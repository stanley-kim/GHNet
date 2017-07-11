<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

function trimming_array($string_array)
{
	foreach($string_array as $idx => $string_value) {
		$string_value_trim = trim($string_value);
		if($string_value_trim == '')
		{
			unset($string_array[$idx]);
		}
		else
		{
			$string_array[$idx] = $string_value_trim;
		}
	}
	return array_values($string_array);
}

function join_st_member($st_id, $pw, $name, $email, $st_group, $st_level, $s_uid) {
	global $s, $table, $date;
	getDbInsert($table['s_mbrid'],'site,id,pw',"'$s','$st_id','".md5($pw)."'");
	
	$memberuid  = getDbCnt($table['s_mbrid'],'max(uid)','');
	$auth = 1;	// 1이면 바로 인증된 상태, 자세한 것은 member 모듈을 참고할 것
	$sosok = $st_group; // 원내생 그룹
	$level = $st_level;
	$nic = $name;
	$num_login = 0;
	$last_pw = $date['totime'];
	$d_regis = $date['totime'];
	
	$_QKEY = "memberuid, site, auth, sosok, level, email, name, nic, num_login, last_pw, d_regis";
	$_QVAL = "'$memberuid', '$s', '$auth', '$sosok', '$level', '$email', '$name', '$nic', '$num_login', '$last_pw', '$d_regis'";
	
	getDbInsert($table['s_mbrdata'],$_QKEY,$_QVAL);
	getDbUpdate($table['s_mbrlevel'],'num=num+1','uid='.$level);
	getDbUpdate($table['s_mbrgroup'],'num=num+1','uid='.$sosok);
	getDbUpdate($table['s_numinfo'],'mbrjoin=mbrjoin+1',"date='".$date['today']."' and site=".$s);
	getDbInsert($table['khusd_st_manager'.'s_mbr'],"s_uid, st_id", "'".$s_uid."', '".$st_id."'");

}

function generate_pw_from_st_id($st_id) {
	if(!$st_id || !is_string($st_id) || strlen($st_id) != 10)
	{
		return false;
	}
	return substr($st_id, -6);
}

$_tmpdfile = $g['dir_module'].'var/var.join.php';
$fp = fopen($_tmpdfile,'w');
fwrite($fp, "<?php\n");

//회원가입
fwrite($fp, "\$d['khusd_st_member']['join_group'] = \"".$join_group."\";\n");
fwrite($fp, "\$d['khusd_st_member']['st_group'] = \"".$st_group."\";\n");
fwrite($fp, "\$d['khusd_st_member']['st_level'] = \"".$st_level."\";\n");
fwrite($fp, "\$d['khusd_st_member']['delegation_level'] = \"".$delegation_level."\";\n");

fwrite($fp, "\$d['khusd_st_member']['sosokmenu'] = \"".$sosokmenu."\";\n");
fwrite($fp, "?>");
fclose($fp);
@chmod($_tmpdfile,0707);

if ($_join_menu == 2)
{
	// 학생 아이디 생성 루틴
	$st_info_array = preg_split("/\r\n|\n|\r/", $num_name_email_list);
	$other_st_info_array = preg_split("/\r\n|\n|\r/", $other_num_name_email_list);
	
	$st_info_array = trimming_array($st_info_array);
	$other_st_info_array = trimming_array($other_st_info_array);
	
	$_tmpdfile = $g['dir_module'].'var/var2.join.php';
	$fp = fopen($_tmpdfile,'w');
	fwrite($fp, "$num_name_email_list");

	// 학생 정보 추출 & 회원가입
	foreach($st_info_array as $st_info_string) {
		
		// 배열로 변환
		$st_info = preg_split("/\t| /", $st_info_string);
		
		// id 는 st_id_prefix 와 합쳐서 자리수 맞춰서 생성
		$st_id = $st_id_prefix . sprintf("%02d", intval($st_info[0]));
		
		// 번호, 이름, 이메일이 모두 입력되었는지 체크
		// todo 유효한 값이 입력되었는지 체크하는 루틴 필요
		if(count($st_info) != 3
			|| intval($st_info[0]) <= 0
			|| intval($st_info[0]) >= 100
			|| getDbRows($table['s_mbrid'],"id='".$st_id."'")
		) {
			continue;
		}
		
		// 회원 가입
		join_st_member($st_id, generate_pw_from_st_id($st_id), $st_info[1], $st_info[2], $st_group, $st_level, $s_uid);
	}

	// 타학번 학생 정보 추출 & 회원가입
	foreach($other_st_info_array as $other_st_info_string) {
		
		// 배열로 변환
		$st_info = preg_split("/\t| /", $other_st_info_string);
		
		$st_id = $st_info[0];
		
		// 번호, 이름, 이메일이 모두 입력되었는지 체크
		// todo 유효한 값이 입력되었는지 체크하는 루틴 필요
		if(count($st_info) != 3
			|| getDbRows($table['s_mbrid'],"id='".$st_id."'")
		) {
			continue;
		}
		
		// 회원 가입
		join_st_member($st_id, generate_pw_from_st_id($st_id), $st_info[1], $st_info[2], $st_group, $st_level, $s_uid);
	}
	
	
	fwrite($fp, count($st_info_array)."\n");
	fwrite($fp, count($other_st_info_array)."\n");
	
	fclose($fp);
	@chmod($_tmpfile,0707);
}
if ($_join_menu == 3)
{
}

$_SESSION['_join_menu'] = $_join_menu;

getLink('reload','parent.','','');
?>