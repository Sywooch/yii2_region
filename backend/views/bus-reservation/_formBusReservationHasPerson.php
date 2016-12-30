<div class="form-group" id="add-bus-reservation-has-person">
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
        'formName' => 'BusReservationHasPerson',
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes' => [
            'person_id' => [
                'label' => 'Person',
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Person::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Person')],
                ],
                'columnOptions' => ['width' => '200px']
            ],
            'number_seats' => ['type' => TabularForm::INPUT_TEXT],
            "lock" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowBusReservationHasPerson(' . $key . '); return false;', 'id' => 'bus-reservation-has-person-del-btn']);
                },
            ],
        ],
        'gridSettings' => [
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Bus Reservation Has Person'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowBusReservationHasPerson()']),
            ]
        ]
    ]);
    echo "    </div>\n\n";
    ?>

