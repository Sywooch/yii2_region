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
?>

<?= Html::beginForm('#','post',['class' => 'form_filter', 'role' => 'form']) ?>
<div class="form-group filter">
    <div class="hotels">
        <?= Html::checkboxList('name') ?>
    </div>
    <div class="range_date">
        
    </div>

</div>

<?= Html::endForm() ?>