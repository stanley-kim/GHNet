<?php
if(!defined('__KIMS__')) exit;

include_once $g['dir_module'].'var/var.php'; // 모듈변수파일 인클루드
include_once $g['dir_module'].'var/var.define.php'; // 각종 변수 정의 인클루드

// 이게 false 면 권한이 없는 것
include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/push.php';
include_once $g['path_module'].'khusd_st_manager/function/debug.php';

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	getLink('', '', '권한이 없거나 로그인하지 않으셨습니다.', '');
}

// todo 수술 추가 권한이 있는지 체크
if(false) {
	getLink('', '', '선착순 신청 추가 권한이 없습니다.', '');
}

include_once $g['dir_module'].'var/var.define.php'; // 모듈변수파일 인클루드

$date_start_t = strtotime($start_date.' '.$start_hour.':'.$start_min.':00');
$date_end_t = strtotime($end_date.' '.$end_hour.':'.$end_min.':00');

// 입력값 유효성 체크
$uid = $uid ? intval($uid) : 0;
$s_uid = $s_uid ? intval($s_uid) : 0;
$st_id = $my['id'];
$apply_limit = (intval($apply_limit) <= 0 ? 0 : intval($apply_limit));
$department = trim($department);
$subject = trim($subject);
$date_start = date('YmdHis',$date_start_t);
$date_end = date('YmdHis',$date_end_t);
$apply_type = trim($apply_type); // 
$status = $d['khusd_st_apply_manager']['apply_info']['OPEN'];
$is_perio_surgery = isset($GLOBALS['is_perio_surgery']) ? 'y' : 'n';
$date_reg = $date['totime'];
//$able_apply_accepted

if (  $date['totime'] > $date_end ) {
	getLink('', '', '마감시간은 현재 시간 이후여야 합니다.', '');
}

if($uid > 0)	$APPLY_INFO = getUidData($table[$m.'apply_info_list'],$uid);

if($uid > 0 && $APPLY_INFO['uid'] == $uid)
{
	$_QSET = "s_uid = '$s_uid', st_id = '$st_id', apply_limit = '$apply_limit', department = '$department', subject = '$subject', content = '$content', date_start = '$date_start', date_end = '$date_end', apply_type = '$apply_type', status = '$status', able_apply_accepted = '$able_apply_accepted', is_perio_surgery = '$is_perio_surgery', date_reg = '$date_reg'";
	
	getDbUpdate($table[$m.'apply_info_list'],$_QSET, "uid = '".$uid."'");
	/*
	send_push_all(
		"[신청] ".$subject."이(가) 올라왔습니다.", 
		"새로운 신청글 - ".$subject."가 올라왔습니다.\n"
		."신청할 것이 있는지 확인해보세요~!\n\n"
		."신청시작 : ".date('Y년 m월 d일 H시 i분',$date_start_t)."\n"
		."신청마감 : ".date('Y년 m월 d일 H시 i분',$date_end_t)."\n"
		."신청종류 : ".($apply_type == 'rand' ? "랜덤" : ( $apply_type == 'fcfs' ? "선착순" : ''))."\n", 
		$g['url_root'].'/?'.($_HS['usescode']?'r='.$r.'&':'').'c='.$c.'&uid='.$uid);
	*/
	getLink($cview, 'parent.', '', '');
}
else
{
	$_QKEY = 's_uid, st_id, apply_limit, department, subject, content, date_start, date_end, apply_type, status, able_apply_accepted, is_perio_surgery, date_reg';
	$_QVAL = "'$s_uid', '$st_id', '$apply_limit', '$department', '$subject', '$content', '$date_start', '$date_end', '$apply_type', '$status', '$able_apply_accepted', '$is_perio_surgery', '$date_reg'";
	
	getDbInsert($table[$m.'apply_info_list'],$_QKEY, $_QVAL);
	
	// 새로 추가된 신청의 uid 가져온다. 
	$LASTUID = getDbCnt($table[$m.'apply_info_list'],'max(uid)','');

	send_push_all(
		"[신청] ".$subject."이(가) 올라왔습니다.", 
		"새로운 신청글 - ".$subject."이(가) 올라왔습니다.\n"
		."신청할 것이 있는지 확인해보세요~!\n\n"
		."신청시작 : ".date('Y년 m월 d일 H시 i분',$date_start_t)."\n"
		."신청마감 : ".date('Y년 m월 d일 H시 i분',$date_end_t)."\n"
		."신청종류 : ".($apply_type == 'rand' ? "랜덤" : ( $apply_type == 'fcfs' ? "선착순" : ''))."\n", 
		$g['url_root'].'/?'.($_HS['usescode']?'r='.$r.'&':'').'c='.$c.'&uid='.$LASTUID);

	getLink($nlist, 'parent.', '', '');
}

?>
