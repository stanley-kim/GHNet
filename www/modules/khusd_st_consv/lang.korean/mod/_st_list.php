<?php
	include_once $g['path_module'].'khusd_st_manager/function/debug.php';
	
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
	
	$_score = $d['khusd_st_consv']['score']['st'];
	$_score_obser = $d['khusd_st_consv']['score']['obser'];
	
	// st 점수 구하기
	$_data_st_op_num = 
		'st_op_tooth_colored_cervical'
		.' + st_op_tooth_colored_simple'
		.' + st_op_tooth_colored_complex'
		.' + st_op_tooth_colored_diastema'

		.' + st_op_am_simple'
		.' + st_op_am_complex'
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
		
	$_data_st_plus_score = 
		'st_op_score'
		.' + st_endo_2nd_point'
		.' + st_inlay_score'
		.' + st_op_bleaching * '.$_score['st_op_bleaching']
		.' + st_op_others * '.$_score['st_op_others']
		;
		
	$_table_st_minus_score = 
		'SELECT mmst.uid,'
		.'st_op,st_am,'
		.genMinusScoreQuery( 'st_op', $d['khusd_st_consv']['require']['st']['st_op'], $d['khusd_st_consv']['minus']['st']['st_op'])
		.'+ '.genMinusScoreQuery( 'st_am', $d['khusd_st_consv']['require']['st']['st_am'], $d['khusd_st_consv']['minus']['st']['st_am'])
		.'+ '.genMinusScoreQuery( "IF(st_inlay_1_proc = 'inlay_setting', 1, 0) + IF(st_inlay_2_proc = 'inlay_setting', 1, 0)", $d['khusd_st_consv']['require']['st']['st_inlay'], $d['khusd_st_consv']['minus']['st']['st_inlay'])
		//.'+ '.genMinusScoreQuery( "IF(st_endo_2 = '', 0, 1)", $d['khusd_st_consv']['require']['st']['st_endo'], $d['khusd_st_consv']['minus']['st']['st_endo'])
		.'+ '.genMinusScoreQuery( "IF(st_endo_1 = 'cf', 1, 0)", $d['khusd_st_consv']['require']['st']['st_endo'], $d['khusd_st_consv']['minus']['st']['st_endo'])
		.'+ '.genMinusScoreQuery( "IF(st_endo_2 = 'cf', 1, 0)", $d['khusd_st_consv']['require']['st']['st_endo'], $d['khusd_st_consv']['minus']['st']['st_endo'])
		.' AS st_minus_score'
		.' FROM '
			.'(SELECT uid,'.$_data_st_op_num.' AS st_op FROM '.$table[$m.'score'].') opt, '
			.'(SELECT uid,st_op_am_simple + st_op_am_complex AS st_am FROM '.$table[$m.'score'].') amt, '
		 	.$table[$m.'score'].' mmst'
 		 .' WHERE '
 			.'mmst.uid = opt.uid'
			.' AND mmst.uid = amt.uid';
			//echo $_table_st_minus_score;
			
	$_table_data_st_op_score = 
		'SELECT uid,'
		.' + st_op_tooth_colored_cervical * '.$_score['st_op_simple']
		.' + st_op_tooth_colored_simple * '.$_score['st_op_simple']
		.' + st_op_tooth_colored_complex * '.$_score['st_op_complex']
		.' + st_op_tooth_colored_diastema * '.$_score['st_op_diastema']

		.' + st_op_am_simple * '.$_score['st_op_simple']
		.' + st_op_am_complex * '.$_score['st_op_complex']
		
		.' AS st_op_score'
		.' FROM '.$table[$m.'score'];
		
	$_table_data_st_inlay_score = 
		'SELECT uid,'
		.' + (('.$_data_st_inlay_setting.') * '.$_score['st_inlay'].')'

		.' AS st_inlay_score'
		.' FROM '.$table[$m.'score'];
	
	$_data_st_score = 
		'IF(('.$_data_st_plus_score .') - ( st_minus_score ) >= '.$d['khusd_st_consv']['score']['max']['st'].', '.$d['khusd_st_consv']['score']['max']['st'].', ('.$_data_st_plus_score .') - ( st_minus_score ))';
		
	// 합계 점수	
	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table[$m.'score'].' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
	$_table = 
		'('.$_table_data_st_op_score.') sos,'
		.'('.$_table_data_st_inlay_score.') ist,'
		.'('.$_table_st_minus_score.') msstt,'
		.$table[$m.'score']." sc, ".$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_join.') sc_j';

	$_where = 
		's_uid = '.$s_uid
		.' AND sc.date_update = sc_j.date_update'
		.' AND sc.st_id = sc_j.st_id'
		.' AND mbrid.uid = mbrdata.memberuid'
		.' AND mbrid.id = sc.st_id'
		.' AND sc.uid = sos.uid'
//		.' AND sc.uid = est.uid'
//		.' AND sc.uid = ost.uid'
		.' AND sc.uid = ist.uid'
//		.' AND sc.uid = mst.uid'
		.' AND sc.uid = msstt.uid';
	$_data = 'sc.*'
		.', st_op_score, st_minus_score, st_inlay_score'
//		.', endo_score, op_score, (minus_score) AS minus_sc'
		.', ('.$_data_st_score.') AS st_score'
//		.', ('.$_data_plus_score.') AS plus_score'
		.', ('.$_data_st_op_num.') AS st_op_num'
		.', ('.$_data_st_inlay_prep.') AS st_inlay_prep'
		.', ('.$_data_st_inlay_setting.') AS st_inlay_setting'
		.', ('.$_data_st_plus_score.') AS st_plus_score';
	$_sort = $order_by;
	$_orderby = $order_mode;
	
	
	//echo "SELECT $_data FROM $_table WHERE $_where";
	__debug_print("!!!!!!!!!!SELECT $_data FROM $_table WHERE $_where");
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
	$_data = 
		'AVG(st_endo_2nd_point) AS st_endo_2nd_point'
		.', AVG(st_op_am_simple) AS st_op_am_simple'
		.', AVG(st_op_am_complex) AS st_op_am_complex'
		.', AVG(st_op_tooth_colored_cervical) AS st_op_tooth_colored_cervical'
		.', AVG(st_op_tooth_colored_simple) AS st_op_tooth_colored_simple'
		.', AVG(st_op_tooth_colored_complex) AS st_op_tooth_colored_complex'
		.', AVG(st_op_tooth_colored_diastema) AS st_op_tooth_colored_diastema'
		.', AVG(st_op_bleaching) AS st_op_bleaching'
		.', AVG(st_op_others) AS st_op_others'
		.', AVG(st_op_score) AS st_op_score'
		.', AVG('.$_data_st_op_num.') AS st_op_num'
		.', AVG('.$_data_st_inlay_prep.') AS st_inlay_prep'
		.', AVG('.$_data_st_inlay_setting.') AS st_inlay_setting'
		.', AVG('.$_data_st_plus_score.') AS st_plus_score'
		.', AVG(st_minus_score) AS st_minus_score'
		.', AVG('.$_data_st_score.') AS st_score';
	$AVG = getDbData($_table, $_where, $_data);
?>