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
		st43_khusd_st_pros_score sc, 
		st43_s_mbrdata mbrdata,
		st43_s_mbrid mbrid,
		(SELECT MAX(date_update) date_update,st_id FROM st43_khusd_st_pros_score GROUP BY st_id) sc_j 
	where 	sc.date_update = sc_j.date_update 
		AND sc.st_id = sc_j.st_id 
		AND mbrid.uid = mbrdata.memberuid 
		AND mbrid.id = sc.st_id 
	order by sc.follow DESC
	*/
        $_data_total_simple_obser = 'sc.simple_obser_3_8 + sc.simple_obser_3_10 + sc.simple_obser_3_12' ;
	
	$_data_total_score = 
		'sc.post_core_complete * '.$d['khusd_st_pros']['score']['post_core']
		.'+ sc.imp_cr_br_complete * '.$d['khusd_st_pros']['score']['imp_cr_br']
		.'+ (sc.second_cr_complete + sc.single_cr_complete) * '.$d['khusd_st_pros']['score']['single_cr']
		.'+ sc.br_complete * '.$d['khusd_st_pros']['score']['br']
		.'+ sc.partial_denture_complete * '.$d['khusd_st_pros']['score']['partial_denture']
		.'+ sc.complete_denture_complete * '.$d['khusd_st_pros']['score']['complete_denture']
		.'+ sc.others_complete * '.$d['khusd_st_pros']['score']['others'];
	
	$_data_total_predict_score = 
		'sc.post_core_complete * '.$d['khusd_st_pros']['score']['post_core']
		.'+ sc.imp_cr_br_complete * '.$d['khusd_st_pros']['score']['imp_cr_br']
		.'+ (sc.second_cr_complete + sc.single_cr_complete) * '.$d['khusd_st_pros']['score']['single_cr']
		.'+ sc.br_complete * '.$d['khusd_st_pros']['score']['br']
		.'+ sc.partial_denture_complete * '.$d['khusd_st_pros']['score']['partial_denture']
		.'+ sc.complete_denture_complete * '.$d['khusd_st_pros']['score']['complete_denture']
		.'+ sc.others_complete * '.$d['khusd_st_pros']['score']['others']
		
		.'+ sc.post_core_ongoing * '.$d['khusd_st_pros']['score']['post_core']
		.'+ sc.imp_cr_br_ongoing * '.$d['khusd_st_pros']['score']['imp_cr_br']
		.'+ (sc.second_cr_ongoing + sc.single_cr_ongoing) * '.$d['khusd_st_pros']['score']['single_cr']
		.'+ sc.br_ongoing * '.$d['khusd_st_pros']['score']['br']
		.'+ sc.partial_denture_ongoing * '.$d['khusd_st_pros']['score']['partial_denture']
		.'+ sc.complete_denture_ongoing * '.$d['khusd_st_pros']['score']['complete_denture']
		.'+ sc.others_ongoing * '.$d['khusd_st_pros']['score']['others'];
	$_data_second_cr = 'sc.second_cr_complete + sc.second_cr_ongoing';
	$_data_post_core = 'sc.post_core_complete + sc.post_core_ongoing';
	$_data_imp_cr_br = 'sc.imp_cr_br_complete + sc.imp_cr_br_ongoing';
	$_data_single_cr = 'sc.single_cr_complete + sc.single_cr_ongoing';
	$_data_br = 'sc.br_complete + sc.br_ongoing';
	$_data_partial_denture = 'sc.partial_denture_complete + sc.partial_denture_ongoing';
	$_data_complete_denture = 'sc.complete_denture_complete + sc.complete_denture_ongoing';
	$_data_others = 'sc.others_complete + sc.others_ongoing';
	
	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table[$m.'score'].' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
	$_table = $table[$m.'score'].' sc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_join.') sc_j';
	$_where = 
		"s_uid = '".$s_uid."'"
		.' AND sc.date_update = sc_j.date_update AND sc.st_id = sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = sc.st_id';
	$_data = 
		'sc.*'
		.', '.$_data_second_cr.' AS second_cr'
		.', '.$_data_post_core.' AS post_core'
		.', '.$_data_imp_cr_br.' AS imp_cr_br'
		.', '.$_data_single_cr.' AS single_cr'
		.', '.$_data_br.' AS br'
		.', '.$_data_partial_denture.' AS partial_denture'
		.', '.$_data_complete_denture.' AS complete_denture'
		.', '.$_data_others.' AS others'
		.', '.$_data_total_simple_obser.' AS total_simple_obser'
		.', '.$_data_total_score.' AS total_score'
		.', '.$_data_total_predict_score.' AS total_predict_score';
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
		
		
		$prevs = array('post_core', 'imp_cr_br', 'single_cr' , 'br', 'partial_denture', 'complete_denture');
		
		foreach($prevs as $prev){
			$SCORE_ARRAY[$st_id][$prev.'_prev'] = $SCORE_ARRAY[$st_id][$prev.'_prev'] - $d['khusd_st_pros']['require'][$prev];
			$SCORE_ARRAY[$st_id][$prev] += $SCORE_ARRAY[$st_id][$prev.'_prev']; 
		}
	}

	// 평균 구하기
	$_data = 'AVG(second_cr_ongoing) AS second_cr_ongoing'
			.', AVG(second_cr_complete) AS second_cr_complete'
			.', AVG(second_cr_cancel) AS second_cr_cancel'
			.', AVG(post_core_ongoing) AS post_core_ongoing'
			.', AVG(post_core_complete) AS post_core_complete'
			.', AVG(post_core_cancel) AS post_core_cancel'
			.', AVG(imp_cr_br_ongoing) AS imp_cr_br_ongoing'
			.', AVG(imp_cr_br_complete) AS imp_cr_br_complete'
			.', AVG(imp_cr_br_cancel) AS imp_cr_br_cancel'
			.', AVG(single_cr_ongoing) AS single_cr_ongoing'
			.', AVG(single_cr_complete) AS single_cr_complete'
			.', AVG(single_cr_cancel) AS single_cr_cancel'
			.', AVG(br_ongoing) AS br_ongoing'
			.', AVG(br_complete) AS br_complete'
			.', AVG(br_cancel) AS br_cancel'
			.', AVG(partial_denture_ongoing) AS partial_denture_ongoing'
			.', AVG(partial_denture_complete) AS partial_denture_complete'
			.', AVG(partial_denture_cancel) AS partial_denture_cancel'
			.', AVG(complete_denture_ongoing) AS complete_denture_ongoing'
			.', AVG(complete_denture_complete) AS complete_denture_complete'
			.', AVG(complete_denture_cancel) AS complete_denture_cancel'
			.', AVG(others_ongoing) AS others_ongoing'
			.', AVG(others_complete) AS others_complete'
			.', AVG(others_cancel) AS others_cancel'
			.', AVG(simple_obser_3_8) AS simple_obser_3_8'
			.', AVG(simple_obser_3_10) AS simple_obser_3_10'
			.', AVG(simple_obser_3_12) AS simple_obser_3_12'

			.', AVG('.$_data_second_cr.') AS second_cr'
			.', AVG('.$_data_post_core.') AS post_core'
			.', AVG('.$_data_imp_cr_br.') AS imp_cr_br'
			.', AVG('.$_data_single_cr.') AS single_cr'
			.', AVG('.$_data_br.') AS br'
			.', AVG('.$_data_partial_denture.') AS partial_denture'
			.', AVG('.$_data_complete_denture.') AS complete_denture'
			.', AVG('.$_data_others.') AS others'

			.', AVG('.$_data_total_score.') AS total_score'
			.', AVG('.$_data_total_simple_obser.') AS total_simple_obser'
			.', AVG('.$_data_total_predict_score.') AS total_predict_score';
	$AVG = getDbData($_table, $_where, $_data);
?>
