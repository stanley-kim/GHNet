<?php
	include_once $g['path_module'].'khusd_st_manager/function/member.php';
	//include_once $g['path_module'].'khusd_st_manager/function/debug.php';	// 필수 인클루드 파일
	
	$SEMESTER_INFO = getCurrentSemesterInfo();
	
	// 현재 FOLLOW 정보 불러오기
	$_table = 'kd44_khusd_st_follow_follow fw, kd44_khusd_st_follow_follow_pt pt';
	$_data = 'fw.*, pt.pt_id, pt.pt_name';
	$_where = "fw.s_uid = '".$SEMESTER_INFO['uid']."'"
		." AND fw.st_id = '".$my['id']."'"
		." AND fw.department = 'perio'"
		." AND fw.status != 'd'"
		." AND fw.pt_uid = pt.uid";
	$_sort = 'fw.fw_type';
	$_orderby = 'DESC';
	
	//__debug_print("SELECT $_data FROM $_table WHERE $_where $_sort $_orderby");
	
	$MY_FOLLOW_ARRAY = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
			
	$FOLLOW_ROWS = getDbArray('kd44_khusd_st_follow_follow fw', 's_uid = '.$SEMESTER_INFO['uid'].' AND st_id = '.$my['id']." AND department = 'perio' AND status != 'd'", "SUM(if(fw.fw_type='A', 1, 0)) AS follow_A, SUM(if(fw.fw_type='B', 1, 0)) AS follow_B, SUM(if(fw.fw_type='C', 1, 0)) AS follow_C", 'fw_type', 'desc', 1, 1);
	$FOLLOW = db_fetch_array($FOLLOW_ROWS);
	
	$SCORE_ROWS = getDbArray($table[$m.'score'],"s_uid = '".$s_uid."' AND st_id='".$my['id']."' AND is_goal = 'n'", '*', 'date_update', 'desc', 1, 1);
	$SCORE = db_fetch_array($SCORE_ROWS);
	
	if(!$SCORE['uid']) {
		$SCORE['follow_point'] = 0;
		$SCORE['iot'] = 0;
		$SCORE['charting'] = 0;
		$SCORE['surgery'] = 0;
		$SCORE['imp_1st'] = 0;
		$SCORE['imp_2nd'] = 0;
		$SCORE['sc'] = 0;
		$SCORE['others'] = 0;
		$SCORE['tbi'] = 0;
		$SCORE['surgery2'] = 0;
		$SCORE['imp_1st2'] = 0;
		$SCORE['imp_2nd2'] = 0;
		$SCORE['abandon'] = 0;
		$SCORE['sc2'] = 0;
		$SCORE['stsc'] = 0;
		$SCORE['stpc'] = 0;
		$SCORE['stcu'] = 0;
		$SCORE['cp'] = 0;
	}
?>