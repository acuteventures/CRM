<?php
// created: 2012-01-10 11:49:05
$dictionary["Case"]["fields"]["trade_trademark_cases"] = array (
  'name' => 'trade_trademark_cases',
  'type' => 'link',
  'relationship' => 'trade_trademark_cases',
  'source' => 'non-db',
  'vname' => 'LBL_TRADE_TRADEMARK_CASES_FROM_TRADE_TRADEMARK_TITLE',
  'id_name' => 'trade_trademark_casestrade_trademark_ida',
);
$dictionary["Case"]["fields"]["trade_trademark_cases_name"] = array (
  'name' => 'trade_trademark_cases_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_TRADE_TRADEMARK_CASES_FROM_TRADE_TRADEMARK_TITLE',
  'save' => true,
  'id_name' => 'trade_trademark_casestrade_trademark_ida',
  'link' => 'trade_trademark_cases',
  'table' => 'trade_trademark',
  'module' => 'trade_trademark',
  'rname' => 'name',
);
$dictionary["Case"]["fields"]["trade_trademark_casestrade_trademark_ida"] = array (
  'name' => 'trade_trademark_casestrade_trademark_ida',
  'type' => 'link',
  'relationship' => 'trade_trademark_cases',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_TRADE_TRADEMARK_CASES_FROM_CASES_TITLE',
);
