<?php
	include_once $g['path_module'].'khusd_st_manager/function/debug.php';

	//__debug_print("in update file");
	
	// 기존 정보 불러오기
	$_where = "s_uid = '".$s_uid."' AND st_id='".$my['id']."'";
	
	//__debug_print("SELECT * FROM ".$table[$m.'score']." WHERE ".$_where);
	
	$SCORE_ROWS = getDbArray($table[$m.'score'],$_where, '*', 'date_update', 'desc', 1, 1);
	// Retrieve the most recent data
	$SCORE = db_fetch_array($SCORE_ROWS);
	// If a score doesn't exists, set all to ZERO
	if(!$SCORE['uid']) {
		$SCORE['obser'] = 0;
		$SCORE['follow_old'] = 0;
		$SCORE['follow_new'] = 0;
		$SCORE['appliance'] = '00000';
	}
	
	//__debug_print("in update file 2: APPLIANCE = ".$SCORE['appliance']);
	
	$APPLIANCE = array();
	// Sort out appliances
	for($i = 0; $i < $d['khusd_st_ortho']['APPLIANCE_SIZE']; $i++) {
		$APPLIANCE[$i] = intval($SCORE['appliance']{$i});
		//__debug_print("VAL_$i: ".$SCORE['appliance']{$i});
	}
	
	// 현재 로그인한 사용자의 팔로우 보여주기
	// 환자명 / 병록번호로 검색하기
	$_data = 'fw.uid, fw.type, fw.status, fw.step, fw.report, pt.pt_name, pt.pt_id, pt.dr_name';
	$_table = $table[$m.'follow_pt'].' pt LEFT JOIN '.$table[$m.'follow'].' fw ON pt.uid=fw.pt_uid';
	$_where = 
		"fw.s_uid = '".$s_uid."'"
		." AND pt.uid = fw.pt_uid"
		." AND fw.st_id = '".$my['id']."'"
		." AND (fw.status = 'f' or fw.status = 'c')";
	$_sort = 'type';
	$_orderby = 'DESC';
	
	//echo "SELECT $_data FROM $_table WHERE $_where ORDER BY $_sort $_orderby";
	
	$MY_FOLLOW_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
?>