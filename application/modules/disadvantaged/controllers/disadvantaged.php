<?php
Class Disadvantaged extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('province_model', 'province');
		
		$this->load->model('unemployee_model', 'unemployee');
		$this->load->model('vacancy_model', 'vacancy');
		$this->load->model('info_model','info');
	}
	//========== UNEMPLOYEE ==========//
	function unemployee(){
		$sql = 'SELECT UNEMPLOYEE.*, PROVINCES.PROVINCE
        FROM UNEMPLOYEE
        JOIN PROVINCES ON PROVINCES.ID = UNEMPLOYEE.PROVINCE_ID
        WHERE 1=1 ';
			if(@$_GET['YEAR']) $sql .= "AND YEAR = ".$_GET['YEAR'].' ';
			if(@$_GET['PROVINCE']) $sql .= "AND PROVINCE_ID = ".$_GET['PROVINCE'].' ';
		$sql .= ' ORDER BY UNEMPLOYEE."YEAR" DESC, PROVINCES.PROVINCE';
		
		$data['result'] = $this->unemployee->get($sql);
    	$data['pagination'] = $this->unemployee->pagination;
		
		$this->template->build('unemployee/unemployee_index', $data);
	}
	
	function unemployee_form($id=FALSE){
		$wlist = $this->db->execute('SELECT * FROM UNEMPLOYEE');
		$data['id'] = @$id;
		if(@$id) { $data['result'] = $this->unemployee->get_row($id); }
		
		$this->template->build('unemployee/unemployee_form', $data);
	}
		function unemployee_save($menu_id)
		{
			$id=$this->unemployee->save($_POST);
			if(empty($_POST['id'])) logs('เพิ่มรายการ ', $menu_id, $id); else logs('แก้ไขรายการ', $menu_id, $id);
			set_notify('success', lang('save_data_complete'));
			redirect('disadvantaged/unemployee');
		}
	function unemployee_delete($menu_id, $id)
	{
		if($id)
		{
			logs('ลบรายการ', $menu_id, $id);
			$this->unemployee->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('disadvantaged/unemployee');
		}
		
	}
	function unemployee_import() { $this->template->build('unemployee/unemployee_import'); }
		function unemployee_upload()
		{
			$amount_rp = 0;
			$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'unemployee_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/unemployee/';
			move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.'/'.$file_name);
			$data = $this->ReadData($uploaddir.$file_name);
			$year_data = $_POST['YEAR_DATA'];
			unset($_POST);

			$_POST['YEAR'] = $year_data;
			for($i=3; $i<count($data); $i++)
				{
					$pv_dtl = $this->province->limit(1)->get("SELECT id FROM PROVINCES WHERE PROVINCE LIKE '".$data[$i][1]."'");
					
					$_POST['PROVINCE_ID'] = @$pv_dtl[0]['id'];
					$_POST['AMOUNT'] = $data[$i][2];

					if($_POST['PROVINCE_ID'] && $_POST['AMOUNT'])
					{
						$chk_rp_tmp = $this->unemployee->where("YEAR LIKE '".$_POST['YEAR']."' AND PROVINCE_ID LIKE '".$_POST['PROVINCE_ID']."'")->get();
						
						if(count($chk_rp_tmp) != 0) { $amount_rp++; }
						$result[] = $_POST;
					}
				}
				
			if($amount_rp >= 1)
			{
				?><script language='javascript'>
					if(!confirm('พบการนำเข้าข้อมูลจำนวน <?=count($result);?> รายการ เป็นข้อมูลที่มีอยู่แล้ว <?=$amount_rp;?> รายการ หากยืนยันจะดำเนินการต่อ ข้อมูลเก่าจะถูกแทนที่ด้วยข้อมูลใหม่ในทันที'))
					{
						alert('ปฏิเสธการบันทึกข้อมูล');
						window.location="../disdvantaged/unemployee_import";
						return false;
					}
				</script><?
			}
			
			for($i=0; $i<count($result); $i++)
			{
				$chk_rp_tmp = $this->unemployee->where("YEAR LIKE '".$result[$i]['YEAR']."' AND PROVINCE_ID LIKE '".$result[$i]['PROVINCE_ID']."'")->get();
				$province_dtl = $this->province->get_row($result[$i]['PROVINCE_ID']);
				if(count($chk_rp_tmp) != 0 )
				{
					$this->unemployee->where("YEAR LIKE '".$result[$i]['YEAR']."' AND PROVINCE_ID LIKE '".$result[$i]['PROVINCE_ID']."'")->delete();
					$content .= "<div style='color:#d97f31; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>".($i+1).". บันทึก : ทำการเขียนทับข้อมูล จังหวัด \"".$province_dtl['province']."\" </div>";
				}
				else 
				{ $content .= "<div style='color:#0A0; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>".($i+1).". บันทึก : เพิ่มข้อมูล จังหวัด \"".$province_dtl['province']."\" </div>"; }
				
				$this->unemployee->save($result[$i]);
			}
			$data['content'] = $content;
			
			$this->template->build('unemployee/unemployee_upload.php', $data);
		}
	//========== UNEMPLOYEE ==========//

	
	
	//========== VACANCY ==========//
	function vacancy(){
		$sql = 'SELECT VACANCY.*, PROVINCES.PROVINCE
        FROM VACANCY
        JOIN PROVINCES ON PROVINCES.ID = VACANCY.PROVINCE_ID
        WHERE 1=1 ';
			if(@$_GET['YEAR']) $sql .= "AND YEAR = ".$_GET['YEAR'].' ';
			if(@$_GET['PROVINCE']) $sql .= "AND PROVINCE_ID = ".$_GET['PROVINCE'].' ';
		$sql .= 'ORDER BY VACANCY."YEAR" DESC, PROVINCES.PROVINCE';
	
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
		function vacancy_save($menu_id)
		{
			$id=$this->vacancy->save($_POST);
			if(empty($_POST['id'])) logs('เพิ่มรายการ ', $menu_id, $id); else logs('แก้ไขรายการ', $menu_id, $id);
			set_notify('success', lang('save_data_complete'));
			redirect('disadvantaged/vacancy');
		}
	function vacancy_delete($menu_id, $id)
	{
		if($id)
		{
			logs('ลบรายการ', $menu_id, $id);
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
			$amount_rp = 0;
			$_POST['SECTION_ID'] = ($_POST['WORKGROUP_ID']>0)?$_POST['WORKGROUP_ID']:$_POST['SECTION_ID'];
            $this->info->save($_POST);
			$year_data = $_POST['YEAR_DATA'];
			unset($_POST);
			
			$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'vacancy_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/vacancy/';
			move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.'/'.$file_name);
			$data = $this->ReadData($uploaddir.$file_name);
			
			$_POST['YEAR'] = $year_data;
			for($i=3; $i<count($data); $i++)
				{
	
					$pv_dtl = $this->province->limit(1)->get("SELECT id FROM PROVINCES WHERE PROVINCE LIKE '".$data[$i][1]."'");
					$_POST['PROVINCE_ID'] = @$pv_dtl[0]['id'];
					$_POST['VACANCIES'] = $data[$i][2];
					$_POST['CANDIDATES'] = $data[$i][3];
					$_POST['ACTIVE'] = $data[$i][4];
					
					if($_POST['PROVINCE_ID'] && ($_POST['VACANCIES'] || $_POST['CANDIDATES'] || $_POST['ACTIVE']))
					{
						$chk_rp_tmp = $this->vacancy->where("YEAR LIKE '".$_POST['YEAR']."' AND PROVINCE_ID LIKE '".$_POST['PROVINCE_ID']."'")->get();
						if(count($chk_rp_tmp) != 0){ $amount_rp++; }
						$result[] = $_POST;
					}
				}


				if($amount_rp >= 1)
				{
					?><script language='javascript'>
						if(!confirm('พบการนำเข้าข้อมูลจำนวน <?=count($result);?> รายการ เป็นข้อมูลที่มีอยู่แล้ว <?=$amount_rp;?> รายการ หากยืนยันจะดำเนินการต่อ ข้อมูลเก่าจะถูกแทนที่ด้วยข้อมูลใหม่ในทันที'))
						{
							alert('ปฏิเสธการบันทึกข้อมูล');
							window.location="../disdvantaged/vacancy_import";
							return false;
						}
					</script><?
				}


				for($i=0; $i<count($result); $i++)
				{
					$chk_rp_tmp = $this->vacancy->where("YEAR LIKE '".$result[$i]['YEAR']."' AND PROVINCE_ID LIKE '".$result[$i]['PROVINCE_ID']."'")->get();
					$province_dtl = $this->province->get_row($_POST['PROVINCE_ID']);
					if(count($chk_rp_tmp) != 0 )
					{
						$this->vacancy->where("YEAR LIKE '".$result[$i]['YEAR']."' AND PROVINCE_ID LIKE '".$result[$i]['PROVINCE_ID']."'")->delete();
						$content .= "<div style='color:#d97f31; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>".($i+1).". บันทึก : ทำการเขียนทับข้อมูล จังหวัด \"".$province_dtl['province']."\" </div>";
					}
					else 
					{ $content .= "<div style='color:#0A0; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>".($i+1).". บันทึก : เพิ่มข้อมูล จังหวัด \"".$province_dtl['province']."\" </div>"; }

					print_r($result[$i]);
					$this->vacancy->save($result[$i]);
				}
				$data['content'] = $content;
				$this->template->build("vacancy/vacancy_upload", $data);
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
				@require_once 'include/Excel/reader.php';
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