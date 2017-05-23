<?php

namespace backend\controllers;

use backend\models\SearchKursCurrency;
use common\models\KursCurrency;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * KursCurrencyController implements the CRUD actions for KursCurrency model.
 */
class KursCurrencyController extends Controller
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
                            'get-currency-from-cb'],
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
     * Lists all KursCurrency models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchKursCurrency();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KursCurrency model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new KursCurrency model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KursCurrency();
        $stop = false;
        if ($model->loadAll(Yii::$app->request->post())) {
            if ($model->active == 1){
                if (!$model->saveCurrency($model->kurs_type_currency_id)){
                    $stop = true;
                }
            }
            else{
                if (!$model->saveAll()){
                    $stop = true;
                }
            }
            if ($stop){
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            else{
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing KursCurrency model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->request->post('_asnew') == '1') {
            $model = new KursCurrency();
        }else{
            $model = $this->findModel($id);
        }
        $stop = false;
        if ($model->loadAll(Yii::$app->request->post())) {
            if ($model->active == 1){
                if (!$model->saveCurrency($model->kurs_type_currency_id)){
                    $stop = true;
                }
            }
            else{
                if (!$model->saveAll()){
                    $stop = true;
                }
            }
            if ($stop){
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
            else{
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing KursCurrency model.
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
     * Export KursCurrency information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
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
    * Creates a new KursCurrency model by another data,
    * so user don't need to input all field from scratch.
    * If creation is successful, the browser will be redirected to the 'view' page.
    *
    * @param mixed $id
    * @return mixed
    */
    public function actionSaveAsNew($id) {
        $model = new KursCurrency();

        if (Yii::$app->request->post('_asnew') != '1') {
            $model = $this->findModel($id);
        }

        if ($model->loadAll(Yii::$app->request->post())) {
            if ($model->active == 1){
                if (!$model->saveCurrency($model->kurs_type_currency_id)){
                    $stop = true;
                }
            }
            else{
                if (!$model->saveAll()){
                    $stop = true;
                }
            }
            if ($stop){
                return $this->render('saveAsNew', [
                    'model' => $model,
                ]);
            }
            else{
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            return $this->render('saveAsNew', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Функция получает из ЦБ РФ курс валюты $ncode на дату $date
     * По факту получения текущего курса - он записывается в БД и применяется к нему внутренний процент.
     * @param $date
     * @param $ncode
     */
    public function actionGetCurrencyFromCb($ncode = '', $date = 'current'){
        /*Получаем текущий курс*/
        $n = new KursCurrency();
        $n->CurrencyUpdated();
        return $this->redirect(['index']);
    }

    /**
     * Finds the KursCurrency model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KursCurrency the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KursCurrency::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
