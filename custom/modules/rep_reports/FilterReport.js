// JavaScript Document

// Author : Basudeba Rath.
 
function filterReport() {
		
	
    var date_from = document.getElementById('date_from').value;
	var date_to = document.getElementById('date_to').value;
	var field = document.getElementById('field_names').value;
	var field_data = document.getElementById('field_data').value;
	var first_name = document.getElementById('first_name').value;
	var last_name = document.getElementById('last_name').value;
	
	if(document.getElementById('field_names').value == "credit_date"){
		if(date_from == '' || date_to == ''){
			alert("Enter both Date From and Date To");
			return false;
		}	
	}
	else if(document.getElementById('field_names').value == "consutant"){
		
		if(first_name == '' || last_name == ''){
			alert("Enter both first name and last name!");
			return false;
		}
	}
	else if(document.getElementById('field_names').value == "client_name" ){
		if(field_data == '' ){
			alert("Enter Client name!");
			return false;
		}
	}
	else if(document.getElementById('field_names').value == "case_type" ){
		if(field_data == '' ){
			alert("Enter Case Type!");
			return false;
		}
	}
	else if(document.getElementById('field_names').value == "filt_by_field"){
		alert('Select Search type.');
		return false;
	}


	var callback = {
		success: function(o) {
			document.getElementById("filt_report").innerHTML = "";
			document.getElementById("curr_report").innerHTML = "";
			document.getElementById("filt_report").innerHTML = o.responseText;
		}
	}
	
	var connectionObject = YAHOO.util.Connect.asyncRequest ("GET", "GetReport.php?date_from="+date_from+"&date_to="+date_to+"&field="+field+"&field_data="+field_data+"&first_name="+first_name+"&last_name="+last_name, callback);
	
} 

function filtered_by_column(){
	
	document.getElementById('txt_data').style.display = "none";
	document.getElementById('fname').style.display = "none";
	document.getElementById('lname').style.display = "none";
	document.getElementById('lbl_fname').style.display = "none";
	document.getElementById('lbl_lname').style.display = "none";
	document.getElementById('lbl_client').style.display = "none";
	
	document.getElementById('lbl_dt_from').style.display = "none";
	document.getElementById('dt_from').style.display = "none";
	
	document.getElementById('lbl_dt_to').style.display = "none";
	document.getElementById('dt_to').style.display = "none";
	document.getElementById('lbl_type').style.display = "none";
	
		
	if(document.getElementById('field_names').value == "consutant"){
		document.getElementById('fname').style.display = "block";
		document.getElementById('lname').style.display = "block";
		
		document.getElementById('lbl_fname').style.display = "block";
		document.getElementById('lbl_lname').style.display = "block";
	}
	else if(document.getElementById('field_names').value == "credit_date"){
		document.getElementById('lbl_dt_from').style.display = "block";
		document.getElementById('dt_from').style.display = "block";
		
		document.getElementById('lbl_dt_to').style.display = "block";
		document.getElementById('dt_to').style.display = "block";
		//document.getElementById('lbl_dt_from').style.visibility = "visible"
	}
	else if(document.getElementById('field_names').value == "client_name"){
		document.getElementById('lbl_client').style.display = "block";
		document.getElementById('txt_data').style.display = "block"
	}
	else if(document.getElementById('field_names').value == "case_type"){
		document.getElementById('lbl_type').style.display = "block";
		document.getElementById('txt_data').style.display = "block";
	}
	
}

/*function filterReport_by_column() {
	
    
	if(date_from != '' && date_to != ''){
		
		var callback = {
			success: function(o) {
				
				document.getElementById("filt_report").innerHTML = "";
				document.getElementById("curr_report").innerHTML = "";
				document.getElementById("filt_report").innerHTML = o.responseText;
			}
		}
		var connectionObject = YAHOO.util.Connect.asyncRequest ("GET", "GetReport.php?date_from="+date_from+"&date_to="+date_to + "&field" + field + "&field_data" + field_data, callback);
	
	}
	else if(date_from == '' || date_to == ''){
			alert("Select both Date From and Date To");
			return false;
	}
}*/ 
