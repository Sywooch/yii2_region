<?php

namespace frontend\components\lk;

//use dmstr\web\traits\AccessBehaviorTrait;

class Module extends \yii\base\Module
{
    //public $layout = 'main';
    /*
     * TODO Добавить уровни доступа к данным
     * TODO Добавить форму авторизации для турагенств
     */
    //use AccessBehaviorTrait;

    public $controllerNamespace = 'frontend\components\lk\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
