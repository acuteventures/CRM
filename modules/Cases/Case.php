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

/* * *******************************************************************************

 * Description:  TODO: To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 * ****************************************************************************** */

// Author : Basudeba Rath.
// Date : 03-jan-2012 

function getUserList() {


    global $db;
    $user_array = array();
    $sql_users = "SELECT id, first_name, last_name FROM users WHERE deleted = '0'";
    $res_user = $db->query($sql_users);
    while ($row_users = $db->fetchByAssoc($res_user)) {

        $user_array[$row_users['id']] = $row_users['first_name'] . " " . $row_users['last_name'];
    }
    return $user_array;
}

// Case is used to store customer information.
class aCase extends Basic {

    var $field_name_map = array();
    // Stored fields
    var $id;
    var $date_entered;
    var $date_modified;
    var $modified_user_id;
    var $assigned_user_id;
    var $case_number;
    var $resolution;
    var $description;
    var $name;
    var $status;
    var $priority;
    var $created_by;
    var $created_by_name;
    var $modified_by_name;
    //ashok custom
    var $caseoverride;
    // These are related
    var $bug_id;
    var $account_name;
    var $account_id;
    var $contact_id;
    var $task_id;
    var $note_id;
    var $meeting_id;
    var $call_id;
    var $email_id;
    var $assigned_user_name;
    var $account_name1;
    var $table_name = "cases";
    var $rel_account_table = "accounts_cases";
    var $rel_contact_table = "contacts_cases";
    var $module_dir = 'Cases';
    var $object_name = "Case";
    var $importable = true;

    /** "%1" is the case_number, for emails
     * leave the %1 in if you customize this
     * YOU MUST LEAVE THE BRACKETS AS WELL */
    var $emailSubjectMacro = '[CASE:%1]';
    // This is used to retrieve related fields from form posts.
    var $additional_column_fields = Array('bug_id', 'assigned_user_name', 'assigned_user_id', 'contact_id', 'task_id', 'note_id', 'meeting_id', 'call_id', 'email_id');
    var $relationship_fields = Array('account_id' => 'accounts', 'bug_id' => 'bugs',
        'task_id' => 'tasks', 'note_id' => 'notes',
        'meeting_id' => 'meetings', 'call_id' => 'calls', 'email_id' => 'emails',
    );

    function aCase() {
        parent::SugarBean();
        global $sugar_config;
        if (!$sugar_config['require_accounts']) {
            unset($this->required_fields['account_name']);
        }

        $this->setupCustomFields('Cases');
        foreach ($this->field_defs as $field) {
            $this->field_name_map[$field['name']] = $field;
        }
    }

    var $new_schema = true;

    function get_summary_text() {
        return "$this->name";
    }

    function listviewACLHelper() {
        $array_assign = parent::listviewACLHelper();
        $is_owner = false;
        if (!empty($this->account_id)) {

            if (!empty($this->account_id_owner)) {
                global $current_user;
                $is_owner = $current_user->id == $this->account_id_owner;
            }
        }
        if (!ACLController::moduleSupportsACL('Accounts') || ACLController::checkAccess('Accounts', 'view', $is_owner)) {
            $array_assign['ACCOUNT'] = 'a';
        } else {
            $array_assign['ACCOUNT'] = 'span';
        }

        return $array_assign;
    }

    function save_relationship_changes($is_update) {
        parent::save_relationship_changes($is_update);

        if (!empty($this->contact_id)) {
            $this->set_case_contact_relationship($this->contact_id);
        }
    }

    function set_case_contact_relationship($contact_id) {
        global $app_list_strings;
        $default = $app_list_strings['case_relationship_type_default_key'];
        $this->load_relationship('contacts');
        $this->contacts->add($contact_id, array('contact_role' => $default));
    }

    function fill_in_additional_list_fields() {
        parent::fill_in_additional_list_fields();
        /* // Fill in the assigned_user_name
          //$this->assigned_user_name = get_assigned_user_name($this->assigned_user_id);

          $account_info = $this->getAccount($this->id);
          $this->account_name = $account_info['account_name'];
          $this->account_id = $account_info['account_id']; */
    }

