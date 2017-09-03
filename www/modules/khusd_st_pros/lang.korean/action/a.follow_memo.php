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
	// 상태 변환
	$date_update = $date['totime'];
	//$memo = '32';	
	
	//$_set = "memo = '".$memo."', date_update = '".$date_update."'";
	$_set = "memo = '".$memo."'";
	$_where = "uid = '".$uid."'";
	
	getDbUpdate($table[$m.'follow'], $_set, $_where);
	
	getLink('/?c=25/81', '', 'memo가 변경되었습니다.', '');
}
else
{
	getLink('/?c=25/81', '', '팔로우 정보가 없습니다.', '-1');
}
?>
