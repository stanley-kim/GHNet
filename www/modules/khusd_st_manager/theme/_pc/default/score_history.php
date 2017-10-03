<div id="score_history" class="khusd_st manager">
	
	<form name="update_check" action="<?php echo $g['s']?>/" method="get">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="c" value="<?php echo $c?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="mode" value="<?php echo $mode?>" />


		<select name="dept_id">
			<option value="perio"<?php if($dept_id == 'perio'):?> selected<?php endif?>>치주과</option>
			<option value="pros"<?php if($dept_id == 'pros'):?> selected<?php endif?>>보철과</option>
			<option value="pedia"<?php if($dept_id == 'pedia'):?> selected<?php endif?>>소아치과</option>
			<option value="radio"<?php if($dept_id == 'radio'):?> selected<?php endif?>>영상과</option>
			<option value="ortho"<?php if($dept_id == 'ortho'):?> selected<?php endif?>>교정과</option>
			<option value="consv"<?php if($dept_id == 'consv'):?> selected<?php endif?>>보존과</option>
			<option value="oms"<?php if($dept_id == 'oms'):?> selected<?php endif?>>구강외과</option>
			<option value="medi"<?php if($dept_id == 'medi'):?> selected<?php endif?>>구강내과</option>
		</select>

		학번 : <input type="text" name="st_id" value="<?php echo $st_id ? $st_id : ''?>" />
		이름 : <input type="text" name="st_name" value="<?php echo $st_name ? $st_name : ''?>" />
		<input type="submit" value="확인" class="btngray" />
	</form>
	
	<?php if($dept_id && $st_id):?>
	<iframe src="<?php echo $g['s'].'/?m=khusd_st_'.$dept_id.'&amp;mode=history&amp;iframe=Y&amp;st_id='.$st_id?>" width="100%" height="300px" border="0px"> </iframe>
	<?php endif?>



        <?php if( permcheck('duplication_checker') ) :?>
	<br><br><br>
        <table summary="통합 점수표 입니다.">
        <caption>통합 점수표</caption>
        <colgroup>
        <col width="30">
        <col width="70">
        <col width="70">
        <col width="30">
        <col width="30">
        <col width="30">
        <col width="30">
        <col width="30">
        <col width="30">
        <col width="30">
        <col width="30">
        <col width="30">
        <col width="30">
        <col width="30">
        <col width="30">
        <col width="30">
        <col width="30">
        <col width="30">
        <col width="30">
        <col width="30">
        </colgroup>
        <thead>

        <tr>
        <th scope="col" rowspan=3 class="split">No</th>
        <th scope="col" rowspan=3 class="split">학번</th>
        <th scope="col" rowspan=3 class="split">이름</th>
        <th scope="col" rowspan=1 colspan=7  class="split">치주</th>
        <th scope="col" rowspan=1 colspan=1  class="split">외과</th>
        <th scope="col" rowspan=1 colspan=3  class="split">영상</th>
        <th scope="col" rowspan=1 colspan=6  class="split">내과</th>
	</tr>
	<tr>
        <th scope="col" rowspan=2 class="split">IOT</th>
        <th scope="col" rowspan=2 class="split">Ch</th>
        <th scope="col" rowspan=2 class="split">Ch<br>+<br>IOT</th>
        <th scope="col" rowspan=2 class="split">Perio Surgery</th>
        <th scope="col" rowspan=2 class="split">Imp 1st</th>
        <th scope="col" rowspan=2 class="split">Imp 2nd</th>
        <th scope="col" rowspan=2 class="split">Total<br>surgery</th>
        <th scope="col" rowspan=2 class="split">Implant</th>
        <th scope="col" rowspan=2 class="split">판독</th>
        <th scope="col" rowspan=2 class="split">촬영</th>
        <th scope="col" rowspan=2 class="split">판+촬</th>
        <th scope="col" rowspan=2 class="split">오전픽스</th>
        <th scope="col" rowspan=2 class="split">오후픽스</th>
        <th scope="col" rowspan=2 class="split">픽스합계</th>
        <th scope="col" rowspan=2 class="split">장치내주</th>
        <th scope="col" rowspan=2 class="split">장치외주</th>
        <th scope="col" rowspan=2 class="split">장치합계</th>
        </tr>
	<tr></tr>
        </thead>
        <tbody>
	<?php $idx=1?>
       <?php foreach($SCORE_ARRAY as $SCORE):?>

       <tr >
        <td><?php echo $idx++?></td>
        <td class="hand" ><?php echo $SCORE['st_id']?></td>
        <td class="hand" ><?php echo $SCORE['st_info']['name']?></td>

        <td class="category1"><?php echo $SCORE['iot']?></td>
        <td class="category1"><?php echo $SCORE['charting']?></td>
        <td class="category1"><?php echo $SCORE['perio_ch_iot']?></td>
        <td><?php echo $SCORE['surgery']?></td>
        <td><?php echo $SCORE['imp_1st']?></td>
        <td><?php echo $SCORE['imp_2nd']?></td>
        <td class="category2"><?php echo $SCORE['perio_total_surgery']?></td>
        <td><?php echo $SCORE['oms_imp_1st']?></td>
        <td><?php echo $SCORE['radio_obser_decoding']?></td>
        <td><?php echo $SCORE['radio_obser_filming']?></td>
        <td><?php echo $SCORE['radio_decoding_filming']?></td>
        <td><?php echo $SCORE['medi_fix_am']?></td>
        <td><?php echo $SCORE['medi_fix_pm']?></td>
        <td><?php echo $SCORE['medi_prof_fix']?></td>
        <td><?php echo $SCORE['medi_splint_in']?></td>
        <td><?php echo $SCORE['medi_splint_out']?></td>
        <td><?php echo $SCORE['medi_splint']?></td>
	</tr>
        <?php endforeach?>
        </tbody>


        </table>


	
	<?php endif?>



</div>
