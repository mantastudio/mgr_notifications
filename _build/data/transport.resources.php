<?php
/**
 * resources transport file for mgrnotifications extra
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
/* @var xPDOObject[] $resources */


$resources = array();

$resources[1] = $modx->newObject('modResource');
$resources[1]->fromArray(array (
  'id' => 1,
  'pagetitle' => 'Resource1',
  'alias' => 'resource1',
  'context_key' => 'mgrnotifications',
  'class_key' => 'modDocument',
  'published' => '',
  'richtext' => '1',
  'hidemenu' => '0',
  'cacheable' => '1',
  'searchable' => '1',
), '', true, true);
$resources[1]->setContent(file_get_contents($sources['data'].'resources/resource1.content.html'));

$resources[2] = $modx->newObject('modResource');
$resources[2]->fromArray(array (
  'id' => 2,
  'pagetitle' => 'Resource2',
  'alias' => 'resource2',
  'context_key' => 'mgrnotifications',
  'template' => 'Template2',
  'richtext' => false,
  'published' => true,
  'tvValues' => 
  array (
    'Tv1' => 'SomeValue',
    'Tv2' => 'SomeOtherValue',
  ),
  'class_key' => 'modDocument',
  'hidemenu' => '0',
  'cacheable' => '1',
  'searchable' => '1',
), '', true, true);
$resources[2]->setContent(file_get_contents($sources['data'].'resources/resource2.content.html'));

return $resources;
