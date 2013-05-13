<?php 
//===== Ref:child/welfare =====//
class Crime extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('crime_station_model', 'crime_station');
		$this->load->model('crime_statistic_model', 'crime_statistic');
	}
	
	function index()
	{
		$data[1] = 1;
		$set_year = $this->crime_station->get("SELECT YEAR FROM CRIME_STATION GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i<count($set_year); $i++) { $data['set_year'][] = $set_year[$i]['year']; }
		
		$data['tbl_head'] = array("คดีอุกฉกรรจ์และสะเทือนขวัญ", "คดีชีวิตร่างกาย และเพศ", "คดีประทุษร้ายต่อทรัพย์", "คดีที่น่าสนใจ", "คดีที่รัฐเป็นผู้เสียหาย");
		
		
		
		$set_province = $this->crime_station->limit(1000)->get("SELECT STATION FROM CRIME_STATION GROUP BY STATION ORDER BY STATION ASC");
		for($i=0; $i<count($set_province); $i++) { $data['set_province'][] = $set_province[$i]['station']; }
		
		$this->template->build('crime/index', $data);
	}
	
	
	function report2()
	{
		$set_year = $this->inmates->get("SELECT YEAR FROM ELDER_INMATES GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i<count($set_year); $i++) { $data['set_year'][] = $set_year[$i]['year']; }
		$this->template->build('elder_inmates/index2', $data);
	}

	function export($status=FALSE)
	{
		?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?
		$data[1] = 1;
		if($status!='print')
		{
			$filename= "crime_report_data_".date("Y-m-d_H_i_s").".xls";
			header("Content-Disposition: attachment; filename=".$filename);
			logs('ดาวน์โหลดข้อมูล การกระทำความผิดที่ละเมิดกฎหมายทางอาญา');
		} else {
			?><script>window.print();</script><?
			logs('พิมพ์ข้อมูล การกระทำความผิดที่ละเมิดกฎหมายทางอาญา');	
		}

		$set_year = $this->crime_station->get("SELECT YEAR FROM CRIME_STATION GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i<count($set_year); $i++) { $data['set_year'][] = $set_year[$i]['year']; }
		
		$data['tbl_head'] = array("คดีอุกฉกรรจ์และสะเทือนขวัญ", "คดีชีวิตร่างกาย และเพศ", "คดีประทุษร้ายต่อทรัพย์", "คดีที่น่าสนใจ", "คดีที่รัฐเป็นผู้เสียหาย");
		
		
		
		$set_province = $this->crime_station->limit(1000)->get("SELECT STATION FROM CRIME_STATION GROUP BY STATION ORDER BY STATION ASC");
		for($i=0; $i<count($set_province); $i++) { $data['set_province'][] = $set_province[$i]['station']; }
		
		$this->load->view('crime/export', $data);
	}
}
