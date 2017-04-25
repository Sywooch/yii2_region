<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AgentPercent */

$this->title = Yii::t('app', 'Create Agent Percent');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agent Percents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-percent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
