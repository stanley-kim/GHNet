	<table summary="치주과 점수표 입니다."<?php if($_start_idx > 1):?> class="pagebreak"<?php endif?>>
	<caption>
	<div class="headbox">
		<div class="table_title">
			경희대학교 치과대학교 47기
			<br />
			경희대학교 치의학전문대학원 11기
		</div>
		
		<div class="table_date">
			<?php echo getDateFormat($ch_date,'Y-m-d (D)')?>
		</div>
	</div>
	</caption> 
	<?php $_width = ($is_available_nt ? 15 : 20)?>
	<colgroup> 
	<col width="30"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<?php if($is_available_nt):?>
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<col width="<?php echo $_width?>"> 
	<?php endif?>
	</colgroup> 

	<thead>
	<tr>
	<th scope="col" class="split">No</th>
	<th scope="col" colspan="13" class="split">진료내용 및 시간 (오전)</th>
	<th scope="col" colspan="17" class="split">진료내용 및 시간 (오후)</th>
	<?php if($is_available_nt):?>
	<th scope="col" colspan="10" class="split">진료내용 및 시간 (야간)</th>
	<?php endif?>
	</tr>
	</thead>

	<tbody>
	
	<tr>

		<td></td>
		
		<td></td>
		<td colspan="2">9:30</td>
		<td colspan="2">10:00</td>
		<td colspan="2">10:30</td>
		<td colspan="2">11:00</td>
		<td colspan="2">11:30</td>
		<td colspan="2">12:00</td>
		
		<td colspan="2">13:30</td>
		<td colspan="2">14:00</td>
		<td colspan="2">14:30</td>
		<td colspan="2">15:00</td>
		<td colspan="2">15:30</td>
		<td colspan="2">16:00</td>
		<td colspan="2">16:30</td>
		<td colspan="2">17:00</td>

		<?php if($is_available_nt):?>
		<td colspan="2">17:30</td>
		<td colspan="2">18:00</td>
		<td colspan="2">18:30</td>
		<td colspan="2">19:00</td>
		<td colspan="2">19:30</td>
		<?php endif?>
		<td></td>
	</tr>
	
	<?php $_count = 0?>
	<?php foreach($CHAIR_RESERV_ARRAY as $CHAIR):?>
	<?php $_count++?>
	<?php if($_start_idx > $_count):?>
		<?php continue?>
	<?php endif?>
	<?php if($_count > $_start_idx + $CHAIR_NUM_PAGE - 1):?>
		<?php break?>
	<?php endif?>
	
	<tr>
		<td rowspan="1" class="timeline">
			<?php echo $CHAIR['chair_no']?>
		</td>

		<?php $time = 9 * 60?>
		<?php foreach($CHAIR['reserv'] as $RESERV):?>
			<?php if($time == 12 * 60 + 30)	$time = 13 * 60 + 30?>
			<?php $start_time = intval(
									substr($RESERV['chair_start_time'], 0, 2) * 60
									+ substr($RESERV['chair_start_time'], 2, 2)
									)?>
			<?php $end_time = intval(
									substr($RESERV['chair_end_time'], 0, 2) * 60
									+ substr($RESERV['chair_end_time'], 2, 2)
									)?>
			<?php if($time != $start_time):?>
				<?php for( ; $time < $start_time; $time += 30):?>
				<?php if($time == 12 * 60 + 30)	$time = 13 * 60 + 30?>
				<?php if($time >= $start_time) break;?>
				<td colspan="2" class="timeline"></td>
				<?php endfor?>
			<?php endif?>
			<?php $term = $end_time - $start_time?>
			<?php $time += $term?>
				<?php if($MANAGER && $iframe  != 'Y'):?>
				<form name="stApplyForm<?php echo $idx?>" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>">
					<input type="hidden" name="r" value="<?php echo $r?>" />
					<input type="hidden" name="a" value="force_cancel_chair" />
					<input type="hidden" name="c" value="<?php echo $c?>" />
					<input type="hidden" name="m" value="<?php echo $m?>" />
					
					<input type="hidden" name="uid" value="<?php echo $RESERV['uid']?>" />
				<td colspan="<?php echo $term / 30 * 2?>" class="timeline category1" onclick="javascript:if(confirm('배정 취소하시겠습니까?')){document.stApplyForm<?php echo $idx?>.submit();}">
				<?php else:?>
				<td colspan="<?php echo $term / 30 * 2?>" class="timeline category1">
				<?php endif?>
					St.<?php echo $RESERV['st_name']?> / Pt.<?php echo $RESERV['pt_name']?>
					<br />
					<?php echo $dept_array[$RESERV['department']]['name']?> / <?php echo $d['khusd_st_cnslt_room_manager']['tx_plan'][$RESERV['st_type']][$RESERV['tx_plan']]['name']?>
				</td>
				<?php if($MANAGER && $iframe  != 'Y'):?>
				</form>
				<?php endif?>
		<?php endforeach?>
		<?php if($time < 17 * 60 + 30):?>
			<?php for( ; $time < 17 * 60 + 30; $time += 30):?>
				<?php if($time == 12 * 60 + 30)	$time = 13 * 60 + 30?>
				<td colspan="2" class="timeline"></td>
			<?php endfor?>
		<?php endif?>
		<?php if($is_available_nt && $time < 20 * 60):?>
			<?php for( ; $time < 20 * 60; $time += 30):?>
				<td colspan="2" class="timeline"></td>
			<?php endfor?>
		<?php endif?>
		
	</tr>
	<?php endforeach?>

        <?php  if ($_start_idx == 25 ) :?>
        <?php $__i = 0?>
        <? while( $__i<7 )   :?>
        <tr>
                <td rowspan="1" class="timeline">
                </td>
                <?php $__j = 0?>
                <?php   if ( $is_available_nt == false ) $_col_length = 15;
                        else $_col_length = 20 ?>
                <? while( $__j< $_col_length )   :?>
                <td rowspan="1" colspan="2" class="timeline">
                </td>
                <? $__j = $__j + 1 ?>
                <?php endwhile ?>
        </tr>
        <? $__i = $__i + 1 ?>
        <?php endwhile ?>
        <?php endif?>

	</tbody>
	</table>
