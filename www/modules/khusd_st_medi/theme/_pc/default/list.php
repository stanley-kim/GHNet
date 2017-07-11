<div id="medi_list" class="khusd_st list medi">

	<?php getWidget('khusd/semester_selector',array())?>
	
	<table summary="구강내과 점수표 입니다.">
	<caption>구강내과 점수표</caption> 
	<colgroup> 
	<col width="35">
	<col width="105"> 
	<col width="80"> 
<!--	<col width="40">--> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
<!--	<col width="40">--> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
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
<!--	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'charting_obser', $om)?>">Ch Obser</a></th>-->
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'charting', $om)?>">T Ch</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'charting', $om)?>">연 Ch</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'obser', $om)?>">단순 Obser</a></th>
<!--	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'splint_obser', $om)?>">장치 Obser</a></th>-->
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'physical_tx_fix', $om)?>">물리치료 고정옵저</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'physical_tx', $om)?>">물리치료</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'odor', $om)?>">구취측정</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'm_text', $om)?>">의료문서</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'fix_am', $om)?>">Fix 오전</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'fix_pm', $om)?>">Fix 오후</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'fix', $om)?>">Fix 합</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'portfolio1', $om)?>">포트폴리오</a></th>
	<th scope="col" class="split">Port합</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'total_score', $om)?>">총점</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'splint_impression', $om)?>">장치인기</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'splint_polishing', $om)?>">마무리</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'splint_adjust', $om)?>">조정</a></th>
	<th scope="col">수정일</th>
	<?php else:?>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
<!--	<th scope="col" class="split">Ch Obser</th>-->
	<th scope="col" class="split">T Ch</th>
	<th scope="col" class="split">연 Ch</th>
	<th scope="col" class="split">단순 Obser</th>
<!--	<th scope="col" class="split">장치 Obser</th>-->
	<th scope="col" class="split">물리치료 고정옵저</th>
	<th scope="col" class="split">물리치료</th>
	<th scope="col" class="split">구취측정</th>
	<th scope="col" class="split">의료문서</th>
	<th scope="col" class="split">Fix 오전</th>
	<th scope="col" class="split">Fix 오후</th>
	<th scope="col" class="split">Fix 합</th>
	<th scope="col" class="split">Port</th>
	<th scope="col" class="split">Port합</th>
	<th scope="col" class="split">총점</th>
	<th scope="col" class="split">장치인기</th>
	<th scope="col" class="split">마무리</th>
	<th scope="col" class="split">조정</th>
	<th scope="col">수정일</th>
	<?php endif?>
	</tr>
	</thead>
	<tbody>

	<tr>
	<td></td>
	<td></td>
	<td class="avg">평균</td>
<!--	<td class="avg"><?php echo sprintf("%1.1f",$AVG['charting_obser'])?></td>-->
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['charting'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['soft_charting'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['obser'])?></td>
<!--	<td class="avg"><?php echo sprintf("%1.1f",$AVG['splint_obser'])?></td>-->
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['physical_tx_fix'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['physical_tx'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['odor'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['m_text'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['fix_am'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['fix_pm'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['fix'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['portfolio1'])?>/<?php echo sprintf("%1.1f",$AVG['portfolio2'])?>/<?php echo sprintf("%1.1f",$AVG['portfolio3'])?></td>
	<td class="avg">0</td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['total_score'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['splint_impression'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['splint_polishing'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['splint_adjust'])?></td>
	<td></td>
	</tr>

	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>

	<?php if(is_array($SCORE_ARRAY[$my['id']])):?>
	<?php $SCORE = $SCORE_ARRAY[$my['id']]?>
	<tr class="mine">
	<td colspan="3">내점수</td>

<!--	<td><?php echo $SCORE['charting_obser']?></td>-->
	<td class="category4"><?php echo $SCORE['charting']?></td>
	<td class="category4"><?php echo $SCORE['soft_charting']?></td>
	<td class="category4"><?php echo $SCORE['obser']?></td>
<!--	<td><?php echo $SCORE['splint_obser']?></td>-->
	<td><?php echo $SCORE['physical_tx_fix']?></td>
	<td><?php echo $SCORE['physical_total']?></td>
	<td><?php echo $SCORE['odor']?></td>
	<td><?php echo $SCORE['m_text']?></td>
	<td><?php echo $SCORE['fix_am']?></td>
	<td><?php echo $SCORE['fix_pm']?></td>
	<td><?php echo $SCORE['fix']?></td>
	<td><?php echo $SCORE['portfolio1']?>/<?php echo $SCORE['portfolio2']?>/<?php echo $SCORE['portfolio3']?>/<?php echo $SCORE['portfolio4']?></td>
	<td><?php echo $SCORE['portfolio1'] + $SCORE['portfolio2'] + $SCORE['portfolio3'] + $SCORE['portfolio4']?></td>
	<td class="category4"><?php echo $SCORE['total_score']?></td>
	<td><?php echo $SCORE['splint_impression']?></td>
	<td><?php echo $SCORE['splint_polishing']?></td>
	<td><?php echo $SCORE['splint_adjust']?></td>
	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endif?>
	
	

	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td><?php echo $idx++?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_id']?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_info']['name']?></td>

<!--	<td><?php echo $SCORE['charting_obser']?></td>-->
	<td class="category4"><?php echo $SCORE['charting']?></td>
	<td class="category4"><?php echo $SCORE['soft_charting']?></td>
	<td class="category4"><?php echo $SCORE['obser']?></td>
<!--	<td><?php echo $SCORE['splint_obser']?></td>-->
	<td><?php echo $SCORE['physical_tx_fix']?></td>
	<td><?php echo $SCORE['physical_total']?></td>
	<td><?php echo $SCORE['odor']?></td>
	<td><?php echo $SCORE['m_text']?></td>
	<td><?php echo $SCORE['fix_am']?></td>
	<td><?php echo $SCORE['fix_pm']?></td>
	<td><?php echo $SCORE['fix']?></td>
	<td><?php echo $SCORE['portfolio1']?>/<?php echo $SCORE['portfolio2']?>/<?php echo $SCORE['portfolio3']?>/<?php echo $SCORE['portfolio4']?></td>
	<td><?php echo $SCORE['portfolio1'] + $SCORE['portfolio2'] + $SCORE['portfolio3'] + $SCORE['portfolio4']?></td>
	<td class="category4"><?php echo $SCORE['total_score']?></td>
	<td><?php echo $SCORE['splint_impression']?></td>
	<td><?php echo $SCORE['splint_polishing']?></td>
	<td><?php echo $SCORE['splint_adjust']?></td>
	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>