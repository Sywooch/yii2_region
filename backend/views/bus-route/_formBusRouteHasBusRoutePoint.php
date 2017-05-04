<div class="form-group" id="add-bus-route-has-bus-route-point">
    <?php
    use kartik\builder\TabularForm;
    use kartik\grid\GridView;
    use yii\data\ArrayDataProvider;
    use yii\helpers\Html;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $row,
        'pagination' => [
            'pageSize' => -1
        ]
    ]);
    echo TabularForm::widget([
        'dataProvider' => $dataProvider,
        'formName' => 'BusRouteHasBusRoutePoint',
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes' => [
            'bus_route_point_id' => [
                'label' => Yii::t('app', 'Bus route point'),
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\BusRoutePoint::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Bus route point')],
                ],
                'columnOptions' => ['width' => '200px']
            ],
            'first_point' => [
                'label' => Yii::t('app', 'First Point'),
                'type' => TabularForm::INPUT_CHECKBOX,
                'options' => [
                    'style' => 'position : relative; margin-top : -9px'
                ]
            ],
            'end_point' => [
                'label' => Yii::t('app', 'End Point'),
                'type' => TabularForm::INPUT_CHECKBOX,
                'options' => [
                    'style' => 'position : relative; margin-top : -9px'
                ]
            ],
            'position' => [
                'label' => Yii::t('app', 'Position'),
                'type' => TabularForm::INPUT_TEXT],
            /*'date_point_forward' => [
                    'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\datecontrol\DateControl::classname(),
                'options' => [
                    'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
                    //'autoWidget' => false,
                    //'widgetClass' => 'yii\jui\DatePicker',
                    'saveFormat' => 'php:Y-m-d H:i',
                    'displayFormat' => 'dd.MM.yyyy hh:mm',
                    'ajaxConversion' => true,
                    'options' => [
                        'pluginOptions' => [
                            'placeholder' => Yii::t('app', 'Choose Date Point Forward'),
                            'autoclose' => true,
                        ]
                    ],
                ]
            ],*/
            'time_pause' => [
                'label' => Yii::t('app', 'Time Pause'),
                'type' => TabularForm::INPUT_TEXT],
            /*'date_point_reverse' => ['type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\datecontrol\DateControl::classname(),
                'options' => [
                    'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
                    'saveFormat' => 'php:Y-m-d H:i',
                    'ajaxConversion' => true,
                    'options' => [
                        'pluginOptions' => [
                            'placeholder' => Yii::t('app', 'Choose Date Point Reverse'),
                            'autoclose' => true,
                        ]
                    ],
                ]
            ],*/
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowBusRouteHasBusRoutePoint(' . $key . '); return false;', 'id' => 'bus-route-has-bus-route-point-del-btn']);
                },
            ],
        ],
        'gridSettings' => [
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Bus Route Has Bus Route Point'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowBusRouteHasBusRoutePoint()']),
            ]
        ]
    ]);
    echo "    </div>\n\n";
    ?>

