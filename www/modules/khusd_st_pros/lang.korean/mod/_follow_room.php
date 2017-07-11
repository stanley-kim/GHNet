<?php
	$SCORE_ARRAY = array();
    if(!permcheck('over_chief_of_case')  && !permcheck('pros'))
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

    
    
	$_data_second_cr = 'sc.second_cr_complete + sc.second_cr_ongoing';
	$_data_post_core = 'sc.post_core_complete + sc.post_core_ongoing';
	$_data_imp_cr_br = 'sc.imp_cr_br_complete + sc.imp_cr_br_ongoing';
	$_data_single_cr = 'sc.single_cr_complete + sc.single_cr_ongoing';
	$_data_br = 'sc.br_complete + sc.br_ongoing';
	$_data_partial_denture = 'sc.partial_denture_complete + sc.partial_denture_ongoing';
	$_data_complete_denture = 'sc.complete_denture_complete + sc.complete_denture_ongoing';
	$_data_others = 'sc.others_complete + sc.others_ongoing';
	
	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table[$m.'score'].' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
	$_table = $table[$m.'score'].' sc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_join.') sc_j';
	$_where = 
		"s_uid = '".$s_uid."'"
		.' AND sc.date_update = sc_j.date_update AND sc.st_id = sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = sc.st_id';
	$_data = 
		'sc.*'
		.', '.$_data_second_cr.' AS second_cr'
		.', '.$_data_post_core.' AS post_core'
		.', '.$_data_imp_cr_br.' AS imp_cr_br'
		.', '.$_data_single_cr.' AS single_cr'
		.', '.$_data_br.' AS br'
		.', '.$_data_partial_denture.' AS partial_denture'
		.', '.$_data_complete_denture.' AS complete_denture'
		.', '.$_data_others.' AS others';
	$_sort = 'st_id';
	$order_mode = ASC;
	$_orderby = $order_mode;
	
	$SCORE_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);

	// getDbArray 는 mysql_query 의 리턴값을 리턴하므로, fetch 해줘야 한다
	while( $_ROW = db_fetch_array($SCORE_ROWS) ) $SCORE_ARRAY[$_ROW['st_id']] = $_ROW;
    $target_name = '';
	foreach($SCORE_ARRAY as $SCORE_TMP) {
		$st_id = $SCORE_TMP['st_id'];

		$stid_array = getDbData($table['s_mbrid'],"id='".$st_id."'", '*');
		$stdata_array = getDbData($table['s_mbrdata'], "memberuid='".$stid_array['uid']."'", '*');

		$st_array = array_merge($stid_array, $stdata_array);
		
		$SCORE_ARRAY[$st_id]['st_info'] = $st_array;
		
		if($show_list && $SCORE_TMP['st_id'] == $order){
			
            $target_name = $st_array['name'];
        }
	}
	
	
    $st_id = $order;
    $_data = 'fw.*, pt.pt_name AS pt_name, pt.pt_id AS pt_id, pt.dr_name AS dr_name, mbrdata.name AS st_name';
    $_table = $table[$m.'follow_pt'].' pt, '.$table[$m.'follow'].' fw, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
    $_where = 
        "fw.s_uid = '".$s_uid."'"
        ." AND pt.uid = fw.pt_uid"
        ." AND mbrid.uid = mbrdata.memberuid"
        ." AND mbrid.id = fw.st_id"
        ." AND fw.st_id = '".$st_id."'";
    $_sort = 'fw.type, fw.status';
    $_orderby = 'DESC';
    
    $MY_FOLLOW_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
    $MY_FOLLOW_ARRAY = array();
    while( $_ROW = db_fetch_array($MY_FOLLOW_ROWS) )
    {
        $MY_FOLLOW_ARRAY[$_ROW['pt_uid']] = $_ROW;
    }
?>