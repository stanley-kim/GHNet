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



// 하단 코드는 main.php 에서 copy & paste

include_once $g['path_module'].'khusd_st_manager/function/date.php';

$base_date = $base_date ? $base_date : $date['today'];
$base_date_t = mktimeFromYmd($base_date);
$mon_t = getMonDateTimestamp($base_date);		// 오늘이 포함된 주의 월요일 구하기
$sun_t = getSunDateTimestamp($base_date);		// 오늘이 포함된 주의 일요일 구하기

$start_date_t = $mon_t + ($d['khusd_st_manager']['update_check']['start_day'] - 1) * 24 * 60 * 60;
$start_date_t += $d['khusd_st_manager']['update_check']['start_hour'] * 60 * 60;
$end_date_t = $mon_t + ($d['khusd_st_manager']['update_check']['end_day'] - 1) * 24 * 60 * 60;
$end_date_t += $d['khusd_st_manager']['update_check']['end_hour'] * 60 * 60;

$start_date = date('YmdHis', $start_date_t);
$end_date = date('YmdHis', $end_date_t);

// 만약, 현재 시간이 업데이트 가능 시간이 아니라면, 독촉하지 않는다.
if($date['totime'] < $start_date || $date['totime'] > $end_date)
{
	getLink('', '', '현재는 업데이트 가능 시간이 아닙니다~!!! 업데이트 가능할 때에만 독촉 가능합니다.', '');
}

// 모든 과에 대해서 독촉 알림 전달
$check_dept = array();
foreach($dept_array as $dept)
{
	$check_dept[] = $dept['id'];
}

$UPDATE_CHECK = array();
$UPDATE_LIST = array();
foreach( $check_dept as $dept_id )
{
	$UPDATE_LIST[$dept_id] = array();
	
	$_update_list_query = 'SELECT date_update, st_id FROM '.$table['khusd_st_'.$dept_id.'score'].' WHERE date_update >= '.$start_date.' AND date_update <= '.$end_date;

	global $DB_CONNECT;
	$UPDATE_LIST_ROWS = db_query($_update_list_query, $DB_CONNECT);
	while($_UPDATE_LIST_ROW = db_fetch_array($UPDATE_LIST_ROWS)) $UPDATE_LIST[$dept_id][$_UPDATE_LIST_ROW['st_id']] = true;

	// full list of member
	$_table = $table['khusd_st_'.$dept_id.'score'].' sc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
	$_where = "mbrid.uid = mbrdata.memberuid AND mbrid.id = sc.st_id";
	$_data = "sc.st_id, mbrdata.name";
	$_orderby = 'sc.st_id ASC';
	$_groupby = 'sc.st_id';
	
	$UPDATE_ROWS = db_query('SELECT '.$_data.' FROM '.$_table.' WHERE '.$_where.' GROUP BY '.$_groupby.' ORDER BY '.$_orderby, $DB_CONNECT);
	while($_UPDATE_ROW = db_fetch_array($UPDATE_ROWS))
	{
		$st_id = $_UPDATE_ROW['st_id'];
		if(!$UPDATE_CHECK[$st_id]) 
		{
			$UPDATE_CHECK[$st_id] = array();
			$UPDATE_CHECK[$st_id]['st_id'] = $_UPDATE_ROW['st_id'];
			$UPDATE_CHECK[$st_id]['name'] = $_UPDATE_ROW['name'];
		}
	}
}

// 구한 업데이트 이력을 토대로, 하나의 과라도 업데이트 안한 사용자에게 푸시 전달
foreach($UPDATE_CHECK as $UPDATE)
{
	// 각 사람마다 어느 과가 업데이트 되었는지 임시로 저장하는 변수
	$_NO_UPDATE_DEPT_NAME = '';

	foreach($check_dept as $dept_id)
	{
		if(!$UPDATE_LIST[$dept_id][$UPDATE['st_id']])
		{
			// 미업데이트인 경우에 해당
			$_NO_UPDATE_DEPT_NAME .= (strlen($_NO_UPDATE_DEPT_NAME) > 0) ? ', ' : '';
			$_NO_UPDATE_DEPT_NAME .= $d['khusd_st_manager']['department'][$dept_id]['name'];
		}
	}

	if(strlen($_NO_UPDATE_DEPT_NAME) > 0)
	{
		send_push_by_id("자신의 점수를 어서 업데이트 하세요~!!!!!!", 
			"현재 ".$my['name']." 님이 각 과별 점수 업데이트를 독촉하였습니다.!!!\n"
			."당신은 현재 ".$_NO_UPDATE_DEPT_NAME."를 업데이트 하지 않았습니다.!!!\n"
			."어서 업데이트 해주세요~!\n\n"
			."마감시간은 ".date('m월 d일 H시 i분', $end_date_t)."입니다.", 
			$UPDATE['st_id'], 
			$g['url_root']);
	}
}


getLink('', '', '미 업데이트 구성원에게 업데이트 독촉 알림을 전달하였습니다.', '');


?>