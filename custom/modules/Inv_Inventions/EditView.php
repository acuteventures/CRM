<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/**
* Author: Anuradha
* Org: Veon Consulting
* Created On: 23-11-2011
* Description: Creating new module Inventions: Class
*/
global $current_user;
global $app_strings;
global $app_list_strings;
global $mod_strings;
global $theme,$db;
global $sugar_version, $sugar_config;

$focus = new Inv_Inventions();

if(isset($_REQUEST['record'])) {
    $focus->retrieve($_REQUEST['record']);
}
if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
	$focus->id = "";
}
	
echo get_module_title($mod_strings['LBL_MODULE_NAME'], $mod_strings['LBL_MODULE_NAME'].(isset($focus->name)? ":  ($focus->name)":" "), true);

$GLOBALS['log']->info("Invention edit view");
$xtpl= new XTemplate ('custom/modules/Inv_Inventions/EditView.html');

$xtpl->assign("MOD", $mod_strings);
$xtpl->assign("APP", $app_strings);
$xtpl->assign("PRINT_URL", "index.php?".$GLOBALS['request_string']);
$xtpl->assign("ID", $focus->id);

$xtpl->assign("INVENTION_NAME", $focus->name);
$xtpl->assign("TOTAL_PATENT_ASSIGNED", $focus->total_patent_assigned);


 global $db;
    $clientId =$_GET['client'];
	$clientQuery = " SELECT name,id FROM accounts WHERE id='".$clientId."' AND deleted=0";
	$client_sql_result = $db->query($clientQuery);
	$client_row = $db->fetchByAssoc($client_sql_result);
	$clientName =  $client_row['name'];

// Author : Basudeba Rath.
// Date : 10-Feb-2012.

	if($_REQUEST['account_name'] != "" ){
		$xtpl->assign("CLIENT_NAME", $_REQUEST['account_name']);  
		$xtpl->assign("CLIENT_ID", $_REQUEST['account_id']); 
	}
	else if($_REQUEST['return_module']=='Accounts')
	{
		$xtpl->assign("CLIENT_NAME", $_REQUEST['inv_inventions_accounts_name']);  //client_name
		$xtpl->assign("CLIENT_ID", $_REQUEST['inv_inventd1acccounts_ida']);    //client_id
	}
	else{
		$xtpl->assign("CLIENT_NAME", $focus->inv_inventions_accounts_name);  //client_name
		$xtpl->assign("CLIENT_ID", $focus->inv_inventd1acccounts_ida);    //client_id
	}
/***********************************************/

$xtpl->assign("ASSIGNEE_NAME", $focus->assignee_name);
$xtpl->assign("ASSIGNEE_ADDRESS1", $focus->assignee_address1);
$xtpl->assign("ASSIGNEE_ADDRESS2", $focus->assignee_address2);
$xtpl->assign("ASSIGNEE_CITY", $focus->assignee_city);
$xtpl->assign("ASSIGNEE_STATE", $focus->assignee_state);
$xtpl->assign("ASSIGNEE_ZIPCODE", $focus->assignee_zipcode);
$xtpl->assign("ASSIGNEE_COUNTRY", $focus->assignee_country);

$xtpl->assign("LARGE_ENTITY_TYPE", "large");
$xtpl->assign("SMALL_ENTITY_TYPE", "small");

if($focus->invention_entity_type=='large'){
	$val="checked='checked'";
}
else{
	$val="";
}
$xtpl->assign("LARGE_ENTITY_CHECK", $val);

if(empty($_REQUEST['record']))
{
	$sval="checked='checked'";
}
else if($focus->invention_entity_type=='small'){
	$sval="checked='checked'";
}
else{
	$sval="";
}

$xtpl->assign("SMALL_ENTITY_CHECK", $sval);

$inv_sql = "SELECT * FROM inventor_list WHERE invention_id='".$focus->id."' AND deleted='0'";
$inv_sql_result = $db->query($inv_sql);
$line_items=array();
while($inv_row = $db->fetchByAssoc($inv_sql_result)){
	$line_items[]=$inv_row;
}	
$inv_count = 1;
//echo sizeof($line_items);
//echo  $line_items[0]['name'];

