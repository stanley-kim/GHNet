<div id="perio_list" class="khusd_st list perio">

'	<table summary="치주과 점수표 입니다.">
	<caption>치주과 수술 누계</caption> 
	<colgroup> 
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
	</colgroup> 
	<thead>
        <tr>
            <th scope="col" colspan=2 class="split">&nbsp;</th>
            <th scope="col" colspan=4 class="split ">치주수술 기록</th>
            <th scope="col" colspan=4 class="split category3">정보수정 기록</th>
	</tr>
	<tr>
            <th scope="col" class="split">학번</th>
            <th scope="col" class="split">이름</th>
            <th scope="col" class="split">Perio</th>
            <th scope="col" class="split">Imp 1st</th>
            <th scope="col" class="split">Imp 2nd</th>
            <th scope="col" class="split">합계</th>
            <th scope="col" class="split">Perio</th>
            <th scope="col" class="split">Imp 1st</th>
            <th scope="col" class="split">Imp 2nd</th>
            <th scope="col" class="split">합계</th>
	</tr>
	</thead>
	<tbody>
	
	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>

			
	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<?php $idx++; ?>
	<td class="hand" ><?php echo $SCORE['st_id']?></td>
	<td class="hand" ><?php echo $SCORE['st_info']['name']?></td>
        <td><?php echo $SCORE['history_perio']?></td>
        <td><?php echo $SCORE['history_imp1']?></td>
        <td><?php echo $SCORE['history_imp2']?></td>
        <td class="category2"><?php echo $SCORE['history_perio'] + $SCORE['history_imp1'] + $SCORE['history_imp2']?></td>
        <td><?php echo $SCORE['surgery']?></td>
        <td><?php echo $SCORE['imp_1st']?></td>
        <td><?php echo $SCORE['imp_2nd']?></td>
        <td class="category3"><?php echo $SCORE['surgery'] + $SCORE['imp_1st'] + $SCORE['imp_2nd']?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>