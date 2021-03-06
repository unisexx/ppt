<?php
Class Information extends Public_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('pledgee_model', 'pledgee');
        $this->load->model('opt_model', 'opt');

		$this->load->model('province_model', 'province');
		$this->load->model('amphur_model', 'amphur');
	}
	
	function population(){
		$this->template->build('population_index');
	}
	
	function population_form(){
		$this->template->build('population_form');
	}
	
	//===== PLEDGEE =====//
		function pledgee(){
			menu::source(77);
			$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');

			$sql = 'SELECT PG.*, PV.PROVINCE, AM.AMPHUR_NAME 
					FROM (PLEDGEE PG LEFT JOIN PROVINCES PV ON PG.CTM_PVM_PV_CODE = PV.CODE) LEFT JOIN AMPHUR AM ON PG.CTM_PVM_AMP_CODE = AM.ID 
					WHERE 1=1 ';
				if(@$_GET['YEAR']) $sql .= "AND EXTRACT(YEAR FROM TO_DATE(PG.PTH_TICKET_DATE)) = ".($_GET['YEAR']-543).' ';
				if(@$_GET['province_id']) $sql .= "AND PG.CTM_PVM_PV_CODE LIKE '".$_GET['province_id']."' ";
				if(@$_GET['amphur_id']) $sql .= 'AND PG.CTM_PVM_AMP_CODE = '.$_GET['amphur_id'].' ';
					
			$sql .= 'ORDER BY PTH_TICKET_DATE DESC';

			$data['result'] = $this->pledgee->get($sql);
        	$data['pagination'] = $this->pledgee->pagination;
		
			$this->template->build('pledgee/pledgee_index', $data);
		}
		function pledgee_form($id=FALSE) {
			menu::source(77);
		    $data['rs'] = $this->pledgee->get_row($id);
			$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
			
			$data['id'] = $id;
				if($id)
				{
					$data['pg_dtl'] = $this->pledgee->get_row($id);
					echo $data['pg_dtl']['ctm_pvm_pv_code'];
						$pv_dtl = $this->province->limit(1)->get("SELECT * FROM PROVINCES WHERE ID LIKE '".$data['pg_dtl']['ctm_pvm_pv_code']."'");
					$data['rs']['amphur_id'] = $data['pg_dtl']['ctm_pvm_amp_code'];
				}
								
			$this->template->build('pledgee/pledgee_form', $data);
		}
		
			function pledgee_save()
			{
				menu::source(77);
				$_POST['CTM_PVM_AMP_CODE'] = $_POST['amphur_id']; 	unset($_POST['amphur_id']);
				$_POST['CTM_PVM_PV_CODE'] = $_POST['province_id'];	unset($_POST['province_id']);
					
				$last_id = $this->pledgee->get('SELECT ID FROM PLEDGEE WHERE rownum <= 1 ORDER BY ID DESC');
				$ins_id = $this->pledgee->save($_POST);
				
				if($ins_id != $last_id[0]['id'])
					{
						set_notify('success', 'บันทึกข้อมูลเสร็จสิ้น');
						redirect('information/pledgee');	
					}
	
				else
					{
						set_notify('success', 'error');
						?><script>alert('พบข้อผิดพลาดไม่สามารถบันทึกข้อมูลได้'); history.back();</script><?
					}
			}
			function pledgee_delete($id=FALSE)
			{
				menu::source(77);
				if($id)
				{
					$this->pledgee->delete($id);
					set_notify('success', 'ดำเนินการลบข้อมูลเสร็จสิ้น');
					redirect('information/pledgee');	
				} else {
					set_notify('error', 'พบความผิดพลาด ไม่สามารถดำเนินการลบข้อมูลได้');
					redirect('information/pledgee');						
				}
			}
		function pledgee_import()
		{
			menu::source(77);
			$this->template->build('pledgee/pledgee_import');
		}
			function pledgee_upload()
			{
				print_r($_FILES);
				/*
				
				unset($_POST['ID']);
				print_r($_FILES);
				$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
				$file_name = 'pledgee_'.date("Y_m_d_H_i_s").'.'.$ext;
				$uploaddir = 'import_file/information/pledgee/';
				move_uploaded_file($_FILES['file_import']['tmp_name'], $uploaddir.$file_name);
				#$objTxt = file($uploaddir.$file_name);
				$objTxt2 = opendir($uploaddir.$file_name);
				$objRes = readdir($objTxt2);
				print_r($objRes);
				
				/*
				foreach($objTxt as $value)
				{
					$value = iconv('TIS-620', 'UTF-8', $value);
					
					if(trim($value) != "PTH_TICKET_DATE,PTH_TICKET_NO,PTD_SEQ,PTD_DESC,PTH_PAWN_COST,CTM_TITLE,CTM_CARD_NO,CTM_AGE,CTM_NATIONALITY,CTM_HOUSE_NO,CTM_ROAD,CTM_TUMBON,CTM_PVM_AMP_CODE,CTM_PVM_PV_CODE,CTM_OCM_CODE")
					{	$value = trim($value);
						$value_exp = explode(',', $value);
						$_POST['PTH_TICKET_DATE'] = date('Y-m-d', strtotime($value_exp[0]));
						$_POST['PTH_TICKET_NO'] = $value_exp[1];
						$_POST['PTD_SEQ'] = $value_exp[2];
						$_POST['PTD_DESC'] = $value_exp[3];
						$_POST['PTH_PAWN_COST'] = $value_exp[4];
						$_POST['CTM_TITLE'] = $value_exp[5];
						$_POST['CTM_CARD_NO'] = $value_exp[6];
						$_POST['CTM_AGE'] = $value_exp[7];
						$_POST['CTM_NATIONALITY'] = $value_exp[8];
						$_POST['CTM_HOUSE_NO'] = $value_exp[9];
						$_POST['CTM_ROAD'] = $value_exp[10];
						$_POST['CTM_TUMBON'] = $value_exp[11];
						$_POST['CTM_PVM_AMP_CODE'] = $value_exp[12];
						$_POST['CTM_PVM_PV_CODE'] = $value_exp[13];
						$_POST['CTM_OCM_CODE'] = $value_exp[14];
						
						$chk_repeat = $this->pledgee->limit(1)->get("SELECT * FROM PLEDGEE WHERE PTH_TICKET_DATE LIKE '".$_POST['PTH_TICKET_DATE']."' AND PTH_TICKET_NO = ".$_POST['PTH_TICKET_NO']);
						if(count($chk_repeat) == 1)
							{ ?><DIV STYLE='color:#F55; line-height:25px;'>ไม่สามารถเพิ่มข้อมูลได้เนื่องจาก พบข้อมูล   ตั๋วจำนำเลขที่ <?=$_POST['PTH_TICKET_NO'];?> ลงวันที่ <?=$_POST['PTH_TICKET_DATE'];?> ในระบบอยู่แล้ว</DIV><? 	}
						else 
							{
								$this->pledgee->save($_POST);
								?><DIV STYLE='color:#0A0; line-height:25px;'>ดำเนินการบันทึกข้อมูล ตั๋วจำนำเลขที่ <?=$_POST['PTH_TICKET_NO'];?> ลงวันที่ <?=$_POST['PTH_TICKET_DATE'];?>เสร็จสิ้น</DIV><?
							}
					}
				}
				
				 * 
				 */
					?><BR><BR>
						<input type='button' value='กลับไปหน้าแรก' onclick='window.location="../../information/pledgee";'>
						<input type='button' value='ย้อนกลับไปหน้านำเข้าข้อมูล' onclick='window.location="	../information/pledgee_import";'>
					<?
				/*
				$data = $this->ReadData($uploaddir.$file_name);
				for($i=3; $i<count($data); $i++)
				{
					$pv_dtl = $this->province->get("SELECT ID FROM PROVINCES WHERE PROVINCE LIKE '".$data[$i][13]."'");
					$dt_dtl = $this->amphur->get("SELECT ID FROM AMPHUR WHERE AMPHUR_NAME LIKE '".$data[$i][14]."'");
					
					$_POST['PTH_TICKET_DATE'] = ($data[$i][2]-543).'-'.$data[$i][1].'-'.$data[$i][0];
					$_POST['PTH_TICKET_NO'] = $data[$i][3];
					$_POST['PTD_SEQ'] = $data[$i][4];
					$_POST['PTD_DESC'] = $data[$i][5];
					$_POST['PTH_PAWN_COST'] = $data[$i][6];
					$_POST['CTM_TITLE'] = $data[$i][7];
					$_POST['CTM_CARD_NO'] = $data[$i][8];
					$_POST['CTM_AGE'] = $data[$i][9];
					$_POST['CTM_NATIONALITY'] = $data[$i][10];
					$_POST['CTM_HOUSE_NO'] = $data[$i][11];
					$_POST['CTM_ROAD'] = $data[$i][12];
					$_POST['CTM_TUMBON'] = $data[$i][15];
						$_POST['CTM_PVM_AMP_CODE'] = $dt_dtl[0]['id'];
						$_POST['CTM_PVM_PV_CODE'] = $pv_dtl[0]['id'];
					$_POST['CTM_OCM_CODE'] = $data[$i][16];
					
					$this->pledgee->save($_POST);
					?><div style='color:#0A0; border-bottom:solid 1px #CCC; line-height:15px; padding:5px;'>บันทึก: ข้อมูล 
						รหัสรับจำนำเลขที่ <?=$_POST['PTH_TICKET_NO'];?>
					</div><?
				}
				
			unlink($uploaddir.$file_name);
			?><BR><BR>
				<input type='button' value='กลับไปหน้าแรก' onclick='window.location="information/pledgee";'>
				<input type='button' value='ย้อนกลับไปหน้านำเข้าข้อมูล' onclick='window.location="information/pledgee_import";'>
			<?
				#print_r($data);
				 /* 
				 */
				 
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
}
?>

