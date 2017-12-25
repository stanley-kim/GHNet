<div id="perio_update" class="khusd_st update perio">

<h2>치주과 정보 수정</h2>

	<form name="updateScore" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="update" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	
	<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />

	<input type="hidden" name="fix" value="<?php echo $SCORE['fix']?>" />
	
	<?php if($n_page):?>
		<input type="hidden" name="n_page" value="<?php echo $n_page?>" />
	<?php endif?>
	
	<?php $SEMESTER_INFO = getCurrentSemesterInfo()  ?>
	<div id="follow_list" style="display:none;">
		<table>
		<caption>치주과 팔로우 리스트</caption>
		<colgroup>
			<col width="30">
			<col width="80">
			<col width="60">
			<col width="60">
			<col width="50">
			<col width="50">
			<col width="40">
			<col width="60">
		</colgroup>
			<thead>
				<tr>
					<th>번호</th>
					<th>병록번호</th>
					<th>환자명</th>
					<th>담당의</th>
					<th>팔로우 타입</th>
					<th>팔로우 횟수</th>
					<th>팔로우 상태</th>
					<th>업데이트 시간</th>
				</tr>
			</thead>
			<tbody>
				<?php $idx = 1?>
				<?php while($MY_FOLLOW = db_fetch_array($MY_FOLLOW_ARRAY)):?>
				<tr>
					<td><?php echo $idx++?></td>
					<td><?php echo $MY_FOLLOW['pt_id']?></td>
					<td><?php echo $MY_FOLLOW['pt_name']?></td>
					<td><?php echo $MY_FOLLOW['dr_name']?></td>
					<td><?php echo $MY_FOLLOW['fw_type']?></td>
					<td><?php echo $MY_FOLLOW['step']?></td>
					<td><?php echo $MY_FOLLOW['status']?></td>
					<td><?php echo getDateFormat($MY_FOLLOW['date_update'], 'Y-m-d H:i')?></td>
				</tr>
				<?php endwhile?>
			</tbody>
		</table>
	</div>

	<table summary="치주과 점수표 입니다.">
	<caption>치주과 점수표</caption>
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
			<td class="title" colspan=2>Follow</td>
		</tr>
		<tr>
			<td class="head">Follow A</td>
			<td><?php echo $FOLLOW['follow_A']?>명</td>
		</tr>
		<tr>
			<td class="head">Follow B</td>
			<td><?php echo $FOLLOW['follow_B']?>명</td>
		</tr>
		<tr>
			<td class="head">Follow C</td>
			<td><?php echo $FOLLOW['follow_C']?>명</td>
		</tr>
		<tr>
			<td class="head">Follow 추가 점수 (F/U 점수)</td>
			<td><input type="number" name="follow_point" maxlength="5" class="input" value="<?php echo $SCORE['follow_point']?>">점</td>
		</tr>-->
		<tr>
			<td class="title" colspan=2>Observation</td>
		</tr>
		<tr>
		<td class="head">IOT(IntraOral TBI)</td>
		<td><input type="number" name="iot" maxlength="5" class="input" value="<?php echo $SCORE['iot']?>">회</td>
		</tr>
		<tr>
		<td class="head">Charting</td>
		<td><input type="number" name="charting" maxlength="5" class="input" value="<?php echo $SCORE['charting']?>">회</td>
		</tr>
		<tr>
		<td class="head">Periodontal surgery</td>
		<td><input type="number" name="perio_surgery" maxlength="5" class="input" value="<?php echo $SCORE['surgery']?>">회
		&nbsp;(술후레포트 : <input type="number" name="perio_report" class="input" value="<?php echo $SCORE['perio_report']?>">회)</td>
		</tr>
<!--		<tr>
		<td class="head">Periodontal surgery 2nd</td>
		<td><input type="number" name="perio_surgery2" maxlength="5" class="input" value="<?php echo $SCORE['surgery2']?>">회</td>
		</tr>-->
		<tr>
		<td class="head">Implant 1st</td>
		<td><input type="number" name="imp_1st" maxlength="5" class="input" value="<?php echo $SCORE['imp_1st']?>">회
		&nbsp;(술후레포트 : <input type="number" name="imp1_report" class="input" value="<?php echo $SCORE['imp1_report']?>">회)</td>
		</tr>
<!--		<tr>
		<td class="head">Implant 1st (2nd)</td>
		<td><input type="number" name="imp_1st2" maxlength="5" class="input" value="<?php echo $SCORE['imp_1st2']?>">회</td>
		</tr>-->
		<tr>
		<td class="head">Implant 2nd</td>
		<td><input type="number" name="imp_2nd" maxlength="5" class="input" value="<?php echo $SCORE['imp_2nd']?>">회
		&nbsp;(술후레포트 : <input type="number" name="imp2_report" class="input" value="<?php echo $SCORE['imp2_report']?>">회)</td>
		</tr>
