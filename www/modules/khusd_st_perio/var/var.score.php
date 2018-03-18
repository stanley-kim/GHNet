<?php
$d['khusd_st_perio']['score'] = array(
	'iot'		=> 7,
        'iot2'		=> 7,
	'charting'	=> 7,
        'charting2'	=> 7,
	'surgery'	=> 10,
        'surgery2'	=> 8,
	'imp_1st'	=> 8,
        'imp_1st2'	=> 6,
	'imp_2nd'	=> 5,
        'imp_2nd2'	=> 4,
	'sc'		=> 3,
        'sc2'		=> 2,
	'others'	=> 1,
	'tbi'		=> 1,
        'tbi2'		=> 1,
	'fix'		=> 1,
	
	'stsc'		=> 13,
	'stpc'		=> 5,
	'stspt_complete'		=> 18,
	'stspt_incomplete'		=> 13,
	'stcu'		=> 10
);


$d['khusd_st_perio']['score']['ratio']['3']['obser_ratio'] = 0.38 * 70.0 / 507.0 ;
$d['khusd_st_perio']['score']['ratio']['3']['obser_100_ratio'] = 70.0 / 479.0; //mo use
$d['khusd_st_perio']['score']['ratio']['3']['st_ratio'] = 0.5 * 70.0 / 138.0 ;
$d['khusd_st_perio']['score']['ratio']['3']['st_100_ratio'] = 70.0 / 108.0; //no use

// 치주과랑 반올림 방식이 달라서.. 100점만점으로 옵저/st 점수를 구한 후 다시 38% 50% 반영해야하므로
// todo 임시로 이렇게 수정... 추후 정리 필요....
$d['khusd_st_perio']['score']['ratio']['3']['obser'] = 0.38;
$d['khusd_st_perio']['score']['ratio']['3']['st'] = 0.50;

$d['khusd_st_perio']['score']['ratio']['3']['fix'] = 12;

$d['khusd_st_perio']['score']['ratio']['3']['obser_max'] = 100;
$d['khusd_st_perio']['score']['ratio']['3']['st_max'] = 100;



$d['khusd_st_perio']['score']['ratio']['2']['obser_ratio'] = 28.0 / 429.0 ;
$d['khusd_st_perio']['score']['ratio']['2']['obser_100_ratio'] = 70.0 / 479.0; //mo use
$d['khusd_st_perio']['score']['ratio']['2']['st_ratio'] = 28.0 / 108.0 ;
$d['khusd_st_perio']['score']['ratio']['2']['st_100_ratio'] = 70.0 / 108.0; //no use

// 치주과랑 반올림 방식이 달라서.. 100점만점으로 옵저/st 점수를 구한 후 다시 38% 50% 반영해야하므로
// todo 임시로 이렇게 수정... 추후 정리 필요....
$d['khusd_st_perio']['score']['ratio']['2']['obser'] = 0.38;
$d['khusd_st_perio']['score']['ratio']['2']['st'] = 0.50;

$d['khusd_st_perio']['score']['ratio']['2']['fix'] = 20;

$d['khusd_st_perio']['score']['ratio']['2']['obser_max'] = 100;
$d['khusd_st_perio']['score']['ratio']['2']['st_max'] = 100;



/* 2015년도 3학년 2학기 계산법
        Ch	12 x 7(point)
	Sc 	80 X 3
	TBI	6 x 1
	others	1
	IOT	7 x 7
	
	Surgery 10 x 10 - 4 (implant require)
	
	obser => 12 x 7 + 80 x 30 + 6 x 1 + 7 x 7 + 10 x 10 = 479
	479가 70점, 이것의 38% 반영
	
	x * 70 / 479 * 38 / 100 => 옵져 최종 점수
	
	ST Ch&Sc 	6 x 18
	ST Ch&Pc		13
	
	St => 108
	108이 70점, 이것의 50% 반영
	
	x * 70 / 108 * 50 / 100 => ST 최종 점수
	
	Fix 12% 반영
	보통 10~11점 나옴
*/
$d['khusd_st_perio']['score']['ratio']['2015FW3Y']['obser_ratio'] = 70.0 / 479.0 * 0.38;
$d['khusd_st_perio']['score']['ratio']['2015FW3Y']['obser_100_ratio'] = 70.0 / 479.0;
$d['khusd_st_perio']['score']['ratio']['2015FW3Y']['st_ratio'] = 70.0 / 108.0 * 0.5;
$d['khusd_st_perio']['score']['ratio']['2015FW3Y']['st_100_ratio'] = 70.0 / 108.0;

// 치주과랑 반올림 방식이 달라서.. 100점만점으로 옵저/st 점수를 구한 후 다시 38% 50% 반영해야하므로
// todo 임시로 이렇게 수정... 추후 정리 필요....
$d['khusd_st_perio']['score']['ratio']['2015FW3Y']['obser'] = 0.38;
$d['khusd_st_perio']['score']['ratio']['2015FW3Y']['st'] = 0.50;

$d['khusd_st_perio']['score']['ratio']['2015FW3Y']['fix'] = 12;

$d['khusd_st_perio']['score']['ratio']['2015FW3Y']['obser_max'] = 100;
$d['khusd_st_perio']['score']['ratio']['2015FW3Y']['st_max'] = 100;


