// JavaScript Document

function filterReport() {
	
    var date_from = document.getElementById('date_from').value;
	var date_to = document.getElementById('date_to').value;
	
	if(date_from != '' && date_to != ''){
		
		var callback = {
			success: function(o) {
				
				document.getElementById("filt_report").innerHTML = "";
				document.getElementById("curr_report").innerHTML = "";
				document.getElementById("filt_report").innerHTML = o.responseText;
			}
		}
		var connectionObject = YAHOO.util.Connect.asyncRequest ("GET", "GetReport.php?date_from="+date_from+"&date_to="+date_to, callback);
	
	}
	else if(date_from == '' || date_to == ''){
			alert("Select both Date From and Date To");
			return false;
	}
} 