<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AgentRekv */

$this->title = Yii::t('app', 'Save As New {modelClass}: ', [
    'modelClass' => 'Agent Rekv',
]). ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agent Rekvs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Save As New');
?>
<div class="agent-rekv-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
