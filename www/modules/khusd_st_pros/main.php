<?php
if(!defined('__KIMS__')) exit;

/*******
 * 현재 과 이름 정의
 * 이건 과마다 당연히 바꿔줘야.... 과에 대한 모듈이 아니면 필요 없음
 *******/
$DEPARTMENT = 'pros';

include_once $g['path_module'].'khusd_st_manager/department_core/main.php';	// 각 과별 점수관련 공통 메인함수

include_once $g['path_module'].'khusd_st_cnslt_room_manager/var/var.define.php';	// 각 과별 진료 단계 등 관련 변수 이용을 위해
$tx_plan_array = $d['khusd_st_cnslt_room_manager']['tx_plan']['pros'];
$inst_array = $d['khusd_st_cnslt_room_manager']['pros']['inst']['list'];

$g['khusd_st_pros_search_follow'] = $g['s'].'/?r='.$r.'&m='.$m.'&amp;mode=follow&amp;nameOrId=';
$g['khusd_st_pros_drop_follow'] = $g['s'].'/?r='.$r.'&m='.$m.'&amp;a=drop_follow&amp;uid=';
$g['khusd_st_pros_change_follow'] = $g['s'].'/?r='.$r.'&m='.$m.'&a=change_follow&uid=';
$g['khusd_st_pros_new_change_follow'] = $g['s'].'/?r='.$r.'&m='.$m.'&a=new_change_follow&uid=';
$g['khusd_st_pros_follow_comment'] = $g['s'].'/?r='.$r.'&m='.$m.'&a=follow_comment&uid=';

//khusd_st_pros_obser_score
$g['khusd_st_pros_obser_score'] = $g['s'].'/?r='.$r.'&m='.$m.'&a=obser_update';

?>