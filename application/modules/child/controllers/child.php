<?php
Class Child extends Public_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('opt_model', 'opt');
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
	    /*
	    $sql = 'SELECT 
          FORM_ALL."ID",
          FORM_ALL."YEAR",
          (FORM_ALL.T4161_M + FORM_ALL.T4161_F) AS TOTAL_1,
          (FORM_ALL.T4162_M + FORM_ALL.T4162_F) AS TOTAL_2,
          (FORM_ALL.T4163_M + FORM_ALL.T4163_F) AS TOTAL_3,
          (FORM_ALL.T4164_M + FORM_ALL.T4164_F) AS TOTAL_4,
          (FORM_ALL.T4165_M + FORM_ALL.T4165_F) AS TOTAL_5,
          FORM_ALL.NUMBER_ID,
          FORM_ALL.OPT_NAME,
          FORM_ALL.AMPHOR,
          FORM_ALL.PROVINCE,
          FORM_ALL."SIZE",
          FORM_ALL.C_TITLE,
          FORM_ALL.C_NAME
        FROM FORM_ALL
        WHERE (FORM_ALL.T4161_M + FORM_ALL.T4161_F + FORM_ALL.T4162_M + FORM_ALL.T4162_F + FORM_ALL.T4163_M + FORM_ALL.T4163_F + FORM_ALL.T4164_M + FORM_ALL.T4164_F + FORM_ALL.T4165_M + FORM_ALL.T4165_F) > 0
        ORDER BY FORM_ALL."YEAR" DESC, FORM_ALL.NUMBER_ID DESC';
        */
        $sql = 'SELECT 
          FORM_ALL."ID",
          FORM_ALL."YEAR",
          (FORM_ALL.T4161_M + FORM_ALL.T4161_F) AS TOTAL_1,
          (FORM_ALL.T4162_M + FORM_ALL.T4162_F) AS TOTAL_2,
          (FORM_ALL.T4163_M + FORM_ALL.T4163_F) AS TOTAL_3,
          (FORM_ALL.T4164_M + FORM_ALL.T4164_F) AS TOTAL_4,
          (FORM_ALL.T4165_M + FORM_ALL.T4165_F) AS TOTAL_5,
          FORM_ALL.NUMBER_ID,
          FORM_ALL.OPT_NAME,
          FORM_ALL.AMPHOR,
          FORM_ALL.PROVINCE,
          FORM_ALL."SIZE",
          FORM_ALL.C_TITLE,
          FORM_ALL.C_NAME
        FROM FORM_ALL 
        ORDER BY FORM_ALL."YEAR" DESC, FORM_ALL.NUMBER_ID DESC';
		$data['result'] = $this->opt->get($sql);
        $data['pagination'] = $this->opt->pagination;
		$this->template->build('unsuitable_index', $data);
	}
	
	function unsuitable_form($id = null){
	    $data['rs'] = $this->opt->get_row($id);
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('unsuitable_form', $data);
	}
}
?>