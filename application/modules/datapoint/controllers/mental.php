<?php
Class Mental extends Public_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('mental_model', 'mental');
		$this->load->model('province_model', 'province');		
#		$this->load->model('crime_station_model','station');
#		$this->load->model('crime_statistic_model','statistic');
		$this->load->model('dp_vehicle_model','vehicle');
		$this->load->model('info_model','info');
	}
	
	
	#================ MENTAL ==================#
	function index($year=FALSE, $province_id=FALSE){
		$sql = 'SELECT MT.ID, MT.PROVINCE_ID, MT.YEAR, MT.PSY_NUMBER, MT.FEAR_NUMBER, MT.DEPRESS_NUMBER, MT.RETARDED_NUMBER, MT.APOPLEXY_NUMBER, MT.DRUGADD_NUMBER, MT.AUTISM_NUMBER, MT.OTHER_NUMBER, PV.PROVINCE 
				FROM MENTAL_NUMBER MT LEFT JOIN PROVINCES PV ON MT.PROVINCE_ID = PV.ID WHERE 1=1 ';
			$sql .= (@$_GET['year'])?"AND MT.YEAR LIKE '".$_GET['year']."' ":'';
			$sql .= (@$_GET['province_id'])?"AND MT.PROVINCE_ID LIKE '".$_GET['province_id']."' ":'';
		$sql .= 'ORDER BY MT.YEAR DESC, MT.PROVINCE_ID ASC ';
		
		$data['province'] = $this->province->limit(80)->get('SELECT ID, PROVINCE FROM PROVINCES');


		$data['result'] = $this->mental->get($sql);
    	$data['pagination'] = $this->mental->pagination;
		
		$this->template->build('mental/index', $data);
	}
	
	function form($id=FALSE){
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$data['id'] = $id;
		if($id)
		{
			$data['mental_dtl'] = $this->mental->get_row($id);
		}
		
		
        $this->template->build('mental/form', $data);
	}
		function save($menu_id)
		{
			$sql = "SELECT * FROM MENTAL_NUMBER WHERE PROVINCE_ID LIKE '".$_POST['PROVINCE_ID']."' AND YEAR LIKE '".$_POST['YEAR']."'";
			$chk_mental = $this->mental->get($sql);
			
			
				$id=$this->mental->save($_POST);
	           	if(empty($_POST['id'])) logs('เพิ่มรายการ ', $menu_id, $id); else logs('แก้ไขรายการ', $menu_id, $id);

				set_notify('success', 'บันทึกข้อมูลเสร็จสิ้น');
				redirect('datapoint/mental');
		}
		
		function delete($menu_id, $id)
		{
				if($id)
				{
					logs('ลบรายการ', $menu_id, $id);
					$this->mental->delete($id);
					set_notify('success', 'ดำเนินการลบข้อมูลเสร็จสิ้น');
					redirect('datapoint/mental');	
				} else {
					set_notify('error', 'พบความผิดพลาด ไม่สามารถดำเนินการลบข้อมูลได้');
					redirect('datapoint/mental');						
				}
		}	
		
	function import() { $this->template->build('mental/import'); }
		function upload()
		{
			$total_row=0;
			$_POST['SECTION_ID'] = ($_POST['WORKGROUP_ID']>0)?$_POST['WORKGROUP_ID']:$_POST['SECTION_ID'];
            $this->info->save($_POST);
			unset($_POST);
			$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'mental_'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/datapoint/mental/';
			move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.'/'.$file_name);
			$data = $this->ReadData($uploaddir.$file_name);
echo '<HR>';
			?><div style='font-size:12px;'><?
			$_POST['YEAR'] = $data[1][1];

			if($_POST['YEAR'])
			{
				for($i=6; $i<count($data); $i++)
				{
					
					if($data[$i][0])
					{
						$get_province = explode('รวม', $data[$i][0]);
						$get_province = trim($get_province[0]);
						if($get_province != '')
						{
							$dtl_province = $this->province->limit(1)->get("SELECT id FROM PROVINCES WHERE PROVINCE LIKE '".$get_province."'");
							
							
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
								
							for($j=0; $j<count($post_title); $j++) { $_POST[$post_title[$j]] = number_format(($data[$i][($j+1)]*1), 0); }
							
							$total_row++;
							$this->mental->save($_POST);
							?><div style='color:#0A0; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>บันทึก : เพิ่มข้อมูล จังหวัด "<?=$get_province;?>" </div><?
						}
					}
				}
			} ELSE {
				?><DIV STYLE='color:#A00'>ไม่สามารถดำเนินการบันทึกข้อมูลได้เนื่องจากข้อมูลไม่ถูกต้อง</DIV><?
			}
			?></div><?
					unlink($uploaddir.$file_name);
					if($total_row>0) logs('นำเข้าข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์  จำนวน '.number_format($total_row).' record');
					?><BR>
						<input type='button' value='กลับไปหน้าแรก' onclick='window.location="../../datapoint/mental/";'>
						<input type='button' value='ย้อนกลับไปหน้านำเข้าข้อมูล' onclick='window.location="../../datapoint/mental/import";'>
					<?

		}
	#================ MENTAL ==================#	
	
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
					for($j=1; $j<=$cnt_colum; $j++)
					{
						$import[$index][] = trim($data -> sheets[0]['cells'][$i][$j]);		
					}
					$index++;			
				}
				return $import;	
			}	
}