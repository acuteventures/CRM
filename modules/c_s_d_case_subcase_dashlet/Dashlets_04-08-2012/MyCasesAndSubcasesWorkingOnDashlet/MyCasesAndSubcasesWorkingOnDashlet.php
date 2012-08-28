<?php

if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');
/* * *******************************************************************************
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
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com. * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,

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
 * ****************************************************************************** */


require_once('include/Dashlets/DashletGeneric.php');

class MyCasesAndSubcasesWorkingOnDashlet extends DashletGeneric {

	function MyCasesAndSubcasesWorkingOnDashlet($id, $def = null) {
	
        global $current_user, $app_strings;
		
		require('modules/c_s_d_case_subcase_dashlet/Dashlets/MyCasesAndSubcasesWorkingOnDashlet/MyCasesAndSubcasesWorkingOnDashlet.data.php');
		
        parent::DashletGeneric($id, $def);
        
        if(empty($def['title'])) $this->title = translate('LBL_MY_CASES_AND_SUBCASES_WORKING_ON', 'c_s_d_case_subcase_dashlet');
        $this->searchFields = $dashletData['MyCasesAndSubcasesWorkingOnDashlet']['searchFields'];
        $this->columns = $dashletData['MyCasesAndSubcasesWorkingOnDashlet']['columns'];
        $this->seedBean = new c_s_d_case_subcase_dashlet();        
    }
	
	function process($lvsParams3 = array()) {
    	
		global $db, $current_user;
		
		$lvsParams3 = array(
						
						'custom_from' => ' INNER JOIN c_contribute ON c_contribute.case_id = c_s_d_case_subcase_dashlet.case_subcase_id ',
						'custom_where' => ' AND c_contribute.login_id = "'.$current_user->id.'" AND jt3.order_no <> "100" AND jt3.order_no <> "0" AND c_s_d_case_subcase_dashlet.deleted =  "0" AND c_contribute.deleted = "0"',
						
						'distinct' => true							
		); 
		/*echo "<pre>";
		print_r($lvsParams3);
		exit;*/
		parent::process($lvsParams3);	
    }
  }

?>
