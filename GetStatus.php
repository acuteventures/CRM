<?php

/********************************************************

	AUTHOR : BASUDEBA RATH.
	DATE: 29-Nov-2011.
	VEON CONSULTING PVT. LTD.
********************************************************/
	
	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	global $db;
	
	$case_type = $_REQUEST['case_type'];
	
	$sql_Case_Status = "SELECT cs.id,cs.name,cs.display_order,cr.c_case_type_c_case_statusc_case_status_idb from c_case_type ct,c_case_status cs, c_case_type_c_case_status_c cr WHERE ct.id = '".$case_type."' and ct.id = cr.c_case_type_c_case_statusc_case_type_ida AND cr.c_case_type_c_case_statusc_case_status_idb = cs.id AND cs.deleted = '0' AND ct.deleted = '0' AND cr.deleted = '0' ORDER BY  cs.order_no asc"; //by anuradha 9/aug/2012 : display_order";
	
	$res_Case_Status = $db->query($sql_Case_Status);

?>

	<!--<select id="status" name="status" >-->
<?php
	while($row_Case_Status = $db->fetchByAssoc($res_Case_Status)){
		
		if($row_Case_Status['display_order'] == 2){
	
?>		
		<option value="<?php echo $row_Case_Status['id']; ?>" selected="selected"><?php echo $row_Case_Status['name']; ?></option>
<?php 	
		}
		else{
?>
		<option value="<?php echo $row_Case_Status['id']; ?>"><?php echo $row_Case_Status['name']; ?></option>
<?php
		}
	}
?>


	<!--</select>-->