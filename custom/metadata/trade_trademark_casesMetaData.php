<?php
// created: 2012-01-10 11:49:05
$dictionary["trade_trademark_cases"] = array (
  'relationships' => 
  array (
    'trade_trademark_cases' => 
    array (
      'lhs_module' => 'trade_trademark',
      'lhs_table' => 'trade_trademark',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'trade_trademark_cases_c',
      'join_key_lhs' => 'trade_trademark_casestrade_trademark_ida',
      'join_key_rhs' => 'trade_trademark_casescases_idb',
    ),
  ),
  'table' => 'trade_trademark_cases_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'trade_trademark_casestrade_trademark_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'trade_trademark_casescases_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'trade_trademark_casesspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'trade_trademark_cases_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'trade_trademark_casestrade_trademark_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'trade_trademark_cases_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'trade_trademark_casescases_idb',
      ),
    ),
  ),
);