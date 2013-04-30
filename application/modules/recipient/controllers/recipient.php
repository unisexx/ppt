<?php
Class Recipient extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('recipient_model','recipient');
		$this->load->model('info_model','info');
	}
	public $menu_id=68;
	function index(){
		$year=(!empty($_GET['year'])) ? " and YEAR=".$_GET['year']:'';
		$agency_id=(!empty($_GET['agency_id'])) ? " and AGENCY_ID=".$_GET['agency_id']:'';	
		$help =(!empty($_GET['help_id'])) ? " and HELP_ID=".$_GET['help_id']:'';
		$data['result'] = $this->recipient->where("1=1 $year $agency_id $help")->get();
		$data['pagination'] = $this->recipient->pagination();	
		$data['menu_id']=$this->menu_id;
		$this->template->build('recipient_index',$data);
	}
	function form($id=FALSE){
		$data['menu_id']=$this->menu_id;	
		$data['rs']=$this->recipient->get_row($id);
		$this->template->build('recipient_form',$data);
	}
	function save(){
		
		if($_POST){
			$_POST['s_date']=(!empty($_POST['s_date']))?  date_to_mysql($_POST['s_date'],true):'0000-00-00';
			$_POST['e_date']=(!empty($_POST['e_date']))?  date_to_mysql($_POST['e_date'],true):'0000-00-00';
			$this->recipient->save($_POST);
			set_notify('success', lang('save_data_complete'));	
		}
		redirect('recipient');
	}
	function delete($id){
		if(!empty($id)){
			$this->recipient->delete($id);
			set_notify('success', lang('delete_data_complete'));	
		}
		redirect('recipient');
	}
	function import(){
		$this->template->build('recipient_import_form');
	}
	function ImportData($filepath)
	{
		require_once 'include/Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data -> setOutputEncoding('UTF-8');
		$data -> read($filepath);		
		error_reporting(E_ALL ^ E_NOTICE);		
		$index = 0;
		foreach($data->sheets as $key =>$item){			
			for($i = 1; $i <= $item['numRows']; $i++) {
				$cnt_colum = count($item['cells'][$i]);
				for($j=1; $j<=$cnt_colum; $j++)
				{
					$import[$index][] = trim($item['cells'][$i][$j]);		
				}
				$index++;			
			}
		}	
		return $import;			
	}	
	function save_import(){
			if($_FILES['fl_import']['name']!=''){
				/*---for insert value to info table ---*/
					$import_section_id = $_POST['import_workgroup_id']> 0 ? $_POST['import_workgroup_id'] : $_POST['import_section_id'];
					$_POST['section_id'] = $import_section_id;
					$_POST['menu_id']=$this->menu_id;
					$this->info->save($_POST);
				/*--end--*/								
				$this->db->execute("DELETE FROM RECIPIENT WHERE YEAR='".$_POST['year_data']."'");
				$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
				$file_name = 'recipient_'.$_POST['year_data'].date("Y_m_d_H_i_s").'.'.$ext;	
				$uploaddir = 'import_file/recipient/';
				$fpicname = $uploaddir.$file_name;
				move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);		
				$data= $this->ImportData($uploaddir.$file_name);				
				foreach($data as $key=>$item){	
						if(strpos($item[0],':')){
							list($s_date,$e_date)=explode('-',substr($item[0],strpos ($item[0],':')+1));
							$val['s_date']=Date2Oracle($s_date);
							$val['e_date']=Date2Oracle($e_date);
							continue;
							}
							if(in_array('รหัสหน่วยงาน',$item)){
								continue;
							}	
							$val['agency_id'] =$item[0];
							$val['agency'] =$item[1];
							$val['service_total'] = $item[2];
							$val['help_id'] =$item[3];
							$val['help'] = $item[4];
							$val['money_total'] = $item[5];
							$val['year'] = $_POST['year_data'];
							$val['create'] =date('Y-m-d');
							$this->recipient->save($val);																	
				}
			set_notify('success', lang('save_data_complete'));		
		}
		redirect('recipient/import');
	}	
}	