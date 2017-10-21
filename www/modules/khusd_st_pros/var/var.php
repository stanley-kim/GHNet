<?php
$d['khusd_st_pros']['layout'] = "";
$d['khusd_st_pros']['theme'] = "";
$d['khusd_st_pros']['theme_m'] = "";

if(!$table[$m.'follow_pt']){
	$table[$m.'follow_pt'] = $DB['head'].'_'.$m.'_follow_pt'; // 팔로우 환자 정보 테이블
	$table[$m.'follow'] = $DB['head'].'_'.$m.'_follow'; 		// 팔로우 정보 테이블	
	$table[$m.'follow_comment'] = $DB['head'].'_'.$m.'_follow_comment'; 		// 팔로우 정보 테이블	
	$table[$m.'new_follow'] = $DB['head'].'_'.$m.'_new_follow'; 		// 팔로우 정보 테이블	
	$table[$m.'obser_score'] = $DB['head'].'_'.$m.'_obser_score'; 		// 옵저 정보 테이블

	}


$d['khusd_st_pros']['FOLLOWER_LIMIT'] = 30; // temporarily set as 4 (originally 2)

$d['khusd_st_pros']['FOLLOW_PT']['FOLLOWING'] = 'f';
$d['khusd_st_pros']['FOLLOW_PT']['FREE'] = 'e';

$d['khusd_st_pros']['FOLLOW_STATUS']['FOLLOWING'] = 'f';
$d['khusd_st_pros']['FOLLOW_STATUS']['COMPLETE'] = 'c';
$d['khusd_st_pros']['FOLLOW_STATUS']['DROP'] = 'd';

$d['khusd_st_pros']['OBSER_TYPES'] = array(
    array(	'name'	=> 'Post Core',
                'id'	=> 'PostCore'
            ),
    array(	'name'	=> 'Implant Cr&Br',
                'id'	=> 'imp'
            ),
    array(	'name'	=> 'Single Cr/Laminamte',
                'id'	=> 'single'
            ),
    array(	'name'	=> 'Bridge (3unit 이상)',
                'id'	=> 'bridge'
            ),
    array(	'name'	=> 'Partial Denture',
                'id'	=> 'pd'
            ),
    array(	'name'	=> 'Complete Denture',
                'id'	=> 'cd'
            ),
    array(	'name'	=> 'Others',
                'id'	=> 'others'
            )
);

$d['khusd_st_pros']['TYPES'] = array(
    array(	'name'	=> '2년차 Cr',
                'id'	=> '2ndCr'
            ),
    array(	'name'	=> 'Post Core',
                'id'	=> 'PostCore'
            ),
    array(	'name'	=> 'Implant Cr&Br',
                'id'	=> 'imp'
            ),
    array(	'name'	=> 'Single Cr/Laminamte',
                'id'	=> 'single'
            ),
    array(	'name'	=> 'Bridge (3unit 이상)',
                'id'	=> 'bridge'
            ),
    array(	'name'	=> 'Partial Denture',
                'id'	=> 'pd'
            ),
    array(	'name'	=> 'Complete Denture',
                'id'	=> 'cd'
            )/*,
    array(	'name'	=> 'Others',
                'id'	=> 'others'
            )*/
);

$d['khusd_st_pros']['others'] = array(
    array(	'name'	=> 'Others',
				'score' => 5
            ));
			
$d['khusd_st_pros']['single'] = array(
    array(	'name'	=> 'Tooth prep (single)',
				'score' => 20
            ),
    array(	'name'	=> 'Tooth prep (multiple)',
				'score' => 10
            ),
    array(	'name'	=> 'Core',
				'score' => 5
            ),
    array(	'name'	=> 'Temporization',
				'score' => 10
            ),
    array(	'name'	=> 'Temporary relining',
				'score' => 5
            ),
    array(	'name'	=> 'Impression',
				'score' => 15
            ),
    array(	'name'	=> 'Coping adap',
				'score' => 10
            ),
    array(	'name'	=> 'Temp setting',
				'score' => 10
            ),
    array(	'name'	=> 'Final setting',
				'score' => 10
            ),
    array(	'name'	=> 'Occlusal Adjustment',
				'score' => 5
            )
);
$d['khusd_st_pros']['bridge'] = array(
    array(	'name'	=> 'Tooth prep (single)',
				'score' => 20
            ),
    array(	'name'	=> 'Tooth prep (multiple)',
				'score' => 10
            ),
    array(	'name'	=> 'Core',
				'score' => 5
            ),
    array(	'name'	=> 'Temporization',
				'score' => 10
            ),
    array(	'name'	=> 'Temporary relining',
				'score' => 5
            ),
    array(	'name'	=> 'Impression',
				'score' => 15
            ),
    array(	'name'	=> 'Coping adap',
				'score' => 10
            ),
    array(	'name'	=> 'Temp setting',
				'score' => 10
            ),
    array(	'name'	=> 'Final setting',
				'score' => 10
            ),
    array(	'name'	=> 'Occlusal Adjustment',
				'score' => 5
            )
);
$d['khusd_st_pros']['cd'] = array(
    array(	'name'	=> 'Border molding',
				'score' => 30
            ),
    array(	'name'	=> 'Impression',
				'score' => 20
            ),
    array(	'name'	=> 'Framework try-in',
				'score' => 5
            ),
    array(	'name'	=> 'Jaw Relation Record',
				'score' => 15
            ),
    array(	'name'	=> 'Wax denture try-in',
				'score' => 15
            ),
    array(	'name'	=> 'Delivery',
				'score' => 20
            ),
    array(	'name'	=> 'F/U check',
				'score' => 10
            ),
    array(	'name'	=> 'Relining/Rebasing',
				'score' => 10
            )
);

$d['khusd_st_pros']['pd'] = array(
    array(	'name'	=> 'Border molding',
				'score' => 20
            ),
    array(	'name'	=> 'Impression',
				'score' => 20
            ),
    array(	'name'	=> 'Framework try-in',
				'score' => 5
            ),
    array(	'name'	=> 'Jaw Relation Record',
				'score' => 15
            ),
    array(	'name'	=> 'Wax denture try-in',
				'score' => 15
            ),
    array(	'name'	=> 'Delivery',
				'score' => 20
            ),
    array(	'name'	=> 'F/U check',
				'score' => 10
            ),
    array(	'name'	=> 'Relining/Rebasing',
				'score' => 10
            )
);


$d['khusd_st_pros']['imp'] = array(
    array(	'name'	=> 'Temporary prosthesis',
				'score' => 10
            ),
    array(	'name'	=> 'Impression',
				'score' => 10
            ),
    array(	'name'	=> 'Abutment/coping adap',
				'score' => 10
            ),
    array(	'name'	=> 'setting',
				'score' => 10
            )
);

$d['khusd_st_pros']['PostCore'] = array(
    array(	'name'	=> 'Canal preparation',
				'score' => 10
            ),
    array(	'name'	=> 'Impression',
				'score' => 10
            ),
    array(	'name'	=> 'Fiber post & core',
				'score' => 10
            ),
    array(	'name'	=> 'Cast post setting',
				'score' => 10
            )
);

$d['khusd_st_pros']['STATUS_OPTIONS'] = array(
    array(	'name'	=> '팔로우',
                'id'	=> 'f'
            ),
	array(	'name'	=> '포기',
                'id'	=> 'g'
            ),
	array(	'name'	=> '취소',
                'id'	=> 'c'
            ),
       array(	'name'	=> '완료',
                'id'	=> 'e'
            ),
       array(	'name'	=> '삭제',
                'id'	=> 'd'
            )
	);
?>
