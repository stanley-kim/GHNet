<?php
if(!defined('__KIMS__')) exit;
include_once $g['path_module'].'khusd_st_manager/function/debug.php';

/*******
 * 현재 과 이름 정의
 * 이건 과마다 당연히 바꿔줘야.... 과에 대한 모듈이 아니면 필요 없음
 *******/
$d['khusd_st_manager']['isperm'] = true;

include_once $g['dir_module'].'var/var.php'; // 모듈변수파일 인클루드

// 이게 false 면 권한이 없는 것
include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일


// 관리자 권한이 있다면 변수에 표시
//if(!permcheck('chief_of_case'))
if(!permcheck('manager'))
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
	$d['khusd_st_manager']['isperm'] = false;
}

if(permcheck('manager'))
{
	$MANAGER = true;
}


////////////////////////////////
// 여기까지는 각 과마다 루틴한 작업
////////////////////////////////
$mode = $mode ? $mode : 'update_check'; //테마 초기접속모드

/** logic 부분 **/
if($mode == 'score_history' && $MANAGER) {
	include_once $g['path_module'].'khusd_st_apply_manager/var/var.define.php';
	include_once $g['path_module'].'khusd_st_manager/function/member.php';

	if($st_name && !$st_id){
		$st_id = getSTInfoByName($st_name);
	}
} else if($mode == 'apply_history' && $MANAGER) {

	include_once $g['path_module'].'khusd_st_apply_manager/var/var.define.php';
	include_once $g['path_module'].'khusd_st_manager/function/member.php';

	$APPLY_ARRAY = array();
	if($st_name && !$st_id){
		$st_id = getSTInfoByName($st_name);
	}
	if($st_id)
	{
		$info = getSTInfo($st_id);
		$st_name = $info['name'];
		$_sort = 'date_reg';
		$_orderby = 'DESC';
		$recnum = $recnum && $recnum < 200 ? $recnum : $d['khusd_st_manager']['recnum'];

		$NUM = getDbRows(
			$table['khusd_st_apply_manager'.'apply_list'].' al'
			.', '.$table['khusd_st_apply_manager'.'apply_info_list'].' ail'
			.', '.$table['khusd_st_apply_manager'.'apply_item'].' ai', 

			"al.st_id = '".$st_id."'"
			." AND ("
				."al.status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'"
				." OR al.status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
			." )"
			." AND al.apply_info_uid = ail.uid" 
			." AND al.apply_item_uid = ai.uid"
		);

		$TCD = getDbArray(
			$table['khusd_st_apply_manager'.'apply_list'].' al'
			.', '.$table['khusd_st_apply_manager'.'apply_info_list'].' ail'
			.', '.$table['khusd_st_apply_manager'.'apply_item'].' ai', 

			"al.st_id = '".$st_id."'"
			." AND ("
				."al.status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'"
				." OR al.status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
			." )"
			." AND al.apply_info_uid = ail.uid" 
			." AND al.apply_item_uid = ai.uid",

			"al.*"
			.", IF(ail.status = '".$d['khusd_st_apply_manager']['apply_info']['CLOSED']."', 1, 0) AS is_closed"
			.", ail.subject AS apply_info_subject"
			.", ail.date_start AS date_start"
			.", ail.department AS department"
			.", ail.uid AS apply_info_uid"
			.", ai.content AS apply_item_content",
			
			$_sort, 
			$_orderby, 
			$recnum, 
			$p
		);
		
		
		/*
		echo "select al.*"
			.", IF(ail.status = '".$d['khusd_st_apply_manager']['apply_info']['CLOSED']."', 1, 0) AS is_closed"
			.", ail.subject AS apply_info_subject"
			.", ail.date_start AS date_start"
			.", ail.department AS department"
			.", ail.uid AS apply_info_uid"
			.", ai.content AS apply_item_content ";
			
		echo "from ".$table['khusd_st_apply_manager'.'apply_list'].' al'
			.', '.$table['khusd_st_apply_manager'.'apply_info_list'].' ail'
			.', '.$table['khusd_st_apply_manager'.'apply_item'].' ai ';
			
		echo "where al.st_id = '".$st_id."'"
			." AND ("
				."al.status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'"
				." OR al.status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
			." )"
			." AND al.apply_info_uid = ail.uid" 
			." AND al.apply_item_uid = ai.uid";*/
		
		while($_R = db_fetch_array($TCD)) $APPLY_ARRAY[] = $_R;
	
		$TPG = getTotalPage($NUM, $recnum);
		$ST_INFO = getSTInfo($st_id);
	}else{
	
//dup check start
                $check_start_code = ( 12 - date("w", time()   ) )%7 - 4 ;
                $check_start_time = date("Ymd", time() + 60*60*24*$check_start_code).'000000';

                $TCC = getDbArray(
                        $table['khusd_st_apply_manager'.'apply_list'].' al'
                        .', '.$table['khusd_st_apply_manager'.'apply_info_list'].' ail'
                        .', '.$table['khusd_st_apply_manager'.'apply_item'].' ai',

                        "("
                                ."al.status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'"
                                ." OR al.status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
                        ." )"
                        ." AND al.apply_info_uid = ail.uid"
                        ." AND al.apply_item_uid = ai.uid"
                        ." AND ai.date_item >= ".$check_start_time,
                        "al.*"
                        .", IF(ail.status = '".$d['khusd_st_apply_manager']['apply_info']['CLOSED']."', 1, 0) AS is_closed"
                        .", ail.subject AS apply_info_subject"
                        .", ail.date_start AS date_start"
                        .", ail.date_end AS date_end"
                        .", ail.date_select AS date_select"
                        .", ail.department AS department"
                        .", ail.uid AS apply_info_uid"
                        .", ai.date_item AS date_item"
                        .", ai.sub_category AS sub_category"
                        .", ai.content AS apply_item_content",

                        'al.st_id' ,
                        'asc' ,
                        //'desc' ,
                        0,
                        0
                );

        __debug_print("db_query_4_detect. - " . mysql_error());
        $Duplicate_Check_Dic = array();
        while($_R = db_fetch_array($TCC))   {
                $mesial =  intval(intval( $_R['date_item']) / 1000000)   ;
                $distal =  intval( $_R['date_item']) % 1000000   ;
                __debug_print("print each rows. - " .$mesial. ' ' .$distal   );
                if ( $mesial > 20170101 && $_R['rand']!= 0   )  {
                        if ( $distal < 120000 )
                                $Duplicate_Check_Dic[$_R['st_id'] ][$mesial]["morning"][$_R['date_end']][$_R['uid']   ]=$_R;
                        elseif ( $distal >= 120000 AND $distal < 180000 )
                                $Duplicate_Check_Dic[$_R['st_id']][$mesial]["afternoon"][$_R['date_end']][$_R['uid']   ]=$_R;
                        else
                                $Duplicate_Check_Dic[$_R['st_id']][$mesial]["night"][$_R['date_end']][$_R['uid']   ]=$_R;
                }

        }
/*
        foreach($Duplicate_Check_Dic as $dcd1)  // each st_id
                foreach($dcd1 as $dcd2)         // each day
                        foreach($dcd2 as $dcd3)    { // each time
                                //sort($dcd3 ) 1st try;
                                ksort($dcd3, SORT_NUMERIC ) ;
                                $a_flag = 0;
                                foreach($dcd3 as $dcd4)    { // each date_end
__debug_print("dup count - " . count($dcd4)  );
                                        if( count($dcd4)>= 2 )  { __debug_print("duplicate!!------------------>>  "  );

                                        foreach($dcd4 as $dcd5)  {  // each uid
__debug_print("each dup_rs-".$dcd5['st_id'].'/'.$dcd5['date_item'].'/'.$dcd5['date_end'].'/'.$dcd5['status'].'/'.$dcd5['rand']   );
__debug_print("            ".$dcd5['st_id'].'/'.$dcd5['apply_item_content'].'/'.$dcd5['apply_info_subject'].'/'.$dcd5['status'].'/'.$dcd5['rand']   );

                                        }
                                        }
                                        else  {

                                        foreach($dcd4 as $dcd5)  {  // each uid
if ($a_flag > 0 ) __debug_print("duplicate!----------------->" ) ;
if ($dcd5['status'] == 'a' ) $a_flag = 1;
__debug_print("each nor_rs-".$dcd5['st_id'].'/'.$dcd5['date_item'].'/'.$dcd5['date_end'].'/'.$dcd5['status'].'/'.$dcd5['rand']   );
__debug_print("            ".$dcd5['st_id'].'/'.$dcd5['apply_item_content'].'/'.$dcd5['apply_info_subject'].'/'.$dcd5['status'].'/'.$dcd5['rand']   );

                                        }


                                        }
                                }
                        }
//dup check end
*/


	
	$_data = 'al.st_id as avg_st_id, mbrdata.name as avg_name, count(*) as total_count, AVG(al.rand) as avg_rand';
	$_table = 			$table['khusd_st_apply_manager'.'apply_list'].' al'
			.', '.$table['khusd_st_apply_manager'.'apply_info_list'].' ail'
			.', '.$table['khusd_st_apply_manager'.'apply_item'].' ai'
			.', '.$table['s_mbrdata'].' mbrdata ,'.$table['s_mbrid'].' mbrid';
	$_where = "mbrid.uid = mbrdata.memberuid AND mbrid.id = al.st_id and (al.status = 'p' OR al.status = 'a' ) AND al.apply_info_uid = ail.uid AND al.apply_item_uid = ai.uid  and rand != 0 group by al.st_id order by al.st_id";
	$AVG = db_query('SELECT '.$_data.' FROM '.$_table.' WHERE '.$_where, $DB_CONNECT);

	$AVG_ARRAY = array();
//	echo 'SELECT '.$_data.' FROM '.$_table.' WHERE '.$_where;
	///////while($_R = db_fetch_array($AVG)) $AVG_ARRAY[] = $_R;
	while($_R = db_fetch_array($AVG)) {
		$AVG_ARRAY[$_R['avg_st_id']] = $_R;
		$AVG_ARRAY[$_R['avg_st_id']]["a"] = 0;
		$AVG_ARRAY[$_R['avg_st_id']]["p"] = 0;
	}
	$_where = "mbrid.uid = mbrdata.memberuid AND mbrid.id = al.st_id and al.apply_info_uid = ail.uid AND al.apply_item_uid = ai.uid and al.status = 'a' and rand != 0 group by al.st_id order by al.st_id";
	$AVG_DETAIL = db_query('SELECT '.$_data.' FROM '.$_table.' WHERE '.$_where, $DB_CONNECT);
	$idx = 0;
	while($_R = db_fetch_array($AVG_DETAIL)){
		$AVG_ARRAY[$_R['avg_st_id']]["a"] = $_R['total_count'];
		
		$AVG_ARRAY[$_R['avg_st_id']]["a_ratio"] = $_R['total_count']/$AVG_ARRAY[$_R['avg_st_id']]["total_count"]*100;
		$idx++;
	}
	
	$_where = "mbrid.uid = mbrdata.memberuid AND mbrid.id = al.st_id and al.apply_info_uid = ail.uid AND al.apply_item_uid = ai.uid and al.status = 'p' and rand != 0 group by al.st_id order by al.st_id";
	$AVG_DETAIL = db_query('SELECT '.$_data.' FROM '.$_table.' WHERE '.$_where, $DB_CONNECT);
	$idx = 0;
	while($_R = db_fetch_array($AVG_DETAIL)){
		$AVG_ARRAY[$_R['avg_st_id']]["p"] = $_R['total_count'];
		$idx++;
	}	
	

	//print_r($AVG_ARRAY);
	}
}
elseif($mode == 'update_check' && $d['khusd_st_manager']['isperm']) {
		include_once $g['path_module'].'khusd_st_manager/function/date.php';
		$yesterday = date('Y-m-d',strtotime("-1 days"));
		$today = date('Y-m-d');

		//echo $start_hour.":".$start_min;
		//$base_date = $base_date ? $base_date : $date['today'];
		$_INFO = array();
		//$_INFO["date_start_date"] = substr($date['today'], 0, 4)."-".substr($date['today'], 4, 2)."-".substr($date['today'], 6, 2);
		$_INFO["date_start_date"] = $start_date? $start_date : $yesterday;
		$_INFO["date_start_hour"] = $start_hour? $start_hour : '22';
		$_INFO["date_start_minute"] = $start_min? $start_min : '00';
		$_INFO["date_end_date"] = $end_date? $end_date : $today;		
		$_INFO["date_end_hour"] = $end_hour? $end_hour : '22';
		$_INFO["date_end_minute"] = $end_min? $end_min : '00';

		$start_date = str_replace("-","",$_INFO["date_start_date"]).$_INFO["date_start_hour"].$_INFO["date_start_minute"].'00';
		$end_date = str_replace("-","",$_INFO["date_end_date"]).$_INFO["date_end_hour"].$_INFO["date_end_minute"].'00';

		//$base_date_t = mktimeFromYmd($base_date);
		//$mon_t = getMonDateTimestamp($base_date);		// 오늘이 포함된 주의 월요일 구하기
		//$sun_t = getSunDateTimestamp($base_date);		// 오늘이 포함된 주의 일요일 구하기
		//
		//$start_date_t = $mon_t + ($d['khusd_st_manager']['update_check']['start_day'] - 1) * 24 * 60 * 60;
		//$start_date_t += $d['khusd_st_manager']['update_check']['start_hour'] * 60 * 60;
		//$end_date_t = $mon_t + ($d['khusd_st_manager']['update_check']['end_day'] - 1) * 24 * 60 * 60;
		//$end_date_t += $d['khusd_st_manager']['update_check']['end_hour'] * 60 * 60;
		//
		//$start_date = date('YmdHis', $start_date_t);
		//$end_date = date('YmdHis', $end_date_t);
		//
		//$start_date_t_2nd = $mon_t + ($d['khusd_st_manager']['update_check_2nd']['start_day'] - 1) * 24 * 60 * 60;
		//$start_date_t_2nd += $d['khusd_st_manager']['update_check_2nd']['start_hour'] * 60 * 60;
		//$end_date_t_2nd = $mon_t + ($d['khusd_st_manager']['update_check_2nd']['end_day'] - 1) * 24 * 60 * 60;
		//$end_date_t_2nd += $d['khusd_st_manager']['update_check_2nd']['end_hour'] * 60 * 60;
		//
		//$start_date_2nd = date('YmdHis', $start_date_t_2nd);
		//$end_date_2nd = date('YmdHis', $end_date_t_2nd);
		//
		//$is_first = true;
		//if($round == 2){
		//	$is_first = false;
		//	$start_date = $start_date_2nd;
		//	$end_date = $end_date_2nd;
		//}
	
		// 검사하고자 선택한 과를 배열로 변환
		$check_dept = array();
		foreach($dept_array as $dept)
		{
			if($GLOBALS['check_'.$dept['id']])
			{
				$check_dept[] = $dept['id'];
				if(!$MANAGER && !permcheck($dept['id']))
					unset($GLOBALS['check_'.$dept['id']]);
			}
		}
		
		$UPDATE_CHECK = array();
		$UPDATE_LIST = array();
		foreach( $check_dept as $dept_id )
		{
			// 검사하고자 하는 과에 대해 관리자 권한이 있는지 확인
			if(!$MANAGER && !permcheck($dept_id))	getLink('','',$dept_array[$dept_id]['name'].'에 대해 관리자 권한이 없습니다.','-1');

			$UPDATE_LIST[$dept_id] = array();
			
/*
			$_join = 'SELECT MAX(date_update) date_update, st_id FROM '.$table['khusd_st_'.$dept_id.'score'].' GROUP BY st_id';
			$_table = $table['khusd_st_'.$dept_id.'score'].' sc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_join.') sc_j';
			$_where = "sc.date_update = sc_j.date_update AND sc.st_id = sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = sc.st_id";
			$_data = "sc.st_id, mbrdata.name, sc.date_update, IF(sc.date_update < '".$start_date."' OR sc.date_update > '".$end_date."','notyet','updated') AS update_status";
			$_orderby = 'sc.st_id ASC';
*/
			$_update_list_query = 'SELECT date_update, st_id FROM '.$table['khusd_st_'.$dept_id.'score'].' WHERE date_update >= '.$start_date.' AND date_update <= '.$end_date;
			//echo $_update_list_query."<br />";
			global $DB_CONNECT;
			$UPDATE_LIST_ROWS = db_query($_update_list_query, $DB_CONNECT);
			while($_UPDATE_LIST_ROW = db_fetch_array($UPDATE_LIST_ROWS)) $UPDATE_LIST[$dept_id][$_UPDATE_LIST_ROW['st_id']] = true;

			// full list of member
			$_table = $table['khusd_st_'.$dept_id.'score'].' sc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
			$_where = "mbrid.uid = mbrdata.memberuid AND mbrid.id = sc.st_id";
			$_data = "sc.st_id, mbrdata.name";
			$_orderby = 'sc.st_id ASC';
			$_groupby = 'sc.st_id';
			
			$UPDATE_ROWS = db_query('SELECT '.$_data.' FROM '.$_table.' WHERE '.$_where.' GROUP BY '.$_groupby.' ORDER BY '.$_orderby, $DB_CONNECT);
			while($_UPDATE_ROW = db_fetch_array($UPDATE_ROWS))
			{
				$st_id = $_UPDATE_ROW['st_id'];
				if(!$UPDATE_CHECK[$st_id]) 
				{
					$UPDATE_CHECK[$st_id] = array();
					$UPDATE_CHECK[$st_id]['st_id'] = $_UPDATE_ROW['st_id'];
					$UPDATE_CHECK[$st_id]['name'] = $_UPDATE_ROW['name'];
				}

//				$UPDATE_CHECK[$st_id][$dept_id] = array( 'update_status' => $_UPDATE_ROW['update_status'], 'date_update' => $_UPDATE_ROW['date_update'] );
			}
		}
}
//elseif( ( $mode == 'verification' && $MANAGER)  || $mode == 'koda' ) {
elseif(  $mode == 'verification' && $MANAGER   ) {

        include_once $g['path_module'].'khusd_st_apply_manager/var/var.define.php';
        include_once $g['path_module'].'khusd_st_manager/function/member.php';
	include_once $g['path_module'].'khusd_st_consv/var/var.score.php';

        if($st_name && !$st_id){
                $st_id = getSTInfoByName($st_name);
        }

	function isSameTime( $date_item0, $date_item1) {
                $mesial0 =  intval(intval( $date_item0) / 1000000)   ;     //morning
                $mesial1 =  intval(intval( $date_item1) / 1000000)   ;     //morning
                $distal0 =  intval( $date_item0) % 1000000   ;             //afternoon
                $distal1 =  intval( $date_item1) % 1000000   ;             //afternoon
                __debug_print("print isSameTime para0. - " .$mesial0. ' ' .$distal0   );
                __debug_print("print isSameTime para1. - " .$mesial1. ' ' .$distal1   );
                if ( $mesial0 == $mesial1 )     {
                        if     ( $distal0  < 120000 && $distal1 <  120000 )   {
                		__debug_print("print each SameTimerowsMor. - " .$distal0. ' ' .$distal1   );
				return true;
			}
                        elseif ( $distal0 >= 120000 && $distal0 <  180000 &&  $distal1 >= 120000 && $distal1 < 180000 )   {
                		__debug_print("print each SameTimerowsAft. - " .$distal0. ' ' .$distal1   );
				return true;
			}
                        elseif ( $distal0 >= 180000 && $distal1 >= 180000 )    {
                		__debug_print("print each SameTimerowsEve. - " .$distal0. ' ' .$distal1   );
				return true;
			}
                        
		}
		return false;
	}

	$SEMESTER_INFO = getCurrentSemesterInfo();

        $SCORE_ARRAY = array();

        $order_by = $order ? $order : 'perio_sc.st_id';
        $order_mode = 'ASC';

        //$s_uid = '2';
	$s_uid = $SEMESTER_INFO['sid'];
        $_data_perio_ch_iot = 'perio_sc.iot + perio_sc.charting';
        $_data_perio_total_surgery = 'perio_sc.surgery+perio_sc.imp_1st+perio_sc.imp_2nd+perio_sc.surgery2+perio_sc.imp_1st2+perio_sc.imp_2nd2';
        $_data_radio_decoding_filming = 'radio_sc.obser_decoding + radio_sc.obser_filming';
        $_data_medi_prof_fix = 'medi_sc.fix_am + medi_sc.fix_pm';
        $_data_medi_splint = 'medi_sc.splint_impression + 0.5*medi_sc.splint_polishing';

        $consv_score_const = $d['khusd_st_consv']['score']['st'];

	$_data_consv_st_op_score = 
                 '  consv_sc.st_op_tooth_colored_cervical * '.$consv_score_const['st_op_simple']
                .' + consv_sc.st_op_tooth_colored_simple * '.$consv_score_const['st_op_simple']
                .' + consv_sc.st_op_tooth_colored_complex * '.$consv_score_const['st_op_complex']
               .' + consv_sc.st_op_tooth_colored_diastema * '.$consv_score_const['st_op_diastema']
                .' + consv_sc.st_op_am_simple * '.$consv_score_const['st_op_simple']
                .' + consv_sc.st_op_am_complex * '.$consv_score_const['st_op_complex'];

	$_data_consv_st_op_prev_cur_score = 
		$_data_consv_st_op_score 
                .' - consv_sc.st_op_prev_score ';


        $_data_post_core = 'pros_sc.post_core_complete + pros_sc.post_core_ongoing + pros_sc.post_core_complete_prof + pros_sc.post_core_ongoing_prof';
        $_data_imp_cr_br = 'pros_sc.imp_cr_br_complete_prof + pros_sc.imp_cr_br_ongoing_prof + pros_sc.imp_cr_br_complete + pros_sc.imp_cr_br_ongoing';
        $_data_single_cr = 'pros_sc.single_cr_complete_prof + pros_sc.single_cr_ongoing_prof + pros_sc.single_cr_complete + pros_sc.single_cr_ongoing';
        $_data_br = 'pros_sc.br_complete + pros_sc.br_ongoing + pros_sc.br_complete_prof + pros_sc.br_ongoing_prof';
        $_data_partial_denture = 'pros_sc.partial_denture_complete + pros_sc.partial_denture_ongoing + pros_sc.partial_denture_complete_prof + pros_sc.partial_denture_ongoing_prof ';
        $_data_complete_denture = 'pros_sc.complete_denture_complete + pros_sc.complete_denture_ongoing + pros_sc.complete_denture_complete_prof + pros_sc.complete_denture_ongoing_prof ';


	$_data_pedia_prof_fix = 'pedia_sc.prof_fix_am + pedia_sc.prof_fix_pm' ;

        //$_perio_join = 'SELECT MAX(date_update) date_update,st_id FROM '.'rb_khusd_st_perio_score '." WHERE s_uid = '".$s_uid."' AND is_goal = 'n' GROUP BY st_id";
        $_perio_join = 'SELECT MAX(uid) uid,st_id FROM '.'rb_khusd_st_perio_score '." WHERE s_uid = '".$s_uid."' AND is_goal = 'n' GROUP BY st_id ";
       //   $_oms_join = 'SELECT MAX(date_update) date_update,st_id FROM '.'rb_khusd_st_oms_score'.' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
          $_oms_join = 'SELECT MAX(uid) uid,st_id FROM '.'rb_khusd_st_oms_score'.' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
        //$_radio_join = 'SELECT MAX(date_update) date_update,st_id FROM '.'rb_khusd_st_radio_score'.' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
        $_radio_join = 'SELECT MAX(uid) uid,st_id FROM '.'rb_khusd_st_radio_score'.' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
        $_medi_join = 'SELECT MAX(uid) uid,st_id FROM '.'rb_khusd_st_medi_score'.' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
        $_consv_join ='SELECT MAX(uid) uid,st_id FROM '.'rb_khusd_st_consv_score'.' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
        $_pros_join = 'SELECT MAX(uid) uid,st_id FROM '. 'rb_khusd_st_pros_score'.' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
        $_pedia_join = 'SELECT MAX(uid) uid,st_id FROM '. 'rb_khusd_st_pedia_score'.' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
        $_ortho_join = 'SELECT MAX(uid) uid,st_id FROM '. 'rb_khusd_st_ortho_score'.' WHERE s_uid = '.$s_uid.' GROUP BY st_id';

        $_table = 'rb_khusd_st_perio_score perio_sc,'.'rb_khusd_st_oms_score oms_sc,'.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_perio_join.') perio_sc_j, ('.$_oms_join.') oms_sc_j ' ;
        $_where =
                "mbrdata.tmpcode!='tester' AND ".
                "perio_sc.s_uid = '".$s_uid."'"
                ."AND oms_sc.s_uid = '".$s_uid."'"
                ." AND perio_sc.uid = perio_sc_j.uid AND perio_sc.st_id = perio_sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = perio_sc.st_id AND oms_sc.uid = oms_sc_j.uid AND oms_sc.st_id = oms_sc_j.st_id AND mbrid.id = oms_sc.st_id";

        $_data = 'perio_sc.*'
                .', oms_sc.imp_1st AS oms_imp_1st'
                .', oms_sc.st_case AS oms_st_case'
                .', ('.$_data_perio_ch_iot.') AS perio_ch_iot'
                .', ('.$_data_perio_total_surgery.') AS perio_total_surgery';

        $_sort = $order_by;
        $_orderby = $order_mode;

        $SCORE_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
        $order_by = 'radio_sc.st_id';
        $_table = 'rb_khusd_st_radio_score radio_sc,'.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_radio_join.') radio_sc_j ';
        $_where =
                "mbrdata.tmpcode!='tester' AND ".
                "radio_sc.s_uid = '".$s_uid."'"
                ." AND radio_sc.uid = radio_sc_j.uid AND radio_sc.st_id = radio_sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = radio_sc.st_id";
        $_data = 'radio_sc.obser_decoding AS radio_obser_decoding'
                .', radio_sc.obser_filming AS radio_obser_filming'
                .', radio_sc.taking AS radio_taking'
                .', radio_sc.st_id AS radio_sc_st_id'
                .', ('.$_data_radio_decoding_filming.') AS radio_decoding_filming';
        $_sort = $order_by;
        $_orderby = $order_mode;
        $SCORE_ROWS2 = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);


        //while( $_ROW  = db_fetch_array($SCORE_ROWS) ) {
        //       $_ROW2 = db_fetch_array($SCORE_ROWS2);
        //      $_ROW3 = $_ROW + $_ROW2;

        //      $SCORE_ARRAY[$_ROW['st_id']] = $_ROW3;
        //}


        $order_by = 'medi_sc.st_id';
        $_table = 'rb_khusd_st_medi_score medi_sc,'.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_medi_join.') medi_sc_j ';
        $_where =
                "mbrdata.tmpcode!='tester' AND ".
                "medi_sc.s_uid = '".$s_uid."'"
                ." AND medi_sc.uid = medi_sc_j.uid AND medi_sc.st_id = medi_sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = medi_sc.st_id";
        $_data = 'medi_sc.fix_am AS medi_fix_am'
                .', medi_sc.fix_pm AS medi_fix_pm'
                .', medi_sc.splint_impression AS medi_splint_in'
                .', medi_sc.splint_polishing AS medi_splint_out'
                .', medi_sc.st_id AS medi_sc_st_id'
                .', ('.$_data_medi_prof_fix.') AS medi_prof_fix'
                .', ('.$_data_medi_splint.') AS medi_splint';
        $_sort = $order_by;
        $_orderby = $order_mode;
        $SCORE_ROWS3 = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);

        $order_by = 'consv_sc.st_id';
        $_table = 'rb_khusd_st_consv_score consv_sc,'.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_consv_join.') consv_sc_j ';
        $_where =
                "mbrdata.tmpcode!='tester' AND ".
                "consv_sc.s_uid = '".$s_uid."'"
                ." AND consv_sc.uid = consv_sc_j.uid AND consv_sc.st_id = consv_sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = consv_sc.st_id";
        $_data = 'consv_sc.surgery AS consv_surgery'
                .', consv_sc.st_op_tooth_colored_cervical  AS consv_st_op_tooth_colored_cervical '
                .', consv_sc.st_op_tooth_colored_simple AS consv_st_op_tooth_colored_simple '
                .', consv_sc.st_op_tooth_colored_complex  AS consv_st_op_tooth_colored_complex '
                .', consv_sc.st_op_tooth_colored_diastema AS consv_st_op_tooth_colored_diastema '
                .', consv_sc.st_op_prev_score AS consv_st_op_prev_score '
                .', consv_sc.st_endo_1 AS consv_st_endo_1 '
                .', consv_sc.st_endo_2 AS consv_st_endo_2 '
                .', ('.$_data_consv_st_op_score.') AS consv_st_op_score '
                .', ('.$_data_consv_st_op_prev_cur_score.') AS consv_st_op_prev_cur_score '
                .', consv_sc.st_inlay_1_proc  AS consv_st_inlay_1_proc '
                .', consv_sc.st_inlay_2_proc  AS consv_st_inlay_2_proc '
                .', consv_sc.st_inlay_1_case  AS consv_st_inlay_1_case '
                .', consv_sc.st_inlay_2_case  AS consv_st_inlay_2_case ';
        $_sort = $order_by;
        $_orderby = $order_mode;
        $SCORE_ROWS4 = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);

        $order_by = 'pros_sc.st_id';
        $_table = 'rb_khusd_st_pros_score pros_sc,'.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_pros_join.') pros_sc_j ';
        $_where =
                "mbrdata.tmpcode!='tester' AND ".
                "pros_sc.s_uid = '".$s_uid."'"
                ." AND pros_sc.uid = pros_sc_j.uid AND pros_sc.st_id = pros_sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = pros_sc.st_id";
        $_data = '  pros_sc.s_uid AS pros_s_uid'
                .', pros_sc.st_case_1 AS pros_st_case_1'
                .', pros_sc.st_case_2 AS pros_st_case_2'
                .', pros_sc.st_case_3 AS pros_st_case_3'
                .', ('.$_data_post_core.') AS pros_post_core'
                .', ('.$_data_imp_cr_br.') AS pros_imp_cr_br'
                .', ('.$_data_single_cr.') AS pros_single_cr'
                .', ('.$_data_br.')        AS pros_br'
                .', ('.$_data_partial_denture.')  AS pros_partial_denture'
                .', ('.$_data_complete_denture.') AS pros_complete_denture';
        $_sort = $order_by;
        $_orderby = $order_mode;
        $SCORE_ROWS5 = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);

        $order_by = 'pedia_sc.st_id';
        $_table = 'rb_khusd_st_pedia_score pedia_sc,'.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_pedia_join.') pedia_sc_j ';
        $_where =
                "mbrdata.tmpcode!='tester' AND ".
                "pedia_sc.s_uid = '".$s_uid."'"
                ." AND pedia_sc.uid = pedia_sc_j.uid AND pedia_sc.st_id = pedia_sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = pedia_sc.st_id";
        $_data = '  pedia_sc.s_uid AS pedia_s_uid'
                .', pedia_sc.ga AS pedia_ga'
                .', pedia_sc.st_point AS pedia_st_point'
                .', ('.$_data_pedia_prof_fix.') AS pedia_prof_fix';
        $_sort = $order_by;
        $_orderby = $order_mode;
        $SCORE_ROWS6 = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);

        $order_by = 'ortho_sc.st_id';
        $_table = 'rb_khusd_st_ortho_score ortho_sc,'.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_ortho_join.') ortho_sc_j ';
        $_where =
                "mbrdata.tmpcode!='tester' AND ".
                "ortho_sc.s_uid = '".$s_uid."'"
                ." AND ortho_sc.uid = ortho_sc_j.uid AND ortho_sc.st_id = ortho_sc_j.st_id AND mbrid.uid = mbrdata.memberuid AND mbrid.id = ortho_sc.st_id";
        $_data = '  ortho_sc.s_uid AS ortho_s_uid'
                .', ortho_sc.follow_new_cnt AS ortho_follow_new_cnt';
        $_sort = $order_by;
        $_orderby = $order_mode;
        $SCORE_ROWS7 = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
        
	__debug_print("db_query_go_detect7. - " . mysql_error());
        while( $_ROW  = db_fetch_array($SCORE_ROWS) ) {
               $_ROW2 = db_fetch_array($SCORE_ROWS2);
               $_ROW3 = db_fetch_array($SCORE_ROWS3);
               $_ROW4 = db_fetch_array($SCORE_ROWS4);
               $_ROW5 = db_fetch_array($SCORE_ROWS5);
               $_ROW6 = db_fetch_array($SCORE_ROWS6);
               $_ROW7 = db_fetch_array($SCORE_ROWS7);
      	       $_ROW10 = $_ROW + $_ROW2 + $_ROW3+ $_ROW4+ $_ROW5 + $_ROW6 + $_ROW7 ;

                $SCORE_ARRAY[$_ROW['st_id']] = $_ROW10;
        }



        // 각각의 항목에 id와 회원정보를 추가
        foreach($SCORE_ARRAY as $SCORE_TMP) {
                $st_id = $SCORE_TMP['st_id'];
                $stid_array = getDbData($table['s_mbrid'],"id='".$st_id."'", '*');
                $stdata_array = getDbData($table['s_mbrdata'], "memberuid='".$stid_array['uid']."'", '*');
                $st_array = array_merge($stid_array, $stdata_array);
                $SCORE_ARRAY[$st_id]['st_info'] = $st_array;
        }










