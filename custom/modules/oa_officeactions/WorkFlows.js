// JavaScript Document

/***************************************************************

Author :  PHANEENDRA
Date : 24-Dec-2011
Veon Consulting Pvt. Ltd.


***************************************************************/

// Tested and modified by : BASUDEBA RATH.
// DATE : 31-Dec-2011


	/*var xmlHttp1;
	function change_status(id,status_id,btn_id)
	{
		var assigned_id = document.getElementById('user_id').value;
		var flag_hook = 1;
		var btn_value = document.getElementById(btn_id).value;
		var res = confirm('Are you sure, you want to change the status ?');
				
		if(res == true){

				
			var url = "WorkFlowSection.php?id=" + id + "&user_id=" + assigned_id + "&flag_hook=" + flag_hook + "&btn_id=" + btn_value; 
			
			if (window.XMLHttpRequest){
				
				xmlHttp1=new XMLHttpRequest();
			}
			else{
				
				xmlHttp1=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlHttp1.open("Get",url,true);
			xmlHttp1.onreadystatechange = work_flow;
			xmlHttp1.send(null);
			
		}
		else{
			return false;
		}
	}

	function work_flow()
	{
		var record = document.getElementById('record_id').value;
		if(xmlHttp1.readyState == 4)
		{
			if(xmlHttp1.status == 200)
			{
				var resText = xmlHttp1.responseText;
				
				window.location.href ="index.php?module=oa_officeactions&offset=1&stamp=1324532307001306700&return_module=oa_officeactions&action=DetailView&record=" + record;

			}
		}
	}*/
	
// WORK FLOW STATUS FOR PROVISIONAL PATENT.

	/*var xmlHttp2;
	function prov_status(id,status_id,btn_id)
	{
		var assigned_id = document.getElementById('user_id').value;
		var flag_hook = 1;
		
		var btn_value = document.getElementById(btn_id).value;
		var res = confirm('Are you sure, you want to change the status and send a mail ?');
				
		if(res == true){
			
			
			var url = "OfficeFlow_Provisional.php?id=" + id + "&user_id=" + assigned_id + "&flag_hook=" + flag_hook + "&btn_id=" +btn_value; 
			
			if (window.XMLHttpRequest){
				
				xmlHttp2=new XMLHttpRequest();
			}
			else{
				
				xmlHttp2=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlHttp2.open("Get",url,true);
			xmlHttp2.onreadystatechange = prov_work_flow;
			xmlHttp2.send(null);
			
		}
		else{
			return false;
		}
	}

	function prov_work_flow()
	{
		var record = document.getElementById('record_id').value;
		if(xmlHttp2.readyState == 4)
		{
			if(xmlHttp2.status == 200)
			{
				var resText = xmlHttp2.responseText;
				alert(resText);
				window.location.href ="index.php?module=oa_officeactions&offset=1&stamp=1324532307001306700&return_module=oa_officeactions&action=DetailView&record=" + record;
			}
		}
	}*/
	
/*****************************************************************************

		APPLICATION NO. AND FILING DATE INSERT 

******************************************************************************/	
//by anuradha on 3/2/2012
function app_insert(id,status_id,btn_id){
    
	var assigned_id = document.getElementById('user_id').value;
	var subcase_number = document.getElementById('subcase_number').value;
	var btn_value = document.getElementById(btn_id).value;
	var	fdate  = document.getElementById('fdate').value;
	var flag_hook = 1;
	if(fdate == ''){
		alert('Please Enter Filing date.');
		return false;
	}
	
	var application_start_callback = {
		 success: function(x) {		 			 
		 alert(x.responseText);		 
		 window.location.href ="index.php?module=oa_officeactions&return_module=oa_officeactions&action=DetailView&record="+id;
		 
		}
	}
	var startObject = YAHOO.util.Connect.asyncRequest ("GET", "applicationFiledWorkflow.php?id="+ id + "&user_id=" + assigned_id + "&btn_id=" +btn_value + "&fdate=" + fdate+"&subcase_number="+subcase_number+"&flag_hook="+ flag_hook, application_start_callback);
	
}
//end
/*********************************************************************************************************/

