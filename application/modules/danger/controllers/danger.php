<?php
Class Danger extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('danger_model', 'danger');
	}
	
	function form_import(){
		$this->template->build('form_import');
	}
	
	function import(){
		set_time_limit(0);
		//$this->db->debug=true;
		$columns = $this->db->MetaColumnNames("DANGER");
		foreach($columns as $item){
			$column[] = $item;
		}
		if($_FILES['fl_import']['name']!=''){						
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'danger_dear_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/danger/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
			
			
			require_once 'include/Excel/reader.php';
			$data = new Spreadsheet_Excel_Reader();
			$data -> setOutputEncoding('UTF-8');
			$data -> read($uploaddir.$file_name);
			
			//error_reporting(E_ALL ^ E_NOTICE);
			//$index = 0;
			//echo $data -> sheets[0]['numCols'];
			
			
			for($i = 7; $i <= $data -> sheets[0]['numRows']-12; $i++) {
				$value = null;
				//if(in_array(substr(trim($data -> sheets[0]['cells'][$i][1]),0,2), array(14,21,31,30,36))){				
				for($ncolumn = 0; $ncolumn <= $data -> sheets[0]['numCols'];$ncolumn++){
					$column_name = strtoupper(trim($column[$ncolumn+1]));
					$value[$column_name] = trim($data -> sheets[0]['cells'][$i][$ncolumn]); 						
				}
				
				$value['YEAR'] = '2555';
				
				// echo "<pre>";
				// var_dump($value);
				// echo "</pre>";
				
				$this->danger->save($value);
			}
		}
		redirect('danger/form_import');
	}
}