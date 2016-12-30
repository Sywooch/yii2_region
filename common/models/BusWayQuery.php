<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BusWay]].
 *
 * @see BusWay
 */
class BusWayQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return BusWay[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BusWay|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    //Получаем все активные маршруты, которые идут из одного пункта в другой в конкретную дату
    //$timeLimit - переменная содержит время, которое нужно

    //Выбираются только те маршруты, по которым идет в день начала тура транспорт
    /**
     * @param $cityOut
     * @param $cityTo
     * @param $dateOut - Дата выезда из пункта отправления
     * @return $this
     */
    public function getBusWay($cityOut, $cityTo, $dateOut/*, $timeLimit*/)
    {
        $query = $this;
        $query->select('bus_way.*');
        $query->distinct(true);
        $query->innerJoin('bus_route as br', 'bus_way.bus_route_id = br.id')
            ->innerJoin('bus_route_has_bus_route_point as hasbr', 'br.id=hasbr.bus_route_id')
            ->innerJoin('bus_route_point as brp', 'hasbr.bus_route_point_id=brp.id');

        $timestamp = strtotime($dateOut);
        $dayBegin = date('Y-m-d', $timestamp) . ' 00:00:00';
        $dayEnd = date('Y-m-d', $timestamp) . ' 23:59:59';
        //Выбираем дату заезда
        $query->andFilterWhere(['>=', 'bus_way.date_begin', $dayBegin]);
        $query->andFilterWhere(['<=', 'bus_way.date_begin', $dayEnd]);
        $query->andWhere('bus_way.active = 1');
        $query->andWhere('bus_way.ended = 0');
        //Выбираем необходимый город
        $query->andWhere("
        (
            hasbr.first_point = 1
            AND brp.city_id = $cityOut
        )
        or (
            hasbr.first_point = 0
            AND brp.city_id = $cityTo
        )
        ");

        $query->groupBy('bus_way.id');
        $query->having('count(bus_way.id) = 2');

        return $query;
    }

    //Получаем все активные маршруты, которые возвращаются обратно
    /**
     * @param $cityOut
     * @param $cityTo
     * @param $dateOut //Дата отъезда из гостиницы
     * @return $this
     */
    public function getBusWayReverse($cityOut, $cityTo, $dateOut)
    {
        $timestamp = strtotime($dateOut);
        $dayBegin = date('Y-m-d', $timestamp) . ' 00:00:00';
        $dayEnd = date('Y-m-d', $timestamp) . ' 23:59:59';

        $query = $this;
        $query->select('bus_way.*');
        $query->distinct(true);
        $query->innerJoin('bus_route as br', 'bus_way.bus_route_id = br.id')
            ->innerJoin('bus_route_has_bus_route_point as hasbr', 'br.id=hasbr.bus_route_id')
            ->innerJoin('bus_route_point as brp', 'hasbr.bus_route_point_id=brp.id');
        //Выбираем дату заезда
        $query->andFilterWhere(['>=', 'bus_way.date_end', $dayBegin]);
        $query->andFilterWhere(['<=', 'bus_way.date_end', $dayEnd]);
        $query->andWhere('bus_way.active = 1');
        $query->andWhere('bus_way.ended = 0');
        //Выбираем необходимый город
        $query->andWhere("
        (
            (
                hasbr.first_point = 1
                AND brp.city_id = $cityTo
            )
            or (
                hasbr.first_point = 0
                AND brp.city_id = $cityOut
            )
        )
        ");
        $query->groupBy('bus_way.id');
        $query->having('count(bus_way.id) = 2');
        return $query;
    }

}