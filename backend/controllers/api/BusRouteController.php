<?php

namespace backend\controllers\api;

/**
* This is the class for REST controller "BusRouteController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class BusRouteController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\BusRoute';
}
