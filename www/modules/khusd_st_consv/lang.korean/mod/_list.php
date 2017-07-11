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
	
	$_score = $d['khusd_st_consv']['score']['obser'];
	
	$_data_post_core = 'post + core';
	$_data_plus_score = 'endo_score + op_score';
	$_data_obser_score = $_data_plus_score.' - minus_score ';
	$_data_pre_st_am = 'IF( pre_st_am >= 2, 1, 0)';
	$_data_pre_st_op = 'IF( pre_st_ant >= 4 AND pre_st_post >= 5 AND pre_st_cervical >= 7, 1, 0)';
	$_data_pre_st_endo = 'IF('
		.'pre_st_ant_pe >= 1 AND pre_st_ant_ce >= 1 AND pre_st_ant_cf >= 1'
		.' AND pre_st_pre_pe >= 1 AND pre_st_pre_ce >= 1 AND pre_st_pre_cf >= 1'
		.', 1, 0)';
	$_data_pre_st_re_endo = 'IF('
		.'pre_st_ant_re_rm >= 1 AND pre_st_ant_re_ce >= 1 AND pre_st_ant_re_cf >= 1'
		.' AND pre_st_pre_re_rm >= 1 AND pre_st_pre_re_ce >= 1 AND pre_st_pre_re_cf >= 1'
		.', 1, 0)';
	$_data_pre_st_inlay_gold = 'IF('
		.'pre_st_inlay_gold_prep >= 1 AND pre_st_inlay_gold_setting >= 1'
		.', 1, 0)';
	$_data_pre_st_inlay_resin = 'IF('
		.'pre_st_inlay_resin_prep >= 1 AND pre_st_inlay_resin_setting >= 1'
		.', 1, 0)';

	$_table_data_endo_score = 
		'SELECT uid,'
		.'endo_molar_pe * '.$_score['endo_molar_pe'].' + endo_molar_ce * '.$_score['endo_molar_ce']
		.' + endo_molar_cf * '.$_score['endo_molar_cf'].' + endo_molar_etc * '.$_score['endo_molar_etc']
		.' + endo_pre_pe * '.$_score['endo_pre_pe'].' + endo_pre_ce * '.$_score['endo_pre_ce']
		.' + endo_pre_cf * '.$_score['endo_pre_cf'].' + endo_pre_etc * '.$_score['endo_pre_etc']
		.' + endo_ant_pe * '.$_score['endo_ant_pe'].' + endo_ant_ce * '.$_score['endo_ant_ce']
		.' + endo_ant_cf * '.$_score['endo_ant_cf'].' + endo_ant_etc * '.$_score['endo_ant_etc']
		.' AS endo_score'
		.' FROM '.$table[$m.'score'];
	$_table_data_op_score = 
		'SELECT uid,'
		.'indirect_prep_imp * '.$_score['indirect_prep_imp'].' + indirect_setting * '.$_score['indirect_setting'].' + am * '.$_score['am']
		.' + tooth_colored_simple * '.$_score['tooth_colored_simple']
		.' + tooth_colored_complex * '.$_score['tooth_colored_complex']
		.' + tooth_colored_diastema * '.$_score['tooth_colored_diastema']
		.' + post * '.$_score['post'].' + core * '.$_score['core']
		.' + others * '.$_score['others'].' + surgery * '.$_score['surgery'].' + miscellaneous * '.$_score['miscellaneous']
		.' AS op_score'
		.' FROM '.$table[$m.'score'];
		
