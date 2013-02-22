<?php
Class Family extends Public_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function warm(){
		$this->template->build('warm_index');
	}
	
	function warm_form(){
		$this->template->build('warm_form');
	}
	
	function violence(){
		$this->template->build('violence_index');
	}
	
	function violence_form(){
		$this->template->build('violence_form');
	}
}
?>