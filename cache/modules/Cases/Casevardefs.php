<?php 
 $GLOBALS["dictionary"]["Case"]=array (
  'table' => 'cases',
  'audited' => true,
  'unified_search' => true,
  'unified_search_default_enabled' => true,
  'duplicate_merge' => true,
  'comment' => 'Cases are issues or problems that a customer asks a support representative to resolve',
  'fields' => 
  array (
    'id' => 
    array (
      'name' => 'id',
      'vname' => 'LBL_ID',
      'type' => 'id',
      'required' => true,
      'reportable' => true,
      'comment' => 'Unique identifier',
    ),
    'name' => 
    array (
      'name' => 'name',
      'vname' => 'LBL_SUBJECT',
      'type' => 'name',
      'link' => true,
      'dbType' => 'varchar',
      'len' => 255,
      'audited' => true,
      'unified_search' => true,
      'comment' => 'The short description of the bug',
      'merge_filter' => 'selected',
      'required' => true,
      'importable' => 'required',
    ),
    'date_entered' => 
    array (
      'name' => 'date_entered',
      'vname' => 'LBL_DATE_ENTERED',
      'type' => 'datetime',
      'group' => 'created_by_name',
      'comment' => 'Date record created',
      'enable_range_search' => true,
      'options' => 'date_range_search_dom',
    ),
    'date_modified' => 
    array (
      'name' => 'date_modified',
      'vname' => 'LBL_DATE_MODIFIED',
      'type' => 'datetime',
      'group' => 'modified_by_name',
      'comment' => 'Date record last modified',
      'enable_range_search' => true,
      'options' => 'date_range_search_dom',
    ),
    'modified_user_id' => 
    array (
      'name' => 'modified_user_id',
      'rname' => 'user_name',
      'id_name' => 'modified_user_id',
      'vname' => 'LBL_MODIFIED',
      'type' => 'assigned_user_name',
      'table' => 'users',
      'isnull' => 'false',
      'group' => 'modified_by_name',
      'dbType' => 'id',
      'reportable' => true,
      'comment' => 'User who last modified record',
    ),
    'modified_by_name' => 
    array (
      'name' => 'modified_by_name',
      'vname' => 'LBL_MODIFIED_NAME',
      'type' => 'relate',
      'reportable' => false,
      'source' => 'non-db',
      'rname' => 'user_name',
      'table' => 'users',
      'id_name' => 'modified_user_id',
      'module' => 'Users',
      'link' => 'modified_user_link',
      'duplicate_merge' => 'disabled',
    ),
    'created_by' => 
    array (
      'name' => 'created_by',
      'rname' => 'user_name',
      'id_name' => 'modified_user_id',
      'vname' => 'LBL_CREATED',
      'type' => 'assigned_user_name',
      'table' => 'users',
      'isnull' => 'false',
      'dbType' => 'id',
      'group' => 'created_by_name',
      'comment' => 'User who created record',
    ),
    'created_by_name' => 
    array (
      'name' => 'created_by_name',
      'vname' => 'LBL_CREATED',
      'type' => 'relate',
      'reportable' => false,
      'link' => 'created_by_link',
      'rname' => 'user_name',
      'source' => 'non-db',
      'table' => 'users',
      'id_name' => 'created_by',
      'module' => 'Users',
      'duplicate_merge' => 'disabled',
      'importable' => 'false',
    ),
    'description' => 
    array (
      'name' => 'description',
      'vname' => 'LBL_DESCRIPTION',
      'type' => 'text',
      'comment' => 'Full text of the note',
      'rows' => 6,
      'cols' => 80,
    ),
    'deleted' => 
    array (
      'name' => 'deleted',
      'vname' => 'LBL_DELETED',
      'type' => 'bool',
      'default' => '0',
      'reportable' => false,
      'comment' => 'Record deletion indicator',
    ),
    'created_by_link' => 
    array (
      'name' => 'created_by_link',
      'type' => 'link',
      'relationship' => 'cases_created_by',
      'vname' => 'LBL_CREATED_USER',
      'link_type' => 'one',
      'module' => 'Users',
      'bean_name' => 'User',
      'source' => 'non-db',
    ),
    'modified_user_link' => 
    array (
      'name' => 'modified_user_link',
      'type' => 'link',
      'relationship' => 'cases_modified_user',
      'vname' => 'LBL_MODIFIED_USER',
      'link_type' => 'one',
      'module' => 'Users',
      'bean_name' => 'User',
      'source' => 'non-db',
    ),
    'assigned_user_id' => 
    array (
      'name' => 'assigned_user_id',
      'rname' => 'user_name',
      'id_name' => 'assigned_user_id',
      'vname' => 'LBL_ASSIGNED_TO_ID',
      'group' => 'assigned_user_name',
      'type' => 'relate',
      'table' => 'users',
      'module' => 'Users',
      'reportable' => true,
      'isnull' => 'false',
      'dbType' => 'id',
      'audited' => true,
      'comment' => 'User ID assigned to record',
      'duplicate_merge' => 'disabled',
    ),
    'assigned_user_name' => 
    array (
      'name' => 'assigned_user_name',
      'link' => 'assigned_user_link',
      'vname' => 'LBL_ASSIGNED_TO_NAME',
      'rname' => 'user_name',
      'type' => 'relate',
      'reportable' => false,
      'source' => 'non-db',
      'table' => 'users',
      'id_name' => 'assigned_user_id',
      'module' => 'Users',
      'duplicate_merge' => 'disabled',
    ),
    'assigned_user_link' => 
    array (
      'name' => 'assigned_user_link',
      'type' => 'link',
      'relationship' => 'cases_assigned_user',
      'vname' => 'LBL_ASSIGNED_TO_USER',
      'link_type' => 'one',
      'module' => 'Users',
      'bean_name' => 'User',
      'source' => 'non-db',
      'duplicate_merge' => 'enabled',
      'rname' => 'user_name',
      'id_name' => 'assigned_user_id',
      'table' => 'users',
    ),
    'case_number' => 
    array (
      'name' => 'case_number',
      'vname' => 'LBL_NUMBER',
      'type' => 'varchar',
      'len' => 255,
      'required' => true,
      'audited' => true,
      'auto_increment' => false,
      'comment' => 'Visual unique identifier',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),
    'type' => 
    array (
      'name' => 'type',
      'vname' => 'LBL_TYPE',
      'type' => 'char',
      'len' => 36,
      'comment' => 'The type of issue (ex: issue, feature)',
      'required' => true,
      'merge_filter' => 'enabled',
    ),
    'status' => 
    array (
      'name' => 'status',
      'vname' => 'LBL_STATUS',
      'type' => 'char',
      'len' => 36,
      'audited' => true,
      'comment' => 'The status id of the case status',
      'required' => false,
      'merge_filter' => 'enabled',
    ),
    'priority' => 
    array (
      'name' => 'priority',
      'vname' => 'LBL_PRIORITY',
      'type' => 'enum',
      'options' => 'case_priority_dom',
      'len' => 100,
      'audited' => true,
      'comment' => 'The priority of the case',
    ),
    'resolution' => 
    array (
      'name' => 'resolution',
      'vname' => 'LBL_RESOLUTION',
      'type' => 'text',
      'comment' => 'The resolution of the case',
    ),
    'work_log' => 
    array (
      'name' => 'work_log',
      'vname' => 'LBL_WORK_LOG',
      'type' => 'text',
      'comment' => 'Free-form text used to denote activities of interest',
    ),
    'modified_status' => 
    array (
      'name' => 'modified_status',
      'vname' => 'LBL_MODIFIED_STATUS',
      'type' => 'datetime',
      'comment' => 'case Status last modified date',
    ),
    'case_type_title' => 
    array (
      'name' => 'case_type_title',
      'vname' => 'LBL_CASE_TYPE_TITLE',
      'type' => 'varchar',
      'len' => 255,
      'required' => false,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),
    'user_name' => 
    array (
      'name' => 'user_name',
      'rname' => 'name',
      'id_name' => 'client_consultant_id',
      'vname' => 'LBL_USER_NAME',
      'type' => 'relate',
      'link' => 'usercs',
      'table' => 'users',
      'join_name' => 'users',
      'isnull' => 'true',
      'module' => 'Users',
      'dbType' => 'varchar',
      'len' => 100,
      'source' => 'non-db',
      'unified_search' => true,
      'comment' => 'The name of the Users represented by the client_consultant field',
      'required' => true,
      'importable' => 'required',
    ),
    'patent_number' => 
    array (
      'name' => 'patent_number',
      'vname' => 'LBL_PATENT_NUMBER',
      'type' => 'varchar',
      'len' => 255,
      'required' => false,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),
    'client_consultant_id' => 
    array (
      'required' => false,
      'name' => 'client_consultant_id',
      'vname' => 'LBL_CLIENT_CONSULTANT_ID',
      'type' => 'char',
      'massupdate' => 0,
      'comments' => 'Parent clients assigned user id',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'len' => 36,
      'size' => '36',
    ),
    'client_consultant_name' => 
    array (
      'name' => 'client_consultant_name',
      'rname' => 'name',
      'id_name' => 'client_consultant_id',
      'vname' => 'LBL_CLIENT_CONSULTANT_NAME',
      'type' => 'relate',
      'link' => 'Users',
      'table' => 'users',
      'isnull' => 'true',
      'module' => 'Users',
      'dbType' => 'varchar',
      'len' => 100,
      'source' => 'non-db',
      'unified_search' => true,
      'comment' => 'The name of the assigned user id of client represented by the client_consultant_id field',
      'required' => false,
      'importable' => 'required',
    ),
    'amount_owed' => 
    array (
      'required' => false,
      'name' => 'amount_owed',
      'vname' => 'LBL_AMOUNT_OWED',
      'type' => 'decimal',
      'massupdate' => 0,
      'default' => '0.00',
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => true,
      'reportable' => true,
      'len' => '25',
      'size' => '25',
      'precision' => '2',
    ),
    'case_start_date' => 
    array (
      'name' => 'case_start_date',
      'vname' => 'LBL_CASE_START_DATE',
      'type' => 'datetime',
      'comment' => 'case record started',
    ),
    'case_end_date' => 
    array (
      'name' => 'case_end_date',
      'vname' => 'LBL_CASE_END_DATE',
      'type' => 'datetime',
      'comment' => 'case record completion date',
    ),
    'prioritydate' => 
    array (
      'name' => 'prioritydate',
      'vname' => 'LBL_PRIORITYDATE',
      'type' => 'date',
      'default' => '',
      'comment' => 'case record Priority Date',
    ),
    'patent_publication_number' => 
    array (
      'name' => 'patent_publication_number',
      'vname' => 'LBL_PATENT_PUBLICATION_NUMBER',
      'type' => 'int',
      'required' => true,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),
    'patent_issued_number' => 
    array (
      'name' => 'patent_issued_number',
      'vname' => 'LBL_PATENT_ISSUED_NUMBER',
      'type' => 'varchar',
      'len' => 255,
      'required' => true,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),
    'tm_filing_date' => 
    array (
      'name' => 'tm_filing_date',
      'vname' => 'LBL_TM_FILING_DATE',
      'type' => 'date',
      'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => 0,
      'reportable' => 0,
    ),
    'tm_application_number' => 
    array (
      'name' => 'tm_application_number',
      'vname' => 'LBL_TM_APPLICATION_NUMBER',
      'type' => 'varchar',
      'len' => 255,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),
    'tm_registration_date' => 
    array (
      'name' => 'tm_registration_date',
      'vname' => 'LBL_TM_REGISTRATION_DATE',
      'type' => 'date',
      'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => 0,
      'reportable' => 0,
    ),
    'tm_registration_number' => 
    array (
      'name' => 'tm_registration_number',
      'vname' => 'LBL_TM_REGISTRATION_NUMBER',
      'type' => 'varchar',
      'len' => 255,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),
    'tm_classes' => 
    array (
      'required' => false,
      'name' => 'tm_classes',
      'vname' => 'LBL_TM_CLASSES',
      'type' => 'multienum',
      'massupdate' => '0',
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => true,
      'reportable' => true,
      'size' => '20',
      'options' => 'tm_classes_list',
      'studio' => 'visible',
      'isMultiSelect' => true,
    ),
    'case_status_age' => 
    array (
      'name' => 'case_status_age',
      'vname' => 'LBL_CASE_STATUS_AGE',
      'type' => 'int',
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'default' => 0,
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),
    'spec_writing_call' => 
    array (
      'required' => false,
      'name' => 'spec_writing_call',
      'vname' => 'LBL_SPEC_WRITING_CALL',
      'type' => 'varchar',
      'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'len' => 255,
      'size' => '20',
      'studio' => 'visible',
      'dependency' => false,
    ),
    'patent_drawing_fee' => 
    array (
      'required' => false,
      'name' => 'patent_drawing_fee',
      'vname' => 'LBL_PATENT_DRAWING_FEE',
      'type' => 'varchar',
      'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'len' => 255,
      'size' => '20',
      'studio' => 'visible',
      'dependency' => false,
    ),
    'caseoverride' => 
    array (
      'name' => 'caseoverride',
      'vname' => 'LBL_CASEOVER',
      'type' => 'bool',
      'default' => '0',
      'massupdate' => false,
      'comment' => 'custom field checkbox',
    ),
    'casetype' => 
    array (
      'name' => 'casetype',
      'rname' => 'name',
      'id_name' => 'type',
      'vname' => 'LBL_CASE_TYPE',
      'type' => 'relate',
      'link' => 'case',
      'table' => 'c_case_type',
      'join_name' => 'c_case_type',
      'isnull' => 'true',
      'audited' => true,
      'module' => 'c_case_type',
      'dbType' => 'varchar',
      'len' => 100,
      'source' => 'non-db',
      'unified_search' => true,
      'comment' => 'The name of the invention represented by the type field',
      'required' => true,
      'importable' => 'required',
    ),
    'type_name' => 
    array (
      'name' => 'type_name',
      'rname' => 'name',
      'id_name' => 'type',
      'vname' => 'LBL_TYPE',
      'type' => 'relate',
      'link' => 'c_case_type',
      'table' => 'c_case_type',
      'join_name' => 'c_case_type',
      'isnull' => 'true',
      'module' => 'c_case_type',
      'dbType' => 'varchar',
      'len' => 100,
      'source' => 'non-db',
      'unified_search' => true,
      'comment' => 'The name of the case type represented by the type field',
      'required' => true,
      'importable' => 'required',
    ),
    'status_name' => 
    array (
      'name' => 'status_name',
      'rname' => 'name',
      'id_name' => 'status',
      'vname' => 'LBL_STATUS',
      'type' => 'relate',
      'link' => 'c_case_status',
      'table' => 'c_case_status',
      'join_name' => 'c_case_status',
      'isnull' => 'true',
      'module' => 'c_case_status',
      'dbType' => 'varchar',
      'len' => 100,
      'source' => 'non-db',
      'unified_search' => true,
      'comment' => 'The name of the case status represented by the status field',
      'required' => true,
      'importable' => 'required',
    ),
    'casestatus' => 
    array (
      'name' => 'casestatus',
      'rname' => 'name',
      'id_name' => 'status',
      'vname' => 'LBL_STATUS',
      'type' => 'relate',
      'link' => 'casest',
      'table' => 'c_case_status',
      'join_name' => 'c_case_status',
      'isnull' => 'true',
      'module' => 'c_case_status',
      'dbType' => 'varchar',
      'len' => 100,
      'source' => 'non-db',
      'unified_search' => true,
      'comment' => 'The name of the case status represented by the status field',
      'required' => true,
      'importable' => 'required',
    ),
    'invention' => 
    array (
      'name' => 'invention',
      'rname' => 'name',
      'id_name' => 'invention_id',
      'vname' => 'LBL_INVENTION_NAME',
      'type' => 'relate',
      'link' => 'inventions',
      'table' => 'inv_inventions',
      'join_name' => 'inv_inventions',
      'isnull' => 'true',
      'module' => 'Inv_Inventions',
      'dbType' => 'varchar',
      'len' => 100,
      'source' => 'non-db',
      'unified_search' => true,
      'comment' => 'The name of the invention represented by the invention_id field',
      'required' => true,
      'importable' => 'required',
    ),
    'invention_id' => 
    array (
      'required' => false,
      'name' => 'invention_id',
      'vname' => 'LBL_INVENTION_NAME',
      'type' => 'char',
      'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => true,
      'reportable' => true,
      'len' => 36,
      'size' => '36',
    ),
    'invention_name' => 
    array (
      'name' => 'invention_name',
      'rname' => 'name',
      'id_name' => 'invention_id',
      'vname' => 'LBL_INVENTION_NAME',
      'type' => 'relate',
      'link' => 'inv_inventions',
      'table' => 'inv_inventions',
      'join_name' => 'Inv_Inventions',
      'isnull' => 'true',
      'module' => 'Inv_Inventions',
      'dbType' => 'varchar',
      'len' => 100,
      'source' => 'non-db',
      'unified_search' => true,
      'comment' => 'The name of the case type represented by the type field',
      'required' => false,
      'importable' => 'required',
    ),
    'search_type' => 
    array (
      'name' => 'search_type',
      'vname' => 'LBL_SEARCH_TYPE',
      'type' => 'enum',
      'options' => 'case_search_type_dom',
      'len' => 100,
      'comment' => 'addtinal dropdown field for Search-Patent',
      'required' => false,
      'merge_filter' => 'enabled',
    ),
    'due_date' => 
    array (
      'name' => 'due_date',
      'vname' => 'LBL_DUE_DATE',
      'type' => 'date',
      'required' => false,
      'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => 0,
      'reportable' => 0,
      'display_default' => '',
    ),
    'filing_date' => 
    array (
      'name' => 'filing_date',
      'vname' => 'LBL_FILING_DATE',
      'type' => 'date',
      'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => 0,
      'reportable' => 0,
    ),
    'application_number' => 
    array (
      'name' => 'application_number',
      'vname' => 'LBL_APPLICATION_NUMBER',
      'type' => 'varchar',
      'len' => 255,
      'auto_increment' => false,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),
    'freceipt' => 
    array (
      'name' => 'freceipt',
      'vname' => 'LBL_FILING_RECEIPT',
      'type' => 'int',
      'required' => false,
      'unified_search' => true,
      'comment' => '',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
    ),
    'assigned_to' => 
    array (
      'required' => false,
      'name' => 'assigned_to',
      'vname' => 'LBL_ASSIGNED_TO',
      'type' => 'multienum',
      'function' => 
      array (
        'name' => 'getUserList',
      ),
      'massupdate' => '0',
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => true,
      'reportable' => true,
      'size' => '20',
      'studio' => 'visible',
      'isMultiSelect' => true,
    ),
    'credit_date' => 
    array (
      'name' => 'credit_date',
      'vname' => 'LBL_CREDIT_DATE',
      'type' => 'date',
      'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'size' => '20',
      'enable_range_search' => false,
    ),
    'credit_alloc_notes' => 
    array (
      'name' => 'credit_alloc_notes',
      'vname' => 'LBL_ALLOC_NOTES',
      'type' => 'text',
      'comment' => 'For credit allcoation notes of the case',
    ),
    'account_name' => 
    array (
      'name' => 'account_name',
      'rname' => 'name',
      'id_name' => 'account_id',
      'vname' => 'LBL_ACCOUNT_NAME',
      'type' => 'relate',
      'link' => 'accounts',
      'table' => 'accounts',
      'join_name' => 'accounts',
      'isnull' => 'true',
      'module' => 'Accounts',
      'dbType' => 'varchar',
      'len' => 100,
      'source' => 'non-db',
      'unified_search' => true,
      'comment' => 'The name of the account represented by the account_id field',
      'required' => true,
      'importable' => 'required',
    ),
    'account_name1' => 
    array (
      'name' => 'account_name1',
      'source' => 'non-db',
      'type' => 'text',
      'len' => 100,
      'importable' => 'false',
    ),
    'account_id' => 
    array (
      'name' => 'account_id',
      'type' => 'relate',
      'dbType' => 'id',
      'rname' => 'id',
      'module' => 'Accounts',
      'id_name' => 'account_id',
      'reportable' => false,
      'vname' => 'LBL_ACCOUNT_ID',
      'audited' => true,
      'massupdate' => false,
      'comment' => 'The account to which the case is associated',
    ),
    'tasks' => 
    array (
      'name' => 'tasks',
      'type' => 'link',
      'relationship' => 'case_tasks',
      'source' => 'non-db',
      'vname' => 'LBL_TASKS',
    ),
    'notes' => 
    array (
      'name' => 'notes',
      'type' => 'link',
      'relationship' => 'case_notes',
      'source' => 'non-db',
      'vname' => 'LBL_NOTES',
    ),
    'meetings' => 
    array (
      'name' => 'meetings',
      'type' => 'link',
      'relationship' => 'case_meetings',
      'bean_name' => 'Meeting',
      'source' => 'non-db',
      'vname' => 'LBL_MEETINGS',
    ),
    'emails' => 
    array (
      'name' => 'emails',
      'type' => 'link',
      'relationship' => 'emails_cases_rel',
      'source' => 'non-db',
      'vname' => 'LBL_EMAILS',
    ),
    'documents' => 
    array (
      'name' => 'documents',
      'type' => 'link',
      'relationship' => 'documents_cases',
      'source' => 'non-db',
      'vname' => 'LBL_DOCUMENTS_SUBPANEL_TITLE',
    ),
    'calls' => 
    array (
      'name' => 'calls',
      'type' => 'link',
      'relationship' => 'case_calls',
      'source' => 'non-db',
      'vname' => 'LBL_CALLS',
    ),
    'bugs' => 
    array (
      'name' => 'bugs',
      'type' => 'link',
      'relationship' => 'cases_bugs',
      'source' => 'non-db',
      'vname' => 'LBL_BUGS',
    ),
    'contacts' => 
    array (
      'name' => 'contacts',
      'type' => 'link',
      'relationship' => 'contacts_cases',
      'source' => 'non-db',
      'vname' => 'LBL_CONTACTS',
    ),
    'relatedtoparent' => 
    array (
      'name' => 'relatedtoparent',
      'vname' => 'LBL_RELATED_TO_PARENT',
      'type' => 'enum',
      'options' => 'relatedtoparent_list',
      'len' => 100,
      'comment' => 'addtinal dropdown field for relatedtoparent',
      'merge_filter' => 'enabled',
    ),
    'inventions' => 
    array (
      'name' => 'inventions',
      'type' => 'link',
      'relationship' => 'invention_cases',
      'link_type' => 'one',
      'side' => 'right',
      'source' => 'non-db',
      'vname' => 'LBL_INVENTION',
    ),
    'case' => 
    array (
      'name' => 'case',
      'type' => 'link',
      'relationship' => 'ccasetype_cases',
      'link_type' => 'one',
      'side' => 'right',
      'source' => 'non-db',
      'vname' => 'LBL_CASE',
    ),
    'casest' => 
    array (
      'name' => 'casest',
      'type' => 'link',
      'relationship' => 'ccasestatus_cases',
      'link_type' => 'one',
      'side' => 'right',
      'source' => 'non-db',
      'vname' => 'LBL_CASE',
    ),
    'usercs' => 
    array (
      'name' => 'usercs',
      'type' => 'link',
      'relationship' => 'parent_consultant',
      'link_type' => 'one',
      'side' => 'right',
      'source' => 'non-db',
      'vname' => 'LBL_CASE',
    ),
    'accounts' => 
    array (
      'name' => 'accounts',
      'type' => 'link',
      'relationship' => 'account_cases',
      'link_type' => 'one',
      'side' => 'right',
      'source' => 'non-db',
      'vname' => 'LBL_ACCOUNT',
    ),
    'project' => 
    array (
      'name' => 'project',
      'type' => 'link',
      'relationship' => 'projects_cases',
      'source' => 'non-db',
      'vname' => 'LBL_PROJECTS',
    ),
    'case_origin' => 
    array (
      'required' => false,
      'name' => 'case_origin',
      'vname' => 'LBL_CASE_ORIGIN',
      'type' => 'varchar',
      'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'len' => '45',
      'size' => '45',
    ),
    'amount_paid' => 
    array (
      'required' => false,
      'name' => 'amount_paid',
      'vname' => 'LBL_AMOUNT_PAID',
      'type' => 'decimal',
      'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'len' => '25',
      'size' => '25',
      'precision' => '2',
    ),
    'qb_date' => 
    array (
      'required' => false,
      'name' => 'qb_date',
      'vname' => 'LBL_QB_DATE',
      'type' => 'date',
      'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'len' => '100',
      'size' => '100',
    ),
    'date_case_status_modified' => 
    array (
      'name' => 'date_case_status_modified',
      'vname' => 'LBL_DATE_CASE_STATUS_MODIFIED',
      'type' => 'datetime',
    ),
    'case_end_user_id' => 
    array (
      'required' => false,
      'name' => 'case_end_user_id',
      'vname' => 'LBL_CASE_END_USER_ID',
      'type' => 'char',
      'massupdate' => 0,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'len' => 36,
      'size' => '36',
    ),
    'case_end_user_name' => 
    array (
      'name' => 'case_end_user_name',
      'rname' => 'name',
      'id_name' => 'case_end_user_id',
      'vname' => 'LBL_CASE_END_USER_NAME',
      'type' => 'relate',
      'link' => 'Users',
      'table' => 'users',
      'isnull' => 'true',
      'module' => 'Users',
      'dbType' => 'varchar',
      'len' => 100,
      'source' => 'non-db',
      'unified_search' => true,
      'comment' => '',
      'required' => false,
      'importable' => 'required',
    ),
    'oa_officeactions_cases' => 
    array (
      'name' => 'oa_officeactions_cases',
      'type' => 'link',
      'relationship' => 'oa_officeactions_cases',
      'source' => 'non-db',
      'side' => 'right',
      'vname' => 'LBL_OA_OFFICEACTIONS_CASES_FROM_OA_OFFICEACTIONS_TITLE',
    ),
    'trade_trademark_cases' => 
    array (
      'name' => 'trade_trademark_cases',
      'type' => 'link',
      'relationship' => 'trade_trademark_cases',
      'source' => 'non-db',
      'vname' => 'LBL_TRADE_TRADEMARK_CASES_FROM_TRADE_TRADEMARK_TITLE',
      'id_name' => 'trade_trademark_casestrade_trademark_ida',
    ),
    'trade_trademark_cases_name' => 
    array (
      'name' => 'trade_trademark_cases_name',
      'type' => 'relate',
      'source' => 'non-db',
      'vname' => 'LBL_TRADE_TRADEMARK_CASES_FROM_TRADE_TRADEMARK_TITLE',
      'save' => true,
      'id_name' => 'trade_trademark_casestrade_trademark_ida',
      'link' => 'trade_trademark_cases',
      'table' => 'trade_trademark',
      'module' => 'trade_trademark',
      'rname' => 'name',
    ),
    'trade_trademark_casestrade_trademark_ida' => 
    array (
      'name' => 'trade_trademark_casestrade_trademark_ida',
      'type' => 'link',
      'relationship' => 'trade_trademark_cases',
      'source' => 'non-db',
      'reportable' => false,
      'side' => 'right',
      'vname' => 'LBL_TRADE_TRADEMARK_CASES_FROM_CASES_TITLE',
    ),
  ),
  'indices' => 
  array (
    'id' => 
    array (
      'name' => 'casespk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    'number' => 
    array (
      'name' => 'casesnumk',
      'type' => 'unique',
      'fields' => 
      array (
        0 => 'case_number',
      ),
    ),
    0 => 
    array (
      'name' => 'case_number',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'case_number',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_case_name',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'name',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_account_id',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'account_id',
      ),
    ),
    3 => 
    array (
      'name' => 'idx_cases_stat_del',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'assigned_user_id',
        1 => 'status',
        2 => 'deleted',
      ),
    ),
  ),
  'relationships' => 
  array (
    'cases_modified_user' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'modified_user_id',
      'relationship_type' => 'one-to-many',
    ),
    'cases_created_by' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'created_by',
      'relationship_type' => 'one-to-many',
    ),
    'cases_assigned_user' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'assigned_user_id',
      'relationship_type' => 'one-to-many',
    ),
    'case_calls' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'Calls',
      'rhs_table' => 'calls',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'Cases',
    ),
    'case_tasks' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'Tasks',
      'rhs_table' => 'tasks',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'Cases',
    ),
    'case_notes' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'Notes',
      'rhs_table' => 'notes',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'Cases',
    ),
    'case_meetings' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'Meetings',
      'rhs_table' => 'meetings',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'Cases',
    ),
    'case_emails' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'Emails',
      'rhs_table' => 'emails',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'Cases',
    ),
    'invention_cases' => 
    array (
      'lhs_module' => 'Inv_Inventions',
      'lhs_table' => 'inv_inventions',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'invention_id',
      'relationship_type' => 'one-to-many',
    ),
    'ccasetype_cases' => 
    array (
      'lhs_module' => 'c_case_type',
      'lhs_table' => 'c_case_type',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'type',
      'relationship_type' => 'one-to-many',
    ),
    'ccasestatus_cases' => 
    array (
      'lhs_module' => 'c_case_status',
      'lhs_table' => 'c_case_status',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'status',
      'relationship_type' => 'one-to-many',
    ),
    'parent_consultant' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'client_consultant_id',
      'relationship_type' => 'one-to-many',
    ),
  ),
  'optimistic_locking' => true,
  'templates' => 
  array (
    'issue' => 'issue',
    'assignable' => 'assignable',
    'basic' => 'basic',
  ),
  'custom_fields' => false,
);