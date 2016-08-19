<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 03.08.16
 * Time: 18:30
 */
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

//Шаг 3 мастера создания тура для турагенств. Завершающий. Выводится сводная информация и стоимость ПРОЖИВАНИЯ

//Сводная информация по заказа, идет перерасчет стоимости на общее количество человек, если есть дети, применяется скидка

echo \yii\base\View::render('../layouts/menu.php');
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sal Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sal-order-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Sal Order') . ' ' . Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
            <?=
            Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'),
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            ) ?>
            <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'date',
            [
                'attribute' => 'salOrderStatus.name',
                'label' => Yii::t('app', 'Sal Order Status'),
            ],
            'date_begin',
            'date_end',
            'enable',
            [
                'attribute' => 'hotelsInfo.name',
                'label' => Yii::t('app', 'Hotels Info'),
            ],
            [
                'attribute' => 'hotelsAppartment.name',
                'label' => Yii::t('app', 'Hotels Appartment'),
            ],
            [
                'attribute' => 'hotelsTypeOfFood.name',
                'label' => Yii::t('app', 'Type Of Food'),
            ],
            [
                'attribute' => 'transInfo.name',
                'label' => Yii::t('app', 'Trans Info'),
            ],
            [
                'attribute' => 'userinfo.username',
                'label' => Yii::t('app', 'Userinfo'),
            ],
            [
                'attribute' => 'tourInfo.name',
                'label' => Yii::t('app', 'Tour Info'),
            ],
            'full_price',
            'insurance_info:ntext',
            ['attribute' => 'lock', 'visible' => false],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerSalOrderHasPerson->totalCount) {
            $gridColumnSalOrderHasPerson = [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'person.lastname',
                    'label' => Yii::t('app', 'Fname')
                ],
                [
                    'attribute' => 'person.firstname',
                    'label' => Yii::t('app', 'Iname')
                ],
                [
                    'attribute' => 'person.secondname',
                    'label' => Yii::t('app', 'Oname')
                ],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerSalOrderHasPerson,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-sal-order-has-person']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Sal Order Has Person')),
                ],
                'columns' => $gridColumnSalOrderHasPerson
            ]);
        }
        ?>
    </div>
</div>