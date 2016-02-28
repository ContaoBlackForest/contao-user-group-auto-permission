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

foreach (array('extend', 'custom') as $palette) {
    \MetaPalettes::appendAfter(
        'tl_user',
        $palette,
        'groups',
        array(
            'autoPermission' => array(':hide', 'autoPermission',),
        )
    );
}

$fields = array(
    'autoPermission' => array(
        'label'     => &$GLOBALS['TL_LANG']['tl_user']['autoPermission'],
        'exclude'   => true,
        'inputType' => 'multiColumnWizard',
        'eval'      => array(
            'tl_class'     => 'w50 autoheight',
            'columnFields' => array(
                'archive' => array(
                    'label'            => &$GLOBALS['TL_LANG']['tl_user']['autoPermissionArchive'],
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
    )
);

$GLOBALS['TL_DCA']['tl_user']['fields'] = array_merge(
    $GLOBALS['TL_DCA']['tl_user']['fields'],
    $fields
);

unset($fields);
