<?php

namespace backend\controllers;

use backend\models\SearchHotelsAppartment;
use common\models\HotelsAppartment;
use common\models\HotelsInfo;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * HotelsAppartmentController implements the CRUD actions for HotelsAppartment model.
 */
class HotelsAppartmentController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new',
                            'add-hotels-appartment-has-hotels-type-of-food', 'add-hotels-pricing', 'child-hotels-info'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all HotelsAppartment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchHotelsAppartment();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HotelsAppartment model.
     * @param integer $id
     * @param integer $hotels_info_id
     * @return mixed
     */
    public function actionView($id, $hotels_info_id)
    {
        $model = $this->findModel($id, $hotels_info_id);
        $providerHotelsAppartmentHasHotelsTypeOfFood = new \yii\data\ArrayDataProvider([
            'allModels' => $model->hotelsAppartmentHasHotelsTypeOfFoods,
        ]);
        $providerHotelsPricing = new \yii\data\ArrayDataProvider([
            'allModels' => $model->hotelsPricings,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id, $hotels_info_id),
            'providerHotelsAppartmentHasHotelsTypeOfFood' => $providerHotelsAppartmentHasHotelsTypeOfFood,
            'providerHotelsPricing' => $providerHotelsPricing,
        ]);
    }

    /**
     * Creates a new HotelsAppartment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HotelsAppartment();

        if ($model->loadAll(Yii::$app->request->post(), ['salOrders']) && $model->saveAll(['salOrders'])) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->imageFiles) {
                $model->upload();
            }
            return $this->redirect(['update', 'id' => $model->id, 'hotels_info_id' => $model->hotels_info_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HotelsAppartment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $hotels_info_id
     * @return mixed
     */
    public function actionUpdate($id, $hotels_info_id)
    {
        if (Yii::$app->request->post('_asnew') == '1') {
            $model = new HotelsAppartment();
        } else {
            $model = $this->findModel($id, $hotels_info_id);
        }

        if ($model->loadAll(Yii::$app->request->post(), ['salOrders', 'hotelsPricings'])
            && $model->saveAll(['salOrders', 'hotelsPricings'])
        ) {

            if (is_array($model->imageFiles) && count($model->imageFiles) > 0) {
                $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
                $model->upload();
            }

            if (isset($_POST['delImages'])) {
                $model->delImages = $_POST['delImages'];
                $model->imageDelete($model->delImages);
            }
            if (isset($_POST['mainImage'])) {
                $model->mainImage = $_POST['mainImage'];
                $model->setMainImage($model->getImageByField('urlAlias', $model->mainImage));
            }

            return $this->redirect(['view', 'id' => $model->id, 'hotels_info_id' => $model->hotels_info_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HotelsAppartment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $hotels_info_id
     * @return mixed
     */
    public function actionDelete($id, $hotels_info_id)
    {
        $this->findModel($id, $hotels_info_id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    /**
     *
     * Export HotelsAppartment information into PDF format.
     * @param integer $id
     * @param integer $hotels_info_id
     * @return mixed
     */
    public function actionPdf($id, $hotels_info_id)
    {
        $model = $this->findModel($id, $hotels_info_id);
        $providerHotelsAppartmentHasHotelsTypeOfFood = new \yii\data\ArrayDataProvider([
            'allModels' => $model->hotelsAppartmentHasHotelsTypeOfFoods,
        ]);
        $providerHotelsPricing = new \yii\data\ArrayDataProvider([
            'allModels' => $model->hotelsPricings,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerHotelsAppartmentHasHotelsTypeOfFood' => $providerHotelsAppartmentHasHotelsTypeOfFood,
            'providerHotelsPricing' => $providerHotelsPricing,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    /**
     * Creates a new HotelsAppartment model by another data,
     * so user don't need to input all field from scratch.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param type $id
     * @return type
     */
    public function actionSaveAsNew($id, $hotels_info_id)
    {
        $model = new HotelsAppartment();

        if (Yii::$app->request->post('_asnew') != '1') {
            $model = $this->findModel($id, $hotels_info_id);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'hotels_info_id' => $model->hotels_info_id]);
        } else {
            return $this->render('saveAsNew', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the HotelsAppartment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $hotels_info_id
     * @return HotelsAppartment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $hotels_info_id)
    {
        if (($model = HotelsAppartment::findOne(['id' => $id, 'hotels_info_id' => $hotels_info_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for HotelsAppartmentHasHotelsTypeOfFood
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddHotelsAppartmentHasHotelsTypeOfFood()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('HotelsAppartmentHasHotelsTypeOfFood');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formHotelsAppartmentHasHotelsTypeOfFood', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for HotelsPricing
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddHotelsPricing()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('HotelsPricing');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formHotelsPricing', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    public function actionChildHotelsInfo()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = HotelsInfo::find()->andWhere(['country' => $id])->asArray()->all();
            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $hotels) {
                    $out[] = ['id' => $hotels['id'], 'name' => $hotels['name']];
                    if ($i == 0) {
                        $selected = $hotels['id'];
                    }
                }
                // Shows how you can preselect a value
                echo Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

}
