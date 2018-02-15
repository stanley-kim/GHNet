<?php
	
    $SCORE_ARRAY = array();
    if(!permcheck('over_chief_of_case') && !permcheck('ortho'))
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

$SCORE_PREV_ARRAY = array();
$SCORE_PREV_ARRAY2 = array(); 
    $query = "select st_id, s_uid, pt_uid, step "
." from rb_khusd_st_ortho_follow as f"
." where f.status = 'f' and s_uid = '".'2'."'"
//." where s_uid = 2"
." order by st_id";
global $DB_CONNECT;
$SCORE_PREV_ROWS = db_query($query, $DB_CONNECT);
// __debug_print("[]".mysql_error() );
	while( $_ROW = db_fetch_array($SCORE_PREV_ROWS) ){
__debug_print("IN PREV ACTION".$_ROW['st_id'].'_'.$_ROW['pt_uid']);
        //$SCORE_PREV_ARRAY[$_ROW['st_id'].$_ROW['pt_uid']] = $_ROW;
        $SCORE_PREV_ARRAY[] = $_ROW;
	$SCORE_PREV_ARRAY2[ $_ROW['st_id']][ $_ROW['pt_uid'] ] = $_ROW;
}
$SCORE_CUR_ARRAY = array(); 
    $query = "select st_id, s_uid, pt_uid "
." from rb_khusd_st_ortho_follow as f"
." where f.status = 'f' and s_uid = '".'3'."'"
//." where s_uid = 3"
." order by st_id";

$SCORE_CUR_ROWS = db_query($query, $DB_CONNECT);
// __debug_print("[]".mysql_error() );
	while( $_ROW = db_fetch_array($SCORE_CUR_ROWS) ){
__debug_print("IN CURR ACTION".$_ROW['st_id'].'_'.$_ROW['pt_uid']);
        //$SCORE_PREV_ARRAY[$_ROW['st_id'].$_ROW['pt_uid']] = $_ROW;
        $SCORE_CUR_ARRAY[] = $_ROW;
}

	foreach($SCORE_CUR_ARRAY as $_CUR)   {
		//if( !isset($SCORE_ARRAY[$_CUR['st_id']]['old_pt_count']) )	
        	$SCORE_ARRAY[$_CUR['st_id']]['old_pt_count'] = 0 ;
	}
	foreach($SCORE_PREV_ARRAY as $_PREV)   {
		foreach($SCORE_CUR_ARRAY as $_CUR)   {
		//	if( !isset($SCORE_ARRAY[$_CUR['st_id']]['old_pt_count']) )	
        			//$SCORE_ARRAY[$_CUR['st_id']]['old_pt_count'] = 0 ;
						
			if( $_PREV['st_id'] == $_CUR['st_id'] &&
				$_PREV['pt_uid'] == $_CUR['pt_uid'] )    {
//__debug_print("IN UPDATE ACTION".$_PREV['st_id'].'_'.$_PREV['pt_uid']);
        			$SCORE_ARRAY[$_PREV['st_id']]['old_pt_count'] += 1    ;
			}
		}
	}

    $query = "select st_id, pt_uid, pt_name, dr_room, pt_id, name, type, count(*) as room_count"
