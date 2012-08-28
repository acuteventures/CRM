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


require_once('include/MVC/View/views/view.detail.php');

class oa_officeactionsViewDetail extends ViewDetail {


 	function oa_officeactionsViewDetail(){
 		parent::ViewDetail();
 	}

 	/**
 	 * display
 	 * Override the display method to support customization for the buttons that display
 	 * a popup and allow you to copy the account's address into the selected contacts.
 	 * The custom_code_billing and custom_code_shipping Smarty variables are found in
 	 * include/SugarFields/Fields/Address/DetailView.tpl (default).  If it's a English U.S.
 	 * locale then it'll use file include/SugarFields/Fields/Address/en_us.DetailView.tpl.
 	 */
 	function display(){
				
		
		if(empty($this->bean->id)){
			global $app_strings;
			sugar_die($app_strings['ERROR_NO_RECORD']);
		}				
		
		$this->dv->process();
		global $mod_strings;
		global $db,$current_user;
		 
		// Author : Basudeba Rath. Date : 11-May-2012.
		$case_obj = new aCase();
		$rec_case = $case_obj->retrieve($this->bean->oa_officeactions_casescases_ida);
		
		$user_obj = new User();
		$rec_user = $user_obj->retrieve($rec_case->client_consultant_id);
		
		$this->ss->assign("PARENT_CASE_CONSULTANT", $rec_user->first_name." ". $rec_user->last_name);
		
		// Author : Anuradha Date : 11-July-2012.
		$client_obj = new Account();		
		$res_client = $client_obj->retrieve($rec_case->account_id);
		$client_link = '<a href="index.php?module=Accounts&action=DetailView&record='.$rec_case->account_id.'">'.$res_client->name.'</a>';
		$this->ss->assign("CLIENT_NAME", $client_link);

        		
/*********************************************************************************************************************/		
		// Author : Phaneendra.
		// Dt. 02-Dec-2011.
		// Veon Consulting Pvt. Ltd.
/*********************************************************************************************************************/
		
	
		$this->ss->assign('USER_ID', $current_user->id);
		$this->ss->assign('BEAN_ID', $this->bean->id );
		$this->ss->assign('SUBCASE_NUMBER', $this->bean->name);
		//end
		//by anuradha 31-01-2012
		/**
		----------------------------------------
		desc: workflow button Start Preparation
		---------------------------------------
		*/
		$subcase_status_id=$this->bean->subcase_status_id;
		$status_obj = new c_case_status();
        $status_obj = $status_obj->retrieve($subcase_status_id);
        $order_no = $status_obj->order_no;
		
		$this->ss->assign('VISIBITY', "visibility:hidden");
		$this->ss->assign('DISPLAY_DET', "display:none");
		$this->ss->assign('DISP_INPUT', "display:none");

		if($order_no==30)
		{
		// WORK FLOW BUTTON FOR In Progress
		 $this->ss->assign('WORKFLOW_BUTTONS', "<input type='button' value='Complete Preparation' id='btn_complete' name='btn_complete' onclick='change_complete_status(".'"'.$this->bean->id.'",'.'"'.$this->bean->subcase_status_id.'",this.id'.");'>");
		}		
		else if($order_no==20){
		// WORK FLOW BUTTONS FOR To Prepare
		$this->ss->assign('WORKFLOW_BUTTONS', "<input type='button' value='Start Preparation' id='btn_stwork' name='btn_stwork' onclick='change_status(".'"'.$this->bean->id.'",'.'"'.$this->bean->subcase_status_id.'",this.id'.");'>");
		}
		else if($order_no==60){
		    $this->ss->assign('VISIBITY', "display:block");
			$this->ss->assign('DISP_INPUT', "display:block");
			$this->ss->assign('APPLICATION_FILED', "Application Filed" );

			$this->ss->assign('WORKFLOW_BUTTONS', "<input type='button' id='btn_af' name='btn_af' value='Application Filed' onclick='app_insert(".'"'.$this->bean->id.'",'.'"'.$this->bean->subcase_status_id.'",this.id'.");' />");
		}
		else if($order_no == 70){
			$this->ss->assign('VISIBITY', "display:block");
			$this->ss->assign('APPLICATION_FILED', "Application Filed" );
			$this->ss->assign('DISP_INPUT', 'display:none');
			$this->ss->assign('DISPLAY_DET', "display:block");
			$this->ss->assign('FDATE', $this->bean->filing_date);
			$this->ss->assign('APP_NO', $this->bean->application_number);
			
		}
		//end
		
		
		// CONTRIBUTION SECTION.
		
		$this->ss->assign('BEAN_ID', $this->bean->id);
		$this->ss->assign('USER_ID', $current_user->id);
		
		$acl_role = new ACLRole();
		$user_role = $acl_role->getUserRoles($current_user->id);
		
		$acc_obj = new Account();
		$rec_acc = $acc_obj->retrieve($this->bean->account_id);
		//by anuradha 23/8/2012
		if(($user_role[0] == 'manager') || ($current_user->id == $rec_acc->assigned_user_id)){
			$this->ss->assign('DIS_BTN_ASSIGNTO', "");
		}
		else{
			$this->ss->assign('DIS_BTN_ASSIGNTO', 'disabled="disabled"');
		}
		//end
		$this->ss->assign('CONTRIBUTE', "Contributed By:");
		$sql_cont_list = "SELECT c.id,c.credits,c.`login_id`,u.first_name,u.last_name FROM `c_contribute` c,users u WHERE c.`case_id` = '".$this->bean->id."' AND u.id = c.login_id AND c.deleted = '0' AND u.deleted = '0'";
		$res_cont_list = $db->query($sql_cont_list);
		
		$lists = "<table>";
		while($row_cont_list = $db->fetchByAssoc($res_cont_list)){
		
			$lists .= "<tr><td>". $row_cont_list['first_name']." ".$row_cont_list['last_name']."</td>";
			//by anuradha 23/8/2012
			$lists .= "<td>". $row_cont_list['credits']."</td>";
			$lists .= "<td>";
			if($current_user->id == $row_cont_list['login_id']){
				$lists .= "<img src='delete.png' onclick='removeUser(this.id);' id='" .$row_cont_list['id']. "' name='" .$row_cont_list['id']."' />";
			}
			else if($user_role[0] == 'manager'){
				$lists .= "<img src='delete.png' onclick='removeUser(this.id);' id='" .$row_cont_list['id']. "' name='" .$row_cont_list['id']."' />";
			}
			$lists .= "</td></tr>";
		}
		
		$lists .= "</table>";
		
		$this->ss->assign('CONT_LISTS', $lists);

		// Author : Basudeba Rath. Date: 03-jan-2012

		$sql_parent = "SELECT oa_officeactions_casescases_ida FROM oa_officeactions_cases_c WHERE 	oa_officeactions_casesoa_officeactions_idb = '".$this->bean->id."' AND deleted = '0' ";
		$res_parent = $db->query($sql_parent);
		$row_parent = $db->fetchByAssoc($res_parent);

		// CASE HISTORY MANUAL SECTION.
		
		$this->ss->assign('CASE_HISTORY', "Case History");
				
		$sqlNOTE  = " SELECT n.id, n.entry, n.assigned_user_id, n.description, n.date_entered, n.date_modified, ";
		$sqlNOTE .= " n.created_by, u.first_name,u.last_name FROM notes n,users u "; 
		$sqlNOTE .= " WHERE (n.parent_id = '". $this->bean->id ."' OR n.parent_id = '".$row_parent['oa_officeactions_casescases_ida']."') AND n.deleted = '0' AND n.created_by = u.id  ORDER BY n.date_modified desc";
		$resNOTE = $db->query($sqlNOTE);
		
		$history_row .= " <table border='1' width = '100%'><tr><th width = '10%' style='text-align:left;border-bottom: 1px solid ";
		$history_row .= " #C1DAD7;letter-spacing: 2px;padding: 6px 6px 6px 12px;text-transform: uppercase;'>Date & Time</th> "; 
		$history_row .= " <th width = '10%' style='border-bottom: 1px solid #C1DAD7; letter-spacing: 2px;";
		$history_row .= " padding: 6px 6px 6px 12px;text-align:left;'>User</th>";
		
		$history_row .= " <th width = '40%' style='border-bottom: 1px solid #C1DAD7;letter-spacing: 2px;text-align:left; ";
		$history_row .= " padding: 6px 6px 6px 12px;'>Comments</th><th width = '1%'  style='border-bottom: 1px solid #C1DAD7; ";
		$history_row .= " letter-spacing: 2px;padding: 6px 6px 6px 12px;'>Action</th></tr>";
		
		while($rowNOTE = $db->fetchByAssoc($resNOTE)){
		//by anuradha on 6/3/2012
		$originalDate = $rowNOTE['date_entered']; //$rowNOTE['date_modified'];
        	$newDate = date("m/d/Y g:i a", strtotime('-5 hours',strtotime($originalDate)));
		
			if($rowNOTE['entry'] == 0 ){
				
				$history_row .= "<tr><td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$newDate;
				$history_row .= ", <td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>  by ".$rowNOTE['first_name'].$rowNOTE['last_name'] ;
				$history_row .= "<b> : </td><td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rowNOTE['description']."</td>";
			}
		
			else if($rowNOTE['created_by'] == $rec_acc->assigned_user_id){
				$history_row .= "<tr><td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$newDate;
				$history_row .= ", <td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>  by ".$rowNOTE['first_name'].$rowNOTE['last_name'] ;
				$history_row .= "<b> : </td><td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rowNOTE['description']."</td>";
			}

			
			else if($current_user->id == $rowNOTE['created_by'] ){ //$rowNOTE['assigned_user_id']
				
				$history_row .= "<tr><td style='color:#00CCFF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$newDate;
				$history_row .= ", <td style='color:#00CCFF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>  by ".$rowNOTE['first_name'].$rowNOTE['last_name'] ;
				$history_row .= "<b> : </td><td style='color:#00CCFF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rowNOTE['description']."</td>";
			}	
			else{
				$history_row .= " <tr><td style='color:#5280B1; border-bottom: 1px solid #C1DAD7;";
				$history_row .= " border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$newDate;
				$history_row .= " ,<td style='color:#5280B1;border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; "; 
				$history_row .= " padding:6px 6px 6px 12px'><b>  by ".$rowNOTE['first_name'].$rowNOTE['last_name'] ;
				$history_row .= " <b> : </td><td style='color:#5280B1;border-bottom: 1px solid #C1DAD7; border-top: ";
				$history_row .= " 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rowNOTE['description']."</b></td>";
			}		
			$rec_Date = explode(" ",$rowNOTE['date_entered']);
			$expire_date = strtotime($rec_Date[0]);
			$today = strtotime(gmdate ("Y-m-d", time() ));
			
			if(($expire_date == $today) && ($rowNOTE['entry'] == 1)){
				
				$history_row .= " <td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; ";
				$history_row .= " padding:6px 6px 6px 12px'> <img  src='edit.png' onclick='edit(this.id);' ";
				$history_row .= " id='" .$rowNOTE['id']. "' name='" .$rowNOTE['id']."' /> <img src='delete.png' ";
				$history_row .= " onclick='removeNotes(this.id);' id='" .$rowNOTE['id']. "' name='" .$rowNOTE['id']."' /></td></tr>";
			}	
			else if(($expire_date == $today) && ($user_role[0] == 'manager') && ($rowNOTE['entry'] == 1)){

				$history_row .= " <td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; ";
				$history_row .= " padding:6px 6px 6px 12px'> <img  src='edit.png' onclick='edit(this.id);' ";
				$history_row .= " id='" .$rowNOTE['id']. "' name='" .$rowNOTE['id']."' /> <img src='delete.png' ";
				$history_row .= " onclick='removeNotes(this.id);' id='" .$rowNOTE['id']. "' name='" .$rowNOTE['id']."' /></td></tr>";
			}
			if(($user_role[0] == 'manager' && $expire_date <= $today) && ($rowNOTE['entry'] == 0) ){
			
				$history_row .= " <td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; ";
				$history_row .= " padding:6px 6px 6px 12px'> <img src='delete.png' ";
				$history_row .= " onclick='removeNotes(this.id);' id='" .$rowNOTE['id']. "' name='" .$rowNOTE['id']."' /></td></tr>";
				
			}
			else{
				$history_row .= "</tr>";
			}		
		}
		$history_row .= "</table>"; 
		$this->ss->assign('NOTES', $history_row );
		if($_REQUEST['notesid']){
			$sql_edit_NOTE = "SELECT * FROM `notes` WHERE id = '".$_REQUEST['notesid']."' AND `deleted` = '0' ";
			$res_edit_NOTE = $db->query($sql_edit_NOTE);
			if($row_edit_NOTE = $db->fetchByAssoc($res_edit_NOTE)){
			    $this->ss->assign('NOTES_TEXT', $row_edit_NOTE['description']);
				$this->ss->assign('NOTE_ID',    $row_edit_NOTE['id']);
				$btnCancel = "<input type = 'button' id = 'btnCancel' name = 'btnCancel' value = 'Cancel' onclick = 'cancel()' />";
				$this->ss->assign('BTN_CANCEL',    $btnCancel);
			}
		}
		
/**********************************************************************************************************************/

		// WORK FLOW FOR DESIGN PATENT.
		
		
			

/**********************************************************************************************************************/	
		//by anuradha
		$this->ss->assign('SUBCASE_NAME', $this->bean->subcase);
		$this->ss->assign('SUBCASE_STATUS_NAME', $this->bean->subcase_status);

		//end

		echo $this->dv->display();
		
		
 	} 	
}

?>
