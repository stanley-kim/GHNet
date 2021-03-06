<div id="pros_history" class="khusd_st list pros">

        <?php $SEMESTER_INFO = getCurrentSemesterInfo()  ?>

	<table summary="보철과 점수표 기록입니다.">
	<caption>보철과 점수표 기록</caption> 
	<colgroup> 
	<col width="35">
	<col width="125"> 
	<col width="120"> 

<!--
	<col width="40"> 
	<col width="40"> 
	<col width="40"> 
-->
                <?php if( $SEMESTER_INFO['sid'] == 2  ||  $SEMESTER_INFO['sid'] == 3 ):?>
	<?php $idx = 0?>
	<?php while($idx < 54):?>
	<col width="40"> 
	<?php $idx += 1?>
	<?php endwhile?>
                <?php endif?>
        <col width="40">
        <col width="40">
        <col width="40">
        <col width="40">

<?php if($SEMESTER_INFO['sid'] == 2):?>
        <col width="40">
        <col width="40">
        <col width="40">
        <col width="40">
<?php elseif ($SEMESTER_INFO['sid'] == 3 && $simple_obser_type == $cycle_type) : ?>
        <col width="40">
        <col width="40">
        <col width="40">
        <col width="40">
        <col width="40">
<?php elseif ($SEMESTER_INFO['sid'] == 3 && $simple_obser_type == $month_type) : ?>
        <col width="40">
        <col width="40">
        <col width="40">
        <col width="40">
        <col width="40">
        <col width="40">
        <col width="40">
        <col width="40">
<?php endif?>

 
<!--
	<col width="40"> 
	<col width="40"> 
-->
	<col width="150"> 
 
	</colgroup> 
	<thead>
	<tr>
	<th rowspan="3" scope="col" class="split">No</th>
	<th rowspan="3" scope="col" class="split">학번</th>
	<th rowspan="3" scope="col" class="split">이름</th>
<!--
	<th colspan="3" scope="col" class="split">2년차 Cr</th>
-->
                <?php if( $SEMESTER_INFO['sid'] == 2  ||  $SEMESTER_INFO['sid'] == 3 ):?>
	<th colspan="9" scope="col" class="split">Post Core</th>
	<th colspan="9" scope="col" class="split">Impl. Cr&Br</th>
	<th colspan="9" scope="col" class="split">Single Cr</th>
	<th colspan="9" scope="col" class="split">Br.</th>
	<th colspan="9" scope="col" class="split">RPD</th>
	<th colspan="9" scope="col" class="split">CD</th>
	<th rowspan="3" scope="col" class="split">총팔로우</th>
               <?php endif?>
        <th rowspan="3" scope="col" class="split">ST1</th>
        <th rowspan="3" scope="col" class="split">ST2</th>
        <th rowspan="3" scope="col" class="split">ST3</th>

        <?php if($SEMESTER_INFO['sid'] == 2):?>
        <th colspan="4" scope="col" class="split">단순 Obs</th>
        <?php elseif ($SEMESTER_INFO['sid'] == 3 && $simple_obser_type == $cycle_type) : ?>
        <th colspan="5" scope="col" class="split">단순 Obs</th>
        <?php elseif ($SEMESTER_INFO['sid'] == 3 && $simple_obser_type == $month_type) : ?>
        <th colspan="8" scope="col" class="split">단순 Obs</th>
        <?php endif?>

<!--
	<th colspan="2" scope="col" class="split">총점</th>
-->
	<th rowspan="3" scope="col">수정일</th>
	</tr>
	<tr>
<!--
	<th rowspan="2" scope="col" class="split">진행</th>
	<th rowspan="2" scope="col" class="split">완</th>
	<th rowspan="2" scope="col" class="split">취소</th>
