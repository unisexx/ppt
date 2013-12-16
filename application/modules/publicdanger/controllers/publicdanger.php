<?php
Class Publicdanger extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('publicdanger_traffic_model', 'traffic');
		$this->load->model('publicdanger_drought_model', 'drought');
		$this->load->model('publicdanger_storm_model', 'storm');
		$this->load->model('publicdanger_cold_model', 'cold');
		$this->load->model('info_model','info');
	}
	// public $menu_id=112;
	
	
	function form_import(){
		// $data['menu_id'] = 112; 
		$this->template->build('form_import',$data);
	}
	
	function import(){
		// Report all PHP errors (see changelog)
		// error_reporting(E_ALL);
		// $this->db->debug = true;
		
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
		    case 'drought':
		        $publicdanger_type = "drought";
		        $table = 'PUBLICDANGER_DROUGHT';
		        break;
		    case 'storm':
		        $publicdanger_type = "storm";
		        $table = 'PUBLICDANGER_STORM';
		        break;
			case 'cold':
		        $publicdanger_type = "cold";
		        $table = 'PUBLICDANGER_COLD';
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
			$this->$publicdanger_type->delete('YEAR_DATA',$year_data);
			
			header('Content-Type: text/html; charset=utf-8');
			for($i = 10; $i <= $data -> sheets[0]['numRows']; $i++) {
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
		$data['years'] = $this->traffic->get("SELECT DISTINCT YEAR_DATA FROM PUBLICDANGER_TRAFFIC ORDER BY YEAR_DATA DESC");
		$this->template->build('report_all',$data);
	}
	
	function export_all(){
		$data['years'] = $this->traffic->get("SELECT DISTINCT YEAR_DATA FROM PUBLICDANGER_TRAFFIC ORDER BY YEAR_DATA DESC");
		
		$filename= "publicdanger_report_data_all.xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export_all',$data);
	}
	
	function report_traffic($year=false){ //การจราจร
		// Report all PHP errors (see changelog)
		// error_reporting(E_ALL);
		// $this->db->debug = true;
		$data['years'] = $this->traffic->get("SELECT DISTINCT YEAR_DATA FROM PUBLICDANGER_TRAFFIC ORDER BY YEAR_DATA DESC");

		$data['traffics'] = $this->traffic->where('year_data = '.$year)->order_by('province','asc')->get(false,true);
		$this->template->build('report_traffic',$data);
	}
	
	function export_traffic($year=false){
		$data['years'] = $this->traffic->get("SELECT DISTINCT YEAR_DATA FROM PUBLICDANGER_TRAFFIC ORDER BY YEAR_DATA DESC");

		$data['traffics'] = $this->traffic->where('year_data = '.$year)->order_by('province','asc')->get(false,true);
		
		$filename= "publicdanger_traffic_report_data_".$year.".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export_traffic',$data);
	}
	
	function report_drought($year=false){ //ภัยแล้ง
		$data['years'] = $this->drought->get("SELECT DISTINCT YEAR_DATA FROM PUBLICDANGER_DROUGHT ORDER BY YEAR_DATA DESC");
		
		$data['droughts'] = $this->drought->where('year_data = '.$year)->order_by('province','asc')->get(false,true);
		$this->template->build('report_drought',$data);
	}
	
	function export_drought($year=false){
		$data['years'] = $this->drought->get("SELECT DISTINCT YEAR_DATA FROM PUBLICDANGER_DROUGHT ORDER BY YEAR_DATA DESC");
		
		$data['droughts'] = $this->drought->where('year_data = '.$year)->order_by('province','asc')->get(false,true);
		
		$filename= "publicdanger_drought_report_data_".$year.".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export_drought',$data);
	}
	
	function report_storm($year=false){ //ภัยแล้ง
		$data['years'] = $this->storm->get("SELECT DISTINCT YEAR_DATA FROM PUBLICDANGER_STORM ORDER BY YEAR_DATA DESC");
		
		$data['storms'] = $this->storm->where('year_data = '.$year)->order_by('province','asc')->get(false,true);
		$this->template->build('report_storm',$data);
	}

	function export_storm($year=false){
		$data['years'] = $this->storm->get("SELECT DISTINCT YEAR_DATA FROM PUBLICDANGER_STORM ORDER BY YEAR_DATA DESC");
		
		$data['storms'] = $this->storm->where('year_data = '.$year)->order_by('province','asc')->get(false,true);
		
		$filename= "publicdanger_storm_report_data_".$year.".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export_storm',$data);
	}
}