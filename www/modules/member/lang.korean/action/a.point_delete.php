<?php
if(!defined('__KIMS__')) exit;

//include_once $g['path_module'].'khusd_st_manager/function/debug.php';

if (!$my['uid'])
{
	getLink('','','정상적인 접근이 아닙니다.','');
}

$pointType = $pointType ? $pointType : 'point';
//if ($my['admin']) originally this part is "Admin only"
if ($my['admin'] || $my['level'] >= 14) // For members that are level 14 or higher can have 'delete' authority
{
	//__debug_print("Above Level 14, member search");
	foreach($members as $val)
	{
		$P = getUidData($table['s_'.$pointType],$val);
		if (!$P['uid']) continue;
		
		getDbDelete($table['s_'.$pointType],'uid='.$P['uid']);
		getDbUpdate($table['s_mbrdata'],$pointType.'='.$pointType.'-'.$P['price'],'memberuid='.$P['my_mbruid']);
	}
}
else {
	//__debug_print("Value check");
	foreach($members as $val)
	{
		$P = getUidData($table['s_'.$pointType],$val);
		if (!$P['uid'] || $my['uid'] != $P['my_mbruid']) continue;

		getDbDelete($table['s_'.$pointType],'uid='.$R['uid'].' and my_mbruid='.$my['uid']);
		getDbUpdate($table['s_mbrdata'],$pointType.'='.$pointType.'-'.$P['price'],'memberuid='.$my['uid']);
	}
}

getLink('reload','parent.','','');
?>