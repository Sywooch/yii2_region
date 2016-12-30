<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TransSeats */

$this->title = Yii::t('app', 'Create Trans Seats');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trans Seats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-seats-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
