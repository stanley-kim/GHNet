<?php
if(!defined('__KIMS__')) exit;

/* score update 액션 처리 */

getLink('', '', '업데이트 작업으로 잠시 기능을 제한합니다.', '');

include_once $g['path_module'].'khusd_st_cnslt_room_manager/var/var.define.php';	// ST 신청용 변수 파일

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}

// 권한 체크
// 권한은 종진실장, 총케이스장, 총대에게만 있다. 
if(!permcheck('chief_of_cnslt_room')) {
	getLink('', '', '권한이 없습니다.', '');
}


// 입력값 유효성 체크
$uid 		= intval($uid);
$status 	= trim($status);
$chair		= trim($chair);
$department	= 'perio';
$date_reg = $date['totime'];

$CHAIR = getUidData($table[$m.'st_chair'], $uid);

if(!$CHAIR || $CHAIR['uid'] != $uid)
{
	getLink('', '', '해당하는 값에 대한 신청 정보가 없습니다.', '');
}
$st_id = $CHAIR['st_id'];
$pt_name = $CHAIR['pt_name'];
$tx_plan = $CHAIR['tx_plan'];
$chair_date = $CHAIR['st_date'];
$chair_timetype = $CHAIR['st_timetype'];

// 시작, 끝 시간 세팅
if($tx_plan == $d['khusd_st_cnslt_room_manager']['tx_plan']['perio']['pre_sc']['id'])
{
	// 오전 9시~12시, 오후 13:30 ~ 17:30
	$chair_start_time = ($chair_timetype == 'am' ? '0900' : '1330');
	$chair_end_time = ($chair_timetype == 'am' ? '1200' : '1730');
}
else
{
	getLink('', '', '다른 진료과정은 아직 지원하지 않습니다.', '');
}

// 변경되는 상태값에 따라 처리
if($status == $d['khusd_st_cnslt_room_manager']['apply']['status']['ACCEPTED'])
{
	// 시간 겹치는지 체크
	$_table = $table['khusd_st_cnslt_room_manager'.'reservation'];
	$_where = 
		"chair_date = '".$CHAIR['st_date']."'"
		." AND chair_no = '".$chair."'"
		." AND ("
			." (chair_start_time <= '".$chair_start_time."' AND chair_end_time > '".$chair_start_time."')"
			." OR "
			." (chair_start_time < '".$chair_end_time."' AND chair_end_time >= '".$chair_end_time."')"
		.")";
	
	$dup_num = getDbRows($_table, $_where);
	if($dup_num > 0)
	{
		getLink('', '', '이미 배정된 시간과 겹칩니다.', '');
	}
	
	// 이미 배정된 체어가 있는데, 체어만 변경하는 것인지 확인
	if($CHAIR['status'] == $d['khusd_st_cnslt_room_manager']['apply']['status']['ACCEPTED'])
	{
		// 기존 체어 취소
		$_where = 
			"chair_date = '".$CHAIR['st_date']."'"
			." AND chair_no = '".$CHAIR['chair_no']."'"
			." AND chair_start_time = '".$chair_start_time."'"
			." AND chair_end_time = '".$chair_end_time."'"
			." AND st_id = '".$st_id."'"
			." AND pt_name = '".$pt_name."'";
		
		getDbDelete($_table, $_where);
	}
	
	// 새로운 체어 배정
	$QKEY = 'st_id, pt_name, reserve_status, department, tx_plan, chair_no, chair_date, chair_timetype, chair_start_time, chair_end_time, date_reg';
	$QVAL = "'$st_id', '$pt_name', '', '$department', '$tx_plan', '$chair', '$chair_date', '$chair_timetype', '$chair_start_time', '$chair_end_time', '$date_reg'";
	
	getDbInsert($_table, $QKEY, $QVAL);
}
elseif($status == $d['khusd_st_cnslt_room_manager']['apply']['status']['CANCEL'])
{
	// 기존 체어 취소
	$_table = $table['khusd_st_cnslt_room_manager'.'reservation'];
	$_where = 
		"chair_date = '".$CHAIR['st_date']."'"
		." AND chair_no = '".$CHAIR['chair_no']."'"
		." AND chair_start_time = '".$chair_start_time."'"
		." AND chair_end_time = '".$chair_end_time."'"
		." AND st_id = '".$st_id."'"
		." AND pt_name = '".$pt_name."'";
		
	getDbDelete($_table, $_where);
}

// 입력한 데이터로 query 생성
$_set = "status = '".$status."', chair_no = '".$chair."'";
$_where = "uid = '".$uid."'";

getDbUpdate($table[$m.'st_chair'],$_set, $_where);

getLink('reload', 'parent.', '변경 되었습니다.', '');
?>