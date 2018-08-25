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
	
	$_join = 'SELECT MAX(date_update) date_update, st_id FROM '.$table[$m.'score'].' GROUP BY st_id';
	$_table = $table[$m.'score'].' sc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_join.') sc_j';
	$_where = 'sc.date_update = sc_j.date_update AND sc.st_id = sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = sc.st_id';
	$_where = $_where. " AND mbrdata.tmpcode!='tester' ";
	$_data = 'sc.*';
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
		
		if(!isset($SCORE_TMP['st_score']) || $SCORE_TMP['st_score'] == 0) {
			$SCORE_ARRAY[$st_id]['st_score'] = $d['khusd_st_pros']['st_stage_score'][$SCORE_ARRAY[$st_id]['st_case_1']]
							+ $d['khusd_st_pros']['st_stage_score'][$SCORE_ARRAY[$st_id]['st_case_2']]
							+ $d['khusd_st_pros']['st_stage_score'][$SCORE_ARRAY[$st_id]['st_case_3']];
							
			/*$_table = $table[$m.'score'];
			$_set = "st_score = '$SCORE_ARRAY[$st_id]['st_score']'";
			$_where = "uid = '$SCORE_TMP['uid']'";
			
			getDbUpdate($_table, $_set, $_where);*/
		}
	}

	// 진행 수 구하기
	$_table_avg = 
		"SELECT "
			." SUM(CASE WHEN st_case_1 = 'case_selection' THEN 1 ELSE 0 END) AS st_case_1_case_selection"
			.", SUM(CASE WHEN st_case_1 = 'snap_impression' THEN 1 ELSE 0 END) AS st_case_1_snap_impression"
			.", SUM(CASE WHEN st_case_1 = 'initial_prep' THEN 1 ELSE 0 END) AS st_case_1_initial_prep"
			.", SUM(CASE WHEN st_case_1 = 'final_prep' THEN 1 ELSE 0 END) AS st_case_1_final_prep"
			.", SUM(CASE WHEN st_case_1 = 'metal_adap' THEN 1 ELSE 0 END) AS st_case_1_metal_adap"
			.", SUM(CASE WHEN st_case_1 = 'initial_setting' THEN 1 ELSE 0 END) AS st_case_1_initial_setting"
			.", SUM(CASE WHEN st_case_1 = 'final_setting' THEN 1 ELSE 0 END) AS st_case_1_final_setting"
			.", SUM(CASE WHEN st_case_1 = 'check' THEN 1 ELSE 0 END) AS st_case_1_check"

			.", SUM(CASE WHEN st_case_2 = 'case_selection' THEN 1 ELSE 0 END) AS st_case_2_case_selection"
			.", SUM(CASE WHEN st_case_2 = 'snap_impression' THEN 1 ELSE 0 END) AS st_case_2_snap_impression"
			.", SUM(CASE WHEN st_case_2 = 'initial_prep' THEN 1 ELSE 0 END) AS st_case_2_initial_prep"
			.", SUM(CASE WHEN st_case_2 = 'final_prep' THEN 1 ELSE 0 END) AS st_case_2_final_prep"
			.", SUM(CASE WHEN st_case_2 = 'metal_adap' THEN 1 ELSE 0 END) AS st_case_2_metal_adap"
			.", SUM(CASE WHEN st_case_2 = 'initial_setting' THEN 1 ELSE 0 END) AS st_case_2_initial_setting"
			.", SUM(CASE WHEN st_case_2 = 'final_setting' THEN 1 ELSE 0 END) AS st_case_2_final_setting"
			.", SUM(CASE WHEN st_case_2 = 'check' THEN 1 ELSE 0 END) AS st_case_2_check"

			.", SUM(CASE WHEN st_case_3 = 'case_selection' THEN 1 ELSE 0 END) AS st_case_3_case_selection"
			.", SUM(CASE WHEN st_case_3 = 'snap_impression' THEN 1 ELSE 0 END) AS st_case_3_snap_impression"
			.", SUM(CASE WHEN st_case_3 = 'initial_prep' THEN 1 ELSE 0 END) AS st_case_3_initial_prep"
			.", SUM(CASE WHEN st_case_3 = 'final_prep' THEN 1 ELSE 0 END) AS st_case_3_final_prep"
			.", SUM(CASE WHEN st_case_3 = 'metal_adap' THEN 1 ELSE 0 END) AS st_case_3_metal_adap"
			.", SUM(CASE WHEN st_case_3 = 'initial_setting' THEN 1 ELSE 0 END) AS st_case_3_initial_setting"
			.", SUM(CASE WHEN st_case_3 = 'final_setting' THEN 1 ELSE 0 END) AS st_case_3_final_setting"
			.", SUM(CASE WHEN st_case_3 = 'check' THEN 1 ELSE 0 END) AS st_case_3_check"
		." FROM ".$_table
		." WHERE ".$_where;

	$_data = 
			"("
				."st_sum.st_case_1_case_selection"
				."+ st_sum.st_case_1_snap_impression"
				."+ st_sum.st_case_1_initial_prep"
				."+ st_sum.st_case_1_final_prep"
				."+ st_sum.st_case_1_metal_adap"
				."+ st_sum.st_case_1_initial_setting"
				."+ st_sum.st_case_1_final_setting"
				."+ st_sum.st_case_1_check"
			.") AS st_case_1_avg_case_selection"
			.", ("
				."st_sum.st_case_1_snap_impression"
				."+ st_sum.st_case_1_initial_prep"
				."+ st_sum.st_case_1_final_prep"
				."+ st_sum.st_case_1_metal_adap"
				."+ st_sum.st_case_1_initial_setting"
				."+ st_sum.st_case_1_final_setting"
				."+ st_sum.st_case_1_check"
			.") AS st_case_1_avg_snap_impression"
			.", ("
				."st_sum.st_case_1_initial_prep"
				."+ st_sum.st_case_1_final_prep"
				."+ st_sum.st_case_1_metal_adap"
				."+ st_sum.st_case_1_initial_setting"
				."+ st_sum.st_case_1_final_setting"
				."+ st_sum.st_case_1_check"
			.") AS st_case_1_avg_initial_prep"
			.", ("
				."st_sum.st_case_1_final_prep"
				."+ st_sum.st_case_1_metal_adap"
				."+ st_sum.st_case_1_initial_setting"
				."+ st_sum.st_case_1_final_setting"
				."+ st_sum.st_case_1_check"
			.") AS st_case_1_avg_final_prep"
			.", ("
				."st_sum.st_case_1_metal_adap"
				."+ st_sum.st_case_1_initial_setting"
				."+ st_sum.st_case_1_final_setting"
				."+ st_sum.st_case_1_check"
			.") AS st_case_1_avg_metal_adap"
			.", ("
				."st_sum.st_case_1_initial_setting"
				."+ st_sum.st_case_1_final_setting"
				."+ st_sum.st_case_1_check"
			.") AS st_case_1_avg_initial_setting"
			.", ("
				."st_sum.st_case_1_final_setting"
				."+ st_sum.st_case_1_check"
			.") AS st_case_1_avg_final_setting"
			.", ("
				."st_sum.st_case_1_check"
			.") AS st_case_1_avg_check"


			.", ("
				."st_sum.st_case_2_case_selection"
				."+ st_sum.st_case_2_snap_impression"
				."+ st_sum.st_case_2_initial_prep"
				."+ st_sum.st_case_2_final_prep"
				."+ st_sum.st_case_2_metal_adap"
				."+ st_sum.st_case_2_initial_setting"
				."+ st_sum.st_case_2_final_setting"
				."+ st_sum.st_case_2_check"
			.") AS st_case_2_avg_case_selection"
			.", ("
				."st_sum.st_case_2_snap_impression"
				."+ st_sum.st_case_2_initial_prep"
				."+ st_sum.st_case_2_final_prep"
				."+ st_sum.st_case_2_metal_adap"
				."+ st_sum.st_case_2_initial_setting"
				."+ st_sum.st_case_2_final_setting"
				."+ st_sum.st_case_2_check"
			.") AS st_case_2_avg_snap_impression"
			.", ("
				."st_sum.st_case_2_initial_prep"
				."+ st_sum.st_case_2_final_prep"
				."+ st_sum.st_case_2_metal_adap"
				."+ st_sum.st_case_2_initial_setting"
				."+ st_sum.st_case_2_final_setting"
				."+ st_sum.st_case_2_check"
			.") AS st_case_2_avg_initial_prep"
			.", ("
				."st_sum.st_case_2_final_prep"
				."+ st_sum.st_case_2_metal_adap"
				."+ st_sum.st_case_2_initial_setting"
				."+ st_sum.st_case_2_final_setting"
				."+ st_sum.st_case_2_check"
			.") AS st_case_2_avg_final_prep"
			.", ("
				."st_sum.st_case_2_metal_adap"
				."+ st_sum.st_case_2_initial_setting"
				."+ st_sum.st_case_2_final_setting"
				."+ st_sum.st_case_2_check"
			.") AS st_case_2_avg_metal_adap"
			.", ("
				."st_sum.st_case_2_initial_setting"
				."+ st_sum.st_case_2_final_setting"
				."+ st_sum.st_case_2_check"
			.") AS st_case_2_avg_initial_setting"
			.", ("
				."st_sum.st_case_2_final_setting"
				."+ st_sum.st_case_2_check"
			.") AS st_case_2_avg_final_setting"
			.", ("
				."st_sum.st_case_2_check"
			.") AS st_case_2_avg_check"


			.", ("
				."st_sum.st_case_3_case_selection"
				."+ st_sum.st_case_3_snap_impression"
				."+ st_sum.st_case_3_initial_prep"
				."+ st_sum.st_case_3_final_prep"
				."+ st_sum.st_case_3_metal_adap"
				."+ st_sum.st_case_3_initial_setting"
				."+ st_sum.st_case_3_final_setting"
				."+ st_sum.st_case_3_check"
			.") AS st_case_3_avg_case_selection"
			.", ("
				."st_sum.st_case_3_snap_impression"
				."+ st_sum.st_case_3_initial_prep"
				."+ st_sum.st_case_3_final_prep"
				."+ st_sum.st_case_3_metal_adap"
				."+ st_sum.st_case_3_initial_setting"
				."+ st_sum.st_case_3_final_setting"
				."+ st_sum.st_case_3_check"
			.") AS st_case_3_avg_snap_impression"
			.", ("
				."st_sum.st_case_3_initial_prep"
				."+ st_sum.st_case_3_final_prep"
				."+ st_sum.st_case_3_metal_adap"
				."+ st_sum.st_case_3_initial_setting"
				."+ st_sum.st_case_3_final_setting"
				."+ st_sum.st_case_3_check"
			.") AS st_case_3_avg_initial_prep"
			.", ("
				."st_sum.st_case_3_final_prep"
				."+ st_sum.st_case_3_metal_adap"
				."+ st_sum.st_case_3_initial_setting"
				."+ st_sum.st_case_3_final_setting"
				."+ st_sum.st_case_3_check"
			.") AS st_case_3_avg_final_prep"
			.", ("
				."st_sum.st_case_3_metal_adap"
				."+ st_sum.st_case_3_initial_setting"
				."+ st_sum.st_case_3_final_setting"
				."+ st_sum.st_case_3_check"
			.") AS st_case_3_avg_metal_adap"
			.", ("
				."st_sum.st_case_3_initial_setting"
				."+ st_sum.st_case_3_final_setting"
				."+ st_sum.st_case_3_check"
			.") AS st_case_3_avg_initial_setting"
			.", ("
				."st_sum.st_case_3_final_setting"
				."+ st_sum.st_case_3_check"
			.") AS st_case_3_avg_final_setting"
			.", ("
				."st_sum.st_case_3_check"
			.") AS st_case_3_avg_check"
			;
	
	$_table .= ", (".$_table_avg.") AS st_sum";
	
	$AVG = getDbData($_table, $_where, $_data);
?>
