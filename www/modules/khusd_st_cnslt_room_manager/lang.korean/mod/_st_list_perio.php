<?php

	include_once $g['path_module'].'khusd_st_manager/function/score.php';
	include_once $g['path_module'].'khusd_st_manager/function/date.php';
	include_once $g['path_module'].'khusd_st_perio/var/var.score.php';

	include_once $g['path_module'].'khusd_st_manager/function/debug.php';
	
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
	
	$one_hour_in_sec = 60 * 60;
	$one_day_in_sec = 24 * $one_hour_in_sec;

	$prev_week_date_t = $st_start_date_t - $one_day_in_sec;
	$next_week_date_t = $st_end_date_t + $one_day_in_sec;
	
	// calculation of st apply start/end date
	$cur_time_t = strtotime($date['totime']);
	$st_apply_start_date_t = $st_start_date_t - 7 * $one_day_in_sec; // monday, prev week
	$st_apply_end_date_t = $st_apply_start_date_t
				+ ($d['khusd_st_cnslt_room_manager']['apply_time']['end_day'] - 1) * $one_day_in_sec
				+  $d['khusd_st_cnslt_room_manager']['apply_time']['end_hour'] * $one_hour_in_sec;
	$st_apply_start_date_t += ($d['khusd_st_cnslt_room_manager']['apply_time']['start_day'] - 1) * $one_day_in_sec
				+  $d['khusd_st_cnslt_room_manager']['apply_time']['start_hour'] * $one_hour_in_sec;
				
	$end_of_apply_date = getDateOfDay(
		$chair_date, 
		$d['khusd_st_cnslt_room_manager']['apply_time']['end_day']-7, 
		$d['khusd_st_cnslt_room_manager']['apply_time']['end_hour']
	);
	
	
	$st_start_date = date('Ymd', $st_start_date_t);
	$st_end_date = date('Ymd', $st_end_date_t);
	
	
	$prev_week_date = date('Ymd', $prev_week_date_t);
	$next_week_date = date('Ymd', $next_week_date_t);
	*/
	$_data_pre_st = 'IF( sc.charting >= 3 AND sc.iot >= 2 AND sc.sc >= 10, 1, 0)';
	$_data_st_score = 
		'sc.stsc * '.$d['khusd_st_perio']['score']['stsc']
		.' + sc.stpc * '.$d['khusd_st_perio']['score']['stpc']
		.' + sc.stcu * '.$d['khusd_st_perio']['score']['stcu'];

	// 기존점수 + 금주 배정받은 체어 점수
	$_data_st_predict_score = 
		'sc.stsc * '.$d['khusd_st_perio']['score']['stsc']
		.' + sc.stpc * '.$d['khusd_st_perio']['score']['stpc']
		.' + sc.stcu * '.$d['khusd_st_perio']['score']['stcu']
		.' + perio_accepted_sc_chair * '.$d['khusd_st_perio']['score']['stsc']
		.' + perio_accepted_spt_chair * '.$d['khusd_st_perio']['score']['stpc']
		.' + perio_accepted_cu_chair * '.$d['khusd_st_perio']['score']['stcu']
		;
	
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
	
	// 그 주의 치주과 체어 신청 수 + 배정받은 체어수
	// 취소도 포함 모든 체어
	$_join_perio_chair = 
		"SELECT"
		." SUM(IF(status = '".$d['khusd_st_cnslt_room_manager']['apply']['status']['ACCEPTED']."', 1, 0)) AS perio_accepted_chair"
		.", SUM(IF(status = '".$d['khusd_st_cnslt_room_manager']['apply']['status']['ACCEPTED']."' AND tx_plan = '".$d['khusd_st_cnslt_room_manager']['tx_plan']['perio']['sc']['id']."', 1, 0)) AS perio_accepted_sc_chair"
		.", SUM(IF(status = '".$d['khusd_st_cnslt_room_manager']['apply']['status']['ACCEPTED']."' AND tx_plan = '".$d['khusd_st_cnslt_room_manager']['tx_plan']['perio']['spt']['id']."', 1, 0)) AS perio_accepted_spt_chair"
		.", SUM(IF(status = '".$d['khusd_st_cnslt_room_manager']['apply']['status']['ACCEPTED']."' AND tx_plan = '".$d['khusd_st_cnslt_room_manager']['tx_plan']['perio']['cu']['id']."', 1, 0)) AS perio_accepted_cu_chair"
		.", COUNT(uid) AS perio_chair"
		.", st_id"
		.' FROM '.$table[$m.'apply']
		." WHERE"
			." st_type = '".$st_type."'"
			." AND st_date >= '".$st_start_date."'"
			." AND st_date <= '".$st_end_date."'"
		." GROUP BY st_id";
		
	// 조회하는 전날까지 배정받은 치주과 SC 체어 수
	$_query_sc_chair = 'SELECT COUNT(uid) AS sc_chair, st_id'
		.' FROM '.$table[$m.'apply']
		." WHERE"
			." st_type = '".$st_type."'"
			." AND tx_plan = '".$d['khusd_st_cnslt_room_manager']['tx_plan']['perio']['sc']['id']."'"
			." AND st_date < '".$st_date."'"
			." AND chair_no != 0"
		." GROUP BY st_id";

	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table['khusd_st_perio'.'score']." WHERE is_goal = 'n' GROUP BY st_id";
	$_table = 
		$table[$m.'apply'].' st'
		.', '.$table['khusd_st_perio'.'score'].' sc'
		.', '.$table['s_mbrdata'].' mbrdata'
		.', '.$table['s_mbrid'].' mbrid'
		.',('.$_join.') sc_j'
		.',('.$_join_perio_chair.') perio_j'
		.',('.$_join_total_chair.') total_j';
		//.',('.$_query_sc_chair.') sch';
	$_where = 
		"st.st_type = '".$st_type."'"
		.' AND sc.date_update = sc_j.date_update'
		.' AND st.st_id = sc.st_id'
		.' AND sc.st_id = sc_j.st_id'
		." AND sc.s_uid = '".$SEMESTER_INFO['uid']."'"
		." AND sc.is_goal = 'n'"
		.' AND st.st_id = perio_j.st_id'
		.' AND st.st_id = total_j.st_id'
		.' AND mbrid.uid = mbrdata.memberuid'
		.' AND mbrid.id = sc.st_id'
		." AND st.s_uid = '".$SEMESTER_INFO['uid']."'"
		." AND st.st_date = '".$st_date."'"
		." AND st.st_timetype = '".$st_timetype."'";
		//.' AND st.st_id = sch.st_id';
		//stscpc
	$_data = 'st.*'
		.', sc.stsc'
		.', sc.stpc'
		.', (sc.stpc+sc.stsc) as stscpc'
		.', sc.stcu'
		.', perio_j.perio_chair AS perio_chair'
		.', perio_j.perio_accepted_chair AS perio_accepted_chair'
		.', total_j.total_chair AS total_chair'
		.', '.$_data_pre_st.' AS pre_st'
		.', '.$_data_st_score.' AS st_score'
		.', '.$_data_st_predict_score.' AS st_predict_score'
	;
			
	$_sort = $order_by;
	$_orderby = $order_mode;
//	echo "SELECT ".$_data." FROM ".$_table." WHERE ".$_where;
	//__debug_print("SELECT ".$_data." FROM ".$_table." WHERE ".$_where);
?>