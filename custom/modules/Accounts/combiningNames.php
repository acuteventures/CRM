<?php
//By Swapna dt:-15-03-2012
class combiningNames
{
	function assignName(&$bean, $event, $arguments)
	{
		global $db;
		$fname=$_REQUEST['first_name'];
		$lname=$_REQUEST['last_name'];
		$name= $fname." ".$lname;
		if($name != " "){		
			$sql='UPDATE accounts SET name="'.$name.'" WHERE id="'.$bean->id.'" AND deleted=0';
			$db->query($sql);
		}
	}
	
// By Basudeba Rath, Date : 11-May-2012.

	function updateConsultant_before(&$bean, $event, $arguments){
	
		$GLOBALS['assigned_user_before'] = $bean->fetched_row['assigned_user_id'];
	}
	
	function updateConsultant(&$bean, $event, $arguments){
	
		global $db;
		if($GLOBALS['assigned_user_before'] != $bean->assigned_user_id){
			
			$sql_cases = "UPDATE cases SET `client_consultant_id` = '".$bean->assigned_user_id."' WHERE `account_id` = '".$bean->id."'";
			$res_cases = $db->query($sql_cases);
			// * preethi for updating client consultant id in joint module
			$sql_cases_subcases_dashlet = "UPDATE c_s_d_case_subcase_dashlet SET `client_consultant_id` = '".$bean->assigned_user_id."' WHERE `account_id` = '".$bean->id."'";
			
			$res_cases_subcases_dashlet = $db->query($sql_cases_subcases_dashlet);
			// * End
		}
	}
	//by anuradha 2-7-2012
	//desc: updating to accounts table phone_office field that entered as a primary phone
	function officePhoneUpdate(&$bean, $event, $arguments)
	{
		global $db;
		$get_primary_phone = "SELECT phone_no FROM ph_phoneno WHERE account_id_c='".$bean->id."' AND primary_no=1 AND deleted=0";
		$get_primary_phone_res = $db->query($get_primary_phone);
		$get_primary_phone_row = $db->fetchByAssoc($get_primary_phone_res);
		
		
		echo $sql_update_phone = "UPDATE accounts SET `phone_office` = '".$get_primary_phone_row['phone_no']."' WHERE `id` = '".$bean->id."' AND deleted=0 ";
		$sql_update_phone_res = $db->query($sql_update_phone);
		
		//by anuradha on 06-07-2012		
		echo $get_other_phone = "SELECT phone_no FROM ph_phoneno WHERE account_id_c='".$bean->id."' AND primary_no=0 AND deleted=0";
		echo '<br />';
		$get_other_phone_res = $db->query($get_other_phone);
		$a=0;
		$b=1;
		while($get_other_phone_row = $db->fetchByAssoc($get_other_phone_res))
		{		
			echo $get_other_phone_row['phone_no'];
			echo '<br />';
			if($a==0){
			echo $sql_update_phone_other = "UPDATE accounts SET `phone_alternate` = '".$get_other_phone_row['phone_no']."' WHERE `id` = '".$bean->id."' AND deleted=0 ";
			echo '<br />';
			$sql_update_phone_other_res = $db->query($sql_update_phone_other);			
			//$b=0;
			}
			if($b==1 && $a==1){			
			echo $sql_update_phone_other1 = "UPDATE accounts SET `mobile` = '".$get_other_phone_row['phone_no']."' WHERE `id` = '".$bean->id."' AND deleted=0 ";
			echo '<br />';
			$sql_update_phone_other_res1 = $db->query($sql_update_phone_other1);
			$b=0;
			}
			$a=1;

		}
		//die;
		//end
		
	}
	//end

	
}
?>