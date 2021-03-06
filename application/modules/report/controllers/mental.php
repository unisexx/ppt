<?php 
//===== Ref:datapoint/Mental =====//
class Mental extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mental_model', 'mental');
		$this->load->model('province_model', 'province');
	}
	
	function index()
	{
		$data[1] = 1;
		$data['tbl_head'] = array("โรคจิต", "โรควิตกกังวล และเพศ", "โรคซึมเศร้า", "ปัญญาอ่อน", "โรคลมชัก", "ผู้ติดสารเสพติด", "ปัญหาสุขภาพจิตอื่น ๆ", "ผู้พยายามฆ่าตัวตายหรือฆ่าตัวตาย", "ออติสติก", "รวมทั้งหมด");
		$set_y = $this->mental->get("SELECT YEAR FROM MENTAL_NUMBER GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i<count($set_y); $i++) { $data['set_y'][$set_y[$i]['year']] = $set_y[$i]['year']; }
		for($i=0; $i<count($set_y); $i++) { $data['year_list'][] = $set_y[$i]['year']; }
		
		if(@$_GET['province']) { $data['province_'] = $this->province->get("SELECT * FROM PROVINCES WHERE ID LIKE '".$_GET['province']."'"); }
		
		$this->template->title('รายงานจำนวนและอัตราผู้ป่วยสุขภาพจิต (ต่อประชากร 100,000 คน) ระบบฐานข้อมูลทางสังคม สป.พม.');
		$this->template->append_metadata( meta('keywords','ระบบฐานข้อมูลทางสังคม,ระบบฐานข้อมูลด้านสังคม,ฐานข้อมูลด้านสังคม,ฐานข้อมูลทางสังคม,กลุ่มเป้าหมาย,เชิงประเด็น,สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,พม.,สป.พม.,สป.,ข้อมูลด้านสังคม,ข้อมูลทางสังคม,ข้อมูลสังคม,ผู้ป่วยสุขภาพจิต,จำนวนและอัตราผู้ป่วยสุขภาพจิต,จำนวนผู้ป่วยสุขภาพจิต,อัตราผู้ป่วยสุขภาพจิต,ผู้ป่วยสุขภาพจิต,โรคจิต,ซึมเศร้า,วิตกกังวล,ปัญญาอ่อน,ลมชัก,เสพติด,ปัญหาสุขภาพ,ฆ่าตัวตาย,ออติสติก,กรมสุขภาพจิต กระทรวงสาธารณสุข,กรมสุขภาพจิต,กระทรวงสาธารณสุข'));
		
		$this->template->build('mental/index', $data);
	}
	
	
	function report2()
	{
		$set_year = $this->inmates->get("SELECT YEAR FROM ELDER_INMATES GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i<count($set_year); $i++) { $data['set_year'][] = $set_year[$i]['year']; }
		$this->template->build('elder_inmates/index2', $data);
	}
	
	function export($status=FALSE)
	{
		$data[1] = 1;
		if($status!='print')
		{
			$filename= "mental_report_data_".date("Y-m-d_H_i_s").".xls";
			header("Content-Disposition: attachment; filename=".$filename);
			logs('ดาวน์โหลดข้อมูล ผู้ป่วยสุขภาพจิต');
		} else {
			?><script>window.print();</script><?
			logs('พิมพ์ข้อมูล ผู้ป่วยสุขภาพจิต');	
		}
		?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?
		
		
		$data['tbl_head'] = array("โรคจิต", "โรควิตกกังวล และเพศ", "โรคซึมเศร้า", "ปัญญาอ่อน", "โรคลมชัก", "ผู้ติดสารเสพติด", "ปัญหาสุขภาพจิตอื่น ๆ", "ผู้พยายามฆ่าตัวตายหรือฆ่าตัวตาย", "ออติสติก", "รวมทั้งหมด");
		$set_y = $this->mental->get("SELECT YEAR FROM MENTAL_NUMBER GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i<count($set_y); $i++) { $data['set_y'][$set_y[$i]['year']] = $set_y[$i]['year']; }
		for($i=0; $i<count($set_y); $i++) { $data['year_list'][] = $set_y[$i]['year']; }
		
		if(@$_GET['province']) { $data['province_'] = $this->province->get("SELECT * FROM PROVINCES WHERE ID LIKE '".$_GET['province']."'"); }
		
		
		$this->load->view('mental/export', $data);		
	}
}
