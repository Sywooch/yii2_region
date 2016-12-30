<div class="form-group" id="add-tour-price">
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
        'formName' => 'TourPrice',
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes' => [
            "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],

            'tour_composition_id' => [
                'label' => Yii::t('app', 'Tour composition'),
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\TourComposition::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Tour composition')],
                ],
                'columnOptions' => ['width' => '200px']
            ],
            'price' => ['type' => TabularForm::INPUT_TEXT],
            'active' => ['type' => TabularForm::INPUT_CHECKBOX,
                'options' => [
                    'style' => 'position : relative; margin-top : -9px'
                ]
            ],
            'date_begin' => ['type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\datecontrol\DateControl::classname(),
                'options' => [
                    'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
                    'saveFormat' => 'php:Y-m-d H:i:s',
                    'ajaxConversion' => true,
                    'options' => [
                        'pluginOptions' => [
                            'placeholder' => Yii::t('app', 'Choose Date Begin'),
                            'autoclose' => true,
                        ]
                    ],
                ]
            ],
            'date_end' => ['type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\datecontrol\DateControl::classname(),
                'options' => [
                    'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
                    'saveFormat' => 'php:Y-m-d H:i:s',
                    'ajaxConversion' => true,
                    'options' => [
                        'pluginOptions' => [
                            'placeholder' => Yii::t('app', 'Choose Date End'),
                            'autoclose' => true,
                        ]
                    ],
                ]
            ],
            /*'in_hotels' => ['type' => TabularForm::INPUT_CHECKBOX,
                'options' => [
                    'style' => 'position : relative; margin-top : -9px'
                ]
            ],
            'in_trans' => ['type' => TabularForm::INPUT_CHECKBOX,
                'options' => [
                    'style' => 'position : relative; margin-top : -9px'
                ]
            ],
            'in_food' => ['type' => TabularForm::INPUT_CHECKBOX,
                'options' => [
                    'style' => 'position : relative; margin-top : -9px'
                ]
            ],*/
            "lock" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowTourPrice(' . $key . '); return false;', 'id' => 'tour-price-del-btn']);
                },
            ],
        ],
        'gridSettings' => [
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Tour Price'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowTourPrice()']),
            ]
        ]
    ]);
    echo "    </div>\n\n";
    ?>

