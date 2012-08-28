<?php
if(!defined('sugarEntry') || !sugarEntry) define('sugarEntry', TRUE);
require_once('modules/Users/User.php');
require_once('modules/Cases/Case.php');

global  $db; 
global $current_user;

$case_status_comp="d7b78682-00e9-943d-ecc6-4ed9c63407f5";
$case_status_ab="10a723b0-83d2-f248-64de-4ed9c7afcc4b";
$user_id=$current_user->id;

$From_date = gmdate("Y-m")."-01";
$To_date = gmdate("Y-m-d");

$ObjCase = new aCase();
$row=$ObjCase->get_cases_list_for_CreditReportSearch_default($case_status_comp,$case_status_ab,$user_id); // this is for case type and query time is .044

$email=get_consultant_name_drop_down(); // this is for Consultant and query time is .????
static $grand_total=0;
?>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>


<table width="100%" border="0" cellpadding="2" cellspacing="2" bgcolor="#B4ECF5">
  <tr>
    <td width="8%" height="40" align="center" bgcolor="#4E8CCF"><span class="style1">Case Type </span></td>
    <td width="7%" height="40" align="center" bgcolor="#4E8CCF"><span class="style1">Consultant</span></td>
    <td width="16%" height="40" align="center" bgcolor="#4E8CCF"><span class="style1">Subject</span></td>
    <td width="23%" height="40" align="center" bgcolor="#4E8CCF"><span class="style1">Client Name </span></td>
    <td width="16%" height="40" align="center" bgcolor="#4E8CCF"><span class="style1"><?php echo ucfirst($current_user->user_name);?> </span></td>
    <td width="17%" height="40" align="center" bgcolor="#4E8CCF"><span class="style1">Credit Allocation Notes</span></td>
    <td width="13%" height="40" align="center" bgcolor="#4E8CCF"><span class="style1">Credit Date</span></td>
  </tr>
  <?php 
  if(!empty($row)){
   foreach ($row as $e => $case_type) {?>

  <tr>
    <td height="40" align="center" valign="top" style="border-bottom:#4E8CCF solid 1px; border-right:#4E8CCF solid 1px;"><?php echo $case_type;?></td>
    <td  valign="top" align="center" style="border-bottom:#4E8CCF solid 1px; border-right:#4E8CCF solid 1px;"><table width="100%">
        <?php
			$row_credits=$ObjCase->get_cases_consultant_CreditsById_default($e,$case_status_comp,$case_status_ab,$user_id);
			for ($ij=0; $ij<=$count_array ;$ij++ ){
        	$case_id=$row_credits['case_id'][$ij];
	        $client_consultant_id = $row_credits['client_consultant_id'][$ij];
	        ?>
        <tr>
          <td valign="top"  style="border-bottom:#660066  1px solid;" height="40" align="center">
            <?php echo $current_user->user_name ;?></td>
        </tr>
        <?php
  }
  
   ?>
      </table></td>
    <td   valign="top" width="16%" align="center" style="border-bottom:#4E8CCF solid 1px; border-right:#4E8CCF solid 1px;"><table width="100%">
        <?php 
			$row_sub_client_name=$ObjCase->getCaseSubjectAnsClientNameCredits_default($e,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date );
			$count_array_client_name=count($row_sub_client_name['case_id']);
	?>
        <?php for ($ik=0; $ik<=$count_array_client_name ;$ik++ ){
        	  $case_id=$row_sub_client_name['case_id'][$ik];
	?>
        <tr>
		<td valign="top" style="border-bottom:#660066 1px solid;" height="40" align="center"><a href="index.php?module=Cases&return_module=c1_Credit_Report&action=DetailView&record=<?php echo $case_id;?>"><?php echo $row_sub_client_name['casename'][$ik] ;?></a></td>
          <!--<td valign="top" style="border-bottom:#660066  1px solid;" height="40" align="center"><?php echo $row_sub_client_name['casename'][$ik] ;?></td>-->
        </tr>
        <?php }
	?>
      </table></td>
    <td  valign="top" width="23%" align="center" style="border-bottom:#4E8CCF solid 1px; border-right:#4E8CCF solid 1px;"><table width="100%">
        <?php 
			$row_sub_client_name_client_name=$ObjCase->getCaseSubjectAnsClientNameCredits_default($e,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date );
			$count_array_client_name_client_name=count($row_sub_client_name_client_name['case_id']);
	?>
        <?php for ($ik_client_name=0; $ik_client_name<=$count_array_client_name_client_name ;$ik_client_name++ ){
        
	?>
        <tr>
          <td valign="top" style="border-bottom:#660066  1px solid;" height="40" align="center"><a href="index.php?module=Accounts&return_module=c1_Credit_Report&action=DetailView&record=<?php echo $row_sub_client_name_client_name['clientid'][$ik_client_name] ;?>"><?php echo $row_sub_client_name_client_name['clientname'][$ik_client_name] ;?></a></td>
        </tr>
        <?php }
	?>
      </table></td>
    <td valign="top" align="center" style="border-bottom:#4E8CCF solid 1px; border-right:#4E8CCF solid 1px;"><table width="100%">
        <?php 
			// For Subject Value
			$row_sub_client_name_CP=$ObjCase->getCaseSubjectAnsClientNameCredits_default($e,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date );
			$count_array_client_name_CP=count($row_sub_client_name_CP['case_id']);
	?>
        <?php 
		$sum_CRProint=0;
		for ($ik_CP=0; $ik_CP<$count_array_client_name_CP ;$ik_CP++ ){
        	  $case_id_CP=$row_sub_client_name_CP['case_id'][$ik_CP];
	?>
        <tr >
          <td valign="top" style="border-bottom:#660066  1px solid;" height="40" align="center"><?php $roooo=$ObjCase->getContributePointCustom($case_id_CP,$user_id);
		 echo $roooo;

		 $sum_CRProint=$roooo+$sum_CRProint;
		
		 
		 ?></td>
        </tr>
        <?php } 
		$grand_total=$sum_CRProint+$grand_total;
	?>
	  <tr >
          <td valign="top" height="40"><strong>Sum of Credit Points : - </strong><?php  echo $sum_CRProint;?></td>
        </tr>
      </table></td>
    <td valign="top" align="center" style="border-bottom:#4E8CCF solid 1px; border-right:#4E8CCF solid 1px;"><table width="100%">
        <?php 
			// For Subject Value
			$row_sub_notes=$ObjCase->getCaseSubjectAnsClientNameCredits_default($e,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date );
			//print_r($row_sub_notes['credit_alloc_notes']);
			$count_array_client_name_notes=count($row_sub_notes['case_id']);
	?>
        <?php for ($ik_notes=0; $ik_notes<=$count_array_client_name_notes ;$ik_notes++ ){
        
	?>
        <tr>
          <td valign="top" style="border-bottom:#660066  1px solid;" height="40" align="center"><?php echo $row_sub_notes['credit_alloc_notes'][$ik_notes] ;?></td>
        </tr>
        <?php }
	?>
      </table></td>
    <td width="13%" valign="top" align="center" style="border-bottom:#4E8CCF solid 1px; border-right:#4E8CCF solid 1px;"><table width="100%">
        <?php 
			// For Subject Value
			$row_sub_date=$ObjCase->getCaseSubjectAnsClientNameCredits_default($e,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date );
			//print_r($row_sub_date['credit_date']);
			$count_array_client_name_date=count($row_sub_date['case_id']);
	?>
        <?php for ($ik_date=0; $ik_date<=$count_array_client_name_date ;$ik_date++ ){
        
	?>
        <tr>
          <td valign="top" style="border-bottom:#660066  1px solid;" height="40" align="center"><?php echo $row_sub_date['credit_date'][$ik_date] ;?></td>
        </tr>
		
        <?php }
	?>
      </table></td>
  </tr>
  <?php
       }
	   }else{
	   
	   echo "<div>No Match Found</div>";
	   }
   ?>
    <tr>
    <td height="5" colspan="7" align="center" valign="top" style="background:#FFFFFF;"></td>
  </tr>
  
     <tr>
    <td height="40" align="center" valign="top">&nbsp;</td>
    <td  valign="top" align="center" >&nbsp;</td>
    <td   valign="top" align="center">&nbsp;</td>
    <td  valign="top" align="center">&nbsp;</td>
    <td valign="top" align="left" ><strong>Grand Total of Credit Points:- </strong><?php echo $grand_total;?></td>
    <td valign="top" align="center">&nbsp;</td>
    <td valign="top" align="center" >&nbsp;</td>
  </tr>
</table>
