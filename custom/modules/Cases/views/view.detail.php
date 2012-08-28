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

class CasesViewDetail extends ViewDetail {


 	function CasesViewDetail(){
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
		       
        		
/*********************************************************************************************************************/		
		// Author : Basudeba Rath.
		// Dt. 02-Dec-2011.
		// Veon Consulting Pvt. Ltd.
/*********************************************************************************************************************/
		
						
					
		$sql_Case_Type = "SELECT name FROM c_case_type where id = '".$this->bean->type."' AND deleted = '0' ";
		$res_Case_Type = $db->query($sql_Case_Type);
		$row_Case_Type = $db->fetchByAssoc($res_Case_Type);
		$this->ss->assign('TYPE',    $row_Case_Type['name']);
		
		$sql_Case_Status = "SELECT name FROM c_case_status where id = '".$this->bean->status."' AND deleted = '0' ";
		$res_Case_Status = $db->query($sql_Case_Status);
		$row_Case_Status = $db->fetchByAssoc($res_Case_Status);
		
		$this->ss->assign('STATUS',  $row_Case_Status['name']);
		$this->ss->assign('USER_ID', $current_user->id);
		$this->ss->assign('BEAN_ID', $this->bean->id );
		
                /**********************
                 * Rajesh G - 10/05/12
                 * Flag Case button
                 **********************/
		
                $select_query = "SELECT
                        COUNT(*) AS total
                        FROM fc_flag_cases 
                        WHERE
                        fc_flag_cases.case_id = '".$this->bean->id."' 
                        AND fc_flag_cases.flagged_user_id = '".$current_user->id."' 
                        AND fc_flag_cases.deleted = 0";
                $result = $db->query($select_query);
                $total_rows_res = $db->fetchByAssoc($result);
                $total_rows = $total_rows_res['total'];

                if($total_rows == 0 )
                {
                    $flagCase = '<span id="spanFlag" ><input type="button" name="btnFlag" id="btnFlag" value="Flag Case" onclick="fnFlagCase('.$current_user->id.', true)" /></span>';
                }
                else
                {
                    $flagCase = '<span id="spanFlag" ><input type="button" name="btnFlag" id="btnFlag" value="Unflag Case" onclick="fnFlagCase('.$current_user->id.', false)" /></span>';
                }
		$this->ss->assign("FLAGCASE",$flagCase);
		/**************************************/
                
		// WORK FLOW BUTTONS FOR Patent Search.
		
		if($row_Case_Status['name'] == "To Search" && $row_Case_Type['name'] == "Patent Search"){
			$this->ss->assign('WORKFLOW_BUTTONS', "<input type = 'button' value = 'Start Search' id = 'btn_stSearch' name = 'btn_stSearch' onclick = 'change_status(".'"'.$this->bean->id.'",'.'"'.$this->bean->status.'",this.id'.");'>");
		}
		else if($row_Case_Status['name'] == "In Progress" && $row_Case_Type['name'] == "Patent Search"){
			$this->ss->assign('WORKFLOW_BUTTONS', "<input type = 'button' value = 'Contribute to the Search' id = 'btn_contSearch' name = 'btn_contSearch'  onclick = 'cont_search(".'"'.$this->bean->id.'",'.'"'.$this->bean->status.'",this.id'.");'><input type = 'button' value = 'Complete Search' id = 'btn_Search_complete' name = 'btn_Search_complete' onclick = 'change_status(".'"'.$this->bean->id.'",'.'"'.$this->bean->status.'",this.id'.");'>");
		}
				
		// WORK FLOW BUTTONS FOR PROVISIONAL PATENT, DISIGN PATENT, UTILITY PATENT.
		
		$this->ss->assign('VISIBITY', "visibility:hidden");
		$this->ss->assign('DISPLAY_DET', "display:none");
		$this->ss->assign('DISP_INPUT', "display:none");
	
		$this->ss->assign('TM_VISIBITY', "display:none");
		$this->ss->assign('DISPLAY_TA_DET', "display:none");
		$this->ss->assign('DISP_TA_INPUT', "display:none");
		$this->ss->assign('TM_FILING', "display:none");

		$this->ss->assign('IP_LBL_PN', "display:none");
		$this->ss->assign('DET_LBL_PN', "display:none");

		if(($row_Case_Type['name'] == "Provisional Patent" || $row_Case_Type['name'] == "Design Patent" || $row_Case_Type['name'] == "Utility Patent" || $row_Case_Type['name'] == "Trademark" || $row_Case_Type['name'] == "Virtual Prototype" || $row_Case_Type['name'] == "Drawings" || $row_Case_Type['name'] == "Marketing Material" || $row_Case_Type['name'] == "Logo Design" || $row_Case_Type['name'] == "Other" || $row_Case_Type['name'] == "International Patent") && $row_Case_Status['name'] == "To Prepare"){
			
			$this->ss->assign('WORKFLOW_BUTTONS', "<input type = 'button' id = 'btn_prepair' name = 'btn_prepair' value = 'Start Preparation' onclick = 'prov_status(".'"'.$this->bean->id.'",'.'"'.$this->bean->status.'",this.id'.");' />");
			
		}
		else if(($row_Case_Type['name'] == "Provisional Patent" || $row_Case_Type['name'] == "Design Patent" || $row_Case_Type['name'] == "Utility Patent" || $row_Case_Type['name'] == "Trademark" || $row_Case_Type['name'] == "Virtual Prototype" || $row_Case_Type['name'] == "Drawings" || $row_Case_Type['name'] == "Marketing Material" || $row_Case_Type['name'] == "Logo Design" || $row_Case_Type['name'] == "Other" || $row_Case_Type['name'] == "International Patent") && $row_Case_Status['name'] == "In Progress"){
		
			$this->ss->assign('WORKFLOW_BUTTONS', "<input type = 'button' id = 'btn_conribute' name = 'btn_conribute' value = 'Contribute To Preparation' onclick = 'cont_search(".'"'.$this->bean->id.'",'.'"'.$this->bean->status.'",this.id'.");' /><input type = 'button' value = 'Complete Preparation' id = 'btn_completePrepair' name = 'btn_completePrepair' onclick = 'prov_status(".'"'.$this->bean->id.'",'.'"'.$this->bean->status.'",this.id'.");' />");

		}
		// APPLICATION FILED SECTION.
		else if(($row_Case_Type['name'] == "Provisional Patent" || $row_Case_Type['name'] == "Design Patent" || $row_Case_Type['name'] == "Utility Patent" || $row_Case_Type['name'] == "International Patent") && $row_Case_Status['name'] == "To File"){
			
			//$this->ss->assign('VISIBITY', "visibility:visible");
			$this->ss->assign('VISIBITY', "display:block");
			$this->ss->assign('DISP_INPUT', "display:block");
			$this->ss->assign('APPLICATION_FILED', "Application Filed" );
			$this->ss->assign('WORKFLOW_BUTTONS', "<input type = 'button' id = 'btn_af' name = 'btn_af' value = 'Application Filed' onclick = 'app_insert(".'"'.$this->bean->id.'",'.'"'.$this->bean->status.'",this.id'.");' />");
			if($row_Case_Type['name'] == "International Patent"){
				$this->ss->assign('IP_LBL_PN', "display:block");
			}
			
			$this->ss->assign('FDT',  $this->bean->filing_date);
			$this->ss->assign('ANO', $this->bean->application_number );
		}
		
		else if(($row_Case_Type['name'] == "Provisional Patent" || $row_Case_Type['name'] == "Design Patent" || $row_Case_Type['name'] == "Utility Patent" || $row_Case_Type['name'] == "International Patent") && ($row_Case_Status['name'] == "Filed" || ($row_Case_Status['name'] == "Completed"))){
		
			//$this->ss->assign('VISIBITY', "visibility:visible");
			$this->ss->assign('VISIBITY', "display:block");
			$this->ss->assign('APPLICATION_FILED', "Application Filed" );
			$this->ss->assign('DISP_INPUT', 'display:none');
			$this->ss->assign('DISPLAY_DET', "display:block");
			$this->ss->assign('FDATE', $this->bean->filing_date);
			$this->ss->assign('APP_NO', $this->bean->application_number);
			if($this->bean->freceipt == 1)
				$chk_fr = 'checked="checked"';
			else
				$chk_fr ='';
			$this->ss->assign('F_RECEIPT', $chk_fr);
			if($row_Case_Type['name'] == "International Patent"){
				$this->ss->assign('DET_LBL_PN', "display:block");
				$this->ss->assign('PUBLICATION_NO', $this->bean->patent_publication_number);
				$this->ss->assign('ISSUED_NO', $this->bean->patent_issued_number);
			}
		}

	// TRADE MARK FILING SECTION.
		
		else if(($row_Case_Type['name'] == "Trademark") && $row_Case_Status['name'] == "To File"){
			
			$this->ss->assign('TM_VISIBITY', "display:block");
			$this->ss->assign('DISP_TA_INPUT', "display:block");
			$this->ss->assign('TM_APPLICATION_FILED', "Application Filed" );
			$this->ss->assign('WORKFLOW_BUTTONS', "<input type = 'button' id = 'btn_tm_af' name = 'btn_tm_af' value = 'TMApplication Filed' onclick = 'tm_app_insert(".'"'.$this->bean->id.'",'.'"'.$this->bean->status.'",this.id'.");' />");

			$this->ss->assign('TM_FDATE_VAL', $this->bean->tm_filing_date );
			$this->ss->assign('TM_APP_NO_VAL', $this->bean->tm_application_number );
			$this->ss->assign('TM_REG_DT_VAL', $this->bean->tm_registration_date );
			$this->ss->assign('TM_REG_NO_VAL', $this->bean->tm_registration_number );

		}
		else if(($row_Case_Type['name'] == "Trademark") && ($row_Case_Status['name'] == "Filed" || ($row_Case_Status['name'] == "Completed"))){

			$this->ss->assign('TM_VISIBITY', "display:block");
			$this->ss->assign('TM_APPLICATION_FILED', "Application Filed" );
			$this->ss->assign('TM_FILING', "display:block");
			
			$this->ss->assign('TM_FDATE', $this->bean->tm_filing_date );
			$this->ss->assign('TM_REG_NO', $this->bean->tm_registration_number );
			$this->ss->assign('TM_REG_DATE', $this->bean->tm_registration_date );
			$this->ss->assign('TM_APP_NO', $this->bean->tm_application_number );
			
			$tm_classes = explode("^",$this->bean->tm_classes);
			$classes_tm = "";
			for($i=1;$i<sizeof($tm_classes);$i++){
				if($tm_classes[$i]== ','){
					continue;
				}
				$classes_tm .= "<br>".$tm_classes[$i];
				
			}	
			
			$this->ss->assign('TM_CLASSES_VALUES', $classes_tm );
		}		

		// CONTRIBUTION AND CREDIT ALLOCATION SECTION.
		
		$this->ss->assign('BEAN_ID', $this->bean->id);
		$this->ss->assign('USER_ID', $current_user->id);
		
		$acl_role = new ACLRole();
		$user_role = $acl_role->getUserRoles($current_user->id);
		
		$acc_obj = new Account();
		$rec_acc = $acc_obj->retrieve($this->bean->account_id);
		//by anuradha on 21/8/2012
		$this->ss->assign('PRIMARY_CLIENT_EMAIL', $rec_acc->email1);
		
		$sql_client_primary_phone = "SELECT ph.phone_no FROM accounts a JOIN ph_phoneno ph ON ph.account_id_c=a.id AND a.deleted=0 AND ph.deleted=0 WHERE a.id = '".$this->bean->account_id."' AND ph.primary_no = '1' ";
		$res_client_primary_phone = $db->query($sql_client_primary_phone);
		$row_client_primary_phone = $db->fetchByAssoc($res_client_primary_phone);		
		
		$this->ss->assign('PRIMARY_CLIENT_PHONE', $row_client_primary_phone['phone_no']);
		//end
	// Date : 10-Feb-2012.
	// Modified Date : 04-May-2012.
		
		if(($user_role[0] == 'manager') || ($current_user->id == $rec_acc->assigned_user_id)){
			$this->ss->assign('DIS_BTN_ASSIGNTO', "");
		}
		else{
			$this->ss->assign('DIS_BTN_ASSIGNTO', 'disabled="disabled"');
		}

		$this->ss->assign('CONTRIBUTE', "Contributed By:");
		
		$sql_cont_list = "SELECT c.id,c.`login_id`,c.credits, u.first_name,u.last_name FROM `c_contribute` c, users u 
						  WHERE c.`case_id` = '".$this->bean->id."' AND u.id = c.login_id 
						  AND c.deleted = '0' AND u.deleted = '0'";
						  
		$res_cont_list = $db->query($sql_cont_list);
		
		$lists = "<table>";
		while($row_cont_list = $db->fetchByAssoc($res_cont_list)){
		
			$lists .= "<tr><td>". $row_cont_list['first_name']." ".$row_cont_list['last_name']. "</td>";
			$lists .= "<td>". $row_cont_list['credits']."</td>";
			$lists .= "<td>";
			if($current_user->id == $row_cont_list['login_id']){
				$lists .= "<img src='delete.png' onclick='removeUser(this.id);' id='" .$row_cont_list['id']. "' name='" .$row_cont_list['id']."' />";
			}
			else if(($user_role[0] == 'manager') || ($current_user->id == $rec_acc->assigned_user_id)){
				$lists .= "<img src='delete.png' onclick='removeUser(this.id);' id='" .$row_cont_list['id']. "' name='" .$row_cont_list['id']."' />";
			}
			$lists .= "</td></tr>";
		}
		
		$lists .= "<tr><td>Credit Date : </td><td>".$this->bean->credit_date."</td>";
		$lists .= "<td>Credit Allocation Notes : ".$this->bean->credit_alloc_notes."</td></tr>";
		$lists .= "</table>";
		
		$this->ss->assign('CONT_LISTS', $lists);
		
		
		// Author : Basudeba Rath. Date: 03-jan-2012 SUBCASE HISTORY.

		$sql_subcase = "SELECT oa_officeactions_casesoa_officeactions_idb FROM oa_officeactions_cases_c WHERE 	oa_officeactions_casescases_ida = '".$this->bean->id."' AND deleted = '0' ";
		$res_subcase = $db->query($sql_subcase);
		$row_subcase = $db->fetchByAssoc($res_subcase);
				
		if(empty($row_subcase['oa_officeactions_casesoa_officeactions_idb'])){
			$sqlNOTE  = " SELECT n.id,n.assigned_user_id,n.description,n.date_entered,n.date_modified, n.entry, ";
			$sqlNOTE .= " n.created_by, u.first_name,u.last_name,n.parent_id FROM notes n,users u "; 
			$sqlNOTE .= " WHERE n.parent_id in( '". $this->bean->id ."' ) AND n.deleted = '0' AND u.deleted = 0 AND n.created_by = u.id ORDER BY n.date_entered desc";
		}
		else{
		$sqlNOTE  = " SELECT n.id,n.assigned_user_id,n.description,n.date_entered,n.date_modified, n.entry, ";
		$sqlNOTE .= " n.created_by, u.first_name,u.last_name,n.parent_id FROM notes n,users u "; 
		$sqlNOTE .= " WHERE n.parent_id in( '". $this->bean->id ."','".$row_subcase['oa_officeactions_casesoa_officeactions_idb']."' ) AND n.deleted = '0' AND u.deleted = 0 AND n.created_by = u.id ORDER BY n.date_entered desc";
		
		}
		//end
		// CASE HISTORY MANUAL SECTION.
		
		$this->ss->assign('CASE_HISTORY', "Case History");
				
		$resNOTE = $db->query($sqlNOTE);
		//echo $sqlNOTE;
		$history_row .= " <table border='1' width = '100%'><tr><th width = '12%' style='text-align:left;border-bottom: 1px solid ";
		$history_row .= " #C1DAD7;letter-spacing: 2px;padding: 6px 6px 6px 12px;text-transform: uppercase;'>Date & Time</th> "; 
		$history_row .= " <th width = '12%' style='border-bottom: 1px solid #C1DAD7; letter-spacing: 2px;";
		$history_row .= " padding: 6px 6px 6px 12px;text-align:left;'>User</th>";
		
		$history_row .= " <th width = '35%' style='border-bottom: 1px solid #C1DAD7;letter-spacing: 2px;text-align:left; ";
		$history_row .= " padding: 6px 6px 6px 12px;'>Comments</th>";
		//by anuradha 20-03-2012
		$history_row .= "<th width = '15%'  style='border-bottom: 1px solid #C1DAD7; letter-spacing: 2px;text-align:left;padding: 6px 6px 6px 12px;'>Subcase</th>";

		$history_row .= "<th width = '1%'  style='border-bottom: 1px solid #C1DAD7; ";
		$history_row .= " letter-spacing: 2px;padding: 6px 6px 6px 12px;'>Action</th></tr>";
		
		while($rowNOTE = $db->fetchByAssoc($resNOTE)){
		    
		    //$originalDate = $rowNOTE['date_entered']; 
   		    //$newDate = date("m/d/Y g:i a", strtotime($originalDate));
		
			 
		    $originalDate = $rowNOTE['date_entered']; 
  		    $newDate = date("m/d/Y g:i a", strtotime('-4 hours',strtotime($originalDate))); // Converted date time to EST GMT - 4 .
			//by anuradha 20-03-2012
			$get_subcase_number = "SELECT * FROM oa_officeactions WHERE deleted=0 AND id='".$rowNOTE['parent_id']."'";
			$get_subcase_number = $db->query($get_subcase_number);
			$subcase_row = $db->fetchByAssoc($get_subcase_number);
			
			if($rowNOTE['parent_id']!=$this->bean->id){
				$subcase_data = '<a href="index.php?module=oa_officeactions&return_module=oa_officeactions&action=DetailView&record='.$rowNOTE['parent_id'].'">'.$subcase_row['name'].'</a>';
			}
			else{
				$subcase_data = 'Case History';
			}
			
			if($rowNOTE['entry'] == 0 ){
				
				$history_row .= "<tr><td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$newDate;
				$history_row .= ", <td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>  by ".$rowNOTE['first_name']." ".$rowNOTE['last_name'] ;
				$history_row .= "<b> : </td><td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rowNOTE['description']."</td>";
				//by anuradha 20-03-2012
				$history_row .= "<td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$subcase_data."</b></td>";
			}
		
			else if($rowNOTE['created_by'] == $rec_acc->assigned_user_id){
				$history_row .= "<tr><td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$newDate;
				$history_row .= ", <td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>  by ".$rowNOTE['first_name']." ".$rowNOTE['last_name'] ;
				$history_row .= "<b> : </td><td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rowNOTE['description']."</td>";
				//by anuradha 20-03-2012
				$history_row .= "<td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$subcase_data."</b></td>";
			}
			
			else if($current_user->id == $rowNOTE['created_by'] ){ //$rowNOTE['assigned_user_id']
				
				$history_row .= "<tr><td style='color:#00CCFF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$newDate;
				$history_row .= ", <td style='color:#00CCFF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>  by ".$rowNOTE['first_name']." ".$rowNOTE['last_name'] ;
				$history_row .= "<b> : </td><td style='color:#00CCFF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rowNOTE['description']."</td>";
				//by anuradha 20-03-2012
				$history_row .= "<td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$subcase_data."</b></td>";
			}	
			else{
				$history_row .= " <tr><td style='color:#5280B1; border-bottom: 1px solid #C1DAD7;";
				$history_row .= " border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$newDate;
				$history_row .= " ,<td style='color:#5280B1;border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; "; 
				$history_row .= " padding:6px 6px 6px 12px'><b>  by ".$rowNOTE['first_name']." ".$rowNOTE['last_name'] ;
				$history_row .= " <b> : </td><td style='color:#5280B1;border-bottom: 1px solid #C1DAD7; border-top: ";
				$history_row .= " 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rowNOTE['description']."</b></td>";
				//by anuradha 20-03-2012
				$history_row .= "<td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$subcase_data."</b></td>";
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
				$this->ss->assign('BTN_CANCEL',  $btnCancel);
			}
		}
		
/**********************************************************************************************************************/

		// CLAIM PRIORITY FOR UTILITY PATENT. Date : 07-Feb-2012.
		
		$sql_claim_priority = "SELECT * FROM cp_claimpriority WHERE acase_id_c = '".$this->bean->id."' AND deleted = '0'";
		$res_claim_priority = $db->query($sql_claim_priority);
		
		$claimed_cases .= " <table border='1' width = '100%'><tr><th width = '10%' style='text-align:left;border-bottom: 1px solid ";
		$claimed_cases .= " #C1DAD7;letter-spacing: 2px;padding: 6px 6px 6px 12px;text-transform: uppercase;'>Case Number</th> "; 
		$claimed_cases .= " <th width = '15%' style='border-bottom: 1px solid #C1DAD7; letter-spacing: 2px;";
		$claimed_cases .= " padding: 6px 6px 6px 12px;text-align:left;'>Application Type </th>";
		
		$claimed_cases .= " <th width = '15%' style='border-bottom: 1px solid #C1DAD7;letter-spacing: 2px;text-align:left; ";
		$claimed_cases .= " padding: 6px 6px 6px 12px;'>Filing Date </th><th width = '15%'  style='border-bottom: 1px solid #C1DAD7; ";
		$claimed_cases .= " letter-spacing: 2px;padding: 6px 6px 6px 12px; text-align:left;'>Application Number</th>";
		
		$claimed_cases .= " <th width = '10%' style='border-bottom: 1px solid #C1DAD7;letter-spacing: 2px;text-align:left;";
		$claimed_cases .= " padding: 6px 6px 6px 12px;'>Country </th><th width = '15%'  style='border-bottom: 1px solid #C1DAD7;";
		
		$claimed_cases .= " <th width = '10%'  style='border-bottom: 1px solid #C1DAD7; letter-spacing: 2px;padding: 6px 6px 6px 12px;'>Action</th></tr>";
		while($row_sql_claim_priority = $db->fetchByAssoc($res_claim_priority)){
			
			$fdt_or = $row_sql_claim_priority['filing_date'];
   		        $fdt_new = date("m/d/Y", strtotime($fdt_or));
			$case_obj = new aCase();
			$rec_case = $case_obj->retrieve($row_sql_claim_priority['claimed_case_id']);
			
			$case_type_obj = new c_case_type();
			$rec_case_type = $case_type_obj->retrieve($rec_case->type);
						
			$claimed_cases .= "<tr><td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b><a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26offset%3D3%26stamp%3D1331663471023037300%26return_module%3DCases%26action%3DDetailView%26record%3D".$row_sql_claim_priority['claimed_case_id']."'>".$rec_case->case_number."</a>";
			$claimed_cases .= " <td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b> ".$rec_case_type->name ;
			$claimed_cases .= " </td><td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rec_case->filing_date."</td>";
			$claimed_cases .= " </td><td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rec_case->application_number."</td>";
			
			$claimed_cases .= "<td></td>";
			$claimed_cases .= " <td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; ";
			// $claimed_cases .= " padding:6px 6px 6px 12px'> <img  src='edit.png' onclick='edit_claim(this.id);' ";
			//$claimed_cases .= " id='" .$row_sql_claim_priority['id']. "' name='" .$row_sql_claim_priority['id']."' /> <img src='delete.png' ";
			
			$claimed_cases .= " padding:6px 6px 6px 12px'>  <img src='delete.png' ";			
			$claimed_cases .= " onclick='removeCase(this.id,1);' id='" .$row_sql_claim_priority['id']. "' name='" .$row_sql_claim_priority['id']."' /></td></tr>";
			
		}
		
		$sql_no_possession = "SELECT * FROM cp_claim_no_possession WHERE acase_id_c = '".$this->bean->id."' AND deleted = '0'";
		$res_no_possession = $db->query($sql_no_possession);
		while($row_no_possession = $db->fetchByAssoc($res_no_possession)){
			
			$fdt_nop_or = $row_no_possession['filing_date'];
   		        $fdt_nop_new = date("m/d/Y", strtotime($fdt_nop_or));
			$claimed_cases .= "<tr><td></td>";
			$claimed_cases .= " <td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b> ".$row_no_possession['application_type'] ;
			$claimed_cases .= " </td><td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$fdt_nop_new."</td>";
			$claimed_cases .= " </td><td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$row_no_possession['application_no']."</td>";
			
			$claimed_cases .= "<td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$row_no_possession['country']."</td>";
			
			$claimed_cases .= " <td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; ";
			$claimed_cases .= " padding:6px 6px 6px 12px'> <img  src='edit.png' onclick='edit_claim(this.id);' ";
			$claimed_cases .= " id='" .$row_no_possession['id']. "' name='" .$row_no_possession['id']."' /> <img src='delete.png' ";
			$claimed_cases .= " onclick='removeCase(this.id,2);' id='" .$row_no_possession['id']. "' name='" .$row_no_possession['id']."' /></td></tr>";
		}
	
	if($row_Case_Type['name'] != "Trademark"){
		
		$this->ss->assign('CLAIMED_CASES',  $claimed_cases);
		$this->ss->assign('CLAIM',  "Claim Priority");
	}

/**********************************************************************************************************************/	

/******************************************* PRIORITY CLAIMED BY CASES ************************************************/
	// DATE : 11-Jun-2012.
	
	    $sql_priority_claimed_by = "SELECT * FROM cp_claimpriority WHERE `claimed_case_id` = '".$this->bean->id."' AND deleted = '0'";
		$res_priority_claimed_by = $db->query($sql_priority_claimed_by);
		
		$claimed_by .= " <table border='1' width = '100%'><tr><th width = '10%' style='text-align:left;border-bottom: 1px solid ";
		$claimed_by .= " #C1DAD7;letter-spacing: 2px;padding: 6px 6px 6px 12px;text-transform: uppercase;'>Case Number</th> "; 
		$claimed_by .= " <th width = '15%' style='border-bottom: 1px solid #C1DAD7; letter-spacing: 2px;";
		$claimed_by .= " padding: 6px 6px 6px 12px;text-align:left;'>Application Type </th>";
		
		$claimed_by .= " <th width = '15%' style='border-bottom: 1px solid #C1DAD7;letter-spacing: 2px;text-align:left; ";
		$claimed_by .= " padding: 6px 6px 6px 12px;'>Filing Date </th><th width = '15%'  style='border-bottom: 1px solid #C1DAD7; ";
		$claimed_by .= " letter-spacing: 2px;padding: 6px 6px 6px 12px; text-align:left;'>Application Number</th>";
		
		$claimed_by .= " <th width = '10%' style='border-bottom: 1px solid #C1DAD7;letter-spacing: 2px;text-align:left;";
		$claimed_by .= " padding: 6px 6px 6px 12px;'>Country </th>";
		
		while($row_priority_claimed_by = $db->fetchByAssoc($res_priority_claimed_by)){
			
			$case_obj_by= new aCase();
			$rec_case_by = $case_obj_by->retrieve($row_priority_claimed_by['acase_id_c']);
			
			$fdt = $rec_case_by->filing_date;
			if($fdt != ""){
	   		    $fdt_new = date("m/d/Y", strtotime($fdt));
			}
			$case_type_obj_by = new c_case_type();
			$rec_case_type_by = $case_type_obj_by->retrieve($rec_case_by->type);
			
			$claimed_by .= "<tr><td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b><a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26offset%3D3%26stamp%3D1331663471023037300%26return_module%3DCases%26action%3DDetailView%26record%3D".$row_priority_claimed_by['acase_id_c']."'>".$rec_case_by->case_number."</a>";
			$claimed_by .= " <td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b> ".$rec_case_type_by->name ;
			$claimed_by .= " </td><td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$fdt_new."</td>";
			$claimed_by .= " </td><td style='color:#000000; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rec_case_by->application_number."</td>";
			
			$claimed_by .= "<td></td></tr>";
			
						
		}
	
	if($row_Case_Type['name'] != "Trademark"){
		$this->ss->assign('PRIORITY_CLAIM_BY',  $claimed_by);
		$this->ss->assign('PRIORITY_CLAIMED_BY',  "Priority Claimed By : ");
	}

/**********************************************************************************************************************/	


		echo $this->dv->display();
		
		
 	} 	
}

?>
