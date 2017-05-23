<?php

namespace backend\controllers;

use backend\models\SearchBusRoute;
use common\models\BusRoute;
use common\models\BusRouteHasBusRoutePoint;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BusRouteController implements the CRUD actions for BusRoute model.
 */
class BusRouteController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new', 'add-bus-route-has-bus-route-point', 'add-bus-way',
                        'test'],
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
     * Lists all BusRoute models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchBusRoute();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BusRoute model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerBusRouteHasBusRoutePoint = new \yii\data\ArrayDataProvider([
            'allModels' => $model->busRouteHasBusRoutePoints,
        ]);
        $providerBusWay = new \yii\data\ArrayDataProvider([
            'allModels' => $model->busWays,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerBusRouteHasBusRoutePoint' => $providerBusRouteHasBusRoutePoint,
            'providerBusWay' => $providerBusWay,
        ]);
    }

    /**
     * Creates a new BusRoute model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BusRoute();

        if ($model->loadAll(Yii::$app->request->post(), ['BusWay']) && $model->saveAll(['BusWay'])) {
            //Формируем обратный маршрут, если выбрана галочка "Формирование обратного маршрута
            if ($model->b_reverse == 1){
                $revId = $model->reverse_id;
                if (!isset($revId) || $revId <= 0) {
                    //Создаем копию модели с обратным маршрутом
                    $reverseModel = new BusRoute();
                    $reverseModel->load(['BusRoute'=>$model->getAttributes()]);
                    $reverseModel->name = "Обратный маршрут: " . $reverseModel->name;//Вставить название из "старого" маршрута
                    $reverseModel->save();
                    $revId = $reverseModel->id;
                    $model->reverse_id = $revId;
                    $model->save();
                }

                BusRouteHasBusRoutePoint::reverseRouteSave($model->id, $revId);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BusRoute model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->request->post('_asnew') == '1') {
            $model = new BusRoute();
        } else {
            $model = $this->findModel($id);
        }

        if ($model->loadAll(Yii::$app->request->post(), ['busWays']) && $model->saveAll(['busWays'])) {
            if ($model->b_reverse == 1){
                $revId = $model->reverse_id;
                if (!isset($revId) || $revId <= 0) {
                    //Создаем копию модели с обратным маршрутом
                    $reverseModel = new BusRoute();
                    $reverseModel->load(['BusRoute'=>$model->getAttributes()]);
                    $reverseModel->name = "Обратный маршрут: " . $reverseModel->name;//Вставить название из "старого" маршрута
                    $reverseModel->save();
                    $revId = $reverseModel->id;
                    $model->reverse_id = $revId;
                    $model->save();
                }

                BusRouteHasBusRoutePoint::reverseRouteSave($model->id, $revId);
            }
            /*return $this->render('update', [
                'model' => $model,
            ]);*/
            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BusRoute model.
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
     * Export BusRoute information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id)
    {
        $model = $this->findModel($id);
        $providerBusRouteHasBusRoutePoint = new \yii\data\ArrayDataProvider([
            'allModels' => $model->busRouteHasBusRoutePoints,
        ]);
        $providerBusWay = new \yii\data\ArrayDataProvider([
            'allModels' => $model->busWays,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerBusRouteHasBusRoutePoint' => $providerBusRouteHasBusRoutePoint,
            'providerBusWay' => $providerBusWay,
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
     * Creates a new BusRoute model by another data,
     * so user don't need to input all field from scratch.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param type $id
     * @return type
     */
    public function actionSaveAsNew($id)
    {
        $model = new BusRoute();

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
     * Finds the BusRoute model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BusRoute the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BusRoute::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for BusRouteHasBusRoutePoint
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddBusRouteHasBusRoutePoint()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('BusRouteHasBusRoutePoint');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add'){
                $row[] = [];
            }
            $key = array_keys($row);
            $l = end($key)-1;
            $row[$l+1]['position'] = $row[$l]['position'] + 10;

            return $this->renderAjax('_formBusRouteHasBusRoutePoint', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }


    /**
     * Action to load a tabular form grid
     * for BusWay
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddBusWay()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('BusWay');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formBusWay', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }



    public function actionTest(){
        BusRouteHasBusRoutePoint::reverseRouteSave(1,2);
    }
}
