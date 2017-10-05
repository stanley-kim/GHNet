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
		<col width=80>
		<col width=80>
		<col width=80>
		<col width=80>
		<col width=80>
		<col width=80>
		<col width=80>
		<col width=80>
	</colgroup>
	<thead>
		<tr>
		<th scope="col"></th>
		<th scope="col"></th>
		<th scope="col"></th>
		<th scope="col"></th>
		<th scope="col"></th>
		<th scope="col"></th>
		<th scope="col"></th>
		<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
		<td class="head" colspan="3">단순 Obser 횟수</td>
		<td colspan="2"><input type="number" name="obser" maxlength="5" class="input" value="<?php echo $SCORE['obser_cnt']?>"> 회</td>
		</tr>
		<tr>
		<td class="head" colspan="5">기공 횟수</td>
		</tr>
		<?php for($i=0; $i<$d['khusd_st_ortho']['APPLIANCE_SIZE']; $i++):?>
		<tr>
		<td colspan="3"><?php echo $d['khusd_st_ortho']['APPLIANCE'][$i];?></td>
		<td colspan="2">
			<input type="number" name="appliance[]" maxlength="5" class="input" value="<?php echo $APPLIANCE[$i]?>"> 회&nbsp;&nbsp;
		</td>
		</tr>
		<?php endfor?>
		<tr>
		<td colspan="5"><b style="text-decoration: underline;color:blue;">Total</b>&nbsp;&nbsp;
			A: <input type="number" name="fabri_a" maxlength="5" class="input" value="<?php echo $SCORE['fabri_a']?>"> 회 |&nbsp;
			B: <input type="number" name="fabri_b" maxlength="5" class="input" value="<?php echo $SCORE['fabri_b']?>"> 회 |&nbsp;
			C: <input type="number" name="fabri_c" maxlength="5" class="input" value="<?php echo $SCORE['fabri_c']?>"> 회 &nbsp;
		</td>
		</tr>
                <tr> <td><br><br></td> </tr>
		<tr>
		<td class="head" colspan="8">Follow 환자</td>
		</tr>
                <tr>
                <td colspan="8">본딩필수: 본딩이 필수인 치료는 check, 본딩이 필수가 아닌 치료(ex 성장조절치료)인 경우 uncheck 해주시면 됩니다.(신환만 해당)</td>
                </tr>
                <tr>
                <td colspan="8">F/U 횟수: <b style="text-decoration: underline;color:blue;">신환 F/U 분석 상담</b>은 F/U 횟수에 포함되지 않습니다.</td>
                </tr>
		<tr class="sub_head">
			<td width="8%">신/구</td>
			<td width="12%">병록번호</td>
			<td width="10%">이름</td>
			<td width="8%">Report</td>
                        <td width="10%">분석참석</td>
                        <td width="10%">본딩필수</td>
                        <td width="10%">본딩참석</td>
                        <td width="10%">F/U횟수</td>

		</tr>
		<?php
			$follow_cnt = 0;
			$follow_new_cnt = 0;
			$follow_list = array();
		?>
		<?php while($_ROW = db_fetch_array($MY_FOLLOW_ROWS)):?>
			<tr>
				<input type="hidden" name="follow_list[]" value="<?php echo $_ROW['uid']?>" />
				<?php if($_ROW['type']==0):?>
				<td>구</td>
				<?php else:?>
				<?php $follow_new_cnt++;?>
				<td>신</td>
				<?php endif?>
				<td><?php echo $_ROW['pt_id']?></td>
				<td><?php echo $_ROW['pt_name']?></td>

                                <td><input type="checkbox" name="report[]" value="<?php echo $follow_cnt?>"  <?php echo $_ROW['report']==0?'':checked?>></td>
                                <td><input type="checkbox" name="bool_analysis[]" value="<?php echo $follow_cnt?>" <?php if($_ROW['type']==0) echo disabled?>   <?php echo $_ROW['bool_analysis']==0?'':checked?>></td>
                                <td><input type="checkbox" name="bool_mandatorybonding[]" value="<?php echo $follow_cnt?>"  <?php if($_ROW['type']==0) echo disabled?>   <?php echo $_ROW['bool_mandatorybonding']==0?'':checked?>></td>
                                <td><input type="checkbox" name="bool_bonding[]" value="<?php echo $follow_cnt?>"  <?php if($_ROW['type']==0) echo disabled?>   <?php echo $_ROW['bool_bonding']==0?'':checked?>></td>

				<td><input type="number" name="fobser[]" maxlength="2" class="input" value="<?php echo $_ROW['step']?>"> 회</td>
			</tr>
			<?php $follow_cnt++;?>
		<?php endwhile ?>
		
		<input type="hidden" name="follow_cnt" value="<?php echo $follow_cnt?>" />
		<input type="hidden" name="follow_new_cnt" value="<?php echo $follow_new_cnt?>" />
	</tbody>
	</table>

	<div class="bottombox">
		<input type="button" value="취소" class="btngray" onclick="cancelCheck();" />
		<input type="submit" value="확인" class="btnblue" />
	</div>
	</form>
</div>
