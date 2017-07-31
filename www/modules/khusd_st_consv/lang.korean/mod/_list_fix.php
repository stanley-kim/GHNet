<?php
	$SCORE_ARRAY = array();

	// 정렬 순서에 대한 옵션 처리
	//if($MANAGER == false && $order)
	if($MANAGER == false)
	{
		// 정렬은 관리권한 있는 사용자만 가능
		getLink('','', '각 과의 연락담당과 총대만 정렬 가능합니다.','');
	}
	$order_by = $order ? $order : 'st_id';
	$order_mode = ASC;
	if($om == 'a') $order_mode = ASC;
	else if($om == 'd') $order_mode = DESC;
	
    
	$_score = $d['khusd_st_consv']['score']['obser'];
	
	$_data_post_core = 'f_post + f_core';
	$_data_plus_score = 'endo_score + op_score';
	$_data_obser_score = $_data_plus_score;

	$_table_data_endo_score = 
		'SELECT uid,'
		.'f_endo_molar_pe * '.$_score['endo_molar_pe'].' + f_endo_molar_ce * '.$_score['endo_molar_ce']
		.' + f_endo_molar_cf * '.$_score['endo_molar_cf'].' + f_endo_molar_etc * '.$_score['endo_molar_etc']
		.' + f_endo_pre_pe * '.$_score['endo_pre_pe'].' + f_endo_pre_ce * '.$_score['endo_pre_ce']
		.' + f_endo_pre_cf * '.$_score['endo_pre_cf'].' + f_endo_pre_etc * '.$_score['endo_pre_etc']
		.' + f_endo_ant_pe * '.$_score['endo_ant_pe'].' + f_endo_ant_ce * '.$_score['endo_ant_ce']
		.' + f_endo_ant_cf * '.$_score['endo_ant_cf'].' + f_endo_ant_etc * '.$_score['endo_ant_etc']
		.' AS endo_score'
		.' FROM '.$table[$m.'score'];
	$_table_data_op_score = 
		'SELECT uid,'
		.'f_indirect_prep_imp * '.$_score['indirect_prep_imp'].' + f_indirect_setting * '.$_score['indirect_setting'].' + f_am * '.$_score['am']
		.' + f_tooth_colored_simple * '.$_score['tooth_colored_simple']
		.' + f_tooth_colored_complex * '.$_score['tooth_colored_complex']
		.' + f_tooth_colored_diastema * '.$_score['tooth_colored_diastema']
		.' + f_post * '.$_score['post'].' + f_core * '.$_score['core']
		.' + f_others * '.$_score['others'].' + f_charting * '.$_score['charting'].' + f_miscellaneous * '.$_score['miscellaneous']
		.' AS op_score'
		.' FROM '.$table[$m.'score'];
	
	//include_once $g['path_module'].'khusd_st_manager/function/debug.php';
	
	
	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table[$m.'score'].' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
	$_table = 
		'('.$_table_data_endo_score.') est,'
		.'('.$_table_data_op_score.') ost,'
		.$table[$m.'score']." sc, ".$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_join.') sc_j';
	$_where = 
		's_uid = '.$s_uid
		.' AND sc.date_update = sc_j.date_update'
		.' AND sc.st_id = sc_j.st_id'
		.' AND mbrid.uid = mbrdata.memberuid'
		.' AND mbrid.id = sc.st_id'
		.' AND sc.uid = est.uid'
		.' AND sc.uid = ost.uid';
	$_data = 'sc.*, '
		.'endo_score, op_score, '
		.$_data_post_core.' AS f_post_core, '
		.$_data_plus_score.' AS plus_score, '
		.$_data_obser_score.' AS obser_score';		
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
	$_data = 'AVG(endo_score) AS endo_score'
		.', AVG(f_indirect_prep_imp) AS indirect_prep_imp'
		.', AVG(f_indirect_setting) AS indirect_setting'
		.', AVG(f_am) AS am'
		.', AVG(f_tooth_colored_simple) AS tooth_colored_simple'
		.', AVG(f_tooth_colored_complex) AS tooth_colored_complex'
		.', AVG(f_tooth_colored_diastema) AS tooth_colored_diastema'
		.', AVG('.$_data_post_core.') AS post_core'
		.', AVG(f_others) AS others'
		.', AVG(f_charting) AS charting'
		.', AVG(f_miscellaneous) AS miscellaneous'
		.', AVG(op_score) AS op_score'
		.', AVG('.$_data_plus_score.') AS plus_score'
		.', AVG('.$_data_obser_score.') AS obser_score';    

	//__debug_print("%%%%%SELECT $_data FROM $_table WHERE $_where");
	$AVG = getDbData($_table, $_where, $_data);
	
	
	$SCORE_INFO = $d['khusd_st_consv']['score']['obser'];
?>