    function fill_in_additional_detail_fields() {
        parent::fill_in_additional_detail_fields();
        // Fill in the assigned_user_name
        $this->assigned_user_name = get_assigned_user_name($this->assigned_user_id);

        $this->created_by_name = get_assigned_user_name($this->created_by);
        $this->modified_by_name = get_assigned_user_name($this->modified_user_id);

        if (!empty($this->id)) {
            $account_info = $this->getAccount($this->id);
            if (!empty($account_info)) {
                $this->account_name = $account_info['account_name'];
                $this->account_id = $account_info['account_id'];
            }
        }
    }

    /** Returns a list of the associated contacts
     * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc..
     * All Rights Reserved..
     * Contributor(s): ______________________________________..
     */
    function get_contacts() {
        $this->load_relationship('contacts');
        $query_array = $this->contacts->getQuery(true);

        //update the select clause in the retruned query.
        $query_array['select'] = "SELECT contacts.id, contacts.first_name, contacts.last_name, contacts.title, contacts.email1, contacts.phone_work, contacts_cases.contact_role as case_role, contacts_cases.id as case_rel_id ";

        $query = '';
        foreach ($query_array as $qstring) {
            $query.=' ' . $qstring;
        }
        $temp = Array('id', 'first_name', 'last_name', 'title', 'email1', 'phone_work', 'case_role', 'case_rel_id');
        return $this->build_related_list2($query, new Contact(), $temp);
    }

    function get_list_view_data() {
        global $current_language;
        $app_list_strings = return_app_list_strings_language($current_language);

        $temp_array = $this->get_list_view_array();
        $temp_array['NAME'] = (($this->name == "") ? "<em>blank</em>" : $this->name);
        $temp_array['PRIORITY'] = empty($this->priority) ? "" : $app_list_strings['case_priority_dom'][$this->priority];
        $temp_array['STATUS'] = empty($this->status) ? "" : $app_list_strings['case_status_dom'][$this->status];
        $temp_array['ENCODED_NAME'] = $this->name;
        $temp_array['CASE_NUMBER'] = $this->case_number;
        $temp_array['SET_COMPLETE'] = "<a href='index.php?return_module=Home&return_action=index&action=EditView&module=Cases&record=$this->id&status=Closed'>" . SugarThemeRegistry::current()->getImage("close_inline", "title=" . translate('LBL_LIST_CLOSE', 'Cases') . " border='0'", null, null, '.gif', translate('LBL_LIST_CLOSE', 'Cases')) . "</a>";
        //$temp_array['ACCOUNT_NAME'] = $this->account_name; //overwrites the account_name value returned from the cases table.
        return $temp_array;
    }

    /**
      builds a generic search based on the query string using or
      do not include any $this-> because this is called on without having the class instantiated
     */
    function build_generic_where_clause($the_query_string) {
        $where_clauses = Array();
        $the_query_string = $this->db->quote($the_query_string);
        array_push($where_clauses, "cases.name like '$the_query_string%'");
        array_push($where_clauses, "accounts.name like '$the_query_string%'");

        if (is_numeric($the_query_string))
            array_push($where_clauses, "cases.case_number like '$the_query_string%'");

        $the_where = "";

        foreach ($where_clauses as $clause) {
            if ($the_where != "")
                $the_where .= " or ";
            $the_where .= $clause;
        }

        if ($the_where != "") {
            $the_where = "(" . $the_where . ")";
        }

        return $the_where;
    }

    function set_notification_body($xtpl, $case) {
        global $app_list_strings;

        $xtpl->assign("CASE_SUBJECT", $case->name);
        $xtpl->assign("CASE_PRIORITY", (isset($case->priority) ? $app_list_strings['case_priority_dom'][$case->priority] : ""));
        $xtpl->assign("CASE_STATUS", (isset($case->status) ? $app_list_strings['case_status_dom'][$case->status] : ""));
        $xtpl->assign("CASE_DESCRIPTION", $case->description);

        return $xtpl;
    }

    function bean_implements($interface) {
        switch ($interface) {
            case 'ACL':return true;
        }
        return false;
    }

    function save($check_notify = FALSE) {
        return parent::save($check_notify);
    }

