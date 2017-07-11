<?php
$CHAIR_NUM_MAX = 30;
$CHAIR_NUM_PAGE = 12;

// 신청시간 : 일요일 오전 10시 ~ 일요일 오후10시
$d['khusd_st_cnslt_room_manager']['st_time'] = array(
	'start_day'		=> 0,
	'start_hour'	        => 20,
	'end_day'		=> 6, 
	'end_hour'		=> 14
);

// 신청시간 : 토요일 오후 4시 ~ 토요일 오후 6시
$d['khusd_st_cnslt_room_manager']['apply_time'] = array(
	'start_day'		=> -1,
	'start_hour'	        => 16,
	'end_day'		=> -1, 
	'end_hour'		=> 18
);

$d['khusd_st_cnslt_room_manager']['cancel_time'] = array(
	'am'		=> 10,
	'pm'	        => 18
);

// 신청자가 신청 상태일 때 취소 혹은 삭제할 수 있는데, 
// 이를 취소로 할지, 삭제를 할지 정하는 옵션
// 기본값은 delete
$d['khusd_st_cnslt_room_manager']['radio']['delete_action'] = 'cancel';

$d['khusd_st_cnslt_room_manager']['apply']['status'] = array(
	'APPLY'		=> 'p',
	'ACCEPTED'	=> 'a', 
	'CANCEL'	=> 'c', 
	'CANDI'		=> 'd',
	'ADD_ACCEPTED'	=> 'b'
);

$d['khusd_st_cnslt_room_manager']['tx_plan']['perio'] = array(
	'pre_sc'	=>	array( 	'id' => 'pre_sc', 
							'name' => 'Pre-SC', 
							'time' => 
								array( 
									'am' => array( 'start' => '0900', 'end' => '1200' ), 
									'pm' => array( 'start' => '1330', 'end' => '1730' )
									)
	),
	'pre_resc'	=>	array( 	'id' => 'pre_resc', 
							'name' => 'Pre-ReSC' 
	),
	'pre_spt'	=>	array( 	'id' => 'pre_spt', 
							'name' => 'Pre-SPT', 
							'time' => 
								array( 
									'am' => array( 'start' => '0930', 'end' => '1200' ), 
									'pm' => array( 'start' => '1500', 'end' => '1730' )
									)
	),
	'pre_respt'	=>	array( 	'id' => 'pre_respt', 
							'name' => 'Pre-ReSPT' 
	),
	'sc'	=>	array( 	'id' => 'sc', 
						'name' => 'Sc', 
						'time' => 
							array( 
								'am' => array( 'start' => '0900', 'end' => '1200' ), 
								'pm' => array( 'start' => '1330', 'end' => '1730' )
								)
	),
	'resc'	=>	array( 	'id' => 'resc', 
						'name' => 'ReSc' 
	),
	'spt'	=>	array( 	'id' => 'spt', 
						'name' => 'SPT', 
						'time' => 
							array( 
								'am' => array( 'start' => '0930', 'end' => '1200' ), 
								'pm' => array( 'start' => '1500', 'end' => '1730' )
								)
	),
	'respt'	=>	array( 	'id' => 'respt', 
						'name' => 'ReSPT' 
	),
	'cu'	=>	array( 	'id' => 'cu', 
						'name' => 'Cu' 
	)
);

$d['khusd_st_cnslt_room_manager']['tx_plan']['consv'] = array(
	'rf'		=> array(	'id' => 'rf', 		'name' => 'RF'	),
	'af'		=> array(	'id' => 'af', 		'name' => 'AF'	),
	'ca'		=> array(	'id' => 'ca', 		'name' => 'CA'	),
	'diastema'		=> array(	'id' => 'diastema', 		'name' => 'Diastema'	),

	'inlay_select_rf'		=> array(	'id' => 'inlay_select_rf', 		'name' => 'Inlay Select & RF'	),
	'inlay_select_af'		=> array(	'id' => 'inlay_select_af', 		'name' => 'Inlay Select & AF'	),
	'inlay_select_ca'		=> array(	'id' => 'inlay_select_ca', 		'name' => 'Inlay Select & CA'	),
	'inlay_select_diastema'		=> array(	'id' => 'inlay_select_diastema', 		'name' => 'Inlay Select & Diastema'	),

	'inlay_select'		=> array(	'id' => 'inlay_select', 		'name' => 'Inlay Select'	),
	'inlay_prep'		=> array(	'id' => 'inlay_prep', 			'name' => 'Inlay Prep'	),
	'inlay_set'			=> array(	'id' => 'inlay_set', 			'name' => 'Inlay Set'	)
);

