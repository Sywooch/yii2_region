<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\SalOrderStatus;
use common\models\HotelsInfo;
use common\models\Userinfo;
use common\models\TransInfo;
use common\models\TourInfo;
use common\models\HotelsAppartment;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\SalOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sal-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>
    
    <?php
    $ur_names = ArrayHelper::map(SalOrderStatus::find()->all(),'id','name');

    echo $form->field($model, 'sal_order_status_id')->dropDownList(
        $ur_names,
        ['prompt' => 'Выберите статус заказа'] // текст, который отображается в качестве первого варианта
    )->label('Статус заказа');
    ?>

    <?= $form->field($model, 'persons')->textarea(['maxlength' => true]) ?>
    <div class="btn btn-default">
        <?= 1/*$this->render('_persons',['model' => $model])*/ ?>

    </div>

    <?= $form->field($model, 'child')->textInput() ?>

    <?= $form->field($model, 'date_begin')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>

    <?= $form->field($model, 'date_end')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>

    <?= $form->field($model, 'enable')->checkbox() ?>

    <?= $form->field($model, 'full_price')->textInput() ?>

    <?= $form->field($model, 'insurance_info')->textarea(['rows' => 6]) ?>

    <?php
    $ur_names = ArrayHelper::map(TransInfo::find()->all(),'id','name');

    echo $form->field($model, 'trans_info_id')->dropDownList(
        $ur_names,
        ['prompt' => 'Выберите транспорт для заказа'] // текст, который отображается в качестве первого варианта
    )->label('Список транспорта');
    ?>

    <?php
    $ur_names = ArrayHelper::map(Userinfo::find()->all(),'id','username');

    echo $form->field($model, 'userinfo_id')->dropDownList(
        $ur_names,
        ['prompt' => 'Выберите пользователя, оформляющего заказ'] // текст, который отображается в качестве первого варианта
    )->label('Список пользователей');
    ?>

    <?php
    $ur_names = ArrayHelper::map(TourInfo::find()->all(),'id','name');

    echo $form->field($model, 'tour_info_id')->dropDownList(
        $ur_names,
        ['prompt' => 'Выберите тур для заказа'] // текст, который отображается в качестве первого варианта
    )->label('Список туров');
    ?>

    <?php
    $ur_names = ArrayHelper::map(HotelsAppartment::find()->all(),'id','name');

    echo $form->field($model, 'hotels_appartment_id')->dropDownList(
        $ur_names,
        ['prompt' => 'Выберите номер и вид обслуживания для заказа'] // текст, который отображается в качестве первого варианта
    )->label('Список номеров и видов обслуживания');
    ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
