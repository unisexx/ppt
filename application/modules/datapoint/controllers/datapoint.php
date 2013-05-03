<?php
Class Datapoint extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('mental_model', 'mental');
		$this->load->model('province_model', 'province');		
		$this->load->model('crime_station_model','station');
		$this->load->model('crime_statistic_model','statistic');
		$this->load->model('dp_vehicle_model','vehicle');
		$this->load->model('agency_model','agency');
		$this->load->model('info_model','info');
	}
	public $vehicle_menu_id=93;
	
	#================ MENTAL ==================#
	function mental($year=FALSE, $province_id=FALSE){
		$sql = 'SELECT MT.ID, MT.PROVINCE_ID, MT.YEAR, MT.PSY_NUMBER, MT.FEAR_NUMBER, MT.DEPRESS_NUMBER, MT.RETARDED_NUMBER, MT.APOPLEXY_NUMBER, MT.DRUGADD_NUMBER, MT.AUTISM_NUMBER, MT.OTHER_NUMBER, PV.PROVINCE 
				FROM MENTAL_NUMBER MT LEFT JOIN PROVINCES PV ON MT.PROVINCE_ID = PV.ID WHERE 1=1 ';
			$sql .= (@$_GET['year'])?"AND MT.YEAR LIKE '".$_GET['year']."' ":'';
			$sql .= (@$_GET['province_id'])?"AND MT.PROVINCE_ID LIKE '".$_GET['province_id']."' ":'';
		$sql .= ' ORDER BY MT.YEAR DESC, PV.PROVINCE ASC ';
		
		$data['province'] = $this->province->limit(80)->get('SELECT ID, PROVINCE FROM PROVINCES');


		$data['result'] = $this->mental->get($sql);
    	$data['pagination'] = $this->mental->pagination;
		
		$this->template->build('mental_number/mental_index', $data);
	}
	
	function mental_form($id=FALSE){
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$data['id'] = $id;
		if($id)
		{
			$data['mental_dtl'] = $this->mental->get_row($id);
		}
		
		
        $this->template->build('mental_number/mental_form', $data);
	}
		function mental_save()
		{
			$sql = "SELECT * FROM MENTAL_NUMBER WHERE PROVINCE_ID LIKE '".$_POST['PROVINCE_ID']."' AND YEAR LIKE '".$_POST['YEAR']."'";
			$chk_mental = $this->mental->get($sql);
			
			if(count($chk_mental) == 1)
			{
				?>
				<script language="JavaScript">
					alert("พบข้อผิดพลาดไม่สามารถบันทึกข้อมูลได้ : จังหวัดดังกล่าวได้ถูกบันทึกข้อมูลไว้ในปี <?=$_POST['YEAR'];?> แล้ว");
					history.back();
				</script>
				<?
			} else {
			
				$this->mental->save($_POST);
							
				set_notify('success', 'บันทึกข้อมูลเสร็จสิ้น');
				redirect('datapoint/mental');
			}
		}
		
		function mental_delete($id=FALSE)
		{
				if($id)
				{
					$this->mental->delete($id);
					set_notify('success', 'ดำเนินการลบข้อมูลเสร็จสิ้น');
					redirect('datapoint/mental');	
				} else {
					set_notify('error', 'พบความผิดพลาด ไม่สามารถดำเนินการลบข้อมูลได้');
					redirect('datapoint/mental');						
				}
		}	
		
	function mental_import()
	{
		$this->template->build('mental_number/mental_import');
	}
		function mental_upload()
		{
			unset($_POST['ID']);
			$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'mental_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/datapoint/mental/';
			move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.'/'.$file_name);
			$data = $this->ReadData($uploaddir.$file_name);
