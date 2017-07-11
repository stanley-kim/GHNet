<?php
if(!defined('__KIMS__')) exit;

/* score update 액션 처리 */

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

// TODO s_uid 를 form 에서 받는것과 이렇게 하는것중 뭐가 날까
// 현재 진행중인 학기 선택
$SEMESTER_INFO = getCurrentSemesterInfo();

// 입력값 유효성 체크
$s_uid 		= $SEMESTER_INFO['uid'];

// 입력값 유효성 체크
$taking		= intval($taking);
$taking_pt	= intval($taking_pt);
$follow 	= intval($follow);
$obser_decofing	= intval($obser_decoding);
$obser_filming 	= intval($obser_filming);
$panorama	= intval($panorama);

$penalty_taking		= intval($penalty_taking);

$date_update = $date['totime'];

// 입력한 데이터로 query 생성
$QKEY = "s_uid, st_id, taking, taking_pt, follow,obser_decoding ,obser_filming  , panorama, penalty_taking, date_update";
$QVAL = "'$s_uid', '$st_id', '$taking', '$taking_pt', '$follow', '$obser_decoding'   ,  '$obser_filming'  , '$panorama', '$penalty_taking', '$date_update'";
	
getDbInsert($table[$m.'score'],$QKEY,$QVAL);

if(isset($n_page) && $n_page == 'home')
{
	getLink('/', 'parent.', '업데이트 되었습니다.', '');
}
else
{
	getLink('reload', 'parent.', '업데이트 되었습니다.', '');
}
?>
