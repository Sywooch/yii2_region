<div class="form-group" id="add-sal-order-has-person">
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
        'formName' => 'SalOrderHasPerson',
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes' => [
            'person_id' => [
                'label' => Yii::t('app', 'Person'),
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Person::find()->orderBy('firstname')->asArray()->all(), 'id', 'firstname'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Person')],
                ],
                'columnOptions' => ['width' => '200px']
            ],
            //"lock" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowSalOrderHasPerson(' . $key . '); return false;', 'id' => 'sal-order-has-person-del-btn']);
                },
            ],
        ],
        'gridSettings' => [
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Sal Order Has Person'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowSalOrderHasPerson()']),
            ]
        ]
    ]);
    echo "    </div>\n\n";
    ?>

