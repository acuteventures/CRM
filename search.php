<?php
if(!defined('sugarEntry') || !sugarEntry) define('sugarEntry', TRUE);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once('include/entryPoint.php');
require_once('modules/Users/User.php');
require_once('modules/Cases/Case.php');

global  $db; 
$case_statuscombine=$_REQUEST['case_status'];

$case_list = explode("==",$case_statuscombine);
$case_status_comp = $case_list[0];
$case_status_ab = $case_list[1];


$user_id=$_REQUEST['user_id'];

$credit_date_dom = $_REQUEST['credit_date_dom'];

	if($credit_date_dom == 'this_month')
	{
	$From_date = gmdate("Y-m")."-01";
	$To_date = gmdate("Y-m-d");
	  }

	else if($credit_date_dom == 'last_month')
	{
		
		$lastyear=gmdate(("Y"),strtotime ( '-1 month' , strtotime ( (date("Y-m-d")) ) ));
		$lastmonth=gmdate(("m"),strtotime ( '-1 month' , strtotime ( (date("Y-m-d")) ) ));
		$lastmonth_days = daysInMonth($lastyear, $lastmonth);
		$To_date=gmdate(("Y-m"),strtotime ( '-1 month' , strtotime ( (date("Y-m-d")) ) ))."-".$lastmonth_days ;
		$From_date=gmdate(("Y-m"),strtotime ( '-1 month' , strtotime ( (date("Y-m-d")) ) ))."-01" ;

		}
	else if($credit_date_dom == 'none')
	{
		$From_date = "0000-00-00";
		$To_date = "0000-00-00";
		}
	else{
		$From_date=gmdate("Y-m-d", strtotime($_REQUEST['date_from']));
		$To_date=gmdate("Y-m-d", strtotime($_REQUEST['date_to']));
}



function daysInMonth($year, $month)
    { 
        return date("t", strtotime($year . "-" . $month . "-01")); 
    }

/*echo "<pre>";
print_r($_REQUEST);*/
//die;




$ObjCase = new aCase();
$row=$ObjCase->get_cases_list_for_CreditReportSearch($case_status_comp,$case_status_ab,$user_id); // this is for case type and query time is .044
$email=get_consultant_name_drop_down(); // this is for Consultant and query time is .????

