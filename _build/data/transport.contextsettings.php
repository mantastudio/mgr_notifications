<?php
/**
 * contextSettings transport file for mgrnotifications extra
 *
 * Copyright 2020 by Sinisa Vrhovac https://github.com/mantastudio/
 * Created on 28-09-2020
 *
 * @package mgrnotifications
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
  'context_key' => 'mgrnotifications',
  'key' => 'mgrnotifications_context_setting1',
  'name' => 'mgrnotifications Setting One',
  'description' => 'Description for setting one',
  'namespace' => 'mgrnotifications',
  'xtype' => 'textfield',
  'value' => 'value1',
  'area' => 'mgrnotifications',
  'fk' => 'mgrnotifications',
), '', true, true);
$contextSettings[2] = $modx->newObject('modContextSetting');
$contextSettings[2]->fromArray(array (
  'context_key' => 'mgrnotifications',
  'key' => 'mgrnotifications_context_setting2',
  'name' => 'mgrnotifications Setting Two',
  'description' => 'Description for setting two',
  'namespace' => 'mgrnotifications',
  'xtype' => 'combo-boolean',
  'value' => true,
  'area' => 'mgrnotifications',
  'fk' => 'mgrnotifications',
), '', true, true);
return $contextSettings;
