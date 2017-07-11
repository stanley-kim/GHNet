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
$comment = trim($comment);
$comment = mysql_real_escape_string($comment);
//$status

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


$QKEY = "s_uid, st_id, pt_name, pt_id, status, comment, date_update, type";
$QVAL = "'$s_uid', '$st_id', '$pt_name', '$pt_id', '$status', '$comment', '$date_update', '$follow_type'";
getDbInsert($table[$m.'follow_comment'],$QKEY,$QVAL);

getLink('reload', 'parent.', '업데이트 되었습니다.', '');

    
?>