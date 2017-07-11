<div id="consv_list" class="khusd_st list consv">

	<?php getWidget('khusd/semester_selector',array())?>
	
	<table summary="보존과 점수표 입니다.">
	<caption>보존과 Observation 점수표</caption> 
	<colgroup> 
	<col width="35">
	<col width="150">
	<col width="40">
	<col width="40">
	<col width="40">
	<col width="40">
<!--	<col width="40">
	<col width="40">
	<col width="40">-->
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
<!--		<th colspan="8" scope="col" class="split category3">[Follow]</th>-->
		<th colspan="5" scope="col" class="split category2">[Endodontic Tx.]</th>
		<th colspan="13" scope="col" class="split category3">[일반]</th>
		<th colspan="3" scope="col" class="split category4"></th>
		<th rowspan="6" scope="col" class="category5">수정일</th>
	</tr>
	<tr>
<!--		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'fol_ind', $om)?>">ind</a></th>
		<th colspan="2" scope="col" class="split category3">end</th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'fol_sur', $om)?>">sur</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'fol_ble', $om)?>">ble</a></th>
		<th rowspan="3" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'fol_sc', $om)?>">득점</a></th>
		<th rowspan="3" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'fol_sc_m', $om)?>">감점</a></th>
		<th rowspan="3" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'fol_sc_obs', $om)?>">obs</a></th>-->
		<th colspan="4" scope="col" class="split category2">obs.</th>
		<th rowspan="2" scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'endo_score', $om)?>">점수</a></th>
<!--		<th rowspan="2" scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'pre_st_endo', $om)?>">PRe St(Endo)</a></th>-->
		<th colspan="2" scope="col" class="split category3">Indirect</th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'am', $om)?>">AF</a></th>
		<th colspan="3" scope="col" class="split category3">Tooth colored</th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'post_core', $om)?>">P/C</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'others', $om)?>">oth</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'surgery', $om)?>">Sur</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'miscellaneous', $om)?>">Mis</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'op_score', $om)?>">점수</a></th>
<!--		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'pre_st_am', $om)?>">Pre ST(AF)</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'pre_st_op', $om)?>">Pre ST(OP)</a></th>-->
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'pre_st_inlay_gold', $om)?>">Pre ST(Inlay Gold)</a></th>
		<th rowspan="2" scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'pre_st_inlay_resin', $om)?>">Pre ST(Inlay Resin)</a></th>
		<th rowspan="2" scope="col" class="split category4"><a href="<?php echo getSortingLink($c, 'plus_score', $om)?>">득점</a></th>
		<th rowspan="2" scope="col" class="split category4"><a href="<?php echo getSortingLink($c, 'minus_sc', $om)?>">감점</a></th>
		<th rowspan="2" scope="col" class="split category4"><a href="<?php echo getSortingLink($c, 'obser_score', $om)?>">총점</a></th>
	</tr>
	<tr>
<!--		<th scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'fol_endapm', $om)?>">a-pm</a></th>
		<th scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'fol_endm', $om)?>">m</a></th>-->
		<th scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'endo_molar', $om)?>">대</a></th>
		<th scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'endo_pre', $om)?>">소</a></th>
		<th scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'endo_ant', $om)?>">전</a></th>
		<th scope="col" class="split category2"><a href="<?php echo getSortingLink($c, 'endo_etc', $om)?>">♠</a></th>
		<th scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'indirect_prep_imp', $om)?>">Prep</a></th>
		<th scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'indirect_setting', $om)?>">Set</a></th>
		<th scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'tooth_colored_simple', $om)?>">Smpl</a></th>
		<th scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'tooth_colored_complex', $om)?>">Cmpx</a></th>
		<th scope="col" class="split category3"><a href="<?php echo getSortingLink($c, 'tooth_colored_diastema', $om)?>">dias</a></th>
	</tr>
	<?php else:?>
		<th rowspan="6" scope="col" class="split category1">No</th>
		<th rowspan="3" scope="col" class="split category1">학번,이름</th>
