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

	$order_by = 'fcuid';
	$order_mode = 'ASC';
	$recnum = $recnum && $recnum < 200 ? $recnum : 10;

	$_table = $table[$m.'new_follow'].' fc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
	$_where = "s_uid = '".$s_uid."'"
		.' AND mbrid.uid = mbrdata.memberuid'
		.' AND mbrid.id = fc.st_id';
    
    if($pt_name != ''){
        $_where .= " AND fc.pt_name = \"$pt_name\"";
    }else if($pt_id != ''){
        $_where .= " AND fc.pt_id = \"$pt_id\"";
    }else{
		getLink('', '', '검색어를 입력해주세요.', '-1');
	}
    
    
	$_data = '*, fc.uid as fcuid';
	$_sort = $order_by;
	$_orderby = $order_mode;
	
    $FOLLOW_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
    $FOLLOW_ARRAY = array();
    while( $_ROW = db_fetch_array($FOLLOW_ROWS) )
    {
        $FOLLOW_ARRAY[$_ROW['fcuid']] = $_ROW;
    }
    
?>