-->

                <?php if( $SEMESTER_INFO['sid'] == 2  ||  $SEMESTER_INFO['sid'] == 3 ):?>

	<?php $idx = 0?>
	<?php while($idx < 6):?>
        <th colspan="3" scope="col" class="split">선생님</th>
        <th colspan="3" scope="col" class="split">교수님</th>
        <th colspan="3" scope="col" class="split">전체</th>
	<?php $idx += 1?>
	<?php endwhile?>
                <?php endif?>
        <?php if($SEMESTER_INFO['sid'] == 2):?>
        <th rowspan="2" scope="col" class="split">1c</th>
        <th rowspan="2" scope="col" class="split">2c</th>
        <th rowspan="2" scope="col" class="split">3c</th>
        <th rowspan="2" scope="col" class="split">합계</th>
        <?php elseif ($SEMESTER_INFO['sid'] == 3 && $simple_obser_type == $cycle_type) : ?>
        <th rowspan="2" scope="col" class="split">1c</th>
        <th rowspan="2" scope="col" class="split">2c</th>
        <th rowspan="2" scope="col" class="split">3c</th>
        <th rowspan="2" scope="col" class="split">4c</th>
        <th rowspan="2" scope="col" class="split">합계</th>
        <?php elseif ($SEMESTER_INFO['sid'] == 3 && $simple_obser_type == $month_type) : ?>
        <th rowspan="2" scope="col" class="split">1m</th>
        <th rowspan="2" scope="col" class="split">2m</th>
        <th rowspan="2" scope="col" class="split">3m</th>
        <th rowspan="2" scope="col" class="split">4m</th>
        <th rowspan="2" scope="col" class="split">5m</th>
        <th rowspan="2" scope="col" class="split">6m</th>
        <th rowspan="2" scope="col" class="split">7m</th>
        <th rowspan="2" scope="col" class="split">합계</th>
        <?php endif?>


<!--
	<th rowspan="2" scope="col" class="split">실제점수</a></th>
	<th rowspan="2" scope="col" class="split">예상점수</a></th>
-->
	</tr>
               <?php if( $SEMESTER_INFO['sid'] == 2  ||  $SEMESTER_INFO['sid'] == 3 ):?>
	<tr>
	<?php $idx = 0?>
	<?php while($idx < 18):?>
	<th scope="col" class="split">진행</th>
        <th scope="col" class="split">완료</th>
        <th scope="col" class="split">합</th>
	<?php $idx += 1?>
	<?php endwhile?>

	</tr>
                <?php endif?>
	</thead>
	<tbody>
	
	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>
	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr>
	<td><?php echo $idx++?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_id']?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_info']['name']?></td>
