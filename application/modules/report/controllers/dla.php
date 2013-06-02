<?php
class Dla extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('opt_model', 'opt');
    }
    
    public function child()
    {
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
        
        if(!empty($_GET['province_id']) && !empty($_GET['amphur_id'])) $data['opt_option'] = $this->opt->get_option($_GET['province_id'], $_GET['amphur_id']);
        
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        $this->template->build('dla/child', $data);
    }
}