//rule save
		$APPLY_INFOS = array();
                $TCD = getDbArray(
                        $table['khusd_st_apply_manager'.'apply_info_list'].' ail' , '' ,  
                        "IF(ail.status = '".$d['khusd_st_apply_manager']['apply_info']['CLOSED']."', 1, 0) AS is_closed"
                        .", ail.subject AS apply_info_subject"
                        .", ail.date_start AS date_start"
                        .", ail.date_end AS date_end"
                        .", ail.department AS department"
                        .", ail.is_perio_surgery AS is_perio_surgery"
                        .", ail.uid AS apply_info_uid",
                        'ail.date_end' ,
                        'desc limit 50',
                        0 ,
                        0);
 __debug_print("db_query_go for_detect. - " . mysql_error()); 
	$idx=1;
        while($_R = db_fetch_array($TCD))  {
 __debug_print("db_query_go for_detect. - " . $idx++ ); 
		$APPLY_INFOS[] = $_R;
	}
		$RULES = array();
                $TCD = getDbArray("rb_khusd_st_manager_verification_rule".' vr' , '' , 
			"vr.uid AS uid" 
			.", vr.perio_surgery_on AS perio_surgery_on"
			.", vr.perio_surgery_selection AS perio_surgery_selection"
			.", vr.perio_surgery_standard AS perio_surgery_standard"
			.", vr.perio_surgery_num_apply AS perio_surgery_num_apply"
			.", vr.perio_chiot_on AS perio_chiot_on"
			.", vr.perio_chiot_selection AS perio_chiot_selection"
			.", vr.perio_chiot_standard AS perio_chiot_standard"
			.", vr.perio_chiot_num_apply AS perio_chiot_num_apply"
			.", vr.oms_on AS oms_on"
			.", vr.oms_selection AS oms_selection"
			.", vr.oms_standard AS oms_standard"
			.", vr.oms_num_apply AS oms_num_apply"
			.", vr.radio_on AS radio_on"
			.", vr.radio_selection AS radio_selection"
			.", vr.radio_standard AS radio_standard"
			.", vr.radio_num_apply AS radio_num_apply",
			 'vr.uid', 'desc', 0 , 0);
 __debug_print("db_query_go for_rule detect main.php. - " . mysql_error()); 
        	while($_R = db_fetch_array($TCD))  {
			$RULES[]=$_R;
 __debug_print("db_query_go for_rulerule detect. main.php - " . intval($_R['uid']).' - '. $_R['perio_surgery_num_apply']  ); 
		}




