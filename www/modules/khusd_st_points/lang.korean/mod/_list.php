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

	/*	
   casebook = $data[charting]*0.2+$data[dressing]*0.1+$data[simple_ext]*0.2+$data[surgical_ext]*0.4;
   총점 = $data[minor_sur_simp]*1+$data[major_surgery]*0+$data[st_assist]*0;
*/
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
		st43_khusd_st_oms_score sc, 
		st43_s_mbrdata mbrdata,
		st43_s_mbrid mbrid,
		(SELECT MAX(date_update) date_update,st_id FROM st43_khusd_st_oms_score GROUP BY st_id) sc_j 
	where 	sc.date_update = sc_j.date_update 
		AND sc.st_id = sc_j.st_id 
		AND mbrid.uid = mbrdata.memberuid 
		AND mbrid.id = sc.st_id 
	order by sc.follow DESC
	*/
	
	$_data_total_imp = 'sc.imp_1st + sc.imp_2nd';
	$_data_ob_score = 
		'sc.charting * '.$d['khusd_st_oms']['score']['charting']
		.'+ sc.dressing * '.$d['khusd_st_oms']['score']['dressing']
		.'+ sc.simple_ext * '.$d['khusd_st_oms']['score']['simple_ext']
		.'+ sc.surgical_ext * '.$d['khusd_st_oms']['score']['surgical_ext']
		.'+ sc.minor * '.$d['khusd_st_oms']['score']['minor'];
	
	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table[$m.'score'].' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
	$_table = $table[$m.'score'].' sc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_join.') sc_j';
	$_where = 
		"s_uid = '".$s_uid."'"
		.' AND sc.date_update = sc_j.date_update AND sc.st_id = sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = sc.st_id';
	$_data = 'sc.*'
		.', '.$_data_total_imp.' AS total_imp'
		.', '.$_data_ob_score.' AS ob_score';
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
	$_data = 'AVG(charting) AS charting, AVG(dressing) AS dressing, AVG(cp) AS cp, AVG(simple_ext) AS simple_ext, AVG(surgical_ext) AS surgical_ext,'
			.' AVG(minor) AS minor, AVG(major) AS major, AVG(st_case) AS st_case, AVG(st_assist) AS st_assist, AVG(imp_1st) AS imp_1st, AVG(imp_2nd) AS imp_2nd'
			.', AVG('.$_data_total_imp.') AS total_imp'
			.', AVG('.$_data_ob_score.') AS ob_score';
	$AVG = getDbData($_table, $_where, $_data);
?>