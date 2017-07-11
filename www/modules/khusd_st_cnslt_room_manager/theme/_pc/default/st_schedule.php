<div id="<?php echo $st_type?>_st_schedule" class="khusd_st calendar list <?php echo $st_type?>">

	<div class="title" style="font-size:16px; font-weight:bold; color:blue;">
	<?php
		$st_type_string = "";
		if($st_type == 'radio')
			$st_type_string = '구강검진';
		elseif($st_type == 'endo')
			$st_type_string = '보존 Endo ST';
		elseif($st_type == 'consv')
			$st_type_string = '보존 OP ST';
		elseif($st_type == 'perio')
			$st_type_string = '치주 ST';
		elseif($st_type == 'pros')
			$st_type_string = '보철 ST';
		elseif($st_type == 'pedia')
			$st_type_string = '소치 ST';
		else
			$st_type_string = "$st_type";
	?>
		<font style="color:red;">[<?php echo $st_type_string?>]</font>
		<?php echo getDateFormat($st_date, 'Y')?>.
		<?php echo getDateFormat($st_date, 'n')?>.
	</div>
	
	<table class="st_schedule">
	<tr>
	<td width="75%">
	<table class="calendar">
		<tbody>
			<tr class="navi">
				<td colspan="7" style="color:white; font-weight:bold; text-align:center;">
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_'.$st_type.'_schedule'].$last_month_day?>" style="color:white;">◁ 지난달</a>|
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_'.$st_type.'_schedule'].$date['today']?>" style="color:white;"> 오늘 </a>|
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_'.$st_type.'_schedule'].$next_month_day?>" style="color:white;">다음달 ▷</a>
				</td>
			</tr>
			
			<tr class="head">
				<td class="sun">
					<h4>SUN</h4>
				</td>
				<td class="weekday">
					<h4>MON</h4>
				</td>
				<td class="weekday">
					<h4>TUE</h4>
				</td>
				<td class="weekday">
					<h4>WED</h4>
				</td>
				<td class="weekday">
					<h4>THU</h4>
				</td>
				<td class="weekday">
					<h4>FRI</h4>
				</td>
				<td class="sat">
					<h4>SAT</h4>
				</td>
			</tr>
			
			<?php $day = $mon_start_date?>
			<?php $day2 = $mon_start_date?>
			<?php for( 
						; 
						(getDateFormat($st_date, 'n') < 12 && getDateFormat($day, 'n') <= getDateFormat($st_date, 'n'))
						||
						(getDateFormat($st_date, 'n') == 12 && getDateFormat($day, 'n') != 1 && getDateFormat($st_date, 'n'))
						||
						(getDateFormat($st_date, 'n')== 1 && getDateFormat($day, 'n') == 12)
						; 
						):?>
			<tr class="day">
				<td class="sun">
					<?php if(getDateFormat($day, 'w') == 0 && getDateFormat($day, 'n') == getDateFormat($st_date, 'n')):?>
						<?php echo getDateFormat($day++, 'j')?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day, 'w') == 1 && getDateFormat($day, 'n') == getDateFormat($st_date, 'n')):?>
						<?php echo getDateFormat($day++, 'j')?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day, 'w') == 2 && getDateFormat($day, 'n') == getDateFormat($st_date, 'n')):?>
						<?php echo getDateFormat($day++, 'j')?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day, 'w') == 3 && getDateFormat($day, 'n') == getDateFormat($st_date, 'n')):?>
						<?php echo getDateFormat($day++, 'j')?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day, 'w') == 4 && getDateFormat($day, 'n') == getDateFormat($st_date, 'n')):?>
						<?php echo getDateFormat($day++, 'j')?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day, 'w') == 5 && getDateFormat($day, 'n') == getDateFormat($st_date, 'n')):?>
						<?php echo getDateFormat($day++, 'j')?>
					<?php endif?>
				</td>
				<td class="sat">
					<?php if(getDateFormat($day, 'w') == 6 && getDateFormat($day, 'n') == getDateFormat($st_date, 'n')):?>
						<?php echo getDateFormat($day++, 'j')?>
					<?php endif?>
				</td>
			</tr>
			<tr class="body">
				<td class="sun">
					<?php if(getDateFormat($day2, 'w') == 0 && getDateFormat($day2, 'n') == getDateFormat($st_date, 'n')):?>
					<?php $day2++?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day2, 'w') == 1 && getDateFormat($day2, 'n') == getDateFormat($st_date, 'n')):?>
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_'.$st_type.'_list'].$day2.'&amp;st_timetype=am'?>">오전 <?php echo $ST_CHAIR_ARRAY[$day2]['am']?>명</a>
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_'.$st_type.'_list'].$day2.'&amp;st_timetype=pm'?>">오후 <?php echo $ST_CHAIR_ARRAY[$day2]['pm']?>명</a>
					<?php $day2++?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day2, 'w') == 2 && getDateFormat($day2, 'n') == getDateFormat($st_date, 'n')):?>
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_'.$st_type.'_list'].$day2.'&amp;st_timetype=am'?>">오전 <?php echo $ST_CHAIR_ARRAY[$day2]['am']?>명</a>
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_'.$st_type.'_list'].$day2.'&amp;st_timetype=pm'?>">오후 <?php echo $ST_CHAIR_ARRAY[$day2]['pm']?>명</a>
					<?php $day2++?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day2, 'w') == 3 && getDateFormat($day2, 'n') == getDateFormat($st_date, 'n')):?>
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_'.$st_type.'_list'].$day2.'&amp;st_timetype=am'?>">오전 <?php echo $ST_CHAIR_ARRAY[$day2]['am']?>명</a>
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_'.$st_type.'_list'].$day2.'&amp;st_timetype=pm'?>">오후 <?php echo $ST_CHAIR_ARRAY[$day2]['pm']?>명</a>
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_'.$st_type.'_list'].$day2.'&amp;st_timetype=nt'?>">야간 <?php echo $ST_CHAIR_ARRAY[$day2]['nt']?>명</a>
					<?php $day2++?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day2, 'w') == 4 && getDateFormat($day2, 'n') == getDateFormat($st_date, 'n')):?>
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_'.$st_type.'_list'].$day2.'&amp;st_timetype=am'?>">오전 <?php echo $ST_CHAIR_ARRAY[$day2]['am']?>명</a>
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_'.$st_type.'_list'].$day2.'&amp;st_timetype=pm'?>">오후 <?php echo $ST_CHAIR_ARRAY[$day2]['pm']?>명</a>
					<?php $day2++?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day2, 'w') == 5 && getDateFormat($day2, 'n') == getDateFormat($st_date, 'n')):?>
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_'.$st_type.'_list'].$day2.'&amp;st_timetype=am'?>">오전 <?php echo $ST_CHAIR_ARRAY[$day2]['am']?>명</a>
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_'.$st_type.'_list'].$day2.'&amp;st_timetype=pm'?>">오후 <?php echo $ST_CHAIR_ARRAY[$day2]['pm']?>명</a>
					<?php $day2++?>
					<?php endif?>
				</td>
				<td class="sat">
					<?php if(getDateFormat($day2, 'w') == 6 && getDateFormat($day2, 'n') == getDateFormat($st_date, 'n')):?>
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_'.$st_type.'_list'].$day2.'&amp;st_timetype=am'?>">오전 <?php echo $ST_CHAIR_ARRAY[$day2]['am']?>명</a>
					<?php $day2++?>
					<?php endif?>
				</td>
			</tr>
			<?php endfor?>
		</tbody>
	</table>
	
	</td>
	<td>
	
	<table class="my_chair">
		<tbody>
			<tr class="title">
				<td colspan="5">내 예약 현황</td>
			</tr>
			<tr class="head">
				<td width="65">시간</td>
				<td width="60">상태</td>
				<td width="30">체어</td>
				<td>진료내용</td>
				<td width="50">환자이름</td>
			</tr>
			<?php $_ST_STATUS = $d['khusd_st_cnslt_room_manager']['apply']['status']?>
			<?php foreach($MY_ST_CHAIR_ARRAY as $MY_ST_CHAIR):?>
			<tr class="body">
				<td>
				<?php echo getDateFormat($MY_ST_CHAIR['st_date'], 'm-d')?>
				 
				<?php if($MY_ST_CHAIR['st_timetype'] == 'am'):?>오전<?php endif?>
				<?php if($MY_ST_CHAIR['st_timetype'] == 'pm'):?>오후<?php endif?>
				<?php if($MY_ST_CHAIR['st_timetype'] == 'nt'):?>야간<?php endif?>
				</td>
				<td>
					<?php if($MY_ST_CHAIR['status'] == $_ST_STATUS['APPLY']):?>신청
					<?php elseif($MY_ST_CHAIR['status'] == $_ST_STATUS['CANCEL']):?>취소
					<?php elseif($MY_ST_CHAIR['status'] == $_ST_STATUS['ACCEPTED']):?>당첨
					<?php elseif($MY_ST_CHAIR['status'] == $_ST_STATUS['CANDI']):?>대기
					<?php elseif($MY_ST_CHAIR['status'] == $_ST_STATUS['ADD_ACCEPTED']):?>추가
					<?php endif?>
				</td>
				<td><?php echo $MY_ST_CHAIR['chair_no']?></td>
				<td><?php echo $d['khusd_st_cnslt_room_manager']['tx_plan'][$st_type][$MY_ST_CHAIR['tx_plan']]['name']?></td>
				<td><?php echo $MY_ST_CHAIR['pt_name']?></td>
			</tr>
			<?php endforeach?>
		</tbody>
	</table>
	
	</td>
	</tr>
	</table>

</div>