$d['khusd_st_cnslt_room_manager']['tx_plan']['pros'] = array(
	'case_selection'		=> array(	'id' => 'case_selection', 		'name' => 'Case Selection'	),
	'snap_impression'		=> array(	'id' => 'snap_impression', 		'name' => 'Snap Impression'	),
	'initial_prep'			=> array(	'id' => 'initial_prep', 		'name' => 'Initial Prep.'	),
	'final_prep'			=> array(	'id' => 'final_prep', 			'name' => 'Final Prep.'	),
	'temp_setting'			=> array(	'id' => 'temp_setting', 		'name' => 'Temporary Setting'	),
	'final_setting'			=> array(	'id' => 'final_setting', 		'name' => 'Final Setting'	),
	'matal_adap'			=> array(	'id' => 'matal_adap', 			'name' => 'Metal Adap.'	),
	'post_core'				=> array(	'id' => 'post_core', 			'name' => 'Post, Core'	), 
	'temp_cr_repair'		=> array(	'id' => 'temp_cr_repair', 		'name' => 'Temp. Cr. Repair' )
);

$d['khusd_st_cnslt_room_manager']['tx_plan']['endo'] = array(
	'pe'		=> array(	'id' => 'pe', 		'name' => 'PE'	),
	'ce'		=> array(	'id' => 'ce', 		'name' => 'CE'	),
	'cd'		=> array( 	'id' => 'cd',		'name' => 'CD'	),
	'cf'		=> array(	'id' => 'cf', 		'name' => 'CF'	), 
	'core'		=> array(	'id' => 'core', 	'name' => 'Resin Core' )
);

$d['khusd_st_cnslt_room_manager']['tx_plan']['pedia'] = array(
	'charting'		=> array(	'id' => 'charting', 		'name' => 'Charting'	),
	'pri_op'		=> array(	'id' => 'pri_op', 			'name' => '유치 OP'	),
	'per_op'		=> array(	'id' => 'per_op', 			'name' => '영구치 OP'	),
	'pfs'			=> array(	'id' => 'pfs',				'name' => 'Sealant' ),
	'ss_cr'			=> array(	'id' => 'ss_cr',			'name' => 'SS Crown' ),
	'celluloid_cr'	=> array( 	'id' => 'celluloid_cr',		'name' => 'Celluloid Crown' ),
	'pulpotomy'		=> array( 	'id' => 'pulpotomy',		'name' => 'Pulpotomy' ),
	'pulpectomy'	=> array( 	'id' => 'pulpectomy',		'name' => 'Pulpectomy' ),
	'maintainer'	=> array( 	'id' => 'maintainer',		'name' => 'Space Maintainer' ),
	'ext'			=> array( 	'id' => 'ext', 				'name' => '유치발치' ),
	'prophy'		=> array( 	'id' => 'prophy', 			'name' => 'Prophylaxis' ),
	'fluoride'		=> array( 	'id' => 'fluoride',			'name' => '불소도포' )
);

$d['khusd_st_cnslt_room_manager']['pros']['inst'] = array(
	'pf_baek_day'	=> array( 'day' => 2, 'timetype' => 'pm' ), 
	'pf_noh_day'	=> array( 'day' => 4, 'timetype' => 'am' ), 
	'list' 			=> array(
			'noh'		=> array( 'id' => 'noh', 	'name' => 'Pf.노관태' ),
			'baek'		=> array( 'id' => 'baek', 	'name' => 'Pf.백장현' ),
			'choi'		=> array( 'id' => 'choi', 	'name' => 'Dr.최원준' ),
			'chun'		=> array( 'id' => 'chun', 	'name' => 'Dr.천영훈' ),
			'lee'		=> array( 'id' => 'lee', 	'name' => 'Dr.이수지' ),
    			'lim'		=> array( 'id' => 'lim', 	'name' => 'Dr.임소은' ),
    			'min'		=> array( 'id' => 'min', 	'name' => 'Dr.김민지' ),
    			'seok'		=> array( 'id' => 'seok', 	'name' => 'Dr.이준석' ),
    			'young'		=> array( 'id' => 'young', 	'name' => 'Dr.최영하' ),
    			'tae'		=> array( 'id' => 'tae', 	'name' => 'Dr.김태윤' ),
    			'jae'		=> array( 'id' => 'jae', 	'name' => 'Dr.박윤재' ),
    			'yeon'		=> array( 'id' => 'yeon', 	'name' => 'Dr.이연이' ),
    			'hoo'		=> array( 'id' => 'hoo', 	'name' => 'Dr.이영후' ),
    			'jung'		=> array( 'id' => 'jung', 	'name' => 'Dr.정영철' ),

			'inst_park'		=> array( 'id' => 'inst_park',	'name' => 'Inst.박능석' ),
			'inst_jeong'	=> array( 'id' => 'inst_jeong',	'name' => 'Inst.정극모' ),
			'inst_choi'		=> array( 'id' => 'inst_choi',	'name' => 'Inst.최우진' ),
			'inst_kwon'		=> array( 'id' => 'inst_kwon',	'name' => 'Inst.권정은' )
		)
);
?>
