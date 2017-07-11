<div id="perio_list" class="khusd_st calendar list perio">

	<table summary="치주과 ST 신청표 입니다.">
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
	<col width="50"> 
	<col width="50"> 
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
	<th scope="col" class="split">상태</th>
	<th scope="col" class="split">체어</th>
	<th scope="col" class="split">진료내용</th>
	<th scope="col" class="split">학생명</th>
	<th scope="col" class="split">환자명</th>
	<th scope="col" class="split">직전SC수</th>
	<th scope="col" class="split">직전SPT수</th>
	<th scope="col" class="split">직전CU수</th>
	<th scope="col" class="split">예상ST점수</th>
	<th scope="col" class="split">금주체어수</th>
	<th scope="col" class="split">Pre-ST 완료</th>
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
	<tr>
	<td><?php echo $idx++?></td>
	<td>
		<?php $_ST_STATUS = $d['khusd_st_cnslt_room_manager']['apply']['status']?>
		<?php if($MANAGER):?>
		<select name="status" onChange="updateStatus(this.form)">
			<option value="<?php echo $_ST_STATUS['APPLY']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['APPLY']):?> selected<?php endif?>>신청</option>
			<option value="<?php echo $_ST_STATUS['CANCEL']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['CANCEL']):?> selected<?php endif?>>취소</option>
			<option value="<?php echo $_ST_STATUS['ACCEPTED']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['ACCEPTED']):?> selected<?php endif?>>당첨</option>
			<option value="<?php echo $_ST_STATUS['CANDI']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['CANDI']):?> selected<?php endif?>>대기</option>
			<option value="<?php echo $_ST_STATUS['ADD_ACCEPTED']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['ADD_ACCEPTED']):?> selected<?php endif?>>추가</option>
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
			<?php for($idx = 0; $idx < $CHAIR_NUM_MAX; $idx++):?>
			<option value="<?php echo $idx + 1?>"<?php if($ST_CHAIR['chair_no'] == ($idx + 1)):?> selected<?php endif?>><?php echo $idx + 1?></option>
			<?php endfor?>
		</select>
		<?php else:?>
		<?php echo $ST_CHAIR['chair_no'] == 0 ? '미배정' : $ST_CHAIR['chair_no']?>
		<?php endif?>
	</td>
	<td><?php echo $tx_plan_array[$ST_CHAIR['tx_plan']]['name']?></td>
	<td><?php echo $ST_CHAIR['st_info']['name']?></td>
	<td><?php echo $ST_CHAIR['pt_name']?></td>
	<td><?php echo $ST_CHAIR['stsc']?></td>
	<td><?php echo $ST_CHAIR['stpc']?></td>
	<td><?php echo $ST_CHAIR['stcu']?></td>
	<td><?php echo $ST_CHAIR['st_score']?></td>
	<td>0</td>
	<td><?php echo $ST_CHAIR['pre_st'] == 1 ? '완' : ''?></td>
	<td><?php echo getDateFormat($ST_CHAIR['date_reg'],'Y-m-d H:i:s')?></td>
	<td><?php echo getDateFormat($ST_CHAIR['date_cancel'],'Y-m-d H:i:s')?></td>
	</tr>
	</form>
	<?php endforeach?>
	
	</tbody>
	</table>
	
	<form name="applyStChair" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="a" value="apply_st_chair" />
		<input type="hidden" name="c" value="<?php echo $c?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		
		<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
		<input type="hidden" name="st_date" value="<?php echo $st_date?>" />

		<table summary="치주과 점수표 입니다.">
		<caption>치주과 점수표</caption>
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
			<td class="head">시간구분</td>
			<td>
				<select name="st_timetype">
					<option value="am"<?php if($st_timetype == 'am'):?> selected<?php endif?>>오전</option>
					<option value="pm"<?php if($st_timetype == 'pm'):?> selected<?php endif?>>오후</option>
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
		else
		{
			form.chair.value = '0';
		}
		
		form.submit();
	}
	
	function updateChair(form)
	{
		var chair_original = form.chair.value;
		
		if(form.chair.value == '0')
		{
			alert('잘못된 체어 번호입니다.');
			form.chair.value = chair_original;
			return;
		}
		
		if(form.status.value == '<?php echo $d['khusd_st_cnslt_room_manager']['apply']['status']['CANCEL']?>')
		{
			alert('취소 상태에서는 체어번호를 변경할 수 없습니다.');
			form.chair.value = chair_original;
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