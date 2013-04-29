<?php
Class support_section extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('section_model','section');
	}
function index(){
		//$this->db->debug=true;
		$condition = " SECTION_TYPE=2 ";		
		$condition.= @$_GET['province_id']!='' ? " AND PROVINCE_ID=".$_GET['province_id'] : "";
		$condition.= @$_GET['amphur_id']!='' ? " AND AMPHUR_ID=".$_GET['amphur_id'] : "";
		$condition.= @$_GET['district_id']!='' ? " AND DISTRICT_ID=".$_GET['district_id'] : "";
		$data['data'] = $this->section->where($condition)->get();
    	$data['pagination'] = $this->section->pagination;
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('support_section_index', $data);
	}
	
	function form($id=FALSE){
		//$this->db->debug = true;
		$data['id'] = @$id;
		if(@$id)
		{
			$data['item'] = $this->section->get_row($id);
		}
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('support_section_form', $data);
	}
		function save()
		{
			//$this->db->debug = true;
			$_POST['section_type'] = 2;
			$this->section->save($_POST);
			set_notify('success', lang('save_data_complete'));
			redirect('setting/support_section/index');
		}
	function delete($id=FALSE)
	{
		if($id)
		{
			$this->section->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('setting/support_section/index');
		}
		
	}
	
}
?>