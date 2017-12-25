<div id="perio_history" class="khusd_st list perio">

        <?php $SEMESTER_INFO = getCurrentSemesterInfo()  ?>

	<table summary="치주과 점수표 기록입니다.">
	<caption>치주과 점수표 기록</caption> 
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

        <?php if($SEMESTER_INFO['sid'] == 2):?>
        <col width="40">
        <col width="40">
        <?php endif?>

	<col width="150"> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" rowspan=2 class="split">No</th>
	<th scope="col" rowspan=2 class="split">학번</th>
	<th scope="col" rowspan=2 class="split">이름</th>
	<th scope="col" colspan=13 class="split">[Observation]</th>
        <?php if($SEMESTER_INFO['sid'] == 2):?>
        <th scope="col" colspan=8 class="split">[ST Case]</th>
        <?php else :?>
	<th scope="col" colspan=6 class="split">[ST Case]</th>
        <?php endif?>
	<th scope="col" rowspan=2 class="split">동물<br/>실험</th>
	<th scope="col" rowspan=2 class="split">Total</th>
	<th scope="col" rowspan=2>수정일</th>
	</tr>
	<tr>
	<th scope="col" class="split">F/U</th>
	<th scope="col" class="split">F/U 점수</th>
	<th scope="col" class="split">IOT</th>
	<th scope="col" class="split">Ch</th>
	<th scope="col" class="split">Ch+IOT</th>
	<th scope="col" class="split">F/O</th>
	<th scope="col" class="split">Imp 1st</th>
	<th scope="col" class="split">Imp 2nd</th>
	<th scope="col" class="split">Total + surgery</th>
	<th scope="col" class="split">SC</th>
	<th scope="col" class="split">others</th>
	<th scope="col" class="split">TBI</th>
	<th scope="col" class="split">Obser 점수</th>
        <?php if($SEMESTER_INFO['sid'] == 2):?>
	<th scope="col" class="split">Pre ST</th>
	<th scope="col" class="split">Pre SC</th>
        <?php endif?>
	<th scope="col" class="split">SC</th>
	<th scope="col" class="split">PC</th>
        <th scope="col" class="split">SPT완료</th>
        <th scope="col" class="split">SPT미완료</th>
	<th scope="col" class="split">CU</th>
	<th scope="col" class="split">ST점수</th>
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
	
	<td><?php echo $SCORE['follow']?></td>
	<td><?php echo $SCORE['follow_point']?></td>
	<td class="category1"><?php echo $SCORE['iot']?></td>
	<td class="category1"><?php echo $SCORE['charting']?></td>
	<td class="category1"><?php echo $SCORE['ch_iot']?></td>
	<td><?php echo $SCORE['surgery']?></td>
	<td><?php echo $SCORE['imp_1st']?></td>
	<td><?php echo $SCORE['imp_2nd']?></td>
	<td class="category2"><?php echo $SCORE['total_surgery']?></td>
	<td class="category3"><?php echo $SCORE['sc']?></td>
	<td><?php echo $SCORE['others']?></td>
	<td><?php echo $SCORE['tbi']?></td>
	<td class="category4"><?php echo $SCORE['ob_score_original']?></td>
        <?php if($SEMESTER_INFO['sid'] == 2):?>
	<td class="category5"><?php echo ($SCORE['pre_st'] == 1 ? '완' : '')?></td>
	<td><?php echo ($SCORE['stpresc'] == 1 ? '완' : '')?></td>
        <?php endif?>
	<td><?php echo $SCORE['stsc']?></td>
	<td><?php echo $SCORE['stpc']?></td>
        <td><?php echo $SCORE['stspt_complete']?></td>
        <td><?php echo $SCORE['stspt_incomplete']?></td>
	<td><?php echo $SCORE['stcu']?></td>
	<td class="category4"><?php echo $SCORE['st_score_original']?></td>
	<td><?php echo $SCORE['animal_exp']?></td>
	<td class="category4"><?php echo sprintf("%1.4f", $SCORE['total_score'])?></td>

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
