<?php
/**
 * systemSettings transport file for mgrnotifications extra
 *
 * Copyright 2020 by Sinisa Vrhovac https://github.com/mantastudio/
 * Created on 20-12-2020
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
/* @var xPDOObject[] $systemSettings */


$systemSettings = array();

$systemSettings[1] = $modx->newObject('modSystemSetting');
$systemSettings[1]->fromArray(array (
  'key' => 'default_message_contact',
  'value' => '',
  'xtype' => 'textfield',
  'namespace' => 'mgrnotifications',
  'area' => 'Message',
  'name' => 'Message Contact Detail',
  'description' => 'A standard contact action',
), '', true, true);
$systemSettings[2] = $modx->newObject('modSystemSetting');
$systemSettings[2]->fromArray(array (
  'key' => 'default_message_en',
  'value' => '',
  'xtype' => 'textfield',
  'namespace' => 'mgrnotifications',
  'area' => 'Message',
  'name' => 'Default Message English',
  'description' => 'A sample default message to provide in English',
), '', true, true);
$systemSettings[3] = $modx->newObject('modSystemSetting');
$systemSettings[3]->fromArray(array (
  'key' => 'default_message_nl',
  'value' => '',
  'xtype' => 'textfield',
  'namespace' => 'mgrnotifications',
  'area' => 'Message',
  'name' => 'Default Message Dutch',
  'description' => 'A sample default message to provide in Dutch',
), '', true, true);
return $systemSettings;
