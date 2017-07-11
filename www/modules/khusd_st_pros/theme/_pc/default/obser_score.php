<div id="pros_list" class="khusd_st list pros">

	<?php getWidget('khusd/semester_selector',array())?>
	
	<table summary="보철과 점수표 입니다.">
	<caption>보철과 점수표</caption> 
	<thead>
	<tr>
	<th  scope="col" class="split">No</th>
	<th  scope="col" class="split">학번</th>
	<th  scope="col" class="split">이름</th>
	<th  scope="col" class="split">Post Core</th>
	<th  scope="col" class="split">Impl. Cr&Br</th>
	<th  scope="col" class="split">Single Cr</th>
	<th  scope="col" class="split">Br.</th>
	<th  scope="col" class="split">RPD</th>
	<th  scope="col" class="split">CD</th>
	<th  scope="col" class="split">others</th>
	<th  scope="col" class="split">총점</th>
	<th  scope="col">수정일</th>
	</tr>
	</thead>
	<tbody>
	<?php $idx = 1?>
	<?php if(is_array($SCORE_ARRAY)) {?>

	<?php foreach($SCORE_ARRAY as $SCORE):?>
	<tr class="score_row" <?php if($my['id']==$SCORE['st_id']):?> class="mine"<?php endif?>>
	<td><?php echo $idx++?></td>
	<td class="category1" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['st_id']?></td>
	<td class="category1" onclick="getMemberLayer2('<?php echo $SCORE['st_info']['memberuid']?>',event);"><?php echo $SCORE['name']?></td>

	<?php
		
		/*
		foreach( $d['khusd_st_pros']['OBSER_TYPES'] as $f_types ){
			$f_type = $f_types['id']; 
			$stage = explode(",",$SCORE['stage_'.$f_types['id']]);
			$pros_stage = count( $d['khusd_st_pros'][$f_type] );
			$score = array();
			for($i=0; $i< $stage; $i++){
				if($i < count($my_stage)){
					array_push( $score, $my_stage[$i]);
				}else{
					array_push( $score, 0);
				}
			}
			
			$total[$f_type] = 0;
			foreach( $d['khusd_st_pros'][$f_type] as $type ){
				$total[$f_type] += $type["score"]*$score[$t_idx];
			}
		}*/
		
	?>
	<td class="stage_PostCore" stage="<?=$SCORE['stage_PostCore']?>">0</td>
	<td class="stage_imp" stage="<?=$SCORE['stage_imp']?>">0</td>
	<td class="stage_single" stage="<?=$SCORE['stage_single']?>">0</td>
	<td class="stage_bridge" stage="<?=$SCORE['stage_bridge']?>">0</td>
	<td class="stage_pd" stage="<?=$SCORE['stage_pd']?>">0</td>
	<td class="stage_cd" stage="<?=$SCORE['stage_cd']?>">0</td>
	<td class="stage_others" stage="<?=$SCORE['stage_others']?>">0</td>
	<td class="stage_total category4">0</td>

	<td><?php echo getDateFormat($SCORE['date_update'],"Y-m-d H:i")?></td>
	</tr>
	<?php endforeach?>
	<?php }?>
	</tbody>
	</table>
</div>



<script type="text/javascript">

var types = <?php echo json_encode($d['khusd_st_pros']['OBSER_TYPES']);?>;
var stages = new Object;
<?php 
	foreach( $d['khusd_st_pros']['OBSER_TYPES'] as $f_types ){
		$f_type = $f_types['id'];
		echo "stages.$f_type = ".json_encode($d['khusd_st_pros'][$f_type]).";";
	}
?>
var types = <?php echo json_encode($d['khusd_st_pros'][$f_type]);?>;
$(document).ready(function(){
	$("tr.score_row").each(function(){
		var total_score = 0;
		for(key in stages){
				var user_stages = $(this).find(".stage_"+key).attr("stage");
				user_stages = user_stages.split(",");
				
				var score = 0;
				for(var i=0; i< stages[key].length; i++){
					if(i < user_stages.length){
						score += user_stages[i]*stages[key][i]['score'];					
					}
				}
				
				total_score += score;
				$(this).find(".stage_"+key).text(score);
		}
		$(this).find(".stage_total").text(total_score);
	});
	
});

</script>