<!--		<th colspan="8" scope="col" class="split category3">[Follow]</th>-->
		<th colspan="5" scope="col" class="split category2">[Endodontic Tx.]</th>
		<th colspan="13" scope="col" class="split category3">[일반]</th>
		<th colspan="3" scope="col" class="split category4"></th>
		<th rowspan="6" scope="col" class="category5">수정일</th>
	</tr>
	<tr>
<!--		<th rowspan="2" scope="col" class="split category3">ind</th>
		<th colspan="2" scope="col" class="split category3">end</th>
		<th rowspan="2" scope="col" class="split category3">sur</th>
		<th rowspan="2" scope="col" class="split category3">ble</th>
		<th rowspan="3" scope="col" class="split category3">득점</th>
		<th rowspan="3" scope="col" class="split category3">감점</th>
		<th rowspan="3" scope="col" class="split category3">obs</th>-->
		<th colspan="4" scope="col" class="split category2">obs.</th>
		<th rowspan="2" scope="col" class="split category2">점수</th>
<!--		<th rowspan="2" scope="col" class="split category2">PRe St(Endo)</th>-->
		<th colspan="2" scope="col" class="split category3">Indirect</th>
		<th rowspan="2" scope="col" class="split category3">AF</th>
		<th colspan="3" scope="col" class="split category3">Tooth colored</th>
		<th rowspan="2" scope="col" class="split category3">P/C</th>
		<th rowspan="2" scope="col" class="split category3">oth</th>
		<th rowspan="2" scope="col" class="split category3">Sur</th>
		<th rowspan="2" scope="col" class="split category3">Mis</th>
		<th rowspan="2" scope="col" class="split category3">점수</th>
<!--		<th rowspan="2" scope="col" class="split category3">Pre ST(AF)</th>
		<th rowspan="2" scope="col" class="split category3">Pre ST(OP)</th>-->
		<th rowspan="2" scope="col" class="split category3">Pre ST(Inlay Gold)</th>
		<th rowspan="2" scope="col" class="split category3">Pre ST(Inlay Resin)</th>
		<th rowspan="2" scope="col" class="split category4">득점</th>
		<th rowspan="2" scope="col" class="split category4">감점</th>
		<th rowspan="2" scope="col" class="split category4">총점</th>
	</tr>
	<tr>
		<!--<th scope="col" class="split category3">a-pm</th>
		<th scope="col" class="split category3">m</th>-->
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
	<tr>
		<th scope="col" class="split category1">Require</th>
