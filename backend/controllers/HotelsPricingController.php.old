<?php

namespace backend\controllers;

/*use Yii;
use common\models\HotelsPricing;
use backend\models\SearchHotelsPricing;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;*/
use backend\models\SearchHotelsPricing;

/**
 * HotelsPricingController implements the CRUD actions for HotelsPricing model.
 */
class HotelsPricingController extends \backend\controllers\base\HotelsPricingController
{
    /**
     * @inheritdoc
     */
    /*public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }*/

    /**
     * Lists all HotelsPricing models.
     * @return mixed
     */
    /*public function actionIndex()
    {    
        $searchModel = new SearchHotelsPricing();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/


    /**
     * Displays a single HotelsPricing model.
     * @param integer $id
     * @return mixed
     */
    /*public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> Yii::t('app', 'HotelsPricing') . ' #' .$id,
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button(Yii::t('app', 'Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('app', 'Edit'),['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }*/

    /**
     * Creates a new HotelsPricing model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new HotelsPricing();

        if($request->isAjax){

            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> Yii::t('app', 'Create new') . ' ' . Yii::t('app', 'HotelsPricing'),
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('app', 'Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('app', 'Save'),['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> Yii::t('app', 'Create new') . ' ' . Yii::t('app', 'HotelsPricing'),
                    'content'=>'<span class="text-success">' . Yii::t('app', 'Create HotelsPricing success') . '</span>',
                    'footer'=> Html::button(Yii::t('app', 'Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('app', 'Create More'),['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> Yii::t('app', 'Create new') . ' ' . Yii::t('app', 'HotelsPricing'),
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('app', 'Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('app', 'Save'),['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{

            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }*/

    /**
     * Updates an existing HotelsPricing model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){

            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> Yii::t('app', 'Update') . ' ' . Yii::t('app', 'HotelsPricing') . ' #' .$id,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button(Yii::t('app', 'Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('app', 'Save'),['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> Yii::t('app', 'HotelsPricing') . ' #' .$id,
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button(Yii::t('app', 'Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('app', 'Edit'),['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> Yii::t('app', 'Update') . ' ' . Yii::t('app', 'HotelsPricing') . ' #' .$id,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button(Yii::t('app', 'Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('app', 'Save'),['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{

            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }*/

    /**
     * Delete an existing HotelsPricing model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>true];    
        }else{
            return $this->redirect(['index']);
        }


    }*/

     /**
     * Delete multiple existing HotelsPricing model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = $request->post('pks'); // Array or selected records primary keys
        foreach (HotelsPricing::findAll(json_decode($pks)) as $model) {
            $model->delete();
        }
        

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>true]; 
        }else{
            return $this->redirect(['index']);
        }
       
    }*/

    /**
     * Finds the HotelsPricing model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HotelsPricing the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*protected function findModel($id)
    {
        if (($model = HotelsPricing::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }*/
}
