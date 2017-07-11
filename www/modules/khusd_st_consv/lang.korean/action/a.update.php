<?php
if(!defined('__KIMS__')) exit;

/* score update 액션 처리 */

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/member.php';

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

$pre_st_ant			= intval($pre_st_ant);
$pre_st_post		= intval($pre_st_post);
$pre_st_cervical	= intval($pre_st_cervical);
$pre_st_am			= intval($pre_st_am);

$indirect_prep_imp 	= intval($indirect_prep_imp);
$indirect_setting 	= intval($indirect_setting);

$am					= intval($am);

$tooth_colored_simple	= intval($tooth_colored_simple);
$tooth_colored_complex	= intval($tooth_colored_complex);
$tooth_colored_diastema	= intval($tooth_colored_diastema);

$post		= intval($post);
$core 		= intval($core);

$others		= intval($others);

$surgery	= intval($surgery);
$miscellaneous	= intval($miscellaneous);

$f_indirect_prep_imp 	= intval($f_indirect_prep_imp);
$f_indirect_setting 	= intval($f_indirect_setting);

$f_am					= intval($f_am);

$f_tooth_colored_simple	= intval($f_tooth_colored_simple);
$f_tooth_colored_complex	= intval($f_tooth_colored_complex);
$f_tooth_colored_diastema	= intval($f_tooth_colored_diastema);

$f_post		= intval($f_post);
$f_core 		= intval($f_core);

$f_others		= intval($f_others);

$f_surgery	= intval($f_surgery);
$f_miscellaneous	= intval($f_miscellaneous);

$pre_st_ant_pe	= isset($pre_st_ant_pe) ? 1 : 0;
$pre_st_ant_ce	= isset($pre_st_ant_ce) ? 1 : 0;
$pre_st_ant_cf	= isset($pre_st_ant_cf) ? 1 : 0;

$pre_st_pre_pe 	= isset($pre_st_pre_pe) ? 1 : 0;
$pre_st_pre_ce 	= isset($pre_st_pre_ce) ? 1 : 0;
$pre_st_pre_cf 	= isset($pre_st_pre_cf) ? 1 : 0;

$pre_st_ant_re_rm 	= isset($pre_st_ant_re_rm) ? 1 : 0;
$pre_st_ant_re_ce 	= isset($pre_st_ant_re_ce) ? 1 : 0;
$pre_st_ant_re_cf 	= isset($pre_st_ant_re_cf) ? 1 : 0;

$pre_st_pre_re_rm 	= isset($pre_st_pre_re_rm) ? 1 : 0;
$pre_st_pre_re_ce 	= isset($pre_st_pre_re_ce) ? 1 : 0;
$pre_st_pre_re_cf 	= isset($pre_st_pre_re_cf) ? 1 : 0;

$pre_st_inlay_gold_prep 	= isset($pre_st_inlay_gold_prep) ? 1 : 0;
$pre_st_inlay_gold_setting 	= isset($pre_st_inlay_gold_setting) ? 1 : 0;
$pre_st_inlay_resin_prep 	= isset($pre_st_inlay_resin_prep) ? 1 : 0;
$pre_st_inlay_resin_setting = isset($pre_st_inlay_resin_setting) ? 1 : 0;

$endo_molar_pe	= intval($endo_molar_pe);
$endo_molar_ce	= intval($endo_molar_ce);
$endo_molar_cf	= intval($endo_molar_cf);
$endo_molar_etc	= intval($endo_molar_etc);

$endo_pre_pe	= intval($endo_pre_pe);
$endo_pre_ce	= intval($endo_pre_ce);
$endo_pre_cf	= intval($endo_pre_cf);
$endo_pre_etc	= intval($endo_pre_etc);

$endo_ant_pe	= intval($endo_ant_pe);
$endo_ant_ce	= intval($endo_ant_ce);
$endo_ant_cf	= intval($endo_ant_cf);
$endo_ant_etc	= intval($endo_ant_etc);

