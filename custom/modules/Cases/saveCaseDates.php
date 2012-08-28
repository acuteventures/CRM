<?php

/********************************************************

	AUTHOR : BASUDEBA RATH.
	DATE: 55-Feb-2011.
	VEON CONSULTING PVT. LTD.
********************************************************/


//Saving case start date,time and also case completion time
	class saveCaseDates
	{ 
		function checkCaseDates(&$bean, $event, $arguments){
			global $current_user,$db; 
			
			/**
			---------------------------
			get Case status order no
			---------------------------			
			*/
			$case_status_id = $bean->status;			
			$status_obj = new c_case_status();
            $status_obj = $status_obj->retrieve($case_status_id);
            $action_no = $status_obj->action_no;
			$order_no = $status_obj->order_no;
			/**
			-----------------------------------------------------------------------------------------------
			save Case start date time if order no greater than 10 and not equal to Completed(100) Status
			------------------------------------------------------------------------------------------------
			*/
			
			//$offset=4*60*60; //converting 4 hours to seconds.
			//$dateFormat="Y-m-d H:i:s";
			//$timeNdate=gmdate($dateFormat, time()-$offset);
			//echo $timeNdate;die;
			
						
			if($order_no>10 && $order_no!=100 && $bean->case_start_date=="")
			{
				$bean->case_start_date = gmdate("Y-m-d H:i:s"); // modify Date : 04-may-2012 by Basudeba.
			}			
			if($order_no==100 && $bean->case_end_date=="")		
			{
				$bean->case_end_date = gmdate("Y-m-d H:i:s"); // modify Date : 04-may-2012 by Basudeba.
			}		
		     
	   } //end fn
   }