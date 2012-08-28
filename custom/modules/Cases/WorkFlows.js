// JavaScript Document

/***************************************************************

Author :  Basudeba Rath
Date : 05-Dec-2011
Veon Consulting Pvt. Ltd.


***************************************************************/

	var xmlHttp1;
	function change_status(id,status_id,btn_id)
	{
		var assigned_id = document.getElementById('user_id').value;
		var flag_hook = 1;
		var btn_value = document.getElementById(btn_id).value;
		var client_name = document.getElementById('account_id').innerHTML;
		var caseNo = document.getElementById('case_number').innerHTML;
		
		var res = confirm('Are you sure, you want to change the status ?');
				
		if(res == true){

			//if(btn_value == 'Complete Search')
				//alert('Please wait for next message...');
			var url = "WorkFlowStatus.php?id=" + id + "&user_id=" + assigned_id + "&flag_hook=" + flag_hook + "&btn_id=" + btn_value + "&client_name=" + client_name + "&caseNo=" + caseNo; 
			
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
				//alert(resText);
				window.location.href ="index.php?module=Cases&offset=1&stamp=1322207474090936400&return_module=Cases&action=DetailView&record=" + record;

			}
		}
	}
	
// WORK FLOW STATUS FOR PROVISIONAL PATENT.

	var xmlHttp2;
	function prov_status(id,status_id,btn_id)
	{
		var assigned_id = document.getElementById('user_id').value;
		var client_name = document.getElementById('account_id').innerHTML;
		var caseNo = document.getElementById('case_number').innerHTML;
		var case_type = document.getElementById('type').innerHTML;
		
		var flag_hook = 1;
		
		var btn_value = document.getElementById(btn_id).value;
		var res = confirm('Are you sure, you want to change the status ?');
				
		if(res == true){
			
			
			var url = "WorkFlow_Provisional.php?id=" + id + "&user_id=" + assigned_id + "&flag_hook=" + flag_hook + "&btn_id=" +btn_value + "&client_name=" + client_name + "&caseNo=" + caseNo + "&case_type=" + case_type; 
			
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
				//alert(resText);
				window.location.href ="index.php?module=Cases&offset=1&stamp=1322207474090936400&return_module=Cases&action=DetailView&record=" + record;
			}
		}
	}
        /****************************
         * Rajesh G - 10/05/12
         * Flag Case record insertion
         ****************************/

function fnFlagCase(userId,isFlag)
 {
     alert("Please wait..Case is being flagged/unflagged.");
   var case_id = document.DetailView.record.value;
   var callback = {
        success: function(o) {
            if(o.responseText == 'flagged')
                {
                    document.getElementById("btnFlag").value = "Unflag Case";
                    var btnFlag = document.getElementById("spanFlag").innerHTML;
                    btnFlag = btnFlag.replace("true", "false");
                    document.getElementById("spanFlag").innerHTML = btnFlag;
                }
                else if(o.responseText == 'unflagged')
                    {
                        document.getElementById("btnFlag").value = "Flag Case";
                        var btnFlag = document.getElementById("spanFlag").innerHTML;
                        btnFlag = btnFlag.replace("false", "true");
                        document.getElementById("spanFlag").innerHTML = btnFlag;
                    }
                    else
                        {
                            //nothing to do
                        }
       }
   }
   var connectionObject = YAHOO.util.Connect.asyncRequest ("GET", "FlagCaseInsert.php?case_id="+case_id+"&user_id="+userId+"&is_flag="+isFlag, callback);
 }	
 /****************************************/
	
