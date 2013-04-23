<?php
Class Disadvantaged extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('province_model', 'province');
		
		$this->load->model('unemployee_model', 'unemployee');
		$this->load->model('vacancy_model', 'vacancy');
	}
	//========== UNEMPLOYEE ==========//
	function unemployee(){
		$sql = 'SELECT * FROM UNEMPLOYEE WHERE 1=1 ';
			if(@$_GET['YEAR']) $sql .= "AND YEAR = ".$_GET['YEAR'].' ';
			if(@$_GET['PROVINCE']) $sql .= "AND PROVINCE_ID = ".$_GET['PROVINCE'].' ';
		$sql .= 'ORDER BY YEAR DESC, PROVINCE_ID ASC';
		
		$data['result'] = $this->unemployee->get($sql);
    	$data['pagination'] = $this->unemployee->pagination;
		
		$this->template->build('unemployee/unemployee_index', $data);
	}
	
	function unemployee_form($id=FALSE){
		$wlist = $this->db->execute('SELECT * FROM UNEMPLOYEE');
		$data['id'] = @$id;
		if(@$id)
		{
			$data['result'] = $this->unemployee->get_row($id);
		}
		
		$this->template->build('unemployee/unemployee_form', $data);
	}
		function unemployee_save()
		{
			$this->unemployee->save($_POST);
			set_notify('success', lang('save_data_complete'));
			redirect('disadvantaged/unemployee');
		}
	function unemployee_delete($id=FALSE)
	{
		if($id)
		{
			$this->unemployee->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('disadvantaged/unemployee');
		}
		
	}
		function unemployee_upload()
		{
			//print_r($_FILES);
			$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'unemployee_'.$_POST['YEAR'].date("Y_m_d_H_i_s").'.'.$ext;
			//$file_name = 'vacancy'.'.'.$ext;			
			$uploaddir = 'import_file/unemployee/';
			move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.'/'.$file_name);
			$data = $this->ReadData_unemployee($uploaddir.$file_name);
			unlink($uploaddir.'/'.$file_name);
		}
	
	function unemployee_import()
	{
		$this->template->build('unemployee/unemployee_import');	
	}
	//========== UNEMPLOYEE ==========//

	
	
	//========== VACANCY ==========//
	function vacancy(){
		$sql = 'SELECT * FROM VACANCY WHERE 1=1 ';
			if(@$_GET['YEAR']) $sql .= "AND YEAR = ".$_GET['YEAR'].' ';
			if(@$_GET['PROVINCE']) $sql .= "AND PROVINCE_ID = ".$_GET['PROVINCE'].' ';
		$sql .= 'ORDER BY YEAR DESC, PROVINCE_ID ASC';
		
		$data['result'] = $this->vacancy->get($sql);
    	$data['pagination'] = $this->vacancy->pagination;
		
		$this->template->build('vacancy/vacancy_index', $data);
	}	
	function vacancy_form($id=FALSE){
		$data['id'] = @$id;
		if(@$id)
		{
			$data['result'] = $this->vacancy->get_row($id);
		}
		
		$this->template->build('vacancy/vacancy_form', $data);
	}
		function vacancy_save()
		{
			$this->vacancy->save($_POST);
			set_notify('success', lang('save_data_complete'));
			redirect('disadvantaged/vacancy');
		}
	function vacancy_delete($id=FALSE)
	{
		if($id)
		{
			$this->vacancy->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('disadvantaged/vacancy');
		}
		
	}
		function vacancy_upload()
		{
			//print_r($_FILES);
			$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'vacancy_'.$_POST['YEAR'].date("Y_m_d_H_i_s").'.'.$ext;
			//$file_name = 'vacancy'.'.'.$ext;			
			$uploaddir = 'import_file/vacancy/';
			move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.'/'.$file_name);
			$data = $this->ReadData_vacancy($uploaddir.$file_name);
			unlink($uploaddir.'/'.$file_name);
		}
	
	
	function vacancy_import()
	{
		$this->template->build('vacancy/vacancy_import');	
	}
	//========== VACANCY ==========//
				
	function social(){
		$this->template->build('social_index');
	}
	
	function social_form(){
		$this->template->build('social_form');
	}
	
	function province(){
		$this->template->build('province_index');
	}
	
	function province_form(){
		$this->template->build('province_form');
	}
	
	function allage(){
		$this->template->build('allage_index');
	}
	
	function allage_form(){
		$this->template->build('allage_form');
	}

			function ReadData_vacancy($filepath){
					require_once 'include/Excel/reader.php';
					$data = new Spreadsheet_Excel_Reader();
					$data -> setOutputEncoding('UTF-8');
					$data -> read($filepath);
					error_reporting(E_ALL ^ E_NOTICE);		
					$index = 0;
					for($i = 3; $i <= $data -> sheets[0]['numRows']; $i++) {
						$import[$index]['title'] = trim($data -> sheets[0]['cells'][$i][1]);
						$import[$index]['province'] = trim($data -> sheets[0]['cells'][$i][2]);
						$import[$index]['vacancies'] = trim($data -> sheets[0]['cells'][$i][3]);
						$import[$index]['candidates'] = trim($data -> sheets[0]['cells'][$i][4]);
						$import[$index]['active'] = trim($data -> sheets[0]['cells'][$i][5]);
						#$import[$index]['value_length'] = strlen($import[$index]['value']);								 
						$index++;			
					}	
					
					
					for($i=0; $i<count($import); $i++)
					{
						$pv_dtl = $this->province->limit(1)->get("SELECT * FROM PROVINCES WHERE PROVINCE LIKE '".$import[$i]['province']."'");
						$_POST['PROVINCE_ID'] = $pv_dtl[0]['id'];
						$_POST['VACANCIES'] = $import[$i]['vacancies'];
						$_POST['CANDIDATES'] = $import[$i]['candidates'];
						$_POST['ACTIVE'] = $import[$i]['active'];
						$this->vacancy->save($_POST);
					}
						set_notify('success', lang('save_data_complete'));
						redirect('disadvantaged/vacancy');
			}
		
			function ReadData_unemployee($filepath){
				
					require_once 'include/Excel/reader.php';
					$data = new Spreadsheet_Excel_Reader();
					$data -> setOutputEncoding('UTF-8');
					$data -> read($filepath);
					
					error_reporting(E_ALL ^ E_NOTICE);		
					$index = 0;
					for($i = 3; $i <= $data -> sheets[0]['numRows']; $i++) {
						$import[$index]['year'] = trim($data -> sheets[0]['cells'][$i][2]);
						$import[$index]['province'] = trim($data -> sheets[0]['cells'][$i][3]);
						$import[$index]['amount'] = trim($data -> sheets[0]['cells'][$i][4]);
						#$import[$index]['value_length'] = strlen($import[$index]['value']);								 
						$index++;			
					}	
					
					
					for($i=0; $i<count($import); $i++)
					{
						$pv_dtl = $this->province->limit(1)->get("SELECT * FROM PROVINCES WHERE PROVINCE LIKE '".$import[$i]['province']."'");
						$_POST['PROVINCE_ID'] = $pv_dtl[0]['id'];
						$_POST['YEAR'] = $_POST['YEAR'];
						$_POST['AMOUNT'] = $import[$i]['amount'];
						$this->unemployee->save($_POST);
					}
					
						set_notify('success', lang('save_data_complete'));
						redirect('disadvantaged/unemployee');
			}
}
?>