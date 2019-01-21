<?php

include_once $g['path_module'].'khusd_st_manager/var/var.php'; 
include_once $g['path_module'].'khusd_st_manager/function/debug.php'; 

function getSTInfo($st_id)
{
	global $table;
	

	$ST_INFO = getDbData(
		$table['s_mbrid'].' mbrid,'.$table['s_mbrdata'].' mbrdata'
		,

		"mbrid.uid = mbrdata.memberuid"
		." AND mbrid.id = '".$st_id."'"
		, 

		'*'
	);

	return $ST_INFO;
}

function getSTInfoByName($st_name)
{
	global $table;
	

	$ST_INFO = getDbData(
		$table['s_mbrid'].' mbrid,'.$table['s_mbrdata'].' mbrdata'
		,

		"mbrid.uid = mbrdata.memberuid"
		." AND mbrdata.name = '".$st_name."'"
		, 

		'*'
	);

	return $ST_INFO["id"];
}

function getSemesterGroupArray($only_my_semester = false, $st_id = false)
{
	global $table, $my;
	
	$_table = $table['khusd_st_manager'.'semester'].' s';
	$_where = "1";
	$_data = 's.*';
	$_sort = 's.uid'; 
	$_orderby = 'DESC';
	
	if($st_id === false)
	{
		if(!$my || !$my['id'])
			return array();
			
		$st_id = $my['id'];
	}

	if($only_my_semester)
	{
		$_table .= ', '.$table['khusd_st_manager'.'s_mbr'].' mbr';
		$_where = "s.uid = mbr.s_uid AND mbr.st_id = '".$st_id."'";
	}

	$SEMESTERS_ARRAY = array();
	$SEMESTERS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);

	while( $_S = db_fetch_array($SEMESTERS) )
	{
		$SEMESTERS_ARRAY[] = $_S;
	}

	return $SEMESTERS_ARRAY;
}

function isSemesterMember($st_id = false)
{
	global $my;
	
	if($st_id === false)
	{
		if(!$my || !$my['id'])
			return array();
			
		$st_id = $my['id'];
	}
	
	$_table = $table['khusd_st_manager'.'semester'].' s';
	$_where = "1";
	$_data = 's.*';
	$_sort = 's.uid'; 
	$_orderby = 'DESC';

	if($only_my_semester)
	{
		$_table .= ', '.$table['khusd_st_manager'.'s_mbr'].' mbr';
		$_where = "s.uid = mbr.s_uid AND mbr.st_id = '".$st_id."'";
	}

	$SEMESTERS_ARRAY = array();
	$SEMESTERS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, 0, 0);
}

// TODO 임시 구현
// s_uid 전역변수를 체크하기보다... 다른 방식을...
function getCurrentSemesterInfo()
{
	global $s_uid, $my, $table, $_SESSION;

	if($_SESSION['khusd_s_uid'])
	{
		$s_uid = $_SESSION['khusd_s_uid'];
	}
	else
	{
		$s_uid = isset($s_uid) ? $s_uid : 1;
	}
	// HARD CODED
	$s_uid = 4;
	
	$SEMESTER_INFO = getSemesterInfo($s_uid);
		
	return $SEMESTER_INFO;
}

function getSemesterInfo($s_uid)
{
	global $table;

	$_table = $table['khusd_st_manager'.'semester'];

	$SEMESTER_INFO = getUidData($_table, $s_uid);
	
	return $SEMESTER_INFO;
}
?>
