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
    <div class="col-sm-12">
        <h2><?= Yii::t('app', 'Sal Order') . ' №' . Html::encode($this->title) ?></h2>

    </div>
    <?php
    if ($model->enable == 0){
    ?>
    <div id="accept-tour">
        <div class="row">
            <div class="col-sm-12">
                <p>
                    <h2>
                <p class="text-warning">
                    Внимание!
                </p>
                <p >
                    <small class="text-primary">
                        Проверьте правильность введенных данных, а также, конечную стоимость и
                        подтвердите или отмените заказ.
                    </small>
                </p>
                <!--Все заказы, не подтвержденые в течении 20 минут, будут автоматически удаляться. -->
                </h2></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" style="margin-top: 15px">

                <?= Html::a(Yii::t('app', 'Подтвердить заказ'),
                    ['choose-reserv', '_reservation' => $model->id, 'order_id' => $model->id],
                    ['class' => 'btn btn-primary',
                    'data' => [
                        'confirm' => Yii::t('app', 'Внимание! Отмена заказа невозможна. Вы уверены, что хотите оформить заказ?'),
                        'method' => 'post',
                    ],
                ]) ?>

                <?= Html::a(Yii::t('app', 'Отменить заказ'), ['choose-reserv', '_not_reservation' => $model->id, 'order_id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Вы действительно отменяете заказ?'),
                        'method' => 'post',
                    ],
                ])
                ?>

            </div>
        </div>

    </div>
    <?php }?>

    <div class="row">
        <div class="panel panel-info">
            <div class="panel-body">

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
                        'attribute' => 'user.username',
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
        </div>
    </div>

    <div class="row">
        <div class="panel panel-info">
            <div class="pane-body">

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
    </div>
</div>