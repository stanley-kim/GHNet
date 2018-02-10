<?php
if(!defined('__KIMS__')) exit;

include_once $g['dir_module'].'var/var.php'; // 모듈변수파일 인클루드
include_once $g['dir_module'].'var/var.define.php'; // 각종 변수 정의 인클루드

// 이게 false 면 권한이 없는 것
include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/date.php';	// 날짜 처리 함수들
include_once $g['path_module'].'khusd_st_manager/function/member.php';

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}
// 총대단에 관리 권한 부여
$MANAGER = false;
if(permcheck('chief_of_case'))
{
	$MANAGER = true;
}

// 현재 진행중인 학기 선택
$SEMESTER_INFO = getCurrentSemesterInfo();

// TODO 아래 변수들을 점차 제거하고 $SEMESTER_INFO 를 사용하는게 나을듯
$s_uid = $SEMESTER_INFO['uid'];
$s_sid = $SEMESTER_INFO['sid'];
$s_description = $SEMESTER_INFO['description'];


$st_id = $my['id'];

// uid 값이 있으면 view 모드로 내용을 보여준다
if($uid && $uid > 0)
{
	if($mode == 'item_view')
	{
		$APPLY_ITEM = getUidData($table[$m.'apply_item'],$uid);
		$APPLY_INFO = getUidData($table[$m.'apply_info_list'],$APPLY_ITEM['apply_info_uid']);
		
		// CLOSED 상태가 아니라면, 랜덤인 경우 관리자와 과목 연락담당만 명단을 볼 수 있다. 
		if($APPLY_INFO['apply_type'] == 'rand')
		{
			if($APPLY_INFO['status'] != $d['khusd_st_apply_manager']['apply_info']['CLOSED'] 
				&& 
				!$MANAGER 
				&& !permcheck($APPLY_INFO['department'])
				&& ($APPLY_INFO['department'] == 'pros' && !permcheck('pros_sub'))
		)
				getLink('', '', '랜덤 신청의 경우, 마감된 신청만 신청자를 확인할 수 있습니다.','');
		}

		$_orderby = 'al.date_reg, al.timestamp';
		$_sort = 'asc';
		if($APPLY_INFO['apply_type'] == 'fcfs')
		{
			$_orderby = 'al.date_reg, al.timestamp';
			$_sort = 'asc';
		}
		else
		{
			$_orderby = 'al.rand';
			$_sort = 'desc';
		}
		
		$APPLIER_ROWS = getDbArray($table[$m.'apply_list'].' al,'.$table['s_mbrid'].' mbrid,'.$table['s_mbrdata'].' mbrdata',
							"al.apply_item_uid='".$uid."' AND al.st_id=mbrid.id AND mbrid.uid=mbrdata.memberuid", 
							'al.*, mbrdata.name AS name, mbrid.uid AS mbruid', 
							$_orderby, 
							$_sort,
							0,
							0);
		
		$APPLIER_ARRAY = array();
		while($APPLIER = db_fetch_array($APPLIER_ROWS)) $APPLIER_ARRAY[] = $APPLIER;
			}
	else
	{
		$APPLY_INFO = $APPLY_INFO['uid'] 
							?	 $APPLY_INFO 
								: 
								$_APPLY_MBR_INFO = 
									getDbData($table[$m.'apply_info_list'].' ail,'.$table['s_mbrid'].' mbrid,'
										.$table['s_mbrdata'].' mbrdata', 
										"ail.uid = '".$uid."' AND ail.st_id = mbrid.id AND mbrid.uid = mbrdata.memberuid", 
										'ail.*, mbrid.uid AS mbruid, mbrdata.name AS name');
		if(!$APPLY_INFO['uid']) getLink($g['s'].'/', '', '존재하지 않는 신청 정보 입니다.', '');
		
		if($APPLY_INFO['uid']) 
			$PRE_APPLY_INFO_ROWS = getDbArray($table[$m.'pre_apply_info_list'], " parent_apply_info_uid = '".$APPLY_INFO['uid']."'"  ,'*','uid','ASC',0,0);	
	
		// lang.korea/mod/_view.php 에 관련 코드 넣기
		include_once $g['dir_module'].'lang.'.$_HS['lang'].'/mod/_view.php';
		include_once $g['dir_module'].'lang.'.$_HS['lang'].'/mod/_item_list.php';
	}
	
	// 관리자 권한 판단
	if($MANAGER == false && permcheck($APPLY_INFO['department']))
	{
		$MANAGER = true;
	}
	elseif($MANAGER == false && $APPLY_INFO['department'] == 'pros' && permcheck('pros_sub'))
	{
		// 보철과의 경우, 보철과 부관리 담당에게도 권한을 준다. 
		$MANAGER = true;
	}
}

$mode = $mode ? $mode : 'list'; //테마 초기접속모드

/** logic 부분 **/

$sort = $sort ? $sort : 'uid';
$orderby = $orderby && strpos('[asc][desc]',$orderby) ? $orderby : 'desc';
$recnum = $recnum && $recnum < 200 ? $recnum : $d['khusd_st_apply_manager']['recnum'];
 
