<div class="widget_my_st_apply_manager">
<div class="title">
		<div class="article">
			<a href="#"><span class="name">내 ST 신청 항목</span></a>
		</div>
		<div class="clear"></div>
	</div>

	<?php
		include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
		include_once $g['path_module'].'khusd_st_cnslt_room_manager/var/var.define.php';
		
		if($my['id'])
		{
			$recnum = $wdgvar['recnum'];
			
			$MY_ST_CHAIR_ARRAY = array();
		
			$_table = $table['khusd_st_cnslt_room_manager'.'apply'].' st';
			$_where = 
				"st.st_id = '".$my['id']."'";
			
			$_data = 'st.*';
			$_sort = 'st.st_date DESC, st_timetype';
			$_orderby = 'DESC';
			
			$MY_ST_CHAIR_ROWS = getDbArray($_table, $_where, $_data, $_sort, $_orderby, $recnum, 1);
			while($_ROW = db_fetch_array($MY_ST_CHAIR_ROWS)) $MY_ST_CHAIR_ARRAY[] = $_ROW;
		}
	?>
	
	<?php 
	$st_apply_list_link = getLinkFilter(
			$g['s'].'/?'.(
					$_HS['usecode']?'r='.r.'&amp;':''
			)
			.'m=khusd_st_cnslt_room_manager',
		array($iframe?'iframe':'')
	)
	.'&amp;mode=st_list&amp;department=';
	?>

	<ul>
	<?php if($my['id']):?>
		<?php $_ST_STATUS = $d['khusd_st_cnslt_room_manager']['apply']['status']?>
		<?php foreach($MY_ST_CHAIR_ARRAY as $MY_ST_CHAIR):?>
	<li>
		<a href="<?php echo $st_apply_list_link.$MY_ST_CHAIR['department'].'&amp;st_date='.getDateFormat($MY_ST_CHAIR['st_date'], 'Ymd').'&amp;st_timetype='.$MY_ST_CHAIR['st_timetype']?>">
		<span>
			<?php echo getDateFormat($MY_ST_CHAIR['st_date'], 'm-d')?>
			- 
			<?php if($MY_ST_CHAIR['st_timetype'] == 'am'):?>오전<?php endif?>
			<?php if($MY_ST_CHAIR['st_timetype'] == 'pm'):?>오후<?php endif?>
			<?php if($MY_ST_CHAIR['st_timetype'] == 'nt'):?>야간<?php endif?>
		</span>
		<span>상태 : </span>
		<?php if($MY_ST_CHAIR['status'] == $_ST_STATUS['APPLY']):?>신청
		<?php elseif($MY_ST_CHAIR['status'] == $_ST_STATUS['CANCEL']):?>취소
		<?php elseif($MY_ST_CHAIR['status'] == $_ST_STATUS['ACCEPTED']):?>당첨
		<?php elseif($MY_ST_CHAIR['status'] == $_ST_STATUS['CANDI']):?>대기
		<?php elseif($MY_ST_CHAIR['status'] == $_ST_STATUS['ADD_ACCEPTED']):?>추가
		<?php endif?>
		
		<span>체어번호 : </span><?php echo $MY_ST_CHAIR['chair_no']?>
		<span>진료 : </span>
		<?php echo $d['khusd_st_manager']['department'][$MY_ST_CHAIR['department']]['name']?>
		<?php echo $d['khusd_st_cnslt_room_manager']['tx_plan'][$MY_ST_CHAIR['department']][$MY_ST_CHAIR['tx_plan']]['name']?>
		<span>환자명 : </span>
		<?php echo $MY_ST_CHAIR['pt_name']?>
		</a>
	</li>
		<?php endforeach?>
	
	<?php else:?>
	<li><span>로그인을 하세요.</span></li>

	<?php endif?>

	</ul>

</div>
