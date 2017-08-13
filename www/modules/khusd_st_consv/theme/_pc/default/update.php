<div id="consv_update" class="khusd_st update consv">

<h2>보존과 정보 수정</h2>

	<form name="updateScore" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="update" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	
	<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
	<?php if($n_page):?>
		<input type="hidden" name="n_page" value="<?php echo $n_page?>" />
	<?php endif?>

	<table summary="보존과 점수표 입니다.">
	<caption>보존과 점수표</caption>
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
			<td class="title" colspan=2 style="background-color:#eeffff;">Pre-ST Case</td>
		</tr>
		<tr>
		<td class="head">Operative</td>
		<td class="input">
			<span>ANT.</span> <input type="number" name="pre_st_ant" maxlength="5" class="input num" value="<?php echo $SCORE['pre_st_ant']?>">회 | 
			<span>POS.</span> <input type="number" name="pre_st_post" maxlength="5" class="input num" value="<?php echo $SCORE['pre_st_post']?>">회<br />
			<span>Cervical</span> <input type="number" name="pre_st_cervical" maxlength="5" class="input num" value="<?php echo $SCORE['pre_st_cervical']?>">회 | 
			<span>Amalgam</span> <input type="number" name="pre_st_am" maxlength="5" class="input num" value="<?php echo $SCORE['pre_st_am']?>">회
		</td>
		<tr>
		<td class="head">전치 Endo</td>
		<td class="input">
			PE<input type="checkbox" name="pre_st_ant_pe" maxlength="5" class="checkbox" <?php if($SCORE['pre_st_ant_pe']):?>  checked<?php endif?>>
			CE<input type="checkbox" name="pre_st_ant_ce" maxlength="5" class="checkbox" <?php if($SCORE['pre_st_ant_ce']):?>  checked<?php endif?>>
			CF<input type="checkbox" name="pre_st_ant_cf" maxlength="5" class="checkbox" <?php if($SCORE['pre_st_ant_cf']):?>  checked<?php endif?>>
		</td>
		</tr>
		<tr>
		<td class="head">소구치 Endo</td>
		<td class="input">
			PE<input type="checkbox" name="pre_st_pre_pe" maxlength="5" class="checkbox" <?php if($SCORE['pre_st_pre_pe']):?>  checked<?php endif?>>
			CE<input type="checkbox" name="pre_st_pre_ce" maxlength="5" class="checkbox" <?php if($SCORE['pre_st_pre_ce']):?>  checked<?php endif?>>
			CF<input type="checkbox" name="pre_st_pre_cf" maxlength="5" class="checkbox" <?php if($SCORE['pre_st_pre_cf']):?>  checked<?php endif?>>
		</td>
		</tr>
		<tr>
		<td class="head">전치 Re-endo</td>
		<td class="input">
			GP제거<input type="checkbox" name="pre_st_ant_re_rm" maxlength="5" class="checkbox" <?php if($SCORE['pre_st_ant_re_rm']):?>  checked<?php endif?>>
			CE<input type="checkbox" name="pre_st_ant_re_ce" maxlength="5" class="checkbox" <?php if($SCORE['pre_st_ant_re_ce']):?>  checked<?php endif?>>
			CF<input type="checkbox" name="pre_st_ant_re_cf" maxlength="5" class="checkbox" <?php if($SCORE['pre_st_ant_re_cf']):?>  checked<?php endif?>>
		</td>
		</tr>
		<tr>
		<td class="head">소구치 Re-endo</td>
		<td class="input">
			GP제거<input type="checkbox" name="pre_st_pre_re_rm" maxlength="5" class="checkbox" <?php if($SCORE['pre_st_pre_re_rm']):?>  checked<?php endif?>>
			CE<input type="checkbox" name="pre_st_pre_re_ce" maxlength="5" class="checkbox" <?php if($SCORE['pre_st_pre_re_ce']):?>  checked<?php endif?>>
			CF<input type="checkbox" name="pre_st_pre_re_cf" maxlength="5" class="checkbox" <?php if($SCORE['pre_st_pre_re_cf']):?>  checked<?php endif?>>
		</td>
		</tr>
		<tr>
		<td class="head">Inlay(4학년 1학기)</td>
		<td class="input">
			Gold Inlay - prep<input type="checkbox" name="pre_st_inlay_gold_prep" class="checkbox"<?php if($SCORE['pre_st_inlay_gold_prep']):?>  checked<?php endif?>>
			Gold Inlay - setting<input type="checkbox" name="pre_st_inlay_gold_setting" class="checkbox"<?php if($SCORE['pre_st_inlay_gold_setting']):?>  checked<?php endif?>>
			Resin Inlay - prep<input type="checkbox" name="pre_st_inlay_resin_prep" class="checkbox"<?php if($SCORE['pre_st_inlay_resin_prep']):?>  checked<?php endif?>>
			Resin Inlay - setting<input type="checkbox" name="pre_st_inlay_resin_setting" class="checkbox"<?php if($SCORE['pre_st_inlay_resin_setting']):?>  checked<?php endif?>>
		</td>
		</tr>
		<tr>
			<td class="title" colspan=2 style="background-color:#32548D; color:white;">FIX</td>
		</tr>
		<!--<tr>
			<td class="head">Charting</td>
			<td class="input">
				<input type="number" name="f_charting" maxlength="5" class="input num" value="<?php echo $SCORE['f_charting']?>">회
			</td>
		</tr>-->
		<tr>
			<td class="title" colspan=2>Operative Observation</td>
		</tr>

		<tr>
		<td class="head">Indirect restoration</td>
		<td class="input">
			Prep & Imp<input type="number" name="f_indirect_prep_imp" maxlength="5" class="input num" value="<?php echo $SCORE['f_indirect_prep_imp']?>">회
			Setting<input type="number" name="f_indirect_setting" maxlength="5" class="input num" value="<?php echo $SCORE['f_indirect_setting']?>">회
		</td>
		</tr>
		<tr>
		<td class="head">Amalgam restoration</td>
		<td class="input"><input type="number" name="f_am" maxlength="5" class="input num" value="<?php echo $SCORE['f_am']?>">회</td>
		</tr>
		<tr>
		<td class="head">Tooth colored restoration (Direct)</td>
		<td class="input">
			Simple<input type="number" name="f_tooth_colored_simple" maxlength="5" class="input num" value="<?php echo $SCORE['f_tooth_colored_simple']?>">회
			Complex<input type="number" name="f_tooth_colored_complex" maxlength="5" class="input num" value="<?php echo $SCORE['f_tooth_colored_complex']?>">회
			Diastema<input type="number" name="f_tooth_colored_diastema" maxlength="5" class="input num" value="<?php echo $SCORE['f_tooth_colored_diastema']?>">회
		</td>
		</tr>
		<tr>
		<td class="head">Post/Core</td>
		<td class="input">
			Post<input type="number" name="f_post" maxlength="5" class="input num" value="<?php echo $SCORE['f_post']?>">회
			Core<input type="number" name="f_core" maxlength="5" class="input num" value="<?php echo $SCORE['f_core']?>">회
		</td>
		</tr>
		<tr>
		<td class="head">Others</td>
		<td class="input"><input type="number" name="f_others" maxlength="5" class="input num" value="<?php echo $SCORE['f_others']?>">회</td>
		</tr>
		<tr>
		<td class="head">Miscellaneous</td>
		<td class="input"><input type="number" name="f_miscellaneous" maxlength="5" class="input num" value="<?php echo $SCORE['f_miscellaneous']?>">회</td>
		</tr>
		<tr>
			<td class="title" colspan=2>Endodoctic observation</td>
		</tr>
		<tr>
		<td class="head">대구치 Endo</td>
		<td class="input">
			PE<input type="number" name="f_endo_molar_pe" maxlength="5" class="input num" value="<?php echo $SCORE['f_endo_molar_pe']?>">회
			CE<input type="number" name="f_endo_molar_ce" maxlength="5" class="input num" value="<?php echo $SCORE['f_endo_molar_ce']?>">회
			CF<input type="number" name="f_endo_molar_cf" maxlength="5" class="input num" value="<?php echo $SCORE['f_endo_molar_cf']?>">회
			♠<input type="number" name="f_endo_molar_etc" maxlength="5" class="input num" value="<?php echo $SCORE['f_endo_molar_etc']?>">회
		</td>
		</tr>
		<tr>
		<td class="head">소구치 Endo</td>
		<td class="input">
			PE<input type="number" name="f_endo_pre_pe" maxlength="5" class="input num" value="<?php echo $SCORE['f_endo_pre_pe']?>">회
			CE<input type="number" name="f_endo_pre_ce" maxlength="5" class="input num" value="<?php echo $SCORE['f_endo_pre_ce']?>">회
			CF<input type="number" name="f_endo_pre_cf" maxlength="5" class="input num" value="<?php echo $SCORE['f_endo_pre_cf']?>">회
			♠<input type="number" name="f_endo_pre_etc" maxlength="5" class="input num" value="<?php echo $SCORE['f_endo_pre_etc']?>">회
		</td>
		</tr>
		<tr>
		<td class="head">전치 Endo</td>
		<td class="input">
			PE<input type="number" name="f_endo_ant_pe" maxlength="5" class="input num" value="<?php echo $SCORE['f_endo_ant_pe']?>">회
			CE<input type="number" name="f_endo_ant_ce" maxlength="5" class="input num" value="<?php echo $SCORE['f_endo_ant_ce']?>">회
			CF<input type="number" name="f_endo_ant_cf" maxlength="5" class="input num" value="<?php echo $SCORE['f_endo_ant_cf']?>">회
			♠<input type="number" name="f_endo_ant_etc" maxlength="5" class="input num" value="<?php echo $SCORE['f_endo_ant_etc']?>">회
		</td>
		</tr>
		</tr>
		<tr>
			<td class="title" colspan=2 style="background-color:green; color:white;">Observation</td>
		</tr>
		<tr>
			<td class="title" colspan=2>Operative Observation</td>
		</tr>

		<tr>
		<td class="head">Indirect restoration</td>
		<td class="input">
			Prep & Imp<input type="number" name="indirect_prep_imp" maxlength="5" class="input num" value="<?php echo $SCORE['indirect_prep_imp']?>">회
			Setting<input type="number" name="indirect_setting" maxlength="5" class="input num" value="<?php echo $SCORE['indirect_setting']?>">회
		</td>
		</tr>
		<tr>
		<td class="head">Amalgam restoration</td>
		<td class="input"><input type="number" name="am" maxlength="5" class="input num" value="<?php echo $SCORE['am']?>">회</td>
		</tr>
		<tr>
		<td class="head">Tooth colored restoration (Direct)</td>
		<td class="input">
			Simple<input type="number" name="tooth_colored_simple" maxlength="5" class="input num" value="<?php echo $SCORE['tooth_colored_simple']?>">회
			Complex<input type="number" name="tooth_colored_complex" maxlength="5" class="input num" value="<?php echo $SCORE['tooth_colored_complex']?>">회
			Diastema<input type="number" name="tooth_colored_diastema" maxlength="5" class="input num" value="<?php echo $SCORE['tooth_colored_diastema']?>">회
		</td>
		</tr>
		<tr>
		<td class="head">Post/Core</td>
		<td class="input">
			Post<input type="number" name="post" maxlength="5" class="input num" value="<?php echo $SCORE['post']?>">회
			Core<input type="number" name="core" maxlength="5" class="input num" value="<?php echo $SCORE['core']?>">회
		</td>
		</tr>
		<tr>
		<td class="head">Others</td>
		<td class="input"><input type="number" name="others" maxlength="5" class="input num" value="<?php echo $SCORE['others']?>">회</td>
		</tr>
		<tr>
		<td class="head">Surgery</td>
		<td class="input"><input type="number" name="surgery" maxlength="5" class="input num" value="<?php echo $SCORE['surgery']?>">회</td>
		</tr>
		<tr>
		<td class="head">Miscellaneous</td>
		<td class="input"><input type="number" name="miscellaneous" maxlength="5" class="input num" value="<?php echo $SCORE['miscellaneous']?>">회</td>
		</tr>
		<tr>
			<td class="title" colspan=2>Endodoctic observation</td>
		</tr>
		<tr>
		<td class="head">대구치 Endo</td>
		<td class="input">
			PE<input type="number" name="endo_molar_pe" maxlength="5" class="input num" value="<?php echo $SCORE['endo_molar_pe']?>">회
			CE<input type="number" name="endo_molar_ce" maxlength="5" class="input num" value="<?php echo $SCORE['endo_molar_ce']?>">회
			CF<input type="number" name="endo_molar_cf" maxlength="5" class="input num" value="<?php echo $SCORE['endo_molar_cf']?>">회
			♠<input type="number" name="endo_molar_etc" maxlength="5" class="input num" value="<?php echo $SCORE['endo_molar_etc']?>">회
		</td>
		</tr>
		<tr>
		<td class="head">소구치 Endo</td>
		<td class="input">
			PE<input type="number" name="endo_pre_pe" maxlength="5" class="input num" value="<?php echo $SCORE['endo_pre_pe']?>">회
			CE<input type="number" name="endo_pre_ce" maxlength="5" class="input num" value="<?php echo $SCORE['endo_pre_ce']?>">회
			CF<input type="number" name="endo_pre_cf" maxlength="5" class="input num" value="<?php echo $SCORE['endo_pre_cf']?>">회
			♠<input type="number" name="endo_pre_etc" maxlength="5" class="input num" value="<?php echo $SCORE['endo_pre_etc']?>">회
		</td>
		</tr>
		<tr>
		<td class="head">전치 Endo</td>
		<td class="input">
			PE<input type="number" name="endo_ant_pe" maxlength="5" class="input num" value="<?php echo $SCORE['endo_ant_pe']?>">회
			CE<input type="number" name="endo_ant_ce" maxlength="5" class="input num" value="<?php echo $SCORE['endo_ant_ce']?>">회
			CF<input type="number" name="endo_ant_cf" maxlength="5" class="input num" value="<?php echo $SCORE['endo_ant_cf']?>">회
			♠<input type="number" name="endo_ant_etc" maxlength="5" class="input num" value="<?php echo $SCORE['endo_ant_etc']?>">회
		</td>
		</tr>
	

