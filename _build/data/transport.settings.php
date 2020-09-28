<?php
/**
 * systemSettings transport file for mgr_notifications extra
 *
 * Copyright 2020 by Sinisa Vrhovac https://github.com/mantastudio/
 * Created on 28-09-2020
 *
 * @package mgr_notifications
 * @subpackage build
 */

if (! function_exists('stripPhpTags')) {
    function stripPhpTags($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<' . '?' . 'php', '', $o);
        $o = str_replace('?>', '', $o);
        $o = trim($o);
        return $o;
    }
}
/* @var $modx modX */
/* @var $sources array */
/* @var xPDOObject[] $systemSettings */


$systemSettings = array();

$systemSettings[1] = $modx->newObject('modSystemSetting');
$systemSettings[1]->fromArray(array (
  'key' => 'mgr_notifications_system_setting1',
  'name' => 'mgr_notifications Setting One',
  'description' => 'Description for setting one',
  'namespace' => 'mgr_notifications',
  'xtype' => 'textfield',
  'value' => 'value1',
  'area' => 'area1',
), '', true, true);
$systemSettings[2] = $modx->newObject('modSystemSetting');
$systemSettings[2]->fromArray(array (
  'key' => 'mgr_notifications_system_setting2',
  'name' => 'mgr_notifications Setting Two',
  'description' => 'Description for setting two',
  'namespace' => 'mgr_notifications',
  'xtype' => 'combo-boolean',
  'value' => true,
  'area' => 'area2',
), '', true, true);
return $systemSettings;