    /**
     * retrieves the Subject line macro for InboundEmail parsing
     * @return string
     */
    function getEmailSubjectMacro() {
        global $sugar_config;
        return (isset($sugar_config['inbound_email_case_subject_macro']) && !empty($sugar_config['inbound_email_case_subject_macro'])) ?
                $sugar_config['inbound_email_case_subject_macro'] : $this->emailSubjectMacro;
    }

    function getAccount($case_id) {
        if (empty($case_id))
            return array();
        $ret_array = array();
        $query = "SELECT acc.id, acc.name from accounts  acc, cases  where acc.id = cases.account_id and cases.id = '" . $case_id . "' and cases.deleted=0 and acc.deleted=0";
        $result = $this->db->query($query, true, " Error filling in additional detail fields: ");

        // Get the id and the name.
        $row = $this->db->fetchByAssoc($result);

        if ($row != null) {
            $ret_array['account_name'] = stripslashes($row['name']);
            $ret_array['account_id'] = $row['id'];
        } else {
            $ret_array['account_name'] = '';
            $ret_array['account_id'] = '';
        }
        return $ret_array;
    }

// Author : Basudeba Rath
// Date : 03-Jan-2012

    /* function getUsers(){

      global $db;
      $user_array1 = array();
      $sql_users1 = "SELECT id, first_name, last_name FROM users";
      $res_user1 = $db->query($sql_users1);
      while($row_users = $db->fetchByAssoc($res_user1)){

      $user_array1[$row_users['id']] = $row_users['first_name'] . " " . $row_users['last_name'];
      }
      return $user_array1;
      } */

    function getInventions($case_id) {
        if (empty($case_id))
            return array();
        $ret_array = array();
        $query = "SELECT inv.id, inv.name from inv_inventions  inv, cases  where inv.id = cases.invention_id and cases.id = '" . $case_id . "' and cases.deleted=0 and inv.deleted=0";
        $result = $this->db->query($query, true, " Error filling in additional detail fields: ");

        // Get the id and the name.
        $row = $this->db->fetchByAssoc($result);
        if ($row != null) {
            $ret_array['invention_name'] = stripslashes($row['name']);
            $ret_array['invention_id'] = $row['id'];
        } else {
            $ret_array['invention_name'] = '';
            $ret_array['invention_id'] = '';
        }
        return $ret_array;
    }

// Author : Basudeba Rath.
// Date : 17-Jan-2012.  

    function handleSave($prefix, $redirect = true, $useRequired = false) {


        require_once('include/formbase.php');

        $focus = new aCase();

        if ($useRequired && !checkRequired($prefix, array_keys($focus->required_fields))) {
            return null;
        }
        $focus = populateFromPost($prefix, $focus);
        $focus->save();
    }

    /*
     * Rajesh G - 20/06/12
     */

    function create_new_list_query($order_by, $where, $filter = array(), $params = array(), $show_deleted = 0, $join_type = '', $return_array = false, $parentbean = null, $singleSelect = false) {
        global $current_user;
        $table_name = $this->table_name;
        $ret_array = parent::create_new_list_query($order_by, $where, $filter, $params, $show_deleted, $join_type, true, $parentbean, $singleSelect);

        // Modified By Basudeba Rath., Date : 30-Jun-2012.
        //$ret_array['select'] = "";
        // $ret_array['where'] = "";
        //$ret_array['order_by'] = "";
        //$ret_array['from'] = "";       
        if($_REQUEST['case_number_advanced']!='' || $_REQUEST['account_name_advanced']!='' || $_REQUEST['invention_name_advanced']!=''){
		//by anuradha 11-07-2012
			$ret_array['where'] = ' WHERE ';
			
			if($_REQUEST['case_number_advanced']!=''){
				$ret_array['where'] .= ' (cases.name like "'.$_REQUEST['case_number_advanced'].'%")  ';
			}
			
			if($_REQUEST['case_number_advanced']!='' && $_REQUEST['account_name_advanced']!=''){
				$ret_array['where'] .= ' OR ';
			}
			
			
			if($_REQUEST['case_number_advanced']!='' && $_REQUEST['account_name_advanced']!='' && $_REQUEST['invention_name_advanced']!=''){
				$ret_array['where'] .= '  ';
			
			}
			else{
					if($_REQUEST['case_number_advanced']!='' && $_REQUEST['invention_name_advanced']!=''){
						$ret_array['where'] .= ' OR ';
				}
			}
			
			
			if($_REQUEST['account_name_advanced']!=''){
				$ret_array['where'] .= '  ( cases.account_id IN (SELECT id FROM accounts WHERE name like "'.$_REQUEST['account_name_advanced'].'%" AND deleted=0 ) )';
			}
			
			if($_REQUEST['account_name_advanced']!='' && $_REQUEST['invention_name_advanced']!=''){
			$ret_array['where'] .= ' OR ';
			}
			
			if($_REQUEST['invention_name_advanced']!=''){
				$ret_array['where'] .= ' (cases.invention_id IN (SELECT id FROM inv_inventions WHERE name like "'.$_REQUEST['invention_name_advanced'].'%" AND deleted=0 ))  ';
			}			
			$ret_array['where'] .= ' AND cases.deleted=0 ';
			
		}
        //$ret_array['order_by'] = " ORDER BY cases.date_entered DESC";
//        echo "<pre>";
//        print_r($ret_array);
        return $ret_array;
    }
	
