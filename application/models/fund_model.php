<?php
/**
 *  
 */
class fund_model extends MY_Model {
	
    public $table = 'FUNDS';
    public $select = ' FUNDS.* ';
	function __construct() {
		parent::__construct();
	}
}
?>