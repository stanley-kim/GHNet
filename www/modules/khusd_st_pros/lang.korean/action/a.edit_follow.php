<?php
if(!defined('__KIMS__')) exit;

$DEPARTMENT = 'pros';

/* score update 액션 처리 */

include_once $g['dir_module'].'var/var.php'; // 모듈변수파일 인클루드

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/debug.php';	// 필수 인클루드 파일

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
$dr_room = intval($dr_room);
$pf_name = trim($pf_name);
$dr_name = trim($dr_name);
$date_update = $date['totime'];

$status = $d['khusd_st_pros']['FOLLOW_STATUS']['FOLLOWING'];

// follow_pt 테이블용 상태값
$status_pt = $d['khusd_st_pros']['FOLLOW_PT']['FOLLOWING'];


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
$_set = "pt_name = '".$pt_name."', dr_name = '".$dr_name."', date_update = '".$date_update."'";
$_where = "pt_id = '".$pt_id."'";

getDbUpdate($_table, $_set, $_where);


$_table = $table[$m.'follow'];
$_set = "status = '".$status."', type ='".$follow_type."', date_update = '".$date_update."'";
$_where = "pt_uid = '".$pt_uid."' and st_id ='".$st_id."'";

getDbUpdate($_table, $_set, $_where);


getLink('reload', 'parent.', '환자 정보 수정되었습니다.', '');
?>