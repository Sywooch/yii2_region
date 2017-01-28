<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 22.01.17
 * Time: 18:56
 */

namespace frontend\models;

use common\models\BusReservation;
use common\models\BusWay;
use common\models\HotelsInfo;
use common\models\TourInfo;

class Tour
{
    public $main = false; //выходные данные со структурой $main[id_tour]
    public $tour = false; //хранится \common\models\TourInfo
    public $hotel = false; // \common\models\HotelsInfo
    public $appartment = false; // \common\models\HotelsAppartment
    public $appartmentPrice = false; // \common\models\HotelsPayPeriod
    public $typeOfFood = false; // \common\models\HotelsTypeOfFood
    public $typeTransport = false; // \common\models\TourTypeTransport
    public $transport = false; // \common\models\TransPrice || \common\models\BusWay
    public $tourFormat = false; // Формат тура: полный пакет, проживание+питание, только переезд


    private function getActiveTour($dateBegin = null, $dateEnd  = null){
        $bDate = $this->procDate($dateBegin);
        $eDate = $this->procDate($dateEnd);

        //Получаем активные туры, т.е. туры, у признак активность = 1, а переданные даты входят в этот тур
        //$model = new TourInfo;
        $model = TourInfo::find();
        $model->active()
            ->andWhere("((`tour_info`.`date_begin` <= \"$bDate\") AND (`tour_info`.`date_end` >= \"$bDate\") )
    OR ((`tour_info`.`date_begin` <= \"$eDate\")AND(`tour_info`.`date_end` >= \"$eDate\"))")
        ;

        return $model;
    }

    private function getTourHotels(){

    }

    /**
     * Эта основная функция. Данная функция находит и фильтрует по переданным параметрам туры и их цены.
     * @param null $dateBegin
     * @param null $dateEnd
     * @return $this - возвращается текущий объект, в котором определены все туры и их свойства
     */
    public function findFilterTour($dateBegin = null, $dateEnd = null){
        $dBegin = new \DateTime($this->procDate($dateBegin));
        $dEnd = new \DateTime($this->procDate($dateEnd));
        $count = $dBegin->diff($dEnd)->days;
        for ($i = 0; $i < $count; $i++){
            $tours = $this->getActiveTour($dateBegin, $dateEnd);
            $date = $dBegin->add(new \DateTime('P1D'));
            foreach ($tours->each() as $id => $tour){
                $this->main[$id]['date'] = $date->format('Y-m-d');
                $this->main[$id]['tour'] = $tour;
                $this->main[$id]['hotels'] = $tour->hotelsInfo;
                $this->main[$id]['appartments'] = $this->getAppartments($id);
                //получаем типы питания
                $this->main[$id]['typeOfFood'] = $this->getTypeOfFood($id);
                //Получаем цены на отели
                $this->main[$id]['hotelsPricings']= $this->getAppartmentPricings($id);

                $this->main[$id]['typeTransport'] = $tour->tourTypeTransport;
                $this->main[$id]['typeTransportReverse'] = $tour->tourTypeTransport;
                $this->main[$id]['transport'] = $this->getTransWay();
                $this->main[$id]['transportReverse'] = $tour->getTransWayReverse($dEnd);
                $this->main[$id]['full_price'] = $this->getFullPrice($id);
            }
        }

        /*
        $this->hotel = $this->tour[0]->hotelsInfo; //цикл
        $this->appartment = $this->hotel->hotelsAppartments;
        $pricing = $this->appartment[0]->hotelsPricings; //цикл
        $this->typeOfFood = $this->appartment[0]->hotelsAppartmentHasHotelsTypeOfFoods; //цикл
        $this->typeTransport = $this->tour[0]->tourTypeTransports; //цикл
        $this->transport = $this->getTransWay();
*/
        return $this;
    }

    /**
     * Получаем все гостиницы (не приложенные к туру) согласно фильтру
     */
    public function findFilterHotels($date){
        $model = HotelsInfo::find()->listAll();
        //Получаем все цены на текущую дату
    }


    /**
     * @inheritdoc Получаем активные Маршруты на текущую дату. Функция готова!
     *
     * @param null $date - дата проверки, если не указана - текущая дата
     * @return array - массив обеъектов BusWay, удовлетворяющих условию
     */
    public function findFilterBusDate($date = null){
        //Получаем все маршруты, для которых созданы путевые листы (готовые ехать)
        if ($date === null){
            $date = $this->procDate();
        }
        $model = BusWay::find()->active();
        $model->andWhere(['DATE_FORMAT(`date_begin`,\'%Y-%m-%d\')'=>$date]);
        //Получаем и исключаем все полностью забронированные автобусы
        $reserv = array();
        $maxSeats = 0;
        $reservSeats = 0;
        foreach ($model->all() as $key => $way){
            //Получаем общее число мест в автобусе
            $t = new BusReservation();
            $reservSeats = $t->getCountFreeSeats($way->id);
            if ($reservSeats > 0){ // Места есть, можно выводить
                $reserv[] = $way;
            }
        }
        return $reserv;
    }

    /**
     * Получаем весь активный транспорт (поезда, самолеты)
     */
    public function findFilterTransport(){

    }

    /**
     * @param $tourId
     * @return array
     */
    private function getAppartmentPricings($tourId){
        $val = array();
        foreach ($this->main[$tourId]['appartments'] as $key => $value){
            $val[] = $value->hotelsPricings;
        }
        return $val;
    }

    private function getAppartments($tourId){
        //Получаем свободные номера
        $date = $this->main[$tourId]['date'];
        $res = array();
        $i = 0;
        $appartments = $this->main[$tourId]['hotels']->getHotelsAppartments();
        foreach ($appartments->each() as $key=>$value){
            if ($value->countFreeRoom($date,$date) > 0){
                /*$res[$i]['id'] = $value->id;
                $res[$i]['name'] = $value->name;*/
                $res[$i] = $value;
                $i++;
            }
        }
        return $res;
    }

    private function getTypeOfFood($tourId){
        $res=array();
        $appartments = $this->main[$tourId]['appartments'];
        $i = 0;
        foreach ($appartments->each() as $key => $value){
            $res[] = $value->hotelsAppartmentHasHotelsTypeOfFoods;
        }
        return $res;
    }

    private function getFullPrice($tourId){

    }

    public function procDate($date = null,$format = 'Y-m-d'){

        if ($date === null){
            $res = date($format);
        }
        else{
            $bDate = new \DateTime($date);
            $res = $bDate->format($format);
        }
        //Если все таки передали какие-нибудь фигню, то просто возвращаем текущую дату
        if($res == false){
            $res = date('Y-m-d');
        }

        return $res;
    }


    /**
     * Функция расчитывает и возвращает начало и окончание периода дней, а также количество дней.
     * Если переданы параметры:
     * - начальную дату и конечная дата, количество дней игнорируется и расчитывается исходя из переданных данных
     * - начальная дату и период, расчитывается дата окончания периода
     * @param null $dateBegin
     * @param null $dateEnd
     * @param int $period
     * @param string $format
     * @return array Возвращается массив из трех значений:
 *                      - дата начала периода
     *                  - дата окончания периода
     *                  - количество дней в периоде
     */
    public function datePeriodDays($dateBegin = null, $period = 1, $dateEnd = null, $format = 'Y-m-d'){
        if ($dateBegin === null){
            $beginDate = new \DateTime();
        }
        else{
            $beginDate = new \DateTime($dateBegin);
        }

        if ($dateEnd === null){
            if (!(isset($period)) && !($period>0)){
                $period = 1;
            }
            $endDate = clone $beginDate;
            $endDate = $endDate->add(new \DateInterval('P'.$period.'D'));
        }
        else{
            $endDate = new \DateTime($dateEnd);
            $period = $beginDate->diff($endDate)->days;
        }
        return [
            'begin' => $beginDate->format($format),
            'end' => $endDate->format($format),
            'period' => $period];
    }

    private function getTransWay(){
        //Если у нас не найдены туры, то нечего будет искать
        if (!$this->tour){
            return false;
        }
        if (!$this->typeTransport){
            return false;
        }

        $typeTrans = $this->typeTransport->id;
        if ($typeTrans == 1){
            //Получаем путевые листы или активные маршруты для автобусов

        }
        elseif($typeTrans == 2 || $typeTrans == 3){
            //Получаем путевые листы или активные маршруты для поездов и/или для самолетов
        }
        return false;
    }
}