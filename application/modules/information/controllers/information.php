<?php
Class Information extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('pledgee_model', 'pledgee');
        $this->load->model('opt_model', 'opt');
	}
	
	function population(){
		$this->template->build('population_index');
	}
	
	function population_form(){
		$this->template->build('population_form');
	}
	
	//===== PLEDGEE =====//
		function pledgee(){
			$sql = 'SELECT PG.*, PV.PROVINCE, AM.AMPHUR_NAME
					FROM
						(PLEDGEE PG LEFT JOIN  PROVINCES PV
							ON PG.CTM_PVM_PV_CODE = PV.ID)
						LEFT JOIN AMPHUR AM
							ON PG.CTM_PVM_AMP_CODE = AM.ID
					ORDER BY PTH_TICKET_DATE DESC';
			$data['result'] = $this->pledgee->get($sql);
        	$data['pagination'] = $this->pledgee->pagination;
		
			$this->template->build('pledgee/pledgee_index', $data);
		}
		function pledgee_form($id=FALSE) {
		    $data['rs'] = $this->pledgee->get_row($id);
			$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
			
			$data['id'] = $id;
				if($id)
				{
					$data['pg_dtl'] = $this->pledgee->get_row($id);
					$data['rs']['province_id'] = $data['pg_dtl']['ctm_pvm_pv_code'];
					$data['rs']['amphur_id'] = $data['pg_dtl']['ctm_pvm_amp_code'];
				}
								
			$this->template->build('pledgee/pledgee_form', $data);
		}
		
			function pledgee_save()
			{
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
}
?>




