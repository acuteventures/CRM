<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2012-06-23
//Anuradha
$dictionary["Case"]["fields"]["case_origin"] = array (
        'required' => false,
		'name' => 'case_origin',
		'vname' => 'LBL_CASE_ORIGIN',
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
$dictionary["Case"]["fields"]["amount_paid"] = array (
        'required' => false,
		'name' => 'amount_paid',
		'vname' => 'LBL_AMOUNT_PAID',
		'type' => 'decimal',
		'massupdate' => 0,
		'comments' => '',
		'help' => '',
		'importable' => 'true',
		'duplicate_merge' => 'disabled',
		'duplicate_merge_dom_value' => '0',
		'audited' => false,
		'reportable' => true,
		'len' => '25',
		'size' => '25',
		'precision' => '2',
	);
$dictionary["Case"]["fields"]["qb_date"] = array (
        'required' => false,
		'name' => 'qb_date',
		'vname' => 'LBL_QB_DATE',
		'type' => 'date',
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

//Rajesh G - 23/07/12
$dictionary["Case"]["fields"]['date_case_status_modified'] =
  array (
    'name' => 'date_case_status_modified',
    'vname' => 'LBL_DATE_CASE_STATUS_MODIFIED',
    'type' => 'datetime',
  );
 //* preethi on 31-08-2012
//* Des : added new filed 
$dictionary["Case"]["fields"]['case_end_user_id'] = array(
    'required' => false,
    'name' => 'case_end_user_id',
    'vname' => 'LBL_CASE_END_USER_ID',
    'type' => 'char',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 36,
    'size' => '36',
);
$dictionary["Case"]["fields"]['case_end_user_name'] = array(
    'name' => 'case_end_user_name',
    'rname' => 'name',
    'id_name' => 'case_end_user_id',
    'vname' => 'LBL_CASE_END_USER_NAME',
    'type' => 'relate',
    'link'=>'Users',
    'table' => 'users',
    'isnull' => 'true',
    'module' => 'Users',
    'dbType' => 'varchar',
    'len' => 100,
    'source'=>'non-db',
    'unified_search' => true,
    'comment' => '',
    'required' => false,
    'importable' => 'required',
);
//* End


// created: 2011-12-23 08:57:43
$dictionary["Case"]["fields"]["oa_officeactions_cases"] = array (
  'name' => 'oa_officeactions_cases',
  'type' => 'link',
  'relationship' => 'oa_officeactions_cases',
  'source' => 'non-db',
  'side' => 'right',
  'vname' => 'LBL_OA_OFFICEACTIONS_CASES_FROM_OA_OFFICEACTIONS_TITLE',
);


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


// created: 2012-06-27
//Anuradha

$dictionary['Cases']['unified_search'] = true;
$dictionary['Cases']['unified_search_default_enabled'] = true;
//$dictionary['Cases']['fields']['name']['unified_search'] = true;


/*$dictionary['Case']['fields']['shop_id_c']['rname'] = 'shop_id_c';
$dictionary['Case']['fields']['shop_id_c']['vname'] = 'LBL_SHOP_ID_C';
$dictionary['Case']['fields']['shop_id_c']['type'] = 'relate';
$dictionary['Case']['fields']['shop_id_c']['dbType'] = 'int';
$dictionary['Case']['fields']['shop_id_c']['table'] = 'accounts_cstm';
$dictionary['Case']['fields']['shop_id_c']['unified_search'] = true;*/
//echo "dddddddddddddddddddddddd-anuradha";

$dictionary['Case']['fields']['name']['unified_search'] = true;

$dictionary['Case']['fields']['application_number']['unified_search'] = true;
$dictionary['Case']['fields']['tm_application_number']['unified_search'] = true;

$dictionary['Case']['fields']['tm_registration_number']['unified_search'] = true;
$dictionary['Case']['fields']['patent_number']['unified_search'] = true;

?>