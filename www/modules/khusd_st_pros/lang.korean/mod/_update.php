<?php
	// 기존 정보 불러오기
	$SCORE_ROWS = getDbArray($table[$m.'score'],"s_uid = '".$s_uid."' AND st_id='".$my['id']."'", '*', 'date_update', 'desc', 1, 1);
	$SCORE = db_fetch_array($SCORE_ROWS);
	
	if(!$SCORE['uid']) {
		$SCORE['second_cr_ongoing'] = 0;
		$SCORE['post_core_ongoing'] = 0;
		$SCORE['imp_cr_br_ongoing'] = 0;
		$SCORE['single_cr_ongoing'] = 0;
		$SCORE['br_ongoing'] = 0;
		$SCORE['partial_denture_ongoing'] = 0;
		$SCORE['complete_denture_ongoing'] = 0;
		$SCORE['others_ongoing'] = 0;

		$SCORE['second_cr_complete'] = 0;
		$SCORE['post_core_complete'] = 0;
		$SCORE['imp_cr_br_complete'] = 0;
		$SCORE['single_cr_complete'] = 0;
		$SCORE['br_complete'] = 0;
		$SCORE['partial_denture_complete'] = 0;
		$SCORE['complete_denture_complete'] = 0;
		$SCORE['others_complete'] = 0;

		$SCORE['second_cr_cancel'] = 0;
		$SCORE['post_core_cancel'] = 0;
		$SCORE['imp_cr_br_cancel'] = 0;
		$SCORE['single_cr_cancel'] = 0;
		$SCORE['br_cancel'] = 0;
		$SCORE['partial_denture_cancel'] = 0;
		$SCORE['complete_denture_cancel'] = 0;
		$SCORE['others_cancel'] = 0;
	}
	
	
?>