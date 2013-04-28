<?php
Class Home extends  Public_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->template->build('index');
	}
}
?>