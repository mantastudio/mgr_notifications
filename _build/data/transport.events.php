<?php
/**
 * events transport file for mgrnotifications extra
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
/* @var xPDOObject[] $events */


$events = array();

$events[1] = $modx->newObject('modEvent');
$events[1]->fromArray(array (
  'name' => 'OnMyEvent1',
  'groupname' => 'mgrnotifications',
  'service' => 1,
), '', true, true);
$events[2] = $modx->newObject('modEvent');
$events[2]->fromArray(array (
  'name' => 'OnMyEvent2',
  'groupname' => 'mgrnotifications',
  'service' => 1,
), '', true, true);
return $events;
