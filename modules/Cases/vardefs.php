<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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


$dictionary['Case'] = array('table' => 'cases','audited'=>true, 'unified_search' => true, 'unified_search_default_enabled' => true, 'duplicate_merge'=>true,
		'comment' => 'Cases are issues or problems that a customer asks a support representative to resolve'
                               ,'fields' => array (

/******************** Author : Basudeba Rath, Date: 25-May-2012. *******************************/

 'modified_status' => 
    array (
      'name' => 'modified_status',
      'vname' => 'LBL_MODIFIED_STATUS',
      'type' => 'datetime',
      'comment' => 'case Status last modified date',
    ),

 'case_type_title' => 
    array (
      'name' => 'case_type_title',
      'vname' => 'LBL_CASE_TYPE_TITLE',
      'type' => 'varchar',
      'len' => 255,
      'required' => false,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),	

/******************** Author : Basudeba Rath, Date: 07-May-2012. *******************************/
 
'user_name' =>
  array (
    'name' => 'user_name',
    'rname' => 'name',
    'id_name' => 'client_consultant_id',
    'vname' => 'LBL_USER_NAME',
    'type' => 'relate',
    'link'=>'usercs', //by anuradha 20/8/2012
    'table' => 'users',
    'join_name'=>'users',
    'isnull' => 'true',
    'module' => 'Users',
    'dbType' => 'varchar',
    'len' => 100,
    'source'=>'non-db',
    'unified_search' => true,
    'comment' => 'The name of the Users represented by the client_consultant field',
    'required' => true,
    'importable' => 'required',
  ),

   'patent_number' => 
    array (
      'name' => 'patent_number',
      'vname' => 'LBL_PATENT_NUMBER',
      'type' => 'varchar',
      'len' => 255,
      'required' => false,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),	

   'client_consultant_id'=>
    array(
    'required' => false,
    'name' => 'client_consultant_id',
    'vname' => 'LBL_CLIENT_CONSULTANT_ID',
    'type' => 'char',
    'massupdate' => 0,
    'comments' => 'Parent clients assigned user id',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 36,
    'size' => '36',
  	),
	 
  'client_consultant_name' =>
  array (
    'name' => 'client_consultant_name',
    'rname' => 'name',
    'id_name' => 'client_consultant_id',
    'vname' => 'LBL_CLIENT_CONSULTANT_NAME',
    'type' => 'relate',
    'link'=>'Users',
    'table' => 'users',
    //'join_name'=>'Users',
    'isnull' => 'true',
    'module' => 'Users',
    'dbType' => 'varchar',
    'len' => 100,
    'source'=>'non-db',
    'unified_search' => true,
    'comment' => 'The name of the assigned user id of client represented by the client_consultant_id field',
    'required' => false,
    'importable' => 'required',
  ),
                                   
/************************************************************************************************/
        /*
         * Rajesh G - 20/06/12
         */
        /*'casesfilter' =>
        array(
            'required' => false,
            'name' => 'casesfilter',
            'source' => 'non-db',
            'vname' => '',
            'type' => 'enum',
            'massupdate' => 0,
            'default' => '',
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => true,
            'calculated' => false,
            'len' => 100,
            'size' => '20',
            'options' => 'cases_filter_dom',
            'studio' => 'visible',
            'dependency' => false,
        ),*/
                                   
        /* ********************* *
           * Rajesh G - 24/07/2012
           * Employee filter
           * ********************* */                         
         /*'viewasfilter' =>
        array(
            'required' => false,
            'name' => 'viewasfilter',
            'source' => 'non-db',
            'vname' => '',
            'type' => 'enum',
            'massupdate' => 0,
            'default' => '',
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => true,
            'calculated' => false,
            'len' => 100,
            'size' => '20',
            'studio' => 'visible',
            'dependency' => false,
        ),   */                           
                                   
/************************Author : Basudeba Rath. date: 25-01-2012********************************/
	
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
	//Phaneendra
	'prioritydate' => 
    array (
      'name' => 'prioritydate',
      'vname' => 'LBL_PRIORITYDATE',
      'type' => 'date',
      'default' => '',	
      'comment' => 'case record Priority Date',
    ), 
	//End

   'patent_publication_number' => 
    array (
      'name' => 'patent_publication_number',
      'vname' => 'LBL_PATENT_PUBLICATION_NUMBER',
      'type' => 'int',
      //'len' => 255,
      'required' => true,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),
	 'patent_issued_number' => 
    array (
      'name' => 'patent_issued_number',
      'vname' => 'LBL_PATENT_ISSUED_NUMBER',
      'type' => 'varchar',
      'len' => 255,
      'required' => true,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),	
 
	 'tm_filing_date' => 
	  array (
		//'required' => '1',
		'name' => 'tm_filing_date',
		'vname' => 'LBL_TM_FILING_DATE',
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
	  
	'tm_application_number' => 
    array (
      'name' => 'tm_application_number',
      'vname' => 'LBL_TM_APPLICATION_NUMBER',
      'type' => 'varchar', //by anuradha 20/8/2012
      'len' => 255,
      //'required' => true,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),
	 'tm_registration_date' => 
	  array (
		//'required' => '1',
		'name' => 'tm_registration_date',
		'vname' => 'LBL_TM_REGISTRATION_DATE',
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
	  'tm_registration_number' => 
    array (
      'name' => 'tm_registration_number',
      'vname' => 'LBL_TM_REGISTRATION_NUMBER',
      'type' => 'varchar', //by anuradha 20/8/2012
      'len' => 255,
      //'required' => true,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),
	  'tm_classes' => 
	  array (
		'required' => false,
		'name' => 'tm_classes',
		'vname' => 'LBL_TM_CLASSES',
		'type' => 'multienum',
		//'function' => array('name' => 'getUserList',),
		'massupdate' => '0',
		//'default' => '^Hi^',
		'comments' => '',
		'help' => '',
		'importable' => 'true',
		'duplicate_merge' => 'disabled',
		'duplicate_merge_dom_value' => '0',
		'audited' => true,
		'reportable' => true,
		'size' => '20',
		'options' => 'tm_classes_list',
		'studio' => 'visible',
		'isMultiSelect' => true,
	  ),
	
	// Date : 31-Jan-2012.
	
	'case_status_age' => 
    array (
      'name' => 'case_status_age',
      'vname' => 'LBL_CASE_STATUS_AGE',
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
/*********************************************************************************/	
      // by swapna .dt:-30-03-2012.
  //start
    'spec_writing_call' => 
  array (
    'required' => false,
    'name' => 'spec_writing_call',
    'vname' => 'LBL_SPEC_WRITING_CALL',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 255,
    'size' => '20',
   // 'options' => 'status_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
    'patent_drawing_fee' => 
  array (
    'required' => false,
    'name' => 'patent_drawing_fee',
    'vname' => 'LBL_PATENT_DRAWING_FEE',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 255,
    'size' => '20',
   // 'options' => 'status_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
//end.


/*********Author : Ashok date: 07-01-2012*****************************************/

'caseoverride'=> array (
'name' => 'caseoverride',
'vname' => 'LBL_CASEOVER',
'type' => 'bool',
'default' => '0',
'massupdate' => false,
'comment' => 'custom field checkbox',
),
/*************************************************************************************/

/****************************************************************************

Author : Basudeba Rath
Date : 29-Nov-2011
Veon Consulting pvt ltd.

****************************************************************************/
	'case_number' => 
    array (
      'name' => 'case_number',
      'vname' => 'LBL_NUMBER',
      'type' => 'varchar',
      'len' => 255,
      'required' => true,
      'audited'=>true,
      'auto_increment' => false,
      'comment' => 'Visual unique identifier',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),
	
	
	'casetype' =>
  array (
    'name' => 'casetype',
    'rname' => 'name',
    'id_name' => 'type',
    'vname' => 'LBL_CASE_TYPE',
    'type' => 'relate',
    'link'=>'case',
    'table' => 'c_case_type',
    'join_name'=>'c_case_type',
    'isnull' => 'true',
    'audited'=>true,
    'module' => 'c_case_type',
    'dbType' => 'varchar',
    'len' => 100,
    'source'=>'non-db',
    'unified_search' => true,
    'comment' => 'The name of the invention represented by the type field',
    'required' => true,
    'importable' => 'required',
  ), 
	
	  'type_name' =>
  array (
    'name' => 'type_name',
    'rname' => 'name',
    'id_name' => 'type',
    'vname' => 'LBL_TYPE',
    'type' => 'relate',
    'link'=>'c_case_type',
    'table' => 'c_case_type',
    'join_name'=>'c_case_type',
    'isnull' => 'true',
    'module' => 'c_case_type',
    'dbType' => 'varchar',
    'len' => 100,
    'source'=>'non-db',
    'unified_search' => true,
    'comment' => 'The name of the case type represented by the type field',
    'required' => true,
    'importable' => 'required',
  ),
	 'type' => 
    array (
      'name' => 'type',
      'vname' => 'LBL_TYPE',
      'type' => 'char',
      //'options' => 'case_type_dom',
      'len' => 36,
      'comment' => 'The type of issue (ex: issue, feature)',
	  'required' => true,
      'merge_filter' => 'enabled',
    ),
   
     'status' =>
    array (
		'name' => 'status',
		'vname' => 'LBL_STATUS',
		'type' => 'char',
		'len' => 36,
		'audited'=>true,
		'comment' => 'The status id of the case status',
		'required' => false,
     	'merge_filter' => 'enabled',	
	 ),
	 'status_name' =>
  array (
    'name' => 'status_name',
    'rname' => 'name',
    'id_name' => 'status',
    'vname' => 'LBL_STATUS',
    'type' => 'relate',
    'link'=>'c_case_status',
    'table' => 'c_case_status',
    'join_name'=>'c_case_status',
    'isnull' => 'true',
    'module' => 'c_case_status',
    'dbType' => 'varchar',
    'len' => 100,
    'source'=>'non-db',
    'unified_search' => true,
    'comment' => 'The name of the case status represented by the status field',
    'required' => true,
    'importable' => 'required',
  ),
 //by anuradha 20/8/2012
  'casestatus' =>
  array (
    'name' => 'casestatus',
    'rname' => 'name',
    'id_name' => 'status',
    'vname' => 'LBL_STATUS',
    'type' => 'relate',
    'link'=>'casest',
    'table' => 'c_case_status',
    'join_name'=>'c_case_status',
    'isnull' => 'true',
    'module' => 'c_case_status',
    'dbType' => 'varchar',
    'len' => 100,
    'source'=>'non-db',
    'unified_search' => true,
    'comment' => 'The name of the case status represented by the status field',
    'required' => true,
    'importable' => 'required',
  ),
  //end 
/*

Author : PHANEENDRA
Date : 17-DEC-2011

*/
   'invention' =>
  array (
    'name' => 'invention',
    'rname' => 'name',
    'id_name' => 'invention_id',
    'vname' => 'LBL_INVENTION_NAME',
    'type' => 'relate',
    'link'=>'inventions',
    'table' => 'inv_inventions',
    'join_name'=>'inv_inventions',
    'isnull' => 'true',
    'module' => 'Inv_Inventions',
    'dbType' => 'varchar',
    'len' => 100,
    'source'=>'non-db',
    'unified_search' => true,
    'comment' => 'The name of the invention represented by the invention_id field',
    'required' => true,
    'importable' => 'required',
  ),
  
  
  
   'invention_id'=>
    array(
    'required' => false,
    'name' => 'invention_id',
    'vname' => 'LBL_INVENTION_NAME',
    'type' => 'char',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'len' => 36,
    'size' => '36',
  	),
  'invention_name' =>
  array (
    'name' => 'invention_name',
    'rname' => 'name',
    'id_name' => 'invention_id',
    'vname' => 'LBL_INVENTION_NAME',
    'type' => 'relate',
    'link'=>'inv_inventions',
    'table' => 'inv_inventions',
    'join_name'=>'Inv_Inventions',
    'isnull' => 'true',
    'module' => 'Inv_Inventions',
    'dbType' => 'varchar',
    'len' => 100,
    'source'=>'non-db',
    'unified_search' => true,
    'comment' => 'The name of the case type represented by the type field',
    'required' => false,
    'importable' => 'required',
  ),
	
	 'search_type' => 
    array (
      'name' => 'search_type',
      'vname' => 'LBL_SEARCH_TYPE',
      'type' => 'enum',
      'options' => 'case_search_type_dom',
      'len' => 100,
      'comment' => 'addtinal dropdown field for Search-Patent',
	  'required' => false,
      'merge_filter' => 'enabled',
    ),
	'due_date' => 
  array (
    
    'name' => 'due_date',
    'vname' => 'LBL_DUE_DATE',
    'type' => 'date',
    'required' => false,// Changed on : 23-May-2012.
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => 0,
    'reportable' => 0,
    'display_default' => '',
  ),
	
	'filing_date' => 
  array (
    //'required' => '1',
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
      'type' => 'varchar',//by anuradha 20/8/2012
      'len' => 255,
      //'required' => true,
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
      'required' => false,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),

       'assigned_to' => 
  array (
    'required' => false,
    'name' => 'assigned_to',
    'vname' => 'LBL_ASSIGNED_TO',
    'type' => 'multienum',
    'function' => array('name' => 'getUserList',),
    'massupdate' => '0',
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'size' => '20',
    //'options' => 'multi_select_test_list',
    'studio' => 'visible',
    'isMultiSelect' => true,
  ),
  
  // Date : 04-Jan-2012.
  // Author : Basudeba Rath.
	
   'credit_date' => 
  array (
   
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

  ),
  
  // Date : 04-Jan-2012.
  
 'credit_alloc_notes' =>
  array (
    'name' => 'credit_alloc_notes',
    'vname' => 'LBL_ALLOC_NOTES',
    'type' => 'text',
    'comment' => 'For credit allcoation notes of the case'
  ),

/***************************************************************************/


   'account_name' =>
  array (
    'name' => 'account_name',
    'rname' => 'name',
    'id_name' => 'account_id',
    'vname' => 'LBL_ACCOUNT_NAME',
    'type' => 'relate',
    'link'=>'accounts',
    'table' => 'accounts',
    'join_name'=>'accounts',
    'isnull' => 'true',
    'module' => 'Accounts',
    'dbType' => 'varchar',
    'len' => 100,
    'source'=>'non-db',
    'unified_search' => true,
    'comment' => 'The name of the account represented by the account_id field',
    'required' => true,
    'importable' => 'required',
  ),
   'account_name1' =>
  array (
    'name' => 'account_name1',
    'source'=>'non-db',
    'type'=>'text',
    'len' => 100,
    'importable' => 'false',
  ),

    'account_id'=>
  	array(
  	'name'=>'account_id',
  	'type' => 'relate',
  	'dbType' => 'id',
  	'rname' => 'id',
    'module' => 'Accounts',
    'id_name' => 'account_id',
    'reportable'=>false,
  	'vname'=>'LBL_ACCOUNT_ID',
  	'audited'=>true,
  	'massupdate' => false,
  	'comment' => 'The account to which the case is associated'
  	),

  /*'status' =>
  array (
    'name' => 'status',
    'vname' => 'LBL_STATUS',
    'type' => 'enum',
    'options' => 'case_status_dom',
    'len' => 100,
    'audited'=>true,
    'comment' => 'The status of the case',

  ),*/
   'priority' =>
  array (
    'name' => 'priority',
    'vname' => 'LBL_PRIORITY',
    'type' => 'enum',
    'options' => 'case_priority_dom',
    'len' => 100,
    'audited'=>true,
    'comment' => 'The priority of the case',

  ),
  'resolution' =>
  array (
    'name' => 'resolution',
    'vname' => 'LBL_RESOLUTION',
    'type' => 'text',
    'comment' => 'The resolution of the case'
  ),


  'tasks' =>
  array (
  	'name' => 'tasks',
    'type' => 'link',
    'relationship' => 'case_tasks',
    'source'=>'non-db',
		'vname'=>'LBL_TASKS',
  ),
  'notes' =>
  array (
  	'name' => 'notes',
    'type' => 'link',
    'relationship' => 'case_notes',
    'source'=>'non-db',
		'vname'=>'LBL_NOTES',
  ),
  'meetings' =>
  array (
  	'name' => 'meetings',
    'type' => 'link',
    'relationship' => 'case_meetings',
    'bean_name'=>'Meeting',
    'source'=>'non-db',
		'vname'=>'LBL_MEETINGS',
  ),
  'emails' =>
  array (
  	'name' => 'emails',
    'type' => 'link',
    'relationship' => 'emails_cases_rel',/* reldef in emails */
    'source'=>'non-db',
		'vname'=>'LBL_EMAILS',
  ),
  'documents'=>
  array (
      'name' => 'documents',
      'type' => 'link',
      'relationship' => 'documents_cases',
      'source' => 'non-db',
      'vname' => 'LBL_DOCUMENTS_SUBPANEL_TITLE',
  ),
  'calls' =>
  array (
  	'name' => 'calls',
    'type' => 'link',
    'relationship' => 'case_calls',
    'source'=>'non-db',
		'vname'=>'LBL_CALLS',
  ),
  'bugs' =>
  array (
  	'name' => 'bugs',
    'type' => 'link',
    'relationship' => 'cases_bugs',
    'source'=>'non-db',
		'vname'=>'LBL_BUGS',
  ),
  'contacts' =>
  array (
  	'name' => 'contacts',
    'type' => 'link',
    'relationship' => 'contacts_cases',
    'source'=>'non-db',
		'vname'=>'LBL_CONTACTS',
  ),
  //anuradha on 19-01-2012
  'relatedtoparent' => 
    array (
      'name' => 'relatedtoparent',
      'vname' => 'LBL_RELATED_TO_PARENT',
      'type' => 'enum',      
      'options' => 'relatedtoparent_list',
      'len' => 100,
      'comment' => 'addtinal dropdown field for relatedtoparent',
     // 'required' => true,
      'merge_filter' => 'enabled',
    ),
  
  
  
  /****************************************************************************

Author : PHANEENDRA
Date : 17-DEC-2011
Veon Consulting pvt ltd.

****************************************************************************/
  
   'inventions' =>
  array (
  	'name' => 'inventions',
    'type' => 'link',
    'relationship' => 'invention_cases',
		'link_type'=>'one',
		'side'=>'right',
    'source'=>'non-db',
		'vname'=>'LBL_INVENTION',
  ),
    'case' =>
  array (
  	'name' => 'case',
    'type' => 'link',
    'relationship' => 'ccasetype_cases',
		'link_type'=>'one',
		'side'=>'right',
    'source'=>'non-db',
		'vname'=>'LBL_CASE',
  ),
  
  //by anuradha 20/8/2012
  'casest' =>
  array (
  	'name' => 'casest',
    'type' => 'link',
    'relationship' => 'ccasestatus_cases',
	'link_type'=>'one',
	'side'=>'right',
    'source'=>'non-db',
	'vname'=>'LBL_CASE',
  ),
  'usercs' =>
  array (
  	'name' => 'usercs',
    'type' => 'link',
    'relationship' => 'parent_consultant',
	'link_type'=>'one',
	'side'=>'right',
    'source'=>'non-db',
	'vname'=>'LBL_CASE',
  ),  
  //end  
  
  
  
  
  'accounts' =>
  array (
  	'name' => 'accounts',
    'type' => 'link',
    'relationship' => 'account_cases',
		'link_type'=>'one',
		'side'=>'right',
    'source'=>'non-db',
		'vname'=>'LBL_ACCOUNT',
  ),
	'project' =>
	array (
	    'name' => 'project',
	    'type' => 'link',
	    'relationship' => 'projects_cases',
	    'source'=>'non-db',
	    'vname'=>'LBL_PROJECTS',
	),

  ), 'indices' => array (
       array('name' =>'case_number' , 'type'=>'index' , 'fields'=>array('case_number')),

       array('name' =>'idx_case_name', 'type' =>'index', 'fields'=>array('name')),
       array( 'name' => 'idx_account_id', 'type' => 'index', 'fields'=> array('account_id')),
       array('name' => 'idx_cases_stat_del', 'type' => 'index', 'fields'=> array('assigned_user_id', 'status', 'deleted')),
                                                      )

, 'relationships' => array (
	'case_calls' => array('lhs_module'=> 'Cases', 'lhs_table'=> 'cases', 'lhs_key' => 'id',
							  'rhs_module'=> 'Calls', 'rhs_table'=> 'calls', 'rhs_key' => 'parent_id',
							  'relationship_type'=>'one-to-many', 'relationship_role_column'=>'parent_type',
							  'relationship_role_column_value'=>'Cases')

	,'case_tasks' => array('lhs_module'=> 'Cases', 'lhs_table'=> 'cases', 'lhs_key' => 'id',
							  'rhs_module'=> 'Tasks', 'rhs_table'=> 'tasks', 'rhs_key' => 'parent_id',
							  'relationship_type'=>'one-to-many', 'relationship_role_column'=>'parent_type',
							  'relationship_role_column_value'=>'Cases')

	,'case_notes' => array('lhs_module'=> 'Cases', 'lhs_table'=> 'cases', 'lhs_key' => 'id',
							  'rhs_module'=> 'Notes', 'rhs_table'=> 'notes', 'rhs_key' => 'parent_id',
							  'relationship_type'=>'one-to-many', 'relationship_role_column'=>'parent_type',
							  'relationship_role_column_value'=>'Cases')

	,'case_meetings' => array('lhs_module'=> 'Cases', 'lhs_table'=> 'cases', 'lhs_key' => 'id',
							  'rhs_module'=> 'Meetings', 'rhs_table'=> 'meetings', 'rhs_key' => 'parent_id',
							  'relationship_type'=>'one-to-many', 'relationship_role_column'=>'parent_type',
							  'relationship_role_column_value'=>'Cases')

	,'case_emails' => array('lhs_module'=> 'Cases', 'lhs_table'=> 'cases', 'lhs_key' => 'id',
							  'rhs_module'=> 'Emails', 'rhs_table'=> 'emails', 'rhs_key' => 'parent_id',
							  'relationship_type'=>'one-to-many', 'relationship_role_column'=>'parent_type',
							  'relationship_role_column_value'=>'Cases')
    ,
   'cases_assigned_user' =>
   array('lhs_module'=> 'Users', 'lhs_table'=> 'users', 'lhs_key' => 'id',
   'rhs_module'=> 'Cases', 'rhs_table'=> 'cases', 'rhs_key' => 'assigned_user_id',
   'relationship_type'=>'one-to-many')

   ,'cases_modified_user' =>
   array('lhs_module'=> 'Users', 'lhs_table'=> 'users', 'lhs_key' => 'id',
   'rhs_module'=> 'Cases', 'rhs_table'=> 'cases', 'rhs_key' => 'modified_user_id',
   'relationship_type'=>'one-to-many')

   ,'cases_created_by' =>
   array('lhs_module'=> 'Users', 'lhs_table'=> 'users', 'lhs_key' => 'id',
   'rhs_module'=> 'Cases', 'rhs_table'=> 'cases', 'rhs_key' => 'created_by',
   'relationship_type'=>'one-to-many')
   
   
   /****************************************************************************

Author : PHANEENDRA
Date : 17-DEC-2011
Veon Consulting pvt ltd.

****************************************************************************/
   
   ,'invention_cases' => array('lhs_module'=> 'Inv_Inventions', 'lhs_table'=> 'inv_inventions', 'lhs_key' => 'id',
                              'rhs_module'=> 'Cases', 'rhs_table'=> 'cases', 'rhs_key' => 'invention_id',
                              'relationship_type'=>'one-to-many')
   ,'ccasetype_cases' => array('lhs_module'=> 'c_case_type', 'lhs_table'=> 'c_case_type', 'lhs_key' => 'id',
                              'rhs_module'=> 'Cases', 'rhs_table'=> 'cases', 'rhs_key' => 'type',
                              'relationship_type'=>'one-to-many')
//by anuradha 20/8/2012							  
   ,'ccasestatus_cases' => array('lhs_module'=> 'c_case_status', 'lhs_table'=> 'c_case_status', 'lhs_key' => 'id',
                              'rhs_module'=> 'Cases', 'rhs_table'=> 'cases', 'rhs_key' => 'status',
                              'relationship_type'=>'one-to-many')
   ,'parent_consultant' => array('lhs_module'=> 'Users', 'lhs_table'=> 'users', 'lhs_key' => 'id',
                              'rhs_module'=> 'Cases', 'rhs_table'=> 'cases', 'rhs_key' => 'client_consultant_id',
                              'relationship_type'=>'one-to-many')
	
//end							  
							  
   
   
)
//This enables optimistic locking for Saves From EditView
	,'optimistic_locking'=>true,
);
VardefManager::createVardef('Cases','Case', array('default', 'assignable',
'issue',
),
'case'
);

//jc - adding for refactor for import to not use the required_fields array
//defined in the field_arrays.php file
$dictionary['Case']['fields']['name']['importable'] = 'required';
?>