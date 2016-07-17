<?php

namespace backend\controllers;

use common\models\HotelsPayPeriod;
use Yii;
use common\models\HotelsPricing;
use common\models\HotelsTypeOfFood;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class PayperiodController extends Controller
{

    public function actionUpdate($priceId)
    {
        $pricing = $this->findPricing($priceId);
        $this->batchUpdate($pricing->payperiod);
        return $this->renderAjax('_payperiod', ['model' => $user]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Обновляет все цены
     * @param $items
     * @return nothing
     */
    protected function batchUpdate($items){
        if (Model::loadMultiple($items, Yii::$app->request->post()) &&
            Model::validateMultiple($items)) {
            foreach ($items as $key => $item) {
                $item->save();
            }
        }
    }

    /**
     * Finds the HotelsPricing model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HotelsPricing the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HotelsPayPeriod::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the HotelsAppartment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HotelsAppartment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findPricing($id)
    {
        if (($model = HotelsPricing::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
