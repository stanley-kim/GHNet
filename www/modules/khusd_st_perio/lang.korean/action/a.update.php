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
$iot			= intval($iot);
$charting		= intval($charting);
$perio_surgery	= intval($perio_surgery);
$imp_1st		= intval($imp_1st);
$imp_2nd		= intval($imp_2nd);
$scaling		= intval($scaling);
$others			= intval($others);
$tbi			= intval($tbi);

$perio_surgery2	= intval($perio_surgery2);
$imp_1st2		= intval($imp_1st2);
$imp_2nd2		= intval($imp_2nd2);
$scaling2		= intval($scaling2);

$perio_report	= intval($perio_report);
$imp1_report	= intval($imp1_report);
$imp2_report	= intval($imp2_report);

$abandon		= intval($abandon);

$st_sc			= intval($st_sc);
$st_pc			= intval($st_pc);
$st_cu			= intval($st_cu);
$st_cu_selected		= intval($st_cu_selected);
$st_cu_todo			= intval($st_cu_todo);
$fix			= intval($fix);	// fix 점수 공개되었을 때에는 그 점수로 업데이트 해주도록... update 페이지에서는 hidden form 으로 최신의 값을 유지하도록 하자...
$cp			= intval($cp); // cp 점수 공개되었을 때에는 그 점수로 업데이트 해주도록...
$animal_exp	= intval($animal_exp);

$follow_point		= intval($follow_point);

$is_goal 	= isset($is_goal) ? 'y' : 'n';

$date_update = $date['totime'];

// 기존 데이터 가져오기
$SCORE = getDbData($table[$m.'score'],"st_id='".$my['id']."'",'*');

if($is_goal == 'n')
{
	// 입력한 데이터로 query 생성
	$QKEY = "s_uid, st_id, follow_point, iot, charting, surgery, surgery2, imp_1st, imp_1st2, imp_2nd, imp_2nd2, abandon, sc, sc2, others, tbi, stsc, stpc, stcu, stcu_selected, stcu_todo, is_goal, fix, cp, date_update, perio_report, imp1_report, imp2_report, animal_exp";
	$QVAL = "'$s_uid', '$st_id', '$follow_point', '$iot', '$charting', '$perio_surgery', '$perio_surgery2', '$imp_1st', '$imp_1st2', '$imp_2nd', '$imp_2nd2', '$abandon', '$scaling', '$scaling2', '$others', '$tbi', '$st_sc', '$st_pc', '$st_cu', '$stcu_selected', '$stcu_todo', '$is_goal', '$fix', '$cp', '$date_update', '$perio_report','$imp1_report','$imp2_report', '$animal_exp'";
		
	getDbInsert($table[$m.'score'],$QKEY,$QVAL);
}
elseif($is_goal == 'y')
{
	$_WHERE = "st_id = '".$st_id."' AND is_goal = '".$is_goal."'";
	
	$row_num = getDbRows($table[$m.'score'], $_WHERE);
	
	if($row_num > 0)
	{
		$_SET = "s_uid= '$s_uid', st_id = '$st_id', follow_point = '$follow_point', animal_exp = '$animal_exp', iot = '$iot', charting = '$charting', surgery = '$perio_surgery', imp_1st = '$imp_1st', imp_2nd = '$imp_2nd', sc = '$scaling', others = '$others', tbi = '$tbi', surgery2 = '$perio_surgery2', imp_1st2 = '$imp_1st2', imp_2nd2 = '$imp_2nd2', abandon = '$abandon', sc2 = '$scaling2', stsc = '$st_sc', stpc = '$st_pc', stcu = '$st_cu', stcu_selected = '$stcu_selected', stcu_todo = '$stcu_todo', is_goal = '$is_goal', fix = '$fix', cp = '$cp', date_update = '$date_update'";
	
		getDbUpdate($table[$m.'score'],$_SET, $_WHERE);
	}
	else
	{
		$QKEY = "s_uid, st_id, follow_point, iot, charting, surgery, imp_1st, imp_2nd, sc, others, tbi, surgery2, imp_1st2, imp_2nd2, abandon, sc2, stsc, stpc, stcu, stcu_selected, stcu_todo, is_goal, fix, cp, date_update, perio_report, imp1_report, imp2_report, animal_exp";
		$QVAL = "'$s_uid', '$st_id', '$follow_point', '$iot', '$charting', '$perio_surgery', '$imp_1st', '$imp_2nd', '$scaling', '$others', '$tbi', '$perio_surgery2', '$imp_1st2', '$imp_2nd2', '$abandon', '$scaling2', '$st_sc', '$st_pc', '$st_cu', '$stcu_selected', '$stcu_todo', '$is_goal', '$fix', '$cp', '$date_update', '$perio_report','$imp1_report','$imp2_report','$animal_exp'";
			
		getDbInsert($table[$m.'score'],$QKEY,$QVAL);
	}
}

if(isset($n_page) && $n_page == 'home')
{
	getLink('/', 'parent.', '업데이트 되었습니다.', '');
}
else
{
	getLink('reload', 'parent.', '업데이트 되었습니다.', '');
}
?>