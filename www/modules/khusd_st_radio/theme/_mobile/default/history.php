<div id="radio_history" class="khusd_st list radio">

	<table summary="영상과 점수표 기록입니다.">
	<caption>영상과 점수표 기록</caption> 
	<colgroup> 
	<col width="35">
	<col width="105"> 
	<col width="80"> 
	<col width="60"> 
	<col width="60"> 
	<col width="60"> 
	<col width="60"> 
	<col width="60"> 
	<col width="150"> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
	<th scope="col" class="split">Taking</th>
	<th scope="col" class="split">환자수</th>
	<th scope="col" class="split">판독옵져</th>
	<th scope="col" class="split">촬영옵져</th>
	<th scope="col" class="split">파노라마</th>
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

	<td><?php echo $SCORE['taking']?></td>
	<td><?php echo $SCORE['taking_pt']?></td>
	<td><?php echo $SCORE['obser_decoding']?></td>
	<td><?php echo $SCORE['obser_filming']?></td>
	<td><?php echo $SCORE['panorama']?></td>

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
