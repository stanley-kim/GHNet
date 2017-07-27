<?php
if(!defined('__KIMS__')) exit;

/* score update 액션 처리 */

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/member.php';
include_once $g['path_module'].'khusd_st_manager/function/debug.php';	// 필수 인클루드 파일
include_once $g['path_module'].$m.'/var/var.score.php';

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}

// 지금 로그인한 사용자인지 체크
if($st_id == NULL || !is_string($st_id) || $st_id != $my['id']) {
	getLink('', '', '사용자 학번이 누락되었거나, 로그인한 사용자 학번과 일치하지 않습니다.', '');
}

// TODO s_uid 를 form 에서 받는것과 이렇게 하는것중 뭐가 날까
// 현재 진행중인 학기 선택
$SEMESTER_INFO = getCurrentSemesterInfo();

// 입력값 유효성 체크
$s_uid 		= $SEMESTER_INFO['uid'];

// 입력값 유효성 체크
$second_cr_ongoing			= intval($second_cr_ongoing);
$post_core_ongoing 			= intval($post_core_ongoing);
$imp_cr_br_ongoing 			= intval($imp_cr_br_ongoing);
$single_cr_ongoing	 		= intval($single_cr_ongoing);
$br_ongoing 				= intval($br_ongoing);
$partial_denture_ongoing 	= intval($partial_denture_ongoing);
$complete_denture_ongoing 	= intval($complete_denture_ongoing);
$others_ongoing 			= intval($others_ongoing);

$second_cr_complete			= intval($second_cr_complete);
$post_core_complete 		= intval($post_core_complete);
$imp_cr_br_complete 		= intval($imp_cr_br_complete);
$single_cr_complete	 		= intval($single_cr_complete);
$br_complete 				= intval($br_complete);
$partial_denture_complete 	= intval($partial_denture_complete);
$complete_denture_complete 	= intval($complete_denture_complete);
$others_complete 			= intval($others_complete);

$second_cr_cancel			= intval($second_cr_cancel);
$post_core_cancel 			= intval($post_core_cancel);
$imp_cr_br_cancel 			= intval($imp_cr_br_cancel);
$single_cr_cancel	 		= intval($single_cr_cancel);
$br_cancel 					= intval($br_cancel);
$partial_denture_cancel 	= intval($partial_denture_cancel);
$complete_denture_cancel 	= intval($complete_denture_cancel);
$others_cancel 				= intval($others_cancel);

$second_cr_prev			= intval($second_cr_prev);
$post_core_prev 			= intval($post_core_prev);
$imp_cr_br_prev 			= intval($imp_cr_br_prev);
$single_cr_prev	 		= intval($single_cr_prev);
$br_prev 					= intval($br_prev);
$partial_denture_prev 	= intval($partial_denture_prev);
$complete_denture_prev 	= intval($complete_denture_prev);
$others_prev 				= intval($others_prev);

$simeple_obser_3_7 = intval($simple_obser_3_7);
$simeple_obser_3_8 = intval($simple_obser_3_8);
$simeple_obser_3_9 = intval($simple_obser_3_9);
$simeple_obser_3_10 = intval($simple_obser_3_10);
$simeple_obser_3_11 = intval($simple_obser_3_11);
$simeple_obser_3_12 = intval($simple_obser_3_12);

$st_case_1					= trim($st_case_1);
$st_case_1_pt_name			= trim($st_case_1_pt_name);
$st_case_1_last_tx_date		= ($st_case_1_last_tx_date ? date("Ymd", strtotime($st_case_1_last_tx_date)) : '');
$st_case_1_last_tx			= trim($st_case_1_last_tx);
$st_case_1_last_inst		= trim($st_case_1_last_inst);
$st_case_1_friendly			= isset($GLOBALS['st_case_1_friendly']) ? 'y' : 'n';

$st_case_2					= trim($st_case_2);
$st_case_2_pt_name			= trim($st_case_2_pt_name);
$st_case_2_last_tx_date		= ($st_case_2_last_tx_date ? date("Ymd", strtotime($st_case_2_last_tx_date)) : '');
$st_case_2_last_tx			= trim($st_case_2_last_tx);
$st_case_2_last_inst		= trim($st_case_2_last_inst);
$st_case_2_friendly			= isset($GLOBALS['st_case_2_friendly']) ? 'y' : 'n';

