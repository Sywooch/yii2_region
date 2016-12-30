<div class="form-group" id="add-bus-reservation">
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
        'formName' => 'BusReservation',
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes' => [
            "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
            'name' => ['type' => TabularForm::INPUT_TEXT],
            'bus_info_id' => [
                'label' => 'Bus info',
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\BusInfo::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Bus info')],
                ],
                'columnOptions' => ['width' => '200px']
            ],
            'number_seat' => ['type' => TabularForm::INPUT_TEXT],
            'date' => ['type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\datecontrol\DateControl::classname(),
                'options' => [
                    'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
                    'saveFormat' => 'php:Y-m-d H:i:s',
                    'ajaxConversion' => true,
                    'options' => [
                        'pluginOptions' => [
                            'placeholder' => Yii::t('app', 'Choose Date'),
                            'autoclose' => true,
                        ]
                    ],
                ]
            ],
            'status' => ['type' => TabularForm::INPUT_TEXT],
            'active' => ['type' => TabularForm::INPUT_CHECKBOX,
                'options' => [
                    'style' => 'position : relative; margin-top : -9px'
                ]
            ],
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowBusReservation(' . $key . '); return false;', 'id' => 'bus-reservation-del-btn']);
                },
            ],
        ],
        'gridSettings' => [
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Bus Reservation'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowBusReservation()']),
            ]
        ]
    ]);
    echo "    </div>\n\n";
    ?>

