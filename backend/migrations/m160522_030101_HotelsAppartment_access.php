<?php

use yii\db\Migration;

class m160522_030101_HotelsAppartment_access extends Migration
{
    /**
     * @var array controller all actions
     */
    public $permisions = [
        "index" => [
            "name" => "backend_hotels-appartment_index",
            "description" => "backend/hotels-appartment/index"
        ],
        "view" => [
            "name" => "backend_hotels-appartment_view",
            "description" => "backend/hotels-appartment/view"
        ],
        "create" => [
            "name" => "backend_hotels-appartment_create",
            "description" => "backend/hotels-appartment/create"
        ],
        "update" => [
            "name" => "backend_hotels-appartment_update",
            "description" => "backend/hotels-appartment/update"
        ],
        "delete" => [
            "name" => "backend_hotels-appartment_delete",
            "description" => "backend/hotels-appartment/delete"
        ]
    ];
    
    /**
     * @var array roles and maping to actions/permisions
     */
    public $roles = [
        "BackendHotelsAppartmentFull" => [
            "index",
            "view",
            "create",
            "update",
            "delete"
        ],
        "BackendHotelsAppartmentView" => [
            "index",
            "view"
        ],
        "BackendHotelsAppartmentEdit" => [
            "update",
            "create",
            "delete"
        ]
    ];
    
    public function up()
    {
        
        $permisions = [];
        $auth = \Yii::$app->authManager;

        /**
         * create permisions for each controller action
         */
        foreach ($this->permisions as $action => $permission) {
            $permisions[$action] = $auth->createPermission($permission['name']);
            $permisions[$action]->description = $permission['description'];
            $auth->add($permisions[$action]);
        }

        /**
         *  create roles
         */
        foreach ($this->roles as $roleName => $actions) {
            $role = $auth->createRole($roleName);
            $auth->add($role);

            /**
             *  to role assign permissions
             */
            foreach ($actions as $action) {
                $auth->addChild($role, $permisions[$action]);
            }
        }
    }

    public function down() {
        $auth = Yii::$app->authManager;

        foreach ($this->roles as $roleName => $actions) {
            $role = $auth->createRole($roleName);
            $auth->remove($role);
        }

        foreach ($this->permisions as $permission) {
            $authItem = $auth->createPermission($permission['name']);
            $auth->remove($authItem);
        }
    }
}
