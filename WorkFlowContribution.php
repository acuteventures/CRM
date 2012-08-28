

<?php
	
	
/***************************************************************

Author :  Basudeba Rath
Date : 05-Dec-2011
Veon Consulting Pvt. Ltd.

***************************************************************/

 	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	
	global $db;
	$new_status = "";
	
	$result = "";
	$id = $_REQUEST['id'];
	$user_id = $_REQUEST['user_id'];
	$btn_id  = $_REQUEST['btn_id'];
	$clnt_name = $_REQUEST['client_name'];
	$caseNo = $_REQUEST['caseNo'];

	$users = new User();
	$record_user = $users->retrieve($user_id);
	
	if($btn_id == "Contribute to the Search"){
	
		// Contribut to serach, add in Contribute module.
		
		if(contribute($id, $user_id, $db)){
			caseHIstory($id, $user_id,$record_user,1);
			$result .= "New Case Registered.";
			$result .= "\n Contributed Successfully..";
		}
		else{
			$result .= "Already Contributed.";
		}
	}		
	
	if($btn_id == "Contribute To Preparation"){
		
		if(contribute($id, $user_id, $db)){
			caseHIstory($id, $user_id,$record_user,2);
			$result .= "\n New Case Registered.";
			$result .= "\n Contributed successfully.";
		}
		else
			$result .= "Already Contributed.";
	}
	if($btn_id == 'Contribute Case'){
	
		if(contribute($id, $user_id, $db))
			$result .= "Successfully Contributed to this case.";
		else{
			$result .= "Already contributed to this case.";
		}
	}
	
	function contribute($id, $user_id, $db){
	
		$sql_cont = "SELECT * from `c_contribute` WHERE login_id = '".$user_id."' AND case_id = '".$id."'  AND deleted = '0'";		
		$res_cont = $db->query($sql_cont);
		$row_cont = $db->fetchByAssoc($res_cont);
		if(!($row_cont['login_id'] == $user_id && $row_cont['case_id'] == $id)){

			$cont_search = new c_contribute();
			$cont_search->name = "Contribute Case";
			$cont_search->login_id = $user_id;
			$cont_search->case_id = $id;
			
			$cont_search->assigned_user_id = $user_id;
			$cont_search->set_created_by = false;
			$cont_search->update_modified_by = false;
			$cont_search->created_by = $user_id;
			$cont_search->modified_user_id = $user_id;
			$cont_search->save();
			
			$cont_search->set_created_by = true;
			$cont_search->update_modified_by = true;
			
			return 1;
		}
		else{
			return 0;
		}
	}
	function caseHIstory($id, $user_id,$record_user, $flag = 0){
		
		$dateTime = date("d-m-Y H:i:s");
		$caseHistory4 = new Note();
		$caseHistory4->name = "Case History - contribute To Search";
		$caseHistory4->parent_type = "Cases";
		$caseHistory4->parent_id = $id;
		$caseHistory4->assigned_user_id = $user_id;
		
		$caseHistory4->set_created_by = false;
		$caseHistory4->update_modified_by = false;
		
		$caseHistory4->modified_user_id = $user_id;
		$caseHistory4->created_by = $user_id;
		if($flag == 1){
			$caseHistory4->description = $record_user->first_name." ". $record_user->last_name ." has started to contribute to the search on ".$dateTime;
		}
		else if($flag == 2){
			$caseHistory4->description = $record_user->first_name." ". $record_user->last_name ." has started to contribute to the case on ".$dateTime;
		}
		$caseHistory4->save();
		$result .= "\n New Case is Registered.";
		
	}

	echo $result;
	

?>