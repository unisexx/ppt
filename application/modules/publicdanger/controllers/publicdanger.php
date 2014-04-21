<?php
Class Publicdanger extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('publicdanger_traffic_model', 'traffic');
		$this->load->model('publicdanger_drought_model', 'drought');
		$this->load->model('publicdanger_storm_model', 'storm');
		$this->load->model('publicdanger_cold_model', 'cold');
		$this->load->model('publicdanger_flood_model', 'flood');
		$this->load->model('info_model','info');
	}
	public $menu_id=113;
	
	
	function form_import(){
		$data['menu_id'] = 113;
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
			case 'flood':
		        $publicdanger_type = "flood";
		        $table = 'PUBLICDANGER_FLOOD';
		        break;
		}

		$columns = $this->db->MetaColumnNames($table);
		foreach($columns as $item){
			$column[] = $item;
		}
		if($_FILES['fl_import']['name']!=''){						
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = $publicdanger_type.'_'.$year_data.'_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/publicdanger/'.$publicdanger_type.'/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
			
			
			require_once 'include/Excel/reader.php';
			$data = new Spreadsheet_Excel_Reader();
			$data -> setOutputEncoding('UTF-8');
			$data -> read($uploaddir.$file_name);
			
			// ลบข้อมูลเก่าแล้วบันทึกข้อมูลใหม่เข้าไป
			if($publicdanger_type == "flood"){
				$this->$publicdanger_type->where("YEAR_DATA = ".$year_data." AND NO = ".$_POST['no'])->delete();
			}else{
				$this->$publicdanger_type->delete('YEAR_DATA',$year_data);	
			}
			
			header('Content-Type: text/html; charset=utf-8');
			for($i = 10; $i <= $data -> sheets[0]['numRows']; $i++) {
				$value = null;
				
				if(@trim($data -> sheets[0]['cells'][$i][1]) != ""){
					
					if($publicdanger_type == 'traffic'){
						
						$value['YEAR_DATA'] = $year_data;
						$value['PROVINCE'] = @trim($data -> sheets[0]['cells'][$i][1]);
						$value['COUNTER'] = @trim($data -> sheets[0]['cells'][$i][2]);
						$value['DEATH'] = @trim($data -> sheets[0]['cells'][$i][3]);
						$value['SERIOUS_INJURY'] = @trim($data -> sheets[0]['cells'][$i][4]);
						$value['MINOR_INJURY'] = @trim($data -> sheets[0]['cells'][$i][5]);
						$value['TOTAL_INJURY'] = @trim($data -> sheets[0]['cells'][$i][6]);
					
					}elseif($publicdanger_type == 'drought'){
						
						$value['YEAR_DATA'] = $year_data;
						$value['PROVINCE'] = @trim($data -> sheets[0]['cells'][$i][1]);
						$value['AMPOR'] = @trim($data -> sheets[0]['cells'][$i][2]);
						$value['TUMBON'] = @trim($data -> sheets[0]['cells'][$i][3]);
						$value['MOOBAN'] = @trim($data -> sheets[0]['cells'][$i][4]);
						$value['HOUSEHOLD'] = @trim($data -> sheets[0]['cells'][$i][5]);
						$value['PEOPLE'] = @trim($data -> sheets[0]['cells'][$i][6]);
						
					}elseif($publicdanger_type == 'storm' || $publicdanger_type == 'cold'){
						
						$value['YEAR_DATA'] = $year_data;
						$value['PROVINCE'] = @trim($data -> sheets[0]['cells'][$i][1]);
						$value['AMPOR'] = @trim($data -> sheets[0]['cells'][$i][2]);
						$value['TUMBON'] = @trim($data -> sheets[0]['cells'][$i][3]);
						$value['MOOBAN'] = @trim($data -> sheets[0]['cells'][$i][4]);
						$value['PEOPLE'] = @trim($data -> sheets[0]['cells'][$i][5]);
						$value['HOUSEHOLD'] = @trim($data -> sheets[0]['cells'][$i][6]);
						
					}elseif($publicdanger_type == 'flood'){
						
						$value['YEAR_DATA'] = $year_data;
						$value['NO'] = $_POST['no'];
						$value['PROVINCE'] = @trim($data -> sheets[0]['cells'][$i][1]);
						$value['AMPOR'] = @trim($data -> sheets[0]['cells'][$i][2]);
						$value['TUMBON'] = @trim($data -> sheets[0]['cells'][$i][3]);
						$value['MOOBAN'] = @trim($data -> sheets[0]['cells'][$i][4]);
						$value['HOUSEHOLD'] = @trim($data -> sheets[0]['cells'][$i][5]);
						$value['PEOPLE'] = @trim($data -> sheets[0]['cells'][$i][6]);
						
					}
					
					// echo"<pre>";
					// echo print_r($value);
					// echo"</pre>";
					
					$this->$publicdanger_type->save($value);
					
				}
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
	
	function export_drought($year=false){$data['droughts'] = $this->drought->where('year_data = '.$year)->order_by('province','asc')->get(false,true);
		
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

	function export_storm($year=false){$data['storms'] = $this->storm->where('year_data = '.$year)->order_by('province','asc')->get(false,true);
		
		$filename= "publicdanger_storm_report_data_".$year.".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export_storm',$data);
	}
	
	function report_flood(){ // อุทกภัย
		$data['years'] = $this->flood->get("SELECT DISTINCT YEAR_DATA FROM PUBLICDANGER_FLOOD ORDER BY YEAR_DATA DESC");
		$data['nos'] = $this->flood->get("SELECT DISTINCT NO FROM PUBLICDANGER_FLOOD WHERE YEAR_DATA = ".$_GET['year_data']." ORDER BY NO ASC");
		
		$data['floods'] = $this->flood->where('year_data = '.$_GET['year_data'].' and no = '.$_GET['no'])->order_by('province','asc')->get(false,true);
		$this->template->build('report_flood',$data);
	}
	
	function export_flood(){
		$data['floods'] = $this->flood->where('year_data = '.$_GET['year_data'].' and no = '.$_GET['no'])->order_by('province','asc')->get(false,true);
		
		$filename= "publicdanger_flood_report_data_".$_GET['year_data']."_no".$_GET['no'].".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export_flood',$data);
	}
	
	function report_cold($year=false){
		$data['years'] = $this->cold->get("SELECT DISTINCT YEAR_DATA FROM PUBLICDANGER_COLD ORDER BY YEAR_DATA DESC");
		
		$data['colds'] = $this->cold->where('year_data = '.$year)->order_by('province','asc')->get(false,true);
		$this->template->build('report_cold',$data);
	}
	
	function export_cold($year=false){$data['colds'] = $this->cold->where('year_data = '.$year)->order_by('province','asc')->get(false,true);
		
		$filename= "publicdanger_cold_report_data_".$year.".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export_cold',$data);
	}
}