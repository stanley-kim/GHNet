<div id="cnslt_pros_table" class="khusd_st list">

	<div>
		<?php if($iframe != 'y' && $iframe != 'Y'):?>
		<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_pros_table'].$ch_date.'&amp;iframe=Y'?>" target="_blank">프린트</a>
		<?php endif?>
	</div>
	
	<?php if(count($CHAIR_RESERV_AM_ARRAY) > 0):?>
	<table summary="종진실 보철과 ST 출석부 입니다.">
	<caption>
	<div class="headbox">
		<div class="table_title">
			종진실 ST 보철과 일정
		</div>
		<div class="table_subtitle">
			-<?php echo getDateFormat($ch_date,'n월 j일')?> <?php echo getWeek(getDateFormat($ch_date, 'w'))?>요일 09:00~12:00-
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
	</colgroup> 

	<thead>
	<tr>
	<th scope="col" class="split">체어</th>
	<th scope="col" class="split">이름</th>
	<th scope="col" class="split">환자</th>
	<th scope="col" class="split">단계</th>
        <th scope="col" class="split">치식</th>
	<th scope="col" class="split mid_col">친환</th>
	<th colspan="3" scope="col" class="split">Last tx. (일자, 내용, 인스트럭터)</th>
	</tr>
	</thead>

	<tbody>
	
	<?php foreach($CHAIR_RESERV_AM_ARRAY as $CHAIR_NO => $ROW):?>
	<tr>
		<td><?php echo $ROW['chair_no']?></td>
		<td><?php echo $ROW['st_name']?></td>
                <td><?php echo $ROW['pt_name']?><br><?php echo $ROW['pt_id'] ?></td>

		<td><?php echo $tx_plan_array[$ROW['tx_plan']]['name']?></td>
                <td><?php echo $ROW['dental_formula']?></td>
		<td class="mid_col"><?php echo $ROW['pt_info']['friendly'] == 'y' ? 'O' : 'X'?></td>
		<td><?php echo getDateFormat($ROW['pt_info']['last_tx_date'],'y/n/j')?></td>
		<td><?php echo $tx_plan_array[$ROW['pt_info']['last_tx']]['name']?></td>
		<td><?php echo $d['khusd_st_cnslt_room_manager']['pros']['inst']['list'][$ROW['pt_info']['last_inst']]['name']?></td>
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
			종진실 ST 보철과 일정
		</div>
		<div class="table_subtitle">
			-<?php echo getDateFormat($ch_date,'n월 j일')?> <?php echo getWeek(getDateFormat($ch_date, 'w'))?>요일 13:30~17:30-
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
	</colgroup> 

	<thead>
	<tr>
	<th scope="col" class="split">체어</th>
	<th scope="col" class="split">이름</th>
	<th scope="col" class="split">환자</th>
	<th scope="col" class="split">단계</th>
        <th scope="col" class="split">치식</th>
	<th scope="col" class="split mid_col">친환</th>
	<th colspan="3" scope="col" class="split">Last tx. (일자, 내용, 인스트럭터)</th>
	</tr>
	</thead>

	<tbody>
	
	<?php foreach($CHAIR_RESERV_PM_ARRAY as $CHAIR_NO => $ROW):?>
	<tr>
		<td><?php echo $ROW['chair_no']?></td>
		<td><?php echo $ROW['st_name']?></td>
                <td><?php echo $ROW['pt_name']?><br><?php echo $ROW['pt_id'] ?></td>

		<td><?php echo $tx_plan_array[$ROW['tx_plan']]['name']?></td>
                <td><?php echo $ROW['dental_formula']?></td>
		<td class="mid_col"><?php echo $ROW['pt_info']['friendly'] == 'y' ? 'O' : 'X'?></td>
		<td><?php echo getDateFormat($ROW['pt_info']['last_tx_date'],'y/n/j')?></td>
		<td><?php echo $tx_plan_array[$ROW['pt_info']['last_tx']]['name']?></td>
		<td><?php echo $d['khusd_st_cnslt_room_manager']['pros']['inst']['list'][$ROW['pt_info']['last_inst']]['name']?></td>
	</tr>
	<?php endforeach?>
	
	</tbody>
	</table>
	<?php endif?>
	
	<?php if(count($CHAIR_RESERV_AM_ARRAY) <= 0 && count($CHAIR_RESERV_PM_ARRAY) <= 0):?>
	배정된 OP 가 하나도 없네요!
	<?php endif?>
</div>
