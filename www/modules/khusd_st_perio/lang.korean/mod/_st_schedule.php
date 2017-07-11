<?php

	if(permcheck('chief_of_cnslt_room'))
	{
		$MANAGER = true;
	}
	
	// 로그인 & 권한 체크
	if(permcheck('st') == false)
	{
		$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
	}
	
	$st_id = $my['id'];
	$st_date = $st_date ? $st_date : $date['today'];
	
	// 이번달의 첫날짜
	$mon_start_date = getDateFormat($st_date, 'Ym').'01';
	
	
	// 각 날짜별 신청자 수 구하기
	
	$ST_CHAIR_ARRAY = array();
	$MY_ST_CHAIR_ARRAY = array();

	$_table = $table[$m.'st_chair'].' st';
	$_where = "st.st_date LIKE '".substr($st_date, 0, 6)."%'"
		." AND status != '".$d['khusd_st_cnslt_room_manager']['apply']['status']['CANCEL']."'";
	
	$_data = 'st.*';
	$_sort = 'st.st_date ASC, st_timetype';
	$_orderby = 'ASC';
	
	$ST_CHAIR_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
	
	// getDbArray 는 mysql_query 의 리턴값을 리턴하므로, fetch 해줘야 한다
	for($_day = $mon_start_date; getDateFormat($_day, 'n') == getDateFormat($st_date, 'n'); $_day++)
	{
		$ST_CHAIR_ARRAY[$_day] = array( 'am' => 0, 'pm' => 0, 'nt' => 0 );
	}
	while( $_ROW = db_fetch_array($ST_CHAIR_ROWS) ) 
	{
		$ST_CHAIR_ARRAY[$_ROW['st_date']][$_ROW['st_timetype']]++;
	}
	
	$_where = 
		"st.st_id = '".$st_id."'"
		." AND st.st_date LIKE '".substr($st_date, 0, 6)."%'";
	
	__debug_print("SELECT $_data FROM $_table WHERE $_where");
	$MY_ST_CHAIR_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
	while($_ROW = db_fetch_array($MY_ST_CHAIR_ROWS)) $MY_ST_CHAIR_ARRAY[] = $_ROW;
	
?>