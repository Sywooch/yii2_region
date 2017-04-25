<?php

namespace common\models;

use common\models\base\AgentPercent as BaseAgentPercent;

/**
 * This is the model class for table "agent_percent".
 */
class AgentPercent extends BaseAgentPercent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id', 'percent'], 'required'],
            [['user_id', 'created_by', 'updated_by', 'lock', 'active'], 'integer'],
            [['percent'], 'number'],
            [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
