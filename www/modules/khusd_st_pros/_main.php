<?php
if(!defined('__KIMS__')) exit;

include_once $g['path_module'].'khusd_st_manager/function/score.php';	// 점수 관련에서 공통으로 이용하는 함수들

include_once $g['path_module'].'khusd_st_manager/function/debug.php';

function getProsSTPT($st_id)
{
	global $table, $s_uid, $d, $g;

	include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 점수 관련에서 공통으로 이용하는 함수들
	
	// pros_score 에 있는, st_case_x_pt_name 목록 구해오기
	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table['khusd_st_pros'.'score'].' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
	$_table = $table['khusd_st_pros'.'score'].' sc, '.$table['s_mbrdata'].' mbrdata,'.$table['s_mbrid'].' mbrid,('.$_join.') sc_j';
	$_where = 
		"s_uid = '".$s_uid."'"
		." AND sc.date_update = sc_j.date_update"
		." AND sc.st_id = sc_j.st_id"
		." AND mbrid.id = sc.st_id"
		." AND sc.st_id = '".$st_id."'"
	;

	$_data = 
		'sc.uid'
		
		.', sc.st_case_1_pt_name'
		.', sc.st_case_1_last_tx_date'
		.', sc.st_case_1_last_tx'
		.', sc.st_case_1_last_inst'
		.', sc.st_case_1_friendly'

		.', sc.st_case_2_pt_name'
		.', sc.st_case_2_last_tx_date'
		.', sc.st_case_2_last_tx'
		.', sc.st_case_2_last_inst'
		.', sc.st_case_2_friendly'

		.', sc.st_case_3_pt_name'
		.', sc.st_case_3_last_tx_date'
		.', sc.st_case_3_last_tx'
		.', sc.st_case_3_last_inst'
		.', sc.st_case_3_friendly'
	;
	$_sort = 'uid';
	$_orderby = 'ASC';
	
	__debug_print("SELECT ".$_data." FROM ".$_table." WHERE ".$_where);
	
	$PROS_PT_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);

	$_ROW = db_fetch_array($PROS_PT_ROWS);
	$PROS_PT_ARRAY = array(
		1	=> 	array(
					'id'			=> 'pros_pt_case_1', 
					'pt_name'		=> $_ROW['st_case_1_pt_name'], 
					'last_tx_date'	=> $_ROW['st_case_1_last_tx_date'], 
					'last_tx'		=> $_ROW['st_case_1_last_tx'], 
					'last_inst'		=> $_ROW['st_case_1_last_inst'], 
					'friendly'		=> $_ROW['st_case_1_friendly']
				), 
		2	=> 	array(
					'id'			=> 'pros_pt_case_2', 
					'pt_name'		=> $_ROW['st_case_2_pt_name'], 
					'last_tx_date'	=> $_ROW['st_case_2_last_tx_date'], 
					'last_tx'		=> $_ROW['st_case_2_last_tx'], 
					'last_inst'		=> $_ROW['st_case_2_last_inst'], 
					'friendly'		=> $_ROW['st_case_2_friendly']
				), 
		3	=> 	array(
					'id'			=> 'pros_pt_case_3', 
					'pt_name'		=> $_ROW['st_case_3_pt_name'], 
					'last_tx_date'	=> $_ROW['st_case_3_last_tx_date'], 
					'last_tx'		=> $_ROW['st_case_3_last_tx'], 
					'last_inst'		=> $_ROW['st_case_3_last_inst'], 
					'friendly'		=> $_ROW['st_case_3_friendly']
				)
	);
	
	return $PROS_PT_ARRAY;
}

?>