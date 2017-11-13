<?php
if(!defined('__KIMS__')) exit;

/* score update 액션 처리 */
include_once $g['path_module'].'khusd_st_manager/function/debug.php';

//__debug_print('in change st chair, status='.$status);

include_once $g['path_module'].'khusd_st_cnslt_room_manager/var/var.define.php';	// ST 신청용 변수 파일
include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/push.php';
include_once $g['path_module'].'khusd_st_manager/function/date.php';

//__debug_print('in change st chair, status='.$status.', before ST permission check');

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}
//__debug_print('in change st chair, status='.$status.', after ST permission check');

// 입력값 유효성 체크
$uid 		= intval($uid);
$status 	= trim($status);
$chair		= trim($chair);
$date_reg = $date['totime'];
$date_cancel = '';

$CHAIR = getUidData($table[$m.'apply'], $uid);
$st_id = $CHAIR['st_id'];
$department	= $CHAIR['department'];
$st_type = $CHAIR['st_type'];

if(!$CHAIR || $CHAIR['uid'] != $uid)
{
	getLink('', '', '해당하는 값에 대한 신청 정보가 없습니다.', '');
}

$pt_name = $CHAIR['pt_name'];
$pt_id   = $CHAIR['pt_id'];
$dental_formula   = $CHAIR['dental_formula'];
$tx_plan = $CHAIR['tx_plan'];
$chair_date = $CHAIR['st_date'];
$chair_timetype = $CHAIR['st_timetype'];
$chair_timetype_detail = $CHAIR['st_timetype_detail'];
$chair_start_time = $CHAIR['st_start_time'];
$chair_end_time = $CHAIR['st_end_time'];
$memo = $CHAIR['memo'];

// 현재 로그인 사용자가 체어 신청자와 동일한 경우에는
// 신청자가 스스로 취소 가능한지 판단하여 처리하기 위한 날짜 계산
$start_date = getDateOfDay(
					$chair_date, 
					$d['khusd_st_cnslt_room_manager']['apply_time']['start_day'], 
					$d['khusd_st_cnslt_room_manager']['apply_time']['start_hour']
				);
$end_date = getDateOfDay(
					$chair_date, 
					$d['khusd_st_cnslt_room_manager']['apply_time']['end_day'], 
					$d['khusd_st_cnslt_room_manager']['apply_time']['end_hour']
				);
$end_of_apply_date = getDateOfDay(
					$chair_date, 
					$d['khusd_st_cnslt_room_manager']['apply_time']['end_day']-7, 
					$d['khusd_st_cnslt_room_manager']['apply_time']['end_hour']
				);
$end_of_cancel_date = date(
				'YmdHis',
				mktimeFromYmd($chair_date)
				+ 60*60*$d['khusd_st_cnslt_room_manager']['cancel_time'][$chair_timetype]
			   );
				
// 권한 체크
// 권한은 종진실장, 총케이스장, 총대에게만 있다. 
// (보존과 OP 는 OP장도 가짐 )
// 단, 신청 상태에서는 본인 것을 삭제할 수 있다. 
// var.define.php 의 변수에 따라 삭제 되신 취소를 할 수 도 있다. 
if(!permcheck('chief_of_cnslt_room') && !permcheck('chief_of_op')) {
	/*
	if($CHAIR['st_id'] == $my['id'] && $CHAIR['status'] == $d['khusd_st_cnslt_room_manager']['apply']['status']['APPLY'])
	{
		if($d['khusd_st_cnslt_room_manager'][$st_type]['delete_action'])
		{
			if($d['khusd_st_cnslt_room_manager'][$st_type]['delete_action'] == 'cancel' && $status == $d['khusd_st_cnslt_room_manager']['apply']['status']['CANCEL'])
				$_perm = true;
			elseif($d['khusd_st_cnslt_room_manager'][$st_type]['delete_action'] == 'delete' && $status == 'delete')
				$_perm = true;
		}
		elseif(($status == 'delete' && $date['totime'] <= $end_of_apply_date) || ($status == 'c' && $date['totime'] >= $start_date && $date['totime'] <= mktimeFromYmd($chair_date))) // Currently, both delete&cancel can be done without permission
		{
			$_perm = true;
		}
	}
	elseif($st_id == $my['id'] && $date['totime'] >= $start_date && $date['totime'] <= $end_date)
	{
		if($status == $d['khusd_st_cnslt_room_manager']['apply']['status']['CANCEL'])
			$_perm = true;
	}
	elseif($st_id == $my['id'] && $CHAIR['status'] == $d['khusd_st_cnslt_room_manager']['apply']['status']['CANDI'])
	{
		if($status == $d['khusd_st_cnslt_room_manager']['apply']['status']['CANCEL'])
			$_perm = true;
	}
	*/
	$_perm = false;
	if($st_id == $my['id'] &&
		(
			($status == 'delete' && $date['totime'] <= $end_of_apply_date)
			|| ($status == $d['khusd_st_cnslt_room_manager']['apply']['status']['CANCEL'] && $date['totime'] <= $end_of_cancel_date)
		)
	  )
	{
		$_perm = true;
	}elseif($st_id == $my['id'] && $date['totime'] >= $start_date && $date['totime'] <= $end_date)
	{
		
		if($status == 'delete')
			$_perm = true;
	}
	if(!$_perm)
		getLink('', '', '권한이 없습니다. 수정가능시간이 지났습니다.', '');
}

