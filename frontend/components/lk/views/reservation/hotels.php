<?php

use dmstr\helpers\Html;

$this->registerJs('
$("#reservation-hotels_info_id").on("change", function() {
$.pjax.reload("#pjax-reservation-hotelsinfo div div.col-sm-6", {
history: false,
data: $(this).serialize(),
type: \'POST\',
url: \'getappartment\',

});
});
');
?>

<?php

if (isset($model->country_id)) {
    echo Html::dropDownList('Reservation[hotels_info_id]',
        0,
        \yii\helpers\ArrayHelper::map(\common\models\HotelsInfo::findAll(['country' => $model->country_id, 'active' => 1]), 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select'),
            'id' => 'reservation-hotels_info_id',
            'class' => 'form-control',
        ]
    );
} else {
    echo Html::dropDownList('Reservation[hotels_info_id]',
        0,
        [],
        ['prompt' => Yii::t('app', 'Error Download'),
            'id' => 'reservation-hotels_info_id',
            'class' => 'form-control',
        ]
    );
}


?>

<script type="text/javascript">
    $("#reservation-hotels_info_id").on("change", function () {
        $.pjax.reload("#pjax-reservation-hotelsinfo div div.col-sm-6", {
            history: false,
            data: $(this).serialize(),
            type: 'POST',
            url: 'getappartment',

        });
    });
</script>