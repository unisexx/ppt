<?php
Class Disability extends Public_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function identity(){
		$this->template->build('identity_index');
	}
	
	function identity_form(){
		$this->template->build('identity_form');
	}
}
?>