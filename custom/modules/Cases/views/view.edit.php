<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

/*********************************************************************************
 * SugarCRM is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004 - 2009 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/

require_once('include/json_config.php');
require_once('include/MVC/View/views/view.edit.php');

class CasesViewEdit extends ViewEdit {

	// Author : Basudeba Rath. Date : 30-Jan-2012.
	public $useForSubpanel = true;

 	function CasesViewEdit(){
 		parent::ViewEdit();
 	}

 	
 	function display(){
		
		global $current_user,$db,$app_list_strings,$app_strings;
		
		/**************************************************************************************************
			Author : Basudeba Rath.
			Dt.: 01-Dec-2011.
			Veon Consulting pvt. ltd.
		
		*************************************************************************************************/
     
	  	$this->ss->assign("BEAN_ID",  $this->bean->id);

		// Date : 07-May-2012.
		$this->ss->assign("CONSULTANT_NAME",  $this->bean->client_consultant_name);
		$this->ss->assign("CONSULTANT_ID",  $this->bean->client_consultant_id);
		/*-------------------------------------------------------------------------*/

		$this->ss->assign("SEARCH_TYPE_LABEL", "display:none");
		$this->ss->assign("SERARCHTYPE", "display:none");
		$this->ss->assign("BTN_CLAIM", "display:none");
		$this->ss->assign("CLAIM_DIV", "display:none");
		$this->ss->assign("DUE_DATE", "display:none");
		$this->ss->assign("LBL_ASSIGNED_TO", "display:none");	
		$this->ss->assign("ASSIGNED_TO", "display:none");

	  	$acl_role = new ACLRole();
		$user_role = $acl_role->getUserRoles($current_user->id);
		
		if($user_role[0] == 'manager'){
			$this->ss->assign("USER_LISTS", "display:block");
		}
		else{
			$this->ss->assign("USER_LISTS", "display:none");
		}
		if(isset($this->bean->id)){
			
			$sql_acc = "SELECT id,name,assigned_user_id from accounts where id = '".$this->bean->account_id."' AND deleted = '0' ";
			$res_acc = $db->query($sql_acc);
			$row_acc = $db->fetchByAssoc($res_acc);
			$this->ss->assign("ACC_DESC", $row_acc['name']);
			$this->ss->assign("ACC_ID", $this->bean->account_id);
			
			
			$inv_array = array();
						
			if($row_acc['assigned_user_id'] !=  $current_user->id){
				$this->ss->assign("DISABLE", 'disabled="disabled"');
			}
			else{
				$this->ss->assign("DISABLE", " ");
			}
			if($user_role[0] == 'manager'){
				$this->ss->assign("DISABLE", " ");
			}
			
			/************************
                         * Rajesh G - 04/05/12
                         * Invention name display
                         ************************/
                        if($this->bean->relatedtoparent == "Invention"){
                            $invSpanDisplay = 'black';
                            $tmSpanDisplay = 'none';
                        }
                        else
                        {
                            $invSpanDisplay = 'none';
                            $tmSpanDisplay = 'block';
                        }
			$relatedTo = '<span id="inv-popup" style="display:'.$invSpanDisplay.'"><input type="text" name="invention_name" class="sqsEnabled" tabindex="103" id="invention_name" size="25" value="'.$this->bean->invention_name.'" title=\'\' autocomplete="off" >
						<input type="hidden" name="invention_id" id="invention_id" value="'.$this->bean->invention_id.'">
						<input type="button" name="btn_invention_cases_c" id="btn_invention_cases_c" tabindex="103" title="'.$app_strings['LBL_SELECT_BUTTON_TITLE'].'" accessKey="'.$app_strings['LBL_SELECT_BUTTON_KEY'].'" class="button" value="'.$app_strings['LBL_SELECT_BUTTON_LABEL'].'" onclick="open_popup(\'Inv_Inventions\', 600, 400, \'&inv_inventions_accounts_name=\'+ document.getElementById(\'client_name_popup\').value+\'&inv_inventd1acccounts_ida=\'+document.getElementById(\'client_id_popup\').value, true, false, {\'call_back_function\':\'set_return\',\'form_name\':\'EditView\',\'field_to_name_array\':{\'id\':\'invention_id\',\'name\':\'invention_name\'}}, \'single\', true);this.form.invention_name.focus();">
						<input type="button" name="btn_clr_invention_cases_c" id="btn_invention_cases_c" tabindex="103" title="{$APP.LBL_CLEAR_BUTTON_TITLE}" accessKey="'.$app_strings['LBL_CLEAR_BUTTON_KEY'].'" class="button" onclick="this.form.invention_name.value = \'\';this.form.invention_id.value = \'\';" value="'.$app_strings['LBL_CLEAR_BUTTON_LABEL'].'">
			<script type="text/javascript">
				enableQS(false);
			</script></span>';
			$relatedTo .= '<span id="tm-popup" style="display:'.$tmSpanDisplay.'"><input type="text" name="trade_trademark_cases_name" class="sqsEnabled" tabindex="103" id="trade_trademark_cases_name" size="25" value="'.$this->bean->trade_trademark_cases_name.'" title=\'\' autocomplete="off">
						<input type="hidden" name="trade_trademark_casestrade_trademark_ida" id="trade_trademark_casestrade_trademark_ida" value="'.$this->bean->trade_trademark_casestrade_trademark_ida.'">
						<input type="button" name="btn_trademark_cases_c" id="btn_trademark_cases_c" tabindex="103" title="'.$app_strings['LBL_SELECT_BUTTON_TITLE'].'" accessKey="'.$app_strings['LBL_SELECT_BUTTON_KEY'].'" class="button" value="'.$app_strings['LBL_SELECT_BUTTON_LABEL'].'" onclick=" open_popup(\'trade_trademark\', 600, 400, \'&trade_trademark_accounts_name=\'+ document.getElementById(\'client_name_popup\').value+\'&trade_trademark_accountsaccounts_ida=\'+document.getElementById(\'client_id_popup\').value,true,false,{\'call_back_function\':\'set_return\',\'form_name\':\'EditView\',\'field_to_name_array\':{\'id\':\'trade_trademark_casestrade_trademark_ida\',\'name\':\'trade_trademark_cases_name\'}}, \'single\', true);this.form.login_name.focus();">
						<input type="button" name="btn_clr_trademark_cases_c" id="btn_trademark_cases_c" tabindex="103" title="'.$app_strings['LBL_CLEAR_BUTTON_TITLE'].'" accessKey="'.$app_strings['LBL_CLEAR_BUTTON_KEY'].'" class="button" onclick="this.form.trade_trademark_cases_name.value = \'\';this.form.trade_trademark_casestrade_trademark_ida.value = \'\';" value="'.$app_strings['LBL_CLEAR_BUTTON_LABEL'].'">
			<script type="text/javascript">
				enableQS(false);
			</script></span>'; 
                        
                        $this->ss->assign("RELATEPOPUP",$relatedTo);

			// Changes Date : 09-May-2012.
			$this->ss->assign("PATENT_NUMBER_HIDE", "display:none");	
						
			$caseTypeObj = new c_case_type();
			$record_Type = $caseTypeObj->retrieve($this->bean->type);
			if($record_Type->name == 'Patent Search'){
			
				//$this->ss->assign("SEARCH_PATENT","Patent Search");
				//$this->ss->assign("USER_LISTS", "display:none");
				$this->ss->assign("SEARCH_TYPE_LABEL", "display:block");
				$this->ss->assign("HIDE_SHOW", "display:block");
				$this->ss->assign("SERARCHTYPE", "display:block");

			}
			else if($record_Type->name == 'Provisional Patent'){
				//$this->ss->assign("HIDE_SHOW", "display:none");
				//$this->ss->assign("USER_LISTS", "display:block");
				
			}
			else if($record_Type->name == 'Utility Patent'){
				
				$this->ss->assign("CLAIM_DIV", "display:block");
				$this->ss->assign("BTN_CLAIM", "display:block");

				// Changes Date : 09-May-2012.
				$this->ss->assign("PATENT_NUMBER_HIDE", "display:block");
				$this->ss->assign("PATENT_NUMBER_VALUE", $this->bean->patent_number);
				
			}

		// CLAIM PRIORITY FOR International Patent. 
			
			else if($record_Type->name == 'International Patent'){
				$this->ss->assign("CLAIM_DIV", "display:block");
				$this->ss->assign("BTN_CLAIM", "display:block");

				// Changes Date : 09-May-2012.
				$this->ss->assign("PATENT_NUMBER_HIDE", "display:block");
				$this->ss->assign("PATENT_NUMBER_VALUE", $this->bean->patent_number);
			}
			else if($record_Type->name == 'Design Patent'){
			
				// Changes Date : 09-May-2012.
				$this->ss->assign("PATENT_NUMBER_HIDE", "display:block");
				$this->ss->assign("PATENT_NUMBER_VALUE", $this->bean->patent_number);
			}

			/* Retrieve contribute users to popups */
			
			$cont_list=array();
			
			$sql_cont = "SELECT `id`,`login_id` FROM `c_contribute` WHERE `case_id` = '".$this->bean->id."' AND deleted = '0'";
			$res_cont = $db->query($sql_cont);
			
			while($row_cont = $db->fetchByAssoc($res_cont)){
				
				$cont_list[] = $row_cont;
			}
			
			$item_count = 1;
			for($i=0; $i<sizeof($cont_list); $i++)
			{
				$userObj = new User();
				$rec_user = $userObj->retrieve($cont_list[$i]['login_id']);
				$name_user = $rec_user->first_name." ".$rec_user->last_name;

				$contHtml .= "<tr>";
				$contHtml .= "<td>";
				$contHtml .= "<table>";
				$contHtml .= '<tr>';
				
				$contHtml .= '<td>';
			
				$contHtml .= '<td><input type="text" name="login_name'.$item_count.'" class="sqsEnabled" tabindex="103" id="login_name'.$item_count.'" size="25" value = "'.$name_user.'" title="" autocomplete="off"><input type="hidden" name="login_id'.$item_count.'" id="login_id'.$item_count.'" value='.$rec_user->id.'></td>';
				
				$contHtml .= "<td><input type='button' name='btn_user_c".$item_count."' id='btn_user_c".$item_count."' tabindex='103' title='' accessKey='' class='button' value='Select' onclick=\" open_popup('Users', 600, 400, '', true, false, {'call_back_function':'set_return','form_name':'EditView','field_to_name_array':{'id':'login_id".$item_count."','name':'login_name".$item_count."'}}, 'single', true);this.form.login_name.focus();this.form.login_name.focus();\"></td>";
				
				$contHtml .= '<td><input id="btn_clr_account_c'.$item_count.'" class="button" type="button" value="Clear" onclick="this.form.login_name'.$item_count.'.value =  \'\';this.form.login_id'.$item_count.'.value =  \'\';" accesskey="C" title="Clear" name="btn_clr_account_c'.$item_count.'" tabindex="0"></td>';
				
				$contHtml .= '<td><input type = "hidden" id = "cont_id'.$item_count.'"  name =  "cont_id'.$item_count.'"  value = "'.$cont_list[$i]['id'].'"/></td>';
				
				$contHtml .= '</tr>';	    
				$contHtml .= "</table>";
				$contHtml .= "</td>";
				$contHtml .= "</tr>";
				$item_count++;
				
			}
		
			$this->ss->assign("item_count", ($item_count-1));
			$this->ss->assign("ITEM_ROWS", $contHtml);
				
			/**********************************************************************************/
			
		}else if(isset($_GET['client']) ){
		
			global $db;
			$clientId =$_GET['client'];
			$clientQuery = " SELECT name,id FROM accounts WHERE id='".$clientId."' AND deleted=0";
			$client_sql_result = $db->query($clientQuery);
			$client_row = $db->fetchByAssoc($client_sql_result);
			$clientName =  $client_row['name'];
	
			$this->ss->assign("ACC_DESC",$clientName);
			$this->ss->assign("ACC_ID", $clientId);
                        
		}	
		else{
			$this->ss->assign("ACC_DESC", $_REQUEST['account_name']);
			$this->ss->assign("ACC_ID", $_REQUEST['account_id']);
			$this->ss->assign("CLIENT_POPUP_NAME", $_REQUEST['account_name']); // Assign client name to editviewfooter.tpl file.
			$this->ss->assign("CLIENT_POPUP_ID", $_REQUEST['account_id']);
			
			// Auth : Basudeba Changes Date : 09-May-2012. when coming from client record, assigned user id populated on field.
			$consultant_user = new User();
			$rec_cons_user = $consultant_user->retrieve($_REQUEST['consultant_id']);
			$this->ss->assign("CONSULTANT_NAME", $rec_cons_user->first_name." ".$rec_cons_user->last_name);
			$this->ss->assign("CONSULTANT_ID", $_REQUEST['consultant_id']);
			/*------------------------------------------------------------------------------------------*/
                        
			/***********************
                         * Rajesh G - 04/05/12
                         * create new case
                         *********************/
                        $invPopup = '<input type="hidden" id="client_name_popup" name="client_name_popup" value="'.$_REQUEST['account_name'].'" />
                        <input type="hidden" id="client_id_popup" name="client_id_popup" value="'.$_REQUEST['account_id'].'" />';
                        $invPopup .= '<span id="inv-popup" style="display:none;"><input type="text" name="invention_name" class="sqsEnabled" tabindex="103" id="invention_name" size="25" value="'.$this->bean->invention_name.'" title=\'\' autocomplete="off" >
						
						<input type="hidden" name="invention_id" id="invention_id" value="'.$this->bean->invention_id.'">
			
						<input type="button" name="btn_invention_cases_c" id="btn_invention_cases_c" tabindex="103" title="'.$app_strings['LBL_SELECT_BUTTON_TITLE'].'" accessKey="{$APP.LBL_SELECT_BUTTON_KEY}" class="button" value="'.$app_strings['LBL_SELECT_BUTTON_LABEL'].'"  onclick="open_popup(\'Inv_Inventions\', 600, 400, \'&amp;inv_inventions_accounts_name=\'+ document.getElementById(\'client_name_popup\').value+\'&amp;inv_inventd1acccounts_ida=\'+document.getElementById(\'client_id_popup\').value, true, false, {\'call_back_function\':\'set_return\',\'form_name\':\'EditView\',\'field_to_name_array\':{\'id\':\'invention_id\',\'name\':\'invention_name\'}}, \'single\', true);this.form.invention_name.focus();">
			
						<input type="button" name="btn_clr_invention_cases_c" id="btn_invention_cases_c" tabindex="103" title="'.$app_strings['LBL_CLEAR_BUTTON_TITLE'].'" accessKey="{$APP.LBL_CLEAR_BUTTON_KEY}" class="button" onclick="this.form.invention_name.value = \'\';this.form.invention_id.value = \'\';" value="'.$app_strings['LBL_CLEAR_BUTTON_LABEL'].'">
			
			<script type="text/javascript">
			<!--
				enableQS(false);
			-->
			</script></span><span id="tm-popup" style="display:none;"><input type="text" name="trade_trademark_cases_name" class="sqsEnabled" tabindex="103" id="trade_trademark_cases_name" size="25" value="" title=\'\' autocomplete="off">
						
						<input type="hidden" name="trade_trademark_casestrade_trademark_ida" id="trade_trademark_casestrade_trademark_ida" value="{$TRADEMARK_ID}">
			
						<input type="button" name="btn_trademark_cases_c" id="btn_trademark_cases_c" tabindex="103" title="'.$app_strings['LBL_SELECT_BUTTON_TITLE'].'" accessKey="{$APP.LBL_SELECT_BUTTON_KEY}" class="button" value="'.$app_strings['LBL_SELECT_BUTTON_LABEL'].'" onclick=" open_popup(\'trade_trademark\', 600, 400, \'&amp;trade_trademark_accounts_name=\'+ document.getElementById(\'client_name_popup\').value+\'&amp;trade_trademark_accountsaccounts_ida=\'+document.getElementById(\'client_id_popup\').value,true,false,{\'call_back_function\':\'set_return\',\'form_name\':\'EditView\',\'field_to_name_array\':{\'id\':\'trade_trademark_casestrade_trademark_ida\',\'name\':\'trade_trademark_cases_name\'}}, \'single\', true);this.form.login_name.focus();">
					
						<input type="button" name="btn_clr_trademark_cases_c" id="btn_trademark_cases_c" tabindex="103" title="'.$app_strings['LBL_CLEAR_BUTTON_KEY'].'" accessKey="'.$app_strings['LBL_CLEAR_BUTTON_KEY'].'" class="button" onclick="this.form.trade_trademark_cases_name.value = \'\';this.form.trade_trademark_casestrade_trademark_ida.value = \'\';" value="'.$app_strings['LBL_CLEAR_BUTTON_LABEL'].'">
			
			<script type="text/javascript">
			<!--
				enableQS(false);
			-->
			</script></span>';
                        $this->ss->assign("RELATEPOPUP",$invPopup);
		}
		
						
		$this->ss->assign("USER_ID", $current_user->id);
		
		$CaseType_array = array();
		$CaseType_array[] = ''; 
		$trademark_arr_case_subpanel = array();

		$sql_CaseType = "SELECT `id`,`name` FROM `c_case_type` WHERE `deleted` = '0' ORDER BY  display_order asc";
		

		$res_CaseType = $db->query($sql_CaseType);
		while($row_CaseType = $db->fetchByAssoc($res_CaseType)) {
		
			if($_REQUEST['parent_type'] == "trade_trademark" && ($row_CaseType['name'] == 'Trademark' || $row_CaseType['name'] == 'Logo Design' || $row_CaseType['name'] == 'Other')){
				
				$trademark_arr_case_subpanel[$row_CaseType['id']] = $row_CaseType['name'];
			}
			if($this->bean->relatedtoparent == "Invention"){
				if($row_CaseType['name'] == 'Trademark' || $row_CaseType['name'] == 'Logo Design'){
					continue;
				}
			}
			if($this->bean->relatedtoparent == "Trademark"){
				if($row_CaseType['name'] == 'Marketing Material' || $row_CaseType['name'] == 'Virtual Prototype' || $row_CaseType['name'] == 'Drawings' || $row_CaseType['name'] == 'International Patent' || $row_CaseType['name'] == 'Utility Patent' || $row_CaseType['name'] == 'Design Patent' || $row_CaseType['name'] == 'Provisional Patent' || $row_CaseType['name'] == 'Patent Search'){
					continue;
				}
			}
			if($this->bean->relatedtoparent == ""){
				if($row_CaseType['name'] == 'Trademark' || $row_CaseType['name'] == 'Logo Design' || $row_CaseType['name'] == 'Marketing Material' || $row_CaseType['name'] == 'Virtual Prototype' || $row_CaseType['name'] == 'Drawings' || $row_CaseType['name'] == 'International Patent' || $row_CaseType['name'] == 'Utility Patent' || $row_CaseType['name'] == 'Design Patent' || $row_CaseType['name'] == 'Provisional Patent' || $row_CaseType['name'] == 'Patent Search'){
					continue;
				}
			}
			
			$CaseType_array[$row_CaseType['id']] = $row_CaseType['name']; 
			// For case subpanel in clients detailveiew. 
			$this->ss->assign("PANEL_CS_TYPE",get_select_options_with_id($CaseType_array, $this->bean->type));
		}
		$this->ss->assign("CASE_TYPE",get_select_options_with_id($CaseType_array, $this->bean->type));
		// For case subpanel in clients detailveiew. 
		$this->ss->assign("PANEL_CS_TYPE",get_select_options_with_id($CaseType_array, $this->bean->type));
		
