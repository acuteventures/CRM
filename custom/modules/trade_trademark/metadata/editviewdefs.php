<?php
$module_name = 'trade_trademark';
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
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'trade_trademark_accounts_name',
          ),
        ),
      ),
	  
	  /* 'LBL_PANEL_APPLICANTS' => 
      array (

        array (
          array (
            'name' => '',
           'customCode' => '<input type = "text"  onclick = add(); />',
          ),
		  array (
            'name' => '',
         
          ),
        ),
		
		array (
          array (
            'name' => '',
            'label' => '',
          ),
		  array (
            'name' => '',
            'label' => '',
          ),
        ),
		
      ),*/// END CUSTOM PANEL.
	  
    ),
  ),
);
?>

<script language="javascript">
	/*function add(){
		alert('hello');
	}*/
</script>
