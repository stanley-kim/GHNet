<div id="perio_list" class="khusd_st list perio">

	<?php getWidget('khusd/semester_selector',array())?>
	
	<table summary="치주과 점수표 입니다.">
	<caption>치주과 큐렛 현황표</caption> 
	<colgroup> 
	<col width="35">
	<col width="125"> 
	<col width="120"> 
	<col width="100"> 
	<col width="90"> 
	<col width="100"> 
	<col width="90"> 
	<col width="150"> 
	</colgroup> 
	<thead>
	<tr>
	<?php if($MANAGER):?>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_stcu'], 'st_id', $om, $order == 'st_id')?>">학번</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_stcu'], 'name', $om, $order == 'name')?>">이름</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_stcu'], 'stcu_selected', $om, $order == 'stcu_selected')?>">Cu Select 총 수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_stcu'], 'stcu', $om, $order == 'stcu')?>">Cu 완료 수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_stcu'], 'stcu_todo', $om, $order == 'stcu_todo')?>">앞으로 할 Cu 수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_stcu'], 'stcu_remain', $om, $order == 'stcu_remain')?>">남는 Cu 수</a></th>
	<th scope="col" rowspan=2>수정일</th>
	<?php else:?>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
	<th scope="col" class="split">Cu Select 총 수</th>
	<th scope="col" class="split">Cu 완료 수</th>
	<th scope="col" class="split">앞으로 할 Cu 수</th>
	<th scope="col" class="split">남는 Cu 수</th>
	<th scope="col" rowspan=2>수정일</th>
	<?php endif?>
	</tr>
	</thead>
	<tbody>
	
	<tr>
		<td></td>
		<td></td>
		<td class="avg">평균</td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['stcu_selected'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['stcu'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['stcu_todo'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['stcu_remain'])?></td>
		<td></td>
	</tr>
	
	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>

	<?php if(is_array($SCORE_ARRAY[$my['id']])):?>
	<?php $SCORE = $SCORE_ARRAY[$my['id']]?>
	<tr class="mine">
	<td colspan="3">내점수</td>
	
	<td><?php echo $SCORE['stcu_selected']?></td>
	<td class="category1"><?php echo $SCORE['stcu']?></td>
	<td><?php echo $SCORE['stcu_todo']?></td>
	<td class="category1"><?php echo $SCORE['stcu_remain']?></td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endif?>
	
	<?php if(is_array($GOAL_SCORE)):?>
	<?php $SCORE = $GOAL_SCORE?>
	<tr class="goal">
	<td colspan="3">목표점수</td>
	
	<td><?php echo $SCORE['stcu_selected']?></td>
	<td class="category1"><?php echo $SCORE['stcu']?></td>
	<td><?php echo $SCORE['stcu_todo']?></td>
	<td class="category1"><?php echo $SCORE['stcu_remain']?></td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endif?>
			
	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td><?php echo $idx++?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_id']?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_info']['name']?></td>
	
	<td><?php echo $SCORE['stcu_selected']?></td>
	<td class="category1"><?php echo $SCORE['stcu']?></td>
	<td><?php echo $SCORE['stcu_todo']?></td>
	<td class="category1"><?php echo $SCORE['stcu_remain']?></td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>