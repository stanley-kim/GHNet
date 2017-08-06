<?php
if(!defined('__KIMS__')) exit;

/* score update 액션 처리 */

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_pedia/var/var.score.php';	// 필수 인클루드 파일
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
$follow_pt	= intval($follow_pt);
$follow		= intval($follow);
$charting 	= intval($charting);
$charting_obser	= intval($charting_obser);
$obser		= intval($obser);
$ga 		= intval($ga);
$sedation_rp	= intval($sedation_rp);
$clinical_rp	= intval($clinical_rp);
$blsm		= intval($blsm);
$st_pt		= intval($st_pt);
$st_point	= intval($st_point);
$st_assist	= intval($st_assist);
$fix			= intval($fix);
$prof_fix_am			= intval($prof_fix_am);
$prof_fix_pm			= intval($prof_fix_pm);


$follow_str = $follow_ch."|".$follow_1."|".$follow_2."|".$follow_3."|".$follow_4."|".$follow_5."|";
$follow_str .= $follow_6."|".$follow_7."|".$follow_8."|".$follow_9."|".$follow_10;


$follow = 0;
$follow_arr = explode("|",$follow_str);
$i = 0;
foreach($follow_arr as $aFollow){
	if(intval($aFollow) > 0){
		$follow +=  intval($aFollow) * $d['khusd_st_pedia']['follow_score'][$i];
	}
	$i++;
}
$follow += $prof_fix_am *  $d['khusd_st_pedia']['score']['prof_fix_am'];
$follow += $prof_fix_pm *  $d['khusd_st_pedia']['score']['prof_fix_pm'];

$is_goal 	= isset($is_goal) ? 'y' : 'n';

$date_update = $date['totime'];

if($is_goal == 'n')
{
	// 입력한 데이터로 query 생성
	$QKEY = "s_uid, st_id, follow_pt, follow, charting, charting_obser, obser, ga, sedation_rp, clinical_rp, blsm, st_pt, st_point, st_add_a, st_add_b, st_add_c, st_assist, fix, prof_fix_am, prof_fix_pm, is_goal, date_update, follow_str";
	$QVAL = "'$s_uid', '$st_id', '$follow_pt', '$follow', '$charting', '$charting_obser', '$obser', '$ga', '$sedation_rp', '$clinical_rp', '$blsm', '$st_pt', '$st_point', '$st_add_a', '$st_add_b', '$st_add_c', '$st_assist', '$fix', '$prof_fix_am', '$prof_fix_pm', '$is_goal', '$date_update', '$follow_str'";
		
	getDbInsert($table[$m.'score'],$QKEY,$QVAL);
}
elseif($is_goal == 'y')
{
	$_WHERE = "st_id = '".$st_id."' AND is_goal = '".$is_goal."'";
	
	$row_num = getDbRows($table[$m.'score'], $_WHERE);
	
	if($row_num > 0)
	{
		$_SET = "s_uid = '$s_uid', st_id = '$st_id', follow_pt = '$follow_pt', follow = '$follow', charting = '$charting', charting_obser =  '$charting_obser', obser = '$obser', ga = '$ga', sedation_rp = '$sedation_rp', clinical_rp = '$clinical_rp',blsm = '$blsm', st_pt = '$st_pt', st_point = '$st_point', st_assist = '$st_assist', fix = '$fix', is_goal = '$is_goal', date_update = '$date_update'";
	
		getDbUpdate($table[$m.'score'],$_SET, $_WHERE);
	}
	else
	{
	$QKEY = "s_uid, st_id, follow_pt, follow, charting, charting_obser, obser, ga, sedation_rp, clinical_rp, blsm, st_pt, st_point, st_assist, fix, is_goal, date_update";
	$QVAL = "'$s_uid', '$st_id', '$follow_pt', '$follow', '$charting', '$charting_obser', '$obser', '$ga', '$sedation_rp', '$clinical_rp', '$blsm', '$st_pt', '$st_point', '$st_assist', '$fix', '$is_goal', '$date_update'";
		
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