$xtpl->assign("FIRST_NAME", $line_items[0]['name']);
$xtpl->assign("LAST_NAME", $line_items[0]['last_name']);
$xtpl->assign("MIDDLE_NAME",$line_items[0]['middle_name']);
$xtpl->assign("MAILING_ADDRESS1",$line_items[0]['mailing_address1']);
$xtpl->assign("MAILING_ADDRESS2",$line_items[0]['mailing_address2']);
$xtpl->assign("MAILING_CITY",$line_items[0]['mailing_city']);
$xtpl->assign("MAILING_STATE",$line_items[0]['mailing_state']);
$xtpl->assign("MAILING_ZIPCODE",$line_items[0]['mailing_zipcode']);
$xtpl->assign("MAILING_COUNTRY",$line_items[0]['mailing_country']);
$xtpl->assign("RESIDENCE_CITY",$line_items[0]['residence_city']);
$xtpl->assign("RESIDENCE_STATE",$line_items[0]['residence_state']);
$xtpl->assign("RESIDENCE_COUNTRY",$line_items[0]['residence_country']);
$xtpl->assign("EMAIL_ADDRESS",$line_items[0]['email_address']);
$xtpl->assign("PHONE_NUMBER",$line_items[0]['phone_number']);
if($line_items[0]['primary_inventor']==1){
		$sval="checked='checked'";
	}
	else{
		$sval="";
	}



$xtpl->assign("PRIMARY_CHECKED",$sval);

