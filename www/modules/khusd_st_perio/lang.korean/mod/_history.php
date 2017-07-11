<?php
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

	// 쿼리는 list 모드일 때의 쿼리 참고.. .이 변수들을 합치면 좋겠음....

	if(is_array($d['khusd_st_perio']['score']['ratio'][$s_sid]))
	{
		$PERIO_SCORE_ARRAY = $d['khusd_st_perio']['score']['ratio'][$s_sid];
	}
	else
	{
		$PERIO_SCORE_ARRAY = $d['khusd_st_perio']['score']['ratio'];
	}
	
	$_data_pre_st = 'IF( sc.charting >= 3 AND sc.iot >= 2 AND sc.sc >= 10, 1, 0)';
	$_data_ch_iot = 'sc.iot + sc.charting';
	$_data_total_surgery = 'surgery+imp_1st+imp_2nd';
	$_data_surgery_diff_stsc = $_data_total_surgery.'-stsc';
	$_data_ob_score_original = 
		'sc.iot * '.$d['khusd_st_perio']['score']['iot']
		.'+ sc.charting * '.$d['khusd_st_perio']['score']['charting']
		.'+ sc.surgery * '.$d['khusd_st_perio']['score']['surgery']
		.'+ sc.imp_1st * '.$d['khusd_st_perio']['score']['imp_1st']
		.'+ sc.imp_2nd * '.$d['khusd_st_perio']['score']['imp_2nd']
		.'+ sc.sc * '.$d['khusd_st_perio']['score']['sc']
		.'+ sc.others * '.$d['khusd_st_perio']['score']['others']
		.'+ sc.tbi * '.$d['khusd_st_perio']['score']['tbi']
		;
	$_data_ob_score_sum = 
		'('  
		.$_data_ob_score_original
		.') * '.$PERIO_SCORE_ARRAY['obser_ratio'];
	$_data_ob_score = 
		'IF('.$_data_ob_score_sum.'>='.$PERIO_SCORE_ARRAY['obser_max']
			.', '.$PERIO_SCORE_ARRAY['obser_max']
			.', '.$_data_ob_score_sum
		.')';
	$_data_st_score_original = 
			'sc.stsc * '.$d['khusd_st_perio']['score']['stsc']
			.'+ sc.stpc * '.$d['khusd_st_perio']['score']['stpc']
			.'+ sc.stcu * '.$d['khusd_st_perio']['score']['stcu']
			;
	$_data_st_score_sum = 
		'('
		.$_data_st_score_original
		.') * '.$PERIO_SCORE_ARRAY['st_ratio'];
	$_data_st_score = 
		'IF('.$_data_st_score_sum.'>='.$PERIO_SCORE_ARRAY['st_max']
			.', '.$PERIO_SCORE_ARRAY['st_max']
			.', '.$_data_st_score_sum
		.')';
	$_data_total_score = 
		'('.$_data_ob_score.')'
		.' + '.$_data_st_score
		.' + sc.fix'
		;
		
	
	$_table = $table[$m.'score'].' sc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
	$_where = 
		"s_uid = '".$s_uid."'"
		.' AND mbrid.uid = mbrdata.memberuid AND mbrid.id = sc.st_id'
		." AND sc.st_id = '".$st_id."'";
	$_data = 'sc.*'
		.', ('.$_data_ch_iot.') AS ch_iot'
		.', ('.$_data_total_surgery.') AS total_surgery'
		.', ('.$_data_surgery_diff_stsc.') AS surgery_diff_stsc'
		.', '.$_data_ob_score_original.' AS ob_score_original'
		.', '.$_data_st_score_original.' AS st_score_original'
		.', '.$_data_ob_score.' AS ob_score'
		.', '.$_data_st_score.' AS st_score'
		.', '.$_data_total_score.' AS total_score'
		.', '.$_data_pre_st.' AS pre_st';
	$_sort = $order_by;
	$_orderby = $order_mode;
	
	$SCORE_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, $recnum, $p);
	
	
	// getDbArray 는 mysql_query 의 리턴값을 리턴하므로, fetch 해줘야 한다
	$idx = 0;
	while( $_ROW = db_fetch_array($SCORE_ROWS) ) $SCORE_ARRAY[$idx++] = $_ROW;


	// 각각의 항목에 id와 회원정보를 추가
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