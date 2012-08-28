<?php
/*********************************************************************************

* Author : Basudeba Rath
* Date : 19-Dec-2011
* Veon Consulting Pvt Ltd.

 ********************************************************************************/

$dictionary['c_case_status'] = array(
	'table'=>'c_case_status',
	'audited'=>true,
		'duplicate_merge'=>true,
		'fields'=>array (
		
   'display_order' => 
  array (
    'required' => false,
    'name' => 'display_order',
    'vname' => 'LBL_DISPLAY_ORDER',
    'type' => 'int',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'len' => '255',
    'size' => '20',
    'enable_range_search' => false,
    'disable_num_format' => '',
  ),
  
  'action_no' => 
  array (
    'required' => false,
    'name' => 'action_no',
    'vname' => 'LBL_ACTION_NO',
    'type' => 'int',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'len' => '255',
    'size' => '20',
    'enable_range_search' => false,
    'disable_num_format' => '',
  ),
  'order_no' => 
  array (
    'required' => false,
    'name' => 'order_no',
    'vname' => 'LBL_ORDER_NO',
    'type' => 'int',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'len' => '255',
    'size' => '20',
    'enable_range_search' => false,
    'disable_num_format' => '',
  ),
),
	'relationships'=>array (
),
	'optimistic_locking'=>true,
		'unified_search'=>true,
	);
if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('c_case_status','c_case_status', array('basic','assignable'));