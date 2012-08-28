<?php
//Saving case start date,time and also case completion time
	class saveSubCaseDates
	{ 
		function checkSubCaseDates(&$bean, $event, $arguments){
			global $current_user,$db; 
			
			/**
			---------------------------
			get subcase status order no
			---------------------------			
			*/
			$subcase_status_id = $bean->subcase_status_id;			
			$status_obj = new c_case_status();
            $status_obj = $status_obj->retrieve($subcase_status_id);
            $action_no = $status_obj->action_no;
			$order_no = $status_obj->order_no;
			/**
			-----------------------------------------------------------------------------------------------
			save subCase start date time if order no greater than 10 and not equal to Completed(100) Status
			------------------------------------------------------------------------------------------------
			*/
			if($order_no>10 && $order_no!=100 && $bean->case_start_date=="")
			{
				$bean->case_start_date = date('Y-m-d H:i:s');
			}			
			if($order_no==100 && $bean->case_end_date=="")		
			{
				$bean->case_end_date = date('Y-m-d H:i:s');

			}		
			
				
		     
	   } //end fn
   }