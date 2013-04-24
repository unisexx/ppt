<?php
Class birth extends Public_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('birth_model', 'birth');
		$this->load->model('province_model', 'province');				
	}
	function index(){
		//$this->db->debug=true;
		$condition = " 1 = 1 ";
		if(@$_GET['year_data']) $condition .= "AND year_data = ".$_GET['year_data'].' ';
		if(@$_GET['province_id']) $condition .= "AND province_id = ".$_GET['province_id'].' ';
		
		$data['birth'] = $this->birth->where($condition)->get();
    	$data['pagination'] = $this->birth->pagination;
		
		$this->template->build('index', $data);
	}
	
	function form($id=FALSE){
		//$this->db->debug = true;
		$data['id'] = @$id;
		if(@$id)
		{
			$data['item'] = $this->birth->get_row($id);
		}
		
		$this->template->build('form', $data);
	}
		function save()
		{
			$province_id = $_POST['province_id'];
			if($province_id > 0 ){
				$_POST['ID'] = $this->birth->select('id')->where("YEAR_DATA=".$_POST['year_data']." AND PROVINCE_ID=".$province_id)->get_one();
				$_POST['PROVINCE_NAME'] = $this->province->select('PROVINCE')->where("ID=".$_POST['province_id'])->get_one();
			}
			$this->birth->save($_POST);
			set_notify('success', lang('save_data_complete'));
			redirect('birth/index');
		}
	function delete($id=FALSE)
	{
		if($id)
		{
			$this->birth->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('birth/index');
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
		echo "<script>window.location='birth';</script>";
		//redirect('population/index');
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