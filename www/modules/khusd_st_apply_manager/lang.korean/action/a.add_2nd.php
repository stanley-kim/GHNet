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
	getLink('', '', '신청 추가 권한이 없습니다.', '');
}

include_once $g['dir_module'].'var/var.define.php'; // 모듈변수파일 인클루드






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
















// 입력값 유효성 체크
$uid = intval($uid);

if($uid > 0)	$APPLY_INFO = getUidData($table[$m.'apply_info_list'],$uid);

if($uid > 0 && $APPLY_INFO['uid'] == $uid)
{
	$date_start_t = strtotime($start_date.' '.$start_hour.':'.$start_min.':00');
	$date_end_t = strtotime($end_date.' '.$end_hour.':'.$end_min.':00');
	
	$st_id = $my['id'];
	$s_uid = $s_uid ? intval($s_uid) : 0;
	$department = trim($department);
	$apply_limit = (intval($apply_limit) <= 0 ? 0 : intval($apply_limit));
	$subject = trim($subject);
	$order = $order ? trim($order) : '주중6차';
	$date_start = date('YmdHis',$date_start_t);
	$date_end = date('YmdHis',$date_end_t);
	//$apply_type = 'etc'; // todo 치주수술 등 미리 정의된 타입 추가하기
	$apply_type = trim($apply_type); // 
	$status = $d['khusd_st_apply_manager']['apply_info']['OPEN'];
	$is_perio_surgery = $APPLY_INFO['is_perio_surgery'];
	$date_reg = $date['totime'];
	$is_imp_cent = $APPLY_INFO['is_imp_cent'];
	

	$type0 = $d['khusd_st_apply_manager']['apply_info']['type0']['single'];
	$type1 = $d['khusd_st_apply_manager']['apply_info']['type1']['weekday'];
	$type2 = '주중6차';
	$type3 = '주중6차';
	foreach($d['khusd_st_apply_manager']['apply_info']['order_list'] as $_ROW)    {
        	if( $_ROW['name'] == $order )    {
                	$type0 = $_ROW['type0'];
                	$type1 = $_ROW['type1'];
                	$type2 = $_ROW['type2'];
                	if(  $_ROW['type3'] )
                        	$type3 = $_ROW['type3'];
                	else
                        	$type3 = $_ROW['type2'];

        	}	


	}	
	//filter integer information
        $first_start_order = filter_var($type2, FILTER_SANITIZE_NUMBER_INT);

	if ( $type0 == $d['khusd_st_apply_manager']['apply_info']['type0']['single'] ) {
		if(   trim($end_min_array[$first_start_order ]) == '' || trim($end_hour_array[$first_start_order]) == '' || trim($apply_limit_array[$first_start_order]) == '' )
			getLink('', '', $type2.'를 입력해주세요.', '');

        	$date_start_t = strtotime($start_date.' '.$start_hour_array[ $first_start_order ].':'.$start_min_array[  $first_start_order ].':00');
        	$date_end_t = strtotime($start_date.' '.$end_hour_array[ $first_start_order ].':'.$end_min_array[ $first_start_order ].':00');
        	$date_start = date('YmdHis',$date_start_t);
        	$date_end = date('YmdHis',$date_end_t);
        	$apply_limit = (intval($apply_limit_array[ $first_start_order ] ) <= 0 ? 0 : intval($apply_limit_array[ $first_start_order ] ));
        	$able_apply_accepted = $able_apply_accepted_array[ $first_start_order ];
	}	





if(  isAlreadyExist2($date_end, $department, $subject, $order, -1 ) )  {
                getLink('', '', $subject.' 동일한 날짜, 동일한 차수가 이미 있습니다!!', '');
}

	
	//$_QKEY = 's_uid, st_id, apply_limit, department, subject, content, date_start, date_end, apply_type, status, able_apply_accepted, is_perio_surgery, date_reg';
	//$_QVAL = "'$s_uid', '$st_id', '$apply_limit','$department', '$subject', '$content', '$date_start', '$date_end', '$apply_type', '$status', '$able_apply_accepted', '$is_perio_surgery', '$date_reg'";
	$_QKEY = 's_uid, st_id, apply_limit, department, subject, content, date_start, date_end, apply_type, status, able_apply_accepted, is_perio_surgery, date_reg, info_order ';
	$_QVAL = "'$s_uid', '$st_id', '$apply_limit','$department', '$subject', '$content', '$date_start', '$date_end', '$apply_type', '$status', '$able_apply_accepted', '$is_perio_surgery', '$date_reg', '$order'";
	
	getDbInsert($table[$m.'apply_info_list'],$_QKEY, $_QVAL);
	
	// 새로 추가된 신청의 uid 가져온다. 
	$LASTUID = getDbCnt($table[$m.'apply_info_list'],'max(uid)','');

	// 추가 신청은... 새로 생성하되, uid 에 있는 item들과 '당첨자'들 정보를 가져온다...!!!
	$ITEM_ROWS = getDbArray($table[$m.'apply_item'], "apply_info_uid='".$uid."'",'*','uid','asc',0,0);
	while($_ITEM = db_fetch_array($ITEM_ROWS)) 
	{
                $_QKEY = 'apply_info_uid, content, ref_uid, accept_limit, date_reg, date_item, doctor, assist, pt_id, pt_name, is_imp_cent, sub_category';
                $_QVAL = "'".$LASTUID."', '".mysql_real_escape_string($_ITEM['content'])."', '".$_ITEM['ref_uid']."', '".$_ITEM['accept_limit']."', '".$_ITEM['date_reg']."'"
                                .", '".$_ITEM['date_item']."', '".$_ITEM['doctor']."', '".$_ITEM['assist']."', '".$_ITEM['pt_id']."', '".$_ITEM['pt_name']."', '".$_ITEM['is_imp_cent']."', '".$_ITEM['sub_category']."'";

		getDbInsert($table[$m.'apply_item'],$_QKEY, $_QVAL);
		// 새로 추가된 uid 가져온다. 
		$ITEM_LASTUID = getDbCnt($table[$m.'apply_item'],'max(uid)','');
		
		// 당첨자들도 추가
		$APPLIER_ROWS = getDbArray($table[$m.'apply_list'].' al',
						"al.apply_item_uid='".$_ITEM['uid']."' AND al.status ='".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'", 
						'al.*', 
						'al.date_reg, al.timestamp', 
						'asc',
						0,
						0);
		
		while($APPLIER = db_fetch_array($APPLIER_ROWS))
		{
			$_QKEY = 'st_id, apply_info_uid, apply_item_uid, original_apply_item_uid, rand, timestamp, date_reg, status';
			$_QVAL = "'".$APPLIER['st_id']."', '".$LASTUID."', '".$ITEM_LASTUID."', '".$_ITEM['uid']."', '".$APPLIER."', '".$APPLIER['timestamp']."', '".$APPLIER['date_reg']."', '".$APPLIER['status']."'";
			
			getDbInsert($table[$m.'apply_list'],$_QKEY, $_QVAL);
		}
	}
	// item 수 구하기
	$num_item = getDbRows($table[$m.'apply_item'],"apply_info_uid = '".$LASTUID."'");
	// apply_info_list 의 num_item 업데이트
	getDbUpdate($table[$m.'apply_info_list'], "num_item='".$num_item."'", "uid = '".$LASTUID."'");
	
	send_push_all(
		"[신청] ".$subject."이(가) 올라왔습니다.", 
		"새로운 신청글 - ".$subject."이(가) 올라왔습니다.\n"
		."신청할 것이 있는지 확인해보세요~!\n\n"
		."신청시작 : ".date('Y년 m월 d일 H시 i분',$date_start_t)."\n"
		."신청마감 : ".date('Y년 m월 d일 H시 i분',$date_end_t)."\n"
		."신청종류 : ".($apply_type == 'rand' ? "랜덤" : ( $apply_type == 'fcfs' ? "선착순" : ''))."\n", 
		$g['url_root'].'/?'.($_HS['usescode']?'r='.$r.'&':'').'c='.$c.'&uid='.$LASTUID);
}

getLink($nlist, 'parent.', '', '');
?>
