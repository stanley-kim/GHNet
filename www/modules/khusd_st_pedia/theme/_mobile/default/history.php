<div id="pedia_history" class="khusd_st list pedia">

	<table summary="소아치과 점수표 기록입니다.">
	<caption>소아치과 점수표 기록</caption> 
	<colgroup> 
	<col width="35">
	<col width="95"> 
	<col width="80"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50">
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="150"> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
	<th scope="col" class="split">교픽오전</th>
	<th scope="col" class="split">교픽오후</th>
	<th scope="col" class="split">교픽+Follow 점수</th>
	<th scope="col" class="split">Obser</th>
	<th scope="col" class="split">G/A</th>
	<th scope="col" class="split">Sedation 레폿</th>
	<th scope="col" class="split">Clinical 레폿</th>
	<th scope="col" class="split">Charting Obser</th>
	<th scope="col" class="split">Obser 점수</th>
	<th scope="col">수정일</th>
	</tr>
	</thead>
	<tbody>

	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>
	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr>
	<td><?php echo $idx++?></td>
	<td><?php echo $SCORE['st_id']?></td>
	<td><?php echo $SCORE['st_info']['name']?></td>

	<td><?php echo $SCORE['prof_fix_am']?></td>
	<td><?php echo $SCORE['prof_fix_pm']?></td>
	<td class="category1"><?php echo $SCORE['follow']?></td>
	<td class="category2"><?php echo $SCORE['obser']?></td>
	<td><?php echo $SCORE['ga']?></td>
	<td><?php echo $SCORE['sedation_rp']?></td>
	<td><?php echo $SCORE['clinical_rp']?></td>
	<td><?php echo $SCORE['charting_obser']?></td>
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
