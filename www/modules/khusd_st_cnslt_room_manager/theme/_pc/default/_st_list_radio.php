<div id="oral_exam_list" class="khusd_st calendar list oral_exam">

	<table summary="구강검진 ST 신청표 입니다.">
	<caption>
	<?php echo getDateFormat($st_date,'Y-m-d (D)')?>
	<?php echo '---'?>
	<?php
		if($st_timetype == 'am')
			$st_timetype_string = '오전';
		elseif($st_timetype == 'pm')
			$st_timetype_string = '오후';
		elseif($st_timetype == 'nt')
			$st_timetype_string = '야간';
	?>
	<?php echo $st_timetype_string?>
	</caption> 
	<colgroup> 
	<col width="35">
	<col width="65"> 
	<col width="50"> 
	<col width="65"> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	</colgroup> 
	<thead>
	<?php if($MANAGER):?>
		<tr>
		<th scope="col" class="split">No</th>
		<th scope="col" class="split">상태</th>
		<th scope="col" class="split">타임</th>
		<th scope="col" class="split">신청자</th>
		<th scope="col" class="split">환자명</th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_cnslt_room_manager_st_radio_list'].$st_date.'&amp;st_timetype='.$st_timetype, 'prev_taking', $om, $order == 'prev_taking')?>">직전Taking수</a></th>
		<th scope="col" class="split"><a href="<?php echo getSortingLink2($g['khusd_st_cnslt_room_manager_st_radio_list'].$st_date.'&amp;st_timetype='.$st_timetype, 'prev_taking_pt', $om, $order == 'prev_taking_pt')?>">직전 환자수</a></th>
		</tr>
	<?php else:?>
		<tr>
		<th scope="col" class="split">No</th>
		<th scope="col" class="split">상태</th>
		<th scope="col" class="split">타임</th>
		<th scope="col" class="split">신청자</th>
		<th scope="col" class="split">환자명</th>
		<th scope="col" class="split">직전Taking수</th>
		<th scope="col" class="split">직전 환자수</th>
		</tr>
		<?php endif?>
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
		<input type="hidden" name="chair" value="0" />
	<tr class="date_row date_row_<?=$ST_CHAIR['st_timetype_detail']?>">
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
				<?php if($cur_time_t >= $st_apply_start_date_t && $cur_time_t <= $st_apply_end_date_t):?>
				<option value="delete">삭제</option>
				<?php else:?>
				<option value="<?php echo $_ST_STATUS['CANCEL']?>"<?php if($ST_CHAIR['status'] == $_ST_STATUS['CANCEL']):?> selected<?php endif?>>취소</option>
				<?php endif?>
			<?php endif?>
		</select>
		<?php else:?>
			<?php 
			if($ST_CHAIR['status'] == $_ST_STATUS['APPLY'])
				$_status = '신청';
			elseif($ST_CHAIR['status'] == $_ST_STATUS['CANCEL'])
				$_status = '취소';
			elseif($ST_CHAIR['status'] == $_ST_STATUS['ACCEPTED'])
				$_status = '당첨';
			elseif($ST_CHAIR['status'] == $_ST_STATUS['CANDI'])
				$_status = '대기';
			elseif($ST_CHAIR['status'] == $_ST_STATUS['ADD_ACCEPTED'])
				$_status = '추가';
			?>
			<?php echo $_status; ?>
		<?php endif?>
	</td>
	<td class="timetype">
		<?php echo $st_timetype_string." ".$ST_CHAIR['st_timetype_detail'].""?>
	</td>
	<td><?php echo $ST_CHAIR['st_info']['name']?>

	</td>
	<td><?php echo $ST_CHAIR['pt_name']?></td>
	<td><?php echo $ST_CHAIR['prev_taking']?></td>
	<td><?php echo $ST_CHAIR['prev_taking_pt']?></td>
	</tr>
	<tr>
	<td></td>
	<td colspan=6 style="text-align: left;color:#ababab">
		신청: <?php echo getDateFormat($ST_CHAIR['date_reg'],'Y-m-d H:i:s')?>
		<?php if($ST_CHAIR['date_cancel']): ?> | 취소: <?php echo getDateFormat($ST_CHAIR['date_cancel'],'Y-m-d H:i:s')?><?php endif?>
	</td>
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
		<input type="hidden" name="department" value="<?php echo $department?>" />
		<input type="hidden" name="st_type" value="<?php echo $st_type?>" />

		<table summary="구강검진 신청 입니다.">
		<caption>구강검진 신청</caption>
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
					<?php if(getDateFormat($st_date,'w') == 3):?>
					<option value="nt"<?php if($st_timetype == 'nt'):?> selected<?php endif?>>야간</option>
					<?php endif?>
				</select>
			</td>
			</tr>
			<tr>
			<td class="head">상세타임</td>
			<td>
				<select name="st_timetype_detail">
					<option value="1" selected>첫번째</option>
					<option value="2">두번째</option>
					<?php if(getDateFormat($st_date,'w') == 3 && $st_timetype == 'nt'):?>
					<option value="3">세번째</option>
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
		</tbody>
		</table>
	
		<div class="bottombox">
			<input type="button" value="취소" class="btngray" onclick="cancelCheck();" />
			<input type="submit" value="확인" class="btnblue" />
		</div>
	</form>
	
	<script type="text/javascript">
	//<![CDATA[
	<?php if($g['mobile']):?>
	function snsWin(st_name, type, st_num, is_today_apply)
	{
		if(is_today_apply == false)
		{
			if(confirm('당일 신청만 카톡알림하면 됩니다. 그래도 카톡 알림 하시겠습니까~~~~????') == false)
			{
				return;
			}
		}
		var snsset = new Array();
		var enc_sbj = encodeURIComponent("-"+st_name+" "+type+"\n총"+st_num+"명");
		var enc_url = "<?php echo urlencode(
							$g['url_root'].'/?'.($_HS['usescode']?'r='.$r.'&':'')
							.'m='.$m
							.'&department='.$department
							.'&st_type='.$st_type
							.'&mode='.$mode
							.'&st_date='.$st_date
							.'&st_timetype='.$st_timetype
						)?>";
		var enc_appname = "<?php echo urlencode(
							getDateFormat($st_date,'m/d (D)').$st_timetype_string.' 구강검진'
						)?>";
		
		snsset['k'] = 'kakaolink://sendurl?msg=' + enc_sbj + '&url=' + enc_url + '&appid=kr.co.kimsq.st43&appver=1.0&appname=' + enc_appname;
		window.location = snsset['k'];
	}
	<?php endif?>
	function updateStatus(form)
	{
		if(form.status.value == '<?php echo $d['khusd_st_cnslt_room_manager']['apply']['status']['ACCEPTED']?>')
		{
			if(!confirm('정말 당첨시키겠습니까?'))
			{
				form.status.value = form._status.value;
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
		else if(form.status.value == 'cancel')
		{
			if(!confirm('정말 취소하시겠습니까?'))
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
	
	//]]>
	</script>
</div>
