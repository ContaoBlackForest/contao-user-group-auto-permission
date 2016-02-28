<?php

/**
 * Copyright (C) user-group-auto-permission
 *
 * @package   user-group-auto-permission
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Dominik Tomasi <dominik.tomasi@gmail.com>
 * @license   GNU/LGPL
 * @copyright Copyright 2016 ContaoBlackForest
 */

namespace ContaoBlackForest\User\Group\Permission;

/**
 * Class Controller
 *
 * @package ContaoBlackForest\User\Group\Permission
 */
class Controller
{
    /**
     * @var null
     */
    protected $permissionTable = null;

    /**
     * @var null
     */
    protected $permissionField = null;

    /**
     * @var bool
     */
    protected $autoPermission = false;

    /**
     * @param $table
     */
    public function setAutoPermission($table)
    {
        global $controller;

        if (!array_key_exists('controller', $GLOBALS)
            || $controller->User->isAdmin
            || !array_key_exists('TL_RELATION_PERMISSION', $GLOBALS)
            || empty($GLOBALS['TL_RELATION_PERMISSION'])
        ) {
            return;
        }

        $this->findPermissionByTable($table);
        $this->parsePermissionByTable();
        $this->findPermissionByParentTable($table);
        $this->setPermissionToUser();
    }

    protected function parsePermissionByTable()
    {
        if (!$this->permissionField) {
            return;
        }

        global $controller;

        $userGroupResult = \UserGroupModel::findMultipleByIds($controller->User->groups);
        if (!$userGroupResult) {
            return;
        }

        $time = \Date::floorToMinute();
        while ($userGroupResult->next()) {
            if ($userGroupResult->disable
                || ($userGroupResult->start && $userGroupResult->start >= $time)
                || ($userGroupResult->stop && $userGroupResult->stop <= $time + 60)
            ) {
                continue;
            }

            $chunks = deserialize($userGroupResult->autoPermission);
            if (empty($chunks)) {
                continue;
            }

            foreach ($chunks as $chunk) {
                if (!in_array($this->permissionField, array_values($chunk))) {
                    continue;
                }

                $this->autoPermission = true;
            }
        }
    }

    /**
     * @param $table
     */
    protected function findPermissionByTable($table)
    {
        foreach ($GLOBALS['TL_RELATION_PERMISSION'] as $permissionField => $permissionTable) {
            if ($permissionTable !== $table) {
                continue;
            }

            $this->permissionField = $permissionField;
            $this->permissionTable = $permissionTable;
        }
    }

    /**
     * @param $table
     */
    protected function findPermissionByParentTable($table)
    {
        if (($this->autoPermission)
            || !array_key_exists('ptable', $GLOBALS['TL_DCA'][$table]['config'])
        ) {
            return;
        }

        $this->findPermissionByTable($GLOBALS['TL_DCA'][$table]['config']['ptable']);
        $this->parsePermissionByTable();
        if ($this->autoPermission
            || !array_key_exists('ptable', $GLOBALS['TL_DCA'][$table]['config'])
            || empty($GLOBALS['TL_DCA'][$table]['config']['ptable'])
        ) {
            return;
        }

        \Controller::loadDataContainer($GLOBALS['TL_DCA'][$table]['config']['ptable']);
    }

    protected function setPermissionToUser()
    {
        if ((!$this->permissionField
             && !$this->permissionTable)
            || !$this->autoPermission
        ) {
            return;
        }

        /** @var \Model $permissionModel */
        $permissionModel  = \Model::getClassFromTable($this->permissionTable);
        $permissionResult = $permissionModel::findAll();
        if (!$permissionResult) {
            return;
        }

        $permissions = array();
        while ($permissionResult->next()) {
            $permissions[] = $permissionResult->id;
        }
        if (empty($permissions)) {
            return;
        }

        global $controller;
        $permissionField = $this->permissionField;

        $controller->User->$permissionField = $permissions;
    }
}
