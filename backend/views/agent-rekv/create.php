<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AgentRekv */

$this->title = Yii::t('app', 'Create Agent Rekv');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agent Rekvs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-rekv-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
