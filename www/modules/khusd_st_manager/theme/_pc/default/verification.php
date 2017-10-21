<div id="update" class="khusd_st manager">

        <?php if( permcheck('duplication_checker') ) :?>

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
        <th scope="col" rowspan=1 colspan=1  class="split">보존</th>
        <th scope="col" rowspan=1 colspan=6  class="split">보철</th>
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
        <th scope="col" rowspan=2 class="split">수술</th>
        <th scope="col" rowspan=2 class="split">Post</th>
        <th scope="col" rowspan=2 class="split">Imp</th>
        <th scope="col" rowspan=2 class="split">SingleCr</th>
        <th scope="col" rowspan=2 class="split">Br</th>
        <th scope="col" rowspan=2 class="split">RPD</th>
        <th scope="col" rowspan=2 class="split">CD</th>
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
        <td><?php echo $SCORE['consv_surgery']?></td>
        <td><?php echo $SCORE['pros_post_core']?></td>
        <td><?php echo $SCORE['pros_imp_cr_br']?></td>
        <td><?php echo $SCORE['pros_single_cr']?></td>
        <td><?php echo $SCORE['pros_br']?></td>
        <td><?php echo $SCORE['pros_partial_denture']?></td>
        <td><?php echo $SCORE['pros_complete_denture']?></td>
        </tr>
        <?php endforeach?>
        </tbody>


        </table>





	<form name="procForm" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="ruleupdate" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	
	<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
	<?php if($n_page):?>
		<input type="hidden" name="n_page" value="<?php echo $n_page?>" />
	<?php endif?>
	<?php
	$apply_regular_1st_end_time = '1410';
	$apply_regular_2nd_end_time = '1420';
	$apply_regular_3rd_end_time = '1430';
	$apply_regular_4th_end_time = '1440';
	$apply_regular_4th_end_time = '1445';

	// to detect appliance day
	$apply_regular_1st_end_day='';
        foreach($APPLY_INFOS as $EACH_INFO) {
		if( $EACH_INFO['is_perio_surgery'] == 'y' && getDateFormat($EACH_INFO['date_end'],'Hi') == $apply_regular_1st_end_time )  {
			 __debug_print("db_query_go for_detect. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$apply_regular_1st_end_day = getDateFormat($EACH_INFO['date_end'],'Ymd'); 
			break;
		}
		else if( $EACH_INFO['is_perio_surgery'] == 'n' && $EACH_INFO['department'] == 'perio' &&  getDateFormat($EACH_INFO['date_end'],'Hi') == $apply_regular_1st_end_time )  {
			 __debug_print("db_query_go for_detect. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$apply_regular_1st_end_day = getDateFormat($EACH_INFO['date_end'],'Ymd'); 
			break;
		}
		

	}
	//to detect each apply_info  
	$latest_perio_surgery=array();	
	$latest_perio_chiot  =array();
	$latest_oms          =array();
	$latest_radio        =array();	
        foreach($APPLY_INFOS as $EACH_INFO) {
		if( $EACH_INFO['is_perio_surgery'] == 'y' && getDateFormat($EACH_INFO['date_end'],'YmdHi') == $apply_regular_1st_end_day.$apply_regular_1st_end_time)   { 
			//__debug_print("db_query_go for_detect!. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$latest_perio_surgery[1] = $EACH_INFO;
		}
		else if( $EACH_INFO['is_perio_surgery'] == 'y' && getDateFormat($EACH_INFO['date_end'],'YmdHi') == $apply_regular_1st_end_day.$apply_regular_2nd_end_time)   { 
			//__debug_print("db_query_go for_detect!. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$latest_perio_surgery[2] = $EACH_INFO;
		}
		else if( $EACH_INFO['is_perio_surgery'] == 'y' && getDateFormat($EACH_INFO['date_end'],'YmdHi') == $apply_regular_1st_end_day.$apply_regular_3rd_end_time)   { 
			//__debug_print("db_query_go for_detect!. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$latest_perio_surgery[3] = $EACH_INFO;
		}
		else if( $EACH_INFO['is_perio_surgery'] == 'y' && getDateFormat($EACH_INFO['date_end'],'YmdHi') == $apply_regular_1st_end_day.$apply_regular_4th_end_time)   { 
			//__debug_print("db_query_go for_detect!. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$latest_perio_surgery[4] = $EACH_INFO;
		}
		else if( $EACH_INFO['is_perio_surgery'] == 'n' &&  $EACH_INFO['department'] == 'perio' && getDateFormat($EACH_INFO['date_end'],'YmdHi') == $apply_regular_1st_end_day.$apply_regular_1st_end_time)   { 

			//__debug_print("db_query_go for_detect!. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$latest_perio_chiot[1] = $EACH_INFO;
		}
		else if( $EACH_INFO['is_perio_surgery'] == 'n' &&  $EACH_INFO['department'] == 'perio' && getDateFormat($EACH_INFO['date_end'],'YmdHi') == $apply_regular_1st_end_day.$apply_regular_2nd_end_time)   { 

			//__debug_print("db_query_go for_detect!. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$latest_perio_chiot[2] = $EACH_INFO;
		}
		else if( $EACH_INFO['is_perio_surgery'] == 'n' &&  $EACH_INFO['department'] == 'perio' && getDateFormat($EACH_INFO['date_end'],'YmdHi') == $apply_regular_1st_end_day.$apply_regular_3rd_end_time)   { 

			//__debug_print("db_query_go for_detect!. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$latest_perio_chiot[3] = $EACH_INFO;
		}
		else if( $EACH_INFO['is_perio_surgery'] == 'n' &&  $EACH_INFO['department'] == 'perio' && getDateFormat($EACH_INFO['date_end'],'YmdHi') == $apply_regular_1st_end_day.$apply_regular_4th_end_time)   { 

			//__debug_print("db_query_go for_detect!. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$latest_perio_chiot[4] = $EACH_INFO;
		}
		else if(  $EACH_INFO['department'] == 'oms' && getDateFormat($EACH_INFO['date_end'],'YmdHi') == $apply_regular_1st_end_day.$apply_regular_1st_end_time)   { 

			//__debug_print("db_query_go for_detect!. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$latest_oms[1] = $EACH_INFO;
		}
		else if(  $EACH_INFO['department'] == 'oms' && getDateFormat($EACH_INFO['date_end'],'YmdHi') == $apply_regular_1st_end_day.$apply_regular_2nd_end_time)   { 

			//__debug_print("db_query_go for_detect!. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$latest_oms[2] = $EACH_INFO;
		}
		else if(  $EACH_INFO['department'] == 'oms' && getDateFormat($EACH_INFO['date_end'],'YmdHi') == $apply_regular_1st_end_day.$apply_regular_3rd_end_time)   { 

			//__debug_print("db_query_go for_detect!. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$latest_oms[3] = $EACH_INFO;
		}
		else if(  $EACH_INFO['department'] == 'oms' && getDateFormat($EACH_INFO['date_end'],'YmdHi') == $apply_regular_1st_end_day.$apply_regular_4th_end_time)   { 

			//__debug_print("db_query_go for_detect!. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$latest_oms[4] = $EACH_INFO;
		}
		else if(  $EACH_INFO['department'] == 'radio' && getDateFormat($EACH_INFO['date_end'],'YmdHi') == $apply_regular_1st_end_day.$apply_regular_1st_end_time)   { 

			//__debug_print("db_query_go for_detect!. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$latest_radio[1] = $EACH_INFO;
		}
		else if(  $EACH_INFO['department'] == 'radio' && getDateFormat($EACH_INFO['date_end'],'YmdHi') == $apply_regular_1st_end_day.$apply_regular_2nd_end_time)   { 

			//__debug_print("db_query_go for_detect!. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$latest_radio[2] = $EACH_INFO;
		}
		else if(  $EACH_INFO['department'] == 'radio' && getDateFormat($EACH_INFO['date_end'],'YmdHi') == $apply_regular_1st_end_day.$apply_regular_3rd_end_time)   { 

			//__debug_print("db_query_go for_detect!. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$latest_radio[3] = $EACH_INFO;
		}
		else if(  $EACH_INFO['department'] == 'radio' && getDateFormat($EACH_INFO['date_end'],'YmdHi') == $apply_regular_1st_end_day.$apply_regular_4th_end_time)   { 

			//__debug_print("db_query_go for_detect!. - " . "YY".getDateFormat($EACH_INFO['date_end'],'Ymd') );
			$latest_radio[4] = $EACH_INFO;
		}

	}
	$RULE = array();
	foreach($RULES as $EACH_RULE)  {
		$RULE = $EACH_RULE;
		break;
	}
	//to restore saved rules
	$perio_surgery_on        = str_split( $RULE['perio_surgery_on']  ) ;
	$perio_surgery_selection = str_split( $RULE['perio_surgery_selection']  ) ;
	$perio_surgery_standard  = str_split( $RULE['perio_surgery_standard']  ) ;
	$perio_surgery_num_apply = str_split( $RULE['perio_surgery_num_apply']  ) ;

	$perio_chiot_on        = str_split( $RULE['perio_chiot_on']  ) ;
	$perio_chiot_selection = str_split( $RULE['perio_chiot_selection']  ) ;
	$perio_chiot_standard  = str_split( $RULE['perio_chiot_standard']  ) ;
	$perio_chiot_num_apply = str_split( $RULE['perio_chiot_num_apply']  ) ;

	$oms_on        = str_split( $RULE['oms_on']  ) ;
	$oms_selection = str_split( $RULE['oms_selection']  ) ;
	$oms_standard  = str_split( $RULE['oms_standard']  ) ;
	$oms_num_apply = str_split( $RULE['oms_num_apply']  ) ;

	$radio_on        = str_split( $RULE['radio_on']  ) ;
	$radio_selection = str_split( $RULE['radio_selection']  ) ;
	$radio_standard  = str_split( $RULE['radio_standard']  ) ;
	$radio_num_apply = str_split( $RULE['radio_num_apply']  ) ;
	?>
	<table summary="규칙표 입니다.">
	<caption>Rule</caption>
	<colgroup>
		<col width=10%>
		<col width=10%>
		<col width=10%>
		<col width=10%>
		<col >
	</colgroup>
	<thead>
	</thead>
	<tbody>
                <tr>
                <td scope="col" class="title">과목</th>
                <td scope="col" class="title">차수</th>
                <td scope="col" class="title">시간</th>
                <td scope="col" class="title">제목</th>
                <td scope="col" class="title">조건</th>
                </tr>
		<?php $idx = 1 ?>
		<?php for($idx=1;$idx<=4;$idx++) {?>
		<tr>
		<td   rowspan="1" class="head">치주수술</td>
		<td   class="head"><?php echo $idx?>차 <input type="checkbox"  name=checkbox_perio_surgery_on[<?php echo $idx-1?>]  value="1"   <?php if( $perio_surgery_on[$idx-1] == '1'  )  echo checked ?>  >On</td>
		<td> <?php echo getDateFormat($latest_perio_surgery[$idx]['date_start'],'Y-m-d H:i')  ?>~ <?php echo getDateFormat($latest_perio_surgery[$idx]['date_end'],'Y-m-d H:i')  ?></td>
		<td><?php echo $latest_perio_surgery[$idx]['apply_info_subject']   ?>   </td>
		<td>
			<input type="radio"  name=checkbox_perio_surgery_selection[<?php echo $idx-1?>] value=<?php echo $d['khusd_st_manager']['selection']['perio_surgery']['surgery']   ?>   <?php if( $perio_surgery_selection[$idx-1] != $d['khusd_st_manager']['selection']['perio_surgery']['group']  )  echo checked ?>  >수술
			<input type="radio"  name=checkbox_perio_surgery_selection[<?php echo $idx-1?>]  value=<?php echo $d['khusd_st_manager']['selection']['perio_surgery']['group']   ?>  <?php if( $perio_surgery_selection[$idx-1] == $d['khusd_st_manager']['selection']['perio_surgery']['group']  )  echo checked ?>  >Group
			<br><input type="number" name=input_perio_surgery_standard[<?php echo $idx-1?>]  maxlength="5"  class="input" value="<?php echo $perio_surgery_standard[$idx-1] ?>">회이하<br>
			<input type="number" name=input_perio_surgery_num_apply[<?php echo $idx-1?>] maxlength="5"  class="input" value="<?php echo $perio_surgery_num_apply[$idx-1] ?>">회지원

		</td>
		</tr>
		<?php }?>

		<?php $idx = 1 ?>
		<?php for($idx=1;$idx<=4;$idx++) {?>
		<tr>
		<td   rowspan="1" class="head">치주ChIot</td>
		<td   class="head"><?php echo $idx?>차 <input type="checkbox"  name=checkbox_perio_chiot_on[<?php echo $idx-1?>] value="1"   <?php if( $perio_chiot_on[$idx-1] == '1'  )  echo checked ?>  >On</td>
		<td> <?php echo getDateFormat($latest_perio_chiot[$idx]['date_start'],'Y-m-d H:i')  ?>~ <?php echo getDateFormat($latest_perio_chiot[$idx]['date_end'],'Y-m-d H:i')  ?></td>
		<td><?php echo $latest_perio_chiot[$idx]['apply_info_subject']   ?>   </td>
		<td>
			<input type="radio"  name=checkbox_perio_chiot_selection[<?php echo $idx-1?>] value=<?php echo $d['khusd_st_manager']['selection']['perio_chiot']['ch']  ?>   <?php if( $perio_chiot_selection[$idx-1] ==  $d['khusd_st_manager']['selection']['perio_chiot']['ch']   )  echo checked ?>  >Ch만
			<input type="radio"  name=checkbox_perio_chiot_selection[<?php echo $idx-1?>] value=<?php echo $d['khusd_st_manager']['selection']['perio_chiot']['iot']  ?>   <?php if( $perio_chiot_selection[$idx-1] == $d['khusd_st_manager']['selection']['perio_chiot']['iot']  )  echo checked ?>  >IoT만
			<input type="radio"  name=checkbox_perio_chiot_selection[<?php echo $idx-1?>] value=<?php echo $d['khusd_st_manager']['selection']['perio_chiot']['chiot']  ?>   <?php if( $perio_chiot_selection[$idx-1] == $d['khusd_st_manager']['selection']['perio_chiot']['chiot']  )  echo checked ?>  >ChIoT합
			<input type="radio"  name=checkbox_perio_chiot_selection[<?php echo $idx-1?>] value=<?php echo $d['khusd_st_manager']['selection']['perio_chiot']['group']  ?>   <?php if( $perio_chiot_selection[$idx-1] == $d['khusd_st_manager']['selection']['perio_chiot']['group'] )  echo checked ?>  >Group
			<br><input type="number" name=input_perio_chiot_standard[<?php echo $idx-1?>] maxlength="2" class="input" value="<?php echo $perio_chiot_standard[$idx-1] ?>">회이하<br>
			<input type="number" name=input_perio_chiot_num_apply[<?php echo $idx-1?>] maxlength="2" class="input" value="<?php echo $perio_chiot_num_apply[$idx-1] ?>">회지원

		</td>
		</tr>
		<?php }?>

		<?php $idx = 1 ?>
		<?php for($idx=1;$idx<=4;$idx++) {?>
		<tr>
		<td   rowspan="1" class="head">oms surgery</td>
		<td   class="head"><?php echo $idx?>차 <input type="checkbox"  name=checkbox_oms_on[<?php echo $idx-1?>] value="1"   <?php if( $oms_on[$idx-1] == '1'  )  echo checked ?>  >On</td>
		<td> <?php echo getDateFormat($latest_oms[$idx]['date_start'],'Y-m-d H:i')  ?>~ <?php echo getDateFormat($latest_oms[$idx]['date_end'],'Y-m-d H:i')  ?></td>
		<td><?php echo $latest_oms[$idx]['apply_info_subject']   ?>   </td>
		<td>
			<input type="radio"  name=checkbox_oms_selection[<?php echo $idx-1?>] value=<?php echo $d['khusd_st_manager']['selection']['oms']['surgery']  ?>   <?php if( $oms_selection[$idx-1] == $d['khusd_st_manager']['selection']['oms']['surgery']  )  echo checked ?>  >수술
			<input type="radio"  name=checkbox_oms_selection[<?php echo $idx-1?>] value=<?php echo $d['khusd_st_manager']['selection']['oms']['group']  ?>   <?php if( $oms_selection[$idx-1] == $d['khusd_st_manager']['selection']['oms']['group'] )  echo checked ?>  >Group
			<br><input type="number" name=input_oms_standard[<?php echo $idx-1?>] maxlength="2" class="input" value="<?php echo $oms_standard[$idx-1] ?>">회이하<br>
			<input type="number" name=input_oms_num_apply[<?php echo $idx-1?>] maxlength="2" class="input" value="<?php echo $oms_num_apply[$idx-1] ?>">회지원

		</td>
		</tr>
		<?php }?>

		<?php $idx = 1 ?>
		<?php for($idx=1;$idx<=4;$idx++) {?>
		<tr>
		<td   rowspan="1" class="head">영상</td>
		<td   class="head"><?php echo $idx?>차 <input type="checkbox"  name=checkbox_radio_on[<?php echo $idx-1?>] value="1"   <?php if( $radio_on[$idx-1] == '1'  )  echo checked ?>  >On</td>
		<td> <?php echo getDateFormat($latest_radio[$idx]['date_start'],'Y-m-d H:i')  ?>~ <?php echo getDateFormat($latest_radio[$idx]['date_end'],'Y-m-d H:i')  ?></td>
		<td><?php echo $latest_radio[$idx]['apply_info_subject']   ?>   </td>
		<td>
			<input type="radio"  name=checkbox_radio_selection[<?php echo $idx-1?>] value=<?php echo $d['khusd_st_manager']['selection']['radio']['filming']  ?>    <?php if( $radio_selection[$idx-1] == $d['khusd_st_manager']['selection']['radio']['filming']   )  echo checked ?>  >촬옵
			<input type="radio"  name=checkbox_radio_selection[<?php echo $idx-1?>] value=<?php echo $d['khusd_st_manager']['selection']['radio']['decoding']  ?>   <?php if( $radio_selection[$idx-1] == $d['khusd_st_manager']['selection']['radio']['decoding']  )  echo checked ?>  >판옵
			<input type="radio"  name=checkbox_radio_selection[<?php echo $idx-1?>] value=<?php echo $d['khusd_st_manager']['selection']['radio']['fandp']  ?>      <?php if( $radio_selection[$idx-1] == $d['khusd_st_manager']['selection']['radio']['fandp']  )  echo checked ?>  >촬+판옵
			<input type="radio"  name=checkbox_radio_selection[<?php echo $idx-1?>] value=<?php echo $d['khusd_st_manager']['selection']['radio']['group']  ?>      <?php if( $radio_selection[$idx-1] == $d['khusd_st_manager']['selection']['radio']['group'] )  echo checked ?>  >Group
			<br><input type="number" name=input_radio_standard[<?php echo $idx-1?>] maxlength="2" class="input" value="<?php echo $radio_standard[$idx-1] ?>">회이하<br>
			<input type="number" name=input_radio_num_apply[<?php echo $idx-1?>] maxlength="2" class="input" value="<?php echo $radio_num_apply[$idx-1] ?>">회지원

		</td>
		</tr>
		<?php }?>

	</tbody>
	</table>

	<div class="bottombox">
		<input type="button" value="취소" class="btngray" onclick="cancelCheck();" />
		<input type="submit" value="확인" class="btnblue" />
	</div>
	</form>


	<?php
function format_print($_dup_check_rows, $_prefix)  {
        $prefix = $_prefix;
        $dcd5 = $_dup_check_rows;
        echo $prefix;
        echo "ID@".$dcd5['st_id'].'@'.getDateFormat($dcd5['date_item'],'m/d').'('.getWeek(getDateFormat($dcd5['date_item'], 'w')).')'.' @'.getDateFormat($dcd5['date_item'],'Hi').'@'.getDateFormat($dcd5['date_end'],'m/d').'('.getWeek(getDateFormat($dcd5['date_end'], 'w')).')'.' @'.getDateFormat($dcd5['date_end'],'Hi').'@상태)'.$dcd5['status'];
        //echo ' rand) '.$dcd5['rand'] ;
        echo ' @'.$dcd5['apply_item_content'].'@'.$dcd5['apply_info_subject'].' @'.$dcd5['department'].'@'.$dcd5['sub_category'];
        //echo "ID]".$dcd5['st_id'].']'.getDateFormat($dcd5['date_item'],'m/d').'('.getWeek(getDateFormat($dcd5['date_item'], 'w')).')'.' ]'.getDateFormat($dcd5['date_item'],'Hi').']'.getDateFormat($dcd5['date_end'],'m/d').'('.getWeek(getDateFormat($dcd5['date_end'], 'w')).')'.' ]'.getDateFormat($dcd5['date_end'],'Hi').']상태)'.$dcd5['status'];
        //echo ' rand) '.$dcd5['rand'] ;
        //echo ' ]'.$dcd5['apply_item_content'].']'.$dcd5['apply_info_subject'].' ]'.$dcd5['department'].']'.$dcd5['sub_category'];
        echo "<br>"  ;

        echo '</span>';
}

function isMandatory( $dcd5 , $rules) {       
	if( $dcd5['department'] == 'perio' && $dcd5['is_perio_surgery'] == 'y' )   
		return true;  // have to modify 
	else if( $dcd5['department'] == 'perio' && $dcd5['is_perio_surgery'] == 'n' )
		return true;
	else if( $dcd5['department'] == 'oms' )
		return true;
	else if( $dcd5['department'] == 'radio' )
		return true;
	else  
		return false;
	return false;
}

function _getOnesValue( $st_id, $department, $is_perio_surgery, $selection , $rules)   {
__debug_print("db_query_go for_detect. getOneValue0 - " . $st_id.$selection. $rules['selection']['perio_surgery']['surgery']  );
        if( $department == 'perio' && $is_perio_surgery == 'y' )    {
 		if( $selection == $rules['selection']['perio_surgery']['surgery'] )   { 
__debug_print("db_query_go for_detect. getOneValue1 - " . $st_id );
			return $SCORE_ARRAY[ $st_id ]['perio_total_surgery'] ;
		}
		else    {
__debug_print("db_query_go for_detect. getOneValue3 - " . $st_id );
			return  0 ;	
		}
	}
        else if( $department == 'perio' && $is_perio_surgery == 'n' )    {
 		if( $selection == $rules['selection']['perio_chiot']['ch'] ) 
			return $SCORE_ARRAY[ $st_id ]['charting'] ;
 		if( $selection == $rules['selection']['perio_chiot']['iot'] ) 
			return $SCORE_ARRAY[ $st_id ]['iot'] ;
 		if( $selection == $rules['selection']['perio_chiot']['chiot'] ) 
			return $SCORE_ARRAY[ $st_id ]['perio_ch_iot'] ;
		else    return  0 ;	
	}
        else if( $department == 'oms'  )    {
 		if( $selection == $rules['selection']['oms']['surgery'] )   { 
__debug_print("db_query_go for_detect. getOneValue10 - " . $st_id );
			return $SCORE_ARRAY[ $st_id ]['oms_imp_1st'] ;
		}
		else    {
__debug_print("db_query_go for_detect. getOneValue13 - " . $st_id );
			return  0 ;	
		}
	}
        else if( $department == 'radio'  )    {
 		if( $selection == $rules['selection']['radio']['filming'] ) 
			return $SCORE_ARRAY[ $st_id ]['radio_obser_filming'] ;
 		if( $selection == $rules['selection']['radio']['decoding'] ) 
			return $SCORE_ARRAY[ $st_id ]['radio_obser_decoding'] ;
 		if( $selection == $rules['selection']['radio']['fandp'] ) 
			return $SCORE_ARRAY[ $st_id ]['radio_decoding_filming'] ;
		else    return  0 ;	
	}
__debug_print("db_query_go for_detect. getOneValue2 - " . $st_id );
	return 0;
}

function isWithinRuleRange($st_id,  $department, $is_perio_surgery, $apply_info_uid,  $idx, $rules)  {
        $perio_surgery_on = $rules['perio_surgery']['perio_surgery_on'];
        $perio_surgery_selection = $rules['perio_surgery']['perio_surgery_selection'];
        $perio_surgery_num_apply = $rules['perio_surgery']['perio_surgery_num_apply'];


        $perio_chiot_on = $rules['perio_chiot']['perio_chiot_on'];
        $perio_chiot_selection = $rules['perio_chiot']['perio_chiot_selection'];
        $perio_chiot_num_apply = $rules['perio_chiot']['perio_chiot_num_apply'];

        $oms_on = $rules['oms']['oms_on'];
        $oms_selection = $rules['oms']['oms_selection'];
        $oms_num_apply = $rules['oms']['oms_num_apply'];

        $radio_on        = $rules['radio']['radio_on'];
        $radio_selection = $rules['radio']['radio_selection'];
        $radio_num_apply = $rules['radio']['radio_num_apply'];

__debug_print("db_query_go for_detect. WiRa0 - " . $st_id );
	if ( $idx <0 || $idx >4 ) return false; 
        if( $department == 'perio' && $is_perio_surgery == 'y' )    {    //perio surgery case
		if( $rules['perio_surgery']['perio_surgery_on'][ $idx -1 ] != '1') {
__debug_print("db_query_go for_detect. WiRa1 Off - " . $st_id );
			return false;
		}
__debug_print("db_query_go for_detect. WiRa2 - " .$rules['perio_surgery']['perio_surgery_selection'][ $idx -1 ] .'-'.$rules['selection']['perio_surgery']['surgery']  );
		if( $rules['perio_surgery']['perio_surgery_selection'][ $idx -1 ] == $rules['selection']['perio_surgery']['surgery'] &&  _getOnesValue( $st_id, $department, $is_perio_surgery, $rules['perio_surgery']['perio_surgery_selection'][ $idx -1 ],$rules ) <= $rules['perio_surgery']['perio_surgery_standard'][ $idx -1 ] && $rules['MandatoryTime'][ $apply_info_uid]      )   {
__debug_print("db_query_go for_detect. WiRa3 - " . $st_id );
			return true;	
		}

	}
        else if( $department == 'perio' && $is_perio_surgery == 'n' )    {  //perio chiot case
__debug_print("db_query_go for_detect. WiRa4 - " . $st_id );
		if( $rules['perio_chiot']['perio_chiot_on'][ $idx -1 ] != '1') return false;
__debug_print("db_query_go for_detect. WiRa5 Off- " . $st_id );
		if(      $perio_chiot_selection[ $idx -1 ] == $rules['selection']['perio_chiot']['ch'] &&  _getOnesValue( $st_id, $department, $is_perio_surgery, $rules['perio_chiot']['perio_chiot_selection'][ $idx -1 ] ,$rules) <= $rules['perio_chiot']['perio_chiot_standard'][ $idx -1 ] && $rules['MandatoryTime'][ $apply_info_uid]   )  
			return true;
		else if( $perio_chiot_selection[ $idx -1 ] == $rules['selection']['perio_chiot']['iot'] &&  _getOnesValue( $st_id, $department, $is_perio_surgery, $perio_chiot_selection[ $idx -1 ], $rules ) <= $perio_chiot_standard[ $idx -1 ]  && $rules['MandatoryTime'][ $apply_info_uid]     )  
			return true;
		else if( $perio_chiot_selection[ $idx -1 ] == $rules['selection']['perio_chiot']['chiot'] &&  _getOnesValue( $st_id, $department, $is_perio_surgery, $perio_chiot_selection[ $idx -1 ], $rules ) <= $perio_chiot_standard[ $idx -1 ] && $rules['MandatoryTime'][ $apply_info_uid]    )  
			return true;	

	}
        else if( $department == 'oms'  )    {  //oms chiot case
__debug_print("db_query_go for_detect. WiRa7 - " . $st_id );
		if( $rules['oms']['oms_on'][ $idx -1 ] != '1') return false;
__debug_print("db_query_go for_detect. WiRa7 Off- " . $st_id );
		if(      $oms_selection[ $idx -1 ] == $rules['selection']['oms']['surgery'] &&  _getOnesValue( $st_id, $department, $is_perio_surgery, $rules['oms']['oms_selection'][ $idx -1 ] ,$rules) <= $rules['oms']['oms_standard'][ $idx -1 ] && $rules['MandatoryTime'][ $apply_info_uid]   )  
			return true;

	}
        else if( $department == 'radio'  )    {  //radio case
__debug_print("db_query_go for_detect. WiRa14 - " . $st_id );
		if( $rules['radio']['radio_on'][ $idx -1 ] != '1') return false;
__debug_print("db_query_go for_detect. WiRa15 Off- " . $st_id );
		if(      $radio_selection[ $idx -1 ] == $rules['selection']['radio']['filming'] &&   _getOnesValue( $st_id, $department, $is_perio_surgery, $radio_selection[ $idx -1 ] ,$rules) <= $rules['radio']['radio_standard'][ $idx -1 ] && $rules['MandatoryTime'][ $apply_info_uid]   )  
			return true;
		else if( $radio_selection[ $idx -1 ] == $rules['selection']['radio']['decoding'] &&  _getOnesValue( $st_id, $department, $is_perio_surgery, $radio_selection[ $idx -1 ], $rules ) <= $radio_standard[ $idx -1 ]  && $rules['MandatoryTime'][ $apply_info_uid]     )  
			return true;
		else if( $radio_selection[ $idx -1 ] == $rules['selection']['radio']['fandp'] &&     _getOnesValue( $st_id, $department, $is_perio_surgery, $radio_selection[ $idx -1 ], $rules ) <= $radio_standard[ $idx -1 ] && $rules['MandatoryTime'][ $apply_info_uid]    )  
			return true;	

	}
	return false ; 
}

function isMandatoryTime( $dcd5, $rules ) {
//__debug_print("db_query_go for_detect. PS PCI - " . $dcd5['st_id'] );
	if   (!isMandatory($dcd5, $rules) ) return false;
        if( $dcd5['department'] == 'perio' && $dcd5['is_perio_surgery'] == 'y' )    {  //perio_surgery case
//__debug_print("db_query_go for_detect. PS0 - " . $dcd5['st_id'] );
		for($idx=1; $idx<=4 ; $idx++)  {
//__debug_print("db_query_go for_detect. PS1 - ".$dcd5['st_id']. '-' . $rules['perio_surgery']['latest_perio_surgery'][$idx]['apply_info_uid'].'-'.  $dcd5['apply_info_uid'] );
			if( $rules['perio_surgery']['latest_perio_surgery'][$idx]['apply_info_uid'] == $dcd5['apply_info_uid'] &&  isWithinRuleRange($dcd5['st_id'],  $dcd5['department'], $dcd5['is_perio_surgery'], $dcd5['apply_info_uid'],  $idx, $rules)    )    { 
//__debug_print("db_query_go for_detect. PS2 - " . $dcd5['st_id'] );
				return true;
			}
		}
	}   
        else if( $dcd5['department'] == 'perio' && $dcd5['is_perio_surgery'] == 'n' )    {   //perio chiot case
//__debug_print("db_query_go for_detect. PCI 0 " . $dcd5['st_id'] );
		for($idx=1; $idx<=4 ; $idx++)  {
//__debug_print("db_query_go for_detect. PCI1 - ".$dcd5['st_id']. '-' . $rules['perio_chiot']['latest_perio_chiot'][$idx]['apply_info_uid'].'-'.  $dcd5['apply_info_uid'] );
			if( $rules['perio_chiot']['latest_perio_chiot'][$idx]['apply_info_uid'] == $dcd5['apply_info_uid'] &&  isWithinRuleRange($dcd5['st_id'],  $dcd5['department'], $dcd5['is_perio_surgery'],  $dcd5['apply_info_uid'] ,  $idx, $rules)    )   {
//__debug_print("db_query_go for_detect. PCI 2- " . $dcd5['st_id'] );
				return true;
			}
		}
	}
        else if( $dcd5['department'] == 'oms'  )    {   //oms case
//__debug_print("db_query_go for_detect. PCI 0 " . $dcd5['st_id'] );
		for($idx=1; $idx<=4 ; $idx++)  {
//__debug_print("db_query_go for_detect. PCI1 - ".$dcd5['st_id']. '-' . $rules['perio_chiot']['latest_perio_chiot'][$idx]['apply_info_uid'].'-'.  $dcd5['apply_info_uid'] );
			if( $rules['oms']['latest_oms'][$idx]['apply_info_uid'] == $dcd5['apply_info_uid'] &&  isWithinRuleRange($dcd5['st_id'],  $dcd5['department'], $dcd5['is_perio_surgery'],  $dcd5['apply_info_uid'] ,  $idx, $rules)    )   {
//__debug_print("db_query_go for_detect. PCI 2- " . $dcd5['st_id'] );
				return true;
			}
		}
	}
        else if( $dcd5['department'] == 'radio'  )    {   //radio case
//__debug_print("db_query_go for_detect. PCI 0 " . $dcd5['st_id'] );
		for($idx=1; $idx<=4 ; $idx++)  {
//__debug_print("db_query_go for_detect. PCI1 - ".$dcd5['st_id']. '-' . $rules['perio_chiot']['latest_perio_chiot'][$idx]['apply_info_uid'].'-'.  $dcd5['apply_info_uid'] );
			if( $rules['radio']['latest_radio'][$idx]['apply_info_uid'] == $dcd5['apply_info_uid'] &&  isWithinRuleRange($dcd5['st_id'],  $dcd5['department'], $dcd5['is_perio_surgery'],  $dcd5['apply_info_uid'] ,  $idx, $rules)    )   {
//__debug_print("db_query_go for_detect. PCI 2- " . $dcd5['st_id'] );
				return true;
			}
		}
	}

	
	return false;
}

function isAllMandatoryTime( $dcd4 , $rules)  {
	foreach($dcd4 as $dcd5)  {  // each infos uid
		if ( !isMandatoryTime($dcd5, $rules) ) return false;
	}	
	return true;
} 

function haveHalf( $uid, $dcd3, $rules)  {
__debug_print("db_query_go for_detect. HH " . $uid );
                                $a_flag = 0;
                                //count of date_end to detect if it is last chasu
                                $len = count($dcd3);
                                foreach($dcd3 as $dcd4)    { // infos each date_end
                                                foreach($dcd4 as $dcd5)  {  // each infos uid
                                                        if ($a_flag > 0 && $dcd5['department'] != 'etc' && !isMandatoryTime($dcd5, $rules)  )  {
__debug_print("db_query_go for_detect. HH 3" . $dcd5['st_id']  );
								return true;
                                                        }

                                                        if ($dcd5['uid'] == $uid   )  {
__debug_print("db_query_go for_detect. HH 5" . $uid );
                                                                $a_flag = 1;
                                                        }
                                        	}


                        	}
			return false;
}
        include_once $g['path_module'].'khusd_st_manager/function/date.php';
                echo  "HIHI"."<br>";
                echo $date['today']."<br>";
                //$oldday = time()-60*60*24*3;
                $oldday = time()-60*60*24*2;
                $oldday = time();
                $start_code = ( 12 - date("w",$oldday ) )%7 - 4 ;
                echo "if today is "."<br>";
                echo date("Ymd", $oldday).'000000'."<br>";
                echo date("Ymd", $oldday+60*60*24*$start_code).'000000~~';
                echo date("Ymd", $oldday+60*60*24*($start_code+5))."235959<br>";

	$rules['MandatoryTime'] = $MandatoryTime;
	$rules['selection'] = $d['khusd_st_manager']['selection'];

	$rules['perio_surgery']['latest_perio_surgery'] = $latest_perio_surgery ;
	$rules['perio_surgery']['perio_surgery_on'] =  $perio_surgery_on;
	$rules['perio_surgery']['perio_surgery_selection'] = $perio_surgery_selection;
	$rules['perio_surgery']['perio_surgery_num_apply'] = $perio_surgery_num_apply;

	$rules['perio_chiot']['latest_perio_chiot'] = $latest_perio_chiot ;
	$rules['perio_chiot']['perio_chiot_on'] =  $perio_chiot_on;
	$rules['perio_chiot']['perio_chiot_selection'] = $perio_chiot_selection;
	$rules['perio_chiot']['perio_chiot_num_apply'] = $perio_chiot_num_apply;

	$rules['oms']['latest_oms']    = $latest_oms ;
	$rules['oms']['oms_on']        =  $oms_on;
	$rules['oms']['oms_selection'] = $oms_selection;
	$rules['oms']['oms_num_apply'] = $oms_num_apply;

	$rules['radio']['latest_radio']    = $latest_radio ;
	$rules['radio']['radio_on']        =  $radio_on;
	$rules['radio']['radio_selection'] = $radio_selection;
	$rules['radio']['radio_num_apply'] = $radio_num_apply;

        foreach($Duplicate_Check_Dic as $dcd1)  // each st_id
                foreach($dcd1 as $dcd2)         // items each day
                        foreach($dcd2 as $dcd3)    { // items each time
                                //sort($dcd3 ) 1st try;
                                //ksort to order by date_end
                                ksort($dcd3, SORT_NUMERIC ) ;
                                $a_flag = 0;
				$g_flag = 0;
                                $i = 0;
                                //count of date_end to detect if it is last chasu
                                $len = count($dcd3);
                                foreach($dcd3 as $dcd4)    { // infos each date_end
                                        if( count($dcd4)>= 2 )  { //same date_end multiple uid
                                                $prefix = '<span style="color:blue;">each google-';
						if (  isAllMandatoryTime($dcd4, $rules)  )  
                                                                //$prefix='<span style="color:black;">each normal-';
                                                		$prefix = '<span style="color:gray;">each google-';
                                                foreach($dcd4 as $dcd5)  {  // each infos uid
                                                        if( $dcd5['department']=='etc'  )
                                                                $prefix='<span style="color:gray;">each normal-';
                                                                //$prefix='<span style="color:black;">each normal-';

                                                        format_print($dcd5, $prefix  );
                                                }
                                        }
                                        else  {    // one date_end
                                                foreach($dcd4 as $dcd5)  {  // each infos uid
                                                        $prefix='<span style="color:black;">each normal-';
                                                        if ($a_flag > 0 && $dcd5['department'] != 'etc' && !isMandatoryTime($dcd5, $rules)  )  {
                                                                $prefix = '<span style="color:blue;">echo talk---';
                                                        }
							else if( $g_flag > 0)  
                                                                $prefix = '<span style="color:gray;">echo talk---';

                                                        // if it is not last date_end , evenif 'a' case, no duplicate possibility
                                                        if ($dcd5['status'] == 'a' && $i != $len-1 && $dcd5['department'] != 'etc' && haveHalf($dcd5['uid'], $dcd3, $rules)  )  {
                                                        //if ($dcd5['status'] == 'a' && $i != $len-1 && $dcd5['department'] != 'etc'   )  {
                                                                $a_flag = 1;
                                                                $prefix = '<span style="color:blue;">each kakao--';
                                                        }
							else if( $dcd5['status'] == 'a' && $i != $len-1 )  {
								$g_flag = 1;
                                                                $prefix = '<span style="color:gray;">each kakao--';
							}
                                                        format_print($dcd5, $prefix);
                                        }


                                }  //one date_end
                        $i++;
                        }
              }

	?>
	<?php else:?>
	Under Construction
        <?php endif?>


</div>
