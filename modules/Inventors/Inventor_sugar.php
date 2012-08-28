<?PHP
/**
* Author: Anuradha
* Org: Veon Consulting
* Created On: 23-11-2011
* Description: Creating new module Inventor
*/

class Inventor_sugar extends Basic {
	var $new_schema = true;
	var $module_dir = 'Inventors';
	var $object_name = 'Inventor';
	var $table_name = 'inventor_list';
	var $importable = false;
	var $disable_row_level_security = true ; // to ensure that modules created and deployed under CE will continue to function under team security if the instance is upgraded to PRO
		var $id;
		var $name;
		var $date_entered;
		var $date_modified;
		var $modified_user_id;
		var $modified_by_name;
		var $created_by;
		var $created_by_name;
		var $description;
		var $deleted;
		var $created_by_link;
		var $modified_user_link;
		var $assigned_user_id;
		var $assigned_user_name;
		var $assigned_user_link;
		var $invention_id;
		
	function Inventor_sugar(){
		parent::Basic();
	}
	
	function bean_implements($interface){
		switch($interface){
			case 'ACL': return true;
		}
		return false;
	}
	
		
}
?>