<div id="consv_history" class="khusd_st list consv">

       <?php $SEMESTER_INFO = getCurrentSemesterInfo()  ?>

	<table summary="보존과 점수표 기록입니다.">
	<caption>보존과 점수표 기록</caption> 
	<colgroup> 
	<col width="35">
	<col width="125"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
        <?php if($SEMESTER_INFO['sid'] == 2):?>
	<col width="40"> 
        <?php endif?>
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
        <?php if($SEMESTER_INFO['sid'] == 2):?>
		<th colspan="6" scope="col" class="split category2">[Endodontic Tx.]</th>
        <?php endif?>
        <?php if($SEMESTER_INFO['sid'] == 3):?>
		<th colspan="5" scope="col" class="split category2">[Endodontic Tx.]</th>
        <?php endif?>
		<th colspan="13" scope="col" class="split category3">[일반]</th>
		<th colspan="3" scope="col" class="split category4"></th>
		<th rowspan="3" scope="col" class="category5">수정일</th>
	</tr>
	<tr>
		<th colspan="4" scope="col" class="split category2">obs.</th>
		<th rowspan="2" scope="col" class="split category2">점수</th>
        <?php if($SEMESTER_INFO['sid'] == 2):?>
		<th rowspan="2" scope="col" class="split category2">PRe St(Endo)</th>
        <?php endif?>
		<th colspan="2" scope="col" class="split category3">Indirect</th>
		<th rowspan="2" scope="col" class="split category3">AF</th>
		<th colspan="3" scope="col" class="split category3">Tooth colored</th>
		<th rowspan="2" scope="col" class="split category3">P/C</th>
		<th rowspan="2" scope="col" class="split category3">oth</th>
		<th rowspan="2" scope="col" class="split category3">Sur</th>
		<th rowspan="2" scope="col" class="split category3">Mis</th>
		<th rowspan="2" scope="col" class="split category3">점수</th>
                <?php if($SEMESTER_INFO['sid'] == 2):?>

		<th rowspan="2" scope="col" class="split category3">Pre ST(AF)</th>
		<th rowspan="2" scope="col" class="split category3">Pre ST(OP)</th>
                <?php endif?>
                <?php if($SEMESTER_INFO['sid'] == 3):?>

                <th rowspan="2" scope="col" class="split category3">Pre ST(Inlay Gold)</th>
                <th rowspan="2" scope="col" class="split category3">Pre ST(Inlay Resin)</th>
                <?php endif?>

		<th rowspan="2" scope="col" class="split category4">득점</th>
		<th rowspan="2" scope="col" class="split category4">감점</th>
		<th rowspan="2" scope="col" class="split category4">총점</th>
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
	
		<td><?php echo $SCORE['endo_molar']?></td>
		<td><?php echo $SCORE['endo_pre']?></td>
		<td><?php echo $SCORE['endo_ant']?></td>
		<td><?php echo $SCORE['endo_etc']?></td>
		<td class="category3"><?php echo $SCORE['endo_score']?></td>
        	<?php if($SEMESTER_INFO['sid'] == 2):?>
		<td><?php echo ($SCORE['pre_st_endo'] == 1 ? '완' : '')?></td>
                <?php endif?>
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
                <?php if($SEMESTER_INFO['sid'] == 2):?>

		<td><?php echo ($SCORE['pre_st_am'] == 1 ? '완' : '')?></td>
		<td><?php echo ($SCORE['pre_st_op'] == 1 ? '완' : '')?></td>
                <?php endif?>

                <?php if($SEMESTER_INFO['sid'] == 3):?>

        <td><?php echo ($SCORE['pre_st_inlay_gold'] == 1 ? '완' : ($SCORE['pre_st_inlay_gold_prep'].'/'.$SCORE['pre_st_inlay_gold_setting']))?></td>
        <td><?php echo ($SCORE['pre_st_inlay_resin'] == 1 ? '완' : ($SCORE['pre_st_inlay_resin_prep'].'/'.$SCORE['pre_st_inlay_resin_setting']))?></td>
                <?php endif?>

		<td class="category4"><?php echo $SCORE['plus_score']?></td>
		<td class="category4"><?php echo $SCORE['minus_score']?></td>
		<td class="category4"><?php echo $SCORE['obser_score']?></td>
	
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
			<?php echo getPageLink($d['theme']['pagenum'],$p,$TPG,$g['img_core'].'/page/default')?>
		</div>
	</div>
	
</div>