/**********************************************************************************************************************/

		if($_REQUEST['parent_type'] == "trade_trademark"){
			
			// for Trademark parent module.
			
			
			$rel_parent_str = "<option value = 'Trademark' >Trademark</option>";
			$this->ss->assign("REL_PARENT",$rel_parent_str);
			$this->ss->assign("PANEL_CS_TYPE",get_select_options_with_id($trademark_arr_case_subpanel, $this->bean->type));

			$trademark_info = new trade_trademark();
			$rec_trd_info = $trademark_info->retrieve($_REQUEST['parent_id']);
		
			$this->ss->assign("ACC_SUBPANEL_NAME", $rec_trd_info->trade_trademark_accounts_name);
			$this->ss->assign("ACC_SUBPANEL_ID", $rec_trd_info->trade_trademark_accountsaccounts_ida);
		}
		else{
			// For related to parent in all parent detail view.
			
			$this->ss->assign("REL_PARENT",get_select_options_with_id($app_list_strings['relatedtoparent_list'], $this->bean->relatedtoparent));
			
			$this->ss->assign("ACC_SUBPANEL_NAME", $_REQUEST['account_name']);
			$this->ss->assign("ACC_SUBPANEL_ID", $_REQUEST['account_id']);
		}

/*******************************************************************************************************************/


		$CaseStatus_array = array();
		
		$sql_CaseStatus = "SELECT cs.id,cs.name,cr.c_case_type_c_case_statusc_case_status_idb from c_case_type ct,c_case_status cs, c_case_type_c_case_status_c cr WHERE ct.id = '".$this->bean->type."' and ct.id = cr.c_case_type_c_case_statusc_case_type_ida AND cr.c_case_type_c_case_statusc_case_status_idb = cs.id and cs.deleted = '0' ORDER BY  cs.order_no asc"; //by anuradha 9/aug/2012 : display_order
		$res_CaseStatus = $db->query($sql_CaseStatus);
		while($row_CaseStatus = $db->fetchByAssoc($res_CaseStatus)) {
		
			$CaseStatus_array[$row_CaseStatus['id']] = $row_CaseStatus['name']; 
		}
		$this->ss->assign("CASE_STATUS",get_select_options_with_id($CaseStatus_array, $this->bean->status));
		
                #Rajesh G - 07/05/12
		if(isset($this->bean->search_type))
                {
                    $this->ss->assign("SEARCH_TYPE",get_select_options_with_id($app_list_strings['case_search_type_dom'], $this->bean->search_type));
                }
                else
                {
                    $this->ss->assign("SEARCH_TYPE",get_select_options_with_id($app_list_strings['case_search_type_dom'], "ComprehensiveSearch"));
                }
		
		/**********************************************************************************************************************
			
			CONTRIBUTION AND CREDIT ALLOCATION SECTION.
			DATE : 04-JAN-2012.
			Veon Consulting Pvt. Ltd.
			
		**********************************************************************************************************************/
		
		$sql_cont_list = "SELECT c.id,c.`login_id`,c.credits, u.first_name,u.last_name FROM `c_contribute` c, users u 
						  WHERE c.`case_id` = '".$this->bean->id."' AND u.id = c.login_id 
						  AND c.deleted = '0' AND u.deleted = '0'";
						  
		$res_cont_list = $db->query($sql_cont_list);
		$i = 0;
		$cnt = 1;
		$cr_allocation =  "<tr>";
		while($row_cont_list = $db->fetchByAssoc($res_cont_list)){

			if($cnt == 2){
				$cnt = 0;
			}
			
			$cr_allocation .= "<td>".$row_cont_list['first_name'] . " " . $row_cont_list['last_name'] . "</td>";
			$cr_allocation .= "<td><input type = 'text' name = 'credits_".$i."' id = 'credits_".$i."' value = '".$row_cont_list['credits']."' /><input type = 'hidden' id = 'cid_".$i."' name = 'cid_".$i."' value = '".$row_cont_list['id']."' />";
			$cr_allocation .= "</td>";
			
			if($cnt == 0){
				$cr_allocation .= "</tr>";
			}
			$cnt++;
			$i++;
		}
				
		$this->ss->assign("CNT_VALUE", $i);
		$this->ss->assign("CREDIT_ALLOCATION", $cr_allocation);
		
		/************************* RELATED TO PARENT SECTION  ************************************/
		
		// Date :  16-Jan-2012.
		
		$this->ss->assign("RELATED_PARENT",get_select_options_with_id($app_list_strings['relatedtoparent_list'], $this->bean->relatedtoparent));
		

		$this->ss->assign("RIL", "display:none");	
		$this->ss->assign("TRADEMARK_POPUP", "display:none");	
		// Date : 20-Jan-2012.
		if(isset($this->bean->id)){
			$this->ss->assign("CLIENT_POPUP_NAME", $this->bean->account_name);
			$this->ss->assign("CLIENT_POPUP_ID", $this->bean->account_id);

			$this->ss->assign("INVENTION_NAME", $this->bean->invention_name);
			$this->ss->assign("INVENTION_ID", $this->bean->invention_id);
			$this->ss->assign("TRADEMARK_DESC", $this->bean->trade_trademark_cases_name);	
			$this->ss->assign("TRADEMARK_ID", $this->bean->trade_trademark_casestrade_trademark_ida);
			
			$this->ss->assign("CLM_EDIT", 1); // For Edit Claim Priority
		}
		else{
			$this->ss->assign("CLM_EDIT", 0); // For Create Claim Priority while creating case.
		}

		if($this->bean->relatedtoparent == "Invention"){
			$this->ss->assign("TRADEMARK_POPUP", "display:none");	
			$this->ss->assign("RIL", "display:block");	
			
			
		}
		else if($this->bean->relatedtoparent == "Trademark"){
			$this->ss->assign("RIL", "display:none");	
			$this->ss->assign("TRADEMARK_POPUP", "display:block");	
				
		}
