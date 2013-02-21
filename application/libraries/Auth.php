<?php

class Auth
{
	
	private $CI;
	
	function __construct()
	{
		$this->CI =& get_instance();	
	}
	
	function login($username,$password)
	{
		$sql = 'select * from users where username = ? and password = ?';
		$id = $this->CI->db->GetOne($sql,array($username,$password));	
		//$id = $this->CI->user_model->check_login($username,$password);	
		if($id)
		{
			$this->CI->session->set_userdata('id',$id);
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function logout()
	{
		$this->CI->session->unset_userdata('id');
	}
	
	function is_login()
	{
		return ($this->CI->session->userdata('id')) ? TRUE : FALSE;
	}
	
}

?>