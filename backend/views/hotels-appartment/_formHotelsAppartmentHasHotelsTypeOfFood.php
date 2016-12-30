<div class="form-group" id="add-hotels-appartment-has-hotels-type-of-food">
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
        'formName' => 'HotelsAppartmentHasHotelsTypeOfFood',
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes' => [
            //'hotels_info_id' => ['type' => TabularForm::INPUT_TEXT], //hotels_appartment_hotels_info_id
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
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowHotelsAppartmentHasHotelsTypeOfFood(' . $key . '); return false;', 'id' => 'hotels-appartment-has-hotels-type-of-food-del-btn']);
                },
            ],
        ],
        'gridSettings' => [
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Hotels Appartment Has Hotels Type Of Food'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowHotelsAppartmentHasHotelsTypeOfFood()']),
            ]
        ]
    ]);
    echo "    </div>\n\n";
    ?>

