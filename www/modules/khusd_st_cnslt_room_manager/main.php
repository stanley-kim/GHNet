<?php
if(!defined('__KIMS__')) exit;

$d['khusd_st_cnslt_room_manager']['isperm'] = true;

include_once $g['dir_module'].'var/var.php'; // 모듈변수파일 인클루드
include_once $g['dir_module'].'var/var.define.php'; // 모듈변수파일 인클루드

// 이게 false 면 권한이 없는 것
include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/debug.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/date.php';	// 날짜 처리 함수들
include_once $g['path_module'].'khusd_st_manager/function/member.php';

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
	$d['khusd_st_cnslt_room_manager']['isperm'] = false;
}
// 관리자 권한이 있다면 변수에 표시
	if(permcheck('chief_of_cnslt_room') || permcheck('chief_of_op'))
{
	$MANAGER = true;
}

// 현재 진행중인 학기 선택
// TODO 사용해보니 학기초에는... 업데이트 안한 사람의 경우 체어신청 이력이 표시되지 않는 문제 발생함
$SEMESTER_INFO = getCurrentSemesterInfo();

// TODO 아래 변수들을 점차 제거하고 $SEMESTER_INFO 를 사용하는게 나을듯
$s_uid = $SEMESTER_INFO['uid'];
$s_sid = $SEMESTER_INFO['sid'];
$s_description = $SEMESTER_INFO['description'];

////////////////////////////////
// 여기까지는 각 과마다 루틴한 작업
////////////////////////////////

$mode = $mode ? $mode : 'cnslt_table';

/** logic 부분 **/

if($mode && $d['khusd_st_cnslt_room_manager']['isperm']) {
	$_mode_include_file = $g['dir_module'].'lang.'.$_HS['lang'].'/mod/_'.$mode.'.php';
	if(!file_exists($_mode_include_file))
	{
		getLink('', '', '지원하지 않는 모드입니다. ['.$mode.']', '-1');
	}
	include_once $_mode_include_file;
}

$st_id = $my['id']; 

/** view 부분 **/
 
$theme = $d['khusd_st_cnslt_room_manager']['theme'] ? $d['khusd_st_cnslt_room_manager']['theme'] : 'default'; //지정테마
$dispType = $g['mobile']&&$_SESSION['pcmode']!='Y' ? '_mobile' : '_pc'; //모바일,PC모드구분
if ($dispType == '_mobile')
{
	$theme = $d['khusd_st_cnslt_room_manager']['theme_m'] ? $d['khusd_st_cnslt_room_manager']['theme_m'] : 'default'; // 모바일테마
}

// 모듈 내에서 사용되는 링크들 선언
// 모듈내에서 이동시 이 링크들을 사용한다.  (주로 theme 에서 사용~)
$g['khusd_st_cnslt_room_manager_list'] =  $g['s'].'/?r='.$r.'&m='.$m;
$g['khusd_st_cnslt_room_manager_update'] = $g['khusd_st_cnslt_room_manager_list'].'&amp;mode=update';

$g['khusd_st_cnslt_room_manager_history'] =  $g['khusd_st_cnslt_room_manager_list'].'&amp;mode=history&amp;st_id=';
$g['pagelink'] = $g['khusd_st_cnslt_room_manager_history'].$st_id.($iframe ? '&amp;iframe='.$iframe : '');	// history mode 에서 사용되는 값

$g['khusd_st_cnslt_room_manager_cnslt_table'] = $g['khusd_st_cnslt_room_manager_list'].'&amp;mode=cnslt_table&amp;ch_date=';
$g['khusd_st_cnslt_room_manager_cnslt_schedule'] = $g['khusd_st_cnslt_room_manager_list'].'&amp;mode=cnslt_schedule&amp;ch_date=';

$g['khusd_st_cnslt_room_manager_cnslt_consv_table'] = $g['khusd_st_cnslt_room_manager_list'].'&amp;mode=cnslt_consv_table&amp;ch_date=';
$g['khusd_st_cnslt_room_manager_cnslt_pros_table'] = $g['khusd_st_cnslt_room_manager_list'].'&amp;mode=cnslt_pros_table&amp;ch_date=';