$st_case_3					= trim($st_case_3);
$st_case_3_pt_name			= trim($st_case_3_pt_name);
$st_case_3_last_tx_date		= ($st_case_3_last_tx_date ? date("Ymd", strtotime($st_case_3_last_tx_date)) : '');
$st_case_3_last_tx			= trim($st_case_3_last_tx);
$st_case_3_last_inst		= trim($st_case_3_last_inst);
$st_case_3_friendly			= isset($GLOBALS['st_case_3_friendly']) ? 'y' : 'n';

$st_score = $d['khusd_st_pros']['st_stage_score'][$st_case_1]
	+ $d['khusd_st_pros']['st_stage_score'][$st_case_2]
	+ $d['khusd_st_pros']['st_stage_score'][$st_case_3];
	
__debug_print("ST SCORE: ".$st_score."//st_case_1: ".$st_case_1." st_case_2: ".$st_case_2." st_case_3: ".$st_case_3);
	
$date_update = $date['totime'];

// 입력한 데이터로 query 생성
$QKEY = "s_uid, st_id, "
	."second_cr_ongoing, post_core_ongoing, imp_cr_br_ongoing, single_cr_ongoing,"
	."br_ongoing, partial_denture_ongoing, complete_denture_ongoing, others_ongoing,"
	
	."second_cr_complete, post_core_complete, imp_cr_br_complete, single_cr_complete,"
	."br_complete, partial_denture_complete, complete_denture_complete, others_complete,"
	
	."second_cr_cancel, post_core_cancel, imp_cr_br_cancel, single_cr_cancel,"
	."br_cancel, partial_denture_cancel, complete_denture_cancel, others_cancel,"
	
	."second_cr_prev, post_core_prev, imp_cr_br_prev, single_cr_prev,"
	."br_prev, partial_denture_prev, complete_denture_prev, others_prev,"
	."simple_obser_3_7, simple_obser_3_8, simple_obser_3_9,"
	."simple_obser_3_10, simple_obser_3_11, simple_obser_3_12,"

	."st_case_1, st_case_1_pt_name, st_case_1_last_tx_date, st_case_1_last_tx, st_case_1_last_inst, st_case_1_friendly,"
	."st_case_2, st_case_3_pt_name, st_case_2_last_tx_date, st_case_2_last_tx, st_case_2_last_inst, st_case_2_friendly,"
	."st_case_3, st_case_2_pt_name, st_case_3_last_tx_date, st_case_3_last_tx, st_case_3_last_inst, st_case_3_friendly,"
	."st_score,"
	
	."date_update";
$QVAL = "'$s_uid', '$st_id', "
	."'$second_cr_ongoing', '$post_core_ongoing', '$imp_cr_br_ongoing', '$single_cr_ongoing',"
	."'$br_ongoing', '$partial_denture_ongoing', '$complete_denture_ongoing', '$others_ongoing',"
	
	."'$second_cr_complete', '$post_core_complete', '$imp_cr_br_complete', '$single_cr_complete',"
	."'$br_complete', '$partial_denture_complete', '$complete_denture_complete', '$others_complete',"
	
	."'$second_cr_cancel', '$post_core_cancel', '$imp_cr_br_cancel', '$single_cr_cancel',"
	."'$br_cancel', '$partial_denture_cancel', '$complete_denture_cancel', '$others_cancel',"
	
	."'$second_cr_prev', '$post_core_prev', '$imp_cr_br_prev', '$single_cr_prev',"
	."'$br_prev', '$partial_denture_prev', '$complete_denture_prev', '$others_prev',"
	."'$simple_obser_3_7', '$simple_obser_3_8', '$simple_obser_3_9',"
	."'$simple_obser_3_10', '$simple_obser_3_11', '$simple_obser_3_12',"

	."'$st_case_1', '$st_case_1_pt_name', '$st_case_1_last_tx_date', '$st_case_1_last_tx', '$st_case_1_last_inst', '$st_case_1_friendly',"
	."'$st_case_2', '$st_case_3_pt_name', '$st_case_2_last_tx_date', '$st_case_2_last_tx', '$st_case_2_last_inst', '$st_case_2_friendly',"
	."'$st_case_3', '$st_case_2_pt_name', '$st_case_3_last_tx_date', '$st_case_3_last_tx', '$st_case_3_last_inst', '$st_case_3_friendly',"
	."'$st_score',"

	."'$date_update'";
	
getDbInsert($table[$m.'score'],$QKEY,$QVAL);
 

if(isset($n_page) && $n_page == 'home')
{
	getLink('/', 'parent.', '업데이트 되었습니다.', '');
}
else
{
	getLink('reload', 'parent.', '업데이트 되었습니다.', '');
}
?>
