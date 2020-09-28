<?php
/**
 * contextSettings transport file for mgr_notifications extra
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
/* @var xPDOObject[] $contextSettings */


$contextSettings = array();

$contextSettings[1] = $modx->newObject('modContextSetting');
$contextSettings[1]->fromArray(array (
  'context_key' => 'mgr_notifications',
  'key' => 'mgr_notifications_context_setting1',
  'name' => 'mgr_notifications Setting One',
  'description' => 'Description for setting one',
  'namespace' => 'mgr_notifications',
  'xtype' => 'textfield',
  'value' => 'value1',
  'area' => 'mgr_notifications',
  'fk' => 'mgr_notifications',
), '', true, true);
$contextSettings[2] = $modx->newObject('modContextSetting');
$contextSettings[2]->fromArray(array (
  'context_key' => 'mgr_notifications',
  'key' => 'mgr_notifications_context_setting2',
  'name' => 'mgr_notifications Setting Two',
  'description' => 'Description for setting two',
  'namespace' => 'mgr_notifications',
  'xtype' => 'combo-boolean',
  'value' => true,
  'area' => 'mgr_notifications',
  'fk' => 'mgr_notifications',
), '', true, true);
return $contextSettings;
