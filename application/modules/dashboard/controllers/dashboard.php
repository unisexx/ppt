<?php
class Dashboard extends Public_Controller
{
    public function index()
    {
        $this->template->build('index');
    }
    
    /*
     * แนวโน้มประชากรสูงอายุ
     */
    public function chart_1()
    {   
        $sql = 'SELECT POPULATION.YEAR_DATA AS YEAR,

        ((SUM(UNIT_M.TOTAL)/SUM(YOUNG_M.TOTAL))*100) AS M,
        ((SUM(UNIT_F.TOTAL)/SUM(YOUNG_F.TOTAL))*100) AS F
        
        FROM POPULATION
        
        LEFT JOIN (
        SELECT PID, SUM(NUNIT) AS TOTAL
        FROM POPULATION_DETAIL
        WHERE AGE_RANGE_CODE BETWEEN 1 AND 15
        OR AGE_RANGE_CODE BETWEEN 61 AND 102
        GROUP BY PID
        ) UNIT_M ON UNIT_M.PID = POPULATION."ID"
        
        LEFT JOIN (
        SELECT PID, SUM(NUNIT) AS TOTAL
        FROM POPULATION_DETAIL
        WHERE AGE_RANGE_CODE BETWEEN 103 AND 117
        OR AGE_RANGE_CODE BETWEEN 163 AND 204
        GROUP BY PID
        ) UNIT_F ON UNIT_F.PID = POPULATION."ID"
        
        LEFT JOIN (
        SELECT PID, SUM(NUNIT) AS TOTAL
        FROM POPULATION_DETAIL
        WHERE AGE_RANGE_CODE BETWEEN 16 AND 60
        GROUP BY PID
        ) YOUNG_M ON YOUNG_M.PID = POPULATION."ID"
        
        LEFT JOIN (
        SELECT PID, SUM(NUNIT) AS TOTAL
        FROM POPULATION_DETAIL
        WHERE AGE_RANGE_CODE BETWEEN 118 AND 162
        GROUP BY PID
        ) YOUNG_F ON YOUNG_F.PID = POPULATION."ID"
        
        WHERE POPULATION.YEAR_DATA BETWEEN TO_NUMBER((EXTRACT(YEAR FROM SYSDATE)))+538 AND TO_NUMBER((EXTRACT(YEAR FROM SYSDATE)))+543 
        
        GROUP BY YEAR_DATA
        ORDER BY YEAR_DATA';
        $result = $this->db->getarray($sql);
        dbConvert($result);
            
        if(!empty($_GET['test']))
        {
            $result = array();
            for($year=2550;$year<=2555;$year++)
            {
                $result[] = array('year' => $year, 'm' => rand(0.00, 99.99), 'f' => rand(0.00, 99.99));
            }
        }    
            
        $year = array();
        $data_m = array();
        $data_f = array();    
        foreach($result as $item)
        {
            $year[] = $item['year'];
            $data_m[] = floatval($item['m']);
            $data_f[] = floatval($item['f']);
        }
        
        header("content-type: application/json"); 
        $array = array(
            
            'chart' => array(
                'renderTo' => 'chart_1',
                'type' => 'line'
            ),
            'title' => array(
                'text' => 'อัตราส่วนการเป็นภาระของประชากร ในระยะ 5 ปี'
            ),
            'xAxis' => array(
                'categories' => $year
            ),
            'yAxis' => array(
                'title' => array('text' => 'หน่วยร้อยละ')
            ),
            'series' => array(
                array('name' => 'ชาย', 'color' => '#007FFF', 'lineWidth' => 4, 'data' => $data_m), 
                array('name' => 'หญิง', 'color' => '#FF2A2A', 'lineWidth' => 4, 'data' => $data_f)  
            ),
            'plotOptions' => array(
                'line' => array(
                    'dataLabels' => array('enabled' => true, 'format' => '{point.y:.2f}'),
                    'marker' => array('symbol' => 'circle')
                )
            ), 
            'tooltip' => array(
                //'pointFormat' => '{series.name}: <b>{point.y}</b>',
                'valueDecimals' => 2
            )        
        );      
        echo json_encode($array);     
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
                'renderTo' => 'chart_2',
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
    
    /*
     * แนวโน้มอัตราการคลอดบุตรของมารดาวัยรุ่น
     */
    public function chart_3()
    {
        $sql = 'SELECT 
            DISTINCT C_PREGNANT.YEAR, 
            (AGE15.TOTAL*100)/AL.ALL_TOTAL AS AGE15_TOTAL, 
            (AGE20.TOTAL*100)/AL.ALL_TOTAL AS AGE20_TOTAL
        
        FROM C_PREGNANT
        
        LEFT JOIN (
            SELECT YEAR, COUNT(YEAR) AS TOTAL
            FROM C_PREGNANT  
            WHERE (YEAR - TO_NUMBER(EXTRACT(YEAR FROM M_BIRTHDAY))) BETWEEN 0 AND 14
          GROUP BY YEAR
        ) AGE15 ON AGE15.YEAR = C_PREGNANT.YEAR
        
        LEFT JOIN (
            SELECT YEAR, COUNT(YEAR) AS TOTAL
            FROM C_PREGNANT  
            WHERE (YEAR - TO_NUMBER(EXTRACT(YEAR FROM M_BIRTHDAY))) BETWEEN 15 AND 19
          GROUP BY YEAR
        ) AGE20 ON AGE20.YEAR = C_PREGNANT.YEAR
        
        JOIN (SELECT YEAR, COUNT(YEAR) AS ALL_TOTAL FROM C_PREGNANT GROUP BY YEAR) AL ON AL.YEAR = C_PREGNANT.YEAR
        
        WHERE C_PREGNANT.YEAR BETWEEN 2540 AND 2554
        ORDER BY C_PREGNANT.YEAR ';
        $result = $this->db->getarray($sql);
        dbConvert($result);
            
        if(!empty($_GET['test']))
        {
            $result = array();
            for($year=2540;$year<=2554;$year++)
            {
                $result[] = array('year' => $year, 'age20_total' => rand(0.00, 20.00), 'age15_total' => rand(0.00, 20.00));
            }
        }    
            
        $year = array();
        $data_m = array();
        $data_f = array();    
        foreach($result as $item)
        {
            $year[] = $item['year'];
            $data_m[] = floatval($item['age20_total']);
            $data_f[] = floatval($item['age15_total']);
        }
        
        header("content-type: application/json"); 
        $array = array(
            
            'chart' => array(
                'renderTo' => 'chart_3',
                'type' => 'spline'
            ),
            'title' => array(
                'text' => 'แนวโน้มอัตราการคลอดบุตรของมารดาวัยรุ่น ปี '.min($year).'-'.max($year)
            ),
            'xAxis' => array(
                'categories' => $year
            ),
            'yAxis' => array(
                'title' => array('text' => 'หน่วยร้อยละ')
            ),
            'series' => array(
                array('name' => 'มารดาวัยรุ่นอายุ < 20 ปี', 'color' => '#007FFF', 'lineWidth' => 4, 'data' => $data_m), 
                array('name' => 'มารดาวัยรุ่นอายุ < 15 ปี', 'color' => '#FF2A2A', 'lineWidth' => 4, 'data' => $data_f)  
            ),
            'plotOptions' => array(
                'spline' => array(
                    'dataLabels' => array('enabled' => true, 'format' => '{point.y:.2f}'),
                    'marker' => array('symbol' => 'circle')
                )
            ),
            'tooltip' => array(
                'pointFormat' => '{series.name}: <b>{point.y}</b>',
                'valueDecimals' => 2
            )      
        );      
        echo json_encode($array);    
    }

    /*
     * แนวโน้มของประชากรที่มีรายได้ต่ำกว่าเส้นความยากจน ปี 2549-2554
     */
    public function chart_4()
    {   
        $sql = 'SELECT 
        POOR_PROVINCE_YEAR AS YEAR,
        SUM(POOR_PROVINCE_LINE) AS M,
        SUM(POOR_PROVINCE_QTY) AS F
        FROM POOL_PROVINCE
        WHERE POOR_PROVINCE_YEAR BETWEEN 2549 AND 2554
        GROUP BY POOR_PROVINCE_YEAR
        ORDER BY POOR_PROVINCE_YEAR';
        
        $result = $this->db->getarray($sql);
        dbConvert($result);
            
        if(!empty($_GET['test']))
        {
            $result = array();
            for($year=2549;$year<=2554;$year++)
            {
                $result[] = array('year' => $year, 'm' => rand(9000, 200000), 'f' => rand(4000, 7000));
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
                'renderTo' => 'chart_4',
                'type' => 'line'
            ),
            'title' => array(
                'text' => 'แนวโน้มของประชากรที่มีรายได้ต่ำกว่าเส้นความยากจน ปี '.min($year).'-'.max($year)
            ),
            'xAxis' => array(
                'categories' => $year
            ),
            'yAxis' => array(
                'title' => array('text' => 'จำนวน')
            ),
            'series' => array(
                /*
                array(
                    'name' => 'เส้นความยากจน(บาท/คน/เดือน)',
                    'type' => 'column',
                    'color' => '#007FFF',
                    'data' => $data_m,
                    'plotOptions' => array(
                        'line' => array(
                            'dataLabels' => array('enabled' => true, 'format' => '{point.y:,.0f}'),
                            'marker' => array('symbol' => 'circle')
                        )
                    ),
                ), 
                array(
                    'name' => 'จำนวนคนจน(พันคน)',
                    'type' => 'column',
                    'color' => '#AA4643',
                    'data' => $data_f,
                    'plotOptions' => array(
                        'line' => array(
                            'dataLabels' => array('enabled' => true, 'format' => '{point.y:,.0f}'),
                            'marker' => array('symbol' => 'circle')
                        )
                    ),
                ),
                */
                array('name' => 'เส้นความยากจน(บาท/คน/เดือน)', 'color' => '#007FFF', 'lineWidth' => 4, 'data' => $data_m), 
                array('name' => 'จำนวนคนจน(พันคน)', 'color' => '#FF2A2A', 'lineWidth' => 4, 'data' => $data_f) 
            ),
            'plotOptions' => array(
                'line' => array(
                    'dataLabels' => array('enabled' => true, 'format' => '{point.y:,.0f}'),
                    'marker' => array('symbol' => 'circle')
                )
            ), 
            'tooltip' => array(
                'pointFormat' => '{series.name}: <b>{point.y}</b>',
                'valueDecimals' => 2
            )      
        );      
        echo json_encode($array);     
    }
} 