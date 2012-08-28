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
 
 //By preethi on 26-06-2012
 //customizing the detail for reports
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
    require_once('XTemplate/xtpl.php');
    require_once('data/Tracker.php');
    require_once('include/DetailView/DetailView.php');
    require_once('modules/Inv_Report/language/en_us.lang.php');
    //by anuradha
	require_once('modules/Inv_Report/Inv_Report.php');
	
    global $mod_strings;
    global $app_list_strings;
    global $db;
	global $current_user;

    $focus      = new Inv_Report();
    $detailView = new DetailView();
    $offset     = 0;
    if (isset($_REQUEST['offset']) or isset($_REQUEST['record'])) {
        $result = $detailView->processSugarBean("Inv_Report", $focus, $offset);
        if($result == null) {
            sugar_die($app_strings['ERROR_NO_RECORD']);
        }
   	    $focus = $result;
    }else{
            header("Location: index.php?module=Inv_Report&action=index");
    }
    if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
        $focus->id = "";
    }
	if($focus->name != 'Inventions with Search but no Patent' && $focus->name !== 'Inventions with Expired Provisionals not Claimed' && $focus->name !== 'Expiring Provisionals with No Full Patent in Progress')
	{
		header("Location: index.php?module=Inv_Report&action=index");
	}
	// For fetching the consultant(users) list
	$users = array('all_consultants' => 'All Consultants');
	$sql_for_users = "SELECT * FROM `users` WHERE deleted=0  AND status='Active' ORDER BY first_name ASC";
	$result_sql_for_users = $focus->db->query($sql_for_users);
	while($row_sql_for_users = $focus->db->fetchByAssoc($result_sql_for_users)) {
		$users[$row_sql_for_users['id']]=$row_sql_for_users['first_name']." ".$row_sql_for_users['last_name'];
	}
	$users_options_str	= get_select_options_with_id($users, $current_user->id);
	$users_options_str = str_replace(array("\r\n","\n","\r"),"",$users_options_str);
	//End
	//1st
	// Inventions with Search but no Patent
    if($focus->name == 'Inventions with Search but no Patent'){
		echo "\n<p>\n";
		echo get_module_title($mod_strings['LBL_MODULE_NAME'], $mod_strings['LBL_MODULE_NAME'].": ".$focus->name, true);
		echo "\n</p>\n";
		global $theme;
		global $app_list_strings;
		$theme_path = "themes/".$theme."/";
		$image_path = $theme_path."images/";
		require_once($theme_path.'layout_utils.php');
		
		$GLOBALS['log']->info("Reports detail view");
		$focus->format_all_fields();
		
		$xtpl=new XTemplate ('modules/Inv_Report/Inventions_with_Search_ but_no_Patent.html');
		$xtpl->assign("MOD",           $mod_strings);
		$xtpl->assign("APP",           $app_strings);
		$xtpl->assign("THEME",         $theme);
		$xtpl->assign("GRIDLINE",      $gridline);
		$xtpl->assign("IMAGE_PATH",    $image_path);
		$xtpl->assign("PRINT_URL",    "index.php?".$GLOBALS['request_string']);
		$xtpl->assign("ID",            $focus->id);
		$xtpl->assign("NAME",$focus->name);
		
		$xtpl->assign("USERS_OPTIONS", $users_options_str);
		//old query
		/*$sq1 = " SELECT distinct inv_inventions.id , inv_inventions.name ";
		$sq1 .=" FROM inv_inventions LEFT JOIN cases ON cases.invention_id = inv_inventions.id LEFT JOIN c_case_status ON cases.status = c_case_status.id LEFT JOIN c_case_type ON cases.type=c_case_type.id ";
		$sq1 .=" WHERE c_case_type.case_type_code='PS' AND c_case_status.order_no='100'";*/
		
		//new query for fetching consultant
		$sq1 = " SELECT distinct inv_inventions.id , inv_inventions.name, users.first_name, users.last_name, users.id as user_id, accounts.name as client_name, accounts.id as account_id";
		$sq1 .=" FROM inv_inventions LEFT JOIN inv_inventions_accounts_c ON inv_inventions_accounts_c.inv_invent9feaentions_idb = inv_inventions.id LEFT JOIN accounts ON accounts.id = inv_inventions_accounts_c.inv_inventd1acccounts_ida LEFT JOIN users ON users.id = accounts.assigned_user_id LEFT JOIN cases ON cases.invention_id = inv_inventions.id LEFT JOIN c_case_status ON cases.status = c_case_status.id LEFT JOIN c_case_type ON cases.type=c_case_type.id ";
		$sq1 .=" WHERE c_case_type.case_type_code='PS' AND c_case_status.order_no='100' AND users.id='".$current_user->id."'";
		$result = $focus->db->query($sq1);
		$cnt = $focus->db->getRowCount($result);
		//Generating rows
		$str = '';
		$str .=  "<table border='0'  cellpadding='0' cellspacing='{GRIDLINE}' width='100%' style='table-layout:fixed'>";
		if($cnt>=1){
			while($row = $focus->db->fetchByAssoc($result)){
				$sql_2 = " SELECT cases.name FROM cases LEFT JOIN c_case_status ON cases.status = c_case_status.id LEFT JOIN c_case_type ON cases.type=c_case_type.id WHERE cases.invention_id='".$row['id']."' AND (c_case_type.case_type_code='UP' || c_case_type.case_type_code='IP' || c_case_type.case_type_code='PP' || c_case_type.case_type_code='DP') AND c_case_status.order_no>='20'";
				$result_2 = $focus->db->query($sql_2);
				if($row_2 = $focus->db->fetchByAssoc($result_2)){		
				}else{
					$str .=  "<tr>";
					$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><input type='checkbox' name='invention_id[]' id='invention_id' value='".$row['id']."'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DInv_Inventions%26action%3DDetailView%26record%3D".$row['id']."' title='Click To See The Details Of Invantions'>".$row['name']."</a></td>";
					
					$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DAccounts%26action%3DDetailView%26record%3D".$row['account_id']."'>".$row['client_name']."</a></td>";
					  
					$str .= "<td width='12%' valign='top' class='tabDetailViewDF'>".$row['first_name']." ".$row['last_name']."</td>";
					$str .=  "</tr>";
				}
			}
		}else{
			$str .=  "<tr>";
			$str .= "<td valign='top' width='975px' class='tabDetailViewDFNew' align='center'>"."No Recors Found"."</td>";
			$str .=  "</tr>";
		}
		
		$str .=  "</table>";
		$xtpl->assign("ROWS",$str);
		global $current_user;
		$detailView->processListNavigation($xtpl, "ord_Orders", $offset, $focus->is_AuditEnabled());
		require_once('modules/DynamicFields/templates/Files/DetailView.php');
		$xtpl->parse("main");
		$xtpl->out("main");
		//echo $old_contents;
		require_once('include/SubPanel/SubPanelTiles.php');
		//$subpanel = new SubPanelTiles($focus, 'INV_REPORT');
		//echo $subpanel->display();
		require_once('modules/SavedSearch/SavedSearch.php');
		$savedSearch        = new SavedSearch();
		$json               = getJSONobj();
		$savedSearchSelects = $json->encode(array($GLOBALS['app_strings']['LBL_SAVED_SEARCH_SHORTCUT'] . '<br>' 
		.$savedSearch->getSelect('Orders')));
		$str = "<script>
		YAHOO.util.Event.addListener(window, 'load', SUGAR.util.fillShortcuts, $savedSearchSelects);
		</script>";
		echo $str;
	}
	//2nd
	// Inventions with expired provisionals not claimed
	else if($focus->name == 'Inventions with Expired Provisionals not Claimed'){
		echo "\n<p>\n";
		echo get_module_title($mod_strings['LBL_MODULE_NAME'], $mod_strings['LBL_MODULE_NAME'].": ".$focus->name, true);
		echo "\n</p>\n";
		global $theme;
		global $app_list_strings;
		$theme_path = "themes/".$theme."/";
		$image_path = $theme_path."images/";
		require_once($theme_path.'layout_utils.php');
		
		$GLOBALS['log']->info("Reports detail view");
		$focus->format_all_fields();
		
		$xtpl=new XTemplate ('modules/Inv_Report/Inventions_with_Expired_Provisionals_not_Claimed.html');
		$xtpl->assign("MOD",           $mod_strings);
		$xtpl->assign("APP",           $app_strings);
		$xtpl->assign("THEME",         $theme);
		$xtpl->assign("GRIDLINE",      $gridline);
		$xtpl->assign("IMAGE_PATH",    $image_path);
		$xtpl->assign("PRINT_URL",    "index.php?".$GLOBALS['request_string']);
		$xtpl->assign("ID",            $focus->id);
		$xtpl->assign("NAME",$focus->name);
		
		$xtpl->assign("USERS_OPTIONS", $users_options_str);

		$today = date('Y-m-d');
		$past_year = date("Y-m-d", strtotime($today."-1 year" ));
		
		
		//Old query
		// filtering the inventions whoes casetype == pp and case order == 100
		/*$sq1 = " SELECT distinct inv_inventions.name,inv_inventions.id,cases.name as case_name ";
		$sq1 .=" FROM inv_inventions LEFT JOIN cases ON cases.invention_id = inv_inventions.id LEFT JOIN c_case_status ON cases.status = c_case_status.id LEFT JOIN c_case_type ON cases.type=c_case_type.id ";
		$sq1 .= " WHERE c_case_type.case_type_code='PP' AND c_case_status.order_no='100' GROUP BY inv_inventions.id";*/
		
		//new query for fetching consultant
		$sq1 = " SELECT distinct inv_inventions.name,inv_inventions.id,cases.name as case_name, users.first_name, users.last_name, users.id as user_id, accounts.name as client_name, accounts.id as account_id ";
		$sq1 .=" FROM inv_inventions LEFT JOIN inv_inventions_accounts_c ON inv_inventions_accounts_c.inv_invent9feaentions_idb = inv_inventions.id LEFT JOIN accounts ON accounts.id = inv_inventions_accounts_c.inv_inventd1acccounts_ida LEFT JOIN users ON users.id = accounts.assigned_user_id LEFT JOIN cases ON cases.invention_id = inv_inventions.id LEFT JOIN c_case_status ON cases.status = c_case_status.id LEFT JOIN c_case_type ON cases.type=c_case_type.id ";
		$sq1 .= " WHERE c_case_type.case_type_code='PP' AND c_case_status.order_no='100' AND users.id='".$current_user->id."' GROUP BY inv_inventions.id";
		
		$result = $focus->db->query($sq1);
		$cnt =  $focus->db->getRowCount($result);
		//Generating rows
		$str = '';
		$str .=  "<table border='0'  cellpadding='0' cellspacing='{GRIDLINE}' width='100%' style='table-layout:fixed'>";
		if($cnt>=1){
			while($row = $focus->db->fetchByAssoc($result)){
				// for the filter invention checking the filing date is > 1year from todays date for the recent record
				$sql_2 = "SELECT cases.filing_date,cases.name FROM `cases` LEFT JOIN c_case_status ON cases.status = c_case_status.id LEFT JOIN c_case_type ON cases.type=c_case_type.id WHERE  cases.invention_id='".$row['id']."' AND c_case_type.case_type_code='PP' AND c_case_status.order_no='100' ORDER BY cases.filing_date DESC ";
				$result_2 = $focus->db->query($sql_2);
				$row_2 = $focus->db->fetchByAssoc($result_2);
				if($row_2['filing_date'] < $past_year)
				{
					$sql_3 = " SELECT cases.name FROM cases LEFT JOIN c_case_status ON cases.status = c_case_status.id LEFT JOIN c_case_type ON cases.type=c_case_type.id WHERE cases.invention_id='".$row['id']."' AND (c_case_type.case_type_code='UP' || c_case_type.case_type_code='IP') AND c_case_status.order_no>='20'";
					$result_3 = $focus->db->query($sql_3);
					if($row_3 = $focus->db->fetchByAssoc($result_3)){		
					}else{
						$str .=  "<tr>";
						$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><input type='checkbox' name='invention_id[]' id='invention_id' value='".$row['id']."'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DInv_Inventions%26action%3DDetailView%26record%3D".$row['id']."' title='Click To See The Details Of Invantions'>".$row['name']."</a></td>";
						$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DAccounts%26action%3DDetailView%26record%3D".$row['account_id']."'>".$row['client_name']."</a></td>";
						$str .= "<td width='12%' valign='top' class='tabDetailViewDF'>".$row['first_name']." ".$row['last_name']."</td>";
						$str .=  "</tr>";
					}
				}
			}
		}else{
			$str .=  "<tr>";
			$str .= "<td valign='top' width='975px' class='tabDetailViewDFNew' align='center'>"."No Recors Found"."</td>";
			$str .=  "</tr>";
		}
		$str .=  "</table>";
		$xtpl->assign("ROWS",$str);
		global $current_user;
		$detailView->processListNavigation($xtpl, "ord_Orders", $offset, $focus->is_AuditEnabled());
		require_once('modules/DynamicFields/templates/Files/DetailView.php');
		$xtpl->parse("main");
		$xtpl->out("main");
		//echo $old_contents;
		require_once('include/SubPanel/SubPanelTiles.php');
		//$subpanel = new SubPanelTiles($focus, 'INV_REPORT');
		//echo $subpanel->display();
		require_once('modules/SavedSearch/SavedSearch.php');
		$savedSearch        = new SavedSearch();
		$json               = getJSONobj();
		$savedSearchSelects = $json->encode(array($GLOBALS['app_strings']['LBL_SAVED_SEARCH_SHORTCUT'] . '<br>' 
		.$savedSearch->getSelect('Orders')));
		$str = "<script>
		YAHOO.util.Event.addListener(window, 'load', SUGAR.util.fillShortcuts, $savedSearchSelects);
		</script>";
		echo $str;
	}
	//3rd
	//Expiring Provisionals with No Full Patent in Progress
	else if($focus->name == 'Expiring Provisionals with No Full Patent in Progress'){
		echo "\n<p>\n";
		echo get_module_title($mod_strings['LBL_MODULE_NAME'], $mod_strings['LBL_MODULE_NAME'].": ".$focus->name, true);
		echo "\n</p>\n";
		global $theme;
		global $app_list_strings;
		$theme_path = "themes/".$theme."/";
		$image_path = $theme_path."images/";
		require_once($theme_path.'layout_utils.php');
		
		$GLOBALS['log']->info("Reports detail view");
		$focus->format_all_fields();
		
		$xtpl=new XTemplate ('modules/Inv_Report/Expiring_Provisionals_with_No_Full_Patent_in_Progress.html');
		$xtpl->assign("MOD",           $mod_strings);
		$xtpl->assign("APP",           $app_strings);
		$xtpl->assign("THEME",         $theme);
		$xtpl->assign("GRIDLINE",      $gridline);
		$xtpl->assign("IMAGE_PATH",    $image_path);
		$xtpl->assign("PRINT_URL",    "index.php?".$GLOBALS['request_string']);
		$xtpl->assign("ID",            $focus->id);
		$xtpl->assign("NAME",$focus->name);
		
		$xtpl->assign("USERS_OPTIONS", $users_options_str);
		
		//old query
		/*$sq1 = "SELECT cases.name,cases.filing_date,cases.id ";
		$sq1 .=" FROM `cases` LEFT JOIN c_case_type ON cases.type=c_case_type.id ";
		$sq1 .= " WHERE c_case_type.case_type_code='PP'";*/
		
		//new query for fetching consultant
		$sq1 = "SELECT cases.name,cases.filing_date,cases.id, users.first_name, users.last_name, users.id as user_id, accounts.name as client_name, accounts.id as account_id ";
		$sq1 .=" FROM `cases` LEFT JOIN inv_inventions ON inv_inventions.id=cases.invention_id LEFT JOIN inv_inventions_accounts_c ON inv_inventions_accounts_c.inv_invent9feaentions_idb = inv_inventions.id LEFT JOIN accounts ON accounts.id = inv_inventions_accounts_c.inv_inventd1acccounts_ida LEFT JOIN users ON users.id = accounts.assigned_user_id LEFT JOIN c_case_type ON cases.type=c_case_type.id ";
		$sq1 .= " WHERE c_case_type.case_type_code='PP' AND users.id='".$current_user->id."'";
		
		$result = $focus->db->query($sq1);
		$cnt = $focus->db->getRowCount($result);
		//Generating rows
		$str = '';
		$str .=  "<table border='0'  cellpadding='0' cellspacing='{GRIDLINE}' width='100%' style='table-layout:fixed'>";
		if($cnt>=1){
			while($row = $focus->db->fetchByAssoc($result)){
				$today = date('Y-m-d');
				$filing_date = $row['filing_date'];
				$plus_year = date("Y-m-d", strtotime($filing_date."+1 year" ));
				$diff_days = (strtotime($plus_year) - strtotime($today)) / (60 * 60 * 24);
				if($diff_days > 0 && $diff_days <=60){
				
					$sql_2 = "SELECT cp_claimpriority.acase_id_c FROM `cp_claimpriority`WHERE cp_claimpriority.claimed_case_id='".$row['id']."' AND cp_claimpriority.deleted=0";
					$result_2 = $focus->db->query($sql_2);
					$count = $focus->db->getRowCount($result_2); 
					//echo $count;
					//echo "<br/>";
					$flag_status = 0;
					if($count > 0){
						while($row_2 = $focus->db->fetchByAssoc($result_2)){
							$sql_for_status = "SELECT c_case_status.order_no FROM cases LEFT JOIN c_case_status ON cases.status = c_case_status.id WHERE cases.deleted=0 AND cases.id='".$row_2['acase_id_c']."'";
							$result_for_status = $focus->db->query($sql_for_status);
							$row_for_status = $focus->db->fetchByAssoc($result_for_status);
							if($row_for_status['order_no']>=20){
								$flag_status = 1;
								break;
							}
						}
						if($flag_status == 0){
							$str .=  "<tr>";
							$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><input type='checkbox' name='case_id[]' id='case_id' value='".$row['id']."'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D".$row['id']."'>".$row['name']."</a></td>";
							$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DAccounts%26action%3DDetailView%26record%3D".$row['account_id']."'>".$row['client_name']."</a></td>";
	
							$str .= "<td width='12%' valign='top' class='tabDetailViewDF'>".$row['first_name']." ".$row['last_name']."</td>";
							//by anuradha 24/8/2012
							$str .= "<td width='12%' valign='top' class='tabDetailViewDF'>". $focus->formattedDate($filing_date)."</a></td>";

							$str .=  "</tr>";
						}
					}
					else{
						$str .=  "<tr>";
						$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><input type='checkbox' name='case_id[]' id='case_id' value='".$row['id']."'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D".$row['id']."'>".$row['name']."</a></td>";
						$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DAccounts%26action%3DDetailView%26record%3D".$row['account_id']."'>".$row['client_name']."</a></td>";
						$str .= "<td width='12%' valign='top' class='tabDetailViewDF'>".$row['first_name']." ".$row['last_name']."</td>";
						//by anuradha 24/8/2012
						$str .= "<td width='12%' valign='top' class='tabDetailViewDF'>". $focus->formattedDate($filing_date)."</a></td>";

						$str .=  "</tr>";
					}
				}
			}
		}else{
			$str .=  "<tr>";
			$str .= "<td valign='top' width='975px' class='tabDetailViewDFNew' align='center'>"."No Recors Found"."</td>";
			$str .=  "</tr>";
		}
		$str .=  "</table>";
		$xtpl->assign("ROWS",$str);
		global $current_user;
		$detailView->processListNavigation($xtpl, "ord_Orders", $offset, $focus->is_AuditEnabled());
		require_once('modules/DynamicFields/templates/Files/DetailView.php');
		$xtpl->parse("main");
		$xtpl->out("main");
		//echo $old_contents;
		require_once('include/SubPanel/SubPanelTiles.php');
		//$subpanel = new SubPanelTiles($focus, 'INV_REPORT');
		//echo $subpanel->display();
		require_once('modules/SavedSearch/SavedSearch.php');
		$savedSearch        = new SavedSearch();
		$json               = getJSONobj();
		$savedSearchSelects = $json->encode(array($GLOBALS['app_strings']['LBL_SAVED_SEARCH_SHORTCUT'] . '<br>' 
		.$savedSearch->getSelect('Orders')));
		$str = "<script>
		YAHOO.util.Event.addListener(window, 'load', SUGAR.util.fillShortcuts, $savedSearchSelects);
		</script>";
		echo $str;
	}
?>