<?php 
class Child extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('c_drop_model','drop');
		$this->load->model('pregnant_model','pregnant');
	}
	
	public function drop()
	{
		$this->template->build('child/drop_index');
	}
	public function pregnant(){
		
		$sql= "	
			SELECT  year,ages,sum(ages) as sum_ages FROM
				(
						SELECT  id,year,to_char(m_birthday,'yyyy-mm-dd'),
												to_date(concat(substr(to_char(m_birthday,'yyyy-mm-dd'),0,4)-543,substr(to_char(m_birthday,'yyyy-mm-dd'),5)),'yyyy-mm-dd') ,
												to_date(to_char(sysdate,'yyyy-mm-dd'),'yyyy-mm-dd'),
												floor(months_between(to_date(to_char(sysdate,'yyyy-mm-dd'),'yyyy-mm-dd'),
												to_date(concat(substr(to_char(m_birthday,'yyyy-mm-dd'),0,4)-543,substr(to_char(m_birthday,'yyyy-mm-dd'),5)),'yyyy-mm-dd'))/12)as ages
						 FROM C_PREGNANT
						 WHERE 1=1
					) 
			GROUP BY year,ages
			ORDER BY ages";
		$result=$this->pregnant->get($sql);
		 foreach($result as $key=>$item){
		 	echo "key=".$key." item= ".$item;
		 }
		$this->template->build('child/pregnant_index');
	}
	function pregnant_parent()
	{
		
		$this->template->build('child/pregnant_parent');
	}
}
?>