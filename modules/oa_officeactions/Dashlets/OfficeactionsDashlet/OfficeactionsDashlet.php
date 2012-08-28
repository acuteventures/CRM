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

/*********************************************************************************

 * Description:  Defines the English language pack for the base application.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/


/*****************************************************************
 Author : Basudeba Rath.
 Dt. 30-Dec-2011.
 Veon Consulting Pvt. Ltd.
*****************************************************************/

require_once('include/Dashlets/DashletGeneric.php');
//require_once('modules/oa_officeactions/Dashlets/MyOfficeactionsDashlet.php');

class OfficeactionsDashlet extends DashletGeneric { 
    
	function OfficeactionsDashlet($id, $def = null) {
		global $current_user, $app_strings;
		require('modules/oa_officeactions/Dashlets/OfficeactionsDashlet/OfficeactionsDashlet.data.php');

        parent::DashletGeneric($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_OFFACTION_DASHLET_TITLE', 'oa_officeactions');

        $this->searchFields = $dashletData['OfficeactionsDashlet']['searchFields'];
        $this->columns = $dashletData['OfficeactionsDashlet']['columns'];

        $this->seedBean = new oa_officeactions();        
    }
	
	function process($lvsParams_offAct = array()) {
    	
		global $db, $current_user;
	
		
		$lvsParams_offAct = array( 
						'custom_select' => '', 
												
						'custom_from' => ' LEFT JOIN oa_officeactions_cases_c ON oa_officeactions.id = oa_officeactions_cases_c.oa_officeactions_casesoa_officeactions_idb LEFT JOIN cases ON cases.id = oa_officeactions_cases_c.oa_officeactions_casescases_ida LEFT JOIN accounts ON accounts.id = cases.account_id LEFT JOIN c_case_status ON subcase_status_id = c_case_status.id ',
												
						'custom_where' => ' AND accounts.assigned_user_id = "'.$current_user->id.'" AND c_case_status.action_no = "4" AND cases.deleted = 0 ',
						'distinct' => true							
		); 
       
		
		parent::process($lvsParams_offAct);
		
				
    }
}