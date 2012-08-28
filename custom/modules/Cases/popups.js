// JavaScript Document

/*****************************************************************
 Author : Basudeba Rath.
 Dt. 02-Jan-2012.
 Veon Consulting Pvt. Ltd.
*****************************************************************/
	
	
// DATE : 19-DEC-2011
	
	function openPopup(){
				
		clnt_id = document.getElementById('account_id').value;
		var record = document.getElementById('record_id').value;
		user_id = document.getElementById('user_id').value;
		
		var clm_edit = document.getElementById('clm_edit').value;
		
		if(clm_edit == 1){
			var url = "PriorityClaim.php?clnt_id=" + clnt_id + "&user_id=" + user_id + "&record=" + record;
		}
		else{
				var url = "PriorityClaimCreate.php?clnt_id=" + clnt_id + "&user_id=" + user_id;
		}
		window.open(url,"Claim Priority",'height=500,width=500,status=yes');
		
	}
	
	// Date : 06-Feb-2012.
	function popup_no_possession(){
		
		user_id = document.getElementById('user_id').value;
		record = document.getElementById('record_id').value;
		
		var clm_edit = document.getElementById('clm_edit').value;
		
		if(clm_edit == 1){
			var url = "PriorityClaim_NoPossession.php?user_id=" + user_id + "&record=" + record;
		}
		else{
			var url = "PriorityClaim_NoPossessionCreate.php?user_id=" + user_id;
		}
		window.open(url,"Claim Priority without Possession",'height=500,width=510,status=yes'); 
	}
	
//Dt. 02-Jan-2012.	
	function open_assign_popup()
	{
		//var client_name = document.getElementById('account_id').value;
		var user_id = document.getElementById('userid').value;
		var bean_id = document.getElementById('beanid').value;
		var url = "AssignedToCasePopup.php?beanid=" + bean_id + "&userid=" + user_id; 
		window.open(url,"Assigned to Case",'height=200,width=650,status=yes');
	}

// Date : 07-Feb-2012.

	function edit_claim(claimed_case_id){
		
		var bean_id = document.getElementById('beanid').value;
		var url = "EditClaimPopup.php?claimed_case_id=" + claimed_case_id + "&bean_id=" + bean_id; 
		window.open(url,"Claimed Case Edit",'height=200,width=650,status=yes');
	}
	