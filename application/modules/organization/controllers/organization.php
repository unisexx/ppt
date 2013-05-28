<?php
Class organization extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('organization_main_model','org_main');
		$this->load->model('info_model','info');
	}
	public $menu_id = 102;
	function index(){
		$this->db->debug =false;
		$data['menu_id'] = $this->menu_id;
		$condition = "1=1";
		$condition.= @$_GET['year_data']!='' ? " AND YEAR_DATA=".$_GET['year_data'] : "";
		$condition.= @$_GET['province_id']!='' ? " AND PROVINCE_ID=".$_GET['province_id'] : "";
		$condition.= @$_GET['amphur_id']!='' ? " AND AMPHUR_ID=".$_GET['amphur_id'] : "";
		$condition.= @$_GET['district_id']!='' ? " AND DISTRICT_ID=".$_GET['district_id'] : "";
		$select = " ORGANIZATION_MAIN.* , ORGANIZATION_TYPE.TITLE TYPE_TITLE, ORGANIZATION_TYPE_SUB.TITLE TYPE_SUB_TITLE ";
		$join = " LEFT JOIN ORGANIZATION_TYPE ON ORGANIZATION_MAIN.UNDER_TYPE = ORGANIZATION_TYPE.ID ";
		$join.= " LEFT JOIN ORGANIZATION_TYPE_SUB ON ORGANIZATION_MAIN.UNDER_TYPE_SUB = ORGANIZATION_TYPE_SUB.ID ";
		$data['data'] = $this->org_main->select($select)->join($join)->where($condition)->order_by('ORGANIZATION_MAIN.ID','desc')->get();
		$data['pagination'] = $this->org_main->pagination();
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('index',$data);
	}
	
	function form($id=FALSE){
		$data['menu_id'] = $this->menu_id;		
		$data['item'] = $this->org_main->get_row($id);
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('form_1',$data);
	}
	
	function save(){
		if(!menu::perm($this->menu_id, 'add') || !menu::perm($this->menu_id,'edit'))redirect('population/index');
		$_POST['PROVINCE_NAME'] = $this->province->select("PROVINCE")->where("ID=".$_POST['province_id'])->get_one();
		$_POST['AMPHUR_NAME'] = $_POST['amphur_id'] > 0 ? $this->amphur->select("amphur_name")->where("ID=".$_POST['amphur_id'])->get_one() : "";
		$_POST['DISTRICT_NAME'] = $_POST['district_id'] > 0 ? $this->district->select("district_name")->where("ID=".$_POST['district_id'])->get_one() : "";
		$id = $this->ppl->save($_POST);
		$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$id);
		
		for($i=1;$i<=102;$i++){
			$value['age_range_code'] = $i;
			$value['pid'] = $id;
			$value['nunit'] = $_POST['male_'.$i];
			$this->ppl_detail->save($value);
		}
		
		for($i=1;$i<=102;$i++){
			$value['age_range_code'] = $i+102;
			$value['pid'] = $id;
			$value['nunit'] = $_POST['female_'.$i];
			$this->ppl_detail->save($value);
		}
		redirect('population/index');
	}

	function delete($id=FALSE){
		$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$id);
		$this->db->execute("DELETE FROM POPULATION WHERE ID=".$id);
		redirect('population/index');
	}
	
	function import_form(){
		$data['menu_id'] = $this->menu_id;
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');		
		$this->template->build('population_import_form',$data);
	}
	
	function population_import(){
		if($_FILES['fl_import']['name']!=''){
			/*---for insert value to info table ---*/
			$import_section_id = $_POST['import_workgroup_id']> 0 ? $_POST['import_workgroup_id'] : $_POST['import_section_id'];
			$_POST['section_id'] = $import_section_id;
			$this->info->save($_POST);
			/*--end--*/
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'population_'.$_POST['year_data'].'_'.$_POST['province_id'].date("Y_m_d_H_i_s").'.'.$ext;			
			$uploaddir = 'import_file/population/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);		
			$data = $this->ReadData($uploaddir.$file_name);			
			foreach($data as $item):								
				if($item['value_length']==1712){
					$chars = str_split($item['value'] , 8);
					$item['title']."<br>";
					if (strpos($item['title'], 'จังหวัด')!==false) {
						$province_name = str_replace('จังหวัด', '', $item['title']);
						$val['ID'] = $this->ppl->select('id')->where(" PROVINCE_ID=".$_POST['province_id']." AND AMPHUR_ID=0 AND DISTRICT_ID=0 AND YEAR_DATA=".$_POST['year_data'])->get_one();
						if($val['ID']>0){
							$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$val['ID']);
						}						
						$province = $this->province->where(" province='".iconv('utf-8','tis-620',$province_name)."'")->get_row();
						$province_id = $province['id'];		
						$val['PROVINCE_ID'] = $province_id;
						$val['PROVINCE_NAME'] = $province_name;
						$val['AMPHUR_ID'] = '';
						$val['AMPHUR_NAME'] = '';
						$val['DISTRICT_ID'] = '';
						$val['DISTRICT_NAME'] = '';			
						$val['YEAR_DATA'] = $_POST['year_data'];					
						$val['LUNAR_CAL_MALE'] = (int)$chars[204];
						$val['LUNAR_CAL_FEMALE'] = (int)$chars[205];
						$val['CENTRAL_HH_MALE'] = (int)$chars[206];
						$val['CENTRAL_HH_FEMALE'] = (int)$chars[207];
						$val['NO_THAI_MALE'] = (int)$chars[208];
						$val['NO_THAI_FEMALE'] = (int)$chars[209];
						$val['IN_TRANS_MALE'] = (int)$chars[210];
						$val['IN_TRANS_FEMALE'] = (int)$chars[211];
						$val['SUM_MALE'] = (int)$chars[212];
						$val['SUM_FEMALE'] = (int)$chars[213];
						$val['IMPORT_SECTION_ID'] = (int)$import_section_id;
						$id = $this->ppl->save($val);					
						
						for($i=0;$i<=203;$i++){
							$val_sub['PID'] = $id;
							$val_sub['AGE_RANGE_CODE'] = $i+1;
							$val_sub['NUNIT'] = $chars[$i];
							$this->ppl_detail->save($val_sub);
						}					
					}
					else if (strpos($item['title'], 'อำเภอ')!==false) {
						$amphur_name = strpos($item['title'], 'อำเภอ')!==false ? str_replace('อำเภอ', '', $item['title']) : strpos($item['title'], 'เทศบาล')!==false;
						$amphur = $this->amphur->where(" province_id=".$province_id." AND AMPHUR_NAME='".iconv('utf-8','tis-620',$amphur_name)."'")->get_row();
						$amphur_id = $amphur['id'];
						$val['ID'] = $this->ppl->select('id')->where(" PROVINCE_ID=".$_POST['province_id']." AND AMPHUR_ID=".$amphur_id." AND DISTRICT_ID=0 AND YEAR_DATA=".$_POST['year_data'])->get_one();
						if($val['ID']>0){
							$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$val['ID']);
						}
						$val['PROVINCE_ID'] = $province_id;
						$val['PROVINCE_NAME'] = $province_name;
						$val['AMPHUR_ID'] = $amphur_id;
						$val['AMPHUR_NAME'] = $amphur_name;
						$val['DISTRICT_ID'] = '';
						$val['DISTRICT_NAME'] = '';		
						$val['YEAR_DATA'] = $_POST['year_data'];					
						$val['LUNAR_CAL_MALE'] = (int)$chars[204];
						$val['LUNAR_CAL_FEMALE'] = (int)$chars[205];
						$val['CENTRAL_HH_MALE'] = (int)$chars[206];
						$val['CENTRAL_HH_FEMALE'] = (int)$chars[207];
						$val['NO_THAI_MALE'] = (int)$chars[208];
						$val['NO_THAI_FEMALE'] = (int)$chars[209];
						$val['IN_TRANS_MALE'] = (int)$chars[210];
						$val['IN_TRANS_FEMALE'] = (int)$chars[211];
						$val['SUM_MALE'] = (int)$chars[212];
						$val['SUM_FEMALE'] = (int)$chars[213];
						$val['IMPORT_SECTION_ID'] = (int)$import_section_id;
						$id = $this->ppl->save($val);					
						
						for($i=0;$i<=203;$i++){
							$val_sub['PID'] = $id;
							$val_sub['AGE_RANGE_CODE'] = $i+1;
							$val_sub['NUNIT'] = $chars[$i];
							$this->ppl_detail->save($val_sub);
						}				
					}
					else if (strpos($item['title'], 'ตำบล')!==false && strpos($item['title'], 'เทศบาล')===false) {
						$district_name = str_replace('ตำบล', '', $item['title']);
						$district = $this->district->where(" province_id=".$province_id."  AND DISTRICT_NAME='".iconv('utf-8','tis-620',$district_name)."'")->get_row();
						$amphur = $this->amphur->get_row($district['amphur_id']);
						$district_id = $district['id'];
						$val['ID'] = $this->ppl->select('id')->where(" PROVINCE_ID=".$province_id." AND AMPHUR_ID=".$district['amphur_id']." AND DISTRICT_ID=".$district_id." AND YEAR_DATA=".$_POST['year_data'])->get_one();
						if($val['ID']>0){
							$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$val['ID']);
						}
						$val['PROVINCE_ID'] = $province_id;
						$val['PROVINCE_NAME'] = $province_name;
						$val['AMPHUR_ID'] = $amphur['id'];
						$val['AMPHUR_NAME'] = $amphur['amphur_name'];
						$val['DISTRICT_ID'] = $district_id;
						$val['DISTRICT_NAME'] = $district_name;		
						$val['YEAR_DATA'] = $_POST['year_data'];					
						$val['LUNAR_CAL_MALE'] = (int)$chars[204];
						$val['LUNAR_CAL_FEMALE'] = (int)$chars[205];
						$val['CENTRAL_HH_MALE'] = (int)$chars[206];
						$val['CENTRAL_HH_FEMALE'] = (int)$chars[207];
						$val['NO_THAI_MALE'] = (int)$chars[208];
						$val['NO_THAI_FEMALE'] = (int)$chars[209];
						$val['IN_TRANS_MALE'] = (int)$chars[210];
						$val['IN_TRANS_FEMALE'] = (int)$chars[211];
						$val['SUM_MALE'] = (int)$chars[212];
						$val['SUM_FEMALE'] = (int)$chars[213];
						$val['IMPORT_SECTION_ID'] = (int)$import_section_id;
						$id = $this->ppl->save($val);					
						for($i=0;$i<=203;$i++){
							$val_sub['PID'] = $id;
							$val_sub['AGE_RANGE_CODE'] = $i+1;
							$val_sub['NUNIT'] = $chars[$i];
							$this->ppl_detail->save($val_sub);
						}						
					}
				}				
			endforeach;							
		}
		/*echo "<script>window.location='population';</script>";*/
		redirect('population/index');
	}

	function ReadData($filepath){
		require_once 'include/Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data -> setOutputEncoding('UTF-8');
		$data -> read($filepath);
//		error_reporting(E_ALL ^ E_NOTICE);
		$index = 0;
		for($i = 1; $i <= $data -> sheets[0]['numRows']; $i++) {
			$import[$index]['title'] = trim($data -> sheets[0]['cells'][$i][1]);
			$import[$index]['value'] = trim($data -> sheets[0]['cells'][$i][2]);
			$import[$index]['value_length'] = strlen($import[$index]['value']);								 
			$index++;			
		}		
		return $import;
	}
}
?>