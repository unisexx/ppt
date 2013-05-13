<?php
Class Inmates extends Public_Controller{
	function __construct(){
		parent::__construct();
		#$this->load->model('hf_elderly_model','welfare');
		#$this->load->model('hf_elderlylist_model','wflist');
		$this->load->model('province_model', 'province');
		$this->load->model('elder_inmates_model', 'inmates');
		$this->load->model('elder_inmateslist_model', 'inmateslist');
		$this->load->model('info_model', 'info');
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
			$cnt_colum = count($data->sheets[0]['cells'][$i]);
			for($j=1; $j<=$cnt_colum; $j++) { $import[$index][] = trim($data -> sheets[0]['cells'][$i][$j]); }
			$index++;
		}
		return $import;	
	}


	//===== INMATES OF ELDERLY =====//
		function index()
		{
			
			if(@$_GET['PROVINCE'])
			{
				$inmateslist = $this->inmateslist->get("SELECT id FROM ELDER_INMATES_LIST WHERE PROVINCE_ID LIKE '".$_GET['PROVINCE']."'");
			}
			
			$sql = 'SELECT * FROM ELDER_INMATES WHERE 1=1 ';
				if(@$_GET['YEAR']) $sql .= "AND YEAR = ".$_GET['YEAR'].' ';
				if(@$_GET['PROVINCE'])
				{
					$sql .= ' AND (';
					for($i=0; $i<count($inmateslist); $i++)
					{
						$sql .= 'INMATESLIST_ID = '.$inmateslist[$i]['id'];
						if(@$inmateslist[$i+1]) { $sql .= ' OR '; }
					}
					$sql .= ') ';
				}
			$sql .= ' ORDER BY ID DESC';
			
			$data['result'] = $this->inmates->get($sql);
	    	$data['pagination'] = $this->inmates->pagination;
			
			$this->template->build('inmates/index', $data);
		}
		
		function form($id=FALSE)
		{
			$wlist = $this->db->execute('SELECT * FROM ELDER_INMATES');
			$data['id'] = @$id;
			if(@$id) { $data['result'] = $this->inmates->get_row($id); }
			
			$this->template->build('inmates/form', $data);
		}
		
			function save()
			{
				#print_r($_POST);
				$this->inmates->save($_POST);
				set_notify('success', lang('save_data_complete'));	redirect('elder/inmates/');
			}
			
		function delete($id=FALSE)
		{
			if($id)
			{
				$this->inmates->delete($id);
	            set_notify('success', lang('delete_data_complete'));	redirect('elder/inmates/');
			}
		}
		
		
		
		function import() { $this->template->build('inmates/import'); }

		function upload()
		{
			
			$_POST['SECTION_ID'] = ($_POST['WORKGROUP_ID']>0)?$_POST['WORKGROUP_ID']:$_POST['SECTION_ID'];
            $this->info->save($_POST);
            $year = $_POST['YEAR_DATA'];
			unset($_POST);
			

			$month_th = array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฏาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');
			$data['content'] = '';
			
			$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'hfelderly_'.date("Y_m_d_H_i_s").'.'.$ext;	$uploaddir = 'import_file/elder/hfelderly/';
			
			move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.$file_name);
				$data = $this->ReadData($uploaddir.$file_name);
			unlink($uploaddir.$file_name);
			
			$_POST['YEAR'] = $year;
			if($_POST['YEAR'])
			{
					for($i=4; $i<count($data); $i++)
					{
						$list_id = $this->inmateslist->limit(1)->get("SELECT * FROM ELDER_INMATES_LIST WHERE NAME LIKE '".$data[$i][0]."'");
						if($list_id[0]['id'])
						{
							$_POST['INMATESLIST_ID'] = $list_id[0]['id'];
							$_POST['VALUE1_M'] = $data[$i][2];
							$_POST['VALUE1_F'] = $data[$i][3];
							$_POST['VALUE2_M'] = $data[$i][4];
							$_POST['VALUE2_F'] = $data[$i][5];
							$_POST['VALUE3_M'] = $data[$i][6];
							$_POST['VALUE3_F'] = $data[$i][7];
							
							
							$chk_repeat = $this->inmates->get("SELECT * FROM ELDER_INMATES WHERE INMATESLIST_ID LIKE '".$_POST['INMATESLIST_ID']."' AND YEAR LIKE '".$_POST['YEAR']."'");
							if(count($chk_repeat) >= 1)
							{ $data['content'] .= "<DIV class='list' STYLE='color:#F55; '>ไม่สามารถเพิ่มข้อมูลได้เนื่องจาก พบข้อมูล  ".$data[$i][0]." ปี (พ.ศ.) ".$_POST['YEAR']." ในระบบอยู่แล้ว</DIV>"; }
							else if(!$_POST['INMATESLIST_ID'] || !$_POST['YEAR'])
							{ $data['content'] .= "<DIV class='list' STYLE='color:#F55; '>ไม่สามารถเพิ่มข้อมูลได้เนื่องจาก พบข้อมูล ในเอกสารไม่ถูกต้อง"; }
							else
							{
								$data['content'] .= "<DIV class='list' STYLE='color:#0A0; '>ดำเนินการบันทึกข้อมูล ".$data[$i][0]." ปี (พ.ศ.) ".$_POST['YEAR']." เสร็จสิ้น</DIV>"; 
								$this->inmates->save($_POST);
							}
						}
					}
			} else {
				$data['content'] = '<DIV style="background:#EEE; border-radius:5px; line-height:80px; font-weight:bold; color:#F33; text-align:center; width:100%;">กรุณาเลือกปีก่อนการดำเนินการ</DIV>';
			}
			
			$this->template->build('inmates/upload', @$data);
		}

	//===== INMATES OF ELDERLY =====//	
}
?>