	function get_cases_list_for_CreditReportSearch($case_status_comp,$case_status_ab,$user_id)
	{
	    global  $db,$current_user; 
		$name = array();
	    $id = array();
	    $ret_array = array();
   /*     $query = "SELECT name,id from c_case_type , cases , c_case_status where cases.status=c_case_status.id and cases.status='d7b78682-00e9-943d-ecc6-4ed9c63407f5' and cases.type = c_case_type.id and c_case_type.deleted=0";
   
$query = "SELECT c_case_type.name as case_type_name, c_case_type.id as case_type_id
FROM c_case_type, cases, c_case_status
WHERE cases.status = c_case_status.id
AND cases.status = '".$case_status."'
AND cases.type = c_case_type.id
AND c_case_type.deleted =0 AND cases.client_consultant_id='".$user_id."'
GROUP BY cases.type";
*/


if($user_id !='all'){
$query = "SELECT c_case_type.name as case_type_name, c_case_type.id as case_type_id
FROM c_case_type, cases, c_case_status
WHERE cases.status = c_case_status.id AND ( cases.status = '".$case_status_comp."' OR  cases.status = '".$case_status_ab."') AND cases.type = c_case_type.id
AND c_case_type.deleted =0 AND cases.client_consultant_id='".$user_id."' GROUP BY cases.type";
}else{
$query = "SELECT c_case_type.name as case_type_name, c_case_type.id as case_type_id
FROM c_case_type, cases, c_case_status
WHERE cases.status = c_case_status.id AND ( cases.status = '".$case_status_comp."' OR  cases.status = '".$case_status_ab."') AND cases.type = c_case_type.id
AND c_case_type.deleted =0  GROUP BY cases.type";


}
       $result = $this->db->query($query, true, " Error filling in additional detail fields: ");

        while ($row = $db->fetchByAssoc($result)) {
		 array_push($name, $row['case_type_name']);
         array_push($id,$row['case_type_id']);
        
    }


        // Get the id and the name.
     //  $row = $this->db->fetchByAssoc($result);
if(!empty($id)){
		$user_array = array_combine($id, $name);  
		return $user_array;

}
		  
    	//return $result;
	
	}
	
