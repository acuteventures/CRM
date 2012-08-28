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
 * ****************************************************************************** */


require_once('include/Dashlets/DashletGeneric.php');

class MyCasesAndSubcasesInProgressDashlet extends DashletGeneric {

	function MyCasesAndSubcasesInProgressDashlet($id, $def = null) {
	
        global $current_user, $app_strings;
		
		require('modules/c_s_d_case_subcase_dashlet/Dashlets/MyCasesAndSubcasesInProgressDashlet/MyCasesAndSubcasesInProgressDashlet.data.php');
		
        parent::DashletGeneric($id, $def);
        
        if(empty($def['title'])) $this->title = translate('LBL_MY_CASES_SUBCASES_IN_PROGRESS', 'c_s_d_case_subcase_dashlet');
        $this->searchFields = $dashletData['MyCasesAndSubcasesInProgressDashlet']['searchFields'];
        $this->columns = $dashletData['MyCasesAndSubcasesInProgressDashlet']['columns'];
        $this->seedBean = new c_s_d_case_subcase_dashlet();        
    }
	
	function process($lvsParams3 = array()) {
    	
		global $db, $current_user;
		
		
		$lvsParams3 = array(
		
						//'custom_select' => ', c_s_d_case_subcase_dashlet.invention_id ',  
						
						//'custom_select' => ', c_s_d_case_subcase_dashlet.invention_id, c_s_d_case_subcase_dashlet.client_consultant_id, concat(users.first_name," ",users.last_name) as user_name,   c_s_d_case_subcase_dashlet.status, inv_inventions.name AS invention_name, c_case_type.name AS type_name, c_case_status.name AS status_name,c_s_d_case_subcase_dashlet.due_date ', 
						
						
						//'custom_from' => ' LEFT JOIN inv_inventions  ON inv_inventions.id = c_s_d_case_subcase_dashlet.invention_id LEFT JOIN c_case_type ON c_s_d_case_subcase_dashlet.type = c_case_type.id  LEFT JOIN c_case_status ON c_s_d_case_subcase_dashlet.status = c_case_status.id LEFT JOIN users ON users.id = c_s_d_case_subcase_dashlet.client_consultant_id ', 
					    //'custom_where' => ' AND c_case_status.action_no = "3" AND c_s_d_case_subcase_dashlet.deleted =  "0" ',
						
						'custom_where' => ' AND jt4.assigned_user_id = "'.$current_user->id.'" AND jt3.action_no = "3" AND c_s_d_case_subcase_dashlet.deleted =  "0" ',
									
						'distinct' => true							
		); 
		/*echo "<pre>";
		print_r($lvsParams3);
		exit;*/
		parent::process($lvsParams3);	
    }
  }

?>
