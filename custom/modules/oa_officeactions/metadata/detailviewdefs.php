<?php
$module_name = 'oa_officeactions';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
		  4 => 
          array (
            'customCode' => '{$WORKFLOW_BUTTONS}',
          ),
		   5 => 
          array (
            'customCode' => '<input type = "hidden" value = "{$USER_ID}" id = "user_id" name = "user_id"><input type = "hidden" value = "{$BEAN_ID}" id = "record_id" name = "record_id" ><input type="hidden" value="{$SUBCASE_NUMBER}" id="subcase_number" name="subcase_number" >',
          ),
        ),
		'footerTpl' => 'custom/modules/oa_officeactions/tpls/DetailViewFooter.tpl',
      ),
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
          0 => 'name',
         // 1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'duedate',
            'label' => 'LBL_DUEDATE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'oa_officeactions_cases_name',
          ),
          1 => 
          array (
            'name' => 'subcase_name',
		    'label' => 'LBL_SUBCASE_NAME',
			'customCode' => '{$SUBCASE_NAME}',
          ),
        ),
        3 => 
        array (
          /*0 => 
          array (
            'name' => 'extensionallowed',
            'studio' => 'visible',
            'label' => 'LBL_EXTENSIONALLOWED',
          ),*/
          0 => 
          array (
            'name' => 'subcase_status_id',
            'label' => 'LBL_OFFICEACTIONSTATUS',
 		    'customCode' => '{$SUBCASE_STATUS_NAME}',
          ),
 
	  1 => 
          array (
            'label' => 'LBL_PARENT_CASE_CONSULTANT',
            'customCode' => '{$PARENT_CASE_CONSULTANT}',
          ),

        ),
		4 =>
		array(
			0 =>
			array(
			  'name' => 'amount_owed',
			  'label' => 'LBL_AMOUNT_OWED',
			),
			1 =>
			array(
			 'name' => 'credit_alloc_notes',
			 'label' => 'LBL_ALLOC_NOTES',
			),
		),
		5 =>
		array(
		 0 =>
		 array(
		  'name' => 'case_start_date',
		  'label' => 'LBL_CASE_START_DATE',
		 ),
		 1 =>
		 array(
		  'name' => 'case_end_date',
		  'label' => 'LBL_CASE_END_DATE',
		  'customCode' => '{$fields.case_end_date.value} {$APP.LBL_BY} {$fields.case_end_user_name.value}', //* preethi on 01-09-2012
		 ),
		),
		//start
		6 =>
		array(
		0 =>
		 array(
		  'name' => 'filing_date',
		  'label' => 'LBL_FILING_DATE',
		 ),
		 1 =>//by swapna dt:-15-03-2012
		 array(
		  'name' => 'subcase_status_age',
		  'label' => 'LBL_SUBCASE_STATUS_AGE',
		 ),

		),
		//end

// Added By Basudeba Rath, Date : 11-May-2012.

		7 =>
		array(
		0 =>
		 array(
		  'name' => 'sub_case_title',
		 
		 ),
		 1 =>//by swapna dt:-15-03-2012
		 array(
		  'name' => 'visible_to_client',
		 
		 ),

		),
		//end
		
		// Added By Anuradha, Date : 11-July-2012.
		8 =>
		array(
		0 =>
		 array(
		  'label' => 'LBL_CLIENT_NAME',
		  'customCode' => '{$CLIENT_NAME}',
		 ),
		 1 =>
		 array(
		   'name' => 'credit_date',
		 
		 ),

		),
		//end
		//by anuradha 23/8/2012
		9 =>
		array(
			  0 =>
			  array(		  
				  'name' => 'amount_paid',
			  ),
			  1 =>		  
			  array(			  
				  'name' => 'qb_date',
			  ),
		),
		//end
        10 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
            'label' => 'LBL_DATE_ENTERED',
          ),
          1 => 
          array (
            'name' => 'date_modified',
            'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
            'label' => 'LBL_DATE_MODIFIED',
          ),
        ),

// Author : Basudeba Rath, Date : 22-Jun-2012.
	11 => 
        array (
		array (
			'name' => 'modified_status',
			'customCode' => '{$fields.modified_status.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
            
            	),	
	),
      ),
    ),
  ),
);
?>
<script src="custom/modules/oa_officeactions/WorkFlows.js" type="text/javascript" >
</script>
