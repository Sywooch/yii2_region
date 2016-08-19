<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 03.08.16
 * Time: 18:29
 */

namespace frontend\components\lk\controllers;

use common\models\HotelsPricing;
use common\models\Person;
use common\models\SalOrder;
use common\models\SalOrderHasPerson;
use frontend\components\lk\models\LkOrder;
use frontend\components\lk\models\Reservation;
use Yii;
use yii\web\Controller;


class ReservationController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new',
                            'ajax-person-index', 'ajax-person-create','mpdf-voucher'],
                        'roles' => ['Super Admin', 'Manager', 'Tagent'],
                    ],
                    [
                        'allow' => false
                    ],
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->redirect('reservation/choose-tour');
    }

    public function actionChooseTour()
    {
        //Проверяем, не получили ли мы от пользователя данные?
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $order = new LkOrder();
        //$order = $model->processChooseTour();

        /*$order->hotels_appartment_id = 1;
        $order->hotels_info_id = 24;*/
        /*TODO Произвести автоматический расчет суммы*/

        $order->sal_order_status_id = LkOrder::SAL_STATUS_DEFAULT;
        $beginDay = new \DateTime($order->date_begin . HotelsPricing::CHECKOUT_TIME);
        $endDay = new \DateTime($order->date_end . HotelsPricing::CHECKOUT_TIME);
        $countDay = $beginDay->diff($endDay)->days;

        //$order->full_price = 25000;
        //$dayCount = $order;
        //$order = new SalOrder();
        //Получаем данные из фроненда (выбрали отель или комнату)

        if ($order->isNewRecord && $order->load($request->post())) {

            //$dayCount = $beginDay->diff($endDay)->days;

            if (isset($request->post()['_toperson'])) {
                $order->full_price = $order->calculateAppartmentPrice($order->hotels_appartment_id, $beginDay->format('Y-m-d H:i'), $endDay->format('Y-m-d H:i'), $order->type_of_food_id);
                if (/*$order->validate()*/
                true
                ) {
                    if ($order->save()) {

                        $session->open();
                        $session->set('reservation_order_id', $order->id);
                        $session->set('reservation_appartment_id', $order->hotels_appartment_id);
                        $session->set('reservation_type_of_food_id', $order->type_of_food_id);
                        $session->set('reservation_date_begin', $beginDay);
                        $session->set('reservation_date_end', $endDay);
                        $session->close();

                        return $this->redirect(['reservation/choose-person']);

                        /*return $this->render('choosePerson', [
                            'model' => $person,
                            'personHasOrder' => $person_has_order,
                        ]);*/
                    }
                }

            }
        } elseif ($order->isNewRecord && $request->get('hotels_info_id')) {
            /*TODO !!!Проверить будет ли выбран только отель, или уже с комнатой*/
            //TODO !!!Предусмотреть возможность выбора типа номера во фронтенде
            $order->hotels_info_id = $request->get('hotels_info_id');
            if (isset($order->hotels_appartment_id)) {
                //Заполняем (перезаполняем) делаем запрос к БД для
                //Информация об отеле
                $order->hotels_info_id = $order->getHotelsInfoByAppartmentId($order->hotels_appartment_id);

                $order->full_price = $order->calculateAppartmentPrice($order->hotels_appartment_id, $beginDay->format('Y-m-d H:i'), $endDay->format('Y-m-d H:i'), $order->type_of_food_id);

            }
            //Информация о туре
            if (isset($order->hotels_info_id)) {
                $order->country_id = $order->getCountryByHotels($order->hotels_info_id);
                $order->tour_info_id = $order->getTourInfoByHotelsId($order->hotels_info_id);
                $order->userinfo_id = Yii::$app->user->id;
            }
        }
        return $this->render('chooseTour', ['model' => $order]);
    }

    public function actionChoosePerson()
    {
        //Добавить ajax-форму для полной работоспособности персон (с доступным выбором из уже имеющихся туристов)
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $model = new SalOrderHasPerson();
        $person = new Person();
        $model->sal_order_id = $session->get('reservation_order_id');

        //TODO Если существуют уже добавленные туристы, а в поля ничего не было добавлено, то считать что пользователь больше не будет никого вводить
        $person->load($request->post());
        if (isset($request->post()['_toreserv'])) {
            if ($person->save()) {
                //Сохраняем информацию о заказе для клиента
                $model->person_id = $person->id;
                //Перерасчет стоимости, исходя из количества туристов. Применение скидки для детей.
                $allPersons = LkOrder::getAllPersons($model->sal_order_id);

                if ($model->save()) {
                    return $this->redirect(['reservation/choose-reserv']);
                } else {
                    return $this->render('choosePerson', ['model' => $person]);
                }
            }
        } elseif (isset($request->post()['_personadd'])) {
            if ($person->save()) {
                //Сохраняем информацию о заказе для клиента
                $model->person_id = $person->id;
                $model->save();
                $personNew = new Person();
                //TODO Выбрать всех клиентов данного заказа из SalOrderHasPerson
                $allPersons = LkOrder::getAllPersons($model->sal_order_id)->all();
                return $this->render('choosePerson', ['model' => $personNew, 'oldPerson' => $allPersons]);
            }
        } else {
            return $this->render('choosePerson', ['model' => $person]);
        }
    }

    public function actionChooseReserv()
    {
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $orderId = $session->get('reservation_order_id');
        $appartmentId = $session->get('reservation_appartment_id');
        $typeOfFoodId = $session->get('reservation_type_of_food_id');
        //Считаем количество туристов
        $persons = LkOrder::getAllPersons($orderId);
        $count = $persons->count();
        $countChild = LkOrder::getChildPersons($orderId)->count();

        $order = LkOrder::findOne(['id' => $orderId]);
        $beginDay = new \DateTime($order->date_begin . HotelsPricing::CHECKOUT_TIME);
        $endDay = new \DateTime($order->date_end . HotelsPricing::CHECKOUT_TIME);

        //Пересчитываем сумму за проживание
        $fullPrice = HotelsPricing::calculatedAppartmentPrice($appartmentId, $beginDay->format("Y-m-d H:i"), $endDay->format("Y-m-d H:i"), $typeOfFoodId, $count, $countChild);

        $model = SalOrder::findOne(['id' => $orderId]);
        $model->full_price = $fullPrice;
        $providerSalOrderHasPerson = new \yii\data\ArrayDataProvider([
            'allModels' => $model->salOrderHasPeople,
        ]);
        /*$session->remove('reservation_order_id');
        $session->remove('reservation_appartment_id');
        $session->remove('reservation_type_of_food_id');
        $session->close;*/
        //Получаем все данные о брони
        return $this->render('chooseReserv', ['model' => $model, 'providerSalOrderHasPerson' => $providerSalOrderHasPerson]);
    }

    public function actionGethotelsinfo()
    {
        $model = new Reservation();
        if ($model->load(Yii::$app->request->post())) {
            $model->getHotelsByCountry($model->country);
        } else {
            $model = '';
        }
        return $this->renderPartial('hotels', ['model' => $model]);
    }

    public function actionGetappartment()
    {
        $model = new Reservation();
        if ($model->load(Yii::$app->request->post())) {
            $model->getAppertmentsByHotel($model->hotels_info_id);
        } else {
            $model = '';
        }
        return $this->renderPartial('appartment', ['model' => $model]);
    }
}