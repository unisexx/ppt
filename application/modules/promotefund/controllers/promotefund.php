<?php
Class Promotefund extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('promotefund_org_model', 'promotefund_org');
	}
	public $menu_id=115;
	
	function index(){
		$data['years'] = $this->promotefund_org->get('SELECT DISTINCT YEAR_DATA from PROMOTEFUND_ORG ORDER BY YEAR_DATA DESC');
		$data['provinces'] = $this->promotefund_org->get('SELECT DISTINCT PROVINCE from PROMOTEFUND_ORG ORDER BY PROVINCE ASC');
		
		$condition = " 1=1 ";
		if(@$_GET['year_data']) $condition .= "AND YEAR_DATA = ".$_GET['year_data'].' ';
		if(@$_GET['province']) $condition .= "AND PROVINCE = '".$_GET['province']."'";
		$data['promotefunds'] = $this->promotefund_org->where($condition)->get(false,true);
		$this->template->build('index',$data);
	}
	
	function form_import(){
		$data['menu_id'] = 115;
		$this->template->build('form_import',$data);
	}
	
	function import(){ // ประเภทบุคคล
		// Report all PHP errors (see changelog)
		// error_reporting(E_ALL);
		// $this->db->debug = true;
		
		// $year_data = $_POST['year_data'];
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
			$this->promotefund_org->delete();
			
			header('Content-Type: text/html; charset=utf-8');
			for($i = 4; $i <= $data -> sheets[0]['numRows']; $i++) {
				if(is_numeric(@trim($data -> sheets[0]['cells'][$i][1]))){ //ถ้าคอลัมน์แรกเป็นตัวเลข ให้ fetch ข้อมูล
					$value = null;			
					
					$value['YEAR_DATA'] = @trim($data -> sheets[0]['cells'][$i][1]);
					$value['PROVINCE'] = (@trim($data -> sheets[0]['cells'][$i][2] == ''))?'ไม่ระบุ':@trim($data -> sheets[0]['cells'][$i][2]);
					$value['PROJECT_NAME'] = @trim($data -> sheets[0]['cells'][$i][3]);
					$value['UNDER_TYPE'] = chk_numeric(@trim($data -> sheets[0]['cells'][$i][4]));
					$value['COST_GET'] = chk_numeric(@trim($data -> sheets[0]['cells'][$i][5]));
					// $value['ORGAN_ID'] = chk_numeric(trim($data -> sheets[0]['cells'][$i][6]));
					
					// echo"<pre>";
					// echo print_r($value);
					// echo"</pre>";
					
					$this->promotefund_org->save($value);
				}
				
			}
			set_notify('success', 'นำเข้าข้อมูลเรียบร้อย');
		}
		redirect('childfund/form_import');
	}


	function report1(){
		$sql = "SELECT 
				BUDGETYEAR,
				(SELECT NVL(count(PROJECT_NAME),0) FROM PROMOTEFUND_ORG d WHERE YEAR_DATA = BUDGETYEAR)ORG_SUM,
				(SELECT NVL(sum(COST_GET),0) FROM PROMOTEFUND_ORG d WHERE YEAR_DATA = BUDGETYEAR)ORG_TOTAL_SUM
				FROM 
				(SELECT DISTINCT YEAR_DATA BUDGETYEAR from PROMOTEFUND_ORG ORDER BY BUDGETYEAR DESC)TMP_TABLE_1";
		$data['promotefunds'] = $this->promotefund_org->get($sql);
		
		$this->template->title('รายงานองค์กรที่ได้รับการสนับสนุนเงินจากกองทุนส่งเสริมการจัดการสวัสดิการสังคมทั้งประเทศ ระบบฐานข้อมูลทางสังคม สป.พม.');
		$this->template->append_metadata( meta('keywords','ระบบฐานข้อมูลทางสังคม,ระบบฐานข้อมูลด้านสังคม,ฐานข้อมูลด้านสังคม,ฐานข้อมูลทางสังคม,กลุ่มเป้าหมาย,เชิงประเด็น,สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,พม.,สป.พม.,สป.,ข้อมูลด้านสังคม,ข้อมูลทางสังคม,ข้อมูลสังคม,องค์กรที่ได้รับการสนับสนุนจากกองทุนส่งเสริม,กองทุนส่งเสริมการจัดสวัสดิการสังคม,ข้อมูลกองทุนส่งเสริม,กองทุนสวัสดิการสังคม,สวัสดิการสังคม,องค์กรที่ได้รับการสนับสนุนเงิน'));
		
		$this->template->build('report1',$data);
	}
	
	function export1(){
		$sql = "SELECT 
				BUDGETYEAR,
				(SELECT NVL(count(PROJECT_NAME),0) FROM PROMOTEFUND_ORG d WHERE YEAR_DATA = BUDGETYEAR)ORG_SUM,
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