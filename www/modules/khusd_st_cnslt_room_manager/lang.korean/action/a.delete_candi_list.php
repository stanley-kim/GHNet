<?php
if(!defined('__KIMS__')) exit;

/* score update 액션 처리 */

include_once $g['path_module'].'khusd_st_cnslt_room_manager/var/var.define.php';	// ST 신청용 변수 파일

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}

// 관리자 권한여부 체크
$MANAGER = $MANAGER ? $MANAGER : false;
if(!$MANAGER)
{
	if(permcheck('chief_of_cnslt_room') || permcheck('chief_of_op'))
	{
		$MANAGER = true;
	}
}

// 지금 로그인한 사용자인지 체크
if($st_id == NULL 
	|| !is_string($st_id)
	|| (!$MANAGER && $st_id != $my['id'])
	) 
{
	getLink('', '', '사용자 학번이 누락되었거나, 로그인한 사용자 학번과 일치하지 않습니다.'.$MANAGER, '');
}

// 입력값 유효성 체크
$st_date 		= trim($st_date);
$st_timetype	= trim($st_timetype);

$apply_uid		= intval($apply_uid);

if($st_timetype != 'am' && $st_timetype != 'pm')
{
	getLink('', '', '시간구분 값이 잘못되었습니다.', '');
}



// 우선 대기열에서 제거하려는 대기열 데이터를 가져온다. 
$_table = $table[$m.'candi'];
$_where = 
	"apply_uid = '".$apply_uid."'"
	." AND st_date = '".$st_date."'"
	." AND st_timetype = '".$st_timetype."'";
$_data = "*";
$CANDI = getDbData($_table, $_where, $_data);

if(!$CANDI || $CANDI['apply_uid'] != $apply_uid)
{
	getLink('', '', '해당 대기열 정보를 가져오지 못하였습니다.'.$CANDI['apply_uid'], '');
}

/*
if($CANDI['is_first'] == 'y')
{
	// 제거할 대기열이 첫 항목이라면, 다음 대기열을 찾아서 업데이트
	if($CANDI['is_last'] != 'y')
	{
		$_table = $table[$m.'candi'];
		$_where = "uid = '".$CANDI['next_uid']."'";
		$_set = "is_first = 'y'";
		getDbUpdate($_table, $_set, $_where);
	}
}
else
{
	// 제거할 대기열의 바로 앞 대기열 항목 업데이트
	$_table = $table[$m.'candi'];
	$_where = "next_uid = '".$CANDI['uid']."'";
	$_set = "next_uid = '".$CANDI['next_uid']."'"
		.", is_last = '".$CANDI['is_last']."'";
	getDbUpdate($_table, $_set, $_where);
}*/

// just delete the matching info without modifying any other information.
$_table[$m.'candi'];
$_where = "uid = '".$CANDI['uid']."'";
getDbDelete($_table, $_where);

getLink('reload', 'top.', '대기열에서 제거되었습니다.', '');

?>