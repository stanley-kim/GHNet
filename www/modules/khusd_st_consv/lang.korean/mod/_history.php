<?php
	$SCORE_ARRAY = array();

	if(!isset($st_id) || !$st_id || $st_id == '')
	{
		$st_id = $my['id'];
	}

	if(!$MANAGER && $st_id != $my['id'])
	{
		getLink('', '', '타인에 대한 조회에 대한 권한이 없습니다.'.$st_id, '');
	}

	$order_by = 'date_update';
	$order_mode = 'DESC';
	$recnum = $recnum && $recnum < 200 ? $recnum : $d['khusd_st_manager']['history_recnum'];

	// 쿼리는 list 모드일 때의 쿼리 참고.. .이 변수들을 합치면 좋겠음....
	
	$_score = $d['khusd_st_consv']['score']['obser'];
	
	$_data_post_core = 'post + core';
	$_data_plus_score = 'endo_score + op_score';
	$_data_obser_score = 'endo_score + op_score - minus_score';
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

//		.genMinusScoreQuery( 'indirect_prep_imp', $d['khusd_st_consv']['require']['obser']['indirect_prep_imp'], $d['khusd_st_consv']['minus']['obser']['indirect_prep_imp'])
//		.'+ '.genMinusScoreQuery( 'indirect_setting', $d['khusd_st_consv']['require']['obser']['indirect_setting'], $d['khusd_st_consv']['minus']['obser']['indirect_setting'])
//		.'+ '.genMinusScoreQuery( 'tooth_colored_simple + tooth_colored_complex + tooth_colored_diastema', 
//					$d['khusd_st_consv']['require']['obser']['tooth_colored'], $d['khusd_st_consv']['minus']['obser']['tooth_colored'])
//		.'+ '.genMinusScoreQuery( 'tooth_colored_complex', 
//					$d['khusd_st_consv']['require']['obser']['tooth_colored_complex'], $d['khusd_st_consv']['minus']['obser']['tooth_colored_complex'])
//		.'+ '.genMinusScoreQuery( 'endo_molar + endo_pre + endo_ant', $d['khusd_st_consv']['require']['obser']['endo'], $d['khusd_st_consv']['minus']['obser']['endo'])
//		.'+ '.genMinusScoreQuery( 'endo_molar', $d['khusd_st_consv']['require']['obser']['endo_molar'], $d['khusd_st_consv']['minus']['obser']['endo_molar'])
//		.'+ '.genMinusScoreQuery( 'surgery', $d['khusd_st_consv']['require']['obser']['surgery'], $d['khusd_st_consv']['minus']['obser']['surgery'])
//		.'+ '.genMinusScoreQuery( 'miscellaneous', $d['khusd_st_consv']['require']['obser']['miscellaneous'], $d['khusd_st_consv']['minus']['obser']['miscellaneous'])
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

	
	$_table = 
		'('.$_table_data_endo_score.') est,'
		.'('.$_table_data_op_score.') ost,'
		.'('.$_table_data_minus_score.') mst,'
		.$table[$m.'score'].' sc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
	$_where = 
		"s_uid = '".$s_uid."'"
		." AND mbrid.uid = mbrdata.memberuid"
		." AND mbrid.id = sc.st_id"
		." AND sc.st_id = '".$st_id."'"
		.' AND sc.uid = est.uid'
		.' AND sc.uid = ost.uid'
		.' AND sc.uid = mst.uid';
	$_data = 'sc.*, '
		.'endo_molar, endo_pre, endo_ant, endo_etc, '
		.'endo_score, op_score, minus_score,'
		.$_data_post_core.' AS post_core, '
		.$_data_plus_score.' AS plus_score, '
		.$_data_obser_score.' AS obser_score'
		.', ('.$_data_pre_st_am.') AS pre_st_am'
		.', ('.$_data_pre_st_op.') AS pre_st_op'
		.', ('.$_data_pre_st_endo.') AS pre_st_endo'
		.', ('.$_data_pre_st_re_endo.') AS pre_st_re_endo'
		.', ('.$_data_pre_st_inlay_gold.') AS pre_st_inlay_gold'
		.', ('.$_data_pre_st_inlay_resin.') AS pre_st_inlay_resin';

	$_sort = $order_by;
	$_orderby = $order_mode;
	
	$SCORE_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, $recnum, $p);
	
	// getDbArray 는 mysql_query 의 리턴값을 리턴하므로, fetch 해줘야 한다
	$idx = 0;
	while( $_ROW = db_fetch_array($SCORE_ROWS) ) $SCORE_ARRAY[$idx++] = $_ROW;
	
	foreach($SCORE_ARRAY as $idx => $SCORE_TMP) {
		$st_id = $SCORE_TMP['st_id'];

		$stid_array = getDbData($table['s_mbrid'],"id='".$st_id."'", '*');
		$stdata_array = getDbData($table['s_mbrdata'], "memberuid='".$stid_array['uid']."'", '*');

		$st_array = array_merge($stid_array, $stdata_array);
		
		$SCORE_ARRAY[$idx]['st_info'] = $st_array;
	}
	
	$NUM = getDbRows($table[$m.'score'], "st_id='".$st_id."'");
	$TPG = getTotalPage($NUM, $recnum);
?>
