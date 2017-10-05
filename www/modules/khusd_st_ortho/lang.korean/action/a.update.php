<?php
if(!defined('__KIMS__')) exit;

/* score update 액션 처리 */

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/member.php';

include_once $g['path_module'].'khusd_st_ortho/var/var.score.php';	// 필수 인클루드 파일

include_once $g['path_module'].'khusd_st_manager/function/debug.php'; // for debug

include_once $g['path_module'].'khusd_st_ortho/function/calc.php';	// 팔로우, 옵져 점수 계산을 위한  인클루드 파일
//__debug_print("IN UPDATE ACTION");

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}

// 지금 로그인한 사용자인지 체크
if($st_id == NULL || !is_string($st_id) || $st_id != $my['id']) {
	getLink('', '', '사용자 학번이 누락되었거나, 로그인한 사용자 학번과 일치하지 않습니다.', '');
}

//__debug_print("ST_ID: ".$st_id);

// TODO s_uid 를 form 에서 받는것과 이렇게 하는것중 뭐가 날까
// 현재 진행중인 학기 선택
$SEMESTER_INFO = getCurrentSemesterInfo();

// 입력값 유효성 체크
$s_uid 		= $SEMESTER_INFO['uid'];
$date_update = $date['totime'];

$obser = intval($obser);
$fabri_a = intval($fabri_a);
$fabri_b = intval($fabri_b);
$fabri_c = intval($fabri_c);

$appliances = '';
$appliance_score = 0;
for($i=0; $i < count($_POST['appliance']); $i++){
	//$appliance[$i] = intval($appliance[$i]);
	//("APPLIANCES_$i: ".$_POST['appliance'][$i]);
	$appliances = $appliances.$_POST['appliance'][$i];
	$appliance_score += $_POST['appliance'][$i]*$d['khusd_st_ortho']['appliance_score'][$i];
}

$appliance_rank_score = $fabri_a * $d['khusd_st_ortho']['appliance_a'];
$appliance_rank_score += $fabri_b * $d['khusd_st_ortho']['appliance_b'];
$appliance_rank_score += $fabri_c * $d['khusd_st_ortho']['appliance_c'];

$appliance_score += $appliance_rank_score;

$follow_cnt = intval($follow_cnt);
$follow_new_cnt = intval($follow_new_cnt);
$follow_old = 0;
$follow_new = 0;

$follow_old_obs_cnt = 0;
$follow_new_obs_cnt = 0;

//__debug_print("FOLLOW CNT: ".$follow_cnt.", NEW CNT: ".$follow_new_cnt);

for($i=0; $i<count($_POST['report']); $i++) {
	$temp = intval($_POST['report'][$i]);
	$freport[$temp] = 1;
}
for($i=0; $i<count($_POST['bool_analysis']); $i++) {
	$temp = intval($_POST['bool_analysis'][$i]);
	$fbool_analysis[$temp] = 1;
}
for($i=0; $i<count($_POST['bool_mandatorybonding']); $i++) {
	$temp = intval($_POST['bool_mandatorybonding'][$i]);
	$fbool_mandatorybonding[$temp] = 1;
}
for($i=0; $i<count($_POST['bool_bonding']); $i++) {
	$temp = intval($_POST['bool_bonding'][$i]);
	$fbool_bonding[$temp] = 1;
}

// Obser score calculation // As of ss 2015, no more observation
//단순 옵저
$obser_cnt = $obser;
$obser = $obser * $d['khusd_st_ortho']['score']['obser'];
//$obser = 0;

/*__debug_print("OBSER_CNT: ".$obser_cnt.", OBSER: ".$obser);
__debug_print("SCORES: OBSER=".$d['khusd_st_ortho']['score']['obser']);
__debug_print("SCORES: F_NEW=".$d['khusd_st_ortho']['score']['follow_new']);
__debug_print("SCORES: F_OLD=".$d['khusd_st_ortho']['score']['follow_old']);
__debug_print("SCORES: REPORT=".$d['khusd_st_ortho']['score']['follow_report']);*/

