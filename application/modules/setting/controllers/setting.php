<?php
Class Setting extends Public_Controller{
	
	public $module = array(
		'user' => array('label' => 'ผู้ใช้งานระบบ', 'permission' => array('view','add','edit','delete')),
		'usertype' => array('label' => 'สิทธ์การใช้งาน', 'permission' => array('view','add','edit','delete')),
		'menus' => array('label' => 'ข้อมูลพื้นฐานและกลุ่มเป้าหมาย', 'permission' => array('view','add','edit','delete')),
		'set_province' => array('label' => 'จังหวัด', 'permission' => array('view','add','edit','delete')),
		'set_amphor' => array('label' => 'อำเภอ', 'permission' => array('view','add','edit','delete')),
		'set_tumbon' => array('label' => 'ตำบล', 'permission' => array('view','add','edit','delete')),
		'report' => array('label' => 'รายงาน', 'permission' => array('view')),
		// 'basic' => array('label' => 'ข้อมูลพื้นฐาน', 'permission' => array('view','add','edit','delete','import')),
		// 'target1' => array('label' => 'ข้อมูลกลุ่มเป้าหมาย 1', 'permission' => array('view','add','edit','delete','import')),
		// 'target2' => array('label' => 'ข้อมูลกลุ่มเป้าหมาย 2', 'permission' => array('view','add','edit','delete','import')),
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
		$this->load->model('menu_model','menu');
		
		if (!is_login()){
			set_notify('error', 'กรุณาเข้าสู่ระบบ');
			redirect('home');
		}
	}
	
	function user(){
		$condition = " 1=1 ";
		$condition .= (@$_GET['department_id']!='')?" and PPT.USERS.DEPARTMENT_ID = ".$_GET['department_id'] : "";
		$condition .= (@$_GET['division_id']!='')?" and PPT.USERS.DIVISION_ID = ".$_GET['division_id'] : "";
		$condition .= (@$_GET['workgroup_id']!='')?" and PPT.USERS.WORKGROUP_ID = ".$_GET['workgroup_id'] : "";
		$condition .= (@$_GET['fullname']!='')?" and PPT.USERS.FULLNAME like '%".$_GET['fullname']."%'" : "";
		
		$sql = "SELECT
PPT.USERS.ID,
PPT.USERS.USER_TYPE_ID,
PPT.USERS.FULLNAME,
PPT.USERS.NAME,
PPT.USERS.SURNAME,
PPT.USERS.DEPARTMENT_ID,
PPT.USERS.DIVISION_ID,
PPT.USERS.WORKGROUP_ID,
PPT.USERS.PERSON_TYPE_ID,
PPT.USERS.ID_CARD,
PPT.USERS.CONTACT_NUMBER,
PPT.USERS.TARGET_RESPONSE,
PPT.USERS.EMAIL,
PPT.USERS.PASSWORD,
PPT.USERS.USERNAME,
PPT.USER_TYPE.USER_TYPE_NAME,
PPT.DEPARTMENT.DEPARTMENT_NAME,
PPT.DIVISION.DIVISION_NAME,
PPT.PERSON_TYPE.PERSON_TYPE_NAME,
PPT.WORKGROUP.WORKGROUP_NAME,
PPT.USER_TYPE.USER_TYPE_LEVEL
FROM
PPT.USERS
LEFT JOIN PPT.USER_TYPE ON PPT.USERS.USER_TYPE_ID = PPT.USER_TYPE.ID
LEFT JOIN PPT.DEPARTMENT ON PPT.USERS.DEPARTMENT_ID = PPT.DEPARTMENT.ID
LEFT JOIN PPT.DIVISION ON PPT.USERS.DIVISION_ID = PPT.DIVISION.ID
LEFT JOIN PPT.PERSON_TYPE ON PPT.USERS.PERSON_TYPE_ID = PPT.PERSON_TYPE.ID
LEFT JOIN PPT.WORKGROUP ON PPT.USERS.WORKGROUP_ID = PPT.WORKGROUP.ID
WHERE ".$condition." and USER_TYPE_LEVEL <= ".login_data('user_type_level');
		$data['users'] = $this->user->order_by('id','desc')->get($sql);
		$data['pagination'] = $this->user->pagination();
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('user_index',$data);
	}
	
	function user_form($id=false){
		$data['user'] = $this->user->get_row($id);
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('user_form',$data);
	}
	
	function user_save(){
		if($_POST){
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
		$condition = " 1=1 ";
		$condition .= (@$_GET['user_type_name']!='')?" and user_type_name like '%".$_GET['user_type_name']."%'" : "";
		
		$data['user_types'] = $this->user_type->where('user_type_level <= '.login_data('user_type_level').' and '.$condition)->order_by('user_type_level','desc')->get();
		$data['pagination'] = $this->user_type->pagination();
		$this->template->build('usertype_index',$data);
	}

	function usertype_form($id=false){
		$data['usertype'] = $this->user_type->get_row($id);
		$data['rs_perm'] = $this->permission->permission_row($id);
		$data['module'] = $this->module;
		$data['crud'] = $this->crud;
		
		$data['menus'] = $this->menu->where('parent_id = 0')->get();
		$this->template->build('usertype_form',$data);
	}
	
	function usertype_save(){
		if($_POST)
		{
			$_POST['id'] = $_POST['user_type_id'];
			$this->user_type->save($_POST);
			
			$this->permission->delete('user_type_id', $_POST['user_type_id']);
			if(isset($_POST['checkbox'])){
				foreach($_POST['checkbox'] as $module => $item)
				{
					$data['user_type_id'] = $_POST['user_type_id'];
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

	function check_username($id=false){
		$user = $this->user->where("username = '".$_GET['username']."'")->get_row();
		($user)?$this->output->set_output("false"):$this->output->set_output("true");
    }
	
	function ajax_division(){
		$result = $this->db->GetArray('select id,division_name as text from division where department_id = ?',$_GET['q']);
		dbConvert($result);
        if(!empty($_GET['q'])) array_unshift($result, array('id' => '', 'text' => '- กอง / สำนักงาน -'));
		echo $result ? json_encode($result) : '[{"id":"","text":"- กอง / สำนักงาน -"}]';
	}
	
	function ajax_workgroup(){
		$result = $this->db->GetArray('select id,workgroup_name as text from workgroup where division_id = ?',$_GET['q']);
		dbConvert($result);
        if(!empty($_GET['q'])) array_unshift($result, array('id' => '', 'text' => '- กลุ่ม / ฝ่าย -'));
		echo $result ? json_encode($result) : '[{"id":"","text":"- กลุ่ม / ฝ่าย -"}]';
	}
}
?>