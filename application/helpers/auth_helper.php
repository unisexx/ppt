<?php
function login($username,$password)
{
	$CI =& get_instance();
	$sql = "select * from users where username = ? and password = ? and STATUS ='1'";
	$id = $CI->db->GetOne($sql,array($username,$password));	
	if($id)
	{
		$CI->session->set_userdata('id',$id);
		$ip=(@getenv(HTTP_X_FORWARDED_FOR)) ? @getenv(HTTP_X_FORWARDED_FOR):@getenv(REMOTE_ADDR); 
		$CI->session->set_userdata('ipaddress',$ip);
		
		$CI->db->execute("update users set status = 1 where id = $id");		
		save_logfile("LOGIN","เข้าสู่ระบบ : ".$id." ".login_data("name"),"login");		
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}


function is_login($usertype = FALSE)
{
	$CI =& get_instance();
	if($usertype)
	{		
		$sql = 'select id from users where id = ? and user_type = ?';
		$id = $CI->db->GetOne($sql,array($CI->session->userdata('id'),$CI->db->getone('select id from user_types where id = ?',$usertype)));
	}
	else
	{
		$sql = 'select id from users where id = ?';
		$id = $CI->db->GetOne($sql,$CI->session->userdata('id'));
	}
	return ($id) ? true : false;
}

function permission($module, $action)
{
	$sql = 'SELECT '.strtoupper($action).' 
	FROM USERTYPE 
	WHERE USERTYPETITLEID = (SELECT ID FROM USER_TYPE_TITLE WHERE USER_ID='.login_data('ID').')  
	AND MODULENAME = \''.$module.'\'';
	$CI =& get_instance();
	$perm = $CI->db->getone($sql);
	return $perm == 'on' ? TRUE : FALSE;
}

function login_data($field)
{
	$CI =& get_instance();
	//$CI->db->debug=TRUE;
		$sql = 'select users.*
		,user_type_title.title usertype_title
		,user_type_title.budgetadmin
		,user_type_title.budgetcanaccessall
		,lv ,is_inspector ,insp_access_all, mt_access_all, fn_access_all
		,cnf_workgroup.title workgroup_title, cnf_workgroup.divisionid, cnf_workgroup.wprovinceid workgroup_provinceid, pwg.title workgroup_province_name,cwg_province_area.id workgroup_province_area_id,cwg_province_area.title workgroup_province_area_name
		,cnf_division.title division_title, cnf_division.departmentid, cnf_division.provinceid division_provinceid, pdv.title division_province_name,cdv_province_area.id division_province_area_id,cdv_province_area.title division_province_area_name		
		,cnf_department.title department_title
		from users
		left join cnf_workgroup  on users.workgroupid = cnf_workgroup.id
		left join cnf_division on users.divisionid = cnf_division.id
		left join cnf_department on cnf_division.departmentid = cnf_department.id
		left join user_type_title on users.id=user_type_title.user_id
		left join cnf_province pdv on cnf_division.provinceid = pdv.id
		left join cnf_province pwg on cnf_workgroup.wprovinceid = pwg.id	
		left join cnf_province_area cdv_province_area on pdv.area = cdv_province_area.id
		left join cnf_province_area cwg_province_area on pwg.area = cwg_province_area.id
		where users.id = ?';
	if($CI->session->userdata('id')>0){
	$row = $CI->db->getrow($sql,$CI->session->userdata('id'));
	
	$field = strtolower($field);	
	}else{
		redirect('home');
	}

	
	
	$user_province = $row['WORKGROUP_PROVINCEID'] > 0  ? $row['WORKGROUP_PROVINCEID'] : 0;
	$user_province = $user_province == 0 && $row['DIVISION_PROVINCEID'] ==2  ? 2 : $user_province;
	$row['user_area'] = $user_province == 2 ? 'central' : 'domestic';
	$row['user_province_id'] = $user_province;
	$row['user_province_title'] = $CI->db->getone("select title from cnf_province where id=".$row['user_province_id']);
	$row['user_province_area_id'] = $CI->db->getone("select AREA from cnf_province where id=".$row['user_province_id']);	
	$row['user_province_area_title'] = $CI->db->getone("select TITLE from cnf_province_area where id=".$row['user_province_area_id']);
	$row['social_province_id']=0;
	$row['home_province_id']=0;
	if($row['DIVISIONID']==108){
		$row['social_province_id']= $row['user_province_id'];
	}
	if($row['DIVISIONID']==110){
		$row['home_province_id']= $row['user_province_id'];
	}
	
	
	dbConvert($row);
	return $row[$field];
}

function logout()
{
	$CI =& get_instance();
	//$CI->db->execute("update users set status = 0 where id = ".$CI->session->userdata('id')."");
	save_logfile("LOGOUT","ออกจากระบบ : ".login_data("id")." ".login_data("name"),"logout");		
	$CI->session->unset_userdata('id');
}

function time_login_update($id){
	$CI =& get_instance();
	$CI->db->execute("UPDATE users SET TIME_LOGIN= ".time()." WHERE id = $id");
}

function time_check_last_login(){
	$CI =& get_instance();
	$CI->db->execute("UPDATE users SET STATUS = 0 WHERE TIME_LOGIN <=".(time()-600));
}

function login_chk(){
	$CI =& get_instance();
	if($CI->session->userdata('id') == ""){
		redirect('home');
	}
}

function save_logfile($action_type=FALSE,$action=FALSE,$modules_name=FALSE){
	
	$CI=& get_instance();
	$process_date = en_to_stamp(date("Y-m-d H:i:s"),TRUE);	
	$sql = "INSERT INTO USER_LOGFILE (ID,USERID, IPADDRESS,ACTIONTYPE,ACTION, MODULE_NAME,PROCESS_DATE)VALUES(
		(select COALESCE(max(ID),0)+1 from USER_LOGFILE),
		".login_data("id").",'".$_SERVER['REMOTE_ADDR']."','".$action_type."','".iconv("UTF-8","TIS-620//IGNORE",$action)."','".$modules_name."',".$process_date."
	)";
	$CI->db->Execute($sql);
}
function new_save_logfile($action_type=FALSE,$modules_title=FALSE,$table=FALSE,$PK="ID",$ID=FALSE,$column=FALSE,$modules_name=FALSE,$description=FALSE){
	$CI=& get_instance();
	//$CI->db->debug=true;
	switch($action_type){
		case "VIEW":
			$cap = "ดูรายละเอียด";
		break;
		case "ADD":
			$cap="เพิ่ม";
		break;
		case "EDIT":
			$cap="แก้ไข";
		break;
		case "DELETE":
			$cap = "ลบ";
		break;
		default:
			$cap ="";
		break;
	}
	
	$table = $table=="FALSE" ? $modules_name : $table;
	$data = $CI->db->getrow("SELECT * FROM ".$table." WHERE ".$PK."=".$ID);	
	dbConvert($data);
	$action= $cap.$modules_title." ID : ".$ID." ".$data[$column];
	$action.= $description != FALSE ? $description : "";			
	$process_date = en_to_stamp(date("Y-m-d H:i:s"),TRUE);	
	$sql = "INSERT INTO USER_LOGFILE (ID,USERID, IPADDRESS,ACTIONTYPE,ACTION, MODULE_NAME,PROCESS_DATE)VALUES(
		(select COALESCE(max(ID),0)+1 from USER_LOGFILE),
		".login_data("id").",'".$_SERVER['REMOTE_ADDR']."','".$action_type."','".iconv("UTF-8","TIS-620//IGNORE",$action)."','".$modules_name."',".$process_date."
	)";
	$CI->db->Execute($sql);
}
function get_logaction($action_type,$modules_title){
	switch($action_type){
		case "VIEW":
			$cap = "ดูรายละเอียด";
		break;
		case "ADD":
			$cap="เพิ่ม";
		break;
		case "EDIT":
			$cap="แก้ไข";
		break;
		case "DELETE":
			$cap = "ลบ";
		break;
		default:
			$cap ="";
		break;
	}
	return $cap;
}
?>