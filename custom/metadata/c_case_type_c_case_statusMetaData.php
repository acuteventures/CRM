<?php
// created: 2011-12-03 02:32:14
$dictionary["c_case_type_c_case_status"] = array (
  'relationships' => 
  array (
    'c_case_type_c_case_status' => 
    array (
      'lhs_module' => 'c_case_type',
      'lhs_table' => 'c_case_type',
      'lhs_key' => 'id',
      'rhs_module' => 'c_case_status',
      'rhs_table' => 'c_case_status',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'c_case_type_c_case_status_c',
      'join_key_lhs' => 'c_case_type_c_case_statusc_case_type_ida',
      'join_key_rhs' => 'c_case_type_c_case_statusc_case_status_idb',
    ),
  ),
  'table' => 'c_case_type_c_case_status_c',
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
      'name' => 'c_case_type_c_case_statusc_case_type_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'c_case_type_c_case_statusc_case_status_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'c_case_type_c_case_statusspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'c_case_type_c_case_status_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'c_case_type_c_case_statusc_case_type_ida',
        1 => 'c_case_type_c_case_statusc_case_status_idb',
      ),
    ),
  ),
);