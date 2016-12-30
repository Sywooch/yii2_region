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
        $this->andWhere('[[active]]=1');
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

    public function hot()
    {
        $this->andWhere('[[hot]]=1');
        return $this;
    }

    public function activeTour()
    {
        $curentTime = new Expression('NOW()');
        $this->active();
        $this->innerJoin('tour_info', ['tour_info.hotels_info_id' => 'hotels_info.id'])
            ->andWhere(['>=', 'tour_info.date_begin', $curentTime]);
        //->andWhere(['<=','tour_info.date_end',$curentTime]);
        return $this;
    }

}