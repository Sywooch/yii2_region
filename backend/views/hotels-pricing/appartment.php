<?php
use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;

?>

<?php

if (isset($model->hotels_appartment_hotels_info_id)){
    echo Html::dropDownList('HotelsPricing[hotels_appartment_id]',
        0,
        \yii\helpers\ArrayHelper::map(\common\models\HotelsAppartment::findAll(['hotels_info_id'=>$model->hotels_appartment_hotels_info_id]),'id' ,'name' ),
        ['prompt' => Yii::t('app', 'Select'),
            'id' => 'hotelspricing-hotels_appartment_id',
            'class' => 'form-control',
        ]
    );
}
else{
    echo Html::dropDownList('HotelsPricing[hotels_appartment_id]',
        0,
        [],
        ['prompt' => Yii::t('app', 'Error Download'),
            'id' => 'hotelspricing-hotels_appartment_id',
            'class' => 'form-control',
        ]
    );
}


?>