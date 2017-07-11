<?php

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}

$ch_date = $ch_date ? $ch_date : $date['totime'];

$tx_plan_array = $d['khusd_st_cnslt_room_manager']['tx_plan']['consv'];


$_data = 'rsv.*, mbrdata.name AS st_name';
$_table = $table[$m.'reservation'].' rsv, '.$table['s_mbrdata'].' mbrdata, '.$table['s_mbrid'].' mbrid';
$_where = 'mbrid.uid = mbrdata.memberuid'
	.' AND rsv.st_id = mbrid.id'
	." AND rsv.chair_date = '".substr($ch_date, 0, 8)."'"
	." AND rsv.department = 'consv'"
	." AND rsv.st_type = 'consv'"
	;
$_sort = 'chair_no';
$_orderby = 'ASC';

$CHAIR_RESERV_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);


$CHAIR_RESERV_AM_ARRAY = array();
$CHAIR_RESERV_PM_ARRAY = array();
while( $_ROW = db_fetch_array($CHAIR_RESERV_ROWS)) 
{
	$_chair_no = $_ROW['chair_no'];

	if($_ROW['chair_timetype'] == 'am')
		$CHAIR_RESERV_AM_ARRAY[$_chair_no] = $_ROW;
	elseif($_ROW['chair_timetype'] == 'pm')
		$CHAIR_RESERV_PM_ARRAY[$_chair_no] = $_ROW;
}

//$g['khusd_st_cnslt_room_manager_history'] =  $g['khusd_st_cnslt_room_manager_list'].'&amp;mode=history&amp;st_id=';
?>