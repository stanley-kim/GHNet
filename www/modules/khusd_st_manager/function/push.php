<?php
if(!defined('__KIMS__')) exit;

include_once $g['path_module'].'khusd_st_manager/function/member.php'; 
include_once $g['path_module'].'khusd_st_manager/function/debug.php'; 

function send_push($subject, $content, $phone, $url)
{
	$config['push_server'] = "www.pushwing.com";
	$config['mysql_id'] = "khusdisdream";
	$config['mysql_pw'] = "590d043dfe66c33998f2603fc74f4bbedf2dd58c";
	$config['client_id'] = "129";
	
	$conn = mysql_connect($config["push_server"], $config["mysql_id"], $config["mysql_pw"]);
	
	if(!$conn)
	{
		__debug_print("push func: Could not connect to server. - " . mysql_error());
		return false;
	}
	
	mysql_select_db("pushwing", $conn);
	mysql_query("set names utf8", $conn);

	$columns = "hp, client_id, subject, contents, url, ymd, time, ";
	$_ymd = date("ymd");
	$_time = date("H");

	if(isset($phone) && !is_array($phone))
	{
		$phone = array( $phone );
	}

	if(is_array($phone))
	{
		foreach($phone as $idx => $hp)
		{
			$hp = isset($hp) && $hp ? preg_replace('/[^0-9]*/s', '', $hp) : '';
			
			$values = "'$hp', '".$config['client_id']."', '$subject', '$content', '$url', '".$_ymd."', '".$_time."', ";
			
			mysql_query(sprintf("INSERT INTO push_wait (%s timestamp) VALUES (%s UNIX_TIMESTAMP())", $columns, $values), $conn);
		}
	}
	
	mysql_close($conn);
}

function send_push_by_id($subject, $content, $id_list, $url)
{
	$config['push_server'] = "www.pushwing.com";
	$config['mysql_id'] = "khusdisdream";
	$config['mysql_pw'] = "590d043dfe66c33998f2603fc74f4bbedf2dd58c";
	$config['client_id'] = "129";
	
	$conn = mysql_connect($config["push_server"], $config["mysql_id"], $config["mysql_pw"]);
	
	if(!$conn)
	{
		__debug_print("push func: Could not connect to server. - " . mysql_error());
		return false;
	}
	
	mysql_select_db("pushwing", $conn);
	mysql_query("set names utf8", $conn);

	$columns = "hp, client_id, subject, contents, url, ymd, time, ";
	$_ymd = date("ymd");
	$_time = date("H");

	if(isset($id_list) && !is_array($id_list))
	{
		$id_list = array( $id_list );
	}

	if(is_array($id_list))
	{
		foreach($id_list as $idx => $id)
		{
			$ST_INFO = getSTInfo($id);
			
			$hp = preg_replace('/[^0-9]*/s', '', $ST_INFO['tel2']);
			
			if($hp && strlen($hp) > 0)
			{
				$values = "'$hp', '".$config['client_id']."', '$subject', '$content', '$url', '".$_ymd."', '".$_time."', ";
				
				mysql_query(sprintf("INSERT INTO push_wait (%s timestamp) VALUES (%s UNIX_TIMESTAMP())", $columns, $values), $conn);
			}
		}
	}
	
	mysql_close($conn);
}

// 특정 학기 그룹 구성원 모두에게 보내기
function send_push_semester_group($subject, $content, $s_uid, $url)
{
	// 유효한 s_uid 인지 체크
	
	// 해당 semester 구성원 정보 구하기
	
	// 푸시 보내기
}

// 모든 회원에게 보내기
function send_push_all($subject, $content, $url)
{
	global $table;
	
	$MBR_TEL_ARRAY = array();
	$MBR_TEL_ROWS = getDbArray($table['s_mbrdata'], "tel2 IS NOT NULL AND tel2 != ''", "tel2", "tel2", "ASC", 0, 0);
	while( $_ROW = db_fetch_array($MBR_TEL_ROWS) )
	{
		$MBR_TEL_ARRAY[] = $_ROW['tel2'];
	}

	send_push($subject, $content, $MBR_TEL_ARRAY, $url);
}

?>