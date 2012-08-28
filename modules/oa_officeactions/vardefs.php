<?php
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2011 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/

$dictionary['oa_officeactions'] = array(
	'table'=>'oa_officeactions',
	'audited'=>true,
		'duplicate_merge'=>true,
		'fields'=>array (

// Author : Basudeba Rath, Date : 10-May-2012. 

	// Date : 22-Jun-2012

  'modified_status' => 
    array (
      'name' => 'modified_status',
      'vname' => 'LBL_MODIFIED_STATUS',
      'type' => 'datetime',
      'comment' => 'sub case Status last modified date and time',
    ),

'visible_to_client' => 
  array (
    'name' => 'visible_to_client',
    'vname' => 'LBL_VISIBLE_TO_CLIENT',
    'type' => 'enum',
    'massupdate' => 0,
    'required' => true,
    'default' => '',
    'comments' => '',
    'help' => '',
    'importable' => 'false',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 100,
    'size' => '20',
    'options' => 'visible_to_client_list',
    'studio' => 'visible',
    'dbType' => 'enum',
   // 'separator' => '<br>',
  ),

// Author : Basudeba Rath, Date : 09-May-2012.
	
  'sub_case_title' => 
    array (
      'name' => 'sub_case_title',
      'vname' => 'LBL_SUBCASE_TITLE',
      'type' => 'varchar',
      'len' => 255,
      'required' => true,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'default' => '',
      'size' => '20',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),

  'duedate' => 
  array (
    'required' => false,
    'name' => 'duedate',
    'vname' => 'LBL_DUEDATE',
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
    //'display_default' => 'now',
  ),
  'officeactiontype' => 
  array (
    'required' => false,
    'name' => 'officeactiontype',
    'vname' => 'LBL_OFFICEACTIONTYPE',
    'type' => 'enum',
    'massupdate' => 0,
    'default' => 'OfficeAction1',
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'len' => 100,
    'size' => '20',
    'options' => 'OfficeActionType',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'extensionallowed' => 
  array (
    'required' => false,
    'name' => 'extensionallowed',
    'vname' => 'LBL_EXTENSIONALLOWED',
    'type' => 'enum',
    'massupdate' => 0,
    'default' => 'Yes',
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'len' => 100,
    'size' => '20',
    'options' => 'ExtensionAllowed',
    'studio' => 'visible',
    'dependency' => false,
  ),
  //start
  'subcase_status_id' => 
  array (
    'required' => true,
    'name' => 'subcase_status_id',
    'vname' => 'LBL_OFFICEACTIONSTATUS',
    'type' => 'id',
    'massupdate' => 0,
    'default' => '',
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'unified_search' => false,   
    //'options' => 'OfficeActionStatus',
    'studio' => 'visible',
    'dependency' => false,
  ),
   'subcase_status' =>
  array (
    'required' => true,
    'source'=>'non-db',
    'name' => 'subcase_status',
	'vname' => 'LBL_OFFICEACTIONSTATUS',
	'type' => 'relate',
	'massupdate' => 0,
    'comments' => '',
    'help' => '',	
    'id_name' => 'subcase_status_id',    
    'ext2' => 'c_case_status',
    'table' => 'c_case_status',
    'join_name'=>'c_case_status',
    'isnull' => 'true',
    'module' => 'c_case_status',
    'rname' => 'name',
    'len' => 100,
    'size' => 20,
    'unified_search' => true,    
    'importable' => 'required',
  ), 
  //end
  //by swapna 15-03-2012
  'subcase_status_age' => 
    array (
      'name' => 'subcase_status_age',
      'vname' => 'LBL_SUBCASE_STATUS_AGE',
      'type' => 'int',
      //'len' => 255,
      //'required' => true,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'default' => 0,
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),

'filing_date' => 
  array (
    'required' => false,
    'name' => 'filing_date',
    'vname' => 'LBL_FILING_DATE',
    'type' => 'date',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => 0,
    'reportable' => 0,
  ),
	'application_number' => 
    array (
      'name' => 'application_number',
      'vname' => 'LBL_APPLICATION_NUMBER',
      'type' => 'int',
      //'len' => 255,
	  'link' =>'true',
	  'required' => true,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),
	'freceipt' => 
    array (
      'name' => 'freceipt',
      'vname' => 'LBL_FILING_RECEIPT',
      'type' => 'int',
      'required' => true,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ), 
//by anuradha 13-01-2012
	//desc: adding new field subcase name dropdown	
    'subcase_name' => 
    array (
	  'name' => 'subcase_name',
      'vname' => 'LBL_SUBCASE_NAME',
      'type' => 'id',
	  'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => true,
      'reportable' => true,
      'len' => 36,
      'required' => true,
      'merge_filter' => 'enabled',
    ),
	
	 'subcase' =>
  array (
    'required' => true,
    'source'=>'non-db',
    'name' => 'subcase',
	'vname' => 'LBL_SUBCASE_NAME',
	'type' => 'relate',
	'massupdate' => 0,
    'comments' => '',
    'help' => '',	
    'id_name' => 'subcase_name',    
    'ext2' => 'sc_sc_subcasetype',
    'table' => 'sc_sc_subcasetype',
    'join_name'=>'sc_sc_subcasetype',
    'isnull' => 'true',
    'module' => 'sc_sc_subcasetype',
    'rname' => 'name',
    'len' => 100,
    'size' => 20,
    'unified_search' => true,    
    'importable' => 'required',
  ),	
  'name' => 
    array (
      'name' => 'name',
      'vname' => 'LBL_NAME',
      'type' => 'name',
      'link' => true,
      'dbType' => 'varchar',
      'len' => 255,
      'unified_search' => true,
      'required' => false,
	  'audited' => true,
      'importable' => 'required',
      'duplicate_merge' => 'enabled',
      'merge_filter' => 'selected',
    ),
	'subcase_number' => 
    array (
      'name' => 'subcase_number',
      'vname' => 'LBL_SUBCASE_NUMBER',
      'type' => 'varchar',
      'len' => 255,
      'required' => false,
	  'audited' => true,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => 'Visual unique identifier',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),
	'amount_owed' =>
	array (
     'required' => false,
    'name' => 'amount_owed',
    'vname' => 'LBL_AMOUNT_OWED',
    'type' => 'decimal',
    'massupdate' => 0,
    'default' => '0.00',
    'comments' => '',
    'help' => '',
	'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'len' => '25',
    'size' => '25',
	'precision' => '2',
    ),
	 'case_start_date' => 
    array (
      'name' => 'case_start_date',
      'vname' => 'LBL_CASE_START_DATE',
      'type' => 'datetime',
      'comment' => 'case record started',
    ),
    'case_end_date' => 
    array (
      'name' => 'case_end_date',
      'vname' => 'LBL_CASE_END_DATE',
      'type' => 'datetime',
      'comment' => 'case record completion date',
    ),
	'credit_alloc_notes' =>
    array (
    'name' => 'credit_alloc_notes',
    'vname' => 'LBL_ALLOC_NOTES',
    'type' => 'text',
    'comment' => 'For credit allcoation notes of the case'
  ),
	//end	
),
	'relationships'=>array (
),
	'optimistic_locking'=>true,
		'unified_search'=>true,
	);
if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('oa_officeactions','oa_officeactions', array('basic','assignable'));