for($i=1; $i<sizeof($line_items); $i++)
{
	if($line_items[$i]['primary_inventor']==1){
		$sval="checked='checked'";
	}
	else{
		$sval="";
	}
	
	$lineItemsHtml .= '<table cellspacing="3" cellpadding="0" border="0" width="100%" class="edit view delete_table"  id="myTable_'.$i.'">';
	
     $lineItemsHtml .= ' <tr>';
     $lineItemsHtml .= '   <td width="12.5%">'.$mod_strings['LBL_FIRST_NAME'].':</td>';
      $lineItemsHtml .= '  <td width="37.5%"><input type="text" name="first_name_'.$i.'" id="first_name_'.$i.'" value="'.$line_items[$i]['name'].'" class="ac_input" /></td>';
		
		$lineItemsHtml .= '<td width="12.5%">'.$mod_strings['LBL_MIDDLE_NAME'].':</td>';
      $lineItemsHtml .= '  <td width="37.5%"><input type="text" name="middle_name_'.$i.'" id="middle_name_'.$i.'" value="'.$line_items[$i]['middle_name'].'"  class="ac_input" /></td>';
		
     $lineItemsHtml .= ' </tr>';
	  
	 $lineItemsHtml .= ' <tr>';
      $lineItemsHtml .= '  <td width="12.5%">'.$mod_strings['LBL_LAST_NAME'].':</td>';
      $lineItemsHtml .= '  <td width="37.5%"><input type="text" name="last_name_'.$i.'" id="last_name_'.$i.'" value="'.$line_items[$i]['last_name'].'" class="ac_input" /></td>';
		
	$lineItemsHtml .= '	<td width="12.5%">'.$mod_strings['LBL_MAILING_ADDRESS1'].':</td>';
      $lineItemsHtml .= '  <td width="37.5%"><textarea name="mailing_address1_'.$i.'" id="mailing_address1_'.$i.'" class="ac_input" >'.$line_items[$i]['mailing_address1'].'</textarea></td>		';
     $lineItemsHtml .= ' </tr>';
	  
	  $lineItemsHtml .= ' <tr> ';
		
	$lineItemsHtml .= '<td width="12.5%">'.$mod_strings['LBL_MAILING_ADDRESS2'].':</td>';
      $lineItemsHtml .= '  <td width="37.5%"><textarea name="mailing_address2_'.$i.'" id="mailing_address2_'.$i.'" class="ac_input" >'.$line_items[$i]['mailing_address2'].'</textarea></td>		';
		
		$lineItemsHtml .= '<td width="12.5%">'.$mod_strings['LBL_MAILING_CITY'].':</td>';
      $lineItemsHtml .= '  <td width="37.5%"><input type="text" name="mailing_city_'.$i.'" id="mailing_city_'.$i.'" value="'.$line_items[$i]['mailing_city'].'" class="ac_input" /></td>';
     $lineItemsHtml .= ' </tr>';
	  
	 $lineItemsHtml .= ' <tr>';
	  $lineItemsHtml .= '	<td width="12.5%">'.$mod_strings['LBL_MAILING_STATE'].':</td>';
      $lineItemsHtml .= '  <td width="37.5%"><input type="text" name="mailing_state_'.$i.'" id="mailing_state_'.$i.'" value="'.$line_items[$i]['mailing_state'].'" class="ac_input" /></td>';
		
		$lineItemsHtml .= '<td width="12.5%">'.$mod_strings['LBL_MAILING_ZIPCODE'].':</td>';
       $lineItemsHtml .= ' <td width="37.5%"><input type="text" name="mailing_zipcode_'.$i.'" id="mailing_zipcode_'.$i.'" value="'.$line_items[$i]['mailing_zipcode'].'" class="ac_input" />';
	$lineItemsHtml .= '	</td>';
    $lineItemsHtml .= '  </tr>';
	
	$lineItemsHtml .= ' <tr>';
	 $lineItemsHtml .= '	<td width="12.5%">'.$mod_strings['LBL_MAILING_COUNTRY'].':</td>';
     $lineItemsHtml .= '   <td width="37.5%"><input type="text" name="mailing_country_'.$i.'" id="mailing_country_'.$i.'" value="'.$line_items[$i]['mailing_country'].'" class="ac_input" /></td>';
		
	 $lineItemsHtml .= '	<td width="12.5%">'.$mod_strings['LBL_RESIDENCE_CITY'].':</td>';
    $lineItemsHtml .= '    <td width="37.5%"><input type="text" name="residence_city_'.$i.'" id="residence_city_'.$i.'" value="'.$line_items[$i]['residence_city'].'" class="ac_input" /></td>';
    $lineItemsHtml .= '  </tr>';
	  
	 $lineItemsHtml .= ' <tr>';
	 $lineItemsHtml .= '	<td width="12.5%">'.$mod_strings['LBL_RESIDENCE_STATE'].':</td>';
      $lineItemsHtml .= '  <td width="37.5%"><input type="text" name="residence_state_'.$i.'" id="residence_state_'.$i.'" value="'.$line_items[$i]['residence_state'].'" class="ac_input" /></td>';
		
	 $lineItemsHtml .= '	<td width="12.5%">'.$mod_strings['LBL_RESIDENCE_COUNTRY'].':</td>';
     $lineItemsHtml .= '   <td width="37.5%"><input type="text" name="residence_country_'.$i.'" id="residence_country_'.$i.'" value="'.$line_items[$i]['residence_country'].'" class="ac_input" /></td>';
     $lineItemsHtml .= ' </tr>';
	  
	$lineItemsHtml .= '  <tr>';
	 $lineItemsHtml .= '	<td width="12.5%">'.$mod_strings['LBL_EMAIL_ADDRESS'].':</td>';
      $lineItemsHtml .= '  <td width="37.5%"><input type="text" name="email_address_'.$i.'" id="email_address_'.$i.'" value="'.$line_items[$i]['email_address'].'" class="ac_input" /></td>';
		
	 $lineItemsHtml .= '	<td width="12.5%">'.$mod_strings['LBL_PHONE_NUMBER'].':</td>';
     $lineItemsHtml .= '   <td width="37.5%"><input type="text" name="phone_number_'.$i.'" id="phone_number_'.$i.'" value="'.$line_items[$i]['phone_number'].'" class="ac_input" />';
		$a = "'".'myTable_'.$i."'";
		$lineItemsHtml .= '&nbsp;&nbsp; <input type="button" value="-" onclick="deleteTable('.$a.');" name="delbutton_'.$i.'" id="delbutton_'.$i.'" class="delete_row" >&nbsp;&nbsp;';
		$lineItemsHtml .= '&nbsp;&nbsp;<input type="radio" name="primary_type" '.$sval.' value="'.$i.'" />&nbsp;&nbsp; Primary';
		
		
		$lineItemsHtml .= '</td>';
     $lineItemsHtml .= ' </tr>';
	  	 
   $lineItemsHtml .= ' </table>';
	
	$inv_count++;
}	
if(!empty($_REQUEST['record'])){
	$lineItemsHtml .= '<input type="hidden" name="edit_total_count" id="edit_total_count" value="'.sizeof($line_items).'" />';
	$lineItemsHtml .= '<input type="hidden" name="table_count" value="'.(sizeof($line_items)-1).'" />';
}
else{
	$lineItemsHtml .= '<input type="hidden" name="edit_total_count" id="edit_total_count" value="1" />';
}

