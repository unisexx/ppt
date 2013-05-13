<?php 
class Child extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('c_drop_model','drop');
		$this->load->model('pregnant_model','pregnant');
		$this->load->model('province_model','province');
	}
	
	public function drop()
	{
		$this->template->build('child/drop_index');
	}
	public function pregnant(){
		$province_id =(!empty($_GET['province_id'])) ? " and substr(m_address_code,0,2)='".$_GET['province_id']."'":'';
		$amphur_id =(!empty($_GET['amphur_id'])) ? " and substr(m_address_code,3,2)='".$_GET['amphur_id']."'":'';
		$district_id =(!empty($_GET['district_id'])) ? " and substr(m_address_code,6,2)='".$_GET['district_id']."'":'';
		$sql= "	
			SELECT  year,ages,sum(ages) as cnt FROM
				(
						SELECT  id,year,to_char(m_birthday,'yyyy-mm-dd'),
												to_date(concat(substr(to_char(m_birthday,'yyyy-mm-dd'),0,4)-543,substr(to_char(m_birthday,'yyyy-mm-dd'),5)),'yyyy-mm-dd') ,
												to_date(to_char(sysdate,'yyyy-mm-dd'),'yyyy-mm-dd'),
												floor(months_between(to_date(to_char(sysdate,'yyyy-mm-dd'),'yyyy-mm-dd'),
												to_date(concat(substr(to_char(m_birthday,'yyyy-mm-dd'),0,4)-543,substr(to_char(m_birthday,'yyyy-mm-dd'),5)),'yyyy-mm-dd'))/12)as ages
						 FROM C_PREGNANT
						 WHERE 1=1 $province_id
					) 
			GROUP BY year,ages
			ORDER BY year,ages";
		
		$result=$this->pregnant->limit(1000)->get($sql);
		$sum1=0;$sum2=0;$sum3=0;
		foreach($result as $item){
			if($item['ages']<15){
				$sum1=$sum1+$item['cnt'];
			}
			$val[$item['year']]['lower15']=$sum1;
			if($item['ages']==15 && $item['ages']<20){
				$sum2=$sum2+$item['cnt'];
			}
			$val[$item['year']]['equal']=$sum2;
			if($item['ages']>=20){
				$sum3=$sum3+$item['cnt'];
			}
			$val[$item['year']]['more']=$sum3;
		}		
		//var_dump($val);exit;
		$data['val']=$val;
		$this->template->build('child/pregnant_index',$data);
	}
	function pregnant_parent()
	{
		$province_id =(!empty($_GET['province_id'])) ? " and substr(m_address_code,0,2)='".$_GET['province_id']."'":'';
		if(!empty($_GET['province_id'])){
			$data['province'] =$this->province->get_one("province","id",$_GET['province_id']);
		}
		
		$year =(!empty($_GET['year'])) ? " and  year='".$_GET['year']."'":'';	
		$sql="
				SELECT  year,f_ages,m_ages,count(id) as cnt from
				(
					SELECT  id,year,to_date(to_char(sysdate,'yyyy-mm-dd'),'yyyy-mm-dd'),to_char(m_birthday,'yyyy-mm-dd'),
													to_date(concat(substr(to_char(m_birthday,'yyyy-mm-dd'),0,4)-543,substr(to_char(m_birthday,'yyyy-mm-dd'),5)),'yyyy-mm-dd') ,
													
													floor(months_between(to_date(to_char(sysdate,'yyyy-mm-dd'),'yyyy-mm-dd'),
													to_date(concat(substr(to_char(m_birthday,'yyyy-mm-dd'),0,4)-543,substr(to_char(m_birthday,'yyyy-mm-dd'),5)),'yyyy-mm-dd'))/12)as m_ages
													,to_char(f_birthday,'yyyy-mm-dd'),
													floor(months_between(to_date(to_char(sysdate,'yyyy-mm-dd'),'yyyy-mm-dd'),
													to_date(concat(substr(to_char(f_birthday,'yyyy-mm-dd'),0,4)-543,substr(to_char(f_birthday,'yyyy-mm-dd'),5)),'yyyy-mm-dd'))/12)as f_ages
												
							 FROM C_PREGNANT
							 WHERE 1=1 $province_id $year
				) GROUP BY year,f_ages,m_ages
				ORDER BY f_ages,m_ages		
		";
		$result = $this->pregnant->limit(1000)->get($sql);
		$sum=0;
		foreach($result as $item){
			if($item['f_ages']<=9 && $item['m_ages']<=9){
					$sum=$sum+$item['cnt'];
					$val[9][9]=$sum;				
			}			
			$val[$item['f_ages']][$item['m_ages']]=$item['cnt'];													
		}	
			$sum=0;
		
			for($i=9;$i<20;$i++){				 				
				for($j=20;$j<25;$j++){							
						$v=(!empty($val[$j][$i]))? $val[$j][$i]:0;
						$sum=$sum+$v;
						$val[20][$i]=$sum;
					}
				  $sum=0;
				for($j=25;$j<30;$j++){							
						$v=(!empty($val[$j][$i]))? $val[$j][$i]:0;
						$sum=$sum+$v;
						$val[21][$i]=$sum;
					}
				$sum=0;	
				for($j=30;$j<35;$j++){							
						$v=(!empty($val[$j][$i]))? $val[$j][$i]:0;
						$sum=$sum+$v;
						$val[22][$i]=$sum;
					}
				$sum=0;	
				for($j=35;$j<40;$j++){							
						$v=(!empty($val[$j][$i]))? $val[$j][$i]:0;
						$sum=$sum+$v;
						$val[23][$i]=$sum;
					}
				$sum=0;	
				for($j=40;$j<45;$j++){							
						$v=(!empty($val[$j][$i]))? $val[$j][$i]:0;
						$sum=$sum+$v;
						$val[24][$i]=$sum;
					}
				$sum=0;	
				for($j=45;$j<50;$j++){							
						$v=(!empty($val[$j][$i]))? $val[$j][$i]:0;
						$sum=$sum+$v;
						$val[25][$i]=$sum;
					}
				$sum=0;	
				for($j=50;$j<55;$j++){							
						$v=(!empty($val[$j][$i]))? $val[$j][$i]:0;
						$sum=$sum+$v;
						$val[26][$i]=$sum;
					}
				$sum=0;	
				for($j=55;$j<60;$j++){							
						$v=(!empty($val[$j][$i]))? $val[$j][$i]:0;
						$sum=$sum+$v;
						$sumage55[$i]=$sum;
					}
				$sum=0;	
				for($j=60;$j<100;$j++){							
						$v=(!empty($val[$j][$i]))? $val[$j][$i]:0;
						$sum=$sum+$v;
						$sumage60[$i]=$sum;
					}
				$sum=0;	
			}
	
		$data['val']=$val;		
		$this->template->build('child/pregnant_parent',$data);
	}
}
?>