<div id="perio_surgery_timetable_view" class="khusd_st list">

	<div>
		<?php if($iframe != 'y' && $iframe != 'Y'):?>
		<a href="<?php echo $g['perio_surgery_timetable'].$apply_info_list_uid.'&amp;iframe=Y'?>" target="_blank">프린트</a>
		<?php endif?>
	</div>
	
	<?php $_first_page = true?>
	<?php foreach($TIMETABLE_ARRAY as $date_item => $DATE_ROW):?>
	<table summary="종진실 OP 출석부 입니다."<?php if($_first_page == false):?> class="pagebreak"<?php endif?>>
	<?php $_first_page = false?>
	<caption>
	<div class="headbox">
		<div class="table_title">
			<?php echo getDateFormat($date_item,'m/d')?> (<?php echo getWeek(getDateFormat($date_item, 'w'))?>)
		</div>
	</div>
	</caption> 
	<colgroup> 
	<col width="40"> 
	<col width="60"> 
	<col width="60"> 
	<col width="65"> 
	<col width="65"> 
	<col width="60"> 
	<col width="140"> 
	<col width="60"> 
	<col width="90"> 
	</colgroup> 

	<thead>
	<tr>
	<th scope="col" class="split">시간</th>
	<th scope="col" class="split">병록번호</th>
	<th scope="col" class="split">환자이름</th>
	<th scope="col" class="split">성별/나이</th>
	<th scope="col" class="split">수술부위</th>
	<th scope="col" class="split">술자</th>
	<th scope="col" class="split">술식</th>
	<th scope="col" class="split">어시스트<br />(수련의)</th>
	<th scope="col" class="split">어시스트<br />(원내생)</th>
	</tr>
	</thead>

	<tbody>
	
	<?php foreach($DATE_ROW as $TIME_ROW):?>
	<?php $_count_time_row = count($TIME_ROW)?>
	<?php $_idx_time_row = 0?>
	<?php foreach($TIME_ROW as $ROW):?>
	<?php if($ROW['is_imp_cent'] == 1):?>
	<tr class="selected">
	<?php else:?>
	<!--<tr onclick="toggle_bg(this)">-->
	<tr>
	<?php endif?>
		<?php if($_idx_time_row == 0):?>
		<td rowspan=<?php echo $_count_time_row?> class="no_bg"><?php echo getDateFormat($ROW['date_item'],'H:i')?></td>
		<?php endif?>
		<?php $_idx_time_row++?>
		
		<td><?php echo $ROW['pt_id']?></td>
		<td><?php echo $ROW['pt_name']?></td>
		<td></td>
		<td></td>
		<td><?php echo $ROW['doctor']?></td>
		<td><?php echo $ROW['content']?></td>
		<td><?php echo $ROW['assist']?></td>
		<td>
			<?php if($ROW['accept'] && count($ROW['accept']) > 0):?>
				<?php echo $ROW['accept'][0]['st_name']?><?php if($ROW['accept'] && count($ROW['accept']) > 1):?>/<?php echo $ROW['accept'][1]['st_name']?><?php endif?>
			<?php endif?>
		</td>
	</tr>
	<?php endforeach?>
	<?php endforeach?>
	
	</tbody>
	</table>
	<?php endforeach?>
</div>

<script>
	function toggle_bg(elem)
	{
		selectClass = 'selected';
		orgClass = elem.className;
		elem.className = (elem.className == selectClass) ? '' : selectClass;
	}
</script>