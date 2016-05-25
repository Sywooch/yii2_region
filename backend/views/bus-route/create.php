<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\BusRoute $model
 */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $model->getAliasModel(true)), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud bus-route-create">

    <h1>
        <?= Yii::t('app', 'BusRoute') ?>
        <small>
            <?= $model->name ?>        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?= Html::a(
                Yii::t('app', 'Cancel'),
                \yii\helpers\Url::previous(),
                ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
