<?php
Class People extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('people_model','people');
	}
	
	function index(){
		//$this->db->debug = true;
		$condition = " 1=1 ";
		$condition .= (@$_GET['name']!='')?" and NAME like '%".$_GET['name']."%'" : "";
		if(@$_GET['age']!=''){
				
			$today = date("Y-m-d");
			list($y,$m,$d) = explode('-', $today);
			$y = $y+543; // แปลง คศ เป็น พศ
			
			switch($_GET['age']){
				case 1: // 0-18
					$sdate = ($y-18).'-'.$m.'-'.$d;
					$edate = ($y-0).'-'.$m.'-'.$d;
			        break;
			    case 2: // 18-25
			        $sdate = ($y-25).'-'.$m.'-'.$d;
					$edate = ($y-18).'-'.$m.'-'.$d;
			        break;
			    case 3: // 25-60
			        $sdate = ($y-60).'-'.$m.'-'.$d;
					$edate = ($y-25).'-'.$m.'-'.$d;
			        break;
				case 4: // 60 up
			        $sdate = ($y-500).'-'.$m.'-'.$d;
					$edate = ($y-60).'-'.$m.'-'.$d;
			        break;
			}
			
			$condition .= "and birth BETWEEN TO_DATE('".$sdate."','YYYY-MM-DD') and TO_DATE('".$edate."','YYYY-MM-DD')";
		}
		
		$data['peoples'] = $this->people->where($condition)->order_by('id','desc')->get();
		$data['pagination'] = $this->people->pagination();
		$this->template->build('people', $data);
	}
	
	function form($id=FALSE){
		$data['people'] = $this->people->get_row($id);
		$this->template->build('people_form', $data);
	}
	
	function save()
	{
		//$this->db->debug = true;
		$_POST['birthstamp'] = $_POST['birth'];
		$_POST['birth']=($_POST['birth']!="")? ThaiDatePicker2Oracle($_POST['birth']):'';
		$_POST['birthstamp']=($_POST['birthstamp']!="")? th_to_stamp($_POST['birthstamp']):'';
		$this->people->save($_POST);
		set_notify('success', lang('save_data_complete'));
		redirect('setting/people');
	}
	
	function delete($id=FALSE)
	{
		if($id)
		{
			$this->people->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('setting/people');
		}
		
	}
}
?>