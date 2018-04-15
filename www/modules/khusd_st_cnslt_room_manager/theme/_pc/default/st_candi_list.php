<div id="candi_list" class="khusd_st calendar list candi">
	<table>
		<colgroup>
		<col width="70">
		<col width="70">
		<col width="70">
		<col width="100">
		<col width="70">
		<?php if ($st_type == 'perio' || $st_type == 'consv'):?>
		<col width="70">
		<col width="70">
		<col width="70">
		<col width="70">
		<?php endif?>
		<?php if ($st_type == 'pros'):?>
		<col width="70">
		<?php endif?>
		<col width="150">
		</colgroup>
		
		<thead>
		<tr>
			<th>대기순서</th>
			<th>이름</th>
			<th>진료과</th>
			<th>진료내용</th>
			<th>환자명</th>
			<?php if ($st_type == 'perio'):?>
			<th>SC</th>
			<th>SPT완료</th>
			<th>CU</th>
			<th>ST 점수</th>
			<?php endif?>
			<?php if ($st_type == 'consv'):?>
			<th>직전 OP수</th>
			<?php endif?>
			<?php if ($st_type == 'pros'):?>
			<th>1st 크라운</th>
			<?php endif?>
			<th>신청시간</th>
		</tr>
		</thead>
		
		<tbody>
		
		<?php $candi_idx = 1?>
		<?php while($_ROW = db_fetch_array($CANDI_ROWS)):?>
		<tr>
			<td>
				<?php echo $candi_idx++?>
			</td>
			<td>
				<?php echo $_ROW['name']?>
			</td>
			<td>
				<?php echo $d['khusd_st_manager']['department'][$_ROW['department']]['name']?>
			</td>
			<td>
				<?php echo $d['khusd_st_cnslt_room_manager']['tx_plan'][$_ROW['st_type']][$_ROW['tx_plan']]['name']?>
			</td>
			<td>
				<?php echo $_ROW['pt_name']?>
			</td>
			<?php if ($st_type == 'perio'):?>
			<td>
				<?php echo $_ROW['stsc']?>
			</td>
			<td>
				<?php echo $_ROW['stspt_complete']?>
			</td>
			<td>
				<?php echo $_ROW['stcu']?>
			</td>
			<td>
				<?php echo $_ROW['st_score']?>
			</td>
			<?php endif?>
			<?php if ($st_type == 'consv'):?>
			<td>
				<?php echo $_ROW['pre_op']?>
			</td>
			<?php endif?>
			<?php if ($st_type == 'pros'):?>
			<td>
				<?php echo $_ROW['is_first']?>
			</td>
			<?php endif?>
			<td>
				<?php echo getDateFormat($_ROW['date_reg'],'Y-m-d H:i:s')?>
			</td>
		</tr>
		<?php endwhile?>
				<?php while($_ROW = db_fetch_array($CANDI_ROWS_ADDITIONAL)):?>
		<tr>
			<td>
				<?php echo $candi_idx++?>
			</td>
			<td>
				<?php echo $_ROW['name']?>
			</td>
			<td>
				<?php echo $d['khusd_st_manager']['department'][$_ROW['department']]['name']?>
			</td>
			<td>
				<?php echo $d['khusd_st_cnslt_room_manager']['tx_plan'][$_ROW['st_type']][$_ROW['tx_plan']]['name']?>
			</td>
			<td>
				<?php echo $_ROW['pt_name']?>
			</td>
			<?php if ($st_type == 'perio'):?>
			<td>
				<?php echo $_ROW['stsc']?>
			</td>
			<td>
				<?php echo $_ROW['stpc']?>
			</td>
			<td>
				<?php echo $_ROW['stcu']?>
			</td>
			<td>
				<?php echo $_ROW['st_score']?>
			</td>
			<?php endif?>
			<?php if ($st_type == 'consv'):?>
			<td>
				<?php echo $_ROW['pre_op']?>
			</td>
			<?php endif?>
			<?php if ($st_type == 'pros'):?>
			<td>
				<?php echo $_ROW['is_first']?>
			</td>
			<?php endif?>
			<td>
				<?php echo getDateFormat($_ROW['date_reg'],'Y-m-d H:i:s')?>
			</td>
		</tr>
		<?php endwhile?>
		
		</tbody>
		
	</table>
</div>
