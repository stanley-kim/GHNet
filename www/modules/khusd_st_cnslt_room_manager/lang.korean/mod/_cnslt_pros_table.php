<?php

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}

$ch_date = $ch_date ? $ch_date : $date['totime'];

$tx_plan_array = $d['khusd_st_cnslt_room_manager']['tx_plan']['pros'];


// 보철 ST 환자정보 가져오기
include_once $g['path_module'].'khusd_st_pros/_main.php';	// 보철 ST 환자 관련 함수

$_data = 'rsv.*, mbrdata.name AS st_name';
$_table = $table[$m.'reservation'].' rsv, '.$table['s_mbrdata'].' mbrdata, '.$table['s_mbrid'].' mbrid';
$_where = 'mbrid.uid = mbrdata.memberuid'
	.' AND rsv.st_id = mbrid.id'
	." AND rsv.chair_date = '".substr($ch_date, 0, 8)."'"
	." AND rsv.department = 'pros'"
	." AND rsv.st_type = 'pros'"
	;
$_sort = 'chair_no';
$_orderby = 'ASC';

$CHAIR_RESERV_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);


$CHAIR_RESERV_AM_ARRAY = array();
$CHAIR_RESERV_PM_ARRAY = array();
while( $_ROW = db_fetch_array($CHAIR_RESERV_ROWS)) 
{
	$_chair_no = $_ROW['chair_no'];
	
	if($_ROW['memo'] && strlen($_ROW['memo']) > 0 && strpos($_ROW['memo'], 'pros_pt_case_') !== false)
	{
		$PROS_PT_ARRAY = getProsSTPT($_ROW['st_id']);
//		__debug_print('\n\n'.$_ROW['memo']);
		$_ROW['pt_info'] = $PROS_PT_ARRAY[substr($_ROW['memo'], strlen('pros_pt_case_'), 1)];
	}

	if($_ROW['chair_timetype'] == 'am')
		$CHAIR_RESERV_AM_ARRAY[$_chair_no] = $_ROW;
	elseif($_ROW['chair_timetype'] == 'pm')
		$CHAIR_RESERV_PM_ARRAY[$_chair_no] = $_ROW;
}

//$g['khusd_st_cnslt_room_manager_history'] =  $g['khusd_st_cnslt_room_manager_list'].'&amp;mode=history&amp;st_id=';
?>