// 배정되어 있을 때에는 '취소' 만 가능
if($CHAIR['status'] == $d['khusd_st_cnslt_room_manager']['apply']['status']['ACCEPTED']
	&& $status != $d['khusd_st_cnslt_room_manager']['apply']['status']['CANCEL'])
{
	getLink('', '', '배정 상태에서는 취소만 가능합니다.', '');
}

// 변경되는 상태값에 따라 처리
if($status == $d['khusd_st_cnslt_room_manager']['apply']['status']['ACCEPTED'])
{
	
	// 시간 겹치는지 체크
	$_table = $table['khusd_st_cnslt_room_manager'.'reservation'];
	$_where = 
		"chair_date = '".$CHAIR['st_date']."'"
		." AND chair_no = '".$chair."'"
		." AND ("
			." (chair_start_time <= '".$chair_start_time."' AND chair_end_time > '".$chair_start_time."')"
			." OR "
			." (chair_start_time < '".$chair_end_time."' AND chair_end_time >= '".$chair_end_time."')"
		.")";
	
	$dup_num = getDbRows($_table, $_where);
	if($dup_num > 0)
	{
		getLink('', '', '이미 배정된 시간과 겹칩니다.', '');
	}
	
	// 이미 배정된 체어가 있는데, 체어만 변경하는 것인지 확인
	if($CHAIR['status'] == $d['khusd_st_cnslt_room_manager']['apply']['status']['ACCEPTED'])
	{
		// 기존 체어 취소
		$_where = 
			"chair_date = '".$CHAIR['st_date']."'"
			." AND chair_no = '".$CHAIR['chair_no']."'"
			." AND chair_start_time = '".$chair_start_time."'"
			." AND chair_end_time = '".$chair_end_time."'"
			." AND st_id = '".$st_id."'"
			." AND pt_name = '".$pt_name."'";
		
		getDbDelete($_table, $_where);
	}
	
	if($chair > 0)
	{
		// 새로운 체어 배정
		$QKEY = 'st_id, pt_name, pt_id, dental_formula,  reserve_status, st_type, department, tx_plan, chair_no, chair_date, chair_timetype, chair_timetype_detail, chair_start_time, chair_end_time, date_reg, memo';
		$QVAL = "'$st_id', '$pt_name', '$pt_id', '$dental_formula', '', '$st_type', '$department', '$tx_plan', '$chair', '$chair_date', '$chair_timetype', '$chair_timetype_detail', '$chair_start_time', '$chair_end_time', '$date_reg', '$memo'";
		
		getDbInsert($_table, $QKEY, $QVAL);
	}
}
elseif($status == $d['khusd_st_cnslt_room_manager']['apply']['status']['CANCEL'])
{
	//__debug_print("? ==> Cancel");
	if($CHAIR['chair_no'] > 0)
	{
		//__debug_print("Accepted ==> Cancel");
		// 기존 체어 취소
		$_table = $table['khusd_st_cnslt_room_manager'.'reservation'];
		$_where = 
			"chair_date = '".$CHAIR['st_date']."'"
			." AND chair_no = '".$CHAIR['chair_no']."'"
			." AND chair_start_time = '".$chair_start_time."'"
			." AND chair_end_time = '".$chair_end_time."'"
			." AND st_id = '".$st_id."'"
			." AND pt_name = '".$pt_name."'";
		
		getDbDelete($_table, $_where);
		/*
		// in case of cancel, check if there's any candidate and if it exists,
		// the first candidate automatically takes the chair
		// TEMPORARILY NOT WORKING
		$_table = $table[$m.'apply']." as apply"
			." LEFT JOIN ".$table[$m.'candi']." as candi on apply.uid=candi.apply_uid";
		$_where = "candi.is_first='y'"
			." AND candi.st_date='".$CHAIR['st_date']."'"
			." AND candi.st_timetype='".$CHAIR['st_timetype']."'"
			." AND candi.department='".$CHAIR['department']."'";
		$_data = "*";
		
		//__debug_print("SELECT ".$_data." FROM ".$_table." WHERE ".$_where);
		
		$CANDI = getDbData($_table, $_where, $_data);
		
		// if there are candidates
		if($CANDI)
		{
			$_table = $table['khusd_st_cnslt_room_manager'.'reservation'];
			
			$QKEY = 'st_id, pt_name, reserve_status, st_type, department, tx_plan, chair_no, chair_date, chair_timetype, chair_start_time, chair_end_time, date_reg, memo';
			$QVAL = "'".$CANDI['st_id']."', '".$CANDI['pt_name']."', '', "
			."'".$CANDI['st_type']."', '".$CANDI['department']."', '".$CANDI['tx_plan']."', "
			."'".$CANDI['chair_no']."', '".$CANDI['st_date']."', '".$CANDI['st_timetype']."', "
			."'".$CANDI['st_start_time']."', '".$CANDI['st_end_time']."', '".$CANDI['date_reg']."', "
			."'".$CANDI['memo']."'";
			
			//__debug_print("UPDATE ".$QKEY." FROM ".$_table." SET ".$QVAL);
			
			getDbInsert($_table, $QKEY, $QVAL);
			
			// CANCEL the previous one
			$date_cancel = $date['totime'];
			$_set = "status = '".$status."', chair_no = '0', date_cancel = '".$date_cancel."'";
			$_where = "uid = '".$uid."'";
			
			getDbUpdate($table[$m.'apply'],$_set, $_where);
			//__debug_print("TABLE UPDATE1: ".$table[$m.'apply'].", ".$_set.", ".$_where);
			
			/*
			// PLACE a chair to the first candidate
			$date_cancel = '';
			$_set = "status = '".$d['khusd_st_cnslt_room_manager']['apply']['status']['ACCEPTED']
				."', chair_no = '".$CHAIR['chair_no']."', date_cancel = '".$date_cancel."'";
			$_where = "uid = '".$CANDI['apply_uid']."'";
			
			getDbUpdate($table[$m.'apply'],$_set, $_where);
			__debug_print("TABLE UPDATE2: ".$table[$m.'apply'].", ".$_set.", ".$_where);
			
			$apply_uid = $CANDI['apply_uid'];
			$next_uid = 0;
			$st_timetype = $CANDI['st_timetype'];
			$st_date = $CANDI['st_date'];
			
			include_once $g['dir_module'].'lang.'.$_HS['lang'].'/action/a.delete_candi_list.php';
			
			getLink('reload', 'top.', '취소 되었습니다.22', '');
		}*/
	}
	
	$date_cancel = $date['totime'];
}
elseif($status == 'delete')
{
	// 기존 체어 신청을 DB에서 삭제
	
	// 만약 체어가 이미 신청되어 있는 상태라면, 삭제 불가능. 배정되지 않은 경우만 삭제 가능
	if($CHAIR['status'] == $d['khusd_st_cnslt_room_manager']['apply']['status']['ACCEPTED'])
	{
		getLink('', '', '먼저 체어 배정을 취소해야 삭제 가능합니다.', '');
	}
	
	$_table = $table[$m.'apply'];
	$_where = "uid = '".$uid."'";
		
	getDbDelete($_table, $_where);
	
	if($CHAIR['status'] == $d['khusd_st_cnslt_room_manager']['apply']['status']['CANDI'])
	{
		// 기존 상태가 대기였다가 변경되는 것 이라면...
		$apply_uid = $uid;
		$next_uid = 0;
		$st_timetype = $chair_timetype;
		$st_date = $chair_date;
		
		include_once $g['dir_module'].'lang.'.$_HS['lang'].'/action/a.delete_candi_list.php';
	}

	getLink('reload', 'top.', '삭제되었습니다.', '');
}

