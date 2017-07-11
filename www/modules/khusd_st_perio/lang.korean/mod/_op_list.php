<?php
	$OP_ARRAY = array();
	
	// 기준이 되는 날이 없으면 오늘을 기준으로, 이번주를 출력
	if(!$wdate) $t_date = $date['today'];
	else {
		// wdate 가 있으면 $wd 값에 따라 전주/다음주 출력
		$t_date = mktime(0,0,0,
							intval(substr($wdate,4,2)),
							intval(substr($wdate,6,2)),
							intval(substr($wdate,0,4)));
		
		if($wd == 'p') $t_date -= (60 * 60 * 24 * 7);
		else if($wd == 'n') $t_date += (60 * 60 * 24 * 7);
		
		$t_date = date('Ymd', $t_date);
	}
	
	// todo 오늘이 일요일이면 다음주를 출력?
	// todo 한 주 시작을 옵션으로 선택할 수 있게 수정하기
	
	// 기준되는 주의 첫날~마지막날 날짜 구하기
	$first_of_week_array = getMonDate($t_date);
	$last_of_week_array = getSunDate($t_date);
	
	$first_of_week = $first_of_week_array['totime'];
	$last_of_week = $last_of_week_array['totime'];
		
	// 기준이 되는 주의 첫날~마지막날 요일 구하기
	$first_day_of_week = getWeekday($first_of_week_array['toweek']);
	$last_day_of_week = getWeekday($last_of_week_array['toweek']);
	
	$OP_ROWS = getDbArray($table[$m.'op_list'], 'op_date >= '.$first_of_week_array['today'].' AND op_date <= '.$last_of_week_array['today'], '*', 'op_date, op_time', 'ASC', 0, 0);
	
	while( $_ROW = db_fetch_array($OP_ROWS) ) {
		if(!$OP_ARRAY[$_ROW['op_date']]) {
			$OP_ARRAY[$_ROW['op_date']] = array();
			
			$date_i = mktime(0,0,0, substr($_ROW['op_date'], 4, 2), substr($_ROW['op_date'], 6, 2), substr($_ROW['op_date'], 0, 4));
			$_date['PROC'] = date('YmdHisw', $date_i);
			$_date['totime'] = substr($_date['PROC'],0,14);
			$_date['year']	= substr($_date['PROC'],0,4);
			$_date['month']	= substr($_date['PROC'],0,6);
			$_date['today']  = substr($_date['PROC'],0,8);
			$_date['nhour']  = substr($_date['PROC'],0,10);
			$_date['tohour'] = substr($_date['PROC'],8,6);
			$_date['toweek'] = substr($_date['PROC'],14,1);
			
			$OP_ARRAY[$_ROW['op_date']]['_date'] = $_date;
		}
		
		$OP_ARRAY[$_ROW['op_date']][] = $_ROW;
	}
	
	$wdate = $t_date;
?>