	function get_cases_list_for_CreditReportSearch_default($case_status_comp,$case_status_ab,$user_id)
	{
	    global  $db,$current_user; 
		$name = array();
	    $id = array();
	    $ret_array = array();
   /*     $query = "SELECT name,id from c_case_type , cases , c_case_status where cases.status=c_case_status.id and cases.status='d7b78682-00e9-943d-ecc6-4ed9c63407f5' and cases.type = c_case_type.id and c_case_type.deleted=0";*/
   
 $query = "SELECT c_case_type.name as case_type_name, c_case_type.id as case_type_id
FROM c_case_type, cases, c_case_status
WHERE cases.status = c_case_status.id AND ( cases.status = '".$case_status_comp."' OR  cases.status = '".$case_status_ab."') AND cases.type = c_case_type.id
AND c_case_type.deleted =0 AND cases.client_consultant_id='".$user_id."' GROUP BY cases.type";



       $result = $this->db->query($query, true, " Error filling in additional detail fields: ");
        while ($row = $db->fetchByAssoc($result)) {
		 array_push($name, $row['case_type_name']);
         array_push($id,$row['case_type_id']);
        
    }


        // Get the id and the name.
     //  $row = $this->db->fetchByAssoc($result);
if(!empty($id)){
		$user_array = array_combine($id, $name);  
		return $user_array;

}
		  
    	//return $result;
	
	}
	
	
	function get_cases_consultant_Credits($case_type,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date )
	{
	    global  $db,$current_user; 
		$consultant = array();
	    $casename = array();
		$credit_alloc_notes = array();
	    $credit_date = array();
	    $clientname = array();
	    $case_id = array();
		$client_consultant_id = array();
	    $ret_array = array();


if($user_id != 'all'){
$query = "select   cases.client_consultant_id as client_consultant_id, cases.id as case_id,CONCAT(users.first_name,users.last_name) as consultant from cases,users where  cases.client_consultant_id=users.id AND cases.deleted=0 and users.deleted=0  
AND ( cases.status = '".$case_status_comp."' OR  cases.status = '".$case_status_ab."')  AND cases.type='".$case_type."' AND cases.client_consultant_id='".$user_id."' group by cases.client_consultant_id "; 
}else{
$query = "select   cases.client_consultant_id as client_consultant_id, cases.id as case_id,CONCAT(users.first_name,users.last_name) as consultant from cases,users where  cases.client_consultant_id=users.id AND cases.deleted=0 and users.deleted=0  
AND ( cases.status = '".$case_status_comp."' OR  cases.status = '".$case_status_ab."')  AND cases.type='".$case_type."' group by cases.client_consultant_id "; 


}
        $result = $this->db->query($query, true, " Error filling in additional detail fields: ");
 
        while ($row = $db->fetchByAssoc($result)) {
				array_push($client_consultant_id, $row['client_consultant_id']);
				array_push($case_id, $row['case_id']);
				array_push($consultant, $row['consultant']);
				/*array_push($casename, $row['case_Name']);
				array_push($credit_alloc_notes, $row['Credit_Allocation_Notes']);
				array_push($credit_date, $row['credit_date']);
				array_push($clientname, $row['Client_Name']);*/
				//array_push($casename, $row['case Name']);
       
        
    }


        // Get the id and the name.
       $row = $this->db->fetchByAssoc($result);
		$user_array = array('client_consultant_id'=>$client_consultant_id,'case_id'=>$case_id,'consultant'=>$consultant);  
		return $user_array;
		  
   // return $result;
	
	}
	
	
// get here case subject and client name 
	function getCaseSubjectAnsClientNameCredits($case_type,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date)
	{
	    global  $db,$current_user; 
		$consultant = array();
	    $casename = array();
		$credit_alloc_notes = array();
	    $credit_date = array();
	    $clientname = array();
		$clientid = array();
	    $case_id = array();
		$client_consultant_id = array();
	    $ret_array = array();
		
if($user_id != 'all'){


$query = "select   cases.client_consultant_id as client_consultant_id, cases.id as case_id,CONCAT(users.first_name,users.last_name) as consultant,cases.name as 'case_Name',cases.credit_alloc_notes as 'credit_allocation_notes',cases.credit_date as credit_date,accounts.name as 'client_name' , accounts.id as accounts_id  from cases,users,accounts where  cases.client_consultant_id=users.id AND cases.deleted=0 and users.deleted=0 and
cases.account_id=accounts.id 
AND ( cases.status = '".$case_status_comp."' OR  cases.status = '".$case_status_ab."')  and cases.type='".$case_type."' and cases.client_consultant_id='".$user_id."'
and cases.credit_date BETWEEN '".$From_date."' AND '".$To_date."' ORDER BY cases.credit_date DESC";
}
else
{
$query = "select   cases.client_consultant_id as client_consultant_id, cases.id as case_id,CONCAT(users.first_name,users.last_name) as consultant,cases.name as 'case_Name',cases.credit_alloc_notes as 'credit_allocation_notes',cases.credit_date as credit_date,accounts.name as 'client_name' , accounts.id as accounts_id  from cases,users,accounts where  cases.client_consultant_id=users.id AND cases.deleted=0 and users.deleted=0 and
cases.account_id=accounts.id 
AND ( cases.status = '".$case_status_comp."' OR  cases.status = '".$case_status_ab."')  and cases.type='".$case_type."' and cases.credit_date BETWEEN '".$From_date."' AND '".$To_date."' ORDER BY cases.credit_date DESC";

}


        $result = $this->db->query($query, true, " Error filling in additional detail fields: ");
 
        while ($row = $db->fetchByAssoc($result)) {
				array_push($client_consultant_id, $row['client_consultant_id']);
				array_push($case_id, $row['case_id']);
				array_push($consultant, $row['consultant']);
				array_push($casename, $row['case_Name']);
				array_push($credit_alloc_notes, $row['credit_allocation_notes']);
				array_push($credit_date, $row['credit_date']);
				array_push($clientname, $row['client_name']);
				array_push($clientid, $row['accounts_id']);
				//array_push($casename, $row['case Name']);
    }
        // Get the id and the name.
       $row = $this->db->fetchByAssoc($result);
		$user_array = array('client_consultant_id'=>$client_consultant_id,'case_id'=>$case_id,'consultant'=>$consultant,'casename'=> $casename,'credit_alloc_notes'=>$credit_alloc_notes,'credit_date'=>$credit_date,'clientname'=>$clientname,'clientid'=>$clientid);  
		return $user_array;
		  
   // return $result;
	
	}

