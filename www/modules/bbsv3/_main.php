<?php
//매장출력
function getShopCategoryShow($table,$j,$parent,$depth,$uid,$CXA,$hidden)
{
	global $path,$cat,$g;
	global $MenuOpen,$numhidden,$checkbox,$headfoot;
	static $j;

	$CD=getDbSelect($table,'depth='.($depth+1).' and parent='.$parent.($hidden ? ' and hidden=0':'').' order by gid asc','*');
	while($C=db_fetch_array($CD))
	{
		$j++;
		if(@in_array($C['uid'],$CXA)) $MenuOpen .= 'trees[0].tmB('.$j.');';
		$numprintx = !$numhidden && $C['num'] ? '&lt;span class="num"&gt;('.$C['num'].')&lt;/span&gt;' : '';
		$C['name'] = $headfoot && ($C['imghead']||$C['imgfoot']||$C['codhead']||$C['codfoot']) ? '&lt;b&gt;'.$C['name'].'&lt;b&gt;' : $C['name'];
		$name = $C['uid'] != $cat ? addslashes($C['name']): '&lt;span class="on"&gt;'.addslashes($C['name']).'&lt;/span&gt;';
		$name = '&lt;span class="ticon tdepth'.$C['depth'].'"&gt;&lt;/span&gt;&lt;span class="name ndepth'.$C['depth'].'"&gt;'.$name.'&lt;/span&gt;';

		if($checkbox) $icon1 = '&lt;input type="checkbox" name="members[]" value="'.$C['uid'].'" /&gt;';
		$icon2 = $C['hidden'] ? ' &lt;img src="'.$g['img_core'].'/_public/ico_hidden.gif" class="hidden" alt="숨김상태" /&gt;' : '';

		if ($C['isson'])
		{
			echo "['".$icon1.$name.$icon2.$numprintx."','".$C['uid']."',";
			getShopCategoryShow($table,$j,$C['uid'],$C['depth'],$uid,$CXA,$hidden);
			echo "],\n";
		}
		else {
			echo "['".$icon1.$name.$icon2.$numprintx."','".$C['uid']."',''],\n";
		}
	}
}
//매장코드->경로
function getShopCategoryCodeToPath($table,$cat,$j)
{
	global $DB_CONNECT;
	static $arr;

	$R=getUidData($table,$cat);
	if($R['parent'])
	{
		$arr[$j]['uid'] = $R['uid'];
		$arr[$j]['id'] = $R['id'];
		$arr[$j]['name']= $R['name'];
		getShopCategoryCodeToPath($table,$R['parent'],$j+1);
	}
	else {
		$C=getUidData($table,$cat);
		$arr[$j]['uid'] = $C['uid'];
		$arr[$j]['id'] = $C['id'];
		$arr[$j]['name']= $C['name'];
	}
	sort($arr);
	reset($arr);
	return $arr;
}
//매장코드->SQL
function getShopCategoryCodeToSql($table,$cat)
{
	$R=getUidData($table,$cat);
	if ($R['uid']) $sql .= 'category='.$R['uid'].' or ';
	if ($R['isson'])
	{
		$RDATA=getDbSelect($table,'parent='.$R['uid'],'uid,isson');
		while($C=db_fetch_array($RDATA)) $sql .= getShopCategoryCodeToSqlX($table,$C['uid'],$C['isson']);
	}
	return substr($sql,0,strlen($sql)-4);
}
//매장코드->SQL
function getShopCategoryCodeToSqlX($table,$cat,$isson)
{
	$sql = 'category='.$cat.' or ';
	if ($isson)
	{
		$RDATA=getDbSelect($table,'parent='.$cat,'uid,isson');
		while($C=db_fetch_array($RDATA)) $sql .= getShopCategoryCodeToSqlX($table,$C['uid'],$C['isson']);
	}
	return $sql;
}
//카테고리출력
function getCategoryShowSelect($table,$j,$parent,$depth,$uid,$hidden)
{
	global $cat;
	static $j;

	$CD=getDbSelect($table,'depth='.($depth+1).' and parent='.$parent.($hidden ? ' and hidden=0':'').' order by gid asc','*');
	while($C=db_fetch_array($CD))
	{
		$j++;
		echo '<option class="selectcat'.$C['depth'].'" value="'.$C['uid'].'"'.($C['uid']==$cat?' selected="selected"':'').'>';
		if(!$depth) echo 'ㆍ';
		for($i=1;$i<$C['depth'];$i++) echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		if ($C['depth'] > 1) echo 'ㄴ';
		echo $C['name'].'</option>';
		if ($C['isson']) getCategoryShowSelect($table,$j,$C['uid'],$C['depth'],$uid,$hidden);
	}
}

?>