<?php
	// 기존 정보 불러오기
	$SCORE_ROWS = getDbArray($table[$m.'score'],"s_uid = '".$s_uid."' AND st_id='".$my['id']."'", '*', 'date_update', 'desc', 1, 1);
	$SCORE = db_fetch_array($SCORE_ROWS);
	
	if(!$SCORE['uid']) {
		$SCORE['charting'] = 0;
		$SCORE['obser'] = 0;
		$SCORE['splint_obser'] = 0;
		$SCORE['physical_tx'] = 0;
		$SCORE['odor'] = 0;
		$SCORE['m_text'] = 0;
		$SCORE['charting_obser'] = 0;
		$SCORE['fix_am'] = 0;
		$SCORE['fix_pm'] = 0;
	}
?>