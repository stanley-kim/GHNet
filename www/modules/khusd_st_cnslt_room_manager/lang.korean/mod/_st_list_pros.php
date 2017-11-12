<?php

	if($mode != 'st_list')
	{
		getLink('', '', '잘못된 접근 입니다.', '-1');
	}
	
	// pros_score 에 있는, st_case_x_pt_name 목록 구해오기
	include_once $g['path_module'].'khusd_st_pros/_main.php';	// 보철 ST 환자 관련 함수
	include_once $g['path_module'].'khusd_st_manager/function/debug.php';	

	$PROS_PT_ARRAY = getProsSTPT($my['id']);


	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table['khusd_st_pros'.'score'].' WHERE s_uid = '.$s_uid.' GROUP BY st_id';
	$_table = 
		$table[$m.'apply'].' st'
		.', '.$table['khusd_st_pros'.'score'].' sc'
		.', '.$table['s_mbrdata'].' mbrdata'
		.', '.$table['s_mbrid'].' mbrid'
		.',('.$_join.') sc_j'
		;
	$_where = 
		"sc.s_uid = '".$s_uid."'"
		." AND st.st_type = '".$st_type."'"
		.' AND mbrid.uid = mbrdata.memberuid'
		.' AND mbrid.id = st.st_id'
		." AND st.s_uid = '".$SEMESTER_INFO['uid']."'"
		." AND st.st_date = '".$st_date."'"
		." AND st.st_timetype = '".$st_timetype."'"
		
		." AND mbrid.id = sc.st_id"
		." AND sc.st_id = sc_j.st_id"
		." AND sc.date_update = sc_j.date_update"
		;

		
	$_data = 'st.*'
		.", IF(
				st.memo = 'pros_pt_case_1', 
				'st_case_1', 
				IF(
					st.memo = 'pros_pt_case_2', 
					'st_case_2', 
					IF(
						st.memo = 'pros_pt_case_3', 
						'st_case_3', 
						''
					)
				)
			) AS pros_pt_idx"

		.', sc.st_case_1_pt_name'
		.', sc.st_case_1_pt_id'
		.', sc.st_case_1_dental_formula'
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
	$_sort = 'st.date_reg';
	$_orderby = 'ASC';

	//('SELECT '.$_data.'\nFROM '.$_table.'\nWHERE '.$_where.'\nSORT '.$_sort.'\nORDER BY '.$_orderby);
	
?>
