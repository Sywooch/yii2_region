<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\common\models\HotelsAppartmentHasHotelsTypeOfFood]].
 *
 * @see \common\models\HotelsAppartmentHasHotelsTypeOfFood
 */
class HotelsAppartmentHasHotelsTypeOfFoodQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\HotelsAppartmentHasHotelsTypeOfFood[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\HotelsAppartmentHasHotelsTypeOfFood|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
