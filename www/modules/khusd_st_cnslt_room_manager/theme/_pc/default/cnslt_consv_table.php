<div id="cnslt_consv_table" class="khusd_st list">

	<div>
		<?php if($iframe != 'y' && $iframe != 'Y'):?>
		<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_consv_table'].$ch_date.'&amp;iframe=Y'?>" target="_blank">프린트</a>
		<?php endif?>
	</div>
	
	<?php if(count($CHAIR_RESERV_AM_ARRAY) > 0):?>
	<table summary="종진실 OP 출석부 입니다.">
	<caption>
	<div class="headbox">
		<div class="table_title">
			<?php echo getDateFormat($ch_date,'m/d')?>(<?php echo getWeek(getDateFormat($ch_date, 'w'))?>) 오전 종진실 ST 진료 - OP
		</div>
	</div>
	</caption> 
	<colgroup> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	</colgroup> 

	<thead>
	<tr>
	<th scope="col" class="split">학 번</th>
	<th scope="col" class="split">이 름</th>
	<th scope="col" class="split">환자명</th>
	<th scope="col" class="split">술 식</th>
	<th scope="col" class="split">Chair No</th>
	<th scope="col" class="split">Selection</th>
	<th scope="col" class="split">Injection / <br />Rubber dam</th>
	<th scope="col" class="split">Prep</th>
	<th scope="col" class="split">Filling</th>
	<th scope="col" class="split">Polishing / <br />Finishing</th>
	<th scope="col" class="split">Finish</th>
	</tr>
	</thead>

	<tbody>
	
	<?php foreach($CHAIR_RESERV_AM_ARRAY as $CHAIR_NO => $ROW):?>
	<tr>
		<td><?php echo $ROW['st_id']?></td>
		<td><?php echo $ROW['st_name']?></td>
		<td><?php echo $ROW['pt_name']?></td>
		<td><?php echo $tx_plan_array[$ROW['tx_plan']]['name']?></td>
		<td><?php echo $ROW['chair_no']?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<?php endforeach?>
	
	</tbody>
	</table>
	<?php endif?>


	<?php if(count($CHAIR_RESERV_PM_ARRAY) > 0):?>
	<table summary="종진실 OP 출석부 입니다." class="pagebreak">
	<caption>
	<div class="headbox">
		<div class="table_title">
			<?php echo getDateFormat($ch_date,'m/d')?>(<?php echo getWeek(getDateFormat($ch_date, 'w'))?>) 오후 종진실 ST 진료 - OP
		</div>
	</div>
	</caption> 
	<colgroup> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	<col width="150"> 
	</colgroup> 

	<thead>
	<tr>
	<th scope="col" class="split">학 번</th>
	<th scope="col" class="split">이 름</th>
	<th scope="col" class="split">환자명</th>
	<th scope="col" class="split">술 식</th>
	<th scope="col" class="split">Chair No</th>
	<th scope="col" class="split">Selection</th>
	<th scope="col" class="split">Injection / <br />Rubber dam</th>
	<th scope="col" class="split">Prep</th>
	<th scope="col" class="split">Filling</th>
	<th scope="col" class="split">Polishing / <br />Finishing</th>
	<th scope="col" class="split">Finish</th>
	</tr>
	</thead>

	<tbody>
	
	<?php foreach($CHAIR_RESERV_PM_ARRAY as $CHAIR_NO => $ROW):?>
	<tr>
		<td><?php echo $ROW['st_id']?></td>
		<td><?php echo $ROW['st_name']?></td>
		<td><?php echo $ROW['pt_name']?></td>
		<td><?php echo $tx_plan_array[$ROW['tx_plan']]['name']?></td>
		<td><?php echo $ROW['chair_no']?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<?php endforeach?>
	
	</tbody>
	</table>
	<?php endif?>
	
	<?php if(count($CHAIR_RESERV_AM_ARRAY) <= 0 && count($CHAIR_RESERV_PM_ARRAY) <= 0):?>
	배정된 OP 가 하나도 없네요!
	<?php endif?>
</div>