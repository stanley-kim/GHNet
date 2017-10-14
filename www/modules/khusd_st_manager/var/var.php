<?php
$d['khusd_st_manager']['manager_level']['st'] = 1; // 원내생, 기본레벨
$d['khusd_st_manager']['manager_level']['pros_sub'] = 4;
$d['khusd_st_manager']['manager_level']['chief_of_op'] = 5;
$d['khusd_st_manager']['manager_level']['radio'] = 6; // 방사
$d['khusd_st_manager']['manager_level']['ortho'] = 7; // 교정
$d['khusd_st_manager']['manager_level']['pedia'] = 8; // 소치
$d['khusd_st_manager']['manager_level']['oms'] = 9; // 외과
$d['khusd_st_manager']['manager_level']['perio'] = 10; // 치주
$d['khusd_st_manager']['manager_level']['pros'] = 11; // 보철
$d['khusd_st_manager']['manager_level']['consv'] = 12; // 보존 
$d['khusd_st_manager']['manager_level']['medi'] = 13; // 내과
$d['khusd_st_manager']['manager_level']['deleg'] = 14; // 총대단(총대단+총케이스장+총대)
$d['khusd_st_manager']['manager_level']['chief_of_cnslt_room'] = 15; //종진실장 레벨
$d['khusd_st_manager']['manager_level']['chief_of_case'] = 16; //총케이스장 레벨
$d['khusd_st_manager']['manager_level']['repres'] = 17; // 총대 레벨
$d['khusd_st_manager']['manager_level']['admin'] = 20; // 관리자 레벨

$d['khusd_st_manager']['history_recnum'] = 5;

$d['khusd_st_manager']['jointgroup'] = 10;
$d['khusd_st_manager']['recnum'] = 15;

$d['khusd_st_manager']['update_check'] = array(
	'start_day'		=> 5,
	'start_hour'		=> 11,
	'end_day'		=> 6,
	'end_hour'		=> 18
);

$d['khusd_st_manager']['update_check_2nd'] = array(
	'start_day'		=> 6,
	'start_hour'		=> 18,
	'end_day'		=> 6,
	'end_hour'		=> 22
);

$d['khusd_st_manager']['our_require'] = array(
	'perio' => 
		array(
			'20140517' => 
				array(
					'sc'	=>		40
				)
		)
);

$d['khusd_st_manager']['department'] = array(
			'radio'	=> 
				array(	'name'	=> '영상과',
						'id'	=> 'radio'
					),
			'ortho' =>
				array(	'name'	=> '교정과',
						'id'	=> 'ortho'
					),
			'pedia' =>
				array(	'name'	=> '소아치과',
						'id'	=> 'pedia'
					),
			'oms' =>
				array(	'name'	=> '구강외과',
						'id'	=> 'oms'
					),
			'perio' =>
				array(	'name'	=> '치주과',
						'id'	=> 'perio'
					),
			'consv' =>
				array(	'name'	=> '보존과',
						'id'	=> 'consv'
					),
			'pros' =>
				array(	'name'	=> '보철과',
						'id'	=> 'pros'
					),
			'medi' =>
				array(	'name'	=> '구강내과',
						'id'	=> 'medi'
					)
		);


$dept_array = array(
			'radio'	=> 
				array(	'name'	=> '영상과',
						'id'	=> 'radio'
					),
			'ortho' =>
				array(	'name'	=> '교정과',
						'id'	=> 'ortho'
					),
			'pedia' =>
				array(	'name'	=> '소아치과',
						'id'	=> 'pedia'
					),
			'oms' =>
				array(	'name'	=> '구강외과',
						'id'	=> 'oms'
					),
			'perio' =>
				array(	'name'	=> '치주과',
						'id'	=> 'perio'
					),
			'consv' =>
				array(	'name'	=> '보존과',
						'id'	=> 'consv'
					),
			'pros' =>
				array(	'name'	=> '보철과',
						'id'	=> 'pros'
					),
			'medi' =>
				array(	'name'	=> '구강내과',
						'id'	=> 'medi'
					)
		);

$d['khusd_st_manager']['selection']['perio_surgery']['surgery'] = "S";
$d['khusd_st_manager']['selection']['perio_surgery']['group'] = 'G';

$d['khusd_st_manager']['selection']['perio_chiot']['ch'] = "C";
$d['khusd_st_manager']['selection']['perio_chiot']['iot'] = "I";
$d['khusd_st_manager']['selection']['perio_chiot']['chiot'] = "P";
$d['khusd_st_manager']['selection']['perio_chiot']['group'] = 'G';

$d['khusd_st_manager']['selection']['oms']['surgery'] = "S";
$d['khusd_st_manager']['selection']['oms']['group'] = 'G';

$d['khusd_st_manager']['selection']['radio']['filming'] = "F";
$d['khusd_st_manager']['selection']['radio']['decoding'] = "D";
$d['khusd_st_manager']['selection']['radio']['fandp'] = "P";
$d['khusd_st_manager']['selection']['radio']['group'] = 'G';
?>
