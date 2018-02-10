<?php
if(!defined('__KIMS__')) exit;

$ITEM = getUidData($table[$m.'apply_item'],$uid);
if(!$ITEM['uid']) getLink('','','삭제되었거나 존재하지 않는 항목입니다.','');

$APPLY_INFO = getUidData($table[$m.'apply_info_list'],$ITEM['apply_info_uid']);
if(!$APPLY_INFO['uid']) getLink('','','삭제되었거나 존재하지 않는 신청입니다.','');

include_once $g['dir_module'].'var/var.php';
include_once $g['dir_module'].'var/var.define.php';

include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	getLink('', '', '권한이 없거나 로그인하지 않으셨습니다.', '');
}

// 관리자 권한 체크
$MANAGER = false;
if(permcheck('chief_of_case') || permcheck($APPLY_INFO['department']))
{
	$MANAGER = true;
}

// apply_info_list 에서 status 조사, closed 면 신청 불가
if($APPLY_INFO['status'] != $d['khusd_st_apply_manager']['apply_info']['OPEN']) {
	getLink('','','신청이 마감되었습니다.','');
}

if($APPLY_INFO['date_end'] <= $date['totime'])
{
	getLink('','','마감 시간이 지났습니다.','');
}

// 신청 작업 수행
if($st_id && $MANAGER)
{
	$st_id = trim($st_id);
	$work_manager_key = 'work_manager';
	$work_manager_val = "'".$my['id']."'";
}
else
{
	$st_id = $my['id'];
}
$apply_info_uid = $APPLY_INFO['uid'];
$date_reg = $date['totime'];
$timestamp = microtime();
$status = $d['khusd_st_apply_manager']['apply_list']['APPLY'];

// 기존 당첨자 수 구하기
$ACCEPTED_NUM = getDbRows($table[$m.'apply_list'],
			"apply_info_uid = '".$apply_info_uid."'"
			." AND status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
			." AND st_id = '".$st_id."'"
);
// 현재 신청 갯수 구하기
$APPLIED_NUM = getDbRows($table[$m.'apply_list'],
			"apply_info_uid = '".$apply_info_uid."'"
			." AND status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'"
			." AND st_id = '".$st_id."'"
);

// 현재 세부 아이템에 신청 갯수 구하기
$APPLIED_FOR_ITEM_NUM = getDbRows($table[$m.'apply_list'],
			"apply_info_uid = '".$apply_info_uid."'"
			." AND apply_item_uid = '".$uid."'"
			." AND status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'"
			." AND st_id = '".$st_id."'"
);
$ACCEPTED_FOR_ITEM_NUM = getDbRows($table[$m.'apply_list'],
			"apply_info_uid = '".$apply_info_uid."'"
			." AND apply_item_uid = '".$uid."'"
			." AND status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
			." AND st_id = '".$st_id."'"
);




// 옵션에 따라 기존 당첨된 만큼 차감을 시킨다.
// 그렇기 때문에, 이미 당첨된 수가 limit 수보다 크다면, 신청을 추가하지 않고 튕긴다. 
if($APPLY_INFO['apply_limit'] > 0 && $APPLY_INFO['able_apply_accepted'] == 'n')
{		
	if($APPLY_INFO['apply_limit'] <= $ACCEPTED_NUM)
	{
		getLink('', '', '이미 당첨되어 있는 항목이 신청 제한 수에 도달하였습니다. 신청이 불가능합니다.', '');
	} else if($APPLY_INFO['apply_limit'] <= $ACCEPTED_NUM + $APPLIED_NUM)
	{
		getLink('', '', '이미 신청한 항목이 신청 제한 수에 도달하였습니다. 추가 신청이 불가능합니다. 기존 신청 내역을 취소하고 시도해 주세요.', '');
	}
}
else if($APPLY_INFO['apply_limit'] > 0 && $APPLY_INFO['able_apply_accepted'] == 'y')
{		
	if($APPLY_INFO['apply_limit'] <= $APPLIED_NUM)
	{
		getLink('', '', '이미 신청한 항목이 신청 제한 수에 도달하였습니다. 신청이 불가능합니다..', '');
	}
}

