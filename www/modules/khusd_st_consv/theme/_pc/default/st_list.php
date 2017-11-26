<div id="consv_list" class="khusd_st list consv">

	<?php getWidget('khusd/semester_selector',array())?>

	<table summary="보존과 점수표 입니다.">
	<caption>보존과 점수표</caption> 
	<colgroup> 
	<col width="35">
	<col width="125"> 
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
<!--	<col width="40"> 
	<col width="40"> 
	<col width="40">
	<col width="40"> 
	<col width="40">--> 
	<col width="200"> 
	</colgroup> 
	<thead>
	<tr>
	<?php if($MANAGER):?>
		<th rowspan="2" scope="col" class="split">No</th>
		<th rowspan="2" scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_id', $om)?>">학번,이름</a></th>
		<th colspan="15" scope="col" class="split">[ST OP & Endo Tx.]</th>
<!--		<th colspan="2" scope="col" class="split">[Fol]</th>-->
<!--		<th colspan="2" scope="col" class="split">[Obs]</th>-->
		<th colspan="3" scope="col" class="split">[Total]</th>
		<th rowspan="2" scope="col" class="">수정일</th>
	</tr>
	<tr>
<!--		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, '', $om)?>">OP 체어 당첨 횟수</a></th> -->
		<th scope="col" class="split">ENDO<br />1/2</th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_endo_1st_point', $om)?>">Endo점수(1st case)</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_op_bleaching', $om)?>">Blch</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_op_tooth_colored_cervical', $om)?>">CA</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_op_tooth_colored_simple', $om)?>">RF(S)</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_op_tooth_colored_complex', $om)?>">RF(C)</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_op_tooth_colored_diastema', $om)?>">Dia</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_op_am_simple', $om)?>">AF(S)</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_op_am_complex', $om)?>">AF(C)</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_op_others', $om)?>">OP기타</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_op_num', $om)?>">OP개수</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_op_score', $om)?>">OP득점</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_inlay_prep', $om)?>">Inlay Prep</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_inlay_setting', $om)?>">Inlay Set</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_inlay_score', $om)?>">Inlay 점수</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_plus_score', $om)?>">ST득점</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_minus_score', $om)?>">감점</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_score', $om)?>">ST총점</a></th>
<!--		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'fol_score', $om)?>">팔로우총점</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'fol_score_ratio', $om)?>">환산점수</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'obser_score', $om)?>">옵저총점</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'obser_score_ratio', $om)?>">환산점수</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'total_score', $om)?>">최종점수</a></th>-->
	</tr>
	<?php else:?>
		<th rowspan="2" scope="col" class="split">No</th>
		<th rowspan="2" scope="col" class="split">학번,이름</th>
		<th colspan="18" scope="col" class="split">[ST OP & Endo Tx.]</th>
		<th colspan="2" scope="col" class="split">[Obs]</th>
		<th scope="col" class="split">[Total]</th>
		<th rowspan="2" scope="col" class="">수정일</th>
	</tr>
	<tr>
<!--		<th scope="col" class="split">OP 체어 당첨 횟수</th>-->
		<th scope="col" class="split">ENDO<br />1/2</th>
		<th scope="col" class="split">Endo점수(1st case)</th>
		<th scope="col" class="split">Blch</th>
		<th scope="col" class="split">CA</th>
		<th scope="col" class="split">RF(S)</th>
		<th scope="col" class="split">RF(C)</th>
		<th scope="col" class="split">Dia</th>
		<th scope="col" class="split">AF(S)</th>
		<th scope="col" class="split">AF(C)</th>
		<th scope="col" class="split">OP기타</th>
		<th scope="col" class="split">OP개수</th>
		<th scope="col" class="split">OP득점</th>
		<th scope="col" class="split">Inlay Prep</th>
		<th scope="col" class="split">Inlay Set</th>
		<th scope="col" class="split">Inlay 점수</th>
		<th scope="col" class="split">ST득점</th>
		<th scope="col" class="split">감점</th>
		<th scope="col" class="split">ST총점</th>
<!--		<th scope="col" class="split">팔로우총점</th>
		<th scope="col" class="split">환산점수</th>
		<th scope="col" class="split">옵저총점</th>
		<th scope="col" class="split">환산점수</th>
		<th scope="col" class="split">최종점수</th>-->
	</tr>
	<?php endif?>
	</thead>
	<tbody>
	
	<tr>
		<td></td>
		<td class="avg">평균</th>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_op_chair_assigned'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_endo_1st_point'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_op_bleaching'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_op_tooth_colored_cervical'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_op_tooth_colored_simple'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_op_tooth_colored_complex'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_op_tooth_colored_diastema'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_op_am_simple'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_op_am_complex'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_op_others'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_op_num'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_op_score'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_inlay_prep'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_inlay_setting'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_inlay_score'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_plus_score'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_minus_score'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['st_score'])?></td>
