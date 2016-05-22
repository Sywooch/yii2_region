<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\HotelsAppartment $model
*/

$this->title = Yii::t('app', 'HotelsAppartment') . $model->name . ', ' . Yii::t('app', 'Edit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'HotelsAppartments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id, 'hotels_info_id' => $model->hotels_info_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Edit');
?>
<div class="giiant-crud hotels-appartment-update">

    <h1>
        <?= Yii::t('<?= app ?>', 'HotelsAppartment') ?>        <small>
                        <?= $model->name ?>        </small>
    </h1>

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . Yii::t('app', 'View'), ['view', 'id' => $model->id, 'hotels_info_id' => $model->hotels_info_id], ['class' => 'btn btn-default']) ?>
    </div>

    <hr />

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
