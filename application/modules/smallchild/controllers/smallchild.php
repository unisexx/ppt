<?php
Class Smallchild extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('smallchild_model', 'smallchild');
		$this->load->model('info_model','info');
		$this->load->model('province_model','province');
		
		// error_reporting(-1);
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
		$sql = 'SELECT 
				BUDGETYEAR,
				(SELECT NVL(count("ID"),0) FROM SMALLCHILD d WHERE YEAR_DATA = BUDGETYEAR)ORG_SUM,
				(SELECT NVL(sum(TEACH_5),0) FROM SMALLCHILD d WHERE YEAR_DATA = BUDGETYEAR)TEACH_5_SUM,
				(SELECT NVL(sum(TEACH_4),0) FROM SMALLCHILD d WHERE YEAR_DATA = BUDGETYEAR)TEACH_4_SUM,
				(SELECT NVL(sum(EM_BOSS),0) FROM SMALLCHILD d WHERE YEAR_DATA = BUDGETYEAR)EM_BOSS_SUM,
				(SELECT NVL(sum(EM_GENERAL),0) FROM SMALLCHILD d WHERE YEAR_DATA = BUDGETYEAR)EM_GENERAL_SUM,
				(SELECT NVL(sum(EM_MISSION),0) FROM SMALLCHILD d WHERE YEAR_DATA = BUDGETYEAR)EM_MISSION_SUM,
				(SELECT NVL(sum(TEACH_EM_TOTAL),0) FROM SMALLCHILD d WHERE YEAR_DATA = BUDGETYEAR)TEACH_EM_TOTAL_SUM,
				(SELECT NVL(sum("CHILD"),0) childfun FROM SMALLCHILD d WHERE YEAR_DATA = BUDGETYEAR)CHILD_SUM
				FROM 
				(SELECT DISTINCT YEAR_DATA BUDGETYEAR from SMALLCHILD ORDER BY BUDGETYEAR DESC)TMP_TABLE_1';
		$data['smallchilds'] = $this->smallchild->get($sql);
		$this->template->build('report1',$data);
	}

	function export1(){
		$sql = 'SELECT 
				BUDGETYEAR,
				(SELECT NVL(count("ID"),0) FROM SMALLCHILD d WHERE YEAR_DATA = BUDGETYEAR)ORG_SUM,
				(SELECT NVL(sum(TEACH_5),0) FROM SMALLCHILD d WHERE YEAR_DATA = BUDGETYEAR)TEACH_5_SUM,
				(SELECT NVL(sum(TEACH_4),0) FROM SMALLCHILD d WHERE YEAR_DATA = BUDGETYEAR)TEACH_4_SUM,
				(SELECT NVL(sum(EM_BOSS),0) FROM SMALLCHILD d WHERE YEAR_DATA = BUDGETYEAR)EM_BOSS_SUM,
				(SELECT NVL(sum(EM_GENERAL),0) FROM SMALLCHILD d WHERE YEAR_DATA = BUDGETYEAR)EM_GENERAL_SUM,
				(SELECT NVL(sum(EM_MISSION),0) FROM SMALLCHILD d WHERE YEAR_DATA = BUDGETYEAR)EM_MISSION_SUM,
				(SELECT NVL(sum(TEACH_EM_TOTAL),0) FROM SMALLCHILD d WHERE YEAR_DATA = BUDGETYEAR)TEACH_EM_TOTAL_SUM,
				(SELECT NVL(sum("CHILD"),0) childfun FROM SMALLCHILD d WHERE YEAR_DATA = BUDGETYEAR)CHILD_SUM
				FROM 
				(SELECT DISTINCT YEAR_DATA BUDGETYEAR from SMALLCHILD ORDER BY BUDGETYEAR DESC)TMP_TABLE_1';
		$data['smallchilds'] = $this->smallchild->get($sql);
		
		$filename= "smallchild_report1_data.xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export1',$data);
	}
	
	function report2($year){
		$sql = 'SELECT 
				pv, budgetyear,
				(SELECT COUNT("ID") FROM SMALLCHILD WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR) ORG_SUM,
				(SELECT NVL(sum(TEACH_5),0) FROM SMALLCHILD d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_5_SUM,
				(SELECT NVL(sum(TEACH_4),0) FROM SMALLCHILD d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_4_SUM,
				(SELECT NVL(sum(EM_BOSS),0) FROM SMALLCHILD d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_BOSS_SUM,
				(SELECT NVL(sum(EM_GENERAL),0) FROM SMALLCHILD d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_GENERAL_SUM,
				(SELECT NVL(sum(EM_MISSION),0) FROM SMALLCHILD d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_MISSION_SUM,
				(SELECT NVL(sum(TEACH_EM_TOTAL),0) FROM SMALLCHILD d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_EM_TOTAL_SUM,
				(SELECT NVL(sum("CHILD"),0) FROM SMALLCHILD d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)CHILD_SUM
				FROM 
				(SELECT DISTINCT PROVINCE pv,YEAR_DATA BUDGETYEAR FROM SMALLCHILD WHERE YEAR_DATA = 2555 ORDER BY PROVINCE ASC)';
		$data['smallchilds'] = $this->smallchild->get($sql);
		$this->template->build('report2',$data);
	}

	function export2($year){
		$sql = 'SELECT 
				pv, budgetyear,
				(SELECT COUNT("ID") FROM SMALLCHILD WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR) ORG_SUM,
				(SELECT NVL(sum(TEACH_5),0) FROM SMALLCHILD d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_5_SUM,
				(SELECT NVL(sum(TEACH_4),0) FROM SMALLCHILD d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_4_SUM,
				(SELECT NVL(sum(EM_BOSS),0) FROM SMALLCHILD d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_BOSS_SUM,
				(SELECT NVL(sum(EM_GENERAL),0) FROM SMALLCHILD d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_GENERAL_SUM,
				(SELECT NVL(sum(EM_MISSION),0) FROM SMALLCHILD d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_MISSION_SUM,
				(SELECT NVL(sum(TEACH_EM_TOTAL),0) FROM SMALLCHILD d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_EM_TOTAL_SUM,
				(SELECT NVL(sum("CHILD"),0) FROM SMALLCHILD d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)CHILD_SUM
				FROM 
				(SELECT DISTINCT PROVINCE pv,YEAR_DATA BUDGETYEAR FROM SMALLCHILD WHERE YEAR_DATA = 2555 ORDER BY PROVINCE ASC)';
		$data['smallchilds'] = $this->smallchild->get($sql);
		
		$filename= "smallchild_report2_data.xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export2',$data);
	}
	
	function report3($year,$province){
		$sql = 'SELECT 
am, pv, budgetyear,
(SELECT COUNT("ID") FROM SMALLCHILD WHERE AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR) ORG_SUM,
(SELECT NVL(sum(TEACH_5),0) FROM SMALLCHILD d WHERE AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_5_SUM,
(SELECT NVL(sum(TEACH_4),0) FROM SMALLCHILD d WHERE AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_4_SUM,
(SELECT NVL(sum(EM_BOSS),0) FROM SMALLCHILD d WHERE AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_BOSS_SUM,
(SELECT NVL(sum(EM_GENERAL),0) FROM SMALLCHILD d WHERE AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_GENERAL_SUM,
(SELECT NVL(sum(EM_MISSION),0) FROM SMALLCHILD d WHERE AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_MISSION_SUM,
(SELECT NVL(sum(TEACH_EM_TOTAL),0) FROM SMALLCHILD d WHERE AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_EM_TOTAL_SUM,
(SELECT NVL(sum("CHILD"),0) FROM SMALLCHILD d WHERE AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)CHILD_SUM
FROM 
(SELECT DISTINCT AMPOR am, PROVINCE pv, YEAR_DATA BUDGETYEAR FROM SMALLCHILD WHERE PROVINCE = \''.$province.'\' AND YEAR_DATA = '.$year.' ORDER BY AMPOR ASC)';
		$data['smallchilds'] = $this->smallchild->get($sql);
		$this->template->build('report3',$data);
	}

	function export3($year,$province){
		$sql = 'SELECT 
am, pv, budgetyear,
(SELECT COUNT("ID") FROM SMALLCHILD WHERE AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR) ORG_SUM,
(SELECT NVL(sum(TEACH_5),0) FROM SMALLCHILD d WHERE AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_5_SUM,
(SELECT NVL(sum(TEACH_4),0) FROM SMALLCHILD d WHERE AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_4_SUM,
(SELECT NVL(sum(EM_BOSS),0) FROM SMALLCHILD d WHERE AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_BOSS_SUM,
(SELECT NVL(sum(EM_GENERAL),0) FROM SMALLCHILD d WHERE AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_GENERAL_SUM,
(SELECT NVL(sum(EM_MISSION),0) FROM SMALLCHILD d WHERE AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_MISSION_SUM,
(SELECT NVL(sum(TEACH_EM_TOTAL),0) FROM SMALLCHILD d WHERE AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_EM_TOTAL_SUM,
(SELECT NVL(sum("CHILD"),0) FROM SMALLCHILD d WHERE AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)CHILD_SUM
FROM 
(SELECT DISTINCT AMPOR am, PROVINCE pv, YEAR_DATA BUDGETYEAR FROM SMALLCHILD WHERE PROVINCE = \''.$province.'\' AND YEAR_DATA = '.$year.' ORDER BY AMPOR ASC)';
		$data['smallchilds'] = $this->smallchild->get($sql);
		
		$filename= "smallchild_report3_data.xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export3',$data);
	}
	
	function report4($year,$province,$ampor){
		
		$sql = 'SELECT 
org, am, pv, budgetyear,
(SELECT COUNT("ID") FROM SMALLCHILD WHERE "ORGANIZATION" = org AND AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR) ORG_SUM,
(SELECT NVL(sum(TEACH_5),0) FROM SMALLCHILD d WHERE "ORGANIZATION" = org AND AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_5_SUM,
(SELECT NVL(sum(TEACH_4),0) FROM SMALLCHILD d WHERE "ORGANIZATION" = org AND AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_4_SUM,
(SELECT NVL(sum(EM_BOSS),0) FROM SMALLCHILD d WHERE "ORGANIZATION" = org AND AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_BOSS_SUM,
(SELECT NVL(sum(EM_GENERAL),0) FROM SMALLCHILD d WHERE "ORGANIZATION" = org AND AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_GENERAL_SUM,
(SELECT NVL(sum(EM_MISSION),0) FROM SMALLCHILD d WHERE "ORGANIZATION" = org AND AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_MISSION_SUM,
(SELECT NVL(sum(TEACH_EM_TOTAL),0) FROM SMALLCHILD d WHERE "ORGANIZATION" = org AND AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_EM_TOTAL_SUM,
(SELECT NVL(sum("CHILD"),0) FROM SMALLCHILD d WHERE "ORGANIZATION" = org AND AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)CHILD_SUM
FROM 
(SELECT DISTINCT "ORGANIZATION" org, AMPOR am, PROVINCE pv, YEAR_DATA BUDGETYEAR FROM SMALLCHILD WHERE AMPOR = \''.$ampor.'\' AND PROVINCE = \''.$province.'\' AND YEAR_DATA = '.$year.' ORDER BY AMPOR ASC)';
		$data['smallchilds'] = $this->smallchild->get($sql);
		$this->template->build('report4',$data);
	}

	function export4($year,$province,$ampor){
		$sql = 'SELECT 
org, am, pv, budgetyear,
(SELECT COUNT("ID") FROM SMALLCHILD WHERE "ORGANIZATION" = org AND AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR) ORG_SUM,
(SELECT NVL(sum(TEACH_5),0) FROM SMALLCHILD d WHERE "ORGANIZATION" = org AND AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_5_SUM,
(SELECT NVL(sum(TEACH_4),0) FROM SMALLCHILD d WHERE "ORGANIZATION" = org AND AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_4_SUM,
(SELECT NVL(sum(EM_BOSS),0) FROM SMALLCHILD d WHERE "ORGANIZATION" = org AND AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_BOSS_SUM,
(SELECT NVL(sum(EM_GENERAL),0) FROM SMALLCHILD d WHERE "ORGANIZATION" = org AND AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_GENERAL_SUM,
(SELECT NVL(sum(EM_MISSION),0) FROM SMALLCHILD d WHERE "ORGANIZATION" = org AND AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)EM_MISSION_SUM,
(SELECT NVL(sum(TEACH_EM_TOTAL),0) FROM SMALLCHILD d WHERE "ORGANIZATION" = org AND AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TEACH_EM_TOTAL_SUM,
(SELECT NVL(sum("CHILD"),0) FROM SMALLCHILD d WHERE "ORGANIZATION" = org AND AMPOR = am AND PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)CHILD_SUM
FROM 
(SELECT DISTINCT "ORGANIZATION" org, AMPOR am, PROVINCE pv, YEAR_DATA BUDGETYEAR FROM SMALLCHILD WHERE AMPOR = \''.$ampor.'\' AND PROVINCE = \''.$province.'\' AND YEAR_DATA = '.$year.' ORDER BY AMPOR ASC)';
		$data['smallchilds'] = $this->smallchild->get($sql);
		
		$filename= "smallchild_report4_data.xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export4',$data);
	}
	
	function form_import(){
		$data['menu_id'] = 112; 
		$data['provinces'] = $this->province->order_by('province','asc')->get(FALSE,TRUE);
		$this->template->build('form_import',$data);
	}
	
	function import(){ // ประเภทบุคคล
		// Report all PHP errors (see changelog)
		// error_reporting(E_ALL);
		// $this->db->debug = true;
		
		$year_data = $_POST['year_data'];
		// $_POST['SECTION_ID'] = ($_POST['WORKGROUP_ID']>0)?$_POST['WORKGROUP_ID']:$_POST['SECTION_ID'];
        // $this->info->save($_POST);
		// unset($_POST);
		
		$table = 'SMALLCHILD';
		$columns = $this->db->MetaColumnNames($table);
		foreach($columns as $item){
			$column[] = $item;
		}
		if($_FILES['fl_import']['name']!=''){						
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'childfund_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/smallchild/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
			
			
			require_once 'include/Excel/reader.php';
			$data = new Spreadsheet_Excel_Reader();
			$data -> setOutputEncoding('UTF-8');
			$data -> read($uploaddir.$file_name);
			
			// ลบข้อมูลเก่าแล้วบันทึกข้อมูลใหม่เข้าไป
			// $this->db->debug =true;
			$this->db->execute("delete from SMALLCHILD where YEAR_DATA = ".$year_data." and PROVINCE = '".$_POST['province']."'");
			
			header('Content-Type: text/html; charset=utf-8');
			for($i = 7; $i <= $data -> sheets[0]['numRows']; $i++) {
				$value = null;			
				// for($ncolumn = 0; $ncolumn <= $data -> sheets[0]['numCols'];$ncolumn++){
					// $column_name = strtoupper(trim($column[$ncolumn]));
					// $value[$column_name] = trim($data -> sheets[0]['cells'][$i][$ncolumn]); 
				// }
				
				if(trim($data -> sheets[0]['cells'][$i][2]) != ""){ //อำเภอ
					$ampor = trim($data -> sheets[0]['cells'][$i][2]);
				}
				
				if(trim($data -> sheets[0]['cells'][$i][3]) != ""){ //อปท.
					$organization = trim($data -> sheets[0]['cells'][$i][3]);
				}
				
				$value['YEAR_DATA'] = $year_data;
				$value['PROVINCE'] = $_POST['province'];
				$value['AMPOR'] = $ampor;
				$value['ORGANIZATION'] = $organization;
				$value['TRANSFER'] = trim($data -> sheets[0]['cells'][$i][4]);
				$value['NAME'] = trim($data -> sheets[0]['cells'][$i][5]);
				$value['TEACH_5'] = chk_numeric(trim($data -> sheets[0]['cells'][$i][6]));
				$value['TEACH_4'] = chk_numeric(trim($data -> sheets[0]['cells'][$i][7]));
				$value['EM_BOSS'] = chk_numeric(trim($data -> sheets[0]['cells'][$i][8]));
				$value['EM_GENERAL'] = chk_numeric(trim($data -> sheets[0]['cells'][$i][9]));
				$value['EM_MISSION'] = chk_numeric(trim($data -> sheets[0]['cells'][$i][10]));
				$value['TEACH_EM_TOTAL'] = chk_numeric(trim($data -> sheets[0]['cells'][$i][12]));
				$value['CHILD'] = chk_numeric(trim($data -> sheets[0]['cells'][$i][13]));
				
				// if(trim($data -> sheets[0]['cells'][$i][3]) != ""){ //อปท.
					// $organization = trim($data -> sheets[0]['cells'][$i][3]).trim($data -> sheets[0]['cells'][$i][4]);
				// }
// 				
				// $value['YEAR_DATA'] = $year_data;
				// $value['PROVINCE'] = $_POST['province'];
				// $value['AMPOR'] = $ampor;
				// $value['ORGANIZATION'] = $organization;
				// $value['TRANSFER'] = trim($data -> sheets[0]['cells'][$i][5]);
				// $value['NAME'] = trim($data -> sheets[0]['cells'][$i][6]);
				// $value['TEACH_5'] = chk_numeric(trim($data -> sheets[0]['cells'][$i][7]));
				// $value['TEACH_4'] = chk_numeric(trim($data -> sheets[0]['cells'][$i][8]));
				// $value['EM_BOSS'] = chk_numeric(trim($data -> sheets[0]['cells'][$i][9]));
				// $value['EM_GENERAL'] = chk_numeric(trim($data -> sheets[0]['cells'][$i][10]));
				// $value['EM_MISSION'] = chk_numeric(trim($data -> sheets[0]['cells'][$i][11]));
				// $value['TEACH_EM_TOTAL'] = chk_numeric(trim($data -> sheets[0]['cells'][$i][12]));
				// $value['CHILD'] = chk_numeric(trim($data -> sheets[0]['cells'][$i][13]));
				
				echo"<pre>";
				echo print_r($value);
				echo"</pre>";
				
				$this->smallchild->save($value);
			}
			
			// set_notify('success', 'นำเข้าข้อมูลเรียบร้อย');
		}
		// redirect('smallchild/form_import');
	}
}