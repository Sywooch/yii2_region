<?php


namespace frontend\models;

use Yii;


class News extends \cinghie\articles\models\Items
{

    /**
     * fetch stored file name with complete path
     * @return string
     */
    public function getFilePath()
    {
        return isset($this->image) ? Yii::getAlias(Yii::$app->controller->module->itemImagePath) . $this->image : null;
    }

    /**
     * fetch stored file url
     * @return string
     */
    public function getImageUrl()
    {
        // return a default image placeholder if your source avatar is not found
        $file = isset($this->image) ? $this->image : 'default.jpg';
        return Yii::getAlias(Yii::$app->controller->module->itemImageURL) . $file;
    }

    /**
     * fetch stored image url
     * @return string
     */
    public function getImageThumbUrl($size)
    {
        // return a default image placeholder if your source avatar is not found
        $file = isset($this->image) ? $this->image : 'default.jpg';
        return Yii::getAlias(Yii::$app->controller->module->itemImageURL) . "thumb/" . $size . "/" . $file;
    }


}