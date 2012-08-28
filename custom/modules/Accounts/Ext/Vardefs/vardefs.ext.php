<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2011-1-03 03:06:10
//Phaneendra@veon.in
$dictionary["Account"]["fields"]["password"] = array (
        'required' => false,
		'name' => 'password',
		'vname' => 'LBL_PASSWORD',
		'type' => 'varchar',
		'massupdate' => 0,
		'comments' => '',
		'help' => '',
		'importable' => 'true',
		'duplicate_merge' => 'disabled',
		'duplicate_merge_dom_value' => '0',
		'audited' => false,
		'reportable' => true,
		'len' => '15',
		'size' => '20',
);


// created: 2012-01-10 11:49:05
$dictionary["Account"]["fields"]["trade_trademark_accounts"] = array (
  'name' => 'trade_trademark_accounts',
  'type' => 'link',
  'relationship' => 'trade_trademark_accounts',
  'source' => 'non-db',
  'side' => 'right',
  'vname' => 'LBL_TRADE_TRADEMARK_ACCOUNTS_FROM_TRADE_TRADEMARK_TITLE',
);


// created: 2012-06-18
//Anuradha
$dictionary["Account"]["fields"]["zohoid"] = array (
        'required' => false,
		'name' => 'zohoid',
		'vname' => 'LBL_ZOHOID',
		'type' => 'varchar',
		'massupdate' => 0,
		'comments' => '',
		'help' => '',
		'importable' => 'true',
		'duplicate_merge' => 'disabled',
		'duplicate_merge_dom_value' => '0',
		'audited' => false,
		'reportable' => true,
		'len' => '45',
		'size' => '45',
);
$dictionary["Account"]["fields"]["mobile"] = array (
        'required' => false,
		'name' => 'mobile',
		'vname' => 'LBL_MOBILE',
		'type' => 'varchar',
		'massupdate' => 0,
		'comments' => '',
		'help' => '',
		'importable' => 'true',
		'duplicate_merge' => 'disabled',
		'duplicate_merge_dom_value' => '0',
		'audited' => false,
		'reportable' => true,
		'len' => '100',
		'size' => '100',
);

// created: 2011-12-05 07:28:05
$dictionary["Account"]["fields"]["inv_inventions_accounts"] = array (
  'name' => 'inv_inventions_accounts',
  'type' => 'link',
  'relationship' => 'inv_inventions_accounts',
  'source' => 'non-db',
  'side' => 'right',
  'vname' => 'LBL_INV_INVENTIONS_ACCOUNTS_FROM_INV_INVENTIONS_TITLE',
);


// created: 2012-07-06
//Anuradha

$dictionary['Account']['unified_search'] = true;
$dictionary['Account']['unified_search_default_enabled'] = true;



$dictionary['Account']['fields']['phone_alternate']['unified_search'] = true;
$dictionary['Account']['fields']['mobile']['unified_search'] = true;

?>