<?php
if(!defined('__KIMS__')) exit;

include_once $g['dir_module'].'var/var.php'; // 모듈변수파일 인클루드
include_once $g['dir_module'].'var/var.define.php'; // 각종 변수 정의 인클루드

// 이게 false 면 권한이 없는 것
include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/push.php';
include_once $g['path_module'].'khusd_st_manager/function/debug.php';
include_once $g['path_module'].'khusd_st_manager/function/db.php';

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	getLink('', '', '권한이 없거나 로그인하지 않으셨습니다.', '');
}

// todo 수술 추가 권한이 있는지 체크
if(false) {
	getLink('', '', '선착순 신청 추가 권한이 없습니다.', '');
}

include_once $g['dir_module'].'var/var.define.php'; // 모듈변수파일 인클루드

$date_start_t = strtotime($start_date.' '.$start_hour.':'.$start_min.':00');
$date_end_t = strtotime($end_date.' '.$end_hour.':'.$end_min.':00');

// 입력값 유효성 체크
$uid = $uid ? intval($uid) : 0;
$s_uid = $s_uid ? intval($s_uid) : 0;
$st_id = $my['id'];
$apply_limit = (intval($apply_limit) <= 0 ? 0 : intval($apply_limit));
$department = trim($department);
$subject = trim($subject);
$order = $order ? trim($order) : '주중6차'; 
$date_start = date('YmdHis',$date_start_t);
$date_end = date('YmdHis',$date_end_t);
$apply_type = trim($apply_type); // 
$status = $d['khusd_st_apply_manager']['apply_info']['OPEN'];
$is_perio_surgery = isset($GLOBALS['is_perio_surgery']) ? 'y' : 'n';
$date_reg = $date['totime'];
//$able_apply_accepted

$type0 = $d['khusd_st_apply_manager']['apply_info']['type0']['single'];
$type1 = $d['khusd_st_apply_manager']['apply_info']['type1']['weekday'];
$type2 = '주중6차';
$type3 = '주중6차';
foreach($d['khusd_st_apply_manager']['apply_info']['order_list'] as $_ROW)    {
	if( $_ROW['name'] == $order )    {
		$type0 = $_ROW['type0'];   // single/multi
		$type1 = $_ROW['type1'];   //weekday/weekend
		$type2 = $_ROW['type2'];   //start order ex)주말1차
		if(  $_ROW['type3'] )
			$type3 = $_ROW['type3'];   //end order ex)주말3차
		else
			$type3 = $_ROW['type2'];

	}


}

	$first_start_order = filter_var($type2, FILTER_SANITIZE_NUMBER_INT);
	if(   trim($end_min_array[$first_start_order ]) == '' || trim($end_hour_array[$first_start_order]) == '' || trim($apply_limit_array[$first_start_order]) == '' )
		getLink('', '', $type2.'를 입력해주세요.', '');
	$date_start_t = strtotime($start_date.' '.$start_hour_array[ $first_start_order   ].':'.$start_min_array[ $first_start_order  ].':00');
	$date_end_t = strtotime($start_date.' '.$end_hour_array[ $first_start_order  ].':'.$end_min_array[ $first_start_order   ].':00');
	$date_start = date('YmdHis',$date_start_t);
	$date_end = date('YmdHis',$date_end_t);
	$apply_limit = (intval($apply_limit_array[ $first_start_order   ] ) <= 0 ? 0 : intval($apply_limit_array[ $first_start_order  ] ));
	$able_apply_accepted = $able_apply_accepted_array[  $first_start_order     ];	

if( $type0 == $d['khusd_st_apply_manager']['apply_info']['type0']['multi'] )   {
	$pre_start_order = filter_var($type2, FILTER_SANITIZE_NUMBER_INT) + 1;
	$pre_end_order = filter_var($type3, FILTER_SANITIZE_NUMBER_INT);
        $i = $pre_start_order;
        while( $i <= $pre_end_order)   {
                if(   trim($end_min_array[$i]) == '' || trim($end_hour_array[$i]) == '' || trim($apply_limit_array[$i]) == '' )
                        getLink('', '', strval($i).'차를 입력해주세요.', '');
		$i = $i + 1;
	}
}

//	getLink('', '', '선착순 신청 추가 권한이 없습니다.'. $type0.'_'.$type1.'_'.$type2.'_'.$type3.'_'.$date_start.'_'.$date_end.'_'.$apply_limit.'_'.$able_apply_accepted     , '');




