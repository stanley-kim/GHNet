<?php

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}

$ch_date = $ch_date ? $ch_date : $date['totime'];
$part = $part ? $part : '1';						// 1 이면 1~12번 체어, 2이면 13~24번 체어

// 이번달의 첫날짜
$mon_start_date = getDateFormat($ch_date, 'Ym').'01';

$CHAIR_RESERV_ARRAY = array();
$_start_chair_no = $CHAIR_NUM_PAGE * ($part - 1) + 1;

if($_start_chair_no > $CHAIR_NUM_MAX)
{
	getLink('', '', '체어 수 범위를 벗어났습니다.', '');
}

for($idx = $_start_chair_no; $idx <= min($CHAIR_NUM_PAGE + $_start_chair_no - 1, $CHAIR_NUM_MAX); $idx++)
{
	$CHAIR_RESERV_ARRAY[$idx] = array(
		'chair_no'		=> ($idx), 
		'reserv' 		=> array()
	);
}


$_data = 'rsv.*, mbrdata.name AS st_name';
$_table = $table[$m.'reservation'].' rsv, '.$table['s_mbrdata'].' mbrdata, '.$table['s_mbrid'].' mbrid';
$_where = 'mbrid.uid = mbrdata.memberuid'
	.' AND rsv.st_id = mbrid.id'
	." AND rsv.chair_date = '".substr($ch_date, 0, 8)."'"
	." AND rsv.chair_no >= '".$_start_chair_no."'"
	." AND rsv.chair_no < '".($_start_chair_no + $CHAIR_NUM_PAGE)."'";
$_sort = 'chair_no ASC, chair_start_time';
$_orderby = 'ASC';

$CHAIR_RESERV_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);


while( $_ROW = db_fetch_array($CHAIR_RESERV_ROWS)) 
{
	$_chair_no = $_ROW['chair_no'];

	$CHAIR_RESERV_ARRAY[$_chair_no]['reserv'][] = $_ROW;
}

$last_month_day = date('Ymd', mktime(0, 0, 0, getDateFormat($ch_date, 'm') - 1, 1, getDateFormat($ch_date, 'Y')));
$next_month_day = date('Ymd', mktime(0, 0, 0, getDateFormat($ch_date, 'm') + 1, 1, getDateFormat($ch_date, 'Y')));

$g['khusd_st_cnslt_room_manager_history'] =  $g['khusd_st_cnslt_room_manager_list'].'&amp;mode=history&amp;st_id=';
?>
