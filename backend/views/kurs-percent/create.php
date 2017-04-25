<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\KursPercent */

$this->title = Yii::t('app', 'Create Kurs Percent');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kurs Percents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kurs-percent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
