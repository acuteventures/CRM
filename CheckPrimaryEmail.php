<?php

/* * *********************
 * Rajesh G - 15/06/12
 * Primary email checking 
 * ********************** */
if (!defined('sugarEntry'))  define('sugarEntry', true);
require_once('include/entryPoint.php');
global $db;
$email = $_REQUEST['emailAddr'];
$clientId = $_REQUEST['clientId'];
$query1 = "SELECT
    accounts.first_name,
    accounts.last_name,
    accounts.id AS acc_id
    FROM
    accounts
    INNER JOIN email_addr_bean_rel ON email_addr_bean_rel.bean_id = accounts.id
    INNER JOIN email_addresses ON email_addresses.id = email_addr_bean_rel.email_address_id
    WHERE
    email_addr_bean_rel.primary_address = '1' AND
    email_addresses.email_address = '" . $email . "' AND
    accounts.deleted = '0' AND
    email_addr_bean_rel.deleted = '0' AND
    email_addresses.deleted = '0'";

if (!empty($clientId)) {
    $query1.=" AND accounts.id != '" . $clientId . "' LIMIT 1";
}
else
{
    $query1.=" LIMIT 1";
}
$query1;
$result = $GLOBALS['db']->query($query1);
$row = $GLOBALS['db']->fetchByAssoc($result);
if(!empty($row['acc_id'])){
    $query2 = "SELECT
    ph_phoneno.phone_no
    FROM
    accounts
    INNER JOIN ph_phoneno ON ph_phoneno.account_id_c = accounts.id
    WHERE
    accounts.deleted = '0' AND
    ph_phoneno.deleted = '0'AND 
    accounts.id = '" . $row['acc_id'] . "' LIMIT 1";
    $result2 = $GLOBALS['db']->query($query2);
    $row2 = $GLOBALS['db']->fetchByAssoc($result2);
    echo "Primary email address already associated with client:<br/>".
    $row['first_name'] . " " . $row['last_name'] . "<br/>" . $row2['phone_no'].
    "<br/>Open this client record in new window? &nbsp&nbsp
        <a href='index.php?module=Accounts&return_module=Accounts&action=DetailView&record=".$row['acc_id']."' target='_new'><b>Yes</b></a>
| No";
}
else{
    echo "No Confliction";
}
//<a href='http://".$_SERVER['HTTP_HOST']."/crm/index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DAccounts%26offset%3D1%26stamp%3D1339832505074581700%26return_module%3DAccounts%26action%3DDetailView%26record%3D".$row['acc_id']."' target='_new'><b>Yes</b></a>
/* * *********GBR*********** */
?>
