<div id="perio_list" class="khusd_st list perio">

	<table summary="치주과 수술 목록 입니다.">
	<caption>치주과 수술목록<br><a href="<?php echo $g['s']?>/?c=<?php echo $c?>&amp;mode=op_list&amp;wdate=<?php echo $wdate?>&wd=p">&lt;&lt;전주</a>&nbsp;&nbsp;-&nbsp;&nbsp;
	<?php echo getDateFormat($first_of_week, "m/d").'('.$first_day_of_week.')'?>~<?php echo getDateFormat($last_of_week, "m/d").'('.$last_day_of_week.')'?>&nbsp;&nbsp;-&nbsp;&nbsp;<a href="<?php echo $g['s']?>/?c=<?php echo $c?>&amp;mode=op_list&amp;wdate=<?php echo $wdate?>&wd=n">다음주&gt;&gt;</a></caption> 
	<colgroup> 
	<col width="50"> 
	<col width="50"> 
	<col width="50"> 
	<col width="130"> 
	<col width="50"> 
	<col width="50"> 
	<col width="130">
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="split">시간</th>
	<th scope="col" class="split">환자명</th>
	<th scope="col" class="split">술자</th>
	<th scope="col" class="split">수술내용</th>
	<th scope="col" colspan=2 class="split">옵져 이름</th>
	<th scope="col" class="split">비고</th>
	</tr>
	</thead>
	<tbody>
	
	<?php $idx = 1?>
	<?php if(is_array($OP_ARRAY) && count($OP_ARRAY) > 0) :?>
	<?php foreach($OP_ARRAY as $OP_DATE => $OP_LIST):?>
	
	<tr>
	<td colspan="7" class="date"><?php echo getDateFormat($OP_LIST['_date']['totime'], 'Y년 m월 d일 '.getWeekday($OP_LIST['_date']['toweek']).'요일')?></td>
	</tr>
	
	<?php if(is_array($OP_LIST) && count($OP_LIST) > 1):?>
		<?php foreach($OP_LIST as $IDX => $OP):?>
		
		<?php //if($IDX == '_date') continue;?>
		
		<tr>
		<td><?php echo $OP['op_time']?></td>
		<td><?php echo $OP['pt_name']?></td>
		<td><?php echo $OP['op_dr']?></td>
		<td><?php echo $OP['op_name']?></td>
		<td></td>
		<td></td>
		<td><?php echo $OP['remark']?></td>
		</tr>
		<?php endforeach?>
	<?php endif?>
	
	<?php endforeach?>
	<?php else:?>
	<tr>
		<td colspan="7">수술 없음</td>
	</tr>
	<?php endif?>
	
	</tbody>
	</table>
	
	<?php if(true):?>
	<form name="addOp" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="add_op" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />

	<table summary="수술 추가 입력란 입니다.">
	<caption>치주과 수술 추가 입력</caption>
	<colgroup>
		<col width=150>
		<col>
		<col width=150>
		<col>
	</colgroup>
	<thead>
		<tr>
		<th scope="col"></th>
		<th scope="col"></th>
		<th scope="col"></th>
		<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td class="head">날짜</td>
		<td><input type="text" name="op_date" class="input" /></td>
		<td class="head">시간</td>
		<td><select name="op_time">
			<option value="9:00" selected>09:00</option>
			<option value="9:30">09:30</option>
			<option value="10:00">10:00</option>
			<option value="10:30">10:30</option>
			<option value="11:00">11:00</option>
			<option value="11:30">11:30</option>
			<option value="12:00">12:00</option>
			<option value="12:30">12:30</option>
			<option value="13:00">13:00</option>
			<option value="13:30">13:30</option>
			<option value="14:00">14:00</option>
			<option value="14:30">14:30</option>
			<option value="15:00">15:00</option>
			<option value="15:30">15:30</option>
			<option value="16:00">16:00</option>
			<option value="16:30">16:30</option>
			<option value="17:00">17:00</option>
			<option value="17:30">17:30</option>
			<option value="18:00">18:00</option>
			<option value="18:30">18:30</option>
			<option value="19:00">19:00</option>
			<option value="19:30">19:30</option>
			<option value="20:00">20:00</option>
			<option value="20:30">20:30</option>
		</select></td>
	</tr>
	<tr>
		<td class="head">환자명</td>
		<td><input type="text" name="pt_name" maxlength="20" class="input" /></td>
		<td class="head">술자</td>
		<td><input type="text" name="op_dr" maxlength="20" class="input" /></td>
	</tr>
	<tr>
		<td class="head">수술내용</td>
		<td colspan="3"><input type="text" name="op_name" maxlength="50" class="input" /></td>
	</tr>
	<tr>
		<td class="head">비고</td>
		<td colspan="3"><input type="text" name="op_remark" maxlength="200" class="input" /></td>
	</tr>
	</tbody>
	</table>
	
	<div class="bottombox">
		<input type="submit" value="추가" class="btnblue" />
	</div>
	
	</form>
	<?php endif?>
</div>