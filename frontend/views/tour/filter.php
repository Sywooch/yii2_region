<?php

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var frontend\models\SearchHotelsInfo $searchModel
 */

/*$this->title = $searchModel->getAliasModel(true);*/
?>

<div class="filters ">
    <?php
    echo $this->render('_search', ['model' => $searchModel]);
    ?>
</div>




