<?php
if(!defined('__KIMS__')) exit;

$DEPARTMENT = 'follow';

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
/*
if(permcheck($DEPARTMENT))
{
	$MANAGER = true;
}
*/
// TODO s_uid 를 form 에서 받는것과 이렇게 하는것중 뭐가 날까
// 현재 진행중인 학기 선택
$SEMESTER_INFO = getCurrentSemesterInfo();

// 입력값 유효성 체크
$s_uid 		= $SEMESTER_INFO['uid'];

// 입력값 유효성 체크 (강화 필요..)
$pt_name = trim($pt_name);
$pt_id = trim($pt_id);
$department = trim($department);
$add_type = trim($add_type);
if($add_type == "new"){
	if($department=='perio') {
		$dr_name = trim($dr_name_perio);
		$fw_type = trim($fw_type_perio);
		$misc = trim($misc_perio);
	} else if($department=='consv') {
		$dr_name = trim($dr_name_consv);
		$fw_type = trim($fw_type_consv);
		$misc = trim($misc_consv);
	} else {
		$dr_name = trim($dr_name_ortho);
		$fw_type = trim($fw_type_ortho);
		$misc = trim($misc_ortho);
	}
} else {
	$dr_name = trim($dr_name);
	$fw_type = trim($fw_type);
	$misc = trim($misc);
}

__debug_print("PT_NAME: $pt_name, PT_ID: $pt_id, DEPT: $department, DR_NAME=$dr_name, FW_TYPE=$fw_type");

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

// follow 테이블용 상태값
$status = 'f';

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
if(!$FOLLOW_PT)
{
	// 입력한 데이터로 query 생성
	$QKEY = "pt_id, pt_name, date_reg";
	$QVAL = "'$pt_id', '$pt_name', '$date_update'";
	
	getDbInsert($table[$m.'follow_pt'],$QKEY,$QVAL);
}

$FOLLOW_PT_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);

$FOLLOW_PT = db_fetch_array($FOLLOW_PT_ROWS);
if(!$FOLLOW_PT)
{
	__debug_print("fail to add follow : pt_name : [$pt_name], pt_id : [$pt_id], st_id : [$st_id]");
	getLink('', '', "팔로우 환자 정보를 찾지 못하였습니다. (입력정보 : 환자명($pt_name), 병록번호($pt_id), 학번($st_id))", '');
}

$QKEY = "s_uid, pt_uid, department, dr_name, st_id, fw_type, status, date_reg, date_update, misc";
$QVAL = "'$s_uid', '".$FOLLOW_PT['uid']."', '$department', '$dr_name', '$st_id', '$fw_type', '$status', '$date_update', '$date_update', '$misc'";

getDbInsert($table[$m.'follow'],$QKEY,$QVAL);

getLink('reload', 'parent.', '팔로우 등록 되었습니다.', '');
?>
