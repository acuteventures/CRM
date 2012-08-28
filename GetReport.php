<?php

/**************************************************
 Autor: Basudeba
 Organization: Veon Consulting Pvt Ltd.
 Date: 25-02-2012
 Description: Fetching the records according to selected financial year
***************************************************/

chdir(realpath(dirname(__FILE__)));
define("sugarEntry", true);
require_once('include/entryPoint.php');


	$date_from = $_REQUEST['date_from'];
	$date_to = $_REQUEST['date_to'];
	$field_info = $_REQUEST['field'];
	$field_data = $_REQUEST['field_data'];
	$first_name = $_REQUEST['first_name'];
	$last_name = $_REQUEST['last_name'];
	
	$sql_cont = "SELECT * FROM c_contribute WHERE deleted = '0' GROUP BY login_id ";
	$res_cont = $db->query($sql_cont);

	$cont_user_array = array();
	$i = 0;
 	while($row_cont = $db->fetchByAssoc($res_cont)){
		
		$cont_user_obj = new User();
		$rec_cont_user = $cont_user_obj->retrieve($row_cont['login_id']);
		$cont_user = $rec_cont_user->first_name." ".$rec_cont_user->last_name;
		
		$cont_user_array[$i] = $row_cont;
		$i++;
		$user_str .= "<th valign='top' width='10%' class='tabDetailViewDL' style='text-align:left;'><span sugar='slot4b'>".$cont_user."</span></th>";
		
	}
	
	/*echo "<pre>";
	  print_r($cont_user_array);*/
	  
  // Finding total credit of each contributed user of each case types
  
  	  $type_case = array();
	  $temp_type = array(); // Required for filtering column case type wise.
 	  $sql_cs_types = "SELECT * FROM c_case_type WHERE deleted = '0' ORDER BY display_order";
	  $res_cs_types = $db->query($sql_cs_types);
	  $i=0;
	  while($row_cs_types = $db->fetchByAssoc($res_cs_types)){
	  
	  		$type_case[$i] = $row_cs_types;
			$temp_type[$row_cs_types['name']] = $row_cs_types['id'];
			$i++;
	  }
	 /* echo "<pre>";
	  print_r($temp_type);
	  $arr_total = array();*/
	
	  /* echo "<pre>";
	  print_r($type_case);die;*/
	  $credit_user = array();
	  for($user_loop=0;$user_loop<sizeof($cont_user_array);$user_loop++){
	  	
		for($type_loop = 0; $type_loop<sizeof($type_case);$type_loop++){
			
			$temp_credit = 0;
			$sql_cs_ids = "SELECT * FROM cases WHERE deleted = '0' AND type = '".$type_case[$type_loop]['id']."'";
			$res_cs_ids = $db->query($sql_cs_ids);
			
			while($row_cs_ids = $db->fetchByAssoc($res_cs_ids)){
			
				$sql_cont_credits = "SELECT * FROM c_contribute where deleted = '0' AND case_id = '".$row_cs_ids['id']."' AND login_id = '".$cont_user_array[$user_loop]['login_id']."' ";
				$res_cont_credits = $db->query($sql_cont_credits);
				while($row_cont_credits = $db->fetchByAssoc($res_cont_credits)){
				
					//print_r($row_cont_credits);
					$arr_total[$type_case[$l]['id']][$row_cont_credits['login_id']][] = $row_cont_credits;
					$temp_credit = $temp_credit + $row_cont_credits['credits'];
				}
			}
			$credit_user[$cont_user_array[$user_loop]['login_id']][$type_case[$type_loop]['id']] = $temp_credit;
			//echo $type_case[$type_loop]['id']."----------".$temp_credit."<br>";
			
		}
	  }
	 // echo "<pre>";
	  //print_r($credit_user);
	  
  /***********************************************************************************************************/
 	
	$sql = "SELECT c.id,c.name,c.case_number, c.account_id,c.type,c.credit_date,c.credit_alloc_notes, a.name
			FROM cases c, accounts a, users u
			WHERE c.account_id = a.id
			AND a.assigned_user_id = u.id   
			AND c.deleted = '0' AND a.deleted='0' and u.deleted = '0' ";
			
	if($date_from != "" && $date_to != ""){
		$sql .= " AND c.credit_date BETWEEN '".$date_from."' AND '".$date_to."' ";
	}
	if($field_info == "case_type"){
		$sql .= " AND c.type = '".$temp_type[$field_data]."' ";
	}
	else if($field_info == "consutant"){
		
		//$user_obj_filter = new User();
//		$rec_user = $user_obj_filter->retrieve($res_acc->assigned_user_id);
//		$consultant = $rec_user->first_name." ".$rec_user->last_name;
		$sql_user_id = "SELECT * FROM users WHERE first_name like '%".$first_name."' AND last_name like '%".$last_name."' ";
		$res_user_id = $db->query($sql_user_id);
		$row_sql_user_id = $db->fetchByAssoc($res_user_id);
		$sql .= " AND a.assigned_user_id = '".$row_sql_user_id['id']."' ";
	}
	else if($field_info == "client_name"){
		
		$sql .= " AND a.name like '%".$field_data."' ";
	}
		
	$res_cases = $db->query($sql);
	$cs_type = array();
	while($row_cases = $db->fetchByAssoc($res_cases)){
		
		$cs_type[$row_cases['type']][] = $row_cases;
		if($type_case[$i] != $row_cases['type']){
			$type_case[$i] = $row_cases['type'];
			$i++;
		}
	}
	/*echo "<pre>";
	print_r($type_case);
	echo count($type_case);
	die;*/
	
	//echo "<pre>";
	//print_r($cs_type);
	$sql_cont = "SELECT * FROM c_contribute WHERE deleted = '0' GROUP BY login_id ";
	$res_cont = $db->query($sql_cont);

	
	$i = 0;
	$user_str = "";
 	
	
	$str = '<table width="100%" border="0" cellspacing="{GRIDLINE}" cellpadding="0"  class="tabDetailView">';
			
	$flag_type = 0;
	foreach($cs_type as $cs_data){

		for($i=0; $i<sizeof($cs_data);$i++){
			
			$cs_type_obj = new c_case_type();
			$rec_type = $cs_type_obj->retrieve($cs_data[$i]['type']);
			
			$acc_obj = new Account();
			$res_acc = $acc_obj->retrieve($cs_data[$i]['account_id']);
			
			$user_obj = new User();
			$rec_user = $user_obj->retrieve($res_acc->assigned_user_id);
			$consultant = $rec_user->first_name." ".$rec_user->last_name;
			
			
			//echo $prev_type. "---".$rec_type->name."<br>";
		    $type_cs_id = $cs_data[$i]['type']."<br>";;
			$temp_count = 0;
			
			//echo $cs_data[$i]['type']."<br>";
			if($rec_type->name != $prev_type ){
				
				$str .= "<tr><td valign='top' class='tabDetailViewDF'></td><td valign='top' class='tabDetailViewDF'></td><td valign='top' class='tabDetailViewDF'></td><td valign='top' class='tabDetailViewDF'></td>";
				
				for($user_loop=0;$user_loop<sizeof($cont_user_array);$user_loop++){
					
					$str .= "<td valign='top' class='tabDetailViewDF'>".$credit_user[$cont_user_array[$user_loop]['login_id']][$type_id]."</td>";
				}
				
				$str .= "</tr>";
			}
			//echo $consultant."----".$prv_constultant."<br>";
			if($consultant != $prv_constultant){
				
				//$str .= "<tr><td></td><td></td><td></td><td></td><td valign='top' class='tabDetailViewDF'></td></tr>";
			}
			$flag_type = 1;
			$prev_type = $rec_type->name;
			
			
			$str .= "<tr>";
			$str .= "<td valign='top' class='tabDetailViewDF'>".$rec_type->name."</td>";
			
			if($consultant != $prv_constultant){
			
				$str .= "<td valign='top' class='tabDetailViewDF'>".$consultant."</td>";
				
			}
			else{
				
				$str .= "<td valign='top' class='tabDetailViewDF'></td>";
			}
			
			$prv_constultant = $consultant;
						
			$str .= "<td valign='top' class='tabDetailViewDF'>".$cs_data[$i]['case_number']."</td>";
			$str .= "<td valign='top' class='tabDetailViewDF'>".$res_acc->name."</td>";
					
			for($j = 0; $j < sizeof($cont_user_array); $j++){
				
				$sql_credit = "SELECT * FROM c_contribute WHERE case_id = '".$cs_data[$i]['id']."' AND login_id  = '".$cont_user_array[$j]['login_id']."' AND deleted = '0'";
						//echo $row_credit['credits']."<br>";		
				$res_credit = $db->query($sql_credit);
				if($row_credit = $db->fetchByAssoc($res_credit)){

					$str .= "<td valign='top' class='tabDetailViewDF'>".$row_credit['credits']."</td>";
				}
				else{
					$str .= "<td valign='top' class='tabDetailViewDF'></td>";
				}
			}		
					
			$str .= "<td valign='top' class='tabDetailViewDF'>".$cs_data[$i]['credit_alloc_notes']."</td>";
			$str .= "<td valign='top' class='tabDetailViewDF'>".$cs_data[$i]['credit_date']."</td>";		
			$str .= "</tr>";
			
			$type_id =  $cs_data[$i]['type'];
			//echo $rec_type->name."---";
			//echo $prev_type."<br>";	
		}
		
		
	}
	//$result .= $str;
	$str .= "</table>";
	echo $str;
?>