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
		<col>
	</colgroup>
	<thead>
		<tr>
		<th scope="col"></th>
		<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
<!--		<tr>
		<td class="head">Charting observation</td>
		<td class="input"><input type="number" name="charting_obser" maxlength="5" class="input num" value="<?php echo $SCORE['charting_obser']?>">회</td>
		</tr>-->
		<tr>
		<td class="head">TMD 차팅</td>
		<td class="input"><input type="number" name="charting" maxlength="5" class="input num" value="<?php echo $SCORE['charting']?>">명</td>
		</tr>
		<tr>
		<td class="head">연조직 차팅</td>
		<td class="input"><input type="number" name="soft_charting" maxlength="5" class="input num" value="<?php echo $SCORE['soft_charting']?>">명</td>
		</tr>
		<tr>
		<td class="head">단순 observation</td>
		<td class="input"><input type="number" name="obser" maxlength="5" class="input num" value="<?php echo $SCORE['obser']?>">회</td>
		</tr>
<!--		<tr>
		<td class="head">장치 observation</td>
		<td class="input"><input type="number" name="splint_obser" maxlength="5" class="input num" value="<?php echo $SCORE['splint_obser']?>">회</td>
		</tr>-->
		<tr>
		<td class="head">물리치료 고정 옵저</td>
		<td class="input"><input type="number" name="physical_tx_fix" maxlength="5" class="input num" value="<?php echo $SCORE['physical_tx_fix']?>">회</td>
		</tr>
		<tr>
		<td class="head">물리치료</td>
		<td class="input">
			Infrared Lamp: <input type="number" name="infra_tx" maxlength="5" class="input num" value="<?php echo $SCORE['infra_tx']?>">회
			<br />Ultrasound: <input type="number" name="ultra_tx" maxlength="5" class="input num" value="<?php echo $SCORE['ultra_tx']?>">회
			<br />EAST: <input type="number" name="east_tx" maxlength="5" class="input num" value="<?php echo $SCORE['east_tx']?>">회
			<br />TENS: <input type="number" name="tens_tx" maxlength="5" class="input num" value="<?php echo $SCORE['tens_tx']?>">회
			<br />Iontophoresis<input type="number" name="ionto_tx" maxlength="5" class="input num" value="<?php echo $SCORE['ionto_tx']?>">회
			<br />TMD Soft Laser<input type="number" name="tmd_tx" maxlength="5" class="input num" value="<?php echo $SCORE['tmd_tx']?>">회
			<br />연조직 Soft Laser <input type="number" name="soft_tx" maxlength="5" class="input num" value="<?php echo $SCORE['soft_tx']?>">회
		</td>
		</tr>
		<tr>
		<td class="head">구취측정</td>
		<td class="input"><input type="number" name="odor" maxlength="5" class="input num" value="<?php echo $SCORE['odor']?>">회</td>
		</tr>
		<tr>
		<td class="head">의료문서</td>
		<td class="input"><input type="number" name="m_text" maxlength="5" class="input num" value="<?php echo $SCORE['m_text']?>">회</td>
		</tr>
		<tr>
		<td class="head">교수님 Fix 오전</td>
		<td class="input"><input type="number" name="fix_am" maxlength="5" class="input num" value="<?php echo $SCORE['fix_am']?>">회</td>
		</tr>
		<tr>
		<td class="head">교수님 Fix 오후</td>
		<td class="input"><input type="number" name="fix_pm" maxlength="5" class="input num" value="<?php echo $SCORE['fix_pm']?>">회</td>
		</tr>
		<tr>
		<td class="head">1 cycle 포트폴리오</td>
		<td class="input"><input type="number" name="portfolio1" maxlength="5" class="input num" value="<?php echo $SCORE['portfolio1']?>">회</td>
		</tr>
		<tr>
		<td class="head">2cycle 포트폴리오</td>
		<td class="input"><input type="number" name="portfolio2" maxlength="5" class="input num" value="<?php echo $SCORE['portfolio2']?>">회</td>
		</tr>
		<tr>
		<td class="head">3 cycle 포트폴리오</td>
		<td class="input"><input type="number" name="portfolio3" maxlength="5" class="input num" value="<?php echo $SCORE['portfolio3']?>">회</td>
		</tr>
		<tr>
		<td class="head">4 cycle 포트폴리오</td>
		<td class="input"><input type="number" name="portfolio4" maxlength="5" class="input num" value="<?php echo $SCORE['portfolio4']?>">회</td>
		</tr>
		<tr>
		<td class="head">장치 인기</td>
		<td class="input"><input type="number" name="splint_impression" maxlength="5" class="input num" value="<?php echo $SCORE['splint_impression']?>">회</td>
		</tr>
		<tr>
		<td class="head">장치 마무리</td>
		<td class="input"><input type="number" name="splint_polishing" maxlength="5" class="input num" value="<?php echo $SCORE['splint_polishing']?>">회</td>
		</tr>
		<tr>
		<td class="head">장치 조정</td>
		<td class="input"><input type="number" name="splint_adjust" maxlength="5" class="input num" value="<?php echo $SCORE['splint_adjust']?>">회</td>
		</tr>
	</tbody>
	</table>

	<div class="bottombox">
		<input type="button" value="취소" class="btngray" onclick="cancelCheck();" />
		<input type="submit" value="확인" class="btnblue" />
	</div>

</div>