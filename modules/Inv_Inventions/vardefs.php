<?php
/*********************************************************************************
 * SugarCRM is a customer relationship management program developed by
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

$dictionary['Inv_Inventions'] = array(
	'table'=>'inv_inventions',
	'audited'=>true,
	'fields'=>array (
	
// By Basudeba Rath, Date : 01-Jun-2012.
	
   'total_patent_assigned' => 
  array (
    'required' => false,
    'name' => 'total_patent_assigned',
    'vname' => 'LBL_TOTAL_PATENT_ASSIGNED',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
	'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => '150',
    'size' => '150',
    'disable_num_format' => '',
  ), 
	
	'assignee_name' => 
  array (
    'required' => false,
    'name' => 'assignee_name',
    'vname' => 'LBL_ASSIGNEE_NAME',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
	'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => '150',
    'size' => '150',
    'disable_num_format' => '',
  ), 
   //by swapna 10-04-2011
	'assignment' => 
  array (
    'required' => false,
    'name' => 'assignment',
    'vname' => 'LBL_ASSIGNMENT',
    'type' => 'enum',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 100,
    'size' => '20',
    'studio' => 'visible',
    'dependency' => false,
  ),  
 
  
    // by swapna .dt:-29-03-2012.To store fax_docs value
  //start
    'fax_docs' => 
  array (
    'required' => false,
    'name' => 'fax_docs',
    'vname' => 'LBL_FAX_DOCS',
    'type' => 'enum',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 100,
    'size' => '20',
    //'options' => 'status_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
      'email_docs' => 
  array (
    'required' => false,
    'name' => 'email_docs',
    'vname' => 'LBL_EMAIL_DOCS',
    'type' => 'enum',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 100,
    'size' => '20',
    //'options' => 'status_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
//end

  // by swapna .dt:-03-04-2012.To store fax_docs value
  //start
    'non_profit_entity' => 
  array (
    'required' => false,
    'name' => 'non_profit_entity',
    'vname' => 'LBL_NON_PROFIT_ENTITY',
    'type' => 'enum',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 100,
    'size' => '20',
    'studio' => 'visible',
    'dependency' => false,
  ),
    'govt_inventions' => 
  array (
    'required' => false,
    'name' => 'govt_inventions',
    'vname' => 'LBL_GOVT_INVENTIONS',
    'type' => 'enum',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 100,
    'size' => '20',
    'studio' => 'visible',
    'dependency' => false,
  ),
//end

	'assignee_address1' => 
  array (
    'required' => false,
    'name' => 'assignee_address1',
    'vname' => 'LBL_ASSIGNEE_ADDRESS1',
    'type' => 'text',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
	'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'disable_num_format' => '',
  ),
'assignee_address2' => 
  array (
    'required' => false,
    'name' => 'assignee_address2',
    'vname' => 'LBL_ASSIGNEE_ADDRESS2',
    'type' => 'text',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
	'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'disable_num_format' => '',
  ),
	'assignee_city' =>
	array (
     'required' => false,
    'name' => 'assignee_city',
    'vname' => 'LBL_ASSIGNEE_CITY',
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
    'disable_num_format' => '',    
	),
	
 	'assignee_state' =>
	array (
     'required' => false,
    'name' => 'assignee_state',
    'vname' => 'LBL_ASSIGNEE_STATE',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
	'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => '150',
    'size' => '150',
    'disable_num_format' => '',    
	),
'assignee_zipcode' =>
	array (
     'required' => false,
    'name' => 'assignee_zipcode',
    'vname' => 'LBL_ASSIGNEE_ZIPCODE',
    'type' => 'int',
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
    'disable_num_format' => '',    
	),
'assignee_country' =>
	array (
     'required' => false,
    'name' => 'assignee_country',
    'vname' => 'LBL_ASSIGNEE_COUNTRY',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
	'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => '200',
    'size' => '200',
    'disable_num_format' => '',    
	),
'invention_entity_type' =>
	array (
     'required' => false,
    'name' => 'invention_entity_type',
    'vname' => 'LBL_ENTITY_TYPE',
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
    'disable_num_format' => '',    
	),
 // By Anuradha on 28-11-2011 
  // Des: Inventions and Accounts relationship
  /*'clients_alloted' =>
  array (
    'name' => 'clients_alloted',
    'type' => 'link',
    'relationship' => 'accounts_inventions',
    'module'=>'Accounts',
    'bean_name'=>'Accounts',
    'source'=>'non-db',
    'vname'=>'LBL_CLIENT_ID',
  ),*/
  
 /* 'accounts_inventions' =>
  array (
    'name' => 'accounts_inventions',
    'type' => 'link',
    'relationship' => 'accounts_inventions',
    'module'=>'Accounts',
    'bean_name'=>'Accounts',
    'source'=>'non-db',
    'vname'=>'LBL_CLIENT_ID',
  ),*/
 /* 'clients' =>
	array (
		'name' => 'clients',
		'type' => 'link',
		'relationship' => 'accounts_inventions',
		'link_type' => 'one',
		'source' => 'non-db',
		'vname' => 'LBL_ACCOUNT',
		'duplicate_merge'=> 'disabled',
	),*/
  //End   
/*  'inv_inventions_accounts_name' => array (
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
),
'inv_inventd1acccounts_ida' => array (
  'name' => 'inv_inventd1acccounts_ida',
  'type' => 'link',
  'relationship' => 'inv_inventions_accounts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_INV_INVENTIONS_ACCOUNTS_FROM_INV_INVENTIONS_TITLE',
),
'inv_inventions_accounts' => array (
  'name' => 'inv_inventions_accounts',
  'type' => 'link',
  'relationship' => 'inv_inventions_accounts',
  'source' => 'non-db',
  'vname' => 'LBL_INV_INVENTIONS_ACCOUNTS_FROM_ACCOUNTS_TITLE',
),*/


),
	'relationships'=>array (
),
	'optimistic_locking'=>true,
);
if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('Inv_Inventions','Inv_Inventions', array('basic','assignable'));