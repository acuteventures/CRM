<?php
// by preethi on 12-07-2012
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('modules/Cases/Case.php');
require_once('include/TimeDate.php');
require_once('include/SugarPHPMailer.php');
require_once('modules/Emails/Email.php');
require_once('include/utils.php');

global $timedate;
global $current_user;
global $sugar_version, $sugar_config;

$body = $_REQUEST['body'];

$subject=$_REQUEST['subject'];
//Create new email that will be saved in table emails
$email = new Email();
/*
 * Create mail object with system settings
 */	
$temp_case=new aCase();
$system_from = getSystemDefaultEmail($temp_case->db);

$mail = new SugarPHPMailer();
$mail->setMailerForSystem();
$mail->From     = $system_from['email'];
$mail->FromName = $system_from['name'];
$mail->IsHTML(false);
$mail->Subject =  $subject;
$mail->Body = $body;

$to_address = explode(',',$_REQUEST['to']);
//Send mail
global $db;
//echo $case_id;
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
}

	// INSERTING IN TO THE EMAIL_TEXT TABLE FOR SAVING THE HISTORY
	//THIS IS NOT WORKING BECAUSE ID FIELD IS NOT THER IN THE email_text TABLE
	/*$email_text = new EmailText();
	$email_text->email_id = $email->id;
	$email_text->from_addr = $system_from['email'];
	$email_text->to_addrs  = $_REQUEST['to'];
	$email_text->description = $_REQUEST['body'];
	$email_text->description_html = $_REQUEST['body'];
	$email_text->save();*/
	$update_email_text = $db->query("UPDATE `emails_text` SET from_addr='".$system_from['email']."', to_addrs='".$_REQUEST['to']."', description='".$_REQUEST['body']."', description_html='".$_REQUEST['body']."' WHERE email_id='".$email->id."'");
//inserting the email id and to addresses email address ids in to the emails_email_addr_rel table
foreach($to_address as $key){
	$to_add_id = "SELECT id FROM `email_addresses` WHERE email_address='".$key."'";
	$result_to_add_id = $db->query($to_add_id);
	$row_to_add_id =  $db->fetchByAssoc($result_to_add_id);
	
	$guid = create_guid();
	$insert_sql = $db->query("INSERT INTO `emails_email_addr_rel`(`id`,`email_id`,`address_type`,`email_address_id`,`deleted`)VALUES('".$guid."','".$email->id."','to','".$row_to_add_id['id']."','0')"); 
}
/*
 * This method is a slightly modified version of a method with the 
 * same name in modules/Emails/Email.php.
 */
function getSystemDefaultEmail($db) {
	$email = array();
	
	$r1 = $db->query("SELECT config.value FROM config WHERE name='fromaddress'");
	$r2 = $db->query("SELECT config.value FROM config WHERE name='fromname'");
	$a1 = $db->fetchByAssoc($r1);
	$a2 = $db->fetchByAssoc($r2);
	
	$email['email'] = $a1['value'];
	$email['name']  = $a2['value'];
	
	if (empty($email['email'])) {
		$email['name'] = 'no-reply@example.com';
	}
	
	if (empty($email['name'])) {
		$email['name'] = 'no-reply';
	}
	
	return $email;
}

header('location: index.php?module=Cases&action=index');
 
?>