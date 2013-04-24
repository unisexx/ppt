<?php
Class Setting extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('province_model','province');
		$this->load->model('amphor_model','amphor');
		$this->load->model('tumbon_model','tumbon');
		$this->load->model('set_target_model','set_target');
		$this->load->model('form_template_model','form_template');
		$this->load->model('user_model','user');
	}
	
	function user(){
		$data['users'] = $this->user->order_by('id','desc')->get();
		$data['pagination'] = $this->user->pagination();
		$this->template->build('user_index',$data);
	}
	
	function user_form($id=false){
		$data['user'] = $this->user->get_row($id);
		$this->template->build('user_form',$data);
	}
	
	function user_save(){
		if($_POST){
			if($_POST["target_response"]){
				$_POST["target_response"] = implode(",", $_POST["target_response"]);
			}
			$this->user->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('setting/user'.GetCurrentUrlGetParameter());
	}
	
	function usertype(){
		$this->template->build('usertype_index');
	}
	
	function usertype_form(){
		$this->template->build('usertype_form');
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
		$condition .= (@$_GET['province_name']!='')?" and province_name like '%".$_GET['province_name']."%'" : "";
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
		$condition .= (@$_GET['amphor_name']!='')?" and amphor_name like '%".$_GET['amphor_name']."%'" : "";
		
		$sql = "SELECT
PPT.AMPHOR.ID,
PPT.AMPHOR.AMPHOR_NAME,
PPT.AMPHOR.PROVINCE_ID,
PPT.PROVINCE.PROVINCE_NAME
FROM
PPT.AMPHOR
LEFT JOIN PPT.PROVINCE ON PPT.AMPHOR.PROVINCE_ID = PPT.PROVINCE.ID WHERE ".$condition;
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
		$condition .= (@$_GET['province_id']!='')?" and province_id = ".$_GET['province_id'] : "";
		$condition .= (@$_GET['amphor_id']!='')?" and amphor_id = ".$_GET['amphor_id'] : "";
		$condition .= (@$_GET['tumbon_name']!='')?" and tumbon_name like '%".$_GET['tumbon_name']."%'" : "";
		
		$sql = "SELECT
PPT.AMPHOR.AMPHOR_NAME,
PPT.PROVINCE.PROVINCE_NAME,
PPT.TUMBON.ID,
PPT.TUMBON.PROVINCE_ID,
PPT.TUMBON.AMPHOR_ID,
PPT.TUMBON.TUMBON_NAME
FROM
PPT.TUMBON
LEFT JOIN PPT.PROVINCE ON PPT.TUMBON.PROVINCE_ID = PPT.PROVINCE.ID
LEFT JOIN PPT.AMPHOR ON PPT.TUMBON.AMPHOR_ID = PPT.AMPHOR.ID WHERE ".$condition;
		$data['tumbons'] = $this->tumbon->get($sql);
		$data['pagination'] = $this->tumbon->pagination();
		$this->template->build('set_tumbon',$data);
	}
	
	function set_tumbon_form($id=false){
		$data['tumbon'] = $this->tumbon->get_row($id);
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