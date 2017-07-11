<?php
//include_once $g['path_module'].'khusd_st_manager/function/debug.php';

$type	= $type ? $type : 'hospital';
$sort	= $sort ? $sort : 'uid';
$orderby= $orderby ? $orderby : 'desc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 15;

//__debug('POINT!!');

//$sqlque = 'my_mbruid='.$M['memberuid'];
$sqlque = 'my_mbruid='.$mbruid;
if ($point == '1') $sqlque .= ' and point > 0';
if ($point == '2') $sqlque .= ' and point < 0';
if ($where && $keyword)
{
	$sqlque .= getSearchSql($where,$keyword,$ikeyword,'or');
}

//__debug('SQL: '.$sqlque);

$RCD = getDbArray($table[$m.'point_'.$type],$sqlque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table[$m.'point_'.$type],$sqlque);
$TPG = getTotalPage($NUM,$recnum);

$MBR_INFO = getDbData($table['s_mbrdata'],'memberuid='.$mbruid,'*');

?>
<div class="point_list">
<div class="xl">
	<h2>
	<?php echo $MBR_INFO['name'].'님';?>
	</h2>
</div>

<div id="pointlist">

	<div class="info">

		<div class="article">

			<span class="tx">
			<a class="<?php if($type=='hospital'):?>b <?php endif?>hand" onclick="document.hideForm.type.value='hospital';document.hideForm.submit();">상벌점(H)</a> |
			<a class="<?php if($type=='school'):?>b <?php endif?>hand" onclick="document.hideForm.type.value='school';document.hideForm.submit();">상벌점(S)</a> |
			</span>

			<?php echo number_format($M[$type])?> (<?php echo $p?>/<?php echo $TPG?>페이지)
		</div>
		<div class="category">
			
			<form name="giveForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return giveCheck(this);">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="m" value="<?php echo $m?>" />
			<input type="hidden" name="a" value="admin_action" />
			<input type="hidden" name="act" value="give_point" />
			<input type="checkbox" name="mbrmembers[]" value="<?php echo $M['memberuid']?>" checked="checked" class="hide" />
			<input type="hidden" name="pointType" value="<?php echo $type?>" />

			<select name="how" class="sm">
			<option value="+">+</option>
			<option value="-">-</option>
			</select>
			<input type="text" name="point" size="5" class="input" /><?php echo 'P'?> | 지급사유 : 
			<input type="text" name="comment" size="35" class="input" />
			<input type="submit" class="btngray" value="부여" />
			</form>

		</div>
		<div class="clear"></div>
	</div>

	<form name="hideForm" action="<?php echo $g['s']?>/" method="get">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
	<input type="hidden" name="mode" value="<?php echo $mode?>" />
	<input type="hidden" name="mbruid" value="<?php echo $mbruid?>" />
	<input type="hidden" name="point" value="<?php echo $point?>" />
	</form>

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return submitCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	<input type="hidden" name="mode" value="<?php echo $mode?>" />
	<input type="hidden" name="a" value="" />

	<table summary="상벌점(H) 리스트입니다.">
	<caption>상벌점(H)</caption> 
	<colgroup> 
	<col width="30"> 
	<col width="50"> 
	<col width="80"> 
	<col> 
	<col width="90"> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="side1"><img src="<?php echo $g['img_core']?>/_public/ico_check_01.gif" class="hand" alt="" onclick="chkFlag('members[]');" /></th>
	<th scope="col">번호</th>
	<th scope="col">
		<select onchange="document.hideForm.point.value=this.value;document.hideForm.submit();">
		<option value="">&nbsp;+ 전체</option>
		<option value="">-----</option>
		<option value="1"<?php if($point=='1'):?> selected="selected"<?php endif?>>상점</option>
		<option value="2"<?php if($point=='2'):?> selected="selected"<?php endif?>>벌점</option>
		</select>	
	</th>
	<th scope="col">내역</th>
	<th scope="col" class="side2">날짜</th>
	</tr>
	</thead>
	<tbody>

	<?php while($R=db_fetch_array($RCD)):?>
	<tr>
	<td><input type="checkbox" name="members[]" value="<?php echo $R['uid']?>" /></td>
	<td><?php echo $NUM-((($p-1)*$recnum)+$_rec++)?></td>
	<td class="cat"><?php echo ($R['point']>0?'+':'').number_format($R['point'])?></td>
	<td class="sbj">
		<?php echo $R['content']?>
		<?php if(getNew($R['d_regis'],24)):?><span class="new">new</span><?php endif?>
	</td>
	<td><?php echo getDateFormat($R['d_occur'],'Y.m.d')?></td>
	</tr> 
	<?php endwhile?> 

	<?php if(!$NUM):?>
	<tr>
	<td><input type="checkbox" disabled="disabled" /></td>
	<td>1</td>
	<td class="cat">-</td>
	<td class="sbj1">내역이 없습니다.</td>
	<td><?php echo getDateFormat($date['totime'],'Y.m.d H:i')?></td>
	</tr> 
	<?php endif?>

	</tbody>
	</table>
	

	<div class="pagebox01">
	<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
	</div>

	<input type="text" name="category" id="iCategory" value="" class="input none" />
	<input type="button" value="선택/해제" class="btngray" onclick="chkFlag('members[]');" />
	<input type="button" value="내역정리" class="btnblue" onclick="actCheck('point_sum');" />
	<input type="button" value="삭제" class="btnblue" onclick="actCheck('point_delete');" />

	</form>
	

</div>
</div>

<script type="text/javascript">
//<![CDATA[
function submitCheck(f)
{
	if (f.a.value == '')
	{
		return false;
	}
}
function giveCheck(f)
{
	if (f.point.value == '')
	{
		alert('지급할 상벌점(H)을 입력해 주세요.   ');
		f.point.focus();
		return false;
	}
	if (f.comment.value == '')
	{
		alert('지급사유를 입력해 주세요.   ');
		f.comment.focus();
		return false;
	}
}
function actCheck(act)
{
	var f = document.procForm;
    var l = document.getElementsByName('members[]');
    var n = l.length;
	var j = 0;
    var i;

    for (i = 0; i < n; i++)
	{
		if(l[i].checked == true)
		{
			j++;	
		}
	}
	if (!j)
	{
		alert('선택된 항목이 없습니다.      ');
		return false;
	}
	
	if(confirm('정말로 실행하시겠습니까?    '))
	{
		f.a.value = act;
		f.submit();
	}
}

document.title = "<?php echo $MBR_INFO['name']?>님의 상벌점(H)";
self.resizeTo(800,750);

//]]>
</script>


