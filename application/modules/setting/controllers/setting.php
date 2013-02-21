<?php
Class Setting extends Public_Controller{
	function __construct(){
		parent::__construct();
		
	}
	
	function user(){
		$this->template->build('user_index');
	}
	
	function user_form(){
		$this->template->build('user_form');
	}
	
	function usertype(){
		$this->template->build('usertype_index');
	}
	
	function usertype_form(){
		$this->template->build('usertype_form');
	}
	
	function set_target(){
		$this->template->build('set_target');
	}
	
	function set_target_form(){
		$this->template->build('set_target_form');
	}
	
	function set_province(){
		$this->template->build('set_province');
	}
	
	function set_province_form(){
		$this->template->build('set_province_form');
	}
	
	function set_amphor(){
		$this->template->build('set_amphor');
	}
	
	function set_amphor_form(){
		$this->template->build('set_amphor_form');
	}
	
	function set_tumbon(){
		$this->template->build('set_tumbon');
	}
	
	function set_tumbon_form(){
		$this->template->build('set_tumbon_form');
	}
}
?>