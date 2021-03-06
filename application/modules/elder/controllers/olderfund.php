<?php
Class Olderfund extends Public_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('olderfund_model', 'older');
		$this->load->model('province_model','province');
	}
	function index()
	{
		$set_year = $this->older->get("SELECT YEAR FROM OLDERFUND GROUP BY YEAR ORDER BY YEAR DESC");
        $num = count($set_year);
		for($i=0; $i<$num; $i++)
		{ $data['set_year'][$set_year[$i]['year']] = $set_year[$i]['year']; }

		$data['result'] = $this->older->get("SELECT * FROM OLDERFUND  ORDER BY YEAR DESC,PROVINCE ASC ");
		$data['pagination'] = $this->older->pagination;
		$this->template->build('olderfund/index',$data);

	}
	function ReadData($filepath)
	{
		@require_once 'include/Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data -> setOutputEncoding('UTF-8');
		$data -> read($filepath);

		error_reporting(E_ALL ^ E_NOTICE);
		$index = 0;
		for($i = 1; $i <= $data -> sheets[0]['numRows']; $i++) {
			$cnt_colum = count($data->sheets[0]['cells'][$i]);
			for($j=1; $j<=$cnt_colum; $j++) { $import[$index][] = trim($data -> sheets[0]['cells'][$i][$j]); }
			$index++;
		}
		return $import;
	}
	function form($id=FALSE){
		$data['rs'] = $this->older->get_row($id);
		$this->template->build('olderfund/form',$data);
	}
	function import(){
		$this->template->build('olderfund/import');
	}
	function upload()
	{
		$this->older->delete('YEAR',$_POST['year_data']);
		$ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
		$file_name = 'olderfund_'.date("Y_m_d_H_i_s").'.'.$ext;	$uploaddir = 'import_file/elder/olderfund/';
		move_uploaded_file($_FILES['fl_import']['tmp_name'], $uploaddir.$file_name);
		$data = $this->ReadData($uploaddir.$file_name);
		$num = count($data)-1;
		unlink($uploaddir.$file_name);
		$_POST['YEAR'] = $_POST['year_data'];
		for($i=2; $i<$num; $i++)
		{
			$_POST['PROVINCE'] = trim($data[$i][0]);
			$_POST['TOTAL_PERSON'] = $data[$i][1];
			$_POST['TOTAL_MONEY_PERSON'] = $data[$i][2];
			$_POST['TOTAL_PROJECT'] = $data[$i][3];
			$_POST['TOTAL_MONEY_PROJECT'] = $data[$i][4];
			$this->older->save($_POST);
		}
		$this->template->build('olderfund/upload');
	}
	function save($menu)
	{
			$id = $this->older->save($_POST);
			if(empty($_POST['id'])) logs('เพิ่มรายการ ', $menu_id, $id); else logs('แก้ไขรายการ', $menu_id, $id);
			set_notify('success', lang('save_data_complete'));	redirect('elder/olderfund/');
	}
	function delete($menu_id,$id)
	{
		if($id)
		{
			logs('ลบรายการ', $menu_id, $id);
			$this->older->delete($id);
            set_notify('success', lang('delete_data_complete'));	redirect('elder/olderfund/');
		}
	}
}