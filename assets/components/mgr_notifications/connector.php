<?php
/**
* Connector file for mgr_notifications extra
*
* Copyright 2020 by Sinisa Vrhovac https://github.com/mantastudio/
* Created on 28-09-2020
*
 * mgr_notifications is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * mgr_notifications is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * mgr_notifications; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
*
* @package mgr_notifications
*/
/* @var $modx modX */

require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$mgr_notificationsCorePath = $modx->getOption('mgr_notifications.core_path', null, $modx->getOption('core_path') . 'components/mgr_notifications/');
require_once $mgr_notificationsCorePath . 'model/mgr_notifications/mgr_notifications.class.php';
$modx->mgr_notifications = new mgr_notifications($modx);

$modx->lexicon->load('mgr_notifications:default');

/* handle request */
$path = $modx->getOption('processorsPath', $modx->mgr_notifications->config, $mgr_notificationsCorePath . 'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));