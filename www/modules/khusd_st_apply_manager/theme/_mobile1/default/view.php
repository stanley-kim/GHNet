<div id="apply_info_view" class="khusd_st view apply">

	<div class="viewbox">
		<div class="icon hand" onclick="getMemberLayer('<?php echo $APPLY_INFO['mbruid']?>',event);"><?php if($g['member']['photo']):?><img src="<?php echo $g['url_root']?>/_var/simbol/<?php echo $g['member']['photo']?>" alt="" /><?php endif?></div>
		<div class="subject">
			<h1><?php echo $APPLY_INFO['subject']?></h1>
		</div>
		<div class="info">
			<div class="xleft">
				<span class="han"><?php echo $APPLY_INFO['name']?></span>
				<span class="split">|</span>
				<?php echo getDateFormat($APPLY_INFO['date_reg'],'Y-m-d H:i:s')?>
				<span class="split">|</span>
				<span class="han">신청 수 제한</span>
				<span class="num" id="apply_limit"><?php echo $APPLY_INFO['apply_limit']?></span>
			</div>
		</div>
		
		<div id="vContent" class="content">
			<?php if(true || $d['theme']['snsping']):?>
			<div class="snsbox">
			<img src="<?php echo $g['img_module_skin']?>/kakaotalk.png" alt="카카오톡" title="게시글을 카카오톡으로 보내기" onclick="snsWin('k');" />
			</div>
			<?php endif?>
		</div>
	</div>
	
	<div class="bottom">
		<span class="btn00">
			<a href="" onclick="return alert('아직 미지원');">마감하기</a>
		</span>
		<span class="btn00">
			<a href="<?php echo $g['apply_info_modify']?>">수정</a>
		</span>
		<span class="btn00">
			<a href="" onclick="return confirm('정말로 삭제하시겠습니까? (아직 미지원)');">삭제</a>
		</span>
		<span class="btn00">
			<a href="<?php echo $g['apply_info_list']?>">목록으로</a>
		</span>
	</div>
	
	<div class="item">
		<p>항목 <span id="item_num1"><?php echo $ITEM_NUM?></span>개</p>
		<p>신청 시작 <span class="highlight"><?php echo getDateFormat($APPLY_INFO['date_start'],'Y-m-d H:i:s')?></span></p>
		<p>서버 시각 <span class="highlight"><?php echo getDateFormat($date['totime'],'Y-m-d H:i:s')?></span></p>
	</div>
	<div id="apply_item_list" class="khusd_st item apply">
		<table summary="신청 항목 리스트입니다.">
			<caption>신청 항목 리스트</caption>
			<colgroup>
				<col width="130">
				<col>
				<col width="50">
			</colgroup>
			<thead>
				<tr><td colspan="3" class="split_b_b"></td></tr>
				<tr>
					<th scope="col" class="side1"></th>
					<th scope="col">유효 신청/제한(총)</th>
					<th rowspan="2" scope="col" class="side2">신청</th>
				</tr>
				<tr>
					<th scope="col" class="side1">등록 날짜</th>
					<th scope="col">상태</th>
				</tr>
			</thead>
			<tbody>
				<tr><td colspan="3" class="split_b_b"></td></tr>
				<?php foreach($ITEM_ARRAY as $ITEM):?>
				<tr>
					<td>
						<a href="javascript:applierListWindow('<?php echo $g['apply_item_applier'].$ITEM['uid']?>');"><?php echo $ITEM['content']?></a>
					</td>
					<td><?php echo $ITEM['valid_apply_num']?> / <?php echo $ITEM['accept_limit']?> ( <?php echo $ITEM['apply_num']?> )</td>
					<td rowspan="2">
						<span class="btn00">
							<?php if(!$ITEM['valid_applied'] && $APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['OPEN']):?>
							<a href="<?php echo $g['apply_item_apply'].$ITEM['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 신청하시겠습니까? (신청 시간 확인은 본인 몫 입니다.)')">신청</a>
							<?php endif?>
						</span>
					</td>
				</tr>
				<tr>
					<td><?php echo getDateFormat($ITEM['date_reg'],'Y-m-d H:i:s')?></td>
					<td<?php if($ITEM['valid_applied'] || $ITEM['accepted']):?> class="valid_applied"<?php endif?>>
					<?php if($ITEM['accepted']):?>당첨
					<?php else:?>
					<?php echo $ITEM['valid_applied'] ? '유효신청' : ($ITEM['applied'] ? '무효신청' : '미신청')?></td>
					<?php endif?>
				</tr>
				<tr><td colspan="3" class="split_b"></td></tr>
				<?php endforeach?>
			</tbody>
			
		</table>
	</div>
	
</div>


<script type="text/javascript">
//<![CDATA[
function applierListWindow(url)
{
	window.open(url, '', 'left=0, top=0, width=700px height=600px, statusbar=no, scrollbars=yes, toolbar=yes');
}
<?php if(true || $d['theme']['snsping']):?>
function snsWin(sns)
{
	var snsset = new Array();
	var enc_sbj = "<?php echo urlencode($APPLY_INFO['subject'])?>";
	var enc_url = "<?php echo urlencode(
						$g['url_root'].'/?'.($_HS['usescode']?'r='.$r.'&':'').'c='.$c.'&uid='.$APPLY_INFO['uid']
					)?>";
	var enc_appname = "경희치전 ST"
	
	snsset['k'] = 'kakaolink://sendurl?msg=' + enc_sbj + '&url=' + enc_url + '&appid=kr.co.kimsq.st43&appver=1.0&appname=' + enc_appname;
	window.location = snsset[sns];
}
<?php endif?>
function setImgSizeSetting()
{
	<?php if($d['theme']['use_autoresize']):?>
	var ofs = getOfs(getId('vContent')); 
	getDivWidth(ofs.width,'vContent');
	<?php endif?>
	getId('vContent').style.fontFamily = getCookie('myFontFamily');
	getId('vContent').style.fontSize = getCookie('myFontSize');
}
window.onload = setImgSizeSetting;
//]]>
</script>
