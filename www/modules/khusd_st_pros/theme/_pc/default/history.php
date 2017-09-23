<div id="pros_history" class="khusd_st list pros">

	<table summary="보철과 점수표 기록입니다.">
	<caption>보철과 점수표 기록</caption> 
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
	<col width="150"> 
	</colgroup> 
	<thead>
	<tr>
	<th rowspan="2" scope="col" class="split">No</th>
	<th rowspan="2" scope="col" class="split">학번</th>
	<th rowspan="2" scope="col" class="split">이름</th>
	<th colspan="3" scope="col" class="split">2년차 Cr</th>
	<th colspan="3" scope="col" class="split">Post Core</th>
	<th colspan="3" scope="col" class="split">Impl. Cr&Br</th>
	<th colspan="3" scope="col" class="split">Single Cr</th>
	<th colspan="3" scope="col" class="split">Br.</th>
	<th colspan="3" scope="col" class="split">RPD</th>
	<th colspan="3" scope="col" class="split">CD</th>
	<th colspan="3" scope="col" class="split">단순 Obs</th>
	<th colspan="2" scope="col" class="split">총점</th>
	<th rowspan="2" scope="col">수정일</th>
	</tr>
	<tr>
	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완</th>
	<th scope="col" class="split">취소</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완</th>
	<th scope="col" class="split">취소</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완</th>
	<th scope="col" class="split">취소</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완</th>
	<th scope="col" class="split">취소</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완</th>
	<th scope="col" class="split">취소</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완</th>
	<th scope="col" class="split">취소</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완</th>
	<th scope="col" class="split">취소</th>

	<th scope="col" class="split">1cycle</th>
	<th scope="col" class="split">2cycle</th>
	<th scope="col" class="split">3cycle</th>

	<th scope="col" class="split">실제점수</a></th>
	<th scope="col" class="split">예상점수</a></th>
	</tr>
	</thead>
	<tbody>
	
	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>
	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr>
	<td><?php echo $idx++?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_id']?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_info']['name']?></td>

	<td class="category1"><?php echo $SCORE['second_cr_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['second_cr_complete']?></td>
	<td><?php echo $SCORE['second_cr_cancel']?></td>
	
	<td class="category1"><?php echo $SCORE['post_core_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['post_core_complete']?></td>
	<td><?php echo $SCORE['post_core_cancel']?></td>
	
	<td class="category1"><?php echo $SCORE['imp_cr_br_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['imp_cr_br_complete']?></td>
	<td><?php echo $SCORE['imp_cr_br_cancel']?></td>
	
	<td class="category1"><?php echo $SCORE['single_cr_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['single_cr_complete']?></td>
	<td><?php echo $SCORE['single_cr_cancel']?></td>
	
	<td class="category1"><?php echo $SCORE['br_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['br_complete']?></td>
	<td><?php echo $SCORE['br_cancel']?></td>
	
	<td class="category1"><?php echo $SCORE['partial_denture_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['partial_denture_complete']?></td>
	<td><?php echo $SCORE['partial_denture_cancel']?></td>
	
	<td class="category1"><?php echo $SCORE['complete_denture_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['complete_denture_complete']?></td>
	<td><?php echo $SCORE['complete_denture_cancel']?></td>

	<td><?php echo $SCORE['simple_obser_3_8']?></td>
	<td><?php echo $SCORE['simple_obser_3_10']?></td>
	<td><?php echo $SCORE['simple_obser_3_12']?></td>
	
	<td class="category4"><?php echo $SCORE['total_score']?></td>
	<td class="category4"><?php echo $SCORE['total_predict_score']?></td>

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