<!--		<th scope="col" class="split category3"><?php echo $d['khusd_st_consv']['require']['follow']['indirect']?></th>--> <!--ind req-->
<!--		<th colspan="2" scope="col" class="split category3"><?php echo $d['khusd_st_consv']['require']['follow']['endo']?></th>-->
<!--		<th scope="col" class="split category3"><?php echo $d['khusd_st_consv']['require']['follow']['surgery']?></th>--> <!--sur req-->
<!--		<th scope="col" class="split category3"><?php echo $d['khusd_st_consv']['require']['follow']['bleach']?></th>--> <!--ble req-->
		<th colspan="4" scope="col" class="split category2">Tot: <?php echo $d['khusd_st_consv']['require']['obser']['endo']?> / 대>=<?php echo $d['khusd_st_consv']['require']['obser']['endo_molar']?></th>
		<th scope="col" class="split category2"></th>
		<!--<th scope="col" class="split"></th>-->
		<th scope="col" class="split category3"><?php echo $d['khusd_st_consv']['require']['obser']['indirect_prep_imp']?></th>
		<th scope="col" class="split category3"><?php echo $d['khusd_st_consv']['require']['obser']['indirect_setting']?></th>
		<th scope="col" class="split category3"></th>
		<th colspan="3" scope="col" class="split category3">Tot: <?php echo $d['khusd_st_consv']['require']['obser']['tooth_colored']?> / cmpx>=<?php echo $d['khusd_st_consv']['require']['obser']['tooth_colored_complex']?></th>
		<th scope="col" class="split category3"><?php echo $d['khusd_st_consv']['require']['obser']['post_core']?></th>
		<th scope="col" class="split category3"><?php echo $d['khusd_st_consv']['require']['obser']['others']?></th>
		<th scope="col" class="split category3"><?php echo $d['khusd_st_consv']['require']['obser']['surgery']?></th>
		<th scope="col" class="split category3"><?php echo $d['khusd_st_consv']['require']['obser']['miscellaneous']?></th>
		<th scope="col" class="split category3"></th>
		<th scope="col" class="split"></th>
		<th scope="col" class="split"></th>
		<!--<<th scope="col" class="split"></th>
		<th scope="col" class="split"></th>-->
		<th colspan="3" scope="col" class="split category4"></th>
	</tr>
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
		<!--<<td class="avg"><?php echo sprintf("%1d",$AVG['pre_st_endo'])?>명</td>-->
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['indirect_prep_imp'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['indirect_setting'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['am'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['tooth_colored_simple'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['tooth_colored_complex'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['tooth_colored_diastema'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['post_core'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['others'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['surgery'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['miscellaneous'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['op_score'])?></td>
		<!--<<td class="avg"><?php echo sprintf("%1d",$AVG['pre_st_am'])?>명</td>
		<td class="avg"><?php echo sprintf("%1d",$AVG['pre_st_op'])?>명</td>-->
		<td class="avg"><?php echo sprintf("%1d",$AVG['pre_st_inlay_gold'])?></td>
		<td class="avg"><?php echo sprintf("%1d",$AVG['pre_st_inlay_resin'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['plus_score'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['minus_sc'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['obser_score'])?></td>
		<td></td>
	</tr>

	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>

	<?php if(is_array($SCORE_ARRAY[$my['id']])):?>
	<?php $SCORE = $SCORE_ARRAY[$my['id']]?>
	<tr class="mine">
	<td colspan="2">내점수</td>

<!--	<td><?php echo $SCORE['fol_ind']?></td>
	<td><?php echo $SCORE['fol_endapm']?></td>
	<td><?php echo $SCORE['fol_endm']?></td>
	<td><?php echo $SCORE['fol_sur']?></td>
	<td><?php echo $SCORE['fol_ble']?></td>
	<td><?php echo $SCORE['fol_sc']?></td>
	<td><?php echo $SCORE['fol_sc_m']?></td>
	<td><?php echo $SCORE['fol_sc_obs']?></td>-->
	<td><?php echo $SCORE['endo_molar']?></td>
	<td><?php echo $SCORE['endo_pre']?></td>
	<td><?php echo $SCORE['endo_ant']?></td>
	<td><?php echo $SCORE['endo_etc']?></td>
	<td class="category3"><?php echo $SCORE['endo_score']?></td>
<!--	<td><?php echo ($SCORE['pre_st_endo'] == 1 ? '완' : '')?></td>-->
	<td class="category1"><?php echo $SCORE['indirect_prep_imp']?></td>
	<td class="category1"><?php echo $SCORE['indirect_setting']?></td>
	<td class="category1"><?php echo $SCORE['am']?></td>
	<td class="category2"><?php echo $SCORE['tooth_colored_simple']?></td>
	<td class="category2"><?php echo $SCORE['tooth_colored_complex']?></td>
	<td class="category2"><?php echo $SCORE['tooth_colored_diastema']?></td>
	<td class="category2"><?php echo $SCORE['post_core']?></td>
	<td><?php echo $SCORE['others']?></td>
	<td class="category2"><?php echo $SCORE['surgery']?></td>
	<td class="category2"><?php echo $SCORE['miscellaneous']?></td>
	<td class="category3"><?php echo $SCORE['op_score']?></td>
<!--	<td><?php echo ($SCORE['pre_st_am'] == 1 ? '완' : '')?></td>
	<td><?php echo ($SCORE['pre_st_op'] == 1 ? '완' : '')?></td>-->
	<td><?php echo ($SCORE['pre_st_inlay_gold'] == 1 ? '완' : ($SCORE['pre_st_inlay_gold_prep'].'/'.$SCORE['pre_st_inlay_gold_setting']))?></td>
	<td><?php echo ($SCORE['pre_st_inlay_resin'] == 1 ? '완' : ($SCORE['pre_st_inlay_resin_prep'].'/'.$SCORE['pre_st_inlay_resin_setting']))?></td>
	<td class="category4"><?php echo $SCORE['plus_score']?></td>
	<td class="category4"><?php echo "-".$SCORE['minus_sc']?></td>
	<td class="category4"><?php echo $SCORE['obser_score']?></td>
	
	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endif?>


	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
		<td><?php echo $idx++?></td>
		<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);">
			<p><?php echo $SCORE['st_id']?> <?php echo $SCORE['st_info']['name']?></p>
		</td>
		
<!--		<td><?php echo $SCORE['fol_ind']?></td>
		<td><?php echo $SCORE['fol_endapm']?></td>
		<td><?php echo $SCORE['fol_endm']?></td>
		<td><?php echo $SCORE['fol_sur']?></td>
		<td><?php echo $SCORE['fol_ble']?></td>
		<td><?php echo $SCORE['fol_sc']?></td>
		<td><?php echo $SCORE['fol_sc_m']?></td>
		<td><?php echo $SCORE['fol_sc_obs']?></td>-->
		<td><?php echo $SCORE['endo_molar']?></td>
		<td><?php echo $SCORE['endo_pre']?></td>
		<td><?php echo $SCORE['endo_ant']?></td>
		<td><?php echo $SCORE['endo_etc']?></td>
		<td class="category3"><?php echo $SCORE['endo_score']?></td>
<!--		<td><?php echo ($SCORE['pre_st_endo'] == 1 ? '완' : '')?></td>-->
		<td class="category1"><?php echo $SCORE['indirect_prep_imp']?></td>
		<td class="category1"><?php echo $SCORE['indirect_setting']?></td> 
		<td class="category1"><?php echo $SCORE['am']?></td>
		<td class="category2"><?php echo $SCORE['tooth_colored_simple']?></td>
		<td class="category2"><?php echo $SCORE['tooth_colored_complex']?></td>
		<td class="category2"><?php echo $SCORE['tooth_colored_diastema']?></td>
		<td class="category2"><?php echo $SCORE['post_core']?></td>
		<td><?php echo $SCORE['others']?></td>
		<td class="category2"><?php echo $SCORE['surgery']?></td>
		<td class="category2"><?php echo $SCORE['miscellaneous']?></td>
		<td class="category3"><?php echo $SCORE['op_score']?></td>
<!--		<td><?php echo ($SCORE['pre_st_am'] == 1 ? '완' : '')?></td>
		<td><?php echo ($SCORE['pre_st_op'] == 1 ? '완' : '')?></td>-->
		<td><?php echo ($SCORE['pre_st_inlay_gold'] == 1 ? '완' : ($SCORE['pre_st_inlay_gold_prep'].'/'.$SCORE['pre_st_inlay_gold_setting']))?></td>
		<td><?php echo ($SCORE['pre_st_inlay_resin'] == 1 ? '완' : ($SCORE['pre_st_inlay_resin_prep'].'/'.$SCORE['pre_st_inlay_resin_setting']))?></td>
		<td class="category4"><?php echo $SCORE['plus_score']?></td>
		<td class="category4"><?php echo "-".$SCORE['minus_sc']?></td>
		<td class="category4"><?php echo $SCORE['obser_score']?></td>
	
	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>