/*************************************************************************************************/

/******************************************Ashok Client Code********************************************/
		
          global $current_user,$db,$app_list_strings;
 	  // $this->ss->assign("DIS",  "readonly = true"); // commented on - 16-Mar-2012.
	  $code = array();
	   	  if(!isset($this->bean->id)){
			  $sql_1=" SELECT max(CAST(substr(case_number,4)AS UNSIGNED)) AS maxnum FROM cases WHERE deleted=0 AND caseoverride=0 AND substr(case_number,4) >= 12000 ";
			  $result_1=$db->query($sql_1, true, 'Error MAX CODE Cases');
			  while($row_1=$GLOBALS['db']->fetchByAssoc($result_1)){
				   $code[] = $row_1;
			  }	   
			  $numrows = count($result_1);
			  if($numrows == 0){
				  $num = 12000;
				  $num = $num + 1;
				  $caseCodeNum = "T".$typeCode."12000".$num;		
			  }else {
					$string_slice = $code[0]['maxnum'];
					$abc = $string_slice+1;
					$caseCodeNum = "T".$abc;
			  }
			  $this->ss->assign("CASECOUNT",$caseCodeNum);
			 
			// Basudeba Rath, Date : 30-Jan-2012.	
			  $this->ss->assign("CS_NO",  $caseCodeNum);	
		 }else{
		     $this->ss->assign("CASECOUNT",$this->bean->case_number);	
		
		// Basudeba Rath, Date : 30-Jan-2012.
		     $this->ss->assign("CS_NO",  $caseCodeNum);	
		 }
		
		if($this->bean->caseoverride== 1){
			 $this->ss->assign("CHECKED_CHECK","checked=checked");	
			// $this->ss->assign("DIS",  "disabled"); // commented on - 16-Mar-2012.
			// $this->ss->assign('CHK_DIS','disabled = "disabled"'); // commented on - 16-Mar-2012.
		}else{     
			 $this->ss->assign("CHECKED_CHECK","");
			 $this->ss->assign('CHK_DIS','');
		}