// 입력한 데이터로 query 생성
$_set = "status = '".$status."', chair_no = '".$chair."', date_cancel = '".$date_cancel."'";
$_where = "uid = '".$uid."'";

getDbUpdate($table[$m.'apply'],$_set, $_where);

//__debug_print("TABLE UPDATE: ".$table[$m.'apply'].", ".$_set.", ".$_where);

// 체어 신청 상태 변경을 푸시
// 단, 본인이 변경한 경우에는 푸시하지 않음
if($st_id != $my['id'])
{
	send_push_by_id("[종진실] 신청한 체어 상태가 변경되었습니다.", 
		"당첨여부 확인하러 가보세요~!!!", 
		$st_id, 
		$g['url_root'].'/?'.($_HS['usescode']?'r='.$r.'&':'').'m='.$m.'&department='.$department.'&st_type='.$st_type.'&mode=st_list&st_date='.$chair_date.'&st_timetype='.$chair_timetype);
}

// 대기로 상태가 변경된다면, 대기열에 추가
if($status == $d['khusd_st_cnslt_room_manager']['apply']['status']['CANDI'])
{
	$apply_uid = $uid;
	$next_uid = 0;
	$st_timetype = $chair_timetype;
	$st_timetype_detail = $chair_timetype_detail;
	$st_date = $chair_date;
	
	include_once $g['dir_module'].'lang.'.$_HS['lang'].'/action/a.add_candi_list.php';
}
elseif($CHAIR['status'] == $d['khusd_st_cnslt_room_manager']['apply']['status']['CANDI'])
{
	// 기존 상태가 대기였다가 변경되는 것 이라면...
	$apply_uid = $uid;
	$next_uid = 0;
	$st_timetype = $chair_timetype;
	$st_timetype_detail = $chair_timetype_detail;
	$st_date = $chair_date;
	
	include_once $g['dir_module'].'lang.'.$_HS['lang'].'/action/a.delete_candi_list.php';
}

getLink('reload', 'top.', '변경 되었습니다.', '');
?>
