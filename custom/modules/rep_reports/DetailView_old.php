<?php
/*****************************************************************************
 * The contents of this file are subject to the RECIPROCAL PUBLIC LICENSE
 * Version 1.1 ("License"); You may not use this file except in compliance
 * with the License. You may obtain a copy of the License at
 * http://opensource.org/licenses/rpl.php. Software distributed under the
 * License is distributed on an "AS IS" basis, WITHOUT WARRANTY OF ANY KIND,
 * either express or implied.
 *
 * You may:
 * a) Use and distribute this code exactly as you received without payment or
 *    a royalty or other fee.
 * b) Create extensions for this code, provided that you make the extensions
 *    publicly available and document your modifications clearly.
 * c) Charge for a fee for warranty or support or for accepting liability
 *    obligations for your customers.
 *
 * You may NOT:
 * a) Charge for the use of the original code or extensions, including in
 *    electronic distribution models, such as ASP (Application Service
 *    Provider).
 * b) Charge for the original source code or your extensions other than a
 *    nominal fee to cover distribution costs where such distribution
 *    involves PHYSICAL media.
 * c) Modify or delete any pre-existing copyright notices, change notices,
 *    or License text in the Licensed Software
 * d) Assert any patent claims against the Licensor or Contributors, or
 *    which would in any way restrict the ability of any third party to use the
 *    Licensed Software.
 *
 * You must:
 * a) Document any modifications you make to this code including the nature of
 *    the change, the authors of the change, and the date of the change.
 * b) Make the source code for any extensions you deploy available via an
 *    Electronic Distribution Mechanism such as FTP or HTTP download.
 * c) Notify the licensor of the availability of source code to your extensions
 *    and include instructions on how to acquire the source code and updates.
 * d) Grant Licensor a world-wide, non-exclusive, royalty-free license to use,
 *    reproduce, perform, modify, sublicense, and distribute your extensions.
 *
 * The Original Code is: CommuniCore
 *                       Olavo Farias
 *                       2006-04-7 olavo.farias@gmail.com
 *
 * The Initial Developer of the Original Code is CommuniCore.
 * Portions created by CommuniCore are Copyright (C) 2005 CommuniCore Ltda
 * All Rights Reserved.
 ********************************************************************************/

    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
    require_once('XTemplate/xtpl.php');
    require_once('data/Tracker.php');
    require_once('include/DetailView/DetailView.php');
    require_once('modules/rep_reports/language/en_us.lang.php');
    
    global $mod_strings;
    global $app_strings;
    global $db;
    
    $focus      = new rep_reports();
    $detailView = new DetailView();
    $offset     = 0;
    if (isset($_REQUEST['offset']) or isset($_REQUEST['record'])) {
        $result = $detailView->processSugarBean("rep_reports", $focus, $offset);
        if($result == null) {
            sugar_die($app_strings['ERROR_NO_RECORD']);
        }
   	    $focus = $result;
        }else{
          //  header("Location: index.php?module=rep_reports&action=index");
    }
   
  
    if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
        $focus->id = "";
    }
    
    if($focus->name != 'Partner Account List'){
    	 //header("Location: index.php?module=rep_reports&action=index");
    }
    echo "\n<p>\n";
    echo get_module_title($mod_strings['LBL_MODULE_ID'], $mod_strings['LBL_MODULE_NAME'].": ".$focus->name, true);
    echo "\n</p>\n";
    
    
    global $theme;
    global $app_list_strings;
    $theme_path = "themes/".$theme."/";
    $image_path = $theme_path."images/";
    require_once($theme_path.'layout_utils.php');
    
    $GLOBALS['log']->info("rep_reports");
    $focus->format_all_fields();
    
    $xtpl=new XTemplate ('custom/modules/rep_reports/DetailView.html');
      
    $xtpl->assign("MOD",           $mod_strings);
    $xtpl->assign("APP",           $app_strings);
    $xtpl->assign("THEME",         $theme);
    $xtpl->assign("GRIDLINE",      $gridline);
    $xtpl->assign("IMAGE_PATH",    $image_path);
    $xtpl->assign("PRINT_URL",    "index.php?".$GLOBALS['request_string']);
    $xtpl->assign("ID",            $focus->id);
   
    
    $xtpl->assign("NAME",$focus->name);
   
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
 	  $sql_cs_types = "SELECT * FROM c_case_type WHERE deleted = '0' ORDER BY display_order";
	  $res_cs_types = $db->query($sql_cs_types);
	  $i=0;
	  while($row_cs_types = $db->fetchByAssoc($res_cs_types)){
	  
	  		$type_case[$i] = $row_cs_types;
			$i++;
	  }
	  
	  $arr_total = array();
	 /* for($l=0;$l<sizeof($type_case);$l++){
		 
		for($user_loop=0;$user_loop<sizeof($cont_user_array);$user_loop++){
		
			$sql_cs_ids = "SELECT * FROM cases WHERE deleted = '0' AND type = '".$type_case[$l]['id']."'";
			$res_cs_ids = $db->query($sql_cs_ids);
			while($row_cs_ids = $db->fetchByAssoc($res_cs_ids)){
				
				// getting credits for each user having particular case type.	
				$sql_cont_credits = "SELECT * FROM c_contribute where deleted = '0' AND case_id = '".$row_cs_ids['id']."' AND login_id = '".$cont_user_array[$user_loop]['login_id']."'";
				$res_cont_credits = $db->query($sql_cont_credits);
				while($row_cont_credits= $db->fetchByAssoc($res_cont_credits)){
				
					//print_r($row_cont_credits);
					$arr_total[$type_case[$l]['id']][$row_cont_credits['login_id']][] = $row_cont_credits;
				}
				
			}
		}	
		 
	  }
	  print_r($arr_total);
	  die;*/
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
	  
  /*******************************************************************/
 	
	
	$xtpl->assign("USERS_TOP",$user_str);
	
	$sql = "SELECT c.id,c.name,c.case_number, c.account_id,c.type,c.credit_date,c.credit_alloc_notes, a.name
			FROM cases c, accounts a, users u
			WHERE c.account_id = a.id
			AND a.assigned_user_id = u.id 
			AND c.deleted = '0' AND a.deleted='0' and u.deleted = '0'";
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
	//$str = '<table width="100%" border="0" cellspacing="{GRIDLINE}" cellpadding="0"  class="tabDetailView">';
	
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
			$str .=  "</tr>";
			
			$type_id =  $cs_data[$i]['type'];
			//echo $rec_type->name."---";
			//echo $prev_type."<br>";
			
			
		}
		
		
	}
	$xtpl->assign("ROWS",$str);
	//$str .= "</table>";
	
	/*echo "<pre>";
	print_r($cs_type);*/
	
   
    $xtpl->parse("main");
    $xtpl->out("main"); 
    


?>

