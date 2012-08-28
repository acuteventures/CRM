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
  'duedate' => 
  array (
    'required' => true,
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
    'display_default' => 'now',
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
  'officeactionstatus' => 
  array (
    'required' => true,
    'name' => 'officeactionstatus',
    'vname' => 'LBL_OFFICEACTIONSTATUS',
    'type' => 'enum',
    'massupdate' => 0,
    'default' => 'Received',
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
    'options' => 'OfficeActionStatus',
    'studio' => 'visible',
    'dependency' => false,
  ),
  /***************************************************************

Author : PHANEEENDRA
Date : 23-Dec-2011
Veon Consulting Pvt. Ltd.
***************************************************************/
  'filing_date' => 
  array (
    'required' => '1',
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