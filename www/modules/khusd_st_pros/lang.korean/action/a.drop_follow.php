<?php
if(!defined('__KIMS__')) exit;

$DEPARTMENT = 'pros';

/* score update 액션 처리 */

include_once $g['dir_module'].'var/var.php'; // 모듈변수파일 인클루드

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/debug.php';	// 필수 인클루드 파일

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}

if(permcheck($DEPARTMENT))
{
	$MANAGER = true;
}

// uid 에 해당하는 follow 찾기
$FOLLOW = getUidData($table[$m.'follow'], $uid);
if($FOLLOW && $FOLLOW['uid'] && $FOLLOW['uid'] == $uid)
{
	// DROP 으로 상태 변환
	$date_update = $date['totime'];
	
	$_set = "status = '".$d['khusd_st_pros']['FOLLOW']['DROP']."', date_update = '".$date_update."'";
	$_where = "uid = '".$uid."'";
	
	getDbUpdate($table[$m.'follow'], $_set, $_where);
	
	// 남은 follow 수 체크해서 follow_pt 상태 변경
	
	$pt_uid = $FOLLOW['pt_uid'];
	
	$_table = $table[$m.'follow'];
	$_where = 
		"pt_uid = '".$pt_uid."'"
		." AND ("
			."status = '".$d['khusd_st_pros']['FOLLOW']['FOLLOWING']."'"
			." OR status = '".$d['khusd_st_pros']['FOLLOW']['NEW_FOLLOWING']."'"
		.")";
	
	$FOLLOWER_NUM = getDbRows($_table, $_where);
	
	if($FOLLOWER_NUM == 0)
	{
		// 상태 변경
		$_set = "status = '".$d['khusd_st_pros']['FOLLOW_PT']['FREE']."', date_update = '".$date_update."'";
		$_where = "uid = '".$pt_uid."'";
		
		getDbUpdate($table[$m.'follow_pt'], $_set, $_where);
	}
	
	getLink('', '', '팔로우 취소되었습니다.', '-1');
}
else
{
	getLink('', '', '팔로우 정보가 없습니다.', '-1');
}
?>