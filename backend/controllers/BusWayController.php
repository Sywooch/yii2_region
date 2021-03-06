<?php

namespace backend\controllers;

use backend\models\BusWayGenerator;
use backend\models\SearchBusWay;
use common\models\BusRoute;
use common\models\BusRouteHasBusRoutePoint;
use common\models\BusRoutePoint;
use common\models\BusWay;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BusWayController implements the CRUD actions for BusWay model.
 */
class BusWayController extends Controller
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
                            'save-as-new', 'add-bus-reservation', 'generate'],
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
     * Lists all BusWay models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchBusWay();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BusWay model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerBusReservation = new \yii\data\ArrayDataProvider([
            'allModels' => $model->busReservations,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerBusReservation' => $providerBusReservation,
        ]);
    }

    /**
     * Creates a new BusWay model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BusWay();

        if ($model->loadAll(Yii::$app->request->post(), ['BusReservation']) && $model->saveAll(['BusReservation'])) {
            //Добавляем новый путевой лист с обраткой, если существует соответствующий маршрут
            if ($model->b_reverse == 1){

                //TODO поиск маршрута не только по id, но и по наличию автономного маршрута
                $revId = BusRoute::find()->andWhere(['id'=>$model->bus_route_id])
                ->one()->reverse_id;
                if (isset($revId) && $revId >= 0) {
                    //Создаем копию модели с обратным маршрутом
                    $reverseModel = new BusWay();
                    $reverseModel->load(['BusWay'=>$model->getAttributes()]);
                    $reverseModel->bus_route_id = $revId;
                    $reverseModel->date_begin = $model->reverse_date_begin;
                    $reverseModel->date_end = $model->reverse_date_end;
                    $brModel = BusRouteHasBusRoutePoint::find()
                        ->andWhere(['bus_route_id'=>$reverseModel->bus_route_id])
                        ->andWhere('first_point = 1 OR end_point = 1')
                        ->orderBy('position')
                        ->all();
                    $name = '';
                    foreach ($brModel as $value){
                        $name .= BusRoutePoint::findOne(['id'=>$value->bus_route_point_id])->name . " - ";
                    }
                    $name .= $reverseModel->date_begin;
                    $reverseModel->name = $name;//Вставить название из "старого" маршрута
                    $reverseModel->save();
                    /*$revId = $reverseModel->id;
                    $model->reverse_id = $revId;
                    $model->save();*/
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BusWay model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->request->post('_asnew') == '1') {
            $model = new BusWay();
        } else {
            $model = $this->findModel($id);
        }

        if ($model->loadAll(Yii::$app->request->post(), ['BusReservation']) && $model->saveAll(['BusReservation'])) {
            if ($model->b_reverse == 1){

                //TODO поиск маршрута не только по id, но и по наличию автономного маршрута
                $revId = BusRoute::find()->andWhere(['id'=>$model->bus_route_id])
                    ->one()->reverse_id;
                if (isset($revId) && $revId >= 0) {
                    //Создаем копию модели с обратным маршрутом
                    $reverseModel = new BusWay();
                    $reverseModel->load(['BusWay'=>$model->getAttributes()]);
                    $reverseModel->bus_route_id = $revId;
                    $reverseModel->date_begin = $model->reverse_date_begin;
                    $reverseModel->date_end = $model->reverse_date_end;
                    $brModel = BusRouteHasBusRoutePoint::find()
                        ->andWhere(['bus_route_id'=>$reverseModel->bus_route_id])
                        ->andWhere('first_point = 1 OR end_point = 1')
                        ->orderBy('position')
                        ->all();
                    $name = '';
                    foreach ($brModel as $value){
                        $name .= BusRoutePoint::findOne(['id'=>$value->bus_route_point_id])->name . " - ";
                    }
                    $name .= $reverseModel->date_begin;
                    $reverseModel->name = $name;//Вставить название из "старого" маршрута
                    $reverseModel->save();
                    /*$revId = $reverseModel->id;
                    $model->reverse_id = $revId;
                    $model->save();*/
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BusWay model.
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
     * Export BusWay information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id)
    {
        $model = $this->findModel($id);
        $providerBusReservation = new \yii\data\ArrayDataProvider([
            'allModels' => $model->busReservations,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerBusReservation' => $providerBusReservation,
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
     * Creates a new BusWay model by another data,
     * so user don't need to input all field from scratch.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param type $id
     * @return type
     */
    public function actionSaveAsNew($id)
    {
        $model = new BusWay();

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
     * Finds the BusWay model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BusWay the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BusWay::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for BusReservation
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddBusReservation()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('BusReservation');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formBusReservation', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    public function actionGenerate(){
        $model = new BusWayGenerator();
        if ($model->loadGenerateData(Yii::$app->request->post()) && $model->generate()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('generate', [
                'model' => $model,
            ]);
        }
    }
}
