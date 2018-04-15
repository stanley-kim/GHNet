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
                ,'pf_j' => 'Pf.J'
                ,'pf_l' => 'Pf.L'
	)
	,
	'doctor' => array(
                 'dr_moon'	=> 'Dr.문'
                ,'dr_kang'	=> 'Dr.강'
                ,'dr_jung'	=> 'Dr.정'
                ,'dr_do'	=> 'Dr.도'
                ,'dr_min'	=> 'Dr.민'
                ,'dr_son'	=> 'Dr.손'
                ,'dr_hyang'	=> 'Dr.향'
                ,'dr_yeon'	=> 'Dr.연'
                ,'dr_ho'	=> 'Dr.호'
                ,'dr_yang'	=> 'Dr.양'
                ,'dr_yoo'	=> 'Dr.유'
                ,'dr_hwang'	=> 'Dr.황'
                ,'dr_hyup'	=> 'Dr.협'
                ,'dr_baek'	=> 'Dr.백'
                ,'dr_sang'	=> 'Dr.상'
                ,'dr_seo'	=> 'Dr.서'
                ,'dr_'	=> 'Dr.'
                ,'dr_'	=> 'Dr.'
	)
);



$d['khusd_st_apply_manager']['pros']['sub_category'] = array(
    array(      'name'  => 'Post Core',
                'id'    => 'PostCore'
            ),
    array(      'name'  => 'Implant Cr&Br',
                'id'    => 'imp'
            ),
    array(      'name'  => 'Single Cr/Laminamte',
                'id'    => 'single'
            ),
    array(      'name'  => 'Bridge (3unit 이상)',
                'id'    => 'bridge'
            ),
    array(      'name'  => 'Partial Denture',
                'id'    => 'pd'
            ),
    array(      'name'  => 'Complete Denture',
                'id'    => 'cd'
        )
);


$d['khusd_st_apply_manager']['apply_info']['order_list0'] = array(  
	array( 'name' => '정규(주말)' , 'id' => 'regular' ),
	array( 'name' => '추가(주중)' , 'id' => 'extra' )
	);


$d['khusd_st_apply_manager']['apply_info']['pre_apply_info']['status']['finished']  = 'f';   
$d['khusd_st_apply_manager']['apply_info']['pre_apply_info']['status']['cancelled'] = 'c';   
$d['khusd_st_apply_manager']['apply_info']['pre_apply_info']['status']['booked']    = 'b';   

