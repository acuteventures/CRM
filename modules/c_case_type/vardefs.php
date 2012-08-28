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

/*********************************************************************************

* Author : Basudeba Rath
* Date : 18-Jan-2011
* Veon Consulting Pvt Ltd.

 ********************************************************************************/

$dictionary['c_case_type'] = array(
	'table'=>'c_case_type',
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
//Author : Basudeba Rath.
//Date : 19-Jan-2012.
		  'case_type_code' => 
			  array (
				'required' => false,
				'name' => 'case_type_code',
				'vname' => 'LBL_CASE_TYPE_CODE',
				'type' => 'varchar',
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
 // Date : 20-Jan-2012.
			  
			  'relatedtoparent' => 
			array (
			  'name' => 'relatedtoparent',
			  'vname' => 'LBL_RELATED_TO_PARENT',
			  'type' => 'enum',
			  'options' => 'relatedtoparent_list',
			  'len' => 100,
			  'comment' => 'Related to parent (Invention or Trademark)',
			  'required' => false,
			  'merge_filter' => 'enabled',
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
VardefManager::createVardef('c_case_type','c_case_type', array('basic','assignable'));