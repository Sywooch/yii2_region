<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Organization */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Organization').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'fullname:ntext',
        'inn',
        'kpp',
        'ogrn',
        'bik',
        'bankname',
        'rs',
        'ks',
        'direktor_fio',
        'direktor_dolgnost',
        'glbuh_fio',
        'glbuh_dolgnost',
        'phone',
        'phone2:ntext',
        ['attribute' => 'lock', 'visible' => false],
        'active',
        'early_day',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
