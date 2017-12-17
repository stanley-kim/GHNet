<div id="pedia_list" class="khusd_st list pedia">

	<?php getWidget('khusd/semester_selector',array())?>
	
	<table summary="소아치과 점수표 입니다.">
	<caption><font size="4">소아치과 점수표</font></caption> 
<?/* 
 	<caption><font size="2">( ST점수= ST추가A*(<?php echo $d['khusd_st_pedia']['score']['st_add_a'] ?>)+ST추가B*(<?php echo $d['khusd_st_pedia']['score']['st_add_b'] ?>)+추가C*(<?php echo $d['khusd_st_pedia']['score']['st_add_c'] ?>)+ST어시*(<?php echo $d['khusd_st_pedia']['score']['st_assist'] ?>) )</font></caption>  
 */ ?> 
	<colgroup> 
	<col width="35">
	<col width="80"> 
	<col width="60"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 

<!--	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50">--> 
	<col width="50">
	<col width="150"> 
	</colgroup> 
	<thead>
	<tr>
	<?php if($MANAGER):?>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_id', $om)?>">학번</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'name', $om)?>">이름</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'prof_fix_am', $om)?>">교픽오전</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'prof_fix_pm', $om)?>">교픽오후</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'follow', $om)?>">교픽+Follow 점수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'obser', $om)?>">Obser</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'ga', $om)?>">G/A</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'sedation_rp', $om)?>">Sedation 레폿</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'clinical_rp', $om)?>">Clinical 레폿</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'charting_obser', $om)?>">Charting Obser</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'obser_score', $om)?>">Obser 점수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_pt', $om)?>">ST 환자수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_only_score', $om)?>">ST 술식 점수(point에 가중치까지 포함)</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_assist', $om)?>">ST assist(회)</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_score', $om)?>">ST 점수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'fix', $om)?>">FIX</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'total_score', $om)?>">Obser+ST점수</a></th>
<!--	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'obser_real_score', $om)?>">Obser 점수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_real_score', $om)?>">ST 점수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'total_score', $om)?>">초ㅇ점수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'obser_plus_st_score', $om)?>">Limit 점수</a></th>-->
	<th scope="col">수정일</th>
	<?php else:?>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
	<th scope="col" class="split">교픽오전</th>
	<th scope="col" class="split">교픽오후</th>
	<th scope="col" class="split">교픽+Follow 점수</th>
	<th scope="col" class="split">Obser</th>
	<th scope="col" class="split">G/A</th>
	<th scope="col" class="split">Sedation Report</th>
	<th scope="col" class="split">Clinial Report</th>
	<th scope="col" class="split">Charting Obser</th>
	<th scope="col" class="split">Obser 점수</th>
	<th scope="col" class="split">ST 환자수</th>
	<th scope="col" class="split">ST 술식 점수</th>
	<th scope="col" class="split">ST assist(회)</th>
	<th scope="col" class="split">ST 점수</th>
	<th scope="col" class="split">FIX</th>
	<th scope="col" class="split">Obser+ST점수</th>
