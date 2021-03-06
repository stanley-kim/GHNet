<div id="pros_list" class="khusd_st list pros">

        <?php $SEMESTER_INFO = getCurrentSemesterInfo()  ?>

	<?php getWidget('khusd/semester_selector',array())?>
	
	<table summary="보철과 점수표 입니다.">
	<caption>보철과 점수표</caption> 
	<colgroup> 
	<col width="35">
	<col width="125"> 
	<col width="120"> 
	<!--<col width="40"> 
	<col width="40"> 
	<col width="40"> 
	<col width="40"> -->
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


	<col width="150"> 
	</colgroup> 
	<thead>
	<tr>
	<?php if($MANAGER):?>
	<th rowspan="2" scope="col" class="split">No</th>
	<th rowspan="2" scope="col" class="split"><a href="<?php echo getSortingLink($c, 'st_id', $om)?>">학번</a></th>
	<th rowspan="2" scope="col" class="split"><a href="<?php echo getSortingLink($c, 'name', $om)?>">이름</a></th>
	<?php else:?>
	<th rowspan="2" scope="col" class="split">No</th>
	<th rowspan="2" scope="col" class="split">학번</th>
	<th rowspan="2" scope="col" class="split">이름</th>
	<?php endif?>
<!--	<th colspan="4" scope="col" class="split">2년차 Cr</th>-->
	<th colspan="4" scope="col" class="split">Post Core</th>
	<th colspan="4" scope="col" class="split">Impl. Cr&Br</th>
	<th colspan="4" scope="col" class="split">Single Cr</th>
	<th colspan="4" scope="col" class="split">Br.</th>
	<th colspan="4" scope="col" class="split">RPD</th>
	<th colspan="4" scope="col" class="split">CD</th>

        <?php if($SEMESTER_INFO['sid'] == 2):?>
        <th colspan="4" scope="col" class="split">단순 Obs</th>
        <?php elseif ($SEMESTER_INFO['sid'] == 3 && $simple_obser_type == $cycle_type) : ?>
        <th colspan="5" scope="col" class="split">단순 Obs</th>
        <?php elseif ($SEMESTER_INFO['sid'] == 3 && $simple_obser_type == $month_type) : ?>
        <th colspan="8" scope="col" class="split">단순 Obs</th>
        <?php endif?>


	<th colspan="2" scope="col" class="split">총점</th>
	<th rowspan="2" scope="col">수정일</th>
	</tr>
	<tr>
	<?php if($MANAGER):?>
<!--	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'second_cr_ongoing', $om)?>">진행</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'second_cr_complete', $om)?>">완료</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'second_cr_prev', $om)?>">지난학기</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'second_cr', $om)?>">진행+완료</a></th>-->

	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'post_core_ongoing', $om)?>">진행</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'post_core_complete', $om)?>">완료</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'post_core_prev', $om)?>">지난학기</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'post_core', $om)?>">진행+완료</a></th>

	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'imp_cr_br_ongoing', $om)?>">진행</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'imp_cr_br_complete', $om)?>">완료</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'imp_cr_br_prev', $om)?>">지난학기</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'imp_cr_br', $om)?>">진행+완료</a></th>

	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'single_cr_ongoing', $om)?>">진행</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'single_cr_complete', $om)?>">완료</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'single_cr_prev', $om)?>">지난학기</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'single_cr', $om)?>">진행+완료</a></th>

	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'br_ongoing', $om)?>">진행</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'br_complete', $om)?>">완료</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'br_prev', $om)?>">지난학기</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'br', $om)?>">진행+완료</a></th>

	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'partial_denture_ongoing', $om)?>">진행</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'partial_denture_complete', $om)?>">완료</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'partial_denture_prev', $om)?>">지난학기</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'partial_denture', $om)?>">진행+완료</a></th>

	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'complete_denture_ongoing', $om)?>">진행</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'complete_denture_complete', $om)?>">완료</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'complete_denture_prev', $om)?>">지난학기</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'complete_denture', $om)?>">진행+완료</a></th>
<?php if($SEMESTER_INFO['sid'] == 2):?>

	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'simple_obser_3_8', $om)?>">1cycle</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'simple_obser_3_9', $om)?>">2cycle</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'simple_obser_3_10', $om)?>">3cycle</a></th>
