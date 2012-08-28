<?php
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
