<?php
///For Connect Other Database VIA ODBC 
function db_connect($dsn,$user,$pass)
{
			$resourceID = odbc_connect($dsn, $user, $pass); 		
			$_SESSION[$dsn] = $resourceID;
}

function db_close($dsnname)
{

			@odbc_free_result($_SESSION[$dsnname]);
			@odbc_close($_SESSION[$dsnname]); 

}

function db_query($sql,$dsnname)
{
			$result =  odbc_exec($_SESSION[$dsnname],$sql);
			return $result;
}

function db_num_rows($sresult)
{

		    $nrow = @odbc_num_rows($sresult);
			return $nrow;
}

function db_fetch_array($result,$cursor)
{
			$row = @odbc_fetch_array($result,$cursor);
			$key = @array_keys($row);
			for($i=0;$i<count($key);$i++)
			{
//				$row[$key[$i]] = $row[$key[$i]];
				$row[$key[$i]] = cvu($row[$key[$i]]);
			}
	return $row;
}

function ConvertCommand($command)
{
	$command = iconv("UTF-8","TIS-620",$command);
	return $command;
}

function cvu($src)
{
	$src = iconv("TIS-620","UTF-8",$src);
	return $src;
}

function GenMaxID($tbName)
{
	$command = "(SELECT CASE 
	WHEN (SELECT MAX(ID) FROM ".$tbName." ) > 0 THEN 
	((SELECT MAX(ID) FROM  ".$tbName." ) +1)
	ELSE
	1 
	END
	FROM sysibm.sysdummy1)";
	return $command;
}
function SelectData($table,$condition,$dsn)
	{
			$sql= "SELECT * FROM $table $condition ";
			$result = db_query(ConvertCommand($sql),$dsn);
			$row = db_fetch_array($result,0);
			return $row;
	}
function Alert($msg)
	{
		echo "<script>alert('".$msg."');</script>";		
	}
/////////////////////////////END
?>