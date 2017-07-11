<?php
if(!defined('__KIMS__')) exit;

/*******
 * 현재 과 이름 정의
 * 이건 과마다 당연히 바꿔줘야.... 과에 대한 모듈이 아니면 필요 없음
 *******/
$DEPARTMENT = 'perio';

include_once $g['path_module'].'khusd_st_cnslt_room_manager/var/var.define.php';	// ST 신청용 변수 파일

include_once $g['path_module'].'khusd_st_manager/department_core/main.php';	// 각 과별 점수관련 공통 메인함수

$g['khusd_st_'.$DEPARTMENT.'_st_list'] =  $g['khusd_st_'.$DEPARTMENT.'_list'].'&amp;mode=st_list&amp;st_date=';
$g['khusd_st_'.$DEPARTMENT.'_st_schedule'] =  $g['khusd_st_'.$DEPARTMENT.'_list'].'&amp;mode=st_schedule&amp;st_date=';

$g['khusd_st_'.$DEPARTMENT.'_surgery'] =  $g['s'].'/?r='.$r.'&m='.$m.'&mode=surgery';

?>