$d['khusd_st_apply_manager']['apply_info']['type0']['multi']  = 'multi';   
$d['khusd_st_apply_manager']['apply_info']['type0']['single'] = 'single';   
$d['khusd_st_apply_manager']['apply_info']['type1']['weekend'] = '주말';   
$d['khusd_st_apply_manager']['apply_info']['type1']['weekday'] = '주중';   
$d['khusd_st_apply_manager']['apply_info']['order_list'] = array(  
	array( 'name' => '주말1차~4차(치주/외과/영상)' ,'type0' => 'multi'  ,'type1' => '주말' , 'type2' => '주말1차' , 'type3' => '주말4차' ),
	array( 'name' => '주말1차~3차(치주/외과/영상 외)' ,'type0' => 'multi'  ,'type1' => '주말' , 'type2' => '주말1차' , 'type3' => '주말3차' ),
	//array( 'name' => '주말1차~2차(치주/외과/영상 외)' ,'type0' => 'multi'  ,'type1' => '주말' , 'type2' => '주말1차' , 'type3' => '주말2차' ),
	array( 'name' => '주말1차'     ,'type0' => 'single' ,'type1' => '주말' , 'type2' => '주말1차' ),
	array( 'name' => '주말2차'     ,'type0' => 'single' ,'type1' => '주말' , 'type2' => '주말2차' ),
	array( 'name' => '주말3차'     ,'type0' => 'single' ,'type1' => '주말' , 'type2' => '주말3차' ),
	array( 'name' => '주말4차'     ,'type0' => 'single' ,'type1' => '주말' , 'type2' => '주말4차' ),
	array( 'name' => '주말5차'     ,'type0' => 'single' ,'type1' => '주말' , 'type2' => '주말5차' ),
	array( 'name' => '주말6차'     ,'type0' => 'single' ,'type1' => '주말' , 'type2' => '주말6차' ),
	array( 'name' => '주말7차'     ,'type0' => 'single' ,'type1' => '주말' , 'type2' => '주말7차' ),

	array( 'name' => '주중1차~4차' ,'type0' => 'multi'  ,'type1' => '주중' , 'type2' => '주중1차' , 'type3' => '주중4차'  ),
	array( 'name' => '주중1차'     ,'type0' => 'single' ,'type1' => '주중' , 'type2' => '주중1차' ),
	array( 'name' => '주중2차'     ,'type0' => 'single' ,'type1' => '주중' , 'type2' => '주중2차' ),
	array( 'name' => '주중3차'     ,'type0' => 'single' ,'type1' => '주중' , 'type2' => '주중3차' ),
	array( 'name' => '주중4차'     ,'type0' => 'single' ,'type1' => '주중' , 'type2' => '주중4차' ),
	array( 'name' => '주중5차'     ,'type0' => 'single' ,'type1' => '주중' , 'type2' => '주중5차' ),
	array( 'name' => '주중6차'     ,'type0' => 'single' ,'type1' => '주중' , 'type2' => '주중6차' ),

	array( 'name' => '주말2차~3차' ,'type0' => 'multi'  ,'type1' => '주말' , 'type2' => '주말2차' , 'type3' => '주말3차' ),
	array( 'name' => '주말2차~4차' ,'type0' => 'multi'  ,'type1' => '주말' , 'type2' => '주말2차' , 'type3' => '주말4차' ),
	array( 'name' => '주말3차~4차' ,'type0' => 'multi'  ,'type1' => '주말' , 'type2' => '주말3차' , 'type3' => '주말4차' ),
	array( 'name' => '주중2차~3차' ,'type0' => 'multi'  ,'type1' => '주중' , 'type2' => '주중2차' , 'type3' => '주중3차' ),
	array( 'name' => '주중2차~4차' ,'type0' => 'multi'  ,'type1' => '주중' , 'type2' => '주중2차' , 'type3' => '주중4차' ),
	array( 'name' => '주중3차~4차' ,'type0' => 'multi'  ,'type1' => '주중' , 'type2' => '주중3차' , 'type3' => '주중4차' )

	);

$d['khusd_st_apply_manager']['apply_info']['apply_info_list'] = array(  
	array( 'name' => '치주수술' , 'department' => 'perio' ),
	array( 'name' => 'ChIOT'    , 'department' => 'perio' ),
	array( 'name' => '임플란트' , 'department' => 'oms' ),
	array( 'name' => '판독/촬영옵져' , 'department' => 'radio' ),
	array( 'name' => '신환 F/U' , 'department' => 'ortho' ),
	array( 'name' => '보존수술' , 'department' => 'consv' ),
	array( 'name' => '교픽' , 'department' => 'pedia' ),
	array( 'name' => 'G/A' , 'department' => 'pedia' ),
	array( 'name' => 'F/U' , 'department' => 'pros' ),
	array( 'name' => '벌픽신청' , 'department' => 'pros' ),
	array( 'name' => '교픽' , 'department' => 'medi' ),
	array( 'name' => '장치제작' , 'department' => 'medi' ),
	array( 'name' => '교내구강검진' , 'department' => 'etc' ),
	array( 'name' => '직접입력'    , 'department' => 'perio' ),
	array( 'name' => '직접입력'    , 'department' => 'oms' ),
	array( 'name' => '직접입력'    , 'department' => 'radio' ),
	array( 'name' => '직접입력'    , 'department' => 'ortho' ),
	array( 'name' => '직접입력'    , 'department' => 'consv' ),
	array( 'name' => '직접입력'    , 'department' => 'pedia' ),
	array( 'name' => '직접입력'    , 'department' => 'pros' ),
	array( 'name' => '직접입력'    , 'department' => 'medi' ),
	array( 'name' => '직접입력' , 'department' => 'etc' )

	);

?>
