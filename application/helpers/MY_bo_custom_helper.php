<?php		
		function ShowUserTypeSystem($pUserGroupID)
		{			
				$CI =& get_instance();
				$systemName ="";
				$sql = " SELECT DISTINCT SYSTEMID FROM USERTYPE WHERE USERTYPETITLEID=".$pUserGroupID." AND (CANVIEW <> 'off'  OR  CANEDIT <> 'off' OR CANDELETE <> 'off' OR CANADD <>'off') " ;
				$result = $CI->db->GetArray($sql);
				foreach($result as $row):
				
					    switch($row['SYSTEMID'])
						{
							case 1:
								$systemName.= $systemName != "" ? ", " : "";
								$systemName.= "ระบบข้อมูล Back Office";							
							break;
							case 2:
								$systemName.= $systemName != "" ? ", " : "";
								$systemName.="ระบบจัดทำคำของบประมาณ";							
							break;
							case 3:
								$systemName.= $systemName != "" ? ", " : "";
								$systemName.="ระบบงานการคลัง";							
							break;
							case 4:
								$systemName.= $systemName != "" ? ", " : "";
								$systemName.="ระบบติดตามและประเมินผล";							
							break;														
							case 5:
								$systemName.= $systemName != "" ? ", " : "";
								$systemName.="ระบบตรวจราชการ";							
							break;	
							case 6:
								$systemName.= $systemName != "" ? ", " : "";
								$systemName.="ระบบบริหารกองทุน";							
							break;																					
							default :
								$systemName.="";
							break;
						}
				endforeach;
				return $systemName;
		}

		function check_permission($username){
			$request_url = "http://app4.m-society.go.th/site_administration/user_permission_service.php?username=".$username; 
			$xml = simplexml_load_file($request_url) or die("feed not loading");
			$permission['network_canuse'] = $xml->userpermission[0]->network_canuse;
			$permission['msolaws_canuse'] = $xml->userpermission[0]->msolaws_canuse;
			$permission['funds_canuse'] = $xml->userpermission[0]->funds_canuse;
			$permission['management_canuse'] = $xml->userpermission[0]->management_canuse;
			
			$CI =& get_instance();					
			$sql = " SELECT COUNT(*) 
			FROM USERTYPE 
			LEFT JOIN USER_TYPE_TITLE ON USERTYPE.USERTYPETITLEID = USER_TYPE_TITLE.ID
			LEFT JOIN USERS ON USER_TYPE_TITLE.USER_ID = USERS.ID
			WHERE
			USERNAME='".$username."' AND SYSTEMNAME='bo' AND MODULENAME='monitor' AND CANVIEW='on'
			";
			$result = $CI->db->GetOne($sql);										
			$permission['monitor_canuse'] = $result > 0 ?  "yes" : "no";
										
			$sql = " SELECT COUNT(*) 
			FROM USERTYPE 
			LEFT JOIN USER_TYPE_TITLE ON USERTYPE.USERTYPETITLEID = USER_TYPE_TITLE.ID
			LEFT JOIN USERS ON USER_TYPE_TITLE.USER_ID = USERS.ID
			WHERE
			USERNAME='".$username."' AND SYSTEMNAME='bo' AND MODULENAME='inspect' AND CANVIEW='on'
			";
			$result = $CI->db->GetOne($sql);										
			$permission['inspect_canuse'] = $result > 0 ?  "yes" : "no";
			
			return $permission;
		}

		function GetPermission($userType)
		{
			$CI =& get_instance();
			$sql = "SELECT * FROM  USERTYPE  WHERE USERTYPETITLEID=".$userType." ORDER BY SYSTEMID, MENUID ";
			$result = $CI->db->GetArray($sql);
			$permission=null;
			foreach($result as $row):
				$s = $row['SYSTEMID'];
				$m = $row['MENUID'];
				$permission[$s][$m]['CANVIEW'] = $row['CANVIEW'];
				$permission[$s][$m]['CANADD'] = $row['CANADD'];
				$permission[$s][$m]['CANEDIT'] = $row['CANEDIT'];
				$permission[$s][$m]['CANDELETE'] = $row['CANDELETE'];														
			endforeach;
			return $permission;
		}
		
	function GetSectionBudget($budgetyear,$subactivityID,$divisionID)
	{
		$CI =& get_instance();	
		 $sql = " SELECT SUM(BUDGET) FROM FN_DIVISION_BUDGET_AMOUNT FD LEFT JOIN FN_DIVISION_BUDGET_AMOUNT_DETAIL FDD ON FD.ID = FDD.PID
		 WHERE SUBACTIVITYID=".$subactivityID." AND DIVISIONID=".$divisionID." AND FNYEAR=".$budgetyear;
		 $budget = $CI->db->getone($sql);		 
		 return $budget;					
	}
	function GetProjectBudget($pProjectID)
	{
		$CI =& get_instance();	
		 $sql = " SELECT SUM(BUDGET)SUMBUDGET
		 FROM FN_BUDGET_TYPE_DETAIL FBMD
		 LEFT JOIN FN_BUDGET_MASTER FBM ON FBMD.BUDGETID = FBM.ID
		 LEFT JOIN CNF_WORKGROUP CWG ON FBM.WORKGROUP_ID = CWG.ID
		 WHERE BUDGETID=".$pProjectID;
		 $budget = $CI->db->getone($sql);		 
		 return $budget;			
	}
	function finance_budget_menu($menuindex=FALSE){
		$selected = array('','','','','','','','','','');		
		$selected[$menuindex]=' selected="selected"';
		echo '<select name="budgetmenu" onchange="window.location=this.value">
		    <option value="finance_budget_related/index" '.$selected[1].'>ผูกพันงบประมาณ</option>
		    <option value="finance_cost_related/index" '.$selected[2].'>ผูกผันค่าใช้จ่าย</option>
		    <option value="finance_withdraw_replace/index" '.$selected[3].'>เงินเบิกแทนกัน</option>
		    <option value="finance_receive_for_withdraw_replace/index" '.$selected[4].'>รับเงินหน่วยงานอื่นเพื่อเบิกแทน</option>
		    <option value="finance_year_overlap/index" '.$selected[5].'>เงินกันเหลื่อมปี</option>
		    <option value="finance_receive_year_overlap/index" '.$selected[6].'>รับเงินกันเหลือมปี</option>
		    <option value="finance_transfer_budget_change/index" '.$selected[7].'>โอนเปลี่ยนแปลงงบประมาณ</option>
		    <option value="finance_transfer_budget/index" '.$selected[8].'>โอนจัดสรรงบประมาณให้ พมจ</option>
		    <option value="finance_transfer_within/index" '.$selected[9].'>โอนภายในสำนัก</option>
		  </select>';		
	}
	function GetWithInSummary($pID=FALSE){
		$CI =& get_instance();
		$sql = "SELECT SUM(CHARGE)SUMMARY FROM FN_TRANSFER_WITHIN_DETAIL WHERE MASTERID=".$pID;
		$result = $CI->db->GetRow($sql);
		return $result['SUMMARY'];
	}
	function GetFNReceiveOverLapSummary($pID=FALSE){
		$CI =& get_instance();
		$sql = "SELECT SUM(EXPENSE_COMMIT)SUMMARY FROM FN_RECEIVE_YEAR_OVERLAP_DETAIL WHERE PID=".$pID;
		$result = $CI->db->GetRow($sql);
		return $result['SUMMARY'];
	}	
	function summary_expense_type($projectID=FALSE,$budgetypeID=FALSE,$expensetypeID=0){		
		$CI =& get_instance();	
		for($i=1;$i<=12;$i++)
			@$budgetCol .= $i ==12 ? "BUDGET_M".$i : "BUDGET_M".$i."+"; 
		$option = $expensetypeID > 0 ? " AND EXPENSETYPEID = ".$expensetypeID : " AND EXPENSETYPEID > 0 ";
		$sql = " SELECT SUM(".$budgetCol.")summary 
				FROM FN_BUDGET_TYPE_DETAIL fbd
				LEFT JOIN FN_BUDGET_TYPE fbt ON fbd.BUDGETTYPEID = fbt.ID 
				WHERE BUDGETID=".$projectID." AND (fbt.BUDGETTYPEID=".$budgetypeID.$option.")";
		$result = $CI->db->GetRow($sql);
		return $result['SUMMARY'];
	}
	
	
	function calculate_related($projectID=FALSE){
		$budget=NULL;
		$CI =& get_instance();	
		$sql = " SELECT BUDGETTYPE_ID,SUM(BUDGET)summary FROM FN_BUDGET_RELATED fbr LEFT JOIN FN_BUDGET_RELATED_DETAIL fbrd ON fbr.ID = fbrd.BUDGET_RELATED_ID
		WHERE
		PROJECTID=".$projectID."
		GROUP BY BUDGETTYPE_ID ";
		$result = $CI->db->GetArray($sql);
		foreach($result as $item){
			$budget[$item['BUDGETTYPE_ID']]=$item['SUMMARY'];
		}
		return $budget;
	}
	
	function calculate_related_book_id($projectID=FALSE,$book_id=FALSE){
		$budget=NULL;
		$CI =& get_instance();	
		$sql = " SELECT BUDGETTYPE_ID,SUM(BUDGET)summary FROM FN_BUDGET_RELATED fbr LEFT JOIN FN_BUDGET_RELATED_DETAIL fbrd ON fbr.ID = fbrd.BUDGET_RELATED_ID
		WHERE
		PROJECTID=".$projectID."
				AND fbr.ID IN (SELECT ID FROM FN_BUDGET_RELATED WHERE BOOK_ID = '".$book_id."')
		
		GROUP BY BUDGETTYPE_ID ";
		$result = $CI->db->GetArray($sql);
		foreach($result as $item){
			$budget[$item['BUDGETTYPE_ID']]=$item['SUMMARY'];
		}
		return $budget;
	}
	
	function calculate_cost($projectID=FALSE){
		$cost=NULL;
		$CI =& get_instance();	
		$sql = " SELECT BUDGETTYPE_ID,SUM(BUDGET_COMMIT)summary FROM FN_COST_RELATED fcr LEFT JOIN FN_COST_RELATED_DETAIL fcrd ON fcr.ID = fcrd.FN_COST_RELATED_ID
		WHERE
		PROJECTID=".$projectID."
		AND fcr.ID NOT IN (SELECT ID FROM FN_COST_RELATED WHERE BOOK_ID IS NULL)
		GROUP BY BUDGETTYPE_ID ";
		$result = $CI->db->GetArray($sql);
		foreach($result as $item){
			$cost[$item['BUDGETTYPE_ID']]=$item['SUMMARY'];
		}
		return $cost;
	}
	
	function calculate_cost_book_id($projectID=FALSE,$book_id=FALSE){
		$cost=NULL;
		$CI =& get_instance();	
		$sql = " SELECT BUDGETTYPE_ID,SUM(BUDGET_COMMIT)summary FROM FN_COST_RELATED fcr LEFT JOIN FN_COST_RELATED_DETAIL fcrd ON fcr.ID = fcrd.FN_COST_RELATED_ID
		WHERE
		PROJECTID=".$projectID."
		AND fcr.ID IN (SELECT ID FROM FN_COST_RELATED WHERE BOOK_ID = '".$book_id."')
		GROUP BY BUDGETTYPE_ID ";
		$result = $CI->db->GetArray($sql);
		foreach($result as $item){
			$cost[$item['BUDGETTYPE_ID']]=$item['SUMMARY'];
		}
		return $cost;
	}
	
	function calculate_cost_non_bookid_same_projectid($projectID=FALSE){
		$cost=NULL;
		$CI =& get_instance();	
		$sql = " SELECT BUDGETTYPE_ID,SUM(BUDGET_COMMIT)summary FROM FN_COST_RELATED fcr LEFT JOIN FN_COST_RELATED_DETAIL fcrd ON fcr.ID = fcrd.FN_COST_RELATED_ID
		WHERE
		PROJECTID=".$projectID."
		AND fcr.ID IN (SELECT ID FROM FN_COST_RELATED WHERE BOOK_ID IS NULL)
		GROUP BY BUDGETTYPE_ID ";
		$result = $CI->db->GetArray($sql);
		foreach($result as $item){
			$cost[$item['BUDGETTYPE_ID']]=$item['SUMMARY'];
		}
		return $cost;
	}
	function CheckExistWithdraw($pCostID=FALSE)
	{
		$CI=& get_instance();
		$result = $CI->db->getone("SELECT COUNT(*)NREC FROM FN_APPROVE_WITHDRAW WHERE COSTID=".$pCostID);		
		return $result;
	}
	function GetWithdrawList($pCostID=FALSE,$idx=FALSE)
	{
		$dataList='';
		$CI=& get_instance();
		$result = $CI->db->getone("SELECT COUNT(*)NREC FROM FN_APPROVE_WITHDRAW WHERE COSTID=".$pCostID);		
		if($result > 0)
		{
			$cost_relate = $CI->db->getrow("SELECT * FROM FN_COST_RELATED WHERE ID=".$pCostID);
			dbConvert($cost_relate);
			$cost_relate_budget = GetCostRelatedNet($pCostID);
			$department = $CI->db->getrow("SELECT * FROM CNF_DEPARTMENT WHERE ID=".$cost_relate['departmentid']);
			dbConvert($department);
			$division = $CI->db->getrow("SELECT * FROM CNF_DIVISION WHERE ID=".$cost_relate['divisionid']);
			dbConvert($division);
			$workgroup = $CI->db->getrow("SELECT * FROM CNF_WORKGROUP WHERE ID=".$cost_relate['workgroupid']);
			dbConvert($workgroup);			
			
			$condition = @$_GET['withdrawid'] != "" ? " AND withdrawid='".$_GET['withdrawid']."' " : ""; 
			
			$sql="SELECT SUM(withdraw) FROM FN_APPROVE_WITHDRAW FA LEFT JOIN FN_APPROVE_WITHDRAW_DETAIL FAD ON FA.ID = FAD.PID WHERE FA.COSTID=".$pCostID." AND EXPENSETYPE_ID=0 ";
			$with_total = $CI->db->getone($sql);
			$with_net = $cost_relate_budget - $with_total;
			$overlap = $CI->db->getone("SELECT COUNT(*) FROM FN_YEAR_OVERLAP WHERE FN_COST_RELATED_ID=".$pCostID);
			$status = $overlap > 0 ? "เบิกงบประมาณเรียบร้อย มีส่วนคงเหลือเป็นเงินกันเหลื่อม" : "ยังไม่เรียบร้อย";
			$i=0;
			$sql = " SELECT * FROM FN_APPROVE_WITHDRAW WHERE COSTID=".$pCostID.$condition;
			$result = $CI->db->getarray($sql);
			dbConvert($result);						
				$dataList='<tr class="boxSub" style="display:none;">';
				$dataList.='<td colspan="8">';
				$dataList.='<div id="search"><div id="searchBox">';
				$dataList.='<table  style="margin-left:5%;" width="95%">';
				$dataList.='<tr>';
				$dataList.='<th>จำนวนเงินทั้งหมด : '.number_format($cost_relate_budget,2).'</th>';
				$dataList.='<th>จำนวนเงินที่เบิกไปแล้ว : '.number_format($with_total,2).'</th>';
				$dataList.='<th>คงเหลือ : '.number_format($with_net,2).'</th>';
				if($with_net==0 || $overlap > 0)
				{    
				$dataList.='<th>'.$status.'&nbsp;</th>';
				}
				else
				{
				$dataList.='<th>';
				$dataList.='<input type="button" name="button4" id="button4" title="อนุมัติเบิกเงิน" value=" " class="btn_approve cursor vtip" onclick="window.location=\'finance_approve_withdraw/form/'.$pCostID.'/\';" />';
				$dataList.='<input type="button" name="button4" id="button4" title="อนุมัติยอดคงเหลือเป็นเงินกันเหลื่อมปี" value="เงินกันเหลื่อมปี" class=" cursor vtip" onclick="window.location=\'finance_year_overlap/form/0/'.$pCostID.'/\';" />';
				$dataList.='</th>';
				}
				$dataList.='</tr>';
				$dataList.='</table>';				
				$dataList.='<table class="tblistSub">';
				$dataList.='<tr>';
				  $dataList.='<th>ลำดับ</th>';
				  $dataList.='<th>เลขที่หนังสืออนุมัติเบิกเงิน</th>';
				  $dataList.='<th>วันที่เบิกเงิน</th>';
				  $dataList.='<th>หน่วยงาน / กลุ่มงาน</th>';
				  $dataList.='<th>จำนวนเงิน</th>';
				  $dataList.='<th>สถานะการเบิกเงิน</th>';
				  $dataList.='<th>จัดการ</th>';
				  $dataList.='</tr>';
				foreach($result as $item):
				$withdrawDate = $item['withdrawdate']>0? stamp_to_th_fulldate($item['withdrawdate']):"";		
				$i++;
				$total = $CI->db->getone("SELECT SUM(WITHDRAW) FROM FN_APPROVE_WITHDRAW_DETAIL WHERE PID=".$item['id']." AND EXPENSETYPE_ID=0");
				$dataList.='<tr class="cursor" onclick="window.location=\'finance_approve_withdraw/form/'.$pCostID.'/'.$item['id'].'\';">';
				  $dataList.='<td>'.$idx.'.'.$i.'</td>';
				  $dataList.='<td>'.$item['withdrawid'].'</td>';
				  $dataList.='<td>'.$withdrawDate.'</td>';
				  $dataList.='<td>'.$department['title'].'/'.$workgroup['title'].'</td>';
				  $dataList.='<td>'.number_format($total,2).'</td>';
				  $dataList.='<td><span style="text-align:center;">ได้</span></td>';
				  $dataList.='<td>';
				  if($overlap == 0){
				  $dataList.='<a href="finance_approve_withdraw/delete/'.$item['id'].'" style="text-decoration:none;" onclick="return confirm(\''.NOTICE_CONFIRM_DELETE.'\')">';				  
				  $dataList.='<input type="submit" name="button3" id="button3" value="-" title="ยกเลิกรายการ" class="btn_cancel vtip" />';
				  }
				  $dataList.='</a>';
				  $dataList.='</td>';
				$dataList.='</tr>';
				endforeach;				
				$dataList.='</table>';	
				$dataList.='</div></div>';			  
				$dataList.='</td>';
			  $dataList.='</tr>';
			  
	  }
return $dataList;
	}
	function CheckExistWithdrawReplace($pReplaceID=FALSE)
	{
		$CI=& get_instance();
		$result = $CI->db->getone("SELECT COUNT(*)NREC FROM FN_APPROVE_WITHDRAW_REPLACE WHERE ReplaceID=".$pReplaceID);		
		return $result;
	}
	function GetWithdrawReplaceList($pReplaceID=FALSE,$idx=FALSE)
	{
		$dataList='';
		$CI=& get_instance();
		$result = $CI->db->getone("SELECT COUNT(*)NREC FROM FN_APPROVE_WITHDRAW_REPLACE WHERE REPLACEID=".$pReplaceID);		
		if($result > 0)
		{
			$wdtotal = $CI->db->getone("SELECT SUM(BUDGET_COMMIT) FROM FN_WITHDRAW_REPLACE_DETAIL WHERE WITHDRAW_REPLACE_ID=".$pReplaceID." AND EXPENSETYPE_ID=0");
			$wd = $CI->db->getrow("SELECT * FROM FN_WITHDRAW_REPLACE WHERE ID=".$pReplaceID);
			dbConvert($wd);
			$department = $CI->db->getrow("SELECT * FROM CNF_DEPARTMENT WHERE ID=".$wd['departmentid']);
			dbConvert($department);
			$division = $CI->db->getrow("SELECT * FROM CNF_DIVISION WHERE ID=".$wd['divisionid']);
			dbConvert($division);
			$workgroup = $CI->db->getrow("SELECT * FROM CNF_WORKGROUP WHERE ID=".$wd['workgroupid']);
			dbConvert($workgroup);
			
			$with_total = $CI->db->getone("SELECT SUM(withdraw) FROM FN_APPROVE_WITHDRAW_REPLACE FA LEFT JOIN FN_APPROVE_WITHDRAW_REPLACE_DETAIL FAD ON FA.ID = FAD.PID WHERE ReplaceID=".$pReplaceID." AND EXPENSETYPE_ID=0");
			
			$with_net = $wdtotal - $with_total;
			$i=0;
			$sql = " SELECT * FROM FN_APPROVE_WITHDRAW_REPLACE WHERE REPLACEID=".$pReplaceID;
			$result = $CI->db->getarray($sql);
			dbConvert($result);						
				$dataList='<tr class="boxSub" style="display:none;">';
				$dataList.='<td colspan="8">';
				$dataList.='<div id="search"><div id="searchBox">';
				$dataList.='<table  style="margin-left:5%;" width="95%">';
				$dataList.='<tr>';
				$dataList.='<th>จำนวนเงินทั้งหมด : '.number_format($wdtotal,2).'</th>';
				$dataList.='<th>จำนวนเงินที่เบิกไปแล้ว : '.number_format($with_total,2).'</th>';
				$dataList.='<th>คงเหลือ : '.number_format($with_net,2).'</th>';
				if($with_net==0)
				{    
				$dataList.='<th>&nbsp;</th>';
				}
				else
				{
				$dataList.='<th>';
				$dataList.='<input type="button" name="button4" id="button4" title="อนุมัติเบิกเงิน" value=" " class="btn_approve cursor vtip" onclick="window.location=\'finance_approve_withdraw_replace/form/'.$pReplaceID.'/\';" />';
				$dataList.='</th>';
				}
				$dataList.='</tr>';
				$dataList.='</table>';				
				$dataList.='<table class="tblistSub">';
				$dataList.='<tr>';
				  $dataList.='<th>ลำดับ</th>';
				  $dataList.='<th>เลขที่หนังสืออนุมัติเบิกเงิน</th>';
				  $dataList.='<th>วันที่เบิกเงิน</th>';
				  $dataList.='<th>หน่วยงาน / กลุ่มงาน</th>';
				  $dataList.='<th>จำนวนเงิน</th>';
				  $dataList.='<th>สถานะการเบิกเงิน</th>';
				  $dataList.='<th>จัดการ</th>';
				  $dataList.='</tr>';
				foreach($result as $item):
				$withdrawDate = $item['withdrawdate']>0? stamp_to_th_fulldate($item['withdrawdate']):"";		
				$i++;
				$total = $CI->db->getone("SELECT SUM(WITHDRAW) FROM FN_APPROVE_WITHDRAW_REPLACE_DETAIL WHERE PID=".$item['id']." AND EXPENSETYPE_ID=0");
				$dataList.='<tr class="cursor" onclick="window.location=\'finance_approve_withdraw_replace/form/'.$pReplaceID.'/'.$item['id'].'\';">';
				  $dataList.='<td>'.$idx.'.'.$i.'</td>';
				  $dataList.='<td>'.$item['approveid'].'</td>';
				  $dataList.='<td>'.$withdrawDate.'</td>';
				  $dataList.='<td>'.$department['title'].'/'.$workgroup['title'].'</td>';
				  $dataList.='<td>'.number_format($total,2).'</td>';
				  $dataList.='<td><span style="text-align:center;">ได้</span></td>';
				  $dataList.='<td>';
				  $dataList.='<a href="finance_approve_withdraw_replace/delete/'.$item['id'].'" style="text-decoration:none;" onclick="return confirm(\''.NOTICE_CONFIRM_DELETE.'\')">';				  
				  $dataList.='<input type="submit" name="button3" id="button3" value="-" title="ยกเลิกรายการ" class="btn_cancel vtip" />';
				  $dataList.='</a>';
				  $dataList.='</td>';
				$dataList.='</tr>';
				endforeach;				
				$dataList.='</table>';	
				$dataList.='</div></div>';			  
				$dataList.='</td>';
			  $dataList.='</tr>';
			  
	  }
return $dataList;
	}

