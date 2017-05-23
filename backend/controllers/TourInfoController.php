<?php

namespace backend\controllers;

use backend\models\SearchTourInfo;
use common\models\City;
use common\models\TourInfo;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * TourInfoController implements the CRUD actions for TourInfo model.
 */
class TourInfoController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf',
                            'save-as-new', 'add-tour-info-has-tour-type',
                            'add-tour-info-has-tour-type-transport', 'add-tour-price', 'get-city',
                            'add-tour-other-price',
                            'child-city', 'child-hotels-info'],
                        'roles' => ['admin','Super Admin']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all TourInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchTourInfo();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TourInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerTourInfoHasTourType = new \yii\data\ArrayDataProvider([
            'allModels' => $model->tourInfoHasTourTypes,
        ]);
        $providerTourInfoHasTourTypeTransport = new \yii\data\ArrayDataProvider([
            'allModels' => $model->tourInfoHasTourTypeTransports,
        ]);
        $providerTourPrice = new \yii\data\ArrayDataProvider([
            'allModels' => $model->tourPrices,
        ]);
        $providerTourOtherPrice = new \yii\data\ArrayDataProvider([
            'allModels' => $model->tourOtherPrices,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerTourInfoHasTourType' => $providerTourInfoHasTourType,
            'providerTourInfoHasTourTypeTransport' => $providerTourInfoHasTourTypeTransport,
            'providerTourPrice' => $providerTourPrice,
            'providerTourOtherPrice' => $providerTourOtherPrice,
        ]);
    }

    /**
     * Creates a new TourInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TourInfo();

        if ($model->loadAll(Yii::$app->request->post(), ['salOrders', 'salBaskets']) && $model->saveAll(['salOrders', 'salBaskets'])) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TourInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->request->post('_asnew') == '1') {
            $model = new TourInfo();
        } else {
            $model = $this->findModel($id);
        }

        if ($model->loadAll(Yii::$app->request->post(), ['salOrders', 'salBaskets']) && $model->saveAll(['salOrders', 'salBaskets'])) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TourInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    /**
     *
     * Export TourInfo information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id)
    {
        $model = $this->findModel($id);
        $providerTourInfoHasTourType = new \yii\data\ArrayDataProvider([
            'allModels' => $model->tourInfoHasTourTypes,
        ]);
        $providerTourInfoHasTourTypeTransport = new \yii\data\ArrayDataProvider([
            'allModels' => $model->tourInfoHasTourTypeTransports,
        ]);
        $providerTourOtherPrice = new \yii\data\ArrayDataProvider([
            'allModels' => $model->tourOtherPrices,
        ]);
        $providerTourPrice = new \yii\data\ArrayDataProvider([
            'allModels' => $model->tourPrices,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerTourInfoHasTourType' => $providerTourInfoHasTourType,
            'providerTourInfoHasTourTypeTransport' => $providerTourInfoHasTourTypeTransport,
            'providerTourPrice' => $providerTourPrice,
            'providerTourOtherPrice' => $providerTourOtherPrice,
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
     * Creates a new TourInfo model by another data,
     * so user don't need to input all field from scratch.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param type $id
     * @return type
     */
    public function actionSaveAsNew($id)
    {
        $model = new TourInfo();

        if (Yii::$app->request->post('_asnew') != '1') {
            $model = $this->findModel($id);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('saveAsNew', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the TourInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TourInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TourInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for TourInfoHasTourType
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddTourInfoHasTourType()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('TourInfoHasTourType');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formTourInfoHasTourType', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for TourInfoHasTourTypeTransport
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddTourInfoHasTourTypeTransport()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('TourInfoHasTourTypeTransport');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formTourInfoHasTourTypeTransport', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for TourOtherPrice
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddTourOtherPrice()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('TourOtherPrice');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formTourOtherPrice', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for TourPrice
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddTourPrice()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('TourPrice');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formTourPrice', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**TODO Полностью доработать получение городов в данной стране через ajax*/
    /**
     * @param $countryId
     * @return string
     */
    public function actionAjaxCity($countryId)
    {

        $countryId = Yii::$app->request->get('country_id');
        $model = City::find()->andWhere(['country_id' => $countryId])->active()->all();

        return $this->renderPartial('_ajaxCountry', [
            'model' => $model,
        ]);
    }

    public function actionGetCity()
    {
        $countryId = Yii::$app->request->post('TourInfo');
        $countryId = $countryId['country_id'];
        $model = City::findAll(['country_id' => $countryId, 'active' => 1]);

        return $this->renderPartial('city', [
            'model' => $model,
            'countryId' => $countryId,
        ]);
    }

    public function actionChildCity()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = \common\models\City::find()->andWhere(['country_id' => $id])->asArray()->all();
            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $value) {
                    $out[] = ['id' => $value['id'], 'name' => $value['name']];
                    if ($i == 0) {
                        $selected = $value['id'];
                    }
                }
                // Shows how you can preselect a value
                echo Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionChildHotelsInfo()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = \common\models\HotelsInfo::find()->active()->andWhere(['city_id' => $id])->asArray()->all();
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
