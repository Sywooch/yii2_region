<?php

namespace backend\controllers\api;


/**
* This is the class for REST controller "BusRouteHasBusRoutePointController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class BusRouteHasBusRoutePointController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\BusRouteHasBusRoutePoint';
}
