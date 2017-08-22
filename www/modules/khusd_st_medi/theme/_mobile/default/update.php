<div id="medi_update" class="khusd_st update medi">

<h2>구강내과 정보 수정</h2>

	<form name="updateScore" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="update" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	
	<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
	<?php if($n_page):?>
		<input type="hidden" name="n_page" value="<?php echo $n_page?>" />
	<?php endif?>

	<table summary="구강내과 점수표 입니다.">
	<caption>구강내과 점수표</caption>
	<colgroup>
		<col width=150>
                <col width=70>
                <col width=70>
                <col width=70>
                <col width=70>
	</colgroup>
	<thead>
		<tr>
		<th scope="col"></th>
		<th scope="col"></th>
		<th scope="col"></th>
		<th scope="col"></th>
		<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
		<td class="head">Pre 차팅</td>
		<td colspan="4" class="input"><input type="number" name="charting_obser" maxlength="5" class="input num" value="<?php echo $SCORE['charting_obser']?>">회</td>
		</tr>
                <tr>
                <td class="head"> </td>
                <td class="input">차팅</td>
                <td class="input">check</td>
                <td class="input">follow 1st</td>
                <td class="input">follow 2nd</td>
                </tr>

		<tr>
		<td class="head">TMD 차팅 1Cycle</td>
                <td class="input"><input type="number" name="charting_tmd_1cycle_charting" maxlength="5" class="input num" value="<?php echo $SCORE['charting_tmd_1cycle_charting']?>">명</td>
                <td class="input"><input type="number" name="charting_tmd_1cycle_check" maxlength="5" class="input num" value="<?php echo $SCORE['charting_tmd_1cycle_check']?>">명</td>
                <td class="input"><input type="number" name="charting_tmd_1cycle_follow1st" maxlength="5" class="input num" value="<?php echo $SCORE['charting_tmd_1cycle_follow1st']?>">명</td>
                <td class="input"><input type="number" name="charting_tmd_1cycle_follow2nd" maxlength="5" class="input num" value="<?php echo $SCORE['charting_tmd_1cycle_follow2nd']?>">명</td>
		</tr>
                <tr>
                <td class="head">TMD 차팅 2Cycle</td>
                <td class="input"><input type="number" name="charting_tmd_2cycle_charting" maxlength="5" class="input num" value="<?php echo $SCORE['charting_tmd_2cycle_charting']?>">명</td>
                <td class="input"><input type="number" name="charting_tmd_2cycle_check" maxlength="5" class="input num" value="<?php echo $SCORE['charting_tmd_2cycle_check']?>">명</td>
                <td class="input"><input type="number" name="charting_tmd_2cycle_follow1st" maxlength="5" class="input num" value="<?php echo $SCORE['charting_tmd_2cycle_follow1st']?>">명</td>
                <td class="input"><input type="number" name="charting_tmd_2cycle_follow2nd" maxlength="5" class="input num" value="<?php echo $SCORE['charting_tmd_2cycle_follow2nd']?>">명</td>
                </tr>
                <tr>
                <td class="head">TMD 차팅 3Cycle</td>
                <td class="input"><input type="number" name="charting_tmd_3cycle_charting" maxlength="5" class="input num" value="<?php echo $SCORE['charting_tmd_3cycle_charting']?>">명</td>
                <td class="input"><input type="number" name="charting_tmd_3cycle_check" maxlength="5" class="input num" value="<?php echo $SCORE['charting_tmd_3cycle_check']?>">명</td>
                <td class="input"><input type="number" name="charting_tmd_3cycle_follow1st" maxlength="5" class="input num" value="<?php echo $SCORE['charting_tmd_3cycle_follow1st']?>">명</td>
                <td class="input"><input type="number" name="charting_tmd_3cycle_follow2nd" maxlength="5" class="input num" value="<?php echo $SCORE['charting_tmd_3cycle_follow2nd']?>">명</td>
                </tr>
                <tr>
                <td class="head">연조직 차팅</td>
                <td class="input"><input type="number" name="charting_soft_charting" maxlength="5" class="input num" value="<?php echo $SCORE['charting_soft_charting']?>">명</td>
                <td class="input"><input type="number" name="charting_soft_check" maxlength="5" class="input num" value="<?php echo $SCORE['charting_soft_check']?>">명</td>
                <td class="input"><input type="number" name="charting_soft_follow1st" maxlength="5" class="input num" value="<?php echo $SCORE['charting_soft_follow1st']?>">명</td>
                <td class="input"><input type="number" name="charting_soft_follow2nd" maxlength="5" class="input num" value="<?php echo $SCORE['charting_soft_follow2nd']?>">명</td>
                </tr>

		<tr>
		<td class="head">단순 observation</td>
		<td colspan="4" class="input"><input type="number" name="obser" maxlength="5" class="input num" value="<?php echo $SCORE['obser']?>">회</td>
		</tr>
<!--		<tr>
		<td class="head">장치 observation</td>
		<td class="input"><input type="number" name="splint_obser" maxlength="5" class="input num" value="<?php echo $SCORE['splint_obser']?>">회</td>
		</tr>-->
		<tr>
		<td class="head">구취측정</td>
		<td colspan="4" class="input"><input type="number" name="odor" maxlength="5" class="input num" value="<?php echo $SCORE['odor']?>">회</td>
		</tr>
		<tr>
		<td class="head">타액분비율측정</td>
		<td colspan="4" class="input"><input type="number" name="saliva_test" maxlength="5" class="input num" value="<?php echo $SCORE['saliva_test']?>">회</td>
		</tr>
		<tr>
		<td class="head">물리치료</td>
		<td colspan="4" class="input"><input type="number" name="physical_tx" maxlength="5" class="input num" value="<?php echo $SCORE['physical_tx']?>">회</td>
		</tr>
		<tr>
		<td class="head">추가물리치료</td>
		<td colspan="4" class="input"><input type="number" name="soft_tx" maxlength="5" class="input num" value="<?php echo $SCORE['soft_tx']?>">회</td>
		</tr>

                <tr>
                <td class="head">장치제작</td>
                <td colspan="2" class="input">내주<input type="number" name="splint_impression" maxlength="5" class="input num" value="<?php echo $SCORE['splint_impression']?>">회</td>
                <td colspan="2" class="input">외주<input type="number" name="splint_polishing" maxlength="5" class="input num" value="<?php echo $SCORE['splint_polishing']?>">회</td>
                </tr>
		<tr>
		<td class="head">의료문서</td>
		<td colspan="4" class="input"><input type="number" name="m_text" maxlength="5" class="input num" value="<?php echo $SCORE['m_text']?>">회</td>
		</tr>

                <tr>
                <td class="head">교수님 Fix</td>
                <td colspan="2" class="input">오전<input type="number" name="fix_am" maxlength="5" class="input num" value="<?php echo $SCORE['fix_am']?>">회</td>
                <td colspan="2" class="input">오후<input type="number" name="fix_pm" maxlength="5" class="input num" value="<?php echo $SCORE['fix_pm']?>">회</td>
                </tr>

	</tbody>
	</table>

	<div class="bottombox">
		<input type="button" value="취소" class="btngray" onclick="cancelCheck();" />
		<input type="submit" value="확인" class="btnblue" />
	</div>

</div>
