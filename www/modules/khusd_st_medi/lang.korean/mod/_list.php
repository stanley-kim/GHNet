<?php
	$SCORE_ARRAY = array();

	// 정렬 순서에 대한 옵션 처리
	//if($MANAGER == false && $order)
	if($MANAGER == false )
	{
		// 정렬은 관리권한 있는 사용자만 가능
		getLink('','', '각 과의 연락담당과 총대만 정렬 가능합니다.','');
	}
	$order_by = $order ? $order : 'st_id';
	$order_mode = ASC;
	if($om == 'a') $order_mode = ASC;
	else if($om == 'd') $order_mode = DESC;

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
		st43_khusd_st_medi_score sc, 
		st43_s_mbrdata mbrdata,
		st43_s_mbrid mbrid,
		(SELECT MAX(date_update) date_update,st_id FROM st43_khusd_st_medi_score GROUP BY st_id) sc_j 
	where 	sc.date_update = sc_j.date_update 
		AND sc.st_id = sc_j.st_id 
		AND mbrid.uid = mbrdata.memberuid 
		AND mbrid.id = sc.st_id 
	order by sc.follow DESC
	*/

	$physical_tx_total = '(infra_tx + ultra_tx + east_tx + tens_tx + ionto_tx + tmd_tx + soft_tx)';
	
	$_data_fix = 'fix_am + fix_pm';
	$_data_total_score = 
		'charting * '. $d['khusd_st_medi']['score']['charting']
		.' + soft_charting * '. $d['khusd_st_medi']['score']['soft_charting']
		.' + obser * '. $d['khusd_st_medi']['score']['obser']
		.' + charting_obser * '. $d['khusd_st_medi']['score']['obser']
		.' + splint_impression * '. $d['khusd_st_medi']['score']['splint_impression']
		.' + splint_polishing * '. $d['khusd_st_medi']['score']['splint_polishing']
		.' + splint_adjust * '. $d['khusd_st_medi']['score']['splint_adjust']
		.' + physical_tx * '. $d['khusd_st_medi']['score']['physical_tx']
		.' + odor * '. $d['khusd_st_medi']['score']['odor']
		.' + m_text * '. $d['khusd_st_medi']['score']['m_text']
		.' + (fix_am + fix_pm) * '. $d['khusd_st_medi']['score']['fix']
		.' + '.$physical_tx_total.' * '. $d['khusd_st_medi']['score']['physical_tx'];
	
	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table[$m.'score'].' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
	$_table = $table[$m.'score'].' sc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_join.') sc_j';
	$_where = 
		"s_uid = '".$s_uid."'"
		.' AND sc.date_update = sc_j.date_update AND sc.st_id = sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = sc.st_id';
	$_data = 'sc.*, '.$physical_tx_total.' AS physical_total, '.$_data_fix.' AS fix, '.$_data_total_score.' AS total_score';
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
	$_data = 'AVG(charting_obser) AS charting_obser, AVG(charting_tmd_1cycle_charting) AS charting_tmd_1cycle_charting, AVG(charting_soft_charting) AS charting_soft_charting, AVG(obser) AS obser, AVG(splint_obser) AS splint_obser, '
			.' AVG(physical_tx) AS physical_tx, AVG(soft_tx) AS soft_tx, AVG(odor) AS odor, AVG(m_text) AS m_text, AVG(fix_am) AS fix_am, AVG(fix_pm) AS fix_pm, AVG(splint_impression) as splint_impression, AVG(splint_polishing) AS splint_polishing,'
			//.' AVG(physical_tx) AS physical_tx, AVG(soft_tx) AS soft_tx, AVG(odor) AS odor, AVG(m_text) AS m_text, AVG(fix_am) AS fix_am, AVG(fix_pm) AS fix_pm,'
			.' AVG('.$_data_fix.') AS fix,'
			.' AVG('.$_data_total_score.') AS total_score';
	$AVG = getDbData($_table, $_where, $_data);
?>
