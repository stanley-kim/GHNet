<?php 

// Ymd 포멧을 timestmap (sec) 으로 변환
function  mktimeFromYmd($ymd_date)
{
	if(!$ymd_date || !is_string($ymd_date) || strlen($ymd_date) != 8)
	{
		return 0;
	}
	
	return mktime(0, 0, 0, substr($ymd_date, 4, 2), substr($ymd_date, 6, 2), substr($ymd_date, 0, 4));
}

// YmdHis 포멧을 timestmap (sec) 으로 변환
function  mktimeFromYmdHis($ymd_date)
{
	if(!$ymd_date || !is_string($ymd_date) || strlen($ymd_date) != 8)
	{
		return 0;
	}
	
	return mktime(
		substr($ymd_date, 8, 2),
		substr($ymd_date, 10, 2),
		substr($ymd_date, 12, 2), 
		substr($ymd_date, 4, 2), 
		substr($ymd_date, 6, 2), 
		substr($ymd_date, 0, 4)
	);
}

// 기준이 되는 주의 월요일 구하기 (월요일 00시 00분 00초)
// 리턴값 포멧은 timestamp 값
function getMonDateTimestamp($date){
	$date_i = mktimeFromYmd($date);
	
	// 요일 구하기
	$date_array = getdate($date_i);
	$day_of_date = $date_array['wday'] == 0 ? 7 : $date_array['wday']; // 일요일은 0, 토요일은 6
	
	$monday_i = $date_i - (60*60*24) * ($day_of_date - 1);
	
	return $monday_i;
}

// 기준이 되는 주의 월요일 구하기
// 리턴값 포멧은 date array (_core/function/sys.func.php 의 getVDate 참고하기)
function getMonDate($date){
	$r_date['PROC'] = date('YmdHisw', getMonDateTimestamp($date));
	$r_date['totime'] = substr($r_date['PROC'],0,14);
	$r_date['year']	= substr($r_date['PROC'],0,4);
	$r_date['month']	= substr($r_date['PROC'],0,6);
	$r_date['today']  = substr($r_date['PROC'],0,8);
	$r_date['nhour']  = substr($r_date['PROC'],0,10);
	$r_date['tohour'] = substr($r_date['PROC'],8,6);
	$r_date['toweek'] = substr($r_date['PROC'],14,1);
	return $r_date;
}

// 기준이 되는 주의 일요일 구하기 (일요일 00시 00분 00초)
// 리턴값 포멧은 timestamp 값
function getSunDateTimestamp($date){
	$date_i = mktimeFromYmd($date);
	
	// 요일 구하기
	$date_array = getdate($date_i);
	$day_of_date = $date_array['wday'] == 0 ? 7 : $date_array['wday']; // 일요일은 0, 토요일은 6
	
	$sunday_i = $date_i + (60*60*24) * (7 - $day_of_date);	
	return $sunday_i;
}

// 기준이 되는 주의 일요일 구하기
// 리턴값 포멧은 date array (_core/function/sys.func.php 의 getVDate 참고하기)
function getSunDate($date){
	$r_date['PROC'] = date('YmdHisw', getSunDateTimestamp($date));
	$r_date['totime'] = substr($r_date['PROC'],0,14);
	$r_date['year']	= substr($r_date['PROC'],0,4);
	$r_date['month']	= substr($r_date['PROC'],0,6);
	$r_date['today']  = substr($r_date['PROC'],0,8);
	$r_date['nhour']  = substr($r_date['PROC'],0,10);
	$r_date['tohour'] = substr($r_date['PROC'],8,6);
	$r_date['toweek'] = substr($r_date['PROC'],14,1);
	return $r_date;
}

// 주어진 날짜/혹은 오늘이 포함된 주에 속하는지 판단
// 월요일부터 일요일까지를 한 주로 계산
function is_thisweekday($date, $weekdate = null) {
	global $date;
	
	if($weekdate == null) $weekdate = $date['today'];
	
	if(!$date) return false;
	
	// date와 weekdate를 timestamp 값으로 변환
	$date_i = mktimeFromYmd($date);
	$weekdate_i = mktimeFromYmd($weekdate);
	
	// $weekdate 가 속한 주의 월요일/일요일 날짜 구하기
	$mon_of_weekdate = getMonDateTimestamp($weekdate);
	$sun_of_weekdate = getSunDateTimestamp($weekdate);
	
	if($date_i >= $mon_of_weekdate && $date_i <= $sun_of_weekdate){
		return true;
	}
	
	return false;
}

// 기준일이 포함된 주의 특정 요일의 특정시간을 원하는 포맷으로 구하기
// 포맷은 기본적으로 YmdHis 포맷 사용
// $base_date 는 kimsq 의 $date['today'] 포맷 사용
// 한 주는 월요일~일요일 이다. 
// $day_offset 은 월요일이 1, 일요일이 7이다. 
function getDateOfDay($base_date, $day_offset, $hour, $format = 'YmdHis')
{
	$mon_t = getMonDateTimestamp($base_date);		// 기준일이 포함된 주의 월요일 구하기
	
	$date_t = $mon_t + ($day_offset - 1) * 24 * 60 * 60;
	$date_t += $hour * 60 * 60;
	
	return date($format, $date_t);
}

// 요일을 한글로 구하기
// '월, 화 수 목 금 토 일' 처럼 한 글자로 반환
// $week 값은 php의 date 함수에서 'w' parameter 로 나온 값을 사용
function getWeek($week)
{
	$week_kor = array("일", "월", "화", "수", "목", "금", "토");

	return $week_kor[$week];
}
?>