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
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="200"> 
	</colgroup> 
	<thead>
	<tr>
	<?php if($MANAGER):?>
		<th rowspan="6" scope="col" class="split category1">No</th>
		<th rowspan="3" scope="col" class="split category1"><a href="<?php echo getSortingLink($c, 'st_id', $om)?>">학번,이름</a></th>
		<th colspan="6" scope="col" class="split category2">[Endodontic Tx.]</th>
		<th colspan="10" scope="col" class="split category3">[일반]</th>
		<th colspan="1" scope="col" class="split category4"></th>
		<th rowspan="6" scope="col" class="category5">수정일</th>
	</tr>
	<tr>
		<th colspan="4" scope="col" class="split category2">obs.</th>
		<th rowspan="2" scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'endo_score', $om)?>">점수</a></th>
		<th colspan="2" scope="col" class="split category3">Indirect</th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'f_am', $om)?>">AF</a></th>
		<th colspan="3" scope="col" class="split category3">Tooth colored</th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'f_post_core', $om)?>">P/C</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'f_others', $om)?>">oth</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'f_charting', $om)?>">Cha</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'f_miscellaneous', $om)?>">Mis</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'op_score', $om)?>">점수</a></th>
		<th rowspan="2" scope="col" class="split category4"><a href="<?php echo getSortingLink($c, 'obser_score', $om)?>">총점</a></th>
	</tr>
	<tr>
		<th scope="col" class="split category2">대</th>
		<th scope="col" class="split category2">소</th>
		<th scope="col" class="split category2">전</th>
		<th scope="col" class="split category2">♠</th>
		<th scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'f_indirect_prep_imp', $om)?>">Prep</a></th>
		<th scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'f_indirect_setting', $om)?>">Set</a></th>
		<th scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'f_tooth_colored_simple', $om)?>">Smpl</a></th>
		<th scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'f_tooth_colored_complex', $om)?>">Cmpx</a></th>
		<th scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'f_tooth_colored_diastema', $om)?>">dias</a></th>
	</tr>
	<?php else:?>
		<th rowspan="6" scope="col" class="split category1">No</th>
		<th rowspan="3" scope="col" class="split category1">학번,이름</th>
		<th colspan="6" scope="col" class="split category2">[Endodontic Tx.]</th>
		<th colspan="15" scope="col" class="split category3">[일반]</th>
		<th colspan="3" scope="col" class="split category4"></th>
		<th rowspan="6" scope="col" class="category5">수정일</th>
	</tr>
	<tr>
		<th colspan="4" scope="col" class="split category2">obs.</th>
		<th rowspan="2" scope="col" class="split category2">점수</th>
		<th colspan="2" scope="col" class="split category3">Indirect</th>
		<th rowspan="2" scope="col" class="split category3">AF</th>
		<th colspan="3" scope="col" class="split category3">Tooth colored</th>
		<th rowspan="2" scope="col" class="split category3">P/C</th>
		<th rowspan="2" scope="col" class="split category3">oth</th>
		<th rowspan="2" scope="col" class="split category3">Cha</th>
		<th rowspan="2" scope="col" class="split category3">Mis</th>
		<th rowspan="2" scope="col" class="split category3">점수</th>
		<th rowspan="2" scope="col" class="split category4">총점</th>
	</tr>
	<tr>
		<th scope="col" class="split category3">a-pm</th>
		<th scope="col" class="split category3">m</th>
		<th scope="col" class="split category2">대</th>
		<th scope="col" class="split category2">소</th>
		<th scope="col" class="split category2">전</th>
		<th scope="col" class="split category2">♠</th>
		<th scope="col" class="split category3">Prep</th>
		<th scope="col" class="split category3">Set</th>
		<th scope="col" class="split category3">Smpl</th>
		<th scope="col" class="split category3">Cmpx</th>
		<th scope="col" class="split category3">dias</th>
	</tr>
	<?php endif?>
	</thead>
	<tbody>
	
	<tr>
		<td></td>
		<td class="avg">평균</th>
