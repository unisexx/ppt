<?php
class Location extends Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function ajax_amphur($type = NULL)
	{
		$text = ($type == 'report') ? '- ทั้งหมด -' : '- เลือกอำเภอ -';
		$result = $this->db->GetArray('select id,amphur_name as text from amphur where province_id = ? order by amphur_name',$_GET['q']);
        dbConvert($result);
		echo $result ? json_encode($result) : '[{"id":"","text":"'.$text.'"}]';
	}
	
	function ajax_district()
	{
		$result = $this->db->GetArray('select id,district_name as text from district where amphur_id = ?',$_GET['q']);
		echo $result ? json_encode($result) : '[{id:"",text:"- เลือกตำบล -"}]';
	}
	
	function ajax_province()
	{
		$condition = ($_GET['q'] != 1) ? 'where dpc_id = '.$_GET['q'] : ''; 
		$result = $this->db->GetArray('select id,province as text from provinces '.$condition.' order by CONVERT(province USING TIS620) asc');
		echo $result ? json_encode($result) : '[{id:"",text:"- เลือกจังหวัด  -"}]';
	}
	
	function ajax_village()
	{
		$result = $this->db->getarray('select id,vill_name as text from villages where district_id = ?',$_GET['q']);
		echo $result ? json_encode($result) : '[{id:"",text:"- เลือกหมู่บ้าน  -"}]';
	}
	
}
?>