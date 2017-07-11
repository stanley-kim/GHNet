<style>
.time_info{
	width:100%;
}
.time_info td.selected{background: yellow; }

input{text-align:center;}
input.time{width:40px;}
input.time.hour{margin-left:10px;}
input.date{width:100px}
.time_table th{background:#0101EC; color:white; padding:10px 0;}
</style>
<div id="update_check" class="khusd_st manager">
	
	
	
	<div id="dept_select">
		<form name="update_check" action="<?php echo $g['s']?>/">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="c" value="<?php echo $c?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="mode" value="<?php echo $mode?>" />
		<p>
		<input type="checkbox" name="check_all" onClick='check_all_dept(this.form);' />전체
		<?php foreach($dept_array as $dept):?>
		<input type="checkbox" name="check_<?php echo $dept['id']?>"<?php if($GLOBALS['check_'.$dept['id']]):?> checked<?php endif?>/><?php echo $dept['name']?>&nbsp;&nbsp;
		<?php endforeach?>
		<input type="submit" value="확인" class="btngray" />
		</p>


		<table class="time_table" style="width:100%;">
			<tr>
				<th>시작 시간</th>
				<th>마감 시간</th>
			</tr>
			<tr>
				<td>
				<input type="text" id="start_date" name="start_date" class="input date" value="<?php if(strlen($_INFO['date_start_date'])>0) echo $_INFO['date_start_date']?>"/>
				<input type="number" name="start_hour" class="input time hour" value="<?php if(strlen($_INFO['date_start_hour'])>0) echo $_INFO['date_start_hour']?>" />시
				<input type="number" name="start_min" class="input time" value="<?php if(strlen($_INFO['date_start_minute'])>0) echo $_INFO['date_start_minute']?>" />분
				</td>
				<td>
				<input type="text" id="end_date" name="end_date" class="input date" value="<?php if(strlen($_INFO['date_end_date'])>0) echo $_INFO['date_end_date']?>" />
				<input type="number" name="end_hour" class="input time hour" value="<?php if(strlen($_INFO['date_end_hour'])>0) echo $_INFO['date_end_hour']?>" />시
				<input type="number" name="end_min" class="input time" value="<?php if(strlen($_INFO['date_end_minute'])>0) echo $_INFO['date_end_minute']?>" />분
				</td>
			</tr>
		</table>
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

		</form>
	</div>
	
	<?php if(count($UPDATE_CHECK) > 0):?>
	<form style="display:none;" name="push_update" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="a" value="push_update" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="c" value="<?php echo $c?>" />
		<input type="hidden" name="base_date" value="<?php echo $base_date ? $base_date : $date['today']?>" />

		<input type="submit" value="독촉하기" class="btngray" />
	</form>
	<p style="display:none;"> 단, 독촉 알림은 선택한 기간내에 모든 과에 대해서 한 개의 업데이트 누락시라도 독촉합니다.</p>
	<table style="width:100%;">
	<colgroup>
		<col width="35">
		<col width="95">
		<col width="80">
		<?php foreach($check_dept as $dept):?>
		<col width="80">
		<?php endforeach?>
	</colgroup>
	<thead>
	<tr>
		<th rowspan="2" scope="col" class="split">No</th>
		<th rowspan="2" scope="col" class="split">학번</th>
		<th rowspan="2" scope="col" class="split">이름</th>
		<th colspan="<?php echo count($check_dept)?>" scope="col" class="split">수정 여부</th>
	</tr>
	<tr>
		<?php foreach($check_dept as $dept):?>
		<th scope="col" class="split"><?php echo $dept_array[$dept]['name']?></th>
		<?php endforeach?>
	</tr>
	</thead>
	<?php $idx = 1?>
	<?php foreach($UPDATE_CHECK as $UPDATE):?>
		<tr>
			<td><?php echo $idx++?></td>
			<td><?php echo $UPDATE['st_id']?></td>
			<td><?php echo $UPDATE['name']?></td>
			<?php foreach($check_dept as $dept_id):?>
			<?php if($UPDATE_LIST[$dept_id][$UPDATE['st_id']]):?>
			<td>완료</td>
			<?php else:?>
			<td class="category1"><p class="notyet">미업뎃</p></td>
			<?php endif?>
			<?php endforeach?>
		</tr>
	<?php endforeach?>
	</table>
	
	<?php else:?>
	<br />
		확인하고자 하는 과와 시간을 선택해주세요
	<?php endif?>

</div>

<script type="text/javascript">
	//<![CDATA[
	function check_all_dept(form) {
		if(form.check_all.checked)
		{
			<?php foreach($dept_array as $dept):?>
			form.check_<?php echo $dept['id']?>.checked = true;
			<?php endforeach?>
		}
		else
		{
			<?php foreach($dept_array as $dept):?>
			form.check_<?php echo $dept['id']?>.checked = false;
			<?php endforeach?>
		}
	}
	// jquery-ui 의 datepicker 사용하여 날짜 입력 받음
	// 이를 위해 스위치에서 jquery-cdn 켜줘야 함
	$(function() {
		$( "#base_date" ).datepicker({
			dateFormat: "YYYYmmdd",
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토']
		}
		);
	});
	//]]>
</script>
