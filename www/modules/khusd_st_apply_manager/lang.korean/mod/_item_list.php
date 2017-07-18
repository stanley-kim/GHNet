<?php
if(!defined('__KIMS__')) exit;

// $APPLY_INFO 가 정의되어 있어야 한다. (apply_info_list 의 row 하나의 데이터를 배열로 가지고 있는 변수)
// $uid 가 정의되어 있어야 한다. (apply_item 의 uid)

$st_id = $my['id'];

$ITEM_ARRAY = array();

$item_sort = $item_sort ? $item_sort : 'uid';
$item_sort = ($APPLY_INFO['is_perio_surgery'] == 'y' ? 'date_item' : $item_sort);
$item_orderby = $item_orderby ? $item_orderby : 'ASC';

// 현재 접속한 사용자가 신청한 항목 구하기
// 사용자가 신청한 항목과, 그 중 유효 시간 내에 신청한 항목을 구분하여 정보를 가져온다. 
// 아래의 쿼리를 이용한다. 
/*
SELECT uid, apply_item_uid, IF(MAX(date_reg)>= '20130715000000','y','n') AS valid_applied 
	FROM st43_khusd_st_apply_manager_apply_list
	WHERE 
		status != 'c'
		AND apply_info_uid = '3'
		AND st_id = 'admin'
	GROUP BY apply_item_uid
*/
$_data = "apply_item_uid, IF(MAX(date_reg)>='".$APPLY_INFO['date_start']."','y','n') AS valid_applied";
$_from = $table[$m.'apply_list'];
$_where = "apply_info_uid='".$uid."'"
		." AND status != '".$d['khusd_st_apply_manager']['apply_list']['CANCEL']."'"
		." AND status != '".$d['khusd_st_apply_manager']['apply_list']['OVERAPPLY']."'"
		." AND st_id ='".$st_id."'";
$_group = ' GROUP BY apply_item_uid';
$_orderby = 'apply_item_uid';
$_sort = 'asc';

$MY_APPLIED_ITEM_ROWS = getDbArray($_from, $_where.$_group, $_data, $_orderby, $_sort, 0, 0);
$MY_APPLIED_ITEM_ARRAY = array();
while($_MY_APPLIED = db_fetch_array($MY_APPLIED_ITEM_ROWS)) $MY_APPLIED_ITEM_ARRAY[$_MY_APPLIED['apply_item_uid']] = $_MY_APPLIED['valid_applied'];

$MY_ACCEPTED_ITEM_ROWS = getDbArray(
			$table[$m.'apply_list'], 
			"apply_info_uid='".$uid."' AND status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
			." AND st_id = '".$st_id."'", 
			'apply_item_uid', 'uid', 'asc', 0, 0);
$MY_ACCEPTED_ITEM_ARRAY = array();
while($_MY_ACCEPTED = db_fetch_array($MY_ACCEPTED_ITEM_ROWS)) $MY_ACCEPTED_ITEM_ARRAY[$_MY_ACCEPTED['apply_item_uid']] = true;

$ITEM_NUM = getDbRows($table[$m.'apply_item'], 'apply_info_uid='.$uid);
$ITEM_ROWS = getDbArray($table[$m.'apply_item'], 'apply_info_uid='.$uid,'*',$item_sort,$item_orderby,0,0);
//$ITEM_ROWS = getDbArray($_from.$_join, $_where, $_data, $item_sort, $item_orderby, 0, 0);
while($_R = db_fetch_array($ITEM_ROWS)) 
{
	// 기존 당첨자 수 구하기
	$ACCEPTED_NUM = getDbRows($table[$m.'apply_list'],
				"apply_item_uid = '".$_R['uid']."'"
				." AND status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
	);
	// 유효 신청 수, 총 신청 수 구하기
	$APPLY_NUM = getDbRows($table[$m.'apply_list'], 'apply_item_uid='.$_R['uid']);
	$VALID_APPLY_NUM = getDbRows($table[$m.'apply_list'], 
			'apply_item_uid='.$_R['uid']
			.' AND date_reg >= '.$APPLY_INFO['date_start']
			." AND status != '".$d['khusd_st_apply_manager']['apply_list']['CANCEL']."'"
			." AND status != '".$d['khusd_st_apply_manager']['apply_list']['OVERAPPLY']."'"
			." AND status != '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
			);
	
	$_R['accepted_num'] = $ACCEPTED_NUM;
	$_R['valid_apply_num'] = ($_R['accept_limit'] > 0 && $_R['accepted_num'] >= $_R['accept_limit']) ? 0 : $VALID_APPLY_NUM;
	$_R['apply_num'] = $APPLY_NUM;
	$_R['applied'] = $MY_APPLIED_ITEM_ARRAY[$_R['uid']] ? true : false;
	$_R['valid_applied'] = $MY_APPLIED_ITEM_ARRAY[$_R['uid']] == 'y' ? true : false;
	$_R['accepted'] = $MY_ACCEPTED_ITEM_ARRAY[$_R['uid']] ? true : false;
	
	// 치주수술의 경우, 수술정보로 content 항목을 새로 구성
	//if($APPLY_INFO['is_perio_surgery'] == 'y')
	if(true)
	{
		$_R['content'] =
			getDateFormat($_R['date_item'],'m/d').'('.getWeek(getDateFormat($_R['date_item'], 'w')).')'
			.' '.getDateFormat($_R['date_item'],'H:i')
			.' '.$_R['pt_name']
			.' '.$_R['doctor']
			.($_R['assist'] && strlen($_R['assist']) > 0 ? '('.$_R['assist'].')' : '')
			.' '.$_R['content']
			;
	}
	
	$ITEM_ARRAY[] = $_R;
}


?>
