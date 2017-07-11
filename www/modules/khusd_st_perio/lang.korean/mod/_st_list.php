<?php

	if(permcheck('chief_of_cnslt_room'))
	{
		$MANAGER = true;
	}

	$st_date = $st_date ? $st_date : $date['today'];
	$st_timetype = $st_timetype ? $st_timetype : 'am';

	$ST_CHAIR_ARRAY = array();
	$tx_plan_array = $d['khusd_st_cnslt_room_manager']['tx_plan']['perio'];

	$_data_pre_st = 'IF( sc.charting >= 3 AND sc.iot >= 2 AND sc.sc >= 10, 1, 0)';
	$_data_st_score = 
		'sc.stsc * '.$d['khusd_st_perio']['score']['stsc']
		.' + sc.stpc * '.$d['khusd_st_perio']['score']['stpc']
		.' + sc.stcu * '.$d['khusd_st_perio']['score']['stcu'];
	
	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table[$m.'score'].' GROUP BY st_id';
	$_table = 
		$table[$m.'st_chair'].' st'
		.', '.$table[$m.'score'].' sc'
		.', '.$table['s_mbrdata'].' mbrdata'
		.','.$table['s_mbrid'].' mbrid,('.$_join.') sc_j';
	$_where = 
		'sc.date_update = sc_j.date_update'
		.' AND st.st_id = sc.st_id'
		.' AND sc.st_id = sc_j.st_id'
		.' AND mbrdata.sosok = '.$d['khusd_st_manager']['jointgroup']
		.' AND mbrid.uid = mbrdata.memberuid'
		.' AND mbrid.id = sc.st_id'
		." AND st.st_date = '".$st_date."'"
		." AND st.st_timetype = '".$st_timetype."'";
		
	$_data = 'st.*'
		.', sc.stsc'
		.', sc.stpc'
		.', sc.stcu'
		.', '.$_data_pre_st.' AS pre_st'
		.', '.$_data_st_score.' AS st_score';
	$_sort = 'st.date_reg';
	$_orderby = 'ASC';
	
	$ST_CHAIR_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
	
	// getDbArray 는 mysql_query 의 리턴값을 리턴하므로, fetch 해줘야 한다
	while( $_ROW = db_fetch_array($ST_CHAIR_ROWS) ) $ST_CHAIR_ARRAY[] = $_ROW;


	// 각각의 항목에 id와 회원정보를 추가
	foreach($ST_CHAIR_ARRAY as $IDX => $SCORE_TMP) {
		$st_id = $SCORE_TMP['st_id'];

		$stid_array = getDbData($table['s_mbrid'],"id='".$st_id."'", '*');
		$stdata_array = getDbData($table['s_mbrdata'], "memberuid='".$stid_array['uid']."'", '*');

		$st_array = array_merge($stid_array, $stdata_array);
		
		$ST_CHAIR_ARRAY[$IDX]['st_info'] = $st_array;
	}
?>