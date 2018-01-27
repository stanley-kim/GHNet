<?php

 	$SEMESTER_INFO = getCurrentSemesterInfo();
	// 이전 업데이트 기록을 좀 보여주자...
	// 최근 5개? 혹은 이번주? 이런식으로...


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
	if($SEMESTER_INFO['sid'] == 2)
	// 쿼리는 list 모드일 때의 쿼리 참고.. .이 변수들을 합치면 좋겠음....
	$_data_total_simple_obser = 'sc.simple_obser_3_8 + sc.simple_obser_3_10 + sc.simple_obser_3_12' ; 		
	else 
	$_data_total_simple_obser = 'sc.simple_obser_4_2 + sc.simple_obser_4_4 + sc.simple_obser_4_6 + sc.simple_obser_4_8' ; 		

	 		
	$_data_total_score = 
		'sc.post_core_complete * '.$d['khusd_st_pros']['score']['post_core']
		.'+ sc.imp_cr_br_complete * '.$d['khusd_st_pros']['score']['imp_cr_br']
		.'+ sc.single_cr_complete * '.$d['khusd_st_pros']['score']['single_cr']
		.'+ sc.br_complete * '.$d['khusd_st_pros']['score']['br']
		.'+ sc.partial_denture_complete * '.$d['khusd_st_pros']['score']['partial_denture']
		.'+ sc.complete_denture_complete * '.$d['khusd_st_pros']['score']['complete_denture']
		.'+ sc.others_complete * '.$d['khusd_st_pros']['score']['others'];
	
	$_data_total_predict_score = 
		'sc.post_core_complete * '.$d['khusd_st_pros']['score']['post_core']
		.'+ sc.imp_cr_br_complete * '.$d['khusd_st_pros']['score']['imp_cr_br']
		.'+ sc.single_cr_complete * '.$d['khusd_st_pros']['score']['single_cr']
		.'+ sc.br_complete * '.$d['khusd_st_pros']['score']['br']
		.'+ sc.partial_denture_complete * '.$d['khusd_st_pros']['score']['partial_denture']
		.'+ sc.complete_denture_complete * '.$d['khusd_st_pros']['score']['complete_denture']
		.'+ sc.others_complete * '.$d['khusd_st_pros']['score']['others']
		
		.'+ sc.post_core_ongoing * '.$d['khusd_st_pros']['score']['post_core']
		.'+ sc.imp_cr_br_ongoing * '.$d['khusd_st_pros']['score']['imp_cr_br']
		.'+ sc.single_cr_ongoing * '.$d['khusd_st_pros']['score']['single_cr']
		.'+ sc.br_ongoing * '.$d['khusd_st_pros']['score']['br']
		.'+ sc.partial_denture_ongoing * '.$d['khusd_st_pros']['score']['partial_denture']
		.'+ sc.complete_denture_ongoing * '.$d['khusd_st_pros']['score']['complete_denture']
		.'+ sc.others_ongoing * '.$d['khusd_st_pros']['score']['others'];
	
        $_data_second_cr = 'sc.second_cr_complete + sc.second_cr_ongoing';
        $_data_post_core_total_resident = 'sc.post_core_ongoing + sc.post_core_complete';
        $_data_post_core_total_prof = 'sc.post_core_ongoing_prof + sc.post_core_complete_prof';
        $_data_post_core_total_ongoing = 'sc.post_core_ongoing + sc.post_core_ongoing_prof';
        $_data_post_core_total_complete = 'sc.post_core_complete + sc.post_core_complete_prof';
        $_data_post_core = 'sc.post_core_complete + sc.post_core_ongoing + sc.post_core_complete_prof + sc.post_core_ongoing_prof';
        $_data_imp_cr_br_total_resident = 'sc.imp_cr_br_complete + sc.imp_cr_br_ongoing';
        $_data_imp_cr_br_total_prof = 'sc.imp_cr_br_complete_prof + sc.imp_cr_br_ongoing_prof';
        $_data_imp_cr_br_total_ongoing = 'sc.imp_cr_br_ongoing_prof + sc.imp_cr_br_ongoing';
        $_data_imp_cr_br_total_complete = 'sc.imp_cr_br_complete_prof + sc.imp_cr_br_complete';
        $_data_imp_cr_br = 'sc.imp_cr_br_complete_prof + sc.imp_cr_br_ongoing_prof + sc.imp_cr_br_complete + sc.imp_cr_br_ongoing';
        $_data_single_cr_total_resident = 'sc.single_cr_complete + sc.single_cr_ongoing';
        $_data_single_cr_total_prof = 'sc.single_cr_complete_prof + sc.single_cr_ongoing_prof';
        $_data_single_cr_total_ongoing = 'sc.single_cr_ongoing_prof + sc.single_cr_ongoing';
        $_data_single_cr_total_complete = 'sc.single_cr_complete + sc.single_cr_complete_prof';
        $_data_single_cr = 'sc.single_cr_complete_prof + sc.single_cr_ongoing_prof + sc.single_cr_complete + sc.single_cr_ongoing';
        $_data_br_total_resident = 'sc.br_complete + sc.br_ongoing';
        $_data_br_total_prof = 'sc.br_complete_prof + sc.br_ongoing_prof';
        $_data_br_total_ongoing = 'sc.br_ongoing_prof + sc.br_ongoing';
        $_data_br_total_complete = 'sc.br_complete + sc.br_complete_prof';
        $_data_br = 'sc.br_complete + sc.br_ongoing + sc.br_complete_prof + sc.br_ongoing_prof';
        $_data_partial_denture_total_resident = 'sc.partial_denture_complete + sc.partial_denture_ongoing';
        $_data_partial_denture_total_prof = 'sc.partial_denture_complete_prof + sc.partial_denture_ongoing_prof';
        $_data_partial_denture_total_ongoing = 'sc.partial_denture_ongoing_prof + sc.partial_denture_ongoing';
        $_data_partial_denture_total_complete = 'sc.partial_denture_complete + sc.partial_denture_complete_prof';
        $_data_partial_denture = 'sc.partial_denture_complete + sc.partial_denture_ongoing + sc.partial_denture_complete_prof + sc.partial_denture_ongoing_prof ';
        $_data_complete_denture_total_resident = 'sc.complete_denture_complete + sc.complete_denture_ongoing';
        $_data_complete_denture_total_prof = 'sc.complete_denture_complete_prof + sc.complete_denture_ongoing_prof';
        $_data_complete_denture_total_ongoing = 'sc.complete_denture_ongoing_prof + sc.complete_denture_ongoing';
        $_data_complete_denture_total_complete = 'sc.complete_denture_complete + sc.complete_denture_complete_prof';
        $_data_complete_denture = 'sc.complete_denture_complete + sc.complete_denture_ongoing + sc.complete_denture_complete_prof + sc.complete_denture_ongoing_prof ';


	
	$_table = $table[$m.'score'].' sc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
	$_where = "s_uid = '".$s_uid."'"
		.' AND mbrid.uid = mbrdata.memberuid'
		.' AND mbrid.id = sc.st_id'
		." AND sc.st_id = '".$st_id."'";
	$_data = 'sc.*, '.$_data_total_score.' AS total_score, '.$_data_total_predict_score.' AS total_predict_score';
	$_data = $_data
                .', '.$_data_second_cr.' AS second_cr'
                .', '.$_data_post_core_total_resident.' AS post_core_total_resident'
                .', '.$_data_post_core_total_prof.' AS post_core_total_prof'
                .', '.$_data_post_core_total_ongoing.' AS post_core_total_ongoing'
                .', '.$_data_post_core_total_complete.' AS post_core_total_complete'
                .', '.$_data_post_core.' AS post_core'
                .', '.$_data_imp_cr_br_total_resident.' AS imp_cr_br_total_resident'
                .', '.$_data_imp_cr_br_total_prof.' AS imp_cr_br_total_prof'
                .', '.$_data_imp_cr_br_total_ongoing.' AS imp_cr_br_total_ongoing'
                .', '.$_data_imp_cr_br_total_complete.' AS imp_cr_br_total_complete'
                .', '.$_data_imp_cr_br.' AS imp_cr_br'
                .', '.$_data_single_cr_total_resident.' AS single_cr_total_resident'
                .', '.$_data_single_cr_total_prof.' AS single_cr_total_prof'
                .', '.$_data_single_cr_total_ongoing.' AS single_cr_total_ongoing'
                .', '.$_data_single_cr_total_complete.' AS single_cr_total_complete'
                .', '.$_data_single_cr.' AS single_cr'
                .', '.$_data_br_total_resident.' AS br_total_resident'
                .', '.$_data_br_total_prof.'     AS br_total_prof'
                .', '.$_data_br_total_ongoing.'  AS br_total_ongoing'
                .', '.$_data_br_total_complete.' AS br_total_complete'
                .', '.$_data_br.' AS br'
                .', '.$_data_partial_denture_total_resident.' AS partial_denture_total_resident'
                .', '.$_data_partial_denture_total_prof.' AS partial_denture_total_prof'
                .', '.$_data_partial_denture_total_ongoing.' AS partial_denture_total_ongoing'
                .', '.$_data_partial_denture_total_complete.' AS partial_denture_total_complete'
                .', '.$_data_partial_denture.' AS partial_denture'
                .', '.$_data_complete_denture_total_resident.' AS complete_denture_total_resident'
                .', '.$_data_complete_denture_total_prof.' AS complete_denture_total_prof'
                .', '.$_data_complete_denture_total_ongoing.' AS complete_denture_total_ongoing'
                .', '.$_data_complete_denture_total_complete.' AS complete_denture_total_complete'
                .', '.$_data_complete_denture.' AS complete_denture';

	$_data = $_data.', '.$_data_total_simple_obser.' AS total_simple_obser';
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
