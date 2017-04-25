<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\KursTypeCurrency */

$this->title = Yii::t('app', 'Create Kurs Type Currency');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kurs Type Currencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kurs-type-currency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
