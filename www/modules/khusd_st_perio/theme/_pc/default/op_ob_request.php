<div id="perio_op_req_list" class="khusd_st list perio">

	<div class="info">
	</div>
	
	<table summary="치주과 수술 신청 리스트 입니다.">
	<caption>치주과 수술 신청 리스트</caption> 
	<colgroup> 
	<col width="50"> 
	<col> 
	<col width="80"> 
	<col width="70"> 
	<col width="90">
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="side1">번호</th>
	<th scope="col">제목</th>
	<th scope="col">올린이</th>
	<th scope="col">수술 개수</th>
	<th scope="col" class="side2">신청날짜</th>
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
		<td colspan="5">수술 없음</td>
	</tr>
	<?php endif?>
	
	</tbody>
	</table>
	<div class="bottom">
		<div class="btnbox1">
			<span class="btn00">
				<a href="">수술신청 추가</a>
			</span>
		</div>
	</div>
	
</div>