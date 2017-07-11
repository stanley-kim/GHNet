<div id="cnslt_schedule" class="khusd_st calendar list">

	<div class="title" style="font-size:14px; font-weight:bold; color:blue;">
		<?php echo getDateFormat($st_date, 'Y')?>.
		<?php echo getDateFormat($st_date, 'n')?>.
		<?php echo getDateFormat($st_date, 'F')?>
	</div>
	
	<table class="calendar">
		<tbody>
			<tr class="navi">
				<td colspan="7">
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_schedule'].$last_month_day?>">◁지난달</a>
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_schedule'].$date['today']?>">|오늘|</a>
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_schedule'].$next_month_day?>">다음달▷</a>
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
						(getDateFormat($ch_date, 'n') < 12 && getDateFormat($day, 'n') <= getDateFormat($ch_date, 'n'))
						||
						(getDateFormat($ch_date, 'n') == 12 && getDateFormat($day, 'n') != 1 && getDateFormat($ch_date, 'n'))
						||
						(getDateFormat($ch_date, 'n')== 1 && getDateFormat($day, 'n') == 12)
						; 
						):?>
			<tr class="day">
				<td class="sun">
					<?php if(getDateFormat($day, 'w') == 0 && getDateFormat($day, 'n') == getDateFormat($ch_date, 'n')):?>
						<?php echo getDateFormat($day++, 'j')?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day, 'w') == 1 && getDateFormat($day, 'n') == getDateFormat($ch_date, 'n')):?>
						<?php echo getDateFormat($day++, 'j')?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day, 'w') == 2 && getDateFormat($day, 'n') == getDateFormat($ch_date, 'n')):?>
						<?php echo getDateFormat($day++, 'j')?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day, 'w') == 3 && getDateFormat($day, 'n') == getDateFormat($ch_date, 'n')):?>
						<?php echo getDateFormat($day++, 'j')?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day, 'w') == 4 && getDateFormat($day, 'n') == getDateFormat($ch_date, 'n')):?>
						<?php echo getDateFormat($day++, 'j')?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day, 'w') == 5 && getDateFormat($day, 'n') == getDateFormat($ch_date, 'n')):?>
						<?php echo getDateFormat($day++, 'j')?>
					<?php endif?>
				</td>
				<td class="sat">
					<?php if(getDateFormat($day, 'w') == 6 && getDateFormat($day, 'n') == getDateFormat($ch_date, 'n')):?>
						<?php echo getDateFormat($day++, 'j')?>
					<?php endif?>
				</td>
			</tr>
			<tr class="body">
				<td class="sun">
					<?php if(getDateFormat($day2, 'w') == 0 && getDateFormat($day2, 'n') == getDateFormat($ch_date, 'n')):?>
					<?php $day2++?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day2, 'w') == 1 && getDateFormat($day2, 'n') == getDateFormat($ch_date, 'n')):?>
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_table'].$day2.'000000'?>">스케줄표</a>
					<br />
					
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_consv_table'].$day2.'000000'?>">보존 OP</a>
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_pros_table'].$day2.'000000'?>">보철 ST</a>
					
					<?php $day2++?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day2, 'w') == 2 && getDateFormat($day2, 'n') == getDateFormat($ch_date, 'n')):?>
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_table'].$day2.'000000'?>">스케줄표</a>
					<br />
					
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_consv_table'].$day2.'000000'?>">보존 OP</a>
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_pros_table'].$day2.'000000'?>">보철 ST</a>

					<?php $day2++?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day2, 'w') == 3 && getDateFormat($day2, 'n') == getDateFormat($ch_date, 'n')):?>
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_table'].$day2.'000000'?>">스케줄표</a>
					<br />
					
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_consv_table'].$day2.'000000'?>">보존 OP</a>
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_pros_table'].$day2.'000000'?>">보철 ST</a>

					<?php $day2++?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day2, 'w') == 4 && getDateFormat($day2, 'n') == getDateFormat($ch_date, 'n')):?>
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_table'].$day2.'000000'?>">스케줄표</a>
					<br />
					
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_consv_table'].$day2.'000000'?>">보존 OP</a>
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_pros_table'].$day2.'000000'?>">보철 ST</a>

					<?php $day2++?>
					<?php endif?>
				</td>
				<td class="weekday">
					<?php if(getDateFormat($day2, 'w') == 5 && getDateFormat($day2, 'n') == getDateFormat($ch_date, 'n')):?>
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_table'].$day2.'000000'?>">스케줄표</a>
					<br />
					
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_consv_table'].$day2.'000000'?>">보존 OP</a>
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_pros_table'].$day2.'000000'?>">보철 ST</a>

					<?php $day2++?>
					<?php endif?>
				</td>
				<td class="sat">
					<?php if(getDateFormat($day2, 'w') == 6 && getDateFormat($day2, 'n') == getDateFormat($ch_date, 'n')):?>
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_table'].$day2.'000000'?>">스케줄표</a>
					<br />
					
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_consv_table'].$day2.'000000'?>">보존 OP</a>
					<br />
					<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_pros_table'].$day2.'000000'?>">보철 ST</a>

					<?php $day2++?>
					<?php endif?>
				</td>
			</tr>
			<?php endfor?>
		</tbody>
	</table>

</div>