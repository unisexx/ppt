<?php 
//===== Ref:disadvantaged/vacancy =====//
class Vacancy extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('vacancy_model', 'vacancy');
		$this->load->model('province_model', 'province');
	}
	
	function index()
	{
		$data[1] = 1;
		
		$set_y = $this->vacancy->get("SELECT YEAR FROM VACANCY GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i < count($set_y); $i++) { $data['year_list'][] = $set_y[$i]['year']; }
		
		$data['tbl_head'] = array("ปี", "ตำแหน่งงานว่าง (ตำแหน่ง)", "ผู้สมัครงาน (คน)", "ผู้บรรจุงาน (คน)");
		if(@$_GET['province']) { $data['province_'] = $this->province->get("SELECT * FROM PROVINCES WHERE ID LIKE '".$_GET['province']."'"); }
		
		
		$this->template->title('รายงานตำแหน่งงานว่าง ระบบฐานข้อมูลทางสังคม สป.พม.');
		$this->template->append_metadata( meta('keywords','ระบบฐานข้อมูลทางสังคม,ระบบฐานข้อมูลด้านสังคม,ฐานข้อมูลด้านสังคม,ฐานข้อมูลทางสังคม,กลุ่มเป้าหมาย,เชิงประเด็น,สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,พม.,สป.พม.,สป.,ข้อมูลด้านสังคม,ข้อมูลทางสังคม,ข้อมูลสังคม,จำนวนคนว่างงาน บรรจุงาน และสมัครงาน,จำนวนคนว่างงาน บรรจุงาน และสมัครงาน,จำนวนคนว่างงาน,บรรจุงาน,สมัครงาน,คนเข้างาน,คนสมัครงาน,ผู้สมัครงาน,ตำแหน่งงานว่าง,ผู้บรรจุงานกรมการจัดหางาน กระทรวงแรงงาน,กรมการจัดหางาน,กระทรวงแรงงาน'));
		
		$this->template->build('vacancy/index', $data);
	}
	
	
	function export($status=FALSE)
	{
		$data[1] = 1;
		if($status!='print')
		{
			$filename= "vacancy_report_data_".date("Y-m-d_H_i_s").".xls";
			header("Content-Disposition: attachment; filename=".$filename);
			logs('ดาวน์โหลดข้อมูล ตำแหน่งงานว่่าง');
		} else {
			?><script>window.print();</script><?
			logs('พิมพ์ข้อมูล ตำแหน่งงานว่่าง');	
		}
		?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?

						
		$set_y = $this->vacancy->get("SELECT YEAR FROM VACANCY GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i < count($set_y); $i++) { $data['year_list'][] = $set_y[$i]['year']; }
		
		$data['tbl_head'] = array("ปี", "คนว่างงาน", "คนสมัครงาน", "คนบรรจุงาน");
		if(@$_GET['province']) { $data['province_'] = $this->province->get("SELECT * FROM PROVINCES WHERE ID LIKE '".$_GET['province']."'"); }
		
		
		$this->load->view('vacancy/export', $data);
		
	}
	
}
