<?php

	include_once $g['path_module'].'khusd_st_manager/function/score.php';
	include_once $g['path_module'].'khusd_st_manager/function/date.php';
	include_once $g['path_module'].'khusd_st_perio/var/var.score.php';

	if($mode != 'st_list')
	{
		getLink('', '', '잘못된 접근 입니다.', '-1');
	}
	
	$order_by = $order ? $order : 'date_reg';
	$order_mode = 'ASC';
	if($om == 'a') $order_mode = 'ASC';
	else if($om == 'd') $order_mode = 'DESC';
	/*
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
	*/
	// 그 주의 모든과 체어 신청 수
	// 취소도 포함 모든 체어
	// 단 영상과 제외
	$_join_total_chair = 'SELECT COUNT(uid) AS total_chair, st_id'
			.' FROM '.$table[$m.'apply']
			." WHERE"
				." st_type != 'radio'"
				." AND st_date >= '".$st_start_date."'"
				." AND st_date <= '".$st_end_date."'"
			
			." GROUP BY st_id";
	
	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table['khusd_st_pedia'.'score']." WHERE is_goal = 'n' GROUP BY st_id";
	$_table = 
		$table[$m.'apply'].' st'
		.', '.$table['khusd_st_pedia'.'score'].' sc'
		.', '.$table['s_mbrdata'].' mbrdata'
		.', '.$table['s_mbrid'].' mbrid'
		.',('.$_join.') sc_j'
		.',('.$_join_total_chair.') total_j';
	$_where = 
		"st.st_type = '".$st_type."'"
		.' AND sc.date_update = sc_j.date_update'
		.' AND st.st_id = sc.st_id'
		.' AND sc.st_id = sc_j.st_id'
		." AND sc.is_goal = 'n'"
		.' AND st.st_id = total_j.st_id'
		.' AND mbrid.uid = mbrdata.memberuid'
		.' AND mbrid.id = sc.st_id'
		." AND st.s_uid = '".$SEMESTER_INFO['uid']."'"
		." AND st.st_date = '".$st_date."'"
		." AND st.st_timetype = '".$st_timetype."'";
		
	$_data = 'st.*'
		.', total_j.total_chair AS total_chair'
	;
			
	$_sort = $order_by;
	$_orderby = $order_mode;
	
	//echo "SELECT $_data FROM $_table WHERE $_where";

?>