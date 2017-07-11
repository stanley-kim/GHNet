<?php
if(!defined('__KIMS__')) exit;

$DEPARTMENT = 'pros';

/* score update 액션 처리 */

include_once $g['dir_module'].'var/var.php'; // 모듈변수파일 인클루드

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/debug.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/member.php';

// 현재 진행중인 학기 선택
$SEMESTER_INFO = getCurrentSemesterInfo();

// 입력값 유효성 체크
$s_uid 		= $SEMESTER_INFO['uid'];

// 입력값 유효성 체크 (강화 필요..)
$pt_name = trim($pt_name);
$pt_id = trim($pt_id);
$follow_type = trim($follow_type);
$dr_name = mysql_real_escape_string($dr_name);
//$status

$date_update = $date['totime'];

if(strlen($pt_id) != 8 && intval($pt_id) <= 0)
{
	// TODO 정규식으로 숫자8자리 체크하도록 수정하기
	getLink('', '', '병록번호 양식을 확인해주세요. 병록번호는 숫자 8자리 이어야 합니다.', '');
}
if(strlen($dr_name) <= 0)
{
	getLink('', '', '담당선생님 이름을 입력해주세요.', '');
}

if($follow_type == "0")
{
	getLink('', '', '팔로우 종류를 선택해주세요.', '');
}

//getLink('', '', "$follow_type 2", '');

if(!isset($st_id) || !$st_id || $st_id == '')
{
	$st_id = $my['id'];
}


$QKEY = "s_uid, st_id, pt_name, pt_id, type, dr_name, date_update, status";
$QVAL = "'$s_uid', '$st_id', '$pt_name', '$pt_id', '$follow_type', '$dr_name', '$date_update', '".$d['khusd_st_pros']['FOLLOW_STATUS']['FOLLOWING']."'";
getDbInsert($table[$m.'new_follow'],$QKEY,$QVAL);

getLink('reload', 'parent.', '등록 되었습니다.', '');

    
?>