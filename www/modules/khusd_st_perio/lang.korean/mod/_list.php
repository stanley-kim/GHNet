<?php
	$SCORE_ARRAY = array();

	// 정렬 순서에 대한 옵션 처리
	//if($MANAGER == false && ($order || $om))
	if($MANAGER == false  )
	{
		// 정렬은 관리권한 있는 사용자만 가능
		getLink('','', '각 과의 연락담당과 총대만 정렬 가능합니다.','');
	}
	$order_by = $order ? $order : 'st_id';
	$order_mode = 'ASC';
	if($om == 'a') $order_mode = 'ASC';
	else if($om == 'd') $order_mode = 'DESC';
	
	include_once $g['path_module'].'khusd_st_manager/function/member.php';
	include_once $g['path_module'].'khusd_st_manager/function/debug.php';	// 필수 인클루드 파일
	
	
	$_data_pre_st = 'IF( sc.charting >= 3 AND sc.iot >= 2 AND sc.sc >= 10, 1, 0)';
	$_data_ch_iot = 'sc.iot + sc.charting';
	$_data_total_surgery = 'surgery+imp_1st+imp_2nd+surgery2+imp_1st2+imp_2nd2';
	$_data_surgery_diff_stsc = $_data_total_surgery.'-stsc';
	$_data_abandon_surgery_score = ' (sc.surgery - sc.perio_report) * '.$d['khusd_st_perio']['score']['surgery']
		.'+ (sc.imp_1st - sc.imp1_report) * '.$d['khusd_st_perio']['score']['imp_1st']
		.'+ (sc.imp_2nd - sc.imp2_report) * '.$d['khusd_st_perio']['score']['imp_2nd']
		;	
	$_data_ob_score_original = 
		'sc.iot * '.$d['khusd_st_perio']['score']['iot']
		.'+ sc.charting * '.$d['khusd_st_perio']['score']['charting']
		.'+ sc.perio_report * '.$d['khusd_st_perio']['score']['surgery']
		.'+ sc.surgery2 * '.$d['khusd_st_perio']['score']['surgery2']
		.'+ sc.imp1_report * '.$d['khusd_st_perio']['score']['imp_1st']
		.'+ sc.imp_1st2 * '.$d['khusd_st_perio']['score']['imp_1st2']
		.'+ sc.imp2_report * '.$d['khusd_st_perio']['score']['imp_2nd']
		.'+ sc.imp_2nd2 * '.$d['khusd_st_perio']['score']['imp_2nd2']
		.'+ sc.sc * '.$d['khusd_st_perio']['score']['sc']
		.'+ sc.sc2 * '.$d['khusd_st_perio']['score']['sc2']
		.'+ sc.others * '.$d['khusd_st_perio']['score']['others']
		.'+ sc.tbi * '.$d['khusd_st_perio']['score']['tbi']
		.'+ sc.follow_point'
		.'- sc.abandon'
		;

	$_data_st_score_original = 
			'sc.stsc * '.$d['khusd_st_perio']['score']['stsc']
			.'+ sc.stpc * '.$d['khusd_st_perio']['score']['stpc']
			.'+ sc.stcu * '.$d['khusd_st_perio']['score']['stcu']
			;


	//////FOLLOW//////
	$_follow_table = "SELECT st_id"
			.", SUM(if(fw.fw_type='A' AND fw.status!='d', 1, 0)) AS follow_A"
			.", SUM(if(fw.fw_type='A' AND fw.status='d', 1, 0)) AS follow_A_Drop"
			.", SUM(if(fw.fw_type='B' AND fw.status!='d', 1, 0)) AS follow_B"
			.", SUM(if(fw.fw_type='B' AND fw.status='d', 1, 0)) AS follow_B_Drop"
			.", SUM(if(fw.fw_type='C' AND fw.status!='d', 1, 0)) AS follow_C"
			.", SUM(if(fw.fw_type='C' AND fw.status='d', 1, 0)) AS follow_C_Drop"
			." FROM ".$table['khusd_st_followfollow']." AS fw"
			." WHERE fw.s_uid='".$s_uid."' AND fw.department='perio' GROUP BY st_id";
		
	$_data_follow = "fw_t.follow_A, fw_t.follow_B, fw_t.follow_C, fw_t.follow_A_Drop, fw_t.follow_B_Drop, fw_t.follow_C_Drop";
	//////FOLLOW//////
	
	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table[$m.'score']." WHERE s_uid = '".$s_uid."' AND is_goal = 'n' GROUP BY st_id";
	
	$_table = $table[$m.'score']." sc LEFT JOIN ($_follow_table) AS fw_t ON sc.st_id=fw_t.st_id, ".$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_join.') sc_j';//, LEFT JOIN ('.$_follow_table.') AS fw_t ON fw_t.st_id=sc.st_id';
	$_where =
		"mbrdata.tmpcode!='tester' AND ".
		"sc.s_uid = '".$s_uid."'"
		." AND sc.date_update = sc_j.date_update AND sc.st_id = sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = sc.st_id";
		//." AND fw_t.st_id=sc.st_id";
	$_data = 'sc.*'
		.', ('.$_data_ch_iot.') AS ch_iot'
		.', ('.$_data_total_surgery.') AS total_surgery'
		.', ('.$_data_surgery_diff_stsc.') AS surgery_diff_stsc'
		.', '.$_data_ob_score_original.' AS ob_score_original'
		.', '.$_data_st_score_original.' AS st_score_original'
		//.', '.$_data_ob_score.' AS ob_score'
		//.', '.$_data_st_score.' AS st_score'
		//.', '.$_data_total_score.' AS total_score'
		.', '.$_data_pre_st.' AS pre_st'
		.', '.$_data_abandon_surgery_score. ' AS abandon_surgery'
		.', '.$_data_follow;
	$_sort = $order_by;
	$_orderby = $order_mode;
	
	//	echo "select $_data from $_table where $_where";

	__debug_print("#####SELECT $_data FROM $_table WHERE $_where");
	$SCORE_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);

	// getDbArray 는 mysql_query 의 리턴값을 리턴하므로, fetch 해줘야 한다
	while( $_ROW = db_fetch_array($SCORE_ROWS) ) $SCORE_ARRAY[$_ROW['st_id']] = $_ROW;


	// 각각의 항목에 id와 회원정보를 추가
	foreach($SCORE_ARRAY as $SCORE_TMP) {
		$st_id = $SCORE_TMP['st_id'];

		$stid_array = getDbData($table['s_mbrid'],"id='".$st_id."'", '*');
		$stdata_array = getDbData($table['s_mbrdata'], "memberuid='".$stid_array['uid']."'", '*');

		$st_array = array_merge($stid_array, $stdata_array);
		
		$SCORE_ARRAY[$st_id]['st_info'] = $st_array;
	}
	
	// 목표점수 구하기
	$_data = 'sc.*'
		.', ('.$_data_ch_iot.') AS ch_iot'
		.', ('.$_data_total_surgery.') AS total_surgery'
		.', ('.$_data_surgery_diff_stsc.') AS surgery_diff_stsc'
		.', '.$_data_ob_score_original.' AS ob_score_original'
		.', '.$_data_st_score_original.' AS st_score_original'
		.', '.$_data_total_score.' AS total_score'
		.', '.$_data_pre_st.' AS pre_st';
	$_where =
		"sc.s_uid = '".$s_uid."'"
		." AND st_id = '".$my['id']."' AND is_goal = 'y'";
	$GOAL_SCORE = getDbData($table[$m.'score'].' sc', $_where, $_data);

	// 평균 구하기
	$_data = 'AVG(follow_point) AS follow_point'
		.', AVG(iot) AS iot'
		.', AVG(charting) AS charting'
		.', AVG('.$_data_ch_iot.') AS ch_iot'
		.', AVG(surgery + surgery2) AS surgery'
		.', AVG(imp_1st + imp_1st2) AS imp_1st'
		.', AVG(imp_2nd + imp_2nd2) AS imp_2nd'
		.', AVG('.$_data_total_surgery.') AS total_surgery'
		.', AVG(abandon) AS abandon'
		.', AVG('.$_data_surgery_diff_stsc.') AS surgery_diff_stsc'
		.', AVG(sc) AS sc'
		.', AVG(sc2) AS sc2'
		.', AVG(others) AS others'
		.', AVG(tbi) AS tbi'
		.', AVG(fix) AS fix'
		.', AVG(cp) AS cp'
		.', AVG('.$_data_ob_score_original.') AS ob_score_original'
		.', SUM('.$_data_pre_st.') AS pre_st'
		.', SUM(stpresc) AS stpresc'
		.', AVG(stsc) AS stsc'
		.', AVG(stpc) AS stpc'
		.', AVG(stcu) AS stcu'
		.', AVG(fw_t.follow_A) AS follow_A'
		.', AVG(fw_t.follow_B) AS follow_B'
		.', AVG(fw_t.follow_C) AS follow_C'
		.', AVG(fw_t.follow_A_Drop) AS follow_A_Drop'
		.', AVG(fw_t.follow_B_Drop) AS follow_B_Drop'
		.', AVG(fw_t.follow_C_Drop) AS follow_C_Drop';
	$_where =
		"mbrdata.tmpcode!='tester' AND ".
		"sc.s_uid = '".$s_uid."'"
		." AND sc.date_update = sc_j.date_update AND sc.st_id = sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = sc.st_id AND is_goal = 'n'";
//		." AND fw_t.st_id=sc.st_id";
	$AVG = getDbData($_table, $_where, $_data);
	
//	echo "SELECT $_data FROM $_table WHERE $_where";
?>
