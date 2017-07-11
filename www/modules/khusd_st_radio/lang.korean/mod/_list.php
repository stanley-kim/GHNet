<?php
	$SCORE_ARRAY = array();

	// 정렬 순서에 대한 옵션 처리
	if($MANAGER == false && $order)
	{
		// 정렬은 관리권한 있는 사용자만 가능
		getLink('','', '각 과의 연락담당과 총대만 정렬 가능합니다.','');
	}
	$order_by = $order ? $order : 'st_id';
	$order_mode = ASC;
	if($om == 'a') $order_mode = ASC;
	else if($om == 'd') $order_mode = DESC;
	
	/** 2014.1 학기에 임시용 코드 **/
	$prev_s_uid = 1;
//	$s_uid =  $_GET["s_uid"];
	// 한 학번에 대해 여러 개의 데이터가 존재하므로 가장 최근의 데이터만 출력해주도록 JOIN 을 이용하여 query
	// 아래 쿼리는 다음의 커리를 참고
	/*
	select 
			sc.*,
			sc.iot+sc.charting AS ch_iot, 
			surgery+imp_1st+imp_2nd AS total_surgery, 
			sc.iot * 7+ sc.charting * 7+ sc.surgery * 10+ sc.imp_1st * 8+ sc.imp_2nd * 5+ sc.sc * 3+ sc.others * 1+ sc.tbi * 1 AS ob_score, 
			(sc.iot * 7+ sc.charting * 7+ sc.surgery * 10+ sc.imp_1st * 8+ sc.imp_2nd * 5+ sc.sc * 3+ sc.others * 1+ sc.tbi * 1 + sc.follow_point) * 0.044 + (sc.stsc * 13+ sc.stpc * 5+ sc.stcu * 10) * 0.208 AS total_score
			
	from 
		st43_khusd_st_radio_score sc, 
		st43_s_mbrdata mbrdata,
		st43_s_mbrid mbrid,
		(SELECT MAX(date_update) date_update,st_id FROM st43_khusd_st_radio_score GROUP BY st_id) sc_j 
	where 	sc.date_update = sc_j.date_update 
		AND sc.st_id = sc_j.st_id 
		AND mbrid.uid = mbrdata.memberuid 
		AND mbrid.id = sc.st_id 
	order by sc.follow DESC
	*/
	// Temporary codes : 1st semester has no penalty requirement
	/*$_table_data_penalty_require = 
		"SELECT date_update, (".$d['khusd_st_radio']['require']['taking']." - taking) * 2 AS penalty_require"
		." FROM ".$table[$m.'score']
		." WHERE s_uid = '".$prev_s_uid."'";*/
	$_table_data_penalty_require = 
		"SELECT date_update, 0 AS penalty_require"
		." FROM ".$table[$m.'score']
		." WHERE s_uid = '".$prev_s_uid."'";
	$_join_prev = 'SELECT uid,MAX(date_update) date_update,st_id, taking AS prev_taking FROM '.$table[$m.'score'].' WHERE s_uid = '.$prev_s_uid.' GROUP BY st_id';
	
	$_data_is_penalty_complete = 
		"IF(penalty_taking - penalty_require >= 0, 1, 0)";

	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table[$m.'score'].' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
	$_table = 
		'('.$_table_data_penalty_require.') prt,'
		.$table[$m.'score'].' sc,'
		.$table['s_mbrdata'].' mbrdata,'
		.$table['s_mbrid'].' mbrid,'
		.'('.$_join.') sc_j,'
		.'('.$_join_prev.') sc_j_p';
		
	$_where = 
		"s_uid = '".$s_uid."'"
		.' AND sc.date_update = sc_j.date_update'
		.' AND sc.st_id = sc_j.st_id'
		.' AND mbrid.uid = mbrdata.memberuid'
		.' AND mbrid.id = sc.st_id'
		
		.' AND sc.st_id = sc_j_p.st_id'
		.' AND prt.date_update = sc_j_p.date_update';
		
	$_data = 
		'sc.*'
		.', prt.penalty_require'
		.', ('.$_data_is_penalty_complete.') AS is_penalty_complete';
	$_sort = $order_by;
	$_orderby = $order_mode;
	
	$SCORE_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
	
	// getDbArray 는 mysql_query 의 리턴값을 리턴하므로, fetch 해줘야 한다
	while( $_ROW = db_fetch_array($SCORE_ROWS) ) $SCORE_ARRAY[$_ROW['st_id']] = $_ROW;

	foreach($SCORE_ARRAY as $SCORE_TMP) {
		$st_id = $SCORE_TMP['st_id'];

		$stid_array = getDbData($table['s_mbrid'],"id='".$st_id."'", '*');
		$stdata_array = getDbData($table['s_mbrdata'], "memberuid='".$stid_array['uid']."'", '*');

		$st_array = array_merge($stid_array, $stdata_array);
		
		$SCORE_ARRAY[$st_id]['st_info'] = $st_array;
	}

	// 평균 구하기
	/*
	$_data = 'AVG(penalty_require) AS penalty_require, AVG(penalty_taking) AS penalty_taking, AVG(taking) AS taking, AVG(taking_pt) AS taking_pt, AVG(follow) AS follow, AVG(panorama) AS panorama'
		.', SUM('.$_data_is_penalty_complete.') AS is_penalty_complete';
	$AVG = getDbData($_table, $_where, $_data);*/
	// Temporary modification
	$_table1 = $table[$m.'score'].' sc,'
		.$table['s_mbrdata'].' mbrdata,'
		.$table['s_mbrid'].' mbrid,'
		.'('.$_join.') sc_j';
	$_where1 = "s_uid = '".$s_uid."'"
		.' AND sc.date_update = sc_j.date_update'
		.' AND sc.st_id = sc_j.st_id'
		.' AND mbrid.uid = mbrdata.memberuid'
		.' AND mbrid.id = sc.st_id';
	$_data1 = '0 AS penalty_require, AVG(penalty_taking) AS penalty_taking, AVG(taking) AS taking, AVG(taking_pt) AS taking_pt, AVG(follow) AS follow, AVG(panorama) AS panorama, 1 AS is_penalty_complete';
	$AVG = getDbData($_table1, $_where1, $_data1);
?>