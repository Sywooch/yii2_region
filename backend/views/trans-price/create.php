<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TransPrice */

$this->title = Yii::t('app', 'Create Trans Price');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trans Prices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
