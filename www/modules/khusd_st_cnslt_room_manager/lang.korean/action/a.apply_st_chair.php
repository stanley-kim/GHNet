<?php
if(!defined('__KIMS__')) exit;

/* score update 액션 처리 */

include_once $g['path_module'].'khusd_st_cnslt_room_manager/var/var.define.php';	// ST 신청용 변수 파일

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/member.php';

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}

// 지금 로그인한 사용자인지 체크
if($st_id == NULL || !is_string($st_id) || $st_id != $my['id']) {
	getLink('', '', '사용자 학번이 누락되었거나, 로그인한 사용자 학번과 일치하지 않습니다.', '');
}

// 현재 진행중인 학기 선택
$SEMESTER_INFO = getCurrentSemesterInfo();

// TODO s_uid 를 form 에서 받는것과 이렇게 하는것중 뭐가 날까

// 입력값 유효성 체크
$s_uid 		= $SEMESTER_INFO['uid'];
$st_date 	= trim($st_date);
$st_timetype	= trim($st_timetype);
$pt_name	= trim($pt_name);
$tx_plan	= trim($tx_plan);
$department = trim($department);
$st_type = trim($st_type);
$status = $d['khusd_st_cnslt_room_manager']['apply']['status']['APPLY'];

$memo = '';
// 백장현 선생님 담당하는 날에 필요한 추가 정보
// 2014.3.17 수정 - 모든 보철에 대해 입력받는걸로
// 2014.5.1~6 수정 - memo 가 아니라, 보철과 점수 디비에 기록된 환자정보 이용하도록 수정
if($st_type == 'pros')
{
	$memo = trim($pros_pt);
	
	if($memo && strlen($memo) > 0 && strpos($memo, 'pros_pt_case_') !== false)
	{
		// pros_pt 정보로 환자이름 가져오기
		include_once $g['path_module'].'khusd_st_pros/_main.php';	// 보철 ST 환자 관련 함수
		$PROS_PT_ARRAY = getProsSTPT($st_id);
		
		$PROS_PT = $PROS_PT_ARRAY[substr($memo, strlen('pros_pt_case_'), 1)];
		$pt_name = $PROS_PT['pt_name'];
	}
}
if(false && $st_type == 'pros')
{
	$is_friendly_pt = isset($is_friendly_pt) ? '1' : '0';
	$prev_st_date = trim($prev_st_date);
	$prev_tx_plan = trim($prev_tx_plan);
	$prev_inst = trim($prev_inst);
	
	if($prev_tx_plan != 'none' && strlen($prev_st_date) != 10)
		getLink('', '', '보철과 ST에는 이전 진료에 대한 정보가 필수입니다.', '');
	
	// 이 정보들을 memo 에 추가한다
	$memo = 
		($is_friendly_pt == '1' ? '친환 O' : '친환 X')
		.($prev_tx_plan != 'none' ?
				' / '.$prev_st_date
				.' / '.$d['khusd_st_cnslt_room_manager']['tx_plan']['pros'][$prev_tx_plan]['name']
				.' / '.$d['khusd_st_cnslt_room_manager']['pros']['inst']['list'][$prev_inst]['name']
			: 
				' / 이전 진료 없음'
		)
		;
}

if($date['today'] > $st_date)
{
	getLink('', '', '지난 날에 대해서는 ST 신청이 불가능합니다.');
}

// 신청 가능 시간인지 판단
// var.define.php 의 변수에 따라
// 신청 가능 시간이면 '신청' 상태로 신청이 되고, 
// 신청 가능 시간이 지났으면 '대기' 상태로 신청이 된다. 
//
// 신청은 한주 전에만 가능하므로 기준일에서 7을 뺀 값을 사용한다. 
include_once $g['path_module'].'khusd_st_manager/function/date.php';

$start_date = getDateOfDay(
					$st_date, 
					$d['khusd_st_cnslt_room_manager']['apply_time']['start_day'] - 7, 
					$d['khusd_st_cnslt_room_manager']['apply_time']['start_hour']
				);
$end_date = getDateOfDay(
					$st_date, 
					$d['khusd_st_cnslt_room_manager']['apply_time']['end_day'] - 7, 
					$d['khusd_st_cnslt_room_manager']['apply_time']['end_hour']
				);

if($date['totime'] < $start_date)
{
	getLink('', '', '아직 신청 가능 시간이 아닙니다. ST는 전주 월요일 '.$d['khusd_st_cnslt_room_manager']['apply_time']['start_hour'].'시부터 신청 가능합니다.');
}
elseif($date['totime'] >= $start_date && $date['totime'] <= $end_date)
{
	$status = $d['khusd_st_cnslt_room_manager']['apply']['status']['APPLY'];
}
elseif($department != 'radio')
{
	$status = $d['khusd_st_cnslt_room_manager']['apply']['status']['CANDI'];
}

