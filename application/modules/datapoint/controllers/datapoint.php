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