<?php
/**************************************************************************************************
	Author : Basudeba Rath.
	Dt.: 07-May-2012.
	Veon Consulting pvt. ltd.
	Comments : Retrieve consultant name and id for case record.
*************************************************************************************************/
	
	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	
	global $db;
	
	$client_id = $_REQUEST['client_id'];
	
	$acc_obj = new Account();
	$rec_acc = $acc_obj->retrieve($client_id);
	
	$user_obj = new User();
	$rec_user = $user_obj->retrieve($rec_acc->assigned_user_id);
	
	echo $rec_user->first_name." ".$rec_user->last_name.",".$rec_acc->assigned_user_id;

?>