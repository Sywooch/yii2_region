<?php

use dmstr\helpers\Html;

?>

<?php
echo '<label> Город отправления</label>';
if (isset($countryId)) {
    echo Html::dropDownList('TourInfo[city_id]',
        0,
        \yii\helpers\ArrayHelper::map($model, 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select'),
            'id' => 'tourinfo-city_id',
            'class' => 'form-control',
            'label'
        ]
    );
} else {

    echo Html::dropDownList('TourInfo[city_id]',
        0,
        [],
        ['prompt' => Yii::t('app', 'Error Download'),
            'id' => 'tourinfo-city_id',
            'class' => 'form-control',
        ]
    );
}


?>
