// JavaScript Document
function getSubcases()
{
 if(document.getElementById('subcase_name').innerHTML==''){
	var case_id = document.DetailView.record.value;
	//alert(case_id);
	var callback = {
 	                 success: function(o) {
					 //alert(o.responseText);
		             document.getElementById("subcase_name").innerHTML = o.responseText;
 					 //sugar crm
	                }
                 }
    var connectionObject = YAHOO.util.Connect.asyncRequest ("GET", "subcase_display.php?case_id="+case_id, callback);
	
 }
}

// Author : Basudeba Rath, Date : 09-May-2012.

function populateTitle(){
	
	var e = document.getElementById("subcase_name");
	var subCsType = e.options[e.selectedIndex].text;
	if(subCsType == "Allowance"){
		document.getElementById('sub_case_title').value = "Allowance";
	}
	else{
		document.getElementById('sub_case_title').value = "";
	}
}

//validations
/*function getValidation(form)
{
	var index_value = document.getElementById('subcase_name').options[document.getElementById('subcase_name').selectedIndex].text;
	//alert(index_value);
    if(index_value=='Other') 	
	{	
		 addToValidate('EditView', 'description', 'varchar', true,"Please enter case description");		
	}
	else{
		removeFromValidate('EditView', 'description') ;
	}
	
	
}*/

function getStatus()
{
	var subcase_id = document.getElementById("subcase_name").value;				 
	var status_callback = {
	 success: function(x) {					 
	 //alert(x.responseText);
	 document.getElementById("subcase_status_id").innerHTML = x.responseText;
	}
	}
	var connectionStatusObject = YAHOO.util.Connect.asyncRequest ("GET", "subcase_status_display.php?subcase_id="+subcase_id, status_callback);
}
//by anuradha 22/8/2012
function enableCsNo(){
	if(document.getElementById('subcaseoverride').checked == true){
		document.getElementById('name').readOnly=false;
	}
	else{
		document.getElementById('name').readOnly=true;
	}
}

//by anuradha 23/8/2012
function populateCurrDate(){
	var e = document.getElementById("subcase_status_id");
	var csStatus = e.options[e.selectedIndex].text;
	document.getElementById('credit_date').value = "";
	if(csStatus == "Completed"){
	var currentDate = new Date();
	var day = currentDate.getDate();
	var month = currentDate.getMonth()+1; 
	var year = currentDate.getFullYear();
	document.getElementById('credit_date').value = month+"/"+day+"/"+year;
	}
}
