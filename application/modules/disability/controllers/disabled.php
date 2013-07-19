<?php
Class disabled extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('disabled_model','welfare');
		$this->load->model('disabledlist_model','wflist');
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
			$set_year = $this->welfare->get("SELECT YEAR FROM DISABLED_DATA GROUP BY YEAR ORDER BY YEAR DESC");
			foreach($set_year as $set_year_) $data['set_year'][$set_year_['year']] = $set_year_['year'];
			
			$sql = 'SELECT * FROM DISABLED_DATA WHERE 1=1 ';
				if(@$_GET['YEAR']) $sql .= "AND YEAR = ".$_GET['YEAR'].' ';
				if(@$_GET['WLIST']) $sql .= "AND WLIST_ID = ".$_GET['WLIST'].' ';
			$sql .= ' order by year desc, wlist_id';
			$data['result'] = $this->welfare->get($sql);
	    	$data['pagination'] = $this->welfare->pagination;
			
			$this->template->build('disabled/index', $data);
		}
		
		function form($id=FALSE)
		{
			$wlist = $this->db->execute('SELECT * FROM disabled_list');
			$data['id'] = @$id;
			if(@$id) { $data['result'] = $this->welfare->get_row($id); }
			
			$this->template->build('disabled/form', $data);
		}
		
			function save($menu_id)
			{
				$id = $this->welfare->save($_POST);
				if(empty($_POST['id'])) logs('เพิ่มรายการ ', $menu_id, $id); else logs('แก้ไขรายการ', $menu_id, $id);
				set_notify('success', lang('save_data_complete'));	redirect('disability/disabled/');
			}
			
		function delete($id)
		{
			if($id)
			{
				logs('ลบรายการ', $menu_id, $id);
				$this->welfare->delete($id);
	            set_notify('success', lang('delete_data_complete'));	redirect('disability/disabled/');
			}
		}
		
		
		function import() { $this->template->build('disabled/import'); }
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
			$file_name = 'disabled_'.date("Y_m_d_H_i_s").'.'.$ext;	$uploaddir = 'import_file/disability/disabled/';
			
			move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.$file_name);
				$data = $this->ReadData($uploaddir.$file_name);
				unlink($uploaddir.$file_name);

			$_POST['YEAR'] = $year_data; unset($year_data);
			$_POST['MONTH'] = array_search(trim($data[1][3]), $month_th)+1;
			
				$wf_list['YEAR'] = $_POST['YEAR'];
				$wf_list['MONTH'] = $_POST['MONTH'];
			$result = 0;
			for($i=3; $i<count($data); $i++)
			{
				$chk_wf_list = $this->wflist->limit(1)->where("NAME LIKE '".$data[$i][0]."'")->get();
				
				if(count($chk_wf_list) == 0)
				{
					$save_wf_list = array('NAME'=>$data[$i][0]);
					$wf_list['WLIST_ID'] = $this->wflist->save($save_wf_list);
				} else 
					$wf_list['WLIST_ID'] = $chk_wf_list[0]['id']; 
				
				$wf_list['TARGET'] = $data[$i][1];
				$wf_list['BALANCE'] = $data[$i][2];
				$wf_list['ADMISSION'] = $data[$i][3];
				$wf_list['DISTRIBUTION'] = $data[$i][4];
				$wf_list['REMAIN'] = $data[$i][5];
				$wf_list['BUILD'] = $data[$i][6];
				
				$chk_wf_data = $this->welfare->limit(1)->where("WLIST_ID LIKE '".$wf_list['WLIST_ID']."' AND YEAR LIKE '".$wf_list['YEAR']."'")->get();
				
				
				if(count($chk_wf_data) == 0)
				{
					$content .= "<div style='color:#0A0; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>".($result+1).". บันทึก : เพิ่มข้อมูล  \"".$data[$i][0]."\" ปี ".$wf_list['YEAR']." </div>";
					$this->welfare->save($wf_list);
				} else {
					$this->welfare->where("WLIST_ID LIKE '".$wf_list['WLIST_ID']."' AND YEAR LIKE '".$wf_list['YEAR']."'")->limit(1)->delete();
					
					$content .= "<div style='color:#d97f31; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>".($result+1).". บันทึก : ทำการเขียนทับข้อมูล \"".$data[$i][0]."\" ปี ".$wf_list['YEAR']." </div>";
					
					$this->welfare->save($wf_list);
				}
				$result++;	
			}

			$data['content'] = $content;
			if(count($result)>0) logs('นำเข้าข้อมูล ผู้พิการในสถานสงเคราะห์และศูนย์บริการทางสังคม จำนวน '.number_format($result).' record');
			$this->template->build('disabled/upload', @$data);
		}

	//===== HOSPITAL OF ELDERLY =====//	
}
?>