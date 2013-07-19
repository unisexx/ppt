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
		
	function save($menu_id)
	{
		$id = @$_POST['ID'];
		$chk_loop = $this->station->limit(1)->get("SELECT id FROM CRIME_STATION WHERE YEAR = ".$_POST['YEAR']."  AND STATION = '".$_POST['STATION']."'");
		if(count($chk_loop) == 1 && !$_POST['ID'])
		{	?>
			<script language='javascript'>
				alert('มีข้อมูลอยู่แล้วไม่สามารถดำเนินการได้');
				history.back();
			</script>
		<?	}
		else 
		{
			$_POST['STATION_ID'] = $this->station->save($_POST);
		 	for($i=1; $i<=12; $i++)
		 	{
		 		for($j=1; $j<=5; $j++)
				{
					#MONTH, CASE ID, NOTIFIED, CATCH sort respectively
						$_POST['MONTH'] = $i;
						$_POST['CASE_ID'] = $j; 
						$_POST['NOTIFIED'] = $_POST[$i.'_NOTIFIED'][$j]; 	unset($_POST[$i.'_NOTIFIED'][$j]); 
						$_POST['CATCH'] = $_POST[$i.'_CATCH'][$j]; 			unset($_POST[$i.'_CATCH'][$j]);
					if($id)
					{
						unset($_POST['ID']);
						$stt_id = $this->statistic->limit(1)->get("SELECT id FROM CRIME_STATISTIC WHERE STATION_ID = ".$_POST['STATION_ID']." AND MONTH = ".$_POST['MONTH']." AND CASE_ID = ".$_POST['CASE_ID']);
						$_POST['ID'] = @$stt_id[0]['id'];
					}
					$id=$this->statistic->save($_POST);
		           	if(empty($_POST['id'])) logs('เพิ่มรายการ ', $menu_id, $id); else logs('แก้ไขรายการ', $menu_id, $id);
				}
		 	}
		}
		set_notify('success', 'ดำเนินการลบข้อมูลเสร็จสิ้น');
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
						if($key>2)
						{
							$colum = 1;
							foreach($year_list as $year)
							{
								$noti = $colum; $colum++;
								$catch = $colum; $colum++;
								
								$rs['station'] = array(
									'year'=>trim($year), 
									'station'=>$row[0],
									'case'=>$case+1,
									'notified'=>$row[$noti],
									'catch'=>$row[$catch]
								);
								$chk_station = $this->station->where("YEAR LIKE '".$rs['station']['year']."' AND STATION LIKE '".$rs['station']['station']."'")->get();
								# AFTER UPDATE DATABASE
									##:"YEAR LIKE '".$rs['station']['year']."' AND STATION LIKE '".$rs['station']['station']."' AND CATCH LIKE '".$rs['station']['catch']."'"
								if(count($chk_station) == 0) {
									#$rs['station']['id'] = $this->station->save($rs['station']);
									$data['content'] .= '<span>';
									$data['content'] .= 'เพิ่มข้อมูล จังหวัด '.$rs['station']['station'].' ปี พ.ศ. '.$rs['station']['year'].' '.$case_title[$rs['station']['case']];
									$data['content'] .= '</span><HR>';
								} else {
									#$rs['station']['id'] = $chk_station[0]['id'];
									#$this->station->save($rs['station']['id']);
									$data['content'] .= '<span>';
									$data['content'] .= 'แก้ไขข้อมูล จังหวัด '.$rs['station']['station'].' ปี พ.ศ. '.$rs['station']['year'].' '.$case_title[$rs['station']['case']];
									$data['content'] .= '</span><HR>';
								}
							}
						}
					}				
			}
			
			echo $return_log;
			
				
			#set_notify('success', 'บันทึกข้อมูลเสร็จสิ้น');
			$this->template->build('mental/upload.php', $data);
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