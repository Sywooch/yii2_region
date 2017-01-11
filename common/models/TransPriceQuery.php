<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TransPrice]].
 *
 * @see TransPrice
 */
class TransPriceQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[trans_price.active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return TransPrice[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TransPrice|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $cityOut
     * @param $cityTo
     * @param $dateOut - Дата выезда из пункта отправления
     * @param $transType
     * @return TransPriceQuery
     */

    public function getTransWay($cityOut, $cityTo, $dateOut, $transType/*, $timeLimit*/)
    {
        $timestamp = strtotime($dateOut);
        $dayBegin = date('Y-m-d', $timestamp) . ' 00:00:00';
        $dayEnd = date('Y-m-d', $timestamp) . ' 23:59:59';

        $query = $this;
        $query->select('trans_price.*');
        $query->distinct(true);
        $query->innerJoin('trans_info as ti', 'trans_price.trans_info_id = ti.id')
            ->innerJoin('trans_route as tr', 'ti.trans_route_id = tr.id')
            ->innerJoin('trans_route_has_trans_station as hastr', 'hastr.trans_route_id = tr.id')
            ->innerJoin('trans_station as ts', 'hastr.trans_station_id = ts.id');

        //Выбираем дату заезда
        $query->andFilterWhere(['>=', 'trans_price.date_end', $dayBegin]);
        $query->andFilterWhere(['<=', 'trans_price.date_end', $dayEnd]);
        $query->andFilterWhere(['=', 'ti.trans_type_id', $transType]);
        $query->andWhere('trans_price.active = 1');
        //Выбираем необходимый город
        $query->andWhere("
        (
            (
                hastr.position = 1
                AND ts.city_id = $cityOut
            )
            or (
                hastr.position > 1
                AND ts.city_id = $cityTo
            )
        )
        ");

        return $query;
    }

    /**
     * @param $cityOut
     * @param $cityTo
     * @param $dateOut - Дата отъезда из гостиницы (окончание тура, отъезд с места отдыха)
     * @param $transType
     * @return TransPriceQuery
     */
    public function getTransWayReverse($cityOut, $cityTo, $dateOut, $transType/*, $timeLimit*/)
    {
        $timestamp = strtotime($dateOut);
        $dayBegin = date('Y-m-d', $timestamp) . ' 00:00:00';
        $dayEnd = date('Y-m-d', $timestamp) . ' 23:59:59';

        $query = $this;
        $query->select('trans_price.*');
        $query->distinct(true);
        $query->innerJoin('trans_info as ti', 'trans_price.trans_info_id = ti.id')
            ->innerJoin('trans_route as tr', 'ti.trans_route_id = tr.id')
            ->innerJoin('trans_route_has_trans_station as hastr', 'hastr.trans_route_id = tr.id')
            ->innerJoin('trans_station as ts', 'hastr.trans_station_id = ts.id');

        //Выбираем дату заезда
        $query->andFilterWhere(['>=', 'bus_way.date_end', $dayBegin]);
        $query->andFilterWhere(['<=', 'bus_way.date_end', $dayEnd]);
        $query->andFilterWhere(['ti.trans_type_id', $transType]);
        $query->andWhere('trans_price.active = 1');

        //Выбираем необходимый город
        $query->andWhere("
        (
            (
                hasbr.position > 1
                AND brp.city_id = $cityTo
            )
            or (
                hasbr.position = 1
                AND brp.city_id = $cityOut
            )
        )
        ");

        return $query;
    }
}