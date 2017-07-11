<?php
    $SCORE_ARRAY = array();
    $recnum = 20;
    $start = ($p - 1) * $recnum;
    
    if(!isset($st_id) || !$st_id || $st_id == '')
    {
            $st_id = $my['id'];
    }

    $query = "select * from ( select *, group_concat(distinct win_st_id) as st_ids from "
    ."(select ail.subject, ai.*, al.st_id as win_st_id "
    ." from rb_khusd_st_apply_manager_apply_info_list ail "
    ." left join rb_khusd_st_apply_manager_apply_item ai on ail.uid = ai.apply_info_uid "
    ." left join (select * from rb_khusd_st_apply_manager_apply_list where status = 'a') al on ai.uid = al.apply_item_uid "
    ." where ail.is_perio_surgery = 'y'  and ail.uid > 830 order by ai.apply_info_uid desc)"
    ." results group by date_item, doctor order by date_item ) a where st_ids like '%$st_id%'";
    
    //$limit = " limit ".$start.", ".$recnum." ";

    global $DB_CONNECT;
    $SCORE_ROWS = db_query($query, $DB_CONNECT);
    
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
    


    $query2 = "select * from rb_khusd_st_perio_surgery_history where st_id = '$st_id'";
    $ROWS = db_query($query2, $DB_CONNECT);
    
    $idx = count($SCORE_ARRAY);
    while( $_ROW = db_fetch_array($ROWS) ){
        $surgery_key = explode("/",$_ROW['surgery_key']);
        
        
        $query3 = "select * from ( select *, group_concat(distinct win_st_id) as st_ids from "
        ."(select ail.subject, ai.*, al.st_id as win_st_id "
        ." from rb_khusd_st_apply_manager_apply_info_list ail "
        ." left join rb_khusd_st_apply_manager_apply_item ai on ail.uid = ai.apply_info_uid "
        ." left join (select * from rb_khusd_st_apply_manager_apply_list where status = 'a') al on ai.uid = al.apply_item_uid "
        ." where ail.is_perio_surgery = 'y'  and ail.uid > 830 order by ai.apply_info_uid desc)"
        ." results group by date_item, doctor order by date_item ) a where date_item = '".$surgery_key[0]."' and doctor = '".$surgery_key[1]."'";        
        $SUB_ROWS = db_query($query3, $DB_CONNECT);
        $INFO = '';
        while( $SUB_ROW = db_fetch_array($SUB_ROWS) ) $INFO = $SUB_ROW;
        
        $INFO['content'] =
                getDateFormat($INFO['date_item'],'m/d').'('.getWeek(getDateFormat($INFO['date_item'], 'w')).')'
                .' '.getDateFormat($INFO['date_item'],'H:i')
                .' '.$INFO['pt_name']
                .' '.$INFO['doctor']
                .($INFO['assist'] && strlen($INFO['assist']) > 0 ? '('.$INFO['assist'].')' : '')
                .' '.$INFO['content'];
        
        $subquery = "select * from rb_khusd_st_perio_surgery_history where surgery_key = \"".$_ROW['surgery_key']."\"";
        $subrows = db_query($subquery, $DB_CONNECT);
        
        $subarray = array();
        $sub_idx = 0;
        while( $subrow = db_fetch_array($subrows) ) $subarray[$sub_idx++] = $subrow;
        $INFO['history'] = $subarray;
        $SCORE_ARRAY[$idx++] = $INFO;
    }

    function invenDescSort($item1,$item2)
    {
        if ($item1['date_item'] == $item2['date_item']) return 0;
        return ($item1['date_item'] > $item2['date_item']) ? 1 : -1;
    }
    usort($SCORE_ARRAY,'invenDescSort');


//  select id as st_id, name as st_name from rb_s_mbrid a left join rb_s_mbrdata b on (a.uid = b.memberuid)
    $member_query = "select id as st_id, name as st_name from rb_s_mbrid a left join rb_s_mbrdata b on (a.uid = b.memberuid)";
    $MEMBER_ROWS = db_query($member_query, $DB_CONNECT);
    $MEMBER_ARRAY = array();
    while( $_ROW = db_fetch_array($MEMBER_ROWS) ) $MEMBER_ARRAY[$_ROW["st_id"]] = $_ROW;
    
    //echo $query;
?>
