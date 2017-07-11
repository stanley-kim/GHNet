<div id="ortho_update" class="khusd_st update ortho">

<h2>교정과 정보 수정</h2>

	<form name="updateScore" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="update" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	
	<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
	<?php if($n_page):?>
		<input type="hidden" name="n_page" value="<?php echo $n_page?>" />
	<?php endif?>

	<table summary="교정과 점수표 입니다.">
	<caption>교정과 점수표</caption>
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
			<td class="title" colspan=4>Observation</td>
		</tr>
		<tr>
		<td class="head">구환 Obser 횟수</td>
		<td><input type="number" name="obser" maxlength="5" class="input" value="<?php echo $SCORE['obser']?>">회</td>
		</tr>
		<tr>
		<td class="head">구환 환자</td>
		<td><input type="number" name="obser_pt" maxlength="5" class="input" value="<?php echo $SCORE['obser_pt']?>">명</td>
		</tr>

		<tr>
			<td class="title" colspan=4>신환 Observation</td>
		</tr>
		
		<tr>
		<td class="head">신환 Obser 횟수</td>
		<td><input type="number" name="follow" maxlength="5" class="input" value="<?php echo $SCORE['follow']?>">회</td>
		</tr>
		<tr>
		<td class="head">신환 환자</td>
		<td><input type="number" name="follow_pt" maxlength="5" class="input" value="<?php echo $SCORE['follow_pt']?>">명</td>
		</tr>
		<tr>
		<td class="head">레포트 검사</td>
		<td><input type="number" name="follow_report" maxlength="5" class="input" value="<?php echo $SCORE['follow_report']?>">회</td>
		</tr>

	</tbody>
	</table>

	<div class="bottombox">
		<input type="button" value="취소" class="btngray" onclick="cancelCheck();" />
		<input type="submit" value="확인" class="btnblue" />
	</div>

</div>