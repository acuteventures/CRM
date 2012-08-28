<?php 


/****************************************************************************

Author : Basudeba Rath
Dt . 19-Jan-2012
Veon Consulting Pvt. Ltd.
Desc: Required to retrieve all the invention records related to client.

****************************************************************************/

if(!defined('sugarEntry'))define('sugarEntry', true);
require_once('include/entryPoint.php');
	
	global $db;
	$related_to_parent = $_REQUEST['rp'];
	
	$sql_case_types = "SELECT * FROM `c_case_type` WHERE deleted = '0' ORDER BY display_order";
	$res_case_types = $db->query($sql_case_types);
?>
	<option id=""></option>
<?php

	while($row_case_types = $db->fetchByAssoc($res_case_types)){
		
		if(($row_case_types['relatedtoparent'] == $related_to_parent) ||  ($row_case_types['name'] == 'Other')){
?>
		<option value="<?php echo $row_case_types['id']; ?>"><?php echo $row_case_types['name']; ?></option>
<?php
		}	
		else if($related_to_parent == "" && $row_case_types['name'] == 'Other'){
?>
			<option value="<?php echo $row_case_types['id']; ?>"><?php echo $row_case_types['name']; ?></option>
<?php
		}	
	}
	
	
	

?>
