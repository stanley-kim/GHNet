<div id="medi_history" class="khusd_st list medi">

	<table summary="구강내과 점수표 기록입니다.">
	<caption>구강내과 점수표 기록</caption> 
	<colgroup> 
	<col width="35">
	<col width="105"> 
	<col width="80"> 
<!--	<col width="40">-->
	<col width="40"> 
	<col width="40"> 
<!--	<col width="40">--> 
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
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
<!--	<th scope="col" class="split">Ch Obser</th>-->
	<th scope="col" class="split">Ch</th>
	<th scope="col" class="split">단순 Obser</th>
<!--	<th scope="col" class="split">장치 Obser</th>-->
	<th scope="col" class="split">구취측정</th>
	<th scope="col" class="split">타액측정</th>
	<th scope="col" class="split">물리치료</th>
	<th scope="col" class="split">장치내주</th>
	<th scope="col" class="split">장치외주</th>
	<th scope="col" class="split">의료문서</th>
	<th scope="col" class="split">Fix 오전</th>
	<th scope="col" class="split">Fix 오후</th>
	<th scope="col" class="split">Fix 합</th>
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

<!--	<td><?php echo $SCORE['charting_obser']?></td>-->
	<td class="category4"><?php echo $SCORE['charting']?></td>
	<td class="category4"><?php echo $SCORE['obser']?></td>
<!--	<td><?php echo $SCORE['splint_obser']?></td>-->
	<td><?php echo $SCORE['odor']?></td>
	<td><?php echo $SCORE['saliva_test']?></td>
	<td><?php echo $SCORE['physical_tx']?></td>
	<td><?php echo $SCORE['splint_impression']?></td>
	<td><?php echo $SCORE['splint_polishing']?></td>
	<td><?php echo $SCORE['m_text']?></td>
	<td><?php echo $SCORE['fix_am']?></td>
	<td><?php echo $SCORE['fix_pm']?></td>
	<td><?php echo $SCORE['fix']?></td>
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
