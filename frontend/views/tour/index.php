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
    <div class="col-md-3 col-xs-12 panel panel-primary">
        <div class="filters-hotels">
            <?php
            echo $this->render('_search_page_hotels', ['model' => $searchModel]);
            ?>
        </div>
    </div>
    <?php
}
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
    ]) ?>
</div>

