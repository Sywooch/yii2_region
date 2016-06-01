<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[HotelsInfo]].
 *
 * @see HotelsInfo
 */
class HotelsInfoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

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
    
    
}