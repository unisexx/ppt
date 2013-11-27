<?php
Class Healthcare extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('healthcare_model', 'healthcare');
		$this->load->model('info_model','info');
	}
	// public $menu_id=111;
	
	function report1(){
		$this->template->build('report1');
	}
	
	function report2(){
		$this->template->build('report2');
	}
	
	function report3(){
		$this->template->build('report3');
	}
	
	function form_import(){
		$data['menu_id'] = 108; 
		$this->template->build('form_import',$data);
	}
	
	function import(){
		$year_data = $_POST['year_data'];
		// $_POST['SECTION_ID'] = ($_POST['WORKGROUP_ID']>0)?$_POST['WORKGROUP_ID']:$_POST['SECTION_ID'];
        // $this->info->save($_POST);
		// unset($_POST);
		
		set_time_limit(0);
		$columns = $this->db->MetaColumnNames("HEALTHCARE");
		foreach($columns as $item){
			$column[] = $item;
		}
		if($_FILES['fl_import']['name']!=''){						
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'healthcare_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/healthcare/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
			
			
			require_once 'include/Excel/reader.php';
			$data = new Spreadsheet_Excel_Reader();
			$data -> setOutputEncoding('UTF-8');
			$data -> read($uploaddir.$file_name);
			
			// ลบข้อมูลเก่าแล้วบันทึกข้อมูลใหม่เข้าไป
			$this->healthcare->delete('YEAR_DATA',$year_data);
			
			for($i = 4; $i <= $data -> sheets[0]['numRows']; $i++) {
				$value = null;
				for($ncolumn = 0; $ncolumn <= $data -> sheets[0]['numCols']+1;$ncolumn++){
					$column_name = strtoupper(trim($column[$ncolumn+1]));
					
					if($column_name == "CODE"){ //แยกรหัสกับจังหวัดออกจากกัน
						$string = trim($data -> sheets[0]['cells'][$i][$ncolumn]);
						if($string != ""){
							$string = explode("-", $string);
							$string = array_map('trim',$string);
							$value[$column_name] = $string[0];
						}else{
							$value["CODE"] = $code;
						}
					}elseif($column_name == "PROVINCE"){
						$value[$column_name] = ($stging[1] != "")?$stging[1]:$province;
					}else{
						$value[$column_name] = trim($data -> sheets[0]['cells'][$i][$ncolumn-1]);
					}
					
					$code = ($string[0] != "")?$string[0]:$code;
					$province = ($string[1] != "")?$string[1]:$province;
				}
				
				$value['YEAR_DATA'] = $year_data;
				// echo"<pre>";
				// echo print_r($value);
				// echo"</pre>";
				$this->healthcare->save($value);
			}
			
			set_notify('success', 'นำเข้าข้อมูลเรียบร้อย');
		}
		redirect('healthcare/form_import');
	}
}