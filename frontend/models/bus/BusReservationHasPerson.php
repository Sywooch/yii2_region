<?php

namespace frontend\models\bus;

use Yii;
use \frontend\models\bus\base\BusReservationHasPerson as BaseBusReservationHasPerson;

/**
 * This is the model class for table "bus_reservation_has_person".
 */
class BusReservationHasPerson extends BaseBusReservationHasPerson
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['bus_reservation_id', 'person_id'], 'required'],
                [['bus_reservation_id', 'person_id', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['date_add', 'date_edit'], 'safe'],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'bus_reservation_id' => Yii::t('app', 'Bus Reservation ID'),
            'person_id' => Yii::t('app', 'Person ID'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }
}
