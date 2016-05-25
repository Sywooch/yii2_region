<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
    * @var backend\models\SearchHotelsAppartemnt $searchModel
*/


if (isset($actionColumnTemplates)) {
$actionColumnTemplate = implode(' ', $actionColumnTemplates);
    $actionColumnTemplateString = $actionColumnTemplate;
} else {
Yii::$app->view->params['pageButtons'] = Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New'), ['create'], ['class' => 'btn btn-success']);
    $actionColumnTemplateString = "'{view} {update} {delete}'";
}
?>
<div class="giiant-crud hotels-appartment-index">

    <?php //             echo $this->render('_search', ['model' =>$searchModel]);
        ?>

    
    <?php \yii\widgets\Pjax::begin(['id'=>'pjax-main', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("yo")}']]) ?>

    <h1>
        <?= Yii::t('app', 'HotelsAppartments') ?>        <small>
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
                'url' => ['hotels-appartment-item/index'],
                'label' => '<i class="glyphicon glyphicon-arrow-right">&nbsp;' . Yii::t('app', 'Hotels Appartment Item') . '</i>',
            ],            [
                'url' => ['hotels-info/index'],
                'label' => '<i class="glyphicon glyphicon-arrow-right">&nbsp;' . Yii::t('app', 'Hotels Info') . '</i>',
            ],            [
                'url' => ['hotels-appartment-has-hotels-type-of-food/index'],
                'label' => '<i class="glyphicon glyphicon-arrow-right">&nbsp;' . Yii::t('app', 'Hotels Appartment Has Hotels Type Of Food') . '</i>',
            ],            [
                'url' => ['hotels-type-of-food/index'],
                'label' => '<i class="glyphicon glyphicon-arrow-right">&nbsp;' . Yii::t('app', 'Hotels Type Of Food') . '</i>',
            ],            [
                'url' => ['hotels-pricing/index'],
                'label' => '<i class="glyphicon glyphicon-arrow-right">&nbsp;' . Yii::t('app', 'Hotels Pricing') . '</i>',
            ],            [
                'url' => ['sal-order/index'],
                'label' => '<i class="glyphicon glyphicon-arrow-right">&nbsp;' . Yii::t('app', 'Sal Order') . '</i>',
            ],]
            ],
            'options' => [
            'class' => 'btn-default'
            ]
            ]
            );
            ?>        </div>
    </div>

    <hr />

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
        'columns' => require(__DIR__.'/_columns.php'),
           
        ]); ?>
    </div>

</div>


<?php \yii\widgets\Pjax::end() ?>


