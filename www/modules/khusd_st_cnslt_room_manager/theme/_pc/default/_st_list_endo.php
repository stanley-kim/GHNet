<div id="consv_list" class="khusd_st calendar list consv">

	<table summary="보존과 Endo ST 신청표 입니다.">
	<caption>
	<?php echo getDateFormat($st_date,'Y-m-d (D)')?>
	<?php echo '---'?>
	<?php echo $st_timetype == 'am' ? '오전' : ''?>
	<?php echo $st_timetype == 'pm' ? '오후' : ''?>
	<?php echo $st_timetype == 'nt' ? '야간' : ''?>
	<a href="<?php echo $g['khusd_st_cnslt_room_manager_cnslt_table'].$st_date.'000000'?>" class="highlight">체어 배정표 보러가기</a>
	</caption> 
	<colgroup> 
	<col width="35">
	<col width="65"> 
	<col width="65"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="100"> 
	<col width="100"> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="split">No</th>
	<th scope="col" class="split">상태</th>
	<th scope="col" class="split">체어</th>
	<th scope="col" class="split">진료내용</th>
	<th scope="col" class="split">학생명</th>
	<th scope="col" class="split">환자명</th>
	<th scope="col" class="split">신청시간</th>
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
	<td>
		<?php $_ST_STATUS = $d['khusd_st_cnslt_room_manager']['apply']['status']?>
		<?php if($MANAGER
			 || ($ST_CHAIR['st_id'] == $st_id
			     && ($ST_CHAIR['status'] == $_ST_STATUS['APPLY']
				 || $ST_CHAIR['status'] == $_ST_STATUS['CANDI']
				 || $ST_CHAIR['status'] == $_ST_STATUS['ACCEPTED']))):?>
		<select name="status" onChange="updateStatus(this.form)">
			<?php if($MANAGER):?>
			<option value="<?php echo $_ST_STATUS['APPLY']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['APPLY']):?> selected<?php endif?>>신청</option>
			<option value="<?php echo $_ST_STATUS['CANCEL']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['CANCEL']):?> selected<?php endif?>>취소</option>
			<option value="<?php echo $_ST_STATUS['ACCEPTED']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['ACCEPTED']):?> selected<?php endif?>>당첨</option>
			<option value="<?php echo $_ST_STATUS['CANDI']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['CANDI']):?> selected<?php endif?>>대기</option>
			<option value="<?php echo $_ST_STATUS['ADD_ACCEPTED']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['ADD_ACCEPTED']):?> selected<?php endif?>>추가</option>
			<option value="delete">삭제</option>
			<?php else:?>
				<?php if($ST_CHAIR['status'] == $_ST_STATUS['APPLY']):?>
				<option value="<?php echo $_ST_STATUS['APPLY']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['APPLY']):?> selected<?php endif?>>신청</option>
				<?php elseif($ST_CHAIR['status'] == $_ST_STATUS['CANDI']):?> 
				<option value="<?php echo $_ST_STATUS['CANDI']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['CANDI']):?> selected<?php endif?>>대기</option>
				<?php elseif($ST_CHAIR['status'] == $_ST_STATUS['ACCEPTED']):?>
				<option value="<?php echo $_ST_STATUS['ACCEPTED']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['ACCEPTED']):?> selected<?php endif?>>당첨</option>
				<?php endif?>
				<?php if($date['totime'] >= $apply_start_date && $date['totime'] <= $apply_end_date):?>
				<option value="delete">삭제</option>
				<?php else:?>
				<option value="<?php echo $_ST_STATUS['CANCEL']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['CANCEL']):?> selected<?php endif?>>취소</option>
				<?php endif?>
			<?php endif?>
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
	<td><?php echo $tx_plan_array[$ST_CHAIR['tx_plan']]['name']?></td>
	<td><?php echo $ST_CHAIR['st_info']['name']?></td>
	<td><?php echo $ST_CHAIR['pt_name']?></td>
	<td><?php echo getDateFormat($ST_CHAIR['date_reg'],'Y-m-d H:i:s')?></td>
	<td><?php echo getDateFormat($ST_CHAIR['date_cancel'],'Y-m-d H:i:s')?></td>
	</tr>
	</form>
	<?php endforeach?>
	
	</tbody>
	</table>
	
	<iframe id="candi_list_frame" name="candi_list_frame" src="<?php echo $g['s'].'/?m=khusd_st_cnslt_room_manager&amp;mode=st_candi_list&amp;iframe=Y&amp;st_type='.$st_type.'&amp;st_timetype='.$st_timetype.'&amp;st_date='.$st_date?>" width="100%" border="0px" frameborder="0"> </iframe>
	
	<form name="applyStChair" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="a" value="apply_st_chair" />
		<input type="hidden" name="c" value="<?php echo $c?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		
		<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
		<input type="hidden" name="st_date" value="<?php echo $st_date?>" />
		<input type="hidden" name="st_timetype" value="<?php echo $st_timetype?>" />
		<input type="hidden" name="department" value="<?php echo $department?>" />
		<input type="hidden" name="st_type" value="<?php echo $st_type?>" />

		<table summary="ST신청">
		<caption>ST신청</caption>
		<colgroup>
			<col width=150>
			<col>
		</colgroup>
		<thead>
			<tr>
			<th scope="col"></th>
			<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<tr>
			<td class="head">시간</td>
			<td>
				<select name="st_start_time">
				<?php if($st_timetype == 'am'):?>
					<option value="0900" selected>09:00</option>
					<option value="0930">09:30</option>
					<option value="1000">10:00</option>
					<option value="1030">10:30</option>
					<option value="1100">11:00</option>
					<option value="1130">11:30</option>
				<?php elseif($st_timetype == 'pm'):?>
					<option value="1330" selected>13:30</option>
					<option value="1400">14:00</option>
					<option value="1430">14:30</option>
					<option value="1500">15:00</option>
					<option value="1530">15:30</option>
					<option value="1600">16:00</option>
					<option value="1630">16:30</option>
					<option value="1700">17:00</option>
				<?php endif?>
				</select>
				&nbsp;~&nbsp;
				<select name="st_end_time">
				<?php if($st_timetype == 'am'):?>
					<option value="0930">09:30</option>
					<option value="1000">10:00</option>
					<option value="1030">10:30</option>
					<option value="1100">11:00</option>
					<option value="1130">11:30</option>
					<option value="1200" selected>12:00</option>
				<?php elseif($st_timetype == 'pm'):?>
					<option value="1400">14:00</option>
					<option value="1430">14:30</option>
					<option value="1500">15:00</option>
					<option value="1530">15:30</option>
					<option value="1600">16:00</option>
					<option value="1630">16:30</option>
					<option value="1700">17:00</option>
					<option value="1730" selected>17:30</option>
				<?php endif?>
				</select>
			</td>
			</tr>
			<tr>
			<td class="head">환자명</td>
			<td>
				<input type="text" name="pt_name" maxlength="10" class="input" value="" />
			</td>
			</tr>
			<tr>
			<td class="head">진료내용</td>
			<td>
				<select name="tx_plan">
					<?php foreach($tx_plan_array as $tx_plan):?>
					<option value="<?php echo $tx_plan['id']?>"><?php echo $tx_plan['name']?></option>
					<?php endforeach?>
				</select>
			</td>
			</tr>
		</tbody>
		</table>
	
		<div class="bottombox">
			<input type="button" value="취소" class="btngray" onclick="cancelCheck();" />
			<input type="submit" value="확인" class="btnblue" />
		</div>
	</form>
	
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
		else if (form.status.value == 'c') {
			if(!confirm('정말 취소하시겠습니까?'))
			{
				form.status.value = form._status.value;
				return;
			}
		}
		else {
			form.chair.value = '0';
		}
		
		//alert('Before submit: status change from: ' + form._status.value + ' to: ' + form.status.value);
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