<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*********************************************************************************
 * SugarCRM is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004 - 2009 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/
/*********************************************************************************

 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
require_once('modules/EmailAddresses/EmailAddress.php');
require_once("phpmailer/class.phpmailer.php");
///require_once("phpmailer/config.php");  
require_once('include/utils.php');
global $db;
//Author: Phaneendra
//date:26/02/2012
//code generated to send the data from a simple form to Accounts module in sugarcrm

$c=$_REQUEST['fname'];
$_REQUEST['lname'];
$_REQUEST['regemail'];
$_REQUEST['regpno'];
$_REQUEST['regpass1'];

$id=create_guid();
/*global $current_user;
echo $current_user->id;
exit;
*/
 /*$account = new Account();
 $account->last_name=$_REQUEST['lname'];
 $account->first_name= $_REQUEST['fname'];
 $account->name= $_REQUEST['fname'].$_REQUEST['lname'];

 $account->phone_office= $_REQUEST['regpno'];
 $account->password= $_REQUEST['regpass1'];
 $account->assigned_user_id=1;*/
 
 
	/*if($c=='Support team')
	{
	$sql=" SELECT id FROM team WHERE name ='Support Team' AND deleted=0 ";
	$res=$db->query($sql);
	$contact=$db->fetchByAssoc($res);
	
	$lead->team_id= $contact['id'];
	}*/
	 
//$account->save();
$name = $_REQUEST['fname']." ".$_REQUEST['lname'];
$date_time =gmdate("Y-m-d H:i:s",time());
$sql_acc = "INSERT INTO `accounts` (id,name,date_entered,date_modified,modified_user_id,created_by,deleted,assigned_user_id,phone_office,first_name,last_name,password) values('".$id."','".$name."','".$date_time."','".$date_time."','1','1','0','1','".$_REQUEST['regpno']."','".$_REQUEST['fname']."','".$_REQUEST['lname']."','".$_REQUEST['regpass1']."')";

$db->query($sql_acc);

//$id=$account->id;
$account = new Account();
//$id=$account->id;
$emailAddr = new EmailAddress();
$emailAddr->addAddress($_REQUEST['regemail'], true);
$emailAddr->save($id, 'Accounts');

$subject="Welcome to Thoughts to Paper";	  
$message ="
<p>Welcome to Thoughts to Paper! <br />

You have successfully registered an account and can access your secure applications online!<br />

Your username is your email address: ".$_REQUEST['regemail']."
<br />Your password is:".$_REQUEST['regpass1']."
</p>
<br><br>

Admin

";
//echo $password;

$mail = new PHPMailer();

// Inform class to use SMTP
$mail->IsSMTP();

// Enable this for Testing
$mail->SMTPDebug  = 0;

// Enable SMTP Authentication
$mail->SMTPAuth   = true;

// Host of the SMTP Server
$mail->Host = "mail.thoughtstopaper.com";

// Port of the SMTP Server
$mail->Port = 587;

// SMTP User Name
$mail->Username   = "support@thoughtstopaper.com";

// SMTP User Password
$mail->Password = "ttp9192493";

// Set From Email Address
$mail->From="support@thoughtstopaper.com";
$mail->FromName ="Thoughts to Paper";
$mail->Sender="support@thoughtstopaper.com";

// Add Subject
$mail->Subject    = $subject;

// Add the body for mail
//$body = "This is the mail body";
$mail->MsgHTML($message);
$email_id=$_REQUEST['regemail'];
$mail->AddAddress($email_id);
$mail->IsHTML(false);

// Add To Address
//$to=$_REQUEST['regemail'];

 //$mail->AddAddress($to,$name);
 //$mail->AddAttachment("upload"."/".$month."/".$name."-".$empid.".pdf");

if(!$mail->Send())
{
   echo "Error sending: " . $mail->ErrorInfo;;
}
else
{
  $msg6="Your Registraton is Successfully ";
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=http://www.thoughtstopaper.com/test/index.php?msg6='.$msg6.'">'; 
  //echo '<META HTTP-EQUIV="Refresh" Content="0; URL=http://www.thoughtstopaper.com/test/index.php?msg6='.$msg6.'">'; 
die();
  //echo "Password sent";
}
/*Header("Location:http://localhost/test2/sugarsoup/regtoemail.php?email=".$_REQUEST['regemail']."&password=".$_REQUEST['regpass1']."");
sugar_cleanup();

die();*/



 
?>
