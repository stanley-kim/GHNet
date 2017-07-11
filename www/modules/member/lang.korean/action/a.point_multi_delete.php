<?php
if(!defined('__KIMS__')) exit;

//checkAdmin(0); // original code
// The following is the modified one
if (!$my['admin'] && $my['level'] < 14)
{
	getLink('','','상벌점 삭제 권한이 없습니다.','');
}

$pointType = $pointType ? $pointType : 'point';
foreach($point_members as $val)
{
	$P = getUidData($table['s_'.$pointType],$val);
	if (!$P['uid']) continue;

	getDbDelete($table['s_'.$pointType],'uid='.$P['uid']);
	//getDbUpdate($table['s_mbrdata'],$pointType.'='.$pointType.'-'.$P['price'],'memberuid='.$P['my_mbruid']);
}

getLink('reload','parent.','','');
?>