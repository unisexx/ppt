<?php
Class Publicdanger extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('publicdanger_traffic_model', 'traffic');
		$this->load->model('info_model','info');
	}
	// public $menu_id=112;
	
	
	function form_import(){
		// $data['menu_id'] = 112; 
		$this->template->build('form_import',$data);
	}
	
	function import(){
		$year_data = $_POST['year_data'];
		// $_POST['SECTION_ID'] = ($_POST['WORKGROUP_ID']>0)?$_POST['WORKGROUP_ID']:$_POST['SECTION_ID'];
        // $this->info->save($_POST);
		// unset($_POST);
		
		set_time_limit(0);
		switch ($_POST['publicdanger_type']) {
		    case 'traffic':
				$publicdanger_type = "traffic";
		        $table = 'PUBLICDANGER_TRAFFIC';
		        break;
		    case 1:
		        echo "i equals 1";
		        break;
		    case 2:
		        echo "i equals 2";
		        break;
		}

		$columns = $this->db->MetaColumnNames($table);
		foreach($columns as $item){
			$column[] = $item;
		}
		if($_FILES['fl_import']['name']!=''){						
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'traffic_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/publicdanger/'.$publicdanger_type.'/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
			
			
			require_once 'include/Excel/reader.php';
			$data = new Spreadsheet_Excel_Reader();
			$data -> setOutputEncoding('UTF-8');
			$data -> read($uploaddir.$file_name);
			
			// ลบข้อมูลเก่าแล้วบันทึกข้อมูลใหม่เข้าไป
			$this->traffic->delete('YEAR_DATA',$year_data);
			
			header('Content-Type: text/html; charset=utf-8');
			for($i = 11; $i <= $data -> sheets[0]['numRows']; $i++) {
				$value = null;			
				for($ncolumn = 0; $ncolumn <= $data -> sheets[0]['numCols'];$ncolumn++){
					$column_name = strtoupper(trim($column[$ncolumn+1]));
					$value[$column_name] = trim($data -> sheets[0]['cells'][$i][$ncolumn]); 						
				}
				
				$value['YEAR_DATA'] = $year_data;
				
				// echo"<pre>";
				// echo print_r($value);
				// echo"</pre>";
				$this->$publicdanger_type->save($value);
			}

			set_notify('success', 'นำเข้าข้อมูลเรียบร้อย');
		}
		redirect('publicdanger/form_import');
	}

	function report_all(){
		$this->template->build('report_all');
	}
}