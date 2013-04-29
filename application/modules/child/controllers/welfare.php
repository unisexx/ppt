<?php
Class Welfare extends Public_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('opt_model', 'opt');
		$this->load->model('c_drop_model','drop');
		$this->load->model('c_pregnant_model','pregnant');
		$this->load->model('province_model','province');

		$this->load->model('welfare_model','welfare');
		$this->load->model('welfarelist_model','wflist');
	}

	//===== WELFARE =====//
	function index(){
		menu::source(13);		
		$sql = 'SELECT * FROM WELFARE_DATA WHERE 1=1 ';
		if(@$_GET['YEAR']) $sql .= "AND YEAR = ".$_GET['YEAR'].' ';
		if(@$_GET['WLIST']) $sql .= "AND WLIST_ID = ".$_GET['WLIST'].' ';
		
		$data['result'] = $this->welfare->get($sql);
    	$data['pagination'] = $this->welfare->pagination;
		
		$this->template->build('welfare/index', $data);
	}
	
	function form($id=FALSE){
		menu::source(13);
		$wlist = $this->db->execute('SELECT * FROM WELFARE_LIST');
		$data['id'] = @$id;
		if(@$id)
		{
			$data['result'] = $this->welfare->get_row($id);
		}
		
		$this->template->build('welfare/form', $data);
	}
		function welfare_save()
		{
			menu::source(13);
			$this->welfare->save($_POST);
			set_notify('success', lang('save_data_complete'));
			redirect('child/welfare/');
		}
	function delete($id=FALSE)
	{
		menu::source(13);
		if($id)
		{
			$this->welfare->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('child/welfare');
		}
		
	}
	
	function import() { menu::source(91); $this->template->build('welfare/import'); }
	function upload()
	{
			unset($_POST['ID']);
			$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'welfare_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/child/welfare/';
			move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.$file_name);
			$data = $this->ReadData($uploaddir.$file_name);
			unlink($uploaddir.$file_name);
			
			$month_th = array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฏาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');
			
			$_POST['YEAR'] = $data[1][1];
			$_POST['MONTH'] = array_search(trim($data[1][3]), $month_th)+1;
			
			for($i=3; $i<count($data); $i++)
			{
				$wlist_dtl = $this->wflist->limit(1)->get("SELECT * FROM WELFARE_LIST WHERE NAME LIKE '".$data[$i][0]."'");
				$_POST['WLIST_ID'] = $wlist_dtl[0]['id'];
				$_POST['TARGET'] = $data[$i][1];
				$_POST['BALANCE'] = $data[$i][2];
				$_POST['ADMISSION'] = $data[$i][3];
				$_POST['DISTRIBUTION'] = $data[$i][4];
				$_POST['REMAIN'] = $data[$i][5];
				$_POST['BUILD'] = $data[$i][6];
				
				
				$chk_repeat = $this->welfare->get("SELECT ID FROM WELFARE_DATA WHERE YEAR=".$_POST['YEAR'])." AND MONTH = ".$_POST['MONTH']." AND WLIST_ID = ".$_POST['WLIST_ID'];
				if($_POST['TARGET'] && $_POST['BALANCE'] && $_POST['ADMISSION'] && $_POST['DISTRIBUTION'] && $_POST['REMAIN'] && $_POST['BUILD'])
				{
					if(count($chk_repeat) == 1)
					{
						?><DIV STYLE='color:#F55; line-height:25px;'>ไม่สามารถเพิ่มข้อมูลได้เนื่องจาก พบข้อมูล  <?=$data[$i][0];?> ปี (พ.ศ.) <?=$_POST['YEAR'];?> เดือน  <?=$data[1][3];?> ในระบบอยู่แล้ว</DIV><?
					}
					else
					{
						$this->welfare->save($_POST);
						?><DIV STYLE='color:#0A0; line-height:25px;'>ดำเนินการบันทึกข้อมูล <?=$data[$i][0];?> ปี (พ.ศ.) <?=$_POST['YEAR'];?> เดือน  <?=$data[1][3];?> เสร็จสิ้น</DIV><?
					}
					if(!$_POST['WLIST_ID'] || !$_POST['YEAR'] || !$_POST['MONTH'])
					{
						?><DIV STYLE='color:#F55; line-height:25px;'>ไม่สามารถเพิ่มข้อมูลได้เนื่องจากข้อมูลไม่ถูกต้อง </DIV><?
					}
				}
				#print_r($_POST);
			}
			?><BR><BR>
				<input type='button' value='กลับไปหน้าแรก' onclick='window.location="../../child/welfare";'>
				<input type='button' value='ย้อนกลับไปหน้านำเข้าข้อมูล' onclick='window.location="../../child/welfare/import";'>
			<?
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
	
	//===== WELFARE =====//	
	
}
?>