echo '<HR>';
			?><div style='font-size:12px;'><?
			$_POST['YEAR'] = $data[1][1];

			for($i=6; $i<count($data); $i++)
			{
				#print_r($data[$i]);	echo '<BR>';
				
				
				if(strstr($data[$i][0], 'รวม'))
				{
					$get_province = explode('รวม', $data[$i][0]);
					$get_province = trim($get_province[0]);
					if($get_province != '')
					{
						$dtl_province = $this->province->limit(1)->get("SELECT id FROM PROVINCES WHERE PROVINCE LIKE '".$get_province."'");
						
						#print_r($data[$i]);
						
						$_POST['PROVINCE_ID'] = $dtl_province[0]['id'];
						
						$post_title = array('POP_NUMBER', 
							'PSY_NUMBER', 
							'PSY_RATE', 
							'FEAR_NUMBER', 
							'FEAR_RATE', 
							'DEPRESS_NUMBER', 
							'DEPRESS_RATE', 
							'RETARDED_NUMBER', 
							'RETARDED_RATE', 
							'APOPLEXY_NUMBER', 
							'APOPLEXY_RATE', 
							'DRUGADD_NUMBER', 
							'DRUGADD_RATE', 
							'OTHER_NUMBER', 
							'OTHER_RATE', 
							'SUICIDE_SUCC_NUMBER', 
							'SUICIDE_SUCC_RATE', 
							'SUICIDE_UNSUC_NUMBER', 
							'SUICIDE_UNSUC_RATE', 
							'AUTISM_NUMBER', 
							'AUTISM_RATE');
							
						for($j=0; $j<count($post_title); $j++)
						{
							$_POST[$post_title[$j]] = ($data[$i][($j+1)]*1);
						}
						$this->mental->save($_POST);
						?><div style='color:#0A0; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>บันทึก : เพิ่มข้อมูล 
							จังหวัด "<?=$get_province;?>"
						</div><?
					}
				}
			}
			?></div><?
					unlink($uploaddir.$file_name);
					?><BR>
						<input type='button' value='กลับไปหน้าแรก' onclick='window.location="datapoint/mental";'>
						<input type='button' value='ย้อนกลับไปหน้านำเข้าข้อมูล' onclick='window.location="datapoint/mental_import";'>
					<?

		}
	#================ MENTAL ==================#	
	
	
	#================ CRIME ==================#	
	function crime(){
		$_GET['YEAR'] = @$_GET['YEAR'];
		$_GET['STATION'] = @$_GET['STATION'];
		$sql = 'SELECT * FROM CRIME_STATION WHERE 1=1 ';
			if($_GET['YEAR']) { $sql .= 'AND YEAR = '.$_GET['YEAR'].' '; }
			if($_GET['STATION']) { $sql .= "AND STATION LIKE '".$_GET['STATION']."' "; }
		$sql .= 'ORDER BY YEAR DESC, STATION ASC';

		$data['result'] = $this->station->get($sql);
    	$data['pagination'] = $this->station->pagination;
		
		$this->template->build('crime/crime_index', $data);
	}
	
	function crime_upload()
	{
		/*
		echo $_FILES['file_upd']['tmp_name'];
		echo '<BR><BR><BR>';
		print_r($_FILES['file_upd']);
		if($_FILES['file_upd'] = 'abc')
		{
			$file_path = $_FILES['file_upd']['tmp_name'];
			require_once 'include/Excel/reader.php';
			$data = new Spreadsheet_Excel_Reader();
			$data -> setOutputEncoding('UTF-8');
	
			$data -> read($filepath);
		
			error_reporting(E_ALL ^ E_NOTICE);
			$index = 0;
			for($i = 1; $i <= $data -> sheets[0]['numRows']; $i++) {
				$import[$index]['title'] = trim($data -> sheets[0]['cells'][$i][1]);
				$import[$index]['value'] = trim($data -> sheets[0]['cells'][$i][2]);
				$import[$index]['value_length'] = strlen($import[$index]['value']);								 
					
				$index++;			
			}		
			return $import;
			
		}
		
		 
		 
		 
		 $this->template->build('crime/crime_upload.php');
		 */
	}
	
		function crime_form($id=FALSE){
			$data['case_title'] = array("คดีอุกฉกรรณ์และสะเทือนขวัญ", "คดีชีวิต ร่างกาย และเพศ", "คดีประทุษร้ายต่อทรัพย์", "คดีน่าสนใจ", "คดีรัฐเป็นผู้เสียหาย");
			$data['case_id'] = array(1, 2, 3, 4, 5);
			
			if($id)
			{
				$data['id'] = $id;
				$data['station'] = $this->station->limit(1)->get("SELECT * FROM CRIME_STATION WHERE ID = '".$id."'");
			}
			
			$this->template->build('crime/crime_form', $data);
		}
		
		function crime_save()
		{
			$id = @$_POST['ID'];
		 	$_POST['STATION_ID'] = $this->station->save($_POST);
		 	
			 	for($i=1; $i<=12; $i++)
			 	{
			 		for($j=1; $j<=5; $j++)
					{
						#MONTH
							$_POST['MONTH'] = $i;
						#CASE ID
							$_POST['CASE_ID'] = $j; 
						#NOTIFIED
							$_POST['NOTIFIED'] = $_POST[$i.'_NOTIFIED'][$j]; 
						#CATCH
							$_POST['CATCH'] = $_POST[$i.'_CATCH'][$j];
						if($id)
						{
							unset($_POST['ID']);
							$stt_id = $this->statistic->limit(1)->get("SELECT * FROM CRIME_STATISTIC WHERE STATION_ID = ".$_POST['STATION_ID']." AND MONTH = ".$_POST['MONTH']." AND CASE_ID = ".$_POST['CASE_ID']);
							$_POST['ID'] = @$stt_id[0]['id'];
						}
						
						$this->statistic->save($_POST);
					}
			 	}
			
			set_notify('success', 'ดำเนินการลบข้อมูลเสร็จสิ้น');
			redirect('datapoint/crime');	

		}
		
		function crime_delete($id)
		{
			
			$this->station->delete($id);
			$this->db->execute("DELETE FROM CRIME_STATISTIC WHERE STATION_ID = ".$id."");
			
			set_notify('success', 'ดำเนินการลบข้อมูลเสร็จสิ้น');
			redirect('datapoint/crime');
		}
		
	#================ CRIME ==================#


	function ReadData($filepath)
	{
		require_once 'include/Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data -> setOutputEncoding('UTF-8');
		$data -> read($filepath);
		
		error_reporting(E_ALL ^ E_NOTICE);		
		$index = 0;	
			for($i = 1; $i <= $data -> sheets[0]['numRows']; $i++) {
				$cnt_colum = count($data->sheets[0]['cells'][$i]);
				for($j=1; $j<=$cnt_colum; $j++)
				{
					$import[$index][] = trim($data -> sheets[0]['cells'][$i][$j]);		
				}
				$index++;			
			}
		return $import;	
	}	
	function ImportData($filepath)
	{
		require_once 'include/Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data -> setOutputEncoding('UTF-8');
		$data -> read($filepath);		
		error_reporting(E_ALL ^ E_NOTICE);		
		$index = 0;
		foreach($data->sheets as $key =>$item){			
			for($i = 1; $i <= $item['numRows']; $i++) {
				$cnt_colum = count($item['cells'][$i]);
				for($j=1; $j<=$cnt_colum; $j++)
				{
					$import[$index][] = trim($item['cells'][$i][$j]);		
				}
				$index++;			
			}
		}	
		return $import;			
	}	
	function vehicle(){
		$year=(!empty($_GET['year'])) ? " and YEAR=".$_GET['year']:'';
		$agency_id=(!empty($_GET['agency_id'])) ? " and AGENCY LIKE '%".$_GET['agency_id']."%'":'';	
		$data['result'] =$this->vehicle->where(" 1=1 $year $agency_id")->order_by("dp_vehicle.ID",'asc')->get();	
		$data['pagination'] = $this->vehicle->pagination();	
		$data['menu_id']=$this->vehicle_menu_id;	
		$this->template->build('vehicle/vehicle_index',$data);
	}
	
	function vehicle_form($id=FALSE){
		$data['rs'] =$this->vehicle->get_row($id);	
		$data['menu_id']=$this->vehicle_menu_id;		
		 $this->template->build('vehicle/vehicle_form',$data);
	}
	function vehicle_save(){
		if(!menu::perm($this->vehicle_menu_id, 'add') || !menu::perm($this->vehicle_menu_id,'edit'))redirect('datapoint/vehicle');		
		if($_POST){
			$this->vehicle->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('datapoint/vehicle');
	}
	function vehicle_delete($id){
		if(!empty($id)){
			$this->vehicle->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('datapoint/vehicle');
	}

	function vehicle_import()
	{	 $data['menu_id']=$this->vehicle_menu_id;		
		$this->template->build('vehicle/vehicle_import_form',$data);
	
	}

	function vehicle_save_import(){		
		if($_FILES['fl_import']['name']!=''){
			/*---for insert value to info table ---*/
			$import_section_id = $_POST['import_workgroup_id']> 0 ? $_POST['import_workgroup_id'] : $_POST['import_section_id'];
			$_POST['section_id'] = $import_section_id;
			$_POST['menu_id']=$this->vehicle_menu_id;
			$this->info->save($_POST);
			/*--end--*/	
				
			$this->db->execute("DELETE FROM DP_VEHICLE WHERE YEAR='".$_POST['year_data']."'");
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'vehicle_'.$_POST['year_data'].date("Y_m_d_H_i_s").'.'.$ext;	
			$uploaddir = 'import_file/datapoint/vehicle/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);		
			$data= $this->ImportData($uploaddir.$file_name);	
			foreach($data as $key=>$item){										
					if(in_array('หน่วยงาน',$item) || in_array('รวม',$item))continue;																	
						$val['YEAR']=$_POST['year_data'];	
						$val['agency']=$item[0];
						$val['NOTICE'] =$item[1];
						$val['WALK'] = $item[2];
						$val['BICYCLE'] = $item[3];
						$val['THREEWHEEL'] = $item[4];
						$val['MOTORCYCLE'] = $item[5];
						$val['MOTOR_TRICYCLE'] = $item[6];
						$val['CAR'] =$item[7];
						$val['MINIBUS'] =$item[8];
						$val['PICKUP'] = $item[9];
						$val['BUS'] = $item[10];
						$val['SIXWHEEL'] =$item[11];
						$val['TENWHEEL'] = $item[12];
						$val['ETAN'] = $item[13];
						$val['TAXI'] = $item[14];
						$val['OTHER'] = $item[15];
						$val['TOTAL'] = $item[16];
						$val['DIE_MALE'] =$item[17];
						$val['DIE_FEMALE'] = $item[18];
						$val['COMA_MALE'] =$item[19];
						$val['COMA_FEMALE'] =$item[20];
						$val['PAIN_MALE'] = $item[21];
						$val['PAIN_FEMALE'] = $item[22];										
						$val['CATCH_MALE'] = $item[23];
						$val['CATCH_FEMALE'] = $item[24];
						$val['ESCAPE_MALE'] = $item[25];
						$val['ESCAPE_FEMALE'] = $item[26];
						$val['INVOLUNTARY'] = $item[27];
						$val['CREATE'] =date('Ymd');
						$this->vehicle->save($val);																																																																		
			}		
			$this->db->Execute("DELETE FROM DP_VEHICLE WHERE AGENCY IS NULL");	
			set_notify('success', lang('save_data_complete'));
		}
		redirect('datapoint/vehicle_import');	
	}

}
