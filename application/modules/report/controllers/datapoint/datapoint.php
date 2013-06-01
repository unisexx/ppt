<?php 
class Datapoint extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dp_vehicle_model','vehicle');
	}
	
	public function vehicle($action=FALSE)
	{
		$sql="SELECT year,sum(die_male) as die_male,sum(die_female) as die_female,sum(pain_male) as pain_male,sum(pain_female) as pain_female
					,sum(coma_male) as coma_male,sum(coma_female) as coma_female,sum(total) as total 
					FROM DP_VEHICLE GROUP BY year ORDER BY year DESC";
		$data['result']=$this->vehicle->get($sql);
		if($action=="export"){
			$filename= "vehicle_data_".date("Y-m-d_H_i_s").".xls";
			header("Content-Disposition: attachment; filename=".$filename);	
			$this->load->view('datapoint/vehicle_export',$data);
		}else if($action=="print"){
			$this->load->view('datapoint/vehicle_print',$data);
		}else{
			$this->template->build('datapoint/vehicle_index',$data);
		}
		
	}
}
?>