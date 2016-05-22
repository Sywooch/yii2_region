<?php

namespace backend\controllers\api;


/**
* This is the class for REST controller "HotelsInfoController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class HotelsInfoController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\HotelsInfo';
}
