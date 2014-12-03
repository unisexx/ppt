<?php
Class Home extends  Public_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->template->title('รายงานองค์กรที่ได้รับการสนับสนุนเงินจากกองทุนส่งเสริมการจัดการสวัสดิการสังคมทั้งประเทศ ระบบฐานข้อมูลทางสังคม สป.พม.');
		$this->template->append_metadata( meta('keywords','ระบบฐานข้อมูลทางสังคม,ระบบฐานข้อมูลด้านสังคม,ฐานข้อมูลด้านสังคม,ฐานข้อมูลทางสังคม,กลุ่มเป้าหมาย,เชิงประเด็น,สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,พม.,สป.พม.,สป.,ข้อมูลด้านสังคม,ข้อมูลทางสังคม,ข้อมูลสังคม,องค์กรที่ได้รับการสนับสนุนจากกองทุนส่งเสริม,กองทุนส่งเสริมการจัดสวัสดิการสังคม,ข้อมูลกองทุนส่งเสริม,กองทุนสวัสดิการสังคม,สวัสดิการสังคม,องค์กรที่ได้รับการสนับสนุนเงิน'));
		$this->template->build('index');
	}
    
    public function download()
    {
        if(!empty($_GET['url']))
        {
            $this->load->helper('download');
            $data = file_get_contents($_GET['url']);
            $name = basename($_GET['url']).'.'.pathinfo($_GET['url'], PATHINFO_EXTENSION);
            force_download('sample.csv', $data); 
        }
    }
}