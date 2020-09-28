<?php
/**
 * menus transport file for mgr_notifications extra
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
/* @var xPDOObject[] $menus */

$action = $modx->newObject('modAction');
$action->fromArray( array (
  'id' => 1,
  'namespace' => 'mgr_notifications',
  'controller' => 'index',
  'haslayout' => true,
  'lang_topics' => 'mgr_notifications:default',
  'assets' => '',
), '', true, true);

$menus[1] = $modx->newObject('modMenu');
$menus[1]->fromArray( array (
  'text' => 'mgr_notifications',
  'parent' => 'components',
  'description' => 'ex_menu_desc',
  'icon' => '',
  'menuindex' => 0,
  'params' => '',
  'handler' => '',
  'permissions' => '',
  'namespace' => 'mgr_notifications',
  'id' => 1,
), '', true, true);
$menus[1]->addOne($action);

return $menus;
