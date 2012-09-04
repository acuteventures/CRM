<script src="custom/modules/oa_officeactions/getSubcases.js" type="text/javascript" >
</script>
<?php
global $current_user,$db,$app_list_strings,$mod_strings;
$module_name = 'oa_officeactions';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
           0 => array('label' => 'LBL_NAME','customCode' => '<input type="text" name="name" id="name"  value="{$fields.name.value}">&nbsp;&nbsp;<input type = "checkbox" title= "Click to Override the Sub Case Number" name="subcaseoverride" id= "subcaseoverride" {$CHECKED_CHECK} onclick = "enableCsNo();" {$CHK_DIS} />', ),
          // 1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 
		   array (
            'name' => 'oa_officeactions_cases_name',
			'displayParams'=>array('required'=>true),
	'customCode'=>'<input type="text" name="oa_officeactions_cases_name" class="sqsEnabled" id="oa_officeactions_cases_name" size="25" value="{$CASE_NAME}" title=\'\' autocomplete="off" readonly="readonly" onblur="subcaseDisplay();">
			
<input type="hidden" name="oa_officeactions_casescases_ida" id="oa_officeactions_casescases_ida" value="{$CASE_ID}">

<button type="button" name="btn_oa_officeactions_cases_name" id="btn_oa_officeactions_cases_name" title="{$APP.LBL_SELECT_BUTTON_TITLE}" accessKey="{$APP.LBL_SELECT_BUTTON_KEY}" class="button firstChild" value="Select" onclick=\' open_popup("Cases", 600, 400, "", true, false, {literal}{"call_back_function":"set_return","form_name":"EditView","field_to_name_array":{"id":"oa_officeactions_casescases_ida","name":"oa_officeactions_cases_name"}}{/literal}, "single", true); this.form.oa_officeactions_cases_name.focus();\'><img alt="" src="themes/default/images/id-ff-select.png?v=OIXX-lwlUV73favZcB3MQg"></button>

<button type="button" name="btn_clr_oa_officeactions_cases_name" id="btn_clr_oa_officeactions_cases_name" tabindex="103" title="{$APP.LBL_CLEAR_BUTTON_TITLE}" accessKey="{$APP.LBL_CLEAR_BUTTON_KEY}" class="button lastChild" onclick="document.forms[\'EditView\'].oa_officeactions_cases_name.value= \'\';document.forms[\'EditView\'].oa_officeactions_casescases_ida.value = \'\';" value="{$APP.LBL_CLEAR_BUTTON_LABEL}" >
<img src="themes/default/images/id-ff-clear.png?v=OIXX-lwlUV73favZcB3MQg"></button>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != \'undefined\' &amp;&amp; typeof(sqs_objects[\'EditView_oa_officeactions_cases_name\']) != \'undefined\'",
		enableQS
);,
</script>'
          ),
          1 => 
          array (
            'name' => 'duedate',
            'label' => 'LBL_DUEDATE',
          ),
        ),
        2 => 
        array (
          /*0 => 
          array (
             'name' => 'extensionallowed',
            'studio' => 'visible',
            'label' => 'LBL_EXTENSIONALLOWED',
          ),*/
		  
          1 => 
          array (
            'name' => 'amount_owed',            
            'label' => 'LBL_AMOUNT_OWED',
          ),
        ),
        3 => 
        array (
          0 => 'description',          
          1 => 
          array (
            'name' => 'credit_alloc_notes',            
            'label' => 'LBL_ALLOC_NOTES',
          ),
        ),
		//by anuradha : onclick="subcaseDisplay();"
		4 =>
		array(
		  0 =>
		  array(
		      
			  'label' => 'LBL_SUBCASE_NAME',			  			  
			   'customCode' => '<select name="subcase_name" id="subcase_name" onchange="getStatus();" ><option value="">-none-</option>{$EDIT_SUBCASE_NAME}</select>',
		  ),
		  1 => 
          array (            
            'customCode' => '<select name="subcase_status_id" id="subcase_status_id" onchange="populateCurrDate();">{$SUBCASE_STATUS_OPTIONS}</select>',	
            'label' => 'LBL_OFFICEACTIONSTATUS',
          ),
		),

		5 =>
		array(
			  0 =>
			  array(		  
				  'name' => 'sub_case_title',
			  ),
			  1 =>		  
			  array(			  
				  'name' => 'visible_to_client',
			  ),
		),
                6 =>
		array(
			  0 =>
			  array(		  
				  'name' => 'credit_date',
                              'customCode' => '{$CREDIT_DATE}',
			  ),
			  1 =>		  
			  array(			  
				  'customCode' => '<input type="hidden" name="credit_dt_hidden" id="credit_dt_hidden" value={$CREDIT_DATE_HID} />'
			  ),
		),
                7 =>
		array(
			  0 =>
			  array(		  
				  'name' => 'amount_paid',
			  ),
			  1 =>		  
			  array(			  
				'name' => 'qb_date',
                                'customCode' => '{$QB_DATE}',
			  ),
		),
		8 =>
		array(
		  array(		  
			  //'name' => 'subcase_number',
			  //'label' => 'LBL_SUBCASE_NUMBER',
			  'customCode' => '<input type="hidden" name="subcase_number" id="subcase_number" readonly value="{$fields.subcase_number.value}">',
		  ),
		  1 =>		  
		  array(			  
			  
		  ),
		),
		//end
		//by anuradha 23/8/2012
		
//		9 =>
//		array(
//			0 =>
//			array(
//				'name' => 'credit_date',
//			),
//		),

		//end		
      ),
	  //start
'LBL_APPLICATION_EDIT_FILING' =>
	array(
	   array (
		    array (
				'name' => 'filing_date',
				'label' => 'Filing date',
				//'customCode' => '{$FILING_DATE}',				
	   		),
	   ),
	    array (
		    array (
		    	'customCode' => '{$CREDIT_ALLOCATION}<input type = "hidden" name = "cnt_value" id = "cnt_value" value = "{$CNT_VALUE}" />',
	   		),
	   ),
	),
//end
    ),
  ),
);
?>
<script type="text/javascript">
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
    
    //qb_date
    //Rajesh G - 01/09/2012
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
        
    function populateCurrDate(){

            var e = document.getElementById("subcase_status_id");
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
</script>