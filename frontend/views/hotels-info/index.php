<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
    * @var frontend\models\SearchHotelsInfo $searchModel
*/

$this->title = $searchModel->getAliasModel(true);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="giiant-crud hotels-info-index">

    <?php echo $this->render('_search', ['model' =>$searchModel]);
        ?>

    
    <?=  ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item'],
    'itemView' => function ($model, $key, $index, $widget) {
    return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
    },
    ]); ?>