function isAlreadyExist2($date_end, $department, $subject, $order, $uid )  {
        $date_end_min = strval(intval($date_end / 1000000)).'000000';
        $date_end_max = strval(intval($date_end / 1000000)).'235959';
        $query = "select uid "
        ." from rb_khusd_st_apply_manager_apply_info_list as info_list"
        ." where info_list.department = '".$department."'"
        ." and info_list.subject = '".$subject."'"
        ." and info_list.info_order = '".$order."'"
        ." and info_list.date_end >= '".$date_end_min."'"
        ." and info_list.date_end <= '".$date_end_max."'"
        ." order by uid";

        $_count = 0;
        global $DB_CONNECT;
        $DUP_ROWS = db_query($query, $DB_CONNECT);
        while( $_ROW = db_fetch_array($DUP_ROWS) ){
		if( $uid != $_ROW['uid'] )
                	$_count = $_count +  1;
        }
	if( $_count > 0 ) 
		return true;
	else
		return false;
}

if (  $date['totime'] > $date_end ) {
	getLink('', '', '마감시간은 현재 시간 이후여야 합니다.'.$date_end, '');
}

if($uid > 0)	$APPLY_INFO = getUidData($table[$m.'apply_info_list'],$uid);

if($uid > 0 && $APPLY_INFO['uid'] == $uid)
{
	//$_QSET = "s_uid = '$s_uid', st_id = '$st_id', apply_limit = '$apply_limit', department = '$department', subject = '$subject', content = '$content', date_start = '$date_start', date_end = '$date_end', apply_type = '$apply_type', status = '$status', able_apply_accepted = '$able_apply_accepted', is_perio_surgery = '$is_perio_surgery', date_reg = '$date_reg'";
	//$_QSET = "s_uid = '$s_uid', st_id = '$st_id', apply_limit = '$apply_limit', department = '$department', subject = '$subject', content = '$content', date_start = '$date_start', date_end = '$date_end', apply_type = '$apply_type', status = '$status', able_apply_accepted = '$able_apply_accepted', is_perio_surgery = '$is_perio_surgery', date_reg = '$date_reg', info_order = '$order'";
	$_QSET = "s_uid = '$s_uid', st_id = '$st_id', apply_limit = '$apply_limit', department = '$department', subject = '$subject', content = '$content', date_start = '$date_start', date_end = '$date_end', apply_type = '$apply_type', status = '$status', able_apply_accepted = '$able_apply_accepted', is_perio_surgery = '$is_perio_surgery', date_reg = '$date_reg', info_order = '$type2'";
	
	//if(  isAlreadyExist($date_end, $department, $subject, $order, $uid ) )  {
	if(  isAlreadyExist2($date_end, $department, $subject, $type2, $uid ) )  {
		getLink('', '', $subject.' 동일한 날짜, 동일한 차수가 이미 있습니다!', '');
	}
	
	getDbUpdate($table[$m.'apply_info_list'],$_QSET, "uid = '".$uid."'");
	/*
	send_push_all(
		"[신청] ".$subject."이(가) 올라왔습니다.", 
		"새로운 신청글 - ".$subject."가 올라왔습니다.\n"
		."신청할 것이 있는지 확인해보세요~!\n\n"
		."신청시작 : ".date('Y년 m월 d일 H시 i분',$date_start_t)."\n"
		."신청마감 : ".date('Y년 m월 d일 H시 i분',$date_end_t)."\n"
		."신청종류 : ".($apply_type == 'rand' ? "랜덤" : ( $apply_type == 'fcfs' ? "선착순" : ''))."\n", 
		$g['url_root'].'/?'.($_HS['usescode']?'r='.$r.'&':'').'c='.$c.'&uid='.$uid);
	*/
	// single modification case. get out
	if( $type0 == $d['khusd_st_apply_manager']['apply_info']['type0']['single'] )   
	getLink($cview, 'parent.', '', '');
	else   {  // multi modification case. delete pre  
		$_cancelled_status =  $d['khusd_st_apply_manager']['apply_info']['pre_apply_info']['status']['cancelled']  ;   //cancelled
		getDbUpdate($table[ 'khusd_st_apply_manager'  .'pre_apply_info_list'], "status = '".$_cancelled_status."'", "parent_apply_info_uid = '".$uid."'" );
	}
		
}
else
{
	
	//if(  isAlreadyExist($date_end, $department, $subject, $order, -1 ) )  {
	if(  isAlreadyExist2($date_end, $department, $subject, $type2, -1 ) )  {
		getLink('', '', $subject.' 동일한 날짜, 동일한 차수가 이미 있습니다.', '');
	}

	$_QKEY = 's_uid, st_id, apply_limit, department, subject, content, date_start, date_end, apply_type, status, able_apply_accepted, is_perio_surgery, date_reg, info_order  ';
	//$_QVAL = "'$s_uid', '$st_id', '$apply_limit', '$department', '$subject', '$content', '$date_start', '$date_end', '$apply_type', '$status', '$able_apply_accepted', '$is_perio_surgery', '$date_reg', '$order'";
	$_QVAL = "'$s_uid', '$st_id', '$apply_limit', '$department', '$subject', '$content', '$date_start', '$date_end', '$apply_type', '$status', '$able_apply_accepted', '$is_perio_surgery', '$date_reg', '$type2 '";
	
	getDbInsert($table[$m.'apply_info_list'],$_QKEY, $_QVAL);
	
	
	// 새로 추가된 신청의 uid 가져온다. 
	$LASTUID = getDbCnt($table[$m.'apply_info_list'],'max(uid)','');

	send_push_all(
		"[신청] ".$subject."이(가) 올라왔습니다.", 
		"새로운 신청글 - ".$subject."이(가) 올라왔습니다.\n"
		."신청할 것이 있는지 확인해보세요~!\n\n"
		."신청시작 : ".date('Y년 m월 d일 H시 i분',$date_start_t)."\n"
		."신청마감 : ".date('Y년 m월 d일 H시 i분',$date_end_t)."\n"
		."신청종류 : ".($apply_type == 'rand' ? "랜덤" : ( $apply_type == 'fcfs' ? "선착순" : ''))."\n", 
		$g['url_root'].'/?'.($_HS['usescode']?'r='.$r.'&':'').'c='.$c.'&uid='.$LASTUID);

	if( $type0 == $d['khusd_st_apply_manager']['apply_info']['type0']['single'] )   
	getLink($nlist, 'parent.', '', '');
}

