<?php
Class Disablefund extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('info_model','info');
		$this->load->model('disablefund_people_model','people');
		$this->load->model('disablefund_project_model','project');
		$this->load->model('province_model','province');
		
		// error_reporting(-1);
	}
	public $menu_id=117;
	
	function form_import(){
		$data['menu_id'] = 117; 
		$data['provinces'] = $this->province->order_by('province','asc')->get(FALSE,TRUE);
		$this->template->build('form_import',$data);
	}
	
	function import(){
		// Report all PHP errors (see changelog)
		// error_reporting(E_ALL);
		// $this->db->debug = true;
		
		$year_data = $_POST['year_data'];
		$province = $_POST['province'];
		$disabled_type = $_POST['disabled_type'];
		
		// $_POST['SECTION_ID'] = ($_POST['WORKGROUP_ID']>0)?$_POST['WORKGROUP_ID']:$_POST['SECTION_ID'];
        // $this->info->save($_POST);
		// unset($_POST);
		
		set_time_limit(0);
		
		if($disabled_type == "people"){
			$start_row = 4;
			$table = 'DISABLEFUND_PEOPLE';
		}elseif($disabled_type == "project"){
			$start_row = 4;
			$table = 'DISABLEFUND_PROJECT';
		}
		$columns = $this->db->MetaColumnNames($table);
		foreach($columns as $item){
			$column[] = $item;
		}
		
		// print_r($columns);
		
		if($_FILES['fl_import']['name']!=''){						
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = $disabled_type.'_'.$year_data.'_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/disablefund/'.$disabled_type.'/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
			
			
			require_once 'include/Excel/reader.php';
			$data = new Spreadsheet_Excel_Reader();
			$data -> setOutputEncoding('UTF-8');
			$data -> read($uploaddir.$file_name);
			
			// ลบข้อมูลเก่าแล้วบันทึกข้อมูลใหม่เข้าไป
			if($disabled_type == "people"){
				$this->people->where("YEAR_DATA = ".$year_data." AND PROVINCE = '".iconv('UTF-8', 'TIS-620', $province)."'")->delete();
			}elseif($disabled_type == "project"){
				$this->project->delete('YEAR_DATA',$year_data);	
			}
			
			// $this->db->debug = true;
			
			header('Content-Type: text/html; charset=utf-8');
			for($i = $start_row; $i <= $data -> sheets[0]['numRows']; $i++) {
				$value = null;
				
				if($disabled_type == "people"){
					
					if(@trim($data -> sheets[0]['cells'][$i][1]) != "ประเภทความพิการ" and @trim($data -> sheets[0]['cells'][$i][1]) != "" and $i>=4){
						$value['YEAR_DATA'] = $year_data;
						$value['PROVINCE'] = $province;
						$value['DISABLE_TYPE'] = @trim($data -> sheets[0]['cells'][$i][1]);
						$value['PEOPLE'] = chk_numeric(@trim($data -> sheets[0]['cells'][$i][2]));
						$value['AMOUNT'] = chk_numeric(@trim($data -> sheets[0]['cells'][$i][3]));
						
						// echo"<pre>";
						// echo print_r($value);
						// echo"</pre>";
						
						$this->$disabled_type->save($value);
					}
					
				}elseif($disabled_type == "project"){
					
					if(@trim($data -> sheets[0]['cells'][$i][1]) != "โครงการ" and @trim($data -> sheets[0]['cells'][$i][1]) != ""){
						$value['YEAR_DATA'] = $year_data;
						$value['PROVINCE'] = (@trim($data -> sheets[0]['cells'][$i][3]) == "") ? "ไม่ระบุ" : trim($data -> sheets[0]['cells'][$i][3]) ;
						$value['PROJECT'] = @trim($data -> sheets[0]['cells'][$i][1]);
						$value['ORGANIZATION'] = @trim($data -> sheets[0]['cells'][$i][2]);
						$value['REQUEST'] = chk_numeric(@trim($data -> sheets[0]['cells'][$i][4]));
						$value['APPROVE'] = chk_numeric(@trim($data -> sheets[0]['cells'][$i][5]));
						$value['NO'] = @trim($data -> sheets[0]['cells'][$i][6]);
						$value['YEAR'] = @trim($data -> sheets[0]['cells'][$i][7]);
						$value['DATE'] = convertThaiyear(@trim($data -> sheets[0]['cells'][$i][8]));
						
						// echo"<pre>";
						// echo print_r($value);
						// echo"</pre>";
						
						$this->$disabled_type->save($value);
					}
					
				}
				
			}
			set_notify('success', 'นำเข้าข้อมูลเรียบร้อย');
		}
		redirect('disablefund/form_import');
	}

	
	function report_all(){
		$sql = 'SELECT 
				BUDGETYEAR, 
				(SELECT NVL(sum(PEOPLE),0) FROM DISABLEFUND_PEOPLE d WHERE YEAR_DATA=BUDGETYEAR)PEOPLE_SUM,
				(SELECT NVL(sum(AMOUNT),0) FROM DISABLEFUND_PEOPLE d WHERE YEAR_DATA=BUDGETYEAR)TOTAL_SUM,
				(SELECT NVL(count("PROJECT"),0) FROM DISABLEFUND_PROJECT d WHERE YEAR_DATA = BUDGETYEAR)PROJECT_SUM,
				(SELECT NVL(sum(APPROVE),0) FROM DISABLEFUND_PROJECT d WHERE YEAR_DATA = BUDGETYEAR)APPROVE_SUM
				FROM 
				(SELECT DISTINCT YEAR_DATA BUDGETYEAR from DISABLEFUND_PEOPLE UNION SELECT DISTINCT YEAR_DATA BUDGETYEAR from DISABLEFUND_PROJECT ORDER BY BUDGETYEAR DESC)TMP_TABLE_1';
		$data['disablefunds'] = $this->people->get($sql);
		$this->template->build('report_all',$data);
	}
	
	function export_all(){
		$sql = 'SELECT 
				BUDGETYEAR, 
				(SELECT NVL(sum(PEOPLE),0) FROM DISABLEFUND_PEOPLE d WHERE YEAR_DATA=BUDGETYEAR)PEOPLE_SUM,
				(SELECT NVL(sum(AMOUNT),0) FROM DISABLEFUND_PEOPLE d WHERE YEAR_DATA=BUDGETYEAR)TOTAL_SUM,
				(SELECT NVL(count("PROJECT"),0) FROM DISABLEFUND_PROJECT d WHERE YEAR_DATA = BUDGETYEAR)PROJECT_SUM,
				(SELECT NVL(sum(APPROVE),0) FROM DISABLEFUND_PROJECT d WHERE YEAR_DATA = BUDGETYEAR)APPROVE_SUM
				FROM 
				(SELECT DISTINCT YEAR_DATA BUDGETYEAR from DISABLEFUND_PEOPLE UNION SELECT DISTINCT YEAR_DATA BUDGETYEAR from DISABLEFUND_PROJECT ORDER BY BUDGETYEAR DESC)TMP_TABLE_1';
				
		$filename= "disablefund_export_all.xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		
		$data['disablefunds'] = $this->people->get($sql);
		$this->load->view('export_all',$data);
	}
	
	function report_people1(){
		$data['years'] = $this->project->get("SELECT DISTINCT YEAR_DATA FROM DISABLEFUND_PEOPLE ORDER BY YEAR_DATA ASC",FALSE);
		
		$sql = 'SELECT 
				pv, budgetyear,
				(SELECT NVL(sum(PEOPLE),0) FROM DISABLEFUND_PEOPLE WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR) PEOPLE_SUM,
				(SELECT NVL(sum(AMOUNT),0) FROM DISABLEFUND_PEOPLE d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TOTAL_SUM
				FROM 
				(SELECT DISTINCT PROVINCE pv,YEAR_DATA BUDGETYEAR FROM DISABLEFUND_PEOPLE WHERE YEAR_DATA = '.$_GET['year'].' ORDER BY PROVINCE ASC)';
		$data['disablefunds'] = $this->people->get($sql);
		$this->template->build('report_people1',$data);
	}

	function export_people1(){
		$data['years'] = $this->project->get("SELECT DISTINCT YEAR_DATA FROM DISABLEFUND_PEOPLE ORDER BY YEAR_DATA ASC",FALSE);
		
		$sql = 'SELECT 
				pv, budgetyear,
				(SELECT NVL(sum(PEOPLE),0) FROM DISABLEFUND_PEOPLE WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR) PEOPLE_SUM,
				(SELECT NVL(sum(AMOUNT),0) FROM DISABLEFUND_PEOPLE d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)TOTAL_SUM
				FROM 
				(SELECT DISTINCT PROVINCE pv,YEAR_DATA BUDGETYEAR FROM DISABLEFUND_PEOPLE WHERE YEAR_DATA = '.$_GET['year'].' ORDER BY PROVINCE ASC)';
		
		$filename= "disablefund_export_people1".$_GET['year'].".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$data['disablefunds'] = $this->people->get($sql);
		$this->load->view('export_people1',$data);
	}
	
	function report_people2(){
		$data['years'] = $this->project->get("SELECT DISTINCT YEAR_DATA FROM DISABLEFUND_PEOPLE ORDER BY YEAR_DATA ASC",FALSE);
		$data['provinces'] = $this->project->get("SELECT DISTINCT PROVINCE FROM DISABLEFUND_PEOPLE",FALSE);
		
		$condition = " 1=1 ";
		$condition .= @$_GET['year'] != '' ? " and year_data = ".$_GET['year'] : "" ;
		$condition .= @$_GET['province'] != '' ? " and province = '".$_GET['province']."'" : "" ;
		
		$sql = 'SELECT 
				dis_type,
				(SELECT NVL(sum(PEOPLE),0) FROM DISABLEFUND_PEOPLE WHERE '.$condition.' AND DISABLE_TYPE = dis_type) PEOPLE_SUM,
				(SELECT NVL(sum(AMOUNT),0) FROM DISABLEFUND_PEOPLE d WHERE '.$condition.' AND DISABLE_TYPE = dis_type)TOTAL_SUM
				FROM 
				(SELECT DISTINCT DISABLE_TYPE dis_type FROM DISABLEFUND_PEOPLE WHERE '.$condition.')';
		
		$data['disablefunds'] = $this->people->get($sql);
		$this->template->build('report_people2',$data);
	}
	
	function export_people2(){
		$condition = " 1=1 ";
		$condition .= @$_GET['year'] != '' ? " and year_data = ".$_GET['year'] : "" ;
		$condition .= @$_GET['province'] != '' ? " and province = '".$_GET['province']."'" : "" ;
		
		$sql = 'SELECT 
				dis_type,
				(SELECT NVL(sum(PEOPLE),0) FROM DISABLEFUND_PEOPLE WHERE '.$condition.' AND DISABLE_TYPE = dis_type) PEOPLE_SUM,
				(SELECT NVL(sum(AMOUNT),0) FROM DISABLEFUND_PEOPLE d WHERE '.$condition.' AND DISABLE_TYPE = dis_type)TOTAL_SUM
				FROM 
				(SELECT DISTINCT DISABLE_TYPE dis_type FROM DISABLEFUND_PEOPLE WHERE '.$condition.')';
		
		$filename= "disablefund_export_people2".$_GET['year']."_".$_GET['province'].".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$data['disablefunds'] = $this->people->get($sql);
		$this->load->view('export_people2',$data);
	}
	
	function report_project1(){
		$data['years'] = $this->project->get("SELECT DISTINCT YEAR_DATA FROM DISABLEFUND_PROJECT ORDER BY YEAR_DATA ASC",FALSE);
		
		$sql = 'SELECT 
				pv, budgetyear,
				(SELECT COUNT("PROJECT") FROM DISABLEFUND_PROJECT WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR) PROJECT_SUM,
				(SELECT NVL(sum(APPROVE),0) FROM DISABLEFUND_PROJECT d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)APPROVE_SUM
				FROM 
				(SELECT DISTINCT PROVINCE pv,YEAR_DATA BUDGETYEAR FROM DISABLEFUND_PROJECT WHERE YEAR_DATA = '.$_GET['year'].' ORDER BY PROVINCE ASC)';
		$data['disablefunds'] = $this->people->get($sql,true);
		$this->template->build('report_project1',$data);
	}
	
	function export_project1(){
		$sql = 'SELECT 
				pv, budgetyear,
				(SELECT COUNT("PROJECT") FROM DISABLEFUND_PROJECT WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR) PROJECT_SUM,
				(SELECT NVL(sum(APPROVE),0) FROM DISABLEFUND_PROJECT d WHERE PROVINCE = pv AND YEAR_DATA = BUDGETYEAR)APPROVE_SUM
				FROM 
				(SELECT DISTINCT PROVINCE pv,YEAR_DATA BUDGETYEAR FROM DISABLEFUND_PROJECT WHERE YEAR_DATA = '.$_GET['year'].' ORDER BY PROVINCE ASC)';
		$data['disablefunds'] = $this->people->get($sql,true);
		
		$filename= "disablefund_export_project1_".$_GET['year'].".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export_project1',$data);
	}
	
	function report_project2(){
		$this->template->build('report_project2');
	}
	
	function report_project3(){
		$data['years'] = $this->project->get("SELECT DISTINCT YEAR_DATA FROM DISABLEFUND_PROJECT ORDER BY YEAR_DATA ASC",FALSE);
		$data['provinces'] = $this->project->get("SELECT DISTINCT PROVINCE FROM DISABLEFUND_PROJECT",FALSE);
		
		$condition = " 1=1 ";
		$condition .= @$_GET['year'] != '' ? " and year_data = ".$_GET['year'] : "" ;
		$condition .= @$_GET['province'] != '' ? " and province = '".$_GET['province']."'" : "" ;
		
		$data['disablefunds'] = $this->project->where($condition)->get(FALSE,TRUE);
		$this->template->build('report_project3',$data);
	}

	function export_project3(){
		$condition = " 1=1 ";
		$condition .= @$_GET['year'] != '' ? " and year_data = ".$_GET['year'] : "" ;
		$condition .= @$_GET['province'] != '' ? " and province = '".$_GET['province']."'" : "" ;
		
		$data['disablefunds'] = $this->project->where($condition)->get(FALSE,TRUE);
		
		$filename= "disablefund_export_project3_".$_GET['year']."_".$_GET['province'].".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$this->load->view('export_project3',$data);
	}
}