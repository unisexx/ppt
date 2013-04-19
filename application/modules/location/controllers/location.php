<?php
class Location extends Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function ajax_amphur($type = NULL)
	{
		$text = ($type == 'report') ? '-- ทุกอำเภอ --' : '- เลือกอำเภอ -';
		$result = $this->db->GetArray('select id,amphur_name as text from amphur where province_id = ? order by amphur_name',$_GET['q']);
        dbConvert($result);
        if($type == 'report' and !empty($_GET['q'])) array_unshift($result, array('id' => '', 'text' => $text));
		echo $result ? json_encode($result) : '[{"id":"","text":"'.$text.'"}]';
	}
	
	function ajax_district()
	{
		$result = $this->db->GetArray('select id,district_name as text from district where amphur_id = ?',$_GET['q']);
		echo $result ? json_encode($result) : '[{id:"",text:"- เลือกตำบล -"}]';
	}
	
}