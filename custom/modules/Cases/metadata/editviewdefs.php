
<?php
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2011 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/
 
 /********************************************************

	AUTHOR : BASUDEBA RATH.
	DATE: 15-Nov-2011.
	VEON CONSULTING PVT. LTD.
********************************************************/

$viewdefs['Cases']['EditView'] = array(
    'templateMeta' => array('maxColumns' => '2',
                            'widths' => array(
                                            array('label' => '10', 'field' => '30'),
                                            array('label' => '10', 'field' => '30')
                                            ),
											
 						   // Author: Basudeba Rath. 
						   // Dt.-30-Nov-2011.
						   
 						   'form' => array('footerTpl'=>'custom/modules/Cases/tpls/EditViewFooter.tpl'),		
                           ),
  'panels' => array (

  'lbl_case_information' =>
  array(
	  array (
	    array(
//Ashok Customcode ,modified by : Basudeba Rath. Date: 08-Feb-2012.
	//'name'=>'case_number'
		'label' => 'LBL_NUMBER',
	          'customCode' => '<input type = "text" name="case_number" value="{$CASECOUNT}" tabindex="1" size="30" maxlength="100" id="case_number"  {$DIS} >&nbsp;&nbsp;
<input type = "checkbox" title= "Click to Override the Case Number" name="caseoverride" id= "caseoverride" {$CHECKED_CHECK} onclick = "enableCsNo();" {$CHK_DIS} /><input type = "hidden" id = "case_override" name = "case_override" value = {$CASE_OVERRIDE_VALUE} />',
//EOC
		
		) ,//, 'type'=>'readonly'
	  ),
		 // Author: Basudeba Rath. 
   		 // Dt.-30-Nov-2011.
	  
	  array(
		 array( 	
		   'name' => 'relatedtoparent',
		   'customCode' => '<select id = "relatedtoparent" name = "relatedtoparent" onchange = "relateToParent();">{$RELATED_PARENT}</select>',// Basudeba Rath. Date : 21-Jan-2012.
		 ),
	  	array( 
			'name' => 'account_name',
		    'customCode'=>'<input type="text" name="account_name" class="sqsEnabled" tabindex="103" id="account_name" size="25" value="{$ACC_DESC}" onblur = "saveClientName();" title=\'\' autocomplete="off"  >
						
			<input type="hidden" name="account_id" id="account_id" value="{$ACC_ID}">
			
			<input type="button" name="btn_account_c" id="btn_account_c" tabindex="103" title="{$APP.LBL_SELECT_BUTTON_TITLE}" accessKey="{$APP.LBL_SELECT_BUTTON_KEY}" class="button" value="{$APP.LBL_SELECT_BUTTON_LABEL}" onclick=\' open_popup("Accounts", 600, 400, "", true, false, {literal}{"call_back_function":"set_return","form_name":"EditView","field_to_name_array":{"id":"account_id","name":"account_name"}}{/literal}, "single", true);this.form.account_name.focus();\'>
			
			<input type="button" name="btn_clr_account_c" id="btn_clr_account_c" tabindex="103" title="{$APP.LBL_CLEAR_BUTTON_TITLE}" accessKey="{$APP.LBL_CLEAR_BUTTON_KEY}" class="button" onclick="this.form.account_name.value = \'\';this.form.account_id.value = \'\';" value="{$APP.LBL_CLEAR_BUTTON_LABEL}">
			
			<script type="text/javascript">
			<!--
				enableQS(false);
			-->
			</script>',	
		),
				
	  ),
	
	  array (
	  	
		array (
			  'name' =>'type',
			  'customCode' => '<select id = "type" name = "type" onchange = "callFunctions();">{$CASE_TYPE}</select>',
		),
		array (
			  'name' => 'status',
			  'customCode' => '<select id = "status" name = "status" {$DISABLE} onchange = "populateCurrDate();" >{$CASE_STATUS}</select>',
	  	),
	  ),
	  
	  array (
	   array (
	      'name' => 'amount_owed',
	      
	    ),
		array (
	      'name' => 'due_date',
	     
	    ),
	
	  ),
      
           array(
            array(
                'label' => 'Related to', 
                'customCode' => '<span>{$RELATEPOPUP}</span>',
            ),
            array(
                'label' => 'Search Type:',
                'customCode' =>'<select id="search_type" name="search_type" style="{$SERARCHTYPE}"> {$SEARCH_TYPE}</select>',
            ),
        
           ),
            array (
                   array(
                            'name' => 'priority',
                    ),
		   /*array(
			    'name' => 'patent_number',
			    'customCode' =>'<input type = "text" name = "patent_number" id = "patent_number" value = "{$PATENT_NUMBER_VALUE}" style="{$PATENT_NUMBER_HIDE}" />',
		   ),*/

            ),
	 
// Added By Basudeba Rath. Date : 25-May-2012.

	array (
	 	array(
			'name' => 'case_type_title',
		),
		array(
			'name' => 'qb_date',
                        'customCode' => '{$QB_DATE}',
		),

    ),
//by anuradha on 17/8/2012
	array (
	 	array(
			'name' => 'amount_paid',
		),

     ),
//end
		  

	),

// commented on 15-Feb-2012.

	/*'LBL_PANEL_ASSIGNMENT' =>
	array(
	   array (
		    'assigned_user_name',
	   ),
	),*/

// Date : 04-Jan-2012.
// Author : Basudeba Rath.

	'LBL_CREDIT_ALLOCATION' =>
	array(
	   array (
		// Date : 07-May-2012.
		    array (
				'name' => 'client_consultant_name',
				'customCode' => '<input type = "text" id = "client_consultant_name" name = "client_consultant_name" value = "{$CONSULTANT_NAME}" readonly = "true" /><input type = "hidden" id = "client_consultant_id" name ="client_consultant_id" value = "{$CONSULTANT_ID}"/>',
	   		),

			array (
		    	'name'=>'credit_date',
                        'customCode' => '{$CREDIT_DATE}',		    	
	   		),
	   ),
	   array (
		    array (
				'name' => 'credit_alloc_notes',
	   		),
			
	   ),
	   array (
		    array (
		    	'customCode' => '{$CREDIT_ALLOCATION}<input type = "hidden" name = "cnt_value" id = "cnt_value" value = "{$CNT_VALUE}" /> <input type="hidden" name="credit_dt_hidden" id="credit_dt_hidden" value={$CREDIT_DATE_HID} />',
	   		),
	   ),
	),
	'LBL_EDIT_FILING' =>
	array(
	   array (
		    array (
				//'name' => 'filing_date',
				'label' => 'Filing date',
				'customCode' => '{$FILING_DATE}',
				
	   		),
			array (
				//'name' => 'filing_date',
				'label' => 'Application Number',
		    	'customCode' => '{$APP_NO}',		    	
	   		),
	   ),
	   array (
		    array(
			'label' => 'LBL_FILING_RECEIPT',
			'customCode' => '<input type = "checkbox" id = "freceipt" name = "freceipt"  onclick = changeFrecipt() {$F_RECEIPT} value = "{$FRECIPT_VALUE}" />'
		    ),
			//* preethi on 03-09-2012
			array(
			    'name' => 'patent_number',
			    'customCode' =>'<input type = "text" name = "patent_number" id = "patent_number" value = "{$PATENT_NUMBER_VALUE}" style="{$PATENT_NUMBER_HIDE}" />',
		   ),
		   //* End			
	   ),
	),

		'LBL_EDIT_TM_FILING' =>
	array(
	   array (
		    array (
				//'name' => 'filing_date',
				'label' => 'TM Filing date',
				'customCode' => '{$TM_FILING_DATE}',
				
	   		),
			array (
				//'name' => '',
				'label' => 'TM Application No',
		    	'customCode' => '{$TM_APP_NO}',		    	
	   		),
	   ),
	   array (
		    array (
				'label' => 'TM Registration Date',
		    	'customCode' => '{$TM_REG_DT}',
	   		),
			 array (
				'label' => 'TM Registration No',
		    	'customCode' => '{$TM_REG_NO}',
	   		),
	   ),
	),
),


);
?>

