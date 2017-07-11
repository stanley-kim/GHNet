<?php
	$SCORE_ARRAY = array();

	// 정렬 순서에 대한 옵션 처리
	if($MANAGER == false && $order)
	{
		// 정렬은 관리권한 있는 사용자만 가능
		getLink('','', '각 과의 연락담당과 총대만 정렬 가능합니다.','');
	}
	$order_by = $order ? $order : 'st_id';
	$order_mode = 'ASC';
	if($om == 'a') $order_mode = 'ASC';
	else if($om == 'd') $order_mode = 'DESC';

	// 한 학번에 대해 여러 개의 데이터가 존재하므로 가장 최근의 데이터만 출력해주도록 JOIN 을 이용하여 query

	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table[$m.'score'].' GROUP BY st_id';
	$_table = $table[$m.'score'].' sc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_join.') sc_j';
	$_where = 'sc.date_update = sc_j.date_update AND sc.st_id = sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = sc.st_id';
	$_data = 'sc.*, st_endo_1st_point + st_endo_2nd_point AS endo_score';
	$_sort = $order_by;
	$_orderby = $order_mode;
	
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

	// 진행 수 구하기
	$_table_sum = "SELECT ";

	$_is_first = true;
	for($_endo_idx = 1; $_endo_idx <= 2; $_endo_idx++)
	{
		foreach($d['khusd_st_consv']['st_stage'] as $key => $text)
		{
			$_table_sum .= ($_is_first ? "" : ", ");
			$_table_sum .= "SUM(CASE WHEN st_endo_".$_endo_idx." = '".$key."' THEN 1 ELSE 0 END) AS st_endo_".$_endo_idx."_".$key."";
			$_is_first = false;
		}
	}
	$_table_sum .= " FROM ".$_table." WHERE ".$_where;
	
	$_is_first = true;
	$_data = '';
	for($_endo_idx = 1; $_endo_idx <= 2; $_endo_idx++)
	{
		foreach($d['khusd_st_consv']['st_stage'] as $key => $text)
		{
			$_data .= ($_is_first ? "(" : ", (");
			
			$_sub_is_first = true;
			foreach($d['khusd_st_consv']['st_stage'] as $sub_key => $sub_text)
			{
				if($_sub_is_first && $key == $sub_key)
				{
					$_sub_is_first = false;
					$_data .= "st_sum.st_endo_".$_endo_idx."_".$sub_key;
				}
				
				if(!$_sub_is_first && $key != $sub_key)
				{
					$_data .= " + st_sum.st_endo_".$_endo_idx."_".$sub_key;
				}
			}
			
			$_data .= ") AS st_endo_".$_endo_idx."_sum_".$key;
			
			$_is_first = false;
		}
	}
	$_data .= ", AVG(st_endo_1st_point) AS st_endo_1st_point"
		.", AVG(st_endo_2nd_point) AS st_endo_2nd_point"
		.", AVG(st_endo_1st_point + st_endo_2nd_point) AS endo_score";
	
	$_table .= ", (".$_table_sum.") AS st_sum";
	
	$SUM = getDbData($_table, $_where, $_data);
?>