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

ClassLoader::addClasses(
    array(
        'ContaoBlackForest\User\Group\Permission\Controller' => 'system/modules/user-group-auto-permission/src/Controller.php',
        'ContaoBlackForest\User\Group\Permission\DataContainer\OptionsBuilder' => 'system/modules/user-group-auto-permission/src/DataContainer/OptionsBuilder.php',
    )
);
