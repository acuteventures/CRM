// JavaScript Document


// APPLICANTS LINE ITEMS.

function addRow()
{
	
    var count = document.getElementById("myTable_new").rows.length;
	var temp = document.getElementById("myTable_new");
	temp.insertRow(temp.rows.length);
	var td = temp.rows.item(temp.rows.length - 1).insertCell(0);
	td.setAttribute('id','ta_' + count);

	var sHTML = document.getElementById("applicants_info").innerHTML;
	   
    sHTML = sHTML.replace('name="first_name"','name="first_name_' + count+'"');	
	sHTML = sHTML.replace('id="first_name"','id="first_name_' + count+'"');	
	
	sHTML = sHTML.replace('name="last_name"','name="last_name_' + count+'"');	
	sHTML = sHTML.replace('id="last_name"','id="last_name_' + count+'"');	
	
	sHTML = sHTML.replace('name="address"','name="address_' + count+'"');	
	sHTML = sHTML.replace('id="address"','id="address_' + count+'"');
	
	sHTML = sHTML.replace('name="city"','name="city_' + count+'"');	
	sHTML = sHTML.replace('id="city"','id="city_' + count+'"');	

	sHTML = sHTML.replace('name="state"','name="state_' + count+'"');	
	sHTML = sHTML.replace('id="state"','id="state_' + count+'"');	
	
	sHTML = sHTML.replace('name="zipcode"','name="zipcode_' + count+'"');	
	sHTML = sHTML.replace('id="zipcode"','id="zipcode_' + count+'"');	
	
	sHTML = sHTML.replace('name="phone_no"','name="phone_no_' + count+'"');	
	sHTML = sHTML.replace('id="phone_no"','id="phone_no_' + count+'"');	
	
	sHTML = sHTML.replace('name="email_address"','name="email_address_' + count+'"');	
	sHTML = sHTML.replace('id="email_address"','id="email_address_' + count+'"');
	
	sHTML = sHTML.replace('name="delbutton"','name="delbutton_' + count+'"');	
	sHTML = sHTML.replace('id="delbutton"','id="delbutton_' + count +'"');
	
	/*sHTML = sHTML.replace('id="ta"','id="ta_' + count +'"');*/
	sHTML = sHTML.replace("removeRow('ta')","removeRow('ta_"+ count + "')");	
	
	temp.rows.item(temp.rows.length-1).cells.item(0).innerHTML=sHTML;
    document.getElementById("table_count").value = count;
	
}
function removeRow(tr){
	
   /*var count = document.getElementById("myTable_new").rows.length;
   count--;
   if(document.getElementById("myTable_new").rows.length == 1){
		alert("No Records to delete.");
		return;
	}
   	if(document.getElementById("myTable_new").rows.length == 1){
		alert("Atleast one row is needed");
		return;
	}
	if(count > 1) {
		var temp = document.getElementById("myTable_new");
		temp.deleteRow(Number(count));
		count--;
		document.getElementById("table_count").value = count;
	
	}*/
	//alert(tr);
	//alert(document.getElementById(tr).innerHTML);
	
	document.getElementById(tr).innerHTML = null;
	
	//tr.innerHTML = null;
	
	//tr.childNode.removeChild(tr);
}

