<?php
chdir(realpath(dirname(__FILE__)));
define("sugarEntry", true);
require_once('include/entryPoint.php');
	
	if($_REQUEST['type']==1){           // 1st
		//all consultants
		if($_REQUEST['consultant_name'] == 'all_consultants'){
			$sq1 = "SELECT distinct inv_inventions.id , inv_inventions.name, users.first_name, users.last_name, users.id as user_id, accounts.name as client_name, accounts.id as account_id";
			$sq1 .=" FROM inv_inventions LEFT JOIN inv_inventions_accounts_c ON inv_inventions_accounts_c.inv_invent9feaentions_idb = inv_inventions.id LEFT JOIN accounts ON accounts.id = inv_inventions_accounts_c.inv_inventd1acccounts_ida LEFT JOIN users ON users.id = accounts.assigned_user_id LEFT JOIN cases ON cases.invention_id = inv_inventions.id LEFT JOIN c_case_status ON cases.status = c_case_status.id LEFT JOIN c_case_type ON cases.type=c_case_type.id ";
			$sq1 .=" WHERE c_case_type.case_type_code='PS' AND c_case_status.order_no='100'";
		}
		//selected consultant
		else{
			$sq1 = "SELECT distinct inv_inventions.id , inv_inventions.name, users.first_name, users.last_name, users.id as user_id, accounts.name as client_name, accounts.id as account_id";
			$sq1 .=" FROM inv_inventions LEFT JOIN inv_inventions_accounts_c ON inv_inventions_accounts_c.inv_invent9feaentions_idb = inv_inventions.id LEFT JOIN accounts ON accounts.id = inv_inventions_accounts_c.inv_inventd1acccounts_ida LEFT JOIN users ON users.id = accounts.assigned_user_id LEFT JOIN cases ON cases.invention_id = inv_inventions.id LEFT JOIN c_case_status ON cases.status = c_case_status.id LEFT JOIN c_case_type ON cases.type=c_case_type.id ";
			$sq1 .=" WHERE c_case_type.case_type_code='PS' AND c_case_status.order_no='100' AND users.id='".$_REQUEST['consultant_name']."'";
		}
		
		$Q_sql = $db->query($sq1);
		$cnt = $db->getRowCount($Q_sql);
		$str = '';
		$str .=  "<table border='0'  cellpadding='0' cellspacing='{GRIDLINE}' width='100%' style='table-layout:fixed'>";		
		if($cnt>=1){
			while($R_sql= $db->fetchByAssoc($Q_sql)){
				$sql_2 = " SELECT cases.name FROM cases LEFT JOIN c_case_status ON cases.status = c_case_status.id LEFT JOIN c_case_type ON cases.type=c_case_type.id WHERE cases.invention_id='".$R_sql['id']."' AND (c_case_type.case_type_code='UP' || c_case_type.case_type_code='IP' || c_case_type.case_type_code='PP' || c_case_type.case_type_code='DP') AND c_case_status.order_no>='20'";
				$result_2 = $db->query($sql_2);
				if($row_2 = $db->fetchByAssoc($result_2)){		
				}else{
					$str .=  "<tr>";
					$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><input type='checkbox' name='invention_id' id='invention_id' value='".$R_sql['id']."'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DInv_Inventions%26action%3DDetailView%26record%3D".$R_sql['id']."' title='Click To See The Details Of Invantions'>".$R_sql['name']."</a></td>";
					$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DAccounts%26action%3DDetailView%26record%3D".$R_sql['account_id']."'>".$R_sql['client_name']."</a></td>";
					$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><a href='index.php?module=Users&offset=7&stamp=1341809177067736200&return_module=Users&action=DetailView&record=".$R_sql['user_id']."'>".$R_sql['first_name']." ".$R_sql['last_name']."</a></td>";
					$str .=  "</tr>";
				}
			}
		}else{
			$str .=  "<tr>";
			$str .= "<td valign='top' width='975px' class='tabDetailViewDFNew' align='center'>"."No Recors Found"."</td>";
			$str .=  "</tr>";
		}
		$str .=  "</table>";
		echo $str;
	}else if($_REQUEST['type']==2){             // 2nd
		$today = date('Y-m-d');
		$past_year = date("Y-m-d", strtotime($today."-1 year" ));
		//all consultants
		if($_REQUEST['consultant_name'] == 'all_consultants'){
			$sq1 = " SELECT distinct inv_inventions.name,inv_inventions.id,cases.name as case_name, users.first_name, users.last_name, users.id as user_id,accounts.name as client_name, accounts.id as account_id ";
			$sq1 .=" FROM inv_inventions LEFT JOIN inv_inventions_accounts_c ON inv_inventions_accounts_c.inv_invent9feaentions_idb = inv_inventions.id LEFT JOIN accounts ON accounts.id = inv_inventions_accounts_c.inv_inventd1acccounts_ida LEFT JOIN users ON users.id = accounts.assigned_user_id LEFT JOIN cases ON cases.invention_id = inv_inventions.id LEFT JOIN c_case_status ON cases.status = c_case_status.id LEFT JOIN c_case_type ON cases.type=c_case_type.id ";
			$sq1 .= " WHERE c_case_type.case_type_code='PP' AND c_case_status.order_no='100' GROUP BY inv_inventions.id";

		}
		//selected consultant
		else{
			$sq1 = " SELECT distinct inv_inventions.name,inv_inventions.id,cases.name as case_name, users.first_name, users.last_name, users.id as user_id,accounts.name as client_name, accounts.id as account_id ";
			$sq1 .=" FROM inv_inventions LEFT JOIN inv_inventions_accounts_c ON inv_inventions_accounts_c.inv_invent9feaentions_idb = inv_inventions.id LEFT JOIN accounts ON accounts.id = inv_inventions_accounts_c.inv_inventd1acccounts_ida LEFT JOIN users ON users.id = accounts.assigned_user_id LEFT JOIN cases ON cases.invention_id = inv_inventions.id LEFT JOIN c_case_status ON cases.status = c_case_status.id LEFT JOIN c_case_type ON cases.type=c_case_type.id ";
			$sq1 .= " WHERE c_case_type.case_type_code='PP' AND c_case_status.order_no='100' AND users.id='".$_REQUEST['consultant_name']."' GROUP BY inv_inventions.id";
		}
		$Q_sql = $db->query($sq1);
		$cnt = $db->getRowCount($Q_sql);
		$str = '';
		$str .=  "<table border='0'  cellpadding='0' cellspacing='{GRIDLINE}' width='100%' style='table-layout:fixed'>";
		if($cnt>=1){
			while($row = $db->fetchByAssoc($Q_sql)){
				// for the filter invention checking the filing date is > 1year from todays date for the recent record
				$sql_2 = "SELECT cases.filing_date,cases.name FROM `cases` LEFT JOIN c_case_status ON cases.status = c_case_status.id LEFT JOIN c_case_type ON cases.type=c_case_type.id WHERE  cases.invention_id='".$row['id']."' AND c_case_type.case_type_code='PP' AND c_case_status.order_no='100' ORDER BY cases.filing_date DESC ";
				$result_2 = $db->query($sql_2);
				$row_2 = $db->fetchByAssoc($result_2);
				if($row_2['filing_date'] < $past_year)
				{
					$sql_3 = " SELECT cases.name FROM cases LEFT JOIN c_case_status ON cases.status = c_case_status.id LEFT JOIN c_case_type ON cases.type=c_case_type.id WHERE cases.invention_id='".$row['id']."' AND (c_case_type.case_type_code='UP' || c_case_type.case_type_code='IP') AND c_case_status.order_no>='20'";
					$result_3 = $db->query($sql_3);
					if($row_3 = $db->fetchByAssoc($result_3)){		
					}else{
						$str .=  "<tr>";
						$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><input type='checkbox' name='invention_id' id='invention_id' value='".$row['id']."'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DInv_Inventions%26action%3DDetailView%26record%3D".$row['id']."' title='Click To See The Details Of Invantions'>".$row['name']."</a></td>";
						$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DAccounts%26action%3DDetailView%26record%3D".$row['account_id']."'>".$row['client_name']."</a></td>";
						$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><a href='index.php?module=Users&offset=7&stamp=1341809177067736200&return_module=Users&action=DetailView&record=".$row['user_id']."'>".$row['first_name']." ".$row['last_name']."</a></td>";
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
			echo $str;
	}else if($_REQUEST['type']==3){             //3rd
		//all consultants
		if($_REQUEST['consultant_name'] == 'all_consultants'){
			$sq1 = "SELECT cases.name,cases.filing_date,cases.id, users.first_name, users.last_name, users.id as user_id,accounts.name as client_name, accounts.id as account_id ";
			$sq1 .=" FROM `cases` LEFT JOIN inv_inventions ON inv_inventions.id=cases.invention_id LEFT JOIN inv_inventions_accounts_c ON inv_inventions_accounts_c.inv_invent9feaentions_idb = inv_inventions.id LEFT JOIN accounts ON accounts.id = inv_inventions_accounts_c.inv_inventd1acccounts_ida LEFT JOIN users ON users.id = accounts.assigned_user_id LEFT JOIN c_case_type ON cases.type=c_case_type.id ";
			$sq1 .= " WHERE c_case_type.case_type_code='PP'";
		}
		//selected consultant
		else{
			$sq1 = "SELECT cases.name,cases.filing_date,cases.id, users.first_name, users.last_name, users.id as user_id,accounts.name as client_name, accounts.id as account_id ";
			$sq1 .=" FROM `cases` LEFT JOIN inv_inventions ON inv_inventions.id=cases.invention_id LEFT JOIN inv_inventions_accounts_c ON inv_inventions_accounts_c.inv_invent9feaentions_idb = inv_inventions.id LEFT JOIN accounts ON accounts.id = inv_inventions_accounts_c.inv_inventd1acccounts_ida LEFT JOIN users ON users.id = accounts.assigned_user_id LEFT JOIN c_case_type ON cases.type=c_case_type.id ";
			$sq1 .= " WHERE c_case_type.case_type_code='PP' AND users.id='".$_REQUEST['consultant_name']."'";
		}
		$Q_sql = $db->query($sq1);
		$cnt = $db->getRowCount($Q_sql);
		$str = '';
		$str .=  "<table border='0'  cellpadding='0' cellspacing='{GRIDLINE}' width='100%' style='table-layout:fixed'>";
		if($cnt>=1){
			while($row = $db->fetchByAssoc($Q_sql)){
			$today = date('Y-m-d');
			$filing_date = $row['filing_date'];
			$plus_year = date("Y-m-d", strtotime($filing_date."+1 year" ));
			$diff_days = (strtotime($plus_year) - strtotime($today)) / (60 * 60 * 24);
				if($diff_days > 0 && $diff_days <=60){
					$sql_2 = "SELECT cp_claimpriority.acase_id_c FROM `cp_claimpriority`WHERE cp_claimpriority.claimed_case_id='".$row['id']."' AND cp_claimpriority.deleted=0";
					$result_2 = $db->query($sql_2);
					$count = $db->getRowCount($result_2); 
					//echo $count;
					//echo "<br/>";
					$flag_status = 0;
					if($count > 0){
						while($row_2 = $db->fetchByAssoc($result_2)){
							$sql_for_status = "SELECT c_case_status.order_no FROM cases LEFT JOIN c_case_status ON cases.status = c_case_status.id WHERE cases.deleted=0 AND cases.id='".$row_2['acase_id_c']."'";
							$result_for_status = $db->query($sql_for_status);
							$row_for_status = $db->fetchByAssoc($result_for_status);
							if($row_for_status['order_no']>=20){
								$flag_status = 1;
								break;
							}
						}
						if($flag_status == 0){
							$str .=  "<tr>";
							$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><input type='checkbox' name='case_id' id='case_id' value='".$row['id']."'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D".$row['id']."'>".$row['name']."</a></td>";
							$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DAccounts%26action%3DDetailView%26record%3D".$row['account_id']."'>".$row['client_name']."</a></td>";
							$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><a href='index.php?module=Users&offset=7&stamp=1341809177067736200&return_module=Users&action=DetailView&record=".$row['user_id']."'>".$row['first_name']." ".$row['last_name']."</a></td>";
							$str .=  "</tr>";
						}
					}
					else{
						$str .=  "<tr>";
						$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><input type='checkbox' name='case_id' id='case_id' value='".$row['id']."'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D".$row['id']."'>".$row['name']."</a></td>";
						$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DAccounts%26action%3DDetailView%26record%3D".$row['account_id']."'>".$row['client_name']."</a></td>";
						$str .= "<td width='12%' valign='top' class='tabDetailViewDF'><a href='index.php?module=Users&offset=7&stamp=1341809177067736200&return_module=Users&action=DetailView&record=".$row['user_id']."'>".$row['first_name']." ".$row['last_name']."</a></td>";
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
			echo $str;
	}
?>
