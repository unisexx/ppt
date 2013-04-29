<?php
Class Hf_elderly extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('hf_elderly_model','welfare');
		$this->load->model('hf_elderlylist_model','wflist');
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


	//===== HOSPITAL OF ELDERLY =====//
		function index()
		{
			$sql = 'SELECT * FROM HF_ELDERLY_DATA WHERE 1=1 ';
				if(@$_GET['YEAR']) $sql .= "AND YEAR = ".$_GET['YEAR'].' ';
				if(@$_GET['WLIST']) $sql .= "AND WLIST_ID = ".$_GET['WLIST'].' ';
			
			$data['result'] = $this->welfare->get($sql);
	    	$data['pagination'] = $this->welfare->pagination;
			
			$this->template->build('hf_elderly/index', $data);
		}
		
		function form($id=FALSE)
		{
			$wlist = $this->db->execute('SELECT * FROM hf_elderly_list');
			$data['id'] = @$id;
			if(@$id) { $data['result'] = $this->welfare->get_row($id); }
			
			$this->template->build('hf_elderly/form', $data);
		}
		
			function save()
			{
				$this->welfare->save($_POST);
				set_notify('success', lang('save_data_complete'));	redirect('elder/hf_elderly/');
			}
			
		function delete($id=FALSE)
		{
			if($id)
			{
				$this->welfare->delete($id);
	            set_notify('success', lang('delete_data_complete'));	redirect('elder/hf_elderly/');
			}
		}
		
		
		
		function import() { $this->template->build('hf_elderly/import'); }
		function upload()
		{
			$_POST['SECTION_ID'] = ($_POST['WORKGROUP_ID']>0)?$_POST['WORKGROUP_ID']:$_POST['SECTION_ID'];
            $this->info->save($_POST);
			unset($_POST);
			

			$month_th = array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฏาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');
			$data['content'] = '';
			
			$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'hfelderly_'.date("Y_m_d_H_i_s").'.'.$ext;	$uploaddir = 'import_file/elder/hfelderly/';
			
			move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.$file_name);
				$data = $this->ReadData($uploaddir.$file_name);
				unlink($uploaddir.$file_name);
			
			$_POST['YEAR'] = $data[1][1];
			$_POST['MONTH'] = array_search(trim($data[1][3]), $month_th)+1;

			for($i=3; $i<count($data); $i++)
			{
				$wlist_dtl = $this->wflist->limit(1)->get("SELECT * FROM HF_ELDERLY_LIST WHERE NAME LIKE '".$data[$i][0]."'");
				$_POST['WLIST_ID'] = $wlist_dtl[0]['id'];
				$_POST['TARGET'] = $data[$i][1];
				$_POST['BALANCE'] = $data[$i][2];
				$_POST['ADMISSION'] = $data[$i][3];
				$_POST['DISTRIBUTION'] = $data[$i][4];
				$_POST['REMAIN'] = $data[$i][5];
				$_POST['BUILD'] = $data[$i][6];
				
				$chk_repeat;
				if($_POST['YEAR'] && $_POST['MONTH'] && $_POST['WLIST_ID'])
				{
					$chk_repeat = $this->welfare->get("SELECT ID FROM HF_ELDERLY_DATA WHERE YEAR=".$_POST['YEAR']." AND MONTH = ".$_POST['MONTH']." AND WLIST_ID = ".$_POST['WLIST_ID']);
				
					if(count($chk_repeat) >= 1)
						{  $data['content'] .= "<DIV class='list' STYLE='color:#F55; '>ไม่สามารถเพิ่มข้อมูลได้เนื่องจาก พบข้อมูล  ".$data[$i][0]." ปี (พ.ศ.) ".$_POST['YEAR']." เดือน  ".$data[1][3]." ในระบบอยู่แล้ว</DIV>"; }
					else
						{
							$this->welfare->save($_POST); 
							$data['content'] .= "<DIV class='list' STYLE='color:#0A0; '>ดำเนินการบันทึกข้อมูล ".$data[$i][0]." ปี (พ.ศ.) ".$_POST['YEAR']." เดือน  ".$data[1][3]." เสร็จสิ้น</DIV>"; }
					if(!$_POST['WLIST_ID'] || !$_POST['YEAR'] || !$_POST['MONTH'])
						{ $data['content'] .= "<DIV class='list' STYLE='color:#F55; '>ไม่สามารถเพิ่มข้อมูลได้เนื่องจากข้อมูลไม่ถูกต้อง </DIV>"; }
				}
			}
			$this->template->build('hf_elderly/upload', @$data);
		}

	//===== HOSPITAL OF ELDERLY =====//	
}
?>