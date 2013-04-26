<?php
Class Child extends Public_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('opt_model', 'opt');
		$this->load->model('c_drop_model','drop');
		$this->load->model('c_pregnant_model','pregnant');
		$this->load->model('province_model','province');

		$this->load->model('welfare_model','welfare');
		$this->load->model('welfarelist_model','wflist');
	}

	//===== WELFARE =====//
	function welfare(){
		$sql = 'SELECT * FROM WELFARE_DATA WHERE 1=1 ';
		if(@$_GET['YEAR']) $sql .= "AND YEAR = ".$_GET['YEAR'].' ';
		if(@$_GET['WLIST']) $sql .= "AND WLIST_ID = ".$_GET['WLIST'].' ';
		
		$data['result'] = $this->welfare->get($sql);
    	$data['pagination'] = $this->welfare->pagination;
		
		$this->template->build('welfare/welfare_index', $data);
	}
	
	function welfare_form($id=FALSE){
		$wlist = $this->db->execute('SELECT * FROM WELFARE_LIST');
		$data['id'] = @$id;
		if(@$id)
		{
			$data['result'] = $this->welfare->get_row($id);
		}
		
		$this->template->build('welfare/welfare_form', $data);
	}
		function welfare_save()
		{
			$this->welfare->save($_POST);
			set_notify('success', lang('save_data_complete'));
			redirect('child/welfare');
		}
	function welfare_delete($id=FALSE)
	{
		if($id)
		{
			$this->welfare->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('child/welfare');
		}
		
	}
	
	//===== WELFARE =====//	
	
	function ImportData($Filepath=FALSE){
			require('include/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
			require('include/spreadsheet-reader-master/SpreadsheetReader.php');
		
			date_default_timezone_set('UTC');
		
			$Spreadsheet = new SpreadsheetReader($Filepath);
			$BaseMem = memory_get_usage();
		
			$Time = microtime(true);
 			var_dump($Spreadsheet[0]);
			/*foreach ($Spreadsheet as $Key => $Row)
			{
				echo $Key.': ';
				if ($Row)
				{
					print_r($Row);
					echo "<br/>";
				}						
			}	*/		
	}
	function test_save(){			
			if($_FILES['fl_import']['name']!=''){
			//$this->db->execute("DELETE FROM C_DROP WHERE YEAR='".$_POST['year_data']."'");
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'child_pregnant_'.$_POST['year_data'].date("Y_m_d_H_i_s").'.'.$ext;	
			$uploaddir = 'import_file/child/pregnant/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);		
			$this->test($uploaddir.$file_name);	
			}
	}
	function ReadData($filepath,$module=FALSE){
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
		$col=array('sex','weight','birthday','hospital_code','address_code','location','m_birthday','m_address_code','m_id','f_birthday','f_address_code','f_id');
		if($module=="pregnant"){
			for($i = 1; $i <= $data -> sheets[0]['numRows']; $i++) {
				
				$import[$index][$col[0]] = trim($data -> sheets[0]['cells'][$i][1]);
				$import[$index][$col[1]] = trim($data -> sheets[0]['cells'][$i][2]);
				$import[$index][$col[2]] =  trim($data -> sheets[0]['cells'][$i][3]);	
				$import[$index][$col[3]] =  trim($data -> sheets[0]['cells'][$i][4]);			
				$import[$index][$col[4]] =  trim($data -> sheets[0]['cells'][$i][5]);
				$import[$index][$col[5]] = trim($data -> sheets[0]['cells'][$i][6]);
				$import[$index][$col[6]] =  trim($data -> sheets[0]['cells'][$i][7]);
				$import[$index][$col[7]] =  trim($data -> sheets[0]['cells'][$i][8]);	
				$import[$index][$col[8]] =  trim($data -> sheets[0]['cells'][$i][9]);
				$import[$index][$col[9]] =  trim($data -> sheets[0]['cells'][$i][10]);	
				$import[$index][$col[10]]=  trim($data -> sheets[0]['cells'][$i][11]);	
				$import[$index][$col[11]] =  trim($data -> sheets[0]['cells'][$i][12]);			
				$index++;			
			}				
			
		}else{
			$col=array('province_id','area_number','province','poor','family','married','adapt','capture','accident','migration','breadwinner','other','total');			
		
			for($i = 1; $i <= $data -> sheets[0]['numRows']; $i++) {			
				$import[$index][$col[0]] = trim($data -> sheets[0]['cells'][$i][2]);
				$import[$index][$col[1]] = trim($data -> sheets[0]['cells'][$i][3]);
				$import[$index][$col[2]] =  trim($data -> sheets[0]['cells'][$i][4]);	
				$import[$index][$col[3]] =  trim($data -> sheets[0]['cells'][$i][5]);			
				$import[$index][$col[4]] =  trim($data -> sheets[0]['cells'][$i][6]);
				$import[$index][$col[5]] = trim($data -> sheets[0]['cells'][$i][7]);
				$import[$index][$col[6]] =  trim($data -> sheets[0]['cells'][$i][8]);
				$import[$index][$col[7]] =  trim($data -> sheets[0]['cells'][$i][9]);	
				$import[$index][$col[8]] =  trim($data -> sheets[0]['cells'][$i][10]);
				$import[$index][$col[9]] =  trim($data -> sheets[0]['cells'][$i][11]);	
				$import[$index][$col[10]] =  trim($data -> sheets[0]['cells'][$i][12]);	
				$import[$index][$col[11]] =  trim($data -> sheets[0]['cells'][$i][13]);	
				$import[$index][$col[12]] =  trim($data -> sheets[0]['cells'][$i][15]);				 			
				$index++;			
			}	
		}	
		return $import;
		//print_r($data);
		//print_r($data->formatRecords);
	}

	//===== END POPULATION ====//


	
	function offense(){
		$this->template->build('offense_index');
	}
	
	function offense_form(){
		$this->template->build('offense_form');
	}
	
	function offender(){
		$this->template->build('offender_index');
	}
	
	function offender_form(){
		$this->template->build('offender_form');
	}
	
	function orphans()
	{
	    $where = '';
        if(!empty($_GET))
        {
            if(!empty($_GET['keyword']))
            {
                $where .= " AND ( FORM_ALL.NUMBER_ID LIKE '%".$_GET['keyword']."%'";
                $where .= " OR FORM_ALL.C_NAME LIKE '%".$_GET['keyword']."%'";
                $where .= " OR FORM_ALL.OPT_NAME LIKE '%".$_GET['keyword']."%' )";
            }
            
            if(!empty($_GET['year'])) $where .= ' AND FORM_ALL."YEAR" = '.$_GET['year'];
            if(!empty($_GET['province_id'])) $where .= ' AND FORM_ALL.PROVINCE_ID = '.$_GET['province_id'];
            if(!empty($_GET['amphur_id'])) $where .= ' AND FORM_ALL.AMPHUR_ID = '.$_GET['amphur_id'];
        }
        $sql = 'SELECT 
          FORM_ALL."ID",
          FORM_ALL."YEAR",
          (FORM_ALL.T414_M) AS TOTAL_1,
          (FORM_ALL.T414_F) AS TOTAL_2,
          FORM_ALL.NUMBER_ID,
          FORM_ALL.OPT_NAME,
          AMPHUR.AMPHUR_NAME,
          PROVINCES.PROVINCE,
          FORM_ALL."SIZE",
          FORM_ALL.C_TITLE,
          FORM_ALL.C_NAME
        FROM FORM_ALL 
        LEFT JOIN PROVINCES ON PROVINCES.ID = FORM_ALL.PROVINCE_ID
        LEFT JOIN AMPHUR ON AMPHUR.ID = FORM_ALL.AMPHUR_ID
        WHERE 1=1 '.$where.' 
        ORDER BY FORM_ALL."YEAR" DESC, FORM_ALL.NUMBER_ID DESC';
        // WHERE (FORM_ALL.T4161_M + FORM_ALL.T4161_F + FORM_ALL.T4162_M + FORM_ALL.T4162_F + FORM_ALL.T4163_M + FORM_ALL.T4163_F + FORM_ALL.T4164_M + FORM_ALL.T4164_F + FORM_ALL.T4165_M + FORM_ALL.T4165_F) > 0
        $data['result'] = $this->opt->get($sql);
        $data['pagination'] = $this->opt->pagination;
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('orphans_index', $data);
	}
	
	function orphans_form($id = null){
	    if($_POST)
        {
            $this->opt->save($_POST);
            set_notify('success', lang('save_data_complete'));
            redirect('child/orphans');
        }
        $data['rs'] = $this->opt->get_row($id);
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('orphans_form', $data);
	}

    function orphans_delete($id)
    {
        if(!empty($id))
        {
            $this->opt->delete($id);
            set_notify('success', lang('delete_data_complete'));
        }
        redirect('child/orphans');
    }
	
	function drop(){
			
		$area_number=(!empty($_GET['area_number']))? " and area_number=".$_GET['area_number']:'';
		$province=(!empty($_GET['province'])) ? " and province='".$_GET['province']."'":'';
		$year=(!empty($_GET['year'])) ? " and year=".$_GET['year']:'';		
		$data['result']	= $this->drop->get();									 
		$data['province']= $this->province->limit(80)->get();
		$data['pagination'] = $this->drop->pagination();
		
		$this->template->build('drop/drop_index',$data);
	}
	
	function drop_form($id=FALSE){
			
		$data['rs'] =$this->drop->get_row($id);
		$data['province']= $this->province->limit(80)->get();
		$this->template->build('drop/drop_form',$data);
	}
	function drop_save(){
			
		if($_POST){
			$_POST['total']= str_replace(",", "",$_POST['total']);			
		   $this->drop->save($_POST);
		   set_notify('success', lang('save_data_complete'));
		}
		redirect('child/drop');
			
	}
	function drop_delete($id){
		 if(!empty($id))
        {
            $this->drop->delete($id);
            set_notify('success', lang('delete_data_complete'));
        }
        redirect('child/drop');
	}
	function drop_import(){				
		$this->template->build('drop/drop_import_form');	
	}
	function drop_save_import(){
		if($_FILES['fl_import']['name']!=''){
			$this->db->execute("DELETE FROM C_DROP WHERE YEAR='".$_POST['year_data']."'");
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'child_drop_'.$_POST['year_data'].date("Y_m_d_H_i_s").'.'.$ext;	
			$uploaddir = 'import_file/child/drop/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);		
			$data = $this->ReadData($uploaddir.$file_name);							
			foreach($data as $key=>$item){
				if($key==0 || $key==1 || $key==2 || $key==3){
					continue;
				}	
					
						$val['YEAR']=$_POST['year_data'];
						$val['PROVINCE_ID'] = $item['province_id'];
						$val['AREA_NUMBER'] =$item['area_number'];
						$val['PROVINCE'] = $item['province'];
						$val['POOR'] = $item['poor'];
						$val['FAMILY'] = $item['family'];
						$val['MARRIED'] = $item['married'];
						$val['ADAPT'] = $item['adapt'];
						$val['CAPTURE'] = $item['capture'];
						$val['ACCIDENT'] = $item['accident'];
						$val['MIGRATION'] = $item['migration'];
						$val['BREADWINNER'] = $item['breadwinner'];
						$val['OTHER'] = $item['other'];
						$val['TOTAL'] = $item['total'];
						//$val['CREATE'] = date('Y-m-d');
						$this->drop->save($val);																													
			}
			set_notify('success', lang('save_data_complete'));
		}
		redirect('child/drop_import');	
	}
	function pregnant(){
		
		$this->template->build('pregnant/pregnant_index');
	}
	
	function pregnant_form(){
		$this->template->build('pregnant/pregnant_form');
	}
	function pregnant_import(){
		$this->template->build('pregnant/pregnant_import_form');	
	}
	function pregnant_save_import(){
		// แก้ upload_max_filesize = 40M
		/* ; Maximum allowed size for uploaded files.
			upload_max_filesize = 40M   จาก  2M
			; Must be greater than or equal to upload_max_filesize
			post_max_size = 40M  จาก 2M*/ 
		
		if($_FILES['fl_import']['name']!=''){
			//$this->db->execute("DELETE FROM C_PREGNANT WHERE YEAR='".$_POST['year_data']."'");
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'child_pregnant_'.$_POST['year_data'].date("Y_m_d_H_i_s").'.'.$ext;	
			$uploaddir = 'import_file/child/pregnant/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);		
			$data = $this->ReadData($uploaddir.$file_name,"pregnant");								
			foreach($data as $key=>$item){				
																						
					$val['year']=$_POST['year'];
					$val['sex'] = $item['sex'];
					$val['weight'] = $item['weight'];
					$val['birthday'] = $item['birthday'];	
					$val['hospital_code'] =  $item['hospital_code'];			
					$val['address_code'] =  $item['address_code'];
					$val['location'] = $item['location'];
					$val['m_birthday'] =  $item['m_birthday'];
					$val['m_address_code'] =  $item['m_address_code'];	
					$val['m_id'] = $item['m_id'];
					$val['f_birthday'] =  $item['f_birthday'];	
					$val['f_address_code'] =  $item['f_address_code'];	
					$val['f_id'] =  $item['f_id'];		
					$this->pregnant->save($val);																																					
			}
			set_notify('success', lang('save_data_complete'));
		}
		//redirect('child/pregnant_import');	
	}
	function birth(){
		$this->template->build('birth_index');
	}
	
	function birth_form(){
		$this->template->build('birth_form');
	}
	
	function unsuitable()
	{
	    $where = '';
        if(!empty($_GET))
        {
            if(!empty($_GET['keyword']))
            {
                $where .= " AND ( FORM_ALL.NUMBER_ID LIKE '%".$_GET['keyword']."%'";
                $where .= " OR FORM_ALL.C_NAME LIKE '%".$_GET['keyword']."%'";
                $where .= " OR FORM_ALL.OPT_NAME LIKE '%".$_GET['keyword']."%' )";
            }
            
            if(!empty($_GET['year'])) $where .= ' AND FORM_ALL."YEAR" = '.$_GET['year'];
            if(!empty($_GET['province_id'])) $where .= ' AND FORM_ALL.PROVINCE_ID = '.$_GET['province_id'];
            if(!empty($_GET['amphur_id'])) $where .= ' AND FORM_ALL.AMPHUR_ID = '.$_GET['amphur_id'];
        }
        $sql = 'SELECT 
          FORM_ALL."ID",
          FORM_ALL."YEAR",
          (FORM_ALL.T4161_M + FORM_ALL.T4161_F) AS TOTAL_1,
          (FORM_ALL.T4162_M + FORM_ALL.T4162_F) AS TOTAL_2,
          (FORM_ALL.T4163_M + FORM_ALL.T4163_F) AS TOTAL_3,
          (FORM_ALL.T4164_M + FORM_ALL.T4164_F) AS TOTAL_4,
          (FORM_ALL.T4165_M + FORM_ALL.T4165_F) AS TOTAL_5,
          FORM_ALL.NUMBER_ID,
          FORM_ALL.OPT_NAME,
          AMPHUR.AMPHUR_NAME,
          PROVINCES.PROVINCE,
          FORM_ALL."SIZE",
          FORM_ALL.C_TITLE,
          FORM_ALL.C_NAME
        FROM FORM_ALL 
        LEFT JOIN PROVINCES ON PROVINCES.ID = FORM_ALL.PROVINCE_ID
        LEFT JOIN AMPHUR ON AMPHUR.ID = FORM_ALL.AMPHUR_ID
        WHERE 1=1 '.$where.' 
        ORDER BY FORM_ALL."YEAR" DESC, FORM_ALL.NUMBER_ID DESC';
        // WHERE (FORM_ALL.T4161_M + FORM_ALL.T4161_F + FORM_ALL.T4162_M + FORM_ALL.T4162_F + FORM_ALL.T4163_M + FORM_ALL.T4163_F + FORM_ALL.T4164_M + FORM_ALL.T4164_F + FORM_ALL.T4165_M + FORM_ALL.T4165_F) > 0
		$data['result'] = $this->opt->get($sql);
        $data['pagination'] = $this->opt->pagination;
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('unsuitable_index', $data);
	}
	
	function unsuitable_form($id = null){
	    if($_POST)
        {
            $this->opt->save($_POST);
            set_notify('success', lang('save_data_complete'));
            redirect('child/unsuitable');
        }
	    $data['rs'] = $this->opt->get_row($id);
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('unsuitable_form', $data);
	}

    function unsuitable_delete($id)
    {
        if(!empty($id))
        {
            $this->opt->delete($id);
            set_notify('success', lang('delete_data_complete'));
        }
        redirect('child/unsuitable');
    }
}
?>