// Date : 01-Mar-2012.
//Author : Basudeba Rath.
	 
	   $cs_type_obj = new c_case_type();
	   $rec_cs_type = $cs_type_obj->retrieve($this->bean->type);
				
	   $cs_status_obj = new c_case_status();
	   $rec_status_obj = $cs_status_obj->retrieve($this->bean->status);

	   if($rec_cs_type->name == "Provisional Patent" || $rec_cs_type->name == "Design Patent" || $rec_cs_type->name == "Utility Patent" || $rec_cs_type->name == "International Patent" ){
			if($this->bean->filing_date != "" || $app_no1 != ""){
				$filing_date1 = "<input type = 'text' id = 'filing_date' name = 'filing_date' value = '".$this->bean->filing_date."' /><img border='0' src='themes/Sugar5/images/jscalendar.gif?s=56edbfd31f58ddaef7105e2f7049754f&c=1' alt='Enter Date' id='created_trigger_af' align='absmiddle' />";
				$app_no1 = "<input type = 'text' id = 'application_number' name = 'application_number' value = '".$this->bean->application_number."' />";
				
			}
			else{
				$filing_date1 = "<input type = 'text' id = 'filing_date' name = 'filing_date' disabled='disabled'/>";
				$app_no1 = "<input type = 'text' id = 'application_number' name = 'application_number' disabled='disabled' />";
			}

// Author : Basudeba Rath, Date : 22-Jun-2012.

			if($this->bean->freceipt == 0){
			
				$this->ss->assign('F_RECEIPT', "");
				$this->ss->assign('FRECIPT_VALUE', "0");
			}
			else{
			
				$this->ss->assign('F_RECEIPT', "checked='checked'");
				$this->ss->assign('FRECIPT_VALUE', "1");
			}
			
	    }
	    else{
			$filing_date1 = "<input type = 'text' id = 'filing_date' name = 'filing_date' disabled='disabled'/>";
			$app_no1 = "<input type = 'text' id = 'application_number' name = 'application_number' disabled='disabled' />";
			$this->ss->assign('F_RECEIPT', "disabled='disabled'");
	    }
	    $this->ss->assign('FILING_DATE', $filing_date1);
	    $this->ss->assign('APP_NO', $app_no1);

