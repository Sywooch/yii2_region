<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BusWay */

$this->title = Yii::t('app', 'Create Bus Way');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bus Ways'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->active = 1;
$model->date_begin = date('Y-m-d H:i:s');

?>
<div class="bus-way-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
