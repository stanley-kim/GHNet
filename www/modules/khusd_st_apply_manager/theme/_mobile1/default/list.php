<div id="apply_info_list" class="khusd_st list apply">

	<div class="title">

		<div class="article">
			<a href="<?php echo $g['apply_info_reset']?>"><span class="name">선착순 신청</span></a>
			<span class="stat"><?php echo number_format($NUM+count($NCD))?>개(<?php echo $p?>/<?php echo $TPG?>페이지)</span>
		</div>
		<div class="clear"></div>
	</div>
	
	<?php foreach($APPLY_INFO_ARRAY as $APPLY_INFO):?> 
	<?php $APPLY_INFO['mobile']=isMobileConnect($R['agent'])?>
	<a name="D<?php echo $APPLY_INFO['uid']?>"></a>
	<div class="list<?php if($APPLY_INFO['uid'] == $uid):?> dselected<?php endif?>" onclick="goHref('<?php echo $g['apply_info_view'].$APPLY_INFO['uid']?>');">
		<div class="sbj">
			<span class="subject"><?php echo $APPLY_INFO['subject']?></span>
		</div>
		<div class="info">
			<?php echo $APPLY_INFO['name']?> <span>|</span> 
			<?php if($APPLY_INFO['apply_type'] == 'rand'):?>랜덤<?php elseif($APPLY_INFO['apply_type'] == 'fcfs'):?>선착순<?php endif?><span>|</span>
			<?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['CLOSED']):?>마감<?php endif?><span>|</span>
			<?php echo getDateFormat($APPLY_INFO['date_start'],'Y.m.d H:i')?> <span>|</span> 
			항목수 <?php echo $APPLY_INFO['num_item']?> 
		</div>
	</div>
	<?php endforeach?> 

	<?php if(!$NUM):?>
	<div class="none">등록된 게시물이 없습니다.</div>
	<?php endif?>
	
	<div class="page">
	<?php echo getPageLink($d['theme']['pagenum'],$p,$TPG,$g['img_core'].'/page/default')?>
	</div>

	<div class="btnbox">
		<div class="xr">
		<span class="btn00"><a href="<?php echo $g['apply_info_list']?>">목록</a></span>
		<span class="btn00"><a href="<?php echo $g['apply_info_add']?>">신청 추가</a></span>
		</div>
		<div class="clear"></div>
	</div>
</div>