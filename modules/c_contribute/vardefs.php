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

// Author : Basudeba Rath.
// Veon Consulting Pvt. Ltd.


$dictionary['c_contribute'] = array(
	'table'=>'c_contribute',
	'audited'=>true,
		'duplicate_merge'=>true,
		'fields'=>array (

// Author : Basudeba Rath.
// Veon Consulting Pvt. Ltd.
// Date : 04-Jan-2012.
  
  'credits' =>
  array (
      'required' => true,
      'name' => 'credits',
      'vname' => 'LBL_CREDITS',
      'type' => 'decimal',
      'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'len' => '10',
      'size' => '20',
      'precision' => '1',
  ),	

  'login_id' => 
  array (
    'required' => false,
    'name' => 'login_id',
    'vname' => 'LBL_LOGIN_ID',
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
  ),
   'login_name' =>
  array (
    'name' => 'login_name',
    'rname' => 'name',
    'id_name' => 'login_id',
    'vname' => 'LBL_LOGIN_NAME',
    'type' => 'relate',
    'link'=>'Users',
    'table' => 'users',
    'join_name'=>'users',
    'isnull' => 'true',
    'module' => 'Users',
    'dbType' => 'varchar',
    'len' => 100,
    'source'=>'non-db',
    'unified_search' => true,
    'comment' => 'The name of the user represented by the login_id field',
    'required' => false,
    'importable' => 'required',
  ),
  'case_id' => 
  array (
    'required' => false,
    'name' => 'case_id',
    'vname' => 'LBL_CASE_ID',
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
VardefManager::createVardef('c_contribute','c_contribute', array('basic','assignable'));