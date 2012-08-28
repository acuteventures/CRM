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

$viewdefs['Accounts']['DetailView'] = array(
    'templateMeta' => array('form' => array('buttons'=>array('EDIT', 
    'DUPLICATE', 
    'DELETE', 
    'FIND_DUPLICATES',
),
	'footerTpl'=>'custom/modules/Accounts/tpls/DetailViewFooter.tpl'), // Author: Basudeba Rath. Dt.-24-Nov-2011.
	
                            'maxColumns' => '2',
                            'widths' => array(
                                            array('label' => '10', 'field' => '30'), 
                                            array('label' => '10', 'field' => '30')
                                            ),
                            'includes'=> array(
                                            array('file'=>'modules/Accounts/Account.js'),
                                         ),                                      
                           ),    
    'panels' => 
    array (
      'lbl_account_information' => 
      array (
        array (
          array (//by swapna dt:15-03-2012
            'name' => 'last_name',
            'comment' => 'Name of the Company',
            'label' => 'LBL_LAST_NAME',
            'displayParams' => 
              array (
                'enableConnectors' => true,
                'module' => 'Accounts',
                'connectors' => 
                array (
                  0 => 'ext_rest_linkedin',
                ),
            ),          
          ),
       	  array (
            'name' => 'first_name',
            'label' => 'LBL_FIRST_NAME',
          ),
        ),

        array (

          array (
            'name' => 'website',
            'type' => 'link',
            'label' => 'LBL_WEBSITE',
            'displayParams' => 
            array (
              'link_target' => '_blank',
            ),
          ),
		   // Author: Basudeba Rath.
		  // Dt.     22-Nov-2011.
		  array (
            'name' => 'client_source',
            'label' => 'LBL_CLIENT_SOURCE',
          ),
		),

        array (
          array (
            'name' => 'billing_address_street',
            'label' => 'LBL_BILLING_ADDRESS',
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'billing',
            ),
          ),

          array (
            'name' => 'shipping_address_street',
            'label' => 'LBL_SHIPPING_ADDRESS',
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'shipping',
            ),
          ),
        ),

        array (
          array (
            'name' => 'email1',
            'studio' => 'false',
            'label' => 'LBL_EMAIL',
          ),
		  array (
            
			'customCode' => '{$PHONE_NOS}',
            'label' => 'LBL_PHONE_NOS',
          ),
        ),
        array (
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
		  array (
            'name' => 'phone_fax',
            'comment' => 'The fax phone number of this company',
            'label' => 'LBL_FAX',
          ),
		 
		  
		  //-------------------------//
        ),
          #Rajesh G - 24/04/12
        array(
            array(
                'name' => 'id',
                'label' => 'LBL_CLIENT_ID',
                'customCode' => '{$CLIENT_ID}',
                
            ),
            array(),
        ),
          
		
		  // Author: Basudeba Rath.
		  // Dt.     22-Nov-2011.
		  
		array (
			/*array (
				'name' => 'phone_office',
				'comment' => 'The office phone number',
				'label' => 'LBL_PHONE_OFFICE',
			  ),*/	
          /*array (
            'name' => 'note',
			'customCode' => '{$NOTES}',
            'label' => 'LBL_NOTES',
          ),*/
		),
      ),
	   // Author: Phaneendra
	 // Dt.     26-Feb-2012.
	  'LBL_PANEL_PASSWORD' => 
	  array (
	   array (
            'name' => 'password',
            'label' => 'LBL_PASSWORD',
            
          ),
		),
  /*    'LBL_PANEL_ADVANCED' => 
      array (

        array (
          array (
            'name' => 'account_type',
            'comment' => 'The Company is of this type',
            'label' => 'LBL_TYPE',
          ),
          array (
            'name' => 'industry',
            'comment' => 'The company belongs in this industry',
            'label' => 'LBL_INDUSTRY',
          ),
        ),

        array (
          array (
            'name' => 'annual_revenue',
            'comment' => 'Annual revenue for this company',
            'label' => 'LBL_ANNUAL_REVENUE',
          ),
          array (
            'name' => 'employees',
            'comment' => 'Number of employees, varchar to accomodate for both number (100) or range (50-100)',
            'label' => 'LBL_EMPLOYEES',
          ),
        ),

        array (
          array (
            'name' => 'sic_code',
            'comment' => 'SIC code of the account',
            'label' => 'LBL_SIC_CODE',
          ),
          array (
            'name' => 'ticker_symbol',
            'comment' => 'The stock trading (ticker) symbol for the company',
            'label' => 'LBL_TICKER_SYMBOL',
          ),
        ),

        array (
          array (
            'name' => 'parent_name',
            'label' => 'LBL_MEMBER_OF',
          ),
          array (
            'name' => 'ownership',
            'comment' => '',
            'label' => 'LBL_OWNERSHIP',
          ),
        ),

        array (
          'campaign_name',
        
          array (
            'name' => 'rating',
            'comment' => 'An arbitrary rating for this company for use in comparisons with others',
            'label' => 'LBL_RATING',
          ),
        ),
      ),*/
      'LBL_PANEL_ASSIGNMENT' => 
      array (
        array (
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
          array (
            'name' => 'date_modified',
            'label' => 'LBL_DATE_MODIFIED',
            'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
          ),
        ),
        array (
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
          ),
        ),
      ),
	  
	  //Ashok 02012011
	    'LBL_PANEL_CLIENT_RECORD_DISPLAY' =>    
	     array (
             array (
                array (
				    'customCode' => '{$CLIENT_RECORD_DISPLAY}',
				),
			),
		),
		//Phaneendra 03052011
	    'LBL_PANEL_TRADEMARK_RECORD_DISPLAY' =>    
	     array (
             array (
                array (
				    'customCode' => '{$CLIENT_TRADEMARK_RECORD_DISPLAY}',
				),
			),
		),
		
// Basudeba, Date : 14-mar-2012.		
		 'LBL_PANEL_OTHERS_DISPLAY' =>    
	     array (
             array (
                array (
				    'customCode' => '{$CLIENT_OTHERS_RECORD_DISPLAY}',
				),
			),
		),
		
    )
);
?>