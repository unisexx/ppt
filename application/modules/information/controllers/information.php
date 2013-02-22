<?php
Class Information extends Public_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function population(){
		$this->template->build('population_index');
	}
	
	function population_form(){
		$this->template->build('population_form');
	}
}
?>