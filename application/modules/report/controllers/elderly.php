<?php 
//===== Ref:child/elderly =====//
class Elderly extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('elderlylist_model', 'elderly_list');
		$this->load->model('hf_elderly_model', 'elderly');
			$this->load->model('hf_elderlylist_model', 'elderly_list');
	}
	
	public function index()
	{
		$all_list = $this->elderly_list->limit(1000)->get();
		for($i=0; $i<count($all_list);$i++)
		{
			$cat_list[] = $all_list[$i]['name'];
		}
#		$cat_list = array("บ้านพักเด็กและครอบครัว", "ศูนย์สงเคราะห์และฝึกอาชีพเด็กและเยาวชน", "สถานคุ้มครองสวัสดิภาพเด็ก", "สถานพัฒนาและฟื้นฟูเด็ก", "สถานสงเคราะห์เด็กอ่อน", "สถานสงเคราะห์เด็ก");
	
		$condition = '';
		$condition = (@$_GET['YEAR'])?"AND YEAR LIKE '".$_GET['YEAR']."'":'';


		for($i=0; $i<count($all_list); $i++)
		{
			$sts_chk = 0;
			for($j=0; $j<count($cat_list) && $sts_chk == 0; $j++)
			{
				if(strstr($all_list[$i]['name'], $cat_list[$j]))
					{
						$tmp_ = $this->elderly->where("WLIST_ID LIKE '".$all_list[$i]['id']."' ".$condition)->get();
						for($k=0; $k<count($tmp_); $k++)
						{
							@$data['rs'][$j]['target'] += $tmp_[$k]['target'];
							@$data['rs'][$j]['balance'] += $tmp_[$k]['balance'];
							@$data['rs'][$j]['admission'] += $tmp_[$k]['admission'];
							@$data['rs'][$j]['distribution'] += $tmp_[$k]['distribution'];
							@$data['rs'][$j]['remain'] += $tmp_[$k]['remain'];
							@$data['rs'][$j]['build'] += $tmp_[$k]['build'];
						}
						$sts_chk++;
					}
			}
			if($sts_chk == 0)
				{
					$tmp_ = $this->elderly->where("WLIST_ID LIKE '".$all_list[$i]['id']."'".$condition)->get();
					for($k=0; $k<count($tmp_); $k++)
					{
						@$data['rs'][$j]['target'] += $tmp_[$k]['target'];
						@$data['rs'][$j]['balance'] += $tmp_[$k]['balance'];
						@$data['rs'][$j]['admission'] += $tmp_[$k]['admission'];
						@$data['rs'][$j]['distribution'] += $tmp_[$k]['distribution'];
						@$data['rs'][$j]['remain'] += $tmp_[$k]['remain'];
						@$data['rs'][$j]['build'] += $tmp_[$k]['build'];
					}
				}
		}
		
		$data['main_list'] = $cat_list;
		$data['main_list'][] = "อื่น ๆ";
		//===== set year list group =====//
		$year_list = $this->elderly->get('SELECT YEAR FROM HF_ELDERLY_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++)
		{
			$data['year_list'][$year_list[$i]['year']] = $year_list[$i]['year'];
		}
		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		//===== set year list group =====//
		
		$this->template->build('elderly/index', $data);

	}


	function report2()
	{
		$all_list = $this->elderly_list->limit(1000)->get();
		for($i=0; $i<count($all_list);$i++)
			{ $cat_list[] = $all_list[$i]['name']; }
		
		$wdata = array();
		$condition = '';
		$condition = (@$_GET['YEAR'])?"AND YEAR LIKE '".$_GET['YEAR']."'":'';


		for($i=0; $i<count($all_list); $i++)
		{
			if(@$_GET['WLIST'] == '')
			{
				$sts_chk = 0;
				for($j=0; $j<count($cat_list) && $sts_chk == 0; $j++)
				{
					if(strstr($all_list[$i]['name'], $cat_list[$j]))
						{
							$tmp_ = $this->elderly->where("WLIST_ID LIKE '".$all_list[$i]['id']."' ".$condition)->get();
							for($k=0; $k<count($tmp_); $k++)
							{
								$wdata[] = $tmp_[$k]['id'];
							}
							$sts_chk++;
						}
				}
			} else {
				$sts_chk = 0;
				$j = $_GET['WLIST'];
					if($cat_list[$j] == 'สถานสงเคราะห์เด็ก') {
						if((strstr($all_list[$i]['name'], $cat_list[$j])) && !strstr($all_list[$i]['name'], $cat_list[$j-1])) 
							{
								$tmp_ = $this->elderly->where("WLIST_ID LIKE '".$all_list[$i]['id']."' ".$condition)->get();
								for($k=0; $k<count($tmp_); $k++)
								{
									$wdata[] = $tmp_[$k]['id'];
								}
								$sts_chk++;
							}
					} else {
						if(strstr($all_list[$i]['name'], $cat_list[$j]))
							{
								$tmp_ = $this->elderly->where("WLIST_ID LIKE '".$all_list[$i]['id']."' ".$condition)->get();
								for($k=0; $k<count($tmp_); $k++)
								{
									$wdata[] = $tmp_[$k]['id'];
								}
								$sts_chk++;
							}
					}
			}
		}
		 
		sort($wdata);
		$data['rs'] = $wdata;		
		$data['main_list'] = $cat_list;
		$data['main_list'][] = "อื่น ๆ";
		//===== set year list group =====//
		$year_list = $this->elderly->get('SELECT YEAR FROM HF_ELDERLY_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++)
		{
			$data['year_list'][$year_list[$i]['year']] = $year_list[$i]['year'];
		}
		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		//===== set year list group =====//
			
		$this->template->build('elderly/index2', $data);
	}

	function export_index($status=FALSE)
	{
		$data[1] = 1;
		if($status!='print')
		{
			$filename= "elderly_report_data_".date("Y-m-d_H_i_s").".xls";
			header("Content-Disposition: attachment; filename=".$filename);
			
			logs('ดาวน์โหลดข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์');
		} else {
			
			?><script>window.print();</script><?
			logs('พิมพ์ข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์');
		}
		?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?
		
		
			//===== set year list group =====//
		$year_list = $this->elderly->get('SELECT YEAR FROM elderly_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++)
		{
			$data['year_list'][] = $year_list[$i]['year'];
		}
		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		//===== set year list group =====//
		
		
		//===== elderly list group =====//
		$data['list'] = $this->elderly_list->limit(100)->get('SELECT * FROM elderly_LIST WHERE 1=1 ORDER BY NAME ASC ');
		for($i=0; $i<count($data['list']); $i++)
		{


			$exp_list = explode('จังหวัด', $data['list'][$i]['name']);
			if(!@$exp_list[1]) { $exp_list = explode('ภาค', $data['list'][$i]['name']);}
			if(!@$exp_list[1]) { $exp_list = explode('บ้าน', $data['list'][$i]['name']); }
			if(!@$exp_list[1]) { $exp_list = explode('สถานสงเคราะห์เด็กหญิง', $data['list'][$i]['name']); $cut_word = 'สถานสงเคราะห์เด็กหญิง'; }
			if(!@$exp_list[1]) { $exp_list = explode('สถานสงเคราะห์เด็กอ่อน', $data['list'][$i]['name']); $cut_word = 'สถานสงเคราะห์เด็กอ่อน'; }
			$exp_list[0] = ($exp_list[0] == '')?@$cut_word:$exp_list[0];
			
			if(@$exp_list[1])
			{
				if($exp_list[0] == '') { $exp_list[0] = $data['list'][$i]['name']; }
				if(@$main_list)
				{
					if(!in_array($exp_list[0], $main_list)) { $main_list[] = $exp_list[0]; }
					else { $exp_list[0]; }
				} 
				else { $main_list[] = $exp_list[0]; }
			}
		}
		$data['main_list'] = $main_list;
		$wlist = @$data['main_list'][$_GET['WLIST']];
		//===== elderly list group =====//

				
		$data['sql'] = 'SELECT * FROM elderly_LIST WHERE 1=1 ';
			$data['sql'] .= (@$wlist)?"AND NAME LIKE '%".$wlist."%' ":'';
		$data['sql'] .= 'ORDER BY NAME ASC';
		unset($data['list']);
		
		$data['list'] = $this->elderly_list->get($data['sql']);
		
		logs('พิมพ์ข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์');
		$this->load->view('elderly/export',$data);
	}

	function export_index2($status=FALSE)
	{
		if($status!='print')
		{
			$filename= "elderly_report2_data_".date("Y-m-d_H_i_s").".xls";
			header("Content-Disposition: attachment; filename=".$filename);
			
			logs('ดาวน์โหลดข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์');
		} else {
			?><script>window.print();</script><?
			logs('พิมพ์ข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์');
		}
		?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?
		
		
			//===== set year list group =====//
		$year_list = $this->elderly->get('SELECT YEAR FROM elderly_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++)
		{
			$data['year_list'][] = $year_list[$i]['year'];
		}
		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		//===== set year list group =====//
		
		//===== elderly list group =====//
		$data['list'] = $this->elderly_list->limit(100)->get('SELECT * FROM elderly_LIST WHERE 1=1 ORDER BY NAME ASC ');
		for($i=0; $i<count($data['list']); $i++)
		{
			$exp_list = explode('จังหวัด', $data['list'][$i]['name']);
			if(!@$exp_list[1]) { $exp_list = explode('ภาค', $data['list'][$i]['name']);}
			if(!@$exp_list[1]) { $exp_list = explode('บ้าน', $data['list'][$i]['name']); }
			if(!@$exp_list[1]) { $exp_list = explode('สถานสงเคราะห์เด็กหญิง', $data['list'][$i]['name']); $cut_word = 'สถานสงเคราะห์เด็กหญิง'; }
			if(!@$exp_list[1]) { $exp_list = explode('สถานสงเคราะห์เด็กอ่อน', $data['list'][$i]['name']); $cut_word = 'สถานสงเคราะห์เด็กอ่อน'; }
			$exp_list[0] = ($exp_list[0] == '')?@$cut_word:$exp_list[0];
			
			if(@$exp_list[1])
			{
				if($exp_list[0] == '') { $exp_list[0] = $data['list'][$i]['name']; }
				if(@$main_list)
				{
					if(!in_array($exp_list[0], $main_list)) { $main_list[] = $exp_list[0]; }
					else { $exp_list[0]; }
				} 
				else { $main_list[] = $exp_list[0]; }
			}
		}
		$data['main_list'] = $main_list;
		$wlist = @$data['main_list'][$_GET['WLIST']];
		//===== elderly list group =====//

		$this->load->view('elderly/export2', $data);
	}

}
