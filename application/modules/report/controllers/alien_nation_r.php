<?php
Class Alien_nation_r extends Public_Controller{
	
	function __construct(){
		parent::__construct();
        $this->load->model('alien_nation_model', 'opt');
	}
	

	
	function index()
	{
/*	    $where = '';
        if(!empty($_GET))
        {
            
            if(!empty($_GET['year'])) $where .= " HAVING ALIEN_YEAR = '".$_GET['year']."' ";
        }
		
        $sql = 'SELECT
Sum(ALIEN_SUM) AS A_SUM,
Sum(ALIEN_MALE) AS S_MALE,
Max(ALIEN_FEMALE) AS S_FEMALE,
Sum(ALIEN_SUM_IN) AS S_IN,
Sum(ALIEN_SUM_OUT) AS S_OUT,
ALIEN_YEAR AS S_YEAR
FROM
ALIEN
GROUP BY
ALIEN_YEAR '.$where.'
ORDER BY
S_YEAR DESC';


		
        $data['result'] = $this->opt->get($sql);
        $data['pagination'] = $this->opt->pagination;*/
		
		$data['kenku']='-_-';
		
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('alien_nation/basic4', $data);
	}
	
	
	function alien_nation_report()
	{
	    $where = '';
        if(!empty($_GET))
        {
            
            if(!empty($_GET['year'])) $where .= ' AND ALIEN_NATION.ALIEN_YEAR = '.$_GET['year'];
        }
		
        $sql = 'SELECT *
			FROM
			ALIEN_NATION 
		WHERE 1=1 '.$where.' 
        ORDER BY ALIEN_NATION.ID ASC';
		
		//$sql = 'SELECT DISTINCT(ALIEN_NATION) from ALIEN_NATION WHERE 1=1 '.$where.' ORDER BY ALIEN_NATION ASC '; 
		
        $data['result'] = $this->opt->get($sql,TRUE);
        $data['pagination'] = $this->opt->pagination;
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->append_metadata('<link href="media/css/style.css" rel="stylesheet">');
		$this->template->build('alien_nation/basic4_1', $data);	
	}


	function basic4_export()
	{
		
		$where = '';
        if(!empty($_GET))
        {
            
            if(!empty($_GET['year'])) $where .= " HAVING ALIEN_YEAR = '".$_GET['year']."' ";
        }
		
        $sql = 'SELECT
		Sum(ALIEN_SUM) AS A_SUM,
		Sum(ALIEN_MALE) AS S_MALE,
		Max(ALIEN_FEMALE) AS S_FEMALE,
		Sum(ALIEN_SUM_IN) AS S_IN,
		Sum(ALIEN_SUM_OUT) AS S_OUT,
		ALIEN_YEAR AS S_YEAR
		FROM
		ALIEN
		GROUP BY
		ALIEN_YEAR '.$where.'
		ORDER BY
		S_YEAR DESC';
		
		$data['result'] = $this->opt->get($sql);
		$this->load->view('alien_nation/basic4_export',$data);
	}
	
	function basic4_print()
	{
		
		$where = '';
        if(!empty($_GET))
        {
            
            if(!empty($_GET['year'])) $where .= " HAVING ALIEN_YEAR = '".$_GET['year']."' ";
        }
		
        $sql = 'SELECT
		Sum(ALIEN_SUM) AS A_SUM,
		Sum(ALIEN_MALE) AS S_MALE,
		Max(ALIEN_FEMALE) AS S_FEMALE,
		Sum(ALIEN_SUM_IN) AS S_IN,
		Sum(ALIEN_SUM_OUT) AS S_OUT,
		ALIEN_YEAR AS S_YEAR
		FROM
		ALIEN
		GROUP BY
		ALIEN_YEAR '.$where.'
		ORDER BY
		S_YEAR DESC';
		
		$data['result'] = $this->opt->get($sql);
		$this->load->view('alien_nation/basic4_print',$data);	
	}

	
	function alien_nation_export($year = null)
	{
		
		$where = '';
         
            if($year!="") $where .= ' AND ALIEN_NATION.ALIEN_YEAR = '.$year;
        
		
        $sql = 'SELECT *
			FROM
			ALIEN_NATION 
		WHERE 1=1 '.$where.' 
        ORDER BY ALIEN_NATION.ID ASC';
        $data['result'] = $this->opt->get($sql,TRUE);
		
		$data['year'] = $year;

		//$this->template->build('alien_nation/basic4_1_export', $data);
		
		$this->load->view('alien_nation/basic4_1_export',$data);	
	}
	
	function alien_nation_print($year = null)
	{
		
		$where = '';
         
            if($year!="") $where .= ' AND ALIEN_NATION.ALIEN_YEAR = '.$year;
        
		
        $sql = 'SELECT *
			FROM
			ALIEN_NATION 
		WHERE 1=1 '.$where.' 
        ORDER BY ALIEN_NATION.ID ASC';
		
		$data['year'] = $year;
        $data['result'] = $this->opt->get($sql,TRUE);

		$this->template->build('alien_nation/basic4_1_print', $data);	
	}

}
?>