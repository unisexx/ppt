<?php
Class population extends Public_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('province_model', 'province');
		$this->load->model('amphur_model','amphur');
		$this->load->model('district_model','district');
		$this->load->model('population_model','ppl');
		$this->load->model('population_detail_model','ppl_detail');
		$this->load->model('population_data_model','population_data');
		$this->load->model('info_model','info');
		$this->load->model('orginfo_model','org');
	}
	public $menu_id = 74;
	public $menu_sixtyup_id = 55;
	function index(){
		$data['menu_id'] = $this->menu_id;
		$condition = "1=1";
		$condition.= @$_GET['year_data']!='' ? " AND YEAR_DATA=".$_GET['year_data'] : "";
		$condition.= @$_GET['province_id']!='' ? " AND PROVINCE_ID=".$_GET['province_id'] : "";
		$condition.= @$_GET['amphur_id']!='' ? " AND AMPHUR_ID=".$_GET['amphur_id'] : "";
		$condition.= @$_GET['district_id']!='' ? " AND DISTRICT_ID=".$_GET['district_id'] : "";
		$data['ppl'] = $this->ppl->where($condition)->order_by('year_data desc, province_name, amphur_name, district_name', 'asc')->get();
		$data['pagination'] = $this->ppl->pagination();
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('population_index',$data);
	}
	
	function form($id=FALSE){
		$data['menu_id'] = $this->menu_id;		
		$data['item'] = $this->ppl->get_row($id);
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('population_form',$data);
	}
	
	function save(){
		if(!menu::perm($this->menu_id, 'add') || !menu::perm($this->menu_id,'edit'))redirect('population/index');
		$_POST['PROVINCE_NAME'] = $this->province->select("PROVINCE")->where("ID=".$_POST['province_id'])->get_one();
		$_POST['AMPHUR_NAME'] = $_POST['amphur_id'] > 0 ? $this->amphur->select("amphur_name")->where("ID=".$_POST['amphur_id'])->get_one() : "";
		$_POST['DISTRICT_NAME'] = $_POST['district_id'] > 0 ? $this->district->select("district_name")->where("ID=".$_POST['district_id'])->get_one() : "";
		$id = $this->ppl->save($_POST);
		$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$id);
		
		for($i=1;$i<=102;$i++){
			$value['age_range_code'] = $i;
			$value['pid'] = $id;
			$value['nunit'] = $_POST['male_'.$i];
			$this->ppl_detail->save($value);
		}
		
		for($i=1;$i<=102;$i++){
			$value['age_range_code'] = $i+102;
			$value['pid'] = $id;
			$value['nunit'] = $_POST['female_'.$i];
			$this->ppl_detail->save($value);
		}
		redirect('population/index');
	}

	function delete($id=FALSE){
		$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$id);
		$this->db->execute("DELETE FROM POPULATION WHERE ID=".$id);
		redirect('population/index');
	}
	
	function import_form(){
		$data['menu_id'] = $this->menu_id;
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');		
		$this->template->build('population_import_form',$data);
	}
	
	function read_text(){
		$strFileName = "import_file/population/NEW/5312cc10";
		$objFopen = fopen($strFileName, 'r');
		$index = 0;
		if ($objFopen) {
		    while (!feof($objFopen)) {	    	
		        $file = fgets($objFopen, 4096);
		        $data = $file;
				echo substr($data,0,40).strlen(substr($data,40))."<br>".substr($data,40)."<br>";
				$import[$index]['title'] = trim($data -> sheets[0]['cells'][$i][1]);
				$import[$index]['value'] = trim($data -> sheets[0]['cells'][$i][2]);
				$import[$index]['value_length'] = strlen($import[$index]['value']);								 
				$index++;			
		    }
		    fclose($objFopen);
		}
		return $import;
	}
	
	function population_import(){
		//$this->db->debug = true;
		$year_data = $_POST['year_data'];
		if($_FILES['fl_import']['name']!=''){
			set_time_limit(0);
			/*---for insert value to info table ---*/
			$import_section_id = $_POST['import_workgroup_id']> 0 ? $_POST['import_workgroup_id'] : $_POST['import_section_id'];
			$_POST['section_id'] = $import_section_id;
			$this->info->save($_POST);
			/*--end--*/
			//$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			//$file_name = 'population_'.$_POST['year_data'].'_'.$_POST['province_id'].date("Y_m_d_H_i_s").'.'.$ext;
			$file_name = 'population_'.$_POST['year_data'].'_'.$_POST['province_id'].date("Y_m_d_H_i_s");			
			$uploaddir = 'import_file/population/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);		
			//$data = $this->ReadData($uploaddir.$file_name);			
			$objFopen = fopen($uploaddir.$file_name, 'r');
			$index = 0;
			$vrow = 0;
			$org_id = 0;
			if ($objFopen) {
			    while (!feof($objFopen)) {	    	
			        $file = fgets($objFopen, 4096);
			        $data = $file;
					//echo trim(substr($data,0,40)).strlen(trim(substr($data,40)))."<br>".trim(substr($data,40))."<br>";
					$item['title'] = trim(substr($data,0,40));
					$item['value'] = trim(substr($data,40));
					$item['value_length'] = strlen(trim(substr($data,40)));
								
				//$this->db->debug = true;
						if($item['value_length']==1712){
							$vrow++;
							//echo "VROW ::: ".$vrow."<BR>";
							//echo "TITLE::: ".$item['title']."<BR>";
							//echo "AAA:::".strpos($item['title'], 'เขต')."<BR>";
							//echo "AAA:::".eregi('^เขต',iconv('tis-620','utf-8',$item['title']));
							$item['title'] = iconv('tis-620','utf-8',$item['title']);					
							 //return eregi('^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$',$email);
							$chars = str_split($item['value'] , 8);
							$item['title']."<br>";
									if ($vrow==1) {
										$province_name = str_replace('จังหวัด', '', $item['title']);
										$province = $this->province->where(" province='".iconv('utf-8','tis-620',$province_name)."'")->get_row();						
										$province_id = @$province['id'];	
										if($province_id <1){
											echo iconv('utf-8','tis-620',"ไม่มีข้อมูลจังหวัด ".$item['title'])."<br>";
										}else{
											
				                        $val['ID'] = $this->ppl->select('id')->where(" PROVINCE_ID=".$province_id." AND AMPHUR_ID=0 AND DISTRICT_ID=0 AND YEAR_DATA=".$year_data)->get_one();
										if($val['ID']>0){
											$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$val['ID']);
										}	
															
										$val['PROVINCE_ID'] = $province_id;
										$val['PROVINCE_NAME'] = $province_name;
										$val['AMPHUR_ID'] = '0';
										$val['AMPHUR_NAME'] = '';
										$val['DISTRICT_ID'] = '0';
										$val['DISTRICT_NAME'] = '';			
										$val['YEAR_DATA'] = $year_data;					
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
										$val['IMPORT_SECTION_ID'] = (int)@$import_section_id;
										$is_org = 'N';
										$val['ORG_ID'] = 0;
										$val['IS_ORG'] = $is_org;
										$id = $this->ppl->save($val);					
											for($i=0;$i<=203;$i++){
												$val_sub['PID'] = $id;
												$val_sub['AGE_RANGE_CODE'] = $i+1;
												$val_sub['NUNIT'] = $chars[$i];
												$this->ppl_detail->save($val_sub);
											}	
										}				
									}
									else if (eregi('^อำเภอ',$item['title']) || eregi('^เขต',$item['title'])) {
										$amphur_name =  str_replace('อำเภอ', '', $item['title']) ;
										$amphur_name = str_replace('เขต', '', $amphur_name);								
										$amphur = $this->amphur->where(" province_id=".$province_id." AND AMPHUR_NAME='".iconv('utf-8','tis-620',$amphur_name)."'")->get_row();
										$amphur_id = @$amphur['id'];
										if($amphur_id<1)
										{
											echo iconv('utf-8','tis-620',"ไม่มี ไอดี อำเภอ ".$amphur_name)."<br>";
										}else{
										$val['ID'] = $this->ppl->select('id')->where(" PROVINCE_ID=".$province_id." AND AMPHUR_ID=".$amphur_id." AND DISTRICT_ID=0 AND YEAR_DATA=".$year_data)->get_one();
										if($val['ID']>0){
											$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$val['ID']);
										}
										$val['PROVINCE_ID'] = $province_id;
										$val['PROVINCE_NAME'] = $province_name;
										$val['AMPHUR_ID'] = $amphur_id;
										$val['AMPHUR_NAME'] = $amphur_name;
										$val['DISTRICT_ID'] = '';
										$val['DISTRICT_NAME'] = '';		
										$val['YEAR_DATA'] = $year_data;					
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
										$val['IMPORT_SECTION_ID'] = (int)@$import_section_id;
										$is_org = 'N';
										$val['ORG_ID'] = 0;
										$val['IS_ORG'] = $is_org;
										$id = $this->ppl->save($val);					
										
											for($i=0;$i<=203;$i++){
												$val_sub['PID'] = $id;
												$val_sub['AGE_RANGE_CODE'] = $i+1;
												$val_sub['NUNIT'] = $chars[$i];
												$this->ppl_detail->save($val_sub);
											}		
										}		
									}
									elseif(eregi('^แขวง',$item['title']) || eregi('^ตำบล',$item['title'])){
											$district_name = str_replace('แขวง', '', $item['title']);
											$district_name = str_replace('ตำบล', '', $district_name);											
											if($amphur_id<1){
												echo iconv('utf-8','tis-620',$item['title']." ไม่มี id amphur")."<br>";
											}else{
												$condition = " province_id=".$province_id." AND AMPHUR_ID=".$amphur_id."  AND DISTRICT_NAME='".iconv('utf-8','tis-620',$district_name)."'";
												$district = $this->district->where($condition)->get_row();
												if(@$district['id']<1){
													echo iconv('utf-8','tis-620',$item['title']." ไม่มี id ตำบล")."  ".$condition."<br>";
												}else{
													$amphur = $this->amphur->get_row($amphur_id);
													$district_id = @$district['id'];
													$val['ID'] = $this->ppl->select('id')->where(" PROVINCE_ID=".$province_id." AND AMPHUR_ID=".$district['amphur_id']." AND DISTRICT_ID=".$district_id." AND YEAR_DATA=".$year_data." AND IS_ORG='".$is_org."' ")->get_one();
													if($val['ID']>0){
														$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$val['ID']);
													}
													$val['PROVINCE_ID'] = $province_id;
													$val['PROVINCE_NAME'] = $province_name;
													$val['AMPHUR_ID'] = $amphur['id'];
													$val['AMPHUR_NAME'] = $amphur['amphur_name'];
													$val['DISTRICT_ID'] = $district_id;
													$val['DISTRICT_NAME'] = $district_name;		
													$val['YEAR_DATA'] = $year_data;					
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
													$val['IMPORT_SECTION_ID'] = (int)@$import_section_id;
													$val['IS_ORG'] = $is_org;
													$val['org_id'] = $org_id;
													$id = $this->ppl->save($val);					
													for($i=0;$i<=203;$i++){
														$val_sub['PID'] = $id;
														$val_sub['AGE_RANGE_CODE'] = $i+1;
														$val_sub['NUNIT'] = $chars[$i];
														$this->ppl_detail->save($val_sub);
													}		
												}
											}		
								}
								else if(eregi('^เทศบาล',$item['title'])){
									$org = $this->org->where(" name='".iconv('utf-8','tis-620',$item['title'])."' ")->get_row();
									$amphur = $this->amphur->where(" province_id=".$province_id." AND AMPHUR_NAME='".iconv('utf-8','tis-620',$org['amphor'])."'")->get_row();
									$amphur_id = $amphur['id'];
									$is_org = 'Y';	
									$org_id = $org['id'];						
								}
								
						}
					$index++;			
			    }				
			    fclose($objFopen);				
			}					
		}
		/*echo "<script>window.location='population';</script>";*/
		redirect('population/index');
	}

	function ReadData($year_data){
		$uploaddir = "import_file/population/NEW/".$year_data."/";		
		$file_list = scandir($uploaddir);
		$data['file_list'] = $file_list;
		foreach($file_list as $file){
			$lfile[] =$file;			
		}		
		
		for($i=2;$i<count($lfile);$i++){
			$file_name = $lfile[$i];
			$file = $lfile[$i];
			//$finfo = explode('.',$file);
			echo $file;
			}
	}
	
    function custom_import($year_data){
		//$this->db->debug=true;
		set_time_limit(0);
		$uploaddir = "import_file/population/NEW/".$year_data."/";		
		$file_list = scandir($uploaddir);
		$data['file_list'] = $file_list;
		foreach($file_list as $file){
//			$lfile[] = iconv('windows-874','utf-8',$file);			
//		}		
		
//		for($fi=2;$fi<count($lfile);$fi++){
//			$file_name = $lfile[$fi];
//			$file = $lfile[$fi];
			//$finfo = explode('.',$file);
			
			
			//$data = $this->ReadData($uploaddir.$file_name);
			$objFopen = fopen($uploaddir.$file, 'r');
			$index = 0;
			$vrow = 0;
			$org_id = 0;
			if ($objFopen) {
			    while (!feof($objFopen)) {	    	
			        $file = fgets($objFopen, 4096);
			        $data = $file;
					//echo trim(substr($data,0,40)).strlen(trim(substr($data,40)))."<br>".trim(substr($data,40))."<br>";
					$item['title'] = trim(substr($data,0,40));
					$item['value'] = trim(substr($data,40));
					$item['value_length'] = strlen(trim(substr($data,40)));
								
				//$this->db->debug = true;
						if($item['value_length']==1712){
							$vrow++;
							//echo "VROW ::: ".$vrow."<BR>";
							//echo "TITLE::: ".$item['title']."<BR>";
							//echo "AAA:::".strpos($item['title'], 'เขต')."<BR>";
							//echo "AAA:::".eregi('^เขต',iconv('tis-620','utf-8',$item['title']));
							$item['title'] = iconv('tis-620','utf-8',$item['title']);					
							 //return eregi('^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$',$email);
							$chars = str_split($item['value'] , 8);
							$item['title']."<br>";
									if ($vrow==1) {
										$province_name = str_replace('จังหวัด', '', $item['title']);
										$province = $this->province->where(" province='".iconv('utf-8','tis-620',$province_name)."'")->get_row();						
										$province_id = @$province['id'];	
										if($province_id <1){
											echo iconv('utf-8','tis-620',"ไม่มีข้อมูลจังหวัด ".$item['title'])."<br>";
										}else{
											
				                        $val['ID'] = $this->ppl->select('id')->where(" PROVINCE_ID=".$province_id." AND AMPHUR_ID=0 AND DISTRICT_ID=0 AND YEAR_DATA=".$year_data)->get_one();
										if($val['ID']>0){
											$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$val['ID']);
										}	
															
										$val['PROVINCE_ID'] = $province_id;
										$val['PROVINCE_NAME'] = $province_name;
										$val['AMPHUR_ID'] = '0';
										$val['AMPHUR_NAME'] = '';
										$val['DISTRICT_ID'] = '0';
										$val['DISTRICT_NAME'] = '';			
										$val['YEAR_DATA'] = $year_data;					
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
										$val['IMPORT_SECTION_ID'] = (int)@$import_section_id;
										$is_org = 'N';
										$val['ORG_ID'] = 0;
										$val['IS_ORG'] = $is_org;
										$id = $this->ppl->save($val);					
											for($i=0;$i<=203;$i++){
												$val_sub['PID'] = $id;
												$val_sub['AGE_RANGE_CODE'] = $i+1;
												$val_sub['NUNIT'] = $chars[$i];
												$this->ppl_detail->save($val_sub);
											}	
										}				
									}
									else if (eregi('^อำเภอ',$item['title']) || eregi('^เขต',$item['title'])) {
										$amphur_name =  str_replace('อำเภอ', '', $item['title']) ;
										$amphur_name = str_replace('เขต', '', $amphur_name);								
										$amphur = $this->amphur->where(" province_id=".$province_id." AND AMPHUR_NAME='".iconv('utf-8','tis-620',$amphur_name)."'")->get_row();
										$amphur_id = @$amphur['id'];
										if($amphur_id<1)
										{
											echo iconv('utf-8','tis-620',"ไม่มี ไอดี อำเภอ ".$amphur_name)."<br>";
										}else{
										$val['ID'] = $this->ppl->select('id')->where(" PROVINCE_ID=".$province_id." AND AMPHUR_ID=".$amphur_id." AND DISTRICT_ID=0 AND YEAR_DATA=".$year_data)->get_one();
										if($val['ID']>0){
											$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$val['ID']);
										}
										$val['PROVINCE_ID'] = $province_id;
										$val['PROVINCE_NAME'] = $province_name;
										$val['AMPHUR_ID'] = $amphur_id;
										$val['AMPHUR_NAME'] = $amphur_name;
										$val['DISTRICT_ID'] = '';
										$val['DISTRICT_NAME'] = '';		
										$val['YEAR_DATA'] = $year_data;					
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
										$val['IMPORT_SECTION_ID'] = (int)@$import_section_id;
										$is_org = 'N';
										$val['ORG_ID'] = 0;
										$val['IS_ORG'] = $is_org;
										$id = $this->ppl->save($val);					
										
											for($i=0;$i<=203;$i++){
												$val_sub['PID'] = $id;
												$val_sub['AGE_RANGE_CODE'] = $i+1;
												$val_sub['NUNIT'] = $chars[$i];
												$this->ppl_detail->save($val_sub);
											}		
										}		
									}
									elseif(eregi('^แขวง',$item['title']) || eregi('^ตำบล',$item['title'])){
											$district_name = str_replace('แขวง', '', $item['title']);
											$district_name = str_replace('ตำบล', '', $district_name);											
											if($amphur_id<1){
												echo iconv('utf-8','tis-620',$item['title']." ไม่มี id amphur")."<br>";
											}else{
												$condition = " province_id=".$province_id." AND AMPHUR_ID=".$amphur_id."  AND DISTRICT_NAME='".iconv('utf-8','tis-620',$district_name)."'";
												$district = $this->district->where($condition)->get_row();
												if(@$district['id']<1){
													echo iconv('utf-8','tis-620',$item['title']." ไม่มี id ตำบล")."  ".$condition."<br>";
												}else{
													$amphur = $this->amphur->get_row($amphur_id);
													$district_id = @$district['id'];
													$val['ID'] = $this->ppl->select('id')->where(" PROVINCE_ID=".$province_id." AND AMPHUR_ID=".$district['amphur_id']." AND DISTRICT_ID=".$district_id." AND YEAR_DATA=".$year_data." AND IS_ORG='".$is_org."' ")->get_one();
													if($val['ID']>0){
														$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$val['ID']);
													}
													$val['PROVINCE_ID'] = $province_id;
													$val['PROVINCE_NAME'] = $province_name;
													$val['AMPHUR_ID'] = $amphur['id'];
													$val['AMPHUR_NAME'] = $amphur['amphur_name'];
													$val['DISTRICT_ID'] = $district_id;
													$val['DISTRICT_NAME'] = $district_name;		
													$val['YEAR_DATA'] = $year_data;					
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
													$val['IMPORT_SECTION_ID'] = (int)@$import_section_id;
													$val['IS_ORG'] = $is_org;
													$val['org_id'] = $org_id;
													$id = $this->ppl->save($val);					
													for($i=0;$i<=203;$i++){
														$val_sub['PID'] = $id;
														$val_sub['AGE_RANGE_CODE'] = $i+1;
														$val_sub['NUNIT'] = $chars[$i];
														$this->ppl_detail->save($val_sub);
													}		
												}
											}		
								}
								else if(eregi('^เทศบาล',$item['title'])){
									$org = $this->org->where(" name='".iconv('utf-8','tis-620',$item['title'])."' ")->get_row();
									$amphur = $this->amphur->where(" province_id=".$province_id." AND AMPHUR_NAME='".iconv('utf-8','tis-620',$org['amphor'])."'")->get_row();
									$amphur_id = $amphur['id'];
									$is_org = 'Y';	
									$org_id = $org['id'];						
								}
								
						}
					$index++;			
			    }				
			    fclose($objFopen);				
			}										 
		}
		
	}	
	
	function do_import($year_data,$file_name){
		//$this->db->debug = true;
		if($file_name!='' && $year_data !=''){
			/*--end--*/
			set_time_limit(0);
			$import_section_id=0;
			$if_exist = 0;
			$file_name=iconv('utf-8','tis-620',$file_name);
			$_POST['year_data'] = $year_data;
			$uploaddir = 'import_file/population/'.$year_data.'/';
			$fpicname = $uploaddir.$file_name;
			$data = $this->ReadData($uploaddir.$file_name);			
			foreach($data as $item):
				if(strpos($item['title'], 'เทศบาล')!==false){
					//$if_exist = 1;
					//echo iconv('utf-8','tis-620',$item['title']); 
					break;
				}
				//if($if_exist < 1)
				//{				
				if($item['value_length']==1712){
					$chars = str_split($item['value'] , 8);
					$item['title']."<br>";
					if (strpos($item['title'], 'จังหวัด')!==false) {
						$province_name = str_replace('จังหวัด', '', $item['title']);
						$province = $this->province->where(" province='".iconv('utf-8','tis-620',$province_name)."'")->get_row();						
						$province_id = @$province['id'];	
						if($province_id <1){
							echo iconv('utf-8','tis-620',"ไม่มีข้อมูลจังหวัด ".$item['title'])."<br>";
						}else{
						$_POST['province_id'] =$province_id;	
                        $val['ID'] = $this->ppl->select('id')->where(" PROVINCE_ID=".$_POST['province_id']." AND AMPHUR_ID=0 AND DISTRICT_ID=0 AND YEAR_DATA=".$_POST['year_data'])->get_one();
						if($val['ID']>0){
							$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$val['ID']);
						}						
						$val['PROVINCE_ID'] = $province_id;
						$val['PROVINCE_NAME'] = $province_name;
						$val['AMPHUR_ID'] = '0';
						$val['AMPHUR_NAME'] = '';
						$val['DISTRICT_ID'] = '0';
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
						$val['IMPORT_SECTION_ID'] = (int)$import_section_id;
						$id = $this->ppl->save($val);					
						
						for($i=0;$i<=203;$i++){
							$val_sub['PID'] = $id;
							$val_sub['AGE_RANGE_CODE'] = $i+1;
							$val_sub['NUNIT'] = $chars[$i];
							$this->ppl_detail->save($val_sub);
						}	
						}				
					}
					else if (strpos($item['title'], 'อำเภอ')!==false) {
						$amphur_name =  str_replace('อำเภอ', '', $item['title']) ;
						$amphur_name = str_replace('เขต', '', $amphur_name);
						$amphur = $this->amphur->where(" province_id=".$province_id." AND AMPHUR_NAME='".iconv('utf-8','tis-620',$amphur_name)."'")->get_row();
						$amphur_id = @$amphur['id'];
						if($amphur_id<1)
						{
							echo iconv('utf-8','tis-620',"ไม่มี ไอดี อำเภอ ".$amphur_name)."<br>";
						}else{
						$val['ID'] = $this->ppl->select('id')->where(" PROVINCE_ID=".$_POST['province_id']." AND AMPHUR_ID=".$amphur_id." AND DISTRICT_ID=0 AND YEAR_DATA=".$_POST['year_data'])->get_one();
						if($val['ID']>0){
							$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$val['ID']);
						}
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
						$val['IMPORT_SECTION_ID'] = (int)$import_section_id;
						$id = $this->ppl->save($val);					
						
						for($i=0;$i<=203;$i++){
							$val_sub['PID'] = $id;
							$val_sub['AGE_RANGE_CODE'] = $i+1;
							$val_sub['NUNIT'] = $chars[$i];
							$this->ppl_detail->save($val_sub);
						}		
						}		
					}
					elseif(strpos($item['title'], 'แขวง')!==false){
						$district_name = str_replace('แขวง', '', $item['title']);
						if($amphur_id<1){
							echo iconv('utf-8','tis-620',$item['title']." ไม่มี id amphur")."<br>";
						}else{
						$district = $this->district->where(" province_id=".$province_id." AND AMPHUR_ID=".$amphur_id."  AND DISTRICT_NAME='".iconv('utf-8','tis-620',$district_name)."'")->get_row();
						if(@$district['id']<1){
							echo iconv('utf-8','tis-620',$item['title']." ไม่มี id ตำบล")." <br>";
						}else{
						$amphur = $this->amphur->get_row($amphur_id);
						$district_id = @$district['id'];
						$val['ID'] = $this->ppl->select('id')->where(" PROVINCE_ID=".$province_id." AND AMPHUR_ID=".$district['amphur_id']." AND DISTRICT_ID=".$district_id." AND YEAR_DATA=".$_POST['year_data'])->get_one();
						if($val['ID']>0){
							$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$val['ID']);
						}
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
						$val['IMPORT_SECTION_ID'] = (int)$import_section_id;
						$id = $this->ppl->save($val);					
						for($i=0;$i<=203;$i++){
							$val_sub['PID'] = $id;
							$val_sub['AGE_RANGE_CODE'] = $i+1;
							$val_sub['NUNIT'] = $chars[$i];
							$this->ppl_detail->save($val_sub);
						}		
						}
						}		
					}
					else if (strpos($item['title'], 'ตำบล')!==false && strpos($item['title'], 'เทศบาล')===false) {
						$district_name = str_replace('ตำบล', '', $item['title']);
						if($amphur_id<1){
							echo iconv('utf-8','tis-620',$item['title']." ไม่มี id amphur")."<br>";
						}else{
						$district = $this->district->where(" province_id=".$province_id." AND AMPHUR_ID=".$amphur_id."  AND DISTRICT_NAME='".iconv('utf-8','tis-620',$district_name)."'")->get_row();
						if(@$district['id']<1){
							echo iconv('utf-8','tis-620',$item['title']." ไม่มี id ตำบล")." <br>";
						}else{
						$amphur = $this->amphur->get_row($amphur_id);
						$district_id = @$district['id'];
						$val['ID'] = $this->ppl->select('id')->where(" PROVINCE_ID=".$province_id." AND AMPHUR_ID=".$district['amphur_id']." AND DISTRICT_ID=".$district_id." AND YEAR_DATA=".$_POST['year_data'])->get_one();
						if($val['ID']>0){
							$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$val['ID']);
						}
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
						$val['IMPORT_SECTION_ID'] = (int)$import_section_id;
						$id = $this->ppl->save($val);					
						for($i=0;$i<=203;$i++){
							$val_sub['PID'] = $id;
							$val_sub['AGE_RANGE_CODE'] = $i+1;
							$val_sub['NUNIT'] = $chars[$i];
							$this->ppl_detail->save($val_sub);
						}		
						}
						}				
					}
				}	
				//}			
			endforeach;							
		}
		/*echo "<script>window.location='population';</script>";*/
		//redirect('population/index');
	}
	
	function sixtyup_index(){
		$data['menu_id'] = $this->menu_sixtyup_id;
		$condition= @$_GET['year_data']!='' ? " AND YEAR_DATA=".$_GET['year_data'] : "";
		$condition.= @$_GET['province_id']!='' ? " AND PROVINCE_ID=".$_GET['province_id'] : "";
		$condition.= @$_GET['amphur_id']!='' ? " AND AMPHUR_ID=".$_GET['amphur_id'] : "";
		$condition.= @$_GET['district_id']!='' ? " AND DISTRICT_ID=".$_GET['district_id'] : "";
		$sql = " SELECT * FROM (
		SELECT PPT.*, 		
		(SELECT SUM(NUNIT) FROM POPULATION_DETAIL WHERE PID=PPT.ID AND AGE_RANGE_CODE > 61 AND AGE_RANGE_CODE <=102 )NSIXTYUP_MALE,
		(SELECT SUM(NUNIT) FROM POPULATION_DETAIL WHERE PID=PPT.ID AND AGE_RANGE_CODE > 163 AND AGE_RANGE_CODE <=204 )NSIXTYUP_FEMALE
		FROM POPULATION PPT) WHERE (NSIXTYUP_MALE > 0 OR NSIXTYUP_FEMALE > 0) ".$condition." ORDER BY ID "; 
		$data['ppl'] = $this->ppl->where($condition)->get($sql);
		$data['pagination'] = $this->ppl->pagination();
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('sixtyup/index',$data);
	}
	
	function sixtyup_form($id=FALSE){
		$data['menu_id'] = $this->menu_sixtyup_id;		
		$data['item'] = $this->ppl->get_row($id);
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('sixtyup/form',$data);
	}
	
	function sixtyup_save(){
		if(!menu::perm($this->menu_sixtyup_id, 'add') || !menu::perm($this->menu_sixtyup_id,'edit'))redirect('population/index');
		$_POST['PROVINCE_NAME'] = $this->province->select("PROVINCE")->where("ID=".$_POST['province_id'])->get_one();
		$_POST['AMPHUR_NAME'] = $_POST['amphur_id'] > 0 ? $this->amphur->select("amphur_name")->where("ID=".$_POST['amphur_id'])->get_one() : "";
		$_POST['DISTRICT_NAME'] = $_POST['district_id'] > 0 ? $this->district->select("district_name")->where("ID=".$_POST['district_id'])->get_one() : "";		
		$id = $this->ppl->save($_POST);		
		$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$id." AND AGE_RANGE_CODE > 61 AND AGE_RANGE_CODE <=102");
		$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$id." AND AGE_RANGE_CODE > 163 AND AGE_RANGE_CODE <=204");			
		for($i=62;$i<=102;$i++){
			$value['age_range_code'] = $i;
			$value['pid'] = $id;
			$value['nunit'] = $_POST['male_'.$i];
			$this->ppl_detail->save($value);
		}
		
		for($i=62;$i<=102;$i++){
			$value['age_range_code'] = $i+102;
			$value['pid'] = $id;
			$value['nunit'] = $_POST['female_'.$i];
			$this->ppl_detail->save($value);
		}
		redirect('population/sixtyup_index');
	}
	
	function sixtyup_delete($id=FALSE){
		
		$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$id." AND AGE_RANGE_CODE > 61 AND AGE_RANGE_CODE <=102");
		$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID =".$id." AND AGE_RANGE_CODE > 163 AND AGE_RANGE_CODE <=204");				
		redirect('population/sixtyup_index');		
	}
	
	
	function dear_import_index(){
		
		$this->template->build('dear_import_index');
	}
	
	function dear_import(){
		$this->db->debug=true;
		$columns = $this->db->MetaColumnNames("POPULATION_DATA");
		foreach($columns as $item){
			$column[] = $item;
		}
		if($_FILES['fl_import']['name']!=''){						
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			/*---for insert value to info table ---*/
			// $import_section_id = $_POST['import_workgroup_id']> 0 ? $_POST['import_workgroup_id'] : $_POST['import_section_id'];
			// $_POST['section_id'] = $import_section_id;
			// $this->info->save($_POST);
			/*--end--*/
			$file_name = 'population_dear'.date("Y_m_d_H_i_s").'.'.$ext;
			$uploaddir = 'import_file/population/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
			
			
			
			require_once 'include/Excel/reader.php';
			$data = new Spreadsheet_Excel_Reader();
			$data -> setOutputEncoding('UTF-8');
			$data -> read($uploaddir.$file_name);						
			//error_reporting(E_ALL ^ E_NOTICE);
			$index = 0;
			//echo $data -> sheets[0]['numCols'];
			
			
			for($i = 4; $i <= $data -> sheets[0]['numRows']; $i++) {
				$value = null;
				//if(in_array(substr(trim($data -> sheets[0]['cells'][$i][1]),0,2), array(14,21,31,30,36))){				
				for($ncolumn = 1; $ncolumn <= $data -> sheets[0]['numCols'];$ncolumn++){
					$column_name = strtoupper(trim($column[$ncolumn]));
					$value[$column_name] = trim($data -> sheets[0]['cells'][$i][$ncolumn]); 						
				}
				//var_dump($value);
				$this->population_data->save($value);
			}					
		}
		redirect('population/index');
	}
}
?>