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

// 입력값 유효성 체크
$charting_obser	= intval($charting_obser);
$charting		= intval($charting);
$soft_charting		= intval($soft_charting);
$obser			= intval($obser);
$splint_obser	= intval($splint_obser);
$physical_tx	= intval($physical_tx);
$odor			= intval($odor);
$saliva_test		= intval($saliva_test);
$m_text			= intval($m_text);
$fix_am			= intval($fix_am);
$fix_pm			= intval($fix_pm);
$portfolio1			= intval($portfolio1);
$portfolio2			= intval($portfolio2);
$portfolio3			= intval($portfolio3);
$portfolio4			= intval($portfolio4);
$splint_impression			= intval($splint_impression);
$splint_polishing			= intval($splint_polishing);
$physical_tx_fix			= intval($physical_tx_fix);

$date_update = $date['totime'];

$infra_tx			= intval($infra_tx);
$ultra_tx			= intval($ultra_tx);
$east_tx			= intval($east_tx);
$tens_tx			= intval($tens_tx);
$ionto_tx			= intval($ionto_tx);
$tmd_tx			= intval($tmd_tx);
$soft_tx			= intval($soft_tx);

$charting_tmd_1cycle_charting = intval($charting_tmd_1cycle_charting);
$charting_tmd_1cycle_check    = intval($charting_tmd_1cycle_check);
$charting_tmd_1cycle_follow1st= intval($charting_tmd_1cycle_follow1st);
$charting_tmd_1cycle_follow2nd= intval($charting_tmd_1cycle_follow2nd);

$charting_tmd_2cycle_charting = intval($charting_tmd_2cycle_charting);
$charting_tmd_2cycle_check    = intval($charting_tmd_2cycle_check);
$charting_tmd_2cycle_follow1st= intval($charting_tmd_2cycle_follow1st);
$charting_tmd_2cycle_follow2nd= intval($charting_tmd_2cycle_follow2nd);

$charting_tmd_3cycle_charting = intval($charting_tmd_3cycle_charting);
$charting_tmd_3cycle_check    = intval($charting_tmd_3cycle_check);
$charting_tmd_3cycle_follow1st= intval($charting_tmd_3cycle_follow1st);
$charting_tmd_3cycle_follow2nd= intval($charting_tmd_3cycle_follow2nd);

$charting_tmd_4cycle_charting = intval($charting_tmd_4cycle_charting);
$charting_tmd_4cycle_check    = intval($charting_tmd_4cycle_check);
$charting_tmd_4cycle_follow1st= intval($charting_tmd_4cycle_follow1st);
$charting_tmd_4cycle_follow2nd= intval($charting_tmd_4cycle_follow2nd);

$charting_soft_charting       = intval($charting_soft_charting);
$charting_soft_check          = intval($charting_soft_check);
$charting_soft_follow1st      = intval($charting_soft_follow1st);
$charting_soft_follow2nd      = intval($charting_soft_follow2nd);


// 입력한 데이터로 query 생성
$QKEY = "s_uid, st_id, charting_obser, charting, soft_charting, obser, splint_obser, physical_tx, odor, m_text, fix_am, fix_pm, portfolio1, portfolio2, portfolio3, portfolio4, splint_impression, splint_polishing, splint_adjust, physical_tx_fix, infra_tx, ultra_tx, east_tx, tens_tx, ionto_tx, tmd_tx, soft_tx, saliva_test, charting_tmd_1cycle_charting, charting_tmd_1cycle_check, charting_tmd_1cycle_follow1st, charting_tmd_1cycle_follow2nd,  charting_tmd_2cycle_charting, charting_tmd_2cycle_check, charting_tmd_2cycle_follow1st, charting_tmd_2cycle_follow2nd,  charting_tmd_3cycle_charting, charting_tmd_3cycle_check, charting_tmd_3cycle_follow1st, charting_tmd_3cycle_follow2nd,  charting_tmd_4cycle_charting, charting_tmd_4cycle_check, charting_tmd_4cycle_follow1st, charting_tmd_4cycle_follow2nd, charting_soft_charting, charting_soft_check, charting_soft_follow1st, charting_soft_follow2nd, date_update";
$QVAL = "'$s_uid', '$st_id', '$charting_obser', '$charting', '$soft_charting', '$obser', '$splint_obser', '$physical_tx', '$odor', '$m_text', '$fix_am', '$fix_pm', '$portfolio1', '$portfolio2', '$portfolio3','$portfolio4', '$splint_impression', '$splint_polishing', '$splint_adjust', '$physical_tx_fix', '$infra_tx', '$ultra_tx', '$east_tx', '$tens_tx', '$ionto_tx', '$tmd_tx', '$soft_tx', '$saliva_test', '$charting_tmd_1cycle_charting', '$charting_tmd_1cycle_check', '$charting_tmd_1cycle_follow1st', '$charting_tmd_1cycle_follow2nd',  '$charting_tmd_2cycle_charting', '$charting_tmd_2cycle_check', '$charting_tmd_2cycle_follow1st', '$charting_tmd_2cycle_follow2nd',  '$charting_tmd_3cycle_charting', '$charting_tmd_3cycle_check', '$charting_tmd_3cycle_follow1st', '$charting_tmd_3cycle_follow2nd', '$charting_tmd_4cycle_charting', '$charting_tmd_4cycle_check', '$charting_tmd_4cycle_follow1st', '$charting_tmd_4cycle_follow2nd',  '$charting_soft_charting', '$charting_soft_check', '$charting_soft_follow1st', '$charting_soft_follow2nd', '$date_update'";
	
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
