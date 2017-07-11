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

// 지금 로그인한 사용자인지 체크
if($st_id == NULL || !is_string($st_id) || $st_id != $my['id']) {
	getLink('', '', '사용자 학번이 누락되었거나, 로그인한 사용자 학번과 일치하지 않습니다.', '');
}


// 입력값 유효성 체크
$surgery 	= trim($surgery);
$type	= trim($type);
$date_reg = $date['totime'];

if(!$surgery || strlen($surgery) <= 0)
{
	getLink('', '', ' 올바른 수술이 아닙니다.', '');
}
if(!$type || strlen($type) <= 0)
{
	getLink('', '', '변경 타입이 올바르지 않습니다..', '');
}


$item_info = getDbData('rb_khusd_st_apply_manager_apply_item', "uid='".$surgery."'", '*');

                
$surgery_key = $item_info['date_item']."/".$item_info['doctor'];
// 입력한 데이터로 query 생성
$QKEY = "st_id, surgery_key, type, date_reg";
$QVAL = "'$st_id', '$surgery_key', '$type', '$date_reg'";

getDbInsert('rb_khusd_st_perio_surgery_history',$QKEY,$QVAL);

getLink('reload', 'parent.', '신청 되었습니다.', '');
?>