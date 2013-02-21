<?php 

class Content_model extends MY_Model
{
	
	function __construct()
    {
        parent::Model();
    }
    
    function get($id)
    {
    	$sql = 'select * from contents where id = ?';
    	return $this->db->GetRow($sql,$id);
    }
    
    function get_content($url)
    {
    	$sql = 'select * from contents where url = ?';
    	return $this->db->GetRow($sql,$url);
    }
    
    function save($data)
    {
    	$mode = $data['id'] ? 'UPDATE' : 'INSERT';
    	$where = $data['id'] ? 'id = '.$data['id'] : false;
    	$this->db->AutoExecute('contents',$data,$mode,$where);
    }
	
}

?>