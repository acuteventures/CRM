
<?php
/*
**************************************************************************************
// By preethi on 08-08-2012
**************************************************************************************
*/
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $app_strings;
global $app_list_strings;
global $mod_strings;
global $theme,$db;

require_once('include/formbase.php');
$focus = new c_s_d_case_subcase_dashlet();
if(isset($_REQUEST['current_post']) && !empty($_POST['current_post'])) {
	if(empty($order_by))$order_by = '';
	$ret_array = create_export_query_relate_link_patch($_REQUEST['module'], $this->searchFields, $this->where_clauses);
	$query = $focus->create_export_query($order_by, $ret_array['where'], $ret_array['join']);
	//echo $query;
	$result = $db->query($query,true);
	$new_arr = array();
	while($val = $db->fetchByAssoc($result,-1,false))
	{
		array_push($new_arr, $val['id']);
	}
	$uid = $new_arr;
}
else{
	$uid =explode(',',$_REQUEST['uid']);
}

$resource_id='';
$emails = '';
$body = '';

$new_array = array();
foreach($uid as $case_subcase_id){
	$email_sql = "SELECT accounts.first_name, accounts.last_name, email_addresses.email_address FROM `c_s_d_case_subcase_dashlet` LEFT JOIN `accounts` ON  accounts.id = c_s_d_case_subcase_dashlet.account_id  LEFT JOIN `email_addr_bean_rel` ON accounts.id = email_addr_bean_rel.bean_id LEFT JOIN `email_addresses` ON email_addr_bean_rel.email_address_id = email_addresses.id WHERE c_s_d_case_subcase_dashlet.id='".$case_subcase_id."' AND c_s_d_case_subcase_dashlet.deleted=0 AND accounts.deleted=0 AND email_addr_bean_rel.deleted=0 AND email_addresses.deleted=0";
	$email_result = $db->query($email_sql);
	$email_row = $db->fetchByAssoc($email_result);
	if($email_row['email_address'] != ''){
		if(!(in_array($email_row['email_address'],$new_array))){
			array_push($new_array, $email_row['email_address']);
		}
	}
}
	for($i=0;$i<count($new_array);$i++){
		$emails .= $new_array[$i].",";
	}
$xtpl=new XTemplate ('modules/c_s_d_case_subcase_dashlet/EmailView.html');

$xtpl->assign("MOD", $mod_strings);
$xtpl->assign("APP", $app_strings);
$xtpl->assign("EMAILS", $emails);
$xtpl->assign("UID", $_REQUEST['uid']);

$xtpl->parse("main");
$xtpl->out("main");

?>