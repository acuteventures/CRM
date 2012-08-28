// JavaScript Document

// Author : PHANEENDRA
// Dt: 25-Dec-2011
// VEON CONSULTING PVT LTD.

/*************************************************************************************************************************/

// Tested and modified by : BASUDEBA RATH.
// DATE : 31-Dec-2011

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
		
		var url = "WorkFlowHistory.php?notes="+ notes + "&beanid=" + beanid + "&userid=" + user_id + "&notesid=" + notesid;
		
		if (window.XMLHttpRequest){
		    
			xmlHttp1=new XMLHttpRequest();
		}
		else{
		  	
			xmlHttp1=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlHttp1.open("Get",url,true);
		xmlHttp1.onreadystatechange = saveHistory;
		xmlHttp1.send(null);
	}
	
	function saveHistory()
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
									
				window.location.href ="index.php?module=oa_officeactions&offset=1&stamp=1324532307001306700&return_module=oa_officeactions&action=DetailView&record=" + record; 
			
			}
		}
	}
	function clr(){
		
		document.getElementById('clnt_hist').value = "";
	}
	
	function cancel(){
		
		var record = document.getElementById('beanid').value;
		window.location.href ="index.php?module=oa_officeactions&offset=1&stamp=1324532307001306700&return_module=oa_officeactions&action=DetailView&record=" + record; 
		
	}
	function edit(id)
	{
		var record = document.getElementById('beanid').value;
		window.location.href ="index.php?module=oa_officeactions&offset=1&stamp=1324532307001306700&return_module=oa_officeactions&action=DetailView&record=" + record + "&notesid=" + id; 
	}
	function removeNotes(id)
	{
		var url = "WorkFlowDelete.php?notesid=" + id;
		var ask = confirm("Do you really want to delete this record?");
		if(ask == true){
			if (window.XMLHttpRequest){
				
				xmlHttp1=new XMLHttpRequest();
			}
			else{
				
				xmlHttp1=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlHttp1.open("Get",url,true);
			xmlHttp1.onreadystatechange = delData1;
			xmlHttp1.send(null);
		}
		else{
			return false;
		}
	}
	function delData1()
	{
		var record = document.getElementById('beanid').value;
		if(xmlHttp1.readyState == 4)
		{
			if(xmlHttp1.status == 200)
			{
				//var resText = xmlHttp1.responseText;
				window.location.href ="index.php?module=oa_officeactions&offset=1&stamp=1324532307001306700&return_module=oa_officeactions&action=DetailView&record=" + record;
				
			}
		}
	}