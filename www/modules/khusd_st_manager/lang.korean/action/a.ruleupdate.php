<?php
if(!defined('__KIMS__')) exit;

include_once $g['dir_module'].'var/var.php'; // 모듈변수파일 인클루드
include_once $g['dir_module'].'var/var.define.php'; // 각종 변수 정의 인클루드

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/member.php';
include_once $g['path_module'].'khusd_st_manager/function/push.php';
include_once $g['path_module'].'khusd_st_manager/function/debug.php';

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	getLink('', '', '권한이 없거나 로그인하지 않으셨습니다.', '');
}

//getLink('', '', '미 업데이트 구성원에게 업데이트 독촉 알림을 전달하였습니다.', '');



// 하단 코드는 main.php 에서 copy & paste

include_once $g['path_module'].'khusd_st_manager/function/date.php';

__debug_print("db_query_go for_rule_update.-start" );
$temp_selection = '';
$temp_standard = '';
$temp_num_apply = '';
$temp_on = '';
$temp_chiot_selection = '';
$temp_chiot_standard = '';
$temp_chiot_num_apply = '';
$temp_chiot_on = '';
$temp_oms_selection = '';
$temp_oms_standard = '';
$temp_oms_num_apply = '';
$temp_oms_on = '';
$temp_radio_selection = '';
$temp_radio_standard = '';
$temp_radio_num_apply = '';
$temp_radio_on = '';

$apply_last_order = 5;

for($i=0; $i< $apply_last_order  ; $i++) {
	if(  isset( $_POST[ 'input_perio_surgery_standard' ][$i]  ) &&  is_int(intval($_POST[ 'input_perio_surgery_standard' ][$i]))  )
	        $temp_standard = $temp_standard.strval( intval($_POST[ 'input_perio_surgery_standard' ][$i]) );
	else 
	        $temp_standard = $temp_standard.strval('0'); 
	if( isset( $_POST[ 'input_perio_surgery_num_apply' ][$i] ) && is_int(intval($_POST[ 'input_perio_surgery_num_apply' ][$i])) )
		$temp_num_apply = $temp_num_apply.strval( intval($_POST[ 'input_perio_surgery_num_apply' ][$i]) );
	else
		$temp_num_apply = $temp_num_apply.strval('0'); 
	$temp_selection = $temp_selection. $_POST['checkbox_perio_surgery_selection'][$i];	
	if(  isset($_POST['checkbox_perio_surgery_on'][$i] )  ) $temp_on = $temp_on. '1';
	else $temp_on = $temp_on . '0'; 
	//$temp_on = $temp_on. $_POST['checkbox_perio_surgery_on'][$i];	
//getLink('', '', '미 업데이트 구성원에게 업데이트 독촉 알림을 전달하였습니다.'.$temp. 'qwer' , '');
}
for($i=0; $i< $apply_last_order  ; $i++) {
	if(  isset( $_POST[ 'input_perio_chiot_standard' ][$i] ) &&  is_int(intval($_POST[ 'input_perio_chiot_standard' ][$i])) )
	        $temp_chiot_standard  = $temp_chiot_standard.strval(  intval( $_POST[ 'input_perio_chiot_standard' ][$i])   );
	else
	        $temp_chiot_standard  = $temp_chiot_standard.strval('0');
	if( isset( $_POST[ 'input_perio_chiot_num_apply' ][$i] ) && is_int(intval($_POST[ 'input_perio_chiot_num_apply' ][$i])) )
		$temp_chiot_num_apply = $temp_chiot_num_apply.strval(  intval($_POST[ 'input_perio_chiot_num_apply' ][$i])  );
	else
		$temp_chiot_num_apply = $temp_chiot_num_apply.strval('0'); 
	$temp_chiot_selection = $temp_chiot_selection. $_POST['checkbox_perio_chiot_selection'][$i];	
	if(  isset( $_POST['checkbox_perio_chiot_on'][$i] )  ) 
		$temp_chiot_on = $temp_chiot_on. '1';
	else 
		$temp_chiot_on = $temp_chiot_on. '0'; 
	//$temp_on = $temp_on. $_POST['checkbox_perio_surgery_on'][$i];	
//getLink('', '', '미 업데이트 구성원에게 업데이트 독촉 알림을 전달하였습니다.'.$temp. 'qwer' , '');
}

