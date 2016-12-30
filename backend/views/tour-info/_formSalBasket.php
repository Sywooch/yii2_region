<div class="form-group" id="add-sal-basket">
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
        'formName' => 'SalBasket',
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes' => [
            "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
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
            'userinfo_id' => [
                'label' => 'Userinfo',
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Userinfo::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Userinfo')],
                ],
                'columnOptions' => ['width' => '200px']
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
            'trans_info_id' => [
                'label' => 'Trans info',
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\TransInfo::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Trans info')],
                ],
                'columnOptions' => ['width' => '200px']
            ],
            'price' => ['type' => TabularForm::INPUT_TEXT],
            'col_day' => ['type' => TabularForm::INPUT_TEXT],
            'col_person' => ['type' => TabularForm::INPUT_TEXT],
            'col_kids' => ['type' => TabularForm::INPUT_TEXT],
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowSalBasket(' . $key . '); return false;', 'id' => 'sal-basket-del-btn']);
                },
            ],
        ],
        'gridSettings' => [
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Sal Basket'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowSalBasket()']),
            ]
        ]
    ]);
    echo "    </div>\n\n";
    ?>

