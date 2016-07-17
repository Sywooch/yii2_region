<?php

namespace frontend\controllers;

use cinghie\articles\models\ItemsSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

class NewsController extends \cinghie\articles\controllers\ItemsController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','create','update','delete','deleteimage','deletemultiple','changestate','activemultiple','deactivemultiple'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['?', '@']
                    ],
                ],
                'denyCallback' => function () {
                    throw new \Exception('You are not allowed to access this page');
                }
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'changestate' => ['post'],
                    'delete' => ['post'],
                    'deleteImage' => ['post'],
                    'deletemultiple' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        // Check RBAC Permission
        if($this->userCanIndex())
        {
            $searchModel = new ItemsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Displays a single Items model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionView($id)
    {
        // Check RBAC Permission
        if($this->userCanView($id))
        {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

}
