<div id="ortho_history" class="khusd_st list ortho">

	<table summary="교정과 업데이트 기록입니다.">
	<caption>교정과 업데이트 기록</caption> 
	<colgroup> 
	<col width="35">
	<col width="125"> 
	<col width="120"> 
	<col width="40"> <!--follow old cnt-->
	<col width="40"> <!--follow old obs cnt-->
	<col width="40"> <!--follow old score-->
	<col width="40"> <!--follow new cnt-->
	<col width="40"> <!--follow new obs cnt-->
	<col width="40"> <!--follow new score-->
	<col width="40"> <!--simple obs count-->
	<col width="40"> <!--simple obs score-->
	<col width="40"> <!--appliance score-->
	<col width="40"> <!--appliance A/B/C score-->
	<col width="40"> <!--total score-->
	<col width="150"> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
	<th scope="col" class="split">구환 명수</th>
	<th scope="col" class="split">구환 횟수</th>
	<th scope="col" class="split">유효 구환 점수</th>
	<th scope="col" class="split">신환 명수</th>
	<th scope="col" class="split">신환 횟수</th>
	<th scope="col" class="split">유효 신환 점수</th>
	<th scope="col" class="split">옵져 횟수</th>
	<th scope="col" class="split">유효 옵져 점수</th>
	<th scope="col" class="split">기공 점수</th>
	<th scope="col" class="split">A/B/C</th>
	<th scope="col" class="split">총점</th>
	<th scope="col">수정일</th>
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

	<td><?php echo $SCORE['follow_old_cnt']?></td>
	<td><?php echo $SCORE['follow_old_obs_cnt']?></td>
	<td><?php echo $SCORE['follow_old']?></td>
	<td><?php echo $SCORE['follow_new_cnt']?></td>
	<td><?php echo $SCORE['follow_new_obs_cnt']?></td>
	<td><?php echo $SCORE['follow_new']?></td>
	<td><?php echo $SCORE['obser_cnt']?></td>
	<td><?php echo $SCORE['obser']?></td>
	<td><?php echo $SCORE['appliance_score']?></td>
	<td><?php echo $SCORE['fabri_a']?>/<?php echo $SCORE['fabri_b']?>/<?php echo $SCORE['fabri_c']?></td>
	<td><?php echo $SCORE['total_score']?></td>
	
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