<?php
Class Inmates extends Public_Controller{
	function __construct(){
		parent::__construct();
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
		
			function save($menu_id)
			{
				$id = $this->inmates->save($_POST);
	           	if(empty($_POST['id'])) logs('เพิ่มรายการ ', $menu_id, $id); else logs('แก้ไขรายการ', $menu_id, $id);
				set_notify('success', lang('save_data_complete'));	redirect('elder/inmates/');
			}
			
		function delete($menu_id, $id)
		{
			if($id)
			{
				logs('ลบรายการ', $menu_id, $id);
				$this->inmates->delete($id);
	            set_notify('success', lang('delete_data_complete'));	redirect('elder/inmates/');
			}
		}
		
		
		
		function import() { $this->template->build('inmates/import'); }

		function upload()
		{
			$amount_rp = 0;
			$content;
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
			
			$_POST['YEAR'] = $year_data;
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
					
					if($_POST['VALUE1_M']||$_POST['VALUE1_F']||$_POST['VALUE2_M']||$_POST['VALUE2_F']||$_POST['VALUE3_M']||$_POST['VALUE3_F'])
					{
						$chk_rp_tmp = $this->inmates->where("YEAR LIKE '".$_POST['YEAR']."' AND 	INMATESLIST_ID LIKE '".$_POST['INMATESLIST_ID']."'")->get();
						if(count($chk_rp_tmp) != 0){ $amount_rp++; }
						$result[] = $_POST;
					}

				}
			}
			


				if($amount_rp >= 1)
				{
					?><script language='javascript'>
						if(!confirm('พบการนำเข้าข้อมูลจำนวน <?=count($result);?> รายการ เป็นข้อมูลที่มีอยู่แล้ว <?=$amount_rp;?> รายการ หากยืนยันจะดำเนินการต่อ ข้อมูลเก่าจะถูกแทนที่ด้วยข้อมูลใหม่ในทันที'))
						{
							alert('ปฏิเสธการบันทึกข้อมูล');
							window.location="../elder/inmates";
							return false;
						}
					</script><?
				}
			
			
				for($i=0; $i<count($result); $i++)
				{
					$inmlist_dtl = $this->inmateslist->get_row($result[$i]['INMATESLIST_ID']);
					$chk_rp_tmp = $this->inmates->where("YEAR LIKE '".$result[$i]['YEAR']."' AND 	INMATESLIST_ID LIKE '".$result[$i]['INMATESLIST_ID']."'")->get();
					if($chk_rp_tmp != 0)
					{
						$this->inmates->where("YEAR LIKE '".$result[$i]['YEAR']."' AND 	INMATESLIST_ID LIKE '".$result[$i]['INMATESLIST_ID']."'")->delete();
						$content .= "<div style='color:#d97f31; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>".($i+1).". บันทึก : ทำการเขียนทับข้อมูล \"".$inmlist_dtl['name']."\" ปี ".$_POST['YEAR']." </div>";
					}
					else 
					{ $content .= "<div style='color:#0A0; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>".($i+1).". บันทึก : เพิ่มข้อมูล  \"".$inmlist_dtl['name']."\" ปี ".$_POST['YEAR']." </div>"; } 
					
					$this->inmates->save($result[$i]);
				}

				$data['content'] = $content;
				
			if(count($result)>0) logs('นำเข้าข้อมูล ผู้ต้องขังสูงอายุ  จำนวน '.number_format(count($result)).' record');
			$this->template->build('inmates/upload', @$data);
		}

	//===== INMATES OF ELDERLY =====//	
}
?>