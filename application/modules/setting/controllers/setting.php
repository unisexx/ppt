<?php
Class Setting extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('province_model','province');
		$this->load->model('amphor_model','amphor');
		$this->load->model('tumbon_model','tumbon');
		$this->load->model('set_target_model','set_target');
		$this->load->model('form_template_model','form_template');
	}
	
	function user(){
		$this->template->build('user_index');
	}
	
	function user_form(){
		$this->template->build('user_form');
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
}
?>