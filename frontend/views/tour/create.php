<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TourInfo */

$this->title = Yii::t('app', 'Create Tour Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tour Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
