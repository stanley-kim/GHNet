<?php
if(!defined('__KIMS__')) exit;

/* score update 액션 처리 */

getLink('', '', '업데이트 작업으로 잠시 신청을 제한합니다.', '');

include_once $g['path_module'].'khusd_st_cnslt_room_manager/var/var.define.php';	// ST 신청용 변수 파일

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}

// 지금 로그인한 사용자인지 체크
if($st_id == NULL || !is_string($st_id) || $st_id != $my['id']) {
	getLink('', '', '사용자 학번이 누락되었거나, 로그인한 사용자 학번과 일치하지 않습니다.', '');
}


// 입력값 유효성 체크
$st_date 	= trim($st_date);
$st_timetype	= trim($st_timetype);
$pt_name	= trim($pt_name);
$tx_plan	= trim($tx_plan);

$status = $d['khusd_st_cnslt_room_manager']['apply']['status']['APPLY'];
$date_reg = $date['totime'];

if(!$pt_name || strlen($pt_name) <= 0)
{
	getLink('', '', '환자명을 입력하셔야 합니다.', '');
}
if($st_timetype != 'am' && $st_timetype != 'pm')
{
	getLink('', '', '시간구분 값이 잘못되었습니다.', '');
}

// 입력한 데이터로 query 생성
$QKEY = "st_id, st_date, st_timetype, pt_name, tx_plan, status, date_reg";
$QVAL = "'$st_id', '$st_date', '$st_timetype', '$pt_name', '$tx_plan', '$status', '$date_reg'";

getDbInsert($table[$m.'st_chair'],$QKEY,$QVAL);

getLink('reload', 'parent.', '신청 되었습니다.', '');
?>