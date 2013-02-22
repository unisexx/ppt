<?php
Class Datapoint extends Public_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function mental(){
		$this->template->build('mental_index');
	}
	
	function mental_form(){
		$this->template->build('mental_form');
	}
	
	function crime(){
		$this->template->build('crime_index');
	}
	
	function crime_form(){
		$this->template->build('crime_form');
	}
	
	function vehicle(){
		$this->template->build('vehicle_index');
	}
	
	function vehicle_form(){
		$this->template->build('vehicle_form');
	}
}
?>