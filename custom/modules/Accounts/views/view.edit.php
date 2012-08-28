<?php if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/********************************************************************************* * 
SugarCRM is a customer relationship management program developed by * SugarCRM, Inc. 
Copyright (C) 2004 - 2009 SugarCRM Inc. *  * This program is free software; you can 
redistribute it and/or modify it under * the terms of the GNU General Public License 
version 3 as published by the * Free Software Foundation with the addition of the 
following permission added * to Section 15 as permitted in Section 7(a): FOR ANY 
PART OF THE COVERED WORK * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM 
DISCLAIMS THE WARRANTY * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS. *  * This program 
is distributed in the hope that it will be useful, but WITHOUT * ANY WARRANTY; without 
even the implied warranty of MERCHANTABILITY or FITNESS * FOR A PARTICULAR PURPOSE.  
See the GNU General Public License for more * details. *  * You should have received 
a copy of the GNU General Public License along with * this program; if not, see 
http://www.gnu.org/licenses or write to the Free * Software Foundation, Inc., 
51 Franklin Street, Fifth Floor, Boston, MA * 02110-1301 USA. *  * You can contact 
SugarCRM, Inc. headquarters at 10050 North Wolfe Road, * SW2-130, Cupertino, CA 95014, 
USA. or at email address contact@sugarcrm.com. *  * The interactive user interfaces 
in modified source and object code versions * of this program must display Appropriate 
Legal Notices, as required under * Section 5 of the GNU General Public License version 
3. *  * In accordance with Section 7(b) of the GNU General Public License version 3, * 
these Appropriate Legal Notices must retain the display of the "Powered by * SugarCRM" 
logo. If the display of the logo is not reasonably feasible for * technical reasons, 
the Appropriate Legal Notices must display the words * "Powered by SugarCRM". ********************************************************************************/

