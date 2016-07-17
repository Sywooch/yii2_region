<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;




?>

<?php

if (isset($model->country)){
    echo Html::dropDownList('TourInfo[hotels_info_id]',
        0,
        \yii\helpers\ArrayHelper::map(\common\models\HotelsInfo::findAll(['country'=>$model->country]),'id' ,'name' ),
        ['prompt' => Yii::t('app', 'Select'),
            'id' => 'tourinfo-hotels_info_id',
            'class' => 'form-control',
        ]
    );
}
else{
    echo Html::dropDownList('TourInfo[hotels_info_id]',
        0,
        [],
        ['prompt' => Yii::t('app', 'Error Download'),
            'id' => 'tourinfo-hotels_info_id',
            'class' => 'form-control',
        ]
    );
}


?>

<script type="text/javascript">
    /*$("#hotelsappartment-hotels_info_id").on("change", function() {
        $.pjax.reload("#tourinfo-gethotelsappartment div div.col-sm-6", {
            history: false,
            data: $(this).serialize(),
            type: 'POST',
            url: 'getappartment',
        });
    });*/

    $("#tourinfo-hotels_info_id").on("change", function() {
        var now = new Date();
        now = now.getFullYear();
        var value = $("#tourinfo-hotels_info_id option:selected").text();
        value = "Тур за " + now + " год для гостиницы \"" + value + "\".";
        $("#tourinfo-name").val(value);
    });
</script>