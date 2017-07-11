<?php
	// 기존 정보 불러오기
	$SCORE_ROWS = getDbArray($table[$m.'score'],"s_uid = '".$s_uid."' AND st_id='".$my['id']."'", '*', 'date_update', 'desc', 1, 1);
	$SCORE = db_fetch_array($SCORE_ROWS);
	
	if(!$SCORE['uid']) {
		$SCORE['charting'] = 0;
		$SCORE['dressing'] = 0;
		$SCORE['cp'] = 0;
		$SCORE['simple_ext'] = 0;
		$SCORE['surgical_ext'] = 0;
		$SCORE['minor'] = 0;
		$SCORE['major'] = 0;
		$SCORE['fix'] = 0;
		$SCORE['st_case'] = 0;
		$SCORE['st_assist'] = 0;
		$SCORE['imp_1st'] = 0;
		$SCORE['imp_2nd'] = 0;
		$SCORE['st_dressing'] = 0;
		$SCORE['st_stitchout'] = 0;
	}
?>
