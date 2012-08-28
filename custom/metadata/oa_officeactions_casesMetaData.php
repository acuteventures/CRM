<?php
// created: 2011-12-21 09:33:00
$dictionary["oa_officeactions_cases"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'oa_officeactions_cases' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'oa_officeactions',
      'rhs_table' => 'oa_officeactions',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'oa_officeactions_cases_c',
      'join_key_lhs' => 'oa_officeactions_casescases_ida',
      'join_key_rhs' => 'oa_officeactions_casesoa_officeactions_idb',
    ),
  ),
  'table' => 'oa_officeactions_cases_c',
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
      'name' => 'oa_officeactions_casescases_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'oa_officeactions_casesoa_officeactions_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'oa_officeactions_casesspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'oa_officeactions_cases_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'oa_officeactions_casescases_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'oa_officeactions_cases_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'oa_officeactions_casesoa_officeactions_idb',
      ),
    ),
  ),
);