<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*
	* Author: Basudeba Rath.
	* Org: Veon Consulting
	* Created On: 11-Jan-2012.
	* Description: Trade mark module save function.
*/

require_once('modules/trade_trademark/trade_trademark.php');
require_once('include/utils.php');

global $db,  $sugar_config;
global $unique_DO, $timedate,$current_user;


$focus = new trade_trademark();
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

$focus->name = $_POST['name'];
$focus->description = $_POST['description'];
$focus->assigned_user_id = $_POST['assigned_user_id'];//$current_user->id;

$focus->save($check_notify);
$return_id = $focus->id;

require_once('modules/trade_applicants/trade_applicants.php');

$table_count = $_POST["table_count"];

$trdapp_obj = new trade_applicants();
$trdapp_obj->mark_deletedByApplicantId($return_id);

for($i = 0; $i <= $table_count; $i++) {
	
	if(!($_POST['first_name_'.$i] == "" && $_POST['last_name_'.$i] == "" && $_POST['address_'.$i] == "" && $_POST['city_'.$i] == "" && $_POST['state_'.$i] == "" && $_POST['zipcode_'.$i] == "" && $_POST['phone_no_'.$i] == "" &&  $_POST['email_address_'.$i] == "")){
		
	
		$trdAppObj = new trade_applicants();
		$trdAppObj->trademark_id = $focus->id;
		$trdAppObj->first_name = $_POST['first_name_'.$i];
		$trdAppObj->name = $_POST['last_name_'.$i];
		$trdAppObj->address = $_POST['address_'.$i];
		$trdAppObj->city = $_POST['city_'.$i];
		$trdAppObj->state = $_POST['state_'.$i];
		$trdAppObj->zip_code = $_POST['zipcode_'.$i];
		$trdAppObj->phone_no = $_POST['phone_no_'.$i];
		$trdAppObj->email_addr = $_POST['email_address_'.$i];
		$trdAppObj->save();
	}
}

handleRedirect($focus->id, 'trade_trademark');

?>

