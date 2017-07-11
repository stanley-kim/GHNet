<div id="ortho_list" class="khusd_st list ortho">

	<?php getWidget('khusd/semester_selector',array())?>
	
	<table summary="교정과 점수표 입니다.">
	<caption>교정과 점수표</caption> 
	<colgroup> 
	<col width="35">
	<col width="125"> 
	<col width="120"> 
	<col width="40"> <!--follow old cnt-->
	<col width="40"> <!--follow old obs cnt-->
	<col width="40"> <!--follow old score-->
	<col width="40"> <!--follow new cnt-->
	<col width="40"> <!--follow new obs cnt-->
	<col width="40"> <!--follow new score-->
	<col width="40"> <!--simple obs count-->
	<col width="40"> <!--simple obs score-->
	<col width="40"> <!--appliance score-->
	<col width="40"> <!--total score-->
	<col width="150"> 
	</colgroup> 
	<thead>
	<tr>
	<?php if($MANAGER):?>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_id', $om)?>">학번</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'name', $om)?>">이름</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'follow_old_cnt', $om)?>">구환 명수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'follow_old_obs_cnt', $om)?>">구환 횟수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'follow_old', $om)?>">유효 구환 점수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'follow_new_cnt', $om)?>">신환 명수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'follow_new_obs_cnt', $om)?>">신환 횟수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'follow_new', $om)?>">유효 신환 점수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'obser_cnt', $om)?>">옵져 횟수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'obser', $om)?>">유효 옵져 점수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'appliance_score', $om)?>">기공 점수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'total_score', $om)?>">총점</a></th>
	<th scope="col">수정일</th>
	<?php else:?>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
	<th scope="col" class="split">구환 명수</th>
	<th scope="col" class="split">구환 횟수</th>
	<th scope="col" class="split">유효 구환 점수</th>
	<th scope="col" class="split">신환 명수</th>
	<th scope="col" class="split">신환 횟수</th>
	<th scope="col" class="split">유효 신환 점수</th>
	<th scope="col" class="split">옵져 횟수</th>
	<th scope="col" class="split">유효 옵져 점수</th>
	<th scope="col" class="split">기공 점수</th>
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
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow_old_cnt'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow_old_obs_cnt'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow_old'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow_new_cnt'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow_new_obs_cnt'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow_new'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['obser_cnt'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['obser'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['appliance_score'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['total_score'])?></td>
	<td></td>
	</tr>
	
	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>

	<?php if(is_array($SCORE_ARRAY[$my['id']])):?>
	<?php $SCORE = $SCORE_ARRAY[$my['id']]?>
	<tr class="mine">
	<td colspan="3">내점수</td>
	
	<td><?php echo $SCORE['follow_old_cnt']?></td>
	<td><?php echo $SCORE['follow_old_obs_cnt']?></td>
	<td><?php echo $SCORE['follow_old']?></td>
	<td><?php echo $SCORE['follow_new_cnt']?></td>
	<td><?php echo $SCORE['follow_new_obs_cnt']?></td>
	<td><?php echo $SCORE['follow_new']?></td>
	<td><?php echo $SCORE['obser_cnt']?></td>
	<td><?php echo $SCORE['obser']?></td>
	<td><?php echo $SCORE['appliance_score']?></td>
	<td><?php echo $SCORE['total_score']?></td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endif?>


	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td><?php echo $idx++?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_id']?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_info']['name']?></td>

	<td><?php echo $SCORE['follow_old_cnt']?></td>
	<td><?php echo $SCORE['follow_old_obs_cnt']?></td>
	<td><?php echo $SCORE['follow_old']?></td>
	<td><?php echo $SCORE['follow_new_cnt']?></td>
	<td><?php echo $SCORE['follow_new_obs_cnt']?></td>
	<td><?php echo $SCORE['follow_new']?></td>
	<td><?php echo $SCORE['obser_cnt']?></td>
	<td><?php echo $SCORE['obser']?></td>
	<td><?php echo $SCORE['appliance_score']?></td>
	<td><?php echo $SCORE['total_score']?></td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>