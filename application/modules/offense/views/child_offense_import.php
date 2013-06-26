<html>
  <head>
  <title>Save Excel file details to the database</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
  <body>
    <?php
    error_reporting(0);
    set_time_limit(0);
         $this->load->model('offense_model', 'opt');
         //$this->opt->delete();
         

        
        include("source_import/reader.php"); 
        
        $excel = new Spreadsheet_Excel_Reader();
    ?>
        <table border="1">
        <?php
        
        					// Set output Encoding.
			$excel->setOutputEncoding('utf-8');
			
			$excel->setUTFEncoder('iconv');
			
            $excel->read('import_file/offense/'.$file_upload);

            $x1=12;
            $i=1;
            
            while($x1<=($excel->sheets[0]['numRows']+4)) {
                
                $check_data = isset($excel->sheets[0]['cells'][$x1][1]) ? $excel->sheets[0]['cells'][$x1][1] : '';
                
                if($check_data != "")
                {
                	
				                
                
                $year = isset($excel->sheets[0]['cells'][7][2]) ? $excel->sheets[0]['cells'][7][2] : '';
                $province = isset($excel->sheets[0]['cells'][$x1][1]) ? $excel->sheets[0]['cells'][$x1][1] : '';
                $data1 = isset($excel->sheets[0]['cells'][$x1][3]) ? $excel->sheets[0]['cells'][$x1][3] : '';
                $data2 = isset($excel->sheets[0]['cells'][$x1][4]) ? $excel->sheets[0]['cells'][$x1][4] : '';
                $data3 = isset($excel->sheets[0]['cells'][$x1][5]) ? $excel->sheets[0]['cells'][$x1][5] : '';
                $data4 = isset($excel->sheets[0]['cells'][$x1][6]) ? $excel->sheets[0]['cells'][$x1][6] : '';
                $data5 = isset($excel->sheets[0]['cells'][$x1][7]) ? $excel->sheets[0]['cells'][$x1][7] : '';
                $data6 = isset($excel->sheets[0]['cells'][$x1][8]) ? $excel->sheets[0]['cells'][$x1][8] : '';
                $data7 = isset($excel->sheets[0]['cells'][$x1][9]) ? $excel->sheets[0]['cells'][$x1][9] : '';
                
				
				if( ($data1 == '') || ($data1 == '-') )
				{
					$data1 = 0;				
				}
				
				if( ($data2 == '') || ($data2 == '-') )
				{
					$data2 = 0;				
				}
				
				if( ($data3 == '') || ($data3 == '-') )
				{
					$data3 = 0;				
				}
				
				if( ($data4 == '') || ($data4 == '-') )
				{
					$data4 = 0;				
				}
				
				if( ($data5 == '') || ($data5 == '-') )
				{
					$data5 = 0;				
				}
				
				if( ($data6 == '') || ($data6 == '-') )
				{
					$data6 = 0;				
				}
				
				if( ($data7 == '') || ($data7 == '-') )
				{
					$data7 = 0;				
				}
				
				
					if($province!='รวม (Total)')
					{
					
					
				
                        $data = array(
                          
                               "offense_aumphur" => "1" ,
                               "offense_province" => $province ,
                               "offense_property" => $data1,
                               "offense_body" => $data2,
                               "offense_sex" => $data3,
                               "offense_dominance" => $data4,
                               "offense_drug" => $data5,
                               "offense_weapon" => $data6,
                               "offense_etc" => $data7,
                               "offense_year" => $year
                            );
                            
                            $this->opt->save($data);
					}

                }


            $x1++;
            $i++;
            }
            
            echo "<script>alert('Add News successfully!');</script>";       
            echo "<script>window.location='offense/offense_data';</script>";
            
        ?>
    </table>
  </body>
</html>