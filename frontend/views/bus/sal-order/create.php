<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\bus\SalOrder */

$this->title = Yii::t('app', 'Create Sal Order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sal Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sal-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
