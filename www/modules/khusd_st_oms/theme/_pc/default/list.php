<div id="oms_list" class="khusd_st list oms">

	<?php getWidget('khusd/semester_selector',array())?>
	
	<table summary="구강외과 점수표 입니다.">
	<caption>구강외과 점수표</caption> 
	<colgroup> 
	<col width="35">
	<col width="125"> 
	<col width="120"> 
<!--	<col width="40"> 
	<col width="40"> 
	<col width="40">--> 
	<col width="40">
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
<!--	<col width="40"> -->
	<col width="40"> 
	<col width="40"> 
<!--	<col width="40"> 
	<col width="40"> -->
	<col width="150"> 
	</colgroup> 
	<thead>
	<tr>
	<?php if($MANAGER):?>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_id', $om)?>">학번</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'name', $om)?>">이름</a></th>
<!--	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'charting', $om)?>">Charting</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'dressing', $om)?>">Dressing</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'cp', $om)?>">Case Presentation</a></th>-->
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'simple_ext', $om)?>">Simple Ext.</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'surgical_ext', $om)?>">Surgical Ext.</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'minor', $om)?>">Minor Surgery</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'major', $om)?>">Major Surgery</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'fix', $om)?>">Fix</a></th>
<!--	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'er_call', $om)?>">E/R Call</a></th>-->
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_case', $om)?>">ST</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_assist', $om)?>">Assist</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'imp_1st', $om)?>">Imp</a></th>
<!--	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'imp_2nd', $om)?>">Imp 2nd</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'total_imp', $om)?>">총 Imp</a></th>-->
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'ob_score', $om)?>">옵져 점수</a></th>
	<th scope="col">수정일</th>
	<?php else:?>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
<!--	<th scope="col" class="split">Charting</th>
	<th scope="col" class="split">Dressing</th>
	<th scope="col" class="split">Case Presentation</th>-->
	<th scope="col" class="split">Simple Ext.</th>
	<th scope="col" class="split">Surgical Ext.</th>
	<th scope="col" class="split">Minor Surgery</th>
	<th scope="col" class="split">Major Surgery</th>
	<th scope="col" class="split">Fix</th>
<!--	<th scope="col" class="split">E/R Call</th>-->
	<th scope="col" class="split">ST</th>
	<th scope="col" class="split">Assist</th>
	<th scope="col" class="split">Imp</th>
<!--	<th scope="col" class="split">Imp 2nd</th>
	<th scope="col" class="split">총 Imp</th>-->
	<th scope="col" class="split">옵져 점수</th>
	<th scope="col">수정일</th>
	<?php endif?>
	</tr>
	</thead>
	<tbody>
	
	<tr>
	<td></td>
	<td></td>
	<td class="avg">평균</td>
<!--	<td class="avg"><?php echo sprintf("%1.1f",$AVG['charting'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['dressing'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['cp'])?></td>-->
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['simple_ext'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['surgical_ext'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['minor'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['major'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['fix'])?></td>
<!--	<td class="avg"><?php echo sprintf("%1.1f",$AVG['er_call'])?></td>-->
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['st_case'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['st_assist'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['imp_1st'])?></td>
<!--	<td class="avg"><?php echo sprintf("%1.1f",$AVG['imp_2nd'])?></td>
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['total_imp'])?></td>-->
	<td class="avg"><?php echo sprintf("%1.1f",$AVG['ob_score'])?></td>
	<td></td>
	</tr>	
	
	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>

	<?php if(is_array($SCORE_ARRAY[$my['id']])):?>
	<?php $SCORE = $SCORE_ARRAY[$my['id']]?>
	<tr class="mine">
	<td colspan="3">내점수</td>

<!--	<td class="category1"><?php echo $SCORE['charting']?></td>
	<td class="category1"><?php echo $SCORE['dressing']?></td>
	<td><?php echo $SCORE['cp']?></td>-->
	<td class="category1"><?php echo $SCORE['simple_ext']?></td>
	<td class="category1"><?php echo $SCORE['surgical_ext']?></td>
	<td><?php echo $SCORE['minor']?></td>
	<td><?php echo $SCORE['major']?></td>
	<td><?php echo $SCORE['fix']?></td>
<!--	<td><?php echo $SCORE['er_call']?></td>-->
	<td class="category2"><?php echo $SCORE['st_case']?></td>
	<td class="category2"><?php echo $SCORE['st_assist']?></td>
	<td><?php echo $SCORE['imp_1st']?></td>
<!--	<td><?php echo $SCORE['imp_2nd']?></td>
	<td><?php echo $SCORE['total_imp']?></td>-->
	<td class="category3"><?php echo $SCORE['ob_score']?></td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endif?>
	

	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td><?php echo $idx++?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_id']?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_info']['name']?></td>

<!--	<td class="category1"><?php echo $SCORE['charting']?></td>
	<td class="category1"><?php echo $SCORE['dressing']?></td>
	<td><?php echo $SCORE['cp']?></td>-->
	<td class="category1"><?php echo $SCORE['simple_ext']?></td>
	<td class="category1"><?php echo $SCORE['surgical_ext']?></td>
	<td><?php echo $SCORE['minor']?></td>
	<td><?php echo $SCORE['major']?></td>
	<td><?php echo $SCORE['fix']?></td>
<!--	<td><?php echo $SCORE['er_call']?></td>-->
	<td class="category2"><?php echo $SCORE['st_case']?></td>
	<td class="category2"><?php echo $SCORE['st_assist']?></td>
	<td><?php echo $SCORE['imp_1st']?></td>
<!--	<td><?php echo $SCORE['imp_2nd']?></td>
	<td><?php echo $SCORE['total_imp']?></td>-->
	<td class="category3"><?php echo $SCORE['ob_score']?></td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>