$f_endo_molar_pe	= intval($f_endo_molar_pe);
$f_endo_molar_ce	= intval($f_endo_molar_ce);
$f_endo_molar_cf	= intval($f_endo_molar_cf);
$f_endo_molar_etc	= intval($f_endo_molar_etc);

$f_endo_pre_pe	= intval($f_endo_pre_pe);
$f_endo_pre_ce	= intval($f_endo_pre_ce);
$f_endo_pre_cf	= intval($f_endo_pre_cf);
$f_endo_pre_etc	= intval($f_endo_pre_etc);

$f_endo_ant_pe	= intval($f_endo_ant_pe);
$f_endo_ant_ce	= intval($f_endo_ant_ce);
$f_endo_ant_cf	= intval($f_endo_ant_cf);
$f_endo_ant_etc	= intval($f_endo_ant_etc);

$fol_cp	= intval($fol_cp);
$fol_ei	= intval($fol_ei);

$f_charing	= intval($f_charing);
$f_diastema	= intval($f_diastema);
$charing	= intval($charing);
$diastema	= intval($diastema);


$st_op_tooth_colored_cervical	= intval($st_op_tooth_colored_cervical);
$st_op_tooth_colored_simple		= intval($st_op_tooth_colored_simple);
$st_op_tooth_colored_complex	= intval($st_op_tooth_colored_complex);
$st_op_tooth_colored_diastema	= intval($st_op_tooth_colored_diastema);

$st_op_am_simple	= intval($st_op_am_simple);
$st_op_am_complex	= intval($st_op_am_complex);

$st_op_bleaching	= intval($st_op_bleaching);
$st_op_others		= intval($st_op_others);

$st_endo_1st_point		= intval($st_endo_1st_point);
$st_endo_2nd_point		= intval($st_endo_2nd_point);

$st_endo_1 = trim($st_endo_1);
$st_endo_2 = trim($st_endo_2);

$st_inlay_1_case = trim($st_inlay_1_case);
$st_inlay_2_case = trim($st_inlay_2_case);

$st_inlay_1_proc = trim($st_inlay_1_proc);
$st_inlay_2_proc = trim($st_inlay_2_proc);

$st_op_chair_assigned	= intval($st_op_chair_assigned);

$date_update = $date['totime'];

// 입력한 데이터로 query 생성
$QKEY = "st_id, s_uid, pre_st_ant, pre_st_post, pre_st_cervical, pre_st_am, 
			indirect_prep_imp, indirect_setting, 
			am, 
			tooth_colored_simple, tooth_colored_complex, tooth_colored_diastema, 
			post, core, 
			others, 
			surgery, miscellaneous, 
			pre_st_ant_pe, pre_st_ant_ce, pre_st_ant_cf, 
			pre_st_pre_pe, pre_st_pre_ce, pre_st_pre_cf, 
			pre_st_ant_re_rm, pre_st_ant_re_ce, pre_st_ant_re_cf, 
			pre_st_pre_re_rm, pre_st_pre_re_ce, pre_st_pre_re_cf, 
			
			pre_st_inlay_gold_prep, pre_st_inlay_gold_setting, 
			pre_st_inlay_resin_prep, pre_st_inlay_resin_setting, 
			
			endo_molar_pe, endo_molar_ce, endo_molar_cf, endo_molar_etc, 
			endo_pre_pe, endo_pre_ce, endo_pre_cf, endo_pre_etc, 
			endo_ant_pe, endo_ant_ce, endo_ant_cf, endo_ant_etc,
			fol_cp, fol_ei,
			st_op_tooth_colored_cervical, st_op_tooth_colored_simple, 
			st_op_tooth_colored_complex, st_op_tooth_colored_diastema, 
			st_op_am_simple, st_op_am_complex, st_op_bleaching, st_op_others, 
			st_endo_1st_point, st_endo_2nd_point,
			st_endo_1, st_endo_2,
			st_inlay_1_case, st_inlay_2_case, 
			st_inlay_1_proc, st_inlay_2_proc,
			st_op_chair_assigned,

			f_indirect_prep_imp, f_indirect_setting, 
			f_am, 
			f_tooth_colored_simple, f_tooth_colored_complex, f_tooth_colored_diastema, 
			f_post, f_core, 
			f_others, 
			f_surgery, f_miscellaneous,
			f_endo_molar_pe, f_endo_molar_ce, f_endo_molar_cf, f_endo_molar_etc, 
			f_endo_pre_pe, f_endo_pre_ce, f_endo_pre_cf, f_endo_pre_etc, 
			f_endo_ant_pe, f_endo_ant_ce, f_endo_ant_cf, f_endo_ant_etc,
			
			charting, diastema,
			f_charting, f_diastema,
			date_update";
			
