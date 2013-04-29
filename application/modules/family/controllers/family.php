<?php
Class Family extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model('family_model','family');
		$this->load->model('info_model','info');
	}
	public $warm_menu_id = 15;
	function warm_index(){
		$data['menu_id'] = $this->warm_menu_id;
		$this->template->build('warm_index',$data);
	}
	
	function warm_form(){
		$data['menu_id'] = $this->warm_menu_id;
		$this->template->build('warm_form');
	}
    
    function warm_save(){
    	
    }
	
	function warm_import_form(){
		$data['menu_id'] = $this->warm_menu_id;
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('import_form',$data);
	}
	function warm_import(){
//		$this->db->debug = true;
		//if(!menu::perm($this->warm_menu_id, 'add') || !menu::perm($this->warm_menu_id,'edit'))redirect('family/warm_index');
		if($_FILES['fl_import']['name']!=''){						
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			/*---for insert value to info table ---*/
			$import_section_id = $_POST['import_workgroup_id']> 0 ? $_POST['import_workgroup_id'] : $_POST['import_section_id'];
			$_POST['section_id'] = $import_section_id;
			$this->info->save($_POST);
			/*--end--*/
			$file_name = 'family_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/family/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);		
			$data = $this->ReadData($uploaddir.$file_name);
			print_r($data);exit;			
			foreach($data as $item):
						$val['ID']='';								
						$province_name = str_replace('จังหวัด', '', $item['title']);
						$province = $this->province->where(" province='".iconv('utf-8','tis-620',$province_name)."'")->get_row();
						$province_id = $province['id'];		
						if($province_id > 0 ){
							$val['ID'] = $this->birth->select('id')->where("YEAR_DATA=".$_POST['year_data']." AND PROVINCE_ID=".$province_id)->get_one();
						}
						$val['YEAR_DATA'] = $_POST['year_data'];
						$val['PROVINCE_ID'] = $province_id;
						$val['PROVINCE_NAME'] = $province_name;
						$val['BIRTH_MALE'] = (int)$item['birth_male'];
						$val['BIRTH_FEMALE'] = (int)$item['birth_female'];
						$id = $this->birth->save($val);											
			endforeach;							
		}
		//redirect('family/warm_index');
	}

	function ReadData($filepath){
		require_once 'include/Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data -> setOutputEncoding('UTF-8');
		$data -> read($filepath);
//		error_reporting(E_ALL ^ E_NOTICE);
		$index = 0;
		for($i = 2; $i <= $data -> sheets[0]['numRows']; $i++) {
			$import[$index]['title'] = trim($data -> sheets[0]['cells'][$i][1]);
			$import[$index]['pass'] = trim($data -> sheets[0]['cells'][$i][2]);
			$import[$index]['percentage'] = trim($data -> sheets[0]['cells'][$i][3]);
			$import[$index]['target'] = trim($data -> sheets[0]['cells'][$i][4]);
			$import[$index]['low_target'] = trim($data -> sheets[0]['cells'][$i][5]);
			$import[$index]['edit'] = trim($data -> sheets[0]['cells'][$i][6]);								 
			$index++;			
		}		
		return $import;
	}
}
?>