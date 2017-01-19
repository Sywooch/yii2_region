<?php

namespace frontend\components\lk\controllers;

use common\models\Person;
use common\models\SalOrder;
use frontend\components\lk\models\LkOrder;
use frontend\models\GenTour;
use frontend\models\SearchPerson;
use frontend\models\SearchSalOrder;
use kartik\mpdf\Pdf;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;

class DefaultController extends Controller
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
                            'ajax-person-index', 'ajax-person-create', 'mpdf-voucher'],
                        'roles' => ['Super Admin', 'Manager', 'Tagent'],
                    ],
                    [
                        'allow' => false
                    ],
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        //Подключаем список туров, которые забронировал текущий пользователь.
        //kartik/GridView
        //1. Подключаем модуль заказов

        $searchModel = new SearchSalOrder();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionMpdfInvoice()
    {
        $this->layout = 'pdf';
    }
    public function actionMpdfVoucher($id)
    {
        $this->layout = 'pdf';
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        //$headers->add('Content-Type', 'application/pdf');

        $model = SalOrder::findOne(['id' => $id]);
        if ($model->sal_order_status_id == 4 || $model->sal_order_status_id == 5) {
            $providerSalOrderHasPerson = new \yii\data\ArrayDataProvider([
                'allModels' => $model->salOrderHasPeople,
            ]);
            //$model = $this->findModel();
            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'content' => $this->renderPartial('viewpdf', ['model' => $model, 'providerSalOrderHasPerson' => $providerSalOrderHasPerson,]),
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                'cssInline' => '.img-circle {border-radius: 50%;}',
                'options' => [
                    /*'title' => $model->title,*/
                    'subject' => 'PDF'
                ],
                'methods' => [
                    'SetHeader' => ['Лайф Тур Вояж'],
                    'SetFooter' => ['|{PAGENO}|'],
                ]
            ]);

            return $pdf->render();
        } else {
            return false;
        }

    }

    public function actionCreate()
    {
        $model = new SalOrder();

        if ($model->loadAll(Yii::$app->request->post(), ['hotelsAppartment']) && $model->saveAll(['hotelsAppartment'])) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionAjaxPersonIndex()
    {
        $request = Yii::$app->request;
        $searchModel = new SearchPerson();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => Yii::t('app', 'Persons'),
                'content' => $this->renderAjax('_person/index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]),
            ];
        } else {
            return $this->render('_person/index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionAjaxPersonCreate()
    {
        $request = Yii::$app->request;
        $model = new Person();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => Yii::t('app', 'Create new') . ' ' . Yii::t('app', 'Person'),
                    'content' => $this->renderAjax('_person/create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button(Yii::t('app', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button(Yii::t('app', 'Save'), ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {

                /**TODO поменять возвращаемый результат (должен быть возвращен ФИО и ID-шник нового туриста */
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => Yii::t('app', 'Create new') . ' ' . Yii::t('app', 'Person'),
                    'content' => '<span class="text-success">' . Yii::t('app', 'Create ') . Yii::t('app', 'Person') . Yii::t('app', ' success') . '</span>',
                    'footer' => Html::button(Yii::t('app', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a(Yii::t('app', 'Create More'), ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => Yii::t('app', 'Create new') . ' ' . Yii::t('app', 'Person'),
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button(Yii::t('app', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button(Yii::t('app', 'Save'), ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionView($id){

        $model = SalOrder::findOne(['id' => $id]);

        if ($model->enable != 1){
            $order = LkOrder::findOne(['id' => $id]);
            $beginDay = new \DateTime($order->date_begin);
            $endDay = new \DateTime($order->date_end);
            $countDay = $beginDay->diff($endDay)->days;
            $persons = LkOrder::getAllPersons($id);
            $count = $persons->count();

            $countChild = LkOrder::getChildPersons($id)->count();
            $childYears = LkOrder::getChildPersonsYears($id);

            $fullPrice = GenTour::calcFullPrice(
                $model->tour_info_id,
                $model->hotels_appartment_id,
                $model->hotels_type_of_food_id,
                $model->date_begin,
                $model->date_end,
                $countDay,
                $count,
                $countChild,
                $childYears,
                $model->date_begin,
                $model->trans_info_id,
                $model->trans_way_id,
                $model->trans_info_id_reverse,
                $model->trans_way_id_reverse
            );
            $model->full_price = $fullPrice['price'];

        }

        $providerSalOrderHasPerson = new \yii\data\ArrayDataProvider([
            'allModels' => $model->salOrderHasPeople,
        ]);

        $transportTo = new \yii\data\ArrayDataProvider([
            'allModels' => $model->transWay,
        ]);
        $transportOut = new \yii\data\ArrayDataProvider([
            'allModels' => $model->transWayReverse,
        ]);

        return $this->render('view',
            ['model' => $model, 'providerSalOrderHasPerson' => $providerSalOrderHasPerson,
            'providerTransportTo' => $transportTo, 'providerTrasportOut'=>$transportOut]);
    }

}
