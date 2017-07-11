<?php
	// 기존 정보 불러오기
	$SCORE_ROWS = getDbArray($table[$m.'score'],"s_uid = '".$s_uid."' AND st_id='".$my['id']."' AND is_goal = 'n'", '*', 'date_update', 'desc', 1, 1);
	$SCORE = db_fetch_array($SCORE_ROWS);
	
	
	if(!$SCORE['uid']) {
		$SCORE['follow_pt'] = 0;
		$SCORE['follow'] = 0;
		$SCORE['charting'] = 0;
		$SCORE['charting_obser'] = 0;
		$SCORE['obser'] = 0;
		$SCORE['ga'] = 0;
		$SCORE['fix'] = 0;
		$SCORE['sedation_rp'] = 0;
		$SCORE['clinical_rp'] = 0;
		$SCORE['blsm'] = 0;
		$SCORE['st_pt'] = 0;
		$SCORE['st_point'] = 0;
		$SCORE['st_add_a'] = 0;
		$SCORE['st_add_b'] = 0;
		$SCORE['st_add_c'] = 0;
		$SCORE['st_assist'] = 0;
		$SCORE['fix'] = 0;

		$SCORE['follow_ch'] = '0';
		for($i = 1; $i < 11; $i++){
			$SCORE['follow_'.$i] = '0';
		}

	}else{
		
		$arr = explode("|",$SCORE['follow_str']);
		if(count($arr) != 11){
			$SCORE['follow_ch'] = '0';
			for($i = 1; $i < 11; $i++){
				$SCORE['follow_'.$i] = '0';
			}
		}else{
			$SCORE['follow_ch'] = $arr[0];
			for($i = 1; $i <= count($arr); $i++){
				$SCORE['follow_'.$i] = $arr[$i];
			}			
		}

	}
?>