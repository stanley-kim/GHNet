<?php
if(!defined('__KIMS__')) exit;

/* score update 액션 처리 */

include_once $g['path_module'].'khusd_st_cnslt_room_manager/var/var.define.php';	// ST 신청용 변수 파일

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}

// 입력값 유효성 체크
$uid 		= intval($uid);

$CHAIR = getUidData($table[$m.'reservation'], $uid);
$st_type = $CHAIR['st_type'];

if(!$CHAIR || $CHAIR['uid'] != $uid)
{
	getLink('', '', '해당하는 값에 대한 신청 정보가 없습니다.', '');
}

// 권한 체크
// 권한은 종진실장, 총케이스장, 총대에게만 있다. 
// (보존과 OP 는 OP장도 가짐 )
if(!permcheck('chief_of_cnslt_room')) {
	$_perm = false;

	if($st_type == 'consv' && permcheck('chief_of_op'))
	{
		$_perm = true;
	}
	
	if(!$_perm)
		getLink('', '', '권한이 없습니다.', '');
}

// 기존 체어 취소
$_where = "uid = $uid";
		
getDbDelete($table[$m.'reservation'], $_where);

getLink('reload', 'parent.', '변경 되었습니다.', '');
?>
