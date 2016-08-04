<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\bus\BusRoutePoint */

$this->title = Yii::t('app', 'Create Bus Route Point');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bus Route Points'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bus-route-point-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
