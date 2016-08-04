<?php

namespace frontend\models\bus;

use Yii;
use \frontend\models\bus\base\BusRoute as BaseBusRoute;

/**
 * This is the model class for table "bus_route".
 */
class BusRoute extends BaseBusRoute
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['name'], 'required'],
                [['name'], 'string'],
                [['date', 'date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
                [['created_by', 'updated_by'], 'integer'],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

}