<?php elseif ($SEMESTER_INFO['sid'] == 3 && $simple_obser_type == $cycle_type) : ?>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'simple_obser_4_1cycle', $om)?>">1cycle</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'simple_obser_4_2cycle', $om)?>">2cycle</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'simple_obser_4_3cycle', $om)?>">3cycle</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'simple_obser_4_4cycle', $om)?>">3cycle</a></th>
<?php elseif ($SEMESTER_INFO['sid'] == 3 && $simple_obser_type == $month_type) : ?>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'simple_obser_4_1', $om)?>">1월</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'simple_obser_4_2', $om)?>">2월</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'simple_obser_4_3', $om)?>">3월</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'simple_obser_4_4', $om)?>">4월</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'simple_obser_4_5', $om)?>">5월</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'simple_obser_4_6', $om)?>">6월</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'simple_obser_4_7', $om)?>">7월</a></th>
<?php endif?>

	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'total_simple_obser', $om)?>">합</a></th>

	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'total_score', $om)?>">실제점수</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink($c, 'total_predict_score', $om)?>">예상점수</a></th>
	<?php else:?>
<!--	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">지난학기</th>
	<th scope="col" class="split">진행+완료</th>-->

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">지난학기</th>
	<th scope="col" class="split">진행+완료</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">지난학기</th>
	<th scope="col" class="split">진행+완료</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">지난학기</th>
	<th scope="col" class="split">진행+완료</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">지난학기</th>
	<th scope="col" class="split">진행+완료</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">지난학기</th>
	<th scope="col" class="split">진행+완료</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">지난학기</th>
	<th scope="col" class="split">진행+완료</th>

<?php if($SEMESTER_INFO['sid'] == 2):?>
	<th scope="col" class="split">1cycle</th>
	<th scope="col" class="split">2cycle</th>
	<th scope="col" class="split">3cycle</th>
<?php elseif ($SEMESTER_INFO['sid'] == 3 && $simple_obser_type == $cycle_type) : ?>
	<th scope="col" class="split">1cycle</th>
	<th scope="col" class="split">2cycle</th>
	<th scope="col" class="split">3cycle</th>
        <th scope="col" class="split">4cycle</th>
<?php elseif ($SEMESTER_INFO['sid'] == 3 && $simple_obser_type == $month_type) : ?>
	<th scope="col" class="split">1월</th>
	<th scope="col" class="split">2월</th>
	<th scope="col" class="split">3월</th>
        <th scope="col" class="split">4월</th>
        <th scope="col" class="split">5월</th>
        <th scope="col" class="split">6월</th>
        <th scope="col" class="split">7월</th>
<?php endif?>

	<th scope="col" class="split">합</th>

	<th scope="col" class="split">실제점수</a></th>
	<th scope="col" class="split">예상점수</a></th>
	<?php endif?>
	</tr>
	</thead>
	<tbody>
	
	<tr>
		<td></td>
		<td></td>
		<td class="avg">평균</th>