/*****************************************************************************

		APPLICATION NO. AND FILING DATE INSERT 

******************************************************************************/

	var xmlHttp3;
	function app_insert(id,status_id,btn_id)
	{
		freceipt = "";
		var assigned_id = document.getElementById('user_id').value;
		var btn_value = document.getElementById(btn_id).value;
		fdate  = document.getElementById('fdate').value;
		app_no = document.getElementById('ano').value;
		file_receipt = document.getElementById('freceipt');
		
		pp_number = document.getElementById('pp_number').value;
		pi_number = document.getElementById('pi_number').value;

		if(file_receipt.checked){
			freceipt = 1;
		}
		else{
			freceipt = 0;
		}
		flag_hook = 1;
		if(fdate == ''){
			alert('Please Enter Filing date.');
			return false;
		}
		if(app_no == ''){
			alert('Please Enter Application number.');
			return false;
		}
		//if(btn_value == 'Application Filed')
			//alert('Please wait for next message.');
		var url = "WorkFlow_Provisional.php?id=" + id + "&user_id=" + assigned_id + "&flag_hook=" + flag_hook + "&btn_id=" +btn_value + "&fdate=" + fdate + "&app_no=" + app_no + "&freceipt=" + freceipt + "&pp_number=" + pp_number + "&pi_number=" + pi_number;
			
		if (window.XMLHttpRequest){
			
			xmlHttp3=new XMLHttpRequest();
		}
		else{
			
			xmlHttp3=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlHttp3.open("Get",url,true);
		xmlHttp3.onreadystatechange = application_File;
		xmlHttp3.send(null);
			
	}
	function application_File()
	{
		var record = document.getElementById('record_id').value;
		if(xmlHttp3.readyState == 4)
		{
			if(xmlHttp3.status == 200)
			{
				var resText = xmlHttp3.responseText;
				//alert(resText);
				window.location.href ="index.php?module=Cases&offset=1&stamp=1322207474090936400&return_module=Cases&action=DetailView&record=" + record;
			}
		}
	}

/*********************************************************************************************************/

// Work flow for search patent contribution.


	var xmlHttp4;
	function cont_search(id,status_id,btn_id)
	{
		var assigned_id = document.getElementById('user_id').value;
		var client_name = document.getElementById('account_id').innerHTML;
		var caseNo = document.getElementById('case_number').innerHTML;
		var flag_hook = 1;
		
		var btn_value = document.getElementById(btn_id).value;
		var res = confirm('Are you sure, you want to contribute this case ?');
				
		if(res == true){
			
			
			var url = "WorkFlowContribution.php?id=" + id + "&user_id=" + assigned_id + "&flag_hook=" + flag_hook + "&btn_id=" +btn_value + "&client_name=" + client_name + "&caseNo=" + caseNo; 
			
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
				//alert(resText);
				window.location.href ="index.php?module=Cases&offset=1&stamp=1322207474090936400&return_module=Cases&action=DetailView&record=" + record;
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
			
			var url = "WorkFlowContribution.php?id=" + id + "&user_id=" + user_id + "&btn_id=" + btn_value; 
			
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
				//alert(resText);
				window.location.href ="index.php?module=Cases&offset=1&stamp=1322207474090936400&return_module=Cases&action=DetailView&record=" + record;
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
				//alert(resText);
				window.location.href ="index.php?module=Cases&offset=1&stamp=1322207474090936400&return_module=Cases&action=DetailView&record=" + record;
			}
		}
	}
	
/****************************************************************************************************************/
// TRADEMARK FILING SECTION.
 
 var xmlHttp7;
 function tm_app_insert(bean_id, bean_status, btn_id){
	 
		//freceipt = "";
		
		var assigned_id = document.getElementById('user_id').value;
		var btn_value = document.getElementById(btn_id).value;
		tm_fdate  = document.getElementById('tm_fdate').value;
		tm_app_no = document.getElementById('tm_ano').value;
		tm_classes = document.getElementById('tm_classes');
		tm_reg_date = document.getElementById('tm_registration_date').value;
		tm_reg_no = document.getElementById('tm_registration_number').value;
		
		j = 0;
		var class_values = {};
		var options1 = tm_classes.options[1].selected;
		var str = "";
		for(i=0;i<tm_classes.options.length;i++){
		
			var options1 = tm_classes.options[i].selected;
			if(options1)
			{
				class_values[j] = tm_classes.options[i].text; //value.
				//alert(class_values[j]);
				str += "^" + class_values[j] + "^,"
				j++;
			}
		}
		//alert(str);
		
		flag_hook = 1;
		if(tm_fdate == ''){
			alert('Please Enter TM Filing date.');
			return false;
		}
		if(tm_app_no == ''){
			alert('Please Enter TM Application number.');
			return false;
		}
		
		var url = "TM_Filing.php?id=" + bean_id + "&user_id=" + assigned_id + "&flag_hook=" + flag_hook + "&btn_id=" +btn_value + "&tm_fdate=" + tm_fdate + "&tm_app_no=" + tm_app_no + "&str=" + str + "&tm_reg_date=" + tm_reg_date + "&tm_reg_no=" + tm_reg_no;
			
		if (window.XMLHttpRequest){
			
			xmlHttp7=new XMLHttpRequest();
		}
		else{
			
			xmlHttp7=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlHttp7.open("Get",url,true);
		xmlHttp7.onreadystatechange = tm_application_File;
		xmlHttp7.send(null);
 }

	function tm_application_File()
	{
		var record = document.getElementById('record_id').value;
		if(xmlHttp7.readyState == 4)
		{
			if(xmlHttp7.status == 200)
			{
				var resText = xmlHttp7.responseText;
				alert(resText);
				window.location.href ="index.php?module=Cases&offset=1&stamp=1322207474090936400&return_module=Cases&action=DetailView&record=" + record;
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

// FOR CALENDER IN APPLICATION FILED.
	Calendar.setup ({
	inputField : "fdate",
	daFormat : "%m/%d/%Y %I:%M%P",
	button : "created_trigger",
	singleClick : true,
	dateStr : "",
	step : 1,
	weekNumbers:false
	}
	);
	
// Date : 25-Jan-2012.

Calendar.setup ({
	inputField : "tm_fdate",
	daFormat : "%m/%d/%Y %I:%M%P",
	button : "created_trigger1",
	singleClick : true,
	dateStr : "",
	step : 1,
	weekNumbers:false
	}
	);

// Date : 10-Feb-2012.

Calendar.setup ({
	inputField : "tm_registration_date",
	daFormat : "%m/%d/%Y %I:%M%P",
	button : "created_trigger2",
	singleClick : true,
	dateStr : "",
	step : 1,
	weekNumbers:false
	}
	);

        