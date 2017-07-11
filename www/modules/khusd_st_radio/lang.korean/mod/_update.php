<?php
	// 기존 정보 불러오기
	$SCORE_ROWS = getDbArray($table[$m.'score'],"s_uid = '".$s_uid."' AND st_id='".$my['id']."'", '*', 'date_update', 'desc', 1, 1);
	$SCORE = db_fetch_array($SCORE_ROWS);
	
	if(!$SCORE['uid']) {
		$SCORE['penalty_taking'] = 0;
		$SCORE['taking'] = 0;
		$SCORE['taking_pt'] = 0;
		$SCORE['follow'] = 0;
		$SCORE['panorama'] = 0;
	}
?>