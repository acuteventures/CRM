<?php

// Author : Basudeba Rath.
// Date : 03-jan-2012 
// Veon Consulting Pvt. Ltd.
/*-----------------------------------------------------------------------------*/


	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	
	
	global $db;
	$user_array1 = array();
	$sql_users1 = "SELECT id, first_name, last_name FROM users where deleted = '0' ";	
	$res_user1 = $db->query($sql_users1);
	while($row_users = $db->fetchByAssoc($res_user1)){

?>
		
	<option value="<?php echo $row_users['id']; ?>"><?php echo $row_users['first_name'] ." ". $row_users['last_name'];  ?></option>
<?php
		
	}


?>