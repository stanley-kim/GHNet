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
	$recnum = $recnum && $recnum < 200 ? $recnum : 10;

	$_table = $table[$m.'follow_comment'].' fc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
	$_where = "s_uid = '".$s_uid."'"
		.' AND mbrid.uid = mbrdata.memberuid'
		.' AND mbrid.id = fc.st_id';
	$_data = '*';
	$_sort = $order_by;
	$_orderby = $order_mode;
	
	$NUM = getDbRows($table[$m.'follow_comment'], '');

	$SCORE_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, $recnum, $p);
	
	// getDbArray 는 mysql_query 의 리턴값을 리턴하므로, fetch 해줘야 한다
	$idx = 0;
	while( $_ROW = db_fetch_array($SCORE_ROWS) ){
		$_ROW['index'] = $NUM - $idx - $recnum*($p-1);
		$SCORE_ARRAY[$idx++] = $_ROW;
	}
	$TPG = getTotalPage($NUM, $recnum);
?>