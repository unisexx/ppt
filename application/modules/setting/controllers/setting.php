<?php
Class Setting extends Public_Controller{
	
	public $module = array(
		'administrators' => array('label' => 'ผู้ดูแล', 'permission' => array('view','add','edit','delete')),
		'coverpages' => array('label' => 'หน้าแรก', 'permission' => array('view','add','edit','delete')),
		'histories' => array('label' => 'ความเป็นมาศูนย์เด็กเล็กปลอดโรค', 'permission' => array('edit')),
		'hilights' => array('label' => 'ไฮไลท์', 'permission' => array('view','add','edit','delete')),
		'informations' => array('label' => 'ข่าวประชาสัมพันธ์', 'permission' => array('view','add','edit','delete')),
		'articles' => array('label' => 'บทความน่าสนใจ', 'permission' => array('view','add','edit','delete')),
		'vdos' => array('label' => 'vdo แนะนำ', 'permission' => array('view','add','edit','delete')),
		'downloads' => array('label' => 'เอกสารดาวน์โหลด', 'permission' => array('view','add','edit','delete')),
		'newsletters' => array('label' => 'จดหมายข่าว', 'permission' => array('view','add','edit','delete')),
		'galleries' => array('label' => 'ภาพกิจกรรม', 'permission' => array('view','add','edit','delete')),
		'calendars' => array('label' => 'ปฎิทินกิจกรรม', 'permission' => array('view','add','edit','delete')),
		'permissions' => array('label' => 'สิทธิ์การใช้งาน', 'permission' => array('view','add','edit','delete')),
		'dashboards' => array('label' => 'สถิติโดยรวม', 'permission' => array('view')),
	);
	
	public $crud = array(
		'view' => 'ดู',
		'add' => 'เพิ่ม',
		'edit' => 'แก้ไข',
		'delete' => 'ลบ',
		'import' => 'นำเข้าข้อมูล',
		'export' => 'ส่งออกข้อมูล'
	);
	
	function __construct(){
		parent::__construct();
		$this->load->model('province_model','province');
		$this->load->model('amphor_model','amphor');
		$this->load->model('tumbon_model','tumbon');
		$this->load->model('set_target_model','set_target');
		$this->load->model('form_template_model','form_template');
		$this->load->model('user_model','user');
		$this->load->model('user_type_model','user_type');
		$this->load->model('permission_model','permission');
	}
	
	function user(){
		$sql = "SELECT
PPT.USERS.ID,
PPT.USERS.USER_TYPE_ID,
PPT.USERS.FULLNAME,
PPT.USERS.NAME,
PPT.USERS.SURNAME,
PPT.USERS.DEPARTMENT_ID,
PPT.USERS.DIVISION_ID,
PPT.USERS.GROUP_ID,
PPT.USERS.PERSON_TYPE_ID,
PPT.USERS.ID_CARD,
PPT.USERS.CONTACT_NUMBER,
PPT.USERS.TARGET_RESPONSE,
PPT.USERS.EMAIL,
PPT.USERS.PASSWORD,
PPT.USER_TYPE.USER_TYPE_NAME,
PPT.DEPARTMENT.DEPARTMENT_NAME,
PPT.DIVISION.DIVISION_NAME,
PPT.PERSON_TYPE.PERSON_TYPE_NAME,
PPT.GROUPS.GROUP_NAME
FROM
PPT.USERS
INNER JOIN PPT.USER_TYPE ON PPT.USERS.USER_TYPE_ID = PPT.USER_TYPE.ID
INNER JOIN PPT.DEPARTMENT ON PPT.USERS.DEPARTMENT_ID = PPT.DEPARTMENT.ID
INNER JOIN PPT.DIVISION ON PPT.USERS.DIVISION_ID = PPT.DIVISION.ID
INNER JOIN PPT.PERSON_TYPE ON PPT.USERS.PERSON_TYPE_ID = PPT.PERSON_TYPE.ID
INNER JOIN PPT.GROUPS ON PPT.USERS.GROUP_ID = PPT.GROUPS.ID
		";
		$data['users'] = $this->user->order_by('id','desc')->get($sql);
		$data['pagination'] = $this->user->pagination();
		$this->template->build('user_index',$data);
	}
	
	function user_form($id=false){
		$data['user'] = $this->user->get_row($id);
		$this->template->build('user_form',$data);
	}
	
	function user_save(){
		if($_POST){
			if($_POST["target_response"] != ""){
				$_POST["target_response"] = implode(",", $_POST["target_response"]);
			}
			$this->user->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('setting/user'.GetCurrentUrlGetParameter());
	}
	
	function user_delete($id=false){
		if($id){
			$this->user->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('setting/user'.GetCurrentUrlGetParameter());
	}
	
	function usertype(){
		$data['user_types'] = $this->user_type->get();
		$data['pagination'] = $this->user_type->pagination();
		$this->template->build('usertype_index',$data);
	}

	function usertype_form($id=false){
		$data['usertype'] = $this->user_type->get_row($id);
		$data['rs_perm'] = $this->permission->permission_row($id);
		$data['module'] = $this->module;
		$data['crud'] = $this->crud;
		$this->template->build('usertype_form',$data);
	}
	
	function usertype_save(){
		if($_POST)
		{
			$id = $this->user_type->save($_POST);
			$this->permission->delete('user_type_id', $id);
			if(isset($_POST['checkbox'])){
				foreach($_POST['checkbox'] as $module => $item)
				{
					$data['user_type_id'] = $id;
					$data['module'] = $module;
					foreach($item as $perm => $val) $data[$perm] =  $val;
					$this->permission->save($data);
					$data = array();
				}	
			}
			set_notify('success', lang('save_data_complete'));
		}
		redirect('setting/usertype'.GetCurrentUrlGetParameter());
	}
	
	function set_target(){
		$this->template->build('set_target');
	}
	
	function set_target_form($id=false){
		$data['set_target'] = $this->set_target->get_row($id);
		$data['basics'] = $this->set_target->where('parent_id = 1')->get();
		$data['targets'] = $this->set_target->where('parent_id = 2')->get();
		$data['form_templates'] = $this->form_template->order_by('id','asc')->get();
		$this->template->build('set_target_form',$data);
	}
	
	function set_target_save(){
		if($_POST){
		   $this->set_target->save($_POST);
		   set_notify('success', lang('save_data_complete'));
		}
		redirect('setting/set_target'.GetCurrentUrlGetParameter());
	}

	function set_target_delete($id=false){
		if($id){
			$this->set_target->delete($id);
			set_notify('error', lang('delete_data_complete'));
		}
		redirect('setting/set_target'.GetCurrentUrlGetParameter());
	}
	
	function set_province(){
		$condition = " 1=1 ";
		$condition .= (@$_GET['province']!='')?" and province like '%".$_GET['province']."%'" : "";
		$data['provinces'] = $this->province->where($condition)->get();
		$data['pagination'] = $this->province->pagination();
		$this->template->build('set_province',$data);
	}
	
	function set_province_form($id=false){
		$data['province'] = $this->province->get_row($id);
		$this->template->build('set_province_form',$data);
	}
	
	function set_province_save(){
		if($_POST){
		   $this->province->save($_POST);
		   set_notify('success', lang('save_data_complete'));
		}
		redirect('setting/set_province'.GetCurrentUrlGetParameter());
	}
	
	function set_province_delete($id=false){
		if($id){
			$this->province->delete($id);
			set_notify('error', lang('delete_data_complete'));
		}
		redirect('setting/set_province'.GetCurrentUrlGetParameter());
	}
	
	function set_amphor(){
		$condition = " 1=1 ";
		$condition .= (@$_GET['province_id']!='')?" and province_id = ".$_GET['province_id'] : "";
		$condition .= (@$_GET['amphur_name']!='')?" and amphur_name like '%".$_GET['amphur_name']."%'" : "";
		
		$sql = "SELECT AMPHUR.ID, AMPHUR.AMPHUR_NAME, PROVINCES.PROVINCE
        FROM AMPHUR
        JOIN PROVINCES ON PROVINCES.ID = AMPHUR.PROVINCE_ID 
        WHERE ".$condition." 
        ORDER BY PROVINCES.PROVINCE, AMPHUR.AMPHUR_NAME";
        
		$data['amphors'] = $this->amphor->get($sql);
		$data['pagination'] = $this->amphor->pagination();
		$this->template->build('set_amphor',$data);
	}
	
	function set_amphor_form($id=false){
		$data['amphor'] = $this->amphor->get_row($id);
		$this->template->build('set_amphor_form',$data);
	}
	
	function set_amphor_save(){
		if($_POST){
		   $this->amphor->save($_POST);
		   set_notify('success', lang('save_data_complete'));
		}
		redirect('setting/set_amphor'.GetCurrentUrlGetParameter());
	}
	
	function set_amphor_delete($id=false){
		if($id){
			$this->amphor->delete($id);
			set_notify('error', lang('delete_data_complete'));
		}
		redirect('setting/set_amphor'.GetCurrentUrlGetParameter());
	}
	
	function set_tumbon(){
		$condition = " 1=1 ";
		$condition .= (@$_GET['province_id']!='')?" and district.province_id = ".$_GET['province_id'] : "";
		$condition .= (@$_GET['amphur_id']!='')?" and district.amphur_id = ".$_GET['amphur_id'] : "";
		$condition .= (@$_GET['district_name']!='')?" and district_name like '%".$_GET['district_name']."%'" : "";
		
		$sql = "SELECT DISTRICT.ID, DISTRICT.DISTRICT_NAME, AMPHUR.AMPHUR_NAME, PROVINCES.PROVINCE
        FROM DISTRICT 
        JOIN AMPHUR ON AMPHUR.ID = DISTRICT.AMPHUR_ID 
        JOIN PROVINCES ON PROVINCES.ID = DISTRICT.PROVINCE_ID 
        WHERE ".$condition." 
        ORDER BY PROVINCES.PROVINCE, AMPHUR.AMPHUR_NAME, DISTRICT.DISTRICT_NAME";
		$data['tumbons'] = $this->tumbon->get($sql);
		$data['pagination'] = $this->tumbon->pagination();
        
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('set_tumbon',$data);
	}
	
	function set_tumbon_form($id=false){
		$data['rs'] = $this->tumbon->get_row($id);
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('set_tumbon_form',$data);
	}
	
	function set_tumbon_save($id=false){
		if($_POST){
		   $this->tumbon->save($_POST);
		   set_notify('success', lang('save_data_complete'));
		}
		redirect('setting/set_tumbon'.GetCurrentUrlGetParameter());
	}
	
	function set_tumbon_delete($id=false){
		if($id){
			$this->tumbon->delete($id);
			set_notify('error', lang('delete_data_complete'));
		}
		redirect('setting/set_tumbon'.GetCurrentUrlGetParameter());
	}
	
	function check_email()
	{
		$user = new User();
		$user->get_by_email($_GET['email']);
		($user->email)?$this->output->set_output("false"):$this->output->set_output("true");
	}
}
?>