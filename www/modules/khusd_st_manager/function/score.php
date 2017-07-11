<?php
if(!defined('__KIMS__')) exit;

include_once $g['path_module'].'khusd_st_manager/function/date.php';

function getSortingLink($menu_code, $order, $current_om)
{
	global $s_uid;
	
	$om = ($current_om == 'd') ? 'a' : 'd';
	$rt_val = $g['s'].'/?c='.$menu_code.'&amp;mode=list&amp;order='.$order.'&amp;om='.$om.'&amp;s_uid='.$s_uid;
	return $rt_val;
}

function getSortingLink2($list_link, $order, $current_om, $reverse_order = true)
{
	// s_uid 를 여기서 반영하는건... 꽁수고...
	// 각 과목별 main.php 에서 list 의 링크를 저장하는 변수에 반영되는게 맞는듯... 귀찮아서..
	global $s_uid;

	if($reverse_order)
		$om = ($current_om == 'd') ? 'a' : 'd';
	else
		$om = $current_om;
		
	$rt_val = $list_link.'&amp;order='.$order.'&amp;om='.$om.'&amp;s_uid='.$s_uid;

	return $rt_val;
}

/*
function getOurRequireSql($department, $due_date, $table_alias = false)
{
	global $d;
	
	$our_require = $d['khusd_st_manager']['our_require'][$department][$due_date];
	
	if(!$our_require || is_array($our_require) == false || count($our_require) == 0)
	{
		return false;
	}
	
	$sql_state = '';
	foreach($our_require as $col => $req)
	{
		
	}

	return '';
}
*/
?>