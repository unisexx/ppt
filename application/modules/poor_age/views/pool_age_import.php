<html>
  <head>
  <title>Save Excel file details to the database</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
  <body>
    <?php
        $this->load->model('poor_model', 'opt');
        $this->opt->delete();
        include("source_import/reader.php");        
        
        $excel = new Spreadsheet_Excel_Reader();
    ?>
        <table border="1">
        <?php
            $excel->read('import_file/poor_age/'.$file_upload);

            $x=6;
            while($x<=($excel->sheets[0]['numRows']+4)) {
                
                $check_data = isset($excel->sheets[0]['cells'][7][$x]) ? $excel->sheets[0]['cells'][7][$x] : '';
                
                if($check_data != "")
                {
                
                $year = isset($excel->sheets[0]['cells'][6][$x]) ? $excel->sheets[0]['cells'][6][$x] : '';
                $data11 = isset($excel->sheets[0]['cells'][7][$x]) ? $excel->sheets[0]['cells'][7][$x] : '';
                $data12 = isset($excel->sheets[0]['cells'][8][$x]) ? $excel->sheets[0]['cells'][8][$x] : '';
                $data13 = isset($excel->sheets[0]['cells'][9][$x]) ? $excel->sheets[0]['cells'][9][$x] : '';
                $data21 = isset($excel->sheets[0]['cells'][11][$x]) ? $excel->sheets[0]['cells'][11][$x] : '';
                $data22 = isset($excel->sheets[0]['cells'][12][$x]) ? $excel->sheets[0]['cells'][12][$x] : '';
                $data23 = isset($excel->sheets[0]['cells'][13][$x]) ? $excel->sheets[0]['cells'][13][$x] : '';
                $data31 = isset($excel->sheets[0]['cells'][15][$x]) ? $excel->sheets[0]['cells'][15][$x] : '';
                $data32 = isset($excel->sheets[0]['cells'][16][$x]) ? $excel->sheets[0]['cells'][16][$x] : '';
                $data33 = isset($excel->sheets[0]['cells'][17][$x]) ? $excel->sheets[0]['cells'][17][$x] : '';
                
/*              echo "----------------------<br>";
                echo "ปี:".$year."<br>";
                echo "วัยเด็ก (< 15 ปี):".$data11."<br>";
                echo "วัยแรงงาน (15-59 ปี):".$data12."<br>";
                echo "ผู้สูงอายุ (60 ปี+):".$data13."<br>";
                echo "---------------------<br>";
                */
                
                            $data = array(
                          
                               "township_child" => $data11 ,
                               "township_work" => $data12 ,
                               "township_elderly" => $data13,
                               "rural_area_child" => $data21,
                               "rural_area_work" => $data22,
                               "rural_area_elderly" => $data23,
                               "country_chijld" => $data31,
                               "country_work" => $data32,
                               "country_elderly" => $data33,
                               "year" => $year
                            );
                            
                            $this->opt->save($data);
                }
              $x++;
            }
            
            echo "<script>alert('Add News successfully!');</script>";       
            echo "<script>window.location='poor_age/allage';</script>";
            
        ?>
    </table>
  </body>
</html>