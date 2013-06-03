<?php
/**
 *  
 */
class Opt_model extends MY_Model {
	
    public $table = 'FORM_ALL';
    
	function __construct() {
		parent::__construct();
	}
	
	public function get_option($province_id, $amphur_id)
	{
		$res = $this->db->GetArray('SELECT OPT_NAME
        FROM FORM_ALL
        WHERE PROVINCE_ID = ?
        AND AMPHUR_ID = ?
        ORDER BY OPT_NAME', array($province_id, $amphur_id));
        dbConvert($res);
        $result = array();
        foreach($res as $item) $result[$item['opt_name']] = $item['opt_name'];
		return $result;
	}
}
