<?php
if(!defined('__KIMS__')) exit;

include_once $g['dir_module'].'var/var.php'; // 모듈변수파일 인클루드
include_once $g['dir_module'].'var/var.define.php'; // 각종 변수 정의 인클루드

// 이게 false 면 권한이 없는 것
include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/debug.php';

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	getLink('', '', '권한이 없거나 로그인하지 않으셨습니다.', '');
}


$uid = intval($uid);

if($uid > 0)	$APPLY_ITEM = getUidData($table[$m.'apply_item'],$uid);

if(!$APPLY_ITEM['uid']) {
	getLink('', '', '해당 항목은 존재하지 않습니다.', '');
}

$APPLY_INFO = getUidData($table[$m.'apply_info_list'],$APPLY_ITEM['apply_info_uid']);

if($APPLY_INFO['st_id'] != $my['id'] && !permcheck('deleg'))
	getLink('', '', '삭제 권한이 없습니다.', '');

include_once $g['dir_module'].'var/var.define.php'; // 모듈변수파일 인클루드

getDbDelete($table[$m.'apply_item'],"uid = '".$uid."'");
getDbDelete($table[$m.'apply_list'],"apply_item_uid = '".$uid."'");

// item 수 구하기
$num_item = getDbRows($table[$m.'apply_item'],"apply_info_uid = '".$APPLY_ITEM['apply_info_uid']."'");
// apply_info_list 의 num_item 업데이트
getDbUpdate($table[$m.'apply_info_list'], "num_item='".$num_item."'", "uid = '".$APPLY_ITEM['apply_info_uid']."'");

getLink('reload', 'parent.', '', '');

?>
