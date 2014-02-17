<?php
Class Childfund extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('childfund_model', 'childfund');
		$this->load->model('childfund_org_model', 'childfund_org');
	}
	public $menu_id=114;
	
	function index(){
		$data['years'] = $this->childfund->get("SELECT DISTINCT YEAR_DATA from CHILDFUND_ORG UNION SELECT DISTINCT YEAR_DATA from CHILDFUND ORDER BY YEAR_DATA DESC");
		
		if($_GET['import_type'] == '1'){
			$data['childfunds'] = $this->childfund->where('year_data = '.$_GET['year_data'])->get(FALSE,TRUE);
		}elseif($_GET['import_type'] == '2'){
			/*
			 * ประเภทการสนับสนุน : โครงการ
			 * TYPEMAIN1 = สงเคราะห์
			 * TYPEMAIN2 = คุ้มครองสวัสดิภาพ
			 * TYPEMAIN3 = ส่งเสริมความประพฤติ
			 * TYPEMAIN4 = 5 สถาน
			 * TYPEMAIN5 = งานวิจัย
			 * TYPEMAIN6 = อื่นๆ
			 * 
			 * องค์กร
			 * UNDER_TYPE1 = หน่วยงานของรัฐ
			 * UNDER_TYPE2 = องค์กรสาธารณประโยชน์
			 * UNDER_TYPE3 = องค์กรสวัสดิการชุมชน
			 * 
			 * เด็ก
			 * TYPECHILD1 = เด็กในโรงเรียน
			 * TYPECHILD2 = เด็กในชุมชน
			 * TYPECHILD3 = เด็กในชุมชน
			 * TYPECHILD4 = 5 สถาน
			*/
			$sql = "SELECT 
					pv, budgetyear,
					(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 1) TYPEMAIN1,
					(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 2) TYPEMAIN2,
					(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 3) TYPEMAIN3,
					(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 4) TYPEMAIN4,
					(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 5) TYPEMAIN5,
					(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 6) TYPEMAIN6,
					(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 1) UNDER_TYPE1,
					(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 2) UNDER_TYPE2,
					(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 3) UNDER_TYPE3,
					(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 1) TYPECHILD1,
					(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 2) TYPECHILD2,
					(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 3) TYPECHILD3,
					(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 4) TYPECHILD4,
					(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 1) SUM_TYPEMAIN1,
					(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 2) SUM_TYPEMAIN2,
					(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 3) SUM_TYPEMAIN3,
					(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 4) SUM_TYPEMAIN4,
					(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 5) SUM_TYPEMAIN5,
					(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 6) SUM_TYPEMAIN6,
					(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 1) SUM_UNDER_TYPE1,
					(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 2) SUM_UNDER_TYPE2,
					(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 3) SUM_UNDER_TYPE3,
					(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 1) SUM_TYPECHILD1,
					(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 2) SUM_TYPECHILD2,
					(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 3) SUM_TYPECHILD3,
					(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 4) SUM_TYPECHILD4
					FROM 
					(SELECT DISTINCT PROVINCE pv,YEAR_DATA budgetyear FROM CHILDFUND_ORG WHERE YEAR_DATA = ".$_GET['year_data']." ORDER BY PROVINCE ASC)";
			$data['childfunds'] = $this->childfund->get($sql,true);
		}
		$this->template->build('index',$data);
	}
	
	function form_import(){
		$data['menu_id'] = 114;
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
		
		$table = 'CHILDFUND';
		$columns = $this->db->MetaColumnNames($table);
		foreach($columns as $item){
			$column[] = $item;
		}
		if($_FILES['fl_import']['name']!=''){						
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'childfund_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/childfund/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
			
			
			require_once 'include/Excel/reader.php';
			$data = new Spreadsheet_Excel_Reader();
			$data -> setOutputEncoding('UTF-8');
			$data -> read($uploaddir.$file_name);
			
			// ลบข้อมูลเก่าแล้วบันทึกข้อมูลใหม่เข้าไป
			$this->childfund->delete('YEAR_DATA',$year_data);
			
			header('Content-Type: text/html; charset=utf-8');
			for($i = 6; $i <= $data -> sheets[0]['numRows']; $i++) {
				$value = null;			
				for($ncolumn = 0; $ncolumn <= $data -> sheets[0]['numCols'];$ncolumn++){
					$column_name = strtoupper(trim($column[$ncolumn+1]));
					$value[$column_name] = trim($data -> sheets[0]['cells'][$i][$ncolumn]); 						
				}
				
				$value['YEAR_DATA'] = $year_data;
				
				// echo"<pre>";
				// echo print_r($value);
				// echo"</pre>";
				
				$this->childfund->save($value);
			}
			set_notify('success', 'นำเข้าข้อมูลเรียบร้อย');
		}
		redirect('childfund/form_import');
	}

	function import_org(){ //ประเภทองค์กร
		// Report all PHP errors (see changelog)
		// error_reporting(E_ALL);
		// $this->db->debug = true;
		
		// $year_data = $_POST['year_data'];
		// $_POST['SECTION_ID'] = ($_POST['WORKGROUP_ID']>0)?$_POST['WORKGROUP_ID']:$_POST['SECTION_ID'];
        // $this->info->save($_POST);
		// unset($_POST);
		
		$table = 'CHILDFUND_ORG';
		$columns = $this->db->MetaColumnNames($table);
		foreach($columns as $item){
			$column[] = $item;
		}
		if($_FILES['fl_import']['name']!=''){						
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'childfund_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/childfund/app4/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
			
			
			require_once 'include/Excel/reader.php';
			$data = new Spreadsheet_Excel_Reader();
			$data -> setOutputEncoding('UTF-8');
			$data -> read($uploaddir.$file_name);
			
			// ลบข้อมูลเก่าแล้วบันทึกข้อมูลใหม่เข้าไป
			// $this->childfund->delete('YEAR_DATA',$year_data);
			
			header('Content-Type: text/html; charset=utf-8');
			for($i = 2; $i <= $data -> sheets[0]['numRows']; $i++) {
				$value = null;			
				for($ncolumn = 0; $ncolumn <= $data -> sheets[0]['numCols'];$ncolumn++){
					$column_name = strtoupper(trim($column[$ncolumn]));
					$value[$column_name] = trim($data -> sheets[0]['cells'][$i][$ncolumn]); 						
				}
				
				// $value['YEAR_DATA'] = $year_data;
				
				// echo"<pre>";
				// echo print_r($value);
				// echo"</pre>";
				
				$this->childfund_org->save($value);
			}
			set_notify('success', 'นำเข้าข้อมูลเรียบร้อย');
		}
		redirect('childfund/form_import');
	}

	function report1(){
		$sql = "SELECT 
				BUDGETYEAR, 
				(SELECT NVL(sum(PEOPLESUM),0) FROM CHILDFUND d WHERE YEAR_DATA=BUDGETYEAR AND (PROVINCE <> 'รวมทั้งสิ้น'))PEOPLE_SUM,
				(SELECT NVL(sum(TOTAL),0) FROM CHILDFUND d WHERE YEAR_DATA=BUDGETYEAR AND (PROVINCE <> 'รวมทั้งสิ้น'))TOTAL_SUM,
				(SELECT NVL(count(ORGAN_ID),0) FROM CHILDFUND_ORG d WHERE YEAR_DATA = BUDGETYEAR)ORG_SUM,
				(SELECT NVL(sum(COST_GET),0) FROM CHILDFUND_ORG d WHERE YEAR_DATA = BUDGETYEAR)ORG_TOTAL_SUM
				FROM 
				(SELECT DISTINCT YEAR_DATA BUDGETYEAR from CHILDFUND_ORG UNION SELECT DISTINCT YEAR_DATA BUDGETYEAR from CHILDFUND ORDER BY BUDGETYEAR DESC)TMP_TABLE_1";
		$data['childfunds'] = $this->childfund->get($sql);
		$this->template->build('report1',$data);
	}
	
	function export1(){
		$sql = "SELECT 
				BUDGETYEAR, 
				(SELECT NVL(sum(PEOPLESUM),0) FROM CHILDFUND d WHERE YEAR_DATA=BUDGETYEAR AND (PROVINCE <> 'รวมทั้งสิ้น'))PEOPLE_SUM,
				(SELECT NVL(sum(TOTAL),0) FROM CHILDFUND d WHERE YEAR_DATA=BUDGETYEAR AND (PROVINCE <> 'รวมทั้งสิ้น'))TOTAL_SUM,
				(SELECT NVL(count(ORGAN_ID),0) FROM CHILDFUND_ORG d WHERE YEAR_DATA = BUDGETYEAR)ORG_SUM,
				(SELECT NVL(sum(COST_GET),0) FROM CHILDFUND_ORG d WHERE YEAR_DATA = BUDGETYEAR)ORG_TOTAL_SUM
				FROM 
				(SELECT DISTINCT YEAR_DATA BUDGETYEAR from CHILDFUND_ORG UNION SELECT DISTINCT YEAR_DATA BUDGETYEAR from CHILDFUND ORDER BY BUDGETYEAR DESC)TMP_TABLE_1";
		$data['childfunds'] = $this->childfund->get($sql);
		
		$filename= "childfund_report_data_all.xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export1',$data);
	}
	
	function report2($year){
		$data['years'] = $this->childfund->get("SELECT DISTINCT YEAR_DATA BUDGETYEAR from CHILDFUND_ORG UNION SELECT DISTINCT YEAR_DATA BUDGETYEAR from CHILDFUND ORDER BY BUDGETYEAR DESC");
		
		/*
		 * ประเภทการสนับสนุน : โครงการ
		 * TYPEMAIN1 = สงเคราะห์
		 * TYPEMAIN2 = คุ้มครองสวัสดิภาพ
		 * TYPEMAIN3 = ส่งเสริมความประพฤติ
		 * TYPEMAIN4 = 5 สถาน
		 * TYPEMAIN5 = งานวิจัย
		 * TYPEMAIN6 = อื่นๆ
		 * 
		 * องค์กร
		 * UNDER_TYPE1 = หน่วยงานของรัฐ
		 * UNDER_TYPE2 = องค์กรสาธารณประโยชน์
		 * UNDER_TYPE3 = องค์กรสวัสดิการชุมชน
		 * 
		 * เด็ก
		 * TYPECHILD1 = เด็กในโรงเรียน
		 * TYPECHILD2 = เด็กในชุมชน
		 * TYPECHILD3 = เด็กในชุมชน
		 * TYPECHILD4 = 5 สถาน
		*/
		$sql = "SELECT 
				pv, budgetyear,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 1) TYPEMAIN1,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 2) TYPEMAIN2,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 3) TYPEMAIN3,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 4) TYPEMAIN4,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 5) TYPEMAIN5,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 6) TYPEMAIN6,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 1) UNDER_TYPE1,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 2) UNDER_TYPE2,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 3) UNDER_TYPE3,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 1) TYPECHILD1,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 2) TYPECHILD2,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 3) TYPECHILD3,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 4) TYPECHILD4,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 1) SUM_TYPEMAIN1,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 2) SUM_TYPEMAIN2,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 3) SUM_TYPEMAIN3,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 4) SUM_TYPEMAIN4,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 5) SUM_TYPEMAIN5,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 6) SUM_TYPEMAIN6,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 1) SUM_UNDER_TYPE1,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 2) SUM_UNDER_TYPE2,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 3) SUM_UNDER_TYPE3,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 1) SUM_TYPECHILD1,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 2) SUM_TYPECHILD2,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 3) SUM_TYPECHILD3,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 4) SUM_TYPECHILD4
				FROM 
				(SELECT DISTINCT PROVINCE pv,YEAR_DATA budgetyear FROM CHILDFUND_ORG WHERE YEAR_DATA = ".$year." ORDER BY PROVINCE ASC)";
		$data['childfunds'] = $this->childfund->get($sql,true);
		$this->template->build('report2',$data);
	}
	
	function export2($year){
		/*
		 * ประเภทการสนับสนุน : โครงการ
		 * TYPEMAIN1 = สงเคราะห์
		 * TYPEMAIN2 = คุ้มครองสวัสดิภาพ
		 * TYPEMAIN3 = ส่งเสริมความประพฤติ
		 * TYPEMAIN4 = 5 สถาน
		 * TYPEMAIN5 = งานวิจัย
		 * TYPEMAIN6 = อื่นๆ
		 * 
		 * องค์กร
		 * UNDER_TYPE1 = หน่วยงานของรัฐ
		 * UNDER_TYPE2 = องค์กรสาธารณประโยชน์
		 * UNDER_TYPE3 = องค์กรสวัสดิการชุมชน
		 * 
		 * เด็ก
		 * TYPECHILD1 = เด็กในโรงเรียน
		 * TYPECHILD2 = เด็กในชุมชน
		 * TYPECHILD3 = เด็กในชุมชน
		 * TYPECHILD4 = 5 สถาน
		*/
		$sql = "SELECT 
				pv, budgetyear,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 1) TYPEMAIN1,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 2) TYPEMAIN2,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 3) TYPEMAIN3,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 4) TYPEMAIN4,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 5) TYPEMAIN5,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 6) TYPEMAIN6,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 1) UNDER_TYPE1,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 2) UNDER_TYPE2,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 3) UNDER_TYPE3,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 1) TYPECHILD1,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 2) TYPECHILD2,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 3) TYPECHILD3,
				(SELECT COUNT(PROJECT_NAME) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 4) TYPECHILD4,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 1) SUM_TYPEMAIN1,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 2) SUM_TYPEMAIN2,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 3) SUM_TYPEMAIN3,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 4) SUM_TYPEMAIN4,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 5) SUM_TYPEMAIN5,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPEMAIN = 6) SUM_TYPEMAIN6,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 1) SUM_UNDER_TYPE1,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 2) SUM_UNDER_TYPE2,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 3) SUM_UNDER_TYPE3,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 1) SUM_TYPECHILD1,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 2) SUM_TYPECHILD2,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 3) SUM_TYPECHILD3,
				(SELECT NVL(SUM(COST_GET),0) FROM CHILDFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND TYPECHILD = 4) SUM_TYPECHILD4
				FROM 
				(SELECT DISTINCT PROVINCE pv,YEAR_DATA budgetyear FROM CHILDFUND_ORG WHERE YEAR_DATA = ".$year." ORDER BY PROVINCE ASC)";
		$data['childfunds'] = $this->childfund->get($sql,true);
		
		$filename= "childfund_report_organization_data_".$year.".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export2',$data);
	}
	
	function report3($year){
		$data['years'] = $this->childfund->get("SELECT DISTINCT YEAR_DATA FROM CHILDFUND ORDER BY YEAR_DATA DESC");
		
		$data['childfunds'] = $this->childfund->where('year_data = '.$year)->get(false,true);
		$this->template->build('report3',$data);
	}
	
	function export3($year){
		$data['childfunds'] = $this->childfund->where('year_data = '.$year)->get(false,true);
		
		$filename= "childfund_report_data_".$year.".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export3',$data);
	}
	
	function test(){
		$sql = "SELECT
			PPT.APP4_FUND_PROJECT.PROJECT_ID,
			PPT.APP4_FUND_PROJECT.BUDGET_YEAR,
			PPT.APP4_ADMIN_PROVINCE.PROVINCE_NAME,
			PPT.APP4_FUND_PROJECT.PROJECT_NAME,
			PPT.APP4_FUND_PROJECT.TYPECHILD,
			PPT.APP4_FUND_PROJECT.TYPEPMAIN,
			PPT.APP4_LAW3_ORGANIZATION_MAIN.UNDER_TYPE,
			PPT.APP4_FUND_PROJECT.COST_GET,
			PPT.APP4_LAW3_ORGANIZATION_MAIN.ORGAN_ID
			FROM
			PPT.APP4_FUND_PROJECT
			INNER JOIN PPT.APP4_ADMIN_PROVINCE ON PPT.APP4_FUND_PROJECT.OPERATE_PROVINCE = PPT.APP4_ADMIN_PROVINCE.PROVINCE_CODE
			INNER JOIN PPT.APP4_LAW3_ORGANIZATION_MAIN ON PPT.APP4_FUND_PROJECT.ORG_ID = PPT.APP4_LAW3_ORGANIZATION_MAIN.ORGAN_ID
			WHERE FUND_ID = 4
			ORDER BY PPT.APP4_FUND_PROJECT.BUDGET_YEAR,PPT.APP4_ADMIN_PROVINCE.PROVINCE_NAME asc";
		$data['app4'] = $this->childfund->get($sql,true);
		
		$filename= "childfund_app4_report_data.xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export_app4',$data);
	}
}