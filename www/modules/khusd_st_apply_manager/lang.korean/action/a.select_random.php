<?php
if(!defined('__KIMS__')) exit;

include_once $g['dir_module'].'var/var.php'; // 모듈변수파일 인클루드
include_once $g['dir_module'].'var/var.define.php'; // 각종 변수 정의 인클루드

// 이게 false 면 권한이 없는 것
include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/member.php';
include_once $g['path_module'].'khusd_st_manager/function/push.php';
include_once $g['path_module'].'khusd_st_manager/function/debug.php';

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	getLink('', '', '권한이 없거나 로그인하지 않으셨습니다.', '');
}

$uid = intval($uid);

// get apply_info
$apply_info = getUidData($table[$m.'apply_info_list'], $uid);
$date_select = $date['totime'];

if(
	$apply_info['st_id'] != $my['id'] 
	&& !permcheck('manager') 
	&& !permcheck($apply_info['department']) 
	&& ($APPLY_INFO['department'] == 'perio' && !permcheck('chief_of_op'))
	&& ($APPLY_INFO['department'] == 'pros' && !permcheck('pros_sub')) )
{
	getLink('', '', '권한이 없습니다.', '');
}

// check apply_info status
if($apply_info['status'] != $d['khusd_st_apply_manager']['apply_info']['OPEN'])
{
	getLink('', 'parent.', '이미 마감되었습니다.', '-1');
}

// close apply_info
getDbUpdate($table[$m.'apply_info_list']
	, "status = '".$d['khusd_st_apply_manager']['apply_info']['CLOSED']."'"
		.", date_select = '".$date_select."'"
	, "uid = '".$uid."'"
);

// update apply_list to generate random value
getDbUpdate($table[$m.'apply_list'], 'rand = RAND( UNIX_TIMESTAMP() )', "apply_info_uid = '".$uid."' AND status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'");
// get apply_item
$ITEM_ARRAY = array();
$ITEM_ROWS = getDbArray($table[$m.'apply_item'], 'apply_info_uid='.$uid,'*','uid','ASC',0,0);
while($ITEM = db_fetch_array($ITEM_ROWS)) 
{
	$ITEM_ARRAY[] = $ITEM;

	// 기존 당첨자 수 구하기
	$ACCEPTED_NUM = getDbRows($table[$m.'apply_list'],
				"apply_item_uid = '".$ITEM['uid']."'"
				." AND status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
	);
	
	if($ACCEPTED_NUM < $ITEM['accept_limit'])
	{
		db_query("UPDATE ".$table[$m.'apply_list']
				." SET status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
				." WHERE apply_item_uid = '".$ITEM['uid']."'"
				." AND status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'"
				." AND date_reg >= '".$apply_info['date_start']."'"
				." ORDER BY rand DESC"
				.( $ITEM['accept_limit'] == 0 ? '' : ' LIMIT '.($ITEM['accept_limit'] - $ACCEPTED_NUM) ), $DB_CONNECT);
	}
}

// 모든 항목 신청자들에게 푸시 보내기
$APPLIER_ROWS = getDbArray($table[$m.'apply_list'], "apply_info_uid = ".$uid, 'st_id', 'st_id', 'ASC', 0, 0);
$APPLIER_ARRAY = array();
while($APPLIER = db_fetch_array($APPLIER_ROWS))
{
	$APPLIER_ARRAY[$APPLIER['st_id']] = $APPLIER['st_id'];
}
foreach($APPLIER_ARRAY as $IDX => $APPLIER_ST_ID)
{
	// 회원정보 가져오기
	$ST_INFO = getSTInfo($APPLIER_ST_ID);
	
	$phone = preg_replace('/[^0-9]*/s', '', $ST_INFO['tel2']);

	if($phone)
	{
		send_push($apply_info['subject']."이(가) 마감되었습니다!!", 
			"당첨여부 확인하러 가보세요~!!!", 
			$phone, 
			$g['url_root'].'/?'.($_HS['usescode']?'r='.$r.'&':'').'c='.$c.'&uid='.$uid);
	}
}

getLink('reload', 'parent.', '', '-1');

?>
