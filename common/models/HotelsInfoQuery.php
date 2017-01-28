<?php

namespace common\models;

use yii\db\Expression;

/**
 * This is the ActiveQuery class for [[HotelsInfo]].
 *
 * @see HotelsInfo
 */
class HotelsInfoQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[hotels_info.active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return HotelsInfo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return HotelsInfo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function listAll($active = true){
        $query = $this->andWhere('[[hotels_info.active]] = '. $active);
        return $query->all();
    }

    public function hot()
    {
        $this->andWhere('[[hot]]=1');
        return $this;
    }

    public function activeTour()
    {
        $curentTime = new Expression('NOW()');
        $this->active();
        $this->innerJoin('tour_info ti', 'ti.hotels_info_id = hotels_info.id')
            ->andWhere(['<=', 'ti.date_begin', $curentTime])
            ->andWhere(['>=','ti.date_end',$curentTime]);
        return $this;
    }

}