if(!empty($_REQUEST['record']))
{
	$display_div = "style=display:none;";
	$table_div = "style=display:none;";
}else{
	$display_div = "";
	$table_div = "";
}

$xtpl->assign("DISPLAY_DIV",$display_div);
$xtpl->assign("DISPLAY_TABLE",$table_div);

$xtpl->assign("LINEITEMS_ROWS",$lineItemsHtml);


/*************************************************************************************/

	// Basudeba Rath.
	// Date : 29-May-2012.
	
	$assignment_arr = array();
	
	if(!empty($_REQUEST['record'])){
	
		$assignment_count = 1;
		
		$sql_assignment = "SELECT * FROM `as_assignment` WHERE `inv_inventions_id_c` = '".$focus->id."' AND deleted = '0'";
		$res_assignment = $db->query($sql_assignment);
		while($row_assignment = $db->fetchByAssoc($res_assignment)){
			$assignment_arr[] = $row_assignment;
		}
			
		$xtpl->assign("ASSIGNEE_NAME",$assignment_arr[0]['name']);
		$xtpl->assign("PERCENT_PATENT_ASSIGNED",$assignment_arr[0]['percent_patent_assigned']);
		$xtpl->assign("ASSIGNEE_ADDRESS1",$assignment_arr[0]['assignee_address1']);
		$xtpl->assign("ASSIGNEE_ADDRESS2",$assignment_arr[0]['assignee_address2']);
		$xtpl->assign("ASSIGNEE_CITY",$assignment_arr[0]['assignee_city']);
		$xtpl->assign("ASSIGNEE_STATE",$assignment_arr[0]['assignee_state']);
		$xtpl->assign("ASSIGNEE_ZIPCODE",$assignment_arr[0]['assignee_zip']);
		$xtpl->assign("ASSIGNEE_COUNTRY",$assignment_arr[0]['assignee_country']);
		
		for($i=1; $i<sizeof($assignment_arr); $i++)
		{
		
			$assignmentHtml .= '<table cellspacing="3" cellpadding="0" border="0" width="100%" class="edit view delete_table"  id="AssignmentTable_'.$i.'">';
		
			$assignmentHtml .= ' <tr>';
			$assignmentHtml .= ' <td width="12.5%">'.$mod_strings['LBL_ASSIGNEE_NAME'].':</td>';
			$assignmentHtml .= ' <td width="37.5%"><input type="text" name="assignee_name_'.$i.'" id="assignee_name_'.$i.'" value="'.$assignment_arr[$i]['name'].'" class="ac_input" /></td>';
			
			$assignmentHtml .= ' <td width="12.5%">'.$mod_strings['LBL_PERCENT_PATENT_ASSIGNED'].':</td>';
			$assignmentHtml .= ' <td width="37.5%"><input type="text" name="percent_patent_assigned_'.$i.'" id="percent_patent_assigned_'.$i.'" value="'.$assignment_arr[$i]['percent_patent_assigned'].'"  class="ac_input" /></td>';
			
			$assignmentHtml .= ' </tr>';
		  
			$assignmentHtml .= ' <tr>';
			$assignmentHtml .= ' <td width="12.5%">'.$mod_strings['LBL_ASSIGNEE_ADDRESS1'].':</td>';
			$assignmentHtml .= ' <td width="37.5%"><textarea name="assignee_address1_'.$i.'" id="assignee_address1_'.$i.'" class="ac_input" >'.$assignment_arr[$i]['assignee_address1'].'</textarea></td>';
			
			$assignmentHtml .= ' <td width="12.5%">'.$mod_strings['LBL_ASSIGNEE_ADDRESS2'].':</td>';
			$assignmentHtml .= ' <td width="37.5%"><textarea name="assignee_address2_'.$i.'" id="assignee_address2_'.$i.'" class="ac_input" >'.$assignment_arr[$i]['assignee_address2'].'</textarea></td>';
			$assignmentHtml .= ' </tr>';
		  
			$assignmentHtml .= ' <tr> ';
			
			$assignmentHtml .= ' <td width="12.5%">'.$mod_strings['LBL_ASSIGNEE_CITY'].':</td>';
			$assignmentHtml .= ' <td width="37.5%"><input type = "text" name="assignee_city_'.$i.'" id="assignee_city_'.$i.'" class="ac_input" value = "'.$assignment_arr[$i]['assignee_city'].'" /></td>		';
			
			$assignmentHtml .= ' <td width="12.5%">'.$mod_strings['LBL_ASSIGNEE_STATE'].':</td>';
			$assignmentHtml .= ' <td width="37.5%"><input type="text" name="assignee_state_'.$i.'" id="assignee_state_'.$i.'" value="'.$assignment_arr[$i]['assignee_state'].'" class="ac_input" /></td>';
			$assignmentHtml .= ' </tr>';
		  
			$assignmentHtml .= ' <tr>';
			$assignmentHtml .= ' <td width="12.5%">'.$mod_strings['LBL_ASSIGNEE_ZIPCODE'].':</td>';
			$assignmentHtml .= ' <td width="37.5%"><input type="text" name="assignee_zipcode_'.$i.'" id="assignee_zipcode_'.$i.'" value="'.$assignment_arr[$i]['assignee_zip'].'" class="ac_input" /></td>';
			
			$assignmentHtml .= ' <td width="12.5%">'.$mod_strings['LBL_ASSIGNEE_COUNTRY'].':</td>';
			$assignmentHtml .= ' <td width="37.5%"><input type="text" name="assignee_country_'.$i.'" id="assignee_country_'.$i.'" value="'.$assignment_arr[$i]['assignee_country'].'" class="ac_input" />';
			
			$table_id = "'".'AssignmentTable_'.$i."'";
			
			$assignmentHtml .= '&nbsp;&nbsp; <input type="button" value="-" onclick="assignment_del('.$table_id.');" name="assi_del_'.$i.'" id="assi_del_'.$i.'" class="delete_row" >&nbsp;&nbsp;';

			$assignmentHtml .= ' </td>';
			$assignmentHtml .= ' </tr>';
			 
			$assignmentHtml .= ' </table>';
		
			$assignment_count++;
		}	
		$xtpl->assign("COUNT_VALUE",$assignment_count-1);
		//$assignmentHtml .= '<input type="hidden" name="assign_table_count" value="'.(sizeof($assignment_arr)-1).'" />';
		if(count($assignment_arr) == 0){
		
			$assignmentHtml .= '<input type="hidden" name="assign_edit_total_count" id="assign_edit_total_count" value="1" />';
		}
		else{
			$assignmentHtml .= '<input type="hidden" name="assign_edit_total_count" id="assign_edit_total_count" value="'.sizeof($assignment_arr).'" />';
			
		}
	}
	else{
		$assignmentHtml .= '<input type="hidden" name="assign_edit_total_count" id="assign_edit_total_count" value="1" />';
		$xtpl->assign("COUNT_VALUE",0);
	}

if(!empty($_REQUEST['record']))
{
	//$display_div = "style=display:none;";
	//$table_div = "style=display:none;";
}else{
	//$display_div = "";
	//$table_div = "";
}

//$xtpl->assign("DISPLAY_DIV",$display_div);
//$xtpl->assign("DISPLAY_TABLE",$table_div);

$xtpl->assign("ASSIGNMENT_LINEITEMS_ROWS",$assignmentHtml);


/*********************************/


if (isset($_REQUEST['return_module'])) $xtpl->assign("RETURN_MODULE", $_REQUEST['return_module']);
if (isset($_REQUEST['return_action'])) $xtpl->assign("RETURN_ACTION", $_REQUEST['return_action']);
if (isset($_REQUEST['return_id'])) $xtpl->assign("RETURN_ID", $_REQUEST['return_id']);
// handle Create $module then Cancel
if (empty($_REQUEST['return_id'])) {
	$xtpl->assign("RETURN_ACTION", 'index');
}
$xtpl->parse("main");
$xtpl->out("main");

?>

