<div id="pedia_update" class="khusd_st update pedia">

<h2>소아치과 정보 수정</h2>

	<form name="updateScore" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="update" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	
	<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
	<?php if($n_page):?>
		<input type="hidden" name="n_page" value="<?php echo $n_page?>" />
	<?php endif?>

	<table summary="소아치과 점수표 입니다.">
	<caption>소아치과 점수표</caption>
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
		<td class="head">FIX</td>
		<td class="input"><input type="number" name="fix" maxlength="5" class="input num" value="<?php echo $SCORE['fix']?>">회</td>
		</tr>
		
<tr>
		<td class="head" rowspan="2">Follow 점수</td>
                <td class="input">
                        교픽&nbsp  오전 <input type="number" name="prof_fix_am" maxlength="5" class="input" value="<?php echo $SCORE['prof_fix_am']?>"> 회 &nbsp&nbsp;
                        교픽&nbsp  오후 <input type="number" name="prof_fix_pm" maxlength="5" class="input" value="<?php echo $SCORE['prof_fix_pm']?>"> 회

                </tr>
                <tr>
		<style>
		.pedia_folow_number input[type="number"]::-webkit-outer-spin-button,
.pedia_folow_number input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.pedia_folow_number input[type="number"] {
    -moz-appearance: textfield;
	width:20px;
}
.pedia_folow_number b{
    margin-left:10px;
}
		</style>
		<td class="input pedia_folow_number">
			<b>Ch</b> <input type="number" name="follow_ch" maxlength="2" class="input num" value="<?php echo $SCORE['follow_ch']?>"> 
			<br /><b>1칸</b> <input type="number" name="follow_1" maxlength="2" class="input num" value="<?php echo $SCORE['follow_1']?>">  
			<b>2칸</b> <input type="number" name="follow_2" maxlength="2" class="input num" value="<?php echo $SCORE['follow_2']?>">  
			<br /><b>3칸</b> <input type="number" name="follow_3" maxlength="2" class="input num" value="<?php echo $SCORE['follow_3']?>">  
			<b>4칸</b> <input type="number" name="follow_4" maxlength="2" class="input num" value="<?php echo $SCORE['follow_4']?>"> 
			<br /><b>5칸</b> <input type="number" name="follow_5" maxlength="2" class="input num" value="<?php echo $SCORE['follow_5']?>">  
			<b>6칸</b> <input type="number" name="follow_6" maxlength="2" class="input num" value="<?php echo $SCORE['follow_6']?>">  
			<br /><b>7칸</b> <input type="number" name="follow_7" maxlength="2" class="input num" value="<?php echo $SCORE['follow_7']?>">  
			<b>8칸</b> <input type="number" name="follow_8" maxlength="2" class="input num" value="<?php echo $SCORE['follow_8']?>">  
			<br /><b>9칸</b> <input type="number" name="follow_9" maxlength="2" class="input num" value="<?php echo $SCORE['follow_9']?>">  
			<b>10칸</b> <input type="number" name="follow_10" maxlength="2" class="input num" value="<?php echo $SCORE['follow_10']?>">  
			
		</td>
		</tr>
		<!--<tr>
		<td class="head">Follow 점수</td>
		<td class="input"><input type="number" name="follow" maxlength="5" class="input num" value="<?php echo $SCORE['follow']?>">점 (챠팅점수 포함해서 계산)</td>
		</tr>-->
		<!--<tr>
		<td class="head">Charting 수</td>
		<td class="input"><input type="number" name="charting" maxlength="5" class="input num" value="<?php echo $SCORE['charting']?>">회</td>
		</tr>-->
		<tr>
		<td class="head">Charting Observation</td>
		<td class="input"><input type="number" name="charting_obser" maxlength="5" class="input num" value="<?php echo $SCORE['charting_obser']?>">회</td>
		</tr>
		<tr>
		<td class="head">Observation</td>
		<td class="input"><input type="number" name="obser" maxlength="5" class="input num" value="<?php echo $SCORE['obser']?>">회</td>
		</tr>
		<tr>
		<td class="head">G/A</td>
		<td class="input"><input type="number" name="ga" maxlength="5" class="input num" value="<?php echo $SCORE['ga']?>">회</td>
		</tr>
		<tr>
		<td class="head">Sedation Report</td>
		<td class="input"><input type="number" name="sedation_rp" maxlength="5" class="input num" value="<?php echo $SCORE['sedation_rp']?>">회</td>
		</tr>
		<tr>
		<td class="head">Clinical Report</td>
		<td class="input"><input type="number" name="clinical_rp" maxlength="5" class="input num" value="<?php echo $SCORE['clinical_rp']?>">회</td>
		</tr>

		<tr>
			<td class="title" colspan=2>ST Case</td>
		</tr>
		
		<tr>
		<td class="head">ST 환자수</td>
		<td class="input"><input type="number" name="st_pt" maxlength="5" class="input num" value="<?php echo $SCORE['st_pt']?>">명</td>
		</tr>
		<td class="head">ST 술식 점수</td>
		<td class="input"><input type="number" name="st_point" maxlength="5" class="input num" value="<?php echo $SCORE['st_point']?>">점</td>
		</tr>
		<td class="head">ST 추가 점수</td>
		<td class="input">
			A: <input type="number" name="st_add_a" maxlength="5" class="input" value="<?php echo $SCORE['st_add_a']?>"> 회 |&nbsp;
			B: <input type="number" name="st_add_b" maxlength="5" class="input" value="<?php echo $SCORE['st_add_b']?>"> 회 |&nbsp;
			C: <input type="number" name="st_add_c" maxlength="5" class="input" value="<?php echo $SCORE['st_add_c']?>"> 회 &nbsp;
		</tr>
		<tr>
		<td class="head">ST Assist</td>
		<td class="input"><input type="number" name="st_assist" maxlength="5" class="input num" value="<?php echo $SCORE['st_assist']?>">회</td>
		</tr>
		<tr>
		<td class="head">목표점수 입력</td>
		<td class="input"><input type="checkbox" name="is_goal" class="input num" value="y">예상점수 확인하고 싶을 때 체크해보세요~</td>
		</tr>
	</tbody>
	</table>

	<div class="bottombox">
		<input type="button" value="취소" class="btngray" onclick="cancelCheck();" />
		<input type="submit" value="확인" class="btnblue" />
	</div>

</div>
