<?php

namespace common\models;

use common\models\base\AgentDefaultPercent as BaseAgentDefaultPercent;

/**
 * This is the model class for table "agent_default_percent".
 */
class AgentDefaultPercent extends BaseAgentDefaultPercent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name'], 'required'],
            [['date_add', 'date_edit'], 'safe'],
            [['created_by', 'updated_by', 'lock', 'active', 'percent'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
