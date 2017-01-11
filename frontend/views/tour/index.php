<?php
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Гостиницы');
?>


<?php
if ((Yii::$app->getRequest()->getPathInfo() == 'hotels') or
    (Yii::$app->getRequest()->getPathInfo() == 'hotels/index') or
    (Yii::$app->getRequest()->getPathInfo() == 'hotels/')
) {
    ?>
<div class="col-md-3 col-xs-12 panel panel-default">
        <div class="filters-hotels">
            <?php
            echo $this->render('_search_page_hotels', ['model' => $searchModel]);
            ?>
        </div>
    </div>
<div class="result-hotels">
    <?php
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => require(__DIR__ . '/_tourColumns.php'),
        'condensed' => true,
        'bordered' => false,
        //'showHeader' => false,
    ]);
}
    else {
    ?>
    <div class="hotels">
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_hotel',
            'pager' => [
                'options' => [
                    'class' => 'pagination',
                ],
            ],
            'summary' => '',
        ]); ?>

        <?php
        }
        ?>
    </div>
