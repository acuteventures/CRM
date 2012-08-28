// JavaScript Document

/*************************************************

	AUTHOR: BASUDEBA RATH
	DATE : 07-Feb-2012.
	VEON CONSULTING PVT. LTD.
	
*************************************************/

	function removeCase(id,clm_flag)
	{
		
		var url = "ClaimedCaseDelete.php?clm_case_id=" + id + "&clm_flag=" + clm_flag;
		var ask = confirm("Do you really want to remove this claimed case?");
		if(ask == true){
			if (window.XMLHttpRequest){
				
				xmlHttp1=new XMLHttpRequest();
			}
			else{
				
				xmlHttp1=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlHttp1.open("Get",url,true);
			xmlHttp1.onreadystatechange = delCase;
			xmlHttp1.send(null);
		}
		else{
			return false;
		}
	}
	function delCase()
	{
		if(xmlHttp1.readyState == 4)
		{
			if(xmlHttp1.status == 200)
			{
				var resText = xmlHttp1.responseText;
				window.location.reload();
			}
		}
	}