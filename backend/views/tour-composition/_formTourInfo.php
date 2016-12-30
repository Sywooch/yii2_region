<div class="form-group" id="add-tour-info">
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
        'formName' => 'TourInfo',
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes' => [
            "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
            'name' => ['type' => TabularForm::INPUT_TEXTAREA],
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
            'days' => ['type' => TabularForm::INPUT_TEXT],
            'active' => ['type' => TabularForm::INPUT_CHECKBOX,
                'options' => [
                    'style' => 'position : relative; margin-top : -9px'
                ]
            ],
            'hotels_info_id' => [
                'label' => 'Hotels info',
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\HotelsInfo::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Hotels info')],
                ],
                'columnOptions' => ['width' => '200px']
            ],
            'city_id' => [
                'label' => 'City',
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\City::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose City')],
                ],
                'columnOptions' => ['width' => '200px']
            ],
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowTourInfo(' . $key . '); return false;', 'id' => 'tour-info-del-btn']);
                },
            ],
        ],
        'gridSettings' => [
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Tour Info'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowTourInfo()']),
            ]
        ]
    ]);
    echo "    </div>\n\n";
    ?>

