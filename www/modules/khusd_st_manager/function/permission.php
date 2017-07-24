<?php

include_once $g['path_module'].'khusd_st_manager/var/var.php'; 
include_once $g['path_module'].'khusd_st_manager/function/debug.php'; 

/*
	학생인지, 혹은 특정 과의 관리 권한이 있는지 체크하는 함수
	총대, 관리자는 모든 권한이 있으며, 
	총대단은... 고민중이고
	각 과의 연락담당은 각 과에 대한 권한이 있다. 
 */
function permcheck($need = 'st', $id = null)
{
	global $my, $table, $d, $dept_array;
	if(!$id)	$id = $my['id'];	// 사용자가 지정 안되었으면 현재 로그인되어 있는 사용자에 대해 수행
		
	// 해당 사용자에 대한 정보를 가져온다. 
	$uinfo = getDbData($table['s_mbrid'],"id='".$id."'",'*');
	if(!$uinfo || !$uinfo['uid'])	return false;	// 회원정보가 없으면 실패로... 최하 권한체크가 학생이기 때문에 비로그인은 없음
	$uinfo = array_merge($uinfo, getDbData($table['s_mbrdata'],"memberuid='".$uinfo['uid']."'",'*'));

	//protect this codes
        if($need == 'duplication_checker')
        {
                if( $uinfo['admin'] ||
 		$uinfo['level'] == $d['khusd_st_manager']['manager_level']['chief_of_case']  )
                	return true;
		else	
			return false;
        }

	
	// 관리자이거나 총대 인가? 프리패스
	// 프리패스 권한은, 총케장과 총대에게~
	if($uinfo['admin'] 
		|| $uinfo['level'] == $d['khusd_st_manager']['manager_level']['repres']
		|| $uinfo['level'] == $d['khusd_st_manager']['manager_level']['chief_of_case']
		|| $uinfo['level'] == $d['khusd_st_manager']['manager_level']['admin']
	)
	{
		return true;
	}
	
	// 자기 등급에 해당하는 권한인 경우 통과
	if($uinfo['level'] == $d['khusd_st_manager']['manager_level'][$need])
		return true;
	
	// 필요로 하는 권한에 따라 체크
	
	// 원내생
	if($need == 'st')
	{
		if($uinfo['level'] >= $d['khusd_st_manager']['manager_level']['st'])
			return true;
	}
	
	// 총대단
	// 총대단+총케이스장+총대
	elseif($need == 'manager')
	{
		if($uinfo['level'] >= $d['khusd_st_manager']['manager_level']['deleg'])
			return true;
	}
	
	// 각 과에 대한 권한
	// 과별 연락담당+총대단+총케이스장+총대
	elseif($dept_array[$need]['id'] == $need)
	{
		// 각 과에 대한 관리자 권한
		if($uinfo['level'] >= $d['khusd_st_manager']['manager_level']['deleg'])
			return true;
	}

	
	// 총케이스장
	// 총케이스장+총대
	// 
	// 인데.. 코드가 과별 연락담당으로 짜져있어서 우선 주석처리 후 지켜보기...
	elseif($need == 'chief_of_case')
	{
		/*
		print_r("This Code need to check. func/perm.php");
		exit;
		// 과별 연락담당 이상의 권한
		foreach($dept_array as $dept)
		{
			if(permcheck($dept['id']))
				return true;
		}
		*/
	}
	elseif($need == 'over_chief_of_case'){
		if($uinfo['level'] >= $d['khusd_st_manager']['manager_level']['chief_of_case'])
			return true;
	}
	elseif($need == 'etc'){
		if($uinfo['level'] >= $d['khusd_st_manager']['manager_level']['deleg'])
			return true;
	}
	
	
	return false;
}

?>
