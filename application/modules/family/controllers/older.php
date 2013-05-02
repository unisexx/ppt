<?php
Class older extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model('family_model','family');
		$this->load->model('info_model','info');
	}
	public $menu_id = 60;
	public $key_id = 36;
	function index(){
		$data['menu_id'] = $this->menu_id;
		$select = " FAMILY.*, PROVINCE PROVINCE_NAME ";
		$join = " LEFT JOIN PROVINCES ON FAMILY.PROVINCE_ID = PROVINCES.ID ";
		$condition = '1=1 AND KEY_ID='.$this->key_id;
		$condition.= @$_GET['year_data'] > 0 ? " AND YEAR_DATA=".$_GET['year_data'] : "";
		$condition.= @$_GET['province_id'] > 0 ? " AND PROVINCE_ID=".$_GET['province_id']:"";
		$data['data'] = $this->family->select($select)->join($join)->where($condition)->order_by('year_data desc, province','asc')->get();
		$data['pagination'] =$this->family->pagination();
		$this->template->build('older/index',$data);
	}
	
	function form($id=FALSE){
		$data['menu_id'] = $this->menu_id;
		if($id){
			$data['item'] = $this->family->get_row($id);
		}
		$this->template->build('older/form',$data);
	}
    
    function save(){
    	$_POST['key_id'] = $this->key_id;
    	$this->family->save($_POST);
		redirect('family/older/index');
    }
	
	function delete($id=false){
		if($id){
			$this->family->delete($id);
		}
		redirect('family/older/index');
	}
	
	function import_form(){
		$data['menu_id'] = $this->menu_id;		
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('older/import_form',$data);
	}
	function import(){
//		$this->db->debug = true;
		//if(!menu::perm($this->menu_id, 'add') || !menu::perm($this->menu_id,'edit'))redirect('family/warm_index');
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
			foreach($data as $item):
						$val['ID']='';								
						$province_id = $_POST['province_id'];
						if($province_id > 0 ){
							$val['ID'] = $this->family->select('id')->where("YEAR_DATA=".$_POST['year_data']." AND PROVINCE_ID=".$province_id." AND KEY_ID=". (int)$item['key_id'])->get_one();
						}
						$val['YEAR_DATA'] = $_POST['year_data'];
						$val['PROVINCE_ID'] = $_POST['province_id'];
						$val['KEY_ID'] = (int)$item['key_id'];
						$val['TITLE'] = $item['title'];
						$val['PASS'] = (float)$item['pass'];
						$val['PERCENTAGE'] = (float)$item['percentage'];
						$val['TARGET'] = (float)$item['target'];
						$val['LOWER_TARGET'] = (float)$item['lower_target'];
						$val['EDIT'] = (float)$item['edit'];
						$id = $this->family->save($val);											
			endforeach;							
		}
		redirect('family/older/index');
	}

	function ReadData($filepath){
		require_once 'include/Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data -> setOutputEncoding('UTF-8');
		$data -> read($filepath);
//		error_reporting(E_ALL ^ E_NOTICE);
		$index = 0;
		for($i = 4; $i <= $data -> sheets[0]['numRows']; $i++) {
			if(in_array(substr(trim($data -> sheets[0]['cells'][$i][1]),0,2), array(14,21,31,30,36))){
			$import[$index]['key_id'] = substr(trim($data -> sheets[0]['cells'][$i][1]),0,2); 
			$import[$index]['title'] = trim($data -> sheets[0]['cells'][$i][1]);
			$import[$index]['pass'] = trim($data -> sheets[0]['cells'][$i][2]);
			$import[$index]['percentage'] = trim($data -> sheets[0]['cells'][$i][3]);
			$import[$index]['target'] = trim($data -> sheets[0]['cells'][$i][4]);
			$import[$index]['lower_target'] = trim($data -> sheets[0]['cells'][$i][5]);
			$import[$index]['edit'] = trim($data -> sheets[0]['cells'][$i][6]);								 
			$index++;			
			}
		}		
		return $import;
	}
}
?>