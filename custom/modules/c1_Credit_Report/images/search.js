function ajaxFunction(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			document.getElementById('sub_cont').innerHTML=req.responseText; 
			//document.myForm.time.value = ajaxRequest.responseText;
		}
	}
	
	var case_status = document.getElementById('case_status').value;
	var credit_date_dom = document.getElementById('credit_date_dom').value;
	var date_from = document.getElementById('date_from').value;
	var date_to = document.getElementById('date_to').value;
	var user_id = document.getElementById('user_id').value;
	var queryString = "?case_status=" + case_status + "&user_id=" + user_id + "&date_from=" + date_from + "&date_to=" + date_to + credit_date_dom + "&credit_date_dom=";
	ajaxRequest.open("GET", "search.php" + queryString, true);
	
	ajaxRequest.send(null); 
}


function disableFromToDate(credit_date_dom){
var credit_date_dom = credit_date_dom;
if(credit_date_dom!='custom'){
document.getElementById('date_from_span').style.display = 'none';
document.getElementById('date_to_span').style.display = 'none';
document.getElementById('from_lebel_id').style.display = 'none';
document.getElementById('to_lebel_id').style.display = 'none';
}else{
document.getElementById('date_from_span').style.display = 'block';
document.getElementById('date_to_span').style.display = 'block';
document.getElementById('from_lebel_id').style.display = 'block';
document.getElementById('to_lebel_id').style.display = 'block';
}


}