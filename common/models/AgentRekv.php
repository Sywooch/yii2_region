<?php

namespace common\models;

use common\models\base\AgentRekv as BaseAgentRekv;

/**
 * This is the model class for table "agent_rekv".
 */
class AgentRekv extends BaseAgentRekv
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id', 'name'], 'required'],
            [['user_id', 'inn', 'kpp', 'ogrn', 'bik', 'created_by', 'updated_by', 'lock', 'active'], 'integer'],
            [['fullname', 'phone2'], 'string'],
            [['date_add', 'date_edit'], 'safe'],
            [['name', 'direktor_fio', 'direktor_dolgnost', 'glbuh_fio', 'glbuh_dolgnost'], 'string', 'max' => 100],
            [['bankname'], 'string', 'max' => 150],
            [['rs', 'ks'], 'string', 'max' => 20],
            [['phone'], 'string', 'max' => 25],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
