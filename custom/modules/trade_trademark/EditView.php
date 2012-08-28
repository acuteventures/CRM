<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

/*
	* Author: Basudeba Rath
	* Org: Veon Consulting
	* Created On: 10-jan-2012
	* Description: Creating new module Trademark.
*/


global $current_user;
global $app_strings;
global $app_list_strings;
global $mod_strings;
global $theme,$db;
global $sugar_version, $sugar_config;

$focus = new trade_trademark();

if(isset($_REQUEST['record'])) {
    $focus->retrieve($_REQUEST['record']);
}
if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
	$focus->id = "";
}
	
//echo get_module_title($mod_strings['LBL_MODULE_NAME'], $mod_strings['LBL_MODULE_NAME'].(isset($focus->name)? ":  ($focus->name)":" "), true);

$GLOBALS['log']->info("trade_trademark edit view");

$xtpl= new XTemplate ('custom/modules/trade_trademark/EditView.html');
$xtpl->assign("MOD", $mod_strings);
$xtpl->assign("APP", $app_strings);
$xtpl->assign("PRINT_URL", "index.php?".$GLOBALS['request_string']);
if(isset($_REQUEST['record'])) {
	$xtpl->assign("MOD_TITLE", $focus->name. " >> Edit" );
}   
else{
	$xtpl->assign("MOD_TITLE", "Create");
}
$xtpl->assign("ID", $focus->id);
$xtpl->assign("NAME", $focus->name);
$xtpl->assign("DESCRIPTION", $focus->description);
$xtpl->assign("ASSIGNED_USER_NAME", $focus->assigned_user_name);
$xtpl->assign("ASSIGNED_USER_ID", $focus->assigned_user_id);
if($_REQUEST['return_module']=='Accounts')
{
	$xtpl->assign("ACCOUNT_NAME", $_REQUEST['trade_trademark_accounts_name']);  //client_name
	$xtpl->assign("ACCOUNT_ID", $_REQUEST['trade_trademark_accountsaccounts_ida']);    //client_id
}
else{
	$xtpl->assign("ACCOUNT_NAME", $focus->trade_trademark_accounts_name);
	$xtpl->assign("ACCOUNT_ID", $focus->trade_trademark_accountsaccounts_ida);
}

