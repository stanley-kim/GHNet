<?php
	if(permcheck('chief_of_cnslt_room') || permcheck('chief_of_op'))
	{
		$MANAGER = true;
	}
	
	include_once $g['path_module'].'khusd_st_perio/var/var.score.php';
	include_once $g['path_module'].'khusd_st_manager/function/date.php';
	include_once $g['path_module'].'khusd_st_manager/function/debug.php';

	$st_date = $st_date ? $st_date : $date['today'];
	$st_timetype = $st_timetype ? $st_timetype : 'am';
	$st_type = $department ? $department : 'radio';
	
	$ST_APPLY_NUM = 0;	// 영상과에서 현재 신청자 수를 알기 위해 사용
	$ST_CHAIR_ARRAY = array();
	$tx_plan_array = $d['khusd_st_cnslt_room_manager']['tx_plan'][$st_type];

	
	
	// 취소 가능한지 판단
	$st_start_date = getDateOfDay(
						$st_date, 
						$d['khusd_st_cnslt_room_manager']['st_time']['start_day'], 
						$d['khusd_st_cnslt_room_manager']['st_time']['start_hour'],
						'Ymd'
					);
	$st_end_date = getDateOfDay(
						$st_date, 
						$d['khusd_st_cnslt_room_manager']['st_time']['end_day'], 
						$d['khusd_st_cnslt_room_manager']['st_time']['end_hour'],
						'Ymd'
					);
	
	$start_date = getDateOfDay(
						$st_date, 
						$d['khusd_st_cnslt_room_manager']['apply_time']['start_day'], 
						$d['khusd_st_cnslt_room_manager']['apply_time']['start_hour'],
						'Ymd'
					);
	$end_date = getDateOfDay(
						$st_date, 
						$d['khusd_st_cnslt_room_manager']['apply_time']['end_day'], 
						$d['khusd_st_cnslt_room_manager']['apply_time']['end_hour'],
						'Ymd'
					);
	
	$apply_start_date = getDateOfDay(
						$st_date, 
						$d['khusd_st_cnslt_room_manager']['apply_time']['start_day']-7, 
						$d['khusd_st_cnslt_room_manager']['apply_time']['start_hour']
					);
	
	$apply_end_date = getDateOfDay(
						$st_date, 
						$d['khusd_st_cnslt_room_manager']['apply_time']['end_day']-7, 
						$d['khusd_st_cnslt_room_manager']['apply_time']['end_hour']
					);
	
	
	$base_date = $st_date ? $st_date : $date['today'];
	$base_date_t = mktimeFromYmd($base_date);
	$st_start_date_t = getMonDateTimestamp($st_date);
	$st_end_date_t = getSunDateTimestamp($st_date);
	
	$prev_week_date = $start_date;
	$next_week_date = $end_date;
	
	$one_hour_in_sec = 60 * 60;
	$one_day_in_sec = 24 * $one_hour_in_sec;

	$prev_week_date_t = $st_start_date_t - $one_day_in_sec;
	$next_week_date_t = $st_end_date_t + $one_day_in_sec;
	
	// calculation of st apply start/end date
	$cur_time_t = strtotime($date['totime']);
//	$st_apply_start_date_t = $st_start_date_t - 7 * $one_day_in_sec; // monday, prev week
	$st_apply_start_date_t = $st_start_date_t; // monday, current week
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
	
	$_mode_query_include_file = $g['dir_module'].'lang.'.$_HS['lang'].'/mod/_'.$mode.'_'.$st_type.'.php';
	if(!file_exists($_mode_query_include_file))
	{
		getLink('', '', '지원하지 않는 ST신청 종류 입니다. ['.$st_type.']', '-1');
	}
	include_once $_mode_query_include_file;
	
	$ST_CHAIR_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
	//__debug_print('SELECT1 '.$_data.'\r\nFROM1 '.$_table.'\r\nWHERE1 .'.$_where);
	//echo 'SELECT '.$_data.'\r\nFROM '.$_table.'\r\nWHERE .'.$_where;
	// getDbArray 는 mysql_query 의 리턴값을 리턴하므로, fetch 해줘야 한다
	while( $_ROW = db_fetch_array($ST_CHAIR_ROWS) ) 
	{
		$ST_CHAIR_ARRAY[] = $_ROW;
		if($_ROW['status'] == $d['khusd_st_cnslt_room_manager']['apply']['status']['APPLY'])
			$ST_APPLY_NUM++;
	}

	// 각각의 항목에 id와 회원정보를 추가
	foreach($ST_CHAIR_ARRAY as $IDX => $SCORE_TMP) {
		$st_id = $SCORE_TMP['st_id'];

		$stid_array = getDbData($table['s_mbrid'],"id='".$st_id."'", '*');
		$stdata_array = getDbData($table['s_mbrdata'], "memberuid='".$stid_array['uid']."'", '*');

		$st_array = array_merge($stid_array, $stdata_array);
		
		$ST_CHAIR_ARRAY[$IDX]['st_info'] = $st_array;
	}
	
	
	if($order == ''){
		if($st_type == 'radio'){
			$ST_CHAIR_ARRAY_1st = array();
			$ST_CHAIR_ARRAY_2nd = array();
			$ST_CHAIR_ARRAY_etc = array();
			foreach($ST_CHAIR_ARRAY as $IDX => $SCORE_TMP) {
				if($SCORE_TMP['st_timetype_detail'] == "1"){
					$ST_CHAIR_ARRAY_1st[$IDX] = $SCORE_TMP;
				}else if($SCORE_TMP['st_timetype_detail'] == "2"){
					$ST_CHAIR_ARRAY_2nd[$IDX] = $SCORE_TMP;
				}else{
					$ST_CHAIR_ARRAY_etc[$IDX] = $SCORE_TMP;
				}
			}
			
			$price = array();
			foreach ($ST_CHAIR_ARRAY_1st as $key => $row)
			{
				$price[$key] = $row['status'];
			}
			array_multisort($price, SORT_ASC, $ST_CHAIR_ARRAY_1st);
			
			$price = array();
			foreach ($ST_CHAIR_ARRAY_2nd as $key => $row)
			{
				$price[$key] = $row['status'];
			}
			array_multisort($price, SORT_ASC, $ST_CHAIR_ARRAY_2nd);
			
			$price = array();
			foreach ($ST_CHAIR_ARRAY_etc as $key => $row)
			{
				$price[$key] = $row['status'];
			}
			array_multisort($price, SORT_ASC, $ST_CHAIR_ARRAY_etc);
			
			$ST_CHAIR_ARRAY = array_merge($ST_CHAIR_ARRAY_1st, $ST_CHAIR_ARRAY_2nd, $ST_CHAIR_ARRAY_etc);
		}else{
			$price = array();
			foreach ($ST_CHAIR_ARRAY as $key => $row)
			{
				$price[$key] = $row['status'];
			}
			array_multisort($price, SORT_ASC, $ST_CHAIR_ARRAY);
			
		}
	}
?>
