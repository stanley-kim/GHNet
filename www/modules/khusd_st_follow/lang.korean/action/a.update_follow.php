<?php
if(!defined('__KIMS__')) exit;

$DEPARTMENT = 'follow';

/* score update 액션 처리 */

include_once $g['dir_module'].'var/var.php'; // 모듈변수파일 인클루드

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/debug.php';	// 필수 인클루드 파일

__debug_print("Inside UPDATE FOLLOW");

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}

if(permcheck($DEPARTMENT))
{
	$MANAGER = true;
}

// 입력값 유효성 체크 (강화 필요..)
$pt_name = trim($pt_name);
$pt_id = trim($pt_id);
$pt_uid = trim($pt_uid);
$fw_uid = trim($fw_uid);
$department = trim($department);
$step = trim($step);
$status = trim($status);

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

$date_update = $date['totime'];

//__debug_print("Data received");

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


// 해당 환자를 팔로우 중인지 확인

// 관리자가 아니면서 해당 환자의 팔로워가 아니면 권한 부족!!!

// 해당 환자의 정보를 업데이트
$_table = $table[$m.'follow_pt'];
$_set = "pt_name = '$pt_name'";
$_where = "uid = '$pt_uid'";

//__debug_print("UPDATE $_table SET $_set WHERE $_where");

getDbUpdate($_table, $_set, $_where);

// 해당 팔로우 정보를 업데이트
$_table = $table[$m.'follow'];
$_set = "status = '$status', department = '$department', dr_name = '$dr_name', fw_type = '$fw_type', step = '$step', misc = '$misc', date_update = '$date_update'";
$_where = "uid = '".$fw_uid."'";

//__debug_print("UPDATE $_table SET $_set WHERE $_where");

getDbUpdate($_table, $_set, $_where);


getLink('reload', 'parent.', '환자 팔로우 정보 수정되었습니다.', '');
?>