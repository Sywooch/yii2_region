<?php

namespace common\models;

use Yii;
use arogachev\ManyToMany\behaviors\ManyToManyBehavior;
use arogachev\ManyToMany\validators\ManyToManyValidator;
use yii2tech\ar\linkmany\LinkManyBehavior;

/**
 * This is the model class for table "trans_route".
 *
 * @property integer $id
 * @property string $date_add
 * @property string $date_edit
 * @property integer $active
 * @property string $begin_point
 * @property string $end_point
 *
 * @property TransRouteHasTransStation[] $transRouteHasTransStations
 * @property TransStation[] $transStations
 */
class TransRoute extends \yii\db\ActiveRecord
{

    /**
     * @var array
     */
    public $editableTransStation = [];

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'editableTransStation' => [
                'class' => LinkManyBehavior::className(),
                'relation' => 'transStation',
                'relationReferenceAttribute' => 'transStationIds',
                'extraColumns' => [
                    'type' => 'user-define',
                    'position' => 'textInput'],
            ],
        ];
        /*return [
            [
                'class' => ManyToManyBehavior::className(),
                'relations' => [
                    [
                        'editableAttribute' => 'editableTransStation', // Editable attribute name
                        'table' => 'trans_route_has_trans_station', // Name of the junction table
                        'ownAttribute' => 'trans_route_id', // Name of the column in junction table that represents current model
                        'relatedModel' => TransStation::className(), // Related model class
                        'relatedAttribute' => 'trans_station_id', // Name of the column in junction table that represents related model
                    ],
                ],
            ],
        ];*/
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_route';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['editableTransStation', ManyToManyValidator::className()],
            [['date_add', 'date_edit'], 'safe'],
            [['active'], 'integer'],
            [['begin_point', 'end_point'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ.'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'active' => Yii::t('app', 'Active'),
            'begin_point' => Yii::t('app', 'Begin Point'),
            'end_point' => Yii::t('app', 'End Point'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransRouteHasTransStations()
    {
        return $this->hasMany(TransRouteHasTransStation::className(), ['trans_route_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransStations()
    {
        return $this->hasMany(TransStation::className(), ['id' => 'trans_station_id'])->viaTable('trans_route_has_trans_station', ['trans_route_id' => 'id']);
    }
}
