<?php
if(!defined('__KIMS__')) exit;

include_once $g['dir_module'].'var/var.php'; // 모듈변수파일 인클루드


if(!isset($st_id) || !$st_id || $st_id == '')
{
	$st_id = $my['id'];
}

if(!$MANAGER && $st_id != $my['id'])
{
	getLink('', '', '타인에 대한 조회에 대한 권한이 없습니다.'.$st_id, '');
}

if(!isset($nameOrId) || !$nameOrId || $nameOrId == '')
{
	// 검색 결과 없이 단순히 보여주기만~
}
else
{
	// 해당 환자 정보 찾아서 보여주기
	
	// 환자명 / 병록번호로 검색하기
	$_table = $table[$m.'follow_pt'];
	$_where =
		"("
			."pt_name = '".$nameOrId."'"
			." OR pt_id = '".$nameOrId."'"
		.")";
	$_data = '*';
	$_sort = 'uid';
	$_orderby = 'ASC';

	$FOLLOW_PT_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
	
	$FOLLOWER_NUM = 0;
	$ABLE_FOLLOW = true;
	$FOLLOW_PT = db_fetch_array($FOLLOW_PT_ROWS);
	if($FOLLOW_PT)
	{
		$_data = 'fw.*, pt.dr_name, mbrdata.name AS st_name';
		$_table = $table[$m.'follow'].' fw, '.$table[$m.'follow_pt'].' pt, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
		$_where = 
			"fw.s_uid = '".$s_uid."'"
			." AND pt.uid = fw.pt_uid"
			." AND fw.pt_uid = '".$FOLLOW_PT['uid']."'"
			." AND mbrid.uid = mbrdata.memberuid"
			." AND mbrid.id = fw.st_id";
		$_sort = 'fw.date_update';
		$_orderby = 'DESC';
		
		$FOLLOW_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
		$FOLLOW_ARRAY = array();
		while( $_ROW = db_fetch_array($FOLLOW_ROWS) ) 
		{
			if( $_ROW['status'] ==  $d['khusd_st_pros']['FOLLOW_STATUS']['FOLLOWING'] )
				$FOLLOW_ARRAY[] = $_ROW;

			//if($_ROW['st_id'] == $st_id && $_ROW['status'] != $d['khusd_st_pros']['FOLLOW_STATUS']['DROP'])
			//	$ABLE_FOLLOW = false;
			
			if( $_ROW['status'] ==  $d['khusd_st_pros']['FOLLOW_STATUS']['FOLLOWING'] )
				$FOLLOWER_NUM++;
		}
	}
	
	if($ABLE_FOLLOW && $FOLLOWER_NUM >= $d['khusd_st_pros']['FOLLOWER_LIMIT'])
		$ABLE_FOLLOW = false;
}

// 현재 로그인한 사용자의 팔로우 보여주기
// 환자명 / 병록번호로 검색하기
$_data = 'fw.*, pt.pt_name AS pt_name, pt.pt_id AS pt_id, pt.dr_name AS dr_name, mbrdata.name AS st_name';
$_table = $table[$m.'follow_pt'].' pt, '.$table[$m.'follow'].' fw, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid';
$_where = 
	"fw.s_uid = '".$s_uid."'"
	." AND pt.uid = fw.pt_uid"
	." AND mbrid.uid = mbrdata.memberuid"
	." AND mbrid.id = fw.st_id"
	." AND fw.st_id = '".$st_id."'";
$_sort = 'fw.date_update';
$_orderby = 'DESC';

$MY_FOLLOW_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
$MY_FOLLOW_ARRAY = array();
while( $_ROW = db_fetch_array($MY_FOLLOW_ROWS) )
{
	//$MY_FOLLOW_ARRAY[$_ROW['pt_uid']] = $_ROW;
	$MY_FOLLOW_ARRAY[$_ROW['pt_uid'].$_ROW['type']] = $_ROW;

}



?>