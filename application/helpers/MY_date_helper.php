<?php 
if ( ! function_exists('db_to_th'))
{
function db_to_th($datetime = '', $time = TRUE ,$format = 'F')
	{
		if($format == 'F')
		{
			$month_th = array( 1 =>'มกราคม',2 => 'กุมภาพันธ์',3=>'มีนาคม',4=>'เมษายน',5=>'พฤษภาคม',6=>'มิถุนายน',7=>'กรกฏาคม',8=>'สิงหาคม',9=>'กันยายน',10=>'ตุลาคม',11=>'พฤศจิกายน',12=>'ธันวาคม');
		}
		else
		{
			$month_th = array( 1 =>'ม.ค.',2 => 'ก.พ.',3=>'มี.ค.',4=>'เม.ย',5=>'พ.ค.',6=>'มิ.ย',7=>'ก.ค.',8=>'ส.ค.',9=>'ก.ย.',10=>'ต.ค.',11=>'พ.ย.',12=>'ธ.ค.');
		}
		
		$datetime = human_to_unix($datetime);
		
		if($format=='F')
			$r = date('d', $datetime).' '.$month_th[date('n', $datetime)].' '.(date('Y', $datetime) + 543);
		else
		 	$r = date('d', $datetime).'-'.date('n', $datetime).'-'.(date('Y', $datetime) + 543);

		if($time)
		{
				$r .= ' - '.date('H', $datetime).':'.date('i', $datetime);
		}
	
		return $r;
	}
}

if ( ! function_exists('unix_to_human_date'))
{
	function unix_to_human_date($time = '')
	{
		return date('Y', $time).'-'.date('m', $time).'-'.date('d', $time);
	}
}

function date_to_mysql($date,$is_date_thai = FALSE)
{
	list($d,$m,$y) = explode('-', $date);
	$y = ($is_date_thai) ? $y - 543 : $y;
	return $y.'-'.$m.'-'.$d;
}


function mysql_to_date($date,$is_date_thai = FALSE)
{
	@list($y,$m,$d) = @explode('-', $date);
	$y = ($is_date_thai) ? $y + 543 : $y;
	return @$date ? $d.'-'.$m.'-'.$y : NULL;
}

if(!function_exists('get_year_option'))
{
	function get_year_option($start = null, $plus = 0, $table = null, $field_year = null, $min = FALSE, $max = FALSE)
	{
	    $data = array();
        $year = (date('Y') + 543) + $plus;
        if(empty($start)) $start = 2535;
	    if(!empty($table) and !empty($field_year))
        {
            if($min == TRUE and $max == TRUE)
            {
                $rs = get_instance()->db->getrow('SELECT MAX('.$field_year.') AS MAX_YEAR, MIN('.$field_year.') AS MIN_YEAR FROM '.$table.' ');
                if($max == TRUE) $year = $rs['MAX_YEAR'];
                if($min == TRUE) $start = $rs['MIN_YEAR'];
                for($year; $year >= $start; $year--)
                {
                    $data[$year] = $year;
                }
            }
            else 
            {
                $rs = get_instance()->db->getarray('SELECT DISTINCT '.$field_year.' AS YEAR FROM '.$table.' ORDER BY '.$field_year.' DESC');
                foreach($rs as $item) $data[$item['YEAR']] = $item['YEAR'];
            }
            
            $data = is_array($data) ? $data : array();
            
        }else{
            for($year; $year >= $start; $year--)
            {
                $data[$year] = $year;
            }
        }
        
		return $data;
	}
}

if(!function_exists('get_month'))
{
	function get_month()
	{
		return array('1'=>'มกราคม','2'=>'กุมภาพันธ์','3'=>'มีนาคม','4'=>'เมษายน','5'=>'พฤษภาคม','6'=>'มิถุนายน','7'=>'กรกฏาคม','8'=>'สิงหาคม','9'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม');
	}
}


if(!function_exists('stamp_to_th'))
{
	function stamp_to_th($timestamp,$incl_time=FALSE)
	{
		if($timestamp > 0 )
		{
		$engdate = date('Y-m-d H:i:s', $timestamp);
		$thaidate = db_to_th($engdate,$incl_time,'');
		}
		else
		{
			$thaidate="";
		}
		return $thaidate;
	}
}
function en_to_stamp($date,$includeTime=FALSE)
{
	if($includeTime!= TRUE)
		{
			list($d, $m, $y) = explode("-", $date);
			$timestamp = strtotime($d . "-" . $m . "-" . $y);
		}else{
			$date = explode(" ",$date);
			list($d, $m, $y) = explode("-", $date[0]);
			$timestamp = strtotime($d . "-" . $m . "-" . $y." ".$date[1]);
		}
		return $timestamp;
}
if(!function_exists('th_to_stamp'))
{
	function th_to_stamp($thaidate,$includeTime = FALSE) 
	{
		if($thaidate=="")
		{
			$timestamp = 0;
		}
		else
		{
			if($includeTime!= TRUE)
			{
				list($d, $m, $y) = explode("-", $thaidate);
				$y = ($y + 543) > 3000 ? $y - 543 : $y;		
				$timestamp = strtotime($d . "-" . $m . "-" . $y);
			}else{						
				$date = explode(" ",$thaidate);
				list($d, $m, $y) = explode("-", $date[0]);
				$y = ($y + 543) > 3000 ? $y - 543 : $y;				 				
				$timestamp = strtotime($d . "-" . $m . "-" . $y." ".$date[1]);
			}
		}
		return $timestamp;
	}
}

if(!function_exists('stamp_to_th_fulldate'))
{
	function stamp_to_th_fulldate($timestamp)
	{
		if($timestamp > 0)
		{
		$th_date = date("Y-m-d", $timestamp);
		$th_date = db_to_th(date("Y-m-d H:i:s", $timestamp),FALSE,'F');
		}else{$th_date='';}
		return $th_date;
	}
}

if(!function_exists('stamp_to_th_abbrfulldate'))
{
	function stamp_to_th_abbrfulldate($timestamp)
	{
		$th_date = db_to_th(date("Y-m-d H:i:s", $timestamp),TRUE,'');
		return $th_date;
	}
}

function DB2Date($date)
{
	
	list($y,$m,$d) = explode('-', $date);
	$y = $y + 543;
	return $d.'/'.$m.'/'.$y;
}

function Date2DB($date){
	//list($date,$time)=explode(' ',$date);	
	list($y,$m,$d) = explode('-', $date);
	$y = $y + 543;
	return $d.'-'.$m.'-'.$y;
}

function Date2Oracle($date){
	list($d,$m,$y) = explode('/', $date);
	return trim($y).'-'.trim($m).'-'.trim($d);
}

function ThaiDatePicker2Oracle($date){
	list($d,$m,$y) = explode('-', $date);
	return $y.'-'.$m.'-'.$d;
}

function Oracle2ThaiDatePicker($date){
	list($y,$m,$d) = explode('-', $date);
	return $d.'-'.$m.'-'.$y;
}

function getAgefromThaidate($birthdate){
	list($y,$m,$d) = explode('-', $birthdate);
	$y = $y - 543; // แปลงให้เป็น ปี คศ.
	//get age from date or birthdate
	$age = (date("md", date("U", mktime(0, 0, 0, $d, $m, $y))) > date("md") ? ((date("Y")-$y)-1):(date("Y")-$y));
	return $age;
}

function getAgefromTimestamp($birth){
	$t = time();
	$age = ($birth < 0) ? ( $t + ($birth * -1) ) : $t - $birth;
	return floor($age/31536000);
}
?>