<!--
	<td class="category1"><?php echo $SCORE['second_cr_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['second_cr_complete']?></td>
	<td><?php echo $SCORE['second_cr_cancel']?></td>
-->	
                <?php if( $SEMESTER_INFO['sid'] == 2  ||  $SEMESTER_INFO['sid'] == 3 ):?>
	<td class="category1"><?php echo $SCORE['post_core_ongoing']?></td>
        <td class="category1"><?php echo $SCORE['post_core_complete']?></td>
        <td ><?php echo $SCORE['post_core_total_resident']?></td>
        <td class="category1"><?php echo $SCORE['post_core_ongoing_prof']?></td>
        <td class="category1"><?php echo $SCORE['post_core_complete_prof']?></td>
        <td ><?php echo $SCORE['post_core_total_prof']?></td>
        <td ><?php echo $SCORE['post_core_total_ongoing']?></td>
        <td ><?php echo $SCORE['post_core_total_complete']?></td>
        <td ><?php echo $SCORE['post_core']?></td>
	
        <td class="category2"><?php echo $SCORE['imp_cr_br_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['imp_cr_br_complete']?></td>
        <td ><?php echo $SCORE['imp_cr_br_total_resident']?></td>
        <td class="category2"><?php echo $SCORE['imp_cr_br_ongoing_prof']?></td>
        <td class="category2"><?php echo $SCORE['imp_cr_br_complete_prof']?></td>
        <td ><?php echo $SCORE['imp_cr_br_total_prof']?></td>
        <td ><?php echo $SCORE['imp_cr_br_total_ongoing']?></td>
        <td ><?php echo $SCORE['imp_cr_br_total_complete']?></td>
        <td ><?php echo $SCORE['imp_cr_br']?></td>
	
	<td class="category1"><?php echo $SCORE['single_cr_ongoing']?></td>
        <td class="category1"><?php echo $SCORE['single_cr_complete']?></td>
        <td ><?php echo $SCORE['single_cr_total_resident']?></td>
        <td class="category1"><?php echo $SCORE['single_cr_ongoing_prof']?></td>
        <td class="category1"><?php echo $SCORE['single_cr_complete_prof']?></td>
        <td ><?php echo $SCORE['single_cr_total_prof']?></td>
        <td ><?php echo $SCORE['single_cr_total_ongoing']?></td>
        <td ><?php echo $SCORE['single_cr_total_complete']?></td>
        <td ><?php echo $SCORE['single_cr']?></td>
	
        <td class="category2"><?php echo $SCORE['br_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['br_complete']?></td>
        <td ><?php echo $SCORE['br_total_resident']?></td>
        <td class="category2"><?php echo $SCORE['br_ongoing_prof']?></td>
        <td class="category2"><?php echo $SCORE['br_complete_prof']?></td>
        <td ><?php echo $SCORE['br_total_prof']?></td>
        <td ><?php echo $SCORE['br_total_ongoing']?></td>
        <td ><?php echo $SCORE['br_total_complete']?></td>
        <td ><?php echo $SCORE['br']?></td>
	
	<td class="category1"><?php echo $SCORE['partial_denture_ongoing']?></td>
        <td class="category1"><?php echo $SCORE['partial_denture_complete']?></td>
        <td ><?php echo $SCORE['partial_denture_total_resident']?></td>
        <td class="category1"><?php echo $SCORE['partial_denture_ongoing_prof']?></td>
        <td class="category1"><?php echo $SCORE['partial_denture_complete_prof']?></td>
        <td ><?php echo $SCORE['partial_denture_total_prof']?></td>
        <td ><?php echo $SCORE['partial_denture_total_ongoing']?></td>
        <td ><?php echo $SCORE['partial_denture_total_complete']?></td>
        <td ><?php echo $SCORE['partial_denture']?></td>
	
        <td class="category2"><?php echo $SCORE['complete_denture_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['complete_denture_complete']?></td>
        <td ><?php echo $SCORE['complete_denture_total_resident']?></td>
        <td class="category2"><?php echo $SCORE['complete_denture_ongoing_prof']?></td>
        <td class="category2"><?php echo $SCORE['complete_denture_complete_prof']?></td>
        <td ><?php echo $SCORE['complete_denture_total_prof']?></td>
        <td ><?php echo $SCORE['complete_denture_total_ongoing']?></td>
        <td ><?php echo $SCORE['complete_denture_total_complete']?></td>
        <td ><?php echo $SCORE['complete_denture']?></td>
        <td ><?php echo $SCORE['total_follow']?></td>
               <?php endif?>


        <td ><?php echo substr($SCORE['pros_st_case_1'],0,10)?></td>
        <td ><?php echo substr($SCORE['pros_st_case_2'],0,10)?></td>
        <td ><?php echo substr($SCORE['pros_st_case_3'],0,10)?></td>

        <?php if($SEMESTER_INFO['sid'] == 2):?>
        <td class="category1"><?php echo $SCORE['simple_obser_3_8']?></td>
        <td class="category1"><?php echo $SCORE['simple_obser_3_10']?></td>
        <td class="category1"><?php echo $SCORE['simple_obser_3_12']?></td>
        <?php elseif ($SEMESTER_INFO['sid'] == 3 && $simple_obser_type == $cycle_type) : ?>
        <td class="category1"><?php echo $SCORE['simple_obser_4_1cycle']?></td>
        <td class="category1"><?php echo $SCORE['simple_obser_4_2cycle']?></td>
        <td class="category1"><?php echo $SCORE['simple_obser_4_3cycle']?></td>
        <td class="category1"><?php echo $SCORE['simple_obser_4_4cycle']?></td>
        <?php elseif ($SEMESTER_INFO['sid'] == 3 && $simple_obser_type == $month_type) : ?>
        <td class="category1"><?php echo $SCORE['simple_obser_4_1']?></td>
        <td class="category1"><?php echo $SCORE['simple_obser_4_2']?></td>
        <td class="category1"><?php echo $SCORE['simple_obser_4_3']?></td>
        <td class="category1"><?php echo $SCORE['simple_obser_4_4']?></td>
        <td class="category1"><?php echo $SCORE['simple_obser_4_5']?></td>
        <td class="category1"><?php echo $SCORE['simple_obser_4_6']?></td>
        <td class="category1"><?php echo $SCORE['simple_obser_4_7']?></td>
        <?php endif?>
               <?php if( $SEMESTER_INFO['sid'] == 2  ||  $SEMESTER_INFO['sid'] == 3 ):?>

        <td><?php echo $SCORE['total_simple_obser']?></td>
                <?php endif?>
<!--	
	<td class="category4"><?php echo $SCORE['total_score']?></td>
	<td class="category4"><?php echo $SCORE['total_predict_score']?></td>
-->
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
