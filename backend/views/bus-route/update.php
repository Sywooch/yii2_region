<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\BusRoute $model
 */

$this->title = Yii::t('app', 'BusRoute') . $model->name . ', ' . Yii::t('app', 'Edit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $model->getAliasModel(true)), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Edit');
?>
<div class="giiant-crud bus-route-update">

    <h1>
        <?= Yii::t('app', 'BusRoute') ?>
        <small>
            <?= $model->name ?>        </small>
    </h1>

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . Yii::t('app', 'View'), ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <hr/>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