if($mode == 'list') {
	$APPLY_INFO_ARRAY = array();

	$_table = 
		$table[$m.'apply_info_list'].' ainfo'
		.', '.$table['s_mbrdata'].' mbrdata'
		.','.$table['s_mbrid'].' mbrid'
		.','.$table['khusd_st_manager'.'semester'].' smstr'
		.','.$table['khusd_st_manager'.'s_mbr'].' s_mbr'
		;
	$_where = 
		'mbrid.uid = mbrdata.memberuid'
		.' AND ainfo.s_uid = smstr.uid'
		.' AND mbrid.id = ainfo.st_id'
		.' AND smstr.uid = s_mbr.s_uid'
		." AND s_mbr.st_id = '".$st_id."'"
		;
	$_data = 'ainfo.*, mbrdata.name AS name, mbrid.uid AS mbruid';
	$_sort = $sort;
	$_orderby = $orderby;
 __debug_print("push func: Could not connect to server2. - " . mysql_error());

	
	$NUM = getDbRows($table[$m.'apply_info_list'],'1=1');
	//$TCD = getDbArray2($_table, $_where, $_data, '', '', $recnum, $p);
	
	$TCD = getDbArray($_table, $_where, $_data, $_sort, $_orderby, $recnum, $p);
	//echo $TCD;
	//echo 'select '.$_data.' from '.$_table.($_where?' where '.getSqlFilter($_where):'').' order by '.$_sort.' '.$_orderby.($_recnum?' limit '.(($_p-1)*$_recnum).', '.$_recnum:'');
	//exit;
	while($_R = db_fetch_array($TCD)) $APPLY_INFO_ARRAY[] = $_R;
	//rsort($APPLY_INFO_ARRAY);
	$TPG = getTotalPage($NUM, $recnum);
}
elseif($mode == 'perio_surgery_timetable_view') {
	$_mode_include_file = $g['dir_module'].'lang.'.$_HS['lang'].'/mod/_'.$mode.'.php';
	if(!file_exists($_mode_include_file))
	{
		getLink('', '', '지원하지 않는 모드입니다. ['.$mode.']', '-1');
	}
	include_once $_mode_include_file;
}

/** view 부분 **/	 
$theme = $d['khusd_st_apply_manager']['theme'] ? $d['khusd_st_apply_manager']['theme'] : 'default'; //지정테마
$dispType = $g['mobile']&&$_SESSION['pcmode']!='Y' ? '_mobile' : '_pc'; //모바일,PC모드구분
if ($dispType == '_mobile')
{
	$theme = $d['khusd_st_apply_manager']['theme_m'] ? $d['khusd_st_apply_manager']['theme_m'] : 'default'; // 모바일테마
}

// 모듈 내에서 사용되는 링크들 선언
if($c) {
	// 메뉴에 등록되어 메뉴를 통해 접근한 경우
	$g['apply_info_reset'] = getLinkFilter($g['s'].'/?'.($_HS['usecode']?'r='.$r.'&amp;':'').'c='.$c,array($iframe?'iframe':''));
} else {
	$g['apply_info_reset'] = getLinkFilter($g['s'].'/?'.($_HS['usecode']?'r='.$r.'&amp;':'').'m='.$m,array($iframe?'iframe':''));
}
$g['apply_info_list'] = $g['apply_info_reset'].getLinkFilter('', array($p>1?'p':'',$recnum!=$d['khusd_st_apply_manager']['recnum']?'recnum':''));
$g['pagelink'] = $g['apply_info_list'];
$g['apply_info_add'] = $g['apply_info_list'].'&amp;mode=add';
$g['apply_info_modify'] = $g['apply_info_add'].'&amp;uid=';
$g['apply_info_del'] = $g['apply_info_reset'].'&amp;a=del&amp;nlist='.urlencode($g['apply_info_list']).'&amp;uid=';
$g['apply_info_view'] = $g['apply_info_list'].'&amp;uid=';
$g['apply_info_select_random'] = $g['apply_info_reset'].'&amp;a=select_random&amp;uid=';
$g['apply_info_select_fcfs'] = $g['apply_info_reset'].'&amp;a=select_fcfs&amp;uid=';
$g['apply_info_add_2nd_apply'] = $g['apply_info_list'].'&amp;mode=add_2nd&amp;uid=';
$g['apply_item_apply'] = $g['apply_info_reset'].'&amp;a=apply&amp;uid=';
$g['apply_item_del'] = $g['apply_info_reset'].'&amp;a=item_del&amp;uid=';
$g['apply_item_applier'] = $g['apply_info_reset'].'&amp;iframe=Y&amp;mode=item_view&amp;uid=';
$g['apply_item_apply_cancel'] = $g['apply_info_reset'].'&amp;a=apply_cancel&amp;uid=';
$g['apply_item_apply_cancel_via_item'] = $g['apply_info_reset'].'&amp;a=apply_cancel_via_item&amp;uid=';
$g['apply_item_apply_accept'] = $g['apply_info_reset'].'&amp;a=apply_accept&amp;uid=';

$g['perio_surgery_timetable'] = $g['apply_info_list'].'&amp;mode=perio_surgery_timetable_view&amp;apply_info_list_uid=';

// theme 폴더 경로 설정
$g['dir_module_skin'] = $g['dir_module'].'theme/'.$dispType.'/'.$theme.'/'; //테마폴더 경로
$g['url_module_skin'] = $g['url_module'].'/theme/'.$dispType.'/'.$theme; //테마폴더 URL
$g['img_module_skin'] = $g['url_module_skin'].'/image'; //테마 이미지폴더 URL
 
$g['dir_module_mode'] = $g['dir_module_skin'].$mode; //테마 선택모드 경로
$g['url_module_mode'] = $g['url_module_skin'].'/'.$mode; //테마 선택모드 URL

/** theme 에서 사용하는 변수 불러오기 **/
include_once $g['dir_module_skin'].'_var.php';


// 호출 파일
$g['main'] = $g['main'] ? $g['main'] : $g['dir_module_mode'].'.php'; //출력파일

?>