	function getCaseSubjectAnsClientNameCredits_default($case_type,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date )
	{
	    global  $db,$current_user; 
		$consultant = array();
	    $casename = array();
		$credit_alloc_notes = array();
	    $credit_date = array();
	    $clientname = array();
		$clientid = array();
	    $case_id = array();
		$client_consultant_id = array();
	    $ret_array = array();
		
  /*     $query = "select   cases.client_consultant_id as client_consultant_id, cases.id as case_id,CONCAT(users.first_name,users.last_name) as consultant,cases.name as 'case_Name',cases.credit_alloc_notes as 'Credit_Allocation_Notes',cases.credit_date as credit_date,accounts.name as 'Client_Name' from cases,users,accounts where  cases.client_consultant_id=users.id AND cases.deleted=0 and users.deleted=0 and
  cases.account_id=accounts.id 
AND ( cases.status = '".$case_status_comp."' OR  cases.status = '".$case_status_ab."') and cases.type='".$case_type."' and cases.client_consultant_id='".$user_id."'";
*/
$query = "SELECT cases.client_consultant_id AS client_consultant_id, cases.id as case_id,cases.name as 'case_name',cases.credit_alloc_notes AS 'credit_allocation_notes',cases.credit_date as credit_date,accounts.name as 'client_name' , accounts.id as accounts_id  from cases,accounts where  cases.deleted=0 and  cases.account_id=accounts.id AND ( cases.status = '".$case_status_comp."' OR  cases.status = '".$case_status_ab."')  AND cases.type='".$case_type."' AND cases.client_consultant_id='".$user_id."'
and cases.credit_date BETWEEN '".$From_date."' AND '".$To_date."' ORDER BY cases.credit_date DESC";



        $result = $this->db->query($query, true, " Error filling in additional detail fields: ");
 
        while ($row = $db->fetchByAssoc($result)) {
				array_push($client_consultant_id, $row['client_consultant_id']);
				array_push($case_id, $row['case_id']);
				array_push($consultant, $row['consultant']);
				array_push($casename, $row['case_name']);
				array_push($credit_alloc_notes, $row['credit_allocation_notes']);
				array_push($credit_date, $row['credit_date']);
				array_push($clientname, $row['client_name']);
				array_push($clientid, $row['accounts_id']);
								//array_push($casename, $row['case Name']);
    }
        // Get the id and the name.
       $row = $this->db->fetchByAssoc($result);
		$user_array = array('client_consultant_id'=>$client_consultant_id,'case_id'=>$case_id,'consultant'=>$consultant,'casename'=> $casename,'credit_alloc_notes'=>$credit_alloc_notes,'credit_date'=>$credit_date,'clientname'=>$clientname,'clientid'=>$clientid);  
		return $user_array;
		  
   // return $result;
	
	}	
function getConsuletantByCaseId($case_id)
{
	global  $db,$current_user; 
	$consultant = array();

 $query = "select  CONCAT(users.first_name,users.last_name) as consultant from cases,users where  cases.client_consultant_id=users.id AND cases.deleted=0 and users.deleted=0 
	AND cases.id = '".$case_id."' group by consultant ";

        $result = $this->db->query($query, true, " Error filling in additional detail fields: ");
		$row = $db->fetchByAssoc($result);
      //  while ($row = $db->fetchByAssoc($result)) {
			
				return ($row['consultant']);
				
//}
}

function getContributePoint($case_id){
	global  $db,$current_user; 
	
		$credits_points = array();
		$user_id = array();
		//$consultant = array();

 $query = "select c_contribute.credits AS credits_points,users.id AS user_id   from c_contribute , users , cases where c_contribute.case_id=cases.id AND c_contribute.login_id=users.id  AND c_contribute.case_id='".$case_id."' AND  c_contribute.deleted=0 AND cases.deleted=0";

        $result = $this->db->query($query, true, " Error filling in additional detail fields: ");
		//$row = $db->fetchByAssoc($result);
        while ($row = $db->fetchByAssoc($result)) {
		//echo $row['credits_points'];
		//echo $row['user_id'];
		//echo "<hr>";
					array_push($credits_points, $row['credits_points']);
					array_push($user_id,$row['user_id']);
			}
			
			$point_array = @array_combine($user_id,$credits_points);  
			print_r($point_array) ;
		//return $point_array;

}