//dup check start
                $check_start_code = ( 12 - date("w", time()   ) )%7 - 4 ;
                $check_start_time = date("Ymd", time() + 60*60*24*$check_start_code).'000000';

                $TCC = getDbArray(
                        $table['khusd_st_apply_manager'.'apply_list'].' al'
                        .', '.$table['khusd_st_apply_manager'.'apply_info_list'].' ail'
                        .', '.$table['khusd_st_apply_manager'.'apply_item'].' ai',

                        "("
                                ."al.status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'"
                                ." OR al.status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
                        ." )"
                        ." AND al.apply_info_uid = ail.uid"
                        ." AND al.apply_item_uid = ai.uid"
                        ." AND ai.date_item >= ".$check_start_time,
                        "al.*"
                        .", IF(ail.status = '".$d['khusd_st_apply_manager']['apply_info']['CLOSED']."', 1, 0) AS is_closed"
                        .", ail.subject AS apply_info_subject"
			.", ail.info_order AS info_order"
                        .", ail.date_start AS date_start"
                        .", ail.date_end AS date_end"
                        .", ail.date_select AS date_select"
                        .", ail.department AS department"
                        .", ail.is_perio_surgery AS is_perio_surgery"
                        .", ail.uid AS apply_info_uid"
                        .", ail.apply_limit AS apply_limit"
                        .", ai.accept_limit AS accept_limit"
                        .", ai.date_item AS date_item"
                        .", ai.sub_category AS sub_category"
                        .", ai.content AS apply_item_content",

                        'al.st_id' ,
                        'asc' ,
                        //'desc' ,
                        0,
                        0
                );

	$zeros = array();
	$accept_limits = array();
	$apply_limits = array();
	$date_items = array();
        //__debug_print("db_query_4_detect. - " . mysql_error());
        $Duplicate_Check_Dic = array();
        while($_R = db_fetch_array($TCC))   {
                $mesial =  intval(intval( $_R['date_item']) / 1000000)   ;     //morning
                $distal =  intval( $_R['date_item']) % 1000000   ;             //afternoon
                __debug_print("print each rows. - " .$mesial. ' ' .$distal   );
                if ( $mesial > 20170101 && $_R['rand']!= 0   )  {
                        if ( $distal < 120000 )
                                $Duplicate_Check_Dic[$_R['st_id'] ][$mesial]["morning"][$_R['date_end']][$_R['uid']   ]=$_R;
                        elseif ( $distal >= 120000 AND $distal < 180000 )
                                $Duplicate_Check_Dic[$_R['st_id']][$mesial]["afternoon"][$_R['date_end']][$_R['uid']   ]=$_R;
                        else
                                $Duplicate_Check_Dic[$_R['st_id']][$mesial]["night"][$_R['date_end']][$_R['uid']   ]=$_R;
                }
	
		if( $_R['rand'] == 0 )    { 
 //__debug_print("db_query_go for_opened search detect main.php. - " .$_R['apply_item_uid'] ); 
			$zeros[  $_R['apply_info_uid']  ][$_R['apply_item_uid'] ]++;

		}
		$accept_limits[ $_R['apply_info_uid'] ][ $_R['apply_item_uid']] = $_R['accept_limit'];
 //__debug_print("db_query_go for_mb_strpos search detect2 main.php. - " .$_R['apply_item_content']. '_'. mb_strpos( $_R['apply_item_content']  ,  "(4", 0,  "UTF-8"     )  ); 


		$apply_limits[ $_R['apply_info_uid'] ]  = $_R['apply_limit'];
		$date_items[ $_R['apply_info_uid'] ][ $_R['apply_item_uid']] = $_R['date_item'];
		
        }

	$MandatoryTime = array();
	foreach( array_keys($accept_limits) AS $tmp_apply_info)   {
		$opened = 0;
		$open_items = array();
		foreach( array_keys($accept_limits[$tmp_apply_info])  AS $tmp_apply_item)  {
			if ( $accept_limits[$tmp_apply_info][$tmp_apply_item] > 0  && $accept_limits[$tmp_apply_info][$tmp_apply_item] > $zeros[$tmp_apply_info][$tmp_apply_item]  )   {
 //__debug_print("db_query_go for_opened++ search detect2 main.php. - " .$tmp_apply_info.'_'.$tmp_apply_item.'_'. $accept_limits[$tmp_apply_info][$tmp_apply_item]  .'>'.$zeros[$tmp_apply_info][$tmp_apply_item] ); 
				$opened=$opened+1;  
				//$open_items[] = $accept_limits[$tmp_apply_info][$tmp_apply_item];  //wrong
				$open_items[] = $date_items[$tmp_apply_info][$tmp_apply_item];
 __debug_print("db_query_go for_opened++ search detect2 main.php. - " .$tmp_apply_info.'_'.$tmp_apply_item.'_('. $accept_limits[$tmp_apply_info][$tmp_apply_item]  .'>'.$zeros[$tmp_apply_info][$tmp_apply_item].')_'.$opened ); 
 __debug_print("db_query_go for_opened   search detect2 main.php. - " .$tmp_apply_info.'_'.$tmp_apply_item.'__'. $date_items[$tmp_apply_info][$tmp_apply_item]  ); 
			}
		}	
		if( $apply_limits[$tmp_apply_info] >0 && $apply_limits[$tmp_apply_info] == $opened )   {
 __debug_print("db_query_go for_opened+++ search detect2 main.php. - " .$tmp_apply_info.'_'. $apply_limits[$tmp_apply_info] .'=='.$opened  ); 
			$MandatoryTime[$tmp_apply_info] = true;
		}
		//else if( $apply_limits[$tmp_apply_info] >0 && $opened == 2 )   {
		else if( $apply_limits[$tmp_apply_info] >0 && $opened <= 3 )   {
 __debug_print("db_query_go for_opened+++ search detect3 main.php. - " .$tmp_apply_info.'_'. $apply_limits[$tmp_apply_info] .'=='.$opened  ); 
			$MandatoryTime[$tmp_apply_info] = true;
		}
		if ( count($open_items) > 0 )  {
			foreach( $open_items AS $_R  )    {
				$saved = $_R ;
				break;
			}
			$value = 1;
			foreach( $open_items AS $_R  )    {
				if( !isSameTime( $saved, $_R) )      
					$value = 0 ;
				else 
					$value = $value * 1;
			}
			if ( $value == 1 )   { 
 __debug_print("db_query_go for_value==1 - " .$tmp_apply_info  ); 
				$MandatoryTime[$tmp_apply_info] = true;
			}

			
		}		
	} 
		
} //verification end

