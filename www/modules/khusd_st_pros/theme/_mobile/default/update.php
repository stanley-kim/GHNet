<div id="pros_update" class="khusd_st update pros">

<h2>보철과 정보 수정</h2>

	<form name="updateScore" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="update" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	
	<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
	<?php if($n_page):?>
		<input type="hidden" name="n_page" value="<?php echo $n_page?>" />
	<?php endif?>

	<table summary="보철과 점수표 입니다.">
	<caption>보철과 점수표</caption>
	<colgroup>
		<col width=150>
		<col>
		<col>
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
			<td class="title" colspan=4>Observation(Follow Up)</td>
		</tr>
		<tr>
		<td class="head">Post Core</td>
		<td>진행중<input type="number" name="post_core_ongoing" maxlength="5" class="input num" value="<?php echo $SCORE['post_core_ongoing']?>">회,</td>
		<td>완료<input type="number" name="post_core_complete" maxlength="5" class="input num" value="<?php echo $SCORE['post_core_complete']?>">회,</td>
		<td>(지난학기 완료 : <input type="number" name="post_core_prev" maxlength="5" class="input num" value="<?php echo $SCORE['post_core_prev']?>">회)</td>
		</tr>
		<tr>
		<td class="head">Implant Cr&Br</td>
		<td>진행중<input type="number" name="imp_cr_br_ongoing" maxlength="5" class="input num" value="<?php echo $SCORE['imp_cr_br_ongoing']?>">회,</td>
		<td>완료<input type="number" name="imp_cr_br_complete" maxlength="5" class="input num" value="<?php echo $SCORE['imp_cr_br_complete']?>">회,</td>
		<td>(지난학기 완료 : <input type="number" name="imp_cr_br_prev" maxlength="5" class="input num" value="<?php echo $SCORE['imp_cr_br_prev']?>">회)</td>
		</tr>
		<tr>
		<td class="head">Single Cr/Laminate</td>
		<td>진행중<input type="number" name="single_cr_ongoing" maxlength="5" class="input num" value="<?php echo $SCORE['single_cr_ongoing']?>">회,</td>
		<td>완료<input type="number" name="single_cr_complete" maxlength="5" class="input num" value="<?php echo $SCORE['single_cr_complete']?>">회,</td>
		<td>(지난학기 완료 : <input type="number" name="single_cr_prev" maxlength="5" class="input num" value="<?php echo $SCORE['single_cr_prev']?>">회)</td>
		</tr>
		<tr>
		<td class="head">Bridge (3unit 이상)</td>
		<td>진행중<input type="number" name="br_ongoing" maxlength="5" class="input num" value="<?php echo $SCORE['br_ongoing']?>">회,</td>
		<td>완료<input type="number" name="br_complete" maxlength="5" class="input num" value="<?php echo $SCORE['br_complete']?>">회,</td>
		<td>(지난학기 완료 : <input type="number" name="br_prev" maxlength="5" class="input num" value="<?php echo $SCORE['br_prev']?>">회)</td>
		</tr>
		<tr>
		<td class="head">Partial Denture</td>
		<td>진행중<input type="number" name="partial_denture_ongoing" maxlength="5" class="input num" value="<?php echo $SCORE['partial_denture_ongoing']?>">회,</td>
		<td>완료<input type="number" name="partial_denture_complete" maxlength="5" class="input num" value="<?php echo $SCORE['partial_denture_complete']?>">회,</td>
		<td>(지난학기 완료 : <input type="number" name="partial_denture_prev" maxlength="5" class="input num" value="<?php echo $SCORE['partial_denture_prev']?>">회)</td>
		</tr>
		<tr>
		<td class="head">Complete Denture</td>
		<td>진행중<input type="number" name="complete_denture_ongoing" maxlength="5" class="input num" value="<?php echo $SCORE['complete_denture_ongoing']?>">회,</td>
		<td>완료<input type="number" name="complete_denture_complete" maxlength="5" class="input num" value="<?php echo $SCORE['complete_denture_complete']?>">회,</td>
		<td>(지난학기 완료 : <input type="number" name="complete_denture_prev" maxlength="5" class="input num" value="<?php echo $SCORE['complete_denture_prev']?>">회)</td>
		</tr>
		<tr>
			<td class="title" colspan=4>Observation(단순 Obs)</td>
		</tr>
		<tr>
		<td rowspan="1" class="head">3학년 2학기</td>
		<td>1cycle<input type="number" name="simple_obser_3_8" maxlength="5" class="input num" value="<?php echo $SCORE['simple_obser_3_8']?>">회</td>
		<td>2cycle<input type="number" name="simple_obser_3_10" maxlength="5" class="input num" value="<?php echo $SCORE['simple_obser_3_10']?>">회</td>
		<td>3cycle<input type="number" name="simple_obser_3_12" maxlength="5" class="input num" value="<?php echo $SCORE['simple_obser_3_12']?>">회</td>
		</tr>
		<td>
		<td>
		<tr>
			<td class="title" colspan=4>Pre ST Case</td>
		</tr>

		<tr>
		<td class="head">2년차 Cr</td>
		<td>진행중<input type="number" name="second_cr_ongoing" maxlength="5" class="input num" value="<?php echo $SCORE['second_cr_ongoing']?>">회,</td>
		<td>완료<input type="number" name="second_cr_complete" maxlength="5" class="input num" value="<?php echo $SCORE['second_cr_complete']?>">회,</td>