static  $sum_CRProint=0;
 $grand_total=0;
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
    <td width="10%" height="40" align="center" bgcolor="#4E8CCF"><span class="style1">Consultant</span></td>
    <td width="16%" height="40" align="center" bgcolor="#4E8CCF"><span class="style1">Subject</span></td>
    <td width="23%" height="40" align="center" bgcolor="#4E8CCF"><span class="style1">Client Name </span></td>
    <?php
 foreach ($email as $k => $v) {
 echo "<td height='40' align='center' bgcolor='#4E8CCF'><span class='style1'><strong>".$v."</strong></span></td>";
}
   ?>
    <td width="17%" height="40" align="center" bgcolor="#4E8CCF"><span class="style1">Credit Allocation Notes</span></td>
    <td width="14%" height="40" align="center" bgcolor="#4E8CCF"><span class="style1">Credit Date</span></td>
    <td  height="40" align="center" bgcolor="#4E8CCF">&nbsp;</td>
  </tr>
  <?php  
  if(!empty($row)){
  foreach ($row as $e => $case_type) {?>
  
  <tr>
    <td  valign="top" align="center" style="border-bottom:#4E8CCF solid 1px; border-right:#4E8CCF solid 1px;"><?php echo $case_type;?></td>
    <td   valign="top" align="center" style="border-bottom:#4E8CCF solid 1px; border-right:#4E8CCF solid 1px;"><table width="100%">
        <?php 
			$row_credits=$ObjCase->get_cases_consultant_Credits($e,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date );
			$count_array=count($row_credits['client_consultant_id']);
			for ($ij=0; $ij<=$count_array ;$ij++ ){
        	$case_id=$row_credits['case_id'][$ij];
	        $client_consultant_id = $row_credits['client_consultant_id'][$ij];
	        ?>
        <tr>
          <td valign="top" style="border-bottom:#660066  1px solid;" height="40" align="left"><?php echo $row_credits['consultant'][$ij] ;?></td>
        </tr>
        <?php
  }
  
   ?>
      </table></td>
    <td valign="top" align="center" style="border-bottom:#4E8CCF solid 1px; border-right:#4E8CCF solid 1px;"><table width="100%">
        <?php 
			$row_credits_Subject=$ObjCase->get_cases_consultant_Credits($e,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date );
			$count_array_Subject=count($row_credits_Subject['client_consultant_id']);
			
			for ($ij_Subject=0; $ij_Subject<$count_array_Subject ;$ij_Subject++ ){
        	$case_id_Subject=$row_credits_Subject['case_id'][$ij_Subject];
	        $client_consultant_id_Subject = $row_credits_Subject['client_consultant_id'][$ij_Subject];
			
			// For Subject Value
			$row_sub_client_name=$ObjCase->getCaseSubjectAnsClientNameCredits($e,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date);
			$count_array_client_name=count($row_sub_client_name['case_id']);
	?>
        <?php for ($ik=0; $ik<=$count_array_client_name;$ik++ ){
        	  $case_id=$row_sub_client_name['case_id'][$ik];
	?>
        <tr>
          <td valign="top" style="border-bottom:#660066  1px solid;" height="40" align="left"><a href="index.php?module=Cases&return_module=c1_Credit_Report&action=DetailView&record=<?php echo $case_id;?>"><?php echo $row_sub_client_name['casename'][$ik] ;?></a></td>
        </tr>
        <?php }
	?>
        <?php }?>
      </table></td>
    <td valign="top" align="center" style="border-bottom:#4E8CCF solid 1px; border-right:#4E8CCF solid 1px;"><table width="100%">
        <?php 
			$row_credits_client_name=$ObjCase->get_cases_consultant_Credits($e,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date );
			$count_array_client_name=count($row_credits_client_name['client_consultant_id']);
			for ($ij_client_name=0; $ij_client_name<$count_array_client_name;$ij_client_name++ ){
        	$case_id_client_name=$row_credits_client_name['case_id'][$ij_client_name];
	        $client_consultant_id_client_name = $row_credits_client_name['client_consultant_id'][$ij_client_name];
			
			// For Subject Value
			$row_sub_client_name_client_name=$ObjCase->getCaseSubjectAnsClientNameCredits($e,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date);
			$count_array_client_name_client_name=count($row_sub_client_name_client_name['case_id']);
	?>
        <?php for ($ik_client_name=0; $ik_client_name<=$count_array_client_name_client_name ;$ik_client_name++ ){
        
	?>
        <tr>
          <td valign="top" style="border-bottom:#660066  1px solid;" height="40" align="left"><a href="index.php?module=Accounts&return_module=c1_Credit_Report&action=DetailView&record=<?php echo $row_sub_client_name_client_name['clientid'][$ik_client_name] ;?>"><?php echo $row_sub_client_name_client_name['clientname'][$ik_client_name] ;?></a></td>
        </tr>
        <?php }
	?>
        <?php }?>
      </table></td>
    <?php
	$grand_total=0;
 	foreach ($email as $k => $v) {
	
	?>
    <td valign="top" align="center" style="border-bottom:#4E8CCF solid 1px; border-right:#4E8CCF solid 1px;"><table width="100%">
        <?php 
		
			$row_credits_CP=$ObjCase->get_cases_consultant_Credits($e,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date );
			//print_r($row_credits_CP);
			$count_array_CP=count($row_credits_CP['client_consultant_id']);
			for ($ij_CP=0; $ij_CP<$count_array_CP ;$ij_CP++ ){
			$sum_CRProint=0;
        //	$case_id_CP=$row_credits_CP['client_consultant_id'][$ij_CP];
	        $client_consultant_id_CP = $row_credits_CP['client_consultant_id'][$ij_CP];
			
			// For Subject Value
			$row_sub_client_name_CP=$ObjCase->getCaseSubjectAnsClientNameCredits($e,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date);
		//	print_r($row_sub_client_name_CP);
			$count_array_client_name_CP=count($row_sub_client_name_CP['case_id']);
			//echo $count_array_client_name_CP;
	?>
        <?php for ($ik_CP=0; $ik_CP<$count_array_client_name_CP ;$ik_CP++ ){
        	  $case_id_CP=$row_sub_client_name_CP['case_id'][$ik_CP];
	?>
        <tr>
          <td valign="top" style="border-bottom:#660066  1px solid;" height="40" align="center"><?php $roooo=$ObjCase->getContributePointCustom($case_id_CP,$k);
		 echo $roooo;
		 
		 
		 
		 ?></td>
        </tr>
        <?php $sum_CRProint=$roooo+$sum_CRProint;}
		 
	?>
        <?php }
		
		?>
		<tr >
          <td valign="top" height="40" bgcolor="#E7F3FE"><strong><?php  echo $sum_CRProint;?></strong></td>
        </tr>
      </table></td>
    <?php
	$grand_total=$sum_CRProint+$grand_total;	
	}
   ?>
    <td valign="top"align="center" style="border-bottom:#4E8CCF solid 1px; border-right:#4E8CCF solid 1px;"><table width="100%">
        <?php 
			$row_credits_notes=$ObjCase->get_cases_consultant_Credits($e,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date );
			$count_array_notes=count($row_credits_notes['client_consultant_id']);
			for ($ij_notes=0; $ij_notes<$count_array_notes;$ij_notes++ ){
        	$case_id_notes=$row_credits_notes['case_id'][$ij_notes];
	        $client_consultant_id_notes = $row_credits_notes['client_consultant_id'][$ij_notes];
		
			
			// For Subject Value
			$row_sub_notes=$ObjCase->getCaseSubjectAnsClientNameCredits($e,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date);
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
        <?php }?>
      </table></td>
    <td valign="top"align="center" style="border-bottom:#4E8CCF solid 1px; border-right:#4E8CCF solid 1px;"><table width="100%">
        <?php 
			$row_credits_date=$ObjCase->get_cases_consultant_Credits($e,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date );
			$count_array_date=count($row_credits_date['client_consultant_id']);
			for ($ij_date=0; $ij_date<$count_array_date;$ij_date++ ){
        	$case_id_date=$row_credits_date['case_id'][$ij_date];
	        $client_consultant_id_date = $row_credits_date['client_consultant_id'][$ij_date];
		
			
			// For Subject Value
			$row_sub_date=$ObjCase->getCaseSubjectAnsClientNameCredits($e,$case_status_comp,$case_status_ab,$user_id,$From_date,$To_date);
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
        <?php }?>
      </table></td>
  </tr>

  <?php
       }
	   }else{
	   
	   echo "<div align='center'><strong>No Records Found :(</strong></div>";
	   }
   ?>
  </tr>

   <tr>
    <td height="40" align="center" valign="top">&nbsp;</td>
    <td  valign="top" align="center" >&nbsp;</td>
    <td   valign="top" align="center">&nbsp;</td>
    <td  valign="top" align="center">&nbsp;</td>
	<?php
 	foreach ($email as $p => $q) {
	?>
    <td valign="top" align="left" ><!--<strong>Grand Total of Credit Points:- </strong><?php //echo $grand_total;?>--></td>
	 <?php }?>
    <td valign="top" align="center">&nbsp;</td>
    <td valign="top" align="center" >&nbsp;</td>
  </tr>
 
</table>