<?php

	include_once $g['path_module'].'khusd_st_manager/function/score.php';
	include_once $g['path_module'].'khusd_st_manager/function/date.php';

	if($mode != 'st_list')
	{
		getLink('', '', '잘못된 접근 입니다.', '-1');
	}
	
	if(!$MANAGER)
	{
		getLink('', '', '권한이 없습니다.', '');
	}

	$order_by = $order ? $order : 'date_reg';
	$order_mode = 'ASC';
	if($om == 'a') $order_mode = 'ASC';
	else if($om == 'd') $order_mode = 'DESC';
	
	if($order_by == 'st_date')
		$order_by = 'st_date '.$order_mode.', st_timetype';

	$base_date = $st_date ? $st_date : $date['today'];
	$base_date_t = mktimeFromYmd($base_date);
	$st_start_date_t = getMonDateTimestamp($base_date);		// 오늘이 포함된 주의 월요일 구하기
	$st_end_date_t = getSunDateTimestamp($base_date);		// 오늘이 포함된 주의 일요일 구하기

	$prev_week_date_t = $st_start_date_t - 24 * 60 * 60;
	$next_week_date_t = $st_end_date_t + 24 * 60 * 60;
	
	$st_start_date = date('Ymd', $st_start_date_t);
	$st_end_date = date('Ymd', $st_end_date_t);
	
	$prev_week_date = date('Ymd', $prev_week_date_t);
	$next_week_date = date('Ymd', $next_week_date_t);

	$_table = 
		$table[$m.'apply'].' st'
		.', '.$table['s_mbrdata'].' mbrdata'
		.','.$table['s_mbrid'].' mbrid';
	$_where = 
		'mbrid.uid = mbrdata.memberuid'
		." AND st.s_uid = '".$SEMESTER_INFO['uid']."'"
		.' AND mbrid.id = st.st_id'
		." AND st.st_date >= '".$st_start_date."'"
		." AND st.st_date <= '".$st_end_date."'";
		
	$_data = 'st.*';

	$_sort = 'st.'.$order_by;
	$_orderby = $order_mode;
	

?>