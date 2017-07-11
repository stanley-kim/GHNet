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
	
	// 한 학번에 대해 여러 개의 데이터가 존재하므로 가장 최근의 데이터만 출력해주도록 JOIN 을 이용하여 query
	// 아래 쿼리는 다음의 커리를 참고
	/*
SELECT 
	sc.*, 
	post + core AS post_core,
	
	endo_score,
	op_score,
	minus_score, 
	endo_score + op_score AS plus_score,
	endo_score + op_score - minus_score AS total_score
	
	FROM 
		(SELECT uid,
			endo_molar_pe * 3 + endo_molar_ce * 3 + endo_molar_cf * 3 + endo_molar_etc * 1
			 + endo_pre_pe * 2 + endo_pre_ce * 2 + endo_pre_cf * 2 + endo_pre_etc * 1
			 + endo_ant_pe * 2 + endo_ant_ce * 2 + endo_ant_cf * 2 + endo_ant_etc * 1 AS endo_score 
		 FROM st43_khusd_st_consv_score) est, 
		(SELECT uid,
		 	indirect_prep_imp * 4 + indirect_setting * 2 + am * 2
		 	 + tooth_colored_simple * 2 + tooth_colored_complex * 3 + tooth_colored_diastema * 6
		 	 + post * 2 + core * 2 + others * 0.5 + surgery * 10 + miscellaneous * 5 AS op_score
		 FROM st43_khusd_st_consv_score) ost, 
		(SELECT mmst.uid,
			endo_molar, endo_pre, endo_ant, endo_etc, 
			IF(indirect_prep_imp < 4,(4 - indirect_prep_imp) * 4,0)
			 + IF(indirect_setting < 4,(4 - indirect_setting) * 2,0)
			 + IF(tooth_colored_simple + tooth_colored_complex + tooth_colored_diastema < 20,(20 - tooth_colored_simple - tooth_colored_complex - tooth_colored_diastema) * 2,0)
			 + IF(tooth_colored_complex < 8,(8 - tooth_colored_complex) * 1,0)
			 + IF(endo_molar + endo_pre + endo_ant < 30,(30 - endo_molar - endo_pre - endo_ant) * 2,0)
			 + IF(endo_molar < 10,(10 - endo_molar) * 1,0)
			 + IF(surgery < 2,(2 - surgery) * 10,0)
			 + IF(miscellaneous < 1,(1 - miscellaneous) * 5,0) AS minus_score 
		 FROM 
			(SELECT uid,endo_molar_pe + endo_molar_ce + endo_molar_cf AS endo_molar FROM st43_khusd_st_consv_score) emt, 
			(SELECT uid,endo_pre_pe + endo_pre_ce + endo_pre_cf AS endo_pre FROM st43_khusd_st_consv_score) ept, 
			(SELECT uid,endo_ant_pe + endo_ant_ce + endo_ant_cf AS endo_ant FROM st43_khusd_st_consv_score) eat, 
			(SELECT uid,endo_molar_etc + endo_pre_etc + endo_ant_etc AS endo_etc FROM st43_khusd_st_consv_score) eet, 
		 	st43_khusd_st_consv_score mmst
 		 WHERE 
 			mmst.uid = emt.uid
			AND mmst.uid = ept.uid
			AND mmst.uid = eat.uid
			AND mmst.uid = eet.uid
		) mst,
		st43_khusd_st_consv_score sc, 
		st43_s_mbrdata mbrdata,
		st43_s_mbrid mbrid,
		(SELECT MAX(date_update) date_update,st_id FROM st43_khusd_st_consv_score GROUP BY st_id) sc_j 
	
	WHERE 
		sc.date_update = sc_j.date_update 
		AND sc.st_id = sc_j.st_id 
		AND mbrid.uid = mbrdata.memberuid 
		AND mbrid.id = sc.st_id
		AND sc.uid = est.uid
		AND sc.uid = ost.uid
		AND sc.uid = mst.uid
	*/
	
	$_score = $d['khusd_st_consv']['score']['obser'];
	
	//////////FOLLOW////////////
	$_data_follow_obs_score = 'fw_t.fol_ind_sc_d + fw_t.fol_endapm_sc_d + fw_t.fol_endm_sc_d + fw_t.fol_sur_sc_d + fw_t.fol_ble_sc_d';
	$_data_follow_plus_score = 'fw_t.fol_ind_sc + fw_t.fol_endapm_sc + fw_t.fol_endm_sc + fw_t.fol_sur_sc + fw_t.fol_ble_sc + fw_t.extra';
	$_data_follow_minus_score = '(if(fw_t.fol_ind_c < '.$d['khusd_st_consv']['require']['follow']['indirect'].', ('.$d['khusd_st_consv']['require']['follow']['indirect'].'-fw_t.fol_ind_c)*'.$d['khusd_st_consv']['penalty']['follow']['indirect'].', 0)'
				.'+ if(fw_t.fol_sur_c < '.$d['khusd_st_consv']['require']['follow']['surgery'].', ('.$d['khusd_st_consv']['require']['follow']['surgery'].'-fw_t.fol_sur_c)*'.$d['khusd_st_consv']['penalty']['follow']['surgery'].', 0))'
				.'+ if(sc.fol_cp < '.$d['khusd_st_consv']['require']['follow']['perio-consv'].', ('.$d['khusd_st_consv']['require']['follow']['perio-consv'].'-sc.fol_cp)*'.$d['khusd_st_consv']['penalty']['follow']['perio-consv'].', 0)';
	//////////FOLLOW////////////
	
	$_data_post_core = 'post + core';
	$_data_plus_score = 'endo_score + op_score + '.$_data_follow_plus_score.' + '.$_data_follow_obs_score;
	$_data_obser_score = $_data_plus_score.' - minus_score - ('.$_data_follow_minus_score.')';
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
			.' AND mmst.uid = eet.uid';

	
	include_once $g['path_module'].'khusd_st_manager/function/debug.php';
	
	//////FOLLOW//////
	$_follow_table = "SELECT fw_stat.*, cn.extra"
			."FROM"
			."(SELECT st_id"
			.", SUM(if(fw.fw_type='ind' AND fw.status!='d', 1, 0)) AS fol_ind"
			.", SUM(if(fw.fw_type='ind' AND fw.status='c', 1, 0)) AS fol_ind_c"
			.", SUM(if(fw.fw_type='ind' AND fw.status!='d', if(fw.step=2, ".$d['khusd_st_consv']['score']['obser']['indirect_prep_imp']."+".$d['khusd_st_consv']['score']['obser']['indirect_setting'].", ".$d['khusd_st_consv']['score']['obser']['indirect_prep_imp']."), 0)) AS fol_ind_sc"
			.", SUM(if(fw.fw_type='ind' AND fw.status='d', if(fw.step=2, ".$d['khusd_st_consv']['score']['obser']['indirect_prep_imp']."+".$d['khusd_st_consv']['score']['obser']['indirect_setting'].", ".$d['khusd_st_consv']['score']['obser']['indirect_prep_imp']."), 0)) AS fol_ind_sc_d"
			.", SUM(if(fw.fw_type='endo-m' AND fw.status!='d', 1, 0)) AS fol_endm"
			.", SUM(if(fw.fw_type='endo-m' AND fw.status!='d', ".$d['khusd_st_consv']['score']['obser']['endo_molar_pe']."*floor(fw.step)+(fw.step-floor(fw.step))*2*".$d['khusd_st_consv']['score']['obser']['endo_molar_etc'].", 0)) AS fol_endm_sc"
			.", SUM(if(fw.fw_type='endo-m' AND fw.status='d', ".$d['khusd_st_consv']['score']['obser']['endo_molar_pe']."*floor(fw.step)+(fw.step-floor(fw.step))*2*".$d['khusd_st_consv']['score']['obser']['endo_molar_etc'].", 0)) AS fol_endm_sc_d"
			.", SUM(if(fw.fw_type='endo-ap' AND fw.status!='d', 1, 0)) AS fol_endapm"
			.", SUM(if(fw.fw_type='endo-ap' AND fw.status!='d', ".$d['khusd_st_consv']['score']['obser']['endo_pre_pe']."*floor(fw.step)+(fw.step-floor(fw.step))*2*".$d['khusd_st_consv']['score']['obser']['endo_pre_etc'].", 0)) AS fol_endapm_sc"
			.", SUM(if(fw.fw_type='endo-ap' AND fw.status='d', ".$d['khusd_st_consv']['score']['obser']['endo_pre_pe']."*floor(fw.step)+(fw.step-floor(fw.step))*2*".$d['khusd_st_consv']['score']['obser']['endo_pre_etc'].", 0)) AS fol_endapm_sc_d"
			.", SUM(if(fw.fw_type='surgery' AND fw.status!='d', 1, 0)) AS fol_sur"
			.", SUM(if(fw.fw_type='surgery' AND fw.status='c', 1, 0)) AS fol_sur_c"
			.", SUM(if(fw.fw_type='surgery' AND fw.status!='d', ".$d['khusd_st_consv']['score']['obser']['surgery'].", 0)) AS fol_sur_sc"
			.", SUM(if(fw.fw_type='surgery' AND fw.status='d', ".$d['khusd_st_consv']['score']['obser']['surgery'].", 0)) AS fol_sur_sc_d"
			.", SUM(if(fw.fw_type='bleach' AND fw.status!='d', 1, 0)) AS fol_ble"
			.", SUM(if(fw.fw_type='bleach' AND fw.status!='d', ".$d['khusd_st_consv']['score']['obser']['bleaching'].", 0)) AS fol_ble_sc"
			.", SUM(if(fw.fw_type='bleach' AND fw.status='d', ".$d['khusd_st_consv']['score']['obser']['bleaching'].", 0)) AS fol_ble_sc_d"
			." FROM kd44_khusd_st_follow_follow AS fw WHERE fw.s_uid='".$SEMESTER_INFO['uid']."' AND fw.department='consv' GROUP BY st_id) AS fw_stat,"
			."(SELECT ind.st_id, SUM(5) as extra"
			." FROM (SELECT st_id, pt_uid, fw_type, misc FROM `kd44_khusd_st_follow_follow` WHERE fw_type='ind' AND status='c') AS ind,"
			."      (SELECT st_id, pt_uid, fw_type, misc FROM `kd44_khusd_st_follow_follow` WHERE (fw_type='endo-ap' OR fw_type='endo-m') AND status='c') AS end"
			." WHERE ind.st_id=end.st_id AND ind.pt_uid=end.pt_uid AND ind.misc=end.misc GROUP BY st_id) AS cn"
			."WHERE"
			." fw_stat.st_id=cn.st_id";
		
	$_data_follow = 'fw_t.fol_ind, fw_t.fol_endapm, fw_t.fol_endm, fw_t.fol_sur, fw_t.fol_ble, '.$_data_follow_plus_score.' AS fol_sc, '.$_data_follow_minus_score.' AS fol_sc_m, (fw_t.fol_ind_sc_d + fw_t.fol_endapm_sc_d + fw_t.fol_endm_sc_d + fw_t.fol_sur_sc_d + fw_t.fol_ble_sc_d) AS fol_sc_obs';
	//////FOLLOW//////
	
	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table[$m.'score'].' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
	$_table = 
		'('.$_table_data_endo_score.') est,'
		.'('.$_table_data_op_score.') ost,'
		.'('.$_table_data_minus_score.') mst,'
		.$table[$m.'score']." sc LEFT JOIN ($_follow_table) fw_t ON sc.st_id=fw_t.st_id, ".$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_join.') sc_j';
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
		.'endo_score, op_score, (minus_score + '.$_data_follow_minus_score.') AS minus_sc, '
		.$_data_post_core.' AS post_core, '
		.$_data_plus_score.' AS plus_score, '
		.$_data_obser_score.' AS obser_score'
		.', ('.$_data_pre_st_am.') AS pre_st_am'
		.', ('.$_data_pre_st_op.') AS pre_st_op'
		.', ('.$_data_pre_st_endo.') AS pre_st_endo'
		.', ('.$_data_pre_st_re_endo.') AS pre_st_re_endo'
		.', ('.$_data_pre_st_inlay_gold.') AS pre_st_inlay_gold'
		.', ('.$_data_pre_st_inlay_resin.') AS pre_st_inlay_resin'
		.', '.$_data_follow;
		
	$_sort = $order_by;
	$_orderby = $order_mode;
	
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
		.', AVG(minus_score + '.$_data_follow_minus_score.') AS minus_sc'
		.', AVG('.$_data_obser_score.') AS obser_score'
		.', SUM('.$_data_pre_st_am.') AS pre_st_am'
		.', SUM('.$_data_pre_st_op.') AS pre_st_op'
		.', SUM('.$_data_pre_st_endo.') AS pre_st_endo'
		.', SUM('.$_data_pre_st_inlay_gold.') AS pre_st_inlay_gold'
		.', SUM('.$_data_pre_st_inlay_resin.') AS pre_st_inlay_resin'
		.', AVG(fol_ind) AS fol_ind'
		.', AVG(fol_endapm) AS fol_endapm'
		.', AVG(fol_endm) AS fol_endm'
		.', AVG(fol_sur) AS fol_sur'
		.', AVG(fol_ble) AS fol_ble'
		.', AVG('.$_data_follow_plus_score.') AS fol_sc'
		.', AVG('.$_data_follow_minus_score.') AS fol_sc_m';
	//__debug_print("%%%%%SELECT $_data FROM $_table WHERE $_where");
	$AVG = getDbData($_table, $_where, $_data);
?>