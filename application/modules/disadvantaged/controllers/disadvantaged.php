<?php
Class Disadvantaged extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('province_model', 'province');
		
		$this->load->model('unemployee_model', 'unemployee');
		$this->load->model('vacancy_model', 'vacancy');
	}
	//========== UNEMPLOYEE ==========//
	function unemployee(){
		$sql = 'SELECT * FROM UNEMPLOYEE WHERE 1=1 ';
			if(@$_GET['YEAR']) $sql .= "AND YEAR = ".$_GET['YEAR'].' ';
			if(@$_GET['PROVINCE']) $sql .= "AND PROVINCE_ID = ".$_GET['PROVINCE'].' ';
		$sql .= 'ORDER BY YEAR DESC, PROVINCE_ID ASC';
		
		$data['result'] = $this->unemployee->get($sql);
    	$data['pagination'] = $this->unemployee->pagination;
		
		$this->template->build('unemployee/unemployee_index', $data);
	}
	
	function unemployee_form($id=FALSE){
		$wlist = $this->db->execute('SELECT * FROM UNEMPLOYEE');
		$data['id'] = @$id;
		if(@$id)
		{
			$data['result'] = $this->unemployee->get_row($id);
		}
		
		$this->template->build('unemployee/unemployee_form', $data);
	}
		function unemployee_save()
		{
			$this->unemployee->save($_POST);
			set_notify('success', lang('save_data_complete'));
			redirect('disadvantaged/unemployee');
		}
	function unemployee_delete($id=FALSE)
	{
		if($id)
		{
			$this->unemployee->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('disadvantaged/unemployee');
		}
		
	}
	//========== UNEMPLOYEE ==========//

	
	
	//========== VACANCY ==========//
	function vacancy(){
		$sql = 'SELECT * FROM VACANCY WHERE 1=1 ';
			if(@$_GET['YEAR']) $sql .= "AND YEAR = ".$_GET['YEAR'].' ';
			if(@$_GET['PROVINCE']) $sql .= "AND PROVINCE_ID = ".$_GET['PROVINCE'].' ';
		$sql .= 'ORDER BY YEAR DESC, PROVINCE_ID ASC';
		
		$data['result'] = $this->vacancy->get($sql);
    	$data['pagination'] = $this->vacancy->pagination;
		
		$this->template->build('vacancy/vacancy_index', $data);
	}	
	function vacancy_form($id=FALSE){
		$data['id'] = @$id;
		if(@$id)
		{
			$data['result'] = $this->vacancy->get_row($id);
		}
		
		$this->template->build('vacancy/vacancy_form', $data);
	}
		function vacancy_save()
		{
			$this->vacancy->save($_POST);
			set_notify('success', lang('save_data_complete'));
			redirect('disadvantaged/vacancy');
		}
	function vacancy_delete($id=FALSE)
	{
		if($id)
		{
			$this->vacancy->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('disadvantaged/vacancy');
		}
		
	}
		function vacancy_upload()
		{
			$ext = pathinfo($_FILES['file_import']['name'], PATHINFO_EXTENSION);
			
			$direct_name = 'import_file/vacancy';
			$file_name = 'vacancy_'.$_POST['YEAR'].'_'.date("Y_m_d_H_i_s").'.'.$ext;
			
			#echo $ext;
			move_uploaded_file($_FILES['file_import']['tmp_name'], $direct_name.'/'.$file_name);
			$data = $this->ReadData($direct_name.'/'.$file_name);
			echo $data;
			print_r($data);
			unlink($direct_name.'/'.$file_name);


			$_FILES['fl_import'] = $_FILES['file_import'];
/*			
			if($_FILES['fl_import']['name']!='xxxxx'){
#			$this->db->execute("DELETE FROM POPULATION_DETAIL WHERE PID IN (SELECT ID FROM POPULATION WHERE PROVINCE_ID=".$_POST['province_id']." AND YEAR_DATA=".$_POST['year_data'].")");
#			$this->db->execute("DELETE FROM POPULATION WHERE PROVINCE_ID=".$_POST['province_id']." AND YEAR_DATA=".$_POST['year_data']);
			$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
			$file_name = 'population_'.$_POST['province_id'].date("Y_m_d_H_i_s").'.'.$ext;
			$file_name = 'population'.'.'.$ext;			
			$uploaddir = 'import_file/population/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
			echo $fpicname;		
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
							#$this->ppl_detail->save($val_sub);
							print_r($val_sub);
							echo '<HR>';
						}						
					}
									
				}				
			endforeach;
			}*/
		}
	
	
	function vacancy_import()
	{
		$this->template->build('vacancy/vacancy_import');	
	}
	//========== VACANCY ==========//
				
	function social(){
		$this->template->build('social_index');
	}
	
	function social_form(){
		$this->template->build('social_form');
	}
	
	function province(){
		$this->template->build('province_index');
	}
	
	function province_form(){
		$this->template->build('province_form');
	}
	
	function allage(){
		$this->template->build('allage_index');
	}
	
	function allage_form(){
		$this->template->build('allage_form');
	}


}
?>