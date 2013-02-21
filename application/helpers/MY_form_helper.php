<?php
// --------------------------------------------------------------------

/**
 * Drop-down Menu
 *
 * @access	public
 * @param	string
 * @param	array
 * @param	string
 * @param	string
 * @return	string
 */

	function form_dropdown($name = '', $options = array(), $selected = array(), $extra = '',$default_text = FALSE,$default_value="")
	{
		if ( ! is_array($selected))
		{
			$selected = array($selected);
		}

		// If no selected state was submitted we will attempt to set it automatically
		if (count($selected) === 0)
		{
			// If the form name appears in the $_POST array we have a winner!
			if (isset($_POST[$name]))
			{
				$selected = array($_POST[$name]);
			}
		}

		if ($extra != '') $extra = ' '.$extra;

		$multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

		$form = '<select name="'.$name.'"'.$extra.$multiple.">\n";
		
		$form .= $default_text!=FALSE ? '<option value="'.$default_value.'">'.$default_text.'</option>\n' : '';

		foreach ($options as $key => $val)
		{
			$key = (string) $key;

			if (is_array($val))
			{
				$form .= '<optgroup label="'.$key.'">'."\n";
				
				
				
				foreach ($val as $optgroup_key => $optgroup_val)
				{
					$sel = (in_array($optgroup_key, $selected)) ? ' selected="selected"' : '';

					$form .= '<option value="'.$optgroup_key.'"'.$sel.'>'.(string) $optgroup_val."</option>\n";
				}

				$form .= '</optgroup>'."\n";
			}
			else
			{
				$sel = (in_array($key, $selected)) ? ' selected="selected"' : '';

				$form .= '<option value="'.$key.'"'.$sel.'>'.(string) $val."</option>\n";
			}
		}

		$form .= '</select>';

		return $form;
	}

function is_checked($text,$data,$return = 'checked="checked"')
{
	$array = explode('|', $data);
	return (in_array($text,$array)) ? $return : NULL;	
}


// ------------------------------------------------------------------------

/**
 * Checkbox Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	bool
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_checkbox'))
{
	function form_checkbox($data = '', $value = '', $checked = FALSE, $extra = '')
	{
		$defaults = array('type' => 'checkbox', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);

		if (is_array($data) AND array_key_exists('checked', $data))
		{
			$checked = $data['checked'];

			if ($checked == FALSE)
			{
				unset($data['checked']);
			}
			else
			{
				$data['checked'] = 'checked';
			}
		}

		if ($checked == $value)
		{
			$defaults['checked'] = 'checked';
		}
		else
		{
			unset($defaults['checked']);
		}

		return "<input "._parse_form_attributes($data, $defaults).$extra." />";
	}

}

			
		function get_budget($id,$projectid)
		{

			$CI =& get_instance();
			$sql="SELECT sum(budget_m1+budget_m2+budget_m3+budget_m4+budget_m5+budget_m6+budget_m7+budget_m8+budget_m9+budget_m10+budget_m11+budget_m12)as sum_m
              FROM FN_BUDGET_TYPE_DETAIL
              WHERE BUDGETID= ".$projectid." AND BUDGETTYPEID IN (SELECT ID FROM FN_BUDGET_TYPE fbt WHERE fbt.BUDGETTYPEID=".$id." AND EXPENSETYPEID>0)";
			$result=$CI->db->GetArray($sql);			
			return $result[0]['SUM_M'];
			
		}
		function cal_budget_other($projectid)		
		{
			// คำนวณงบจัดสรร หักจาก   จากตาราง fn_cost_related,fn_cost_related_detail ด้วย
			$CI =& get_instance();
			$sql="SELECT budgettype_id,sum(budget_commit) as sum_budget 
			  FROM fn_cost_related a INNER JOIN fn_cost_related_detail b on a.id=b.fn_cost_related_id
			  GROUP BY budgettype_id,projectid
			  HAVING projectid=".$projectid;	  		
			
			 $cost=$CI->fn_cost_related->get($sql);			
				if($cost){
					foreach ($cost as $c)
					{
						$budget_cost[$c['budgettype_id']]=$c['sum_budget'];
					}	  
				}else{
					 $budget_cost="";
				}
		  	 return $budget_cost;
		}



?>