if(!$department || $department == '' || !$d['khusd_st_manager']['department'][$department] || $d['khusd_st_manager']['department'][$department]['id'] != $department)
{
	getLink('', '', '과 정보가 잘못 입력되었습니다.', '');
}

if($st_type == 'consv')
{
	$consv_op	= intval($consv_op);
	if(!$consv_op)
		$consv_op = 0;
}

$date_reg = $date['totime'];

if(!$pt_name || strlen($pt_name) <= 0)
{
	getLink('', '', '환자명을 입력하셔야 합니다.', '');
}
if($st_timetype != 'am' && $st_timetype != 'pm' && $st_timetype != 'nt')
{
	getLink('', '', '시간구분 값이 잘못되었습니다.', '');
}
if($st_timetype == 'nt' && getDateFormat($st_date, 'w') != 3)
{
	getLink('', '', '야가ㄴ으ㄴ 수요이ㄹ마ㄴ 가느ㅇ하ㅂ니다.', '');
}

if($st_start_time && $st_end_time)
{
	if($st_start_time >= $st_end_time)
	{
		getLink('', '', '시작/종료 시간이 잘못 설정되었습니다.', '');
	}
	/*
	if($st_start_time < '0900' || $st_start_time >= '1730' || $st_end_time <= '0900' || $st_end_time > '1730')
	{
		getLink('', '', '진료 시간은 오전 9시부터 오후 5시 30분까지 입니다.', '');
	}
	
	if($st_timetype == 'am')
	{
		if($st_start_time >= '1200' || $st_end_time > '1200')
			getLink('', '', '오전은 12시까지 입니다.', '');
	}
	if($st_timetype == 'pm')
	{
		if($st_start_time < '1330' || $st_end_time <= '1330')
			getLink('', '', '오후는 1시 30분부터 입니다.', '');
	}
	*/
}

// 과별로 시작/종료 시간 설정
if($st_type == 'perio')
{
	if(is_array($d['khusd_st_cnslt_room_manager']['tx_plan']['perio'][$tx_plan]['time']))
	{
		$st_start_time = $d['khusd_st_cnslt_room_manager']['tx_plan']['perio'][$tx_plan]['time'][$st_timetype]['start'];
		$st_end_time = $d['khusd_st_cnslt_room_manager']['tx_plan']['perio'][$tx_plan]['time'][$st_timetype]['end'];
	}
}
elseif($st_type == 'pedia')
{
	if($st_time == '13301530')
	{
		$st_start_time = '1330';
		$st_end_time = '1530';
	}
	elseif($st_time == '15301730')
	{
		$st_start_time = '1530';
		$st_end_time = '1730';
	}
}

if(!$st_start_time)
{
	if($st_timetype == 'am')
	{
		$st_start_time = '0900';
	}
	else if($st_timetype == 'pm')
	{
		$st_start_time = '1330';
	}
	else if($st_timetype == 'nt')
	{
		$st_start_time = '1730';
	}
}
if(!$st_end_time)
{
	if($st_timetype == 'am')
	{
		$st_end_time = '1200';
	}
	else if($st_timetype == 'pm')
	{
		$st_end_time = '1730';
	}
	else if($st_timetype == 'nt')
	{
		$st_end_time = '2000';
	}
}

// 입력한 데이터로 query 생성
$QKEY = "s_uid, st_id, st_date, st_timetype, st_start_time, st_end_time, pt_name, st_type, department, tx_plan, status, memo, date_reg";
$QVAL = "'$s_uid', '$st_id', '$st_date', '$st_timetype', '$st_start_time', '$st_end_time', '$pt_name', '$st_type', '$department', '$tx_plan', '$status', '$memo', '$date_reg'";

if($st_type == 'consv')
{
	$QKEY .= ", consv_op";
	$QVAL .= ", '$consv_op'";
}
if($st_type == "radio"){
	$st_timetype_detail	= trim($st_timetype_detail);
	if($st_timetype_detail == "1" || $st_timetype_detail == "2"  || $st_timetype_detail == "3"){
		$QKEY .= ", st_timetype_detail";
		$QVAL .= ", '$st_timetype_detail'";
	}
}

getDbInsert($table[$m.'apply'],$QKEY,$QVAL);

// 대기 상태로 추가된다면, 대기열에 추가
if($status == $d['khusd_st_cnslt_room_manager']['apply']['status']['CANDI'])
{
	// 직전에 추가된 대기열의 uid 구한다. 
	$LAST_UID = getDbCnt($table[$m.'apply'], 'max(uid)', '');

	$apply_uid = $LAST_UID;
	$next_uid = 0;
	
	include_once $g['dir_module'].'lang.'.$_HS['lang'].'/action/a.add_candi_list.php';
}


getLink('reload', 'top.', '신청 되었습니다.', '');
?>