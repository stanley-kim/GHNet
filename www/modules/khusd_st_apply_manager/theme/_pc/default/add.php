<div id="apply_info_add" class="khusd_st add apply">

<?php $_idx = 1;
$type0 = $d['khusd_st_apply_manager']['apply_info']['type0']['single'];
$type1 = $d['khusd_st_apply_manager']['apply_info']['type1']['weekday'];
$type2 = '주말6차';
$type3 = '주말6차';
foreach($d['khusd_st_apply_manager']['apply_info']['order_list'] as $_ROW)    {
        if( $_ROW['name'] == $APPLY_INFO['info_order'] )    {
		$type_name = $_ROW['name'];
                $type0 = $_ROW['type0'];
                $type1 = $_ROW['type1'];
                $type2 = $_ROW['type2'];
                if(  $_ROW['type3'] )
                        $type3 = $_ROW['type3'];
                else
                        $type3 = $_ROW['type2'];
        }
}
//ALL_APPLY_INFO is summation of APPLY_INFO and PRE_APPLY_INFO
if( isset($APPLY_INFO) )
        $ALL_APPLY_INFO[ filter_var(  $APPLY_INFO['info_order'] , FILTER_SANITIZE_NUMBER_INT)  ] = $APPLY_INFO;
if( isset($PRE_APPLY_INFO_ROWS)  )
while($ITEM = db_fetch_array($PRE_APPLY_INFO_ROWS))
{
        //$ALL_APPLY_INFO[ $ITEM['info_order'] ] = $ITEM;
        $ALL_APPLY_INFO[ filter_var(  $ITEM['info_order'] , FILTER_SANITIZE_NUMBER_INT)  ] = $ITEM;
        $type3 = $ITEM['info_order'];
}
foreach($d['khusd_st_apply_manager']['apply_info']['order_list'] as $_ROW)    {
        if( $_ROW['type2'] == $type2 && $_ROW['type3'] == $type3)  {
                $type0 = $_ROW['type0'];
		$type_name = $_ROW['name'];
__debug_print("type is - ".'_'.$type_name.'_'.$type0.'_'.$type1.'_'.$type2.'_'.$type3.'_'.mysql_error());

	}
}
 ?>


<h2>신청 추가</h2>

	<form name="addApply" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="<?php echo $mode?>" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	<input type="hidden" name="uid" value="<?php echo $APPLY_INFO['uid']?>" />
	<input type="hidden" name="s_uid" value="<?php echo $s_uid?>" />
	<input type="hidden" name="nlist" value="<?php echo $g['apply_info_list']?>" />
	<input type="hidden" name="cview" value="<?php echo $g['apply_info_view'].$APPLY_INFO['uid']?>" />
	
	<table class="inputTable">
	<thead>
		<tr>
			<th scope="col" width="80"></th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="td1">제목</td>
			<td class="td2">
				<input type="text" name="subject" class="input subject" value="<?php echo $APPLY_INFO['subject']?>" />
			</td>
		</tr>
		<tr>
<td class="td1">차수</td>
			<td class="td2">
	<select name="order">
	<?php foreach( $d['khusd_st_apply_manager']['apply_info']['order_list'] as $_order ):?>
<!--		<option value="<?php echo $_order['name']?>" <?php if($_order['name'] == $APPLY_INFO['info_order']  ) echo 'selected' ?>  ><?php echo $_order['name']?></option>
-->
		<option value="<?php echo $_order['name']?>" <?php if($_order['name'] == $type_name  ) echo 'selected' ?>  ><?php echo $_order['name']?></option>

	<?php endforeach?>
	</select>
		</tr>
		<tr>
			<td class="td1">관련과</td>
			<td class="td2">
				<select name="department">
					<option value="perio"<?php if($APPLY_INFO['department'] == 'perio'):?> selected<?php endif?>>치주과</option>
					<option value="pros"<?php if($APPLY_INFO['department'] == 'pros'):?> selected<?php endif?>>보철과</option>
					<option value="pedia"<?php if($APPLY_INFO['department'] == 'pedia'):?> selected<?php endif?>>소아치과</option>
					<option value="radio"<?php if($APPLY_INFO['department'] == 'radio'):?> selected<?php endif?>>영상과</option>
					<option value="ortho"<?php if($APPLY_INFO['department'] == 'ortho'):?> selected<?php endif?>>교정과</option>
					<option value="consv"<?php if($APPLY_INFO['department'] == 'consv'):?> selected<?php endif?>>보존과</option>
					<option value="oms"<?php if($APPLY_INFO['department'] == 'oms'):?> selected<?php endif?>>구강외과</option>
					<option value="medi"<?php if($APPLY_INFO['department'] == 'medi'):?> selected<?php endif?>>구강내과</option>ㄴ
					<option value="etc"<?php if($APPLY_INFO['department'] == 'etc'):?> selected<?php endif?>>그외</option>
				</select>
				<input type="checkbox" name="is_perio_surgery"<?php if($APPLY_INFO['is_perio_surgery'] == 'y'):?> checked<?php endif?> />치주수술 신청글인 경우 체크
			</td>
		</tr>
		<tr>
			<td class="td1">분류</td>
			<td class="td2">
				<select name="apply_type">
					<option value="rand"<?php if($APPLY_INFO['apply_type'] == 'rand'):?> selected<?php endif?>>랜덤</option>
					<option value="fcfs"<?php if($APPLY_INFO['apply_type'] == 'fcfs'):?> selected<?php endif?>>선착순</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="td1">신청일</td>
			<td class="td2">
				<input type="text" name="start_date" class="input date"   value="<?php if( isset($APPLY_INFO) &&  strlen($APPLY_INFO['date_start'])>0) echo substr($APPLY_INFO['date_start'], 0, 8)?>"  /> 8자리 년월일 방식으로 입력(ex. 20180205)
			</td>
		</tr>

