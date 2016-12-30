<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 03.08.16
 * Time: 18:29
 */

namespace frontend\components\lk\controllers;

use common\models\BusReservation;
use common\models\BusWay;
use common\models\City;
use common\models\HotelsAppartment;
use common\models\HotelsInfo;
use common\models\HotelsPricing;
use common\models\Person;
use common\models\SalOrder;
use common\models\SalOrderHasPerson;
use common\models\TourInfo;
use common\models\TransPrice;
use frontend\components\lk\models\LkOrder;
use frontend\components\lk\models\Reservation;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\Json;
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
                            'success-tour', '',
                            'ajax-person-index', 'ajax-person-create', 'mpdf-voucher', 'choose-tour', 'choose-person',
                            'choose-reserv', 'gethotelsinfo', 'getappartment',
                            //DepDrop(ajax)-запросы данных
                            'child-city', 'child-hotels', 'child-appartment',
                            'child-hotels-info', //Информация о выбранной гостинице
                            'child-appartment-info', //Информация о выбранном номере
                            'child-transport',
                            'get-transport', // по ссылке начинаем искать маршруты, по которым туристы могут добраться до места
                            'get-transport-reverse',
                            'get-trans-info', // получаем информацию о выбранном транспорте: цена и количество свободных мест
                        ],
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


        //$order->full_price = 25000;
        //$dayCount = $order;
        //$order = new SalOrder();
        //Получаем данные из фроненда (выбрали отель или комнату)

        if ($order->isNewRecord && $order->load($request->post())) {

            //$dayCount = $beginDay->diff($endDay)->days;

            $beginDay = new \DateTime($order->date_begin . HotelsPricing::CHECKOUT_TIME);
            $endDay = new \DateTime($order->date_end . HotelsPricing::CHECKOUT_TIME);
            $countDay = $beginDay->diff($endDay)->days;
            $order->date_begin = $beginDay->format('Y-m-d H:i');
            $order->date_end = $endDay->format('Y-m-d H:i');
            if (isset($request->post()['_toperson'])) {
                $order->full_price = $order->calculateAppartmentPrice($order->hotels_appartment_id,
                    $beginDay->format('Y-m-d H:i'),
                    $endDay->format('Y-m-d H:i'),
                    $order->type_of_food_id);
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
                        $session->set('reservation_type_transport', $order->trans_info_id); //Указываем тип транспорта
                        $session->set('reservation_transport_way', $order->trans_route); //Указываем конекретный транспорт и маршрут
                        $session->set('reservation_type_transport_reverse', $order->trans_info_id_reverse); //Указываем тип транспорта
                        $session->set('reservation_transport_way_reverse', $order->trans_route_reverse); //Указываем конекретный транспорт и маршрут
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
            $beginDay = new \DateTime($order->date_begin . HotelsPricing::CHECKOUT_TIME);
            $endDay = new \DateTime($order->date_end . HotelsPricing::CHECKOUT_TIME);
            $countDay = $beginDay->diff($endDay)->days;
            /*TODO !!!Проверить будет ли выбран только отель, или уже с комнатой*/
            //TODO !!!Предусмотреть возможность выбора типа номера во фронтенде
            $order->hotels_info_id = $request->get('hotels_info_id');
            if (isset($order->hotels_appartment_id)) {
                //Заполняем (перезаполняем) делаем запрос к БД для
                //Информация об отеле
                $order->hotels_info_id = $order->getHotelsInfoByAppartmentId($order->hotels_appartment_id);

                $order->full_price = $order->calculateAppartmentPrice($order->hotels_appartment_id,
                    $beginDay->format('Y-m-d H:i'),
                    $endDay->format('Y-m-d H:i'),
                    $order->type_of_food_id);

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
        //TODO Добавить ajax-форму для полной работоспособности персон (с доступным выбором из уже имеющихся туристов)
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        if (!is_int($session->get('reservation_order_id'))) {
            return $this->redirect(['reservation/choose-tour']);
        }
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
        //В одном заказе два раза будет вызываться метод:
        //1. Для отображения всей информации для подтверждения бронирования заказа
        //2. Непосредственное бронирование и проведение заказа по всем таблицам в БД
        //2.1 В случае отказа от бронирования, из базы данных удаляется только сформированный заказ
        //(так как персон все равно там нет, а другие таблицы не заполнялись

        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $orderId = $session->get('reservation_order_id');

        $appartmentId = $session->get('reservation_appartment_id');
        $typeOfFoodId = $session->get('reservation_type_of_food_id');
        //Считаем количество туристов
        $persons = LkOrder::getAllPersons($orderId);
        $count = $persons->count();

        $countChild = LkOrder::getChildPersons($orderId)->count();
        /**
         * TODO Переделать формирование заказов через темповую таблицу, для устранения мусора
         */
        //Подтверждаем заказ
        if (isset($request->get()['_reservation'])) {
            //Делаем резерв в выбранном транспорте
            $typeTransport = $session->get('reservation_type_transport');
            $transWay = $session->get('reservation_transport_way');
            $typeTransportReverse = $session->get('reservation_type_transport_reverse');
            $transWayReverse = $session->get('reservation_transport_way_reverse');
            if (1 == $typeTransport) {//Сохраняем резерв для автобуса
                LkOrder::reservationBusWay($transWay, $persons->asArray()->all());
            } elseif ($typeTransport > 1 && $typeTransport < 4) {
                LkOrder::reservationTransportWay($transWay, $persons->asArray()->all());
            }

            if (1 == $typeTransportReverse) {
                LkOrder::reservationBusWay($transWayReverse, $persons->asArray()->all());
            } elseif ($typeTransportReverse > 1 && $typeTransportReverse < 4) {
                LkOrder::reservationTransportWay($transWayReverse, $persons->asArray()->all());
            }

            //Пересохраняем заказ

            //Восстанавливаем (если необходимо) связи с туристами

            return $this->redirect('/lk');
        } //Удаляем заказ
        elseif (isset($request->get()['_not_reservation'])) {
            \frontend\models\bus\SalOrder::findOne($orderId)->deleteWithRelated();
            return $this->redirect('/lk');
        }

        $order = LkOrder::findOne(['id' => $orderId]);
        $beginDay = new \DateTime($order->date_begin);
        $endDay = new \DateTime($order->date_end);

        //Пересчитываем сумму за проживание
        $fullPrice = HotelsPricing::calculatedAppartmentPrice($appartmentId,
            $beginDay->format("Y-m-d H:i"),
            $endDay->format("Y-m-d H:i"),
            $typeOfFoodId, $count, $countChild);

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
        return $this->render('chooseReserv',
            ['model' => $model, 'providerSalOrderHasPerson' => $providerSalOrderHasPerson]);
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

    public function actionChildCity()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = City::find()->active()->andWhere(['country_id' => $id])->asArray()->all();
            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $hotels) {
                    $out[] = ['id' => $hotels['id'], 'name' => $hotels['name']];
                    if ($i == 0) {
                        $selected = $hotels['id'];
                    }
                }
                // Shows how you can preselect a value
                echo Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionChildHotels()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];

            $city_id = empty($ids[0]) ? null : $ids[0];
            $stars_id = empty($ids[1]) ? null : $ids[1];

            if ($city_id != null && $stars_id != null) {
                //$model = TourInfo::find();
                //$query = $model
                $query = HotelsInfo::find();
                $query->select('hotels_info.*')
                    ->innerJoin('tour_info ti', 'ti.hotels_info_id = hotels_info.id');
                $query->andWhere(['hotels_info.city_id' => $city_id, 'hotels_info.active' => 1, 'ti.active' => 1]);
                if ($stars_id != 1) {
                    $query->andWhere(['hotels_stars_id' => $stars_id]);
                }
                $list = $query->asArray()->all();
                $selected = null;
                if (count($list) > 0) {
                    $selected = '';
                    foreach ($list as $i => $hotels) {
                        $out[] = ['id' => $hotels['id'], 'name' => $hotels['name']];
                        if ($i === 0) {
                            $selected = $hotels['id'];
                        }
                    }
                    // Shows how you can preselect a value
                    echo Json::encode(['output' => $out, 'selected' => $selected]);
                    return;
                }
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionChildAppartment()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];

            $hotel_id = empty($ids[0]) ? null : $ids[0];
            $food_id = empty($ids[1]) ? null : $ids[1];

            if ($hotel_id != null) {
                $query = HotelsAppartment::find();
                $query->active()->andWhere(['hotels_appartment.hotels_info_id' => $hotel_id]);
                if ($food_id != null) {
                    $query->select('hotels_appartment.*');
                    $query->innerJoin('hotels_appartment_has_hotels_type_of_food as hfood',
                        'hfood.id = hotels_appartment.id');
                    $query->andWhere(['hfood.hotels_type_of_food_id' => $food_id]);
                }
                $list = $query->asArray()->all();
                $selected = null;
                if (count($list) > 0) {
                    $selected = '';
                    foreach ($list as $i => $elem) {
                        $out[] = ['id' => $elem['id'], 'name' => $elem['name']];
                        if ($i == 0) {
                            $selected = $elem['id'];
                        }
                    }
                    // Shows how you can preselect a value
                    echo Json::encode(['output' => $out, 'selected' => $selected]);
                    return;
                }
            }

        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    /**
     * Получаем информацию о выбранной гостинице, а именно:
     * Общее количество номеров (каждого типа)
     * Количество свободных номеров (каждого типа)
     * @return null
     *
     */
    public function actionChildHotelsInfo()
    {
        $out = [];
        if (isset($_POST['hotels']) && $_POST['hotels'] !== 'null') {
            $hotelsId = $_POST['hotels'];
            //$query = HotelsInfo::findOne($hotelsId);
            $model = HotelsAppartment::find();
            $allCount = $model->allCountRooms($hotelsId);
            if ($allCount == null) {
                $allCount = 0;
            }
            //Получить свободные номера на данную дату
            //$freeCount =
            $typeCountRooms = new ActiveDataProvider([
                'query' => $model->typeCountRooms($hotelsId),
                'pagination' => [
                    'pageSize' => 100,
                ],
            ]);

            $tourId = TourInfo::findOne(['active' => 1, 'hotels_info_id' => $hotelsId])/*->active()
                ->andWhere('hotels_info_id',$hotelsId)->one()*/
            ->id;
            //$freeCountAppartment =
            echo $this->renderAjax('_hotelsDetails', [
                'allCount' => $allCount,
                'typeRooms' => $typeCountRooms,
                'tour_info_id' => $tourId,
            ]);
        }
        return null;
    }

    /**
     * TODO Выборка транспорта, продумать логику получения того или иного транспортного средства.
     */

    /**
     * Функция выводит формирует и выводит JSON для личного кабинета турагенства.
     * Для расчета типа и цены транспорта, необходимо передать следующие параметры:
     * - дату заезда - для того, чтобы отфильтровать прошедшие и будущие маршруты;
     * - время в пути (опционально, возможно, не пригодится) - чтобы выбрать только те маршруты, которые
     * максимально близко привезут туриста ко времени заезда;
     * - маршрут следования - чтобы выбрать только маршруты, которые довезут туриста до места;
     *
     */
    public function actionChildTransport()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            unset($query);
            //Фильтруем тип транспорта
            $list = \common\models\TourTypeTransport::find()->asArray()->all();
            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $elem) {
                    $out[] = ['id' => $elem['id'], 'name' => $elem['name']];
                    if ($i == 0) {
                        $selected = $elem['id'];
                    }
                }

                echo Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetTransport()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];

            $trans_id = empty($ids[0]) ? null : $ids[0];
            $appartment_id = empty($ids[1]) ? null : $ids[1];
            $hotel_id = empty($ids[2]) ? null : $ids[2];
            $cityTo = empty($ids[3]) ? null : $ids[3];
            $dateOut = empty($ids[4]) ? null : $ids[4];
            $cityOut = empty($ids[5]) ? null : $ids[5];

            unset($query);
            //Выбираем тип транспорта
            //Если это автобус, выбираем из автобуса
            if ($cityOut == $cityTo) {
                echo Json::encode(['output' => [
                    ['id' => '0', 'name' => 'Города отправления и прибытия совпадают']], 'selected' => '0']);
                return;
            }
            if (($trans_id == 1) && isset($cityOut, $cityTo, $dateOut)) {
                //получить город-откуда
                //получить город-куда
                //получить дату отъезда

                $list = BusWay::find()->getBusWay($cityOut, $cityTo, $dateOut)
                    ->asArray()->all();

            } //Если это поезд, то выбираем из транспорта, но с id поезда
            elseif (($trans_id == 2) && isset($cityOut, $cityTo, $dateOut)) {
                $list = TransPrice::find()->getTransWay($cityOut, $cityTo, $dateOut, 1)
                    ->asArray()->all();

            } //Если это самолет, то выбираем из транспорта, но с id-самолетов
            elseif (($trans_id == 3) && isset($cityOut, $cityTo, $dateOut)) {
                $list = TransPrice::find()->active()->getTransWay($cityOut, $cityTo, $dateOut, 2)
                    ->asArray()->all();
            }
            //Если не нужно предоставлять транспорт, то ничего не выбираем и ставим transport_id = 0
            /*elseif($trans_id == 4){

            }*/

            $selected = '';
            if (count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $elem) {
                    $out[] = ['id' => $elem['id'], 'name' => $elem['name']];
                    if ($i == 0) {
                        $selected = $elem['id'];
                    }
                }

                echo Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }

        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetTransportReverse()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];

            $trans_id = empty($ids[0]) ? null : $ids[0];
            $appartment_id = empty($ids[1]) ? null : $ids[1];
            $hotel_id = empty($ids[2]) ? null : $ids[2];
            $cityTo = empty($ids[3]) ? null : $ids[3];
            $dateTo = empty($ids[4]) ? null : $ids[4];
            $cityOut = empty($ids[5]) ? null : $ids[5];

            unset($query);
            //Выбираем тип транспорта
            //Если это автобус, выбираем из автобуса
            if (($trans_id == 1) && isset($cityOut, $cityTo, $dateTo)) {
                //получить город-откуда
                //получить город-куда
                //получить дату отъезда

                $list = BusWay::find()->getBusWayReverse($cityOut, $cityTo, $dateTo)
                    ->asArray()->all();

            } //Если это поезд, то выбираем из транспорта, но с id поезда
            elseif (($trans_id == 2) && isset($cityOut, $cityTo, $dateTo)) {
                $list = TransPrice::find()->getTransWay($cityOut, $cityTo, $dateTo, 1)
                    ->asArray()->all();

            } //Если это самолет, то выбираем из транспорта, но с id-самолетов
            elseif (($trans_id == 3) && isset($cityOut, $cityTo, $dateTo)) {
                $list = TransPrice::find()->active()->getTransWay($cityOut, $cityTo, $dateTo, 2)
                    ->asArray()->all();
            }
            //Если не нужно предоставлять транспорт, то ничего не выбираем и ставим transport_id = 0
            /*elseif($trans_id == 4){

            }*/

            $selected = '';
            if (count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $elem) {
                    $out[] = ['id' => $elem['id'], 'name' => $elem['name']];
                    if ($i == 0) {
                        $selected = $elem['id'];
                    }
                }

                echo Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }

        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    /**
     * получаем цену и количество свободных мест
     * @return null
     */
    public function actionGetTransInfo()
    {


        if (isset($_POST['trans']) && $_POST['trans'] !== 'null') {
            $id = $_POST['trans'];
            $model = new BusWay();
            $query = $model->find()->active()
                ->andWhere(['id' => $id]);
            $seats = BusReservation::getFreeSeats($id);


            //->asArray()->all();

            //$freeCountAppartment =
            echo $this->renderAjax('_transport', [
                'transPrice' => $query->all(),
                'transSeats' => $seats,
            ]);
        }
        return null;
    }

}