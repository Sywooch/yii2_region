<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Userinfo */
?>
<div class="userinfo-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'login',
            'email:email',
            'password',
            'create_time',
            'last_login',
            'auth_key',
            'user_role_id',
            'password_reset_token:ntext',
        ],
    ]) ?>

</div>
