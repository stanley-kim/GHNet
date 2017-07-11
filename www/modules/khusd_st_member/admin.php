<?php
if(!defined('__KIMS__')) exit;

include_once $g['path_module'].'khusd_st_manager/function/member.php'; 

// 학기 그룹 목록 받아오기
// admin/config.php 에서 사용
$SEMESTERS_ARRAY = getSemesterGroupArray();

if ($g['mobile']&&$_SESSION['pcmode']!='Y')
{
	include_once $g['path_module'].$module.'/lang.'.$_HS['lang'].'/admin/_mobile/'.$front.'.php';
}
else {
	include_once $g['path_module'].$module.'/lang.'.$_HS['lang'].'/admin/_pc/'.$front.'.php';
}
?>