// Date : 11-mar-2012. TM filing section edit.
// Author : Basudeba Rath.
		
		if($rec_cs_type->name == "Trademark"){
		 
		 	if($this->bean->tm_filing_date != "" || $this->bean->tm_application_number != "" || $this->bean->tm_registration_date != "" || $this->bean->tm_registration_number != ""){
				
				$tm_filing_date1 = "<input type = 'text' id = 'tm_filing_date' name = 'tm_filing_date' value = '".$this->bean->tm_filing_date."' /><img border='0' src='themes/Sugar5/images/jscalendar.gif?s=56edbfd31f58ddaef7105e2f7049754f&c=1' alt='Enter Date' id='created_trigger_tm_af' align='absmiddle' />";
				$tm_app_no1 = "<input type = 'text' id = 'tm_application_number' name = 'tm_application_number' value = '".$this->bean->tm_application_number."' />";
				
				$tm_registration_date1 = "<input type = 'text' id = 'tm_registration_date' name = 'tm_registration_date' value = '".$this->bean->tm_registration_date."' /><img border='0' src='themes/Sugar5/images/jscalendar.gif?s=56edbfd31f58ddaef7105e2f7049754f&c=1' alt='Enter Date' id='created_trigger_tm_rd' align='absmiddle' />";
				
				$tm_reg_no1 = "<input type = 'text' id = 'tm_registration_number' name = 'tm_registration_number' value = '".$this->bean->tm_registration_number."' />";
				
				
			}	
			else{
				$tm_filing_date1 = "<input type = 'text' id = 'tm_filing_date' name = 'tm_filing_date' disabled='disabled' />";
				$tm_app_no1 = "<input type = 'text' id = 'tm_application_number' name = 'tm_application_number' disabled='disabled' />";
				
				$tm_registration_date1 = "<input type = 'text' id = 'tm_registration_date' name = 'tm_registration_date' disabled='disabled' />";
				
				$tm_reg_no1 = "<input type = 'text' id = 'tm_registration_number' name = 'tm_registration_number' disabled='disabled' />";
			}
		}
		else{
				$tm_filing_date1 = "<input type = 'text' id = 'tm_filing_date' name = 'tm_filing_date' disabled='disabled' />";
				$tm_app_no1 = "<input type = 'text' id = 'tm_application_number' name = 'tm_application_number' disabled='disabled' />";
				
				$tm_registration_date1 = "<input type = 'text' id = 'tm_registration_date' name = 'tm_registration_date' disabled='disabled' />";
				
				$tm_reg_no1 = "<input type = 'text' id = 'tm_registration_number' name = 'tm_registration_number' disabled='disabled' />";
			}
		$this->ss->assign('TM_FILING_DATE', $tm_filing_date1);
	    $this->ss->assign('TM_APP_NO', $tm_app_no1);
		$this->ss->assign('TM_REG_DT', $tm_registration_date1);
	    $this->ss->assign('TM_REG_NO', $tm_reg_no1);

/****************************************EOC *****************************************************/		

		if(!isset($this->bean->id)){
		
$js =<<<EOD1
		<script type='text/javascript' >
			
				document.getElementById("_label").style.display='none';
				document.getElementById("case_number").style.display='none';
				document.getElementById("caseoverride").style.display='none';
			
        </script>
EOD1;
		
	}
		parent::display();
		
		echo $js;
		
	
 	} 	 
}
?>
