<div id="radio_update" class="khusd_st update radio">

<h2>방사선과 정보 수정</h2>

	<form name="updateScore" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="update" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	
	<input type="hidden" name="s_uid" value="<?php echo $s_uid?>" />
	<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />

	<table summary="방사선과 점수표 입니다.">
	<caption>방사선과 점수표</caption>
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
		<td class="head">Taking</td>
		<td class="input"><input type="text" name="taking" maxlength="5" class="input num" value="<?php echo $SCORE['taking']?>">장 (환자수: <input type="text" name="taking_pt" maxlength="5" class="input num" value="<?php echo $SCORE['taking_pt']?>">명)</td>
		</tr>
		<tr>
		<td class="head">Follow</td>
		<td class="input"><input type="text" name="follow" maxlength="5" class="input num" value="<?php echo $SCORE['follow']?>">회</td>
		</tr>
		<tr>
		<td class="head">파노라마</td>
		<td class="input"><input type="text" name="panorama" maxlength="5" class="input num" value="<?php echo $SCORE['panorama']?>">회</td>
		</tr>
	</tbody>
	</table>

	<div class="bottombox">
		<input type="button" value="취소" class="btngray" onclick="cancelCheck();" />
		<input type="submit" value="확인" class="btnblue" />
	</div>

</div>