<!--		<tr>
			<td class="title" colspan=2>Follow</td>
		</tr>
		<tr>
			<td class="head">보존-치주 연계 팔로우(완성 기준)</td>
			<td class="input"><input type="number" name="fol_cp" maxlength="4" class="input num" value="<?php echo $SCORE['fol_cp']?>">개</td>
		</tr>
		<tr>
			<td class="head">Endo-Indirect 연계 갯수</td>
			<td class="input"><input type="number" name="fol_ei" maxlength="4" class="input num" value="<?php echo $SCORE['fol_ei']?>">개</td>
		</tr>-->


		<tr>
			<td class="title" colspan=2 style="background-color:#eeffff;">ST Case</td>
		</tr>
		<tr>
		<td class="head">OP 체어 배정 횟수</td>
		<td class="input"><input type="number" name="st_op_chair_assigned" maxlength="5" class="input num" value="<?php echo $SCORE['st_op_chair_assigned']?>">회</td>
		</tr>
		<tr>
		<td class="head">Tooth colored - Cervical</td>
		<td class="input"><input type="number" name="st_op_tooth_colored_cervical" maxlength="5" class="input num" value="<?php echo $SCORE['st_op_tooth_colored_cervical']?>">회</td>
		</tr>
		<tr>
		<td class="head">Tooth colored - Simple</td>
		<td class="input"><input type="number" name="st_op_tooth_colored_simple" maxlength="5" class="input num" value="<?php echo $SCORE['st_op_tooth_colored_simple']?>">회</td>
		</tr>
		<tr>
		<td class="head">Tooth colored - Complex</td>
		<td class="input"><input type="number" name="st_op_tooth_colored_complex" maxlength="5" class="input num" value="<?php echo $SCORE['st_op_tooth_colored_complex']?>">회</td>
		</tr>
		<tr>
		<td class="head">Tooth colored - Diastema</td>
		<td class="input"><input type="number" name="st_op_tooth_colored_diastema" maxlength="5" class="input num" value="<?php echo $SCORE['st_op_tooth_colored_diastema']?>">회</td>
		</tr>

		<tr>
		<td class="head">Amalgam - Simple</td>
		<td class="input"><input type="number" name="st_op_am_simple" maxlength="5" class="input num" value="<?php echo $SCORE['st_op_am_simple']?>">회</td>
		</tr>
		<tr>
		<td class="head">Amalgam - Complex</td>
		<td class="input"><input type="number" name="st_op_am_complex" maxlength="5" class="input num" value="<?php echo $SCORE['st_op_am_complex']?>">회</td>
		</tr>

		<tr>
		<td class="head">Inlay - 1st case</td>
		<td class="input">
			<select name="st_inlay_1_case">
				<option value=""<?php if($SCORE['st_inlay_1_case'] == ''):?> selected<?php endif?>>------------</option>
			<?php foreach($d['khusd_st_consv']['st_inlay_case'] as $key => $text):?>
				<option value="<?php echo $key?>"<?php if($SCORE['st_inlay_1_case'] == $key):?> selected<?php endif?>><?php echo $text?></option>
			<?php endforeach?>
			</select>

			<select name="st_inlay_1_proc">
				<option value=""<?php if($SCORE['st_inlay_1_proc'] == ''):?> selected<?php endif?>>------------</option>
			<?php foreach($d['khusd_st_consv']['st_inlay_stage'] as $key => $text):?>
				<option value="<?php echo $key?>"<?php if($SCORE['st_inlay_1_proc'] == $key):?> selected<?php endif?>><?php echo $text?></option>
			<?php endforeach?>
			</select>
		</td>
		</tr>
		<tr>
		<td class="head">Inlay - 2nd case</td>
		<td class="input">
			<select name="st_inlay_2_case">
				<option value=""<?php if($SCORE['st_inlay_2_case'] == ''):?> selected<?php endif?>>------------</option>
			<?php foreach($d['khusd_st_consv']['st_inlay_case'] as $key => $text):?>
				<option value="<?php echo $key?>"<?php if($SCORE['st_inlay_2_case'] == $key):?> selected<?php endif?>><?php echo $text?></option>
			<?php endforeach?>
			</select>

			<select name="st_inlay_2_proc">
				<option value=""<?php if($SCORE['st_inlay_2_proc'] == ''):?> selected<?php endif?>>------------</option>
			<?php foreach($d['khusd_st_consv']['st_inlay_stage'] as $key => $text):?>
				<option value="<?php echo $key?>"<?php if($SCORE['st_inlay_2_proc'] == $key):?> selected<?php endif?>><?php echo $text?></option>
			<?php endforeach?>
			</select>
		</td>
		</tr>
		
		<tr>
		<td class="head">Bleaching</td>
		<td class="input"><input type="number" name="st_op_bleaching" maxlength="5" class="input num" value="<?php echo $SCORE['st_op_bleaching']?>">회</td>
		</tr>
		<tr>
		<td class="head">Others</td>
		<td class="input"><input type="number" name="st_op_others" maxlength="5" class="input num" value="<?php echo $SCORE['st_op_others']?>">회</td>
		</tr>
		<tr>
		<td class="head">Endo - 1st case</td>
		<td class="input">
			<select name="st_endo_1">
				<option value=""<?php if($SCORE['st_endo_1'] == ''):?> selected<?php endif?>>------------</option>
			<?php foreach($d['khusd_st_consv']['st_stage'] as $key => $text):?>
				<option value="<?php echo $key?>"<?php if($SCORE['st_endo_1'] == $key):?> selected<?php endif?>><?php echo $text?></option>
			<?php endforeach?>
			</select>
			<input type="number" name="st_endo_1st_point" maxlength="5" class="input num" value="<?php echo $SCORE['st_endo_1st_point']?>">점수
		</td>
		</tr>
		<tr>
		<td class="head">Endo - 2nd case</td>
		<td class="input">
			<select name="st_endo_2">
				<option value=""<?php if($SCORE['st_endo_2'] == ''):?> selected<?php endif?>>------------</option>
			<?php foreach($d['khusd_st_consv']['st_stage'] as $key => $text):?>
				<option value="<?php echo $key?>"<?php if($SCORE['st_endo_2'] == $key):?> selected<?php endif?>><?php echo $text?></option>
			<?php endforeach?>
			</select>
			<input type="number" name="st_endo_2nd_point" maxlength="5" class="input num" value="<?php echo $SCORE['st_endo_2nd_point']?>">점수
		</td>
		</tr>

	</tbody>
	</table>

	<div class="bottombox">
		<input type="button" value="취소" class="btngray" onclick="cancelCheck();" />
		<input type="submit" value="확인" class="btnblue" />
	</div>

</div>
