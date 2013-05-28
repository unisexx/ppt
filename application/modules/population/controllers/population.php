<?php
Class population extends Public_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('province_model', 'province');
		$this->load->model('amphur_model','amphur');
		$this->load->model('district_model','district');
		$this->load->model('population_model','ppl');
		$this->load->model('population_detail_model','ppl_detail');
		$this->load->model('info_model','info');
	}
	public $menu_id = 74;
	public $menu_sixtyup_id = 55;
	function index(){
		$data['menu_id'] = $this->menu_id;
		$condition = "1=1";
		$condition.= @$_GET['year_data']!='' ? " AND YEAR_DATA=".$_GET['year_data'] : "";
		$condition.= @$_GET['province_id']!='' ? " AND PROVINCE_ID=".$_GET['province_id'] : "";
		$condition.= @$_GET['amphur_id']!='' ? " AND AMPHUR_ID=".$_GET['amphur_id'] : "";
		$condition.= @$_GET['district_id']!='' ? " AND DISTRICT_ID=".$_GET['district_id'] : "";
		$data['ppl'] = $this->ppl->where($condition)->order_by('year_data desc, province_name, amphur_name, district_name', 'asc')->get();
		$data['pagination'] = $this->ppl->pagination();
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('population_index',$data);
	}
	
	function form($id=FALSE){
		$data['menu_id'] = $this->menu_id;		
		$data['item'] = $this->ppl->get_row($id);
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('population_form',$data);
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
		//$this->db->debug = true;
		if($_FILES['fl_import']['name']!=''){
			set_time_limit(0);
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
						$province_id = @$province['id'];		
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
						$amphur_id = @$amphur['id'];
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
						$district = $this->district->where(" province_id=".$province_id." AND AMPHUR_ID=".$amphur_id."  AND DISTRICT_NAME='".iconv('utf-8','tis-620',$district_name)."'")->get_row();
						$amphur = $this->amphur->get_row($amphur_id);
						$district_id = @$district['id'];
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
	
    function custom_import($year_data){
		//$this->db->debug=true;
		set_time_limit(0);
		$uploaddir = "import_file/population/".$year_data."/";		
		$file_list = scandir($uploaddir);
		$data['file_list'] = $file_list;
		foreach($file_list as $file){
			$lfile[] = iconv('windows-874','utf-8',$file);
		}		
		
		for($i=2;$i<count($lfile);$i++){
			$file_name = $lfile[$i];
			$file = $lfile[$i];
			$finfo = explode('.',$file);
			$province_id = $this->province->select('id')->where(" province='".iconv('utf-8','tis-620',$finfo[0])."'")->get_one();
			if($province_id<1)echo "<span style=\"color:red\">";
			echo iconv('utf-8','tis-620',$finfo[0])."::".$province_id.":::".iconv('utf-8','tis-620',$lfile[$i])."<a href=\"../do_import/".$year_data."/".iconv('utf-8','tis-620',$lfile[$i])."\" target=\"_blank\">Import</a><br>";
			if($province_id<1)echo "</span>";		
			
			$this->do_import($year_data, $lfile[$i]);				
			//rename($uploaddir.$file_name, $uploaddir.$province_id.".xls");
			/*
			$data = $this->ReadData($uploaddir.iconv('utf-8','windows-874',$file_name));
			
			foreach($data as $item):
						$val['ID']='';														
						if($province_id > 0 ){
							$val['ID'] = $this->family->select('id')->where("YEAR_DATA=".$year_data." AND PROVINCE_ID=".$province_id." AND KEY_ID=". (int)$item['key_id'])->get_one();
						}
						$val['YEAR_DATA'] = $year_data;
						$val['PROVINCE_ID'] = $province_id;
						$val['KEY_ID'] = (int)$item['key_id'];
						$val['TITLE'] = $item['title'];
						$val['PASS'] = $item['pass']=='-' ? 0 : (float)$item['pass'];
						$val['PERCENTAGE'] = $item['percentage']=='-' ? 0 :(float)$item['percentage'];
						$val['TARGET'] = $item['target']=='-' ? 0 :(float)$item['target'];
						$val['LOWER_TARGET'] = $item['lower_target']=='-' ? 0 :(float)$item['lower_target'];
						$val['EDIT'] = $item['edit']=='-' ? 0 :(float)$item['edit'];
						if($province_id > 0)$id = $this->family->save($val);	
			endforeach;	
			*/
			 
		}
		
	}	
	
	function do_import($year_data,$file_name){
		$this->db->debug = true;
		if($file_name!='' && $year_data !=''){
			/*--end--*/
			set_time_limit(0);
			$import_section_id=0;
			$if_exist = 0;
			$file_name=iconv('utf-8','tis-620',$file_name);
			$_POST['year_data'] = $year_data;
			$uploaddir = 'import_file/population/'.$year_data.'/';
			$fpicname = $uploaddir.$file_name;
			$data = $this->ReadData($uploaddir.$file_name);			
			foreach($data as $item):
				if(strpos($item['title'], 'เทศบาล')!==false){
					//$if_exist = 1;
					//echo iconv('utf-8','tis-620',$item['title']); 
					break;
				}
				//if($if_exist < 1)
				//{				
				if($item['value_length']==1712){
					$chars = str_split($item['value'] , 8);
					$item['title']."<br>";
					if (strpos($item['title'], 'จังหวัด')!==false||strpos($item['title'], 'กรุงเทพมหานคร')!==false) {
						$province_name = str_replace('จังหวัด', '', $item['title']);
						$province = $this->province->where(" province='".iconv('utf-8','tis-620',$province_name)."'")->get_row();						
						$province_id = @$province['id'];	
						if($province_id <1){
							echo iconv('utf-8','tis-620',"ไม่มีข้อมูลจังหวัด ".$item['title'])."<br>";
						}else{
						$_POST['province_id'] =$province_id;	
                        $val['ID'] = $this->ppl->select('id')->where(" PROVINCE_ID=".$_POST['province_id']." AND AMPHUR_ID=0 AND DISTRICT_ID=0 AND YEAR_DATA=".$_POST['year_data'])->get_one();
						if($val['ID']>0){
							$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$val['ID']);
						}						
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
					}
					else if (strpos($item['title'], 'อำเภอ')!==false || strpos($item['title'], 'เขต')!==false) {
						$amphur_name = strpos($item['title'], 'อำเภอ')!==false ? str_replace('อำเภอ', '', $item['title']) : $item['title'];
						$amphur_name = strpos($item['title'], 'เขต')!==false ? str_replace('เขต', '', $item['title']) : $item['title'];
						$amphur = $this->amphur->where(" province_id=".$province_id." AND AMPHUR_NAME='".iconv('utf-8','tis-620',$amphur_name)."'")->get_row();
						$amphur_id = @$amphur['id'];
						if($amphur_id<1)
						{
							echo iconv('utf-8','tis-620',"ไม่มี ไอดี อำเภอ ".$item['title'])."<br>";
						}else{
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
					}
					elseif(strpos($item['title'], 'แขวง')!==false){
						$district_name = str_replace('แขวง', '', $item['title']);
						if($amphur_id<1){
							echo iconv('utf-8','tis-620',$item['title']." ไม่มี id amphur")."<br>";
						}else{
						$district = $this->district->where(" province_id=".$province_id." AND AMPHUR_ID=".$amphur_id."  AND DISTRICT_NAME='".iconv('utf-8','tis-620',$district_name)."'")->get_row();
						if(@$district['id']<1){
							echo iconv('utf-8','tis-620',$item['title']." ไม่มี id ตำบล")." <br>";
						}else{
						$amphur = $this->amphur->get_row($amphur_id);
						$district_id = @$district['id'];
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
					}
					else if (strpos($item['title'], 'ตำบล')!==false && strpos($item['title'], 'เทศบาล')===false) {
						$district_name = str_replace('ตำบล', '', $item['title']);
						if($amphur_id<1){
							echo iconv('utf-8','tis-620',$item['title']." ไม่มี id amphur")."<br>";
						}else{
						$district = $this->district->where(" province_id=".$province_id." AND AMPHUR_ID=".$amphur_id."  AND DISTRICT_NAME='".iconv('utf-8','tis-620',$district_name)."'")->get_row();
						if(@$district['id']<1){
							echo iconv('utf-8','tis-620',$item['title']." ไม่มี id ตำบล")." <br>";
						}else{
						$amphur = $this->amphur->get_row($amphur_id);
						$district_id = @$district['id'];
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
					}
				}	
				//}			
			endforeach;							
		}
		/*echo "<script>window.location='population';</script>";*/
		//redirect('population/index');
	}
	
	function sixtyup_index(){
		$data['menu_id'] = $this->menu_sixtyup_id;
		$condition= @$_GET['year_data']!='' ? " AND YEAR_DATA=".$_GET['year_data'] : "";
		$condition.= @$_GET['province_id']!='' ? " AND PROVINCE_ID=".$_GET['province_id'] : "";
		$condition.= @$_GET['amphur_id']!='' ? " AND AMPHUR_ID=".$_GET['amphur_id'] : "";
		$condition.= @$_GET['district_id']!='' ? " AND DISTRICT_ID=".$_GET['district_id'] : "";
		$sql = " SELECT * FROM (
		SELECT PPT.*, 		
		(SELECT SUM(NUNIT) FROM POPULATION_DETAIL WHERE PID=PPT.ID AND AGE_RANGE_CODE > 61 AND AGE_RANGE_CODE <=102 )NSIXTYUP_MALE,
		(SELECT SUM(NUNIT) FROM POPULATION_DETAIL WHERE PID=PPT.ID AND AGE_RANGE_CODE > 163 AND AGE_RANGE_CODE <=204 )NSIXTYUP_FEMALE
		FROM POPULATION PPT) WHERE (NSIXTYUP_MALE > 0 OR NSIXTYUP_FEMALE > 0) ".$condition." ORDER BY ID "; 
		$data['ppl'] = $this->ppl->where($condition)->get($sql);
		$data['pagination'] = $this->ppl->pagination();
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('sixtyup/index',$data);
	}
	
	function sixtyup_form($id=FALSE){
		$data['menu_id'] = $this->menu_sixtyup_id;		
		$data['item'] = $this->ppl->get_row($id);
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('sixtyup/form',$data);
	}
	
	function sixtyup_save(){
		if(!menu::perm($this->menu_sixtyup_id, 'add') || !menu::perm($this->menu_sixtyup_id,'edit'))redirect('population/index');
		$_POST['PROVINCE_NAME'] = $this->province->select("PROVINCE")->where("ID=".$_POST['province_id'])->get_one();
		$_POST['AMPHUR_NAME'] = $_POST['amphur_id'] > 0 ? $this->amphur->select("amphur_name")->where("ID=".$_POST['amphur_id'])->get_one() : "";
		$_POST['DISTRICT_NAME'] = $_POST['district_id'] > 0 ? $this->district->select("district_name")->where("ID=".$_POST['district_id'])->get_one() : "";		
		$id = $this->ppl->save($_POST);		
		$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$id." AND AGE_RANGE_CODE > 61 AND AGE_RANGE_CODE <=102");
		$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$id." AND AGE_RANGE_CODE > 163 AND AGE_RANGE_CODE <=204");			
		for($i=62;$i<=102;$i++){
			$value['age_range_code'] = $i;
			$value['pid'] = $id;
			$value['nunit'] = $_POST['male_'.$i];
			$this->ppl_detail->save($value);
		}
		
		for($i=62;$i<=102;$i++){
			$value['age_range_code'] = $i+102;
			$value['pid'] = $id;
			$value['nunit'] = $_POST['female_'.$i];
			$this->ppl_detail->save($value);
		}
		redirect('population/sixtyup_index');
	}
	
	function sixtyup_delete($id=FALSE){
		
		$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$id." AND AGE_RANGE_CODE > 61 AND AGE_RANGE_CODE <=102");
		$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$id." AND AGE_RANGE_CODE > 163 AND AGE_RANGE_CODE <=204");				
		redirect('population/sixtyup_index');		
	}
}
?>