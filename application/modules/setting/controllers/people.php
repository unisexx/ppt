<?php
Class People extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('people_model','people');
	}
	
	function index(){
		$condition = " 1=1 ";
		$condition .= (@$_GET['name']!='')?" and NAME like '%".$_GET['name']."%'" : "";
		if(@$_GET['age']!=''){
			$todayStamp = strtotime("12:00:00");
			switch($_GET['age']){
				case 1: // 0-18
						// 1398848489 timestamp 1 ปี
			        $condition .= "and birth between 0 and (".$todayStamp." - (1398848489*18))";
			        break;
			    case 2: // 18-25
			        $condition .= "and birth between (".$todayStamp." - (1398848489*18)) and (".$todayStamp." - (1398848489*25))";
			        break;
			    case 3: // 25-60
			        $condition .= "and birth between (".$todayStamp." - (1398848489*25)) and (".$todayStamp." - (1398848489*60))";
			        break;
				case 4: // 60 up
			        $condition .= "and birth between (".$todayStamp." - (1398848489*60)) and (".$todayStamp." - (1398848489*100))";
			        break;
			}
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
		$_POST['birth']=($_POST['birth']!="")? th_to_stamp($_POST['birth']):'';
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