$QVAL = "'$st_id', '$s_uid', '$pre_st_ant', '$pre_st_post', '$pre_st_cervical', '$pre_st_am',"
		."'$indirect_prep_imp', '$indirect_setting',"
		."'$am',"
		."'$tooth_colored_simple', '$tooth_colored_complex', '$tooth_colored_diastema',"
		."'$post', '$core', '$others',"
		."'$surgery', '$miscellaneous',"
		."'$pre_st_ant_pe', '$pre_st_ant_ce', '$pre_st_ant_cf',"
		."'$pre_st_pre_pe', '$pre_st_pre_ce', '$pre_st_pre_cf',"
		."'$pre_st_ant_re_rm', '$pre_st_ant_re_ce', '$pre_st_ant_re_cf',"
		."'$pre_st_pre_re_rm', '$pre_st_pre_re_ce', '$pre_st_pre_re_cf',"

		."'$pre_st_inlay_gold_prep', '$pre_st_inlay_gold_setting', "
		."'$pre_st_inlay_resin_prep', '$pre_st_inlay_resin_setting', "

		."'$endo_molar_pe', '$endo_molar_ce', '$endo_molar_cf', '$endo_molar_etc',"
		."'$endo_pre_pe', '$endo_pre_ce', '$endo_pre_cf', '$endo_pre_etc'," 
		."'$endo_ant_pe', '$endo_ant_ce', '$endo_ant_cf', '$endo_ant_etc',"
		."'$fol_cp', '$fol_ei',"
		."'$st_op_tooth_colored_cervical', '$st_op_tooth_colored_simple',"
		."'$st_op_tooth_colored_complex', '$st_op_tooth_colored_diastema',"
		."'$st_op_am_simple', '$st_op_am_complex',"
		."'$st_op_bleaching', '$st_op_others',"
		."'$st_endo_1st_point', '$st_endo_2nd_point',"
		."'$st_endo_1', '$st_endo_2',"
		."'$st_inlay_1_case', '$st_inlay_2_case'," 
		."'$st_inlay_1_proc', '$st_inlay_2_proc',"
		."'$st_op_chair_assigned',"
		."'$f_indirect_prep_imp', '$f_indirect_setting',"
		."'$f_am',"
		."'$f_tooth_colored_simple', '$f_tooth_colored_complex', '$f_tooth_colored_diastema',"
		."'$f_post', '$f_core', '$f_others',"
		."'$f_surgery', '$f_miscellaneous',"
		."'$f_endo_molar_pe', '$f_endo_molar_ce', '$f_endo_molar_cf', '$f_endo_molar_etc',"
		."'$f_endo_pre_pe', '$f_endo_pre_ce', '$f_endo_pre_cf', '$f_endo_pre_etc'," 
		."'$f_endo_ant_pe', '$f_endo_ant_ce', '$f_endo_ant_cf', '$f_endo_ant_etc',"
		."'$charting', '$diastema',"
		."'$f_charting', '$f_diastema',"
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