<!--		<td class="avg"><?php echo sprintf("%01.2f",$AVG['fol_score'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['fol_score_ratio'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['obser_score'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['obser_score_ratio'])?></td>
		<td class="avg"><?php echo sprintf("%01.2f",$AVG['total_score'])?></td>-->
		<td></td>
	</tr>

	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>

	<?php if(is_array($SCORE_ARRAY[$my['id']])):?>
	<?php $SCORE = $SCORE_ARRAY[$my['id']]?>
	<tr class="mine">
	<td colspan="2">내점수</td>

<!--	<td class="category3"><?php echo $SCORE['st_op_chair_assigned']?></td>-->
	<td class="category3">
		<?php if($SCORE['st_endo_1'] == 'cf'){ echo 'O';}else { echo 'X';} ?>
		/<?php if($SCORE['st_endo_2'] == 'cf'){ echo 'O';}else { echo 'X';} ?>
	</td>
	<td class="category3"><?php echo $SCORE['st_endo_1st_point']?></td>
	<td class="category3"><?php echo $SCORE['st_op_bleaching']?></td>
	<td class="category1"><?php echo $SCORE['st_op_tooth_colored_cervical']?></td>
	<td class="category1"><?php echo $SCORE['st_op_tooth_colored_simple']?></td>
	<td class="category1"><?php echo $SCORE['st_op_tooth_colored_complex']?></td>
	<td class="category1"><?php echo $SCORE['st_op_tooth_colored_diastema']?></td>
	<td><?php echo $SCORE['st_op_am_simple']?></td>
	<td><?php echo $SCORE['st_op_am_complex']?></td>
	<td class="category1"><?php echo $SCORE['st_op_others']?></td>
	<td class="category3"><?php echo $SCORE['st_op_num']?></td>
	<td><?php echo sprintf("%01.2f",$SCORE['st_op_score'])?></td>
	<td class="category2"><?php echo $SCORE['st_inlay_prep']?></td>
	<td class="category2"><?php echo $SCORE['st_inlay_setting']?></td>
	<td class="category3"><?php echo $SCORE['st_inlay_score']?></td>
	<td class="category4"><?php echo sprintf("%01.2f",$SCORE['st_plus_score'])?></td>
	<td><?php echo $SCORE['st_minus_score']?></td>
	<td class="category4"><?php echo sprintf("%01.2f",$SCORE['st_score'])?></td>
<!--	<td class="category2"><?php echo sprintf("%01.2f",$SCORE['fol_score'])?></td>
	<td class="category2"><?php echo sprintf("%01.2f",$SCORE['fol_score_ratio'])?></td>
	<td class="category2"><?php echo sprintf("%01.2f",$SCORE['obser_score'])?></td>
	<td class="category2"><?php echo sprintf("%01.2f",$SCORE['obser_score_ratio'])?></td>
	<td class="category4"><?php echo sprintf("%01.2f",$SCORE['total_score'])?></td>-->
	
	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endif?>
	

	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
		<td><?php echo $idx++?></td>
		<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);">
			<p><?php echo $SCORE['st_id']?></p>
			<p><?php echo $SCORE['st_info']['name']?></p>
		</td>
	
<!--	<td class="category3"><?php echo $SCORE['st_op_chair_assigned']?></td>-->
	<td class="category3">
		<?php if($SCORE['st_endo_1'] == 'cf'){ echo 'O';}else { echo 'X';} ?>
		/<?php if($SCORE['st_endo_2'] == 'cf'){ echo 'O';}else { echo 'X';} ?>
	</td>
		<td class="category3"><?php echo $SCORE['st_endo_1st_point']?></td>
		<td class="category3"><?php echo $SCORE['st_op_bleaching']?></td>
		<td class="category1"><?php echo $SCORE['st_op_tooth_colored_cervical']?></td>
		<td class="category1"><?php echo $SCORE['st_op_tooth_colored_simple']?></td>
		<td class="category1"><?php echo $SCORE['st_op_tooth_colored_complex']?></td>
		<td class="category1"><?php echo $SCORE['st_op_tooth_colored_diastema']?></td>
		<td><?php echo $SCORE['st_op_am_simple']?></td>
		<td><?php echo $SCORE['st_op_am_complex']?></td>
		<td class="category1"><?php echo $SCORE['st_op_others']?></td>
		<td class="category3"><?php echo $SCORE['st_op_num']?></td>
		<td><?php echo sprintf("%01.2f",$SCORE['st_op_score'])?></td>
		<td class="category2"><?php echo $SCORE['st_inlay_prep']?></td>
		<td class="category2"><?php echo $SCORE['st_inlay_setting']?></td>
		<td class="category3"><?php echo $SCORE['st_inlay_score']?></td>
		<td class="category4"><?php echo sprintf("%01.2f",$SCORE['st_plus_score'])?></td>
		<td><?php echo $SCORE['st_minus_score']?></td>
		<td class="category4"><?php echo sprintf("%01.2f",$SCORE['st_score'])?></td>
<!--		<td class="category2"><?php echo sprintf("%01.2f",$SCORE['fol_score'])?></td>
		<td class="category2"><?php echo sprintf("%01.2f",$SCORE['fol_score_ratio'])?></td>
		<td class="category2"><?php echo sprintf("%01.2f",$SCORE['obser_score'])?></td>
		<td class="category2"><?php echo sprintf("%01.2f",$SCORE['obser_score_ratio'])?></td>
		<td class="category4"><?php echo sprintf("%01.2f",$SCORE['total_score'])?></td>-->
	
	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>
