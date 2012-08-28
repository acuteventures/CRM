

<?php
/*****************************************************************************

Author: Basudeba Rath.
Date : 06-Feb-2012.
Org : Veon Consulting Pvt. Lte.

*****************************************************************************/

	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	
	global $db,$current_user;
	
	if(isset($_REQUEST['btn_claim'])){
		
		$user_id = $_REQUEST['user_id'];
		$record = $_REQUEST['record'];
		$app_no = $_REQUEST['app_no'];
		$app_type = $_REQUEST['app_type'];
		$filing_date = $_REQUEST['filing_date'];
		$country = $_REQUEST['country'];
		
		$clm_obj = new cp_claim_no_possession();
		//$rec_cs = $cs_Obj->retrieve($checkBox[$i]);
					
		$clm_obj->name = "claimed case";
		$clm_obj->acase_id_c = $record; 
						
		$clm_obj->application_no = $app_no;
		$clm_obj->filing_date = $filing_date;
		$clm_obj->application_type = $app_type;
		$clm_obj->country = $country;
		
		$clm_obj->set_created_by = false;
		$clm_obj->update_modified_by = false;
		
		$clm_obj->created_by = $user_id;
		$clm_obj->modified_user_id = $user_id;
		$clm_obj->assigned_user_id = $user_id;
		$clm_obj->save();
		$clm_obj->set_created_by = true;
		$clm_obj->update_modified_by = true;
		echo "<body onload='self.close()'>";
	}
	
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo getJSPath("themes/Sugar5/css/style.css"); ?>" />
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
	<script type="text/javascript">
				//	Calendar.setup ({
//					inputField : "filing_date",
//					daFormat : "%d-%m-%Y",
//					button : "created_trigger",
//					singleClick : true,
//					dateStr : "",
//					step : 1,
//					weekNumbers:false
//					}
//					);
					</script> 
</head>
<body class="popupBody">
<form action="" method="post">

		<table class="edit view">
			<tr>
				<td>Application Number : </td>
				<td><input type="text" id="app_no" name="app_no" /></td>
				<td>Application Type : </td>
				<td><input type="text" id="app_type" name="app_type" /></td>
			</tr>
			<tr>
				<td>Country : </td>
				<td><input type="text" id="country" name="country" /></td>
				<td>Filing Date : </td>
				<td><input type="text" id="filing_date" name="filing_date" />
				</td>
			</tr>
		</table>	
			
<input type="submit" name="btn_claim" id="btn_claim" value="Save" />
</form>
</body>
</html>