<?php
if(!defined('__KIMS__')) exit;

// For permission check
$d['khusd_st_manager']['isperm'] = true;

// 이게 false 면 권한이 없는 것
include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/permission.php';	// 필수 인클루드 파일
include_once $g['path_module'].'khusd_st_manager/function/debug.php';

// 관리자 권한이 있다면 변수에 표시
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

$sort	= $sort ? $sort : 'st_id';
$orderby= $orderby ? $orderby : 'asc';
$recnum = 200;

$_WHERE = 'app.st_date >= '.$year1.sprintf('%02d',$month1).sprintf('%02d',$day1).' and app.st_date <= '.$year2.sprintf('%02d',$month2).sprintf('%02d',$day2);
/*
$query = 'select dis.st_id, mbr.name, SUM(if(water_tube = 1, 1, 0)) as wt_am, SUM(if(water_tube = 2, 1, 0)) as wt_bp, SUM(if(surface = 1, 1, 0)) as sf_am, SUM(if(surface = 2, 1, 0)) as sf_bp, SUM(if(water_tube = 0, 0, 1)) as wt_tot, SUM(if(surface = 0, 0, 1)) as sf_tot'
	.' from '.$table[$m.'disinfection'].' as dis'
	.' left join '.$table['s_mbrid'].' as mid on mid.id = dis.st_id'
	.' left join '.$table['s_mbrdata'].' as mbr on mbr.memberuid = mid.uid'
	.', '.$table[$m.'apply'].' as app'
	.' where dis.apply_uid=app.uid and '.$_WHERE
	.' group by dis.st_id';
*/
$query = 'select app.st_id, mbr.name, COUNT(*) AS num'
	.' from '.$table[$m.'apply'].' as app'
	.' left join '.$table['s_mbrid'].' as mid on mid.id = app.st_id'
	.' left join '.$table['s_mbrdata'].' as mbr on mbr.memberuid = mid.uid'
	." where app.status!='c' AND ".$_WHERE
	.' group by app.st_id';
// SIMPLE VERSION
global $DB_CONNECT;
$DIS = db_query($query.' order by '.$sort.' '.$orderby.($recnum?' limit '.(($p-1)*$recnum).', '.$recnum:''),$DB_CONNECT);

__debug_print('QUERY: '.$query);

//$RCD = getDbArray($_FROM,$_WHERE,$_DATA,$sort,$orderby,$recnum,$p);
$NUM = count($DIS);
//$RCD = getDbArray($table['s_mbrdata'].' left join '.$table['s_mbrid'].' on memberuid=uid',$_WHERE, '*',$sort,$orderby,$recnum,$p);
//$NUM = getDbRows($table['s_mbrdata'].' left join '.$table['s_mbrid'].' on memberuid=uid',$_WHERE, '*');

//$RCD = getDbArray($table['s_mbrdata'],$_NEW_WHERE,'*',$sort,$orderby,$recnum,$p);
//$NUM = getDbRows($table['s_mbrdata'],$_WHERE);
$TPG = getTotalPage($NUM,$recnum);

$xyear1	= substr($date['totime'],0,4);
$xmonth1= substr($date['totime'],4,2);
$xday1	= substr($date['totime'],6,2);
$xhour1	= substr($date['totime'],8,2);
$xmin1	= substr($date['totime'],10,2);
?>

<div id="mbrlist">
	<?php getWidget('khusd/semester_selector',array())?>	

	<div class="info">
		
		<div class="category">
			<?php if($iframe != 'y' && $iframe != 'Y'):?>
			<a href="<?php echo $g['khusd_st_cnslt_room_manager_disinfection']."iframe=Y&amp;year1=$year1&amp;month1=$month1&amp;day1=$day1&amp;year2=$year2&amp;month2=$month2&amp;day2=$day2&amp;sort=$sort&amp;orderby=$orderby"?>" target="_blank">프린트</a>
			<?php endif?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="sbox">
		<form name="procForm" action="<?php echo $g['s']?>/" method="get">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="module" value="<?php echo $module?>" />
		<input type="hidden" name="mode" value="disinfection" />

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
	
	<table summary="수관/표면소독 리스트 입니다.">
	<caption>회원리스트</caption> 
	<colgroup> 
	<col width="130"> <!--학번-->
	<col width="70">  <!--이름-->
	<col width="70">  <!--기간내 수관 물빼기 오전-->
	<col width="70">  <!--기간내 수관 물빼기 환자간-->
	<col width="70">  <!--기간내 표면 소독 오전-->
	<col width="70">  <!--기간내 표면 소독 환자간-->
	<col width="70">  <!--기간내 수관 물빼기 전체-->
	<col width="70">  <!--기간내 표면 소독 전체-->
	</colgroup> 
	<thead>
	<tr>
	<th scope="col">학번</th>
	<th scope="col">이름</th>
	<th scope="col">기간내 수관 물빼기 오전</th>
	<th scope="col">기간내 수관 물빼기 환자간</th>
	<th scope="col">기간내 표면 소독 오전</th>
	<th scope="col">기간내 표면 소독 환자간</th>
	<th scope="col">기간내 수관 물빼기 전체</th>
	<th scope="col">기간내 표면 소독 전체</th>
	</tr>
	</thead>
	<tbody>
	<?php while($R=db_fetch_array($DIS)):?>
	<?php //$_R=getUidData($table['s_mbrid'],$R['memberuid'])?>
	<tr>
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=info&mbruid=<?php echo $R['st_id']?>');" title="회원아이디"><?php echo $R['st_id']?></a></td>	
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=main&mbruid=<?php echo $R['name']?>');" title="회원이름"><?php echo $R['name']?></a></td>
	<!--<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=point&mbruid=<?php echo $R['wt_am']?>');" title="수관 물빼기 오전"><?php echo number_format($R['wt_am'])?></a></td>
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=point&type=cash&mbruid=<?php echo $R['wt_bp']?>');" title="수관 물빼기 환자간"><?php echo number_format($R['wt_bp'])?></a></td>
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=point&mbruid=<?php echo $R['sf_am']?>');" title="표면 소독 오전"><?php echo number_format($R['sf_am'])?></a></td>
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=point&type=cash&mbruid=<?php echo $R['sf_bp']?>');" title="표면 소독 환자간"><?php echo number_format($R['sf_bp'])?></a></td>
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=point&mbruid=<?php echo $R['wt_tot']?>');" title="총 수관 물빼기"><?php echo number_format($R['wt_tot'])?></a></td>-->
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=point&mbruid=<?php echo $R['wt_am']?>');" title="수관 물빼기 오전">0</a></td>
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=point&type=cash&mbruid=<?php echo $R['wt_bp']?>');" title="수관 물빼기 환자간"><?php echo number_format($R['num'])?></a></td>
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=point&mbruid=<?php echo $R['sf_am']?>');" title="표면 소독 오전">0</a></td>
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=point&type=cash&mbruid=<?php echo $R['sf_bp']?>');" title="표면 소독 환자간"><?php echo number_format($R['num'])?></a></td>
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=point&mbruid=<?php echo $R['wt_tot']?>');" title="총 수관 물빼기"><?php echo number_format($R['num'])?></a></td>
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=point&type=cash&mbruid=<?php echo $R['sf_tot']?>');" title="총 표면 소독"><?php echo number_format($R['num'])?></a></td>
	</tr>
	<?php endwhile?>
	</tbody>
	</table>
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

</script>
