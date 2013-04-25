<?php
/**
 *  
 */
class birth_model extends MY_Model {
	
    public $table = 'BIRTH';
    public $select = ' BIRTH.* ';
	function __construct() {
		parent::__construct();
	}
}
?>