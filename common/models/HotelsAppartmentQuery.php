<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[HotelsAppartment]].
 *
 * @see HotelsAppartment
 */
class HotelsAppartmentQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return HotelsAppartment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return HotelsAppartment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * Получаем все номера для текущей гостиницы
     * @param $hotelsId
     * @return $this
     */
    private function getAppartment($hotelsId)
    {
        $query = HotelsAppartment::find()->active()
            ->andWhere(['hotels_info_id' => $hotelsId]);
        return $query;
    }

    public function allCountRooms($hotelsId)
    {
        $query = $this->getAppartment($hotelsId);
        return $query->sum('count_rooms');

    }

    public function typeCountRooms($hotelsId)
    {
        $query = $this->getAppartment($hotelsId);
        $query->select(['sum(count_rooms) as count_rooms', 'hotels_appartment_item_id']);
        return $query
            ->groupBy('hotels_appartment_item_id')//->sum('count_rooms')
            ;
    }

}