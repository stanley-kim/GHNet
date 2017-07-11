<div id="apply_info_add" class="khusd_st add apply">

<h2>신청 추가</h2>

	<form name="addApply" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="<?php echo $mode?>" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	<input type="hidden" name="uid" value="<?php echo $APPLY_INFO['uid']?>" />
	<input type="hidden" name="s_uid" value="<?php echo $s_uid?>" />
	<input type="hidden" name="nlist" value="<?php echo $g['apply_info_list']?>" />
	<input type="hidden" name="cview" value="<?php echo $g['apply_info_view'].$APPLY_INFO['uid']?>" />
	
	<table class="inputTable">
	<thead>
		<tr>
			<th scope="col" width="80"></th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="td1">제목</td>
			<td class="td2">
				<input type="text" name="subject" class="input subject" value="<?php echo $APPLY_INFO['subject']?>" />
			</td>
		</tr>
		<tr>
			<td class="td1">신청 시작</td>
			<td class="td2">
				<input type="text" id="start_date" name="start_date" class="input date" />
				<input type="number" name="start_hour" class="input time" value="<?php if(strlen($APPLY_INFO['date_start'])>0) echo substr($APPLY_INFO['date_start'], 8, 2)?>" />시
				<input type="number" name="start_min" class="input time" value="<?php if(strlen($APPLY_INFO['date_start'])>0) echo substr($APPLY_INFO['date_start'], 10, 2)?>" />분
				<span class="help">24시간 표시방식으로 입력 (ex. 22시 30분)</span>
			</td>
		</tr>
		<tr>
			<td class="td1">마감 시각</td>
			<td class="td2">
				<input type="text" id="end_date" name="end_date" class="input date" />
				<input type="number" name="end_hour" class="input time" value="<?php if(strlen($APPLY_INFO['date_end'])>0) echo substr($APPLY_INFO['date_end'], 8, 2)?>" />시
				<input type="number" name="end_min" class="input time" value="<?php if(strlen($APPLY_INFO['date_end'])>0) echo substr($APPLY_INFO['date_end'], 10, 2)?>" />분
				<span class="help">24시간 표시방식으로 입력 (ex. 22시 30분)</span>
			</td>
		</tr>
		<tr>
			<td class="td1">관련과</td>
			<td class="td2">
				<select name="department">
					<option value="perio"<?php if($APPLY_INFO['department'] == 'perio'):?> selected<?php endif?>>치주과</option>
					<option value="pros"<?php if($APPLY_INFO['department'] == 'pros'):?> selected<?php endif?>>보철과</option>
					<option value="pedia"<?php if($APPLY_INFO['department'] == 'pedia'):?> selected<?php endif?>>소아치과</option>
					<option value="radio"<?php if($APPLY_INFO['department'] == 'radio'):?> selected<?php endif?>>영상과</option>
					<option value="ortho"<?php if($APPLY_INFO['department'] == 'ortho'):?> selected<?php endif?>>교정과</option>
					<option value="consv"<?php if($APPLY_INFO['department'] == 'consv'):?> selected<?php endif?>>보존과</option>
					<option value="oms"<?php if($APPLY_INFO['department'] == 'oms'):?> selected<?php endif?>>구강외과</option>
					<option value="medi"<?php if($APPLY_INFO['department'] == 'medi'):?> selected<?php endif?>>구강내과</option>ㄴ
					<option value="etc"<?php if($APPLY_INFO['department'] == 'etc'):?> selected<?php endif?>>그외</option>
				</select>
				<input type="checkbox" name="is_perio_surgery"<?php if($APPLY_INFO['is_perio_surgery'] == 'y'):?> checked<?php endif?> />치주수술 신청글인 경우 체크
			</td>
		</tr>
		<tr>
			<td class="td1">분류</td>
			<td class="td2">
				<select name="apply_type">
					<option value="rand"<?php if($APPLY_INFO['apply_type'] == 'rand'):?> selected<?php endif?>>랜덤</option>
					<option value="fcfs"<?php if($APPLY_INFO['apply_type'] == 'fcfs'):?> selected<?php endif?>>선착순</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="td1">신청 수 제한</td>
			<td class="td2">
				<input type="number" name="apply_limit" id="apply_limit" class="input" value="<?php echo $APPLY_INFO['apply_limit']?>" />
				<span class="help">한 사람이 신청 가능한 항목 최대 수</span>
			</td>
		</tr>
		<tr>
			<td class="td1">당첨자 추가신청</td>
			<td class="td2">
				이전 신청에서 당첨된 만큼 신청 수 제한에서 차감이 <select name="able_apply_accepted">
					<option value="n"<?php if($APPLY_INFO['able_apply_accepted'] == 'n'):?> selected<?php endif?>>된다</option>
					<option value="y"<?php if($APPLY_INFO['able_apply_accepted'] == 'y'):?> selected<?php endif?>>안된다</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="td2">
				<textarea name="content" class="input"><?php echo $APPLY_INFO['content']?></textarea>
			</td>
		</tr>
	</tbody>
	</table>

	<div class="bottombox">
		<input type="button" value="취소" class="btngray" onclick="cancelCheck();" />
		<input type="submit" value="확인" class="btnblue" />
	</div>
	
	<script>
		// jquery-ui 의 datepicker 사용하여 날짜 입력 받음
		// 이를 위해 스위치에서 jquery-cdn 켜줘야 함
		$(function() {
			$( "#start_date" ).datepicker({
				dateFormat: "yy-mm-dd",
				dayNamesMin: ['일', '월', '화', '수', '목', '금', '토']
			}
			);
			$( "#end_date" ).datepicker({
				dateFormat: "yy-mm-dd",
				dayNamesMin: ['일', '월', '화', '수', '목', '금', '토']
			}
			);
		});
		$(window).load(function() {
			<?php if(strlen($APPLY_INFO['date_start']) >= 8):?>
				$( "#start_date" ).datepicker( "setDate", "<?php echo substr($APPLY_INFO['date_start'], 0, 4).'-'.substr($APPLY_INFO['date_start'], 4, 2).'-'.substr($APPLY_INFO['date_start'], 6, 2)?>" );
			<?php endif?>
			<?php if(strlen($APPLY_INFO['date_end']) >= 8):?>
				$( "#end_date" ).datepicker( "setDate", "<?php echo substr($APPLY_INFO['date_end'], 0, 4).'-'.substr($APPLY_INFO['date_end'], 4, 2).'-'.substr($APPLY_INFO['date_end'], 6, 2)?>" );
			<?php endif?>
		});
	</script>

</div>
