<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SalOrder */
$this->title = $model->id;


?>

<table width="100%" cellpadding="2" cellspacing="2" class="invoice_bank_rekv">
    <tr>
        <td colspan="2" rowspan="2" style="min-height:13mm; width: 105mm;">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="height: 13mm;">
                <tr>
                    <td valign="top">
                        <div>Укажите название банка</div>
                    </td>
                </tr>
                <tr>
                    <td valign="bottom" style="height: 3mm;">
                        <div style="font-size:10pt;">Банк получателя        </div>
                    </td>
                </tr>
            </table>
        </td>
        <td style="min-height:7mm;height:auto; width: 25mm;">
            <div>БИK</div>
        </td>
        <td rowspan="2" style="vertical-align: top; width: 60mm;">
            <div style=" height: 7mm; line-height: 7mm; vertical-align: middle;">Бик банка</div>
            <div>Счет банка</div>
        </td>
    </tr>
    <tr>
        <td style="width: 25mm;">
            <div>Сч. №</div>
        </td>
    </tr>
    <tr>
        <td style="min-height:6mm; height:auto; width: 50mm;">
            <div>ИНН 0000000</div>
        </td>
        <td style="min-height:6mm; height:auto; width: 55mm;">
            <div>КПП </div>
        </td>
        <td rowspan="2" style="min-height:19mm; height:auto; vertical-align: top; width: 25mm;">
            <div>Сч. №</div>
        </td>
        <td rowspan="2" style="min-height:19mm; height:auto; vertical-align: top; width: 60mm;">
            <div>Расчетный счет</div>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="min-height:13mm; height:auto;">

            <table border="0" cellpadding="0" cellspacing="0" style="height: 13mm; width: 105mm;">
                <tr>
                    <td valign="top">
                        <div>Название организации</div>
                    </td>
                </tr>
                <tr>
                    <td valign="bottom" style="height: 3mm;">
                        <div style="font-size: 10pt;">Получатель</div>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>



<div style="font-weight: bold; font-size: 16pt; padding-left:5px;">
    <p>Счет № <?= $model->id ?> от <?= $model->date ?></p></div>

<div style="background-color:#000000; width:100%; font-size:1px; height:2px;">&nbsp;</div>

<table width="100%">
    <tr>
        <td style="width: 30mm;">
            <div style=" padding-left:2px;">Поставщик:    </div>
        </td>
        <td>
            <div style="font-weight:bold;  padding-left:2px;">
                <strong>ООО "ЛайфТурВояж"</strong></div>
        </td>
    </tr>
    <tr>
        <td style="width: 30mm;">
            <div style=" padding-left:2px;">Покупатель: </div>
        </td>
        <td>
            <div style="font-weight:bold;  padding-left:2px;"> <i><?= $model->name ?></i> </div>
        </td>
    </tr>
</table>








<table class="invoice_items" width="100%" cellpadding="2" cellspacing="2">
    <thead>
    <tr>
        <th style="width:13mm;">№</th>
        <th>Наименование</th>
        <th style="width:20mm;">Кол-во</th>
        <th style="width:17mm;">Ед.</th>
        <th style="width:27mm;">Цена</th>
        <th style="width:27mm;">Сумма</th>
    </tr>
    </thead>
    <tbody >
    <?php
    echo $this->render('_invoice_product', ['model' => $model]);
    ?>
    </tbody>
</table>
<?php
$gridColumn = [
    ['attribute' => 'id', 'visible' => false],
    [
        'attribute' => 'hotelsInfo.name',
        'label' => Yii::t('app', 'Hotels Info'),
    ],
    [
        'attribute' => 'hotelsAppartment.name',
        'label' => Yii::t('app', 'Hotels Appartment'),
    ],
    [
        'attribute' => 'hotelsTypeOfFood.name',
        'label' => Yii::t('app', 'Type Of Food'),
    ],
    [
        'attribute' => 'transInfo.name',
        'label' => Yii::t('app', 'Trans Info'),
    ],
    [
        'attribute' => 'tourInfo.name',
        'label' => Yii::t('app', 'Tour Info'),
    ],
    'full_price',
    ['attribute' => 'lock', 'visible' => false],
];
echo DetailView::widget([
    'model' => $model,
    'attributes' => $gridColumn
]);
?>



<table border="0" width="100%" cellpadding="1" cellspacing="1">
    <tr>
        <td></td>
        <td style="width:27mm; font-weight:bold;  text-align:right;">Итого:</td>
        <td style="width:27mm; font-weight:bold;  text-align:right;"> <?= $model->full_price ?> </td>
    </tr>
</table>

<br /><br />
<div style="background-color:#000000; width:100%; font-size:1px; height:2px;">&nbsp;</div>
<br/>

<div>Руководитель ______________________ (Фамилия И.О.)</div>
<br/>

<div>Главный бухгалтер ______________________ (Фамилия И.О.)</div>
<br/>

<div style="width: 85mm;text-align:center;">М.П.</div>
<br/>


<div style="width:800px;text-align:left;font-size:10pt;">Счет действителен к оплате в течении трех дней.</div>
