<div id="oms_history" class="khusd_st list oms">

	<table summary="구강외과 점수표 기록입니다.">
	<caption>구강외과 점수표 기록</caption> 
	<colgroup> 
	<col width="35">
	<col width="125"> 
	<col width="120"> 
<!--	<col width="40"> 
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
	<col width="150"> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">학번</th>
	<th scope="col" class="split">이름</th>
<!--	<th scope="col" class="split">Charting</th>
	<th scope="col" class="split">Dressing</th>
	<th scope="col" class="split">Case Presentation</th>-->
	<th scope="col" class="split">Simple Ext.</th>
	<th scope="col" class="split">Surgical Ext.</th>
	<th scope="col" class="split">Minor Surgery</th>
	<th scope="col" class="split">Major Surgery</th>
	<th scope="col" class="split">E/R Call</th>
	<th scope="col" class="split">ST</th>
	<th scope="col" class="split">Assist</th>
	<th scope="col" class="split">Dressing</th>
	<th scope="col" class="split">Stitch out</th>
	<th scope="col" class="split">Imp 1st</th>
	<th scope="col" class="split">Imp 2nd</th>
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

<!--	<td class="category1"><?php echo $SCORE['charting']?></td>
	<td class="category1"><?php echo $SCORE['dressing']?></td>
	<td><?php echo $SCORE['cp']?></td>-->
	<td class="category1"><?php echo $SCORE['simple_ext']?></td>
	<td class="category1"><?php echo $SCORE['surgical_ext']?></td>
	<td><?php echo $SCORE['minor']?></td>
	<td><?php echo $SCORE['major']?></td>
	<td><?php echo $SCORE['er_call']?></td>
	<td class="category2"><?php echo $SCORE['st_case']?></td>
	<td class="category2"><?php echo $SCORE['st_assist']?></td>
	<td class="category2"><?php echo $SCORE['st_dressing']?></td>
	<td class="category2"><?php echo $SCORE['st_stitchout']?></td>
	<td><?php echo $SCORE['imp_1st']?></td>
	<td><?php echo $SCORE['imp_2nd']?></td>

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
