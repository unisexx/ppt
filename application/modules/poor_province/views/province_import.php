<html>
  <head>
  <title>Save Excel file details to the database</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
  <body>
    <?php
	error_reporting(0);
	set_time_limit(0);
          $this->load->model('poor_province_model', 'opt');
			//$this->opt->delete();
        include("source_import/reader.php"); 
		
        $excel = new Spreadsheet_Excel_Reader();
    ?>
        <table border="1">
        <?php
		
					// Set output Encoding.
			$excel->setOutputEncoding('utf-8');
			
			$excel->setUTFEncoder('iconv');
			
            $excel->read('import_file/poor_province/'.$file_upload);

            $x1=4;
			$i=1;
			
            while($x1<=($excel->sheets[0]['numRows']+4)) {
				
				$check_data = isset($excel->sheets[0]['cells'][$x1][3]) ? $excel->sheets[0]['cells'][$x1][3] : '';
				
				if($check_data != "")
				{
				
				
                $year = isset($excel->sheets[0]['cells'][2][3]) ? $excel->sheets[0]['cells'][2][3] : '';
				//$sex = isset($excel->sheets[0]['cells'][$x1][2]) ? $excel->sheets[0]['cells'][$x1][2] : '';
				$sex = 'etc';
				$province = isset($excel->sheets[0]['cells'][$x1][2]) ? $excel->sheets[0]['cells'][$x1][2] : '';
                $data1 = isset($excel->sheets[0]['cells'][$x1][3]) ? $excel->sheets[0]['cells'][$x1][3] : '';
				$data2 = isset($excel->sheets[0]['cells'][$x1][4]) ? $excel->sheets[0]['cells'][$x1][4] : '';
				$data3 = isset($excel->sheets[0]['cells'][$x1][5]) ? $excel->sheets[0]['cells'][$x1][5] : '';


						$data = array(
						  
							   "poor_province_year" => $year ,
							   "poor_province_sex" => $sex ,
							   "poor_province_province" => $province,
							   "poor_province_line" => $data1,
							   "poor_province_percent" => $data2,
							   "poor_province_qty" => $data3
							);
							
							$this->opt->save($data);
							

				
				

				}
            $x1++;
			$i++;
            }
			
			echo "<script>alert('Add News successfully!');</script>";		
			echo "<script>window.location='poor_province/province_data';</script>";
			
        ?>
    </table>
  </body>
</html>