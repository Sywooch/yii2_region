<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\controllers\base;

use backend\models\SearchHotelsInfo;
use common\models\HotelsInfo;
use dmstr\bootstrap\Tabs;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\UploadedFile;

/**
 * HotelsInfoController implements the CRUD actions for HotelsInfo model.
 */
class HotelsInfoController extends Controller
{
    /**
     * @var boolean whether to enable CSRF validation for the actions in this controller.
     * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
     */
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'bulk-delete'],
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
     * Lists all HotelsInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchHotelsInfo;
        $dataProvider = $searchModel->search($_GET);

        Tabs::clearLocalStorage();

        Url::remember();
        \Yii::$app->session['__crudReturnUrl'] = null;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single HotelsInfo model.
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        \Yii::$app->session['__crudReturnUrl'] = Url::previous();
        Url::remember();
        Tabs::rememberActiveState();

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HotelsInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HotelsInfo;

        try {
            $transact = \Yii::$app->db->beginTransaction();
            if ($model->load($_POST)) {
                $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

                if ($model->save()) {
                    $model->upload();
                    $transact->commit();
                    return $this->redirect(['update', 'id' => $model->id]);
                }
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $transact->rollBack();
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
        }
        if (!isset($model->gps_point_m) && !isset($model->gps_point_p)) {
            $model->gps_point_m = '52.723043';
            $model->gps_point_p = '41.449045';
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing HotelsInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load($_POST)) {

            //Загружаем новые изображения (Если они есть)
            if (is_array($model->imageFiles) && count($model->imageFiles) > 0) {
                $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            }
            if ($model->save()) {
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
            /*
             * TODO Сделать проверку на существование главной картинки
             */
            return $this->render('update', ['model' => $model]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HotelsInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            //Удаляем картинки вместе с записью
            $model = $this->findModel($id);
            $model->removeImages();
            $model->delete();

            //$this->findModel($id)->delete();
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            \Yii::$app->getSession()->addFlash('error', $msg);
            return $this->redirect(Url::previous());
        }

// TODO: improve detection
        $isPivot = strstr('$id', ',');
        if ($isPivot == true) {
            return $this->redirect(Url::previous());
        } elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
            Url::remember(null);
            $url = \Yii::$app->session['__crudReturnUrl'];
            \Yii::$app->session['__crudReturnUrl'] = null;

            return $this->redirect($url);
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the HotelsInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HotelsInfo the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HotelsInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

    /*protected function imageUpdate($model){
        //
    }*/

}
