<div id="ortho_history" class="khusd_st list ortho">

	<table summary="치주과 점수표 기록입니다.">
	<caption>교정과 점수표 기록</caption> 
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
	<col width="150"> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
	<th scope="col" class="split">구환 횟수</th>
	<th scope="col" class="split">구환 환자</th>
	<th scope="col" class="split">구환합</th>
	<th scope="col" class="split">신환 횟수</th>
	<th scope="col" class="split">신환 환자</th>
	<th scope="col" class="split">신환합</th>
	<th scope="col" class="split">레포트점수</th>
	<th scope="col" class="split">신+구점수</th>
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

	<td><?php echo $SCORE['obser']?></td>
	<td><?php echo $SCORE['obser_pt']?></td>
	<td class="category1"><?php echo $SCORE['obser_score']?></td>
	<td><?php echo $SCORE['follow']?></td>
	<td><?php echo $SCORE['follow_pt']?></td>
	<td class="category1"><?php echo $SCORE['follow_score']?></td>
	<td class="category1"><?php echo $SCORE['report_score']?></td>
	<td class="category4"><?php echo $SCORE['obser_follow_score']?></td>
	<td class="category4"><?php echo $SCORE['total_score']?></td>

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