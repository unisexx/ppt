<?php
Class Recipient extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('recipient_model','recipient');
	}
	function index(){
		$this->template->build('recipient_index');
	}
	function form(){
		$this->template->build('recipient_form');
	}
	function save(){
		
	}
	function import(){
		$this->template->build('recipient_import_form');
	}
	function ImportData($Filepath=FALSE){
			require('include/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
			require('include/spreadsheet-reader-master/SpreadsheetReader.php');		
			date_default_timezone_set('UTC');		
			$Spreadsheet = new SpreadsheetReader($Filepath);
			$BaseMem = memory_get_usage();		
			$Time = microtime(true);
			return $Spreadsheet;
	}
	function save_import(){
			if($_FILES['fl_import']['name']!=''){
				$this->db->execute("DELETE FROM RECIPIENT WHERE S_DATE='".$_POST['s_date']."' and E_DATE='".$_POST['e_date']."'");
				$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
				$file_name = 'recipient_'.date("Y_m_d_H_i_s").'.'.$ext;	
				$uploaddir = 'import_file/recipient/';
				$fpicname = $uploaddir.$file_name;
				move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);		
				$data= $this->ImportData($uploaddir.$file_name);				
				foreach($data as $key=>$item){
					if($key>=0){										
						$val['s_date'] =$_POST['s_date'];
						$val['e_date'] =$_POST['e_date'];
						$val['agency_id'] =$item[0];
						$val['agency'] =$item[1];
						$val['service_total'] = $item[2];
						$val['help_id'] =$item[3];
						$val['help'] = $item[4];
						$val['money_total'] = $item[5];
						$val['create'] =date('Y-m-d');
						$this->recipient->save($val);	
					}
				}
			set_notify('success', lang('save_data_complete'));		
		}
		redirect('recipient/import');
	}
}	