if($APPLY_INFO['apply_limit'] == 0 && $APPLIED_NUM > 0){
		getLink('', '', '이미 신청한 항목이 있습니다.', '');
}
if($APPLIED_FOR_ITEM_NUM > 0){
		getLink('', '', '해당 아이템에 이미 신청한 내역이 있습니다.', '');
}
if($ACCEPTED_FOR_ITEM_NUM > 0){
		getLink('', '', '해당 아이템에 이미 당첨된 내역이 있습니다.', '');
}

$_QKEY = 'st_id, apply_info_uid, apply_item_uid, original_apply_item_uid, timestamp, date_reg, status'
	.($work_manager_key ? ', '.$work_manager_key : '');
$_QVAL = "'$st_id', '$apply_info_uid', '$uid', '$uid', '$timestamp', '$date_reg', '$status'"
	.($work_manager_key ? ', '.$work_manager_val : '');

getDbInsert($table[$m.'apply_list'],$_QKEY, $_QVAL);

// 아래는 의미 없는 내용인듯
// 신청에 신청 수 제한이 있다면 해당 신청 이전의 신청들은 모두 OVERAPPLY 로 상태를 변경한다
/*if($APPLY_INFO['apply_limit'] > 0 )
{
	$apply_limit = $APPLY_INFO['apply_limit'];
	if($APPLY_INFO['able_apply_accepted'] == 'n')
	{
		$apply_limit -= $ACCEPTED_NUM;
		if($apply_limit <= 0)
			getLink('', '', '이미 당첨되어 있는 항목이 신청 제한 수에 도달하였습니다. 신청이 불가능합니다.', '');
	}

	// limit 에 해당하는 신청 row 중 가장 작은 값의 date_reg, timestamp 를 구한다. 
	// 그 후에는, 그 이전의 신청을 모두 OVERAPPLY 처리한다. 
	// atomic 으로 처리되면 좋겠지만, 이게 최선인듯....
	$_data = 'uid, date_reg, timestamp';
	$_from = $table[$m.'apply_list'];
	$_where = "st_id = '".$st_id."'"
		." AND status != '".$d['khusd_st_apply_manager']['apply_list']['CANCEL']."'"
		." AND status != '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
		." AND apply_info_uid = '".$apply_info_uid."'";
	$_order = 'date_reg DESC, timestamp DESC, uid DESC';
	$_limit = '0, '.$apply_limit;
	
	$MY_APPLY_ARRAY = array();
	$MY_APPLY_ROWS = db_query('SELECT '.$_data.' FROM '.$_from.' WHERE '.$_where.' ORDER BY '.$_order.' LIMIT '.$_limit, $DB_CONNECT);
	while($_MY_APPLY = db_fetch_array($MY_APPLY_ROWS)) $MY_APPLY_ARRAY[] = $_MY_APPLY;
	
	// 만약 해당 조건의 데이터가 없거나... apply_limit 이하면 패스
	if(count($MY_APPLY_ARRAY) >= $APPLY_INFO['apply_limit'])
	{
		// 구해진 항목들 중 가장 작은 값의 date_reg,timestamp 를 가진 것을 찾는다. 소트했으니 가장 마지막 것이 ....
		$MY_FIRST_VALID_APPLY = $MY_APPLY_ARRAY[count($MY_APPLY_ARRAY)-1];
		
		// 구해진 항목보다 이전에 신청한 것들 중, cancel 이 아닌 모든 신청항목을 overapply 로 변경한다. 
		/*
		UPDATE apply_list
			SET status = 'o'
			WHERE st_id = '' AND status != 'c' AND apply_info_uid = ''
			 AND (date_reg < '' OR (date_reg = '' AND timestamp < ''))		
		*/
		/*$_table = $table[$m.'apply_list'];
		$_set = "status = '".$d['khusd_st_apply_manager']['apply_list']['OVERAPPLY']."'";
		$_where = "st_id = '".$st_id."'"
			." AND status != '".$d['khusd_st_apply_manager']['apply_list']['CANCEL']."'"
			." AND status != '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
			." AND apply_info_uid = '".$apply_info_uid."'"
			." AND (date_reg < '".$MY_FIRST_VALID_APPLY['date_reg']."'"
					." OR (date_reg = '".$MY_FIRST_VALID_APPLY['date_reg']."'"
						." AND timestamp < '".$MY_FIRST_VALID_APPLY['timestamp']."'))";	
	
		getDbUpdate($_table,$_set,$_where);
	}

}듯*/
getLink('reload', 'parent.', '', '');

?>
