<html>
  <head>
  <title>Save Excel file details to the database</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
  <body>
    <?php
	error_reporting(0);
	set_time_limit(0);
          $this->load->model('health_model', 'opt');
			//$this->opt->delete();
        include("source_import/reader.php"); 
		
        $excel = new Spreadsheet_Excel_Reader();
    ?>
        <table border="1">
        <?php
            
			


			// Set output Encoding.
			$excel->setOutputEncoding('utf-8');
			
			$excel->setUTFEncoder('iconv');
			
			$excel->read('import_file/health/'.$file_upload);
			
			//error_reporting(E_ALL ^ E_NOTICE);

            $x1=10;
			$i=1;
			
            while($x1<=($excel->sheets[0]['numRows']+4)) {
				
				$check_data = isset($excel->sheets[0]['cells'][$x1][1]) ? $excel->sheets[0]['cells'][$x1][1] : '';
				
				if($check_data != "")
				{
				
				
                $year = isset($excel->sheets[0]['cells'][1][1]) ? $excel->sheets[0]['cells'][1][1] : '';
				$age = isset($excel->sheets[0]['cells'][1][2]) ? $excel->sheets[0]['cells'][1][2] : '';
				$province = isset($excel->sheets[0]['cells'][$x1][1]) ? $excel->sheets[0]['cells'][$x1][1] : '';
                $data1 = isset($excel->sheets[0]['cells'][$x1][2]) ? $excel->sheets[0]['cells'][$x1][2] : '';
				$data2 = isset($excel->sheets[0]['cells'][$x1][3]) ? $excel->sheets[0]['cells'][$x1][3] : '';
				$data3 = isset($excel->sheets[0]['cells'][$x1][4]) ? $excel->sheets[0]['cells'][$x1][4] : '';
				$data4 = isset($excel->sheets[0]['cells'][$x1][5]) ? $excel->sheets[0]['cells'][$x1][5] : '';
				$data5 = isset($excel->sheets[0]['cells'][$x1][6]) ? $excel->sheets[0]['cells'][$x1][6] : '';
				$data6 = isset($excel->sheets[0]['cells'][$x1][7]) ? $excel->sheets[0]['cells'][$x1][7] : '';
				$data7 = isset($excel->sheets[0]['cells'][$x1][8]) ? $excel->sheets[0]['cells'][$x1][8] : '';
				$data8 = isset($excel->sheets[0]['cells'][$x1][9]) ? $excel->sheets[0]['cells'][$x1][9] : '';
				$data9 = isset($excel->sheets[0]['cells'][$x1][10]) ? $excel->sheets[0]['cells'][$x1][10] : '';
				$data10 = isset($excel->sheets[0]['cells'][$x1][11]) ? $excel->sheets[0]['cells'][$x1][11] : '';
				$data11 = isset($excel->sheets[0]['cells'][$x1][12]) ? $excel->sheets[0]['cells'][$x1][12] : '';
				$data12 = isset($excel->sheets[0]['cells'][$x1][13]) ? $excel->sheets[0]['cells'][$x1][13] : '';
				$data13 = isset($excel->sheets[0]['cells'][$x1][14]) ? $excel->sheets[0]['cells'][$x1][14] : '';
				$data14 = isset($excel->sheets[0]['cells'][$x1][15]) ? $excel->sheets[0]['cells'][$x1][15] : '';
				$data15 = isset($excel->sheets[0]['cells'][$x1][16]) ? $excel->sheets[0]['cells'][$x1][16] : '';
				$data16 = isset($excel->sheets[0]['cells'][$x1][17]) ? $excel->sheets[0]['cells'][$x1][17] : '';
				$data17 = isset($excel->sheets[0]['cells'][$x1][18]) ? $excel->sheets[0]['cells'][$x1][18] : '';
				$data18 = isset($excel->sheets[0]['cells'][$x1][19]) ? $excel->sheets[0]['cells'][$x1][19] : '';
				$data19 = isset($excel->sheets[0]['cells'][$x1][20]) ? $excel->sheets[0]['cells'][$x1][20] : '';
				$data20 = isset($excel->sheets[0]['cells'][$x1][21]) ? $excel->sheets[0]['cells'][$x1][21] : '';
				

				
						$data = array(
						  
							   "health_year" => $year,
							   "health_age" => $age,
							   "health_province" => $province,
							   "health_sum_pop" => $data1,
							   "health_sum_eli" => $data2,
							   "health_sum_eli_percen" => $data3,
							   "health_sum_acress" => $data4,
							   "health_sum_acress_percen" => $data5,
							   "health_male_pop" => $data6,
							   "health_male_eli" => $data7,
							   "health_male_eli_percen" => $data8,
							   "health_male_acress" => $data9,
							   "health_male_acress_percen" => $data10,
							   "health_female_pop" => $data11,
							   "health_female_eli" => $data12,
							   "health_female_eli_percen" => $data13,
							   "health_female_acress" => $data14,
							   "health_female_acress_percen" => $data15,
							   "health_etc_pop" => $data16,
							   "health_etc_eli" => $data17,
							   "health_etc_eli_percen" => $data18,
							   "health_etc_acress" => $data19,
							   "health_etc_acress_percen" => $data20 
							   
							   
							);
							
							$this->opt->save($data);
				

				}
            $x1++;
			$i++;
            }
			
			echo "<script>alert('Add News successfully!');</script>";		
			echo "<script>window.location='health/health_data';</script>";
			
        ?>
    </table>
  </body>
</html>