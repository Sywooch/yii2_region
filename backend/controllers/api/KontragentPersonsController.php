<?php

namespace \api;

/**
* This is the class for REST controller "KontragentPersonsController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class KontragentPersonsController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\KontragentPersons';
}
