<?php
if(!defined('__KIMS__')) exit;

$d['khusd_st_'.$DEPARTMENT]['isperm'] = true;

include_once $g['dir_module'].'var/var.php'; // 모듈변수파일 인클루드
include_once $g['dir_module'].'var/var.score.php'; // 모듈변수파일 인클루드

// 이게 false 면 권한이 없는 것
include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/debug.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/member.php';	// 필수 인클루드 파일

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
	$d['khusd_st_'.$DEPARTMENT]['isperm'] = false;
}
// 치주과 관리자 권한이 있다면 변수에 표시
if(permcheck($DEPARTMENT))
{
	$MANAGER = true;
}

// 현재 진행중인 학기 선택
$SEMESTER_INFO = getCurrentSemesterInfo();

// TODO 아래 변수들을 점차 제거하고 $SEMESTER_INFO 를 사용하는게 나을듯
$s_uid = $_GET["s_uid"]? $_GET["s_uid"] : $SEMESTER_INFO['uid'];
$s_sid = $SEMESTER_INFO['sid'];
$s_description = $SEMESTER_INFO['description'];

////////////////////////////////
// 여기까지는 각 과마다 루틴한 작업
////////////////////////////////

$mode = $mode ? $mode : 'list'; //테마 초기접속모드

/** logic 부분 **/

if($mode && $d['khusd_st_'.$DEPARTMENT]['isperm']) {
	$_mode_include_file = $g['dir_module'].'lang.'.$_HS['lang'].'/mod/_'.$mode.'.php';
	if(!file_exists($_mode_include_file))
	{
		getLink('', '', '지원하지 않는 모드입니다. ['.$mode.']', '-1');
	}
	include_once $_mode_include_file;
} 

/** view 부분 **/
 
$theme = $d['khusd_st_'.$DEPARTMENT]['theme'] ? $d['khusd_st_'.$DEPARTMENT]['theme'] : 'default'; //지정테마
$dispType = $g['mobile']&&$_SESSION['pcmode']!='Y' ? '_mobile' : '_pc'; //모바일,PC모드구분
if ($dispType == '_mobile')
{
	$theme = $d['khusd_st_'.$DEPARTMENT]['theme_m'] ? $d['khusd_st_'.$DEPARTMENT]['theme_m'] : 'default'; // 모바일테마
}

// 모듈 내에서 사용되는 링크들 선언
// 모듈내에서 이동시 이 링크들을 사용한다.  (주로 theme 에서 사용~)
$g['khusd_st_'.$DEPARTMENT.'_list'] =  $g['s'].'/?r='.$r.'&m='.$m;
$g['khusd_st_'.$DEPARTMENT.'_update'] = $g['khusd_st_'.$DEPARTMENT.'_list'].'&amp;mode=update';

$g['khusd_st_'.$DEPARTMENT.'_history'] =  $g['khusd_st_'.$DEPARTMENT.'_list'].'&amp;mode=history&amp;st_id=';
$g['khusd_st_'.$DEPARTMENT.'_history_fix'] =  $g['khusd_st_'.$DEPARTMENT.'_list'].'&amp;mode=history_fix&amp;st_id=';
$g['pagelink'] = $g['khusd_st_'.$DEPARTMENT.'_history'].$st_id.($iframe ? '&amp;iframe='.$iframe : '');	// history mode 에서 사용되는 값
$g['pagelink_fix'] = $g['khusd_st_'.$DEPARTMENT.'_history_fix'].$st_id.($iframe ? '&amp;iframe='.$iframe : '');	// 보존 history fix mode 에서 사용되는 값

$g['khusd_st_cnslt_room_manager_cnslt_table'] = $g['s'].'/?r='.$r.'&m=khusd_st_cnslt_room_manager&amp;mode=cnslt_table&amp;ch_date=';

// theme 폴더 경로 설정
$g['dir_module_skin'] = $g['dir_module'].'theme/'.$dispType.'/'.$theme.'/'; //테마폴더 경로
$g['url_module_skin'] = $g['url_module'].'/theme/'.$dispType.'/'.$theme; //테마폴더 URL
$g['img_module_skin'] = $g['url_module_skin'].'/image'; //테마 이미지폴더 URL
 
$g['dir_module_mode'] = $g['dir_module_skin'].$mode; //테마 선택모드 경로
$g['url_module_mode'] = $g['url_module_skin'].'/'.$mode; //테마 선택모드 URL

/** theme 에서 사용하는 변수 불러오기 **/
if(file_exists($g['dir_module_skin'].'_var.php'))	include_once $g['dir_module_skin'].'_var.php';

// 호출 파일
$g['main'] =  $g['main'] ? $g['main'] : $g['dir_module_mode'].'.php'; //출력파일
?>
