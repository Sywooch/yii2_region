<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Что-то пошло не так при обработке Вашего запроса.
        Возможно вы не верно указали адрес или перешли по не существующей ссылке.

    </p>
    <p>
        Приносим Вам свои извинения за доствленные неудобства.
        <!--Если эта проблема возникла на нашей стороне, то мы в скором времени ее решим.-->
        Спасибо за понимание.

    </p>

</div>
