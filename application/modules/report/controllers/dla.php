<?php
class Dla extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('opt_model', 'opt');
    }
    
	/*
	 * ปัญหาเด็กและเยาวชนในท้องถิ่น
	 */
    public function child()
    {
    	$data['report_title'] = 'ปัญหาเด็กและเยาวชนในท้องถิ่น';
        $sql = "SELECT 
        SUM(T411_M) AS TOTAL411_M, SUM(T411_F) AS TOTAL411_F, (SUM(T411_M) + SUM(T411_F)) AS TOTAL411_S, 
        SUM(T412_M) AS TOTAL412_M, SUM(T412_F) AS TOTAL412_F, (SUM(T412_M) + SUM(T412_F)) AS TOTAL412_S, 
        SUM(T413_M) AS TOTAL413_M, SUM(T413_F) AS TOTAL413_F, (SUM(T413_M) + SUM(T413_F)) AS TOTAL413_S, 
        SUM(T414_M) AS TOTAL414_M, SUM(T414_F) AS TOTAL414_F, (SUM(T414_M) + SUM(T414_F)) AS TOTAL414_S, 
        SUM(T415_M) AS TOTAL415_M, SUM(T415_F) AS TOTAL415_F, (SUM(T415_M) + SUM(T415_F)) AS TOTAL415_S,
        SUM(T4161_M) AS TOTAL4161_M, SUM(T4161_F) AS TOTAL4161_F, (SUM(T4161_M) + SUM(T4161_F)) AS TOTAL4161_S,
        SUM(T4162_M) AS TOTAL4162_M, SUM(T4162_F) AS TOTAL4162_F, (SUM(T4162_M) + SUM(T4162_F)) AS TOTAL4162_S, 
        SUM(T4163_M) AS TOTAL4163_M, SUM(T4163_F) AS TOTAL4163_F, (SUM(T4163_M) + SUM(T4163_F)) AS TOTAL4163_S, 
        SUM(T4164_M) AS TOTAL4164_M, SUM(T4164_F) AS TOTAL4164_F, (SUM(T4164_M) + SUM(T4164_F)) AS TOTAL4164_S,  
        SUM(T417_M) AS TOTAL417_M, SUM(T417_F) AS TOTAL417_F, (SUM(T417_M) + SUM(T417_F)) AS TOTAL417_S, 
        SUM(T418_M) AS TOTAL418_M, SUM(T418_F) AS TOTAL418_F, (SUM(T418_M) + SUM(T418_F)) AS TOTAL418_S, 
        SUM(T419_M) AS TOTAL419_M, SUM(T419_F) AS TOTAL419_F, (SUM(T419_M) + SUM(T419_F)) AS TOTAL419_S, 
        SUM(T4110_M) AS TOTAL4110_M, SUM(T4110_F) AS TOTAL4110_F, (SUM(T4110_M) + SUM(T4110_F)) AS TOTAL4110_S 
        FROM FORM_ALL 
        WHERE 1=1";
        if(!empty($_GET['year'])) $sql .= " AND YEAR = ".$_GET['year'];
        if(!empty($_GET['province_id'])) $sql .= " AND PROVINCE_ID = ".$_GET['province_id'];
        if(!empty($_GET['amphur_id'])) $sql .= " AND AMPHUR_ID = ".$_GET['amphur_id'];
        if(!empty($_GET['opt'])) $sql .= " AND OPT_NAME = '".iconv('utf-8', 'tis-620', $_GET['opt'])."'";
        $data['rs'] = $this->db->getrow($sql);
        dbConvert($data['rs']);
     
     	if(!empty($_GET['export']))
     	{
     		header("Content-Type: application/vnd.ms-excel");
			header('Content-Disposition: attachment; filename="'.$data['report_title'].'.xls"');
			$this->load->view('dla/child', $data);
     	}
		else
		{
			$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        	$this->template->build('dla/child', $data);
		}
    }

	/*
	 * ปัญหาสตรีในท้องถิ่น
	 */
	public function women()
    {
    	$data['report_title'] = 'ปัญหาสตรีในท้องถิ่น';
        $sql = "SELECT 
        SUM(T431) AS TOTAL431, 
        SUM(T432) AS TOTAL432, 
        SUM(T433) AS TOTAL433 
        FROM FORM_ALL 
        WHERE 1=1";
        if(!empty($_GET['year'])) $sql .= " AND YEAR = ".$_GET['year'];
        if(!empty($_GET['province_id'])) $sql .= " AND PROVINCE_ID = ".$_GET['province_id'];
        if(!empty($_GET['amphur_id'])) $sql .= " AND AMPHUR_ID = ".$_GET['amphur_id'];
        if(!empty($_GET['opt'])) $sql .= " AND OPT_NAME = '".iconv('utf-8', 'tis-620', $_GET['opt'])."'";
        $data['rs'] = $this->db->getrow($sql);
        dbConvert($data['rs']);
     
     	if(!empty($_GET['export']))
     	{
     		header("Content-Type: application/vnd.ms-excel");
			header('Content-Disposition: attachment; filename="'.$data['report_title'].'.xls"');
			$this->load->view('dla/women', $data);
     	}
		else
		{
			$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        	$this->template->build('dla/women', $data);
		}
    }
    
    /*
	 * ปัญหาคนพิการในท้องถิ่น
	 */
	public function disabled()
    {
    	$data['report_title'] = 'ปัญหาคนพิการในท้องถิ่น';
        $sql = "SELECT 
        SUM(T452_M) AS TOTAL452_M, SUM(T452_F) AS TOTAL452_F, (SUM(T452_M) + SUM(T452_F)) AS TOTAL452_S, 
        SUM(T453_M) AS TOTAL453_M, SUM(T453_F) AS TOTAL453_F, (SUM(T453_M) + SUM(T453_F)) AS TOTAL453_S, 
        SUM(T454_M) AS TOTAL454_M, SUM(T454_F) AS TOTAL454_F, (SUM(T454_M) + SUM(T454_F)) AS TOTAL454_S 
        FROM FORM_ALL 
        WHERE 1=1";
        if(!empty($_GET['year'])) $sql .= " AND YEAR = ".$_GET['year'];
        if(!empty($_GET['province_id'])) $sql .= " AND PROVINCE_ID = ".$_GET['province_id'];
        if(!empty($_GET['amphur_id'])) $sql .= " AND AMPHUR_ID = ".$_GET['amphur_id'];
        if(!empty($_GET['opt'])) $sql .= " AND OPT_NAME = '".iconv('utf-8', 'tis-620', $_GET['opt'])."'";
        $data['rs'] = $this->db->getrow($sql);
        dbConvert($data['rs']);
     
     	if(!empty($_GET['export']))
     	{
     		header("Content-Type: application/vnd.ms-excel");
			header('Content-Disposition: attachment; filename="'.$data['report_title'].'.xls"');
			$this->load->view('dla/disabled', $data);
     	}
		else
		{
			$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        	$this->template->build('dla/disabled', $data);
		}
    }
    
    /*
	 * ปัญหาครอบครัวในท้องถิ่น
	 */
	public function family()
    {
    	$data['report_title'] = 'ปัญหาครอบครัวในท้องถิ่น';
        $sql = "SELECT 
        SUM(T421) AS TOTAL421, 
        SUM(T422) AS TOTAL422, 
        SUM(T423) AS TOTAL423, 
        SUM(T434) AS TOTAL424, 
        SUM(T425) AS TOTAL425 
        FROM FORM_ALL 
        WHERE 1=1";
        if(!empty($_GET['year'])) $sql .= " AND YEAR = ".$_GET['year'];
        if(!empty($_GET['province_id'])) $sql .= " AND PROVINCE_ID = ".$_GET['province_id'];
        if(!empty($_GET['amphur_id'])) $sql .= " AND AMPHUR_ID = ".$_GET['amphur_id'];
        if(!empty($_GET['opt'])) $sql .= " AND OPT_NAME = '".iconv('utf-8', 'tis-620', $_GET['opt'])."'";
        $data['rs'] = $this->db->getrow($sql);
        dbConvert($data['rs']);
     
     	if(!empty($_GET['export']))
     	{
     		header("Content-Type: application/vnd.ms-excel");
			header('Content-Disposition: attachment; filename="'.$data['report_title'].'.xls"');
			$this->load->view('dla/family', $data);
     	}
		else
		{
			$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        	$this->template->build('dla/family', $data);
		}
    }
    
    /*
	 * ปัญหาผู้สูงอายุในท้องถิ่น
	 */
	public function older()
    {
    	$data['report_title'] = 'ปัญหาผู้สูงอายุในท้องถิ่น';
        $sql = "SELECT 
        SUM(T441_M) AS TOTAL441_M, SUM(T441_F) AS TOTAL441_F, (SUM(T441_M) + SUM(T441_F)) AS TOTAL441_S, 
        SUM(T442_M) AS TOTAL442_M, SUM(T442_F) AS TOTAL442_F, (SUM(T442_M) + SUM(T442_F)) AS TOTAL442_S, 
        SUM(T443_M) AS TOTAL443_M, SUM(T443_F) AS TOTAL443_F, (SUM(T443_M) + SUM(T443_F)) AS TOTAL443_S, 
        SUM(T444_M) AS TOTAL444_M, SUM(T444_F) AS TOTAL444_F, (SUM(T444_M) + SUM(T444_F)) AS TOTAL444_S, 
        SUM(T445_M) AS TOTAL445_M, SUM(T445_F) AS TOTAL445_F, (SUM(T445_M) + SUM(T445_F)) AS TOTAL445_S, 
        SUM(T446_M) AS TOTAL446_M, SUM(T446_F) AS TOTAL446_F, (SUM(T446_M) + SUM(T446_F)) AS TOTAL446_S 
        FROM FORM_ALL 
        WHERE 1=1";
        if(!empty($_GET['year'])) $sql .= " AND YEAR = ".$_GET['year'];
        if(!empty($_GET['province_id'])) $sql .= " AND PROVINCE_ID = ".$_GET['province_id'];
        if(!empty($_GET['amphur_id'])) $sql .= " AND AMPHUR_ID = ".$_GET['amphur_id'];
        if(!empty($_GET['opt'])) $sql .= " AND OPT_NAME = '".iconv('utf-8', 'tis-620', $_GET['opt'])."'";
        $data['rs'] = $this->db->getrow($sql);
        dbConvert($data['rs']);
     
     	if(!empty($_GET['export']))
     	{
     		header("Content-Type: application/vnd.ms-excel");
			header('Content-Disposition: attachment; filename="'.$data['report_title'].'.xls"');
			$this->load->view('dla/older', $data);
     	}
		else
		{
			$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        	$this->template->build('dla/older', $data);
		}
    }
    
    /*
	 * ปัญหาด้านที่อยู่อาศัยและสิ่งแวดล้อมในท้องถิ่น
	 */
	public function issue1()
    {
    	$data['report_title'] = 'ปัญหาด้านที่อยู่อาศัยและสิ่งแวดล้อมในท้องถิ่น';
        $sql = "SELECT 
        SUM(T311) AS TOTAL311, 
        SUM(T312) AS TOTAL312, 
        SUM(T313) AS TOTAL313, 
        SUM(T314) AS TOTAL314  
        FROM FORM_ALL 
        WHERE 1=1";
        if(!empty($_GET['year'])) $sql .= " AND YEAR = ".$_GET['year'];
        if(!empty($_GET['province_id'])) $sql .= " AND PROVINCE_ID = ".$_GET['province_id'];
        if(!empty($_GET['amphur_id'])) $sql .= " AND AMPHUR_ID = ".$_GET['amphur_id'];
        if(!empty($_GET['opt'])) $sql .= " AND OPT_NAME = '".iconv('utf-8', 'tis-620', $_GET['opt'])."'";
        $data['rs'] = $this->db->getrow($sql);
        dbConvert($data['rs']);
     
     	if(!empty($_GET['export']))
     	{
     		header("Content-Type: application/vnd.ms-excel");
			header('Content-Disposition: attachment; filename="'.$data['report_title'].'.xls"');
			$this->load->view('dla/issue1', $data);
     	}
		else
		{
			$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        	$this->template->build('dla/issue1', $data);
		}
    }
    
    /*
	 * ปัญหาด้านสุขภาพอนามัยในท้องถิ่น
	 */
	public function issue2()
    {
    	$data['report_title'] = 'ปัญหาด้านสุขภาพอนามัยในท้องถิ่น';
        $sql = "SELECT 
        SUM(T321_M) AS TOTAL321_M, SUM(T321_F) AS TOTAL321_F, (SUM(T321_M) + SUM(T321_F)) AS TOTAL321_S,
        SUM(T322_M) AS TOTAL322_M, SUM(T322_F) AS TOTAL322_F, (SUM(T322_M) + SUM(T322_F)) AS TOTAL322_S,
        SUM(T323_M) AS TOTAL323_M, SUM(T323_F) AS TOTAL323_F, (SUM(T323_M) + SUM(T323_F)) AS TOTAL323_S,
        SUM(T324_M) AS TOTAL324_M, SUM(T324_F) AS TOTAL324_F, (SUM(T324_M) + SUM(T324_F)) AS TOTAL324_S,
        SUM(T325_M) AS TOTAL325_M, SUM(T325_F) AS TOTAL325_F, (SUM(T325_M) + SUM(T325_F)) AS TOTAL325_S,
        SUM(T326_M) AS TOTAL326_M, SUM(T326_F) AS TOTAL326_F, (SUM(T326_M) + SUM(T326_F)) AS TOTAL326_S,
        SUM(T327_M) AS TOTAL327_M, SUM(T327_F) AS TOTAL327_F, (SUM(T327_M) + SUM(T327_F)) AS TOTAL327_S
        FROM FORM_ALL 
        WHERE 1=1";
        if(!empty($_GET['year'])) $sql .= " AND YEAR = ".$_GET['year'];
        if(!empty($_GET['province_id'])) $sql .= " AND PROVINCE_ID = ".$_GET['province_id'];
        if(!empty($_GET['amphur_id'])) $sql .= " AND AMPHUR_ID = ".$_GET['amphur_id'];
        if(!empty($_GET['opt'])) $sql .= " AND OPT_NAME = '".iconv('utf-8', 'tis-620', $_GET['opt'])."'";
        $data['rs'] = $this->db->getrow($sql);
        dbConvert($data['rs']);
     
     	if(!empty($_GET['export']))
     	{
     		header("Content-Type: application/vnd.ms-excel");
			header('Content-Disposition: attachment; filename="'.$data['report_title'].'.xls"');
			$this->load->view('dla/issue2', $data);
     	}
		else
		{
			$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        	$this->template->build('dla/issue2', $data);
		}
    }
    
    /*
	 * ปัญหาด้านการศึกษาในท้องถิ่น
	 */
	public function issue3()
    {
    	$data['report_title'] = 'ปัญหาด้านการศึกษาในท้องถิ่น';
        $sql = "SELECT 
        SUM(T331_M) AS TOTAL331_M, SUM(T331_F) AS TOTAL331_F, (SUM(T331_M) + SUM(T331_F)) AS TOTAL331_S,
        SUM(T332_M) AS TOTAL332_M, SUM(T332_F) AS TOTAL332_F, (SUM(T332_M) + SUM(T332_F)) AS TOTAL332_S,
        SUM(T333_M) AS TOTAL333_M, SUM(T333_F) AS TOTAL333_F, (SUM(T333_M) + SUM(T333_F)) AS TOTAL333_S,
        SUM(T334_M) AS TOTAL334_M, SUM(T334_F) AS TOTAL334_F, (SUM(T334_M) + SUM(T334_F)) AS TOTAL334_S
        FROM FORM_ALL 
        WHERE 1=1";
        if(!empty($_GET['year'])) $sql .= " AND YEAR = ".$_GET['year'];
        if(!empty($_GET['province_id'])) $sql .= " AND PROVINCE_ID = ".$_GET['province_id'];
        if(!empty($_GET['amphur_id'])) $sql .= " AND AMPHUR_ID = ".$_GET['amphur_id'];
        if(!empty($_GET['opt'])) $sql .= " AND OPT_NAME = '".iconv('utf-8', 'tis-620', $_GET['opt'])."'";
        $data['rs'] = $this->db->getrow($sql);
        dbConvert($data['rs']);
     
     	if(!empty($_GET['export']))
     	{
     		header("Content-Type: application/vnd.ms-excel");
			header('Content-Disposition: attachment; filename="'.$data['report_title'].'.xls"');
			$this->load->view('dla/issue3', $data);
     	}
		else
		{
			$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        	$this->template->build('dla/issue3', $data);
		}
    }
    
    /*
	 * ปัญหาด้านการมีงานทำและรายได้ในท้องถิ่น
	 */
	public function issue4()
    {
    	$data['report_title'] = 'ปัญหาด้านการมีงานทำและรายได้ในท้องถิ่น';
        $sql = "SELECT 
        SUM(T341_M) AS TOTAL341_M, SUM(T341_F) AS TOTAL341_F, (SUM(T341_M) + SUM(T341_F)) AS TOTAL341_S,
        SUM(T342_M) AS TOTAL342_M, SUM(T342_F) AS TOTAL342_F, (SUM(T342_M) + SUM(T342_F)) AS TOTAL342_S,
        SUM(T343_M) AS TOTAL343_M, SUM(T343_F) AS TOTAL343_F, (SUM(T343_M) + SUM(T343_F)) AS TOTAL343_S
        FROM FORM_ALL 
        WHERE 1=1";
        if(!empty($_GET['year'])) $sql .= " AND YEAR = ".$_GET['year'];
        if(!empty($_GET['province_id'])) $sql .= " AND PROVINCE_ID = ".$_GET['province_id'];
        if(!empty($_GET['amphur_id'])) $sql .= " AND AMPHUR_ID = ".$_GET['amphur_id'];
        if(!empty($_GET['opt'])) $sql .= " AND OPT_NAME = '".iconv('utf-8', 'tis-620', $_GET['opt'])."'";
        $data['rs'] = $this->db->getrow($sql);
        dbConvert($data['rs']);
     
     	if(!empty($_GET['export']))
     	{
     		header("Content-Type: application/vnd.ms-excel");
			header('Content-Disposition: attachment; filename="'.$data['report_title'].'.xls"');
			$this->load->view('dla/issue4', $data);
     	}
		else
		{
			$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        	$this->template->build('dla/issue4', $data);
		}
    }
    
    /*
	 * ปัญหาด้านความไม่ปลอดภัยในชีวิตและทรัพย์สินในท้องถิ่น
	 */
	public function issue5()
    {
    	$data['report_title'] = 'ปัญหาด้านความไม่ปลอดภัยในชีวิตและทรัพย์สินในท้องถิ่น';
        $sql = "SELECT 
        SUM(T351_M) AS TOTAL351_M, SUM(T351_F) AS TOTAL351_F, (SUM(T351_M) + SUM(T351_F)) AS TOTAL351_S,
        SUM(T352_M) AS TOTAL352_M, SUM(T352_F) AS TOTAL352_F, (SUM(T352_M) + SUM(T352_F)) AS TOTAL352_S,
        SUM(T354_M) AS TOTAL354_M, SUM(T354_F) AS TOTAL354_F, (SUM(T354_M) + SUM(T354_F)) AS TOTAL354_S,
        SUM(T355_M) AS TOTAL355_M, SUM(T355_F) AS TOTAL355_F, (SUM(T355_M) + SUM(T355_F)) AS TOTAL355_S,
        SUM(T356_M) AS TOTAL356_M, SUM(T356_F) AS TOTAL356_F, (SUM(T356_M) + SUM(T356_F)) AS TOTAL356_S,
        SUM(T357_M) AS TOTAL357_M, SUM(T357_F) AS TOTAL357_F, (SUM(T357_M) + SUM(T357_F)) AS TOTAL357_S
        FROM FORM_ALL 
        WHERE 1=1";
        if(!empty($_GET['year'])) $sql .= " AND YEAR = ".$_GET['year'];
        if(!empty($_GET['province_id'])) $sql .= " AND PROVINCE_ID = ".$_GET['province_id'];
        if(!empty($_GET['amphur_id'])) $sql .= " AND AMPHUR_ID = ".$_GET['amphur_id'];
        if(!empty($_GET['opt'])) $sql .= " AND OPT_NAME = '".iconv('utf-8', 'tis-620', $_GET['opt'])."'";
        $data['rs'] = $this->db->getrow($sql);
        dbConvert($data['rs']);
     
     	if(!empty($_GET['export']))
     	{
     		header("Content-Type: application/vnd.ms-excel");
			header('Content-Disposition: attachment; filename="'.$data['report_title'].'.xls"');
			$this->load->view('dla/issue5', $data);
     	}
		else
		{
			$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        	$this->template->build('dla/issue5', $data);
		}
    }
    
    /*
	 * ปัญหาด้านวัฒนธรรมและจริยธรรมในท้องถิ่น
	 */
	public function issue6()
    {
    	$data['report_title'] = 'ปัญหาด้านวัฒนธรรมและจริยธรรมในท้องถิ่น';
        $sql = "SELECT 
        SUM(T361) AS TOTAL361, 
        SUM(T362) AS TOTAL362, 
        SUM(T363) AS TOTAL363
        FROM FORM_ALL 
        WHERE 1=1";
        if(!empty($_GET['year'])) $sql .= " AND YEAR = ".$_GET['year'];
        if(!empty($_GET['province_id'])) $sql .= " AND PROVINCE_ID = ".$_GET['province_id'];
        if(!empty($_GET['amphur_id'])) $sql .= " AND AMPHUR_ID = ".$_GET['amphur_id'];
        if(!empty($_GET['opt'])) $sql .= " AND OPT_NAME = '".iconv('utf-8', 'tis-620', $_GET['opt'])."'";
        $data['rs'] = $this->db->getrow($sql);
        dbConvert($data['rs']);
     
     	if(!empty($_GET['export']))
     	{
     		header("Content-Type: application/vnd.ms-excel");
			header('Content-Disposition: attachment; filename="'.$data['report_title'].'.xls"');
			$this->load->view('dla/issue6', $data);
     	}
		else
		{
			$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        	$this->template->build('dla/issue6', $data);
		}
    }
}