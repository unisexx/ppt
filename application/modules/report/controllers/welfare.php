<?php 
//===== Ref:child/welfare =====//
class Welfare extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('welfarelist_model', 'welfare_list');
		$this->load->model('welfare_model', 'welfare');
	}
	
	public $cat_list = array("บ้านพักเด็กและครอบครัว", "ศูนย์สงเคราะห์และฝึกอาชีพเด็กและเยาวชน", "สถานคุ้มครองสวัสดิภาพเด็ก", "สถานพัฒนาและฟื้นฟูเด็ก", "สถานสงเคราะห์เด็กอ่อน", "สถานสงเคราะห์เด็ก", "สถานแรกรับเด็ก");
	
	
	public function index()
	{
		$cat_list = $this->cat_list;
		
		$data['main_list'] = $cat_list;
		//===== set year list group =====//
		$year_list = $this->welfare->get('SELECT YEAR FROM WELFARE_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++) $data['year_list'][$year_list[$i]['year']] = $year_list[$i]['year'];

		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		//===== set year list group =====//


		if(@$_GET['WLIST'] != '') $cat_list = array($cat_list[$_GET['WLIST']]);
		
		
		foreach($cat_list as $cat_list_)
		{
			$qry_catlist = '';
				if($cat_list_ == 'อื่น ๆ')
				{
					for($i=0; $i<count($cat_list); $i++)
						{
							if($cat_list[$i] != 'อื่น ๆ')
								{
									if(@$cat_list[$i+1] && $i != 0) $qry_catlist .= 'AND ';
									$qry_catlist .= "NAME NOT LIKE '".$cat_list[$i]."%' ";
								} 
						}
				} else {
					$qry_catlist .= "(NAME LIKE'".$cat_list_."%'";
						if($cat_list_ == 'สถานสงเคราะห์เด็ก') $qry_catlist .= "OR NAME LIKE 'สถานสงเคราะห์เยาวชน%' AND NAME NOT LIKE 'สถานสงเคราะห์เด็กอ่อน%')";
						else $qry_catlist .= ')';
				}
			$rs_catlist = $this->welfare_list->where($qry_catlist)->get(false, true);
			$welfare_list[] = $rs_catlist;
		}		
		
		foreach($welfare_list as $key=>$rs)
		{
			$qry_data = 'SELECT SUM(TARGET) target, SUM(BALANCE) balance, SUM(ADMISSION) admission, SUM(DISTRIBUTION) distribution, SUM(REMAIN) remain, SUM(BUILD) build FROM WELFARE_DATA WHERE (';
			foreach($rs as $key2=>$rs2)
			{
				if($key2 != 0 && $key2-1 != count($rs)) $qry_data .= 'OR ';
				$qry_data .= "WLIST_ID LIKE '".$rs2['id']."' ";
			}
			$qry_data .= ')';
			
			//CONDITION SEARCH
			$_GET['WLIST'] = ((@!$_GET['WLIST'] && @$_GET['WLIST'] != 0) || @$_GET['WLIST'] == '')?NULL:$_GET['WLIST'];
			$_GET['YEAR'] = (@!$_GET['YEAR'])?$year_list[0]['year']:$_GET['YEAR'];
			$qry_data .= (@$_GET['YEAR'])?"AND YEAR LIKE '".$_GET['YEAR']."'":'';

			
			$wdata = $this->welfare->get($qry_data, true);
				$result[$key] = $wdata[0];
				$result[$key]['title'] = $cat_list[$key];
				
			foreach($data['main_list'] as $key2=>$list) if($list == $cat_list[$key]) $result[$key]['id'] = $key2;
		}
		
		$data['result'] = $result;
		
		$this->template->title('รายงานเด็กและเยาวชนที่อยู่ในความอุปการะของสถาบัน ระบบฐานข้อมูลทางสังคม สป.พม.');
		$this->template->append_metadata( meta('keywords','ระบบฐานข้อมูลทางสังคม,ระบบฐานข้อมูลด้านสังคม,ฐานข้อมูลด้านสังคม,ฐานข้อมูลทางสังคม,กลุ่มเป้าหมาย,เชิงประเด็น,สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,เด็กและเยาวชน,เด็ก,เยาวชน,พม.,สป.พม.,สป.,ข้อมูลด้านสังคม,ข้อมูลทางสังคม,ข้อมูลสังคม,เด็กและเยาวชน,อุปการะของสถาบัน,สถานสงเคราะห์,บ้านพักเด็กและครอบครัว,ฝึกอาชีพ,สถานคุ้มครองสวัสดิภาพเด็ก,สถานคุ้มครองและฟื้นฟู,สถานแรกรับ,กรมพัฒนาสังคมและสวัสดิการ,พส.'));
		
		$this->template->build('welfare/index', $data);
	}


	function report2()
	{
		$cat_list = $this->cat_list;
		$data['main_list'] = $cat_list;

		//===== set year list group =====//
		$year_list = $this->welfare->get('SELECT YEAR FROM WELFARE_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++)
		{
			$data['year_list'][$year_list[$i]['year']] = $year_list[$i]['year'];
			if($i==0) $_GET['YEAR'] = (empty($_GET['YEAR']))?$data['year_list'][$year_list[$i]['year']]:$_GET['YEAR'];
		}

		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		
		//===== set year list group =====//
		
		
		$wf_qry = "SELECT WL.NAME title, WD.* FROM WELFARE_LIST WL JOIN WELFARE_DATA WD ON WL.ID = WD.WLIST_ID WHERE 1=1 ";
				
			if(@$cat_list[$_GET['WLIST']] == 'อื่น ๆ'){
				$wf_qry .= "AND (";
				foreach($cat_list as $key=>$rs)
				{
					$wf_qry .= ($key==0)?'':'AND ';
					$wf_qry .= "WL.NAME NOT LIKE '".$rs."%' ";
				}
				$wf_qry .= ") ";
			} else if(@$cat_list[$_GET['WLIST']]) {
				if($cat_list[$_GET['WLIST']] == 'สถานสงเคราะห์เด็ก') 
					$wf_qry .= "AND (WL.NAME LIKE '".$cat_list[$_GET['WLIST']]."%' OR WL.NAME LIKE 'สถานสงเคราะห์เยาวชน%' AND WL.NAME NOT LIKE 'สถานสงเคราะห์เด็กอ่อน%')";
				else 
					$wf_qry .= "AND (WL.NAME LIKE '".$cat_list[$_GET['WLIST']]."%')";
			}
		$wf_qry .= (empty($_GET['YEAR']))?'':"AND WD.YEAR LIKE '".$_GET['YEAR']."'";
		$wf_qry .= " ORDER BY WL.NAME ASC";
		
		$wf_list = $this->welfare_list->get($wf_qry, true);
		$data['rs'] = $wf_list;
	
		$this->template->build('welfare/index2', $data);
	}


	public function export()
	{
		$cat_list = $this->cat_list;
				
				$data['main_list'] = $cat_list;
				//===== set year list group =====//
				$year_list = $this->welfare->get('SELECT YEAR FROM WELFARE_DATA GROUP BY YEAR ORDER BY YEAR DESC');
				for($i=0; $i<count($year_list); $i++) $data['year_list'][$year_list[$i]['year']] = $year_list[$i]['year'];
		
				$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
				//===== set year list group =====//
		
		
				if(@$_GET['WLIST'] != '') $cat_list = array($cat_list[$_GET['WLIST']]);
				
				
				foreach($cat_list as $cat_list_)
				{
					$qry_catlist = '';
						if($cat_list_ == 'อื่น ๆ')
						{
							for($i=0; $i<count($cat_list); $i++)
								{
									if($cat_list[$i] != 'อื่น ๆ')
										{
											if(@$cat_list[$i+1] && $i != 0) $qry_catlist .= 'AND ';
											$qry_catlist .= "NAME NOT LIKE '".$cat_list[$i]."%' ";
										} 
								}
						} else {
							$qry_catlist .= "(NAME LIKE'".$cat_list_."%'";
								if($cat_list_ == 'สถานสงเคราะห์เด็ก') $qry_catlist .= "OR NAME LIKE 'สถานสงเคราะห์เยาวชน%' AND NAME NOT LIKE 'สถานสงเคราะห์เด็กอ่อน%')";
								else $qry_catlist .= ')';
						}
					$rs_catlist = $this->welfare_list->where($qry_catlist)->get(false, true);
					$welfare_list[] = $rs_catlist;
				}		
				
				foreach($welfare_list as $key=>$rs)
				{
					$qry_data = 'SELECT SUM(TARGET) target, SUM(BALANCE) balance, SUM(ADMISSION) admission, SUM(DISTRIBUTION) distribution, SUM(REMAIN) remain, SUM(BUILD) build FROM WELFARE_DATA WHERE (';
					foreach($rs as $key2=>$rs2)
					{
						if($key2 != 0 && $key2-1 != count($rs)) $qry_data .= 'OR ';
						$qry_data .= "WLIST_ID LIKE '".$rs2['id']."' ";
					}
					$qry_data .= ')';
					
					//CONDITION SEARCH
					$_GET['WLIST'] = ((@!$_GET['WLIST'] && @$_GET['WLIST'] != 0) || @$_GET['WLIST'] == '')?NULL:$_GET['WLIST'];
					$_GET['YEAR'] = (@!$_GET['YEAR'])?$year_list[0]['year']:$_GET['YEAR'];
					$qry_data .= (@$_GET['YEAR'])?"AND YEAR LIKE '".$_GET['YEAR']."'":'';
		
					
					$wdata = $this->welfare->get($qry_data, true);
						$result[$key] = $wdata[0];
						$result[$key]['title'] = $cat_list[$key];
						
					foreach($data['main_list'] as $key2=>$list) if($list == $cat_list[$key]) $result[$key]['id'] = $key2;
				}
		
		$filename= "disabled_report_data_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$data['result'] = $result;	
		$this->load->view('welfare/export',$data);
	}

	public function export_2()
	{
		$cat_list = $this->cat_list;
		$data['main_list'] = $cat_list;

		//===== set year list group =====//
		$year_list = $this->welfare->get('SELECT YEAR FROM WELFARE_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++)
		{
			$data['year_list'][$year_list[$i]['year']] = $year_list[$i]['year'];
			if($i==0) $_GET['YEAR'] = (empty($_GET['YEAR']))?$data['year_list'][$year_list[$i]['year']]:$_GET['YEAR'];
		}

		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		
		//===== set year list group =====//
		
		
		$wf_qry = "SELECT WL.NAME title, WD.* FROM WELFARE_LIST WL JOIN WELFARE_DATA WD ON WL.ID = WD.WLIST_ID WHERE 1=1 ";
				
			if(@$cat_list[$_GET['WLIST']] == 'อื่น ๆ'){
				$wf_qry .= "AND (";
				foreach($cat_list as $key=>$rs)
				{
					$wf_qry .= ($key==0)?'':'AND ';
					$wf_qry .= "WL.NAME NOT LIKE '".$rs."%' ";
				}
				$wf_qry .= ") ";
			} else if(@$cat_list[$_GET['WLIST']]) {
				if($cat_list[$_GET['WLIST']] == 'สถานสงเคราะห์เด็ก') 
					$wf_qry .= "AND (WL.NAME LIKE '".$cat_list[$_GET['WLIST']]."%' OR WL.NAME LIKE 'สถานสงเคราะห์เยาวชน%' AND WL.NAME NOT LIKE 'สถานสงเคราะห์เด็กอ่อน%')";
				else 
					$wf_qry .= "AND (WL.NAME LIKE '".$cat_list[$_GET['WLIST']]."%')";
			}
		$wf_qry .= (empty($_GET['YEAR']))?'':"AND WD.YEAR LIKE '".$_GET['YEAR']."'";
		$wf_qry .= " ORDER BY WL.NAME ASC";
		
		$wf_list = $this->welfare_list->get($wf_qry, true);
		$result = $data['rs'] = $wf_list;
		
		$filename= "disabled_report_data_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$data['result'] = $result;	
		$this->load->view('welfare/export2',$data);
	}
	



}

