<?php
if(!defined('__KIMS__')) exit;

// For permission check
$d['khusd_st_manager']['isperm'] = true;

// 이게 false 면 권한이 없는 것
include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/debug.php';

// 관리자 권한이 있다면 변수에 표시
if(!permcheck('chief_of_case'))
{
	$g['main'] = $g['path_module'].'khusd_st_manager/lang.'.$_HS['lang'].'/mod/_permcheck.php';
	$d['khusd_st_manager']['isperm'] = false;
	getLink($g['s'].'/?r=home','','접근권한이 없습니다.','');
}

if(permcheck('manager'))
{
	$MANAGER = true;
}

function getMDname($id)
{
	global $typeset;
	if ($typeset[$id]) return $typeset[$id].' ('.$id.')';
	else return $id;
}

$SITES = getDbArray($table['s_site'],'','*','gid','asc',0,1);
$year1	= $year1  ? $year1  : '2001';
$month1	= $month1 ? $month1 : '01';
$day1	= $day1   ? $day1   : '01';
$year2	= $year2  ? $year2  : substr($date['today'],0,4);
$month2	= $month2 ? $month2 : substr($date['today'],4,2);
$day2	= $day2   ? $day2   : substr($date['today'],6,2);

$sort	= $sort ? $sort : 'memberuid';
$orderby= $orderby ? $orderby : 'desc';
$recnum = 200;

$accountQue = $account ? 'site='.$account.' and ':'';
//사이트선택적용
//$accountQue = $account ? 'a.site='.$account.' and ':'';
$_WHERE = $accountQue.'d_regis > '.$year1.sprintf('%02d',$month1).sprintf('%02d',$day1).'000000 and d_regis < '.$year2.sprintf('%02d',$month2).sprintf('%02d',$day2).'240000';
$_NEW_WHERE = 'd_regis > '.$year1.sprintf('%02d',$month1).sprintf('%02d',$day1).'000000 and d_regis < '.$year2.sprintf('%02d',$month2).sprintf('%02d',$day2).'240000';

