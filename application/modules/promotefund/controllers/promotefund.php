<?php
Class Promotefund extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('promotefund_org_model', 'promotefund_org');
	}
	public $menu_id=113;
	
	function index(){
		$data['promotefunds'] = $this->promotefund_org->get(false,true);
		$this->template->build('index',$data);
	}
	
	function form_import(){
		$data['menu_id'] = 113;
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
		
		$table = 'PROMOTEFUND_ORG';
		$columns = $this->db->MetaColumnNames($table);
		foreach($columns as $item){
			$column[] = $item;
		}
		if($_FILES['fl_import']['name']!=''){						
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'childfund_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/promotefund/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
			
			
			require_once 'include/Excel/reader.php';
			$data = new Spreadsheet_Excel_Reader();
			$data -> setOutputEncoding('UTF-8');
			$data -> read($uploaddir.$file_name);
			
			// ลบข้อมูลเก่าแล้วบันทึกข้อมูลใหม่เข้าไป
			$this->promotefund_org->delete('YEAR_DATA',$year_data);
			
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
				
				$this->promotefund_org->save($value);
			}
			set_notify('success', 'นำเข้าข้อมูลเรียบร้อย');
		}
		redirect('childfund/form_import');
	}


	function report1(){
		$sql = "SELECT 
				BUDGETYEAR,
				(SELECT NVL(count(ORGAN_ID),0) FROM PROMOTEFUND_ORG d WHERE YEAR_DATA = BUDGETYEAR)ORG_SUM,
				(SELECT NVL(sum(COST_GET),0) FROM PROMOTEFUND_ORG d WHERE YEAR_DATA = BUDGETYEAR)ORG_TOTAL_SUM
				FROM 
				(SELECT DISTINCT YEAR_DATA BUDGETYEAR from PROMOTEFUND_ORG ORDER BY BUDGETYEAR DESC)TMP_TABLE_1";
		$data['promotefunds'] = $this->promotefund_org->get($sql);
		$this->template->build('report1',$data);
	}
	
	function export1(){
		$sql = "SELECT 
				BUDGETYEAR,
				(SELECT NVL(count(ORGAN_ID),0) FROM PROMOTEFUND_ORG d WHERE YEAR_DATA = BUDGETYEAR)ORG_SUM,
				(SELECT NVL(sum(COST_GET),0) FROM PROMOTEFUND_ORG d WHERE YEAR_DATA = BUDGETYEAR)ORG_TOTAL_SUM
				FROM 
				(SELECT DISTINCT YEAR_DATA BUDGETYEAR from PROMOTEFUND_ORG ORDER BY BUDGETYEAR DESC)TMP_TABLE_1";
		$data['promotefunds'] = $this->promotefund_org->get($sql);
		
		$filename= "promotefund_report_data_all.xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export1',$data);
	}
	
	function report2($year){
		$data['years'] = $this->promotefund_org->get("SELECT DISTINCT YEAR_DATA BUDGETYEAR from PROMOTEFUND_ORG ORDER BY BUDGETYEAR DESC");
		
		/*
		 * องค์กร
		 * UNDER_TYPE1 = หน่วยงานของรัฐ
		 * UNDER_TYPE2 = องค์กรสาธารณประโยชน์
		 * UNDER_TYPE3 = องค์กรสวัสดิการชุมชน
		*/
		$sql = "SELECT 
				pv, budgetyear,
				(SELECT COUNT(PROJECT_NAME) FROM PROMOTEFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 1) UNDER_TYPE1,
				(SELECT COUNT(PROJECT_NAME) FROM PROMOTEFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 2) UNDER_TYPE2,
				(SELECT COUNT(PROJECT_NAME) FROM PROMOTEFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 3) UNDER_TYPE3,
				(SELECT NVL(SUM(COST_GET),0) FROM PROMOTEFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 1) SUM_UNDER_TYPE1,
				(SELECT NVL(SUM(COST_GET),0) FROM PROMOTEFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 2) SUM_UNDER_TYPE2,
				(SELECT NVL(SUM(COST_GET),0) FROM PROMOTEFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 3) SUM_UNDER_TYPE3
				FROM 
				(SELECT DISTINCT PROVINCE pv,YEAR_DATA budgetyear FROM PROMOTEFUND_ORG WHERE YEAR_DATA = ".$year." ORDER BY PROVINCE ASC)";
		$data['promotefunds'] = $this->promotefund_org->get($sql,true);
		$this->template->build('report2',$data);
	}
	
	function export2($year){
		/*
		 * องค์กร
		 * UNDER_TYPE1 = หน่วยงานของรัฐ
		 * UNDER_TYPE2 = องค์กรสาธารณประโยชน์
		 * UNDER_TYPE3 = องค์กรสวัสดิการชุมชน
		*/
		$sql = "SELECT 
				pv, budgetyear,
				(SELECT COUNT(PROJECT_NAME) FROM PROMOTEFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 1) UNDER_TYPE1,
				(SELECT COUNT(PROJECT_NAME) FROM PROMOTEFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 2) UNDER_TYPE2,
				(SELECT COUNT(PROJECT_NAME) FROM PROMOTEFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 3) UNDER_TYPE3,
				(SELECT NVL(SUM(COST_GET),0) FROM PROMOTEFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 1) SUM_UNDER_TYPE1,
				(SELECT NVL(SUM(COST_GET),0) FROM PROMOTEFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 2) SUM_UNDER_TYPE2,
				(SELECT NVL(SUM(COST_GET),0) FROM PROMOTEFUND_ORG WHERE PROVINCE = pv AND YEAR_DATA = budgetyear AND UNDER_TYPE = 3) SUM_UNDER_TYPE3
				FROM 
				(SELECT DISTINCT PROVINCE pv,YEAR_DATA budgetyear FROM PROMOTEFUND_ORG WHERE YEAR_DATA = ".$year." ORDER BY PROVINCE ASC)";
		$data['promotefunds'] = $this->promotefund_org->get($sql,true);
		
		$filename= "promotefund_report_data_".$year.".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export2',$data);
	}
	
	function test(){
		$sql = "SELECT
			PPT.APP4_FUND_PROJECT.PROJECT_ID,
			PPT.APP4_FUND_PROJECT.BUDGET_YEAR,
			PPT.APP4_ADMIN_PROVINCE.PROVINCE_NAME,
			PPT.APP4_FUND_PROJECT.PROJECT_NAME,
			PPT.APP4_LAW3_ORGANIZATION_MAIN.UNDER_TYPE,
			PPT.APP4_FUND_PROJECT.COST_GET,
			PPT.APP4_LAW3_ORGANIZATION_MAIN.ORGAN_ID
			FROM
			PPT.APP4_FUND_PROJECT
			INNER JOIN PPT.APP4_ADMIN_PROVINCE ON PPT.APP4_FUND_PROJECT.OPERATE_PROVINCE = PPT.APP4_ADMIN_PROVINCE.PROVINCE_CODE
			INNER JOIN PPT.APP4_LAW3_ORGANIZATION_MAIN ON PPT.APP4_FUND_PROJECT.ORG_ID = PPT.APP4_LAW3_ORGANIZATION_MAIN.ORGAN_ID
			WHERE FUND_ID = 7
			ORDER BY PPT.APP4_FUND_PROJECT.BUDGET_YEAR,PPT.APP4_ADMIN_PROVINCE.PROVINCE_NAME asc";
		$data['app4'] = $this->childfund->get($sql,true);
		
		$filename= "promotefund_app4_report_data.xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export_app4',$data);
	}
}