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
	<caption>보철과 점수표</caption> 
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
	<col width="40"> 
	<col width="40"> 
	</colgroup> 
	<thead>
	<tr>
	<th rowspan="2" scope="col" class="split">No</th>
	<th rowspan="2" scope="col" class="split">학번</th>
	<th rowspan="2" scope="col" class="split">이름</th>
	<th colspan="4" scope="col" class="split category2">2년차 Cr</th>
	<th colspan="4" scope="col" class="split">Post Core</th>
	<th colspan="4" scope="col" class="split category2">Impl. Cr&Br</th>
	<th colspan="4" scope="col" class="split">Single Cr</th>
	<th colspan="4" scope="col" class="split category2">Br.</th>
	<th colspan="4" scope="col" class="split">RPD</th>
	<th colspan="4" scope="col" class="split category2">CD</th>
	<th colspan="4" scope="col" class="split">others</th>
	</tr>
	<tr>
	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완</th>
	<th scope="col" class="split">취소</th>
	<th scope="col" class="split">진행+완</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완</th>
	<th scope="col" class="split">취소</th>
	<th scope="col" class="split">진행+완</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완</th>
	<th scope="col" class="split">취소</th>
	<th scope="col" class="split">진행+완</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완</th>
	<th scope="col" class="split">취소</th>
	<th scope="col" class="split">진행+완</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완</th>
	<th scope="col" class="split">취소</th>
	<th scope="col" class="split">진행+완</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완</th>
	<th scope="col" class="split">취소</th>
	<th scope="col" class="split">진행+완</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완</th>
	<th scope="col" class="split">취소</th>
	<th scope="col" class="split">진행+완</th>

	<th scope="col" class="split">진행</th>
	<th scope="col" class="split">완</th>
	<th scope="col" class="split">취소</th>
	<th scope="col" class="split">진행+완</th>
	</tr>
	</thead>
	<tbody>
	

	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>
	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr>
	<td><?php echo $idx++?></td>
	<td class="hand category1"><a href="<?php echo getSortingLink($c, $SCORE['st_id'], $om)?>"><?php echo $SCORE['st_id']?></a></td>
	<td class="hand category1"><a href="<?php echo getSortingLink($c, $SCORE['st_id'], $om)?>"><?php echo $SCORE['st_info']['name']?></a></td>

	<td class="category1"><?php echo $SCORE['second_cr_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['second_cr_complete']?></td>
	<td><?php echo $SCORE['second_cr_cancel']?></td>
	<td class="category2"><?php echo $SCORE['second_cr']?></td>
	
	<td class="category1"><?php echo $SCORE['post_core_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['post_core_complete']?></td>
	<td><?php echo $SCORE['post_core_cancel']?></td>
	<td class="category2"><?php echo $SCORE['post_core']?></td>
	
	<td class="category1"><?php echo $SCORE['imp_cr_br_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['imp_cr_br_complete']?></td>
	<td><?php echo $SCORE['imp_cr_br_cancel']?></td>
	<td class="category2"><?php echo $SCORE['imp_cr_br']?></td>
	
	<td class="category1"><?php echo $SCORE['single_cr_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['single_cr_complete']?></td>
	<td><?php echo $SCORE['single_cr_cancel']?></td>
	<td class="category2"><?php echo $SCORE['single_cr']?></td>
	
	<td class="category1"><?php echo $SCORE['br_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['br_complete']?></td>
	<td><?php echo $SCORE['br_cancel']?></td>
	<td class="category2"><?php echo $SCORE['br']?></td>
	
	<td class="category1"><?php echo $SCORE['partial_denture_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['partial_denture_complete']?></td>
	<td><?php echo $SCORE['partial_denture_cancel']?></td>
	<td class="category2"><?php echo $SCORE['partial_denture']?></td>
	
	<td class="category1"><?php echo $SCORE['complete_denture_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['complete_denture_complete']?></td>
	<td><?php echo $SCORE['complete_denture_cancel']?></td>
	<td class="category2"><?php echo $SCORE['complete_denture']?></td>
	
	<td class="category1"><?php echo $SCORE['others_ongoing']?></td>
	<td class="category2"><?php echo $SCORE['others_complete']?></td>
	<td><?php echo $SCORE['others_cancel']?></td>
	<td class="category2"><?php echo $SCORE['others']?></td>
	
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>

</div>