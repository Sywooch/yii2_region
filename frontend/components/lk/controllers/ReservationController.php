<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 03.08.16
 * Time: 18:29
 */

namespace frontend\components\lk\controllers;

use common\models\Person;
use common\models\SalOrder;
use frontend\models\bus\SalOrderHasPerson;
use frontend\models\SearchPerson;
use frontend\models\SearchSalOrder;
use Yii;
use yii\web\Controller;
use frontend\components\lk\models\Reservation;


class ReservationController extends Controller
{
    public function actionIndex()
    {
        $this->actionChooseTour();
    }

    public function actionChooseTour()
    {
        //Проверяем, не получили ли мы от пользователя данные?
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $model = new Reservation();
        $order = $model->processChooseTour();

        $order->hotels_appartment_id = 1;
        $order->hotels_info_id = 24;
        /*TODO Произвести автоматический расчет суммы*/
        $order->full_price = 25000;
        //$order = new SalOrder();

        $order->load($request->post());

        if (isset($request->post()->bron) && $order->load($request->post())) {
            if ($order->save()) {
                $person = new Person();
                $person_has_order = new SalOrderHasPerson();
                $session->open();
                $session->set('order_id', $order->id);
                $session->close();
                return $this->render('choosePerson', [
                    'model' => $person,
                    'person_has_order' => $person_has_order,
                ]);
            }
        } else {
            return $this->render('chooseTour', ['model' => $order]);
        }

    }

    public function actionChoosePerson()
    {
        //Добавить ajax-форму для полной работоспособности персон (с доступным выбором из уже имеющихся туристов)
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $model = new SalOrderHasPerson();


        $model->load($request->post());
        if ($request->post()->bron && $model->load($request->post())) {
            if ($model->save()) {

                //выбрать всех туристов, которых добавили в таблицу Person $person = new SearchPerson();
                $order = new SearchSalOrder(['id' => $session->get('order_id')]);
                return $this->render('chooseReserv', [
                    'model' => $model,
                    'person_has_order' => $model,
                    'order' => $order,
                ]);
            }
        } else {
            return $this->render('choosePerson', ['model' => $model]);
        }
    }

    public function actionChooseReserv()
    {
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $model = new SearchSalOrder(['id' => $session->get('order_id')]);

        //Получаем все данные о брони

    }
}