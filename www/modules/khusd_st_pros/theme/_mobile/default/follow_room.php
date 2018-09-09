<div id="ortho_list" class="khusd_st list pros">
<style>
    
.khusd_st th.category1 {
background: #DBD9D9;
}
.khusd_st th.category2 {
background: #DDDDDD;
}
.khusd_st th.category3 {
background: #EDEDED;
}
.khusd_st th.category4 {
background: #EDFFFF;
}
.khusd_st th.category4 {
background: #DEFFFF;
}

.khusd_st td.category1 {
background: #FDF5E6;
}
.khusd_st td.category2 {
background: #F0F8FF;
}
.khusd_st td.category3 {
background: #F5FFFA;
}
.khusd_st td.category4 {
background: #FFFFE0;
}

table caption{font-size:14px; font-weight:bold; margin:20px 0 20px 0;}
#follow_list th{background: #FDF5E6}
</style>
    
    <?php if($show_list):?>
	<div id="follow_list">
		<table>
            <caption><b style="color:blue"><?php echo $target_name." "; ?></b> 팔로우 현황</caption> 
			<thead>
				<tr>
					<th>번호</th>
					<th>환자명</th>
					<th>병록번호</th>
					<th>팔로우 종류</th>
					<th>팔로우 상태</th>
					<th>담당의</th>
					<th>업데이트 날짜</th>
				</tr>
			</thead>
			<tbody>
				<?php $idx = 1?>
				<?php foreach($MY_FOLLOW_ARRAY as $MY_FOLLOW):?>
				<tr>
					<td><?php echo $idx++?></td>
					<td><?php echo $MY_FOLLOW['pt_name']?></td>
					<td><?php echo $MY_FOLLOW['pt_id']?></td>
					<td>
						<?php foreach( $d['khusd_st_pros']['TYPES'] as $type ):?>
								<?php if( $MY_FOLLOW['type'] == $type['id']):?>
								<?php echo $type["name"];?>
								<?php endif?>
						<?php endforeach?>
					</td>
					<td>
						<?php foreach( $d['khusd_st_pros']['STATUS_OPTIONS'] as $type ):?>
							<?php if( $MY_FOLLOW['status'] == $type['id']):?>
							<?php echo $type["name"];?>
							<?php endif?>
						<?php endforeach?>
					</td>
					<td><?php echo $MY_FOLLOW['dr_name']?></td>
					<td><?php echo getDateFormat($MY_FOLLOW['date_update'], 'Y-m-d H:i')?></td>
				</tr>
				<?php endforeach?>
			</tbody>
		</table>
	</div>
    <?php endif?>

	
	<table summary="보철과 점수표 입니다.">
	<caption>
                <?php if( $SEMESTER_INFO['sid'] == 2  ||  $SEMESTER_INFO['sid'] == 3 ):?>
		47기 보철과 팔로우 선생님, 교수님 상황 조사
		<?php else:?>
		47기 보철과 ST 상황 조사
		 <?php endif?>

	</caption> 
	<colgroup> 
	<col width="35">
	<col width="125"> 
	<col width="120">
                <?php if( $SEMESTER_INFO['sid'] == 2  ||  $SEMESTER_INFO['sid'] == 3 ):?>
        <?php $idx = 0?>
        <?php while($idx < 54):?>
	<col width="10"> 
        <?php $idx += 1?>
        <?php endwhile?>
	<col width="10"> 
		 <?php endif?>
	<col width="20"> 
	<col width="20"> 
	<col width="20"> 
                <?php if( $SEMESTER_INFO['sid'] == 2  ||  $SEMESTER_INFO['sid'] == 3 ):?>
	<col width="15"> 
		 <?php endif?>
	</colgroup> 
	<br>
	<thead>
	<tr>
	<th rowspan="3" scope="col" class="split">No</th>
	<th rowspan="3" scope="col" class="split">학번</th>
	<th rowspan="3" scope="col" class="split">이름</th>
                <?php if( $SEMESTER_INFO['sid'] == 2  ||  $SEMESTER_INFO['sid'] == 3 ):?>
	<th colspan="9" scope="col" class="split">Post</th>
	<th colspan="9" scope="col" class="split category2">임플란트</th>
	<th colspan="9" scope="col" class="split">크라운</th>
	<th colspan="9" scope="col" class="split category2">브릿지</th>
	<th colspan="9" scope="col" class="split">RPD</th>
	<th colspan="9" scope="col" class="split category2">CD</th>
	<th rowspan="3" scope="col" class="split">총팔로우갯수</th>
		 <?php endif?>
	<th colspan="3" scope="col" class="split">ST</th>
                <?php if( $SEMESTER_INFO['sid'] == 2  ||  $SEMESTER_INFO['sid'] == 3 ):?>
	<th rowspan="3" scope="col" class="split">총옵져갯수</th>
		 <?php endif?>
	</tr>

	<tr>
                <?php if( $SEMESTER_INFO['sid'] == 2  ||  $SEMESTER_INFO['sid'] == 3 ):?>
	<th colspan="3" scope="col" class="split">선생님</th>
	<th colspan="3" scope="col" class="split">교수님</th>
	<th colspan="3" scope="col" class="split">전체</th>
	<th colspan="3" scope="col" class="split">선생님</th>
	<th colspan="3" scope="col" class="split">교수님</th>
	<th colspan="3" scope="col" class="split">전체</th>
	<th colspan="3" scope="col" class="split">선생님</th>
	<th colspan="3" scope="col" class="split">교수님</th>
	<th colspan="3" scope="col" class="split">전체</th>
	<th colspan="3" scope="col" class="split">선생님</th>
	<th colspan="3" scope="col" class="split">교수님</th>
	<th colspan="3" scope="col" class="split">전체</th>
	<th colspan="3" scope="col" class="split">선생님</th>
	<th colspan="3" scope="col" class="split">교수님</th>
	<th colspan="3" scope="col" class="split">전체</th>
	<th colspan="3" scope="col" class="split">선생님</th>
	<th colspan="3" scope="col" class="split">교수님</th>
	<th colspan="3" scope="col" class="split">전체</th>
		 <?php endif?>
	<th rowspan="2" scope="col" class="split">1</th>
	<th rowspan="2" scope="col" class="split">2</th>
	<th rowspan="2" scope="col" class="split">3</th>
	</tr>
                <?php if( $SEMESTER_INFO['sid'] == 2  ||  $SEMESTER_INFO['sid'] == 3 ):?>
	<tr>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">합</th>
	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">합</th>
	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">진행+완료</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">합</th>
	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">합</th>
	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">진행+완료</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">합</th>
	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">합</th>
	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">진행+완료</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">합</th>
	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">합</th>
	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">진행+완료</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">합</th>
	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">합</th>
	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">진행+완료</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">합</th>
	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">합</th>
	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완료</th>
	<th scope="col" class="split">진행+완료</th>

	</tr>
		 <?php endif?>
	</thead>
	<tbody>
	

	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>
	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr>
	<td><?php echo $idx++?></td>
	<td class="hand category1"><a href="<?php echo getSortingLink($c, $SCORE['st_id'], $om)?>"><?php echo $SCORE['st_id']?></a></td>
	<td class="hand category1"><a href="<?php echo getSortingLink($c, $SCORE['st_id'], $om)?>"><?php echo $SCORE['st_info']['name']?></a></td>

                <?php if( $SEMESTER_INFO['sid'] == 2  ||  $SEMESTER_INFO['sid'] == 3 ):?>	
	<td class="category1"><?php echo $SCORE['post_core_ongoing']?></td>
	<td class="category1"><?php echo $SCORE['post_core_complete']?></td>
	<td class="category1"><?php echo $SCORE['post_core_total_resident']?></td>
	<td class="category2"><?php echo $SCORE['post_core_ongoing_prof']?></td>
	<td class="category2"><?php echo $SCORE['post_core_complete_prof']?></td>
	<td class="category2"><?php echo $SCORE['post_core_total_prof']?></td>
	<td ><?php echo $SCORE['post_core_total_ongoing']?></td>
	<td ><?php echo $SCORE['post_core_total_complete']?></td>
	<td ><?php echo $SCORE['post_core']?></td>
	
	<td class="category1"><?php echo $SCORE['imp_cr_br_ongoing']?></td>
	<td class="category1"><?php echo $SCORE['imp_cr_br_complete']?></td>
	<td class="category1"><?php echo $SCORE['imp_cr_br_total_resident']?></td>
	<td class="category2"><?php echo $SCORE['imp_cr_br_ongoing_prof']?></td>
	<td class="category2"><?php echo $SCORE['imp_cr_br_complete_prof']?></td>
	<td class="category2"><?php echo $SCORE['imp_cr_br_total_prof']?></td>
	<td ><?php echo $SCORE['imp_cr_br_total_ongoing']?></td>
	<td ><?php echo $SCORE['imp_cr_br_total_complete']?></td>
	<td ><?php echo $SCORE['imp_cr_br']?></td>
	
	<td class="category1"><?php echo $SCORE['single_cr_ongoing']?></td>
	<td class="category1"><?php echo $SCORE['single_cr_complete']?></td>
	<td class="category1"><?php echo $SCORE['single_cr_total_resident']?></td>
	<td class="category2"><?php echo $SCORE['single_cr_ongoing_prof']?></td>
	<td class="category2"><?php echo $SCORE['single_cr_complete_prof']?></td>
	<td class="category2"><?php echo $SCORE['single_cr_total_prof']?></td>
	<td ><?php echo $SCORE['single_cr_total_ongoing']?></td>
	<td ><?php echo $SCORE['single_cr_total_complete']?></td>
	<td ><?php echo $SCORE['single_cr']?></td>
	
	<td class="category1"><?php echo $SCORE['br_ongoing']?></td>
	<td class="category1"><?php echo $SCORE['br_complete']?></td>
	<td class="category1"><?php echo $SCORE['br_total_resident']?></td>
	<td class="category2"><?php echo $SCORE['br_ongoing_prof']?></td>
	<td class="category2"><?php echo $SCORE['br_complete_prof']?></td>
	<td class="category2"><?php echo $SCORE['br_total_prof']?></td>
	<td ><?php echo $SCORE['br_total_ongoing']?></td>
	<td ><?php echo $SCORE['br_total_complete']?></td>
	<td ><?php echo $SCORE['br']?></td>
	
	<td class="category1"><?php echo $SCORE['partial_denture_ongoing']?></td>
	<td class="category1"><?php echo $SCORE['partial_denture_complete']?></td>
	<td class="category1"><?php echo $SCORE['partial_denture_total_resident']?></td>
	<td class="category2"><?php echo $SCORE['partial_denture_ongoing_prof']?></td>
	<td class="category2"><?php echo $SCORE['partial_denture_complete_prof']?></td>
	<td class="category2"><?php echo $SCORE['partial_denture_total_prof']?></td>
	<td ><?php echo $SCORE['partial_denture_total_ongoing']?></td>
	<td ><?php echo $SCORE['partial_denture_total_complete']?></td>
	<td ><?php echo $SCORE['partial_denture']?></td>
	
	<td class="category1"><?php echo $SCORE['complete_denture_ongoing']?></td>
	<td class="category1"><?php echo $SCORE['complete_denture_complete']?></td>
	<td class="category1"><?php echo $SCORE['complete_denture_total_resident']?></td>
	<td class="category2"><?php echo $SCORE['complete_denture_ongoing_prof']?></td>
	<td class="category2"><?php echo $SCORE['complete_denture_complete_prof']?></td>
	<td class="category2"><?php echo $SCORE['complete_denture_total_prof']?></td>
	<td ><?php echo $SCORE['complete_denture_total_ongoing']?></td>
	<td ><?php echo $SCORE['complete_denture_total_complete']?></td>
	<td ><?php echo $SCORE['complete_denture']?></td>
	<td class="category1"><?php echo $SCORE['total_follow']?></td>
		 <?php endif?>
	<td class="category1"><?php if($SCORE['pros_st_case_1'] != "") echo $SCORE['pros_st_case_1']; else echo "X"?></td>
	<td class="category2"><?php if($SCORE['pros_st_case_2'] != "") echo $SCORE['pros_st_case_2']; else echo "X"?></td>
	<td ><?php if($SCORE['pros_st_case_3'] != "") echo $SCORE['pros_st_case_3']; else echo "X"?></td>
                <?php if( $SEMESTER_INFO['sid'] == 2  ||  $SEMESTER_INFO['sid'] == 3 ):?>
	<td class="category1"><?php echo $SCORE['total_simple_obser']?></td>
		 <?php endif?>
	
	
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>

</div>
