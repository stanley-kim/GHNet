<div id="radio_list" class="khusd_st list radio">

	<?php getWidget('khusd/semester_selector',array())?>

	<table summary="영상과 점수표 입니다." style="width:100%;">
	<caption>영상과 점수표</caption> 
	<colgroup> 
	<col width="35">
	<col width="105"> 
	<col width="80"> 
<!--	<col width="60"> 
	<col width="60">--> 
	<col width="60">
	<col width="60"> 
	<col width="60"> 
	<col width="60"> 
	<col width="60"> 
	<col width="150"> 
	</colgroup> 
	<thead>
	<tr>
	<?php if($MANAGER):?>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_id', $om)?>">학번</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'name', $om)?>">이름</a></th>
<!--	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'penalty_taking', $om)?>">Penalty Taking</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'penalty_require', $om)?>">Penalty Require</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'is_penalty_complete', $om)?>">Penalty 완료여부</a></th>-->
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'taking', $om)?>">Taking</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'taking_pt', $om)?>">환자수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'follow', $om)?>">판독옵져</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'follow', $om)?>">촬영옵져</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'panorama', $om)?>">파노라마</a></th>
	<th scope="col">수정일</th>
	<?php else:?>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
<!--	<th scope="col" class="split">Penalty Taking</th>
	<th scope="col" class="split">Penalty Require</th>
	<th scope="col" class="split">Penalty 완료여부</th>-->
	<th scope="col" class="split">Taking</th>
	<th scope="col" class="split">환자수</th>
	<th scope="col" class="split">판독옵져</th>
	<th scope="col" class="split">촬영옵져</th>
	<th scope="col" class="split">파노라마</th>
	<th scope="col">수정일</th>
	<?php endif?>
	</tr>
	</thead>
	<tbody>

	<tr>
	<td></td>
	<td></td>
	<td class="avg">평균</td>
<!--	<td class="avg"><?php echo sprintf("%1.1f",$AVG['penalty_taking'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['penalty_require'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['is_penalty_complete'])?></td>-->
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['taking'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['taking_pt'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['obser_decoding'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['obser_filming'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['panorama'])?></td>
	<td></td>
	</tr>

	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>

	<?php if(is_array($SCORE_ARRAY[$my['id']])):?>
	<?php $SCORE = $SCORE_ARRAY[$my['id']]?>
	<tr class="mine">
	<td colspan="3">내점수</td>

<!--	<td><?php echo $SCORE['penalty_taking']?></td>
	<td><?php echo $SCORE['penalty_require']?></td>
	<td><?php echo ($SCORE['is_penalty_complete'] == 1 ? '완' : '')?></td>-->
	<td><?php echo $SCORE['taking']?></td>
	<td><?php echo $SCORE['taking_pt']?></td>
	<td><?php echo $SCORE['obser_decoding']?></td>
	<td><?php echo $SCORE['obser_filming']?></td>
	<td><?php echo $SCORE['panorama']?></td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endif?>
	

	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td><?php echo $idx++?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_id']?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_info']['name']?></td>

<!--	<td><?php echo $SCORE['penalty_taking']?></td>
	<td><?php echo $SCORE['penalty_require']?></td>
	<td><?php echo ($SCORE['is_penalty_complete'] == 1 ? '완' : '')?></td>-->
	<td><?php echo $SCORE['taking']?></td>
	<td><?php echo $SCORE['taking_pt']?></td>
	<td><?php echo $SCORE['obser_decoding']?></td>
	<td><?php echo $SCORE['obser_filming']?></td>
	<td><?php echo $SCORE['panorama']?></td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>