$g['khusd_st_cnslt_room_manager_st_manager'] =  $g['khusd_st_cnslt_room_manager_list'].'&amp;department=manager&amp;st_type=manager';
$g['khusd_st_cnslt_room_manager_st_manager_list'] =  $g['khusd_st_cnslt_room_manager_st_manager'].'&amp;mode=st_list&amp;st_date=';
$g['khusd_st_cnslt_room_manager_st_manager_schedule'] =  $g['khusd_st_cnslt_room_manager_st_manager'].'&amp;mode=st_schedule&amp;st_date=';

$g['khusd_st_cnslt_room_manager_st_perio'] =  $g['khusd_st_cnslt_room_manager_list'].'&amp;department=perio&amp;st_type=perio';
$g['khusd_st_cnslt_room_manager_st_perio_list'] =  $g['khusd_st_cnslt_room_manager_st_perio'].'&amp;mode=st_list&amp;st_date=';
$g['khusd_st_cnslt_room_manager_st_perio_schedule'] =  $g['khusd_st_cnslt_room_manager_st_perio'].'&amp;mode=st_schedule&amp;st_date=';

$g['khusd_st_cnslt_room_manager_st_pedia'] =  $g['khusd_st_cnslt_room_manager_list'].'&amp;department=pedia&amp;st_type=pedia';
$g['khusd_st_cnslt_room_manager_st_pedia_list'] =  $g['khusd_st_cnslt_room_manager_st_pedia'].'&amp;mode=st_list&amp;st_date=';
$g['khusd_st_cnslt_room_manager_st_pedia_schedule'] =  $g['khusd_st_cnslt_room_manager_st_pedia'].'&amp;mode=st_schedule&amp;st_date=';

$g['khusd_st_cnslt_room_manager_st_radio'] =  $g['khusd_st_cnslt_room_manager_list'].'&amp;department=radio&amp;st_type=radio';
$g['khusd_st_cnslt_room_manager_st_radio_list'] =  $g['khusd_st_cnslt_room_manager_st_radio'].'&amp;mode=st_list&amp;st_date=';
$g['khusd_st_cnslt_room_manager_st_radio_schedule'] =  $g['khusd_st_cnslt_room_manager_st_radio'].'&amp;mode=st_schedule&amp;st_date=';

$g['khusd_st_cnslt_room_manager_st_consv'] =  $g['khusd_st_cnslt_room_manager_list'].'&amp;department=consv&amp;st_type=consv';
$g['khusd_st_cnslt_room_manager_st_consv_list'] =  $g['khusd_st_cnslt_room_manager_st_consv'].'&amp;mode=st_list&amp;st_date=';
$g['khusd_st_cnslt_room_manager_st_consv_schedule'] =  $g['khusd_st_cnslt_room_manager_st_consv'].'&amp;mode=st_schedule&amp;st_date=';

$g['khusd_st_cnslt_room_manager_st_pros'] =  $g['khusd_st_cnslt_room_manager_list'].'&amp;department=pros&amp;st_type=pros';
$g['khusd_st_cnslt_room_manager_st_pros_list'] =  $g['khusd_st_cnslt_room_manager_st_pros'].'&amp;mode=st_list&amp;st_date=';
$g['khusd_st_cnslt_room_manager_st_pros_schedule'] =  $g['khusd_st_cnslt_room_manager_st_pros'].'&amp;mode=st_schedule&amp;st_date=';

$g['khusd_st_cnslt_room_manager_st_endo'] =  $g['khusd_st_cnslt_room_manager_list'].'&amp;department=consv&amp;st_type=endo';
$g['khusd_st_cnslt_room_manager_st_endo_list'] =  $g['khusd_st_cnslt_room_manager_st_endo'].'&amp;mode=st_list&amp;st_date=';
$g['khusd_st_cnslt_room_manager_st_endo_schedule'] =  $g['khusd_st_cnslt_room_manager_st_endo'].'&amp;mode=st_schedule&amp;st_date=';

$g['khusd_st_cnslt_room_manager_disinfection'] =  $g['khusd_st_cnslt_room_manager_st_endo'].'&amp;mode=disinfection&amp;';


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