<?php while( $_idx <= 6  )  :?>
		<tr>
			<td rowspan="4" class="td1"><?php echo $_idx?>차</td>
			<td class="td2">신청 시작
				<input type="number" name=start_hour_array[<?php echo $_idx?>] class="input time" value="<?php if( isset($ALL_APPLY_INFO[$_idx]) &&  strlen($ALL_APPLY_INFO[$_idx]['date_start'])>0) echo substr($ALL_APPLY_INFO[$_idx]['date_start'], 8, 2)?>" />시
				<input type="number" name=start_min_array[<?php echo $_idx?>]  class="input time" value="<?php if( isset($ALL_APPLY_INFO[$_idx]) &&     strlen($ALL_APPLY_INFO[$_idx]['date_start'])>0) echo substr($ALL_APPLY_INFO[$_idx]['date_start'], 10, 2)?>" />분
				<span class="help">24시간 표시방식으로 입력 (ex. 14시 10분)</span>
			</td>
		</tr>
		<tr>
			<td class="td2">마감 시각
				<input type="number" name=end_hour_array[<?php echo $_idx?>] class="input time" value="<?php if( isset($ALL_APPLY_INFO[$_idx]) &&    strlen($ALL_APPLY_INFO[$_idx]['date_end'])>0) echo substr($ALL_APPLY_INFO[$_idx]['date_end'], 8, 2)?>" />시
				<input type="number" name=end_min_array[<?php echo $_idx?>] class="input time" value="<?php if( isset($ALL_APPLY_INFO[$_idx])   &&   strlen($ALL_APPLY_INFO[$_idx]['date_end'])>0) echo substr($ALL_APPLY_INFO[$_idx]['date_end'], 10, 2)?>" />분
				<span class="help">24시간 표시방식으로 입력 (ex. 14시 20분)</span>
			</td>
		</tr>
		<tr>
			<td class="td2">신청 수 제한
				<input type="number" name=apply_limit_array[<?php echo $_idx?>]  class="input" value="<?php if (  isset($ALL_APPLY_INFO[$_idx])    )   echo $ALL_APPLY_INFO[$_idx]['apply_limit']?>" />
				<span class="help">한 사람이 신청 가능한 항목 최대 수</span>
			</td>
		</tr>
		<tr>
			<td class="td2">당첨자 추가신청
				이전 신청에서 당첨된 만큼 신청 수 제한에서 차감이 <select name=able_apply_accepted_array[<?php echo $_idx?>]   >
					<option value="n"<?php if($ALL_APPLY_INFO[$_idx]['able_apply_accepted'] == 'n'):?> selected<?php endif?>>된다</option>
					<option value="y"<?php if($ALL_APPLY_INFO[$_idx]['able_apply_accepted'] == 'y'):?> selected<?php endif?>>안된다</option>
				</select>
			</td>
		</tr>
<?php $_idx += 1 ?>
<?php endwhile ?>
		<tr>
			<td class="td1">memo</td>
			<td class="td2">
				<input  name="content" size="100" class="input"><?php echo $APPLY_INFO['content']?></input>
			</td>
		</tr>
	</tbody>
	</table>

	<div class="bottombox">
		<input type="button" value="취소" class="btngray" onclick="cancelCheck();" />
		<input type="submit" value="확인" class="btnblue" />
	</div>
	
	<script>
		// jquery-ui 의 datepicker 사용하여 날짜 입력 받음
		// 이를 위해 스위치에서 jquery-cdn 켜줘야 함
		$(function() {
			$( "#start_date" ).datepicker({
				dateFormat: "yy-mm-dd",
				dayNamesMin: ['일', '월', '화', '수', '목', '금', '토']
			}
			);
			$( "#end_date" ).datepicker({
				dateFormat: "yy-mm-dd",
				dayNamesMin: ['일', '월', '화', '수', '목', '금', '토']
			}
			);
		});
		$(window).load(function() {
			<?php if(strlen($APPLY_INFO['date_start']) >= 8):?>
				$( "#start_date" ).datepicker( "setDate", "<?php echo substr($APPLY_INFO['date_start'], 0, 4).'-'.substr($APPLY_INFO['date_start'], 4, 2).'-'.substr($APPLY_INFO['date_start'], 6, 2)?>" );
			<?php endif?>
			<?php if(strlen($APPLY_INFO['date_end']) >= 8):?>
				$( "#end_date" ).datepicker( "setDate", "<?php echo substr($APPLY_INFO['date_end'], 0, 4).'-'.substr($APPLY_INFO['date_end'], 4, 2).'-'.substr($APPLY_INFO['date_end'], 6, 2)?>" );
			<?php endif?>
		});
	</script>

</div>
