<?php
if(!defined('__KIMS__')) exit;

$APPLIER = getUidData($table[$m.'apply_list'],$uid);
if(!$APPLIER['uid']) getLink('','','삭제되었거나 존재하지 않는 항목입니다.','');

$ITEM = getUidData($table[$m.'apply_item'],$APPLIER['apply_item_uid']);
if(!$ITEM['uid']) getLink('','','삭제되었거나 존재하지 않는 항목입니다.','');

$APPLY_INFO = getUidData($table[$m.'apply_info_list'],$ITEM['apply_info_uid']);
if(!$APPLY_INFO['uid']) getLink('','','삭제되었거나 존재하지 않는 신청입니다.','');


include_once $g['dir_module'].'var/var.php';
include_once $g['dir_module'].'var/var.define.php';

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	getLink('', '', '권한이 없거나 로그인하지 않으셨습니다.', '');
}

// 관리자 권한 체크
$MANAGER = false;
if(permcheck('chief_of_case') || permcheck($APPLY_INFO['department']))
{
	$MANAGER = true;
}
elseif($APPLY_INFO['department'] == 'pros' && permcheck('pros_sub'))
{
	$MANAGER = true;
}

if(!$MANAGER)
{
	getLink('', '', '관리자만 가능합니다.', '');
}

// 상태 확인
if($APPLIER['status'] == $d['khusd_st_apply_manager']['apply_list']['ACCEPTED'])	getLink('','','이미 당첨되어 있습니다.','');

// 취소 작업 수행
$_update = "status='".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'";
$_update .= ", work_manager = '".$my['name']."'";

getDbUpdate($table[$m.'apply_list'], $_update, "uid = '".$uid."'");

getLink('reload', 'parent.', '', '');

?>