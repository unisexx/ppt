<?
function GetMainActTotal($pMTYear = FALSE,$pMainActID = FALSE,$pDepartmentID = FALSE, $pDivisionID = FALSE, $pProvinceID=0){
	$CI =& get_instance();
	//$CI->db->debug = true;	
	$sql = " SELECT COUNT(*) FROM MT_PROJECT ";
	$sql.= " LEFT JOIN MT_PROJECT_SUBDETAIL ON MT_PROJECT.ID = MT_PROJECT_SUBDETAIL.MASTERID ";
	$sql.= " LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID = MT_STRATEGY.ID 	WHERE MT_PROJECT.PID > 0 ";
	$sql.= $pMTYear > 0 ? " AND MTYEAR=".$pMTYear : ""; 
	$sql.= $pMainActID > 0 ? " AND MAINACTID=".$pMainActID : "";
	$sql.= $pDepartmentID > 0 ? " AND DEPARTMENTID=".$pDepartmentID : "";
	if($pProvinceID != 2){
	$sql.= $pDivisionID > 0 ? " AND DIVISIONID=".$pDivisionID : "";
	}
	$sql.= $pProvinceID >0 ? " AND MT_PROJECT_SUBDETAIL.PROVINCEID=".$pProvinceID : "";
	$exist_sub = $CI->db->getone($sql);
	
	
	$sql = "SELECT SUM(SBUDGET)TOTAL FROM MT_PROJECT ";
	$sql.= " LEFT JOIN MT_PROJECT_SUBDETAIL ON MT_PROJECT.ID = MT_PROJECT_SUBDETAIL.MASTERID ";
	$sql.= " LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID = MT_STRATEGY.ID ";
	$sql.= " WHERE 1=1 ";
	$sql.= $pMTYear > 0 ? " AND MTYEAR=".$pMTYear : ""; 
	$sql.= $pMainActID > 0 ? " AND MAINACTID=".$pMainActID : "";
	$sql.= $pDepartmentID > 0 ? " AND DEPARTMENTID=".$pDepartmentID : "";
	if($pProvinceID==2){
	$sql.= $pDivisionID > 0 ? " AND MT_PROJECT_SUBDETAIL.DIVISIONID=".$pDivisionID : "";
	}
	$sql.= $exist_sub > 0 ? " AND MT_PROJECT.PID > 0 " : " AND MT_PROJECT.PID < 1 ";
	$sql.= $pProvinceID >0 ? " AND MT_PROJECT_SUBDETAIL.PROVINCEID=".$pProvinceID : "";
	//WHERE 
	$result = $CI->db->getrow($sql);
	$total = $result['TOTAL'];
	return $total;
}
function GetSubActTotal($pMTYear = FALSE,$pSubActID = FALSE,$pDepartmentID = FALSE, $pDivisionID = FALSE,$pProvinceID=0){
	$CI =& get_instance();	
	
	$sql = "SELECT COUNT(*) FROM MT_PROJECT ";
	$sql.= " LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID = MT_STRATEGY.ID ";
	$sql.= " LEFT JOIN MT_PROJECT_SUBDETAIL ON MT_PROJECT.ID = MT_PROJECT_SUBDETAIL.MASTERID ";
	$sql.= " WHERE MT_PROJECT.PID >0 ";
	$sql.= $pMTYear > 0 ? " AND MTYEAR=".$pMTYear : "";
	$sql.= $pSubActID > 0 ? " AND SUBACTID=".$pSubActID : "";
	$sql.= $pDepartmentID > 0 ? " AND DEPARTMENTID=".$pDepartmentID : "";
	if($pProvinceID==2){
	$sql.= $pDivisionID > 0 ? " AND DIVISIONID=".$pDivisionID : "";
	}
	$sql.= $pProvinceID > 0 ? " AND MT_PROJECT_SUBDETAIL.PROVINCEID=".$pProvinceID : "";
	
	$exist_sub = $CI->db->getone($sql);
	
	
	$sql = "SELECT SUM(SBUDGET)TOTAL FROM MT_PROJECT ";	
	$sql.= " LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID = MT_STRATEGY.ID ";
	$sql.= " LEFT JOIN MT_PROJECT_SUBDETAIL ON MT_PROJECT.ID = MT_PROJECT_SUBDETAIL.MASTERID ";
	$sql.= " WHERE 1=1 ";
	$sql.= $pMTYear > 0 ? " AND MTYEAR=".$pMTYear : "";
	$sql.= $pSubActID > 0 ? " AND SUBACTID=".$pSubActID : "";
	$sql.= $pDepartmentID > 0 ? " AND DEPARTMENTID=".$pDepartmentID : "";
	if($pProvinceID==2){
	$sql.= $pDivisionID > 0 ? " AND MT_PROJECT_SUBDETAIL.DIVISIONID=".$pDivisionID : "";
	}
	$sql.= $pProvinceID > 0 ? " AND MT_PROJECT_SUBDETAIL.PROVINCEID=".$pProvinceID : "";
	$sql.= $exist_sub > 0 ? " AND MT_PROJECT.PID > 0 " : " AND MT_PROJECT.PID < 1 ";	
	//WHERE 
	$result = $CI->db->getrow($sql);
	$total = $result['TOTAL'];
	return $total;
}
function GetProjectTotal($pMTYear = FALSE,$pSubActID = FALSE,$pProjectID = FALSE,$pMainProjectID = 0 ,$pDepartmentID = FALSE, $pDivisionID = FALSE, $pProvinceID=0){
	$CI =& get_instance();	
	//$CI->db->debug=true;
	$sql = "
	SELECT SUM(TOTAL) FROM (
	SELECT SUM(SBUDGET)TOTAL FROM MT_PROJECT ";
	$sql.= " LEFT JOIN MT_PROJECT_SUBDETAIL ON MT_PROJECT.ID = MT_PROJECT_SUBDETAIL.MASTERID ";
	$sql.= " LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID = MT_STRATEGY.ID ";
	$sql.= " WHERE 1=1 ";
	$sql.= $pMTYear > 0 ? " AND MTYEAR=".$pMTYear : "";	
	$sql.= $pSubActID > 0 ? " AND SUBACTID=".$pSubActID : "";
	$sql.= $pDepartmentID > 0 ? " AND DEPARTMENTID=".$pDepartmentID : "";
	if($pProvinceID==2){
	$sql.= $pDivisionID > 0 ? " AND MT_PROJECT_SUBDETAIL.DIVISIONID=".$pDivisionID : "";
	}
	$sql.= $pMainProjectID > 0 ? " AND MT_PROJECT.ID=".$pProjectID : " AND (MT_PROJECT.ID=".$pProjectID.") ";
	$sql.= $pProvinceID > 0 ? " AND MT_PROJECT_SUBDETAIL.PROVINCEID=".$pProvinceID : "";
	$sql.=")";
	//WHERE 
	//echo $sql;
	$result = $CI->db->getone($sql);
	return $result;
}
function GetMainActWithdraw($pWYear = FALSE,$pWMonth = FALSE,$pMainActID = FALSE,$pDepartmentID = FALSE, $pDivisionID = FALSE,$pProvinceID=0){
	$CI =& get_instance();	
	$sql = "
SELECT SUM(BUDGET) FROM MT_PROJECT_WITHDRAW_DETAIL MPWD WHERE ID IN(
SELECT DISTINCT( MT_PROJECT_WITHDRAW_DETAIL.ID) FROM MT_PROJECT_WITHDRAW_DETAIL 
LEFT JOIN MT_PROJECT_WITHDRAW MPW ON MT_PROJECT_WITHDRAW_DETAIL.PID = MPW.ID 
LEFT JOIN MT_PROJECT MP ON MPW.PROJECTID = MP.ID 
LEFT JOIN MT_PROJECT_SUBDETAIL ON MP.ID = MT_PROJECT_SUBDETAIL.MASTERID 
";
	$sql.= " WHERE 1=1 ";
	$sql.= $pWYear > 0 ? " AND MT_PROJECT_WITHDRAW_DETAIL.WYEAR=".$pWYear : "";
	$sql.= $pWMonth > 0 ? " AND  MT_PROJECT_WITHDRAW_DETAIL.WMONTH=".$pWMonth : ""; 
	$sql.= $pMainActID > 0 ? " AND SUBACTID IN (SELECT ID FROM MT_STRATEGY WHERE PID=".$pMainActID.")" : "";
	$sql.= $pDepartmentID > 0 ? " AND DEPARTMENTID=".$pDepartmentID : "";
	//if($pProvinceID==2){
		$sql.= $pDivisionID > 0 ? " AND MPW.DIVISIONID=".$pDivisionID : "";
	//}
	
	$sql.= $pProvinceID > 0 ? " AND MPWD.PROVINCEID=".$pProvinceID : "";
	$sql.=")";	
	//echo $sql.'<br>'; 
	$result = $CI->db->getone($sql);		
	return $result;
}
function GetSubActWithdraw($pWYear = FALSE,$pWMonth = FALSE,$pSubActID = FALSE,$pDepartmentID = FALSE, $pDivisionID = FALSE,$pProvinceID=0){
	
	$CI =& get_instance();	
	$sql = "
	SELECT  SUM(MPWD.BUDGET)
	FROM MT_PROJECT_WITHDRAW MPW 
	LEFT JOIN MT_PROJECT_WITHDRAW_DETAIL MPWD ON MPW.ID = MPWD.PID
	LEFT JOIN MT_PROJECT MP ON MPWD.PROJECTID = MP.ID "; 
	$sql.= " WHERE 1=1 ";
	$sql.= $pWYear > 0 ? " AND  MPWD.WYEAR=".$pWYear : "";
	$sql.= $pWMonth > 0 ? " AND  MPWD.WMONTH=".$pWMonth : ""; 
	$sql.= $pSubActID > 0 ? " AND SUBACTID=".$pSubActID : "";
	$sql.= $pDepartmentID > 0 ? " AND DEPARTMENTID=".$pDepartmentID : "";
	if($pProvinceID==2){
	$sql.= $pDivisionID > 0 ? " AND MPWD.DIVISIONID=".$pDivisionID : "";
	}
	$sql.= $pProvinceID > 0 ? " AND MPWD.PROVINCEID=".$pProvinceID : "";
	//$sql.=")";
	//echo $sql.'<br>';
	//if($pWMonth=='')echo $sql.'</br>';	
	//WHERE 
	$result = $CI->db->getone($sql);
	return $result;
}
function GetProjectWithdraw($pWYear = FALSE,$pWMonth = FALSE,$pSubActID = FALSE,$pProjectID = FALSE,$pMainProjectID = 0 ,$pDepartmentID = FALSE, $pDivisionID = FALSE,$pProvinceID=0){
	$CI =& get_instance();	
	/*
	 $sql = "SELECT SUM(MT_PROJECT_WITHDRAW_DETAIL.BUDGET)TOTAL FROM MT_PROJECT_WITHDRAW ";
	$sql.= " LEFT JOIN MT_PROJECT_WITHDRAW_DETAIL ON MT_PROJECT_WITHDRAW.ID=MT_PROJECT_WITHDRAW_DETAIL.PID ";
	$sql.= " LEFT JOIN MT_PROJECT ON MT_PROJECT_WITHDRAW.PROJECTID = MT_PROJECT.ID ";
	$sql.= " LEFT JOIN MT_PROJECT_DETAIL ON MT_PROJECT.ID = MT_PROJECT_DETAIL.MASTERID ";
	$sql.= " LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID = MT_STRATEGY.ID ";
	 * 
	 */
	$sql="
	SELECT SUM(TOTAL) FROM (
	SELECT SUM(MT_PROJECT_WITHDRAW_DETAIL.BUDGET)TOTAL 
	FROM MT_PROJECT_WITHDRAW 
	LEFT JOIN MT_PROJECT_WITHDRAW_DETAIL ON MT_PROJECT_WITHDRAW.ID=MT_PROJECT_WITHDRAW_DETAIL.PID 
	LEFT JOIN MT_PROJECT ON MT_PROJECT_WITHDRAW.PROJECTID = MT_PROJECT.ID "; 
	//if($pWMonth!='')echo $sql."<br>";
	$sql.= " WHERE 1=1 ";
	$sql.= $pWYear > 0 ? " AND  MT_PROJECT_WITHDRAW.WYEAR=".$pWYear : "";
	$sql.= $pWMonth > 0 ? " AND  MT_PROJECT_WITHDRAW.WMONTH=".$pWMonth : ""; 
	$sql.= $pSubActID > 0 ? " AND SUBACTID=".$pSubActID : "";
	$sql.= $pDepartmentID > 0 ? " AND DEPARTMENTID=".$pDepartmentID : "";
	if($pProvinceID==2){
	$sql.= $pDivisionID > 0 ? " AND MT_PROJECT_WITHDRAW.DIVISIONID=".$pDivisionID : "";
	}
	$sql.= $pProvinceID > 0 ? " AND MT_PROJECT_WITHDRAW.PROVINCEID=".$pProvinceID : "";
	$sql.= $pMainProjectID < 1  ? " AND MT_PROJECT_WITHDRAW_DETAIL.PROJECTID=".$pProjectID : " AND (MT_PROJECT.PID=".$pMainProjectID." OR MT_PROJECT.ID=".$pProjectID." OR MT_PROJECT.PID=".$pProjectID." ) ";
	$sql.=")";
	//echo $sql."<br>";
	//WHERE 
	$result = $CI->db->getone($sql);
	return $result;
}
function CountSubProject($pMainProjectID=FALSE){
	if($pMainProjectID > 0 )
	{
		$CI =& get_instance();
		$sql = " SELECT COUNT(*)NRECORD FROM MT_PROJECT WHERE PID=".$pMainProjectID;
		$nrecord = $CI->db->getrow($sql);
		return $nrecord["NRECORD"];
	}	
	else
	{
		return 0;
	}
}
function GetStrategyDetail($pID=FALSE)
{
	if($pID > 0)
	{
		$CI =& get_instance();
		$result = $CI->db->getrow("SELECT * FROM MT_STRATEGY WHERE ID=".$pID);
		dbConvert($result);
		return $result; 
	}
	else
	{
		return '';
	}
}
function GetStrategyKey($pProductivityID=FALSE)
{
	if($pProductivityID > 0 )
	{
		$CI =& get_instance();
		$result = $CI->db->getarray("SELECT * FROM MT_STRATEGY_KEY WHERE PID=".$pProductivityID);
		dbConvert($result);
		return $result; 		
	}
	else
	{
		return '';
	}
}
function CalculateBudgetNet($pMtYear=FALSE,$pBudgetTypeID=FALSE, $pProjectID=FALSE,$pWithdrawID=FALSE,$pProvinceID=0,$pMtMonth=0)
{
	if($pMtYear > 0 && $pBudgetTypeID > 0 && $pProjectID > 0)
	{
		$CI =& get_instance();	
		//$CI->db->debug=true;	
		$total = $CI->db->getone("SELECT SBUDGET FROM MT_PROJECT_SUBDETAIL WHERE MASTERID=".$pProjectID." AND SBUDGETTYPEID=".$pBudgetTypeID." AND PROVINCEID=".$pProvinceID);
		$sql = "SELECT SUM(BUDGET) FROM MT_PROJECT_WITHDRAW mpw LEFT JOIN MT_PROJECT_WITHDRAW_DETAIL mpwd ON mpw.ID = mpwd.PID WHERE mpwd.PROJECTID=".$pProjectID." 
		AND BUDGETTYPEID=".$pBudgetTypeID." AND mpwd.WYEAR=".$pMtYear." AND mpwd.WMONTH <> ".$pMtMonth." AND mpwd.PROVINCEID=".$pProvinceID;
		//$sql.= $pWithdrawID > 0 ? " AND mpw.ID <> ".$pWithdrawID : "";
		$totalwd = $CI->db->getone($sql);
		$net = $total - $totalwd;
		return $net;
	}
	else{
		return 0;	
	}	
}

function CheckInputStatus($mtyear,$month,$departmentid,$provinceid,$divisionid=FALSE,$subactivityid=FALSE,$projectid=FALSE)
{	
	$CI =& get_instance();	
	
	$table = " MT_PROJECT_WITHDRAW ";
	$table.= " LEFT JOIN MT_PROJECT ON MT_PROJECT_WITHDRAW.PROJECTID = MT_PROJECT.ID ";
	$table.= " LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID = MT_STRATEGY.ID ";
	$table.= " LEFT JOIN CNF_DIVISION ON MT_PROJECT.DIVISIONID =CNF_DIVISION.ID ";	
	$option= $provinceid > 0 ? " AND MT_PROJECT_WITHDRAW.PROVINCEID=".$provinceid :"";
	if($provinceid == 2){
		$option.= $divisionid > 0 ? " AND MT_PROJECT_WITHDRAW.DIVISIONID=".$divisionid : '';
	}
	$option.= $subactivityid > 0 ? " AND MT_PROJECT.SUBACTID=".$subactivityid : '';
	if($mtyear > 0 && $month > 0 && $departmentid > 0)
	{
		$central_condition = $provinceid == 2 ? " AND MT_PROJECT.DEPARTMENTID=".$departmentid : "";
		return $CI->db->getone("SELECT COUNT(*) FROM ".$table." WHERE WYEAR=".$mtyear." AND WMONTH=".$month.$central_condition.$option);	
	}else{
		return 0;
	}
}
function GetInputDetail($mtyear,$month,$departmentid,$provinceid,$divisionid=FALSE,$subactivityid=FALSE,$projectid=FALSE)
{
	$CI =& get_instance();
	//$CI->db->debug = true;	
	$select = "SELECT MT_PROJECT_WITHDRAW.ID,REPORTER,CONTACTNO,SUGGESTION
	,(SELECT MAX(SAVEDATE) FROM MT_PROJECT_WITHDRAW_HISTORY WHERE PID=MT_PROJECT_WITHDRAW.ID)MAXSAVEDATE ";	
					
	$table = " MT_PROJECT_WITHDRAW ";
	$table.= " LEFT JOIN MT_PROJECT ON MT_PROJECT_WITHDRAW.PROJECTID = MT_PROJECT.ID ";		
	$table.= " LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID = MT_STRATEGY.ID ";	
	
	$option= $provinceid > 0 ? " AND MT_PROJECT_WITHDRAW.PROVINCEID=".$provinceid :"";
	if($provinceid==2){
		$option.= $divisionid > 0 ? " AND MT_PROJECT_WITHDRAW.DIVISIONID=".$divisionid : $option;
		$option.= $departmentid > 0 ? " AND MT_PROJECT.DEPARTMENTID=".$departmentid : $option;
	}
	
	$option.= $subactivityid > 0 ? " AND MT_PROJECT.SUBACTID=".$subactivityid : $option;
	
		
	
	if($mtyear > 0 && $month > 0 )
	{
		$sql = $select." FROM ".$table." WHERE WYEAR=".$mtyear." AND WMONTH=".$month.$option;			
		$result  = $CI->db->getrow($sql);
		dbConvert($result);
		//echo $sql."<br>";
		return $result;
	}else{
		return NULL;
	}	
}
function GetQuestionairAmount($provinceid,$start_date,$end_date,$province_condition="",$type='qty'){
	$CI=& get_instance();
	//$CI->db->debug=true;
	$condition = "";
	$date_condition = "";
	if(@$start_date!='' && @$end_date!='')
		{
			$s_date= strtotime((date_to_mysql(@$start_date,TRUE))." 00:00:01");			
			$e_date= strtotime((date_to_mysql(@$end_date,TRUE))." 23:59:59");		
			$date_condition = " AND CREATE_DATE BETWEEN ".$s_date." AND ".$e_date;
		}
	
	$province_condition = $province_condition != '' ? " AND PROVINCEID = ".$province_condition : ""; 	
	//LEFT JOIN CNF_WORKGROUP ON MT_QUESTIONAIR.WORKGROUP_ID = CNF_WORKGROUP.ID
	$sql = " SELECT COUNT(*) 
	FROM MT_QUESTIONAIR 	 
	WHERE 1=1 AND PROVINCEID > 0 AND PROVINCEID <> 2 ".$province_condition.$date_condition;
	$sql = iconv('UTF-8','TIS-620',$sql);
	$all_record = $CI->db->getone($sql);
		
	
	//LEFT JOIN CNF_WORKGROUP ON MT_QUESTIONAIR.WORKGROUP_ID = CNF_WORKGROUP.ID
	$condition .= @$provinceid != '' ? " AND PROVINCEID=".@$provinceid." AND PROVINCEID > 0 AND PROVINCEID <> 2 " : "  AND PROVINCEID > 0 AND PROVINCEID <> 2  ";
	$sql = " SELECT COUNT(*) 
	FROM MT_QUESTIONAIR
	WHERE 1=1 AND PROVINCEID > 0 AND PROVINCEID <> 2 ".$date_condition.$condition;
	$sql = iconv('UTF-8','TIS-620',$sql);
	$nrecord = $CI->db->getone($sql);
	
	//echo $sql." --".$nrecord."--<br>";
		
	$result = $type=='qty' ? $nrecord : number_format(@($nrecord/$all_record) * 100,2);
	
	return $result;
}	
function GetQuestionairAnswer($provinceid,$start_date,$end_date,$column_name,$column_value,$type="qty"){
	$CI=& get_instance();
	//$CI->db->debug=true;
	$condition = "";
	if(@$start_date!='' && @$end_date!='')
		{
			$s_date= strtotime((date_to_mysql(@$start_date,TRUE))." 00:00:01");			
			$e_date= strtotime((date_to_mysql(@$end_date,TRUE))." 23:59:59");		
			$condition = " AND CREATE_DATE BETWEEN ".$s_date." AND ".$e_date;
		}
	$condition .= @$provinceid != '' ? " AND PROVINCEID=".@$provinceid." AND PROVINCEID > 0 AND PROVINCEID <> 2 " : "  AND PROVINCEID > 0 AND PROVINCEID <> 2  ";
	;
	$pos = strpos($column_value, '-');
	$ipos = strpos($column_value, '>');
	if ($pos !== false) {
    	//Found Range
		$value = explode('-',$column_value);
	    $excondition = @$column_name != '' && $column_value !='' ? " AND ".$column_name." between ".$value[0]." AND ".$value[1] : "";
	} 
	else if($ipos !== false) 
	{
		//Found Range >				
	    $excondition = @$column_name != '' && $column_value !='' ? " AND ".$column_name." ".$column_value : "";
	}
	else
	{
		//
		$intcolumn = array('WILL','POL','FAST','CLEAN','CONTACT','EASY','TOILET','FAIRLY','TIME','CLEAR','HELP','PCON','PCLEAR');
		if(in_array(strtoupper($column_name),$intcolumn))
			$excondition = @$column_name != '' && $column_value !=''  ? " AND ".$column_name."=".$column_value."" : "";
		else
			$excondition = @$column_name != '' && $column_value !=''  ? " AND ".$column_name."='".$column_value."'" : "";
	}
		$excondition .= @$column_name != '' && $column_value =='0'  ? " AND ".$column_name."=".$column_value."" : "";
	
	
	//LEFT JOIN CNF_WORKGROUP ON MT_QUESTIONAIR.WORKGROUP_ID = CNF_WORKGROUP.ID
	$sql = " SELECT COUNT(*) 
	FROM MT_QUESTIONAIR 	 
	WHERE SEX <> '' ".$condition;
	$sql = iconv('UTF-8','TIS-620',$sql);
	$all_record = $CI->db->getone($sql);
	//echo $sql;	
	
	//LEFT JOIN CNF_WORKGROUP ON MT_QUESTIONAIR.WORKGROUP_ID = CNF_WORKGROUP.ID
	$sql = " SELECT COUNT(*) 
	FROM MT_QUESTIONAIR 	 
	WHERE SEX <> '' ".$condition.$excondition;
	$sql = iconv('UTF-8','TIS-620',$sql);
	$nrecord = $CI->db->getone($sql);
	//echo $sql;
	//echo $sql." --".$nrecord."--<br>";
	
	
	//$result = $type=='qty' ? $nrecord : number_format(@($nrecord/$all_record) * 100,2);
	$qty = $nrecord;
	$percent = number_format(@($nrecord/$all_record) * 100,2);
	$result['qty'] = $nrecord;
	$result['percent'] = $percent;
	return $result;
}		
function GetQuestionairMostAnswer($answer)
{
	$most = 0;
	$most_value = 0;
	for($i=0;$i<count($answer);$i++){
		if($answer[$i] > $most_value){
			$most = $i;
			$most_value = $answer[$i];
		}
	}
		
	return $most;	
}  
function GetQuestionairMostAnswerLevel($most_pop){
	$most = 0;
	$most_value = 0;
	for($i=0;$i<count($most_pop);$i++){
		if($most_pop[$i] > $most_value){
			$most = $i;
			$most_value = $most_pop[$i];
		}
	}
		
	return $most;	
}
function GetSendMonitorDate($department_id=FALSE,$divisiont_id=FALSE,$bg_year=FALSE,$month=FALSE,$province_id=FALSE)
{
	//if($department_id>0){
		$CI=& get_instance();
		//$CI->db->debug=true;
		$condition = "where 1=1";
		$condition .= $department_id > 0 ? " AND cnf_division.departmentid=".$department_id : "";
		$condition .= $bg_year > 0 ? " AND wyear=".$bg_year : "";
		$condition .= $month > 0  ? " AND wmonth=".$month : "";
		$condition .= $province_id > 0 ? " AND mt_project_withdraw.provinceid=".$province_id : "";
		$sql = "select MAX(update_date) from mt_project_withdraw
				left join mt_project on mt_project_withdraw.projectid = mt_project.id
				left join cnf_workgroup on mt_project.workgroupid = cnf_workgroup.id
				left join cnf_division on mt_project.divisionid = cnf_division.id
				left join cnf_department on cnf_division.departmentid = cnf_department.id				
				".$condition;
		//echo $sql;
		$result = $CI->db->getone($sql);
		return stamp_to_th($result);
	//}
}

function GetWithdrawStatus($mode,$itemID,$year,$month){
	$CI=& get_instance();	
	$condition = " 1=1 ";
	$condition.= $year > 0 ? " AND WYEAR=".$year : "";
	$condition.= $month > 0 ? " AND WMONTH=".$month : "";
	if($mode=='province'){
		$condition.= $itemID > 0 ? " AND PROVINCEID=".$itemID : "";
	}
	if($mode=='division'){
		$condition.= $itemID > 0 ? " AND DIVISIONID=".$itemID : "";
	}
	$sql= "SELECT COUNT(*) FROM MT_PROJECT_WITHDRAW WHERE ".$condition;
	$nrecord = $CI->db->getone($sql);
	$data['status'] = $nrecord;
	
	$sql= "SELECT MAX(SAVEDATE) FROM MT_PROJECT_WITHDRAW 
	LEFT JOIN MT_PROJECT_WITHDRAW_HISTORY ON MT_PROJECT_WITHDRAW.ID = MT_PROJECT_WITHDRAW_HISTORY.PID WHERE ".$condition;
	$savedate = $CI->db->getone($sql);
	$data['savedate'] = $savedate;
	return $data;
}
function GetTargetType($bgyear,$department_id=FALSE,$division_id=FALSE,$province_id=FALSE,$productivity_id=FALSE,$mainact_id=FALSE,$subact_id=FALSE,$project_id=FALSE)
{
	if($bgyear > 0){
		$CI=& get_instance();
		$sql = " SELECT MAX(TARGETTYPE_ID) FROM MT_BUDGET_RECORD 
				LEFT JOIN MT_PROJECT ON MT_BUDGET_RECORD.MASTERID = MT_PROJECT.ID
				LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID = MT_STRATEGY.ID 
				WHERE 1=1";
				if($subact_id >0)
				{
					$sql.= $subact_id > 0 ? " AND SUBACTID=".$subact_id : "";
				}else if($mainact_id > 0){
					$sql.= $mainact_id > 0 ? " AND SUBACTID IN (SELECT ID FROM MT_STRATEGY WHERE PID=".$mainact_id." )" : "";
				}else if($productivity_id > 0){
					//$sql.= $productivity_id > 0 ? " AND "
				}
				$sql.= $province_id > 0 ? " AND PROVINCEID=".$province_id : "";
				$sql.= $department_id > 0 ? " AND MT_STRATEGY.DEPARTMENTID=".$department_id : "";
				$sql.= $project_id > 0 ? " AND MT_PROJECT.ID=".$project_id : "";
		$type_id = $CI->db->getone($sql);		
		$target_type = $CI->db->getrow("SELECT * FROM CNF_COUNT_UNIT WHERE ID=".$type_id);			
		dbConvert($target_type);		
	}	
	if(!isset($target_type['title']))$target_type['title'] = '';
	return $target_type;
}
function GetTargetTypeValue($bgyear,$department_id=FALSE,$division_id=FALSE,$province_id=FALSE,$productivity_id=FALSE,$mainact_id=FALSE,$subact_id=FALSE,$target_type_id=FALSE,$project_id=FALSE)
{
	if($bgyear > 0){
		$CI=& get_instance();
		$sql = " SELECT SUM(TARGET_VALUE) FROM MT_BUDGET_RECORD 
				LEFT JOIN MT_PROJECT ON MT_BUDGET_RECORD.MASTERID = MT_PROJECT.ID
				LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID = MT_STRATEGY.ID 
				WHERE 1=1";
				if($subact_id >0)
				{
					$sql.= $subact_id > 0 ? " AND SUBACTID=".$subact_id : "";
				}else if($mainact_id > 0){
					$sql.= $mainact_id > 0 ? " AND SUBACTID IN (SELECT ID FROM MT_STRATEGY WHERE PID=".$mainact_id." )" : "";
				}else if($productivity_id > 0){
					//$sql.= $productivity_id > 0 ? " AND "
				}
				$sql.= $target_type_id > 0 ? " AND TARGETTYPE_ID=".$target_type_id : "";
				$sql.= $province_id > 0 ? " AND PROVINCEID=".$province_id : "";
				$sql.= $department_id > 0 ? " AND MT_STRATEGY.DEPARTMENTID=".$department_id : "";
				$sql.= $project_id > 0 ? " AND MT_PROJECT.ID=".$project_id : "";
		$targettype_value = $CI->db->getone($sql);		
		return $targettype_value;
	}
}
function GetTotalValue($bgyear,$department_id=FALSE,$division_id=FALSE,$province_id=FALSE,$productivity_id=FALSE,$mainact_id=FALSE,$subact_id=FALSE,$budgettype_id=FALSE,$project_id=FALSE)
{
	if($bgyear > 0){
		$CI=& get_instance();
		$sql = " SELECT SUM(SBUDGET) FROM MT_PROJECT_SUBDETAIL 
				LEFT JOIN MT_PROJECT ON MT_PROJECT_SUBDETAIL.MASTERID = MT_PROJECT.ID 	
				LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID = MT_STRATEGY.ID 				
				WHERE 1=1 ";
				if($subact_id >0)
				{
					$sql.= $subact_id > 0 ? " AND SUBACTID=".$subact_id : "";
				}else if($mainact_id > 0){
					$sql.= $mainact_id > 0 ? " AND SUBACTID IN (SELECT ID FROM MT_STRATEGY WHERE PID=".$mainact_id." )" : "";
				}else if($productivity_id > 0){
					//$sql.= $productivity_id > 0 ? " AND "
				}
				$sql.= $budgettype_id > 0 ? " AND SBUDGETTYPEID=".$budgettype_id: "";
				$sql.= $province_id > 0 ? " AND PROVINCEID=".$province_id : "";
				$sql.= $department_id > 0 ? " AND MT_STRATEGY.DEPARTMENTID=".$department_id : "";
				$sql.= $project_id > 0 ? " AND MT_PROJECT.ID=".$project_id : "";
		$total_value = $CI->db->getone($sql);		
		return $total_value;
	}
}
function GetTargetResult($bgyear,$department_id=FALSE,$division_id=FALSE,$province_id=FALSE,$productivity_id=FALSE,$mainact_id=FALSE,$subact_id=FALSE,$month=FALSE,$budgettype_id=FALSE,$project_id=FALSE)
{
	if($bgyear > 0){
		$CI=& get_instance();
		$sql = " SELECT SUM(TARGETRESULT) FROM MT_PROJECT_WITHDRAW 
		LEFT JOIN MT_PROJECT ON MT_PROJECT_WITHDRAW.PROJECTID = MT_PROJECT.ID 	
		LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID = MT_STRATEGY.ID 				
		WHERE 1=1 ";
				if($subact_id >0)
				{
					$sql.= $subact_id > 0 ? " AND SUBACTID=".$subact_id : "";
				}else if($mainact_id > 0){
					$sql.= $mainact_id > 0 ? " AND SUBACTID IN (SELECT ID FROM MT_STRATEGY WHERE PID=".$mainact_id." )" : "";
				}else if($productivity_id > 0){
					//$sql.= $productivity_id > 0 ? " AND "
				}
		$sql .= $month > 0 ? " AND WMONTH=".$month : "";
		$sql.= $province_id > 0 ? " AND MT_PROJECT_WITHDRAW.PROVINCEID=".$province_id : "";
		$sql.= $division_id > 0 ? " AND MT_PROJECT_WITHDRAW.DIVISIONID=".$division_id : "";
		$sql.= $department_id > 0 ? " AND MT_STRATEGY.DEPARTMENTID=".$department_id : "";
		$sql.= $budgettype_id > 0 ? " AND MT_PROJECT_WITHDRAW_DETAIL.BUDGETTYPEID=".$budgettype_id: "";
		$sql.= $project_id > 0 ? " AND MT_PROJECT.ID=".$project_id : "";
		$targettype_value = $CI->db->getone($sql);		
		return $targettype_value;
	}
}
function GetTotalResult($bgyear,$department_id=FALSE,$division_id=FALSE,$province_id=FALSE,$productivity_id=FALSE,$mainact_id=FALSE,$subact_id=FALSE,$month=FALSE,$budgettype_id=FALSE,$project_id=FALSE)
{
	if($bgyear > 0){
		$CI=& get_instance();
		$sql = " SELECT SUM(BUDGET) FROM MT_PROJECT_WITHDRAW_DETAIL 
				LEFT JOIN MT_PROJECT ON MT_PROJECT_WITHDRAW_DETAIL.PROJECTID = MT_PROJECT.ID 
				LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID = MT_STRATEGY.ID 					
				WHERE 1=1 ";
				if($subact_id >0)
				{
					$sql.= $subact_id > 0 ? " AND SUBACTID=".$subact_id : "";
				}else if($mainact_id > 0){
					$sql.= $mainact_id > 0 ? " AND SUBACTID IN (SELECT ID FROM MT_STRATEGY WHERE PID=".$mainact_id." )" : "";
				}else if($productivity_id > 0){
					//$sql.= $productivity_id > 0 ? " AND "
				}
				$sql .= $month > 0 ? " AND WMONTH=".$month : "";
				$sql.= $province_id > 0 ? " AND MT_PROJECT_WITHDRAW_DETAIL.PROVINCEID=".$province_id : "";
				$sql.= $division_id > 0 ? " AND MT_PROJECT_WITHDRAW_DETAIL.DIVISIONID=".$division_id : "";
				$sql.= $department_id > 0 ? " AND MT_STRATEGY.DEPARTMENTID=".$department_id : "";
				$sql.= $budgettype_id > 0 ? " AND MT_PROJECT_WITHDRAW_DETAIL.BUDGETTYPEID=".$budgettype_id: "";
				$sql.= $project_id > 0 ? " AND MT_PROJECT.ID=".$project_id : "";
				//echo $sql; 
				$targettype_value = $CI->db->getone($sql);		
				return $targettype_value;
	}
}

function GetSupportValue($bgyear,$department_id=FALSE,$division_id=FALSE,$province_id=FALSE,$productivity_id=FALSE,$mainact_id=FALSE,$subact_id=FALSE,$start_month=FALSE,$end_month=FALSE,$budgettype_id=FALSE,$project_id=FALSE)
{
	if($bgyear > 0){
		$CI=& get_instance();
		$sql = " SELECT SUM(SUPPORTVALUE) FROM MT_PROJECT_WITHDRAW
				LEFT JOIN MT_PROJECT ON MT_PROJECT_WITHDRAW.PROJECTID = MT_PROJECT.ID 
				LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID = MT_STRATEGY.ID 					
				WHERE 1=1 ";
				if($subact_id >0)
				{
					$sql.= $subact_id > 0 ? " AND SUBACTID=".$subact_id : "";
				}else if($mainact_id > 0){
					$sql.= $mainact_id > 0 ? " AND SUBACTID IN (SELECT ID FROM MT_STRATEGY WHERE PID=".$mainact_id." )" : "";
				}else if($productivity_id > 0){
					//$sql.= $productivity_id > 0 ? " AND "
				}
				if($start_month > $end_month){
					$sql .= " AND ((WMONTH BETWEEN ".$start_month." AND 12) OR WMONTH < ".$end_month.") ";
				}else{
					$sql .=  " AND (WMONTH >=".$start_month." AND WMONTH <= ".$end_month.") ";	
				}
				
				$sql.= $province_id > 0 ? " AND MT_PROJECT_WITHDRAW.PROVINCEID=".$province_id : "";
				$sql.= $division_id > 0 ? " AND MT_PROJECT_WITHDRAW.DIVISIONID=".$division_id : "";
				$sql.= $department_id > 0 ? " AND MT_STRATEGY.DEPARTMENTID=".$department_id : "";				
				$sql.= $project_id > 0 ? " AND MT_PROJECT.ID=".$project_id : "";
				//echo $sql;
					/*SELECT SUM(SUPPORTVALUE) FROM MT_PROJECT_WITHDRAW LEFT JOIN MT_PROJECT ON 
					 * 
					 MT_PROJECT_WITHDRAW.PROJECTID = MT_PROJECT.ID LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID = 
					 MT_STRATEGY.ID 
					 WHERE 1=1 AND SUBACTID=37 AND ((WMONTH BETWEEN10 AND 12) OR WMONTH < 2) 
					 AND MT_PROJECT_WITHDRAW.PROVINCEID=1 AND MT_STRATEGY.DEPARTMENTID=2
				*/
				
				$supportvalue = $CI->db->getone($sql);		
				return $supportvalue;
	}
}
?>