<!--		<td>취소<input type="number" name="second_cr_cancel" maxlength="5" class="input num" value="<?php echo $SCORE['second_cr_cancel']?>">회,</td>-->
		<td>(지난학기 완료 : <input type="number" name="second_cr_prev" maxlength="5" class="input num" value="<?php echo $SCORE['second_cr_prev']?>">회)</td>
		</tr>

		<td>
		<td>
		<tr>
			<td class="title" colspan=4>ST Case</td>
		</tr>
		<tr>
		<td rowspan="6" class="head">ST Case 1</td>
		<td colspan="3">
			<select name="st_case_1">
				<option value=""<?php if($SCORE['st_case_1'] == ''):?> selected<?php endif?>>------------</option>
			<?php foreach($d['khusd_st_pros']['st_stage'] as $key => $text):?>
				<option value="<?php echo $key?>"<?php if($SCORE['st_case_1'] == $key):?> selected<?php endif?>><?php echo $text?></option>
			<?php endforeach?>
			</select>
			
		</td>
		</tr>

		<tr>
		<td>환자명</td>
		<td colspan="2">
			<input type="text" name="st_case_1_pt_name" maxlength="10" class="input" value="<?php echo $SCORE['st_case_1_pt_name']?>" />
		</td>
		</tr>
		<tr>
		<td>친환시 체크</td>
		<td colspan="2">
			<input type="checkbox" name="st_case_1_friendly" class="input"<?php if($SCORE['st_case_1_friendly'] == 'y'):?> checked<?php endif?> />
		</td>
		</tr>
		<tr>
		<td>마지막 진료일</td>
		<td colspan="2">
			<input type="text" name="st_case_1_last_tx_date" id="st_case_1_last_tx_date" maxlength="10" class="input" value="<?php echo $SCORE['st_case_1_last_tx_date']?>">
		</td>
		</tr>
		<tr>
		<td>마지막 진료단계</td>
		<td colspan="2">
			<select name="st_case_1_last_tx">
				<option value="none">없음</option>
				<?php foreach($tx_plan_array as $tx_plan):?>
				<option value="<?php echo $tx_plan['id']?>"<?php if($SCORE['st_case_1_last_tx'] == $tx_plan['id']):?> selected<?php endif?>><?php echo $tx_plan['name']?></option>
				<?php endforeach?>
			</select>
		</td>
		</tr>
		<tr>
		<td>마지막 인스트럭터</td>
		<td colspan="2">
			<select name="st_case_1_last_inst">
				<option value="none">없음</option>
				<?php foreach($inst_array as $inst):?>
				<option value="<?php echo $inst['id']?>"<?php if($SCORE['st_case_1_last_inst'] == $inst['id']):?> selected<?php endif?>><?php echo $inst['name']?></option>
				<?php endforeach?>
			</select>
		</td>
		</tr>


		<tr>
		<td rowspan="6" class="head">ST Case 2</td>
		<td colspan="3">
			<select name="st_case_2">
				<option value=""<?php if($SCORE['st_case_2'] == ''):?> selected<?php endif?>>------------</option>
			<?php foreach($d['khusd_st_pros']['st_stage'] as $key => $text):?>
				<option value="<?php echo $key?>"<?php if($SCORE['st_case_2'] == $key):?> selected<?php endif?>><?php echo $text?></option>
			<?php endforeach?>
			</select>
		</td>
		</tr>

		<tr>
		<td>환자명</td>
		<td colspan="2">
			<input type="text" name="st_case_2_pt_name" maxlength="10" class="input" value="<?php echo $SCORE['st_case_2_pt_name']?>" />
		</td>
		</tr>
		<tr>
		<td>친환시 체크</td>
		<td colspan="2">
			<input type="checkbox" name="st_case_2_friendly" class="input"<?php if($SCORE['st_case_2_friendly'] == 'y'):?> checked<?php endif?> />
		</td>
		</tr>
		<tr>
		<td>마지막 진료일</td>
		<td colspan="2">
			<input type="text" name="st_case_2_last_tx_date" id="st_case_2_last_tx_date" maxlength="10" class="input" value="<?php echo $SCORE['st_case_2_last_tx_date']?>">
		</td>
		</tr>
		<tr>
		<td>마지막 진료단계</td>
		<td colspan="2">
			<select name="st_case_2_last_tx">
				<option value="none">없음</option>
				<?php foreach($tx_plan_array as $tx_plan):?>
				<option value="<?php echo $tx_plan['id']?>"<?php if($SCORE['st_case_2_last_tx'] == $tx_plan['id']):?> selected<?php endif?>><?php echo $tx_plan['name']?></option>
				<?php endforeach?>
			</select>
		</td>
		</tr>
		<tr>
		<td>마지막 인스트럭터</td>
		<td colspan="2">
			<select name="st_case_2_last_inst">
				<option value="none">없음</option>
				<?php foreach($inst_array as $inst):?>
				<option value="<?php echo $inst['id']?>"<?php if($SCORE['st_case_2_last_inst'] == $inst['id']):?> selected<?php endif?>><?php echo $inst['name']?></option>
				<?php endforeach?>
			</select>
		</td>
		</tr>


		<tr>
		<td rowspan="6" class="head">ST Case 3</td>
		<td colspan="3">
			<select name="st_case_3">
				<option value=""<?php if($SCORE['st_case_3'] == ''):?> selected<?php endif?>>------------</option>
			<?php foreach($d['khusd_st_pros']['st_stage'] as $key => $text):?>
				<option value="<?php echo $key?>"<?php if($SCORE['st_case_3'] == $key):?> selected<?php endif?>><?php echo $text?></option>
			<?php endforeach?>
			</select>
		</td>
		</tr>

		<tr>
		<td>환자명</td>
		<td colspan="2">
			<input type="text" name="st_case_3_pt_name" maxlength="10" class="input" value="<?php echo $SCORE['st_case_3_pt_name']?>" />
		</td>
		</tr>
		<tr>
		<td>친환시 체크</td>
		<td colspan="2">
			<input type="checkbox" name="st_case_3_friendly" class="input"<?php if($SCORE['st_case_3_friendly'] == 'y'):?> checked<?php endif?> />
		</td>
		</tr>
		<tr>
		<td>마지막 진료일</td>
		<td colspan="2">
			<input type="text" name="st_case_3_last_tx_date" id="st_case_3_last_tx_date" maxlength="10" class="input" value="<?php echo $SCORE['st_case_3_last_tx_date']?>">
		</td>
		</tr>
		<tr>
		<td>마지막 진료단계</td>
		<td colspan="2">
			<select name="st_case_3_last_tx">
				<option value="none">없음</option>
				<?php foreach($tx_plan_array as $tx_plan):?>
				<option value="<?php echo $tx_plan['id']?>"<?php if($SCORE['st_case_3_last_tx'] == $tx_plan['id']):?> selected<?php endif?>><?php echo $tx_plan['name']?></option>
				<?php endforeach?>
			</select>
		</td>
		</tr>
		<tr>
		<td>마지막 인스트럭터</td>
		<td colspan="2">
			<select name="st_case_3_last_inst">
				<option value="none">없음</option>
				<?php foreach($inst_array as $inst):?>
				<option value="<?php echo $inst['id']?>"<?php if($SCORE['st_case_3_last_inst'] == $inst['id']):?> selected<?php endif?>><?php echo $inst['name']?></option>
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

	<script type="text/javascript">
	//<![CDATA[
	// jquery-ui 의 datepicker 사용하여 날짜 입력 받음
	// 이를 위해 스위치에서 jquery-cdn 켜줘야 함
	$(function() {
		$( "#st_case_1_last_tx_date" ).datepicker({
			dateFormat: "yy-mm-dd",
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토']
		}
		);
		$( "#st_case_2_last_tx_date" ).datepicker({
			dateFormat: "yy-mm-dd",
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토']
		}
		);
		$( "#st_case_3_last_tx_date" ).datepicker({
			dateFormat: "yy-mm-dd",
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토']
		}
		);
	});
	$(window).load(function() {
		<?php if(strlen($SCORE['st_case_1_last_tx_date']) >= 8):?>
			$( "#st_case_1_last_tx_date" ).datepicker( "setDate", "<?php echo substr($SCORE['st_case_1_last_tx_date'], 0, 4).'-'.substr($SCORE['st_case_1_last_tx_date'], 4, 2).'-'.substr($SCORE['st_case_1_last_tx_date'], 6, 2)?>" );
		<?php endif?>
	});
	$(window).load(function() {
		<?php if(strlen($SCORE['st_case_2_last_tx_date']) >= 8):?>
			$( "#st_case_2_last_tx_date" ).datepicker( "setDate", "<?php echo substr($SCORE['st_case_2_last_tx_date'], 0, 4).'-'.substr($SCORE['st_case_2_last_tx_date'], 4, 2).'-'.substr($SCORE['st_case_2_last_tx_date'], 6, 2)?>" );
		<?php endif?>
	});
	$(window).load(function() {
		<?php if(strlen($SCORE['st_case_3_last_tx_date']) >= 8):?>
			$( "#st_case_3_last_tx_date" ).datepicker( "setDate", "<?php echo substr($SCORE['st_case_3_last_tx_date'], 0, 4).'-'.substr($SCORE['st_case_3_last_tx_date'], 4, 2).'-'.substr($SCORE['st_case_3_last_tx_date'], 6, 2)?>" );
		<?php endif?>
	});
	//]]>
	</script>

</div>
