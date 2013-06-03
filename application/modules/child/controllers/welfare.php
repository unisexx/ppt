<?php
Class Welfare extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('welfare_model','welfare');
		$this->load->model('welfarelist_model','wflist');
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
		function index()
		{
			$set_year = $this->welfare->get("SELECT YEAR FROM WELFARE_DATA GROUP BY YEAR ORDER BY YEAR DESC");
			
			for($i=0; $i<count($set_year); $i++) 
			{ $data['set_year'][$set_year[$i]['year']] = $set_year[$i]['year']; }
			
			$sql = 'SELECT * FROM WELFARE_DATA WHERE 1=1 ';
				if(@$_GET['YEAR']) $sql .= "AND YEAR = ".$_GET['YEAR'].' ';
				if(@$_GET['WLIST']) $sql .= "AND WLIST_ID = ".$_GET['WLIST'].' ';
			
			$data['result'] = $this->welfare->get($sql);
	    	$data['pagination'] = $this->welfare->pagination;
			
			$this->template->build('welfare/index', $data);
		}
		
		function form($id=FALSE)
		{
			$wlist = $this->db->execute('SELECT * FROM WELFARE_LIST');
			$data['id'] = @$id;
			if(@$id) { $data['result'] = $this->welfare->get_row($id); }
			
			$this->template->build('welfare/form', $data);
		}
			function save($menu_id)
			{
				$id = $this->welfare->save($_POST);
	           	if(empty($_POST['id'])) logs('เพิ่มรายการ ', $menu_id, $id); else logs('แก้ไขรายการ', $menu_id, $id);
				set_notify('success', lang('save_data_complete'));	redirect('child/welfare/');
			}
		function delete($menu_id, $id)
		{
			if($id)
			{
				logs('ลบรายการ', $menu_id, $id);
				$this->welfare->delete($id);
	            set_notify('success', lang('delete_data_complete'));	redirect('child/welfare');
			}
		}
		
		function import() { $this->template->build('welfare/import'); }
		function upload()
		{
			#$total_row = 0;
			$amount_rp = 0;
			unset($_POST['ID']);
			$month_th = array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฏาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');
			$data['content'] = '';
			
			$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'welfare_'.date("Y_m_d_H_i_s").'.'.$ext;	$uploaddir = 'import_file/child/welfare/';
			
			move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.$file_name);
				$data = $this->ReadData($uploaddir.$file_name);
			unlink($uploaddir.$file_name);
			
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
				
				if($_POST['TARGET'] || $_POST['BALANCE'] || $_POST['ADMISSION'] || $_POST['DISTRIBUTION'] || $_POST['REMAIN'] || $_POST['BUILD'])
				{
					$chk_repeat_tmp = $this->welfare->where("YEAR LIKE '".$_POST['YEAR']."' AND WLIST_ID LIKE '".$_POST['WLIST_ID']."'")->get();
					if(count($chk_repeat_tmp) != 0) { $amount_rp++; }
					$result[] = $_POST;
				}
				
				/*
				if($_POST['YEAR'] && $_POST['MONTH'] && $_POST['WLIST_ID'])
				{
					print_r($_POST);
					echo '<BR>';
					$chk_repeat = $this->welfare->get("SELECT ID FROM WELFARE_DATA WHERE YEAR=".$_POST['YEAR']." AND MONTH = ".$_POST['MONTH']." AND WLIST_ID = ".$_POST['WLIST_ID']);
				
					if(count($chk_repeat) >= 1)
						{  $data['content'] .= "<DIV class='list' STYLE='color:#F55; '>ไม่สามารถเพิ่มข้อมูลได้เนื่องจาก พบข้อมูล  ".$data[$i][0]." ปี (พ.ศ.) ".$_POST['YEAR']." เดือน  ".$data[1][3]." ในระบบอยู่แล้ว</DIV>"; }
					else
						{
							#$total_row++;
							
							//$this->welfare->save($_POST); 
							$data['content'] .= "<DIV class='list' STYLE='color:#0A0; '>ดำเนินการบันทึกข้อมูล ".$data[$i][0]." ปี (พ.ศ.) ".$_POST['YEAR']." เดือน  ".$data[1][3]." เสร็จสิ้น</DIV>"; }
					if(!$_POST['WLIST_ID'] || !$_POST['YEAR'] || !$_POST['MONTH'])
						{ $data['content'] .= "<DIV class='list' STYLE='color:#F55; '>ไม่สามารถเพิ่มข้อมูลได้เนื่องจากข้อมูลไม่ถูกต้อง </DIV>"; }
				}
				 * 
				 */
			}

				if($amount_rp >= 1)
				{
					?><script language='javascript'>
						if(!confirm('พบการนำเข้าข้อมูลจำนวน <?=count($result);?> รายการ เป็นข้อมูลที่มีอยู่แล้ว <?=$amount_rp;?> รายการ หากยืนยันจะดำเนินการต่อ ข้อมูลเก่าจะถูกแทนที่ด้วยข้อมูลใหม่ในทันที'))
						{
							alert('ปฏิเสธการบันทึกข้อมูล');
							window.location="../mental/import";
							return false;
						}
					</script><?
				}

			
			for($i=0; $i<count($result); $i++)
			{
				$chk_repeat_tmp = $this->welfare->where("YEAR LIKE '".$result[$i]['YEAR']."' AND WLIST_ID LIKE '".$result[$i]['WLIST_ID']."'")->get();
				$welfare_dtl = $this->wflist->get_row($result[$i]['WLIST_ID']);

				if(count($chk_repeat_tmp) != 0)
					{
						$this->welfare->where("WLIST_ID LIKE '".$result[$i]['WLIST_ID']."' AND YEAR LIKE '".$result[$i]['YEAR']."'")->delete();
						$content .= "<div style='color:#d97f31; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>".($i+1).". บันทึก : ทำการเขียนทับข้อมูล \"".$welfare_dtl['name']."\" </div>"; 
					}
				else 
					{ $content .= "<div style='color:#0A0; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>".($i+1).". บันทึก : เพิ่มข้อมูล  \"".$welfare_dtl['name']."\" </div>"; }
				print_r($result[$i]);
				echo '<BR>';
				$this->welfare->save($result[$i]);
			}
			
			$data['content'] = "<div style='line-height:30px; font-weight:bold;'>บันทึกข้อมูลทั้งสิ้น ".count($result).' รายการ เป็นรายการที่ซ้ำทั้งสิ้น '.$amount_rp.' รายการ  </div>'.$content;
			
			$this->template->build('welfare/upload.php', $data);
			#if($total_row>0) logs('นำเข้าข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์  จำนวน '.number_format($total_row).' record');
			//$this->template->build('welfare/upload', $data);
		}

	//===== WELFARE =====//	
	
}
?>