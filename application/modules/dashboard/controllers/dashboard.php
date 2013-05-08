<?php
class Dashboard extends Public_Controller
{
    public function index()
    {
        $this->template->build('index');
    }
    
    public function chart_1()
    {
        
    }
    
    /*
     * แนวโน้มประชากรสูงอายุ
     */
    public function chart_2()
    {   
        $sql = 'SELECT POPULATION.YEAR_DATA AS YEAR,
        SUM(UNIT_M.TOTAL) AS M,
        SUM(UNIT_F.TOTAL) AS F
        
        FROM POPULATION
        
        LEFT JOIN (
        SELECT PID, SUM(NUNIT) AS TOTAL
        FROM POPULATION_DETAIL
        WHERE AGE_RANGE_CODE BETWEEN 61 AND 102
        GROUP BY PID
        ) UNIT_M ON UNIT_M.PID = POPULATION."ID"
        
        LEFT JOIN (
        SELECT PID, SUM(NUNIT) AS TOTAL
        FROM POPULATION_DETAIL
        WHERE AGE_RANGE_CODE BETWEEN 163 AND 204
        GROUP BY PID
        ) UNIT_F ON UNIT_F.PID = POPULATION."ID"
        
        
        WHERE POPULATION.YEAR_DATA BETWEEN TO_NUMBER((EXTRACT(YEAR FROM SYSDATE)))+538 AND TO_NUMBER((EXTRACT(YEAR FROM SYSDATE)))+543 
        AND (POPULATION.AMPHUR_ID IS NULL OR POPULATION.AMPHUR_ID = 0)
        
        GROUP BY POPULATION.YEAR_DATA
        
        ORDER BY POPULATION.YEAR_DATA';
        $result = $this->db->getarray($sql);
        dbConvert($result);
            
        if(!empty($_GET['test']))
        {
            $result = array();
            for($year=2551;$year<=2555;$year++)
            {
                $result[] = array('year' => $year, 'm' => rand(10000, 99999), 'f' => rand(10000, 99999));
            }
        }    
            
        $year = array();
        $data_m = array();
        $data_f = array();    
        foreach($result as $item)
        {
            $year[] = $item['year'];
            $data_m[] = intval($item['m']);
            $data_f[] = intval($item['f']);
        }
        
        header("content-type: application/json"); 
        $array = array(
            
            'chart' => array(
                'renderTo' => 'container',
                'type' => 'line'
            ),
            'title' => array(
                'text' => 'แนวโน้มประชากรสูงอายุ ปี '.min($year).'-'.max($year).' (จำแนกชาย - หญิง)'
            ),
            'xAxis' => array(
                'categories' => $year
            ),
            'yAxis' => array(
                'title' => array('text' => 'จำนวนประชากร (คน)')
            ),
            'series' => array(
                array('name' => 'ชาย', 'color' => '#007FFF', 'lineWidth' => 4, 'data' => $data_m), 
                array('name' => 'หญิง', 'color' => '#FF2A2A', 'lineWidth' => 4, 'data' => $data_f)  
            ),
            'plotOptions' => array(
                'line' => array(
                    'dataLabels' => array('enabled' => true, 'format' => '{point.y:,.0f} คน'),
                    'marker' => array('symbol' => 'circle')
                )
            )       
        );      
        echo json_encode($array);     
    }
} 