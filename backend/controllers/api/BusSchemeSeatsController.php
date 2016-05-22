<?php

namespace backend\controllers\api;


/**
* This is the class for REST controller "BusSchemeSeatsController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class BusSchemeSeatsController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\BusSchemeSeats';
}
