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

\MetaPalettes::appendAfter(
    'tl_user_group',
    'default',
    'title',
    array(
        'autoPermission' => array(':hide', 'autoPermission', 'autoModulePermission',),
    )
);

$fields = array(
    'autoPermission' => array(
        'label'     => &$GLOBALS['TL_LANG']['tl_user_group']['autoPermission'],
        'exclude'   => true,
        'inputType' => 'multiColumnWizard',
        'eval'      => array(
            'tl_class'     => 'w50 autoheight',
            'columnFields' => array(
                'archive' => array(
                    'label'            => &$GLOBALS['TL_LANG']['tl_user_group']['autoPermissionArchive'],
                    'exclude'          => true,
                    'inputType'        => 'select',
                    'options_callback' => array(
                        'ContaoBlackForest\User\Group\Permission\DataContainer\OptionsBuilder',
                        'getArchivePermissionOptions'
                    ),
                    'eval'             => array(
                        'style'              => 'width:250px',
                        'chosen'             => true,
                        'includeBlankOption' => true
                    )
                )
            )
        ),
        'sql'       => "blob NULL"
    ),
    'autoModulePermission' => array(
        'label'     => &$GLOBALS['TL_LANG']['tl_user_group']['autoModulePermission'],
        'exclude'   => true,
        'inputType' => 'multiColumnWizard',
        'eval'      => array(
            'tl_class'     => 'w50 autoheight',
            'columnFields' => array(
                'module' => array(
                    'label'            => &$GLOBALS['TL_LANG']['tl_user_group']['autoPermissionModule'],
                    'exclude'          => true,
                    'inputType'        => 'select',
                    'options_callback' => array(
                        'ContaoBlackForest\User\Group\Permission\DataContainer\OptionsBuilder',
                        'getModulePermissionOptions'
                    ),
                    'eval'             => array(
                        'style'              => 'width:250px',
                        'chosen'             => true,
                        'includeBlankOption' => true
                    )
                )
            )
        ),
        'sql'       => "blob NULL"
    ),
);

$GLOBALS['TL_DCA']['tl_user_group']['fields'] = array_merge(
    $GLOBALS['TL_DCA']['tl_user_group']['fields'],
    $fields
);

unset($fields);
