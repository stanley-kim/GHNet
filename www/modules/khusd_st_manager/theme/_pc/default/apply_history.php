<div id="apply_history" class="khusd_st manager">
	
	<form name="apply_history" action="<?php echo $g['s']?>/" method="get">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="c" value="<?php echo $c?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="mode" value="<?php echo $mode?>" />


		학번 : <input type="text" name="st_id" value="<?php echo $st_id ? $st_id : ''?>" />
		이름 : <input type="text" name="st_name" value="<?php echo $st_name ? $st_name : ''?>" />
		<input type="submit" value="확인" class="btngray" />
		<?php echo $ST_INFO['name']?>
	</form>
	
	<table>
	<thead>
		<th width="150">신청시간</th>
		<th width="80">관련과</th>
		<th width="300">신청글</th>
		<th>신청항목</th>
		<th width="40">상태</th>
	</thead>
	<tbody>
	<?php foreach($APPLY_ARRAY as $APPLY):?>
	<tr>
		<td><?php echo getDateFormat($APPLY['date_reg'],'Y-m-d H:i')?></td>
		<td><?php echo $d['khusd_st_manager']['department'][$APPLY['department']]['name']?></td>
		<td>
			<a href="<?php echo $g['st_manager_apply_info_link'].$APPLY['apply_info_uid']?>">
				<?php echo $APPLY['apply_info_subject']?>
			</a>
		</td>
		<td>
			<a href="<?php echo $g['st_manager_apply_item_link'].$APPLY['apply_item_uid']?>">
				<?php echo $APPLY['apply_item_content']?>
			</a>
		</td>
		<td>
			<?php if($APPLY['status'] == $d['khusd_st_apply_manager']['apply_list']['ACCEPTED']):?>
			<span class="highlight">당첨</span>
			<?php elseif($APPLY['is_closed'] == 1):?>
			<span>탈락</span>
			<?php elseif($APPLY['date_reg'] >= $APPLY['date_start']):?>
			<span>신청</span>
			<?php else:?>
			<span>무효 신청</span>
			<?php endif?>
		</td>
	</tr>
	<?php endforeach?>
	</tbody>
	</table>
	
	
	<?php if( count($AVG_ARRAY) != 0):?>
	<table>
	<thead>
		<th width=120>학번</th>
		<th width=120>이름</th>
		<th width=80>신청 수</th>
		<th width=80>당첨</th>
		<th width=80>탈락</th>
		<th width=120>당첨 비율</th>
		<th width=120>평균 랜덤값</th>
	</thead>
	<tbody>
	<?php foreach($AVG_ARRAY as $_AVG):?>
	<tr>
		<td><?=$_AVG["avg_st_id"]?></td>
		<td><?=$_AVG["avg_name"]?></td>
		<td><?=$_AVG["total_count"]?></td>
		<td class="status_a"><?=$_AVG["a"]?></td>
		<td class="status_p"><?=$_AVG["p"]?></td>
		<td><?=number_format($_AVG["a_ratio"], 2)?>%</td>
		<td><?=number_format($_AVG["avg_rand"], 6)?></td>
	</tr>
	<?php endforeach?>
	</tbody>
	</table>
	
	<style>
	.status_a{background-color:#FDF5E6;}
	.status_p{background-color:#F0F8FF;}		
	</style>

	<?php endif?>
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