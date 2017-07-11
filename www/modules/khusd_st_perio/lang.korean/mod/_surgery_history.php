<?php
    $SCORE_ARRAY = array();
    $recnum = 20;
    $start = ($p - 1) * $recnum;

    $query = "select *, group_concat(distinct win_st_id) as st_ids from "
    ."(select ail.subject, ai.*, al.st_id as win_st_id "
    ." from rb_khusd_st_apply_manager_apply_info_list ail "
    ." left join rb_khusd_st_apply_manager_apply_item ai on ail.uid = ai.apply_info_uid "
    ." left join (select * from rb_khusd_st_apply_manager_apply_list where status = 'a') al on ai.uid = al.apply_item_uid "
    ." where ail.is_perio_surgery = 'y'  and ail.uid > 830 order by ai.apply_info_uid desc)"
    ." results group by date_item, doctor order by date_item desc ";
    
    $limit = " limit ".$start.", ".$recnum." ";

    global $DB_CONNECT;
    $SCORE_ROWS = db_query($query.$limit, $DB_CONNECT);
    
    $idx = 0;
    while( $_ROW = db_fetch_array($SCORE_ROWS) ) $SCORE_ARRAY[$idx++] = $_ROW;

    foreach($SCORE_ARRAY as $idx => $SCORE_TMP) {
            $_R = $SCORE_ARRAY[$idx];
            $SCORE_ARRAY[$idx]['content'] =
                getDateFormat($_R['date_item'],'m/d').'('.getWeek(getDateFormat($_R['date_item'], 'w')).')'
                .' '.getDateFormat($_R['date_item'],'H:i')
                .' '.$_R['pt_name']
                .' '.$_R['doctor']
                .($_R['assist'] && strlen($_R['assist']) > 0 ? '('.$_R['assist'].')' : '')
                .' '.$_R['content'];
                
            $surgery_key = $_R["date_item"]."/".$_R["doctor"];
//            echo $surgery_key."<br />";
            $subquery = "select * from rb_khusd_st_perio_surgery_history where surgery_key = \"".$surgery_key."\"";
            $subrows = db_query($subquery, $DB_CONNECT);
            
            $subarray = array();
            $sub_idx = 0;
            while( $_ROW = db_fetch_array($subrows) ) $subarray[$sub_idx++] = $_ROW;
            $SCORE_ARRAY[$idx]['history'] = $subarray;

    }
    
//  select id as st_id, name as st_name from rb_s_mbrid a left join rb_s_mbrdata b on (a.uid = b.memberuid)
    $member_query = "select id as st_id, name as st_name from rb_s_mbrid a left join rb_s_mbrdata b on (a.uid = b.memberuid)";
    $MEMBER_ROWS = db_query($member_query, $DB_CONNECT);
    $MEMBER_ARRAY = array();
    while( $_ROW = db_fetch_array($MEMBER_ROWS) ) $MEMBER_ARRAY[$_ROW["st_id"]] = $_ROW;
    
//    echo $query;
    $query = "select count(*) from "
    ."(select ail.subject, ai.*, al.st_id as win_st_id "
    ." from rb_khusd_st_apply_manager_apply_info_list ail "
    ." left join rb_khusd_st_apply_manager_apply_item ai on ail.uid = ai.apply_info_uid "
    ." left join (select * from rb_khusd_st_apply_manager_apply_list where status = 'a') al on ai.uid = al.apply_item_uid "
    ." where ail.is_perio_surgery = 'y'   and ail.uid > 830 order by ai.apply_info_uid desc)"
    ." results group by date_item, doctor order by date_item desc ";
    
    $cnts = db_query($query, $DB_CONNECT);
    $NUM = 0;
    while( $_ROW = db_fetch_array($cnts) ) $NUM++;
    $TPG = getTotalPage($NUM, $recnum);

?>
