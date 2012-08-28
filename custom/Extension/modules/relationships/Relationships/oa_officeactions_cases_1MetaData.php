<?php
// created: 2011-12-16 09:42:09
$dictionary["oa_officeactions_cases_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'oa_officeactions_cases_1' => 
    array (
      'lhs_module' => 'oa_officeactions',
      'lhs_table' => 'oa_officeactions',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'oa_officeactions_cases_1_c',
      'join_key_lhs' => 'oa_officeactions_cases_1oa_officeactions_ida',
      'join_key_rhs' => 'oa_officeactions_cases_1cases_idb',
    ),
  ),
  'table' => 'oa_officeactions_cases_1_c',
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
      'name' => 'oa_officeactions_cases_1oa_officeactions_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'oa_officeactions_cases_1cases_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'oa_officeactions_cases_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'oa_officeactions_cases_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'oa_officeactions_cases_1oa_officeactions_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'oa_officeactions_cases_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'oa_officeactions_cases_1cases_idb',
      ),
    ),
  ),
);