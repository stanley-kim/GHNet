<?php
include_once $g['path_module'].$module.'/_main.php';
$ISCAT = getDbRows($table[$module.'category'],'');

if($cat)
{
	$CINFO = getUidData($table[$module.'category'],$cat);
	$ctarr = getShopCategoryCodeToPath($table[$module.'category'],$cat,0);
	$ctnum = count($ctarr);
	for ($i = 0; $i < $ctnum; $i++) $CXA[] = $ctarr[$i]['uid'];
}

$catcode = '';
$is_fcategory =  $CINFO['uid'] && $vtype != 'sub';
$is_regismode = !$CINFO['uid'] || $vtype == 'sub';
if ($is_regismode)
{
	$CINFO['name']	   = '';
	$CINFO['hidden']   = '';
	$CINFO['imghead']  = '';
	$CINFO['imgfoot']  = '';
}
?>


<div id="catebody">

	<div id="category">
		<div class="title">
			분류
		</div>
		<?php if($ISCAT):?>
		<div class="joinimg"></div>
		<div class="tree<?php if(strstr($_SERVER['HTTP_USER_AGENT'],'MSIE 7')):?> ie7<?php endif?>">
		<?php if(!$_isDragScript):?>
		<script type="text/javascript" src="<?php echo $g['url_root']?>/_core/opensrc/tool-man/core.js"></script>
		<script type="text/javascript" src="<?php echo $g['url_root']?>/_core/opensrc/tool-man/events.js"></script>
		<script type="text/javascript" src="<?php echo $g['url_root']?>/_core/opensrc/tool-man/css.js"></script>
		<script type="text/javascript" src="<?php echo $g['url_root']?>/_core/opensrc/tool-man/coordinates.js"></script>
		<script type="text/javascript" src="<?php echo $g['url_root']?>/_core/opensrc/tool-man/drag.js"></script>
		<script type="text/javascript" src="<?php echo $g['url_root']?>/_core/opensrc/tool-man/dragsort.js"></script>
		<script type="text/javascript">
		//<![CDATA[
		var dragsort = ToolMan.dragsort();
		//]]>
		</script>
		<?php endif?>
		<script type="text/javascript">
		//<![CDATA[
		var dragsort = ToolMan.dragsort();
		var TreeImg = "<?php echo $g['img_core']?>/tree/default_none";
		var ulink = "<?php echo $g['adm_href']?>&amp;cat=";
		//]]>
		</script>
		<script type="text/javascript" src="<?php echo $g['url_root']?>/_core/js/tree.js"></script>
		<script type="text/javascript">
		//<![CDATA[
		var TREE_ITEMS = [['', null, <?php getShopCategoryShow($table[$module.'category'],0,0,0,$cat,$CXA,0)?>]];
		new tree(TREE_ITEMS, tree_tpl);
		<?php echo $MenuOpen?>
		//]]>
		</script>
		</div>
		<?php else:?>
		<div class="none">등록된 분류가 없습니다.</div>
		<?php endif?>

		<?php if($CINFO['isson']||(!$cat&&$ISCAT)):?>
		<form action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="modifycategorygid" />

		<div class="savebtn">
			<img src="<?php echo $g['img_core']?>/_public/btn_admin.gif" alt="" title="펼치기" onclick="orderOpen();" />
			<input type="image" src="<?php echo $g['img_core']?>/_public/btn_save.gif" title="순서저장" />
		</div>
		<div class="tt1">분류순서</div>
		<ul id="menuorder">
		<?php $_MENUS=getDbSelect($table[$module.'category'],'parent='.intval($CINFO['uid']).' and depth='.($CINFO['depth']+1).' order by gid asc','*')?>
		<?php while($_M=db_fetch_array($_MENUS)):?>
		<li>
			<input type="checkbox" name="categorymembers[]" value="<?php echo $_M['uid']?>" checked="checked" />
			<img src="<?php echo $g['img_core']?>/_public/ico_drag.gif" alt="" class="drag" />
			<?php echo $_M['name']?>
			<?php if($_M['hidden']):?><img src="<?php echo $g['img_core']?>/_public/ico_hidden.gif" alt="" /><?php endif?>
		</li>
		<?php endwhile?>
		</ul>
		</form>
		<?php endif?>


	</div>


	<div id="catinfo">


		<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" enctype="multipart/form-data" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="regiscategory" />
		<input type="hidden" name="cat" value="<?php echo $CINFO['uid']?>" />
		<input type="hidden" name="vtype" value="<?php echo $vtype?>" />
		<input type="hidden" name="depth" value="<?php echo intval($CINFO['depth'])?>" />
		<input type="hidden" name="parent" value="<?php echo intval($CINFO['uid'])?>" />

		<div class="title">

			<div class="xleft">
			
			<?php if($is_regismode):?>
				<?php if($vtype == 'sub'):?>하위분류 만들기<?php else:?>최상위분류 만들기<?php endif?>
			<?php else:?>
				분류 등록정보
			<?php endif?>
			
			</div>
			<div class="xright">

				<a href="<?php echo $g['adm_href']?>&amp;type=makesite">최상위분류 등록</a>

			</div>





		</div>

		<div class="notice">
			<?php if($is_regismode):?>
			복수의 분류을 한번에 등록하시려면 분류명을 콤마(,)로 구분해 주세요.<br />
			보기)남성의류,여성의류,아동복
			<?php else:?>
			속성을 변경하려면 설정값을 변경한 후 [속성변경] 버튼을 클릭해주세요.<br />
			분류을 삭제하면 소속된 하위분류까지 모두 삭제됩니다.
			<?php endif?>
		</div>

		<table>
			<?php if($vtype == 'sub'):?>
			<tr>
				<td class="td1">상위분류</td>
				<td class="td2 b">
				<?php for ($i = 0; $i < $ctnum; $i++): ?>
				<a href="<?php echo $g['adm_href']?>&amp;cat=<?php echo $ctarr[$i]['uid']?>"><?php echo $ctarr[$i]['name']?></a>
				<?php if($i < $ctnum-1):?> &gt; <?php endif?> 
				<?php $catcode .= $ctarr[$i]['id'].'/';endfor?>
				</td>
			</tr>
			<?php else:?>
			<?php if($cat):?>
			<tr>
				<td class="td1">상위분류</td>
				<td class="td2 b">
				<?php for ($i = 0; $i < $ctnum-1; $i++): ?>
				<a href="<?php echo $g['adm_href']?>&amp;cat=<?php echo $ctarr[$i]['uid']?>"><?php echo $ctarr[$i]['name']?></a>
				<?php if($i < $ctnum-2):?> &gt; <?php endif?> 
				<?php $delparent=$ctarr[$i]['uid'];$catcode .= $ctarr[$i]['id'].'/';endfor?>
				<?php if(!$delparent):?>최상위분류<?php endif?>
				</td>
			</tr>
			<?php endif?>
			<?php endif?>
			<tr>
				<td class="td1">분류명칭</td>
				<td class="td2">
					<input type="text" name="name" value="<?php echo $CINFO['name']?>" class="input sname<?php echo $is_fcategory?1:2?>" />
					<?php if($is_fcategory):?>
					<span class="btn01"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=deletecategory&amp;cat=<?php echo $cat?>&amp;parent=<?php echo $delparent?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?     ')">분류삭제</a></span>
					<?php if($CINFO['depth']<3):?>
					<span class="btn01"><a href="<?php echo $g['adm_href']?>&amp;cat=<?php echo $cat?>&amp;vtype=sub">하위분류등록</a></span>
					<?php endif?>
					<?php endif?>
				</td>
			</tr>

			<tr>
				<td class="td1">
					숨김처리
					<img src="<?php echo $g['img_core']?>/_public/ico_q.gif" alt="도움말" title="도움말" class="hand" onclick="layerShowHide('guide_mpro','block','none');" />
				</td>
				<td class="td2 shift">
					<input type="checkbox" name="hidden" id="cat_hidden" value="1"<?php if($CINFO['hidden']):?> checked="checked"<?php endif?> /><label for="cat_hidden">분류숨김</label>
					<input type="checkbox" name="reject" id="cat_reject" value="1"<?php if($CINFO['reject']):?> checked="checked"<?php endif?> /><label for="cat_reject">분류차단</label>
					<div id="guide_mpro" class="guide hide">
					<span class="b">분류숨김 : </span>메뉴를 출력하지 않습니다.(링크접근가능)<br />
					<span class="b">분류차단 : </span>메뉴의 접근을 차단합니다.(링크접근불가)<br />
					</div>
				</td>
			</tr>

		</table>

		<div class="submitbox">


			<input type="button" class="btngray" value="분류 보기" onclick="window.open('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $module?><?php if($CINFO['uid']):?>&cat=<?php echo $CINFO['uid']?><?php endif?>');" />
			<?php if($vtype=='sub'):?><input type="button" class="btngray" value="등록취소" onclick="history.back();" /><?php endif?>
			<input type="submit" class="btnblue" value="<?php echo $is_fcategory?'분류속성 변경':'신규분류 등록'?>" />
			<div class="clear"></div>
		</div>

		</form>
		
	</div>
	<div class="clear"></div>
