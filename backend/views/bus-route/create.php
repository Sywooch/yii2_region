<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BusRoute */

$this->title = Yii::t('app', 'Create Bus Route');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bus Routes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bus-route-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
