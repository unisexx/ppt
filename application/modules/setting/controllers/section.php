<?php
Class section extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('section_model','section');
	}
	function index(){
		//$this->db->debug=true;
		$condition = "pid=0 AND SECTION_TYPE = 1 ";
		$condition.= @$_GET['province_id']!='' ? " AND PROVINCE_ID=".$_GET['province_id'] : "";
		$condition.= @$_GET['amphur_id']!='' ? " AND AMPHUR_ID=".$_GET['amphur_id'] : "";
		$condition.= @$_GET['district_id']!='' ? " AND DISTRICT_ID=".$_GET['district_id'] : "";
		$data['data'] = $this->section->where($condition)->get();
    	$data['pagination'] = $this->section->pagination;
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('section_index', $data);
	}
	
	function form($id=FALSE){
		//$this->db->debug = true;
		$data['id'] = @$id;
		if(@$id)
		{
			$data['item'] = $this->section->get_row($id);
		}
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('section_form', $data);
	}
		function save()
		{
			//$this->db->debug = true;
			$_POST['section_type'] = 1;
			$this->section->save($_POST);
			set_notify('success', lang('save_data_complete'));
			redirect('setting/section/index');
		}
	function delete($id=FALSE)
	{
		if($id)
		{
			$this->section->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('setting/section/index');
		}
		
	}
	
	function workgroup_index(){
		//$this->db->debug=true;
		if(@$_GET['pid']<1)redirect('setting/section');		
		$condition = "pid=".$_GET['pid'];
		$condition.= @$_GET['province_id']!='' ? " AND PROVINCE_ID=".$_GET['province_id'] : "";
		$condition.= @$_GET['amphur_id']!='' ? " AND AMPHUR_ID=".$_GET['amphur_id'] : "";
		$condition.= @$_GET['district_id']!='' ? " AND DISTRICT_ID=".$_GET['district_id'] : "";
		$data['data'] = $this->section->where($condition)->get();
    	$data['pagination'] = $this->section->pagination;
		$data['section_name'] = $this->section->select('title')->where('id='.$_GET['pid'])->get_one();
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('workgroup_index', $data);
	}
	
	function workgroup_form($id=FALSE){
		//$this->db->debug = true;
		$data['id'] = @$id;
		$data['pid'] = @$_GET['pid'];
		if(@$id)
		{			
			$data['item'] = $this->section->get_row($id);
			$data['pid'] = $data['item']['pid'];
		}
		$data['section_name'] = $this->section->select('title')->where('id='.$data['pid'])->get_one();
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('workgroup_form', $data);
	}
		function workgroup_save()
		{
			//$this->db->debug = true;
			$_POST['section_type'] = 1;
			$pid = $_POST['pid'];
			$this->section->save($_POST);
			set_notify('success', lang('save_data_complete'));
			redirect('setting/section/workgroup_index?pid='.$pid);
		}
	function workgroup_delete($id=FALSE)
	{
		if($id)
		{
			$pid = $this->amphur->select("PID")->where("ID=".$id)->get_one();
			$this->section->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('setting/section/workgroup_index?pid='.$pid);
		}
		
	}
	
	function ajax_section($type=NULL)
	{
		$text = ($type == 'report') ? '-- ทุกหน่วยงาน --' : '- เลือกหน่วยงาน -';
		$result = $this->db->GetArray('select id,title as text from section where section_type = ?',$_GET['q']);
		dbConvert($result);
        if($type == 'report' and !empty($_GET['q'])) array_unshift($result, array('id' => '', 'text' => $text));
		echo $result ? json_encode($result) : '[{"id":"","text":"'.$text.'"}]';
	}
	
	function ajax_workgroup($type=NULL)
	{
		$text = ($type == 'report') ? '-- ทุกกลุ่มงาน/ฝ่าย --' : '- เลือกกลุ่มงาน/ฝ่าย -';
		$result = $this->db->GetArray('select id,title as text from section where pid = ?',$_GET['q']);
		dbConvert($result);
        if($type == 'report' and !empty($_GET['q'])) array_unshift($result, array('id' => '', 'text' => $text));
		echo $result ? json_encode($result) : '[{"id":"","text":"'.$text.'"}]';
	}
	
}
?>