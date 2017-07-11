<?php
	include_once $g['path_module'].'khusd_st_manager/function/score.php';
	include_once $g['path_module'].'khusd_st_manager/function/date.php';
	//include_once $g['path_module'].'khusd_st_manager/function/debug.php';
	include_once $g['path_module'].'khusd_st_consv/var/var.score.php';

	if($mode != 'st_list')
	{
		getLink('', '', '잘못된 접근 입니다.', '-1');
	}

	// 관리자 권한이 있다면 변수에 표시
	$MANAGER = false;

	if(permcheck('radio'))
	{
		$MANAGER = true;
	}

	$order_by = $order ? $order : 'date_reg';
	$order_mode = 'ASC';
	if($om == 'a') $order_mode = 'ASC';
	else if($om == 'd') $order_mode = 'DESC';

	
	$_join = 'SELECT MAX(date_update) date_update,st_id FROM '.$table['khusd_st_radio'.'score'].' GROUP BY st_id';
	$_table = 
		$table[$m.'apply'].' st'
		.', '.$table['khusd_st_radio'.'score'].' sc'
		.', '.$table['s_mbrdata'].' mbrdata'
		.','.$table['s_mbrid'].' mbrid'
		.',('.$_join.') sc_j';
	$_where = 
		"st.st_type = '".$st_type."'"
		.' AND sc.date_update = sc_j.date_update'
		.' AND st.st_id = sc.st_id'
		.' AND sc.st_id = sc_j.st_id'
		.' AND mbrid.uid = mbrdata.memberuid'
		.' AND mbrid.id = st.st_id'
		." AND st.s_uid = '".$SEMESTER_INFO['uid']."'"
		." AND st.st_date = '".$st_date."'"
		." AND st.st_timetype = '".$st_timetype."'";
		
	$_data = 'st.*'
		.', sc.taking AS prev_taking'
		.', sc.taking_pt AS prev_taking_pt';
	$_sort = $order_by;
	$_orderby = $order_mode;
	


?>