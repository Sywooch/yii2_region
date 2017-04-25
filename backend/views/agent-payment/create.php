<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AgentPayment */

$this->title = Yii::t('app', 'Create Agent Payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agent Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
