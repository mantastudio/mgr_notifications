<?php
/**
* Resolver to connect TVs to templates for mgrnotifications extra
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
/* @var $parentObj modResource */
/* @var $templateObj modTemplate */

/* @var array $options */

if (!function_exists('checkFields')) {
    function checkFields($required, $objectFields) {
        global $modx;
        $fields = explode(',', $required);
        foreach ($fields as $field) {
            if (!isset($objectFields[$field])) {
                $modx->log(modX::LOG_LEVEL_ERROR, '[TV Resolver] Missing field: ' . $field);
                return false;
            }
        }
        return true;
    }
}

if ($object->xpdo) {
    $modx =& $object->xpdo;
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:

            $intersects = array (
                0 =>  array (
                  'templateid' => 'default',
                  'tmplvarid' => 'Tv1',
                  'rank' => 1,
                ),
                1 =>  array (
                  'templateid' => 'Template1',
                  'tmplvarid' => 'Tv1',
                  'rank' => 4,
                ),
                2 =>  array (
                  'templateid' => 'Template2',
                  'tmplvarid' => 'Tv1',
                  'rank' => 4,
                ),
                3 =>  array (
                  'templateid' => 'default',
                  'tmplvarid' => 'Tv2',
                  'rank' => 3,
                ),
                4 =>  array (
                  'templateid' => 'Template1',
                  'tmplvarid' => 'Tv2',
                  'rank' => 4,
                ),
                5 =>  array (
                  'templateid' => 'Template2',
                  'tmplvarid' => 'Tv2',
                  'rank' => 1,
                ),
            );

            if (is_array($intersects)) {
                foreach ($intersects as $k => $fields) {
                    /* make sure we have all fields */
                    if (!checkFields('tmplvarid,templateid', $fields)) {
                        continue;
                    }
                    $tv = $modx->getObject('modTemplateVar', array('name' => $fields['tmplvarid']));
                    if ($fields['templateid'] == 'default') {
                        $template = $modx->getObject('modTemplate', $modx->getOption('default_template'));
                    } else {
                        $template = $modx->getObject('modTemplate', array('templatename' => $fields['templateid']));
                    }
                    if (!$tv || !$template) {
                        $modx->log(xPDO::LOG_LEVEL_ERROR, 'Could not find Template and/or TV ' .
                            $fields['templateid'] . ' - ' . $fields['tmplvarid']);
                        continue;
                    }
                    $tvt = $modx->getObject('modTemplateVarTemplate', array('templateid' => $template->get('id'), 'tmplvarid' => $tv->get('id')));
                    if (! $tvt) {
                        $tvt = $modx->newObject('modTemplateVarTemplate');
                    }
                    if ($tvt) {
                        $tvt->set('tmplvarid', $tv->get('id'));
                        $tvt->set('templateid', $template->get('id'));
                        if (isset($fields['rank'])) {
                            $tvt->set('rank', $fields['rank']);
                        } else {
                            $tvt->set('rank', 0);
                        }
                        if (!$tvt->save()) {
                            $modx->log(xPDO::LOG_LEVEL_ERROR, 'Unknown error creating templateVarTemplate for ' .
                                $fields['templateid'] . ' - ' . $fields['tmplvarid']);
                        }
                    } else {
                        $modx->log(xPDO::LOG_LEVEL_ERROR, 'Unknown error creating templateVarTemplate for ' .
                            $fields['templateid'] . ' - ' . $fields['tmplvarid']);
                    }


                }

            }
            break;

        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}

return true;