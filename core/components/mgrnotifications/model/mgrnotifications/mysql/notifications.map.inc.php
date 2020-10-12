<?php
$xpdo_meta_map['notifications']= array (
  'package' => 'mgrnotifications',
  'version' => '1.1',
  'table' => 'ntm_notifications',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'MyISAM',
  ),
  'fields' => 
  array (
    'Customer_id' => 0,
    'Title' => '',
    'Message' => '',
    'Class' => '',
    'Published' => 0,
    'Created' => 'CURRENT_TIMESTAMP',
    'Expiry' => 'CURRENT_TIMESTAMP',
    'Author' => 0,
    'First_delivery' => NULL,
    'Last_delivery' => NULL,
  ),
  'fieldMeta' => 
  array (
    'Customer_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'int',
      'null' => false,
      'default' => 0,
    ),
    'Title' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'Message' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'Class' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'Published' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'boolean',
      'null' => false,
      'default' => 0,
    ),
    'Created' => 
    array (
      'dbtype' => 'timestamp',
      'phptype' => 'timestamp',
      'default' => 'CURRENT_TIMESTAMP',
    ),
    'Expiry' => 
    array (
      'dbtype' => 'timestamp',
      'phptype' => 'timestamp',
      'default' => 'CURRENT_TIMESTAMP',
    ),
    'Author' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'First_delivery' => 
    array (
      'dbtype' => 'timestamp',
      'phptype' => 'timestamp',
      'null' => true,
    ),
    'Last_delivery' => 
    array (
      'dbtype' => 'timestamp',
      'phptype' => 'timestamp',
      'null' => true,
    ),
  ),
  'aggregates' => 
  array (
    'customers' => 
    array (
      'class' => 'customers',
      'local' => 'Customer_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
