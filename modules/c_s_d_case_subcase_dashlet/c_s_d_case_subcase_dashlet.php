<?PHP
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2012 SugarCRM Inc.
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

/**
 * THIS CLASS IS FOR DEVELOPERS TO MAKE CUSTOMIZATIONS IN
 */
require_once('modules/c_s_d_case_subcase_dashlet/c_s_d_case_subcase_dashlet_sugar.php');
class c_s_d_case_subcase_dashlet extends c_s_d_case_subcase_dashlet_sugar {
	
	function c_s_d_case_subcase_dashlet(){	
		parent::c_s_d_case_subcase_dashlet_sugar();
	}
	
	function create_new_list_query($order_by, $where, $filter = array(), $params = array(), $show_deleted = 0, $join_type = '', $return_array = false, $parentbean = null, $singleSelect = false) {
        global $current_user;
        $table_name = $this->table_name;
        $ret_array = parent::create_new_list_query($order_by, $where, $filter, $params, $show_deleted, $join_type, true, $parentbean, $singleSelect);
		//echo "<pre>";
		//print_r($ret_array);	
		
		 if ($_REQUEST['casesfilter_basic'][0] == 'all_cases') 
		 { 
            //by anuradha 11/8/2012
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			//end
			$ret_array['where'] = " WHERE c_s_d_case_subcase_dashlet.deleted = '0' ";
            if ($_REQUEST['viewasfilter_basic'][0] != "" && $_REQUEST['viewasfilter_basic'][0] != "all") {
                $ret_array['where'] = " WHERE c_s_d_case_subcase_dashlet.client_consultant_id = '" . $_REQUEST['viewasfilter_basic'][0] . "' AND c_s_d_case_subcase_dashlet.deleted = '0' ";
            }
        }  
		else if($_REQUEST['casesfilter_basic'][0] == 'cases_opportunities')
		{
            //by anuradha 11/8/2012
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			//end
			$ret_array['where'] = ' WHERE jt6.action_no = "2" AND c_s_d_case_subcase_dashlet.deleted =  "0" ';
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND c_s_d_case_subcase_dashlet.client_consultant_id = "' . $_REQUEST['viewasfilter_basic'][0] . '" ';
            }
        }
		else if($_REQUEST['casesfilter_basic'][0] == 'cases_req_action')
		{
            //by anuradha 11/8/2012
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			//end
			$ret_array['where'] = ' WHERE jt6.action_no = "4" AND c_s_d_case_subcase_dashlet.deleted = 0 ';
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND c_s_d_case_subcase_dashlet.client_consultant_id = "' . $_REQUEST['viewasfilter_basic'][0] . '" ';
            }
        }
		else if($_REQUEST['casesfilter_basic'][0] == 'cases_in_progress')
		{
            //by anuradha 11/8/2012
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			//end
			$ret_array['where'] = ' WHERE  jt6.action_no = "3" AND c_s_d_case_subcase_dashlet.deleted =  "0" ';
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND c_s_d_case_subcase_dashlet.client_consultant_id = "' . $_REQUEST['viewasfilter_basic'][0] . '" ';
            }
        }
		else if($_REQUEST['casesfilter_basic'][0] == 'cases_awaiting_client')
		{
            //by anuradha 11/8/2012
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			//end
			$ret_array['where'] = ' WHERE jt6.action_no = "5" AND c_s_d_case_subcase_dashlet.deleted =  "0" ';
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND c_s_d_case_subcase_dashlet.client_consultant_id = "' . $_REQUEST['viewasfilter_basic'][0] . '" ';
            }
        }
		else if($_REQUEST['casesfilter_basic'][0] == 'cases_working')
		{
            //by anuradha 11/8/2012
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			//end
			$ret_array['from'].=" LEFT JOIN c_contribute ON c_contribute.case_id = c_s_d_case_subcase_dashlet.case_subcase_id";
            $ret_array['where'] = ' WHERE  jt6.order_no != 100 AND jt6.order_no != 0 AND c_s_d_case_subcase_dashlet.deleted =  "0" AND  jt6.deleted = "0" AND c_contribute.deleted = "0" ';
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND c_contribute.login_id = "' . $_REQUEST['viewasfilter_basic'][0] . '" ';
            }
        }
		else if($_REQUEST['casesfilter_basic'][0] == 'cases_upcoming_deadline')
		{
            //by anuradha 11/8/2012
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			//end
			$ret_array['from'].=" LEFT JOIN c_contribute ON c_contribute.case_id = c_s_d_case_subcase_dashlet.case_subcase_id ";
			$ret_array['where'] = ' WHERE DATEDIFF(c_s_d_case_subcase_dashlet.due_date,NOW()) <= 60 AND c_s_d_case_subcase_dashlet.due_date > CURDATE() AND c_s_d_case_subcase_dashlet.deleted = "0"  AND c_contribute.deleted=0 AND jt6.order_no != 100 AND jt6.order_no != 0 ';
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND (c_s_d_case_subcase_dashlet.client_consultant_id = "' . $_REQUEST['viewasfilter_basic'][0] . '" OR c_contribute.login_id = "' . $_REQUEST['viewasfilter_basic'][0] . '")';
            }
        }
		else if($_REQUEST['casesfilter_basic'][0] == 'cases_to_file')
		{
            //by anuradha 11/8/2012
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			//end
			$ret_array['where'] = ' WHERE jt6.order_no = "60" AND c_s_d_case_subcase_dashlet.deleted = "0" ';
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND c_s_d_case_subcase_dashlet.client_consultant_id = "' . $_REQUEST['viewasfilter_basic'][0] . '" ';
            }
        }
		else if($_REQUEST['casesfilter_basic'][0] == 'cases_to_start')
		{
            //by anuradha 11/8/2012
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			//end
			$ret_array['where'] = ' WHERE jt6.order_no = "20" AND c_s_d_case_subcase_dashlet.deleted = "0" ';
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND c_s_d_case_subcase_dashlet.client_consultant_id = "' . $_REQUEST['viewasfilter_basic'][0] . '" ';
            }
        }
		else if ($_REQUEST['casesfilter_basic'][0] == 'open_cases')
		{
						
			//by anuradha 11/8/2012
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			//end
			$ret_array['from'].=" LEFT JOIN c_contribute ON c_contribute.case_id = c_s_d_case_subcase_dashlet.case_subcase_id ";
			$ret_array['where'] = ' WHERE jt6.order_no >= "20" AND jt6.order_no != 100 AND c_s_d_case_subcase_dashlet.deleted = "0"  AND c_contribute.deleted=0 ';
			if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND (c_s_d_case_subcase_dashlet.client_consultant_id = "' . $_REQUEST['viewasfilter_basic'][0] . '" OR c_contribute.login_id = "' . $_REQUEST['viewasfilter_basic'][0] . '") ';
            }
		}
		else if($_REQUEST['casesfilter_basic'][0] == 'open_utility_design_cases')
		{
            //by anuradha 11/8/2012
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			//end
		
			$ret_array['from'].=" LEFT JOIN c_contribute ON c_contribute.case_id = c_s_d_case_subcase_dashlet.case_subcase_id";
            $ret_array['where'] = ' WHERE jt6.order_no >= 20 AND jt6.order_no != 100 AND c_s_d_case_subcase_dashlet.deleted = "0" AND (jt4.name = "Utility Patent" OR jt4.name = "Design Patent")  AND c_contribute.deleted=0 ';
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND ( c_s_d_case_subcase_dashlet.client_consultant_id ="' . $_REQUEST['viewasfilter_basic'][0] . '" OR c_contribute.login_id = "' . $_REQUEST['viewasfilter_basic'][0] . '") ';
            }
        }
		// * preethi on 28-08-2012, Des : queries for 2 newly added options
		else if($_REQUEST['casesfilter_basic'][0] == 'open_utility_cases'){
		
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
		
			$ret_array['from'].=" LEFT JOIN c_contribute ON c_contribute.case_id = c_s_d_case_subcase_dashlet.case_subcase_id";
			
            $ret_array['where'] = ' WHERE jt6.order_no >= 20 AND jt6.order_no != 100 AND c_s_d_case_subcase_dashlet.deleted = "0" AND (jt4.name = "Utility Patent")  AND c_contribute.deleted=0 ';
			
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND ( c_s_d_case_subcase_dashlet.client_consultant_id ="' . $_REQUEST['viewasfilter_basic'][0] . '" OR c_contribute.login_id = "' . $_REQUEST['viewasfilter_basic'][0] . '") ';
            }
		
		}else if($_REQUEST['casesfilter_basic'][0] == 'open_design_cases'){
		
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
		
			$ret_array['from'].=" LEFT JOIN c_contribute ON c_contribute.case_id = c_s_d_case_subcase_dashlet.case_subcase_id";
			
            $ret_array['where'] = ' WHERE jt6.order_no >= 20 AND jt6.order_no != 100 AND c_s_d_case_subcase_dashlet.deleted = "0" AND (jt4.name = "Design Patent")  AND c_contribute.deleted=0 ';
			
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND ( c_s_d_case_subcase_dashlet.client_consultant_id ="' . $_REQUEST['viewasfilter_basic'][0] . '" OR c_contribute.login_id = "' . $_REQUEST['viewasfilter_basic'][0] . '") ';
            }
		}
		// * End
		else if($_REQUEST['casesfilter_basic'][0] == 'search_prov_cases_incomplete')
		{
            //by anuradha 11/8/2012
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			//end
			$ret_array['from'].=" LEFT JOIN c_contribute ON c_contribute.case_id = c_s_d_case_subcase_dashlet.case_subcase_id";
            $ret_array['where'] = ' WHERE jt6.order_no >= 20 AND jt6.order_no != 100 AND c_s_d_case_subcase_dashlet.deleted = "0" AND (jt4.name = "Provisional Patent" OR jt4.name = "Patent Search")  AND c_contribute.deleted=0 ';
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND ( c_s_d_case_subcase_dashlet.client_consultant_id ="' . $_REQUEST['viewasfilter_basic'][0] . '" OR c_contribute.login_id = "' . $_REQUEST['viewasfilter_basic'][0] . '") ';
            }
        }
		else if ($_REQUEST['casesfilter_basic'][0] == 'cases_flagged') 
		{ 
            //by anuradha 11/8/2012
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			//end
			$ret_array['from'].=" LEFT JOIN fc_flag_cases ON fc_flag_cases.case_id = c_s_d_case_subcase_dashlet.case_subcase_id";
            $ret_array['where'] = ' WHERE  c_s_d_case_subcase_dashlet.deleted = "0" AND fc_flag_cases.deleted = "0" ';
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND fc_flag_cases.flagged_user_id = "' . $_REQUEST['viewasfilter_basic'][0] . '" AND fc_flag_cases.deleted = "0" ';
            }
        }
		//* preethi on 29-08-2012
		//Des : queries for additional filters
		//* 26. Patents Issued
		else if ($_REQUEST['casesfilter_basic'][0] == 'patents_issued') 
		{ 
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			
			$ret_array['where'] = ' WHERE c_s_d_case_subcase_dashlet.patent_number != "" AND c_s_d_case_subcase_dashlet.patent_number != 0 AND c_s_d_case_subcase_dashlet.deleted =  "0" ';
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND c_s_d_case_subcase_dashlet.client_consultant_id = "'.$_REQUEST['viewasfilter_basic'][0].'" ';
            }
        }
		//* 27. Patent Filing Receipts Not Sent
		else if ($_REQUEST['casesfilter_basic'][0] == 'patent_filing_receipts_not_sent') 
		{ 
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			
			$ret_array['where'] = ' WHERE c_s_d_case_subcase_dashlet.application_number != "" AND c_s_d_case_subcase_dashlet.application_number != 0 AND c_s_d_case_subcase_dashlet.freceipt = 0 AND c_s_d_case_subcase_dashlet.deleted =  "0" ';
			
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND c_s_d_case_subcase_dashlet.client_consultant_id = "'.$_REQUEST['viewasfilter_basic'][0].'" ';
            }
        }
		//* 28. Open Subcases
		else if ($_REQUEST['casesfilter_basic'][0] == 'open_subcases') 
		{ 
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			
			$ret_array['where'] = ' WHERE c_s_d_case_subcase_dashlet.parent_subcase_id != "" AND c_s_d_case_subcase_dashlet.parent_case_id = "" AND c_s_d_case_subcase_dashlet.deleted =  "0" AND jt6.order_no != 100 AND jt6.order_no != 0 ';
			
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND c_s_d_case_subcase_dashlet.client_consultant_id = "'.$_REQUEST['viewasfilter_basic'][0].'" ';
            }
        }
		//* 29. Open Office Actions 
		else if ($_REQUEST['casesfilter_basic'][0] == 'open_office_actions') 
		{ 
			$ret_array['select'] = " SELECT distinct c_s_d_case_subcase_dashlet.id , c_s_d_case_subcase_dashlet.parent_case_id, jt0.name parent_case_name , c_s_d_case_subcase_dashlet.parent_subcase_id, jt1.name parent_subcase_name , c_s_d_case_subcase_dashlet.account_id, jt2.name account_name , c_s_d_case_subcase_dashlet.client_consultant_id, LTRIM(RTRIM(CONCAT(IFNULL(jt3.first_name,''),' ',IFNULL(jt3.last_name,'')))) client_consultant_name , c_s_d_case_subcase_dashlet.case_type_id, jt4.name case_type_name , c_s_d_case_subcase_dashlet.sub_case_type_id, jt5.name subcase_name , c_s_d_case_subcase_dashlet.status, jt6.name status_name , c_s_d_case_subcase_dashlet.case_subcase_status_age , c_s_d_case_subcase_dashlet.due_date , c_s_d_case_subcase_dashlet.prioritydate, c_s_d_case_subcase_dashlet.assigned_user_id ";
			
			$ret_array['where'] = ' WHERE c_s_d_case_subcase_dashlet.parent_subcase_id != "" AND c_s_d_case_subcase_dashlet.parent_case_id = "" AND (jt5.subcase_type_code="OA" || jt5.subcase_type_code="AL" || jt5.subcase_type_code="SU" || jt5.subcase_type_code="RG") AND jt6.order_no != 100 AND jt6.order_no != 0 AND c_s_d_case_subcase_dashlet.deleted =  "0"';
			
            if($_REQUEST['viewasfilter_basic'][0] != "all"){
                $ret_array['where'] .= ' AND c_s_d_case_subcase_dashlet.client_consultant_id = "'.$_REQUEST['viewasfilter_basic'][0].'" ';
            }
        }
		//* End
		return $ret_array;
	}
	
	
}
?>