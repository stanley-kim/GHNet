<?php
if(!defined('__KIMS__')) exit;

include_once $g['dir_module'].'var/var.php';
include_once $g['dir_module'].'var/var.define.php';

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	getLink('', '', '권한이 없거나 로그인하지 않으셨습니다.', '');
}


$ITEM = getUidData($table[$m.'apply_item'],$uid);
if(!$ITEM['uid']) getLink('','','삭제되었거나 존재하지 않는 항목입니다.','');

$APPLY_INFO = getUidData($table[$m.'apply_info_list'],$ITEM['apply_info_uid']);
if(!$APPLY_INFO['uid']) getLink('','','삭제되었거나 존재하지 않는 신청입니다.','');

$APPLIER_ROWS = getDbArray($table[$m.'apply_list'].' al,'.$table['s_mbrid'].' mbrid,'.$table['s_mbrdata'].' mbrdata',
					"al.apply_item_uid='".$uid."' AND al.st_id=mbrid.id AND mbrid.uid=mbrdata.memberuid"
					." AND status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'"
					." AND st_id = '".$my['id']."'", 
					'al.*, mbrdata.name AS name', 
					'al.date_reg, al.timestamp', 
					'asc',
					0,
					0);

while($APPLIER = db_fetch_array($APPLIER_ROWS))
{
	// 해당 신청자로 로그인 되어 있는지 확인
	if($APPLIER['st_id'] != $my['id'])
	{
		getLink('','','신청자 본인만이 취소 가능합니다.'.$APPLIER['st_id'],'');
	}
	
	if($APPLY_INFO['date_end'] <= $date['totime'])
	{
		getLink('','','마감 시간이 지났습니다.','');
	}
	
	// apply_info_list 에서 status 조사, closed 면 취소 불가
	if($APPLY_INFO['status'] != $d['khusd_st_apply_manager']['apply_info']['OPEN']) {
		getLink('','','마감된 신청은 취소할 수 없습니다.','');
	}
	
	// 취소 작업 수행
	$_update = "date_cancel='".$date['totime']."'";
	$_update .= ",status='".$d['khusd_st_apply_manager']['apply_list']['CANCEL']."'";
	
	getDbUpdate($table[$m.'apply_list'], $_update, "uid = '".$APPLIER['uid']."'");
}

getLink('reload', 'parent.', '', '');

?>