<?php 
class family extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model('family_model','family');
		$this->load->model('family_key_model','family_key');
		$this->load->model('info_model','info');
		$this->load->model('family_report_key_model','family_report_key');
		$this->load->model('province_model','province');
	}
	
	public function index($mode=false)
	{
		//$this->db->debug=true;
		$data['keydata'] = @$_GET['keydata'] == '' ? 1 : $_GET['keydata'];
		$condition = " 1 = 1 ";				
		$family_key = $this->family_report_key->get_row($data['keydata']);
		$data['family_key'] = $family_key;		
		$condition.= " AND ID IN (".$family_key['keyid'].")";
		$result = $this->family_key->where($condition)->order_by('id','asc')->get(FALSE,TRUE);
		//$data['value'] = $this->family->select(' SUM(PASS)SPASS, SUM(PERCENTAGE)SPERCENTAGE, SUM(TARGET)STARGET, SUM(LOWER_TARGET)SLOWER_TARGET
//,SUM(EDIT)SEDIT ')->where($condition)->get_row();
		
		$data['province_name'] = @$_GET['province_id']!='' ? $this->province->select("province")->where("id=".$_GET['province_id'])->get_one() : "ทุกจังหวัด";
		$i=0;
		foreach($result as $item):
			$value_condition = " 1=1 ";
		    $value_condition .= @$_GET['year_data']!='' ? " AND YEAR_DATA=".@$_GET['year_data'] : '';
		    $value_condition .= @$_GET['province_id']!='' ? " AND province_id=".@$_GET['province_id'] : '';
		    $value_condition .= " AND KEY_ID =".$item['id'];
			$value[$i]['keyid'] = $item['id'];
			$value[$i]['title'] = $item['title'];
			$value[$i]['nopass'] = $this->family->select(" SUM(EDIT)as SEDIT ")->where($value_condition)->get_one();
			$value[$i]['pass'] = $this->family->select(" SUM(PASS)as SPASS ")->where($value_condition)->get_one();
			$value[$i]['edit'] =  $this->family->select(" SUM(EDIT)as SEDIT ")->where($value_condition)->get_one();
			$value[$i]['target'] = $this->family->select(" max(target)as target ")->where($value_condition)->get_one();
			$value[$i]['total'] = $value[$i]['nopass'] + $value[$i]['pass'];
			$value[$i]['p_nopass'] = $value[$i]['nopass'] > 0 ? ($value[$i]['nopass']/$value[$i]['total'])*100 : 0;
			$value[$i]['p_pass'] =  $value[$i]['pass'] > 0 ? ($value[$i]['pass']/$value[$i]['total'])*100 : 0;			
			$i++;
		endforeach;
		$data['value'] = $value;
		switch($mode){
			case 'export':
				$filename= "family_summary_data_".date("Y-m-d_H_i_s").".xls";
				header("Content-Disposition: attachment; filename=".$filename);
				$this->load->view('family/export',$data);
			break;
			case 'print':
				$this->load->view('family/print',$data);
			break;
			default:
				
				$this->template->title('รายงานตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) ระบบฐานข้อมูลทางสังคม สป.พม.');
				$this->template->append_metadata( meta('keywords','ระบบฐานข้อมูลทางสังคม,ระบบฐานข้อมูลด้านสังคม,ฐานข้อมูลด้านสังคม,ฐานข้อมูลทางสังคม,กลุ่มเป้าหมาย,เชิงประเด็น,สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,พม.,สป.พม.,สป.,ข้อมูลด้านสังคม,ข้อมูลทางสังคม,ข้อมูลสังคม,ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ.),ตัวชี้วัดความจำเป็นขั้นพื้นฐาน,จปฐ,จปฐ.,ตัวชี้วัด,ผ่านเกณฑ์,กรมพัฒนาชุมชน กระทรวงมหาดไทย,กรมพัฒนาชุมชน,กระทรวงมหาดไทย,พช.,พช'));
				
				$this->template->build('family/index',$data);
			break;
		}
	}	
}
?>