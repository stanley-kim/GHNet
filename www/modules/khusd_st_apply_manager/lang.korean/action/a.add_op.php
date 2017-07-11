<?php
if(!defined('__KIMS__')) exit;

include_once $g['dir_module'].'var/var.php';
include_once $g['dir_module'].'var/var.define.php';

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	getLink('', '', '권한이 없거나 로그인하지 않으셨습니다.', '');
}

// todo 수술 추가 권한이 있는지 체크
if(false) {
	getLink('', '', '수술 추가 권한이 없습니다.', '');
}


// 입력값 유효성 체크
$date_update = $date['totime'];

// 시각은 hh:mm 형식으로 꼭 5자리 되도록
if(strlen($op_time) == 4) $op_time = '0'.$op_time;

$_QKEY = 'op_date, op_time, pt_name, op_dr, op_name, op_remark, date_reg';
$_QVAL = "'$op_date', '$op_time', '$pt_name', '$op_dr', '$op_name', '$op_remark', '$date_update'";

getDbInsert($table[$m.'op_list'],$_QKEY, $_QVAL);

getLink('reload', 'parent.', '', '');
?>