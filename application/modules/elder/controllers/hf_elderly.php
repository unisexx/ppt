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
			$set_year = $this->welfare->get("SELECT YEAR FROM HF_ELDERLY_DATA GROUP BY YEAR ORDER BY YEAR DESC");
			
			for($i=0; $i<count($set_year); $i++) 
			{ $data['set_year'][$set_year[$i]['year']] = $set_year[$i]['year']; }
			
			
			$sql = 'SELECT * FROM HF_ELDERLY_DATA WHERE 1=1 ';
				if(@$_GET['YEAR']) $sql .= "AND YEAR = ".$_GET['YEAR'].' ';
				if(@$_GET['WLIST']) $sql .= "AND WLIST_ID = ".$_GET['WLIST'].' ';
			$sql .= ' order by year desc, wlist_id';
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
		
			function save($menu_id)
			{
				$id = $this->welfare->save($_POST);
				if(empty($_POST['id'])) logs('เพิ่มรายการ ', $menu_id, $id); else logs('แก้ไขรายการ', $menu_id, $id);
				set_notify('success', lang('save_data_complete'));	redirect('elder/hf_elderly/');
			}
			
		function delete($id)
		{
			if($id)
			{
				logs('ลบรายการ', $menu_id, $id);
				$this->welfare->delete($id);
	            set_notify('success', lang('delete_data_complete'));	redirect('elder/hf_elderly/');
			}
		}
		
		
		function import() { $this->template->build('hf_elderly/import'); }
		function upload()
		{
			$amount_rp = 0;
			$_POST['SECTION_ID'] = ($_POST['WORKGROUP_ID']>0)?$_POST['WORKGROUP_ID']:$_POST['SECTION_ID'];
            $this->info->save($_POST);
			$year_data = $_POST['YEAR_DATA'];
			unset($_POST);
			

			$month_th = array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฏาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');
			$data['content'] = '';
			
			$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'hfelderly_'.date("Y_m_d_H_i_s").'.'.$ext;	$uploaddir = 'import_file/elder/hfelderly/';
			
			move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.$file_name);
				$data = $this->ReadData($uploaddir.$file_name);
				unlink($uploaddir.$file_name);

			$_POST['YEAR'] = $year_data; unset($year_data);
			$_POST['MONTH'] = array_search(trim($data[1][3]), $month_th)+1;
			for($i=3; $i<count($data); $i++)
			{
				$wlist_dtl = $this->wflist->limit(1)->get("SELECT * FROM HF_ELDERLY_LIST WHERE NAME LIKE '%".trim($data[$i][0])."%'");
				$_POST['WLIST_ID'] = $wlist_dtl[0]['id'];
				$_POST['TARGET'] = $data[$i][1];
				$_POST['BALANCE'] = $data[$i][2];
				$_POST['ADMISSION'] = $data[$i][3];
				$_POST['DISTRIBUTION'] = $data[$i][4];
				$_POST['REMAIN'] = $data[$i][5];
				$_POST['BUILD'] = $data[$i][6];

				if($_POST['YEAR'] && $_POST['MONTH'] && $_POST['WLIST_ID'] && ($_POST['TARGET'] || $_POST['BALANCE'] || $_POST['ADMISSION'] || $_POST['DISTRIBUTION'] || $_POST['REMAIN'] || $_POST['BUILD']))
				{
					$chk_rp_tmp = $this->welfare->where("YEAR LIKE '".$_POST['YEAR']."' AND MONTH LIKE '".$_POST['MONTH']."' AND WLIST_ID LIKE '".$_POST['WLIST_ID']."'")->get();
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
							window.location="../mental/import";
							return false;
						}
					</script><?
				}
				
				for($i=0; $i<count($result); $i++)
				{
					$chk_rp_tmp = $this->welfare->where("YEAR LIKE '".$result[$i]['YEAR']."' AND MONTH LIKE '".$result[$i]['MONTH']."' AND WLIST_ID LIKE '".$result[$i]['WLIST_ID']."'")->get();
					$welfare_dtl = $this->wflist->get_row($result[$i]['WLIST_ID']);
					
					if(count($chk_rp_tmp) != 0)
						{
							$this->welfare->where("YEAR LIKE '".$result[$i]['YEAR']."' AND MONTH LIKE '".$result[$i]['MONTH']."' AND WLIST_ID LIKE '".$result[$i]['WLIST_ID']."'")->delete();
							$content .= "<div style='color:#d97f31; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>".($i+1).". บันทึก : ทำการเขียนทับข้อมูล \"".$welfare_dtl['name']."\" ปี ".$_POST['YEAR']." </div>"; 
						}
					else 
						{ $content .= "<div style='color:#0A0; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>".($i+1).". บันทึก : เพิ่มข้อมูล  \"".$welfare_dtl['name']."\" ปี ".$_POST['YEAR']." </div>"; }
#						print_r($result[$i]);
						$this->welfare->save($result[$i]);
				}
				$data['content'] = $content;
				
			if(count($result)>0) logs('นำเข้าข้อมูล ผู้สูงอายุในสถานสงเคราะห์และศูนย์บริการทางสังคม จำนวน '.number_format($result).' record');
			$this->template->build('hf_elderly/upload', @$data);
		}

	//===== HOSPITAL OF ELDERLY =====//	
}
?>