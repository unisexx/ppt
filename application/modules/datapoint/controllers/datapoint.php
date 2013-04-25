<?php
Class Datapoint extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('mental_model', 'mental');
		$this->load->model('province_model', 'province');		
		$this->load->model('crime_station_model','station');
		$this->load->model('crime_statistic_model','statistic');
		$this->load->model('dp_vehicle_model','vehicle');
	}
	
	
	#================ MENTAL ==================#
	function mental($year=FALSE, $province_id=FALSE){
		$sql = 'SELECT MT.ID, MT.PROVINCE_ID, MT.YEAR, MT.PSY_NUMBER, MT.FEAR_NUMBER, MT.DEPRESS_NUMBER, MT.RETARDED_NUMBER, MT.APOPLEXY_NUMBER, MT.DRUGADD_NUMBER, MT.AUTISM_NUMBER, MT.OTHER_NUMBER, PV.PROVINCE 
				FROM MENTAL_NUMBER MT LEFT JOIN PROVINCES PV ON MT.PROVINCE_ID = PV.ID WHERE 1=1 ';
			$sql .= (@$_GET['year'])?"AND MT.YEAR LIKE '".$_GET['year']."' ":'';
			$sql .= (@$_GET['province_id'])?"AND MT.PROVINCE_ID LIKE '".$_GET['province_id']."' ":'';
		$sql .= 'ORDER BY MT.YEAR DESC, MT.PROVINCE_ID ASC ';
		
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
	function ReadData($filepath){
		require_once 'include/Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data -> setOutputEncoding('UTF-8');
		$data -> read($filepath);	
		error_reporting(E_ALL ^ E_NOTICE);
		$index = 0;						
			for($i = 1; $i <= $data -> sheets[0]['numRows']; $i++) {
				$import[$index]['id'] = trim($data -> sheets[0]['cells'][$i][1]);
				$import[$index]['province_id'] = trim($data -> sheets[0]['cells'][$i][2]);
				$import[$index]['area_number'] = trim($data -> sheets[0]['cells'][$i][3]);
				$import[$index]['p_name'] =  trim($data -> sheets[0]['cells'][$i][4]);	
				$import[$index]['poor'] =  trim($data -> sheets[0]['cells'][$i][5]);			
				$import[$index]['family'] =  trim($data -> sheets[0]['cells'][$i][6]);
				$import[$index]['married'] = trim($data -> sheets[0]['cells'][$i][7]);
				$import[$index]['adapt'] =  trim($data -> sheets[0]['cells'][$i][8]);
				$import[$index]['capture'] =  trim($data -> sheets[0]['cells'][$i][9]);	
				$import[$index]['accident'] =  trim($data -> sheets[0]['cells'][$i][10]);
				$import[$index]['migration'] =  trim($data -> sheets[0]['cells'][$i][11]);	
				$import[$index]['breadwinner'] =  trim($data -> sheets[0]['cells'][$i][12]);	
				$import[$index]['other'] =  trim($data -> sheets[0]['cells'][$i][13]);	
				$import[$index]['total'] =  trim($data -> sheets[0]['cells'][$i][15]);				 			
				$index++;			
			}				
		return $import;
	}	
	
	function vehicle(){
		$this->template->build('vehicle_index');
	}
	
	function vehicle_form(){
		$this->template->build('vehicle_form');
	}
	function vehicle_import(){
		$this->template->build('vehicle_import_form');
	}
	function vehicle_import_save(){		
		if($_FILES['fl_import']['name']!=''){
			$this->db->execute("DELETE FROM DP_VEHICLE WHERE YEAR='".$_POST['year_data']."'");
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'child_drop_'.$_POST['year_data'].date("Y_m_d_H_i_s").'.'.$ext;	
			$uploaddir = 'import_file/datapoint/vehicle/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);		
			$data = $this->ReadData($uploaddir.$file_name);							
			foreach($data as $key=>$item){					
						$val['YEAR']=$_POST['year_data'];
						$val['AGENCY_ID'] = $item['province_id'];
						$val['NOTICE'] =$item['area_number'];
						$val['WALK'] = $item['poor'];
						$val['BICYCLE'] = $item['family'];
						$val['THREEWHEEL'] = $item['married'];
						$val['MOTORCYCLE'] = $item['adapt'];
						$val['CAR'] = $item['capture'];
						$val['MINIBUS'] = $item['accident'];
						$val['PICKUP'] = $item['migration'];
						$val['BUS'] = $item['breadwinner'];
						$val['SIXWHEEL'] = $item['ohter'];
						$val['TENWHEEL'] = $item['total'];
						$val['ETAN'] = date('Y-m-d');
						$val['TAXI'] = $item['total'];
						$val['OTHER'] = $item['total'];
						$val['TOTAL'] = $item['total'];
						$val['DIE_MALE'] = $item['total'];
						$val['DIE_FEMALE'] = $item['total'];
						$val['COMA_MALE'] = $item['total'];
						$val['COMA_FRMALE'] = $item['total'];
						$val['PAIN_MALE'] = $item['total'];
						$val['PAIN_FMALE'] = $item['total'];											
						$val['CATCH_MALE'] = $item['total'];
						$val['CATCH_FEMALE'] = $item['total'];
						$val['ESCAPE_MALE'] = $item['total'];
						$val['ESCAPE_FEMALE'] = $item['total'];
						$val['INVOLUNTARY'] = $item['total'];
						$this->vehicle->save($val);																									
						//$val['CREATE'] = date('Y-m-d H:i:s');																																
			}
			set_notify('success', lang('save_data_complete'));
		}
		redirect('datapoint/vehicle_import');	
	}
}
?>