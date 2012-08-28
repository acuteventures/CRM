<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2011-12-21 09:33:00
$dictionary["oa_officeactions"]["fields"]["oa_officeactions_cases"] = array (
  'name' => 'oa_officeactions_cases',
  'type' => 'link',
  'relationship' => 'oa_officeactions_cases',
  'source' => 'non-db',
  'vname' => 'LBL_OA_OFFICEACTIONS_CASES_FROM_CASES_TITLE',
  'id_name' => 'oa_officeactions_casescases_ida',
);
$dictionary["oa_officeactions"]["fields"]["oa_officeactions_cases_name"] = array (
  'name' => 'oa_officeactions_cases_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_OA_OFFICEACTIONS_CASES_FROM_CASES_TITLE',
  'save' => true,
  'id_name' => 'oa_officeactions_casescases_ida',
  'link' => 'oa_officeactions_cases',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
);
$dictionary["oa_officeactions"]["fields"]["oa_officeactions_casescases_ida"] = array (
  'name' => 'oa_officeactions_casescases_ida',
  'type' => 'link',
  'relationship' => 'oa_officeactions_cases',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_OA_OFFICEACTIONS_CASES_FROM_OA_OFFICEACTIONS_TITLE',
);


// created: 2012-08-23
//Anuradha
$dictionary["oa_officeactions"]["fields"]["amount_paid"] = array (
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
$dictionary["oa_officeactions"]["fields"]["qb_date"] = array (
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

$dictionary["oa_officeactions"]["fields"]["credit_date"] = array (   
    'name' => 'credit_date',
    'vname' => 'LBL_CREDIT_DATE',
    'type' => 'date',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'size' => '20',
    'enable_range_search' => false,
);


// created: 2012-08-22
//Anuradha
$dictionary["oa_officeactions"]["fields"]["subcaseoverride"] = array (
'name' => 'subcaseoverride',
'vname' => 'LBL_SUBCASE_OVERRIDE',
'type' => 'bool',
'default' => '0',
'massupdate' => false,
'comment' => 'custom field checkbox',
);

?>