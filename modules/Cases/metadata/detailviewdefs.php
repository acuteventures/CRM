<?php
$viewdefs ['Cases'] = 
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
            'customCode' => '<input type = "hidden" value = "{$USER_ID}" id = "user_id" name = "user_id"><input type = "hidden" value = "{$BEAN_ID}" id = "record_id" name = "record_id" >',
          ),
        ),
        'footerTpl' => 'custom/modules/Cases/tpls/DetailViewFooter.tpl',
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
    ),
    'panels' => 
    array (
      'lbl_case_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'case_number',
            'label' => 'LBL_CASE_NUMBER',
          ),
          1 => 'priority',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'status',
            'customCode' => '{$STATUS}',
          ),
          1 => 
          array (
            'name' => 'case_status_age',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'type',
            'customCode' => '{$TYPE}',
          ),
          1 => 
          array (
            'name' => 'account_name',
          ),
        ),
        3 => 
        array (
          0=>
	  array(
	  	'name' => 'relatedtoparent',
	  ),
          1 => 
          array (
            'name' => 'search_type',
            'label' => 'LBL_SEARCH_TYPE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'due_date',
          ),
            1 => 
             array(),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'trade_trademark_cases_name',
            'label' => 'LBL_TRADE_TRADEMARK_CASES_FROM_TRADE_TRADEMARK_TITLE',
          ),
	 1 => 
          array (
            'name' => 'invention_name',
          ),
		  
        ),
	6=>
		array (
          0 => 
          array (
            'name' => 'case_start_date',
            
          ),
		  1=>
		  array(
		  	'name' => 'case_end_date',
		  ),
        ),
		7=>
		array (
          0 => 
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
          ),
		  1=>
		  array (
            'name' => 'date_modified',
            'label' => 'LBL_DATE_MODIFIED',
            'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
          ),
        ),
		 
      ),
      'LBL_PANEL_ASSIGNMENT' => 
	  	array(
			array (
			  0 => 
			  array (
				'name' => 'amount_owed',
			  ),
			  1 => 
			  array (
				'name' => 'assigned_to',
			  ),
		  ),
        ),
    ),
  ),
);
?>
