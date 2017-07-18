<div class="widget_my_st_candi_list">
	<div class="title">
		<div class="article">
			<a href="#"><span class="name">ST 체어 대기목록</span></a>
		</div>
		<div class="clear"></div>
	</div>
	<ul>
	<?php
		include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
		include_once $g['path_module'].'khusd_st_apply_manager/var/var.define.php';
		
		include_once $g['path_module'].'khusd_st_manager/function/date.php';
		
		// 오늘이 일요일이면, 그 다음주의 일정표를 보여주기
		$day_offset = 0;
		if($date['toweek'] == 0)
			$day_offset = 7;

		$week_string_array = array( '월요일', '화요일', '수요일', '목요일', '금요일', '토요일' );
		$date_array = array();
		$candi_num_array = array();
		$perio_accepted_array = array();
		$consv_op_accepted_array = array();
		$pros_accepted_array = array();

		$_table = $table['khusd_st_cnslt_room_manager'.'candi'];
		$_table_rsv = $table['khusd_st_cnslt_room_manager'.'reservation'];

		for($_day = 1; $_day <= 6; $_day++)
		{
			$_date = getDateOfDay($date['today'], $_day + $day_offset, '0000', 'Ymd');
			$date_array[] = $_date;
			
			$_where = "st_date = '".$_date."' AND st_timetype = 'am'";
			$_am_num = getDbRows($_table, $_where);

			$_where = "st_date = '".$_date."' AND st_timetype = 'pm'";
			$_pm_num = getDbRows($_table, $_where);
			
			$candi_num_array[] = array( 'am' => $_am_num, 'pm' => $_pm_num );
			
			
			// 보존OP, 치주, 보철 ST 배정된 개수
			$_where = "chair_date = '".$_date."' AND chair_timetype = 'am' AND st_type = 'consv'";
			$_am_num = getDbRows($_table_rsv, $_where);
			$_where = "chair_date = '".$_date."' AND chair_timetype = 'pm' AND st_type = 'consv'";
			$_pm_num = getDbRows($_table_rsv, $_where);
			$consv_op_accepted_array[] = array( 'am' => $_am_num, 'pm' => $_pm_num );

			$_where = "chair_date = '".$_date."' AND chair_timetype = 'am' AND st_type = 'perio'";
			$_am_num = getDbRows($_table_rsv, $_where);
			$_where = "chair_date = '".$_date."' AND chair_timetype = 'pm' AND st_type = 'perio'";
			$_pm_num = getDbRows($_table_rsv, $_where);
			$perio_accepted_array[] = array( 'am' => $_am_num, 'pm' => $_pm_num );

			$_where = "chair_date = '".$_date."' AND chair_timetype = 'am' AND st_type = 'pros'";
			$_am_num = getDbRows($_table_rsv, $_where);
			$_where = "chair_date = '".$_date."' AND chair_timetype = 'pm' AND st_type = 'pros'";
			$_pm_num = getDbRows($_table_rsv, $_where);
			$pros_accepted_array[] = array( 'am' => $_am_num, 'pm' => $_pm_num );
		}

	?>
	
	<?php
	$candi_list_link = getLinkFilter($g['s'].'/?'.($_HS['usecode']?'r='.$r.'&amp;':'').'m=khusd_st_cnslt_room_manager',array($iframe?'iframe':'')).'&amp;mode=st_candi_list&amp;st_date=';
	?>
	
	<?php if($my['id']):?>
	
	<?php foreach($week_string_array as $key => $week_string):?>
	<li>
		<span><?php echo $week_string?></span>(<?php echo getDateFormat($date_array[$key], 'Y-m-d') ?>) : 
		<span>
			대기자 [<a href="<?php echo $candi_list_link.$date_array[$key].'&amp;st_timetype=am'?>">오전</a>( <?php echo $candi_num_array[$key]['am']?> 명)
			<a href="<?php echo $candi_list_link.$date_array[$key].'&amp;st_timetype=pm'?>">오후</a>( <?php echo $candi_num_array[$key]['pm']?> 명)
			]
		</span>
	</li>
	<?php endforeach?>
	
	<?php else:?>
	<li><span>로그인을 하세요.</span></li>
	<?php endif?>
	
	</ul>

	<div class="title">
		<div class="article">
			<a href="#"><span class="name">ST 체어 배정현황</span></a>
		</div>
		<div class="clear"></div>
	</div>
	
	<ul>
	<?php if($my['id']):?>
	<?php foreach($week_string_array as $key => $week_string):?>
	<li>
		<span><?php echo $week_string?></span>(<?php echo getDateFormat($date_array[$key], 'Y-m-d') ?>) : 
		<br />
		<span>
			OP배정자 [<a href="">오전</a>( <?php echo $consv_op_accepted_array[$key]['am']?> 명)
			<a href="">오후</a>( <?php echo $consv_op_accepted_array[$key]['pm']?> 명)
			]
		</span>
		<br />
		<span>
			치주배정자 [<a href="">오전</a>( <?php echo $perio_accepted_array[$key]['am']?> 명)
			<a href="">오후</a>( <?php echo $perio_accepted_array[$key]['pm']?> 명)
			]
		</span>
		<br />
		<span>
			보철배정자 [<a href="">오전</a>( <?php echo $pros_accepted_array[$key]['am']?> 명)
			<a href="">오후</a>( <?php echo $pros_accepted_array[$key]['pm']?> 명)
			]
		</span>
	</li>
	<?php endforeach?>
	
	<?php else:?>
	<li><span>로그인을 하세요.</span></li>
	<?php endif?>
	
	</ul>
</div>
