<?php

	class CaseNumbers
	{
		function casenumber(&$bean, $event, $arguments){
			global $current_user,$db;			
			$type= $_REQUEST['type'];		
	
	       // Edited : Basudeba Rath, Date : 31-Jan-2012.
		if($_REQUEST['flag_hook'] != 1){

			$sql_query_case = " SELECT name as typename,case_type_code as typecode FROM c_case_type WHERE id = '".$type."' AND deleted=0 ";
			$result_query_case=$db->query($sql_query_case);
			$row_query_case= $db->fetchByAssoc($result_query_case);
	
		        $typename = $row_query_case['typename'];
			$caseNumber= $_REQUEST['case_number'];
									
			$finalCaseNumber ="";
			
			if($caseNumber == "T1"){
				$start_no = 12000;
			}
			else{
				$start_no = 0;
			}
			
			// Author : Basudeba Rath. Date : 31-Jan-2012.
			
			$codeType =  $row_query_case['typecode'];
			$string_sliceIs = $start_no + substr($caseNumber, 1);
		        $finalCaseNumber = "T".$codeType.$string_sliceIs;
	
			/*if($typename == 'Office Action'){
			 
				   $sql_1=" SELECT max(CAST(substr(case_number,11)AS UNSIGNED)) AS maxnum FROM cases WHERE case_number like 'TTP12001OA%' AND deleted=0 AND caseoverride=0"; 
				   $result_1=$db->query($sql_1, true, 'Error MAX CODE Cases');
				   while($row_1=$GLOBALS['db']->fetchByAssoc($result_1)){
					   $code[] = $row_1;
				   }	   
				   $numrows = count($result_1);
				   if($numrows == 0){
					   $num = 0;
					   $num = $num + 1;
					   $caseCodeNum = "TTP12001OA".$num;		
				   } 
					else {
					    $string_slice = "".$code[0]['maxnum'];
					    //$string_slice = "TTP".$typeCode.$code[0]['maxnum'];
					    $abc = $string_slice+1;
					    $caseCodeNum = "TTP12001OA".$abc;
				   }
			       $string_sliceIs = substr($caseCodeNum, 10);
		               $finalCaseNumber = "TTP12001OA".$string_sliceIs;
			}
			*/
			/*echo "<pre>";
			print_r($_POST);
			echo "</pre>";*/
			//exit;
			$cs_no = "";
			//echo $bean->id;
			
			if(($_POST['case_number'] == $bean->case_number) && (!empty($_POST['record']))){
          		  
					$bean->case_number=$_POST['case_number'];
					//$bean->save();
					//$cs_no = $_POST['case_number'];
			}else if(($_POST['case_number'] == $bean->case_number) && (empty($_POST['record']))){
				  
					$bean->case_number=$_GET['case_number'];
					//$bean->save();
					//$cs_no = $_GET['case_number'];
			}else{
			    //$bean->date_entered = $bean->date_entered;
				//$bean->case_number = $finalCaseNumber;
				//$bean->save();
				//$cs_no = $finalCaseNumber;
			} 
			if(isset($bean->fetched_row['id'])){
				$finalCaseNumber = $_REQUEST['case_number'];
			}
			if($bean->caseoverride != 1){
				//$sql_update_cs = "UPDATE cases SET case_number = '".$finalCaseNumber."' WHERE id = '".$bean->id."'";
				//$db->query($sql_update_cs);
				$GLOBALS['update_cs_no'] = $finalCaseNumber;	
				
			}
			$GLOBALS['case_no'] = $finalCaseNumber;
		}
	   }
/*********************************************************************************************************************/

	function updateCaseName(&$bean, $event, $arguments){
		
		global $db;
		
		if(empty($bean->case_number)){
			
			$bean_id = $GLOBALS['case_no'];
		}
		else{
			$bean_id = $bean->case_number;
		}
		$sql_update_cs_name = "UPDATE cases SET name = '".$bean_id."' WHERE id = '".$bean->id."'";
		$db->query($sql_update_cs_name);
		if($GLOBALS['update_cs_no'] != ""){
			$sql_update_cs = "UPDATE cases SET case_number = '".$GLOBALS['update_cs_no']."' WHERE id = '".$bean->id."'";
			$db->query($sql_update_cs);	
		}
	}
	function updateStatusName(&$bean, $event, $arguments){
		
		global $db;
		if($_REQUEST['flag_hook'] != 1){
			if($bean->status == ""){
				$sql_cs_status = "SELECT id FROM c_case_status WHERE name = 'Not Started'";
				$res_status = $db->query($sql_cs_status);
				$row_status = $db->fetchByAssoc($res_status);
				echo $sql_update_cs_status = "UPDATE cases SET status = '".$row_status['id']."' WHERE id = '".$bean->id."'";
				$db->query($sql_update_cs_status);
			}
		}
	}
	
/******************************************* END OF CODE ************************************************************/

   }