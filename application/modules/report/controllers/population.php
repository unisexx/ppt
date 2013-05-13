<?php
class Population extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $sql = 'SELECT 
         (((SUM(CHILD_TOTAL) + SUM(OLD_TOTAL))/SUM(YOUNG_TOTAL))*100) AS TOTAL,
         ((SUM(CHILD_TOTAL)/SUM(YOUNG_TOTAL))*100) AS TOTAL_YOUNG,
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
        GROUP BY YEAR_DATA';
        $data['result'] = $this->db->getarray($sql);
        dbConvert($data['result']);
        $this->template->build('population/index', $data);
    }
}
