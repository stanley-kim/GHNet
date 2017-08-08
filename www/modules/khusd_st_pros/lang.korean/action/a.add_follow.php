<?php
if(!defined('__KIMS__')) exit;

$DEPARTMENT = 'pros';

/* score update 액션 처리 */

include_once $g['dir_module'].'var/var.php'; // 모듈변수파일 인클루드

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/debug.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/member.php';

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}

if(permcheck($DEPARTMENT))
{
	$MANAGER = true;
}

// TODO s_uid 를 form 에서 받는것과 이렇게 하는것중 뭐가 날까
// 현재 진행중인 학기 선택
$SEMESTER_INFO = getCurrentSemesterInfo();

// 입력값 유효성 체크
$s_uid 		= $SEMESTER_INFO['uid'];

// 입력값 유효성 체크 (강화 필요..)
$pt_name = trim($pt_name);
$pt_id = trim($pt_id);
$dr_name = trim($dr_name);
//follow_type
$follow_type = trim($follow_type);

$date_update = $date['totime'];

if(strlen($pt_id) != 8 && intval($pt_id) <= 0)
{
	// TODO 정규식으로 숫자8자리 체크하도록 수정하기
	getLink('', '', '이름과 병록번호 양식을 확인해주세요. 병록번호는 숫자 8자리 이어야 합니다.', '');
}

if(!isset($st_id) || !$st_id || $st_id == '')
{
	$st_id = $my['id'];
}

if(!$MANAGER && $st_id != $my['id'])
{
	getLink('', '', '타인의 Follow 환자를 등록할 권한이 없습니다.'.$st_id, '');
}

// 기존 팔로우 정보가 있어서 업데이트 했으면 true
// 이게 false 일때만 마지막에 insert 로 팔로우를 추가
$IS_UPDATED = false;


$status = $d['khusd_st_pros']['FOLLOW_STATUS']['FOLLOWING'];

// follow_pt 테이블용 상태값
$status_pt = $d['khusd_st_pros']['FOLLOW_PT']['FOLLOWING'];


// 검색
// 환자명 / 병록번호로 검색하기
$_table = $table[$m.'follow_pt'];
$_where =
	"("
		."pt_name = '".$pt_name."'"
		." AND pt_id = '".$pt_id."'"
	.")";
$_data = '*';
$_sort = 'uid';
$_orderby = 'ASC';

$FOLLOW_PT_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);

$FOLLOW_PT = db_fetch_array($FOLLOW_PT_ROWS);
if($FOLLOW_PT)
{
	// 팔로우 중인 원내생 수를 파악하여 2명 이내이면 추가 등록하기
	$pt_uid = $FOLLOW_PT['uid'];
	
	$_table = $table[$m.'follow'];
	$_data = '*';
	$_where = 
		"s_uid = '".$s_uid."'"
		." AND st_id = '".$st_id."'"
		." AND pt_uid = '".$pt_uid."'"
		." AND type = '".$follow_type."'"
		." AND status = '".$d['khusd_st_pros']['FOLLOW_STATUS']['FOLLOWING']."'";
	$_sort = 'uid';
	$_orderby = 'ASC';
	
	$FOLLOW_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
	
	$FOLLOW_ARRAY = array();
	while( $_ROW = db_fetch_array( $FOLLOW_ROWS ) ) $FOLLOW_ARRAY[] = $_ROW;
	
	if(count($FOLLOW_ARRAY) >= $d['khusd_st_pros']['FOLLOWER_LIMIT'])
	{
		getLink('', '', '이미 '.$d['khusd_st_pros']['FOLLOWER_LIMIT'].'명 이상이 팔로우 중인 환자 입니다.', '');
	}
	else if(count($FOLLOW_ARRAY) < $d['khusd_st_pros']['FOLLOWER_LIMIT'])
	{
		foreach($FOLLOW_ARRAY as $FOLLOW)
		{
			if($FOLLOW['st_id'] == $st_id)
				if($st_id == $my['id'])
					getLink('', '', '이미 당신이 팔로우 중인 환자 입니다.', '');
				else
					getLink('', '', '이미 '.$st_id.'님이 팔로우 중인 환자 입니다.', '');
		}
	}
	
	// 이미 팔로 내역이 있으면 상태랑 날짜만 변경하기
	$_table = $table[$m.'follow'];
	$_where = 
		"s_uid = '".$s_uid."'"
		." AND st_id = '".$st_id."'"
		." AND pt_uid = '".$pt_uid."'";
	
	$MY_FOLLOW_UID = getDbCnt($_table, 'max(uid)', $_where);
	
	if($MY_FOLLOW_UID > 0)
	{
		// 기존 팔로우 정보를 업데이트
		$_set = "type = '".$follow_type."', status = '".$status."', date_update = '".$date_update."'";
		$_where = 
			"s_uid = '".$s_uid."'"
			." AND uid = '".$MY_FOLLOW_UID."'";
		
		getDbUpdate($_table, $_set, $_where);
		
		$IS_UPDATED = true;
	}

	$_table = $table[$m.'follow_pt'];
	$_where = 
		"pt_name = '".$pt_name."'"
		." AND pt_id = '".$pt_id."'";
	$_set = "status = '".$status_pt."', date_update = '".$date_update."'";
	
	getDbUpdate($_table, $_set, $_where);
}
else
{
	// 입력한 데이터로 query 생성
	$QKEY = "pt_name, pt_id, dr_name, status, date_update";
	$QVAL = "'$pt_name', '$pt_id', '$dr_name', '$status_pt', '$date_update'";
	getDbInsert($table[$m.'follow_pt'],$QKEY,$QVAL);
	
}

if(!$IS_UPDATED)
{
	$_table = $table[$m.'follow_pt'];
	$_where = 
		"pt_name = '".$pt_name."'"
		." AND pt_id = '".$pt_id."'";
	
	$FOLLOW_PT_UID = getDbCnt($_table, 'uid', $_where);
	
	if($FOLLOW_PT_UID <= 0)
	{
		//__debug_print("fail to add follow : pt_name : [$pt_name], pt_id : [$pt_id], st_id : [$st_id]");
		getLink('', '', "팔로우 환자 정보를 찾지 못하였습니다. (입력정보 : 환자명($pt_name), 병록번호($pt_id), 학번($st_id))", '');
	}
	
	$QKEY = "s_uid, pt_uid, st_id, type, status, date_update";
	$QVAL = "'$s_uid', '$FOLLOW_PT_UID', '$st_id', '$follow_type', '$status', '$date_update'";
	
	getDbInsert($table[$m.'follow'],$QKEY,$QVAL);
}

getLink('reload', 'parent.', '팔로우 등록 되었습니다.', '');

?>