<!--		<td class="avg"><?php echo sprintf("%1.1f",$AVG['second_cr_ongoing'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['second_cr_complete'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['second_cr_prev'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['second_cr'])?></td>-->

		<td class="avg"><?php echo sprintf("%1.1f",$AVG['post_core_ongoing'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['post_core_complete'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['post_core_prev'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['post_core'])?></td>

		<td class="avg"><?php echo sprintf("%1.1f",$AVG['imp_cr_br_ongoing'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['imp_cr_br_complete'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['imp_cr_br_prev'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['imp_cr_br'])?></td>

		<td class="avg"><?php echo sprintf("%1.1f",$AVG['single_cr_ongoing'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['single_cr_complete'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['single_cr_prev'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['single_cr'])?></td>

		<td class="avg"><?php echo sprintf("%1.1f",$AVG['br_ongoing'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['br_complete'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['br_prev'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['br'])?></td>

		<td class="avg"><?php echo sprintf("%1.1f",$AVG['partial_denture_ongoing'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['partial_denture_complete'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['partial_denture_prev'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['partial_denture'])?></td>

		<td class="avg"><?php echo sprintf("%1.1f",$AVG['complete_denture_ongoing'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['complete_denture_complete'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['complete_denture_prev'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['complete_denture'])?></td>

        <?php if($SEMESTER_INFO['sid'] == 2):?>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['simple_obser_3_8'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['simple_obser_3_10'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['simple_obser_3_12'])?></td>
	 <?php elseif ($SEMESTER_INFO['sid'] == 3 && $simple_obser_type == $cycle_type) : ?>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['simple_obser_4_1cycle'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['simple_obser_4_2cycle'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['simple_obser_4_3cycle'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['simple_obser_4_4cycle'])?></td>
	<?php elseif ($SEMESTER_INFO['sid'] == 3 && $simple_obser_type == $month_type) : ?>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['simple_obser_4_1'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['simple_obser_4_2'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['simple_obser_4_3'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['simple_obser_4_4'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['simple_obser_4_5'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['simple_obser_4_6'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['simple_obser_4_7'])?></td>
        <?php endif?>

		<td class="avg"><?php echo sprintf("%1.1f",$AVG['total_simple_obser'])?></td>

		<td class="avg"><?php echo sprintf("%1.1f",$AVG['total_score'])?></td>
		<td class="avg"><?php echo sprintf("%1.1f",$AVG['total_predict_score'])?></td>
		<td></td>
	</tr>

	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>

	<?php if(is_array($SCORE_ARRAY[$my['id']])):?>
	<?php $SCORE = $SCORE_ARRAY[$my['id']]?>
	<tr class="mine">
	<td colspan="3">내점수</td>

<!--	<td class="category1"><?php echo $SCORE['second_cr_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['second_cr_complete']?></td>
	<td><?php echo $SCORE['second_cr_prev']?></td>
	<td class="category2"><?php echo $SCORE['second_cr']?></td>-->
	
	<td class="category1"><?php echo $SCORE['post_core_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['post_core_complete']?></td>
	<td><?php echo $SCORE['post_core_prev']?></td>
	<td class="category2"><?php echo $SCORE['post_core']?></td>
	
	<td class="category1"><?php echo $SCORE['imp_cr_br_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['imp_cr_br_complete']?></td>
	<td><?php echo $SCORE['imp_cr_br_prev']?></td>
	<td class="category2"><?php echo $SCORE['imp_cr_br']?></td>
	
	<td class="category1"><?php echo $SCORE['single_cr_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['single_cr_complete']?></td>
	<td><?php echo $SCORE['single_cr_prev']?></td>
	<td class="category2"><?php echo $SCORE['single_cr']?></td>
	
	<td class="category1"><?php echo $SCORE['br_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['br_complete']?></td>
	<td><?php echo $SCORE['br_prev']?></td>
	<td class="category2"><?php echo $SCORE['br']?></td>
	
	<td class="category1"><?php echo $SCORE['partial_denture_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['partial_denture_complete']?></td>
	<td><?php echo $SCORE['partial_denture_prev']?></td>
	<td class="category2"><?php echo $SCORE['partial_denture']?></td>
	
	<td class="category1"><?php echo $SCORE['complete_denture_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['complete_denture_complete']?></td>
	<td><?php echo $SCORE['complete_denture_prev']?></td>
	<td class="category2"><?php echo $SCORE['complete_denture']?></td>


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


	<td class="category2"><?php echo $SCORE['total_simple_obser']?></td>
	
	<td class="category4"><?php echo $SCORE['total_score']?></td>
	<td class="category4"><?php echo $SCORE['total_predict_score']?></td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endif?>



	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td><?php echo $idx++?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_id']?></td>
	<td class="hand" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_info']['name']?></td>

<!--	<td class="category1"><?php echo $SCORE['second_cr_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['second_cr_complete']?></td>
	<td><?php echo $SCORE['second_cr_prev']?></td>
	<td class="category2"><?php echo $SCORE['second_cr']?></td>-->
	
	<td class="category1"><?php echo $SCORE['post_core_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['post_core_complete']?></td>
	<td><?php echo $SCORE['post_core_prev']?></td>
	<td class="category2"><?php echo $SCORE['post_core']?></td>
	
	<td class="category1"><?php echo $SCORE['imp_cr_br_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['imp_cr_br_complete']?></td>
	<td><?php echo $SCORE['imp_cr_br_prev']?></td>
	<td class="category2"><?php echo $SCORE['imp_cr_br']?></td>
	
	<td class="category1"><?php echo $SCORE['single_cr_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['single_cr_complete']?></td>
	<td><?php echo $SCORE['single_cr_prev']?></td>
	<td class="category2"><?php echo $SCORE['single_cr']?></td>
	
	<td class="category1"><?php echo $SCORE['br_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['br_complete']?></td>
	<td><?php echo $SCORE['br_prev']?></td>
	<td class="category2"><?php echo $SCORE['br']?></td>
	
	<td class="category1"><?php echo $SCORE['partial_denture_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['partial_denture_complete']?></td>
	<td><?php echo $SCORE['partial_denture_prev']?></td>
	<td class="category2"><?php echo $SCORE['partial_denture']?></td>
	
	<td class="category1"><?php echo $SCORE['complete_denture_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['complete_denture_complete']?></td>
	<td><?php echo $SCORE['complete_denture_prev']?></td>
	<td class="category2"><?php echo $SCORE['complete_denture']?></td>


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





	<td class="category2"><?php echo $SCORE['total_simple_obser']?></td>
	
	<td class="category4"><?php echo $SCORE['total_score']?></td>
	<td class="category4"><?php echo $SCORE['total_predict_score']?></td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>
