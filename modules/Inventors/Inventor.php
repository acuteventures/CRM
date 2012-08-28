<?PHP
/**
* Author: Anuradha
* Org: Veon Consulting
* Created On: 23-11-2011
* Description: Creating new module Inventor: Class
*/
require_once('modules/Inventors/Inventor_sugar.php');
class Inventor extends Inventor_sugar {
	
	function Inventor(){	
		parent::Inventor_sugar();
	}
	//by anuradha on 23-11-2011 
	function mark_deletedByInventorId($invention_id) {
		
		$return_array2 = $this->get_full_list("id","invention_id='".$invention_id."'");		
		
			if(is_array($return_array2)){	
				foreach ($return_array2 as $value) {
					$this->mark_deleted($value->id);
				}
			}
    } //end
	
}
?>


