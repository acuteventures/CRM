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

class FlaggedCasesAndSubcasesDashlet extends DashletGeneric {

	function FlaggedCasesAndSubcasesDashlet($id, $def = null) {
	
        global $current_user, $app_strings;
		
		require('modules/c_s_d_case_subcase_dashlet/Dashlets/FlaggedCasesAndSubcasesDashlet/FlaggedCasesAndSubcasesDashlet.data.php');
		
        parent::DashletGeneric($id, $def);
        
        if(empty($def['title'])) $this->title = translate('LBL_FLAGGED_CASES_AND_SUBCASES', 'c_s_d_case_subcase_dashlet');
        $this->searchFields = $dashletData['FlaggedCasesAndSubcasesDashlet']['searchFields'];
        $this->columns = $dashletData['FlaggedCasesAndSubcasesDashlet']['columns'];
        $this->seedBean = new c_s_d_case_subcase_dashlet();        
    }
	
	function process($lvsParams3 = array()) {
    	
		global $db, $current_user;
		$this->myItemsOnly = false;
		
		$lvsParams3 = array(
		
						'custom_from' => ' INNER JOIN fc_flag_cases ON fc_flag_cases.case_id = c_s_d_case_subcase_dashlet.case_subcase_id ',
						//if my flagged cases
            			'custom_where' => ' AND fc_flag_cases.flagged_user_id = "'.$current_user->id.'" AND c_s_d_case_subcase_dashlet.deleted = "0" AND fc_flag_cases.deleted = "0" ',
						//if all flagged cases
						//'custom_where' => ' AND c_s_d_case_subcase_dashlet.deleted = "0" AND fc_flag_cases.deleted = "0" ',
			
						'distinct' => true							
		); 
		/*echo "<pre>";
		print_r($lvsParams3);
		exit;*/
		parent::process($lvsParams3);	
    }
  }

?>
