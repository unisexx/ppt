<?php
Class fund extends Public_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('fund_model', 'fund');
		$this->load->model('province_model', 'province');
		$this->load->model('amphur_model', 'amphur');		
		$this->load->model('district_model', 'district');				
		$this->load->model('info_model','info');		
	}
	public $menu_id = 103;
	function index(){
		//$this->db->debug=true;
		$data['menu_id'] = $this->menu_id;
		$condition = " 1 = 1 ";
		if(@$_GET['year_data']) $condition .= "AND ORG_CREATE_DATE LIKE'%".$_GET['year_data']."%' ";
		if(@$_GET['province_id']) $condition .= "AND contact_province_id = ".$_GET['province_id'].' ';
		if(@$_GET['amphur_id']) $condition .= "AND contact_amphur_id = ".$_GET['amphur_id'].' ';
		if(@$_GET['district_id']) $condition .= "AND contact_tumbon_id = ".$_GET['district_id'].' ';
		$data['fund'] = $this->fund->where($condition)->get();
    	$data['pagination'] = $this->fund->pagination;
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('index', $data);
	}
	
	function form($id=FALSE){
		//$this->db->debug = true;
		$data['menu_id'] = $this->menu_id;
		$data['id'] = @$id;
		if(@$id)
		{
			$data['item'] = $this->fund->get_row($id);
		}
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('form', $data);
	}
		function save()
		{
			//$this->db->debug= true;
			if(!menu::perm($this->menu_id, 'add') || !menu::perm($this->menu_id,'edit'))redirect('fund/index');
			$province_id = $_POST['province_id'];
			$_POST['contact_province_id']= $_POST['province_id'];
			$_POST['contact_amphur_id']= $_POST['amphur_id'];
			$_POST['contact_tumbon_id']= $_POST['district_id'];
			$_POST['cur_member_no'] =str_replace(',','',$_POST['cur_member_no']);
			$_POST['cur_amount'] =str_replace(',','',$_POST['cur_amount']);
			if($province_id > 0 ){
				$_POST['contact_province_name'] = $this->province->select('PROVINCE')->where("ID=".$_POST['province_id'])->get_one();
			}
			$this->fund->save($_POST);
			set_notify('success', lang('save_data_complete'));
			redirect('fund/index');
		}
	function delete($id=FALSE)
	{
		if(!menu::perm($this->menu_id, 'delete'))redirect('fund/index');
		if($id)
		{
			$this->fund->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('fund/index');
		}
		
	}
	function import_form(){
		$data['menu_id'] = $this->menu_id;
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('import_form',$data);
	}
	
	function fund_import(){
//		$this->db->debug = true;
		set_time_limit(0);
		if(!menu::perm($this->menu_id, 'add') || !menu::perm($this->menu_id,'edit'))redirect('birth/index');
		if($_FILES['fl_import']['name']!=''){						
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			/*---for insert value to info table ---*/
			$import_section_id = $_POST['import_workgroup_id']> 0 ? $_POST['import_workgroup_id'] : $_POST['import_section_id'];
			$_POST['section_id'] = $import_section_id;
			$this->info->save($_POST);
			/*--end--*/
			$file_name = 'fund_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/fund/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);		
			$data = $this->ReadData($uploaddir.$file_name);			
			foreach($data as $item):
						$item['id'] =$item['org_id']!='' ? $this->fund->get_one('id','org_id',$item['org_id']) : "";
						$item['org_create_date'] = $item['org_create_date']!='' ? substr($item['org_create_date'],0,2)."-".substr($item['org_create_date'],2,2)."-".(substr($item['org_create_date'],4,4)+543) :"";
						$item['contact_province_id'] = trim($item['contact_province_name'])!='' ? $this->province->get_one('id','province',@iconv('utf-8','tis-620',$item['contact_province_name'])):'';
						$item['contact_amphur_id'] = trim($item['contact_amphur_name'])!='' ? $this->amphur->get_one('id','amphur_name',@iconv('utf-8','tis-620',$item['contact_amphur_name'])):'';
						$item['contact_tumbon_id'] = trim($item['contact_tumbon_name'])!='' ? $this->district->get_one('id','district_name',@iconv('utf-8','tis-620',$item['contact_tumbon_name'])):'';
						$id = $this->fund->save($item);											
			endforeach;							
		}
		redirect('fund/index');
	}

	function ReadData($filepath){
		require_once 'include/Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data -> setOutputEncoding('UTF-8');
		$data -> read($filepath);
//		error_reporting(E_ALL ^ E_NOTICE);
		$index = 0;
		for($i = 2; $i <= $data -> sheets[0]['numRows']; $i++) {
			$import[$index]['org_id'] = trim(@$data -> sheets[0]['cells'][$i][1]);
			$import[$index]['fund_name'] = trim(@$data -> sheets[0]['cells'][$i][2]);
			$import[$index]['org_create_date'] = trim(@$data -> sheets[0]['cells'][$i][3]);								 
			$import[$index]['contact_int'] = trim(@$data -> sheets[0]['cells'][$i][4]);
			$import[$index]['contact_name'] = trim(@$data -> sheets[0]['cells'][$i][5]);
			$import[$index]['contact_lastname'] = trim(@$data -> sheets[0]['cells'][$i][6]);
			$import[$index]['contact_add_no'] = trim(@$data -> sheets[0]['cells'][$i][7]);
			$import[$index]['contact_add_moo'] = trim(@$data -> sheets[0]['cells'][$i][8]);
			$import[$index]['contact_add_road'] = trim(@$data -> sheets[0]['cells'][$i][9]);
			$import[$index]['contact_tumbon_name'] = trim(@$data -> sheets[0]['cells'][$i][10]);
			$import[$index]['contact_amphur_name'] = trim(@$data -> sheets[0]['cells'][$i][11]);
			$import[$index]['contact_province_name'] = trim(@$data -> sheets[0]['cells'][$i][12]);
			$import[$index]['contact_add_postcode'] = trim(@$data -> sheets[0]['cells'][$i][13]);
			$import[$index]['contact_add_email'] = trim(@$data -> sheets[0]['cells'][$i][14]);
			$import[$index]['contact_add_tel'] = trim(@$data -> sheets[0]['cells'][$i][15]);
			$import[$index]['contact_add_fax'] = trim(@$data -> sheets[0]['cells'][$i][16]);
			$import[$index]['cur_member_no'] = trim(@$data -> sheets[0]['cells'][$i][17]);
			$import[$index]['cur_amount'] = trim(@$data -> sheets[0]['cells'][$i][18]);
			$index++;			
		}		
		return $import;
	}
	
	function custom_import(){
		$this->db->debug=true;
		$uploaddir = "import_file/birth/";		
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
			echo $finfo[0]."::".$province_id.":::".$lfile[$i]."<br>";						
			//rename($uploaddir.$file_name, $uploaddir.$province_id.".xls");
			
			$data = $this->ReadData($uploaddir.iconv('utf-8','windows-874',$file_name));
			
			foreach($data as $item):
						$val['ID']='';								
						$province_name = str_replace('จังหวัด', '', $item['title']);
						$province = $this->province->where(" province='".iconv('utf-8','tis-620',$province_name)."'")->get_row();
						$province_id = @$province['id'];		
						if($province_id > 0 ){
							$val['ID'] = $this->birth->select('id')->where("YEAR_DATA=".$finfo[0]." AND PROVINCE_ID=".$province_id)->get_one();
						}
						$val['YEAR_DATA'] = $finfo[0];
						$val['PROVINCE_ID'] = $province_id;
						$val['PROVINCE_NAME'] = $province_name;
						$val['BIRTH_MALE'] = (int)$item['birth_male'];
						$val['BIRTH_FEMALE'] = (int)$item['birth_female'];
						//print_r($val);
						$id = $this->birth->save($val);											
			endforeach;	
			
			 
		}
	}
}
?>