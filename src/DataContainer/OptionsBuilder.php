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

namespace ContaoBlackForest\User\Group\Permission\DataContainer;

/**
 * Class OptionsBuilder
 *
 * @package ContaoBlackForest\User\Group\Permission\DataContainer
 */
class OptionsBuilder
{
    /**
     * @param \MultiColumnWizard $wizard
     *
     * @return array
     */
    public function getArchivePermissionOptions(\MultiColumnWizard $wizard)
    {
        $options = array();

        $relationPermission = $GLOBALS['TL_RELATION_PERMISSION'];
        if (count($relationPermission) < 0) {
            return $options;
        }

        foreach ($relationPermission as $permission => $relation) {
            $options[$permission] =
                $GLOBALS['TL_LANG']['TL_RELATION_PERMISSION'][$relation] . ' - ' . $GLOBALS['TL_LANG']['tl_user'][$permission][0];
        }

        return $options;
    }

    /**
     * @param \MultiColumnWizard $wizard
     *
     * @return array
     */
    public function getModulePermissionOptions(\MultiColumnWizard $wizard)
    {
        $options = array();

        foreach (array_keys($GLOBALS['BE_MOD']) as $moduleName) {
            $options[$moduleName] = $GLOBALS['TL_LANG']['MOD'][$moduleName];
            echo "";
        }

        return $options;
    }
}
