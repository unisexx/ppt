<?php
Class volunteer extends Public_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('volunteer_main_model', 'v_main');
		$this->load->model('province_model', 'province');				
	}
	function index(){
		//$this->db->debug=true;
		$condition = " 1 = 1 ";
		$condition.= @$_GET['province_id']!='' ? " AND VOLUNTEER_MAIN.PROVINCE_ID=".$_GET['province_id'] : "";
		$condition.= @$_GET['amphur_id']!='' ? " AND VOLUNTEER_MAIN.AMPHUR_ID=".$_GET['amphur_id'] : "";
		$condition.= @$_GET['district_id']!='' ? " AND VOLUNTEER_MAIN.DISTRICT_ID=".$_GET['district_id'] : "";
		$select = 'VOLUNTEER_MAIN.*, DISTRICT_NAME V_DISTRICT_NAME, AMPHUR_NAME V_AMPHUR_NAME, PROVINCE V_PROVINCE_NAME ';
		$join = 'LEFT JOIN DISTRICT ON VOLUNTEER_MAIN.DISTRICT_ID = DISTRICT.ID ';
		$join.= 'LEFT JOIN AMPHUR ON VOLUNTEER_MAIN.AMPHUR_ID = AMPHUR.ID ';
		$join.= 'LEFT JOIN PROVINCES ON VOLUNTEER_MAIN.PROVINCE_ID = PROVINCES.ID ';
		$data['data'] = $this->v_main->select($select)->join($join)->where($condition)->order_by('VOLUNTEER_MAIN.ID','desc')->get();
    	$data['pagination'] = $this->v_main->pagination;
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');		
		$this->template->build('index', $data);
	}
	
	function form($id=FALSE){
		//$this->db->debug = true;
		$data['id'] = @$id;
		if(@$id)
		{
			$data['item'] = $this->v_main->get_row($id);
		}
		
		$this->template->build('form', $data);
	}
		function save()
		{
			$this->v_main->save($_POST);
			set_notify('success', lang('save_data_complete'));
			redirect('volunteer/index');
		}
	function delete($id=FALSE)
	{
		if($id)
		{
			$this->v_main->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('volunteer/index');
		}
		
	}
	function import_form(){
		$this->template->build('import_form');
	}
	
	function birth_import(){
//		$this->db->debug = true;
		if($_FILES['fl_import']['name']!=''){						
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'birth_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/birth/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);		
			$data = $this->ReadData($uploaddir.$file_name);			
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
		redirect('birth/index');
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
			$import[$index]['birth_male'] = trim($data -> sheets[0]['cells'][$i][2]);
			$import[$index]['birth_female'] = trim($data -> sheets[0]['cells'][$i][3]);								 
			$index++;			
		}		
		return $import;
	}
}
?>