if(!isset($focus->id)){
	$xtpl->assign("ASSIGNED_USER_NAME", $current_user->name);
	$xtpl->assign("ASSIGNED_USER_ID", $current_user->id);
}
/*********************************************************************/
// APPLICANTS LINE ITEMS.

	$lineItemsHtml = "";
	$line_items = array();
	
	$sql_applicant = "SELECT * FROM `trade_applicants` WHERE trademark_id = '".$focus->id."' AND deleted = '0' ";
	$res_applicant = $db->query($sql_applicant);
	while($row_applicant = $db->fetchByAssoc($res_applicant)){
		$line_items[]=$row_applicant;
	}
		
	$applicant_count = 1;
	
	$xtpl->assign("FIRST_NAME", $line_items[0]['first_name']);
	$xtpl->assign("LAST_NAME", $line_items[0]['name']);
	$xtpl->assign("ADDRESS", $line_items[0]['address']);
	$xtpl->assign("CITY", $line_items[0]['city']);
	$xtpl->assign("STATE", $line_items[0]['state']);
	$xtpl->assign("ZIP_CODE", $line_items[0]['zip_code']);
	$xtpl->assign("PHONE_NO", $line_items[0]['phone_no']);
	$xtpl->assign("EMAIL_ADDRESS", $line_items[0]['email_addr']);
		
	for($i=1; $i<sizeof($line_items); $i++){
		
		$lineItemsHtml .= "<tr><td id = 'ta_".$i."'>";
		$lineItemsHtml .= '<table cellspacing="3" cellpadding="0" border="0" width="100%" class="edit view delete_table"  id="myTable_'.$i.'">';
		
		$lineItemsHtml .= ' <tr>';
		$lineItemsHtml .= ' <td width="12.5%">'.$mod_strings['LBL_FIRST_NAME'].':</td>';
		$lineItemsHtml .= ' <td width="37.5%"><input type="text" name="first_name_'.$i.'" id="first_name_'.$i.'" value="'.$line_items[$i]['first_name'].'" class="ac_input" /></td>';
			
		$lineItemsHtml .= ' <td width="12.5%">'.$mod_strings['LBL_LAST_NAME'].':</td>';
		$lineItemsHtml .= ' <td width="37.5%"><input type="text" name="last_name_'.$i.'" id="last_name_'.$i.'" value="'.$line_items[$i]['name'].'"  class="ac_input" /></td>';
			
		$lineItemsHtml .= ' </tr>';
		  
		$lineItemsHtml .= ' <tr>';
		$lineItemsHtml .= ' <td width="12.5%">'.$mod_strings['LBL_ADDRESS'].':</td>';
		$lineItemsHtml .= ' <td width="37.5%"><input type="text" name="address_'.$i.'" id="address_'.$i.'" value="'.$line_items[$i]['address'].'" class="ac_input" /></td>';
			
		$lineItemsHtml .= '	<td width="12.5%">'.$mod_strings['LBL_CITY'].':</td>';
		$lineItemsHtml .= ' <td width="37.5%"><input type="text" name="city_'.$i.'" id="city_'.$i.'" class="ac_input" value = "'.$line_items[$i]['city'].'"/></td>		';
		$lineItemsHtml .= ' </tr>';
		
		$lineItemsHtml .= ' <tr>';
		$lineItemsHtml .= ' <td width="12.5%">'.$mod_strings['LBL_STATE'].':</td>';
		$lineItemsHtml .= ' <td width="37.5%"><input type="text" name="state_'.$i.'" id="state_'.$i.'" value="'.$line_items[$i]['state'].'" class="ac_input" /></td>';
			
		$lineItemsHtml .= '	<td width="12.5%">'.$mod_strings['LBL_ZIPCODE'].':</td>';
		$lineItemsHtml .= ' <td width="37.5%"><input type="text" name="zipcode_'.$i.'" id="zipcode_'.$i.'" class="ac_input" value = "'.$line_items[$i]['zip_code'].'"/></td>';
		$lineItemsHtml .= ' </tr>';
		
		$lineItemsHtml .= ' <tr>';
		$lineItemsHtml .= ' <td width="12.5%">'.$mod_strings['LBL_PHONE_NO'].':</td>';
		$lineItemsHtml .= ' <td width="37.5%"><input type="text" name="phone_no_'.$i.'" id="phone_no_'.$i.'" value="'.$line_items[$i]['phone_no'].'" class="ac_input" /></td>';
			
		$lineItemsHtml .= '	<td width="12.5%">'.$mod_strings['LBL_EMAIL_ADDRESS'].':</td>';
		$lineItemsHtml .= ' <td width="37.5%"><input type="text" name="email_address_'.$i.'" id="email_address_'.$i.'" class="ac_input" value = "'.$line_items[$i]['email_addr'].'"/>
		
		<input type="button" value="-" name="delbutton_'.$i.'" id="delbutton_'.$i.'" class="delete_row" 
		onclick="removeRow('."'ta_".$i."'".');">
		
		</td>';
		$lineItemsHtml .= ' </tr>';//onclick="removeRow(document.getElementById('."'ta_".$i."')".');">
		
		$lineItemsHtml .= ' </table>';
		$lineItemsHtml .= "</td></tr>";		
		
		$applicant_count++;

	}
	//echo $applicant_count;
	$xtpl->assign("TABLE_COUNT",$applicant_count);
	$xtpl->assign("LINEITEMS_ROWS",$lineItemsHtml);
/*********************************************************************/


if (isset($_REQUEST['return_module'])) $xtpl->assign("RETURN_MODULE", $_REQUEST['return_module']);
if (isset($_REQUEST['return_action'])) $xtpl->assign("RETURN_ACTION", $_REQUEST['return_action']);
if (isset($_REQUEST['return_id'])) $xtpl->assign("RETURN_ID", $_REQUEST['return_id']);

if (empty($_REQUEST['return_id'])) {
	$xtpl->assign("RETURN_ACTION", 'index');
}
$xtpl->parse("main");
$xtpl->out("main");

?>

