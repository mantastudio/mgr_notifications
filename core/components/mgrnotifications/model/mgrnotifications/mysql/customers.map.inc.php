<?php
$xpdo_meta_map['customers']= array (
  'package' => 'mgrnotifications',
  'version' => '1.1',
  'table' => 'ntm_customers',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'MyISAM',
  ),
  'fields' => 
  array (
    'Name' => '',
    'API_key' => '',
    'Status' => 1,
  ),
  'fieldMeta' => 
  array (
    'Name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'API_key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '32',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'Status' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'boolean',
      'null' => false,
      'default' => 1,
    ),
  ),
  'composites' => 
  array (
    'notifications' => 
    array (
      'class' => 'notifications',
      'local' => 'id',
      'foreign' => 'Customer_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
