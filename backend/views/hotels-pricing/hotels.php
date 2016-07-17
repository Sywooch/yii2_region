<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;

$this->registerJs('
$("#hotelspricing-hotels_appartment_hotels_info_id").on("change", function() {
$.pjax.reload("#pjax-hotelspricing-hotelsinfo div div.col-sm-6", {
history: false,
data: $(this).serialize(),
type: \'POST\',
url: \'getappartment\',

});
});
');
?>

<?php

if (isset($model->country)){
    echo Html::dropDownList('HotelsPricing[hotels_appartment_hotels_info_id]',
        0,
        \yii\helpers\ArrayHelper::map(\common\models\HotelsInfo::findAll(['country'=>$model->country, 'active' => 1]),'id' ,'name' ),
        ['prompt' => Yii::t('app', 'Select'),
            'id' => 'hotelspricing-hotels_appartment_hotels_info_id',
            'class' => 'form-control',
        ]
    );
}
else{
    echo Html::dropDownList('HotelsPricing[hotels_appartment_hotels_info_id]',
        0,
        [],
        ['prompt' => Yii::t('app', 'Error Download'),
            'id' => 'hotelspricing-hotels_appartment_hotels_info_id',
            'class' => 'form-control',
        ]
    );
}


?>

<script type="text/javascript">
    $("#hotelspricing-hotels_appartment_hotels_info_id").on("change", function() {
        $.pjax.reload("#pjax-hotelspricing-hotelsinfo div div.col-sm-6", {
            history: false,
            data: $(this).serialize(),
            type: 'POST',
            url: 'getappartment',

        });
    });
</script>