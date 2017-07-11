<div id="medi_list" class="khusd_st list medi">

	<?php getWidget('khusd/semester_selector',array())?>
	
	<table summary="구강내과 점수표 입니다.">
	<caption>구강내과 점수표</caption> 
	<colgroup> 
	<col width="35">
	<col width="105"> 
	<col width="80"> 
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
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_id', $om)?>">이름</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'infra_tx', $om)?>">Infra</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'ultra_tx', $om)?>">Ultra</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'east_tx', $om)?>">EAST</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'tens_tx', $om)?>">TENS</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'ionto_tx', $om)?>">IONTO</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'tmd_tx', $om)?>">TMD</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'soft_tx', $om)?>">연조직</a></th>
	<th scope="col">수정일</th>
	<?php else:?>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
	<th scope="col" class="split">Infra</th>
	<th scope="col" class="split">Ultra</th>
	<th scope="col" class="split">EAST</th>
	<th scope="col" class="split">TENS</th>
	<th scope="col" class="split">IONTO</th>
	<th scope="col" class="split">TMD</th>
	<th scope="col" class="split">연조직</th>
	<th scope="col">수정일</th>
	<?php endif?>

	</tr>
	</thead>
	<tbody>


	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>



	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td><?php echo $idx++?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_id']?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_info']['name']?></td>

	<td><?php echo $SCORE['infra_tx']?></td>
	<td><?php echo $SCORE['ultra_tx']?></td>
	<td><?php echo $SCORE['east_tx']?></td>
	<td><?php echo $SCORE['tens_tx']?></td>
	<td><?php echo $SCORE['ionto_tx']?></td>
	<td><?php echo $SCORE['tmd_tx']?></td>
	<td><?php echo $SCORE['soft_tx']?></td>
	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>