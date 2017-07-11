<div id="ortho_list" class="khusd_st list ortho">

	<?php getWidget('khusd/semester_selector',array())?>
	
	<table summary="치주과 점수표 입니다.">
	<caption>교정과 점수표</caption> 
	<colgroup> 
	<col width="35">
	<col width="125"> 
	<col width="120"> 
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
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'obser', $om)?>">구환 횟수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'obser_pt', $om)?>">구환 환자</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'obser_score', $om)?>">구환합</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'follow', $om)?>">신환 횟수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'follow_pt', $om)?>">신환 환자</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'follow_score', $om)?>">신환합</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'report_score', $om)?>">레포트점수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'obser_follow_score', $om)?>">신+구점수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'total_score', $om)?>">총점</a></th>
	<th scope="col">수정일</th>
	<?php else:?>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
	<th scope="col" class="split">구환 횟수</th>
	<th scope="col" class="split">구환 환자</th>
	<th scope="col" class="split">구환합</th>
	<th scope="col" class="split">신환 횟수</th>
	<th scope="col" class="split">신환 환자</th>
	<th scope="col" class="split">신환합</th>
	<th scope="col" class="split">레포트점수</th>
	<th scope="col" class="split">신+구점수</th>
	<th scope="col" class="split">총점</th>
	<th scope="col">수정일</th>
	<?php endif?>
	</tr>
	</thead>
	<tbody>
	
	<tr>
	<td></td>
	<td></td>
	<td class="avg">평균</td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['obser'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['obser_pt'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['obser_score'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow_pt'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow_score'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['report_score'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['obser_follow_score'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['total_score'])?></td>
	<td></td>
	</tr>
	
	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>

	<?php if(is_array($SCORE_ARRAY[$my['id']])):?>
	<?php $SCORE = $SCORE_ARRAY[$my['id']]?>
	<tr class="mine">
	<td colspan="3">내점수</td>

	<td><?php echo $SCORE['obser']?></td>
	<td><?php echo $SCORE['obser_pt']?></td>
	<td class="category1"><?php echo $SCORE['obser_score']?></td>
	<td><?php echo $SCORE['follow']?></td>
	<td><?php echo $SCORE['follow_pt']?></td>
	<td class="category1"><?php echo $SCORE['follow_score']?></td>
	<td class="category1"><?php echo $SCORE['report_score']?></td>
	<td class="category4"><?php echo $SCORE['obser_follow_score']?></td>
	<td class="category4"><?php echo $SCORE['total_score']?></td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endif?>


	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td><?php echo $idx++?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_id']?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_info']['name']?></td>

	<td><?php echo $SCORE['obser']?></td>
	<td><?php echo $SCORE['obser_pt']?></td>
	<td class="category1"><?php echo $SCORE['obser_score']?></td>
	<td><?php echo $SCORE['follow']?></td>
	<td><?php echo $SCORE['follow_pt']?></td>
	<td class="category1"><?php echo $SCORE['follow_score']?></td>
	<td class="category1"><?php echo $SCORE['report_score']?></td>
	<td class="category4"><?php echo $SCORE['obser_follow_score']?></td>
	<td class="category4"><?php echo $SCORE['total_score']?></td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>