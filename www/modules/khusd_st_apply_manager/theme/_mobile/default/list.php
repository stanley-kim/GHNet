<div id="apply_info_list" class="khusd_st list apply">

<div style=" margin-bottom:0px;">
	<div class="title" style="border-bottom:#efefef dotted 0px;margin-bottom:0px;">
		<div class="article">
			<a href="#"><span class="name">ST 신청</span></a>
		</div>
		<div class="clear"></div>
	</div>
	<div class="apply_links">
			<a href="/?c=2/14">구강검진</a> |
			<a href="/?c=21/83">치주과</a> |
			<a href="/?c=24/43">보존OP</a> |
			<a href="/?c=24/44">보존ENDO</a> |
			<a href="/?c=25/50">보철</a> |
			<a href="/?c=23/39">소아치과</a>
	</div>
	<style>
		.apply_links{text-align:center;}
		.apply_links a{color:blue;}
	</style>
</div>
	
	<div style="height:200px; overflow-y:scroll; margin-bottom:20px;">
	<?php getWidget('khusd/my_apply_manager',array('recnum'=>'50',))?>
	</div>

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
	<div  class="list<?php if($APPLY_INFO['uid'] == $uid):?> dselected<?php endif?> <?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['OPEN']):?>open<?php endif?>" onclick="goHref('<?php echo $g['apply_info_view'].$APPLY_INFO['uid']?>');">
		<div class="sbj">
			<span class="subject"><?php echo $dept_array[$APPLY_INFO['department']]['name']?></span>
		</div>
		<div class="sbj">
			<?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['OPEN']):?><img style="vertical-align: top;" src="<?=$g['dir_module']?>theme/_pc/default/image/Warning.png" /><?php endif?>
			<span class="subject"><?php echo $APPLY_INFO['subject'].' '.$APPLY_INFO['info_order'] ?></span>
		</div>
		<div class="info">
			<?php echo $APPLY_INFO['name']?> <span>|</span> 
			<?php if($APPLY_INFO['apply_type'] == 'rand'):?>랜덤<?php elseif($APPLY_INFO['apply_type'] == 'fcfs'):?>선착순<?php endif?><span>|</span>
			<?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['CLOSED']):?>마감<?php endif?><?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['OPEN']):?>마감 전<?php endif?><span>|</span>
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
