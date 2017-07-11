<div id="consv_list" class="khusd_st list consv">

	<table summary="보존과 ST 점수표 입니다.">
	<caption>보존과 ST 점수표</caption> 
	<colgroup> 
	<col width="35">
	<col width="125"> 
	<col width="120"> 
	<col width="50"> 
	
	<?php foreach($d['khusd_st_consv']['st_stage'] as $value):?>
	<col width="40"> 
	<?php endforeach?>
	
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
	
	<?php foreach($d['khusd_st_consv']['st_stage'] as $key => $text):?>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, $key, $om)?>"><?php echo $text?></th>
	<?php endforeach?>
	
	<th colspan="2" scope="col" class="split"><a href="<?php echo getSortingLink($c, 'endo_score', $om)?>">Endo점수</th>
	<?php else:?>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
	<th scope="col" class="split">Case</th>

	<?php foreach($d['khusd_st_consv']['st_stage'] as $key => $text):?>
	<th scope="col" class="split"><?php echo $text?></th>
	<?php endforeach?>
	<th colspan="2" scope="col" class="split">Endo점수</th>
	<?php endif?>
	<th rowspan="2" scope="col">수정일</th>
	</tr>
	</thead>
	<tbody>
	
	<tr>
		<td rowspan="2"></td>
		<td rowspan="2"></td>
		<td rowspan="2" class="avg">누적인원 / 평균점수</th>
		<td class="avg">Case 1</td>
		
		<?php foreach($d['khusd_st_consv']['st_stage'] as $key => $text):?>
		<td class="avg"><?php echo sprintf("%1.0f",$SUM['st_endo_1_sum_'.$key])?></td>
		<?php endforeach?>
		
		<td class="avg"><?php echo sprintf("%1.1f",$SUM['st_endo_1st_point'])?></td>
		
		<td rowspan="2" class="avg"><?php echo sprintf("%1.1f",$SUM['endo_score'])?></td>
		<td></td>
	</tr>
	
	<tr>
		<td class="avg">Case 2</td>
		<?php foreach($d['khusd_st_consv']['st_stage'] as $key => $text):?>
		<td class="avg"><?php echo sprintf("%1.0f",$SUM['st_endo_2_sum_'.$key])?></td>
		<?php endforeach?>

		<td class="avg"><?php echo sprintf("%1.1f",$SUM['st_endo_2nd_point'])?></td>
	</tr>

	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>

	<?php if(is_array($SCORE_ARRAY[$my['id']])):?>
	<?php $SCORE = $SCORE_ARRAY[$my['id']]?>
	<tr class="mine">
	<td rowspan="2" colspan="3">내점수</td>

	<td class="category1">Case 1</td>
	<td colspan="<?php echo count($d['khusd_st_consv']['st_stage'])?>" class="category1">
		<?php
			if($SCORE['st_endo_1'] == '')	$st_endo_1_progress = 0;
			else
			{
				$idx = 1;
				foreach($d['khusd_st_consv']['st_stage'] as $key => $text)
				{
					if($SCORE['st_endo_1'] == $key)
					{
						$st_endo_1_progress = $idx;
						break;
					}
					$idx++;
				}
			}
		?>
		<progress value="<?php echo $st_endo_1_progress?>" max="<?php echo count($d['khusd_st_consv']['st_stage'])?>" />
	</td>

	<td class="category3"><?php echo $SCORE['st_endo_1st_point']?></td>

	<td rowspan="2" class="category4"><?php echo $SCORE['endo_score']?></td>

	<td rowspan="2"><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td class="category2">Case 2</td>
	<td colspan="<?php echo count($d['khusd_st_consv']['st_stage'])?>" class="category2">
		<?php
			if($SCORE['st_endo_2'] == '')	$st_endo_2_progress = 0;
			else
			{
				$idx = 1;
				foreach($d['khusd_st_consv']['st_stage'] as $key => $text)
				{
					if($SCORE['st_endo_2'] == $key)
					{
						$st_endo_2_progress = $idx;
						break;
					}
					$idx++;
				}
			}
		?>
		<progress value="<?php echo $st_endo_2_progress?>" max="<?php echo count($d['khusd_st_consv']['st_stage'])?>" />
	</td>

	<td class="category3"><?php echo $SCORE['st_endo_2nd_point']?></td>
	</tr>
	<?php endif?>
	
	
	
	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td rowspan="2"><?php echo $idx++?></td>
	<td rowspan="2" class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_id']?></td>
	<td rowspan="2" class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_info']['name']?></td>

	<td class="category1">Case 1</td>
	<td colspan="<?php echo count($d['khusd_st_consv']['st_stage'])?>" class="category1">
		<?php
			if($SCORE['st_endo_1'] == '')	$st_endo_1_progress = 0;
			else
			{
				$idx = 1;
				foreach($d['khusd_st_consv']['st_stage'] as $key => $text)
				{
					if($SCORE['st_endo_1'] == $key)
					{
						$st_endo_1_progress = $idx;
						break;
					}
					$idx++;
				}
			}
		?>
		<progress value="<?php echo $st_endo_1_progress?>" max="<?php echo count($d['khusd_st_consv']['st_stage'])?>" />
	</td>

	<td class="category3"><?php echo $SCORE['st_endo_1st_point']?></td>

	<td rowspan="2" class="category4"><?php echo $SCORE['endo_score']?></td>

	<td rowspan="2"><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td class="category2">Case 2</td>
	<td colspan="<?php echo count($d['khusd_st_consv']['st_stage'])?>" class="category2">
		<?php
			if($SCORE['st_endo_2'] == '')	$st_endo_2_progress = 0;
			else
			{
				$idx = 1;
				foreach($d['khusd_st_consv']['st_stage'] as $key => $text)
				{
					if($SCORE['st_endo_2'] == $key)
					{
						$st_endo_2_progress = $idx;
						break;
					}
					$idx++;
				}
			}
		?>
		<progress value="<?php echo $st_endo_2_progress?>" max="<?php echo count($d['khusd_st_consv']['st_stage'])?>" />
	</td>

	<td class="category3"><?php echo $SCORE['st_endo_2nd_point']?></td>
	</tr>

	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>