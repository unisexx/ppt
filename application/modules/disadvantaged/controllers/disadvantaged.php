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
			menu::source(71);
		$sql = 'SELECT * FROM UNEMPLOYEE WHERE 1=1 ';
			if(@$_GET['YEAR']) $sql .= "AND YEAR = ".$_GET['YEAR'].' ';
			if(@$_GET['PROVINCE']) $sql .= "AND PROVINCE_ID = ".$_GET['PROVINCE'].' ';
		$sql .= 'ORDER BY YEAR DESC, PROVINCE_ID ASC';
		
		$data['result'] = $this->unemployee->get($sql);
    	$data['pagination'] = $this->unemployee->pagination;
		
		$this->template->build('unemployee/unemployee_index', $data);
	}
	
	function unemployee_form($id=FALSE){
			menu::source(71);
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
			menu::source(71);
			$this->unemployee->save($_POST);
			set_notify('success', lang('save_data_complete'));
			redirect('disadvantaged/unemployee');
		}
	function unemployee_delete($id=FALSE)
	{
			menu::source(71);
		if($id)
		{
			$this->unemployee->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('disadvantaged/unemployee');
		}
		
	}
	function unemployee_import()
	{
			menu::source(71);
		$this->template->build('unemployee/unemployee_import');	
	}
		function unemployee_upload()
		{
			menu::source(71);
			$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'unemployee_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/unemployee/';
			move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.'/'.$file_name);
			$data = $this->ReadData($uploaddir.$file_name);
			
			unset($_POST['ID']);
			$_POST['YEAR'] = $data[1][2];
			
			?>
			<h5>ผลการดำเนินงาน</h5>
			<div style='font-family:tahoma; font-size:12px; border-top:solid 1px #CCC;'><?
				for($i=3; $i<count($data); $i++)
				{
					$pv_dtl = $this->province->limit(1)->get("SELECT id FROM PROVINCES WHERE PROVINCE LIKE '".$data[$i][1]."'");
					
					$_POST['PROVINCE_ID'] = @$pv_dtl[0]['id'];
					$_POST['AMOUNT'] = $data[$i][2];
					
					$chk_repeat = $this->unemployee->get("SELECT ID FROM UNEMPLOYEE WHERE PROVINCE_ID = ".$_POST['PROVINCE_ID']." AND YEAR = ".$_POST['YEAR']);
					if(count($chk_repeat) == 1)
					{
						?><div style='color:#F00; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>ไม่สามารถดำเนินการได้ (ข้อมูลซ้ำ): ข้อมูล 
							ปี <? echo $_POST['YEAR']; ?>, จังหวัด
							<? echo $data[$i][1]; ?>
						</div><? 
					} else if($_POST['YEAR'] && $_POST['PROVINCE_ID'] && $_POST['AMOUNT']) {
						
						$this->unemployee->save($_POST);
						?><div style='color:#0A0; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>บันทึก: ข้อมูล 
							ปี <? echo $_POST['YEAR']; ?>, จังหวัด
							<? echo $data[$i][1]; ?>
						</div><? 
					}
				}
			?></div><?
			unlink($uploaddir.'/'.$file_name);
			
			?><BR><BR>
				<input type='button' value='กลับไปหน้าแรก' onclick='window.location="disadvantaged/unemployee";'>
				<input type='button' value='ย้อนกลับไปหน้านำเข้าข้อมูล' onclick='window.location="disadvantaged/unemployee_import";'>
			<?
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
	function vacancy_import()
	{
		$this->template->build('vacancy/vacancy_import');	
	}
	
		function vacancy_upload()
		{
			$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'vacancy_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/vacancy/';
			move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.'/'.$file_name);
			$data = $this->ReadData($uploaddir.$file_name);
			
			unset($_POST['ID']);
			$_POST['YEAR'] = $data[1][2];
			
			?>
			<h5>ผลการดำเนินงาน</h5>
			<div style='font-family:tahoma; font-size:12px; border-top:solid 1px #CCC;'><?
				for($i=3; $i<count($data); $i++)
				{
	
					$pv_dtl = $this->province->limit(1)->get("SELECT id FROM PROVINCES WHERE PROVINCE LIKE '".$data[$i][1]."'");
					$_POST['PROVINCE_ID'] = @$pv_dtl[0]['id'];
					$_POST['VACANCIES'] = $data[$i][2];
					$_POST['CANDIDATES'] = $data[$i][3];
					$_POST['ACTIVE'] = $data[$i][4];
					
					$chk_repeat = $this->vacancy->get("SELECT ID FROM VACANCY WHERE PROVINCE_ID = ".$_POST['PROVINCE_ID']." AND YEAR = ".$_POST['YEAR']);
					if(count($chk_repeat) == 1)
					{
						?><div style='color:#F00; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>ไม่สามารถดำเนินการได้ (ข้อมูลซ้ำ): ข้อมูล 
							ปี <? echo $_POST['YEAR']; ?>, จังหวัด
							<? echo $data[$i][1]; ?>
						</div><? 
					} else if($_POST['YEAR'] && $_POST['PROVINCE_ID'] && ($_POST['VACANCIES'] || $_POST['CANDIDATES'] || $_POST['ACTIVE'])) {
						$this->vacancy->save($_POST);
						?><div style='color:#0A0; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>บันทึก: ข้อมูล 
							ปี <? echo $_POST['YEAR']; ?>, จังหวัด
							<? echo $data[$i][1]; ?>
						</div><? 
					}
				}
			?></div><?
			unlink($uploaddir.'/'.$file_name);
			
			?><BR><BR>
				<input type='button' value='กลับไปหน้าแรก' onclick='window.location="disadvantaged/vacancy";'>
				<input type='button' value='ย้อนกลับไปหน้านำเข้าข้อมูล' onclick='window.location="disadvantaged/vacancy_import";'>
			<?

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
			function ReadData($filepath)
			{
				require_once 'include/Excel/reader.php';
				$data = new Spreadsheet_Excel_Reader();
				$data -> setOutputEncoding('UTF-8');
				$data -> read($filepath);
				
				error_reporting(E_ALL ^ E_NOTICE);		
				$index = 0;
				for($i = 1; $i <= $data -> sheets[0]['numRows']; $i++) {
					$import[$index][] = trim($data -> sheets[0]['cells'][$i][1]);
					$import[$index][] = trim($data -> sheets[0]['cells'][$i][2]);
					$import[$index][] = trim($data -> sheets[0]['cells'][$i][3]);
					$import[$index][] = trim($data -> sheets[0]['cells'][$i][4]);
					$import[$index][] = trim($data -> sheets[0]['cells'][$i][5]);
					$import[$index][] = trim($data -> sheets[0]['cells'][$i][6]);
					$index++;			
				}
				return $import;	
			}
}
?>