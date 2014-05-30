<?php 
//===== Ref:child/welfare =====//
class Elder_inmates extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('elder_inmates_model', 'inmates');
		$this->load->model('elder_inmateslist_model', 'inmateslist');
		$this->load->model('province_model', 'province');
	}
	
	function index()
	{
		$set_year = $this->inmates->get("SELECT YEAR FROM ELDER_INMATES GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i<count($set_year); $i++) { $data['set_year'][] = $set_year[$i]['year']; }
		
		$this->template->title('รายงานผู้ต้องขังสูงอายุ ระบบฐานข้อมูลทางสังคม สป.พม.');
		$this->template->append_metadata( meta('keywords','ระบบฐานข้อมูลทางสังคม,ระบบฐานข้อมูลด้านสังคม,ฐานข้อมูลด้านสังคม,ฐานข้อมูลทางสังคม,กลุ่มเป้าหมาย,เชิงประเด็น,สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,พม.,สป.พม.,สป.,ข้อมูลด้านสังคม,ข้อมูลทางสังคม,ข้อมูลสังคม,ผู้สูงอายุ,ผู้ต้องขังสูงอายุ,กรมราชทัณฑ์,กระทรวงยุติธรรม,ผู้ต้องขัง'));
		
		$this->template->build('elder_inmates/index', $data);
	}
	
	
	function report2()
	{
		$set_year = $this->inmates->get("SELECT YEAR FROM ELDER_INMATES GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i<count($set_year); $i++) { $data['set_year'][$set_year[$i]['year']] = $set_year[$i]['year']; }
		$this->template->build('elder_inmates/index2', $data);
	}


	function export()
	{
		$set_year = $this->inmates->get("SELECT YEAR FROM ELDER_INMATES GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i<count($set_year); $i++) { $data['set_year'][] = $set_year[$i]['year']; }
		
		$filename= "elderinmates_report_data_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$data['style'] = 'export';
		$this->load->view('elder_inmates/export', $data);
	}

	function export2()
	{
		$set_year = $this->inmates->get("SELECT YEAR FROM ELDER_INMATES GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i<count($set_year); $i++) { $data['set_year'][$set_year[$i]['year']] = $set_year[$i]['year']; }

		$filename= "elderinmates_report_data_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$data['style'] = 'export';
		$this->load->view('elder_inmates/export2', $data);
	}
}
