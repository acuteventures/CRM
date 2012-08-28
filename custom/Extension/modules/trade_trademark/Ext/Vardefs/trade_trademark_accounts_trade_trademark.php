<?php
// created: 2012-01-10 11:49:05
$dictionary["trade_trademark"]["fields"]["trade_trademark_accounts"] = array (
  'name' => 'trade_trademark_accounts',
  'type' => 'link',
  'relationship' => 'trade_trademark_accounts',
  'source' => 'non-db',
  'vname' => 'LBL_TRADE_TRADEMARK_ACCOUNTS_FROM_ACCOUNTS_TITLE',
  'id_name' => 'trade_trademark_accountsaccounts_ida',
);
$dictionary["trade_trademark"]["fields"]["trade_trademark_accounts_name"] = array (
  'name' => 'trade_trademark_accounts_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_TRADE_TRADEMARK_ACCOUNTS_FROM_ACCOUNTS_TITLE',
  'save' => true,
  'id_name' => 'trade_trademark_accountsaccounts_ida',
  'link' => 'trade_trademark_accounts',
  'table' => 'accounts',
  'module' => 'Accounts',
  'rname' => 'name',
);
$dictionary["trade_trademark"]["fields"]["trade_trademark_accountsaccounts_ida"] = array (
  'name' => 'trade_trademark_accountsaccounts_ida',
  'type' => 'link',
  'relationship' => 'trade_trademark_accounts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_TRADE_TRADEMARK_ACCOUNTS_FROM_TRADE_TRADEMARK_TITLE',
);
