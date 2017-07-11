<div id="oms_update" class="khusd_st update oms">

<h2>구강외과 정보 수정</h2>

	<form name="updateScore" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="update" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	
	<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
	<?php if($n_page):?>
		<input type="hidden" name="n_page" value="<?php echo $n_page?>" />
	<?php endif?>

	<table summary="구강외과 점수표 입니다.">
	<caption>구강외과 점수표</caption>
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
			<td class="title" colspan=2>Observation</td>
		</tr>
		<tr>
		<td class="head">Charting</td>
		<td><input type="number" name="charting" maxlength="5" class="input" value="<?php echo $SCORE['charting']?>">회</td>
		</tr>
		<tr>
		<td class="head">Dressing</td>
		<td><input type="number" name="dressing" maxlength="5" class="input" value="<?php echo $SCORE['dressing']?>">회</td>
		</tr>
		<tr>
		<td class="head">Case Presentation</td>
		<td><input type="number" name="cp" maxlength="5" class="input" value="<?php echo $SCORE['cp']?>">회</td>
		</tr>
		<tr>
		<td class="head">Simple Extration</td>
		<td><input type="number" name="simple_ext" maxlength="5" class="input" value="<?php echo $SCORE['simple_ext']?>">회</td>
		</tr>
		<tr>
		<td class="head">Surgical Extration</td>
		<td><input type="number" name="surgical_ext" maxlength="5" class="input" value="<?php echo $SCORE['surgical_ext']?>">회</td>
		</tr>
		<tr>
		<td class="head">Minor Surgery</td>
		<td><input type="number" name="minor" maxlength="5" class="input" value="<?php echo $SCORE['minor']?>">회</td>
		</tr>
		<tr>
		<td class="head">Major Surgery</td>
		<td><input type="number" name="major" maxlength="5" class="input" value="<?php echo $SCORE['major']?>">회</td>
		</tr>
		<tr>
		<td class="head">Implant 1st</td>
		<td><input type="number" name="imp_1st" maxlength="5" class="input" value="<?php echo $SCORE['imp_1st']?>">회</td>
		</tr>
		<tr>
		<td class="head">Implant 2nd</td>
		<td><input type="number" name="imp_2nd" maxlength="5" class="input" value="<?php echo $SCORE['imp_2nd']?>">회</td>
		</tr>
		<tr>
			<td class="title" colspan=2>ST Case</td>
		</tr>
		<tr>
		<td class="head">ST Case</td>
		<td><input type="number" name="st_case" maxlength="5" class="input" value="<?php echo $SCORE['st_case']?>">회</td>
		</tr>
		<tr>
		<td class="head">ST Assist</td>
		<td><input type="number" name="st_assist" maxlength="5" class="input" value="<?php echo $SCORE['st_assist']?>">회</td>
		</tr>
	</tbody>
	</table>

	<div class="bottombox">
		<input type="button" value="취소" class="btngray" onclick="cancelCheck();" />
		<input type="submit" value="확인" class="btnblue" />
	</div>

</div>