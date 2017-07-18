<div class="widget_my_apply_manager">
	<div class="title" style="border-bottom:#efefef dotted 2px;">
		<div class="article">
			<a href="#"><span class="name">내 신청 항목</span></a>
			<span class="stat">(<?=$my['id']?>)</span>
		</div>
		<div class="clear"></div>
	</div>
	<ul>
	<?php
		include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
		include_once $g['path_module'].'khusd_st_apply_manager/var/var.define.php';
		include_once $g['path_module'].'khusd_st_manager/function/date.php';
		$recnum = $wdgvar['recnum'];
		
/*		
		$MY_APPLY_ARRAY = getDbArray(
			$table['khusd_st_apply_manager'.'apply_list'].' al'
			.', '.$table['khusd_st_apply_manager'.'apply_info_list'].' ail'
			.', '.$table['khusd_st_apply_manager'.'apply_item'].' ai', 
			"al.st_id = '".$my['id']."'"
			." AND ("
				."al.status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'"
				." OR al.status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
			." )"
			." AND al.apply_info_uid = ail.uid" 
			." AND al.apply_item_uid = ai.uid"

			." GROUP BY apply_item_content", 

			"al.*"
			.", IF(ail.status = '".$d['khusd_st_apply_manager']['apply_info']['CLOSED']."', 1, 0) AS is_closed"
			.", ail.subject AS apply_info_subject"
			.", ail.date_start AS date_start"
			.", ail.department AS department"
			.", ail.uid AS apply_info_uid"
			.", ai.content AS apply_item_content",
			'al.date_reg', 
			'DESC', 
			$recnum, 
			1
		);
*/
		$MY_APPLY_ARRAY = getDbArray(
			$table['khusd_st_apply_manager'.'apply_list'].' al'
			.', '.$table['khusd_st_apply_manager'.'apply_info_list'].' ail'
			.', '.$table['khusd_st_apply_manager'.'apply_item'].' ai', 
			"al.st_id = '".$my['id']."'"
			." AND ("
				."al.status = '".$d['khusd_st_apply_manager']['apply_list']['APPLY']."'"
				." OR al.status = '".$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']."'"
			." )"
			." AND al.apply_info_uid = ail.uid" 
			." AND al.apply_item_uid = ai.uid",

			"al.*"
			.", IF(ail.status = '".$d['khusd_st_apply_manager']['apply_info']['CLOSED']."', 1, 0) AS is_closed"
			.", ail.subject AS apply_info_subject"
			.", ail.date_start AS date_start"
			.", ail.department AS department"
			.", ail.uid AS apply_info_uid"
			.", ail.is_perio_surgery AS is_perio_surgery"
			.", ai.content AS apply_item_content"
			.", ai.date_item AS apply_item_date_item"
			.", ai.pt_name AS apply_item_pt_name"
			.", ai.doctor AS apply_item_doctor"
			.", ai.assist AS apply_item_assist"
			,
			'al.date_reg', 
			'DESC', 
			$recnum, 
			1
		);
	?>
	
	<?php
	$apply_info_view_link = getLinkFilter($g['s'].'/?'.($_HS['usecode']?'r='.$r.'&amp;':'').'m=khusd_st_apply_manager',array($iframe?'iframe':'')).'&amp;uid=';
	?>
	
	<?php if($my['id']):?>
	<?php while($_R = db_fetch_array($MY_APPLY_ARRAY)):?>
	
	<?php
	// 치주수술의 경우, 수술정보로 content 항목을 새로 구성
	if($_R['is_perio_surgery'] == 'y')
	{
		$_R['apply_item_content'] =
			getDateFormat($_R['apply_item_date_item'],'m/d').'('.getWeek(getDateFormat($_R['apply_item_date_item'], 'w')).')'
			.' '.getDateFormat($_R['apply_item_date_item'],'H:i')
			.' '.$_R['apply_item_pt_name']
			.' '.$_R['apply_item_doctor']
			.($_R['apply_item_assist'] && strlen($_R['apply_item_assist']) > 0 ? '('.$_R['apply_item_assist'].')' : '')
			.' '.$_R['apply_item_content']
			;
	}
	?>

	<li>
		<span class="dept"><?php echo $d['khusd_st_manager']['department'][$_R['department']]['name']?></span>
		<span class="subject">
			<a href="<?php echo $apply_info_view_link.$_R['apply_info_uid']?>">
				<?php echo $_R['apply_info_subject']?> 의 <?php echo $_R['apply_item_content']?>
			</a>
		</span>
		<?php if($_R['status'] == $d['khusd_st_apply_manager']['apply_list']['ACCEPTED']):?>
		<span class="result highlight win">당첨</span>
		<?php elseif($_R['is_closed'] == 1):?>
		<span class="result fall">탈락</span>
		<?php elseif($_R['date_reg'] >= $_R['date_start']):?>
		<span class="result apply">신청</span>
		<?php else:?>
		<span class="result null_apply">무효 신청</span>
		<?php endif?>
	</li>
	
	<?php endwhile?>
	<?php else:?>
	<li><span>로그인을 하세요.</span></li>
	<?php endif?>
	
	</ul>

</div>

<style>  

.widget_my_apply_manager ul li span.dept{color:#32548D; font-weight:bold}

.widget_my_apply_manager ul li span.subject a{color:#343434; font-weight:normal;}

.widget_my_apply_manager ul li span.result{padding:0 2px; margin: 0 2px;}
.widget_my_apply_manager ul li span.win{padding:0 2px; color:green; font-weight:bold; background-color:#FFF2DB;}
.widget_my_apply_manager ul li span.fall{padding:0 2px; color:#ED514D; font-weight:bold; background-color:#FFF2DB;}
.widget_my_apply_manager ul li span.apply{color:#32548D;}
.widget_my_apply_manager ul li span.null_apply{color:#EF534A;}
</style>