<script src="custom/modules/Cases/WorkFlows.js" type="text/javascript"></script>
<script type="text/javascript">	
/*
	Author : Basudeba Rath
*/
	
	function callFunctions(){

		// Date : 09-May-2012
		document.getElementById('patent_number').style.display="none";

		// Date : 08-May-2012.
		removeFromValidate('EditView', 'search_type');
		// Date : 25-May-2012.
		removeFromValidate('EditView', 'case_type_title');	
		
		var e = document.getElementById("type");
		var csType = e.options[e.selectedIndex].text; //e.options[e.selectedIndex].value;
		
                // Date : 31-Jan-2012.
                //commented on 01-Mar-2012.
		/* if(csType == "Other"){
		
			addToValidate('EditView', 'description', 'text', true,'Description' );
		}
		else{
			removeFromValidate('EditView', 'description');
		}*/ 

		document.getElementById("search_type").disabled = true;
		document.getElementById("search_type").style.display = 'none';
//		document.getElementById("search_type_label").style.display = 'none';
//				
//		document.getElementById('clim_div').style.display="none";
		document.getElementById('btn_np').style.display="none";
		document.getElementById('btn_priority').style.display="none";
		
		if(csType == 'Patent Search'){
			
			var s=document.getElementById("search_type");
			s.disabled=true;
//			document.getElementById("search_type_label").style.display = 'block';
//			document.getElementById('search_patent').style.display="block";
			//document.getElementById('UsersPopUp').style.display="none";
			document.getElementById("search_type").disabled = false;
			document.getElementById("search_type").style.display = 'block';

			// Date : 08-May-2012.
			addToValidate('EditView', 'search_type', 'text', true,'Search Type');
			
		}
		else if(csType == 'Provisional Patent'){
                    document.getElementById("search_type").disabled = true;
                    document.getElementById("search_type").style.display = 'none';
			//document.getElementById('search_patent').style.display="none";	
			//document.getElementById('UsersPopUp').style.display="block";
		}
		else if(csType == 'Utility Patent' || csType == 'International Patent'){
			document.getElementById("search_type").disabled = true;
			document.getElementById("search_type").style.display = 'none';
			document.getElementById('clim_div').style.display="block";
			document.getElementById('btn_np').style.display="block";
			document.getElementById('btn_priority').style.display="block";

			// Date : 09-May-2012 // for both utility and international patent.
			document.getElementById('patent_number').style.display="block";
			
		}
		else if(csType == 'Design Patent'){
			// Date : 09-May-2012
			document.getElementById('patent_number').style.display="block";
		}
		else if(csType == 'Other'){
			// Date : 25-May-2012
			addToValidate('EditView', 'case_type_title', 'text', true,'Case Type Title');
		}
		getCaseStatus();
	}
	
	var xmlHttp1;
	var xmlHttp11;
	var xmlHttpUser;
	
	function getCaseStatus()	
	{	
		var e = document.getElementById("type");
		var caseType = e.options[e.selectedIndex].value;	
		
		var url = "GetStatus.php?case_type="+ caseType; 
		
		if (window.XMLHttpRequest){
		    
			xmlHttp11=new XMLHttpRequest();
		}
		else{
		  	
			xmlHttp11=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlHttp11.open("Get",url,true);
		xmlHttp11.onreadystatechange = getCStatus;
		xmlHttp11.send(null);
	}
	function getCStatus()
	{
		if(xmlHttp11.readyState == 4)
		{
			if(xmlHttp11.status == 200)
			{
				var resText = xmlHttp11.responseText;
				if(resText != ""){
					document.getElementById('status').innerHTML=resText;
				}
				
			}
		}
	}
	
	
	
	// Date : 16-Jan-2012.

	function relToParent(){
		
		var ct = document.getElementById("type");
		var ct_value = ct.options[ct.selectedIndex].text;
	
		document.getElementById("lbl_ril").style.display = 'none';
		document.getElementById("ril").style.display = 'none';
		document.getElementById("lbl_trademark").style.display = 'none';
		document.getElementById("trademark").style.display = 'none';
		
		document.getElementById("trade_trademark_cases_name").value = "";
		document.getElementById("trade_trademark_casestrade_trademark_ida").value = "";
		document.getElementById("invention_name").value = "";
		document.getElementById("invention_id").value = "";
	
		if(ct_value == "Trademark" || ct_value == "Logo Design"){
			document.getElementById("lbl_trademark").style.display = 'block';
			document.getElementById("trademark").style.display = 'block';
		}
		else if(ct_value == "Other"){
			document.getElementById("lbl_trademark").style.display = 'block';
			document.getElementById("trademark").style.display = 'block';
			document.getElementById("lbl_ril").style.display = 'block';
			document.getElementById("ril").style.display = 'block';
		}
		else{
			document.getElementById("lbl_ril").style.display = 'block';
			document.getElementById("ril").style.display = 'block';
		}
	}
	
	function relateToParent(){
		
		var rp = document.getElementById("relatedtoparent");
		var parent = rp.options[rp.selectedIndex].value;
                document.getElementById("inv-popup").style.display = 'none';
                document.getElementById("tm-popup").style.display = 'none';
                document.getElementById("search_type").disabled = true;
		document.getElementById("search_type").style.display = 'none';
//		document.getElementById("lbl_ril").style.display = 'none';
//		document.getElementById("ril").style.display = 'none';
//		document.getElementById("lbl_btn_ril").style.display = 'none';
//		document.getElementById("lbl_trademark").style.display = 'none';
//		document.getElementById("trademark").style.display = 'none';
		
		if(parent == "Invention"){
			
			document.getElementById("trade_trademark_cases_name").value = "";
			document.getElementById("trade_trademark_casestrade_trademark_ida").value = "";
			document.getElementById("inv-popup").style.display = 'block';
                        
//			document.getElementById("lbl_ril").style.display = 'block';
//			document.getElementById("ril").style.display = 'block';
			//document.getElementById("lbl_btn_ril").style.display = 'block';
			
			removeFromValidate('EditView', 'trade_trademark_cases_name');
			addToValidate('EditView', 'invention_name', 'text', true,'Invention' );
		}
		else if(parent == "Trademark"){
			
			document.getElementById("invention_name").value = "";
			document.getElementById("invention_id").value = "";
			document.getElementById("tm-popup").style.display = 'block';
			//document.getElementById("").style.display = 'block';
//			document.getElementById("lbl_trademark").style.display = 'block';
//			document.getElementById("trademark").style.display = 'block';
			
			removeFromValidate('EditView', 'invention_name');
			addToValidate('EditView', 'trade_trademark_cases_name', 'text', true,'Trademark' );
		}
		else{
			document.getElementById("invention_name").value = "";
			document.getElementById("invention_id").value = "";
			document.getElementById("trade_trademark_cases_name").value = "";
			document.getElementById("trade_trademark_casestrade_trademark_ida").value = "";
			
			removeFromValidate('EditView', 'invention_name');
			removeFromValidate('EditView', 'trade_trademark_cases_name');
		}
		getCaseTypes();
	}
	
	// Date : 19-Jan-2012.
	
	xmlHttpCaseTypes = "";
	
	function getCaseTypes(){
		
		var rp = document.getElementById("relatedtoparent").value;
		var url = "GetCaseTypes.php?rp="+rp;
		if (window.XMLHttpRequest){
		    
			xmlHttpCaseTypes = new XMLHttpRequest();
		}
		else{
		  	
			xmlHttpCaseTypes = new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlHttpCaseTypes.open("Get",url,true);
		xmlHttpCaseTypes.onreadystatechange = caseTypeList;
		xmlHttpCaseTypes.send(null);		
	}
	function caseTypeList()
	{
		if(xmlHttpCaseTypes.readyState == 4)
		{
			if(xmlHttpCaseTypes.status == 200)
			{
				var resText = xmlHttpCaseTypes.responseText;
				if(resText != ""){
					document.getElementById('type').innerHTML = resText;
				}
				
			}
		}
	}

// 08-Feb-2012.
	function enableCsNo(){
		
				
		if(document.getElementById('caseoverride').checked == true){
			
			document.getElementById('case_number').readOnly=false;
			
		}
		else{
			document.getElementById('case_number').readOnly=true;
			
		}
	}
	
	function saveClientName(){
		document.getElementById('client_name_popup').value = document.getElementById('account_name').value;
		document.getElementById('client_id_popup').value = document.getElementById('account_id').value;
		
		// Populate client's consultant name and id in the credit allocation section.
		// Date : 07-may-2012, Author : Basudeba Rath.
		
		getSubcases();
	}

// Date : 07-May-2012.	
	
	function getSubcases()
	{
		 var client_id = document.getElementById('account_id').value;
		 if(client_id!=''){
			//var case_id = document.DetailView.record.value;
			//alert(case_id);
			var callback = {
							 success: function(o) {
							 var str1 = o.responseText;
							 var str = str1.split(",");
							 document.getElementById("client_consultant_name").value = str[0];
							 document.getElementById("client_consultant_id").value = str[1];
							 //sugar crm
							}
						 }
			var connectionObject = YAHOO.util.Connect.asyncRequest ("GET", "ConsultantDisplay.php?client_id="+client_id, callback);
			}
	}

// Date : 09-May-2012.

	function populateCurrDate(){
		
		var e = document.getElementById("status");
		var csStatus = e.options[e.selectedIndex].text;
		var creditDt = document.getElementById('credit_dt_hidden').value;
                if(creditDt.length <= 1){
                    if(csStatus == "Completed" || csStatus == "Abandoned"){
                            var currentDate = new Date();
                            var day = currentDate.getDate();
                            var month = currentDate.getMonth()+1; 
                            var year = currentDate.getFullYear();
                            document.getElementById('credit_date').value = month+"/"+day+"/"+year;
                    }
                    else{
                        document.getElementById('credit_date').value = "";
                    }
                }
	}


// Date : 01-Mar-2012.		
	Calendar.setup ({
			inputField : "filing_date",
			daFormat : "%m/%d/%Y %I:%M%P",
			button : "created_trigger_af",
			singleClick : true,
			dateStr : "",
			step : 1,
			weekNumbers:false
			}
	);

// Date : 11-Mar-2012.		

	Calendar.setup ({
			inputField : "tm_filing_date",
			daFormat : "%m/%d/%Y %I:%M%P",
			button : "created_trigger_tm_af",
			singleClick : true,
			dateStr : "",
			step : 1,
			weekNumbers:false
			}
	);

	Calendar.setup ({
			inputField : "tm_registration_date",
			daFormat : "%m/%d/%Y %I:%M%P",
			button : "created_trigger_tm_rd",
			singleClick : true,
			dateStr : "",
			step : 1,
			weekNumbers:false
			}
	);

        //credit_date
        //Rajesh G - 31/08/2012
        Calendar.setup ({
			inputField : "credit_date",
			daFormat : "%m/%d/%Y %I:%M%P",
			button : "created_trigger_cd_af",
			singleClick : true,
			dateStr : "",
			step : 1,
			weekNumbers:false
			}
	);
            
        //credit_date
        //Rajesh G - 31/08/2012
        Calendar.setup ({
			inputField : "qb_date",
			daFormat : "%m/%d/%Y %I:%M%P",
			button : "created_trigger_qb_dt",
			singleClick : true,
			dateStr : "",
			step : 1,
			weekNumbers:false
			}
	);
// Author : Basudeba Rath, Date : 22-Jun-2012.

	function changeFrecipt(){
	
		if(document.getElementById('freceipt').checked){
			document.getElementById('freceipt').value = 1;
		}
		else{
			document.getElementById('freceipt').value = 0;
		} 
	}


</script>