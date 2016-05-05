<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\TourPrice $model
*/

$this->title = $model->getAliasModel() . $model->id . ', ' . Yii::t('app', 'Edit');
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(true), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id, 'tour_info_id' => $model->tour_info_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Edit');
?>
<div class="giiant-crud tour-price-update">

    <h1>
        <?= $model->getAliasModel() ?>        <small>
                        <?= $model->id ?>        </small>
    </h1>

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . Yii::t('app', 'View'), ['view', 'id' => $model->id, 'tour_info_id' => $model->tour_info_id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
