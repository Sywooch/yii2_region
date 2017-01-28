<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;


/* @var $this \yii\web\View */
/* @var $content string */

$this->title = "Счет на оплату №".$model->id;
AppAsset::register($this);
//$this->registerJs('jQuery("div.animation")')
?>
<?php $this->beginPage() ?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        body { width: 210mm; margin-left: auto; margin-right: auto; border: 1px #efefef solid; font-size: 11pt;}
        table.invoice_bank_rekv { border-collapse: collapse; border: 1px solid; }
        table.invoice_bank_rekv > tbody > tr > td, table.invoice_bank_rekv > tr > td { border: 1px solid; }
        table.invoice_items { border: 1px solid; border-collapse: collapse;}
        table.invoice_items td, table.invoice_items th { border: 1px solid;}
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<table width="100%">
    <tr>
        <td>&nbsp;</td>
        <td style="width: 155mm;">
            <div style="width:155mm; ">Внимание! Оплата данного счета означает согласие с условиями оказания услуги. Уведомление об оплате обязательно, в противном случае не гарантируется наличие товара на складе. Товар отпускается по факту прихода денег на р/с Исполнителя, самовывозом, при наличии доверенности и паспорта.</div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <!--<div style="text-align:center;  font-weight:bold;">
                Образец заполнения платежного поручения
                </div>-->
        </td>
    </tr>
</table>



<?= $content ?>




<?php $this->endBody() ?>
</body>
</html>

<?php $this->endPage() ?>