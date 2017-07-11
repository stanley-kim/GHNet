<div id="perio_list" class="khusd_st list perio">

	<?php getWidget('khusd/semester_selector',array())?>
	
	<table summary="치주과 점수표 입니다.">
	<caption>치주과 점수표</caption> 
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
	<th scope="col" rowspan=3 class="split">No</th>
	<th scope="col" rowspan=3 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'st_id', $om, $order == 'st_id')?>">학번</a></th>
	<th scope="col" rowspan=3 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'name', $om, $order == 'name')?>">이름</a></th>
<!--	<th scope="col" colspan=7 class="split">[Follow]</th>-->
	<th scope="col" colspan=13 class="split">[Observation]</th>
	<th scope="col" colspan=5 class="split">[ST Case]</th>
	<th scope="col" rowspan=3 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'animal_exp', $om, $order == 'animal_exp')?>">동물<br>실험</a></th>
	<th scope="col" rowspan=3 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'fix', $om, $order == 'fix')?>">Fix</a></th>
	<th scope="col" rowspan=3 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'cp', $om, $order == 'cp')?>">CP</a></th>
	<th scope="col" rowspan=3 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'total_score', $om, $order == 'total_score')?>">Total</a></th>
	<th scope="col" rowspan=3>수정일</th>
	<?php else:?>
	<th scope="col" rowspan=3 class="split">No</th>
	<th scope="col" rowspan=3 class="split">학번</th>
	<th scope="col" rowspan=3 class="split">이름</th>
<!--	<th scope="col" colspan=7 class="split">[Follow]</th>-->
	<th scope="col" colspan=14 class="split">[Observation]</th>
	<th scope="col" colspan=5 class="split">[ST Case]</th>
	<th scope="col" rowspan=3 class="split">Fix</th>
	<th scope="col" rowspan=3 class="split">CP</th>
	<th scope="col" rowspan=3 class="split">Total</th>
	<th scope="col" rowspan=3>수정일</th>
	<?php endif?>
	</tr>
	<tr>
	<?php if($MANAGER):?>
<!--	<th scope="col" colspan=2 class="split">A</th>
	<th scope="col" colspan=2 class="split">B</th>
	<th scope="col" colspan=2 class="split">C</th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'follow_point', $om, $order == 'follow_point')?>">점수</a></th>-->
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'iot', $om, $order == 'iot')?>">IOT</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'charting', $om, $order == 'charting')?>">Ch</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'ch_iot', $om, $order == 'ch_iot')?>">Ch<br>+<br>IOT</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'surgery', $om, $order == 'surgery')?>">F/O</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'imp_1st', $om, $order == 'imp_1st')?>">Imp 1st</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'imp_2nd', $om, $order == 'imp_2nd')?>">Imp 2nd</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'total_surgery', $om, $order == 'total_surgery')?>">Total<br>surgery</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'abandon_surgery', $om, $order == 'abandon_surgery')?>">버린 수술 점수</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'sc', $om, $order == 'sc')?>">SC</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'sc2', $om, $order == 'sc2')?>">SC2</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'others', $om, $order == 'others')?>">others</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'tbi', $om, $order == 'tbi')?>">TBI</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'ob_score_original', $om, $order == 'ob_score_original')?>">Obser 점수</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'pre_st', $om, $order == 'pre_st')?>">Pre ST</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'stsc', $om, $order == 'stsc')?>">SC</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'stpc', $om, $order == 'stpc')?>">SPT</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'stcu', $om, $order == 'stcu')?>">CU</a></th>
	<th scope="col" rowspan=2 class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'st_score_original', $om, $order == 'st_score_original')?>">ST 점수</a></th>
	<?php else:?>
<!--	<th scope="col" colspan=2 class="split">A</th>
	<th scope="col" colspan=2 class="split">B</th>
	<th scope="col" colspan=2 class="split">C</th>
	<th scope="col" rowspan=2 class="split">점수</th>-->
	<th scope="col" rowspan=2 class="split">IOT</th>
	<th scope="col" rowspan=2 class="split">Ch</th>
	<th scope="col" rowspan=2 class="split">Ch<br>+<br>IOT</th>
	<th scope="col" rowspan=2 class="split">F/O</th>
	<th scope="col" rowspan=2 class="split">Imp 1st</th>
	<th scope="col" rowspan=2 class="split">Imp 2nd</th>
	<th scope="col" rowspan=2 class="split">Total<br>surgery</th>
	<th scope="col" rowspan=2 class="split">버린 수술 점수</th>
	<th scope="col" rowspan=2 class="split">SC</th>
	<th scope="col" rowspan=2 class="split">SC2</th>
	<th scope="col" rowspan=2 class="split">others</th>
	<th scope="col" rowspan=2 class="split">TBI</th>
	<th scope="col" rowspan=2 class="split">Obser 점수</th>
	<th scope="col" rowspan=2 class="split">Pre ST</th>
	<th scope="col" rowspan=2 class="split">SC</th>
	<th scope="col" rowspan=2 class="split">SPT</th>
	<th scope="col" rowspan=2 class="split">CU</th>
	<th scope="col" rowspan=2 class="split">ST 점수</th>
	<?php endif?>
	</tr>