<!--		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fol_ind'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fol_endapm'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fol_endm'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fol_sur'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fol_ble'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fol_sc'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fol_sc_m'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['fol_sc_obs'])?></td>-->
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['endo_molar'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['endo_pre'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['endo_ant'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['endo_etc'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['endo_score'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['indirect_prep_imp'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['indirect_setting'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['am'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['tooth_colored_simple'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['tooth_colored_complex'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['tooth_colored_diastema'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['post_core'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['others'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['charting'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['miscellaneous'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['op_score'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['obser_score'])?></td>
		<td></td>
	</tr>

	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>

	<?php if(is_array($SCORE_ARRAY[$my['id']])):?>
	<?php $SCORE = $SCORE_ARRAY[$my['id']]?>
	<tr class="mine">
	<td colspan="2">내점수</td>

		<td><?php echo 3*($SCORE['f_endo_molar_pe']+$SCORE['f_endo_molar_ce']+$SCORE['f_endo_molar_cf'])?></td>
	<td><?php echo 2*($SCORE['f_endo_pre_pe']+$SCORE['f_endo_pre_ce']+$SCORE['f_endo_pre_cf'])?></td>
	<td><?php echo 2*($SCORE['f_endo_ant_pe']+$SCORE['f_endo_ant_ce']+$SCORE['f_endo_ant_cf'])?></td>
	<td><?php echo 1*($SCORE['f_endo_molar_etc']+$SCORE['f_endo_pre_etc']+$SCORE['f_endo_ant_etc'])?></td>
	<td class="category3"><?php echo $SCORE['endo_score']?></td>
	<td class="category1"><?php echo $SCORE_INFO['indirect_prep_imp']*$SCORE['f_indirect_prep_imp']?></td>
	<td class="category1"><?php echo $SCORE_INFO['indirect_setting']*$SCORE['f_indirect_setting']?></td>
	<td class="category1"><?php echo $SCORE_INFO['am']*$SCORE['f_am']?></td>
	<td class="category2"><?php echo $SCORE_INFO['tooth_colored_simple']*$SCORE['f_tooth_colored_simple']?></td>
	<td class="category2"><?php echo $SCORE_INFO['tooth_colored_complex']*$SCORE['f_tooth_colored_complex']?></td>
	<td class="category2"><?php echo $SCORE_INFO['tooth_colored_diastema']*$SCORE['f_tooth_colored_diastema']?></td>
	<td class="category2"><?php echo $SCORE_INFO['post']*$SCORE['f_post_core']?></td>
	<td><?php echo $SCORE_INFO['others']*$SCORE['f_others']?></td>
	<td class="category2"><?php echo $SCORE_INFO['charting']*$SCORE['f_charting']?></td>
	<td class="category2"><?php echo $SCORE_INFO['miscellaneous']*$SCORE['f_miscellaneous']?></td>
	<td class="category3"><?php echo $SCORE['op_score']?></td>
	<td class="category4"><?php echo $SCORE['obser_score']?></td>
	
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
	<td><?php echo 3*($SCORE['f_endo_molar_pe']+$SCORE['f_endo_molar_ce']+$SCORE['f_endo_molar_cf'])?></td>
	<td><?php echo 2*($SCORE['f_endo_pre_pe']+$SCORE['f_endo_pre_ce']+$SCORE['f_endo_pre_cf'])?></td>
	<td><?php echo 2*($SCORE['f_endo_ant_pe']+$SCORE['f_endo_ant_ce']+$SCORE['f_endo_ant_cf'])?></td>
	<td><?php echo 1*($SCORE['f_endo_molar_etc']+$SCORE['f_endo_pre_etc']+$SCORE['f_endo_ant_etc'])?></td>
	<td class="category3"><?php echo $SCORE['endo_score']?></td>
	<td class="category1"><?php echo $SCORE_INFO['indirect_prep_imp']*$SCORE['f_indirect_prep_imp']?></td>
	<td class="category1"><?php echo $SCORE_INFO['indirect_setting']*$SCORE['f_indirect_setting']?></td>
	<td class="category1"><?php echo $SCORE_INFO['am']*$SCORE['f_am']?></td>
	<td class="category2"><?php echo $SCORE_INFO['tooth_colored_simple']*$SCORE['f_tooth_colored_simple']?></td>
	<td class="category2"><?php echo $SCORE_INFO['tooth_colored_complex']*$SCORE['f_tooth_colored_complex']?></td>
	<td class="category2"><?php echo $SCORE_INFO['tooth_colored_diastema']*$SCORE['f_tooth_colored_diastema']?></td>
	<td class="category2"><?php echo $SCORE_INFO['post']*$SCORE['f_post_core']?></td>
	<td><?php echo $SCORE_INFO['others']*$SCORE['f_others']?></td>
	<td class="category2"><?php echo $SCORE_INFO['charting']*$SCORE['f_charting']?></td>
	<td class="category2"><?php echo $SCORE_INFO['miscellaneous']*$SCORE['f_miscellaneous']?></td>
	<td class="category3"><?php echo $SCORE['op_score']?></td>
	<td class="category4"><?php echo $SCORE['obser_score']?></td>
	
	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>
