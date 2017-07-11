<div id="apply_info_list" class="khusd_st list apply">

	<div style="height:200px; overflow:auto">
	<?php getWidget('khusd/my_apply_manager',array('recnum'=>'50',))?>
	</div>

	<div class="info">
	</div>
	
	<table summary="신청 리스트 입니다.">
	<caption>신청 리스트</caption> 
	<colgroup> 
	<col width="50"> 
	<col width="50"> 
	<col> 
	<col width="80"> 
	<col width="80"> 
	<col width="80"> 
	<col width="80"> 
	<col width="90">
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="side1">번호</th>
	<th scope="col">분류</th>
	<th scope="col">제목</th>
	<th scope="col">올린이</th>
	<th scope="col">신청 항목 개수</th>
	<th scope="col">선정 방식</th>
	<th scope="col">마감여부</th>
	<th scope="col" class="side2">신청날짜</th>
	</tr>
	</thead>
	<tbody>
	
	<?php $idx = 1?>
	<?php if(is_array($APPLY_INFO_ARRAY) && count($APPLY_INFO_ARRAY) > 0):?>
		<?php foreach($APPLY_INFO_ARRAY as $APPLY_INFO):?>
		
		<tr <?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['OPEN']):?>class="open"<?php endif?>>
		<td><?php echo $idx++?></td>
		<td><?php echo $dept_array[$APPLY_INFO['department']]['name']?></td>
		<td class="sbj"><a href="<?php echo $g['apply_info_view'].$APPLY_INFO['uid']?>"><?php echo $APPLY_INFO['subject']?></a></td>
		<td class="name hand" onclick="getMemberLayer2('<?php echo $APPLY_INFO['mbruid']?>',event);"><?php echo $APPLY_INFO['name']?></td>
		<td><?php echo $APPLY_INFO['num_item']?></td>
		<td><?php if($APPLY_INFO['apply_type'] == 'rand'):?>랜덤<?php elseif($APPLY_INFO['apply_type'] == 'fcfs'):?>선착순<?php endif?></td>
		<td><?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['CLOSED']):?>마감<?php endif?>
		<td><?php echo getDateFormat($APPLY_INFO['date_start'],'Y-m-d H:i')?></td>
		</tr>
		<?php endforeach?>
	<?php else:?>
	<tr>
		<td colspan="8">신청 없음</td>
	</tr>
	<?php endif?>
	
	</tbody>
	</table>
	<div class="bottom">
		<div class="btnbox1">
			<span class="btn00">
				<a href="<?php echo $g['apply_info_add']?>">신청 추가</a>
			</span>
		</div>
		<div class="btnbox2"></div>
		<div class="clear"></div>
		<div class="pagebox01">
			<?php echo getPageLink($d['theme']['pagenum'],$p,$TPG,$g['img_core'].'/page/default')?>
		</div>
	</div>
	
</div>