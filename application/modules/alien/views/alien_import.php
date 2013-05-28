<html>
  <head>
  <title>Save Excel file details to the database</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
  <body>
    <?php
	//error_reporting(0);
	set_time_limit(0);
          $this->load->model('alien_model', 'opt');
			$this->opt->delete();
        include("source_import/reader.php"); 
		
        $excel = new Spreadsheet_Excel_Reader();
    ?>
        <table border="1">
        <?php
		
					// Set output Encoding.
			$excel->setOutputEncoding('utf-8');
			
			$excel->setUTFEncoder('iconv');
			
            $excel->read('import_file/alien/'.$file_upload);

            $x1=4;
			$i=1;
			
            while($x1<=($excel->sheets[0]['numRows']+4)) {
				
				$check_data = isset($excel->sheets[0]['cells'][$x1][2]) ? $excel->sheets[0]['cells'][$x1][2] : '';
				
				if($check_data != "")
				{
				
				
                $year = isset($excel->sheets[0]['cells'][1][6]) ? $excel->sheets[0]['cells'][1][6] : '';
				$province = isset($excel->sheets[0]['cells'][$x1][1]) ? $excel->sheets[0]['cells'][$x1][1] : '';
                $data1 = isset($excel->sheets[0]['cells'][$x1][2]) ? $excel->sheets[0]['cells'][$x1][2] : '';
				$data2 = isset($excel->sheets[0]['cells'][$x1][3]) ? $excel->sheets[0]['cells'][$x1][3] : '';
				$data3 = isset($excel->sheets[0]['cells'][$x1][4]) ? $excel->sheets[0]['cells'][$x1][4] : '';
				$data4 = isset($excel->sheets[0]['cells'][$x1][5]) ? $excel->sheets[0]['cells'][$x1][5] : '';
				$data5 = isset($excel->sheets[0]['cells'][$x1][6]) ? $excel->sheets[0]['cells'][$x1][6] : '';

  
  					
				
						$data = array(
						  
							   "alien_province" => $province,
							   "alien_sum" => $data1,
							   "alien_male" => $data2,
							   "alien_female" => $data3,
							   "alien_sum_in" => $data4,
							   "alien_sum_out" => $data5,
							   "alien_year" => $year 
							   
							   
							);
							
							$this->opt->save($data);
				

				}
            $x1++;
			$i++;
            }
			
			echo "<script>alert('Add News successfully!');</script>";		
			echo "<script>window.location='alien/alien_data';</script>";
			
        ?>
    </table>
  </body>
</html>