function get_budget_book_id($book_id)
{
	$CI=& get_instance();
	$sql = " SELECT BOOK_ID FROM FN_BUDGET_RELATED WHERE ID=".$book_id;
	$book_no = $CI->db->getone($sql);
	dbConvert($book_no);
	return $book_no;
}
function get_cost_book_id($book_id)
{
	$CI=& get_instance();
	$sql = " SELECT BOOK_COST_ID FROM FN_COST_RELATED WHERE ID=".$book_id;
	$book_no = $CI->db->getone($sql);
	dbConvert($book_no);
	return $book_no;
}
function get_budget_return_summary($id)
{
	$CI=& get_instance();
	$sql = " SELECT SUM(BUDGET_COMMIT) FROM FN_BUDGET_RETURN_DETAIL  WHERE FN_BOOK_RETURN_ID=".$id." AND BUDGETTYPE_ID IN (SELECT ID FROM FN_BUDGET_TYPE WHERE PID=0)";
	$summary = $CI->db->getone($sql);
	return $summary;
}
function GetCostRelatedNet($cost_id)
{	
	$summary=0;
	$CI=& get_instance();
	//$CI->db->debug=true;
	$option = " SELECT DISTINCT BUDGETTYPE_ID FROM FN_COST_RELATED_DETAIL WHERE FN_COST_RELATED_ID=".$cost_id."
	 AND BUDGETTYPE_ID IN (SELECT ID FROM FN_BUDGET_TYPE WHERE PID > 0 AND EXPENSETYPEID > 0)";
	 
		$sql = " SELECT RELATED_COST FROM
		FN_COST_RELATED WHERE ID=".$cost_id;				
		$summary = $CI->db->getone($sql);
		$bg_change = 0;
		$bg_change_receive = 0;
		/*
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost_id;
		$bg_change = $CI->db->getone($sql);
		
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost_id;		
		$bg_change_receive = $CI->db->getone($sql);		 
		 */
		
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET FT LEFT JOIN FN_TRANSFER_BUDGET_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost_id;
		$bg_transfer = $CI->db->getone($sql);
		
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_WITHIN FT LEFT JOIN FN_TRANSFER_WITHIN_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost_id;		
		$bg_within = $CI->db->getone($sql);
				
		$summary = $summary - ( $bg_change + $bg_transfer + $bg_within) + $bg_change_receive;	 
		return $summary;
}
?>