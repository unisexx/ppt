<?php
class Population extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function summary_rate()
    {
        $province = (empty($_GET['province_id'])) ? '' : ' and province_id = '.$_GET['province_id'];
        $sql = 'SELECT 
         POPULATION.YEAR_DATA,
         (SUM(SUM_MALE)) AS TOTAL_MALE,
         (SUM(SUM_FEMALE)) AS TOTAL_FEMALE         
        FROM POPULATION               
        WHERE POPULATION.YEAR_DATA BETWEEN TO_NUMBER((EXTRACT(YEAR FROM SYSDATE)))+538 AND TO_NUMBER((EXTRACT(YEAR FROM SYSDATE)))+543 
        AND (POPULATION.AMPHUR_ID IS NULL OR POPULATION.AMPHUR_ID = 0) '.$province.' 
        GROUP BY YEAR_DATA 
        ORDER BY YEAR_DATA DESC';
        $data['result'] = $this->db->getarray($sql);
        dbConvert($data['result']);
        $this->template->build('population/summary', $data);
    }
	
	public function summary_rate_export()
    {
    	$filename= "pop_summary_data_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);
        $province = (empty($_GET['province_id'])) ? '' : ' and province_id = '.$_GET['province_id'];
        $sql = 'SELECT 
         POPULATION.YEAR_DATA,
         (SUM(SUM_MALE)) AS TOTAL_MALE,
         (SUM(SUM_FEMALE)) AS TOTAL_FEMALE         
        FROM POPULATION               
        WHERE POPULATION.YEAR_DATA BETWEEN TO_NUMBER((EXTRACT(YEAR FROM SYSDATE)))+538 AND TO_NUMBER((EXTRACT(YEAR FROM SYSDATE)))+543 
        AND (POPULATION.AMPHUR_ID IS NULL OR POPULATION.AMPHUR_ID = 0) '.$province.' 
        GROUP BY YEAR_DATA 
        ORDER BY YEAR_DATA DESC';
        $data['result'] = $this->db->getarray($sql);
        dbConvert($data['result']);
        $this->load->view('population/summary_export', $data);
    }

	public function summary_rate_print()
    {
        $province = (empty($_GET['province_id'])) ? '' : ' and province_id = '.$_GET['province_id'];
        $sql = 'SELECT 
         POPULATION.YEAR_DATA,
         (SUM(SUM_MALE)) AS TOTAL_MALE,
         (SUM(SUM_FEMALE)) AS TOTAL_FEMALE         
        FROM POPULATION               
        WHERE POPULATION.YEAR_DATA BETWEEN TO_NUMBER((EXTRACT(YEAR FROM SYSDATE)))+538 AND TO_NUMBER((EXTRACT(YEAR FROM SYSDATE)))+543 
        AND (POPULATION.AMPHUR_ID IS NULL OR POPULATION.AMPHUR_ID = 0) '.$province.' 
        GROUP BY YEAR_DATA 
        ORDER BY YEAR_DATA DESC';
        $data['result'] = $this->db->getarray($sql);
        dbConvert($data['result']);
        $this->load->view('population/summary_print', $data);
    }
    
    public function burden_rate()
    {
        $province = (empty($_GET['province_id'])) ? '' : ' and province_id = '.$_GET['province_id'];
        $sql = 'SELECT 
         POPULATION.YEAR_DATA,
         (((SUM(CHILD_TOTAL) + SUM(OLD_TOTAL))/SUM(YOUNG_TOTAL))*100) AS TOTAL,
         ((SUM(CHILD_TOTAL)/SUM(YOUNG_TOTAL))*100) AS TOTAL_CHILD,
         ((SUM(OLD_TOTAL)/SUM(YOUNG_TOTAL))*100) AS TOTAL_OLD
        FROM POPULATION
        
        /* CHILD */
        LEFT JOIN (
            SELECT PID, SUM(NUNIT) AS CHILD_TOTAL
            FROM POPULATION_DETAIL
          WHERE AGE_RANGE_CODE BETWEEN 1 AND 15
          OR AGE_RANGE_CODE BETWEEN 103 AND 117
          GROUP BY PID
        ) UNIT_CHILD ON UNIT_CHILD.PID = POPULATION.ID
        
        /* OLD */
        LEFT JOIN (
            SELECT PID, SUM(NUNIT) AS OLD_TOTAL
            FROM POPULATION_DETAIL
          WHERE AGE_RANGE_CODE BETWEEN 61 AND 102
          OR AGE_RANGE_CODE BETWEEN 163 AND 204
          GROUP BY PID
        ) UNIT_OLD ON UNIT_OLD.PID = POPULATION.ID
        
        /* YOUNG */
        LEFT JOIN (
            SELECT PID, SUM(NUNIT) AS YOUNG_TOTAL
            FROM POPULATION_DETAIL
          WHERE AGE_RANGE_CODE BETWEEN 16 AND 60
          OR AGE_RANGE_CODE BETWEEN 118 AND 162
          GROUP BY PID
        ) UNIT_YOUNG ON UNIT_YOUNG.PID = POPULATION.ID
        
        WHERE POPULATION.YEAR_DATA BETWEEN TO_NUMBER((EXTRACT(YEAR FROM SYSDATE)))+538 AND TO_NUMBER((EXTRACT(YEAR FROM SYSDATE)))+543 
        AND (POPULATION.AMPHUR_ID IS NULL OR POPULATION.AMPHUR_ID = 0) '.$province.' 
        GROUP BY YEAR_DATA 
        ORDER BY YEAR_DATA DESC';
        $data['result'] = $this->db->getarray($sql);
        dbConvert($data['result']);
        $this->template->build('population/burden', $data);
    }

	public function burden_rate_export()
    {
    	$filename= "burden_pop_summary_data_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);
        $province = (empty($_GET['province_id'])) ? '' : ' and province_id = '.$_GET['province_id'];
		$data['province_name'] = @$_GET['province_id']!='' ? $this->province->select("province")->where("id=".$_GET['province_id'])->get_one() : "ทุกจังหวัด";
        $sql = 'SELECT 
         POPULATION.YEAR_DATA,
         (((SUM(CHILD_TOTAL) + SUM(OLD_TOTAL))/SUM(YOUNG_TOTAL))*100) AS TOTAL,
         ((SUM(CHILD_TOTAL)/SUM(YOUNG_TOTAL))*100) AS TOTAL_CHILD,
         ((SUM(OLD_TOTAL)/SUM(YOUNG_TOTAL))*100) AS TOTAL_OLD
        FROM POPULATION
        
        /* CHILD */
        LEFT JOIN (
            SELECT PID, SUM(NUNIT) AS CHILD_TOTAL
            FROM POPULATION_DETAIL
          WHERE AGE_RANGE_CODE BETWEEN 1 AND 15
          OR AGE_RANGE_CODE BETWEEN 103 AND 117
          GROUP BY PID
        ) UNIT_CHILD ON UNIT_CHILD.PID = POPULATION.ID
        
        /* OLD */
        LEFT JOIN (
            SELECT PID, SUM(NUNIT) AS OLD_TOTAL
            FROM POPULATION_DETAIL
          WHERE AGE_RANGE_CODE BETWEEN 61 AND 102
          OR AGE_RANGE_CODE BETWEEN 163 AND 204
          GROUP BY PID
        ) UNIT_OLD ON UNIT_OLD.PID = POPULATION.ID
        
        /* YOUNG */
        LEFT JOIN (
            SELECT PID, SUM(NUNIT) AS YOUNG_TOTAL
            FROM POPULATION_DETAIL
          WHERE AGE_RANGE_CODE BETWEEN 16 AND 60
          OR AGE_RANGE_CODE BETWEEN 118 AND 162
          GROUP BY PID
        ) UNIT_YOUNG ON UNIT_YOUNG.PID = POPULATION.ID
        
        WHERE POPULATION.YEAR_DATA BETWEEN TO_NUMBER((EXTRACT(YEAR FROM SYSDATE)))+538 AND TO_NUMBER((EXTRACT(YEAR FROM SYSDATE)))+543 
        AND (POPULATION.AMPHUR_ID IS NULL OR POPULATION.AMPHUR_ID = 0) '.$province.' 
        GROUP BY YEAR_DATA 
        ORDER BY YEAR_DATA DESC';
        $data['result'] = $this->db->getarray($sql);
        dbConvert($data['result']);
        $this->load->view('population/burden_export', $data);
    }

	public function burden_rate_print()
    {
        $province = (empty($_GET['province_id'])) ? '' : ' and province_id = '.$_GET['province_id'];
		$data['province_name'] = @$_GET['province_id']!='' ? $this->province->select("province")->where("id=".$_GET['province_id'])->get_one() : "ทุกจังหวัด";
        $sql = 'SELECT 
         POPULATION.YEAR_DATA,
         (((SUM(CHILD_TOTAL) + SUM(OLD_TOTAL))/SUM(YOUNG_TOTAL))*100) AS TOTAL,
         ((SUM(CHILD_TOTAL)/SUM(YOUNG_TOTAL))*100) AS TOTAL_CHILD,
         ((SUM(OLD_TOTAL)/SUM(YOUNG_TOTAL))*100) AS TOTAL_OLD
        FROM POPULATION
        
        /* CHILD */
        LEFT JOIN (
            SELECT PID, SUM(NUNIT) AS CHILD_TOTAL
            FROM POPULATION_DETAIL
          WHERE AGE_RANGE_CODE BETWEEN 1 AND 15
          OR AGE_RANGE_CODE BETWEEN 103 AND 117
          GROUP BY PID
        ) UNIT_CHILD ON UNIT_CHILD.PID = POPULATION.ID
        
        /* OLD */
        LEFT JOIN (
            SELECT PID, SUM(NUNIT) AS OLD_TOTAL
            FROM POPULATION_DETAIL
          WHERE AGE_RANGE_CODE BETWEEN 61 AND 102
          OR AGE_RANGE_CODE BETWEEN 163 AND 204
          GROUP BY PID
        ) UNIT_OLD ON UNIT_OLD.PID = POPULATION.ID
        
        /* YOUNG */
        LEFT JOIN (
            SELECT PID, SUM(NUNIT) AS YOUNG_TOTAL
            FROM POPULATION_DETAIL
          WHERE AGE_RANGE_CODE BETWEEN 16 AND 60
          OR AGE_RANGE_CODE BETWEEN 118 AND 162
          GROUP BY PID
        ) UNIT_YOUNG ON UNIT_YOUNG.PID = POPULATION.ID
        
        WHERE POPULATION.YEAR_DATA BETWEEN TO_NUMBER((EXTRACT(YEAR FROM SYSDATE)))+538 AND TO_NUMBER((EXTRACT(YEAR FROM SYSDATE)))+543 
        AND (POPULATION.AMPHUR_ID IS NULL OR POPULATION.AMPHUR_ID = 0) '.$province.' 
        GROUP BY YEAR_DATA 
        ORDER BY YEAR_DATA DESC';
        $data['result'] = $this->db->getarray($sql);
        dbConvert($data['result']);
        $this->load->view('population/burden_print', $data);
    }

	public function age_rate()
    {
    	$data ='';
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        $this->template->build('population/age', $data);
    }
	public function age_rate_export()
    {
    	$data =''; 
    	$filename= "age_pop_summary_data_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);
        $this->load->view('population/age_export', $data);
    }
	public function age_rate_print()
    {
    	$data ='';
        $this->load->view('population/age_print', $data);
    }
}