<?php
// created: 2012-01-31 08:12:09
$dictionary["sc_sc_subcasetype_c_case_status"] = array (
  'relationships' => 
  array (
    'sc_sc_subcasetype_c_case_status' => 
    array (
      'lhs_module' => 'sc_sc_subcasetype',
      'lhs_table' => 'sc_sc_subcasetype',
      'lhs_key' => 'id',
      'rhs_module' => 'c_case_status',
      'rhs_table' => 'c_case_status',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'sc_sc_subcasetype_c_case_status_c',
      'join_key_lhs' => 'sc_sc_subcasetype_c_case_statussc_sc_subcasetype_ida',
      'join_key_rhs' => 'sc_sc_subcasetype_c_case_statusc_case_status_idb',
    ),
  ),
  'table' => 'sc_sc_subcasetype_c_case_status_c',
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
      'name' => 'sc_sc_subcasetype_c_case_statussc_sc_subcasetype_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'sc_sc_subcasetype_c_case_statusc_case_status_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'sc_sc_subcasetype_c_case_statusspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'sc_sc_subcasetype_c_case_status_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'sc_sc_subcasetype_c_case_statussc_sc_subcasetype_ida',
        1 => 'sc_sc_subcasetype_c_case_statusc_case_status_idb',
      ),
    ),
  ),
);