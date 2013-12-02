<?php
Class Healthcare extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('healthcare_model', 'healthcare');
		$this->load->model('info_model','info');
	}
	public $menu_id=112;
	
	function index(){
		$data['years'] = $this->healthcare->get("SELECT DISTINCT YEAR_DATA FROM HEALTHCARE ORDER BY YEAR_DATA DESC");
		$data['provinces'] = $this->healthcare->limit(80)->get("SELECT DISTINCT CODE, PROVINCE FROM HEALTHCARE ORDER BY CODE ASC");
		
		$sql = 'SELECT * FROM HEALTHCARE WHERE 1=1 ';
			if(@$_GET['year_data']) $sql .= "AND YEAR_DATA = ".$_GET['year_data'].' ';
			if(@$_GET['code']) $sql .= "AND CODE = ".$_GET['code'].' ';
		$sql .= ' ORDER BY ID ASC';
			
		$data['healthcares'] = $this->healthcare->get($sql);
		$data['pagination'] = $this->healthcare->pagination();
		$this->template->build('index',$data);
	}
	
	function report1(){
		$sql = "SELECT 
				BUDGETYEAR, 
				(SELECT sum(HEALTH_SUM) FROM HEALTHCARE d WHERE YEAR_DATA=BUDGETYEAR AND (AGE <> 'Total' AND AGE IS NOT NULL))HEALTH_SUM,
				(SELECT sum(NOREG_SUM) FROM HEALTHCARE d WHERE YEAR_DATA=BUDGETYEAR AND (AGE <> 'Total' AND AGE IS NOT NULL))NOREG_SUM,
				(SELECT sum(CIVIL_SUM) FROM HEALTHCARE d WHERE YEAR_DATA=BUDGETYEAR AND (AGE <> 'Total' AND AGE IS NOT NULL))CIVIL_SUM,
				(SELECT sum(OTHER_SUM) FROM HEALTHCARE d WHERE YEAR_DATA=BUDGETYEAR AND (AGE <> 'Total' AND AGE IS NOT NULL))OTHER_SUM,
				(SELECT sum(RIGHT_SUM) FROM HEALTHCARE d WHERE YEAR_DATA=BUDGETYEAR AND (AGE <> 'Total' AND AGE IS NOT NULL))RIGHT_SUM,
				(SELECT sum(PROBLEM_SUM) FROM HEALTHCARE d WHERE YEAR_DATA=BUDGETYEAR AND (AGE <> 'Total' AND AGE IS NOT NULL))PROBLEM_SUM,
				(SELECT (sum(HEALTH_SUM)+sum(NOREG_SUM) +sum(CIVIL_SUM) + sum(OTHER_SUM) + sum(RIGHT_SUM) + sum(PROBLEM_SUM)) FROM HEALTHCARE d WHERE YEAR_DATA=BUDGETYEAR AND (AGE <> 'Total' AND AGE IS NOT NULL))TOTAL
				FROM 
				(SELECT DISTINCT YEAR_DATA BUDGETYEAR from HEALTHCARE ORDER BY BUDGETYEAR DESC)";
		$data['healthcares'] = $this->healthcare->get($sql);
		$this->template->build('report1',$data);
	}
	
	function export1(){
		$sql = "SELECT 
				BUDGETYEAR, 
				(SELECT sum(HEALTH_SUM) FROM HEALTHCARE d WHERE YEAR_DATA=BUDGETYEAR AND (AGE <> 'Total' AND AGE IS NOT NULL))HEALTH_SUM,
				(SELECT sum(NOREG_SUM) FROM HEALTHCARE d WHERE YEAR_DATA=BUDGETYEAR AND (AGE <> 'Total' AND AGE IS NOT NULL))NOREG_SUM,
				(SELECT sum(CIVIL_SUM) FROM HEALTHCARE d WHERE YEAR_DATA=BUDGETYEAR AND (AGE <> 'Total' AND AGE IS NOT NULL))CIVIL_SUM,
				(SELECT sum(OTHER_SUM) FROM HEALTHCARE d WHERE YEAR_DATA=BUDGETYEAR AND (AGE <> 'Total' AND AGE IS NOT NULL))OTHER_SUM,
				(SELECT sum(RIGHT_SUM) FROM HEALTHCARE d WHERE YEAR_DATA=BUDGETYEAR AND (AGE <> 'Total' AND AGE IS NOT NULL))RIGHT_SUM,
				(SELECT sum(PROBLEM_SUM) FROM HEALTHCARE d WHERE YEAR_DATA=BUDGETYEAR AND (AGE <> 'Total' AND AGE IS NOT NULL))PROBLEM_SUM,
				(SELECT (sum(HEALTH_SUM)+sum(NOREG_SUM) +sum(CIVIL_SUM) + sum(OTHER_SUM) + sum(RIGHT_SUM) + sum(PROBLEM_SUM)) FROM HEALTHCARE d WHERE YEAR_DATA=BUDGETYEAR AND (AGE <> 'Total' AND AGE IS NOT NULL))TOTAL
				FROM 
				(SELECT DISTINCT YEAR_DATA BUDGETYEAR from HEALTHCARE ORDER BY BUDGETYEAR DESC)";
		$data['healthcares'] = $this->healthcare->get($sql);
		
		$filename= "healthcare_report_data_all.xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export1',$data);
	}
	
	function report2($year=false){
		$data['type'] = array('health'=>'สิทธิประกันสุขภาพถ้วนหน้า','noreg'=>'บุคคลที่ยังไม่ได้รับการลงทะเบียน','civil'=>'สิทธิข้าราชการ/สิทธิรัฐวิสาหกิจ','other'=>'สิทธิและสถานะอื่นๆ','right'=>'สิทธิประกันสังคม','problem'=>'บุคคลผู้มีปัญหาสถานะและสิทธิ');
		
		$data['years'] = $this->healthcare->get("SELECT DISTINCT YEAR_DATA FROM HEALTHCARE ORDER BY YEAR_DATA DESC");
		
		$sql = "SELECT * 
		FROM HEALTHCARE
		WHERE
		YEAR_DATA = ".$year."
		AND AGE = 'Total'
		ORDER BY CODE ASC";
		$data['healthcares'] = $this->healthcare->get($sql,TRUE);
		$this->template->build('report2',$data);
	}
	
	function export2($year=false){
		$data['type'] = array('health'=>'สิทธิประกันสุขภาพถ้วนหน้า','noreg'=>'บุคคลที่ยังไม่ได้รับการลงทะเบียน','civil'=>'สิทธิข้าราชการ/สิทธิรัฐวิสาหกิจ','other'=>'สิทธิและสถานะอื่นๆ','right'=>'สิทธิประกันสังคม','problem'=>'บุคคลผู้มีปัญหาสถานะและสิทธิ');
		
		$data['years'] = $this->healthcare->get("SELECT DISTINCT YEAR_DATA FROM HEALTHCARE ORDER BY YEAR_DATA DESC");
		
		$sql = "SELECT * 
		FROM HEALTHCARE
		WHERE
		YEAR_DATA = ".$year."
		AND AGE = 'Total'
		ORDER BY CODE ASC";
		$data['healthcares'] = $this->healthcare->get($sql,TRUE);
		
		$filename= "healthcare_report_data_".$year."_type_".$_GET['type'].".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export2',$data);
	}
	
	function report3($year=false){
		$data['years'] = $this->healthcare->get("SELECT DISTINCT YEAR_DATA FROM HEALTHCARE ORDER BY YEAR_DATA DESC");
		
		$sql = "SELECT * 
		FROM HEALTHCARE
		WHERE
		YEAR_DATA = ".$year."
		AND AGE = 'Total'
		ORDER BY CODE ASC";
		$data['healthcares'] = $this->healthcare->get($sql,TRUE);
		$this->template->build('report3',$data);
	}
	
	function export3($year=false){
		$data['years'] = $this->healthcare->get("SELECT DISTINCT YEAR_DATA FROM HEALTHCARE ORDER BY YEAR_DATA DESC");
		
		$sql = "SELECT * 
		FROM HEALTHCARE
		WHERE
		YEAR_DATA = ".$year."
		AND AGE = 'Total'
		ORDER BY CODE ASC";
		$data['healthcares'] = $this->healthcare->get($sql,TRUE);
		
		$filename= "healthcare_report_data_".$year.".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$this->load->view('export3',$data);
	}
	
	function form_import(){
		$data['menu_id'] = 112; 
		$this->template->build('form_import',$data);
	}
	
	function import(){
		$year_data = $_POST['year_data'];
		$_POST['SECTION_ID'] = ($_POST['WORKGROUP_ID']>0)?$_POST['WORKGROUP_ID']:$_POST['SECTION_ID'];
        $this->info->save($_POST);
		unset($_POST);
		
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