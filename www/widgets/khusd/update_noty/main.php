<div class="widget_update_alarm">

	<?php
		include_once $g['path_module'].'khusd_st_manager/function/date.php';
		include_once $g['path_module'].'khusd_st_manager/var/var.php';	// 필수 인클루드 파일
		
		$mobile = $g['mobile']&&$_SESSION['pcmode']!='Y' ? true : false; //모바일,PC모드구분

		$dept_array = array(
			'radio'	=> 
				array(	'name'	=> '영상과',
						'id'	=> 'radio'
					),
			'ortho' =>
				array(	'name'	=> '교정과',
						'id'	=> 'ortho'
					),
			'pedia' =>
				array(	'name'	=> '소아치과',
						'id'	=> 'pedia'
					),
			'oms' =>
				array(	'name'	=> '구강외과',
						'id'	=> 'oms'
					),
			'perio' =>
				array(	'name'	=> '치주과',
						'id'	=> 'perio'
					),
			'consv' =>
				array(	'name'	=> '보존과',
						'id'	=> 'consv'
					),
			'pros' =>
				array(	'name'	=> '보철과',
						'id'	=> 'pros'
					),
			'medi' =>
				array(	'name'	=> '구강내과',
						'id'	=> 'medi'
					)
		);
				
		$base_date = $base_date ? $base_date : $date['today'];
		$base_date_t = mktimeFromYmd($base_date);
		$mon_t = getMonDateTimestamp($base_date);		// 오늘이 포함된 주의 월요일 구하기
		$sun_t = getSunDateTimestamp($base_date);		// 오늘이 포함된 주의 일요일 구하기

				
		$start_date_t = $mon_t + ($d['khusd_st_manager']['update_check']['start_day'] - 1) * 24 * 60 * 60;
		$start_date_t += $d['khusd_st_manager']['update_check']['start_hour'] * 60 * 60;
		$end_date_t = $mon_t + ($d['khusd_st_manager']['update_check']['end_day'] - 1) * 24 * 60 * 60;
		$end_date_t += $d['khusd_st_manager']['update_check']['end_hour'] * 60 * 60;
		/*
		$start_date_t = $mon_t + ($wdgvar['start_day'] - 1) * 24 * 60 * 60;
		$start_date_t += $wdgvar['start_hour'] * 60 * 60;
		$end_date_t = $sun_t + ($wdgvar['end_day'] - 0) * 24 * 60 * 60;
		$end_date_t += $wdgvar['end_hour'] * 60 * 60;
		*/
		$start_date = date('YmdHis', $start_date_t);
		$end_date = date('YmdHis', $end_date_t);
		
		$start_date_t_2nd = $mon_t + ($d['khusd_st_manager']['update_check_2nd']['start_day'] - 1) * 24 * 60 * 60;
		$start_date_t_2nd += $d['khusd_st_manager']['update_check_2nd']['start_hour'] * 60 * 60;
		$end_date_t_2nd = $mon_t + ($d['khusd_st_manager']['update_check_2nd']['end_day'] - 1) * 24 * 60 * 60;
		$end_date_t_2nd += $d['khusd_st_manager']['update_check_2nd']['end_hour'] * 60 * 60;
		
		$start_date_2nd = date('YmdHis', $start_date_t_2nd);
		$end_date_2nd = date('YmdHis', $end_date_t_2nd);

	?>
	<div class="title">
		<div class="article">
			<a href="#"><span class="name">이번주 업데이트 여부</span></a>
			<span class="stat">(<?=$my['id']?>)</span>
		</div>
		<div class="clear"></div>
	</div>
	
	<ul>
	<?php if($my['id']):?>
	<table class="time_info" style="margin:5px 0; width:100%;text-align: center; display:none;">
		<?php if($mobile):?>
		<tr>
			<td><b>1차: </b><span class="period"><?php echo getDateFormat($start_date, "Y-m-d H:i")?> ~ <?php echo getDateFormat($end_date, "Y-m-d H:i")?></span></td>
		</tr><tr style="display:none">
			<td><b>2차: </b><span class="period"><?php echo getDateFormat($start_date_2nd, "Y-m-d H:i")?> ~ <?php echo getDateFormat($end_date_2nd, "Y-m-d H:i")?></span></td>
		</tr>
		<? else: ?>
		<tr>
			<td><b>1차: </b><span class="period"><?php echo getDateFormat($start_date, "Y-m-d H:i")?> ~ <?php echo getDateFormat($end_date, "Y-m-d H:i")?></span></td>
			<td style="display:none"><b>2차: </b><span class="period"><?php echo getDateFormat($start_date_2nd, "Y-m-d H:i")?> ~ <?php echo getDateFormat($end_date_2nd, "Y-m-d H:i")?></span></td>
		</tr>

		<? endif ?>
	</table>


	<style>
		.update_table{width:100%;}
		.update_table th{color:#343434;background: #FFFFFF; padding:5px 0;font-weight:normal;border-bottom:1px dotted #efefef;}
		.update_table td{text-align:center; padding:5px;height:24px; border-bottom:1px dotted #efefef;}
		.update_table td.notyet{ color:red}
		.update_table td.notyet a{background: #FDF5E6; padding:5px; color:red;}
		<?php if($mobile):?>
		.update_table td{ background: #FFFFFF; text-decoration: none;}
		.update_table td.update_info{ background: #FDF5E6; text-decoration: none;}
		
		<?endif?>
	</style>
	<table class="update_table" border=0 padding=0 cellspacing=0>
		<?php if($mobile):?>
		<colgroup>
            <col width=30 />
            <col width=50 />
            <col width=30 />
            <col width=50 />
        </colgroup>
		<thead>
			<tr>
				<th colspan=4>과이름 클릭 시 정보수정으로 이동합니다.</th>
			</tr>

			<tr style="display: none;">
<!--				<th>&nbsp;</th>
				<th>1차</th>-->
				<th colspan=4>업데이트 가능 시간: <span class="period" style="font-weight:normal"><?php echo getDateFormat($start_date, "Y-m-d H:i")?> ~ <?php echo getDateFormat($end_date, "Y-m-d H:i")?></span></th>

				<!--<th>2차</th>-->
			</tr>
		</thead>
		<tbody>
			<?php $IDX = 0; ?>
			<?php foreach( $dept_array as $dept ):?>
			<? if($IDX % 2 == 0):?>
			<tr>
			<? endif ?>
				<td><a  style="color:#32548D;font-weight:bold; text-decoration: underline" href="<?php echo RW('m=khusd_st_'.$dept['id'].'&mode=update&n_page=home')?>" class="go_update"><?php echo $dept['name'];?></a></td>
			<?php
				$dept_id = $dept['id'];
		
				$NUM = getDbRows($table['khusd_st_'.$dept_id.'score'], 
					"st_id = '".$my['id']."' order by date_update desc limit 1"
					);
				$SCORE = null;
				if($NUM > 0)
				{
					$updated = true;
					$_table = $table['khusd_st_'.$dept_id.'score'];
					$_where = "st_id = '".$my['id']."'";
					$TCD = getDbArray($_table, $_where, '*', 'date_update', 'desc', 0, 0);
					
					while($_R = db_fetch_array($TCD)) {
						$SCORE = $_R;
						break;
					}
				}
				else
				{
					$updated = false;
				}
			?>
			<td class="update_info <?php if(!$updated):?>notyet<?endif?>"><a href="<?php echo RW('m=khusd_st_'.$dept['id'].'&mode=update&n_page=home')?>" class="go_update"><?php if($updated):?><?php echo getDateFormat($SCORE['date_update'], "m/d H:i")?><? else:?>안됨 (하러가기)<? endif?></a></td>
			<?php
				$dept_id = $dept['id'];
		
				$NUM = getDbRows($table['khusd_st_'.$dept_id.'score'], 
					"date_update >= ".$start_date_2nd." AND date_update <= ".$end_date_2nd." AND st_id = '".$my['id']."'"
					);
				$SCORE = null;
				if($NUM > 0)
				{
					$updated = true;
					$_table = $table['khusd_st_'.$dept_id.'score'];
					$_where = "date_update >= ".$start_date_2nd." AND date_update <= ".$end_date_2nd." AND st_id = '".$my['id']."'";
					$TCD = getDbArray($_table, $_where, '*', 'date_update', 'desc', 0, 0);
					
					while($_R = db_fetch_array($TCD)) {
						$SCORE = $_R;
						break;
					}
				}
				else
				{
					$updated = false;
				}
			?>
			<td  style="display:none" <?php if(!$updated):?>class="notyet"<?endif?>><?php if($updated):?>업데이트 됨<?php echo getDateFormat($SCORE['date_update'], "m/d H:i")?><? else:?><a href="<?php echo RW('m=khusd_st_'.$dept['id'].'&mode=update&n_page=home')?>" class="go_update">안됨 (하러가기)</a><? endif?></td>	
			<? if($IDX % 2 == 1):?>
			</tr>
			<? endif ?>
			<?php $IDX++; ?>
			<?php endforeach?>
		</tbody>
		<? else: ?>
		<thead>
			<tr>
				<th>&nbsp;</th>
				<?php foreach( $dept_array as $dept ):?>
				<th style="color:#32548D;font-weight:bold;"><?php echo $dept['name'];?></th>
				<?php endforeach?>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="padding:2px 0;"><b>&nbsp;</b></td>
				<?php foreach( $dept_array as $dept ):?>
					<td style="text-decoration: underline; padding:2px 0;"><a href="<?php echo RW('m=khusd_st_'.$dept['id'].'&mode=update&n_page=home')?>" class="go_update">업데이트 하기</a></td>
				<?php endforeach?>
			</tr>

			<tr>
				<td>마지막 업데이트</td>
				<?php foreach( $dept_array as $dept ):?>
				<?php
					$dept_id = $dept['id'];
			
				$NUM = getDbRows($table['khusd_st_'.$dept_id.'score'], 
					"st_id = '".$my['id']."' order by date_update desc limit 1"
					);
				$SCORE = null;
				if($NUM > 0)
				{
					$updated = true;
					$_table = $table['khusd_st_'.$dept_id.'score'];
					$_where = "st_id = '".$my['id']."'";
					$TCD = getDbArray($_table, $_where, '*', 'date_update', 'desc', 0, 0);
					
					while($_R = db_fetch_array($TCD)) {
						$SCORE = $_R;
						break;
					}
				}
				else
				{
					$updated = false;
				}

					/*$NUM = getDbRows($table['khusd_st_'.$dept_id.'score'], 
						"date_update >= ".$start_date." AND date_update <= ".$end_date." AND st_id = '".$my['id']."'"
						);
					$SCORE = null;
					if($NUM > 0)
					{
						$updated = true;
						$_table = $table['khusd_st_'.$dept_id.'score'];
						$_where = "date_update >= ".$start_date." AND date_update <= ".$end_date." AND st_id = '".$my['id']."'";
						$TCD = getDbArray($_table, $_where, '*', 'date_update', 'desc', 0, 0);
						
						while($_R = db_fetch_array($TCD)) {
							$SCORE = $_R;
							break;
						}
					}
					else
					{
						$updated = false;
					}*/
				?>
				<td <?php if(!$updated):?>class="notyet"<?endif?>><a href="<?php echo RW('m=khusd_st_'.$dept['id'].'&mode=update&n_page=home')?>" class="go_update"><?php if($updated):?><?php echo getDateFormat($SCORE['date_update'], "m/d H:i")?><? else:?>안됨 (하러가기)<? endif?></a></td>
				<?php endforeach?>
			</tr>

			<tr  style="display:none">
				<td><b>2차</b></td>
				<?php foreach( $dept_array as $dept ):?>
				<?php
					$dept_id = $dept['id'];
			
					$NUM = getDbRows($table['khusd_st_'.$dept_id.'score'], 
						"date_update >= ".$start_date_2nd." AND date_update <= ".$end_date_2nd." AND st_id = '".$my['id']."'"
						);
					$SCORE = null;
					if($NUM > 0)
					{
						$updated = true;
						$_table = $table['khusd_st_'.$dept_id.'score'];
						$_where = "date_update >= ".$start_date_2nd." AND date_update <= ".$end_date_2nd." AND st_id = '".$my['id']."'";
						$TCD = getDbArray($_table, $_where, '*', 'date_update', 'desc', 0, 0);
						
						while($_R = db_fetch_array($TCD)) {
							$SCORE = $_R;
							break;
						}
					}
					else
					{
						$updated = false;
					}
				?>
				<td <?php if(!$updated):?>class="notyet"<?endif?>><?php if($updated):?>업데이트 됨<?php echo getDateFormat($SCORE['date_update'], "m/d H:i")?><? else:?><a href="<?php echo RW('m=khusd_st_'.$dept['id'].'&mode=update&n_page=home')?>" class="go_update">안됨 (하러가기)</a><? endif?></td>
				<?php endforeach?>
			</tr>
		</tbody>
		<? endif ?>
	</table>
	<?php else:?>
	<li><span>로그인을 하세요.</span></li>
	<?php endif?>
	
	</ul>
</div>
