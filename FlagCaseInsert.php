<?php
/*------------------------
Rajesh G - 09/05/12
Flag Case Insertion
--------------------------*/
if(!defined('sugarEntry'))define('sugarEntry', true);
require_once('include/entryPoint.php');

function generateId(){
	$t=time();
	$time=md5($t);
	$a=substr($time,0,8);
	$b=substr($time,8,4);
	$c=substr($time,12,4);
	$d=substr($time,16,4);
	$e=substr($time,20,16);
	return "$a-$b-$c-$d-$e";
}

global $db,$current_user;
	
$case_id = $_REQUEST['case_id'];
$user_id = $_REQUEST['user_id'];
$is_flag = $_REQUEST['is_flag'];
$id = generateId();
        $select_query = "SELECT
                COUNT(*) AS total
                FROM fc_flag_cases 
                WHERE
                fc_flag_cases.case_id = '".$case_id."' 
                AND fc_flag_cases.flagged_user_id = '".$user_id."' 
                AND fc_flag_cases.deleted = 0";
        $result = $db->query($select_query);
        $total_rows_res = $db->fetchByAssoc($result);
        $total_rows = $total_rows_res['total'];

	if($is_flag == 'true' && $total_rows == 0)
	{
            $insert_query = "INSERT INTO fc_flag_cases (id,case_id,flagged_user_id) VALUES ('".$id."','".$case_id."','".$user_id."')";
            $db->query($insert_query);
            echo "flagged";
	}
	else if($is_flag == 'false' && $total_rows != 0)
	{
            $deleteQuery = "DELETE FROM fc_flag_cases WHERE flagged_user_id = '".$user_id."' AND case_id = '".$case_id."'";
            $db->query($deleteQuery);
            echo "unflagged";
	}
?>