<!--	<tr>
		<?php if($MANAGER):?>
		<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'follow_A', $om, $order == 'follow_A')?>">f/c</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'follow_A_Drop', $om, $order == 'follow_A_Drop')?>">d</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'follow_B', $om, $order == 'follow_B')?>">f/c</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'follow_B_Drop', $om, $order == 'follow_B_Drop')?>">d</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'follow_C', $om, $order == 'follow_C')?>">f/c</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_perio_list'], 'follow_C_Drop', $om, $order == 'follow_C_Drop')?>">d</a></th>
		<?php else:?>
		<th scope="col" class="split">f/c</th>
		<th scope="col" class="split">d</th>
		<th scope="col" class="split">f/c</th>
		<th scope="col" class="split">d</th>
		<th scope="col" class="split">f/c</th>
		<th scope="col" class="split">d</th>
		<?php endif?>

	</tr>-->
	</thead>
	<tbody>
	
	<tr>
		<td></td>
		<td></td>
		<td class="avg">평균</td>
<!--		<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow_A'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow_A_Drop'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow_B'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow_B_Drop'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow_C'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow_C_Drop'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['follow_point'])?></td>-->
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['iot'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['charting'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['ch_iot'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['surgery'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['imp_1st'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['imp_2nd'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['total_surgery'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['abandon'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['sc'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['sc2'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['others'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['tbi'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['ob_score_original'])?></td>
		<td class="avg"><?php echo sprintf("%1d",$AVG['pre_st'])?>명</td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['stsc'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['stpc'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['stcu'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['st_score_original'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['animal_exp'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fix'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['cp'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['total_score'])?></td>
		<td></td>
	</tr>
	
	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>

	<?php if(is_array($SCORE_ARRAY[$my['id']])):?>
	<?php $SCORE = $SCORE_ARRAY[$my['id']]?>
	<tr class="mine">
	<td colspan="3">내점수</td>
	
<!--	<td><?php echo $SCORE['follow_A']?></td>
	<td><?php echo $SCORE['follow_A_Drop']?></td>
	<td><?php echo $SCORE['follow_B']?></td>
	<td><?php echo $SCORE['follow_B_Drop']?></td>
	<td><?php echo $SCORE['follow_C']?></td>
	<td><?php echo $SCORE['follow_C_Drop']?></td>
	<td><?php echo $SCORE['follow_point']?></td>-->
	<td class="category1"><?php echo $SCORE['iot']?></td>
	<td class="category1"><?php echo $SCORE['charting']?></td>
	<td class="category1"><?php echo $SCORE['ch_iot']?></td>
	<td><?php echo $SCORE['surgery']?></td>
	<td><?php echo $SCORE['imp_1st']?></td>
	<td><?php echo $SCORE['imp_2nd']?></td>
	<td class="category2"><?php echo $SCORE['total_surgery']?></td>
	<td class="category2"><?php echo $SCORE['abandon_surgery']?></td>
	<td class="category3"><?php echo $SCORE['sc']?></td>
	<td class="category3"><?php echo $SCORE['sc2']?></td>
	<td><?php echo $SCORE['others']?></td>
	<td><?php echo $SCORE['tbi']?></td>
	<td class="category4"><?php echo $SCORE['ob_score_original']?></td>
	<td class="category5"><?php echo ($SCORE['pre_st'] == 1 ? '완' : '')?></td>
	<td><?php echo $SCORE['stsc']?></td>
	<td><?php echo $SCORE['stpc']?></td>
	<td><?php echo $SCORE['stcu']?></td>
	<td class="category4"><?php echo $SCORE['st_score_original']?></td>
	<td class="category3"><?php echo $SCORE['animal_exp']?></td>
	<td class="category3"><?php echo sprintf("%1.2f", $SCORE['fix'])?></td>
	<td class="category3"><?php echo sprintf("%1.2f", $SCORE['cp'])?></td>
	<td class="category5"><?php echo sprintf("%1.2f", $SCORE['total_score'])?></td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endif?>
	
	<?php if(is_array($GOAL_SCORE)):?>
	<?php $SCORE = $GOAL_SCORE?>
	<tr class="goal">
	<td colspan="3">목표점수</td>
	
<!--	<td><?php echo $SCORE['follow_A']?></td>
	<td><?php echo $SCORE['follow_A_Drop']?></td>
	<td><?php echo $SCORE['follow_B']?></td>
	<td><?php echo $SCORE['follow_B_Drop']?></td>
	<td><?php echo $SCORE['follow_C']?></td>
	<td><?php echo $SCORE['follow_C_Drop']?></td>
	<td><?php echo $SCORE['follow_point']?></td>-->
	<td class="category1"><?php echo $SCORE['iot']?></td>
	<td class="category1"><?php echo $SCORE['charting']?></td>
	<td class="category1"><?php echo $SCORE['ch_iot']?></td>
	<td><?php echo $SCORE['surgery']?></td>
	<td><?php echo $SCORE['imp_1st']?></td>
	<td><?php echo $SCORE['imp_2nd']?></td>
	<td class="category2"><?php echo $SCORE['total_surgery']?></td>
	<td class="category2"><?php echo $SCORE['abandon_surgery']?></td>
	<td class="category3"><?php echo $SCORE['sc']?></td>
	<td class="category3"><?php echo $SCORE['sc2']?></td>
	<td><?php echo $SCORE['others']?></td>
	<td><?php echo $SCORE['tbi']?></td>
	<td class="category4"><?php echo $SCORE['ob_score_original']?></td>
	<td class="category5"><?php echo ($SCORE['pre_st'] == 1 ? '완' : '')?></td>
	<td><?php echo $SCORE['stsc']?></td>
	<td><?php echo $SCORE['stpc']?></td>
	<td><?php echo $SCORE['stcu']?></td>
	<td class="category4"><?php echo $SCORE['st_score_original']?></td>
	<td class="category3"><?php echo $SCORE['animal_exp']?></td>
	<td class="category3"><?php echo sprintf("%1.2f", $SCORE['fix'])?></td>
	<td class="category3"><?php echo sprintf("%1.2f", $SCORE['cp'])?></td>
	<td class="category5"><?php echo sprintf("%1.2f", $SCORE['total_score'])?></td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endif?>
			
	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td><?php echo $idx++?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_id']?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_info']['name']?></td>
	
<!--	<td><?php echo $SCORE['follow_A']?></td>
	<td><?php echo $SCORE['follow_A_Drop']?></td>
	<td><?php echo $SCORE['follow_B']?></td>
	<td><?php echo $SCORE['follow_B_Drop']?></td>
	<td><?php echo $SCORE['follow_C']?></td>
	<td><?php echo $SCORE['follow_C_Drop']?></td>
	<td><?php echo $SCORE['follow_point']?></td>-->
	<td class="category1"><?php echo $SCORE['iot']?></td>
	<td class="category1"><?php echo $SCORE['charting']?></td>
	<td class="category1"><?php echo $SCORE['ch_iot']?></td>
	<td><?php echo $SCORE['surgery']?></td>
	<td><?php echo $SCORE['imp_1st']?></td>
	<td><?php echo $SCORE['imp_2nd']?></td>
	<td class="category2"><?php echo $SCORE['total_surgery']?></td>
	<td class="category2"><?php echo $SCORE['abandon_surgery']?></td>
	<td class="category3"><?php echo $SCORE['sc']?></td>
	<td class="category3"><?php echo $SCORE['sc2']?></td>
	<td><?php echo $SCORE['others']?></td>
	<td><?php echo $SCORE['tbi']?></td>
	<td class="category4"><?php echo $SCORE['ob_score_original']?></td>
	<td class="category5"><?php echo ($SCORE['pre_st'] == 1 ? '완' : '')?></td>
	<td><?php echo $SCORE['stsc']?></td>
	<td><?php echo $SCORE['stpc']?></td>
	<td><?php echo $SCORE['stcu']?></td>
	<td class="category4"><?php echo $SCORE['st_score_original']?></td>
	<td class="category3"><?php echo $SCORE['animal_exp']?></td>
	<td class="category3"><?php echo sprintf("%1.2f", $SCORE['fix'])?></td>
	<td class="category3"><?php echo sprintf("%1.2f", $SCORE['cp'])?></td>
	<td class="category5"><?php echo sprintf("%1.2f", $SCORE['total_score'])?></td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>