." from rb_khusd_st_ortho_follow as f"
." left join rb_khusd_st_ortho_follow_pt as fpt on f.pt_uid = fpt.uid"
." left join rb_s_mbrid as mbr on f.st_id = mbr.id"
." left join rb_s_mbrdata as mbrd on mbr.uid = mbrd.memberuid"
//." where f.status = 'f' and s_uid = '2'"
." where f.status = 'f' and s_uid = '".'3'."'"
." group by st_id, dr_room, type";
	
	
	global $DB_CONNECT;
	$SCORE_ROWS = db_query($query, $DB_CONNECT);
    $target_name = '';
	// getDbArray 는 mysql_query 의 리턴값을 리턴하므로, fetch 해줘야 한다
	while( $_ROW = db_fetch_array($SCORE_ROWS) ){
        $SCORE_ARRAY[$_ROW['st_id']]['st_id'] = $_ROW['st_id'];
        $SCORE_ARRAY[$_ROW['st_id']]['st_name'] = $_ROW['name'];
        $SCORE_ARRAY[$_ROW['st_id']]['room_'.$_ROW['dr_room'].'_'.$_ROW['type']] = $_ROW['room_count'];
        
        $SCORE_ARRAY[$_ROW['st_id']]['total'] += $_ROW['room_count'];
        $SCORE_ARRAY[$_ROW['st_id']]['total_'.$_ROW['type']] += $_ROW['room_count'];
        
        if(intval($_ROW['room_count']) >= 3 && $_ROW['type'] == '1'){
            $SCORE_ARRAY[$_ROW['st_id']]['room_'.$_ROW['dr_room'].'_'.$_ROW['type']] = '<b style="color:red">'.$_ROW['room_count'].'</b>';
        }
        
        if($show_list && $_ROW['st_id'] == $order){
            $target_name = $_ROW['name'];
        }


    }
    
    $st_id = $order;
    $_data = 'fw.*, pt.pt_name AS pt_name, pt.pt_id AS pt_id, pt.dr_room AS dr_room, pt.pf_name AS pf_name, pt.dr_name AS dr_name, mbrdata.name AS st_name';
    $_table = $table[$m.'follow_pt'].' pt, '.$table[$m.'follow'].' fw, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
    $_where = 
        "fw.s_uid = '".$s_uid."'"
        ." AND pt.uid = fw.pt_uid"
        ." AND mbrid.uid = mbrdata.memberuid"
        ." AND mbrid.id = fw.st_id"
        ." AND fw.st_id = '".$st_id."'";
    $_sort = 'fw.date_update';
    $_orderby = 'DESC';
    
    $MY_FOLLOW_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
    $MY_FOLLOW_ARRAY = array();
    while( $_ROW = db_fetch_array($MY_FOLLOW_ROWS) )
    {
        $MY_FOLLOW_ARRAY[$_ROW['pt_uid']] = $_ROW;
    }
	
	
	    $query = "select st_id, count(*) as giveup"
." from rb_khusd_st_ortho_follow as f"
." left join rb_khusd_st_ortho_follow_pt as fpt on f.pt_uid = fpt.uid"
." left join rb_s_mbrid as mbr on f.st_id = mbr.id"
." left join rb_s_mbrdata as mbrd on mbr.uid = mbrd.memberuid"
." where f.status = ''"
." group by st_id";
	
	
	global $DB_CONNECT;
	$SCORE_ROWS = db_query($query, $DB_CONNECT);
	// getDbArray 는 mysql_query 의 리턴값을 리턴하므로, fetch 해줘야 한다
	while( $_ROW = db_fetch_array($SCORE_ROWS) ){
        $SCORE_ARRAY[$_ROW['st_id']]['giveup'] = $_ROW['giveup'];

    }

    $_data = 'fw.*, pt.pt_name AS pt_name, pt.pt_id AS pt_id, pt.dr_room AS dr_room, pt.pf_name AS pf_name, pt.dr_name AS dr_name, mbrdata.name AS st_name';
    $_table = $table[$m.'follow_pt'].' pt, '.$table[$m.'follow'].' fw, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
    $_where = 
        "fw.s_uid = '".$s_uid."'"
        ." AND pt.uid = fw.pt_uid"
        ." AND mbrid.uid = mbrdata.memberuid"
        ." AND mbrid.id = fw.st_id";
    $_sort = 'fw.st_id ASC, fw.type DESC, fw.status DESC';
    //$_orderby = 'DESC';
    //$_orderby = 'ASC';
    $_orderby = '';
    
    $TOTAL_FOLLOW_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
 __debug_print("[1]".mysql_error() );
    $TOTAL_FOLLOW_ARRAY = array();
    while( $_ROW = db_fetch_array($TOTAL_FOLLOW_ROWS) )
    {
        //$TOTAL_FOLLOW_ARRAY[$_ROW['pt_uid']] = $_ROW;
        $TOTAL_FOLLOW_ARRAY[] = $_ROW;
    }




?>
