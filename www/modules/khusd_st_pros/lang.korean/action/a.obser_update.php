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
$f_type = trim($type);
$stage = trim($stage);

$date_update = $date['totime'];

if(!isset($st_id) || !$st_id || $st_id == '')
{
	$st_id = $my['id'];
}


$QKEY = "s_uid, st_id, stage_".$f_type.", date_update";
$QVAL = "'$s_uid', '$st_id', '$stage', '$date_update'";
$_set = "stage_".$f_type." = '$stage', date_update = '$date_update'";
$_where = "s_uid = '$s_uid' and st_id = '$st_id'";
$_data = '*';

$MY_ARRAY = getDbData($table[$m.'obser_score'], $_where, "*");
if($MY_ARRAY && count($MY_ARRAY) > 0){
	getDbUpdate($table[$m.'obser_score'], $_set, $_where);
}else{
	getDbInsert($table[$m.'obser_score'],$QKEY,$QVAL);
}


//


getLink('reload', 'parent.','수정되었습니다.', -1);

    
?>