<?php
if(!defined('__KIMS__')) exit;

/*******
 * 현재 과 이름 정의
 * 이건 과마다 당연히 바꿔줘야.... 과에 대한 모듈이 아니면 필요 없음
 *******/


include_once $g['path_module'].'khusd_st_manager/department_core/main.php';	// 각 과별 점수관련 공통 메인함수

$g['khusd_st_follow_search'] = $g['s'].'/?r='.$r.'&m='.$m.'&amp;mode=follow&amp;nameOrId=';
$g['khusd_st_follow_drop'] = $g['s'].'/?r='.$r.'&m='.$m.'&amp;a=drop_follow&amp;uid=';
?>