	function get_cases_list_for_CR($case_status,$case_type)
	{
	    global  $db,$current_user; 
		$case_name = array();
		$case_number = array();
		$account_id = array();
		$invention_id = array();
		$consultant_id = array();
		$credits = array();
	    $ret_array = array();
   /*     $query = "SELECT name,id from c_case_type , cases , c_case_status where cases.status=c_case_status.id and cases.status='d7b78682-00e9-943d-ecc6-4ed9c63407f5' and cases.type = c_case_type.id and c_case_type.deleted=0";*/
   
   $query = "SELECT cases.name as case_name, cases.case_number as case_number, cases.account_id as account_id, cases.invention_id as invention_id, cases.client_consultant_id as consultant_id, c_contribute.credits as credits
FROM cases, c_case_type, c_case_status, c_contribute
WHERE cases.type = c_case_type.id
AND c_case_status.id = cases.status
AND cases.status = '".$case_status."'
AND cases.type = '".$case_type."'
AND c_contribute.case_id = cases.id
AND cases.deleted =0 AND c_case_status.deleted=0 AND c_contribute.deleted=0 AND c_case_type.deleted=0";
   
        $result = $this->db->query($query, true, " Error filling in additional detail fields: ");

        while ($row = $db->fetchByAssoc($result)) {
					array_push($case_name, $row['case_name']);
					array_push($case_number,$row['case_number']);
					array_push($account_id, $row['account_id']);
					array_push($invention_id,$row['invention_id']);
					array_push($consultant_id, $row['consultant_id']);
					array_push($credits,$row['credits']);
        
    }


        // Get the id and the name.
     //  $row = $this->db->fetchByAssoc($result);
		$user_array = array_combine($case_name, $case_number,$account_id, $invention_id,$consultant_id, $credits);  
		return $user_array;
		  
    	return $result;
	
	}

/*function getContributePoint($case_id,$user_id){
global $db,$current_user;

$credits_points = array();
$sum_of_creditds=array();

echo $query = "SELECT credits FROM c_contribute WHERE case_id = '".$case_id."' AND login_id = '".$user_id."' AND deleted=0 ";

$result = $this->db->query($query, true, " Error filling in additional detail fields: ");
$row = $db->fetchByAssoc($result);
//echo $row['credits'];
 
return ($row['credits']);

}*/

function getContributePointCustom($case_id,$user_id){
global $db,$current_user;
$credits_points = array();



 $query = "SELECT credits FROM c_contribute where login_id='".$user_id."' AND case_id='".$case_id."'  AND deleted=0";
$result = $this->db->query($query, true, " Error filling in additional detail fields: ");
$row = $db->fetchByAssoc($result);
$credits = $row['credits'];
if(!empty($credits))
{
$credits =  $credits;
}
else {
$credits=0;
}

return ($credits);

/*global $db,$current_user;

$credits_points = array();
$sum_of_creditds=array();

$query = "select c_contribute.credits AS cred its_points,sum(c_contribute.credits) as sum_of_creditds from c_contribute , users , cases where c_contribute.case_id=cases.id AND c_contribute.login_id='".$user_id."' AND c_contribute.case_id='".$case_id."' AND c_contribute.deleted=0 AND cases.deleted=0";

$result = $this->db->query($query, true, " Error filling in additional detail fields: ");
//$row = $db->fetchByAssoc($result);
while ($row = $db->fetchByAssoc($result)) {
//echo $row['credits_points'];
//echo $row['user_id'];
//echo "<hr>";
array_push($credits_points, $row['credits_points']);
array_push($$sum_of_creditds,$row['sum_of_creditds']);
}

$point_array = array_combine($credits_points,sum_of_creditds);*/
//print_r($point_array) ;
//return "hi here me ";

}


////////////////////////////////////////////
	function get_cases_consultant_CreditsById($case_type,$case_status,$user_id)
	{
	    global  $db,$current_user; 
		$consultant = array();
	    $casename = array();
		$credit_alloc_notes = array();
	    $credit_date = array();
	    $clientname = array();
	    $case_id = array();
		$client_consultant_id = array();
	    $ret_array = array();
$query = "select   cases.client_consultant_id as client_consultant_id, cases.id as case_id,CONCAT(users.first_name,users.last_name) as consultant from cases,users where  cases.client_consultant_id=users.id AND cases.deleted=0 and users.deleted=0  
AND cases.status = '".$case_status."' and cases.type='".$case_type."' and cases.client_consultant_id='".$user_id."'"; 

        $result = $this->db->query($query, true, " Error filling in additional detail fields: ");
 
        while ($row = $db->fetchByAssoc($result)) {
				array_push($client_consultant_id, $row['client_consultant_id']);
				array_push($case_id, $row['case_id']);
				array_push($consultant, $row['consultant']);

       
        
    }


        // Get the id and the name.
       // $row = $this->db->fetchByAssoc($result);
		$user_array = array('client_consultant_id'=>$client_consultant_id,'case_id'=>$case_id,'consultant'=>$consultant);  
		return $user_array;
		  
   // return $result;
	
	}
	
