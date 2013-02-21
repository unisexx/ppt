<?php
class Testdb extends Controller
{	

	public function index()
	{
		$query = $this->db->getarray('select * from EMPLOYEE');
		foreach($query as $item)
		{
			echo $item['FIRSTNME'].br();
		}
	}
	
}
?>