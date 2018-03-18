<?php

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}

$ch_date = $ch_date ? $ch_date : $date['totime'];

$tx_plan_array = $d['khusd_st_cnslt_room_manager']['tx_plan']['perio'];


$CHAIR_RESERV_ARRAY = array();
$_start_chair_no = 1;

//to print 1week chair reservation table
$WEEK_CHAIR_RESERV_ARRAY = array();
$WEEK_is_available_nt = array();
$WEEK_ch_date = array();

if($_start_chair_no > $CHAIR_NUM_MAX)
{
	getLink('', '', '체어 수 범위를 벗어났습니다.', '');
}

for($idx = $_start_chair_no; $idx <= $CHAIR_NUM_MAX; $idx++)
{
	$CHAIR_RESERV_ARRAY[$idx] = array(
		'chair_no'		=> ($idx), 
		'reserv' 		=> array()
	);
}

//make array from mon to sat
for($i=1; $i<=6; $i++)
{

        for($idx = $_start_chair_no; $idx <= $CHAIR_NUM_MAX; $idx++)
        {
                $WEEK_CHAIR_RESERV_ARRAY[$i][$idx] = array(
                        'chair_no'              => ($idx),
                        'reserv'                => array()
                );
        }
}

// 수요일인 경우 야간 스케줄도 표시되도록 옵션 표시
if(getDateFormat($ch_date,'w') == 3)
{
	$is_available_nt = true;
}
else
{
	$is_available_nt = false;
}


$WEEK_is_available_nt[1] = false;
$WEEK_is_available_nt[2] = false;
$WEEK_is_available_nt[3] = true;
$WEEK_is_available_nt[4] = false;
$WEEK_is_available_nt[5] = false;
$WEEK_is_available_nt[6] = false;
$WEEK_ch_date[1] = $ch_date;
$WEEK_ch_date[2] = date("Ymd",  strtotime( "+1 days",  strtotime( $ch_date )))   ;
$WEEK_ch_date[3] = date("Ymd",  strtotime( "+2 days",  strtotime( $ch_date )))   ;
$WEEK_ch_date[4] = date("Ymd",  strtotime( "+3 days",  strtotime( $ch_date )))   ;
$WEEK_ch_date[5] = date("Ymd",  strtotime( "+4 days",  strtotime( $ch_date )))   ;
$WEEK_ch_date[6] = date("Ymd",  strtotime( "+5 days",  strtotime( $ch_date )))   ;

$_data = 'rsv.*, mbrdata.name AS st_name';
$_table = $table[$m.'reservation'].' rsv, '.$table['s_mbrdata'].' mbrdata, '.$table['s_mbrid'].' mbrid';
$_where = 'mbrid.uid = mbrdata.memberuid'
	.' AND rsv.st_id = mbrid.id'
	." AND rsv.chair_date = '".substr($ch_date, 0, 8)."'"
	." AND rsv.chair_no >= '".$_start_chair_no."'"
	." AND rsv.chair_no < '".($_start_chair_no + $CHAIR_NUM_MAX)."'";
$_sort = 'chair_no ASC, chair_start_time';
$_orderby = 'ASC';

$CHAIR_RESERV_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);

 //__debug_print("push func:@@  " . mysql_error());

while( $_ROW = db_fetch_array($CHAIR_RESERV_ROWS)) 
{
	$_chair_no = $_ROW['chair_no'];
 //__debug_print("push func:@  " . mysql_error());

	$CHAIR_RESERV_ARRAY[$_chair_no]['reserv'][] = $_ROW;
}

if(getDateFormat($ch_date,'w') == 1) 
for($i=2; $i<=6; $i++)
{

$_data = 'rsv.*, mbrdata.name AS st_name';
$_table = $table[$m.'reservation'].' rsv, '.$table['s_mbrdata'].' mbrdata, '.$table['s_mbrid'].' mbrid';
$_where = 'mbrid.uid = mbrdata.memberuid'
        .' AND rsv.st_id = mbrid.id'
        ." AND rsv.chair_date = '".$WEEK_ch_date[$i]."'"
        ." AND rsv.chair_no >= '".$_start_chair_no."'"
        ." AND rsv.chair_no < '".($_start_chair_no + $CHAIR_NUM_MAX)."'";
$_sort = 'chair_no ASC, chair_start_time';
$_orderby = 'ASC';

$CHAIR_RESERV_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);


while( $_ROW = db_fetch_array($CHAIR_RESERV_ROWS))
{
        $_chair_no = $_ROW['chair_no'];

        $WEEK_CHAIR_RESERV_ARRAY[$i][$_chair_no]['reserv'][] = $_ROW;
}


}





$g['khusd_st_cnslt_room_manager_history'] =  $g['khusd_st_cnslt_room_manager_list'].'&amp;mode=history&amp;st_id=';
?>
