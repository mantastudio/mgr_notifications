<?php
/**
 * contexts transport file for mgrnotifications extra
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
/* @var xPDOObject[] $contexts */


$contexts = array();

$contexts[1] = $modx->newObject('modContext');
$contexts[1]->fromArray(array (
  'key' => 'mgrnotifications',
  'description' => 'mgrnotifications context',
  'rank' => 2,
), '', true, true);
return $contexts;
