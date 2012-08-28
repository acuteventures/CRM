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

/*********************************************************************************************************************/		
		// Author : Basudeba Rath.
		// Dt. 13-Jan-2011.
		// Veon Consulting Pvt. Ltd.
/*********************************************************************************************************************/

require_once('include/MVC/View/views/view.detail.php');

class trade_trademarkViewDetail extends ViewDetail {


 	function trade_trademarkViewDetail(){
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
		global $db;
		       
   	
    $sql_applicant = "SELECT * FROM `trade_applicants` WHERE trademark_id = '".$this->bean->id."' AND deleted = '0' ";
	$res_applicant = $db->query($sql_applicant);
	$lineItemsHtml = "";
	
	while($row_applicant = $db->fetchByAssoc($res_applicant)){
			
		//$lineItemsHtml .= '<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="detail view">';
		
		$lineItemsHtml .= '<tr>';
		$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL">
						   <span sugar="slot3">'.$mod_strings['LBL_FIRST_NAME'].':</span></td>';
		$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF">
						   <span sugar="slot3b">'.$row_applicant['first_name'].'</span></td>';	
		$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL">
						   <span sugar="slot3">'.$mod_strings['LBL_LAST_NAME'].':</span></td>';
		$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF">
						   <span sugar="slot3b">'.$row_applicant['name'].'</span></td>';
		$lineItemsHtml .= '</tr>';
		
		
		$lineItemsHtml .= '<tr>';
		$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL">
						   <span sugar="slot3">'.$mod_strings['LBL_ADDRESS'].':</span></td>';
		$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF">
						   <span sugar="slot3b">'.$row_applicant['address'].'</span></td>';
		$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL">
						   <span sugar="slot3">'.$mod_strings['LBL_CITY'].':</span></td>';
		$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF">
						   <span sugar="slot3b">'.$row_applicant['city'].'</span></td>';
		$lineItemsHtml .= '</tr>';
		
		
		$lineItemsHtml .= '<tr>';
		$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL">
						   <span sugar="slot3">'.$mod_strings['LBL_STATE'].':</span></td>';
		$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF">
						   <span sugar="slot3b">'.$row_applicant['state'].'</span></td>';
		$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL">
						   <span sugar="slot3">'.$mod_strings['LBL_ZIPCODE'].':</span></td>';
		$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF">
						   <span sugar="slot3b">'.$row_applicant['zip_code'].'</span></td>';
		$lineItemsHtml .= '</tr>';
		
		
		$lineItemsHtml .= '<tr>';
		$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL">
						   <span sugar="slot3">'.$mod_strings['LBL_PHONE_NO'].':</span></td>';
		$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF">
						   <span sugar="slot3b">'.$row_applicant['phone_no'].'</span></td>';
		$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL">
						   <span sugar="slot3">'.$mod_strings['LBL_EMAIL_ADDRESS'].':</span></td>';
		$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF">
						   <span sugar="slot3b">'.$row_applicant['email_addr'].'</span></td>';
		$lineItemsHtml .= '</tr><tr><th></th><tr><th></th></tr>';
		
		//$lineItemsHtml .= ' </table>';
		//break;
	}

	$this->ss->assign('LINEITEMS_ROWS',    $lineItemsHtml);
		
/**********************************************************************************************************************/	

	// TRADEMARK HISTORY SECTION
	// AUTHOR : BASUDEBA RATH.
	// DATE : 19-JAN-2012.
							
		global $current_user;
		$this->ss->assign('TRADEMARK_HISTORY', "Trademark History");
		$this->ss->assign('BEAN_ID', $this->bean->id);
		$this->ss->assign('USER_ID', $current_user->id);
		
		$acl_role = new ACLRole();
		$user_role = $acl_role->getUserRoles($current_user->id);
			
		$sqlNOTE  = " SELECT n.id,n.assigned_user_id,n.description,n.date_entered,n.date_modified, ";
		$sqlNOTE .= " n.created_by, u.first_name,u.last_name FROM notes n,users u "; 
		$sqlNOTE .= " WHERE n.parent_id = '". $this->bean->id ."' AND n.deleted = '0' AND n.created_by = u.id";
		$resNOTE = $db->query($sqlNOTE);
		
		$history_row .= " <table border='1' width = '100%'><tr><th width = '10%' style='text-align:left; border-bottom: 1px solid ";
		$history_row .= " #C1DAD7;letter-spacing: 2px;padding: 6px 6px 6px 12px;text-transform: uppercase;'>Date & Time</th> "; 
		$history_row .= " <th width = '10%' style='text-align:left; border-bottom: 1px solid #C1DAD7; letter-spacing: 2px;";
		$history_row .= " padding: 6px 6px 6px 12px;'>User</th>";
		
		$history_row .= " <th width = '40%' style='border-bottom: 1px solid #C1DAD7;letter-spacing: 2px; text-align:left; ";
		$history_row .= " padding: 6px 6px 6px 12px;' align = 'left'>Comments</th><th width = '1%'  style='border-bottom: 1px solid #C1DAD7; ";
		$history_row .= " letter-spacing: 2px;padding: 6px 6px 6px 12px;'>Action</th></tr>";
		
		
		while($rowNOTE = $db->fetchByAssoc($resNOTE)){
		
			if($this->bean->assigned_user_id == $rowNOTE['created_by']){ //$current_user->id
				$history_row .= "<tr><td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rowNOTE['date_modified'];
				$history_row .= ", <td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>  by ".$rowNOTE['first_name'].$rowNOTE['last_name'] ;
				$history_row .= "<b> : </td><td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rowNOTE['description']."</td>";
			}
			
			else if($current_user->id == $rowNOTE['assigned_user_id']){
				
				$history_row .= "<tr><td style='color:#00CCFF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rowNOTE['date_modified'];
				$history_row .= ", <td style='color:#00CCFF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>  by ".$rowNOTE['first_name'].$rowNOTE['last_name'] ;
				$history_row .= "<b> : </td><td style='color:#00CCFF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rowNOTE['description']."</td>";
			}	
			else{
				$history_row .= " <tr><td style='color:#5280B1; border-bottom: 1px solid #C1DAD7;";
				$history_row .= " border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rowNOTE['date_modified'];
				$history_row .= " ,<td style='color:#5280B1;border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; "; 
				$history_row .= " padding:6px 6px 6px 12px'><b>  by ".$rowNOTE['first_name'].$rowNOTE['last_name'] ;
				$history_row .= " <b> : </td><td style='color:#5280B1;border-bottom: 1px solid #C1DAD7; border-top: ";
				$history_row .= " 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>".$rowNOTE['description']."</b></td>";
			}		
			$rec_Date = explode(" ",$rowNOTE['date_entered']);
			$expire_date = strtotime($rec_Date[0]);
			$today = strtotime(date("Y-m-d"));
			
			if($expire_date == $today){
				
				
				$history_row .= "<td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; ";
				$history_row .= " padding:6px 6px 6px 12px'> <img  src='edit.png' onclick='edit(this.id);' ";
				$history_row .= " id='" .$rowNOTE['id']. "' name='" .$rowNOTE['id']."' /> <img src='delete.png' ";
				$history_row .= " onclick='removeNotes(this.id);' id='" .$rowNOTE['id']. "' name='" .$rowNOTE['id']."' /></td></tr>";
			}	
			if($user_role[0] == 'manager' && $expire_date < $today){
			
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
		echo $this->dv->display();
		
		
 	} 	
}

?>