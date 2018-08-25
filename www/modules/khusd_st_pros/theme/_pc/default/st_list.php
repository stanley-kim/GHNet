<div id="pros_list" class="khusd_st list pros">

	<table summary="보철과 ST 점수표 입니다.">
	<caption>보철과 ST 점수표</caption> 
	<colgroup> 
	<col width="35">
	<col width="125"> 
	<col width="120"> 
	<col width="50"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="150"> 
	</colgroup> 
	<thead>
	<tr>
	<?php if($MANAGER):?>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_id', $om)?>">학번</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'name', $om)?>">이름</a></th>
	<th scope="col" class="split">Case</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'case_selection', $om)?>">Case Selec</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'snap_impression', $om)?>">Snap Imp</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'initial_prep', $om)?>">Initial Prep.</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'final_prep', $om)?>">Final Prep.</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'metal_adap', $om)?>">Metal Adap.</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'initial_setting', $om)?>">Initial Setting</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'final_setting', $om)?>">Final Setting</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'check', $om)?>">Check</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_score', $om)?>">점수</th>
	<?php else:?>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
	<th scope="col" class="split">Case</th>
	<th scope="col" class="split">Case Selec</th>
	<th scope="col" class="split">Snap Imp</th>
	<th scope="col" class="split">Initial Prep.</th>
	<th scope="col" class="split">Final Prep.</th>
	<th scope="col" class="split">Metal Adap.</th>
	<th scope="col" class="split">Initial Setting</th>
	<th scope="col" class="split">Final Setting</th>
	<th scope="col" class="split">Check</th>
	<th scope="col" class="split">점수</th>
	<?php endif?>
	<th rowspan="2" scope="col">수정일</th>
	</tr>
	</thead>
	<tbody>
	
	<tr>
		<td rowspan="3"></td>
		<td rowspan="3"></td>
		<td rowspan="3" class="avg">누적인원</th>
		<td class="avg">Case 1</td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_1_avg_case_selection'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_1_avg_snap_impression'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_1_avg_initial_prep'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_1_avg_final_prep'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_1_avg_metal_adap'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_1_avg_initial_setting'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_1_avg_final_setting'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_1_avg_check'])?></td>
		<td rowspan="3" class="avg"><?php echo sprintf("%1.1f",$AVG['st_score'])?></td>
		<td></td>
	</tr>
	
	<tr>
		<td class="avg">Case 2</td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_2_avg_case_selection'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_2_avg_snap_impression'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_2_avg_initial_prep'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_2_avg_final_prep'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_2_avg_metal_adap'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_2_avg_initial_setting'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_2_avg_final_setting'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_2_avg_check'])?></td>
	</tr>

	<tr>
		<td class="avg">Case 3</td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_3_avg_case_selection'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_3_avg_snap_impression'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_3_avg_initial_prep'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_3_avg_final_prep'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_3_avg_metal_adap'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_3_avg_initial_setting'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_3_avg_final_setting'])?></td>
		<td class="avg"><?php echo sprintf("%1.0f",$AVG['st_case_3_avg_check'])?></td>
	</tr>

	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>
	
	<?php if(is_array($SCORE_ARRAY[$my['id']])):?>
	<?php $SCORE = $SCORE_ARRAY[$my['id']]?>
	<tr class="mine">
	<td rowspan="3" colspan="3">내점수</td>

	<td class="category1">Case 1</td>
	<td colspan="8" class="category1">
		<?php if($SCORE['st_case_1'] == ''):?>
			<?php $st_case_1_progress = 0;?>
		<?php elseif($SCORE['st_case_1'] == 'case_selection'):?>
			<?php $st_case_1_progress = 10;?>
		<?php elseif($SCORE['st_case_1'] == 'snap_impression'):?>
			<?php $st_case_1_progress = 20;?>
		<?php elseif($SCORE['st_case_1'] == 'initial_prep'):?>
			<?php $st_case_1_progress = 30;?>
		<?php elseif($SCORE['st_case_1'] == 'final_prep'):?>
			<?php $st_case_1_progress = 40;?>
		<?php elseif($SCORE['st_case_1'] == 'metal_adap'):?>
			<?php $st_case_1_progress = 50;?>
		<?php elseif($SCORE['st_case_1'] == 'initial_setting'):?>
			<?php $st_case_1_progress = 60;?>
		<?php elseif($SCORE['st_case_1'] == 'final_setting'):?>
			<?php $st_case_1_progress = 70;?>
		<?php elseif($SCORE['st_case_1'] == 'check'):?>
			<?php $st_case_1_progress = 80;?>
		<?php endif?>
		<progress value="<?php echo $st_case_1_progress?>" max="80" />
	</td>


	<td rowspan="3" class="category4"><?php echo $SCORE['st_score']?></td>

	<td rowspan="3"><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td class="category2">Case 2</td>
	<td colspan="8" class="category2">
		<?php if($SCORE['st_case_2'] == ''):?>
			<?php $st_case_2_progress = 0;?>
		<?php elseif($SCORE['st_case_2'] == 'case_selection'):?>
			<?php $st_case_2_progress = 10;?>
		<?php elseif($SCORE['st_case_2'] == 'snap_impression'):?>
			<?php $st_case_2_progress = 20;?>
		<?php elseif($SCORE['st_case_2'] == 'initial_prep'):?>
			<?php $st_case_2_progress = 30;?>
		<?php elseif($SCORE['st_case_2'] == 'final_prep'):?>
			<?php $st_case_2_progress = 40;?>
		<?php elseif($SCORE['st_case_2'] == 'metal_adap'):?>
			<?php $st_case_2_progress = 50;?>
		<?php elseif($SCORE['st_case_2'] == 'initial_setting'):?>
			<?php $st_case_2_progress = 60;?>
		<?php elseif($SCORE['st_case_2'] == 'final_setting'):?>
			<?php $st_case_2_progress = 70;?>
		<?php elseif($SCORE['st_case_2'] == 'check'):?>
			<?php $st_case_2_progress = 80;?>
		<?php endif?>
		<progress value="<?php echo $st_case_2_progress?>" max="80" />
	</td>
	</tr>

	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td class="category3">Case 3</td>
	<td colspan="8" class="category3">
		<?php if($SCORE['st_case_3'] == ''):?>
			<?php $st_case_3_progress = 0;?>
		<?php elseif($SCORE['st_case_3'] == 'case_selection'):?>
			<?php $st_case_3_progress = 10;?>
		<?php elseif($SCORE['st_case_3'] == 'snap_impression'):?>
			<?php $st_case_3_progress = 20;?>
		<?php elseif($SCORE['st_case_3'] == 'initial_prep'):?>
			<?php $st_case_3_progress = 30;?>
		<?php elseif($SCORE['st_case_3'] == 'final_prep'):?>
			<?php $st_case_3_progress = 40;?>
		<?php elseif($SCORE['st_case_3'] == 'metal_adap'):?>
			<?php $st_case_3_progress = 50;?>
		<?php elseif($SCORE['st_case_3'] == 'initial_setting'):?>
			<?php $st_case_3_progress = 60;?>
		<?php elseif($SCORE['st_case_3'] == 'final_setting'):?>
			<?php $st_case_3_progress = 70;?>
		<?php elseif($SCORE['st_case_3'] == 'check'):?>
			<?php $st_case_3_progress = 80;?>
		<?php endif?>
		<progress value="<?php echo $st_case_3_progress?>" max="80" />
	</td>
	</tr>
	<?php endif?>
	
	
	
	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td rowspan="3"><?php echo $idx++?></td>
	<td rowspan="3" class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_id']?></td>
	<td rowspan="3" class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_info']['name']?></td>

	<td class="category1">Case 1</td>
	<td colspan="8" class="category1">
		<?php if($SCORE['st_case_1'] == ''):?>
			<?php $st_case_1_progress = 0;?>
		<?php elseif($SCORE['st_case_1'] == 'case_selection'):?>
			<?php $st_case_1_progress = 10;?>
		<?php elseif($SCORE['st_case_1'] == 'snap_impression'):?>
			<?php $st_case_1_progress = 20;?>
		<?php elseif($SCORE['st_case_1'] == 'initial_prep'):?>
			<?php $st_case_1_progress = 30;?>
		<?php elseif($SCORE['st_case_1'] == 'final_prep'):?>
			<?php $st_case_1_progress = 40;?>
		<?php elseif($SCORE['st_case_1'] == 'metal_adap'):?>
			<?php $st_case_1_progress = 50;?>
		<?php elseif($SCORE['st_case_1'] == 'initial_setting'):?>
			<?php $st_case_1_progress = 60;?>
		<?php elseif($SCORE['st_case_1'] == 'final_setting'):?>
			<?php $st_case_1_progress = 70;?>
		<?php elseif($SCORE['st_case_1'] == 'check'):?>
			<?php $st_case_1_progress = 80;?>
		<?php endif?>
		<progress value="<?php echo $st_case_1_progress?>" max="80" />
	</td>


	<td rowspan="3" class="category4"><?php echo $SCORE['st_score']?></td>

	<td rowspan="3"><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td class="category2">Case 2</td>
	<td colspan="8" class="category2">
		<?php if($SCORE['st_case_2'] == ''):?>
			<?php $st_case_2_progress = 0;?>
		<?php elseif($SCORE['st_case_2'] == 'case_selection'):?>
			<?php $st_case_2_progress = 10;?>
		<?php elseif($SCORE['st_case_2'] == 'snap_impression'):?>
			<?php $st_case_2_progress = 20;?>
		<?php elseif($SCORE['st_case_2'] == 'initial_prep'):?>
			<?php $st_case_2_progress = 30;?>
		<?php elseif($SCORE['st_case_2'] == 'final_prep'):?>
			<?php $st_case_2_progress = 40;?>
		<?php elseif($SCORE['st_case_2'] == 'metal_adap'):?>
			<?php $st_case_2_progress = 50;?>
		<?php elseif($SCORE['st_case_2'] == 'initial_setting'):?>
			<?php $st_case_2_progress = 60;?>
		<?php elseif($SCORE['st_case_2'] == 'final_setting'):?>
			<?php $st_case_2_progress = 70;?>
		<?php elseif($SCORE['st_case_2'] == 'check'):?>
			<?php $st_case_2_progress = 80;?>
		<?php endif?>
		<progress value="<?php echo $st_case_2_progress?>" max="80" />
	</td>
	</tr>

	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td class="category3">Case 3</td>
	<td colspan="8" class="category3">
		<?php if($SCORE['st_case_3'] == ''):?>
			<?php $st_case_3_progress = 0;?>
		<?php elseif($SCORE['st_case_3'] == 'case_selection'):?>
			<?php $st_case_3_progress = 10;?>
		<?php elseif($SCORE['st_case_3'] == 'snap_impression'):?>
			<?php $st_case_3_progress = 20;?>
		<?php elseif($SCORE['st_case_3'] == 'initial_prep'):?>
			<?php $st_case_3_progress = 30;?>
		<?php elseif($SCORE['st_case_3'] == 'final_prep'):?>
			<?php $st_case_3_progress = 40;?>
		<?php elseif($SCORE['st_case_3'] == 'metal_adap'):?>
			<?php $st_case_3_progress = 50;?>
		<?php elseif($SCORE['st_case_3'] == 'initial_setting'):?>
			<?php $st_case_3_progress = 60;?>
		<?php elseif($SCORE['st_case_3'] == 'final_setting'):?>
			<?php $st_case_3_progress = 70;?>
		<?php elseif($SCORE['st_case_3'] == 'check'):?>
			<?php $st_case_3_progress = 80;?>
		<?php endif?>
		<progress value="<?php echo $st_case_3_progress?>" max="80" />
	</td>
	</tr>

	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>
