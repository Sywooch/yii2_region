<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[\common\models\TransRoute]].
 *
 * @see \common\models\TransRoute
 */
class TransRouteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\TransRoute[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\TransRoute|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