/* 2015년도 4학년 1학기 계산법
 	Ch	12 x 7	= 84
 	iot	7 x 7 = 49
 	sc	110 x 3 = 330
 	tbi	6 x 1 = 6
 	surgery	15 x 10 = 150 - 6(implant require 3개이므로 2점씩 6점 빼기)
 	
 	obser => 84 + 49 + 330 + 6 + 150 - 6 = 619 - 6 = 613
 	613이 70점, 이것의 38% 반영
 	그ㄴ데 하ㄱ새ㅇ다ㅁ다ㅇ새ㅁ이 603으로 하시ㅁ
 	
 	x * 70 / 613 * 0.38 => 옵져 최종 반영 점수 (1저ㅁ다ㅇ 0.0434)
 	
 	ST Sc&Pc	6 x 18 = 108
 	ST Cu		6 x 10 = 60
 	
 	St => 168
 	168이 70점, 이것의 50% 반영
 	
 	x * 70 / 168 * 0.5 => ST 최종 반영 점수 (1저ㅁ다ㅇ 0.208333)
 	
 	Fix 12% 반영 (20%일때 보통 17~18점 나왔음)
*/
$d['khusd_st_perio']['score']['ratio']['2015SS4Y']['obser_ratio'] = 44.0 * 0.7 / 603.0;
$d['khusd_st_perio']['score']['ratio']['2015SS4Y']['obser_100_ratio'] = 44.0 / 860.0;
$d['khusd_st_perio']['score']['ratio']['2015SS4Y']['st_ratio'] = 50.0 * 0.7 / 168.0;
$d['khusd_st_perio']['score']['ratio']['2015SS4Y']['st_100_ratio'] = 50.0 / 240.0;

// 치주과랑 반올림 방식이 달라서.. 100점만점으로 옵저/st 점수를 구한 후 다시 38% 50% 반영해야하므로
// todo 임시로 이렇게 수정... 추후 정리 필요....
$d['khusd_st_perio']['score']['ratio']['2015SS4Y']['obser'] = 0.38;
$d['khusd_st_perio']['score']['ratio']['2015SS4Y']['st'] = 0.50;

$d['khusd_st_perio']['score']['ratio']['2015SS4Y']['fix'] = 12;

$d['khusd_st_perio']['score']['ratio']['2015SS4Y']['obser_max'] = 44;
$d['khusd_st_perio']['score']['ratio']['2015SS4Y']['st_max'] = 50;

/* 2014년도 3학년 2학기 계산법
        Ch	12 x 7(point)
	Sc 	80 X 3
	TBI	6 x 1
	others	1
	IOT	7 x 7
	
	Surgery 10 x 10 - 4 (implant require)
	
	obser => 12 x 7 + 80 x 30 + 6 x 1 + 7 x 7 + 10 x 10 = 479
	479가 70점, 이것의 38% 반영
	
	x * 70 / 479 * 38 / 100 => 옵져 최종 점수
	
	ST Ch&Sc 	6 x 18
	ST Ch&Pc		13
	
	St => 108
	108이 70점, 이것의 50% 반영
	
	x * 70 / 108 * 50 / 100 => ST 최종 점수
	
	Fix 12% 반영
	보통 10~11점 나옴
*/
$d['khusd_st_perio']['score']['ratio']['2014FW3Y']['obser_ratio'] = 70.0 / 479.0 * 0.38;
$d['khusd_st_perio']['score']['ratio']['2014FW3Y']['obser_100_ratio'] = 70.0 / 479.0;
$d['khusd_st_perio']['score']['ratio']['2014FW3Y']['st_ratio'] = 70.0 / 108.0 * 0.5;
$d['khusd_st_perio']['score']['ratio']['2014FW3Y']['st_100_ratio'] = 70.0 / 108.0;

// 치주과랑 반올림 방식이 달라서.. 100점만점으로 옵저/st 점수를 구한 후 다시 38% 50% 반영해야하므로
// todo 임시로 이렇게 수정... 추후 정리 필요....
$d['khusd_st_perio']['score']['ratio']['2014FW3Y']['obser'] = 0.38;
$d['khusd_st_perio']['score']['ratio']['2014FW3Y']['st'] = 0.50;

$d['khusd_st_perio']['score']['ratio']['2014FW3Y']['fix'] = 12;

$d['khusd_st_perio']['score']['ratio']['2014FW3Y']['obser_max'] = 100;
$d['khusd_st_perio']['score']['ratio']['2014FW3Y']['st_max'] = 100;

/*
	2013년도 3학년 2학기 계산법
	
	Ch	12 x 7(point)
	Sc 	80 X 3
	TBI	6 x 1
	others	1
	IOT	7 x 7
	
	Surgery 10 x 10 - 4 (implant require)
	
	obser => 12 x 7 + 80 x 30 + 6 x 1 + 7 x 7 + 10 x 10 = 479
	479가 70점, 이것의 40% 반영
	
	x * 70 / 479 * 40 / 100 => 옵져 최종 점수
	
	ST Ch&Sc 	6 x 18
	ST Ch&Pc		13
	
	St => 108
	108이 70점, 이것의 40% 반영
	
	x * 70 / 108 * 40 / 100 => ST 최종 점수
	
	Fix 20% 반영
	보통 17~18점 나옴 (20% 반영할 때)
*/
$d['khusd_st_perio']['score']['ratio']['obser_ratio'] = 70.0 / 475.0 * 40.0 / 100.0;
$d['khusd_st_perio']['score']['ratio']['st_ratio'] = 70.0 / 108.0 * 40.0 / 100.0;
$d['khusd_st_perio']['score']['ratio']['fix'] = 18;

$d['khusd_st_perio']['score']['ratio']['obser_max'] = 40;
$d['khusd_st_perio']['score']['ratio']['st_max'] = 40;

$d['khusd_st_perio']['require'] = array(
	'charting'		=> 12,
	'sc'			=> 110,
	'tbi'			=> 6,
	'iot'			=> 7
);


$d['khusd_st_perio']['surgery'] = array(
	's'		=> "소환방신청",
	't'		=> "양도받음",
	'c'		=> "수술취소",
	'r'		=> "랜덤배정",
	'd'		=> "잘못입력",
	'm'		=> "양도함",
);
?>
