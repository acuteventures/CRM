<title>receive a phone number </title>
<style type="text/css">
.design{
border:1px solid #3366FF;
}
</style>
<?php 
/**
***************************************
Author : Anuradha
Dt . 24-July-2012
Veon Consulting Pvt. Ltd.
Desc: Search Simple Result Page
***************************************
*/
if(!defined('sugarEntry'))define('sugarEntry', true);
require_once('include/entryPoint.php');
global $db;

$phone_no = $_REQUEST['p'];
$phone = preg_replace('/\D+/', '', $phone_no);
$arr1 = preg_split('//', $phone, -1, PREG_SPLIT_NO_EMPTY); 
//echo '<pre>';
//print_r($arr1);
//echo '<br />'.strlen($phone).'<br />'.$arr1[0].'<br />';
//echo substr($phone,1,strlen($phone));

if(strlen($phone)==11 && $arr1[0]==1) //if total digits =11 and first digit =1 then remove 1 in front
{
$revised_phone = substr($phone,1,strlen($phone));
//echo $revised_phone;
}
else{
$revised_phone = $phone;
}

$getPhoneSql = 'SELECT a.id,a.name,ph.phone_no,a.billing_address_city,a.billing_address_state, CONCAT(u.first_name ," ", u.last_name) AS parent_consultant
					FROM accounts a 
					INNER JOIN ph_phoneno ph ON a.id=ph.account_id_c 
					INNER JOIN users u ON u.id=a.assigned_user_id 
					WHERE REPLACE(REPLACE(REPLACE(REPLACE(ph.phone_no," ",""),"(",""),")",""),"-","")  LIKE "'.$revised_phone.'%" AND 
					a.deleted = 0 AND ph.deleted=0 AND u.deleted=0 ';
$getPhoneSql_res = $db->query($getPhoneSql);
?>
<table border="0" cellpadding="2" cellspacing="2" class="design" align="center" width="100%">
<tr >
	<td><strong>Name</strong></td>
	<td><strong>Phone</strong></td>
	<td><strong>City</strong></td>
	<td><strong>State</strong></td>
	<td><strong>Consultant</strong></td>
</tr>
<?php
while($getPhoneSql_row = $db->fetchByAssoc($getPhoneSql_res))
{ ?>

<tr>
	<td><a href="index.php?module=Accounts&action=DetailView&record=<?php echo $getPhoneSql_row['id'];?>" target="_blank"><?php echo $getPhoneSql_row['name'];?></a></td>
	<td><?php echo $getPhoneSql_row['phone_no'];?></td>
	<td><?php if($getPhoneSql_row['billing_address_city'])  echo $getPhoneSql_row['billing_address_city']; else echo "&nbsp;";?></td>
	<td><?php if($getPhoneSql_row['billing_address_state']) echo $getPhoneSql_row['billing_address_state']; else echo "&nbsp;";?></td>
	<td><?php echo $getPhoneSql_row['parent_consultant'];?></td>
</tr>

<?php }
?>
</table>
