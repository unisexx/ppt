<?php
Class Crime extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('province_model', 'province');		
		$this->load->model('crime_station_model','station');
		$this->load->model('crime_statistic_model','statistic');
		$this->load->model('dp_vehicle_model','vehicle');
		$this->load->model('info_model','info');
	}
	
	#================ CRIME ==================#	
	function index()
	{
		$tmp = $this->station->get("SELECT YEAR FROM CRIME_STATION GROUP BY YEAR ORDER BY YEAR DESC");
		foreach($tmp as $tmp2)
			$data['year_list'][$tmp2['year']] = $tmp2['year'];
		
		$_GET['YEAR'] = @$_GET['YEAR'];
		$_GET['STATION'] = @$_GET['STATION'];
		$sql = 'SELECT * FROM CRIME_STATION WHERE 1=1 ';
			if($_GET['YEAR']) { $sql .= 'AND YEAR = '.$_GET['YEAR'].' '; }
			if($_GET['STATION']) { $sql .= "AND STATION LIKE '".$_GET['STATION']."' "; }
		$sql .= 'ORDER BY YEAR DESC, STATION ASC';


		$data['result'] = $this->station->get($sql);
    	$data['pagination'] = $this->station->pagination();
		
		
		
		$this->template->build('crime/index', $data);
	}
	
	function form($id=FALSE)
	{
		$data['monthth_array'] = array('มกราคม', "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
		$data['station_title'] = array('บช.น.', 'บก.น. 1', 'บก.น. 2', 'บก.น. 3', 'บก.น. 4', 'บก.น. 5', 'บก.น. 6', 'บก.น. 7', 'บก.น. 8', 'บก.น. 9', 'บช.ก.');
		$data['case_title'] = array("คดีอุกฉกรรณ์และสะเทือนขวัญ", "คดีชีวิต ร่างกาย และเพศ", "คดีประทุษร้ายต่อทรัพย์", "คดีน่าสนใจ", "คดีรัฐเป็นผู้เสียหาย");
		
		$data['case_id'] = array(1, 2, 3, 4, 5);
		$data['pv_list'] = $this->province->limit(80)->get('SELECT * FROM PROVINCES WHERE ID != 1');
		

		if($id)
		{
			$data['id'] = $id;
			$data['station'] = $this->station->limit(1)->get("SELECT * FROM CRIME_STATION WHERE ID = '".$id."'");
		}
		
		$this->template->build('crime/form', $data);
	}
		
	function save()
	{
		 //======Check repeat =====//
		 $chk_year = $this->station->where("ID LIKE '".$_POST['ID']."'")->get();
		 
		 if(count($chk_year) == 1)
		 {
			 if($chk_year[0]['year'] != $_POST['YEAR'])
			 {
			 	$chk_rp = $this->station->where("STATION LIKE '".$chk_year[0]['station']."' AND YEAR LIKE '".$_POST['YEAR']."'")->get();
				print_r($chk_rp);
				if(count($chk_rp)==1)
				{
					?><script>alert("ไม่สามารถบันทึกข้อมูลได้เนื่องจากมีข้อมูลอยู่แล้วในปีดังกล่าว"); history.back();</script><?
					return false;
				}
			 }
		 }
		 //======Check repeat =====//
		
		$this->station->save($_POST); 

		set_notify('success', 'ดำเนินการบันทึกข้อมูลเสร็จสิ้น');
		redirect('datapoint/crime/');	
	}
	
	function delete($id)
	{
		logs('ลบรายการ', $menu_id, $id);
		$this->station->delete($id);
		$this->db->execute("DELETE FROM CRIME_STATISTIC WHERE STATION_ID = ".$id."");
		
		set_notify('success', 'ดำเนินการลบข้อมูลเสร็จสิ้น');
		redirect('datapoint/crime');
	}
	
	
	function import() { $this->template->build('crime/import'); }	
	
		function upload()
		{
			$data['content'] = '';
			$_POST['SECTION_ID'] = ($_POST['WORKGROUP_ID']>0)?$_POST['WORKGROUP_ID']:$_POST['SECTION_ID'];

            $this->info->save($_POST);
			unset($_POST);
			
			$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'crime_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/datapoint/crime/';
			move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.'/'.$file_name);
			$data = $this->ReadData($uploaddir.$file_name, 1);
			$case_title = array("คดีอุกฉกรรณ์และสะเทือนขวัญ", "คดีชีวิต ร่างกาย และเพศ", "คดีประทุษร้ายต่อทรัพย์", "คดีน่าสนใจ", "คดีรัฐเป็นผู้เสียหาย");
			unlink($uploaddir.'/'.$file_name);
			/*
				 * 0 : อุกฉกรรจ์
				 * 1 : ชีวิต ร่างกาย
				 * 2 : ประทุศร้ายต่อทรัพย์
				 * 3 : คดีที่น่าสนใจ
				 * 4 : รัฐเป็นผู้เสียหาย
			*/

$a_count = 0;
			foreach($data as $case=>$sheet)
			{
				#=====Check Year=====#
				unset($year_list);
				foreach($sheet[0] as $tmp_yl)
				{
					if(!empty($tmp_yl) && $tmp_yl != 'จังหวัด')
					{
						$exp_yl = explode('พ.ศ.', $tmp_yl); $tmp_yl='';
						foreach($exp_yl as $tmp_) $tmp_yl .= trim($tmp_);
						$year_list[] = $tmp_yl;
					}
				}
				#=====End CheckYear =====#
					foreach($sheet as $key=>$row)
					{
						if($key>1)
						{
	
							
							$colum = 1;
							foreach($year_list as $year)
							{
								$noti = $colum; $colum++;
								$catch = $colum; $colum++;
								unset($rs['station']);
								$rs['station'] = array(
									'year'=>trim($year), 
									'station'=>$row[0],
									($case+1).'_noti'=>$row[$noti],
									($case+1).'_catch'=>$row[$catch]
									#'case'=>$case+1,
									#'notified'=>$row[$noti],
									#'catch'=>$row[$catch]
								);
								
								$chk_station = $this->station->where("STATION LIKE '".$rs['station']['station']."' AND YEAR LIKE '".$rs['station']['year']."'")->get();
								
								$data['content'] .= "<span style='color:#070;'>นำเข้าข้อมูล จังหวัด".$rs['station']['station'].' ปี พ.ศ.'.$rs['station']['year'].'</span><HR>'; 								
								if(count($chk_station) == 0) {
									$this->station->save($rs['station']);
								} else {
									$rs['station']['ID'] = $chk_station[0]['id'];
									$this->station->save($rs['station']);
								}
							}
						}
					}				
			}
			set_notify('success', 'บันทึกข้อมูลเสร็จสิ้น');
			$this->template->build('crime/upload.php', $data);
		}
		
				function ReadData($filepath)
				{
					@require_once 'include/Excel/reader.php';
					$data = new Spreadsheet_Excel_Reader();
					$data -> setOutputEncoding('UTF-8');
					$data -> read($filepath);
					
					error_reporting(E_ALL ^ E_NOTICE);		
					
					for($k=0; !empty($data->sheets[$k]); $k++)
					{
						//$import[$i] = ;
						$index = 0;
						for($i = 2; $i <= $data -> sheets[0]['numRows']; $i++) 
						{
							$index2 = 0;
							for($j=1; !empty($data->sheets[$k]['cells'][$i][$j]) || !empty($data->sheets[$k]['cells'][$i][$j+1]); $j++)
							{
								$import[$k][$index][$index2] = $data->sheets[$k]['cells'][$i][$j];
								$index2++;
							}
						$index++;
						}
					}
					return $import;	
				}
		function clear_repeat()
		{
			$station_list = $this->station->limit(1000)->get();
			for($i=0; $i<count($station_list); $i++)
			{
				$chk_rp = $this->station->where("YEAR LIKE '".$station_list[$i]['year']."' AND STATION LIKE '".$station_list[$i]['station']."'")->order_by('id', 'asc')->get();
				if(count($chk_rp) > 1)
				{
					echo count($chk_rp);
					echo '<BR>';
					
					for($j=0; $j<count($chk_rp); $j++)
					{
						if($j < (count($chk_rp)-1))
						{
							#$this->statistic->delete($chk_rp[$j]);
							$this->station->delete($chk_rp[$j]['id']);
							$this->statistic->where("STATION_ID LIKE '".$chk_rp[$j]['id']."'")->get();
						}
					}
				}
			}
		}
					
	#================ CRIME ==================#
}