elseif(  $mode == 'koda' ) {
        include_once $g['path_module'].'khusd_st_apply_manager/var/var.define.php';
        include_once $g['path_module'].'khusd_st_manager/function/member.php';
	include_once $g['path_module'].'khusd_st_consv/var/var.score.php';
 __debug_print("for_TC_Sub_Ext. - "  ); 
//dup check start
                $check_subject0 =  '서브인턴';
                $check_subject1 =  '자율선택(익스턴십)';
                $check_start_time = '20180624010000';
                //$check_start_time = '20180623010000';

                $TC_Sub_Ext = getDbArray(
                        $table['khusd_st_apply_manager'.'apply_list'].' al'
                        .', '.$table['khusd_st_apply_manager'.'apply_info_list'].' ail'
                        .', '.$table['khusd_st_apply_manager'.'apply_item'].' ai',

                        "("
                                ."al.status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'"
                                ." OR al.status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
                        ." )"
                        ." AND al.apply_info_uid = ail.uid"
                        ." AND al.apply_item_uid = ai.uid"
                        ." AND ail.date_start >= ".$check_start_time
			,
                        "al.*"
                        .", IF(ail.status = '".$d['khusd_st_apply_manager']['apply_info']['CLOSED']."', 1, 0) AS is_closed"
                        .", ail.subject AS apply_info_subject"
			.", ail.info_order AS info_order"
                        .", ail.date_start AS date_start"
                        .", ail.date_end AS date_end"
                        .", ail.date_select AS date_select"
                        .", ail.department AS department"
                        .", ail.is_perio_surgery AS is_perio_surgery"
                        .", ail.uid AS apply_info_uid"
                        .", ail.apply_limit AS apply_limit"
                        .", ai.accept_limit AS accept_limit"
                        .", ai.date_item AS date_item"
                        .", ai.sub_category AS sub_category"
                        .", ai.content AS apply_item_content",

                        'al.st_id' ,
                        'asc' ,
                        //'desc' ,
                        0,
                        0
                );
		$Check_Dic = array();
        while($_R = db_fetch_array($TC_Sub_Ext))   {
 __debug_print("db_query_go for_TCGOO_Sub_Ext. - " .$_R['st_id'].'_'.$_R['apply_info_subject']  ); 
		$Check_Dic[ $_R['st_id' ]]['st_id'] = $_R['st_id'];
		$temp_doc =  str_split($_R['apply_info_subject'],4);
		$Check_Dic[ $_R['st_id' ]]['subject'] = $temp_doc[0]; 
		$Check_Dic[ $_R['st_id' ]][  $temp_doc[0]][ $_R['info_order']][$_R['apply_item_content']]['status'] = $_R['status']; 
		$Check_Dic[ $_R['st_id' ]][  $temp_doc[0]][ $_R['info_order']][$_R['apply_item_content']]['rand'] = $_R['rand']; 
		$Check_Dic[ $_R['st_id' ]][  $temp_doc[0]][ $_R['info_order']][$_R['apply_item_content']]['apply_item_content'] = $_R['apply_item_content'] ; 
		//$Check_Dic[ $_R['st_id' ]]['name'] = $_R['name']; 

	}


}

 
$theme = $d['khusd_st_manager']['theme'] ? $d['khusd_st_manager']['theme'] : 'default'; //지정테마
$mode = $mode ? $mode : 'main'; //테마 초기접속모드
$dispType = $g['mobile']&&$_SESSION['pcmode']!='Y' ? '_mobile' : '_pc'; //모바일,PC모드구분
if ($dispType == '_mobile')
{
	$theme = $d['khusd_st_manager']['theme_m'] ? $d['khusd_st_manager']['theme_m'] : 'default'; // 모바일테마
} 


