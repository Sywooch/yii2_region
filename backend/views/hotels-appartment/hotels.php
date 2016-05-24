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
    echo Html::dropDownList('HotelsAppartment[hotels_info_id]',
        0,
        \yii\helpers\ArrayHelper::map(\common\models\HotelsInfo::findAll(['country'=>$model->country]),'id' ,'name' ),
        ['prompt' => Yii::t('app', 'Select'),
            'id' => 'hotelsappartment-hotels_info_id',
            'class' => 'form-control',
        ]
    );
}
else{
    echo Html::dropDownList('HotelsAppartment[hotels_info_id]',
        0,
        [],
        ['prompt' => Yii::t('app', 'Error Download'),
            'id' => 'hotelsappartment-hotels_info_id',
            'class' => 'form-control',
        ]
    );
}


?>
