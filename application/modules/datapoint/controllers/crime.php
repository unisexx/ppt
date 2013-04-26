<?php
Class Crime extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('mental_model', 'mental');
		$this->load->model('province_model', 'province');		
		$this->load->model('crime_station_model','station');
		$this->load->model('crime_statistic_model','statistic');
		$this->load->model('dp_vehicle_model','vehicle');
	}
	
	#================ CRIME ==================#	
	function index(){
		$_GET['YEAR'] = @$_GET['YEAR'];
		$_GET['STATION'] = @$_GET['STATION'];
		$sql = 'SELECT * FROM CRIME_STATION WHERE 1=1 ';
			if($_GET['YEAR']) { $sql .= 'AND YEAR = '.$_GET['YEAR'].' '; }
			if($_GET['STATION']) { $sql .= "AND STATION LIKE '".$_GET['STATION']."' "; }
		$sql .= 'ORDER BY YEAR DESC, STATION ASC';

		$data['result'] = $this->station->get($sql);
    	$data['pagination'] = $this->station->pagination;
		
		$this->template->build('crime/index', $data);
	}
	
	function form($id=FALSE){
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
					$this->statistic->save($_POST);
				}
		 	}
		}
		set_notify('success', 'ดำเนินการลบข้อมูลเสร็จสิ้น');
		redirect('datapoint/crime/');	
	}
	
	function delete($id)
	{
		
		$this->station->delete($id);
		$this->db->execute("DELETE FROM CRIME_STATISTIC WHERE STATION_ID = ".$id."");
		
		set_notify('success', 'ดำเนินการลบข้อมูลเสร็จสิ้น');
		redirect('datapoint/crime');
	}
	
	
	function import() { $this->template->build('crime/import'); }	
	
		function upload()
		{
			unset($_POST['ID']);
			$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'crime_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/datapoint/crime/';
			move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.'/'.$file_name);
			$data = $this->ReadData($uploaddir.$file_name);
			
			$_POST['YEAR'] = $data[1][1];
			$_POST['STATION'] = $data[0][1];
						
			$chk_loop = $this->station->limit(1)->get("SELECT id FROM CRIME_STATION WHERE YEAR = ".$_POST['YEAR']."  AND STATION = '".$_POST['STATION']."'");
			if(count($chk_loop) == 1)
				{	?>
					<script language='javascript'>
						alert('มีข้อมูลอยู่แล้วไม่สามารถดำเนินการได้');
						history.back();
					</script>
				<?	} 
			ELSE 
				{
					$pointer_ary = array(4, 10, 17, 28, 40);
					$pdata_ary = array(0, 2, 4, 6, 8, 10, 12, 17, 19, 21, 23, 25, 27);
					echo 'INSERT DATA STATION <BR>';
					print_r($_POST);
					$_POST['STATION_ID'] = $this->station->save($_POST);
					unset($_POST['YEAR'], $_POST['STATION']);
					ECHO '<hr>';
					
					
					ECHO 'INSERT DATA STATISTIC <br>';
					#$_POST['STATION_ID'];
					#$_POST['MONTH'];
					#$_POST['CASE_ID'];
					#$_POST['NOTIFIED'];
					#$_POST['CATCH'];
					for($j=0; $j<count($pointer_ary); $j++)
					{
						$_POST['CASE_ID'] = ($j+1);
						
						
						for($i=1; $i<=12; $i++)
						{
							$_POST['MONTH'] = $i;
							$_POST['NOTIFIED'] = $data[$pointer_ary[$j]][($pdata_ary[$i]-1)];
							$_POST['CATCH'] = $data[$pointer_ary[$j]][$pdata_ary[$i]];
							
							$this->statistic->save($_POST);
							#print_r($_POST);
							#echo '<BR>';
						}
						#echo ($j+1).'/'.$pointer_ary[$j];
					}
					echo '<HR style="border:solid 2px #000;">';
					
					
					
						for($i=4; $i<count($data); $i++)
						{	#echo $i.'<BR>';
							#print_r($data[$i]);
							#echo '<HR>';
						}
						echo '<HR>';
				}
			unlink($uploaddir.'/'.$file_name);
			set_notify('success', 'บันทึกข้อมูลเสร็จสิ้น');
			redirect('datapoint/crime/');	
		}
		
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
					
	#================ CRIME ==================#
}