<div id="apply_add" class="khusd_st add apply">

<h2>선착순 신청 추가</h2>

	<form name="addApply" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="add" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	
	<table>
	<tbody>
		<tr>
			<td class="td1">제목</td>
			<td class="td2">
				<input type="text" name="subject" class="input subject" />
			</td>
		</tr>
		<tr>
			<td class="td1">신청 시작</td>
			<td class="td2">
				<input type="text" id="start_date" name="start_date" />
				<input type="text" name="start_hour" />시
				<input type="text" name="start_min" />분
				<span class="help">24시간 표시방식으로 입력 (ex. 20170705 22시 30분)</span>
			</td>
		</tr>
		<tr>
			<td class="td1">분류</td>
			<td class="td2">
				<select>
					<option>치주 수술 옵져</option>
					<option>기타</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="td1">신청 수 제한</td>
			<td class="td2">
				<input type="text" name="apply_limit" />
				<span class="help">한 사람이 신청 가능한 항목 최대 수</span>
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
		});
	</script>

</div>
