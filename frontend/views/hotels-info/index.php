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

<div >

    <div class="col-md-4">
        <?= Html::img($model->getImage()->getUrl('120x'),['alt' => $model->name])?>
    <?php echo $this->render('_search', ['model' =>$searchModel]);
        ?>
    </div>
    
    <div class="col-md-8 panel panel-info">
        <div class="container-fluid ">
            <div class="row">
                <?php
                ?>
            </div>
        </div>
    <?=  ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item'],
    'itemView' => function ($model, $key, $index, $widget) {
    return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
    },
    ]); ?>
    </div>



