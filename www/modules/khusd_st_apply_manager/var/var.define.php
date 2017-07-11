<?php

// apply_info_list 테이블의 status 값
$d['khusd_st_apply_manager']['apply_info']['OPEN'] = 'o';
$d['khusd_st_apply_manager']['apply_info']['CLOSED'] = 'c';

// apply_list 테이블의 status 값
$d['khusd_st_apply_manager']['apply_list']['APPLY'] = 'p';
$d['khusd_st_apply_manager']['apply_list']['CANCEL'] = 'c';
$d['khusd_st_apply_manager']['apply_list']['OVERAPPLY'] = 'o';

// 당첨자 선별 후 상태
$d['khusd_st_apply_manager']['apply_list']['EARLY'] = 'e';
$d['khusd_st_apply_manager']['apply_list']['LATE'] = 'l';
$d['khusd_st_apply_manager']['apply_list']['ACCEPTED'] = 'a';


$d['khusd_st_apply_manager']['perio_sur']['doctor'] = array(
	'prof' => array(
		'pf_h'	=> 'Pf.H'
		,'pf_c'	=> 'Pf.C'
		,'pf_s'	=> 'Pf.S'
		,'pf_y'	=> 'Pf.Y'
                ,'pf_p' => 'Pf.P'
                ,'pf_j' => 'Pf.J'
                ,'pf_l' => 'Pf.L'
	)
	,
	'doctor' => array(
		'dr_seo'	=> 'Dr.서'
		,'dr_so'	=> 'Dr.소'
		,'dr_dong'	=> 'Dr.동'
		,'dr_im'	=> 'Dr.진'
                ,'dr_moon'	=> 'Dr.문'
                ,'dr_kang'	=> 'Dr.강'
                ,'dr_jung'	=> 'Dr.정'
                ,'dr_do'	=> 'Dr.도'
                ,'dr_yeon'	=> 'Dr.연'
                ,'dr_son'	=> 'Dr.손'
		,'dr_seon'	=> 'Dr.선'
                ,'dr_'	=> 'Dr.'
                ,'dr_'	=> 'Dr.'
	)
);
?>
