<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
    * @var frontend\models\SearchHotelsInfo $searchModel
*/

$this->title = $searchModel->getAliasModel(true);
?>

<div class="filter">

    <div class="col-md-4">
    <?php echo $this->render('_search', ['model' =>$searchModel]);
        ?>
    </div>
</div>




