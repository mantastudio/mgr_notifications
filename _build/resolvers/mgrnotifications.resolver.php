<?php
/**
 * Resolver for mgrnotifications extra
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
 * @package mgrnotifications
 * @subpackage build
 */

/* @var $object xPDOObject */
/* @var $modx modX */

/* @var array $options */

if ($object->xpdo) {
    $modx =& $object->xpdo;
    $modx->setLogLevel(modX::LOG_LEVEL_INFO);
    //$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');
    $sources = array(
        'model' => $modx->getOption('core_path').'components/mgrnotifications/model/',
        'schema_file' => $modx->getOption('core_path').'components/mgrnotifications/model/schema/mgrnotifications.mysql.schema.xml'
    );
    $manager= $modx->getManager();
    $generator= $manager->getGenerator();
    if (!is_dir($sources['model'])) {
        $modx->log(modX::LOG_LEVEL_ERROR,'Model directory not found!'); die();
    }
    if (!file_exists($sources['schema_file'])) {
        $modx->log(modX::LOG_LEVEL_ERROR,'Schema file not found!'); die();
    }
    $generator->parseSchema($sources['schema_file'],$sources['model']);
    $modx->addPackage('mgrnotifications', $sources['model']); // add package to make all models available

    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:

            $manager->createObjectContainer('customers'); // created the database table
            $manager->createObjectContainer('notifications'); // created the database table
            break;

        case xPDOTransport::ACTION_UNINSTALL:
            $manager->removeObjectContainer('customers'); // created the database table
            $manager->removeObjectContainer('notifications'); // created the database table
            break;
    }
    $modx->log(modX::LOG_LEVEL_INFO, 'Done!');
}

return true;