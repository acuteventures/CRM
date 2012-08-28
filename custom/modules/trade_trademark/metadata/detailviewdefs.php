<?php
$module_name = 'trade_trademark';
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
        ),
		'footerTpl'=>'custom/modules/trade_trademark/tpls/DetailViewFooter.tpl', // Author: Basudeba Rath. Dt.19-Jan-2012.
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
        2 => 
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
      ),
	 
	 'LINEITEMS_PANEL' => 
      array (
	  	
		0 =>
		array(
			0 =>
			array(
				'customCode' => '{$LINEITEMS_ROWS}',
			), 
		),	
			
	  ),
	  
    ),
  ),
);
?>