<!--		<tr>
		<td class="head">Implant 2nd (2nd)</td>
		<td><input type="number" name="imp_2nd2" maxlength="5" class="input" value="<?php echo $SCORE['imp_2nd2']?>">회</td>
		</tr>-->
<!--		<tr>
		<td class="head">버린 수술 점수</td>
		<td><input type="number" name="abandon" maxlength="5" class="input" value="<?php echo $SCORE['abandon']?>">점</td>
		</tr>-->
		<tr>
		<td class="head">SC,CU,RP,PR</td>
		<td><input type="number" name="scaling" maxlength="5" class="input" value="<?php echo $SCORE['sc']?>">회</td>
		</tr>
<!--		<tr>
		<td class="head">Scaling (2nd)</td>
		<td><input type="number" name="scaling2" maxlength="5" class="input" value="<?php echo $SCORE['sc2']?>">회</td>
		</tr>-->
		<tr>
		<td class="head">Others (others)</td>
		<td><input type="number" name="others" maxlength="5" class="input" value="<?php echo $SCORE['others']?>">회</td>
		</tr>
		<tr>
		<td class="head">TBI</td>
		<td><input type="number" name="tbi" maxlength="5" class="input" value="<?php echo $SCORE['tbi']?>">회</td>
		</tr>
		<tr>
		<td class="head">CP</td>
		<td><input type="number" name="cp" maxlength="5" class="input" value="<?php echo $SCORE['cp']?>">점</td>
		</tr>
		<tr>
		<td class="head">동물실험</td>
		<td><input type="number" name="animal_exp" maxlength="5" class="input" value="<?php echo $SCORE['animal_exp']?>">회</td>
		</tr>
		<tr>
			<td class="title" colspan=2>ST Case</td>
		</tr>
		<tr>
		<td class="head">지난학기 SC 완료갯수</td>
		<td><input type="number" name="st_prevsc_complete" maxlength="5" class="input" value="<?php echo $SCORE['stprevsc_complete']?>">회</td>
		</tr>
        	<?php if($SEMESTER_INFO['sid'] == 2):?>
		<tr>
		<td class="head">Pre-Scaling (PreSC)</td>
		<td><input type="checkbox" name="st_presc" value="st_presc" <?php echo $SCORE['stpresc']==0?'':checked?> ></td>
		</tr>
        	<?php endif?>
		<tr>
		<td class="head">Scaling (SC)</td>
		<td><input type="number" name="st_sc" maxlength="5" class="input" value="<?php echo $SCORE['stsc']?>">회</td>
		</tr>
		<tr>
		<td class="head">SPT</td>
		<td><input type="number" name="st_pc" maxlength="5" class="input" value="<?php echo $SCORE['stpc']?>">회</td>
		</tr>
		<tr>
		<td class="head">Charting&Scaling<br>(SPT완료)</td>
		<td><input type="number" name="st_spt_complete" maxlength="5" class="input" value="<?php echo $SCORE['stspt_complete']?>">회</td>
		</tr>
		<tr>
		<td class="head">Charting&Plaque control<br>(SPT미완료)</td>
		<td><input type="number" name="st_spt_incomplete" maxlength="5" class="input" value="<?php echo $SCORE['stspt_incomplete']?>">회</td>
		</tr>
		<tr>
		<td class="head">Curettage (CU)</td>
		<td><input type="number" name="st_cu" maxlength="5" class="input" value="<?php echo $SCORE['stcu']?>">회</td>
		</tr>
		<tr>
<!--		<td class="head">Cu 셀렉받은 총 수(한거 포함)</td>
		<td><input type="number" name="stcu_selected" maxlength="5" class="input" value="<?php echo $SCORE['stcu_selected']?>">회</td>
		</tr>
		<tr>
		<td class="head">Cu 앞으로 할 수</td>
		<td><input type="number" name="stcu_todo" maxlength="5" class="input" value="<?php echo $SCORE['stcu_todo']?>">회</td>
		</tr>
		<tr>
		<td class="head">목표점수 입력</td>
		<td class="input"><input type="checkbox" name="is_goal" class="input num" value="y">예상점수 확인하고 싶을 때 체크해보세요~</td>
		</tr>-->
	</tbody>
	</table>

	<div class="bottombox">
		<input type="button" value="취소" class="btngray" onclick="cancelCheck();" />
		<input type="submit" value="확인" class="btnblue" />
	</div>

</div>
