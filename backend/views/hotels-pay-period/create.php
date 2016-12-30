<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\HotelsPayPeriod */

$this->title = Yii::t('app', 'Create Hotels Pay Period');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hotels Pay Periods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotels-pay-period-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
