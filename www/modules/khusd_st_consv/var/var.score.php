<?php

$d['khusd_st_consv']['score']['ratio'] = array(
	'obser'		=> 30.0 / 240.0,
	'st'		=> 1,
        'fw'        => 20.0 / 160.0
);

$d['khusd_st_consv']['score']['fix'] = 27;	// 평균값, 30점 만점
$d['khusd_st_consv']['score']['max'] = array(
	'obser' => 20, 
	'st'	=> 100
);

$d['khusd_st_consv']['score']['st'] = array(
	'st_op_simple'			=> 2,
	'st_op_complex'			=> 3,
	'st_op_diastema'		=> 5,
	'st_op_bleaching'		=> 2,
	'st_inlay'				=> 5,
	'st_op_others'			=> 0.5
);

$d['khusd_st_consv']['score']['obser'] = array(
	'indirect_prep_imp'			=> 4,
	'indirect_setting'			=> 2,
	'am'						=> 2,
	'tooth_colored_simple'		=> 2,
	'tooth_colored_complex'		=> 3,
	'tooth_colored_diastema'	=> 6,
	'post'						=> 2,
	'core'						=> 2,
	'others'					=> 0.5,
	'endo_molar_pe'				=> 3,
	'endo_molar_ce'				=> 3,
	'endo_molar_cf'				=> 3,
	'endo_molar_etc'			=> 1,
	'endo_pre_pe'				=> 2,
	'endo_pre_ce'				=> 2,
	'endo_pre_cf'				=> 2,
	'endo_pre_etc'				=> 1,
	'endo_ant_pe'				=> 2,
	'endo_ant_ce'				=> 2,
	'endo_ant_cf'				=> 2,
	'endo_ant_etc'				=> 1,
	'charting'				=> 4,
	'surgery'				=> 10,
	'miscellaneous'				=> 5,
        'bleaching'                             => 3,
	
	'st_am_simple'				=> 2,
	'st_am_complex'				=> 3,
	'st_tooth_colored_cervical'	=> 2,
	'st_tooth_colored_simple'	=> 2,
	'st_tooth_colored_complex'	=> 3,
	'st_tooth_colored_diastema'	=> 5,
	'st_endo'					=> 10,
	'st_inlay'					=> 5,
	'st_bleaching'				=> 2,
	'st_others'					=> 0.5,
        
        'extra-endo-ind'                => 5
);

$d['khusd_st_consv']['require']['obser'] = array(
	'indirect_prep_imp'			=> 6,
	'indirect_setting'			=> 6,
	'tooth_colored'				=> 24,
	'tooth_colored_complex'		=> 10,
	'endo_molar'				=> 10,
	'endo'						=> 30,
	'surgery'					=> 2,
	'miscellaneous'				=> 1,

	'st_am'						=> 2,
	'st_am_tooth_colored'		=> 10,
	'st_endo'					=> 0,
	'st_inlay'					=> 0,
	'st_bleaching'				=> 0,
	'st_others'					=> 0
);

$d['khusd_st_consv']['require']['follow'] = array(
	'indirect'  => 6,
        'endo'      => 0,
        'surgery'   => 2,
        'bleach'    => 0,
        'perio-consv'   => 4
);

$d['khusd_st_consv']['penalty']['follow'] = array(
        'indirect'  => 6,
        'surgery'   => 10,
        'perio-consv'   => 7
);

$d['khusd_st_consv']['require']['st'] = array(
	'st_op'				=> 12,
	'st_endo'			=> 1,
	'st_inlay'			=> 2,
	'st_am'				=> 2
);

$d['khusd_st_consv']['minus']['st'] = array(
	'st_endo'			=> 10,
	'st_op'				=> 2,
	'st_inlay'			=> 5,
	'st_am'				=> 0
);

$d['khusd_st_consv']['minus']['obser'] = array(
	'indirect_prep_imp'			=> 0,
	'indirect_setting'			=> 0,
	'tooth_colored'				=> 2,
	'tooth_colored_complex'		=> 1,
	'endo'						=> 2,
	'endo_molar'				=> 1,
	'surgery'					=> 0,
	'miscellaneous'				=> 0,
	
	'st_op'						=> 2,
	'st_op_am'					=> 2,
	'st_endo'					=> 10, 
	'st_inlay'					=> 5
);

$d['khusd_st_consv']['st_stage'] = array(

	'case_selection'		=> 'Case Selection',
	'pe'					=> 'Pulp Extirpation',
	'working_length'		=> 'Working Length',
	'ce'					=> 'Canal Enlargement',
	'master_cone'			=> 'Master Cone',
	'cf'					=> 'Canal Filling'
);

$d['khusd_st_consv']['st_inlay_case'] = array(
	'gold_inlay'			=> 'Gold Inlay', 
	'resin_inlay'			=> 'Resin Inlay'
);

$d['khusd_st_consv']['st_inlay_stage'] = array(

	'case_selection'		=> 'Case Selection',
	'inlay_prep'			=> 'Inlay Prep',
	'inlay_setting'			=> 'Inlay Set'
);

?>