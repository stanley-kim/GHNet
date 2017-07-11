<?php
if(!defined('__KIMS__')) exit;

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

// uid 에 해당하는 follow 찾기
$FOLLOW = getUidData($table[$m.'follow'], $uid);
if($FOLLOW && $FOLLOW['uid'] && $FOLLOW['uid'] == $uid)
{
	getDbDelete($table[$m.'follow'], "uid=$uid");
	
	getLink('', '', '팔로우 삭제되었습니다.', '-1');
}
else
{
	getLink('', '', '팔로우 정보가 없습니다.', '-1');
}
?>