//사이트선택적용
//$RCD = getDbArray($table['s_mbrdata'].' AS a left join '.$table['s_mbrid'].' AS b on memberuid=uid',$_WHERE,'a.*,b.uid,b.id,b.pw',$sort,$orderby,$recnum,$p);
//$NUM = getDbRows($table['s_mbrdata'].' AS a left join '.$table['s_mbrid'].' AS b on memberuid=uid',$_WHERE);
/*
SELECT mid.id,mbr.name,po.price,ca.price,mbr.point,mbr.cash 
FROM kd44_s_mbrdata AS mbr 
LEFT JOIN kd44_s_mbrid AS mid ON mbr.memberuid=mid.uid 
LEFT JOIN (SELECT my_mbruid, SUM(price) AS price FROM kd44_s_point WHERE d_regis > '20140920000000' AND d_regis < '20140928000000' GROUP BY my_mbruid) AS po ON mbr.memberuid=po.my_mbruid 
LEFT JOIN (SELECT my_mbruid, SUM(price) AS price FROM kd44_s_cash WHERE d_regis > '20140920000000' AND d_regis < '20140928000000' GROUP BY my_mbruid) AS ca ON mbr.memberuid=ca.my_mbruid 
WHERE 1
*/
/*
$_POINT_H = '(SELECT my_mbruid, SUM(price) AS price FROM '.$table['s_point'].' WHERE '.$_NEW_WHERE.' GROUP BY my_mbruid)';
$_POINT_S = '(SELECT my_mbruid, SUM(price) AS price FROM '.$table['s_cash'].' WHERE '.$_NEW_WHERE.' GROUP BY my_mbruid)';
$_FROM = $table['s_mbrdata'].' AS mbr'
	.' LEFT JOIN '.$table['s_mbrid'].' AS mid ON memberuid=uid'
	.' LEFT JOIN '.$_POINT_H.' AS po ON mbr.memberuid=po.my_mbruid'
	.' LEFT JOIN '.$_POINT_S.' AS ca ON mbr.memberuid=ca.my_mbruid';
$_DATA = 'mid.id, mbr.name, po.price AS po_h_date, ca.price AS po_s_date, mbr.point AS po_h_tot, mbr.cash AS po_s_tot';
*/
/*
$_POINT_H = '(select my_mbruid, sum(price) as price from '.$table['s_point'].' where '.$_NEW_WHERE.' group by my_mbruid)';
$_POINT_S = '(select my_mbruid, sum(price) as price from '.$table['s_cash'].' where '.$_NEW_WHERE.' group by my_mbruid)';
$_FROM = $table['s_mbrdata'].' as mbr'
	.' left join '.$table['s_mbrid'].' as mid on memberuid=uid'
	.' left join '.$_POINT_H.' as po on mbr.memberuid=po.my_mbruid'
	.' left join '.$_POINT_S.' as ca on mbr.memberuid=ca.my_mbruid';
$_DATA = 'mid.id, mbr.name, po.price as po_h_date, ca.price as po_s_date, mbr.point as po_h_tot, mbr.cash as po_s_tot';

__debug_print('POINT_H: '.$_POINT_H);
__debug_print('POINT_S: '.$_POINT_S);
__debug_print('FROM: '.$_FROM);
__debug_print('DATA: '.$_DATA);
__debug_print('WHERE: '.$_NEW_WHERE);
*/
$query = 'select mid.id,mbr.memberuid,mbr.name,po.price as po_h_date,ca.price as po_s_date,mbr.point as po_h_tot,mbr.cash as po_s_tot'
	.' from '.$table['s_mbrdata'].' as mbr'
	.' left join '.$table['s_mbrid'].' as mid on mbr.memberuid=mid.uid'
	.' left join (select my_mbruid, sum(price) as price from '.$table['s_point'].' where '.$_NEW_WHERE.' group by my_mbruid) as po on mbr.memberuid=po.my_mbruid' 
	.' left join (select my_mbruid, sum(price) as price from '.$table['s_cash'].' where '.$_NEW_WHERE.' group by my_mbruid) as ca on mbr.memberuid=ca.my_mbruid'
	.' where 1';
global $DB_CONNECT;
$RCD = db_query($query.' order by '.$sort.' '.$orderby.($recnum?' limit '.(($p-1)*$recnum).', '.$recnum:''),$DB_CONNECT);

//__debug_print('QUERY: '.$query);

//$RCD = getDbArray($_FROM,$_WHERE,$_DATA,$sort,$orderby,$recnum,$p);
$NUM = count($RCD);
//$RCD = getDbArray($table['s_mbrdata'].' left join '.$table['s_mbrid'].' on memberuid=uid',$_WHERE, '*',$sort,$orderby,$recnum,$p);
//$NUM = getDbRows($table['s_mbrdata'].' left join '.$table['s_mbrid'].' on memberuid=uid',$_WHERE, '*');

//$RCD = getDbArray($table['s_mbrdata'],$_NEW_WHERE,'*',$sort,$orderby,$recnum,$p);
//$NUM = getDbRows($table['s_mbrdata'],$_WHERE);
$TPG = getTotalPage($NUM,$recnum);
$autharr = array('','인증','보류','대기','탈퇴');

$xyear1	= substr($date['totime'],0,4);
$xmonth1= substr($date['totime'],4,2);
$xday1	= substr($date['totime'],6,2);
$xhour1	= substr($date['totime'],8,2);
$xmin1	= substr($date['totime'],10,2);
?>

