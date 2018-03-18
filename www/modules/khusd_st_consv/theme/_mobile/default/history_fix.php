<div id="consv_history" class="khusd_st list consv">

	<table summary="보존과 점수표 기록입니다.">
	<caption>보존과 픽스 점수표 기록</caption> 
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
	<col width="200"> 
	</colgroup> 
	<thead>
	<tr>
		<th rowspan="3" scope="col" class="split category1">No</th>
		<th rowspan="3" scope="col" class="split category1">학번,이름</th>
		<th colspan="5" scope="col" class="split category2">[Endodontic Tx.]</th>
		<th colspan="11" scope="col" class="split category3">[일반]</th>
		<th rowspan="3" scope="col" class="split category4">총점</th>
		<th rowspan="3" scope="col" class="category5">수정일</th>
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
	</tr>
	<tr>
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
	</thead>
	<tbody>
	
	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>
	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr>
		<td><?php echo $idx++?></td>
		<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);">
			<p><?php echo $SCORE['st_id']?></p>
			<p><?php echo $SCORE['st_info']['name']?></p>
		</td>
	
		<td><?php echo $SCORE['f_endo_molar_pe']+$SCORE['f_endo_molar_ce']+$SCORE['f_endo_molar_cf'] ?></td>
		<td><?php echo $SCORE['f_endo_pre_pe']+ $SCORE['f_endo_pre_ce']+$SCORE['f_endo_pre_cf'] ?></td>
		<td><?php echo $SCORE['f_endo_ant_pe']+$SCORE['f_endo_ant_ce']+ $SCORE['f_endo_ant_cf'] ?></td>
		<td><?php echo $SCORE['f_endo_molar_etc']+$SCORE['f_endo_pre_etc']+$SCORE['f_endo_ant_etc']?></td>
		<td class="category3"><?php echo $SCORE['endo_score']?></td>
		<td class="category1"><?php echo $SCORE['f_indirect_prep_imp']?></td>
		<td class="category1"><?php echo $SCORE['f_indirect_setting']?></td>
		<td class="category1"><?php echo $SCORE['f_am']?></td>
		<td class="category2"><?php echo $SCORE['f_tooth_colored_simple']?></td>
		<td class="category2"><?php echo $SCORE['f_tooth_colored_complex']?></td>
		<td class="category2"><?php echo $SCORE['f_tooth_colored_diastema']?></td>
		<td class="category2"><?php echo $SCORE['f_post_core']?></td>
		<td><?php echo $SCORE['f_others']?></td>
		<td class="category2"><?php echo $SCORE['f_charting']?></td>
		<td class="category2"><?php echo $SCORE['f_miscellaneous']?></td>
		<td class="category3"><?php echo $SCORE['op_score']?></td>
		<td class="category4"><?php echo $SCORE['fix_score']?></td>
	
	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>

	<div class="bottom">
		<div class="btnbox1">
		</div>
		<div class="btnbox2"></div>
		<div class="clear"></div>
		<div class="pagebox01">
			<?php echo getPageLink_fix($d['theme']['pagenum'],$p,$TPG,$g['img_core'].'/page/default')?>
		</div>
	</div>
	
</div>