// Work flow for search patent contribution.


	var xmlHttp4;
	function cont_search(id,status_id,btn_id)
	{
		var assigned_id = document.getElementById('user_id').value;
		var flag_hook = 1;
		
		var btn_value = document.getElementById(btn_id).value;
		var res = confirm('Are you sure, you want to contribute this case ?');
				
		if(res == true){
			
			
			var url = "OfficeFlowContribution.php?id=" + id + "&user_id=" + assigned_id + "&flag_hook=" + flag_hook + "&btn_id=" +btn_value; 
			
			if (window.XMLHttpRequest){
				
				xmlHttp4=new XMLHttpRequest();
			}
			else{
				
				xmlHttp4=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlHttp4.open("Get",url,true);
			xmlHttp4.onreadystatechange = searchContribute;
			xmlHttp4.send(null);
			
		}
		else{
			return false;
		}
	}

	function searchContribute()
	{
		var record = document.getElementById('record_id').value;
		if(xmlHttp4.readyState == 4)
		{
			if(xmlHttp4.status == 200)
			{
				var resText = xmlHttp4.responseText;
				window.location.href ="index.php?module=oa_officeactions&offset=1&stamp=1324532307001306700&return_module=oa_officeactions&action=DetailView&record=" + record;
			}
		}
	}
	
	var xmlHttp5;
	function contributeCase(btn_id){
		
		user_id = document.getElementById('user_id').value;
		id = document.getElementById('record_id').value;
		btn_value = document.getElementById(btn_id).value;
		var res = confirm('Are you sure, you want to contribute this case ?');
				
		if(res == true){
			
			var url = "OfficeFlowContribution.php?id=" + id + "&user_id=" + user_id + "&btn_id=" + btn_value; 
			
			if (window.XMLHttpRequest){
				
				xmlHttp5=new XMLHttpRequest();
			}
			else{
				
				xmlHttp5=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlHttp5.open("Get",url,true);
			xmlHttp5.onreadystatechange = contribute;
			xmlHttp5.send(null);
			
		}
		else{
			return false;
		}
	}
	function contribute(){
		
		var record = document.getElementById('record_id').value;
		if(xmlHttp5.readyState == 4)
		{
			if(xmlHttp5.status == 200)
			{
				var resText = xmlHttp5.responseText;
				window.location.href ="index.php?module=oa_officeactions&offset=1&stamp=1324532307001306700&return_module=oa_officeactions&action=DetailView&record=" + record;
			}
		}
	}
	
// REMOVE USER FROM CONTRIBUTION, ADDED ON: 13-DEC-2011.

	var xmlHttp6;
	function removeUser(cont_id){

		var res = confirm('Are you sure, you want to remove this user from Contribute ?');
				
		if(res == true){
			
			var url = "RemoveUserContribute.php?cont_id=" + cont_id; 
			
			if (window.XMLHttpRequest){
				
				xmlHttp6=new XMLHttpRequest();
			}
			else{
				
				xmlHttp6=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlHttp6.open("Get",url,true);
			xmlHttp6.onreadystatechange = deleteContribute;
			xmlHttp6.send(null);
			
		}
		else{
			return false;
		}
	}
	function deleteContribute(){
		
		var record = document.getElementById('record_id').value;
		if(xmlHttp6.readyState == 4)
		{
			if(xmlHttp6.status == 200)
			{
				var resText = xmlHttp6.responseText;
				window.location.href ="index.php?module=oa_officeactions&offset=1&stamp=1324532307001306700&return_module=oa_officeactions&action=DetailView&record=" + record;
			}
		}
	}
	
/****************************************************************************************************************/

// USER POPUP LINE ITEMS.

function addRow()
{
	
    var count = document.getElementById("item_lines").rows.length;
		
	var temp = document.getElementById("item_lines");
	temp.insertRow(temp.rows.length);
	temp.rows.item(temp.rows.length - 1).insertCell(0);
	var xx	=	temp.rows.length -1 ;
	var sHTML = document.getElementById("item_details").innerHTML;
	   
    sHTML = sHTML.replace('name="login_name"','name="login_name' + count+'"');	
	sHTML = sHTML.replace('id="login_name"','id="login_name' + count+'"');	
	
	sHTML = sHTML.replace('name="login_id"','name="login_id' + count+'"');	
	sHTML = sHTML.replace('id="login_id"','id="login_id' + count+'"');	
	
	sHTML = sHTML.replace('name="btn_user_c"','name="btn_user_c' + count+'"');	
	sHTML = sHTML.replace('id="btn_user_c"','id="btn_user_c' + count+'"');	
	
	sHTML = sHTML.replace('name="btn_clr_login_c"','name="btn_clr_login_c' + count+'"');	
	sHTML = sHTML.replace('id="btn_clr_login_c"','id="btn_clr_login_c' + count+'"');	
	
	sHTML = sHTML.replace("'id':'login_id'","'id':'login_id" + count+"'");	
	sHTML = sHTML.replace("'name':'login_name'","'name':'login_name" + count+"'");	
	
	sHTML = sHTML.replace('this.form.login_name.value','this.form.login_name' + count + '.value');	
	sHTML = sHTML.replace('this.form.login_id.value','this.form.login_id' + count + '.value');
		
	temp.rows.item(temp.rows.length-1).cells.item(0).innerHTML=sHTML;
    document.getElementById("item_count").value = count;
	
	
}
function removeRow(){
	
   var count = document.getElementById("item_lines").rows.length;
   count--;
   if(document.getElementById("item_lines").rows.length == 1){
		alert("No Records to delete.");
		return;
	}
   	if(document.getElementById("item_lines").rows.length == 2){
		alert("Atleast one row is needed");
		return;
	}
	if(count > 1) {
		var temp = document.getElementById("item_lines");
		temp.deleteRow(Number(count));
		count--;
		document.getElementById("item_count").value = count;
	
	}
}




/**
* by anuradha on 31-01-2012
* workflow button ajax or js
* Start
*/
function change_complete_status(id,subcase_status_id,btn_id)
{   	 			 	
	
	var assigned_id = document.getElementById('user_id').value;
	var subcase_number = document.getElementById('subcase_number').value;
	var flag_hook = 1;
	var res = confirm('Are you sure, you want to change the status ?');
	if(res == true){
	   var callback = {
		 success: function(o) {		 			 
		 alert(o.responseText);
		 window.location.href ="index.php?module=oa_officeactions&return_module=oa_officeactions&action=DetailView&record="+id;
		 
		}
	}
	    var connectionObject = YAHOO.util.Connect.asyncRequest ("GET", "completePreparationWorkflow.php?subcase_status_id="+subcase_status_id+"&id="+id+"&user_id="+ assigned_id+"&subcase_number="+subcase_number+"&flag_hook="+ flag_hook, callback);
	}
	else{
		return false;

	}
} //end fn

function change_status(id,subcase_status_id,btn_id)
{
    var login_user_id = document.getElementById('user_id').value;
	var subcase_number = document.getElementById('subcase_number').value;
	var flag_hook = 1;
	var res1 = confirm('Are you sure, you want to change the status ?');
	if(res1 == true){
	   var start_callback = {
		 success: function(x) {		 			 
		 alert(x.responseText);
		 window.location.href ="index.php?module=oa_officeactions&return_module=oa_officeactions&action=DetailView&record="+id;
		 
		}
	}
	    var startObject = YAHOO.util.Connect.asyncRequest ("GET", "startPreparationWorkflow.php?subcase_status_id="+subcase_status_id+"&id="+id+"&user_id="+login_user_id+"&subcase_number="+subcase_number+"&flag_hook="+flag_hook, start_callback);
	}
	else{
		return false;

	}
	
} //end fn

// FOR CALENDER IN APPLICATION FILED.
	Calendar.setup ({
	inputField : "fdate",
	daFormat : "%m/%d/%Y %I:%M%P",
	button : "fdate_trigger",
	singleClick : true,
	dateStr : "",
	step : 1,
	weekNumbers:false
	}
	);
/**
END
*/

//by anuradha 23/8/2012
function open_assign_popup()
{
	var user_id = document.getElementById('userid').value;
	var bean_id = document.getElementById('beanid').value;
	var url = "AssignedToCasePopup.php?beanid=" + bean_id + "&userid=" + user_id+"&subcase=yes";
	window.open(url,"Assigned to Case",'height=200,width=650,status=yes');
}
//end