	function get_cases_consultant_CreditsById_default($case_type,$case_status_comp,$case_status_ab,$user_id)
	{
	    global  $db,$current_user; 
		$consultant = array();
	    $casename = array();
		$credit_alloc_notes = array();
	    $credit_date = array();
	    $clientname = array();
	    $case_id = array();
		$client_consultant_id = array();
	    $ret_array = array();
$query = "select   cases.client_consultant_id as client_consultant_id, cases.id as case_id,CONCAT(users.first_name,users.last_name) as consultant from cases,users where  cases.client_consultant_id=users.id AND cases.deleted=0 and users.deleted=0  
AND ( cases.status = '".$case_status_comp."' OR  cases.status = '".$case_status_ab."') and cases.type='".$case_type."' and cases.client_consultant_id='".$user_id."'"; 

        $result = $this->db->query($query, true, " Error filling in additional detail fields: ");
 
        while ($row = $db->fetchByAssoc($result)) {
				array_push($client_consultant_id, $row['client_consultant_id']);
				array_push($case_id, $row['case_id']);
				array_push($consultant, $row['consultant']);

       
        
    }


        // Get the id and the name.
       // $row = $this->db->fetchByAssoc($result);
		$user_array = array('client_consultant_id'=>$client_consultant_id,'case_id'=>$case_id,'consultant'=>$consultant);  
		return $user_array;
		  
   // return $result;
	
	}	

}

?>