<?php

namespace api;

/**
* This is the class for REST controller "BusReservationController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class BusReservationController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\BusReservation';
}
