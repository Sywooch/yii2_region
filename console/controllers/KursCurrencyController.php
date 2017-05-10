<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 02.04.17
 * Time: 2:03
 */

namespace console\controllers;

use common\models\KursCurrency;
use yii\console\Controller as ConsoleController;

class KursCurrencyController extends ConsoleController
{
    public function actionUpdateKurs(){
        $n = new KursCurrency();
        echo $n->CurrencyUpdated();
        //return $this->redirect(['index']);
    }
}