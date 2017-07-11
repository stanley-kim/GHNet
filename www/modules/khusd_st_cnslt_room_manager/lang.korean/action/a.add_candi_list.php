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
$department		= trim($department);
$st_type 		= trim($st_type);

$apply_uid		= intval($apply_uid);
$next_uid		= intval($next_uid);
$date_reg	 	= $date['totime'];

if(!$department || $department == '' || !$d['khusd_st_manager']['department'][$department] || $d['khusd_st_manager']['department'][$department]['id'] != $department)
{
	getLink('', '', '과 정보가 잘못 입력되었습니다.', '');
}

if($st_timetype != 'am' && $st_timetype != 'pm')
{
	getLink('', '', '시간구분 값이 잘못되었습니다.', '');
}



// 우선 대기열에 추가하려는 신청에 대한 데이터를 가져온다. 
$_table = $table[$m.'apply'];
$APPLY = getUidData($_table, $apply_uid);

if(!$APPLY || $APPLY['uid'] != $apply_uid)
{
	getLink('', '', '해당 신청정보를 가져오지 못하였습니다.', '');
}

$s_uid = $APPLY['s_uid'];


// apply table 에서 대기 상태인 신청 수를 구한다. 
$_table = $table[$m.'apply'].' st';
$_where = 
	"st.st_type = '".$st_type."'"
	." AND st.s_uid = '".$s_uid."'"
	." AND st.department = '".$department."'"
	." AND st.st_date = '".$st_date."'"
	." AND st.st_timetype = '".$st_timetype."'"
	." AND status = '".$d['khusd_st_cnslt_room_manager']['apply']['status']['CANDI']."'";

$_data = 'st.*';
$_sort = 'st.date_reg';
$_orderby = 'ASC';

//$CANDI_ROWS_IN_APPLY = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);

// 그리고 대기열에 있는 수와 비교하여 다를 경우 없는 신청에 대해 신청순으로 가장 후순위로 추가


// 대기열의 가장 마지막 아이템 찾기
$_table = $table[$m.'candi'];
$_where = 
	"st_date = '".$st_date."'"
	." AND s_uid = '".$s_uid."'"
	." AND st_timetype = '".$st_timetype."'"
	." AND is_last = 'y'";
$_data = "*";

$LAST_CANDI = getDbData($_table, $_where, $_data);

if($LAST_CANDI && $LAST_CANDI['apply_uid'])
{
	// 새로 마지막을 추가하고, 기존의 마지막 항목을 업데이트
	$is_first = 'n';
	$is_last = 'y';
	$next_uid = 0;
	
	$QKEY = "s_uid, apply_uid, st_id, st_date, st_timetype, next_uid, is_first, is_last, date_reg";
	$QVAL = "'$s_uid', '$apply_uid', '$st_id', '$st_date', '$st_timetype', '$next_uid', '$is_first', '$is_last', '$date_reg'";
		
	if($st_type == "radio"){
		$st_timetype_detail	= trim($st_timetype_detail);
		if($st_timetype_detail == "1" || $st_timetype_detail == "2"){
			$QKEY .= ", st_timetype_detail";
			$QVAL .= ", '".$st_timetype_detail."'";
		}
	}
	getDbInsert($table[$m.'candi'],$QKEY,$QVAL);
	
	// 직전에 추가된 대기열의 uid 구한다. 
	$_where = "apply_uid = '".$apply_uid."'";
	$LAST_UID = getDbCnt($table[$m.'candi'], 'max(uid)', $_where);
	
	// 이전의 마지막 대기열을 업데이트
	$_set = "is_last = 'n', next_uid = '$LAST_UID'";
	$_where = "uid = '".$LAST_CANDI['uid']."'";
	
	getDbUpdate($table[$m.'candi'], $_set, $_where);
}
else
{
	// 아직 대기열이 없으므로 새로 추가
	$is_first = 'y';
	$is_last = 'y';
	$next_uid = 0;
	
	$QKEY = "s_uid, apply_uid, st_id, st_date, st_timetype, next_uid, is_first, is_last, date_reg";
	$QVAL = "'$s_uid', '$apply_uid', '$st_id', '$st_date', '$st_timetype', '$next_uid', '$is_first', '$is_last', '$date_reg'";
	
	if($st_type == "radio"){
		$st_timetype_detail	= trim($st_timetype_detail);
		if($st_timetype_detail == "1" || $st_timetype_detail == "2"){
			$QKEY .= ", st_timetype_detail";
			$QVAL .= ", '".$st_timetype_detail."'";
		}
	}
	
	getDbInsert($table[$m.'candi'],$QKEY,$QVAL);
}

getLink('reload', 'top.', '대기열에 추가되었습니다.', '');

?>