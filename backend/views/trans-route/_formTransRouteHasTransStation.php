<div class="form-group" id="add-trans-route-has-trans-station">
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
        'formName' => 'TransRouteHasTransStation',
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes' => [
            'trans_station_id' => [
                'label' => 'Trans station',
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\TransStation::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Choose Trans station')],
                ],
                'columnOptions' => ['width' => '200px']
            ],
            'position' => ['type' => TabularForm::INPUT_TEXT],
            'active' => ['type' => TabularForm::INPUT_CHECKBOX,
                'options' => [
                    'style' => 'position : relative; margin-top : -9px'
                ]
            ],
            "lock" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowTransRouteHasTransStation(' . $key . '); return false;', 'id' => 'trans-route-has-trans-station-del-btn']);
                },
            ],
        ],
        'gridSettings' => [
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Trans Route Has Trans Station'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowTransRouteHasTransStation()']),
            ]
        ]
    ]);
    echo "    </div>\n\n";
    ?>

