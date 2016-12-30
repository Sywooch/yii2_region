<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TourComposition */

$this->title = Yii::t('app', 'Create Tour Composition');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tour Compositions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-composition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
