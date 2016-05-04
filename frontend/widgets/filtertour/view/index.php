<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 02.05.2016
 * Time: 17:27
 */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use common\models\HotelsInfo;
use kartik\widgets;
?>

<?= Html::beginForm('#','post',['class' => 'form_filter', 'role' => 'form']) ?>
<div class="form-group filter">
    <div class="hotels">
        <?= Html::checkboxList(HotelsInfo::listAll(),['multiple' => true]) ?>
    </div>
    <div class="range_date">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">Дата с</div>
                <div class="col-md-3"><?= widgets\DatePicker::className() ?></div>
                <div class="col-md-1">по</div>
                <div class="col-md-3"><?= widgets\DatePicker::className() ?></div>
            </div>
        </div>
    </div>
    <div class="price">
        <?= Html::textInput('price') ?>
    </div>
    <div class="button-"

</div>

<?= Html::endForm() ?>