<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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

global $current_user;
$dashletData['MyUpcomingCasesAndSubcaseDeadlineDashlet']['searchFields'] = array('date_entered'     => array('default' => ''),
													   //'priority'         => array('default' => ''),                    
													   'name'             => array('default' => ''),
												       //'type'             => array('default' => ''),
                                                       'date_modified'    => array('default' => ''),
                                                       'assigned_user_id' => array('type'    => 'assigned_user_name',
																				   'label'   => 'LBL_ASSIGNED_TO',
                                                                                   'default' => $current_user->name));
$dashletData['MyUpcomingCasesAndSubcaseDeadlineDashlet']['columns'] = array(
													'parent_case_name' => array('width'    => '10', 
																		  'module' => 'Cases',
																		  'id' => 'PARENT_CASE_ID',
																		  'label'   => 'LBL_PARENT_CASE_NAME',
																		  'link'    => true,
																		  'default' => true,
																		  'related_fields' => array('parent_case_id')
													),
													'parent_subcase_name' => array('width'    => '10', 
																		  'module' => 'oa_officeactions',
																		  'id' => 'PARENT_SUBCASE_ID',
																		  'label'   => 'LBL_PARENT_SUBCASE_NAME',
																		  'link'    => true,
																		  'default' => true,
																		  'related_fields' => array('parent_subcase_id')
													),
												    'case_type_name' => array('width' => '14',
                                                                          //'link' => true,
                                                                          'module' => 'c_case_type',
                                                                          'id' => 'CASE_TYPE_ID',
                                                                          //'ACLTag' => 'type', 
                                                                          'label' => 'LBL_TYPE',
																		  'default' => true,
                                                                          'related_fields' => array('case_type_id')
																		  ),
													'subcase_name' => array('width' => '14',
                                                                          'module' => 'sc_sc_subcasetype',
                                                                          'id' => 'SUB_CASE_TYPE_ID',
                                                                          'label' => 'LBL_SUBCASE_NAME',
																		  'default' => true,
                                                                          'related_fields' => array('sub_case_type_id')
																		  ),
													'invention_name' => array('width' => '14',
                                                                          'link' => true,
                                                                          'module' => 'Inv_Inventions',
                                                                          'id' => 'INVENTION_ID',
                                                                          //'ACLTag' => 'type', 
                                                                          'label' => 'LBL_INVENTION_NAME',
																		  'default' => true,
                                                                          'related_fields' => array('invention_id')
																		  ),
																		  
													'client_consultant_name' => array('width' => '14',
                                                                          'link' => true,
                                                                          'module' => 'Users',
                                                                          'id' => 'CLIENT_CONSULTANT_ID',
                                                                          //'ACLTag' => 'type', 
                                                                          'label' => 'LBL_USER_NAME',
																		  'default' => true,
                                                                          'related_fields' => array('client_consultant_id')
																		  ),					  
													'status_name' => array('width' => '10',
                                                                          'link' => false,
                                                                          'module' => 'c_case_status',
                                                                          'id' => 'STATUS',
                                                                          //'ACLTag' => 'status', 
                                                                          'label' => 'LBL_STATUS',
																		  'default' => true,
                                                                          'related_fields' => array('status')
																		  ),   
													'account_name' => array('width' => '15',
                                                                          'link' => true,
                                                                          'module' => 'Accounts',
                                                                          'id' => 'ACCOUNT_ID',
                                                                          'ACLTag' => 'ACCOUNT', 
                                                                          'label' => 'LBL_ACCOUNT_NAME',
																		  'default' => true,
                                                                          'related_fields' => array('account_id')),  

													'case_subcase_status_age' => array('width'   => '10',
                                                                         'label'   => 'LBL_CASE_SUBCASE_STATUS_AGE',
                                                                         'default' => true), 
													'due_date' => array('width'   => '8',
                                                                         'label'   => 'LBL_DUE_DATE',
                                                                         'default' => true),
                           
                                                  /*'resolution' => array('width' => '8', 
                                                                        'label' => 'LBL_RESOLUTION'),
                                                  'date_entered' => array('width'   => '15', 
                                                                          'label'   => 'LBL_DATE_ENTERED'),
                                                  'date_modified' => array('width'   => '15', 
                                                                           'label'   => 'LBL_DATE_MODIFIED'),  
                                                  'created_by' => array('width'   => '8', 
                                                                        'label'   => 'LBL_CREATED'),
                                                  'assigned_user_name' => array('width'   => '8', 
                                                                                'label'   => 'LBL_LIST_ASSIGNED_USER'),*/
                                                 );
?>
