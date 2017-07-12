<div id="radio_update" class="khusd_st update radio">

<h2>영상과 정보 수정</h2>

	<form name="updateScore" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="update" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	
	<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
	<?php if($n_page):?>
		<input type="hidden" name="n_page" value="<?php echo $n_page?>" />
	<?php endif?>

	<table summary="영상과 점수표 입니다.">
	<caption>영상과 점수표</caption>
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
		<td class="head">Penalty Taking</td>
		<td class="input"><input type="number" name="penalty_taking" maxlength="5" class="input num" value="<?php echo $SCORE['penalty_taking']?>">장 (지난학기 남은 리콰에 대한 taking 장수를 입력)</td>
		</tr>-->
		<tr>
		<td class="head">Taking</td>
		<td class="input"><input type="number" name="taking" maxlength="5" class="input num" value="<?php echo $SCORE['taking']?>">장 (환자수: <input type="number" name="taking_pt" maxlength="5" class="input num" value="<?php echo $SCORE['taking_pt']?>">명, 이번학기 require 환자수만 입력)</td>
		</tr>
		<tr>
		<td class="head">판독옵져</td>
		<td class="input"><input type="number" name="obser_decoding" maxlength="5" class="input num" value="<?php echo $SCORE['obser_decoding']?>">회</td>
		</tr>
		<tr>
		<td class="head">촬영옵져</td>
		<td class="input"><input type="number" name="obser_filming" maxlength="5" class="input num" value="<?php echo $SCORE['obser_filming']?>">회</td>
		</tr>
		<tr>
		<td class="head">파노라마</td>
		<td class="input"><input type="number" name="panorama" maxlength="5" class="input num" value="<?php echo $SCORE['panorama']?>">회</td>
		</tr>
	</tbody>
	</table>

	<div class="bottombox">
		<input type="button" value="취소" class="btngray" onclick="cancelCheck();" />
		<input type="submit" value="확인" class="btnblue" />
	</div>

</div>
