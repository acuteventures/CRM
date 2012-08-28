<?php 
/***************************************************************

Author :  Basudeba Rath
Date : 02-Feb-2012.
Veon Consulting Pvt. Ltd.

***************************************************************/

if(!defined('sugarEntry'))define('sugarEntry', true);
require_once('include/entryPoint.php');

?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo getJSPath("themes/Sugar5/css/style.css"); ?>" />

</head>
<body onLoad="closeform()"  class="popupBody">
<?php


	global $db;
	
	$sql_users = "SELECT id, first_name, last_name FROM users where deleted = '0'";	
	$res_user = $db->query($sql_users);
	
	if(isset($_REQUEST['btn_users'])){
		//print_r($_REQUEST['assigned_to_users']);
		if(!empty($_REQUEST['assigned_to_users'])){
			
			$selected_users = array();
			$cont_users = "";
			
			$user_id = $_REQUEST['userid'];
			$case_id = $_REQUEST['beanid'];
			//by anuradha 23/8/2012			
			if($_REQUEST['subcase']=='yes'){
			$subcase = $_REQUEST['subcase'];
			}else{
			$subcase = '';
			}
			//end
			$selected_users = $_REQUEST['assigned_to_users'];
			
			for($i=0;$i<sizeof($selected_users);$i++){
			
				$sql_cont = "SELECT * from `c_contribute` WHERE login_id = '".$selected_users[$i]."' 
																	AND case_id = '".$case_id."'  AND deleted = '0'";		
				$res_cont = $db->query($sql_cont);
				while($row_cont = $db->fetchByAssoc($res_cont)){
				
					$user_obj = new User();
					$user_obj->retrieve($row_cont['login_id']);
					$cont_users .= $user_obj->first_name." ".$user_obj->last_name." ,";
				}
			}
			if($cont_users != ""){
				echo "<script language = 'javascript'>
				function closeform(){
					alert('$cont_users already contributed.');
					exit;
				}</script>";
				
			}
			else{
				$ret_value = contribute($case_id, $user_id, $db,$selected_users,$subcase);
				save_history($ret_value, $user_id, $case_id,$subcase);
				
				echo "<script language = 'javascript'>
				function closeform(){
					window.opener.location.reload();
					self.close();
				}
			
				</script>";
			}
		}
	}
	
	function contribute($id, $user_id, $db, $assigned_users,$subcase){
	
		$assigned = array();
		$j = 0;
		//$not_assigned = "";
		for($i=0; $i<sizeof($assigned_users);$i++){
		
			$sql_cont = "SELECT * from `c_contribute` WHERE login_id = '".$assigned_users[$i]."' 
																AND case_id = '".$id."'  AND deleted = '0'";		
			$res_cont = $db->query($sql_cont);
			$row_cont = $db->fetchByAssoc($res_cont);
		
			$cont_obj = new c_contribute();
			//by anuradha 23/8/2012
			if($subcase=='yes'){
				$title = 'Sub Case';
			}
			else{
				$title = 'Case';
			}
			//end
			$cont_obj->name =  "Assigned to ".$title;
			$cont_obj->login_id = $assigned_users[$i];
			$cont_obj->case_id = $id;
			
			$cont_obj->assigned_user_id = $assigned_users[$i];
			$cont_obj->set_created_by = false;
			$cont_obj->update_modified_by = false;
			$cont_obj->created_by = $user_id;
			$cont_obj->modified_user_id = $user_id;
			$cont_obj->cont_assigned_flag = 1;
			$cont_obj->save();
			
			$cont_obj->set_created_by = true;
			$cont_obj->update_modified_by = true;
			
			$assigned[$j] = $assigned_users[$i]; 
			$j++;	
			
			//if(empty($row_cont)){}
			/*if($row_cont['cont_assigned_flag'] == '0'){
				$not_assigned .= '<br>'. $assigned_users[$i];
			}
			else{
				//return 0;
			}*/
		}// End For.
		return $assigned;
		
	} // End Function contribute.
	
	function save_history($users_assigned, $user_id, $case_id,$subcase){
	
		$user_obj1 = new User();
		$rec_user1 = $user_obj1->retrieve($user_id);
		for($i=0; $i<sizeof($users_assigned); $i++){
		   
			$user_obj = new User();
			$rec_user = $user_obj->retrieve($users_assigned[$i]);
			
			$note_module = new Note();
			$note_module->set_created_by = false;
			$note_module->update_modified_by = false;
			//by anuradha 23/8/2012
			if($subcase=='yes'){
				$nm = 'Sub Case History - System generated';
			}else{
				$nm = 'Case History - System generated';
			}
			//end
			$note_module->name = $nm;
			$note_module->parent_id = $case_id;
			//by anuradha
			if($subcase=='yes'){
			 $des = "sub case";
			}else{
			 $des = "case";			
			}
			//end
			$note_module->description = $rec_user1->first_name." ".$rec_user1->last_name." has assigned ".$user_obj->first_name." ".$user_obj->last_name." to the ".$des;
			if($subcase=='yes'){
				$module = 'oa_officeactions';
			}
			else
			{
				$module = 'Cases';			
			}
			$note_module->parent_type = $module;
			$note_module->assigned_user_id = $user_id;
			$note_module->created_by  = $user_id;
			$note_module->modified_user_id = $user_id;
			$note_module->entry = 0;
			
			$note_module->save();
		}
	}

?>

<form action="" method="post">
	<table class="edit view">
		<tr>
			<td>Select Users : </td>
			<td>
				<select id="assigned_to_users" name="assigned_to_users[]" multiple="multiple" size="5"> 
				<?php while($row_users = $db->fetchByAssoc($res_user)){ ?>
					<option value="<?php echo $row_users['id']; ?>">
						<?php echo $row_users['first_name'] . " " . $row_users['last_name']; ?>
					</option>
				<?php } ?>
				</select>
			
			</td>
		</tr>
		<tr>
			<td><input type="submit" name="btn_users" id="btn_users" value="Assign"/></td>
		</tr>
	</table>
	</form>
</body>
</html>