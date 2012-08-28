<!--
**************************************************************************************
//By preethi on 11-07-2012
**************************************************************************************
-->
<?php
chdir(realpath(dirname(__FILE__)));
define("sugarEntry", true);
require_once('include/entryPoint.php');
global $app_strings;
global $app_list_strings;
global $mod_strings;
global $theme,$db;
$ids = explode(',',$_REQUEST['id']);
//For fetching the emails addresses for the checked cases  3rd option
if($_REQUEST['type'] == 1){
	$new_array = array();
	foreach($ids as $cs_id){
			$email_sql = "SELECT accounts.first_name, accounts.last_name, email_addresses.email_address FROM `cases` LEFT JOIN `accounts` ON  accounts.id = cases.account_id  LEFT JOIN `email_addr_bean_rel` ON accounts.id = email_addr_bean_rel.bean_id LEFT JOIN `email_addresses` ON email_addr_bean_rel.email_address_id = email_addresses.id WHERE cases.id='".$cs_id."' AND cases.deleted=0 AND accounts.deleted=0 AND email_addr_bean_rel.deleted=0 AND email_addresses.deleted=0";
		$email_result = $db->query($email_sql);
		$email_row = $db->fetchByAssoc($email_result);
		if($email_row['email_address'] != ''){
			if(!(in_array($email_row['email_address'],$new_array))){
				array_push($new_array, $email_row['email_address']);
			}
		}
	}
	for($i=0;$i<count($new_array);$i++){
		$emails .= $new_array[$i].",";
	}
}
//For fetching the emails addresses for the checked inventions  1st and 2nd option
else{
	$new_array = array();
	foreach($ids as $inv_id){
		$email_sql = "SELECT accounts.first_name, accounts.last_name, email_addresses.email_address FROM `inv_inventions` LEFT JOIN `inv_inventions_accounts_c` ON  inv_inventions.id = inv_inventions_accounts_c.inv_invent9feaentions_idb LEFT JOIN `accounts` ON  accounts.id = inv_inventions_accounts_c.inv_inventd1acccounts_ida  LEFT JOIN `email_addr_bean_rel` ON accounts.id = email_addr_bean_rel.bean_id LEFT JOIN `email_addresses` ON email_addr_bean_rel.email_address_id = email_addresses.id WHERE inv_inventions.id='".$inv_id."' AND accounts.deleted=0 AND email_addr_bean_rel.deleted=0 AND email_addresses.deleted=0 AND inv_inventions.deleted=0 AND inv_inventions_accounts_c.deleted=0";
		$email_result = $db->query($email_sql);
		$email_row = $db->fetchByAssoc($email_result);
		if($email_row['email_address'] != ''){
			if(!(in_array($email_row['email_address'],$new_array))){
				array_push($new_array, $email_row['email_address']);
			}
		}
	}
	for($i=0;$i<count($new_array);$i++){
		$emails .= $new_array[$i].",";
	}
}
//End
//For sending emails
	if(isset($_POST['send'])){
		require_once('include/TimeDate.php');
		require_once('include/SugarPHPMailer.php');
		require_once('modules/Emails/Email.php');
		require_once('include/utils.php');
		global $timedate;
		global $current_user;
		global $sugar_version, $sugar_config;
		global $db;

		$body = $_REQUEST['body'];
		$subject=$_REQUEST['subject'];
		//Create new email that will be saved in table emails
		$email = new Email();
		//For getting the fromaddress email id
		$email = array();
		$r1 = $db->query("SELECT config.value FROM config WHERE name='fromaddress'");
		$r2 = $db->query("SELECT config.value FROM config WHERE name='fromname'");
		$a1 = $db->fetchByAssoc($r1);
		$a2 = $db->fetchByAssoc($r2);
		$email['email'] = $a1['value'];
		$email['name']  = $a2['value'];
		$from_address = $email['email'];
		//End		
		$mail = new SugarPHPMailer();
		$mail->setMailerForSystem();
		$mail->From     = $email['email'];
		$mail->FromName = $email['name'];
		$mail->IsHTML(false);
		$mail->Subject =  $subject;
		$mail->Body = $body;
		$to_address = explode(',',$_REQUEST['to']);
		//Send mail
		$email = new Email();
		foreach($to_address as $key){
			$mail->ClearAllRecipients();
			$mail->AddAddress($key);
			$mail->prepForOutbound();
			$success = $mail->Send();
			//INSERTING IN TO THE EMAILS TABLE FOR SAVING THE HISTORY
			$email->name = $_REQUEST['subject'];
			$email->assigned_user_id = $current_user->id;
			$email->type = 'out';
			$email->status = 'sent';
			$email->save();
			//END
			if($success){
				$msg ='Mail had sent Successfully';
			}
			else{
				$error_msg =$mail->ErrorInfo;
			}
		}
		// INSERTING IN TO THE EMAIL_TEXT TABLE FOR SAVING THE HISTORY
		$update_email_text = $db->query("UPDATE `emails_text` SET from_addr='".$from_address."', to_addrs='".$_REQUEST['to']."', description='".$_REQUEST['body']."', description_html='".$_REQUEST['body']."' WHERE email_id='".$email->id."'");
		//inserting the email id and to addresses email address ids in to the emails_email_addr_rel table
		foreach($to_address as $key){
			$to_add_id = "SELECT id FROM `email_addresses` WHERE email_address='".$key."'";
			$result_to_add_id = $db->query($to_add_id);
			$row_to_add_id =  $db->fetchByAssoc($result_to_add_id);
			$guid = create_guid();
			$insert_sql = $db->query("INSERT INTO `emails_email_addr_rel`(`id`,`email_id`,`address_type`,`email_address_id`,`deleted`)VALUES('".$guid."','".$email->id."','to','".$row_to_add_id['id']."','0')"); 
		}
	}
//End
?>
<!--<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		//mode : "textareas",
		mode : "exact",
		elements : "body",
		theme : "advanced",
		theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,numlist,undo,redo",
		theme_advanced_buttons2 : "",
    	theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left"
        //theme_advanced_statusbar_location : "bottom"
	});
</script>-->
<form name="sendEmail" method="post" action="" id="sendEmail" enctype="multipart/form-data">
  <table cellpadding="0" cellspacing="0" border="0" width="700px">
    <tr>
      <td style="padding-bottom: 2px;"><input class="button" type="submit" name="send" id="send" value="Send" >
      <td align="left"><strong><?php if(isset($msg)){ ?><span style="color:#009966"><?php echo $msg; }else if(isset($error_msg)){?></span><span style="color:#FF0000"><?php echo $error_msg;}?></span></strong></td>
    </tr>
  </table>
  <table width="700px" border="0" cellpadding="3" cellspacing="0">
    <tr>
      <td style="color:#666666"><strong>To</strong></td>
      <td><textarea readonly name="to" id="to" rows="2" cols="64"><?php echo $emails; ?></textarea></td>
    </tr>
    <tr>
      <td style="color:#666666"><strong>Subject</strong></td>
      <td><input type="text" name="subject" id="subject" style="width:535px"/></td>
    </tr>
    <tr>
      <td colspan="2"><textarea name="body" id="body" rows="10" cols="72"></textarea></td>
    </tr>
  </table>
  <table cellpadding="0" cellspacing="0" border="0" width="700px">
    <tr>
      <td style="padding-bottom: 2px;"><input class="button" type="submit" name="send" id="send" value="Send" >
      <td align="right" nowrap>&nbsp;</td>
    </tr>
  </table>
</form>
