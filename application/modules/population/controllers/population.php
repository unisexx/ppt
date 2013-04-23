<?php
Class population extends Public_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('province_model', 'province');
		$this->load->model('amphur_model','amphur');
		$this->load->model('district_model','district');
		$this->load->model('population_model','ppl');
		$this->load->model('population_detail_model','ppl_detail');
	}
	//=====POPULATION AUT ====//
	function index(){
		$condition = "1=1";
		$condition.= @$_GET['year_data']!='' ? " AND YEAR_DATA=".$_GET['year_data'] : "";
		$condition.= @$_GET['province_id']!='' ? " AND PROVINCE_ID=".$_GET['province_id'] : "";
		$condition.= @$_GET['amphur_id']!='' ? " AND AMPHUR_ID=".$_GET['amphur_id'] : "";
		$condition.= @$_GET['district_id']!='' ? " AND DISTRICT_ID=".$_GET['district_id'] : "";
		$data['ppl'] = $this->ppl->where($condition)->get();
		$data['pagination'] = $this->ppl->pagination();
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('population_index',$data);
	}
	
	function form(){
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('population_form');
	}
	
	function import_form(){		
		$this->template->build('population_import_form');
	}
	
	function population_import(){
		//$this->db->debug=true;
		
		if($_FILES['fl_import']['name']!=''){
			$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID IN (SELECT ID FROM POPULATION WHERE PROVINCE_ID=".$_POST['province_id']." AND YEAR_DATA=".$_POST['year_data'].")");
			$this->db->execute("DELETE FROM POPULATION WHERE PROVINCE_ID=".$_POST['province_id']." AND YEAR_DATA=".$_POST['year_data']);
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'population_'.$_POST['province_id'].date("Y_m_d_H_i_s").'.'.$ext;
			$file_name = 'population'.'.'.$ext;			
			$uploaddir = 'import_file/population/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);		
			$data = $this->ReadData($uploaddir.$file_name);			
			foreach($data as $item):								
				if($item['value_length']==1712){
					$chars = str_split($item['value'] , 8);
					//print_r($chars);	
					$item['title']."<br>";
					
					
					if (strpos($item['title'], 'จังหวัด')!==false) {
						$province_name = str_replace('จังหวัด', '', $item['title']);
						$province = $this->province->where(" province='".iconv('utf-8','tis-620',$province_name)."'")->get_row();
						$province_id = $province['id'];		
						$val['PROVINCE_ID'] = $province_id;
						$val['PROVINCE_NAME'] = $province_name;
						$val['AMPHUR_ID'] = '';
						$val['AMPHUR_NAME'] = '';
						$val['DISTRICT_ID'] = '';
						$val['DISTRICT_NAME'] = '';			
						$val['YEAR_DATA'] = $_POST['year_data'];					
						$val['LUNAR_CAL_MALE'] = (int)$chars[204];
						$val['LUNAR_CAL_FEMALE'] = (int)$chars[205];
						$val['CENTRAL_HH_MALE'] = (int)$chars[206];
						$val['CENTRAL_HH_FEMALE'] = (int)$chars[207];
						$val['NO_THAI_MALE'] = (int)$chars[208];
						$val['NO_THAI_FEMALE'] = (int)$chars[209];
						$val['IN_TRANS_MALE'] = (int)$chars[210];
						$val['IN_TRANS_FEMALE'] = (int)$chars[211];
						$val['SUM_MALE'] = (int)$chars[212];
						$val['SUM_FEMALE'] = (int)$chars[213];
						$id = $this->ppl->save($val);					
						
						for($i=0;$i<=203;$i++){
							$val_sub['PID'] = $id;
							$val_sub['AGE_RANGE_CODE'] = $i+1;
							$val_sub['NUNIT'] = $chars[$i];
							$this->ppl_detail->save($val_sub);
						}					
					}
					else if (strpos($item['title'], 'อำเภอ')!==false) {
						$amphur_name = strpos($item['title'], 'อำเภอ')!==false ? str_replace('อำเภอ', '', $item['title']) : strpos($item['title'], 'เทศบาล')!==false;
						$amphur = $this->amphur->where(" province_id=".$province_id." AND AMPHUR_NAME='".iconv('utf-8','tis-620',$amphur_name)."'")->get_row();
						$amphur_id = $amphur['id'];
						$val['PROVINCE_ID'] = $province_id;
						$val['PROVINCE_NAME'] = $province_name;
						$val['AMPHUR_ID'] = $amphur_id;
						$val['AMPHUR_NAME'] = $amphur_name;
						$val['DISTRICT_ID'] = '';
						$val['DISTRICT_NAME'] = '';		
						$val['YEAR_DATA'] = $_POST['year_data'];					
						$val['LUNAR_CAL_MALE'] = (int)$chars[204];
						$val['LUNAR_CAL_FEMALE'] = (int)$chars[205];
						$val['CENTRAL_HH_MALE'] = (int)$chars[206];
						$val['CENTRAL_HH_FEMALE'] = (int)$chars[207];
						$val['NO_THAI_MALE'] = (int)$chars[208];
						$val['NO_THAI_FEMALE'] = (int)$chars[209];
						$val['IN_TRANS_MALE'] = (int)$chars[210];
						$val['IN_TRANS_FEMALE'] = (int)$chars[211];
						$val['SUM_MALE'] = (int)$chars[212];
						$val['SUM_FEMALE'] = (int)$chars[213];
						$id = $this->ppl->save($val);					
						
						for($i=0;$i<=203;$i++){
							$val_sub['PID'] = $id;
							$val_sub['AGE_RANGE_CODE'] = $i+1;
							$val_sub['NUNIT'] = $chars[$i];
							$this->ppl_detail->save($val_sub);
						}				
					}
					else if (strpos($item['title'], 'ตำบล')!==false && strpos($item['title'], 'เทศบาล')===false) {
						$district_name = str_replace('ตำบล', '', $item['title']);
						$district = $this->district->where(" province_id=".$province_id."  AND DISTRICT_NAME='".iconv('utf-8','tis-620',$district_name)."'")->get_row();
						$amphur = $this->amphur->get_row($district['amphur_id']);
						$district_id = $district['id'];
						$val['PROVINCE_ID'] = $province_id;
						$val['PROVINCE_NAME'] = $province_name;
						$val['AMPHUR_ID'] = $amphur['id'];
						$val['AMPHUR_NAME'] = $amphur['amphur_name'];
						$val['DISTRICT_ID'] = $district_id;
						$val['DISTRICT_NAME'] = $district_name;		
						$val['YEAR_DATA'] = $_POST['year_data'];					
						$val['LUNAR_CAL_MALE'] = (int)$chars[204];
						$val['LUNAR_CAL_FEMALE'] = (int)$chars[205];
						$val['CENTRAL_HH_MALE'] = (int)$chars[206];
						$val['CENTRAL_HH_FEMALE'] = (int)$chars[207];
						$val['NO_THAI_MALE'] = (int)$chars[208];
						$val['NO_THAI_FEMALE'] = (int)$chars[209];
						$val['IN_TRANS_MALE'] = (int)$chars[210];
						$val['IN_TRANS_FEMALE'] = (int)$chars[211];
						$val['SUM_MALE'] = (int)$chars[212];
						$val['SUM_FEMALE'] = (int)$chars[213];
						$id = $this->ppl->save($val);					
						//echo "ID===>".$id."<BR>";
						
						for($i=0;$i<=203;$i++){
							$val_sub['PID'] = $id;
							$val_sub['AGE_RANGE_CODE'] = $i+1;
							$val_sub['NUNIT'] = $chars[$i];
							$this->ppl_detail->save($val_sub);
						}						
					}
									
				}				
			endforeach;
			redirect('population/index');
			/*
			foreach($data as $item):
				if($item['name_en']!=''){
				$product = $this->db->getrow("select * from product where product_code='".$item['product_code']."' and product.name_en='".$item['name_en']."'");
				if(@$product['id']>0)
				{
					$update['id'] = $product['id'];
					$update['cat_lv1']=$_POST['cat_lv1'];
					$update['cat_lv2']=$_POST['cat_lv2'];
					$update['cat_lv3']=$_POST['cat_lv3'];
					$update['product_code'] = $item['product_code'];
					$update['name_th'] = $item['name_th'];
					$update['name_en'] = $item['name_en'];
					$update['price'] = $item['price'];
					$update['show_no'] = $item['show_no'];
				}
				else
				{
					$update = $item;	
					$update['cat_lv1']=$_POST['cat_lv1'];
					$update['cat_lv2']=$_POST['cat_lv2'];
					$update['cat_lv3']=$_POST['cat_lv3'];
					$update['show_no'] = $this->db->getone("SELECT (max(show_no))+1 from product ");
				}
				$this->product->save($update);
				}
			endforeach;
			 * 
			 */			
		}
	}

	function ReadData($filepath){
		require_once 'include/Excel/reader.php';
		// ExcelFile($filename, $encoding);
		$data = new Spreadsheet_Excel_Reader();
		// Set output Encoding.
		//$data->setOutputEncoding('CP1251');
		$data -> setOutputEncoding('UTF-8');
		/***
		 * if you want you can change 'iconv' to mb_convert_encoding:
		 * $data->setUTFEncoder('mb');
		 *
		 **/
		/***
		 * By default rows & cols indeces start with 1
		 * For change initial index use:
		 * $data->setRowColOffset(0);
		 *
		 **/
		/***
		 *  Some function for formatting output.
		 * $data->setDefaultFormat('%.2f');
		 * setDefaultFormat - set format for columns with unknown formatting
		 *
		 * $data->setColumnFormat(4, '%.3f');
		 * setColumnFormat - set format for column (apply only to number fields)
		 *
		 **/
		$data -> read($filepath);
		/*
		 $data->sheets[0]['numRows'] - count rows
		 $data->sheets[0]['numCols'] - count columns
		 $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column
	
		 $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell
	
		 $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown"
		 if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00';
		 $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format
		 $data->sheets[0]['cellsInfo'][$i][$j]['colspan']
		 $data->sheets[0]['cellsInfo'][$i][$j]['rowspan']
		 */
	
		error_reporting(E_ALL ^ E_NOTICE);
		$index = 0;
		for($i = 1; $i <= $data -> sheets[0]['numRows']; $i++) {
			$import[$index]['title'] = trim($data -> sheets[0]['cells'][$i][1]);
			$import[$index]['value'] = trim($data -> sheets[0]['cells'][$i][2]);
			$import[$index]['value_length'] = strlen($import[$index]['value']);								 
			//echo $import[$index]['title'].'['.$import[$index]['value_length'].']<br>'.$import[$index]['value'].'<br>';
			//print_r($chars);
			//echo '<br>==================================<br>';			
			$index++;			
		}		
		return $import;
		//print_r($data);
		//print_r($data->formatRecords);
	}

	//===== END POPULATION ====//
	
}
?>




