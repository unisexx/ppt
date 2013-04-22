<?php
Class Datapoint extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('mental_model', 'mental');
		$this->load->model('province_model', 'province');
	}
	
	function mental($year=FALSE, $province_id=FALSE){
		$_POST['year'] = ($year == 'NA')?'':$year;
		$_POST['province_id'] = ($province_id == 'NA')?'':$province_id;
		
		$sql = 'SELECT MT.ID, MT.PROVINCE_ID, MT.YEAR, MT.PSY_NUMBER, MT.FEAR_NUMBER, MT.DEPRESS_NUMBER, MT.RETARDED_NUMBER, MT.APOPLEXY_NUMBER, MT.DRUGADD_NUMBER, MT.AUTISM_NUMBER, MT.OTHER_NUMBER, PV.PROVINCE 
				FROM MENTAL_NUMBER MT LEFT JOIN PROVINCES PV ON MT.PROVINCE_ID = PV.ID ';
			$sql .= ($_POST['year'] || $_POST['province_id'])?'WHERE ':'';
			$sql .= ($_POST['year'])?"MT.YEAR LIKE '".$_POST['year']."'":'';
			$sql .= ($_POST['year'] && $_POST['province_id'])?'AND ':'';
			$sql .= ($_POST['province_id'])?"MT.PROVINCE_ID LIKE '".$_POST['province_id']."' ":'';
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
	
	
	
	function crime(){
		$this->template->build('crime_index');
	}
	
	function crime_form(){
		$this->template->build('crime_form');
	}
	
	function vehicle(){
		$this->template->build('vehicle_index');
	}
	
	function vehicle_form(){
		$this->template->build('vehicle_form');
	}
}
?>