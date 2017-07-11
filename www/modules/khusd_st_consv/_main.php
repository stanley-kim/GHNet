<?php
if(!defined('__KIMS__')) exit;

include_once $g['path_module'].'khusd_st_manager/function/score.php';	// 점수 관련에서 공통으로 이용하는 함수들

function calculateMinusScore($score, $field_name)
{
	global $d;
	
	$_require = $d['khusd_st_consv']['require']['obser'];
	$_minus = $d['khusd_st_consv']['minus']['obser'];
	
	if($score < $_require[$field_name])	return ($_require[$field_name] - $score) * $_minus[$field_name];
	return 0;
}

function genMinusScoreQuery($field, $require, $score)
{
	return 'IF('.$field.' < '.$require.',('.$require.' - ('.$field.')) * '.$score.',0)';
}

?>