/*
	$_table_data_minus_score = 
		'SELECT mmst.uid,'
		.'endo_molar, endo_pre, endo_ant, endo_etc,'
		.genMinusScoreQuery( 'indirect_prep_imp', $d['khusd_st_consv']['require']['obser']['indirect_prep_imp'], $d['khusd_st_consv']['minus']['obser']['indirect_prep_imp'])
		.'+ '.genMinusScoreQuery( 'indirect_setting', $d['khusd_st_consv']['require']['obser']['indirect_setting'], $d['khusd_st_consv']['minus']['obser']['indirect_setting'])
		.'+ '.genMinusScoreQuery( 'tooth_colored_simple + tooth_colored_complex + tooth_colored_diastema', 
					$d['khusd_st_consv']['require']['obser']['tooth_colored'], $d['khusd_st_consv']['minus']['obser']['tooth_colored'])
		.'+ '.genMinusScoreQuery( 'tooth_colored_complex', 
					$d['khusd_st_consv']['require']['obser']['tooth_colored_complex'], $d['khusd_st_consv']['minus']['obser']['tooth_colored_complex'])
		.'+ '.genMinusScoreQuery( 'endo_molar + endo_pre + endo_ant', $d['khusd_st_consv']['require']['obser']['endo'], $d['khusd_st_consv']['minus']['obser']['endo'])
		.'+ '.genMinusScoreQuery( 'endo_molar', $d['khusd_st_consv']['require']['obser']['endo_molar'], $d['khusd_st_consv']['minus']['obser']['endo_molar'])
		.'+ '.genMinusScoreQuery( 'surgery', $d['khusd_st_consv']['require']['obser']['surgery'], $d['khusd_st_consv']['minus']['obser']['surgery'])
		.'+ '.genMinusScoreQuery( 'miscellaneous', $d['khusd_st_consv']['require']['obser']['miscellaneous'], $d['khusd_st_consv']['minus']['obser']['miscellaneous'])
		.' AS minus_score'
		.' FROM '
			.'(SELECT uid,endo_molar_pe + endo_molar_ce + endo_molar_cf AS endo_molar FROM '.$table[$m.'score'].') emt, '
			.'(SELECT uid,endo_pre_pe + endo_pre_ce + endo_pre_cf AS endo_pre FROM '.$table[$m.'score'].') ept, '
			.'(SELECT uid,endo_ant_pe + endo_ant_ce + endo_ant_cf AS endo_ant FROM '.$table[$m.'score'].') eat, '
			.'(SELECT uid,endo_molar_etc + endo_pre_etc + endo_ant_etc AS endo_etc FROM '.$table[$m.'score'].') eet, '
		 	.$table[$m.'score'].' mmst'
 		 .' WHERE '
 			.'mmst.uid = emt.uid'
			.' AND mmst.uid = ept.uid'
			.' AND mmst.uid = eat.uid'
			.' AND mmst.uid = eet.uid';*/
			
	$_table_data_minus_score = 
		'SELECT mmst.uid,'
		.'endo_molar, endo_pre, endo_ant, endo_etc,'
		.genMinusScoreQuery( 'indirect_prep_imp', $d['khusd_st_consv']['require']['obser']['indirect_prep_imp'], $d['khusd_st_consv']['score']['obser']['indirect_prep_imp'])
		.'+ '.genMinusScoreQuery( 'indirect_setting', $d['khusd_st_consv']['require']['obser']['indirect_setting'], $d['khusd_st_consv']['score']['obser']['indirect_setting'])
		.'+ '.genMinusScoreQuery( 'tooth_colored_simple + tooth_colored_complex + tooth_colored_diastema', 
					$d['khusd_st_consv']['require']['obser']['tooth_colored'], $d['khusd_st_consv']['score']['obser']['tooth_colored_simple'])
		.'+ '.genMinusScoreQuery( 'tooth_colored_complex', 
					$d['khusd_st_consv']['require']['obser']['tooth_colored_complex'], $d['khusd_st_consv']['score']['obser']['tooth_colored_complex'] - $d['khusd_st_consv']['score']['obser']['tooth_colored_simple'])
		.'+ '.genMinusScoreQuery( 'endo_molar + endo_pre + endo_ant', $d['khusd_st_consv']['require']['obser']['endo'], $d['khusd_st_consv']['score']['obser']['endo_pre_pe'])
		.'+ '.genMinusScoreQuery( 'endo_molar', $d['khusd_st_consv']['require']['obser']['endo_molar'], $d['khusd_st_consv']['score']['obser']['endo_molar_pe'] - $d['khusd_st_consv']['score']['obser']['endo_pre_pe'])
		.'+ '.genMinusScoreQuery( 'surgery', $d['khusd_st_consv']['require']['obser']['surgery'], $d['khusd_st_consv']['score']['obser']['surgery'])
		.'+ '.genMinusScoreQuery( 'miscellaneous', $d['khusd_st_consv']['require']['obser']['miscellaneous'], $d['khusd_st_consv']['score']['obser']['miscellaneous'])
		.' AS minus_score'
		.' FROM '
			.'(SELECT uid,endo_molar_pe + endo_molar_ce + endo_molar_cf AS endo_molar FROM '.$table[$m.'score'].') emt, '
			.'(SELECT uid,endo_pre_pe + endo_pre_ce + endo_pre_cf AS endo_pre FROM '.$table[$m.'score'].') ept, '
			.'(SELECT uid,endo_ant_pe + endo_ant_ce + endo_ant_cf AS endo_ant FROM '.$table[$m.'score'].') eat, '
			.'(SELECT uid,endo_molar_etc + endo_pre_etc + endo_ant_etc AS endo_etc FROM '.$table[$m.'score'].') eet, '
		 	.$table[$m.'score'].' mmst'
 		 .' WHERE '
 			.'mmst.uid = emt.uid'
			.' AND mmst.uid = ept.uid'
			.' AND mmst.uid = eat.uid'
			.' AND mmst.uid = eet.uid';

	
	//include_once $g['path_module'].'khusd_st_manager/function/debug.php';
	
	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table[$m.'score'].' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
	$_table = 
		'('.$_table_data_endo_score.') est,'
		.'('.$_table_data_op_score.') ost,'
		.'('.$_table_data_minus_score.') mst,'
		.$table[$m.'score']." sc, ".$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_join.') sc_j';
	$_where = 
		's_uid = '.$s_uid
		.' AND sc.date_update = sc_j.date_update'
		.' AND sc.st_id = sc_j.st_id'
		.' AND mbrid.uid = mbrdata.memberuid'
		.' AND mbrid.id = sc.st_id'
		.' AND sc.uid = est.uid'
		.' AND sc.uid = ost.uid'
		.' AND sc.uid = mst.uid';
	$_data = 'sc.*, '
		.'endo_molar, endo_pre, endo_ant, endo_etc, '
		.'endo_score, op_score, minus_score AS minus_sc, '
		.$_data_post_core.' AS post_core, '
		.$_data_plus_score.' AS plus_score, '
		.$_data_obser_score.' AS obser_score'
		.', ('.$_data_pre_st_am.') AS pre_st_am'
		.', ('.$_data_pre_st_op.') AS pre_st_op'
		.', ('.$_data_pre_st_endo.') AS pre_st_endo'
		.', ('.$_data_pre_st_re_endo.') AS pre_st_re_endo'
		.', ('.$_data_pre_st_inlay_gold.') AS pre_st_inlay_gold'
		.', ('.$_data_pre_st_inlay_resin.') AS pre_st_inlay_resin';
