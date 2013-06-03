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
	
	function ajax_district($type=NULL)
	{
		$text = ($type == 'report') ? '-- ทุกตำบล --' : '- เลือกตำบล -';
		$result = $this->db->GetArray('select id,district_name as text from district where amphur_id = ?',$_GET['q']);
		dbConvert($result);
        if($type == 'report' and !empty($_GET['q'])) array_unshift($result, array('id' => '', 'text' => $text));
		echo $result ? json_encode($result) : '[{"id":"","text":"'.$text.'"}]';
	}
    
    function ajax_opt($type=NULL)
    {
        $text = '-- ทุกตำบล --';
        $res = $this->db->GetArray('SELECT DISTINCT OPT_NAME
        FROM FORM_ALL
        WHERE PROVINCE_ID = ?
        AND AMPHUR_ID = ?
        ORDER BY OPT_NAME', array($_GET['province_id'], $_GET['amphur_id']));
        dbConvert($res);
        echo '<option value="">--ทุกตำบล--</option>';
        foreach($res as $item)
		{
			$selected = (trim(@$_GET['opt']) == trim($item['opt_name'])) ? 'selected="selected"' : null;
			echo '<option value="'.$item['opt_name'].'" '.$selected.'>'.$item['opt_name'].'</option>';
		}

    }
	
}