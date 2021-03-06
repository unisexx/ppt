<?php
Class Danger extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('danger_model', 'danger');
		$this->load->model('info_model','info');
	}
	public $menu_id=111;
	
	function index(){
		$data['years'] = $this->danger->get("SELECT DISTINCT YEAR_DATA FROM DANGER ORDER BY YEAR_DATA DESC");
		$data['provinces'] = $this->danger->limit(80)->get("SELECT DISTINCT CODE, PROVINCE FROM DANGER ORDER BY CODE ASC");
		
		$sql = 'SELECT * FROM DANGER WHERE 1=1 ';
			if(@$_GET['year_data']) $sql .= "AND YEAR_DATA = ".$_GET['year_data'].' ';
			if(@$_GET['code']) $sql .= "AND CODE = ".$_GET['code'].' ';
		$sql .= ' ORDER BY ID DESC';
			
		$data['dangers'] = $this->danger->get($sql);
		$data['pagination'] = $this->danger->pagination();
		$this->template->build('index',$data);
	}
	
	function form($id=false){
		$data['provinces'] = $this->danger->limit(80)->get("SELECT DISTINCT CODE, PROVINCE FROM DANGER ORDER BY CODE ASC");
		$data['danger'] = $this->danger->get_row($id);
		$this->template->build('form',$data);
	}
	
	function save($id=false){
		if($_POST){
			$this->danger->save($_POST); 
			set_notify('success', 'ดำเนินการบันทึกข้อมูลเสร็จสิ้น');
		}
		redirect('danger/index');
	}
	
	function delete($id){
		if($id){
			$this->danger->delete($id);
		}
		redirect('danger/index');
	}
	
	function form_import(){
		$this->template->build('form_import');
	}
	
	function import(){
		$year_data = $_POST['year_data'];
		$_POST['SECTION_ID'] = ($_POST['WORKGROUP_ID']>0)?$_POST['WORKGROUP_ID']:$_POST['SECTION_ID'];
        $this->info->save($_POST);
		unset($_POST);
		
		set_time_limit(0);
		$columns = $this->db->MetaColumnNames("DANGER");
		foreach($columns as $item){
			$column[] = $item;
		}
		if($_FILES['fl_import']['name']!=''){						
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'danger_'.$year_data.'_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/danger/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
			
			
			require_once 'include/Excel/reader.php';
			$data = new Spreadsheet_Excel_Reader();
			$data -> setOutputEncoding('UTF-8');
			$data -> read($uploaddir.$file_name);
			
			// ลบข้อมูลเก่าแล้วบันทึกข้อมูลใหม่เข้าไป
			$this->danger->delete('YEAR_DATA',$year_data);
			
			for($i = 6; $i <= $data -> sheets[0]['numRows']; $i++) {
				$value = null;			
				
				if(@trim($data -> sheets[0]['cells'][$i][1]) != ""){
					for($ncolumn = 0; $ncolumn <= $data -> sheets[0]['numCols'];$ncolumn++){
						$column_name = @strtoupper(@trim($column[$ncolumn+1]));
						$value[$column_name] = @trim($data -> sheets[0]['cells'][$i][$ncolumn]); 						
					}
					
					$value['YEAR_DATA'] = $year_data;
					
					// echo"<pre>";
					// echo print_r($value);
					// echo"</pre>";
				
					$this->danger->save($value);
				}
			}
			
			set_notify('success', 'นำเข้าข้อมูลเรียบร้อย');
		}
		redirect('danger/form_import');
	}

	function report(){
		$sql = "SELECT BUDGETYEAR, 
				(SELECT sum(TOTAL) FROM DANGER d WHERE YEAR_DATA=BUDGETYEAR)TOTAL,
				(SELECT sum(ALL_CASE) FROM DANGER d WHERE YEAR_DATA=BUDGETYEAR)ALL_CASE,
				(SELECT sum(SEVERE_CASE) FROM DANGER d WHERE YEAR_DATA=BUDGETYEAR)SEVERE_CASE
				FROM 
				(SELECT DISTINCT YEAR_DATA BUDGETYEAR from DANGER ORDER BY BUDGETYEAR DESC)";
		$data['dangers'] = $this->danger->get($sql);
		
		$this->template->title('รายงานจำนวนลูกจ้างและผู้ประสบอันตรายจากการทำงาน ระบบฐานข้อมูลทางสังคม สป.พม.');
		$this->template->append_metadata( meta('keywords','ระบบฐานข้อมูลทางสังคม,ระบบฐานข้อมูลด้านสังคม,ฐานข้อมูลด้านสังคม,ฐานข้อมูลทางสังคม,กลุ่มเป้าหมาย,เชิงประเด็น,สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,พม.,สป.พม.,สป.,ข้อมูลด้านสังคม,ข้อมูลทางสังคม,ข้อมูลสังคม,จำนวนลูกจ้างและผู้ประสบอันตรายจากการทำงาน,จำนวนลูกจ้าง,จำนวนผู้ประสบภัย,ผู้ประสบอันตราย,ผู้ประสบอันตรายจาการทำงาน,อันตรายจากการทำงาน,สำนักงานประกันสังคม,ประกันสังคม'));
		
		$this->template->build("report",$data);
	}
	
	function export(){
		$sql = "SELECT BUDGETYEAR, 
				(SELECT sum(TOTAL) FROM DANGER d WHERE YEAR_DATA=BUDGETYEAR)TOTAL,
				(SELECT sum(ALL_CASE) FROM DANGER d WHERE YEAR_DATA=BUDGETYEAR)ALL_CASE,
				(SELECT sum(SEVERE_CASE) FROM DANGER d WHERE YEAR_DATA=BUDGETYEAR)SEVERE_CASE
				FROM 
				(SELECT DISTINCT YEAR_DATA BUDGETYEAR from DANGER ORDER BY BUDGETYEAR DESC)";
		$data['dangers'] = $this->danger->get($sql);
		
		$filename= "danger_report_data_all.xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export',$data);
	}
	
	function report2($year_data=false){
		$data['years'] = $this->danger->get("SELECT DISTINCT YEAR_DATA FROM DANGER ORDER BY YEAR_DATA DESC");
		$data['dangers'] = $this->danger->where("year_data = ".$year_data)->get(FALSE,TRUE);
		$this->template->build("report2",$data);
	}
	
	function export2($year_data=false){
		$data['years'] = $this->danger->get("SELECT DISTINCT YEAR_DATA FROM DANGER ORDER BY YEAR_DATA DESC");
		$data['dangers'] = $this->danger->where("year_data = ".$year_data)->get(FALSE,TRUE);
		
		$filename= "danger_report_data_".$year_data.".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export2',$data);
	}
}