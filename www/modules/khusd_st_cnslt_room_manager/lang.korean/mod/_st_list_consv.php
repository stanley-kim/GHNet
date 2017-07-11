<?php

	include_once $g['path_module'].'khusd_st_manager/function/score.php';
	include_once $g['path_module'].'khusd_st_manager/function/date.php';
	//include_once $g['path_module'].'khusd_st_manager/function/debug.php';
	include_once $g['path_module'].'khusd_st_consv/var/var.score.php';

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
	$_data_pre_st = 'IF( pre_st_ant >= 4 AND pre_st_post >= 5 AND pre_st_cervical >= 7, 1, 0)';
	$_data_pre_op = 
		'sc.st_op_tooth_colored_cervical'
		.' + sc.st_op_tooth_colored_simple'
		.' + sc.st_op_tooth_colored_complex'
		.' + sc.st_op_tooth_colored_diastema'

		.' + sc.st_op_am_simple'
		.' + sc.st_op_am_complex'
		;

	$_data_st_inlay_prep = 
		"IF("
			."(st_inlay_1_proc = 'inlay_prep')"
			." OR "
			."(st_inlay_1_proc = 'inlay_setting')"
			.", 1"
			.", 0"
		.")"
		." + "
		."IF("
			."(st_inlay_2_proc = 'inlay_prep')"
			." OR "
			."(st_inlay_2_proc = 'inlay_setting')"
			.", 1"
			.", 0"
		.")"
		;

	$_data_st_inlay_setting = 
		"IF("
			."st_inlay_1_proc = 'inlay_setting'"
			.", 1"
			.", 0"
		.")"
		." + "
		."IF("
			."st_inlay_2_proc = 'inlay_setting'"
			.", 1"
			.", 0"
		.")"
		;
		
	$_data_pre_op_score = 
		'sc.st_op_tooth_colored_cervical * ' .$d['khusd_st_consv']['score']['st']['st_op_simple']
		.' + sc.st_op_tooth_colored_simple * ' .$d['khusd_st_consv']['score']['st']['st_op_simple']
		.' + sc.st_op_tooth_colored_complex * ' .$d['khusd_st_consv']['score']['st']['st_op_complex']
		.' + sc.st_op_tooth_colored_diastema * ' .$d['khusd_st_consv']['score']['st']['st_op_diastema']

		.' + sc.st_op_am_simple * ' .$d['khusd_st_consv']['score']['st']['st_op_simple']
		.' + sc.st_op_am_complex * ' .$d['khusd_st_consv']['score']['st']['st_op_complex']
		;

	$_data_total_op = 
		'sc.st_op_tooth_colored_cervical'
		.' + sc.st_op_tooth_colored_simple'
		.' + sc.st_op_tooth_colored_complex'
		.' + sc.st_op_tooth_colored_diastema'

		.' + sc.st_op_am_simple'
		.' + sc.st_op_am_complex'
		
		.' + st.consv_op';
		;
		
	$_join_total_chair = 'SELECT COUNT(uid) AS total_chair, st_id'
			.' FROM '.$table[$m.'apply']
			." WHERE st_type = '".$st_type."' AND status = '".$d['khusd_st_cnslt_room_manager']['apply']['status']['ACCEPTED']."' GROUP BY st_id";
	$_join_apply_op_num = 
			'SELECT COUNT(uid) AS apply_op_num, st_id'
			.' FROM '.$table[$m.'apply']
			." WHERE"
				." st_type = '".$st_type."'"
				." AND st_date >= '".$st_start_date."'"
//				." AND status != '".$d['khusd_st_cnslt_room_manager']['apply']['status']['CANCEL']."'"
				." AND st_date <= '".$st_end_date."'"
			." GROUP BY st_id";
	
	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table['khusd_st_'.$department.'score'].' GROUP BY st_id';
	$_join2 = 'select st_id, taking, taking_pt from rb_khusd_st_radio_score t1 join (select MAX(uid) as uid from rb_khusd_st_radio_score group by st_id) t2 on (t1.uid = t2.uid) ';
	$_table = 
		$table[$m.'apply'].' st'
		.', '.$table['khusd_st_'.$department.'score'].' sc'
		.', ('.$_join2.') sc_r'
		.', '.$table['s_mbrdata'].' mbrdata'
		.','.$table['s_mbrid'].' mbrid,('.$_join.') sc_j'
		.',('.$_join_apply_op_num.') op_j';
	$_where = 
		"st.st_type = '".$st_type."'"
		.' AND sc.date_update = sc_j.date_update'
		." AND sc.s_uid = '".$SEMESTER_INFO['uid']."'"
		.' AND st.st_id = sc.st_id'
		.' AND sc.st_id = sc_r.st_id'
		.' AND sc.st_id = sc_j.st_id'
		.' AND st.st_id = op_j.st_id'
		.' AND mbrid.uid = mbrdata.memberuid'
		.' AND mbrid.id = sc.st_id'
		." AND st.s_uid = '".$SEMESTER_INFO['uid']."'"
		." AND st.st_date = '".$st_date."'"
		." AND st.st_timetype = '".$st_timetype."'";
	
	
	$_data = 'st.*'
		.', sc.st_op_chair_assigned AS st_op_chair_assigned'
		.', op_j.apply_op_num'
		.', sc_r.taking as taking'
		.', sc_r.taking_pt as taking_pt'
		.', '.$_data_pre_st.' AS pre_st'
		.', ('.$_data_st_inlay_prep.') AS st_inlay_prep'
		.', ('.$_data_st_inlay_setting.') AS st_inlay_setting'
		.', '.$_data_pre_op.' AS pre_op'
		.', '.$_data_pre_op_score.' AS pre_op_score'
		.', '.$_data_total_op.' AS total_op';
	$_sort = $order_by;
	$_orderby = $order_mode;

	//echo "SELECT $_data FROM $_table WHERE $_where";
	//__debug_print("SELECT1 $_data FROM1 $_table WHERE1 $_where");
?>
