// JavaScript Document
	
// Author : Basudeba Rath
// Dt: 19-Jan-2012.
// VEON CONSULTING PVT LTD.

/*************************************************************************************************************************/
	
	var xmlHttp1 = "";
	function callAjax()
	{
		var user_id = document.getElementById("userid").value;
		var notes   = document.getElementById("clnt_hist").value;
		var beanid  = document.getElementById("beanid").value;
		var notesid   = document.getElementById("noteid").value;
	
		if(notes == "" || notes== null){
				
			alert('Please Enter Description!');
			return false;
		}
		
		var url = "TrademarkHistory.php?notes="+ notes + "&beanid=" + beanid + "&userid=" + user_id + "&notesid=" + notesid;
		
		if (window.XMLHttpRequest){
		    
			xmlHttp1=new XMLHttpRequest();
		}
		else{
		  	
			xmlHttp1=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlHttp1.open("Get",url,true);
		xmlHttp1.onreadystatechange = getData;
		xmlHttp1.send(null);
	}
	
	function getData()
	{
		var record = document.getElementById('beanid').value;
		if(xmlHttp1.readyState == 4)
		{
			if(xmlHttp1.status == 200)
			{
				var resText = xmlHttp1.responseText;
				if(resText != ""){
					document.getElementById('clnt_hist').value = "";
				}
				if(resText == "saved successfully."){
								
					window.location.reload();
				}
			}
		}
	}
	function clr(){
		
		document.getElementById('clnt_hist').value = "";
	}
	function cancel(){
		
		var record = document.getElementById('beanid').value;
		window.location.href ="index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Dtrade_trademark%26offset%3D1%26stamp%3D1326987853086283900%26return_module%3Dtrade_trademark%26action%3DDetailView%26record%3D" + record;
		
	}
	function edit(id)
	{
		var record = document.getElementById('beanid').value;
		window.location.href ="index.php?module=trade_trademark&offset=1&stamp=1322207474090936400&return_module=trade_trademark&action=DetailView&record=" + record + "&notesid=" + id; 
	}
	function removeNotes(id)
	{
		var url = "TrademarkHistoryDelete.php?notesid=" + id;
		var ask = confirm("Do you really want to delete this record?");
		if(ask == true){
			if (window.XMLHttpRequest){
				
				xmlHttp1=new XMLHttpRequest();
			}
			else{
				
				xmlHttp1=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlHttp1.open("Get",url,true);
			xmlHttp1.onreadystatechange = delData;
			xmlHttp1.send(null);
		}
		else{
			return false;
		}
	}
	function delData()
	{
		var record = document.getElementById('beanid').value;
		if(xmlHttp1.readyState == 4)
		{
			if(xmlHttp1.status == 200)
			{
				var resText = xmlHttp1.responseText;
				if(resText == "Successfully Deleted."){
					window.location.reload();
				}
			}
		}
	}
	
/**************************************************************************************************************************/