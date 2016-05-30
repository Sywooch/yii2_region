<?php

namespace frontend\controllers;

use common\models\HotelsInfo;
use frontend\models\SearchHotelsInfo;
use yii\helpers\Url;

class HotelsController extends \yii\web\Controller
{

    public function actionDetails($id)
    {
        $model = HotelsInfo::findOne(['id' => $id]);
        return $this->render('details',[
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new SearchHotelsInfo();
        $dataProvider = $searchModel->search($_GET);
        $model = new HotelsInfo();

        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model,
        ]);
    }

    public function actionFilter()
    {
        $searchModel = new SearchHotelsInfo();
        $dataProvider = $searchModel->search($_GET);

        Url::remember();
        \Yii::$app->session['__crudReturnUrl'] = null;

        return $this->renderPartial('filter', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

}
