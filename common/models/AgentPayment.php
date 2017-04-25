<?php

namespace common\models;

use common\models\base\AgentPayment as BaseAgentPayment;

/**
 * This is the model class for table "agent_payment".
 */
class AgentPayment extends BaseAgentPayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id'], 'required'],
            [['user_id', 'status', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['payment'], 'number'],
            [['comment'], 'string'],
            [['date_add', 'date_edit'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
