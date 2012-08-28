<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/**
* Author: Anuradha
* Org: Veon Consulting
* Created On: 23-11-2011
* Description: Invention module lang definitions
*/

require_once('modules/Inv_Inventions/Inv_Inventions.php');
require_once('include/utils.php');

global $db,  $sugar_config;
global $unique_DO, $timedate,$current_user;


$focus = new Inv_Inventions();
$focus->retrieve($_POST['record']);
if(!$focus->ACLAccess('Save')){
    ACLController::displayNoAccess(true);
    sugar_cleanup(true);
}

$record_check_value = $_REQUEST['record'];
if (!empty($_POST['assigned_user_id']) && ($focus->assigned_user_id != $_POST['assigned_user_id']) && ($_POST['assigned_user_id'] != $current_user->id)) {
    $check_notify = TRUE;
}
else{
    $check_notify = FALSE;
}

require_once('include/formbase.php');
$focus = populateFromPost('', $focus);

$focus->name = $_POST['invention_name'];
$focus->assigned_user_id = $current_user->id;

// By Basudeba Rath, Date : 01-Jun-2012.
//$focus->total_patent_assigned = $_REQUEST['total_patent_assigned'];

//$focus->save($check_notify);
$return_id = $focus->id;

require_once('modules/Inventors/Inventor.php');

//echo 'Initially='.$_POST["table_count"].'<br />';

if($_POST["table_count"]!='zx'){
	$table_count = $_POST["table_count"]+1;
}
//echo $table_count;
//die;

$inventor_items2 = new Inventor();
$inventor_items2->mark_deletedByInventorId($return_id);

/*$inv_sql = "SELECT * FROM inventor_list WHERE invention_id='".$focus->id."' AND deleted='0'";
$inv_sql_result = $db->query($inv_sql);
while($inv_row = $db->fetchByAssoc($inv_sql_result))
{
	$inventor_items_upd = new Inventor();
	$inventor_items_upd->deleted=1;
	$inventor_items_upd->id=$inv_row['id'];
	$inventor_items_upd->save();
	echo $inventor_items_upd;
	//$db->query("UPDATE inventor_list WHERE invention_id='".$focus->id."'");
}
die;
*/
//echo '<pre>';
//print_r($_POST);

$primary_inventor = $_POST['primary_type'];


for($i = 0;$i<= $table_count; $i++) {

    $first_name = $_POST["first_name_".$i];
	//echo '<br />';
	$inventor_items = new Inventor();
	if(isset($_POST["first_name_".$i]) && !empty($first_name)){		
		
		$inventor_items->name = $first_name; 
		$inventor_items->last_name = $_POST["last_name_".$i];
		$inventor_items->middle_name = $_POST["middle_name_".$i];
		$inventor_items->mailing_address1 = $_POST["mailing_address1_".$i];
		$inventor_items->mailing_address2 = $_POST["mailing_address2_".$i];
		$inventor_items->mailing_city = $_POST["mailing_city_".$i];
		$inventor_items->mailing_state = $_POST["mailing_state_".$i];
		$inventor_items->mailing_zipcode = $_POST["mailing_zipcode_".$i];
		$inventor_items->mailing_country = $_POST["mailing_country_".$i];
		$inventor_items->residence_city = $_POST["residence_city_".$i];
		$inventor_items->residence_state = $_POST["residence_state_".$i];
		$inventor_items->residence_country = $_POST["residence_country_".$i];
		$inventor_items->email_address = $_POST["email_address_".$i];
		$inventor_items->phone_number = $_POST["phone_number_".$i];
		
		//echo $primary_inventor.'<br />';

		if($primary_inventor == $i){		
			$inventor_items->primary_inventor = '1';
			//$inventor_primary_inventor = '1';
		}
		else{
			$inventor_items->primary_inventor = '0';
			//$inventor_primary_inventor = '0';
		}
		
		$inventor_items->invention_id = $return_id;
		
		$inventor_items->save();
		//echo $inventor_items->id.'<br />';
		
		//$insert_inventor_sql="INSERT INTO inventor_list(id,name,invention_id,last_name,middle_name,mailing_address1,mailing_address2,mailing_city,mailing_state,mailing_zipcode,mailing_country,residence_city,residence_state	,residence_country,email_address,phone_number,primary_inventor) VALUES('".$guid."','".$first_name."','".$return_id."','".$_POST["last_name_".$i]."','".$_POST["middle_name_".$i]."','".$_POST["mailing_address1_".$i]."','".$_POST["mailing_address2_".$i]."','".$_POST["mailing_city_".$i]."','".$_POST["mailing_state_".$i]."','".$_POST["mailing_zipcode_".$i]."','".$_POST["mailing_country_".$i]."','".$_POST["residence_city_".$i]."','".$_POST["residence_state_".$i]."','".$_POST["residence_country_".$i]."','".$_POST["email_address_".$i]."','".$_POST["phone_number_".$i]."','$inventor_primary_inventor')";
	//echo $insert_inventor_sql;
	
		//$insert_inventor_result = $db->query($insert_inventor_sql);
	
	}

}

	/***************************************************************************************
				Author : Basudeba Rath.
				Date : 30-May-2012.
				
				Desc : Assignment Line Items save.
	
	****************************************************************************************/
	
		
	$assignment_obj = new as_Assignment();
	$assignment_obj->mark_deletedByAssignId($return_id);
	
	for($i = 0;$i <= $_REQUEST['count']; $i++) {

    		$assignment_obj = new as_Assignment();
		
		if($_POST["assignee_name_".$i] != ""){
			
			$assignment_obj->name = $_POST["assignee_name_".$i];
			$assignment_obj->assignee_address1 = $_POST["assignee_address1_".$i];
			$assignment_obj->assignee_address2 = $_POST["assignee_address2_".$i];
			$assignment_obj->assignee_city = $_POST["assignee_city_".$i];
			$assignment_obj->assignee_state = $_POST["assignee_state_".$i];
			$assignment_obj->assignee_zip = $_POST["assignee_zipcode_".$i];
			$assignment_obj->assignee_country = $_POST["assignee_country_".$i];
			$assignment_obj->inv_inventions_id_c = $focus->id;
			$assignment_obj->percent_patent_assigned = $_POST["percent_patent_assigned_".$i];
			
			$assignment_obj->save();

			$total_patent_assigned += $_POST["percent_patent_assigned_".$i];
		}		
	}

	$focus->total_patent_assigned = $total_patent_assigned;

	$focus->save($check_notify);

/*************************************** EOF *******************************************************/

handleRedirect($focus->id, 'Inv_Inventions');
?>

