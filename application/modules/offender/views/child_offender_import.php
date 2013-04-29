<html>
  <head>
  <title>Save Excel file details to the database</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
  <body>
    <?php
        //include 'db_connection.php';
        include("source_import/reader.php"); 
		
		 $this->load->model('offender_model', 'opt');
		 $this->opt->delete();
		
        $excel = new Spreadsheet_Excel_Reader();
    ?>
        <table border="1">
        <?php
            $excel->read('source_import/'.$file_upload);

            $x1=2;
			
			
			
            while($x1<=($excel->sheets[0]['numRows']+4)) {

				$check_data = isset($excel->sheets[0]['cells'][8][$x1]) ? $excel->sheets[0]['cells'][8][$x1] : '';
				
				if($check_data != "")
				{
				
                $year = isset($excel->sheets[0]['cells'][7][$x1]) ? $excel->sheets[0]['cells'][7][$x1] : '';
                $data1 = isset($excel->sheets[0]['cells'][8][$x1]) ? $excel->sheets[0]['cells'][8][$x1] : '';
				$data2 = isset($excel->sheets[0]['cells'][9][$x1]) ? $excel->sheets[0]['cells'][9][$x1] : '';
				$data3 = isset($excel->sheets[0]['cells'][10][$x1]) ? $excel->sheets[0]['cells'][10][$x1] : '';
				$data4 = isset($excel->sheets[0]['cells'][11][$x1]) ? $excel->sheets[0]['cells'][11][$x1] : '';
				$data5 = isset($excel->sheets[0]['cells'][12][$x1]) ? $excel->sheets[0]['cells'][12][$x1] : '';
				$data6 = isset($excel->sheets[0]['cells'][13][$x1]) ? $excel->sheets[0]['cells'][13][$x1] : '';
				$data7 = isset($excel->sheets[0]['cells'][14][$x1]) ? $excel->sheets[0]['cells'][14][$x1] : '';
				$data8 = isset($excel->sheets[0]['cells'][15][$x1]) ? $excel->sheets[0]['cells'][15][$x1] : '';
				$data9 = isset($excel->sheets[0]['cells'][16][$x1]) ? $excel->sheets[0]['cells'][16][$x1] : '';
				
/*				echo "----------------------<br>";
				echo "ปี:".$year."<br>";
				echo "1:".$data1."<br>";
				echo "2:".$data2."<br>";
				echo "3:".$data3."<br>";
				echo "4:".$data4."<br>";
				echo "5:".$data5."<br>";
				echo "6:".$data6."<br>";
				echo "7:".$data7."<br>";
				echo "8:".$data8."<br>";
				echo "9:".$data9."<br>";
				echo "---------------------<br>";*/
				
				
				
				
							$data = array(
						  
							   "offender_mental" => $data1 ,
							   "offender_wrangle" => $data2 ,
							   "offender_social" => $data3,
							   "offender_force" => $data4,
							   "offender_family" => $data5,
							   "offender_friend" => $data6,
							   "offender_unknow" => $data7,
							   "offender_fight" => $data8,
							   "offender_etc" => $data9,
							   "offender_year" => $year
							);
							
							$this->opt->save($data);
		
				}
            $x1++;
            }
			
			echo "<script>alert('Add News successfully!');</script>";		
			echo "<script>window.location='offender/offender_data';</script>";
			
        ?>
    </table>
  </body>
</html>