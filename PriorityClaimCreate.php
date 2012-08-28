<?php
/*****************************************************************************

Author: Basudeba Rath.
Date : 20-Dec-2011
Org : Veon Consulting Pvt. Lte.
Modified Last : 05-Mar-2012.
*****************************************************************************/
if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	global $db;
	
	if(isset($_REQUEST['btn_claim'])){
		
		$checkBox = $_REQUEST['chk'];
		$user_id = $_REQUEST['user_id'];
		//echo $record = $_REQUEST['record'];die;
		
		for($i=0; $i<sizeof($checkBox); $i++){
		
			//echo $checkBox[$i]."<br>";
			$cs_Obj = new aCase();
			$rec_cs = $cs_Obj->retrieve($checkBox[$i]);
			$clm_obj = new cp_claimpriority();
			$clm_obj->name = "claimed case";
			
			//$clm_obj->acase_id_c = $record; // Saved in logic hook.
			
			$clm_obj->claimed_case_id = $rec_cs->id;
			$clm_obj->inv_inventions_id_c = $rec_cs->invention_id;
			
			$clm_obj->app_number = $rec_cs->application_number;
			$clm_obj->filing_date = $rec_cs->filing_date;
			
			$clm_obj->set_created_by = false;
			$clm_obj->update_modified_by = false;
			
			$clm_obj->created_by = $user_id;
			$clm_obj->modified_user_id = $user_id;
			$clm_obj->assigned_user_id = $user_id;
			$clm_obj->save();
			
			// new while creting case, submit claim.
			
			$cs_ids .= $clm_obj->id." ";
			
		}
		
		$clm_obj->set_created_by = true;
		$clm_obj->update_modified_by = true;
		//echo "<body onload='alert(\"Cases claimed successfully.\");self.close()'>";
	
		//echo $cs_ids ;
		
		echo "<script language  = 'javascript'>
				function saveId(){
					window.opener.document.getElementById('clm_ids').value = '';
					window.opener.document.getElementById('clm_ids').value ='$cs_ids';
				}
			</script>";
		echo "<body onload = 'saveId();alert(\"Click Save to Confirm!\");self.close();'>";
	}

?>


<html>
<body>
<form action="" method="post">
<?php
	$client_id = $_REQUEST['clnt_id'];
	$sql_inventions = "SELECT i.`id`, i.`name` from `inv_inventions` i, accounts c, inv_inventions_accounts_c ia WHERE ia.`inv_inventd1acccounts_ida` = '".$client_id."' AND  i.id=ia.inv_invent9feaentions_idb  AND i.`deleted` = '0' AND c.`deleted` = '0' AND ia.`deleted` = '0' and ia.inv_inventd1acccounts_ida= c.id";
	
	$res_inventions = $db->query($sql_inventions);
?>	
	<ol>
<?php
	$cnt = 0;
	while($row_inventions = $db->fetchByAssoc($res_inventions)){
	
		//print_r($row_inventions);	
		$sql_cases = "SELECT * FROM cases WHERE invention_id = '".$row_inventions['id']."' AND application_number <> 0 AND deleted = '0'";
		$res_cases = $db->query($sql_cases);
	
?>
		
		<li><?php echo $row_inventions['name']; ?></li>
		<ul>
			
<?php
		while($row_cases = $db->fetchByAssoc($res_cases)){
			$cs_type = new c_case_type();
			$rec_type = $cs_type->retrieve($row_cases['type']);
			
			$sql_check = "SELECT * FROM cp_claimpriority WHERE claimed_case_id = '".$row_cases['id']."' AND deleted = '0'";
			$res_check = $db->query($sql_check);
			echo "<li>";
			
// commented on 01-March-2012.			

			if($record_check = $db->fetchByAssoc($res_check)){
		// Added on - 01-mar-2012.
?>
				<input type="checkbox"  name="chk[]" value="<?php echo $row_cases['id']; ?> "  />
		<?php
		}
		else{
		
		?>
			<input type="checkbox"  name="chk[]" value="<?php echo $row_cases['id']; ?> " />
		<?php
		}
				
		
				
				 echo $rec_type->name . " | " . $row_cases['case_number'] . " | ". $row_cases['application_number'] . " | " . $row_cases['filing_date'];  
				 $cnt++;
		?>
			</li>
			
			<input type="hidden" name="application_number" id = "application_number" value="<?php echo $row_cases['application_number']; ?>" />
			<input type="hidden" name="filing_date"  id = "filing_date"  value="<?php echo $row_cases['filing_date']; ?>" />
			<input type="hidden" name="invention_id" id = "invention_id" value="<?php echo $row_cases['invention_id']; ?>" />
			<input type="hidden" name="case_id" id = "case_id" value="<?php echo $row_cases['id']; ?>" />
<?php
		}
?>
		</ul>	
		
<?php
	}
?>
</ol>	
<input type="submit" name="btn_claim" id="btn_claim" value="Save" />
</form>
</body>
</html>