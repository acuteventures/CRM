

<?php
/*****************************************************************************

Author: Basudeba Rath.
Date : 07-Feb-2012.
Org : Veon Consulting Pvt. Lte.

*****************************************************************************/

	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	
	global $db,$current_user;
	
	if(isset($_REQUEST['btn_claim'])){
		
		$app_no = $_REQUEST['app_no'];
		$app_type = $_REQUEST['app_type'];
		$filing_date = $_REQUEST['filing_date'];
		$country = $_REQUEST['country'];
		
		$clm_cs_id = $_REQUEST['clm_cs_id'];
		$clm_flag = $_REQUEST['clm_flag'];
		
		if($clm_flag == 1){
			 
			$clm_obj = new cp_claimpriority();
			$rec_clm = $clm_obj->retrieve($clm_cs_id);
			$clm_obj->id = $clm_cs_id;
			$clm_obj->app_number = $app_no;
			$clm_obj->filing_date = $filing_date;
			$clm_obj->save(true);
		
		}
		else if($clm_flag == 2){
			$clm_obj = new cp_claim_no_possession();
			$rec_clm = $clm_obj->retrieve($clm_cs_id);
			$clm_obj->id = $clm_cs_id;
			$clm_obj->application_no = $app_no;
			$clm_obj->country = $country;
			$clm_obj->filing_date = $filing_date;
			$clm_obj->save(true);
			
			// * updating priority date in cases table
				$sql_claim_priority = "SELECT min(filing_date) as mindate  FROM cp_claimpriority WHERE acase_id_c = '".$_REQUEST['bean_id']."' AND deleted = '0'";
			   $res_claim_priority = $db->query($sql_claim_priority);
			   $row_sql_claim_priority = $db->fetchByAssoc($res_claim_priority);
			   
			   $sql_clm_pr_np = "SELECT min(filing_date) as mindate  FROM cp_claim_no_possession WHERE acase_id_c = '".$_REQUEST['bean_id']."' AND deleted = '0'";
			   $res_clm_pr_np = $db->query($sql_clm_pr_np);
			   $row_clm_pr_np = $db->fetchByAssoc($res_clm_pr_np);
			   
			   if($row_sql_claim_priority['mindate'] != "" && $row_clm_pr_np['mindate'] != ""){
			   
				   if($row_sql_claim_priority['mindate'] < $row_clm_pr_np['mindate']){
						$p_date = $row_sql_claim_priority['mindate'];
				   }
				   else{
						$p_date = $row_clm_pr_np['mindate'];
				   }
			   }else if($row_sql_claim_priority['mindate'] != "" || $row_clm_pr_np['mindate'] != ""){
			   
				   if($row_sql_claim_priority['mindate'] != ""){
						$p_date = $row_sql_claim_priority['mindate'];
				   }
				   else if($row_clm_pr_np['mindate'] != ""){
						$p_date = $row_clm_pr_np['mindate'];
				   }
			   }
			   $updatePriority="UPDATE cases SET prioritydate='".$p_date."' WHERE id='".$_REQUEST['bean_id']."'";
			   $res_updatePriority = $db->query($updatePriority);
			   // * preethi on 24-08-2012 Des : updating priority date in the c_s_d_case_subcase_dashlet table
			   $updatePriority_for_new="UPDATE c_s_d_case_subcase_dashlet SET prioritydate='".$p_date."' WHERE case_subcase_id='".$_REQUEST['bean_id']."'";
			   $res_updatePriority_for_new = $db->query($updatePriority_for_new);
			   // * End
			  // * End
		}
		echo '<body onload="javascript:alert(\'Updated...\');self.close(); window.opener.location.reload();">';			
		//echo "<body onload='self.close()'>";
	}
	
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo getJSPath("themes/Sugar5/css/style.css"); ?>" />

</head>

<?php
	
	$claimed_case_id = $_REQUEST['claimed_case_id'];
	$case_id = $_REQUEST['bean_id'];
	
	$sql_possession = "SELECT * FROM cp_claimpriority WHERE acase_id_c = '".$case_id."' AND id = '".$claimed_case_id."' AND deleted = '0'";
	$res_possession = $db->query($sql_possession);
	$row_possession = $db->fetchByAssoc($res_possession);
	
	$cs_obj = new aCase();
	$cs_record = $cs_obj->retrieve($row_possession['claimed_case_id']);
	
	$sql_no_possession = "SELECT * FROM cp_claim_no_possession WHERE id = '".$claimed_case_id."' AND acase_id_c ='".$case_id."' AND deleted = '0'";
	$rec_no_possession = $db->query($sql_no_possession);
	$row_no_possession = $db->fetchByAssoc($rec_no_possession);
	
	$claim_flag = "";
	if($row_possession != ""){
	
		$cs_type_obj = new c_case_type();
		$rec_cs_type = $cs_type_obj->retrieve($cs_record->type);
		$app_type = $rec_cs_type->name;
		$app_no = $row_possession['app_number'];
		$fdate = $row_possession['filing_date'];
		$formated_fdate = date('m/d/Y',strtotime($fdate));
		$claim_flag = 1;
	}
	if($row_no_possession != ""){
		
		$app_type = $row_no_possession['application_type'];
		$country = $row_no_possession['country'];
		$fdate = $row_no_possession['filing_date'];
		$formated_fdate = date('m/d/Y',strtotime($fdate));
		$app_no = $row_no_possession['application_no'];
		$claim_flag = 2;
	}
	
?>
	<!-- Anuradha -- Date Picker Start -->
<link rel="stylesheet" href="jquery/themes/base/jquery.ui.all.css">
<script src="jquery/jquery-1.7.min.js"></script>
<script src="jquery/ui/jquery.ui.core.js"></script>
<script src="jquery/ui/jquery.ui.datepicker.js"></script>
<link rel="stylesheet" href="jquery/demos.css">
<script>
	$(function() {
		$( "#filing_date" ).datepicker({
			showOn: "button",
			buttonImage: "jquery/images/calendar.gif",
			buttonImageOnly: true
		});
	});
	</script>
	<!-- Anuradha -- Date Picker End -->
<body class="popupBody">
<form action="" method="post">

		<table class="edit view">
			<tr>
				<td>Application Number : </td>
				<td><input type="text" id="app_no" name="app_no" value="<?php echo $app_no; ?>" /></td>
				<td>Application Type : </td>
				<td><input type="text" id="app_type" name="app_type"  value="<?php echo $app_type; ?>" disabled="disabled"/></td>
			</tr>
			<tr>
				<td>Country : </td>
				<td><input type="text" id="country" name="country" value="<?php echo $country; ?>" /></td>
				<td>Filing Date : </td>
				<td><input type="text" id="filing_date" name="filing_date" value="<?php echo $formated_fdate; ?>" /></td>
			</tr>
		</table>	
		
	<input type="hidden" id="clm_cs_id" name="clm_cs_id" value="<?php echo $claimed_case_id; ?>" />
	<input type="hidden" id="clm_flag" name="clm_flag" value="<?php echo $claim_flag; ?>" />
	
<input type="submit" name="btn_claim" id="btn_claim" value="Save" />
</form>
</body>
</html>