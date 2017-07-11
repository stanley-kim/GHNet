<?php
$d['khusd_st_medi']['score'] = array (
	'charting'	=> 5, //차팅
	'soft_charting'	=> 3, //연조직 차팅
	'obser'		=> 2,//단순옵저
	'splint_obser'	=> 5,
	'splint_impression'	=> 3,
	'splint_polishing'	=> 3,
	'splint_adjust'	=> 2,
	'physical_tx'	=> 2,
	'odor'		=> 2, //구취
	'm_text'	=> 10, //의료문서
	'fix'		=> 10 //교수님 픽스
);

$d['khusd_st_medi']['require'] = array (
	'charting'		=> 5,
	'obser'			=> 15,
	'odor'			=> 1,
	'm_text'		=> 1,
	'fix_pm'		=> 1,
	'fix'			=> 2
);
?>