<div id="mbrlist">
	<?php getWidget('khusd/semester_selector',array())?>	

	<div class="info">

		<div class="article">
			<?php echo number_format($NUM)?>명
		</div>
		
		<div class="category">

		</div>
		<div class="clear"></div>
	</div>
	
	<div class="sbox">
		<form name="procForm" action="<?php echo $g['s']?>/" method="get">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="module" value="<?php echo $module?>" />
		<input type="hidden" name="front" value="<?php echo $front?>" />
		<input type="hidden" name="type" value="<?php echo $type?>" />

		<div>
		<select name="year1">
		<?php for($i=$date['year'];$i>2000;$i--):?><option value="<?php echo $i?>"<?php if($year1==$i):?> selected="selected"<?php endif?>><?php echo $i?>년</option><?php endfor?>
		</select>
		<select name="month1">
		<?php for($i=1;$i<13;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($month1==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>월</option><?php endfor?>
		</select>
		<select name="day1">
		<?php for($i=1;$i<32;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($day1==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>일(<?php echo getWeekday(date('w',mktime(0,0,0,$month1,$i,$year1)))?>)</option><?php endfor?>
		</select> ~
		<select name="year2">
		<?php for($i=$date['year'];$i>2000;$i--):?><option value="<?php echo $i?>"<?php if($year2==$i):?> selected="selected"<?php endif?>><?php echo $i?>년</option><?php endfor?>
		</select>
		<select name="month2">
		<?php for($i=1;$i<13;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($month2==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>월</option><?php endfor?>
		</select>
		<select name="day2">
		<?php for($i=1;$i<32;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($day2==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>일(<?php echo getWeekday(date('w',mktime(0,0,0,$month2,$i,$year2)))?>)</option><?php endfor?>
		</select>

		<input type="button" class="btngray" value="기간적용" onclick="this.form.submit();" />
		<input type="button" class="btngray" value="어제" onclick="dropDate('<?php echo date('Ymd',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-1,substr($date['today'],0,4)))?>','<?php echo date('Ymd',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-1,substr($date['today'],0,4)))?>');" />
		<input type="button" class="btngray" value="오늘" onclick="dropDate('<?php echo $date['today']?>','<?php echo $date['today']?>');" />
		<input type="button" class="btngray" value="일주" onclick="dropDate('<?php echo date('Ymd',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-7,substr($date['today'],0,4)))?>','<?php echo $date['today']?>');" />
		<input type="button" class="btngray" value="한달" onclick="dropDate('<?php echo date('Ymd',mktime(0,0,0,substr($date['today'],4,2)-1,substr($date['today'],6,2),substr($date['today'],0,4)))?>','<?php echo $date['today']?>');" />
		<input type="button" class="btngray" value="당월" onclick="dropDate('<?php echo substr($date['today'],0,6)?>01','<?php echo $date['today']?>');" />
		<input type="button" class="btngray" value="전월" onclick="dropDate('<?php echo date('Ym',mktime(0,0,0,substr($date['today'],4,2)-1,substr($date['today'],6,2),substr($date['today'],0,4)))?>01','<?php echo date('Ym',mktime(0,0,0,substr($date['today'],4,2)-1,substr($date['today'],6,2),substr($date['today'],0,4)))?>31');" />
		<input type="button" class="btngray" value="전체" onclick="dropDate('20090101','<?php echo $date['today']?>');" />
		</div>
		
		</form>
	</div>
	

	<form name="listForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	<input type="hidden" name="a" value="update_point" />
	<input type="hidden" name="act" value="" />
	<input type="hidden" name="_WHERE" value="<?php echo $_WHERE?>" />
	<input type="hidden" name="_num" value="<?php echo $NUM?>" />

	<table summary="회원리스트 입니다.">
	<caption>회원리스트</caption> 
	<colgroup> 
	<col width="30">  <!--check box-->
	<col width="130"> <!--학번-->
	<col width="70">  <!--이름-->
	<col width="100">  <!--기간내 총 상벌점(H)-->
	<col width="100">  <!--기간내 총 상벌점(S)-->
	<col width="70">  <!--총 상벌점(H)-->
	<col width="70">  <!--총 상벌점(S)-->
	<col>
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="side1"><img src="<?php echo $g['img_core']?>/_public/ico_check_01.gif" alt="선택/반전" class="hand" onclick="chkFlag('mbrmembers[]');" /></th>
	<th scope="col">학번</th>
	<th scope="col">이름</th>
	<th scope="col">기간내 상벌점(H)</th>
	<th scope="col">기간내 상벌점(S)</th>
	<th scope="col">상벌점(H)</th>
	<th scope="col">상벌점(S)</th>
	<th scope="col" class="side2"></th>
	</tr>
	</thead>
	<tbody>
	<?php while($R=db_fetch_array($RCD)):?>
	<?php //$_R=getUidData($table['s_mbrid'],$R['memberuid'])?>
	<tr>
	<td class="side1"><input type="checkbox" name="mbrmembers[]" value="<?php echo $R['memberuid']?>" /></td>
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=info&mbruid=<?php echo $R['memberuid']?>');" title="회원정보"><?php echo $R['id']?></a></td>	
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=main&mbruid=<?php echo $R['memberuid']?>');" title="회원메니져"><?php echo $R['name']?></a></td>
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=point&mbruid=<?php echo $R['memberuid']?>');" title="상벌점(H)내역"><?php echo number_format($R['po_h_date'])?></a></td>
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=point&type=cash&mbruid=<?php echo $R['memberuid']?>');" title="상벌점(S)내역"><?php echo number_format($R['po_s_date'])?></a></td>
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=point&mbruid=<?php echo $R['memberuid']?>');" title="상벌점(H)내역"><?php echo number_format($R['po_h_tot'])?></a></td>
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=point&type=cash&mbruid=<?php echo $R['memberuid']?>');" title="상벌점(S)내역"><?php echo number_format($R['po_s_tot'])?></a></td>
	<td></td>
	</tr>
	<?php endwhile?>
	</tbody>
	</table>

	<div class="prebox">
		<div id="span_member_give" class="xt1">

		<select name="pointType">
		<option value="point">상벌점(H)</option>
		<option value="cash">상벌점(S)</option>
		</select>		
		<select name="how" class="sm">
		<option value="+">+</option>
		<option value="-">-</option>
		</select>
		<input type="text" name="price" size="5" class="input" />P | 지급사유 : 
		<input type="text" name="comment" size="60" class="input" />
		<input type="button" class="btnblue" value="부여" onclick="actQue('give_point');" />

		</div>
	</div>
	</form>
</div>


<script type="text/javascript">
//<![CDATA[
function ToolCheck(compo)
{
	frames.editFrame.showCompo();
	frames.editFrame.EditBox(compo);
}
function maildocLoad(obj)
{
	if (obj.value)
	{
		frames._action_frame_<?php echo $m?>.location.href = "<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $module?>&a=maildoc_load&type=" + obj.value;
		obj.value = '';
		obj.form.subject.focus();
	}
}
function dropDate(date1,date2)
{
	var f = document.procForm;
	f.year1.value = date1.substring(0,4);
	f.month1.value = date1.substring(4,6);
	f.day1.value = date1.substring(6,8);
	
	f.year2.value = date2.substring(0,4);
	f.month2.value = date2.substring(4,6);
	f.day2.value = date2.substring(6,8);

	f.submit();
}
var submitFlag = false;
function actQue(flag)
{
	if (submitFlag == true)
	{
		alert('요청하신 작업을 실행중에 있습니다. 완료될때까지 기다려 주세요.  ');
		return false;
	}

	var f = document.listForm;
	var l = document.getElementsByName('mbrmembers[]');
	var n = l.length;
	var i;
	var j=0;
	var s='';

	for	(i = 0; i < n; i++)
	{
		if (l[i].checked == true)
		{
			j++;
			s += l[i].value +',';
		}
	}
	if (j==0)
	{
		alert('회원을 선택해 주세요.     ');
		return false;
	}
	
	//상벌점(H)지급
	if (flag == 'give_point')
	{
		if (f.price.value == '')
		{
			alert('지급할 상벌점을 입력해 주세요.   ');
			f.price.focus();
			return false;
		}
		if (f.comment.value == '')
		{
			alert('지급사유를 입력해 주세요.   ');
			f.comment.focus();
			return false;
		}
	}

	if (confirm('정말로 실행하시겠습니까?        '))
	{
		submitFlag = true;
		//f.a.value = 'update_point';
		f.act.value = flag;
		f.submit();
	}
	else 
	{
		return false;
	}
}
//]]>
</script>
