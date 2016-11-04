<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[\common\models\HotelsAppartment]].
 *
 * @see \common\models\HotelsAppartment
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
     * @return \common\models\HotelsAppartment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\HotelsAppartment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }


}
