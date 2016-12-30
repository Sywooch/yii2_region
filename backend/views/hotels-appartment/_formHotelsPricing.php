<div class="form-group" id="add-hotels-pricing">
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
        'formName' => 'HotelsPricing',
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes' => [
            "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
            'hotels_info_id' => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
            'hotels_type_of_food_id' => [
                'label' => 'Hotels type of food',
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\HotelsTypeOfFood::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Hotels type of food')],
                ],
                'columnOptions' => ['width' => '200px']
            ],
            /*'date' => ['type' => TabularForm::INPUT_WIDGET,
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
            ],*/
            'name' => ['type' => TabularForm::INPUT_TEXTAREA],
            'active' => ['type' => TabularForm::INPUT_CHECKBOX,
                'options' => [
                    'style' => 'position : relative; margin-top : -9px'
                ]
            ],
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowHotelsPricing(' . $key . '); return false;', 'id' => 'hotels-pricing-del-btn']);
                },
            ],
        ],
        'gridSettings' => [
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Hotels Pricing'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowHotelsPricing()']),
            ]
        ]
    ]);
    echo "    </div>\n\n";
    ?>

