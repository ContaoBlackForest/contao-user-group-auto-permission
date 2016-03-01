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

$GLOBALS['TL_HOOKS']['loadDataContainer'][] = array(
    'ContaoBlackForest\User\Group\Permission\Controller',
    'setAutoPermission'
);

$GLOBALS['TL_HOOKS']['postAuthenticate'][] = array(
    'ContaoBlackForest\User\Group\Permission\Controller',
    'setModulePermission'
);

/**
 * Auto permission settings
 *
 * You can add configuration in $GLOBALS['TL_RELATION_PERMISSION'].
 * The relationship from permission field by the user group must be configure.
 *
 * For example add auto permission for tl_news_archive:
 * $GLOBALS['TL_RELATION_PERMISSION'][] = array('news' => 'tl_news_archive');
 * This makes available by user group edit mask.
 */
$GLOBALS['TL_RELATION_PERMISSION'] = array(
    'calendars' => 'tl_calendar',
    'calendarfeeds' => 'tl_calendar_feed',
    'forms' => 'tl_form',
    'faqs' => 'tl_faq_category',
    'news' => 'tl_news_archive',
    'newsfeeds' => 'tl_news_feed',
    'newsletters' => 'tl_newsletter_channel',
);