for($i=0; $i<count($_POST['fobser']); $i++) {
	$follow_list[$i] = intval($follow_list[$i]);
	if(!$freport[$i]) $freport[$i] = 0;
	if(!$fbool_analysis[$i]) $fbool_analysis[$i] = 0;
	if(!$fbool_mandatorybonding[$i]) $fbool_mandatorybonding[$i] = 0;
	if(!$fbool_bonding[$i]) $fbool_bonding[$i] = 0;
	$fobser[$i] = intval($_POST['fobser'][$i]);
	
	//__debug_print("UID: ".$follow_list[$i].",ANALYSIS: ".$fbool_analysis[$i].", REPORT: ".$freport[$i].",FOBSER: ".$fobser[$i]);
	//__debug_print("UID: ".$follow_list[$i].", REPORT: ".$freport[$i].", FOBSER: ".$fobser[$i]);
	
	if($i < $follow_new_cnt) {
		// new patient
		if($fobser[$i] >= $d['khusd_st_ortho']['score']['follow_req_new'] && $fbool_analysis[$i] != 0 && ( ($fbool_mandatorybonding[$i]!=0&&$fbool_bonding[$i]!= 0) || ($fbool_mandatorybonding[$i] == 0) )  ) {
			$follow_new = $follow_new
				+follow_point2($d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'], $freport[$i],$fbool_analysis[$i],$fbool_mandatorybonding[$i],$fbool_bonding[$i] ,$fobser[$i], 
$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'],$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'],
$d['khusd_st_ortho']['score']['follow_req_new'],$d['khusd_st_ortho']['score']['follow_req_old'],
$d['khusd_st_ortho']['score']['follow_new_report'],  $d['khusd_st_ortho']['score']['follow_old_report'], $d['khusd_st_ortho']['score']['obser'] 
 ); 
			
		} else {
			// no point when the requirement is not fulfilled // temporarily set as obser
			//$obser = $obser + $fobser[$i] * $d['khusd_st_ortho']['score']['obser'];
		}
		
		$follow_new_obs_cnt += $fobser[$i];
	} else {
		// old patient
		if($fobser[$i] >= $d['khusd_st_ortho']['score']['follow_req_old'] ) {
			$follow_old = $follow_old
				+follow_point2($d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'],$freport[$i],$fbool_analysis[$i],$fbool_mandatorybonding[$i],$fbool_bonding[$i] ,$fobser[$i], 
$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'],$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'],
$d['khusd_st_ortho']['score']['follow_req_new'],$d['khusd_st_ortho']['score']['follow_req_old'],
$d['khusd_st_ortho']['score']['follow_new_report'],  $d['khusd_st_ortho']['score']['follow_old_report'], $d['khusd_st_ortho']['score']['obser'] 
 ); 
		} else {
			$obser = $obser + obser_point($d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'],$freport[$i],$fbool_analysis[$i],$fbool_mandatorybonding[$i],$fbool_bonding[$i] ,$fobser[$i], 
$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'],$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'],
$d['khusd_st_ortho']['score']['follow_req_new'],$d['khusd_st_ortho']['score']['follow_req_old'],
$d['khusd_st_ortho']['score']['follow_new_report'],  $d['khusd_st_ortho']['score']['follow_old_report'], $d['khusd_st_ortho']['score']['obser'] 
);
		}
		
		$follow_old_obs_cnt += $fobser[$i];
	}
	
	// UPDATE FOLLOW TABLE INFORMATION
	$_set = "step='".$fobser[$i]."', report='".$freport[$i]."', date_update='".$date_update."'";
	$_set = "step='".$fobser[$i]."', bool_analysis='".$fbool_analysis[$i]."', report='".$freport[$i]."', bool_mandatorybonding='".$fbool_mandatorybonding[$i]."', bool_bonding='".$fbool_bonding[$i]. "', date_update='".$date_update."'";
	$_where = "uid='".$follow_list[$i]."'";
	
	//__debug_print("UPDATE $table[$m.'follow'] SET $_set WHERE $_where");
	
	getDbUpdate($table[$m.'follow'], $_set, $_where);
}

//__debug_print("OBSER_CNT: ".$obser_cnt.", OBSER: ".$obser.", FOLLOW_OLD_CNT: ".($follow_cnt-$follow_new_cnt).", FOLLOW_OLD: ".$follow_old.", FOLLOW_NEW_CNT: ".$follow_new_cnt.", FOLLOW_NEW: ".$follow_new.", APPLIANCES: ".$appliances.", APP_SCORE: ".$appliance_score);
$follow_old_cnt = $follow_cnt-$follow_new_cnt;
// Score table에 업데이트 기록 남기기
$QKEY = "s_uid, st_id, obser_cnt, obser, follow_old_obs_cnt, follow_old_cnt, follow_old, follow_new_obs_cnt, follow_new_cnt, follow_new, appliance, appliance_score, fabri_a, fabri_b, fabri_c, date_update";
$QVAL = "'$s_uid', '$st_id', '$obser_cnt', '$obser', '$follow_old_obs_cnt', '$follow_old_cnt', '$follow_old', '$follow_new_obs_cnt', '$follow_new_cnt', '$follow_new', '$appliances', '$appliance_score', '$fabri_a', '$fabri_b', '$fabri_c', '$date_update'";
	
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