//		.', '.$_data_follow;
		
	$_sort = $order_by;
	$_orderby = $order_mode;
	
	//echo "SELECT $_data FROM $_table WHERE $_where";
	//__debug_print("!!!!!!!!!!SELECT $_data FROM $_table WHERE $_where");
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
	$_data = 'AVG(endo_molar) AS endo_molar, AVG(endo_pre) AS endo_pre, AVG(endo_ant) AS endo_ant'
		.', AVG(endo_etc) AS endo_etc, AVG(endo_score) AS endo_score'
		.', AVG(indirect_prep_imp) AS indirect_prep_imp'
		.', AVG(indirect_setting) AS indirect_setting'
		.', AVG(am) AS am'
		.', AVG(tooth_colored_simple) AS tooth_colored_simple'
		.', AVG(tooth_colored_complex) AS tooth_colored_complex'
		.', AVG(tooth_colored_diastema) AS tooth_colored_diastema'
		.', AVG('.$_data_post_core.') AS post_core'
		.', AVG(others) AS others'
		.', AVG(surgery) AS surgery'
		.', AVG(miscellaneous) AS miscellaneous'
		.', AVG(op_score) AS op_score'
		.', AVG('.$_data_plus_score.') AS plus_score'
		.', AVG(minus_score) AS minus_sc'
		.', AVG('.$_data_obser_score.') AS obser_score'
		.', SUM('.$_data_pre_st_am.') AS pre_st_am'
		.', SUM('.$_data_pre_st_op.') AS pre_st_op'
		.', SUM('.$_data_pre_st_endo.') AS pre_st_endo'
		.', SUM('.$_data_pre_st_inlay_gold.') AS pre_st_inlay_gold'
		.', SUM('.$_data_pre_st_inlay_resin.') AS pre_st_inlay_resin';
	
	//echo $_table_data_minus_score;
	//__debug_print("%%%%%SELECT $_data FROM $_table WHERE $_where");
	$AVG = getDbData($_table, $_where, $_data);
?>