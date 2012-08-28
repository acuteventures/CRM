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

/*****************************************************************
 Author : Basudeba Rath.
 Dt. 30-Dec-2011.
 Veon Consulting Pvt. Ltd.
*****************************************************************/


require_once('include/Dashlets/DashletGeneric.php');


class MyLeadsDashlet extends DashletGeneric { 

    function MyLeadsDashlet($id, $def = null) {
	
        global $current_user, $app_strings;
		
		require('modules/Accounts/Dashlets/MyLeadsDashlet/MyLeadsDashlet.data.php');
		
        parent::DashletGeneric($id, $def);
        
        if(empty($def['title'])) $this->title = translate('LBL_LIST_ACCOUNT_LEADS', 'Accounts');
        $this->searchFields = $dashletData['MyLeadsDashlet']['searchFields'];
        $this->columns = $dashletData['MyLeadsDashlet']['columns'];
        $this->seedBean =  new Account();       
    }
	
	function process($lvsParams = array()) {
    	
		global $db, $current_user;
		//echo $current_user->id;
        $this->myItemsOnly = false;
		$lvsParams = array( 						
						
					    'custom_select' => " SELECT distinct 
                            accounts.id,
                            accounts.`name`,
                            accounts.date_entered,
                            accounts.assigned_user_id,
                            accounts.billing_address_city,
                            accounts.billing_address_country,
                            accounts.phone_office,
                            accounts.phone_alternate,
                            accounts.parent_id,
                            accounts.first_name,
                            accounts.last_name,
                            accounts.mobile
",
						'custom_from' => " FROM accounts LEFT JOIN cases ON cases.account_id = accounts.id LEFT JOIN c_case_status ON cases.status = c_case_status.id ",
						
						/*'custom_where' => " WHERE c_case_status.order_no < 20 AND accounts.id not in (select accounts.id from accounts LEFT JOIN cases ON cases.account_id = accounts.id LEFT JOIN c_case_status ON cases.status = c_case_status.id
 where c_case_status.order_no >= 20 AND accounts.deleted = '0' AND cases.deleted = '0' AND c_case_status.deleted = '0') AND accounts.assigned_user_id = '".$current_user->id."' AND accounts.deleted = '0' AND cases.deleted = '0' AND c_case_status.deleted = '0' ",*/
 						'custom_where' => " WHERE (c_case_status.order_no < 20 AND accounts.id not in (select accounts.id from accounts LEFT JOIN cases ON cases.account_id = accounts.id LEFT JOIN c_case_status ON cases.status = c_case_status.id
 where c_case_status.order_no >= 20 AND accounts.deleted = '0' AND cases.deleted = '0' AND c_case_status.deleted = '0') AND cases.deleted = '0' AND c_case_status.deleted = '0') || (accounts.id not in(select cases.account_id from cases where cases.deleted = '0')) AND accounts.deleted = '0' AND accounts.assigned_user_id = '".$current_user->id."'",
									
						'distinct' => true
		);  
		parent::process($lvsParams);	
		
				
    }
}

?>
