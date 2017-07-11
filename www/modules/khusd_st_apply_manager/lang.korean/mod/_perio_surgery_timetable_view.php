<?php

// 로그인 & 권한 체크
if(permcheck('st') == false)
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
}

// 필요한 parameter check
$apply_info_list_uid	 = $apply_info_list_uid ? $apply_info_list_uid : 0;

$_data = 'ai.uid, ai.date_item, ai.doctor, ai.assist, ai.pt_id, ai.pt_name, ai.content, ai.accept_limit, ai.is_imp_cent';
$_table = $table[$m.'apply_item'].' ai';
$_where = 
	"ai.apply_info_uid = '".$apply_info_list_uid."'"
	;
$_sort = 'ai.date_item';
$_orderby = 'ASC';

$TIMETABLE_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);

__debug_print("\nSELECT $_data FROM $_table WHERE $_WHERE");

$TIMETABLE_ARRAY = array();
while( $_ROW = db_fetch_array($TIMETABLE_ROWS)) 
{
	$_date = substr($_ROW['date_item'], 0, 8);
	$_time = substr($_ROW['date_item'], 8, 4);
	
	if(is_array($TIMETABLE_ARRAY[$_date]) == false)
	{
		$TIMETABLE_ARRAY[$_date] = array();
	}
	
	if(is_array($TIMETABLE_ARRAY[$_date][$_time]) == false)
	{
		$TIMETABLE_ARRAY[$_date][$_time] = array();
	}

	$TIMETABLE_ARRAY[$_date][$_time][$_ROW['uid']] = $_ROW;
	$TIMETABLE_ARRAY[$_date][$_time][$_ROW['uid']]['accept'] = array();
}


$_data = 'al.uid AS apply_list_uid, ai.uid AS apply_item_uid, ai.date_item, ai.doctor, ai.assist, ai.pt_id, ai.pt_name, ai.content, ai.accept_limit, al.st_id, mbrdata.name AS st_name, ai.is_imp_cent';
$_table = $table[$m.'apply_item'].' ai, '.$table[$m.'apply_list'].' al, '.$table['s_mbrdata'].' mbrdata, '.$table['s_mbrid'].' mbrid';
$_where = 
	"ai.apply_info_uid = '".$apply_info_list_uid."'"
	." AND al.apply_item_uid = ai.uid"
	.' AND mbrid.uid = mbrdata.memberuid'
	.' AND al.st_id = mbrid.id'
	." AND al.status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
	;
$_sort = 'ai.date_item ASC, al.uid';
$_orderby = 'ASC';

$TIMETABLE_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);

__debug_print("\nSELECT $_data FROM $_table WHERE $_where");

while( $_ROW = db_fetch_array($TIMETABLE_ROWS)) 
{
	$_date = substr($_ROW['date_item'], 0, 8);
	$_time = substr($_ROW['date_item'], 8, 4);

	$TIMETABLE_ARRAY[$_date][$_time][$_ROW['apply_item_uid']]['accept'][] = $_ROW;
}

?>