<!--	<th scope="col" class="split">Obser 점수</th>
	<th scope="col" class="split">ST 점수</th>
	<th scope="col" class="split">초ㅇ 점수</th>
	<th scope="col" class="split">Limit 점수</th>-->
	<th scope="col">수정일</th>
	<?php endif?>
	</tr>
	</thead>
	<tbody>

	<tr>
	<td></td>
	<td></td>
	<td class="avg">평균</td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['prof_fix_am'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['prof_fix_pm'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['obser'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['ga'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['sedation_rp'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['clinical_rp'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['charting_obser'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['obser_score'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['st_pt'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['st_only_score'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['st_assist'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['st_score'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['fix'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['total_score'])?></td>
<!--	<td class="avg"><?php echo sprintf("%1.1f",$AVG['obser_real_score'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['st_real_score'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['total_score'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['obser_plus_st_score'])?></td>-->
	<td></td>
	</tr>

	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>

	<?php if(is_array($SCORE_ARRAY[$my['id']])):?>
	<?php $SCORE = $SCORE_ARRAY[$my['id']]?>
	<tr class="mine">
	<td colspan="3">내점수</td>

	<td><?php echo $SCORE['prof_fix_am']?></td>
	<td><?php echo $SCORE['prof_fix_pm']?></td>
	<td class="category1"><?php echo $SCORE['follow']?></td>
	<td class="category2"><?php echo $SCORE['obser']?></td>
	<td><?php echo $SCORE['ga']?></td>
	<td><?php echo $SCORE['sedation_rp']?></td>
	<td><?php echo $SCORE['clinical_rp']?></td>
	<td><?php echo $SCORE['charting_obser']?></td>
	<td class="category4"><?php echo $SCORE['obser_score']?></td>
	<td><?php echo $SCORE['st_pt']?></td>
	<td><?php echo $SCORE['st_only_score']?></td>
	<td><?php echo $SCORE['st_assist']?></td>
	<td class="category4"><?php echo $SCORE['st_score']?></td>
	<td><?php echo $SCORE['fix']?></td>
	<td class="category1"><?php echo sprintf("%1.0f",$SCORE['total_score'])?></td>
<!--	<td class="category1"><?php echo $SCORE['obser_real_score']?></td>
	<td class="category1"><?php echo $SCORE['st_real_score']?></td>
	<td class="category1"><?php echo sprintf("%1.0f",$SCORE['total_score'])?></td>
	<td class="category4"><?php echo sprintf("%1.1f",$SCORE['obser_plus_st_score'])?></td>-->

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endif?>

	<?php if(is_array($GOAL_SCORE)):?>
	<?php $SCORE = $GOAL_SCORE?>
	<tr class="goal">
	<td colspan="3">목표점수</td>

	<td><?php echo $SCORE['prof_fix_am']?></td>
	<td><?php echo $SCORE['prof_fix_pm']?></td>
	<td class="category1"><?php echo $SCORE['follow']?></td>
	<td class="category2"><?php echo $SCORE['obser']?></td>
	<td><?php echo $SCORE['ga']?></td>
	<td><?php echo $SCORE['sedation_rp']?></td>
	<td><?php echo $SCORE['clinical_rp']?></td>
	<td><?php echo $SCORE['charting_obser']?></td>
	<td class="category4"><?php echo $SCORE['obser_score']?></td>
	<td><?php echo $SCORE['st_pt']?></td>
	<td><?php echo $SCORE['st_only_score']?></td>
	<td><?php echo $SCORE['st_assist']?></td>
	<td class="category4"><?php echo $SCORE['st_score']?></td>
	<td><?php echo $SCORE['fix']?></td>
	<td class="category1"><?php echo sprintf("%1.0f",$SCORE['total_score'])?></td>
<!--	<td class="category1"><?php echo $SCORE['obser_real_score']?></td>
	<td class="category1"><?php echo $SCORE['st_real_score']?></td>
	<td class="category1"><?php echo sprintf("%1.0f",$SCORE['total_score'])?></td>
	<td class="category4"><?php echo sprintf("%1.1f",$SCORE['obser_plus_st_score'])?></td>-->

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endif?>
		
	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td><?php echo $idx++?></td>
	<td><?php echo $SCORE['st_id']?></td>
	<td><?php echo $SCORE['st_info']['name']?></td>

	<td><?php echo $SCORE['prof_fix_am']?></td>
	<td><?php echo $SCORE['prof_fix_pm']?></td>
	<td class="category1"><?php echo $SCORE['follow']?></td>
	<td class="category2"><?php echo $SCORE['obser']?></td>
	<td><?php echo $SCORE['ga']?></td>
	<td><?php echo $SCORE['sedation_rp']?></td>
	<td><?php echo $SCORE['clinical_rp']?></td>
	<td><?php echo $SCORE['charting_obser']?></td>
	<td class="category4"><?php echo $SCORE['obser_score']?></td>
	<td><?php echo $SCORE['st_pt']?></td>
	<td><?php echo $SCORE['st_only_score']?></td>
	<td><?php echo $SCORE['st_assist']?></td>
	<td class="category4"><?php echo $SCORE['st_score']?></td>
	<td><?php echo $SCORE['fix']?></td>
	<td class="category1"><?php echo sprintf("%1.0f",$SCORE['total_score'])?></td>
<!--	<td class="category1"><?php echo $SCORE['obser_real_score']?></td>
	<td class="category1"><?php echo $SCORE['st_real_score']?></td>
	<td class="category1"><?php echo sprintf("%1.0f",$SCORE['total_score'])?></td>
	<td class="category4"><?php echo sprintf("%1.1f",$SCORE['obser_plus_st_score'])?></td>-->

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>
