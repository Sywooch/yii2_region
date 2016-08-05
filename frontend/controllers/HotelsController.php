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
        $dpCharacters = SearchHotelsInfo::getCharacters($id);
        return $this->render('details',[
            'model' => $model,
            'dateProviderCharacters' => $dpCharacters,
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new SearchHotelsInfo();
        $dataProvider = $searchModel->search($_GET);
        //$model = new HotelsInfo();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            //'model' => $model,
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
    
    public function actionTop(){
        $searchModel = new SearchHotelsInfo();
        $dataProvider = $searchModel->searchTop();

        Url::remember();
        \Yii::$app->session['__crudReturnUrl'] = null;

        return $this->renderPartial('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    static public function getCharacters($id){
        $searchModel = new SearchHotelsInfo();
        $dataProvider = $searchModel->searchCharacters($id);
        return $dataProvider;
    }

}
