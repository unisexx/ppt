<html>
  <head>
  <title>Save Excel file details to the database</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
  <body>
    <?php
	error_reporting(0);
	set_time_limit(0);
          $this->load->model('poor_province_model', 'opt');
		$this->opt->delete();
        include("source_import/reader.php"); 
		
        $excel = new Spreadsheet_Excel_Reader();
    ?>
        <table border="1">
        <?php
            $excel->read('source_import/'.$file_upload);

            $x1=7;
			
            while($x1<=($excel->sheets[0]['numRows']+4)) {
				
				$check_data = isset($excel->sheets[0]['cells'][$x1][6]) ? $excel->sheets[0]['cells'][$x1][6] : '';
				
				if($check_data != "")
				{
				
				
                $year = isset($excel->sheets[0]['cells'][6][6]) ? $excel->sheets[0]['cells'][6][6] : '';
				//$province = isset($excel->sheets[0]['cells'][$x1][1]) ? $excel->sheets[0]['cells'][$x1][1] : '';
                $data1 = isset($excel->sheets[0]['cells'][$x1][6]) ? $excel->sheets[0]['cells'][$x1][6] : '';
				$data2 = isset($excel->sheets[0]['cells'][$x1][7]) ? $excel->sheets[0]['cells'][$x1][7] : '';
				$data3 = isset($excel->sheets[0]['cells'][$x1][8]) ? $excel->sheets[0]['cells'][$x1][8] : '';

				
				
						$data = array(
						  
							   "poor_province_year" => $year ,
							   "poor_province_aumphur" => "1" ,
							   "poor_province_province" => "1",
							   "poor_province_line" => $data1,
							   "poor_province_percent" => $data2,
							   "poor_province_qty" => $data3
							);
							
							$this->opt->save($data);
				

				}
            $x1++;
            }
			
			echo "<script>alert('Add News successfully!');</script>";		
			echo "<script>window.location='poor_province/province_data';</script>";
			
        ?>
    </table>
  </body>
</html>