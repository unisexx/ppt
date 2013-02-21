<?
function GetRiskTypeDetail($pRiskGroupID=FALSE)
{	
	switch($pRiskGroupID){
		case "1":
			$title = "Key Risk area";
			break;
		case "2":
			$title = "Political Risk";
			break;
		case "3":
			$title = "Negotiation Risk";
			break;
		case "4":
			$title = "Ohter (อื่นๆ)";
			break;
		default:
			$title = "";
			break;
	}
	return $title;
}
function GetRiskSubjectList($pBudgetYear=FALSE)
{
	if($pBudgetYear > 0)
	{
		$dataList = '';
		$CI=& get_instance();
		$result = $CI->db->getarray("SELECT * FROM INSP_RISK_SUBJECT WHERE BUDGETYEAR=".$pBudgetYear." ORDER BY RISKTYPE, TITLE");
		dbConvert($result);
		foreach($result as $item):
			$dataList .= $item['title']."<br/>";
		endforeach;
		return $dataList;
	}
	else
	{
		return '';
	}
	
}


function GetProvinceAreaTitle($pProvinceAreaID)
{
	$title = "";
	if($pProvinceAreaID !="")
	{
	$CI=& get_instance();
	$result = $CI->db->getarray("SELECT * FROM CNF_PROVINCE_AREA WHERE ID IN (".$pProvinceAreaID.")");
	dbConvert($result);
	foreach($result as $item):
		$title .= $item['title'].",";
	endforeach;
	}
	return $title;
}


function CheckExistProjectDetail($pProjectID=FALSE)
{
	if($pProjectID > 0)
	{
		$dataList = '';
		$CI=& get_instance();
		$result = $CI->db->getone("SELECT COUNT(*)NREC FROM INSP_PROJECT_DETAIL WHERE PID=".$pProjectID);			
		return $result;
	}
	else
	{
		return FALSE;
	}
}
function GetProjectDetail($pProjectID=FALSE){
	$dataList='';	
	if($pProjectID>0)
	{		
		$CI=& get_instance();
		$result = $CI->db->getone("SELECT COUNT(*)NREC FROM INSP_PROJECT_DETAIL WHERE PID=".$pProjectID);
		if($result > 0)
		{
			$result = $CI->db->getarray("SELECT * FROM INSP_PROJECT_DETAIL WHERE PID=".$pProjectID);
			dbConvert($result);
			$dataList ='<tr class="boxSub" style="display:none">';
				  $dataList.='<td colspan="5">';
				  $dataList.='<table class="tblistSub2">';
					$dataList.='<tr>';
					  $dataList.='<th>ไตรมาสที่ 1</th>';
					  $dataList.='<th>ไตรมาสที่ 2</th>';
					  $dataList.='<th>ไตรมาสที่ 3</th>';
					  $dataList.='<th>ไตรมาสที่ 4</th>';
					$dataList.='</tr>';		
			foreach($result as $item):
					$dataList.='<tr>';
					  $dataList.='<td>'.$item['subq1'].'</td>';
					  $dataList.='<td>'.$item['subq2'].'</td>';
					  $dataList.='<td>'.$item['subq3'].'</td>';
					  $dataList.='<td>'.$item['subq4'].'</td>';
					$dataList.='</tr>';
			endforeach;						
					$dataList.='</table>';
				  $dataList.='</td>';
				  $dataList.='</tr>';
		}		
	}
	return $dataList;
}

//--- เช็คว่าเป็นเขตตรวจสอบของตัวเองหรือไม่ ---
function is_inspector($provinceArea){
	$CI=& get_instance();
	$sql = "SELECT * FROM INSP_GROUP where users_id = ".$CI->session->userdata('id')." and province_area like '%".$provinceArea."%'";
	$inspect_user = $CI->db->GetRow($sql);
	
	if(isset($inspect_user['ID'])){
		return TRUE;
	}else{
		return FALSE;
	}
}
?>