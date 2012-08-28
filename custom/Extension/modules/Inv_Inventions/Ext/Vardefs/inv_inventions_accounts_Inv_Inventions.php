<?php
// created: 2011-12-05 07:28:05
$dictionary["Inv_Inventions"]["fields"]["inv_inventions_accounts"] = array (
  'name' => 'inv_inventions_accounts',
  'type' => 'link',
  'relationship' => 'inv_inventions_accounts',
  'source' => 'non-db',
  'vname' => 'LBL_INV_INVENTIONS_ACCOUNTS_FROM_ACCOUNTS_TITLE',
);
$dictionary["Inv_Inventions"]["fields"]["inv_inventions_accounts_name"] = array (
  'name' => 'inv_inventions_accounts_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_INV_INVENTIONS_ACCOUNTS_FROM_ACCOUNTS_TITLE',
  'save' => true,
  'id_name' => 'inv_inventd1acccounts_ida',
  'link' => 'inv_inventions_accounts',
  'table' => 'accounts',
  'module' => 'Accounts',
  'rname' => 'name',
);
$dictionary["Inv_Inventions"]["fields"]["inv_inventd1acccounts_ida"] = array (
  'name' => 'inv_inventd1acccounts_ida',
  'type' => 'link',
  'relationship' => 'inv_inventions_accounts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_INV_INVENTIONS_ACCOUNTS_FROM_INV_INVENTIONS_TITLE',
);
