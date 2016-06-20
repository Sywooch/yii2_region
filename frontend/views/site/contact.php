<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = Yii::t('app', 'Contacts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container well site-contact">
    <div class="row">
        <div class="col-lg-7">
            <h1><?= Html::encode($this->title) ?></h1>

            <h2>
                Если Вы хотите отдохнуть, или у Вас возникли к нам вопросы - <br> обращайтесь по номеру <br>8 (4752) 71-93-25
            </h2>
        </div>
        <p>Вы можете воспользоваться формой обратной связи (не забудьте оставить свой номер телефона, чтобы мы могли
            решить Ваши вопросы максимально быстро:</p>

        <div class="col-lg-5 panel panel-primary">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'subject') ?>
            <?= $form->field($model, 'phone') ?>
            <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app','Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
