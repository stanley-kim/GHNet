<?php
	$SCORE_ARRAY = array();
    if(!permcheck('over_chief_of_case') && !permcheck('perio'))
    {
        getLink($g['s'].'/?r=home','','접근권한이 없습니다.','');
        exit;
    }
	// 정렬 순서에 대한 옵션 처리
	if($MANAGER == false && $order)
	{
		// 정렬은 관리권한 있는 사용자만 가능
		getLink('','', '각 과의 연락담당과 총대만 정렬 가능합니다.','');
	}

    $show_list = false;
    if($order){
        $show_list = true;
    }

    $order_by = $order ? $order : 'st_id';
	$order_mode = 'ASC';
	if($om == 'a') $order_mode = 'ASC';
	else if($om == 'd') $order_mode = 'DESC';

    
    
    $query = "select sc.*, (surgery + imp_1st + imp_2nd) as total, (perio_report + imp1_report + imp2_report) as total_report".
		" from rb_khusd_st_perio_score sc LEFT JOIN (SELECT st_id, SUM(if(fw.fw_type='A' AND fw.status!='d', 1, 0)) AS follow_A, SUM(if(fw.fw_type='A' AND fw.status='d', 1, 0)) AS follow_A_Drop, SUM(if(fw.fw_type='B' AND fw.status!='d', 1, 0)) AS follow_B,".
		" SUM(if(fw.fw_type='B' AND fw.status='d', 1, 0)) AS follow_B_Drop, SUM(if(fw.fw_type='C' AND fw.status!='d', 1, 0)) AS follow_C, SUM(if(fw.fw_type='C' AND fw.status='d', 1, 0)) AS follow_C_Drop FROM rb_khusd_st_follow_follow AS fw WHERE fw.s_uid='2' ".
		" AND fw.department='perio' GROUP BY st_id) AS fw_t ON sc.st_id=fw_t.st_id, rb_s_mbrdata mbrdata,rb_s_mbrid mbrid,(SELECT MAX(date_update) date_update,st_id FROM rb_khusd_st_perio_score WHERE s_uid = '2' AND is_goal = 'n' GROUP BY st_id) sc_j ".
		" where mbrdata.tmpcode!='tester' AND sc.s_uid = '2' AND sc.date_update = sc_j.date_update AND sc.st_id = sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = sc.st_id ".
		" order by ".$order_by." ".$order_mode;
	
	global $DB_CONNECT;
	$SCORE_ROWS = db_query($query, $DB_CONNECT);
    $target_name = '';
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
?>
