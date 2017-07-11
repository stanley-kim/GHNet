<?php
if(!defined('__KIMS__')) exit;
// 환자명 / 병록번호로 검색하기

$_data = 'fw.*'
		.', pt.pt_name AS pt_name'
		.', pt.pt_id AS pt_id'
		.', pt.dr_room AS dr_room'
		.', pt.pf_name AS pf_name'
		.', pt.dr_name AS dr_name'
		.', mbrdata.name AS st_name';

$_table = 
		$table[$m.'follow'].' fw'
		.' LEFT JOIN ('.$table[$m.'follow_pt'].' pt) ON (fw.pt_uid = pt.uid)'
		.' LEFT JOIN ('.$table['s_mbrid'].' mbrid) ON (fw.st_id = mbrid.id)'
		.', '.$table['s_mbrdata'].' mbrdata';

$_where = "fw.s_uid = '$s_uid' AND mbrid.uid = mbrdata.memberuid";

$_sort = 'fw.st_id ASC, fw.status ASC, pt.dr_room';
$_sort = 'pt.dr_room ASC, pt.pf_name ASC, pt.dr_name';
$_orderby = 'ASC';

$FOLLOW_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
$FOLLOW_ARRAY = array();
while( $_ROW = db_fetch_array($FOLLOW_ROWS) )
{
	if($FOLLOW_ARRAY[$_ROW['pt_id']] == false)
		$FOLLOW_ARRAY[$_ROW['pt_id']] = array();
	
	$FOLLOW_ARRAY[$_ROW['pt_id']][] = $_ROW;
}

?>
