<?php
function login($username,$password)
{
	$CI =& get_instance();
	$sql = "select * from users where username = ? and password = ?";
	$id = $CI->db->GetOne($sql,array($username,$password));	
	if($id)
	{
		$CI->session->set_userdata('id',$id);
		$ip=(@getenv(HTTP_X_FORWARDED_FOR)) ? @getenv(HTTP_X_FORWARDED_FOR):@getenv(REMOTE_ADDR); 
		$CI->session->set_userdata('ipaddress',$ip);
		
		// $CI->db->execute("update users set status = 1 where id = $id");		
		//save_logfile("LOGIN","เข้าสู่ระบบ : ".$id." ".login_data("name"),"login");		
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
	$sql = 'SELECT "'.strtoupper($action).'" 
	FROM PERMISSION 
	WHERE USER_TYPE_ID = '.login_data('USER_TYPE_ID').' 
	AND MODULE = \''.$module.'\'';
	$CI =& get_instance();
	$perm = $CI->db->getone($sql);
	return $perm ? TRUE : FALSE;
}

// เช็ค checkbox ในหน้า usertype form
function permission_chk($module, $action, $user_type_id)
{
    $sql = 'SELECT "'.strtoupper($action).'" 
    FROM PERMISSION 
    WHERE USER_TYPE_ID = '.$user_type_id.' 
    AND MODULE = \''.$module.'\'';
    $CI =& get_instance();
    $perm = $CI->db->getone($sql);
    return $perm ? TRUE : FALSE;
}

function login_data($field)
{
	$CI =& get_instance();
	$sql = 'SELECT
PPT.USERS.ID,
PPT.USERS.USER_TYPE_ID,
PPT.USERS.FULLNAME,
PPT.USERS.NAME,
PPT.USERS.SURNAME,
PPT.USERS.DEPARTMENT_ID,
PPT.USERS.DIVISION_ID,
PPT.USERS.USERNAME,
PPT.USERS.STATUS,
PPT.WORKGROUP.WORKGROUP_NAME,
PPT.DIVISION.DIVISION_NAME,
PPT.DEPARTMENT.DEPARTMENT_NAME,
PPT.USER_TYPE.USER_TYPE_NAME,
PPT.USER_TYPE.USER_TYPE_LEVEL,
PPT.PERSON_TYPE.PERSON_TYPE_NAME,
PPT.USERS.WORKGROUP_ID,
PPT.USERS.PERSON_TYPE_ID
FROM
PPT.USERS
LEFT JOIN PPT.WORKGROUP ON PPT.USERS.WORKGROUP_ID = PPT.WORKGROUP.ID
LEFT JOIN PPT.DIVISION ON PPT.USERS.DIVISION_ID = PPT.DIVISION.ID
LEFT JOIN PPT.DEPARTMENT ON PPT.USERS.DEPARTMENT_ID = PPT.DEPARTMENT.ID
LEFT JOIN PPT.USER_TYPE ON PPT.USERS.USER_TYPE_ID = PPT.USER_TYPE.ID
LEFT JOIN PPT.PERSON_TYPE ON PPT.USERS.PERSON_TYPE_ID = PPT.PERSON_TYPE.ID 
WHERE PPT.USERS.ID = ?';
	if($CI->session->userdata('id')>0){
	$row = $CI->db->getrow($sql,$CI->session->userdata('id'));
	
	$field = strtolower($field);	
	}else{
		// redirect('home');
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
		redirect('home/login_page');
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