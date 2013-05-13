<?php 
class Datapoint extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dp_vehicle_model','vehicle');
	}
	
	public function vehicle()
	{
		$sql="SELECT year,sum(die_male) as die_male,sum(die_female) as die_female,sum(pain_male) as pain_male,sum(pain_female) as pain_female
					,sum(coma_male) as coma_male,sum(coma_female) as coma_female,sum(total) as total 
					FROM DP_VEHICLE GROUP BY year ORDER BY year DESC";
		$data['result']=$this->vehicle->get($sql);
		$this->template->build('datapoint/vehicle_index',$data);
	}
}
?>