</div>

<script type="text/javascript">
//<![CDATA[
var orderopen = false;
function orderOpen()
{
	if (orderopen == false)
	{
		getId('menuorder').style.display = 'block';
		orderopen = true;
	}
	else {
		getId('menuorder').style.display = 'none';
		orderopen = false;
	}
}
function displaySelect(obj)
{
	var f = document.procForm;
	if (obj.value == '1')
	{
		getId('jointBox').style.display = 'block';
		getId('widgetBox').style.display = 'none';
		getId('codeBox').style.display = 'none';
		f.joint.focus();
	}
	else if (obj.value == '2')
	{
		getId('jointBox').style.display = 'none';
		getId('widgetBox').style.display = 'block';
		getId('codeBox').style.display = 'none';
	}
	else if (obj.value == '3')
	{
		getId('jointBox').style.display = 'none';
		getId('widgetBox').style.display = 'none';
		getId('codeBox').style.display = 'block';
	}
	else
	{
		getId('jointBox').style.display = 'none';
		getId('widgetBox').style.display = 'none';
		getId('codeBox').style.display = 'none';
	}
}
function codShowHide(layer,show,hide,img)
{
	if(getId(layer).style.display != show)
	{
		getId(layer).style.display = show;
		img.src = img.src.replace('ico_under','ico_over');
		setCookie('ck_'+layer,show,1);
	}
	else
	{
		getId(layer).style.display = hide;
		img.src = img.src.replace('ico_over','ico_under');
		setCookie('ck_'+layer,hide,1);
	}
}
function saveCheck(f)
{
	if (f.name.value == '')
	{
		alert('분류명칭을 입력해 주세요.      ');
		f.name.focus();
		return false;
	}
	return confirm('정말로 실행하시겠습니까?         ');
}
function slideshowOpen()
{
	<?php if($CINFO['uid']):?>

	var ch = getCookie('ck_menu_header');
	var cf = getCookie('ck_menu_footer');

	if (ch == 'block')
	{
		getId('menu_header').style.display = ch;
		getId('dm_img_header').src = getId('dm_img_header').src.replace('ico_under','ico_over');
	}
	if (cf == 'block')
	{
		getId('menu_footer').style.display = cf;
		getId('dm_img_footer').src = getId('dm_img_footer').src.replace('ico_under','ico_over');
	}
	<?php endif?>

	if(getId('menuorder')) dragsort.makeListSortable(getId("menuorder"));
}
slideshowOpen();
<?php if($type == 'makesite'):?>
document.procForm.name.focus();
<?php endif?>
//]]>
</script>