<?php
Class Child extends Public_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function welfare(){
		$this->template->build('welfare_index');
	}
	
	function welfare_form(){
		$this->template->build('welfare_form');
	}
	
	function offense(){
		$this->template->build('offense_index');
	}
	
	function offense_form(){
		$this->template->build('offense_form');
	}
	
	function offender(){
		$this->template->build('offender_index');
	}
	
	function offender_form(){
		$this->template->build('offender_form');
	}
	
	function orphans(){
		$this->template->build('orphans_index');
	}
	
	function orphans_form(){
		$this->template->build('orphans_form');
	}
	
	function drop(){
		$this->template->build('drop_index');
	}
	
	function drop_form(){
		$this->template->build('drop_form');
	}
	
	function pregnant(){
		$this->template->build('pregnant_index');
	}
	
	function pregnant_form(){
		$this->template->build('pregnant_form');
	}
	
	function birth(){
		$this->template->build('birth_index');
	}
	
	function birth_form(){
		$this->template->build('birth_form');
	}
	
	function unsuitable(){
		$this->template->build('unsuitable_index');
	}
	
	function unsuitable_form(){
		$this->template->build('unsuitable_form');
	}
}
?>