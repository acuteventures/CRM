<?php
// created: 2012-01-10 11:49:05
$dictionary["trade_trademark_accounts"] = array (
  'relationships' => 
  array (
    'trade_trademark_accounts' => 
    array (
      'lhs_module' => 'Accounts',
      'lhs_table' => 'accounts',
      'lhs_key' => 'id',
      'rhs_module' => 'trade_trademark',
      'rhs_table' => 'trade_trademark',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'trade_trademark_accounts_c',
      'join_key_lhs' => 'trade_trademark_accountsaccounts_ida',
      'join_key_rhs' => 'trade_trademark_accountstrade_trademark_idb',
    ),
  ),
  'table' => 'trade_trademark_accounts_c',
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
      'name' => 'trade_trademark_accountsaccounts_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'trade_trademark_accountstrade_trademark_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'trade_trademark_accountsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'trade_trademark_accounts_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'trade_trademark_accountsaccounts_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'trade_trademark_accounts_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'trade_trademark_accountstrade_trademark_idb',
      ),
    ),
  ),
);