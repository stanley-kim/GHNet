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
		
	$_data_fix = 'fix_am + fix_pm';
	$_data_total_score = 
		'charting * '. $d['khusd_st_medi']['score']['charting']
		.' + obser * '. $d['khusd_st_medi']['score']['obser']
		.' + splint_obser * '. $d['khusd_st_medi']['score']['splint_obser']
		.' + physical_tx * '. $d['khusd_st_medi']['score']['physical_tx']
		.' + odor * '. $d['khusd_st_medi']['score']['odor']
		.' + m_text * '. $d['khusd_st_medi']['score']['m_text']
		.' + (fix_am + fix_pm) * '. $d['khusd_st_medi']['score']['fix'];
	
	$_table = $table[$m.'score'].' sc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
	$_where = 'mbrid.uid = mbrdata.memberuid'
		." AND s_uid = '".$s_uid."'"	
		.' AND mbrid.id = sc.st_id'
		." AND sc.st_id = '".$st_id."'";
	$_data = 'sc.*, '.$_data_fix.' AS fix, '.$_data_total_score.' AS total_score';
	$_sort = $order_by;
	$_orderby = $order_mode;
	
	$SCORE_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
	
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