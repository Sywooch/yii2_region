<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\BusReservation $model
*/

$this->title = $model->getAliasModel() . $model->name . ', ' . Yii::t('app', 'Edit');
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(true), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id, 'bus_info_id' => $model->bus_info_id, 'bus_way_id' => $model->bus_way_id, 'kontragent_persons_id' => $model->kontragent_persons_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Edit');
?>
<div class="giiant-crud bus-reservation-update">

    <h1>
        <?= $model->getAliasModel() ?>        <small>
                        <?= $model->name ?>        </small>
    </h1>

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . Yii::t('app', 'View'), ['view', 'id' => $model->id, 'bus_info_id' => $model->bus_info_id, 'bus_way_id' => $model->bus_way_id, 'kontragent_persons_id' => $model->kontragent_persons_id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
