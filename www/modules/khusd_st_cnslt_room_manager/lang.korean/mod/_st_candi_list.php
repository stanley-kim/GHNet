<?php
	if(permcheck('chief_of_cnslt_room') || permcheck('chief_of_op'))
	{
		$MANAGER = true;
	}

	$st_type = $st_type ? $st_type : 'perio';
	$st_date = $st_date ? $st_date : $date['today'];
	$st_timetype = $st_timetype ? $st_timetype : 'am';

	/*
	SELECT apply.st_date, apply.st_timetype, apply.st_id, mdata.name, apply.department, apply.pt_name, apply.date_reg
	FROM
	(
		(
			kd44_khusd_st_cnslt_room_manager_candi as candi
			LEFT JOIN kd44_khusd_st_cnslt_room_manager_apply as apply on candi.apply_uid=apply.uid
		)
		LEFT JOIN kd44_s_mbrid as mbrid ON mbrid.id=apply.st_id
	)
	LEFT JOIN kd44_s_mbrdata as mdata ON mbrid.uid=mdata.memberuid
	WHERE apply.s_uid='1' AND apply.st_date='20141016' AND apply.st_timetype='am'
	ORDER BY apply.date_reg ASC
	*/
	
	$_table = '(('.$table[$m.'candi'].' candi'
		.' LEFT JOIN '.$table[$m.'apply'].' apply ON candi.apply_uid=apply.uid)'
		.' LEFT JOIN '.$table['s_mbrid'].' mbrid ON mbrid.id=apply.st_id)'
		.' LEFT JOIN '.$table['s_mbrdata'].' mbrdata ON mbrid.uid=mbrdata.memberuid'
		;
		
	$where = 
		"candi.st_date = '".$st_date."'"
		." AND candi.s_uid = '".$s_uid."'"
		." AND apply.st_type = '".$st_type."'"
		." AND candi.st_timetype = '".$st_timetype."'";
	
	$_order = ' ORDER BY apply.date_reg ASC';
	$_where = $where. $_order;

	$_data = 'mbrdata.name'
		.', apply.department'
		.', apply.pt_name'
		.', apply.st_type'
		.', apply.tx_plan'
		.', apply.date_reg'
		;
	
	
	$start_date = getDateOfDay(
				$st_date, 
				$d['khusd_st_cnslt_room_manager']['apply_time']['start_day'], 
				$d['khusd_st_cnslt_room_manager']['apply_time']['start_hour']
			);
	$end_date = getDateOfDay(
				$st_date, 
				$d['khusd_st_cnslt_room_manager']['apply_time']['end_day'], 
				$d['khusd_st_cnslt_room_manager']['apply_time']['end_hour']
			);	

	if($st_type == 'perio'){
		$_table .= ' LEFT JOIN (select sc.*  from '.$table['khusd_st_perio'.'score']
		 .' sc, (SELECT MAX(date_update) date_update,st_id FROM '.$table['khusd_st_perio'.'score'].' WHERE is_goal = \'n\' GROUP BY st_id) sc_j where sc.st_id = sc_j.st_id and sc.date_update = sc_j.date_update) sc ON apply.st_id=sc.st_id';		
		$_data .= ", sc.stpc, sc.stsc, sc.stcu, (sc.stpc+sc.stsc) scpc, sc.stspt_complete, sc.stspt_incomplete, (13*sc.stspt_incomplete + 18*sc.stspt_complete + 10*sc.stcu) st_score ";
		
		$_order = " AND apply.date_reg >= $start_date and apply.date_reg <= $end_date ORDER BY st_score, sc.stsc ASC";
		$_order_add = " AND apply.date_reg >= $end_date ORDER BY st_score, apply.date_reg ASC";
		$_where = $where." AND candi.st_date = apply.st_date ". $_order;

		$_where_add = $where. $_order_add;

		/////$CANDI_ROWS_ADDITIONAL = getDbSelect($_table, $_where_add, $_data);

		//echo "SELECT $_data FROM $_table WHERE $_where_add";
	}else if($st_type == 'consv'){
		$_data_pre_op = 
		'sc.st_op_tooth_colored_cervical'
		.' + sc.st_op_tooth_colored_simple'
		.' + sc.st_op_tooth_colored_complex'
		.' + sc.st_op_tooth_colored_diastema'
		.' + sc.st_op_am_simple'
		.' + sc.st_op_am_complex';

		$_table .= ' LEFT JOIN (select sc.*  from '.$table['khusd_st_consv'.'score']
		 .' sc, (SELECT MAX(date_update) date_update,st_id FROM '.$table['khusd_st_consv'.'score'].' GROUP BY st_id) sc_j where sc.st_id = sc_j.st_id and sc.date_update = sc_j.date_update) sc ON apply.st_id=sc.st_id';		
		$_data .= ", ($_data_pre_op) pre_op ";

		$_order = " AND apply.date_reg >= $start_date and apply.date_reg <= $end_date ORDER BY pre_op, apply.date_reg ASC";
		$_order_add = " AND apply.date_reg >= $end_date ORDER BY pre_op, apply.date_reg ASC";
		$_where = $where. $_order;

		$_where_add = $where. $_order_add;

		$CANDI_ROWS_ADDITIONAL = getDbSelect($_table, $_where_add, $_data);

		
//		echo "SELECT $_data FROM $_table WHERE $_where";
	}else if($st_type == 'pros'){
		$_table .= ' LEFT JOIN (select sc.*  from '.$table['khusd_st_pros'.'score']
		 .' sc, (SELECT MAX(date_update) date_update,st_id FROM '.$table['khusd_st_pros'.'score'].' GROUP BY st_id) sc_j where sc.st_id = sc_j.st_id and sc.date_update = sc_j.date_update) sc ON apply.st_id=sc.st_id';		
		//$_data .= ",  ";
		$_data .= ", if(apply.pt_name = sc.st_case_1_pt_name, 'O', 'X') as is_first ";

		
		$_order = " ORDER BY is_first ASC, apply.date_reg ASC";
		$_order_add = " ORDER BY is_first ASC, apply.date_reg ASC";
		$_where = $where." AND candi.st_date = apply.st_date ". $_order;

		$_where_add = $where. $_order_add;

		//$CANDI_ROWS_ADDITIONAL = getDbSelect($_table, $_where_add, $_data);		
	}
	
	$CANDI_ROWS = getDbSelect($_table, $_where, $_data);

	/*
	$CANDI_FIRST = null;
	$CANDI_ARRAY = array();
	while($_ROW = db_fetch_array($CANDI_ROWS))
	{
		$st_id = $_ROW['st_id'];
		
		$stid_array = getDbData($table['s_mbrid'],"id='".$st_id."'", '*');
		$stdata_array = getDbData($table['s_mbrdata'], "memberuid='".$stid_array['uid']."'", '*');

		$st_array = array_merge($stid_array, $stdata_array);

		$CANDI_ARRAY[$_ROW['uid']] = $_ROW;
		if($_ROW['is_first'] == 'y')
		{
			$CANDI_FIRST = $_ROW;
			$CANDI_FIRST['st_info'] = $st_array;
		}
		
		$CANDI_ARRAY[$_ROW['uid']]['st_info'] = $st_array;
	}*/
	
	
?>
