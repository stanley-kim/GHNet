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

// todo 추가 권한이 있는지 체크
if(false) {
	getLink('', '', '추가 권한이 없습니다.', '');
}

// 입력값 유효성 체크
$apply_info_uid = intval($uid);
$content = trim($content);
$ref_uid = intval($ref_uid);
$accept_limit = intval($accept_limit) > 0 ? intval($accept_limit) : 0;
$s_date = trim($s_date);
$s_time = trim($s_time);
$pt_id = trim($pt_id);
$pt_name = trim($pt_name);
$doctor = trim($doctor);
$assist = trim($assist);
$is_imp_cent = $is_imp_cent == '1' ? 1 : 0;

$date_reg = $date['totime'];

$date_item = ($s_date && strlen($s_date) == 8 && $s_time && strlen($s_time) == 4) ? $s_date.$s_time.'00' : '';

// 치주수술 항목 입력을 편하게 하기 위해...
// 마지막으로 입력된 수술날짜를 세션으로 저장
// 귀찮으니 세션 초기화는 없는걸로........( '')a
$_SESSION['last_apply_item_s_date'] = $s_date;

$_QKEY = 'apply_info_uid, content, ref_uid, accept_limit, date_reg, date_item, pt_id, pt_name, doctor, assist, is_imp_cent';
$_QVAL = "'$apply_info_uid', '$content', '$ref_uid', '$accept_limit', '$date_reg', '$date_item', '$pt_id', '$pt_name', '$doctor', '$assist', '$is_imp_cent'";

getDbInsert($table[$m.'apply_item'],$_QKEY, $_QVAL);

// item 수 구하기
$num_item = getDbRows($table[$m.'apply_item'],"apply_info_uid = '".$apply_info_uid."'");
// apply_info_list 의 num_item 업데이트
getDbUpdate($table[$m.'apply_info_list'], "num_item='".$num_item."'", "uid = '".$apply_info_uid."'");

getLink('reload', 'parent.', '', '');
?>