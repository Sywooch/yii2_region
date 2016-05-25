<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\models\SearchBusRoute $searchModel
 */


if (isset($actionColumnTemplates)) {
    $actionColumnTemplate = implode(' ', $actionColumnTemplates);
    $actionColumnTemplateString = $actionColumnTemplate;
} else {
    Yii::$app->view->params['pageButtons'] = Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New'), ['create'], ['class' => 'btn btn-success']);
    $actionColumnTemplateString = "'{view} {update} {delete}'";
}
?>
<div class="giiant-crud bus-route-index">

    <?php //             echo $this->render('_search', ['model' =>$searchModel]);
    ?>


    <?php \yii\widgets\Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
    

    <div class="table-responsive">
        <?= GridView::widget([
            'layout' => '{summary}{pager}{items}{pager}',
            'dataProvider' => $dataProvider,
            'pager' => [
                'class' => yii\widgets\LinkPager::className(),
                'firstPageLabel' => Yii::t('app', 'First'),
                'lastPageLabel' => Yii::t('app', 'Last')],
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
            'headerRowOptions' => ['class' => 'x'],
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                        ['role'=>'modal-remote','title'=> 'Создать новый маршрут','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Сброс таблицы']).
                    '{toggleData}'.
                    '{export}'.
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
                                'items' => [[
                                    'url' => ['bus-route-has-bus-route-point/index'],
                                    'label' => '<i class="glyphicon glyphicon-arrow-right">&nbsp;' . Yii::t('app', 'Bus Route Has Bus Route Point') . '</i>',
                                ], [
                                    'url' => ['bus-route-point/index'],
                                    'label' => '<i class="glyphicon glyphicon-arrow-right">&nbsp;' . Yii::t('app', 'Bus Route Point') . '</i>',
                                ], [
                                    'url' => ['bus-way/index'],
                                    'label' => '<i class="glyphicon glyphicon-arrow-right">&nbsp;' . Yii::t('app', 'Bus Way') . '</i>',
                                ],]
                            ],
                            'options' => [
                                'class' => 'btn-default'
                            ]
                        ]
                    )
                ],
            ],
            'bordered' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> '. Yii::t('app', 'BusRoutes') . Yii::t('app', 'listing'),
                'before'=>'<em>' . Yii::t('app','* Resize table columns just like a spreadsheet by dragging the column edges.') . '</em>',
                'after'=>\johnitvn\ajaxcrud\BulkButtonWidget::widget([
                        'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Удалить всё',
                            ["bulk-delete"] ,
                            [
                                "class"=>"btn btn-danger btn-xs",
                                'role'=>'modal-remote-bulk',
                                'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                'data-request-method'=>'post',
                                'data-confirm-title'=>Yii::t('app','Are you sure?'),
                                'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item')
                            ]),
                    ]).
                    '<div class="clearfix"></div>',
            ],
            'persistResize' => false,
        ]); ?>
    </div>

</div>


<?php \yii\widgets\Pjax::end() ?>


