<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AgentRekv */

?>
<div class="agent-rekv-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->name) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'user.username',
            'label' => Yii::t('app', 'User'),
        ],
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
        ['attribute' => 'lock', 'visible' => false],
        'active',
        'phone',
        'phone2:ntext',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>