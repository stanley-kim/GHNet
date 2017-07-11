<?php
    $SUR_ARRAY = array();

    $SCORE_ARRAY = array();

    $order_by = $order ? $order : 'st_id';
    $order_mode = 'ASC';

    include_once $g['path_module'].'khusd_st_manager/function/member.php';
    include_once $g['path_module'].'khusd_st_manager/function/debug.php';	// 필수 인클루드 파일
    
    
    $_data_total_surgery = 'surgery+imp_1st+imp_2nd+surgery2+imp_1st2+imp_2nd2';
    
    $_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table[$m.'score']." WHERE s_uid = '".$s_uid."' AND is_goal = 'n' GROUP BY st_id";
    
    $_table = $table[$m.'score']." sc , ".$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_join.') sc_j';//, LEFT JOIN ('.$_follow_table.') AS fw_t ON fw_t.st_id=sc.st_id';
    $_where =
            "mbrdata.tmpcode!='tester' AND ".
            "sc.s_uid = '".$s_uid."'"
            ." AND sc.date_update = sc_j.date_update AND sc.st_id = sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = sc.st_id";
            //." AND fw_t.st_id=sc.st_id";
    $_data = 'sc.*'
            .', ('.$_data_total_surgery.') AS total_surgery';
    $_sort = 'st_id';
    $_orderby = 'ASC';
    
    $SCORE_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
    
    while( $_ROW = db_fetch_array($SCORE_ROWS) ) $SCORE_ARRAY[$_ROW['st_id']] = $_ROW;
    foreach($SCORE_ARRAY as $SCORE_TMP) {
            $st_id = $SCORE_TMP['st_id'];

            $stid_array = getDbData($table['s_mbrid'],"id='".$st_id."'", '*');
            $stdata_array = getDbData($table['s_mbrdata'], "memberuid='".$stid_array['uid']."'", '*');
            $st_array = array_merge($stid_array, $stdata_array);            
            $SCORE_ARRAY[$st_id]['st_info'] = $st_array;
            
            $SCORE_ARRAY[$st_id]['history_perio'] = 0;
            $SCORE_ARRAY[$st_id]['history_imp1'] = 0;
            $SCORE_ARRAY[$st_id]['history_imp2'] = 0;
    }
    
    
    $query = "select *, group_concat(distinct win_st_id) as st_ids from "
    ."(select ail.subject, ai.*, al.st_id as win_st_id "
    ." from rb_khusd_st_apply_manager_apply_info_list ail "
    ." left join rb_khusd_st_apply_manager_apply_item ai on ail.uid = ai.apply_info_uid "
    ." left join (select * from rb_khusd_st_apply_manager_apply_list where status = 'a') al on ai.uid = al.apply_item_uid "
    ." where ail.is_perio_surgery = 'y' and ail.s_uid = 2 order by ai.apply_info_uid desc)"
    ." results group by date_item, doctor order by date_item desc ";
    
    global $DB_CONNECT;
    $SUR_ROWS = db_query($query.$limit, $DB_CONNECT);
    
    $idx = 0;
    while( $_ROW = db_fetch_array($SUR_ROWS) ) $SUR_ARRAY[$idx++] = $_ROW;

    foreach($SUR_ARRAY as $idx => $SUR_TMP) {
            $_R = $SUR_ARRAY[$idx];
            
            $surgery_key = $_R["date_item"]."/".$_R["doctor"];

            $subquery = "select * from rb_khusd_st_perio_surgery_history where surgery_key = \"".$surgery_key."\"";
            $subrows = db_query($subquery, $DB_CONNECT);
            
            $subarray = array();
            $sub_idx = 0;
            while( $_ROW = db_fetch_array($subrows) ) $subarray[$sub_idx++] = $_ROW;
            
            foreach($subarray as $idx => $subitem) {
                if($subitem['type'] == 'c' || $subitem['type'] == 'd'){
                    $sub_idx = -1;
                    break;
                }   
            }
            
            if($sub_idx > 0){
                $st_id = $subarray[$sub_idx-1]['st_id'];
                if($_R['is_imp_cent'] == 1){
                        if(preg_match('/2/',$_R['content'])){
                            $SCORE_ARRAY[$st_id]['history_imp2'] +=1;
                        }else{
                            $SCORE_ARRAY[$st_id]['history_imp1'] +=1;
                        }
                    }else{
                        $SCORE_ARRAY[$st_id]['history_perio'] +=1;                    
                }
            }
            //$SUR_ARRAY[$idx]['history'] = $subarray;
            
            if($sub_idx == 0){
                $win_ids = explode(",",$_R['st_ids']);
                foreach($win_ids as $st_id){
                    
                    if($_R['is_imp_cent'] == 1){
                        if(preg_match('/2/',$_R['content'])){
                            $SCORE_ARRAY[$st_id]['history_imp2'] +=1;
                        }else{
                            $SCORE_ARRAY[$st_id]['history_imp1'] +=1;
                        }   
                    }else{
                        $SCORE_ARRAY[$st_id]['history_perio'] +=1;                    
                    }
                }
            }
            
    }
   
?>
