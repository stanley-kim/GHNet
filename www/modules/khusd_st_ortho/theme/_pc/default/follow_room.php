<div id="ortho_list" class="khusd_st list ortho">
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
					<th>팔로우 상태</th>
					<th>진료실 번호</th>
					<th>담당교수님</th>
					<th>담당의(수련의)</th>
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
						<?php if($MY_FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'] && $MY_FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['FOLLOWING']):?>
						신환 팔로 중
						<?php elseif($MY_FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'] && $MY_FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['FOLLOWING']):?>
						구환 팔로 중
						<?php else:?>
						팔로 중단
						<?php endif?>
					</td>
					<td><?php echo $MY_FOLLOW['dr_room']?></td>
					<td><?php echo $MY_FOLLOW['pf_name']?></td>
					<td><?php echo $MY_FOLLOW['dr_name']?></td>
					<td><?php echo getDateFormat($MY_FOLLOW['date_update'], 'Y-m-d H:i')?></td>
				</tr>
				<?php endforeach?>
			</tbody>
		</table>
	</div>
    <?php endif?>
	<table summary="교정과 점수표 입니다.">
	<caption>교정과 팔로우 현황</caption> 
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
	<col width="80"> 
	</colgroup> 
	<thead>
    <tr>
        <th colspan=3 style="border:1px solid #dfdfdf; border-top:none;">&nbsp;</th>
        <th class="category2" colspan=7 style="border:1px solid #dfdfdf; border-top:none;">신환</th>
        <th class="category3" colspan=7 style="border:1px solid #dfdfdf; border-top:none;">구환</th>
        <th class="category1" colspan=1 style="border:1px solid #dfdfdf; border-top:none;">&nbsp;</th>
        <th class="category4" colspan=1 style="border:1px solid #dfdfdf; border-top:none;">&nbsp;</th>
    </tr>
	<tr>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
	<th scope="col" class="split">1번방</th>
	<th scope="col" class="split">2번방</th>
	<th scope="col" class="split">3번방</th>
	<th scope="col" class="split">5번방</th>
	<th scope="col" class="split">7번방</th>
	<th scope="col" class="split">8번방</th>
	<th class="category2" scope="col" class="split">Total</th>
	<th scope="col" class="split">1번방</th>
	<th scope="col" class="split">2번방</th>
	<th scope="col" class="split">3번방</th>
	<th scope="col" class="split">5번방</th>
	<th scope="col" class="split">7번방</th>
	<th scope="col" class="split">8번방</th>
	<th class="category3" scope="col" class="split">Total</th>
	<th scope="col" class="split category1">포기</th>
	<th scope="col" class="split category4">Total</th>
	</tr>
	</thead>
	<tbody>

	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>


	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr>
	<td><?php echo $idx++?></td>
	<td class="hand category1"><a href="<?php echo getSortingLink($c, $SCORE['st_id'], $om)?>"><?php echo $SCORE['st_id']?></a></td>
	<td class="hand category1"><a href="<?php echo getSortingLink($c, $SCORE['st_id'], $om)?>"><?php echo $SCORE['st_name']?></a></td>

	<td><?php echo $SCORE['room_1_1']?></td>
	<td><?php echo $SCORE['room_2_1']?></td>
	<td><?php echo $SCORE['room_3_1']?></td>
	<td><?php echo $SCORE['room_5_1']?></td>
	<td><?php echo $SCORE['room_7_1']?></td>
	<td><?php echo $SCORE['room_8_1']?></td>
	<td class="category2"><b><?php echo $SCORE['total_1']?></b></td>

	<td><?php echo $SCORE['room_1_0']?></td>
	<td><?php echo $SCORE['room_2_0']?></td>
	<td><?php echo $SCORE['room_3_0']?></td>
	<td><?php echo $SCORE['room_5_0']?></td>
	<td><?php echo $SCORE['room_7_0']?></td>
	<td><?php echo $SCORE['room_8_0']?></td>
	<td class="category3"><b><?php echo $SCORE['total_0']?></b></td>
	<td class=""><b><?php echo $SCORE['giveup']?></b></td>
	<td class="category4"><b><?php echo $SCORE['total']?> </b>
	(<?php echo $SCORE['old_pt_count']?>)
	</td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>

	<?php $idx = 1 ?>
	<?php foreach($TOTAL_FOLLOW_ARRAY as $_FOLLOW):?>
	<tr>
                                        <td><?php echo $_FOLLOW['st_id']?></td>
                                        <td><?php echo $_FOLLOW['st_name']?></td>
                                        <td><?php echo $_FOLLOW['pt_name']?></td>
                                        <td><?php echo $_FOLLOW['pt_id']?></td>
                                        <td>
                                                <?php if($_FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'] && $_FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['FOLLOWING']):?>
                                                신환 팔로 중
                                                <?php elseif($_FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'] && $_FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['FOLLOWING']):?>
                                                구환 팔로 중
                                                <?php else:?>
                                                팔로 중단
                                                <?php endif?>
                                        </td>
                                        <td><?php echo $_FOLLOW['dr_room']?></td>
                                        <td><?php echo $_FOLLOW['pf_name']?></td>
                                        <td><?php echo $_FOLLOW['dr_name']?></td>
                                        <td><?php echo $_FOLLOW['step'].'회'?></td>
					<td><?php if( $SCORE_PREV_ARRAY2[$_FOLLOW['st_id']][ $_FOLLOW['pt_uid']] ) 
						echo 'Y('.$SCORE_PREV_ARRAY2[$_FOLLOW['st_id']][ $_FOLLOW['pt_uid']]['step'].'회)';
						else echo 'N(0회)';  ?>
					</td>
                                        <td><?php echo getDateFormat($_FOLLOW['date_update'], 'Y-m-d H:i')?></td>

	<br>
	</tr>	
	<?php endforeach?>

</div>
