<?php

	if($mode != 'st_list')
	{
		getLink('', '', '잘못된 접근 입니다.', '-1');
	}

	$_table = 
		$table[$m.'apply'].' st'
		.', '.$table['s_mbrdata'].' mbrdata'
		.','.$table['s_mbrid'].' mbrid';
	$_where = 
		"st.st_type = '".$st_type."'"
		.' AND mbrid.uid = mbrdata.memberuid'
		.' AND mbrid.id = st.st_id'
		." AND st.s_uid = '".$SEMESTER_INFO['uid']."'"
		." AND st.st_date = '".$st_date."'"
		." AND st.st_timetype = '".$st_timetype."'";
		
	$_data = 'st.*';
	$_sort = 'st.date_reg';
	$_orderby = 'ASC';
?>