for($i=0; $i< $apply_last_order  ; $i++) {
	if(  isset( $_POST[ 'input_oms_standard' ][$i]  ) &&  is_int(intval($_POST[ 'input_oms_standard' ][$i]))  )
	        $temp_oms_standard = $temp_oms_standard.strval( intval($_POST[ 'input_oms_standard' ][$i]) );
	else 
	        $temp_oms_standard = $temp_oms_standard.strval('0'); 
	if( isset( $_POST[ 'input_oms_num_apply' ][$i] ) && is_int(intval($_POST[ 'input_oms_num_apply' ][$i])) )
		$temp_oms_num_apply = $temp_oms_num_apply.strval( intval($_POST[ 'input_oms_num_apply' ][$i]) );
	else
		$temp_oms_num_apply = $temp_oms_num_apply.strval('0'); 
	$temp_oms_selection = $temp_oms_selection. $_POST['checkbox_oms_selection'][$i];	
	if(  isset($_POST['checkbox_oms_on'][$i] )  ) $temp_oms_on = $temp_oms_on. '1';
	else $temp_oms_on = $temp_oms_on . '0'; 
	//$temp_on = $temp_on. $_POST['checkbox_perio_surgery_on'][$i];	
//getLink('', '', '미 업데이트 구성원에게 업데이트 독촉 알림을 전달하였습니다.'.$temp. 'qwer' , '');
}

for($i=0; $i< $apply_last_order  ; $i++) {
	if(  isset( $_POST[ 'input_radio_standard' ][$i]  ) &&  is_int(intval($_POST[ 'input_radio_standard' ][$i]))  )
	        $temp_radio_standard = $temp_radio_standard.strval( intval($_POST[ 'input_radio_standard' ][$i]) );
	else 
	        $temp_radio_standard = $temp_radio_standard.strval('0'); 
	if( isset( $_POST[ 'input_radio_num_apply' ][$i] ) && is_int(intval($_POST[ 'input_radio_num_apply' ][$i])) )
		$temp_radio_num_apply = $temp_radio_num_apply.strval( intval($_POST[ 'input_radio_num_apply' ][$i]) );
	else
		$temp_radio_num_apply = $temp_radio_num_apply.strval('0'); 
	$temp_radio_selection = $temp_radio_selection. $_POST['checkbox_radio_selection'][$i];	
	if(  isset($_POST['checkbox_radio_on'][$i] )  ) $temp_radio_on = $temp_radio_on. '1';
	else $temp_radio_on = $temp_radio_on . '0'; 
	//$temp_on = $temp_on. $_POST['checkbox_perio_surgery_on'][$i];	
//getLink('', '', '미 업데이트 구성원에게 업데이트 독촉 알림을 전달하였습니다.'.$temp. 'qwer' , '');
}
//for($i=0; $i< count( $_POST['checkbox_perio_surgery_selection'] )  ; $i++) {
//$temp_selection = $temp_selection. $_POST['checkbox_perio_surgery_selection'][$i];	
//getLink('', '', '미 업데이트9 구성원에게 업데이트 독촉 알림을 전달하였습니다.'.$temp. 'qwer' , '');

//}
        $_set =  "perio_surgery_on='".$temp_on."', perio_surgery_selection='".$temp_selection."', perio_surgery_standard='".$temp_standard."', perio_surgery_num_apply='".$temp_num_apply."'";
        $_set =  $_set.", perio_chiot_on='".$temp_chiot_on."', perio_chiot_selection='".$temp_chiot_selection."', perio_chiot_standard='".$temp_chiot_standard."', perio_chiot_num_apply='".$temp_chiot_num_apply."'";
        $_set =  $_set.", oms_on='".$temp_oms_on."', oms_selection='".$temp_oms_selection."', oms_standard='".$temp_oms_standard."', oms_num_apply='".$temp_oms_num_apply."'";
        $_set =  $_set.", radio_on='".$temp_radio_on."', radio_selection='".$temp_radio_selection."', radio_standard='".$temp_radio_standard."', radio_num_apply='".$temp_radio_num_apply."'";
        $_where = "uid='".'1'."'";


        getDbUpdate("rb_khusd_st_manager_verification_rule", $_set, $_where);

//getLink('', '', '미 업데이트 구성원에게 업데이트 독촉 알림을 전달하였습니다.'. mysql_error() . 'qwer' , '');
        getLink('reload', 'parent.', 'Rule이 업데이트 되었습니다.', '');


?>