// 모듈 내에서 사용되는 링크들 선언
if($c) {
	// 메뉴에 등록되어 메뉴를 통해 접근한 경우
	$g['st_manager_reset'] = getLinkFilter($g['s'].'/?'.($_HS['usecode']?'r='.$r.'&amp;':'').'c='.$c,array($iframe?'iframe':''));
} else {
	$g['st_manager_reset'] = getLinkFilter($g['s'].'/?'.($_HS['usecode']?'r='.$r.'&amp;':'').'m='.$m,array($iframe?'iframe':''));
}
$g['st_manager_apply_history'] = $g['st_manager_reset'].getLinkFilter('', array('mode',$p>1?'p':'',$recnum!=$d['khusd_st_manager']['recnum']?'recnum':'',$st_id?'st_id':''));
$g['st_manager_apply_info_link'] = getLinkFilter($g['s'].'/?'.($_HS['usecode']?'r='.$r.'&amp;':'').'m=khusd_st_apply_manager',array($iframe?'iframe':'')).'&amp;uid=';
$g['st_manager_apply_item_link'] = getLinkFilter($g['s'].'/?'.($_HS['usecode']?'r='.$r.'&amp;':'').'m=khusd_st_apply_manager&amp;mode=item_view',array($iframe?'iframe':'')).'&amp;uid=';

$g['pagelink'] = $g['st_manager_apply_history'];



$g['dir_module_skin'] = $g['dir_module'].'theme/'.$dispType.'/'.$theme.'/'; //테마폴더 경로
$g['url_module_skin'] = $g['url_module'].'/theme/'.$dispType.'/'.$theme; //테마폴더 URL
$g['img_module_skin'] = $g['url_module_skin'].'/image'; //테마 이미지폴더 URL
 
$g['dir_module_mode'] = $g['dir_module_skin'].$mode; //테마 선택모드 경로
$g['url_module_mode'] = $g['url_module_skin'].'/'.$mode; //테마 선택모드 URL


/** theme 에서 사용하는 변수 불러오기 **/
include_once $g['dir_module_skin'].'_var.php';

 
// 호출 파일
$g['main'] = $g['main'] ? $g['main'] : $g['dir_module_mode'].'.php'; //출력파일
?>
