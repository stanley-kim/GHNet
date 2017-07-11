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

// 상태 확인
if($APPLIER['status'] == $d['khusd_st_apply_manager']['apply_list']['CANCEL'])	getLink('','','이미 취소되었습니다.','');

if(!$MANAGER && $APPLY_INFO['date_end'] <= $date['totime'])
{
	getLink('','','마감 시간이 지났습니다.','');
}

// 해당 신청자로 로그인 되어 있는지 확인
if($APPLIER['st_id'] != $my['id'])
{
	// 관리자의 경우 강제 취소 가능
	if($MANAGER)
	{
		$work_manager_key = 'work_manager';
		$work_manager_val = "'".$my['name']."'";
	}
	else
	{
		getLink('','','신청자 본인만이 취소 가능합니다.');
	}
}

// apply_info_list 에서 status 조사, closed 면 취소 불가
if($APPLY_INFO['status'] != $d['khusd_st_apply_manager']['apply_info']['OPEN']
	&& !$MANAGER
) {
	getLink('','','마감된 신청은 취소할 수 없습니다.','');
}

// 취소 작업 수행
$_update = "date_cancel='".$date['totime']."'";
$_update .= ",status='".$d['khusd_st_apply_manager']['apply_list']['CANCEL']."'";
if($work_manager_key)
{
	$_update .= ", ".$work_manager_key."=".$work_manager_val;
}

getDbUpdate($table[$m.'apply_list'], $_update, "uid = '".$uid."'");

getLink('reload', 'parent.', '', '');

?>