<?php
/**
* Connector file for mgrnotifications extra
*
* Copyright 2020 by Sinisa Vrhovac https://github.com/mantastudio/
* Created on 28-09-2020
*
 * mgrnotifications is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * mgrnotifications is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * mgrnotifications; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
*
* @package mgrnotifications
*/
/* @var $modx modX */

require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$mgrnotificationsCorePath = $modx->getOption('mgrnotifications.core_path', null, $modx->getOption('core_path') . 'components/mgrnotifications/');
require_once $mgrnotificationsCorePath . 'model/mgrnotifications/mgrnotifications.class.php';
$modx->mgrnotifications = new mgrnotifications($modx);

$modx->lexicon->load('mgrnotifications:default');

/* handle request */
$path = $modx->getOption('processorsPath', $modx->mgrnotifications->config, $mgrnotificationsCorePath . 'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));