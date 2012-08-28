<?php
// created: 2011-12-05 07:28:05
$dictionary["inv_inventions_accounts"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'inv_inventions_accounts' => 
    array (
      'lhs_module' => 'Accounts',
      'lhs_table' => 'accounts',
      'lhs_key' => 'id',
      'rhs_module' => 'Inv_Inventions',
      'rhs_table' => 'inv_inventions',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'inv_inventions_accounts_c',
      'join_key_lhs' => 'inv_inventd1acccounts_ida',
      'join_key_rhs' => 'inv_invent9feaentions_idb',
    ),
  ),
  'table' => 'inv_inventions_accounts_c',
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
      'name' => 'inv_inventd1acccounts_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'inv_invent9feaentions_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'inv_inventions_accountsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'inv_inventions_accounts_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'inv_inventd1acccounts_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'inv_inventions_accounts_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'inv_invent9feaentions_idb',
      ),
    ),
  ),
);
?>