if( $type0 == $d['khusd_st_apply_manager']['apply_info']['type0']['multi'] )   {
//remove all related pre_apply_info
//0. get parent_apply_info 
//1. parent_apply_info 
//2. status != f
//3. change status = f 
        $query = "select uid "
        ." from rb_khusd_st_apply_manager_apply_info_list as info_list"
        ." where info_list.department = '".$department."'"
        ." and info_list.subject = '".$subject."'"
        ." and info_list.info_order = '".$type2."'"
        ." and info_list.date_end = '".$date_end."'"
        ." order by uid";

        $_count = 0;
        global $DB_CONNECT;
        $_ROWS = db_query($query, $DB_CONNECT);
        while( $_ROW = db_fetch_array($_ROWS) ){
		$_parent_apply_info_uid = $_ROW['uid'] ;
                $_count = $_count +  1;
        }
	////if( $_count == 1 ) 
	////	getLink('', '', '권한이! '. $_count.$department.$subject.$order.$type2.$date_end, '');


//for ( from pre_start_order to pre_end_order ) 
//getDbInsert
	$booked_status = $d['khusd_st_apply_manager']['apply_info']['pre_apply_info']['status']['booked'] ;
	$i = $pre_start_order;
	while( $i <= $pre_end_order)   {
		$_date_start_t = strtotime($start_date.' '.$start_hour_array[ $i ].':'.$start_min_array[ $i ].':00');
		$_date_end_t = strtotime($start_date.' '.$end_hour_array[ $i ].':'.$end_min_array[ $i ].':00');
		$_date_start = date('YmdHis',$_date_start_t);
		$_date_end = date('YmdHis',$_date_end_t);
       		$_apply_limit = (intval($apply_limit_array[ $i ] ) <= 0 ? 0 : intval($apply_limit_array[ $i ] ));
        	$_able_apply_accepted = $able_apply_accepted_array[ $i ];
		$_info_order = $type1.strval(   $i  ).'차';

                $_QKEY = 's_uid, st_id, apply_limit, department, subject, content, date_start, date_end, apply_type, status, able_apply_accepted, is_perio_surgery, date_reg, info_order, parent_apply_info_uid  ';
                $_QVAL = "'$s_uid', '$st_id', '$_apply_limit', '$department', '$subject', '$content', '$_date_start', '$_date_end', '$apply_type', '$booked_status', '$_able_apply_accepted', '$is_perio_surgery', '$date_reg', '$_info_order', '$_parent_apply_info_uid'";


		getDbInsert( $table[ 'khusd_st_apply_manager'  .'pre_apply_info_list'], $_QKEY, $_QVAL);

///__debug_print("pre0000 insert. - " . mysql_error());


		$i += 1;
	}
	getLink($nlist, 'parent.', '', '');

}
?>
