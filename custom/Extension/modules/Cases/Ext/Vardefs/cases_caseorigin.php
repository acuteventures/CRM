<?php
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
?>