<?php

namespace backend\controllers;

use Yii;
use common\models\BusRouteHasBusRoutePoint;
use backend\models\SearchBusRouteHasBusRoutePoint;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * BusRouteHasBusRoutePointController implements the CRUD actions for BusRouteHasBusRoutePoint model.
 */
class BusRouteHasBusRoutePointController extends Controller
{
    /**
     * @inheritdoc
     */
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
        ];
    }

    /**
     * Lists all BusRouteHasBusRoutePoint models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new SearchBusRouteHasBusRoutePoint();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single BusRouteHasBusRoutePoint model.
     * @param integer $bus_route_id
     * @param integer $bus_route_point_id
     * @return mixed
     */
    public function actionView($bus_route_id, $bus_route_point_id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "BusRouteHasBusRoutePoint #".$bus_route_id, $bus_route_point_id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($bus_route_id, $bus_route_point_id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','bus_route_id, $bus_route_point_id'=>$bus_route_id, $bus_route_point_id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($bus_route_id, $bus_route_point_id),
            ]);
        }
    }

    /**
     * Creates a new BusRouteHasBusRoutePoint model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new BusRouteHasBusRoutePoint();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new BusRouteHasBusRoutePoint",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new BusRouteHasBusRoutePoint",
                    'content'=>'<span class="text-success">Create BusRouteHasBusRoutePoint success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new BusRouteHasBusRoutePoint",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'bus_route_id' => $model->bus_route_id, 'bus_route_point_id' => $model->bus_route_point_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing BusRouteHasBusRoutePoint model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $bus_route_id
     * @param integer $bus_route_point_id
     * @return mixed
     */
    public function actionUpdate($bus_route_id, $bus_route_point_id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($bus_route_id, $bus_route_point_id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update BusRouteHasBusRoutePoint #".$bus_route_id, $bus_route_point_id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "BusRouteHasBusRoutePoint #".$bus_route_id, $bus_route_point_id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','bus_route_id, $bus_route_point_id'=>$bus_route_id, $bus_route_point_id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update BusRouteHasBusRoutePoint #".$bus_route_id, $bus_route_point_id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'bus_route_id' => $model->bus_route_id, 'bus_route_point_id' => $model->bus_route_point_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing BusRouteHasBusRoutePoint model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $bus_route_id
     * @param integer $bus_route_point_id
     * @return mixed
     */
    public function actionDelete($bus_route_id, $bus_route_point_id)
    {
        $request = Yii::$app->request;
        $this->findModel($bus_route_id, $bus_route_point_id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing BusRouteHasBusRoutePoint model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $bus_route_id
     * @param integer $bus_route_point_id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = $request->post('pks'); // Array or selected records primary keys
        foreach (BusRouteHasBusRoutePoint::findAll(json_decode($pks)) as $model) {
            $model->delete();
        }
        

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the BusRouteHasBusRoutePoint model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $bus_route_id
     * @param integer $bus_route_point_id
     * @return BusRouteHasBusRoutePoint the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($bus_route_id, $bus_route_point_id)
    {
        if (($model = BusRouteHasBusRoutePoint::findOne(['bus_route_id' => $bus_route_id, 'bus_route_point_id' => $bus_route_point_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
