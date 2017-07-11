<?php
if(!defined('__KIMS__')) exit;

if(!isset($st_id) || !$st_id || $st_id == '')
{
	$st_id = $my['id'];
}

if(!$MANAGER && $st_id != $my['id'])
{
	getLink('', '', '타인에 대한 조회에 대한 권한이 없습니다.'.$st_id, '');
}

$order_by = $order ? $order : 'date_update';
$order_mode = 'ASC';
if($om == 'a') $order_mode = 'ASC';
else if($om == 'd') $order_mode = 'DESC';

if(isset($nameOrId) && $nameOrId && $nameOrId != '')
{
	// 해당 환자 정보 찾아서 보여주기
	
	// 환자명 / 병록번호로 검색하기
	$_table = $table[$m.'follow_pt'];
	$_where = "pt_name = '$nameOrId' OR pt_id = '$nameOrId'";
	$_data = '*';
	$_sort = 'uid';
	$_orderby = 'ASC';

	$FOLLOW_PT_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
	
	$FOLLOWER_NUM = 0;
	$ABLE_FOLLOW = true;
	
	$FOLLOW_ARRAY = array();
	while($FOLLOW_PT = db_fetch_array($FOLLOW_PT_ROWS))
	{
		$_data = 'fw.*, pt.pt_id, pt.pt_name, mbrdata.name AS st_name';
		$_table = $table[$m.'follow'].' fw, '.$table[$m.'follow_pt'].' pt,'.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
		$_where = 
			"fw.s_uid = '".$s_uid."'"
			." AND fw.pt_uid = '".$FOLLOW_PT['uid']."'"
			." AND pt.uid = '".$FOLLOW_PT['uid']."'"
			." AND mbrid.uid = mbrdata.memberuid"
			." AND mbrid.id = fw.st_id";
		$_sort = 'fw.date_update';
		$_orderby = 'DESC';
		
		$FOLLOW_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
		while( $_ROW = db_fetch_array($FOLLOW_ROWS) ) 
		{
			$FOLLOW_ARRAY[] = $_ROW;
		}
	}
}
else if(isset($fw_uid) && $fw_uid != '')
{
	// Follow data modification mode
	$_data = 'pt.pt_id, pt.pt_name, fw.*';
	$_table = $table[$m.'follow'].' fw, '.$table[$m.'follow_pt'].' pt';
	$_where = "fw.s_uid = '".$s_uid."' AND fw.uid = '".$fw_uid."' AND pt.uid = fw.pt_uid";
	$_sort = 'fw.date_update';
	$_orderby = 'DESC';
	
	$_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
	$MOD_PT = db_fetch_array($_ROWS);
}

// 현재 로그인한 사용자의 팔로우 보여주기
// 환자명 / 병록번호로 검색하기
$_data = 'fw.*, pt.pt_name AS pt_name, pt.pt_id AS pt_id, mbrdata.name AS st_name';
$_table = $table[$m.'follow_pt'].' pt, '.$table[$m.'follow'].' fw, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
$_where = 
	"fw.s_uid = '".$s_uid."'"
	." AND pt.uid = fw.pt_uid"
	." AND mbrid.uid = mbrdata.memberuid"
	." AND mbrid.id = fw.st_id"
	." AND fw.st_id = '".$st_id."'";
$_sort = $order_by;//'fw.date_update';
$_orderby = $order_mode;//'DESC';

$MY_FOLLOW_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
$MY_FOLLOW_ARRAY = array();
while( $_ROW = db_fetch_array($MY_FOLLOW_ROWS) )
{
	$MY_FOLLOW_ARRAY[] = $_ROW;
}

?>