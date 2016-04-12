<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
    * @var backend\models\SearchBusRouteHasBusRoutePoint $searchModel
*/

$this->title = Yii::t('app', 'Bus Route Has Bus Route Points');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="giiant-crud bus-route-has-bus-route-point-index">

    <?php //             echo $this->render('_search', ['model' =>$searchModel]);
        ?>

    
    <?php \yii\widgets\Pjax::begin(['id'=>'pjax-main', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>

    <h1>
        <?= Yii::t('app', 'Bus Route Has Bus Route Points') ?>        <small>
            List
        </small>
    </h1>
    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>

        <div class="pull-right">

                                                                                
            <?= 
            \yii\bootstrap\ButtonDropdown::widget(
            [
            'id' => 'giiant-relations',
            'encodeLabel' => false,
            'label' => '<span class="glyphicon glyphicon-paperclip"></span> ' . Yii::t('app', 'Relations'),
            'dropdown' => [
            'options' => [
            'class' => 'dropdown-menu-right'
            ],
            'encodeLabels' => false,
            'items' => [            [
                'url' => ['bus-route/index'],
                'label' => '<i class="glyphicon glyphicon-arrow-right">&nbsp;' . Yii::t('app', 'Bus Route') . '</i>',
            ],            [
                'url' => ['bus-route-point/index'],
                'label' => '<i class="glyphicon glyphicon-arrow-right">&nbsp;' . Yii::t('app', 'Bus Route Point') . '</i>',
            ],]
            ],
            'options' => [
            'class' => 'btn-default'
            ]
            ]
            );
            ?>        </div>
    </div>


    <div class="table-responsive">
        <?= GridView::widget([
        'layout' => '{summary}{pager}{items}{pager}',
        'dataProvider' => $dataProvider,
        'pager' => [
        'class' => yii\widgets\LinkPager::className(),
        'firstPageLabel' => Yii::t('app', 'First'),
        'lastPageLabel' => Yii::t('app', 'Last')        ],
                    'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
        'headerRowOptions' => ['class'=>'x'],
        'columns' => [

                [
            'class' => 'yii\grid\ActionColumn',
            'urlCreator' => function($action, $model, $key, $index) {
                // using the column name as key, not mapping to 'id' like the standard generator
                $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
                return Url::toRoute($params);
            },
            'contentOptions' => ['nowrap'=>'nowrap']
        ],
			// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
[
    'class' => yii\grid\DataColumn::className(),
    'attribute' => 'bus_route_id',
    'value' => function ($model) {
        if ($rel = $model->getBusRoute()->one()) {
            return Html::a($rel->name, ['bus-route/view', 'id' => $rel->id,], ['data-pjax' => 0]);
        } else {
            return '';
        }
    },
    'format' => 'raw',
],
			// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
[
    'class' => yii\grid\DataColumn::className(),
    'attribute' => 'bus_route_point_id',
    'value' => function ($model) {
        if ($rel = $model->getBusRoutePoint()->one()) {
            return Html::a($rel->name, ['bus-route-point/view', 'id' => $rel->id,], ['data-pjax' => 0]);
        } else {
            return '';
        }
    },
    'format' => 'raw',
],
			'first_point',
			'end_point',
        ],
        ]); ?>
    </div>

</div>


<?php \yii\widgets\Pjax::end() ?>



