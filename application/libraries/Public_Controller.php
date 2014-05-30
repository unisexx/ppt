<?php
class Public_Controller extends Controller
{
	function __construct()
	{
		parent::__construct();	
		
		// check login
		//if(!is_login()) redirect('user/inc_index');
		
		// set theme
		$this->template->set_theme('ppt');
		
		// set layout
		$this->template->set_layout('layout');
		
		// set title
		$this->template->title('ระบบฐานข้อมูลทางสังคม สป.พม.');
		
		// Set js
		$this->template->append_metadata(js_notify());
		
		// Set language
		$this->lang->load('admin');
        $this->load->model('menu_model', 'list_menu');
		
		// Set Keywords , Description
		$this->template->append_metadata( meta('keywords','ระบบฐานข้อมูลทางสังคม,ระบบฐานข้อมูลด้านสังคม,ฐานข้อมูลด้านสังคม,ฐานข้อมูลทางสังคม,กลุ่มเป้าหมาย,เชิงประเด็น,สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,เด็กและเยาวชน,เด็ก,เยาวชน,สตรี,คนพิการ,ครอบครัว,ผู้สูงอายุ,ผู้ด้อยโอกาส,พม.,สป.พม.,สป.'));
		$this->template->append_metadata( meta('description','เว็บไซต์ระบบฐานข้อมูลทางสังคม,ระบบฐานข้อมูลด้านสังคม,ฐานข้อมูลด้านสังคม,ฐานข้อมูลทางสังคม,กลุ่มเป้าหมาย,เชิงประเด็น,สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์,เด็กและเยาวชน,เด็ก,เยาวชน,สตรี,คนพิการ,ครอบครัว,ผู้สูงอายุ,ผู้ด้อยโอกาส,พม.,สป.พม.,สป.'));
	}
}
?>