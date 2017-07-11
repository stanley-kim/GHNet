<div id="list" class="khusd_st calendar list">

	<table summary="ST 신청표 입니다.">
	<caption>
	<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_manager_list'].$prev_week_date?>">전주</a>
	|
	<?php echo getDateFormat($st_start_date,'Y-m-d (D)')?>
	<?php echo ' ~ '?>
	<?php echo getDateFormat($st_end_date,'Y-m-d (D)')?>
	|
	<a href="<?php echo $g['khusd_st_cnslt_room_manager_st_manager_list'].$next_week_date?>">다음주</a>
	</caption> 
	<colgroup> 
	<col width="35">
	<col width="130"> 
	<col width="65"> 
	<col width="65"> 
	<col width="65"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="100"> 
	<col width="100"> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_cnslt_room_manager_st_manager_list'].$st_date, 'st_date', $om, $order == 'st_date')?>">진료일</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_cnslt_room_manager_st_manager_list'].$st_date, 'department', $om, $order == 'department')?>">진료과</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_cnslt_room_manager_st_manager_list'].$st_date, 'status', $om, $order == 'status')?>">상태</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_cnslt_room_manager_st_manager_list'].$st_date, 'chair_no', $om, $order == 'chair_no')?>">체어</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_cnslt_room_manager_st_manager_list'].$st_date, 'tx_plan', $om, $order == 'tx_plan')?>">진료내용</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_cnslt_room_manager_st_manager_list'].$st_date, 'st_id', $om, $order == 'st_id')?>">학생명</a></th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_cnslt_room_manager_st_manager_list'].$st_date, 'pt_name', $om, $order == 'pt_name')?>">환자명</a></th>
	<th scope="col" class="split">금주체어수</th>
	<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_cnslt_room_manager_st_manager_list'].$st_date, 'date_reg', $om, $order == 'date_reg')?>">신청시간</a></th>
	<th scope="col" class="split">취소시간</th>
	</tr>
	</thead>
	<tbody>
	
	<?php $idx = 1?>
	<?php foreach($ST_CHAIR_ARRAY as $ST_CHAIR):?>
	<form name="stApplyForm<?php echo $idx?>" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="a" value="change_st_chair" />
		<input type="hidden" name="c" value="<?php echo $c?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		
		<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
		<input type="hidden" name="uid" value="<?php echo $ST_CHAIR['uid']?>" />
		<input type="hidden" name="_status" value="<?php echo $ST_CHAIR['status']?>" />
		<input type="hidden" name="_chair" value="<?php echo $ST_CHAIR['chair_no']?>" />
	<tr>
	<td><?php echo $idx++?></td>
	<td><?php echo getDateFormat($ST_CHAIR['st_date'],'Y-m-d (D)').' '.$ST_CHAIR['st_timetype']?></td>
	<td><?php echo $d['khusd_st_manager']['department'][$ST_CHAIR['department']]['name']?></td>
	<td>
		<?php $_ST_STATUS = $d['khusd_st_cnslt_room_manager']['apply']['status']?>
		<?php if($MANAGER):?>
		<select name="status" onChange="updateStatus(this.form)">
			<option value="<?php echo $_ST_STATUS['APPLY']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['APPLY']):?> selected<?php endif?>>신청</option>
			<option value="<?php echo $_ST_STATUS['CANCEL']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['CANCEL']):?> selected<?php endif?>>취소</option>
			<option value="<?php echo $_ST_STATUS['ACCEPTED']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['ACCEPTED']):?> selected<?php endif?>>당첨</option>
			<option value="<?php echo $_ST_STATUS['CANDI']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['CANDI']):?> selected<?php endif?>>대기</option>
			<option value="<?php echo $_ST_STATUS['ADD_ACCEPTED']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['ADD_ACCEPTED']):?> selected<?php endif?>>추가</option>
			<option value="delete">삭제</option>
		</select>
		<?php else:?>
			<?php if($ST_CHAIR['status'] == $_ST_STATUS['APPLY']):?>신청
			<?php elseif($ST_CHAIR['status'] == $_ST_STATUS['CANCEL']):?>취소
			<?php elseif($ST_CHAIR['status'] == $_ST_STATUS['ACCEPTED']):?>당첨
			<?php elseif($ST_CHAIR['status'] == $_ST_STATUS['CANDI']):?>대기
			<?php elseif($ST_CHAIR['status'] == $_ST_STATUS['ADD_ACCEPTED']):?>추가
			<?php endif?>
		<?php endif?>
	</td>
	<td>
		<?php if($MANAGER):?>
		<select name="chair" onChange="updateChair(this.form)">
			<option value="0" selected>미정</option>
			<?php for($_idx = 0; $_idx < $CHAIR_NUM_MAX; $_idx++):?>
			<option value="<?php echo $_idx + 1?>"<?php if($ST_CHAIR['chair_no'] == ($_idx + 1)):?> selected<?php endif?>><?php echo $_idx + 1?></option>
			<?php endfor?>
		</select>
		<?php else:?>
		<?php echo $ST_CHAIR['chair_no'] == 0 ? '미배정' : $ST_CHAIR['chair_no']?>
		<?php endif?>
	</td>
	<td><?php echo $d['khusd_st_cnslt_room_manager']['tx_plan'][$ST_CHAIR['st_type']][$ST_CHAIR['tx_plan']]['name']?></td>
	<td><?php echo $ST_CHAIR['st_info']['name']?></td>
	<td><?php echo $ST_CHAIR['pt_name']?></td>
	<td></td>
	<td><?php echo getDateFormat($ST_CHAIR['date_reg'],'Y-m-d H:i:s')?></td>
	<td><?php echo getDateFormat($ST_CHAIR['date_cancel'],'Y-m-d H:i:s')?></td>
	</tr>
	</form>
	<?php endforeach?>
	
	</tbody>
	</table>
	
	
	<script type="text/javascript">
	//<![CDATA[
	function updateStatus(form)
	{
		if(form.status.value == '<?php echo $d['khusd_st_cnslt_room_manager']['apply']['status']['ACCEPTED']?>')
		{
			if(form.chair.value == '0')
			{
				alert('당첨 처리는 체어 배정을 통해 가능합니다. 체어를 배정해주세요.');
				return;
			}
		}
		else if(form.status.value == 'delete')
		{
			if(!confirm('정말 삭제하시겠습니까?'))
			{
				form.status.value = form._status.value;
				return;
			}
		}
		else
		{
			form.chair.value = '0';
		}
		
		form.submit();
	}
	
	function updateChair(form)
	{
		if(form.chair.value == '0')
		{
			alert('잘못된 체어 번호입니다.');
			form.chair.value = form._chair.value;
			return;
		}
		
		if(form.status.value == '<?php echo $d['khusd_st_cnslt_room_manager']['apply']['status']['CANCEL']?>')
		{
			alert('취소 상태에서는 체어번호를 변경할 수 없습니다.');
			form.chair.value = form._chair.value;
			return;
		}
		else
		{
			form.status.value = '<?php echo $d['khusd_st_cnslt_room_manager']['apply']['status']['ACCEPTED']?>';
		}
		
		form.submit();
	}
	//]]>
	</script>
</div>