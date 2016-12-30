<?php

namespace backend\controllers;

use backend\models\SearchBusReservation;
use common\models\BusReservation;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BusReservationController implements the CRUD actions for BusReservation model.
 */
class BusReservationController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new', 'add-bus-reservation-has-person'],
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
     * Lists all BusReservation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchBusReservation();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BusReservation model.
     * @param integer $id
     * @param integer $bus_info_id
     * @param integer $bus_way_id
     * @return mixed
     */
    public function actionView($id/*, $bus_info_id, $bus_way_id*/)
    {
        $model = $this->findModel($id/*, $bus_info_id, $bus_way_id*/);
        $providerBusReservationHasPerson = new \yii\data\ArrayDataProvider([
            'allModels' => $model->busReservationHasPerson,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id/*, $bus_info_id, $bus_way_id*/),
            'providerBusReservationHasPerson' => $providerBusReservationHasPerson,
        ]);
    }

    /**
     * Creates a new BusReservation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BusReservation();
        if ($model->loadAll(Yii::$app->request->post(), ['BusReservationHasPerson']) && $model->saveAll(['BusReservationHasPerson'])) {
            return $this->redirect(['view', 'id' => $model->id/*, 'bus_info_id' => $model->bus_info_id, 'bus_way_id' => $model->bus_way_id*/]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BusReservation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $bus_info_id
     * @param integer $bus_way_id
     * @return mixed
     */
    public function actionUpdate($id/*, $bus_info_id, $bus_way_id*/)
    {
        if (Yii::$app->request->post('_asnew') == '1') {
            $model = new BusReservation();
        } else {
            $model = $this->findModel($id/*, $bus_info_id, $bus_way_id*/);
        }

        if ($model->loadAll(Yii::$app->request->post(), ['BusReservationHasPerson']) && $model->saveAll(['BusReservationHasPerson'])) {
            return $this->redirect(['view', 'id' => $model->id/*, 'bus_info_id' => $model->bus_info_id, 'bus_way_id' => $model->bus_way_id*/]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BusReservation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $bus_info_id
     * @param integer $bus_way_id
     * @return mixed
     */
    public function actionDelete($id/*, $bus_info_id, $bus_way_id*/)
    {
        $this->findModel($id/*, $bus_info_id, $bus_way_id*/)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    /**
     *
     * Export BusReservation information into PDF format.
     * @param integer $id
     * @param integer $bus_info_id
     * @param integer $bus_way_id
     * @return mixed
     */
    public function actionPdf($id/*, $bus_info_id, $bus_way_id*/)
    {
        $model = $this->findModel($id/*, $bus_info_id, $bus_way_id*/);
        $providerBusReservationHasPerson = new \yii\data\ArrayDataProvider([
            'allModels' => $model->busReservationHasPerson,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerBusReservationHasPerson' => $providerBusReservationHasPerson,
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
     * Creates a new BusReservation model by another data,
     * so user don't need to input all field from scratch.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param type $id
     * @return type
     */
    public function actionSaveAsNew($id/*, $bus_info_id, $bus_way_id*/)
    {
        $model = new BusReservation();

        if (Yii::$app->request->post('_asnew') != '1') {
            $model = $this->findModel($id/*, $bus_info_id, $bus_way_id*/);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id/*, 'bus_info_id' => $model->bus_info_id, 'bus_way_id' => $model->bus_way_id*/]);
        } else {
            return $this->render('saveAsNew', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the BusReservation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $bus_info_id
     * @param integer $bus_way_id
     * @return BusReservation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id/*, $bus_info_id, $bus_way_id*/)
    {
        if (($model = BusReservation::findOne(['id' => $id/*, 'bus_info_id' => $bus_info_id, 'bus_way_id' => $bus_way_id*/])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for BusReservationHasPerson
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddBusReservationHasPerson()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('BusReservationHasPerson');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formBusReservationHasPerson', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
