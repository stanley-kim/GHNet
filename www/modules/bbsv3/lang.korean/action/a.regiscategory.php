<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$codhead = trim($codhead);
$codfoot = trim($codfoot);
$recnum  = trim($recnum);

if ($cat && !$vtype)
{
	$R = getUidData($table[$m.'category'],$cat);


	$QVAL = "hidden='$hidden',reject='$reject',name='$name',";
	$QVAL.= "recnum='$recnum',sosokmenu='$sosokmenu'";
	getDbUpdate($table[$m.'category'],$QVAL,'uid='.$cat);

	$vfile = $g['dir_module'].'var/code/'.sprintf('%05d',$cat);


	if ($subcopy == 1)
	{
		include_once $g['dir_module'].'_func.php';

		$subQue = getShopCategoryCodeToSql($table[$m.'category'],$cat,'uid');
		if ($subQue)
		{
			getDbUpdate($table[$m.'category'],"hidden='".$hidden."',reject='".$reject."',layout='".$layout."',skin='".$skin."',skin_mobile='".$skin_mobile."'","uid <> ".$cat." and (".$subQue.")");
		}
	}
}
else {

	$MAXC = getDbCnt($table['s_menu'],'max(gid)','depth='.($depth+1).' and parent='.$parent);
	$sarr = explode(',' , trim($name));
	$slen = count($sarr);
	
	if ($depth > 2) getLink('','','분류는 최대 3단계까지 등록할 수 있습니다.','');

	for ($i = 0 ; $i < $slen; $i++)
	{
		if (!$sarr[$i]) continue;

		$gid	= $MAXC+1+$i;
		$xdepth	= $depth+1;
		$xname	= trim($sarr[$i]);

		$QKEY = "gid,isson,parent,depth,hidden,reject,name,recnum,num,sosokmenu";
		$QVAL = "'$gid','0','$parent','$xdepth','$hidden','$reject','$xname','$recnum','0','$sosokmenu'";

		getDbInsert($table[$m.'category'],$QKEY,$QVAL);
	}
	
	if ($parent)
	{
		getDbUpdate($table[$m.'category'],'isson=1','uid='.$parent);
	}
	db_query("OPTIMIZE TABLE ".$table['s_menu'],$DB_CONNECT); 
}

getLink('reload','parent.','','');
?>