require_once('include/json_config.php');
require_once('include/MVC/View/views/view.edit.php');
class AccountsViewEdit extends ViewEdit { 		
function AccountsViewEdit(){ 				
parent::ViewEdit(); } 	 		
function display(){				
global $current_user,$db,$app_list_strings;								
$count = 0;					
if(isset($this->bean->id)){						
$custm_code1  ="<table><tr><td><input type='button' value='Add' onclick='add(\"tbl_name\");'/></td><td align=right width=160>Primary</td></tr></table>";						
$custm_code1 .="<table id ='tbl_name' name='tbl_name' >";									
global $app_strings,$current_user;						
$sqlPHONE = "SELECT `phone_no`,`primary_no` FROM `ph_phoneno` WHERE `account_id_c` = '".$this->bean->id."' AND deleted='0'";						
$resPHONE = $db->query($sqlPHONE);						
while($rowPHONE = $db->fetchByAssoc($resPHONE)){								

$custm_code1 .= "<tr id=ta".$count." name='ta'><td><input type='text' name='phone_no".$count."'"." id='phone_no".$count."'"." value = '".$rowPHONE['phone_no']."' /></td>";   											
$custm_code1 .= "<td><input type='button' id = 'delbutton".$count."'"." name = 'delbutton".$count."'"." value='-' onclick='removeElement(document.getElementById(".'"ta'.$count.'"'."),this.id);'/></td>";																									
if($rowPHONE['primary_no']==1)				{								
$custm_code1 .="<td><input type = 'radio' name = 'primary0' id = 'primary".$count."'"." checked='checked' value = '".$count."' />	</td></tr>";								
}							
else{								
$custm_code1 .="<td><input type = 'radio' name = 'primary0' id = 'primary".$count."'"." value = '".$count."' />	</td></tr>";	
}							
$count++;						
}									
$custm_code1 .="</table><input id = 'count' name = 'count' type = hidden value='".$count."' />";						
$this->ss->assign('PHONENOS', $custm_code1);                                                  			
/* *******************                         			
* Rajesh G - 11/06/12                         			
* Email customisation                         			
* ******************* */                        			
$custm_code1  ='<table style="text-align:center;">
	<tr>                            
		<td width=160px align=left><input type="button" value="Add" onclick="add(\'tbl_email\');"/></td>
		<td align=right width=40px>Primary</td>                            
		<td width=65px>&nbsp Opted Out</td>                            
		<td width=60px>Invalid</td>                            
	</tr></table>';			
$custm_code1 .="<table id ='tbl_email' name='tbl_email' style='text-align:center;'>
				<thead><tr>                                
				<th width='100px'></th>                                
				<th width='30px'></th>
				<th width='30px'></th>
				<th width='40px'></th>
				<th width='50px'></th>
			</tr></thead>";						
$count = 0;						
global $app_strings,$current_user;						
$email_addr_query = "SELECT
		email_addresses.email_address,
		email_addr_bean_rel.primary_address,
		email_addresses.invalid_email,
		email_addresses.opt_out
		FROM email_addresses                            
		INNER JOIN email_addr_bean_rel                                 
		ON email_addr_bean_rel.email_address_id = email_addresses.id
		INNER JOIN accounts                                 
		ON accounts.id = email_addr_bean_rel.bean_id 
		WHERE accounts.id = '".$this->bean->id."'
		AND email_addresses.deleted = '0' AND 
		accounts.deleted = '0' AND    
		email_addr_bean_rel.deleted = '0'";						
$res_email = $db->query($email_addr_query);			
$primary_email_status_msg = '';                        			
while($row_email = $db->fetchByAssoc($res_email)){                                			
	$is_opt_out ='';                                    			
	if($row_email['opt_out'] == 1)                                        			
	$is_opt_out = "checked";                                			
	$is_invalid = '';                                			
	if($row_email['invalid_email'] == 1)                                    			
	$is_invalid = "checked";							
	$custm_code1 .= "<tr id=tg".$count." name='ta'><td  align=left><input type='text' name='Accounts0emailAddress".$count."'"." id='Accounts0emailAddress".$count."'"." value = '".$row_email['email_address']."' onchange='onChgCheckPrimary(this.id)'/></td>";   								
	$custm_code1 .= "<td><input type='button' id = 'delbutton".$count."'"." name = 'delbutton".$count."'"." value='-' onclick='removeElement(document.getElementById(".'"tg'.$count.'"'."),this.id);'/></td>";																							
	if($row_email['primary_address']==1)				{								
	$custm_code1 .="<td><input type = 'radio' name = 'Accounts0emailAddressPrimaryFlag' id = 'Accounts0emailAddressPrimaryFlag".$count."'"." checked='checked' value = '".$count."' onclick='checkPrimary(this.id)'/></td>";							
	}							
	else{								
	$custm_code1 .="<td><input type = 'radio' name = 'Accounts0emailAddressPrimaryFlag' id = 'Accounts0emailAddressPrimaryFlag".$count."'"." value = '".$count."' onclick='checkPrimary(this.id)'/></td>";				
	}                                                                			
	$custm_code1 .='<td align="center"><input type="checkbox" name="Accounts0emailAddressOptOutFlag[]" id="Accounts0emailAddressOptOutFlag'.$count.'"  value="Accounts0emailAddress'.$count.'" enabled="true" tabindex="0" '.$is_opt_out.'></td>';                                
	$custm_code1 .='<td align="center"><input type="checkbox" name="Accounts0emailAddressInvalidFlag[]" id="Accounts0emailAddressInvalidFlag'.$count.'" value="Accounts0emailAddress'.$count.'" enabled="true" tabindex="0" '.$is_invalid.'></td></tr>';                                			
	$custm_code1 .='</tr>';							
	$count++;                                                               			
	/* *******************                                			
	* Email validation                                 			
	* when editing record                                			
	* ******************* */                                			
	$query = "SELECT
		accounts.first_name, 
		accounts.last_name, 
		ph_phoneno.phone_no, 
		accounts.id AS acc_id  
		FROM                                    
		accounts    
		INNER JOIN email_addr_bean_rel ON email_addr_bean_rel.bean_id = accounts.id 
		INNER JOIN email_addresses ON email_addresses.id = email_addr_bean_rel.email_address_id  
		INNER JOIN ph_phoneno ON ph_phoneno.account_id_c = accounts.id   
		WHERE                                    
		email_addr_bean_rel.primary_address = '1' AND  
		email_addresses.email_address = '" . $row_email['email_address'] . "' AND  
		accounts.deleted = '0' AND            
		email_addr_bean_rel.deleted = '0' AND  
		email_addresses.deleted = '0' AND      
		ph_phoneno.deleted = '0'            
		AND ph_phoneno.primary_no = '1' AND accounts.id != '" . $this->bean->id . "'";                                			
	$result = $db->query($query);                                			
	$row = $db->fetchByAssoc($result);                               			
	if(!empty($row['acc_id'])){                                                                        			
	$disable_save_btn = true;                                    			
	$primary_email_status_msg =  "Primary email address already associated with client:<br/>".                                    $row['first_name'] . " " . $row['last_name'] . "<br/>" . $row['phone_no'].                                    "<br/>Open this client record in new window? &nbsp&nbsp                                        <a href='http://".$_SERVER['HTTP_HOST']."/thoughts_crm/index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DAccounts%26offset%3D1%26stamp%3D1339832505074581700%26return_module%3DAccounts%26action%3DDetailView%26record%3D".$row['acc_id']."' target='_new'><b>Yes</b></a>                                    | No"; 
	}			
}
if($count == 0){
	$custm_code1 .="<tr id='tg' name='tg' ><td align=left><input type='text' name='Accounts0emailAddress0' id='Accounts0emailAddress0' onchange='onChgCheckPrimary(this.id)'/></td>                            
	<td><input type='button' id = 'delbutton0' name = 'delbutton0' value='-' onclick='removeElement(document.getElementById(" . '"tg"' . "),this.id);'/></td>                                
	<td><input type = 'radio' name = 'Accounts0emailAddressPrimaryFlag' id = 'Accounts0emailAddressPrimaryFlag0' value = '0' onclick='checkPrimary(this.id)' checked /></td>                                </td>
	<td><input type='checkbox' name='Accounts0emailAddressOptOutFlag[]' id='Accounts0emailAddressOptOutFlag0' value='Accounts0emailAddress0' enabled='true' ></td>                                
	<td align='center'><input type='checkbox' name='Accounts0emailAddressInvalidFlag[]' id='Accounts0emailAddressInvalidFlag0' value='Accounts0emailAddress0' enabled='true' tabindex='0'></td>                                                            
	</tr>";
	$count++;
}						
$custm_code1 .="</table><input id = 'emailCount' name = 'emailCount' type = hidden value='".$count."' />                            <input type='hidden' name='clientId' id='clientId' value='".$this->bean->id."'/>";                                               
$custm_code1 .="<span id='primaryStatusMsg'>".$primary_email_status_msg."</span>
<div id='email-status-msg' style='color:red;display:none'>Missing: Primary Email</div>";                        		
	//if($disable_save_btn)						
	$this->ss->assign('EMAIL', $custm_code1);                                                  			
	/*********G.B.R***********/					
}							
if(empty($this->bean->id)){						
global $app_strings;									
$custm_code  ="<table ><tr><td><input type='button' value='Add' onclick='add(\"tbl_name\");'/></td><td align=right width=160>Primary</td></tr></table>";			
$custm_code .="<table id ='tbl_name' name='tbl_name' ><tr id='ta' name='ta' ><td>";			
$custm_code .="<input type='text' name='phone_no0' id='phone_no0' /></td><td><input type='button' id = 'delbutton0' name = 'delbutton0' value='-' onclick='removeElement(document.getElementById(".'"ta"'."),this.id);'/></td><td><input type = 'radio' name = 'primary0' id = 'primary0' value = '0' /></td></tr></table>";			
$custm_code .='<input id = "count" name = "count" type = hidden value = 1 />';									
$this->ss->assign('PHONENOS', $custm_code);                                                 			
/* *******************                         			
* Rajesh G - 11/06/12                         			
* Email customisation                         			
* ******************* */                        			
$custm_code  ='<table style="text-align:center;"><tr>                            
<td width=160px align=left><input type="button" value="Add" onclick="add(\'tbl_email\');"/></td>  
  <td align=right width=40px>Primary</td>  
  <td width=65px>&nbsp Opted Out</td>         
  <td width=60px>Invalid</td>                        
  </tr></table>';						
$custm_code .="<table id ='tbl_email' name='tbl_email' style='text-align:center;'>        
	<thead><tr>          
	<th width='100px'></th>                         
	<th width='30px'></th>                        
	<th width='30px'></th>                         
	<th width='40px'></th>                           
	<th width='50px'></th>                    
	</tr></thead>";						
$custm_code .="<tr id='tg' name='tg' ><td align=left><input type='text' name='Accounts0emailAddress0' id='Accounts0emailAddress0' onchange='onChgCheckPrimary(this.id)'/></td>             
   <td><input type='button' id = 'delbutton0' name = 'delbutton0' value='-' onclick='removeElement(document.getElementById(".'"tg"'."),this.id);'/></td>                                
   <td><input type = 'radio' name = 'Accounts0emailAddressPrimaryFlag' id = 'Accounts0emailAddressPrimaryFlag0' value = '0' onclick='checkPrimary(this.id)' checked='checked'/></td>                               
   </td><td><input type='checkbox' name='Accounts0emailAddressOptOutFlag[]' id='Accounts0emailAddressOptOutFlag0' value='Accounts0emailAddress0' enabled='true' tabindex='0'></td>                                
   <td align='center'><input type='checkbox' name='Accounts0emailAddressInvalidFlag[]' id='Accounts0emailAddressInvalidFlag0' value='Accounts0emailAddress0' enabled='true' tabindex='0'></td>          
   </tr></table>";						
$custm_code .='<input id = "emailCount" name = "emailCount" type="hidden" value="1" />     
   <input type="hidden" name="clientId" id="clientId" value="" />          
   <span id="primaryStatusMsg"></span><div id="email-status-msg" style="color:red;display:none">Missing: Primary Email</div>';
$custm_code .= "";						
$this->ss->assign('EMAIL', $custm_code);                        			
/*********G.B.R*********/					
}					
parent::display(); 		
} 	
}?>