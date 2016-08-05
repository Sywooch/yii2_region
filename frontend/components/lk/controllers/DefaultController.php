<?php

namespace frontend\components\lk\controllers;

use common\models\Person;
use frontend\models\SearchPerson;
use Yii;
use common\models\SalOrder;
use frontend\models\SearchSalOrder;
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
                            'ajax-person-index', 'ajax-person-create'],
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

}