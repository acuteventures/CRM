// JavaScript Document
/* Organization: Veon Consulting
 * Name : Preethi
 * Date : 10-11-2011
 * Des : redirecting to getReport.php to display the report according to selected value
 */
// By preethi on 25-02-2012
// for generating the Out standing pledge report
function filter_1st_option(type) {
    var consultant_name = document.getElementById('consultant_name').value;
	if(consultant_name != ''){
		var callback = {
			success: function(o) {
				document.getElementById('current_reports').style.display = 'none';
				//alert(o.responseText);
				if(type==1){
					document.getElementById("InventionsWithSearchButNoPatent_Div").innerHTML = o.responseText;
				}else if(type==2){
					document.getElementById("InventionsWithExpiredProvisionalsNotClaimed_Div").innerHTML = o.responseText;
				}else if(type==3){
					document.getElementById("ExpiringProvisionalswithNoFullPatentinProgress_Div").innerHTML = o.responseText;
				}
			}
		}
		var connectionObject = YAHOO.util.Connect.asyncRequest ("GET", "inventionReport.php?consultant_name="+consultant_name+"&type="+type, callback);
	}
	else if(consultant_name == ''){
			alert("Enter Consultant Name");
			return false;
	}
} 

function openWindow()
{
	// Validation to check atleast one check box
	var len=document.DetailView.invention_id;
			var checked = 0;
			for(i=0;i<document.DetailView.elements.length;i++)
			{
				if(document.DetailView.elements[i].name.indexOf("invention_id")>-1)
				{
					if(document.DetailView.elements[i].checked == true)
					{
						var checked = 1;
					}
				}
			}
			var inv_id= new Array();
			if(checked == 0)
			{
				alert("Select atleast one Invention");
				return false;
			}else{		
				for (var i=0; i<document.DetailView.invention_id.length; i++) 
					{
						if (document.DetailView.invention_id[i].checked) 
						{
							inv_id[i] = document.DetailView.invention_id[i].value;
							//alert(inv_id[i]);
							
						}
					}
					window.open('sendEmail_inv_report.php?id='+inv_id,'name','height=375px,width=625px');
			}
}
