<div id="apply_info_view" class="khusd_st view apply">

	<?php getWidget('khusd/my_apply_manager',array('recnum'=>'5',))?>

	<div class="viewbox">
		<div class="icon hand" onclick="getMemberLayer2('<?php echo $APPLY_INFO['mbruid']?>',event);"><?php if($g['member']['photo']):?><img src="<?php echo $g['url_root']?>/_var/simbol/<?php echo $g['member']['photo']?>" alt="" /><?php endif?></div>
		<div class="subject">
			<h1>
			<?php if($dept_array[$APPLY_INFO['department']]):?>
				<?php echo $dept_array[$APPLY_INFO['department']]['name']?>
				 - 
			<?php endif?>
			<?php echo $APPLY_INFO['subject']?></h1>
		</div>
		<div class="info">
			<div class="xleft">
				<span class="han"><?php echo $APPLY_INFO['name']?></span>
				<span class="split">|</span>
				<?php echo getDateFormat($APPLY_INFO['date_reg'],'Y-m-d H:i:s')?>
				<span class="split">|</span>
				<span class="han">신청 수 제한</span>
				<span class="num highlight"><?php echo $APPLY_INFO['apply_limit']?></span>
				<span class="split">|</span>
				<span class="han">선정 방식</span>
				<span class="num highlight"><?php if($APPLY_INFO['apply_type'] == 'rand'):?>랜덤<?php elseif($APPLY_INFO['apply_type'] == 'fcfs'):?>선착순<?php endif?></span>
			</div>
			<div class="xleft">
				<span class="split">|</span>
				<span class="han">이 신청은 </span>
				<span class="han highlight">이전 당첨 수</span>
				<span class="han"> 만큼 </span>
				<span class="han highlight">'신청 수 제한'</span>
				<span class="han">에서 </span>
				<span class="han highlight">
				차감이 
				<?php if($APPLY_INFO['able_apply_accepted'] == 'y'):?>
				안됩니다. (즉, 또 신청 가능)
				<?php else:?>
				됩니다. (즉, 당첨수 제외하고 신청 가능)
				<?php endif?>
				</span>
			</div>
		</div>
		<div id="vContent" class="content"><?php echo getContents($APPLY_INFO['content'], '')?></div>
	</div>
	
	<div class="bottom">
		<?php if($APPLY_INFO['is_perio_surgery'] == 'y'):?>
		<span class="btn00">
			<a href="<?php echo $g['perio_surgery_timetable'].$APPLY_INFO['uid']?>">치주수술 출석부</a>
		</span>
		<?php endif?>

		<?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['OPEN'] && ($MANAGER || $APPLY_INFO['st_id'] == $my['id'])):?>
		<span class="btn00">
			<?php if($APPLY_INFO['apply_type'] == 'rand'):?>
			<a href="<?php echo $g['apply_info_select_random'].$APPLY_INFO['uid']?>" onclick="return confirm('마갑하시겠습니까?');">마감하기</a>
			<?php elseif($APPLY_INFO['apply_type'] == 'fcfs'):?>
			<a href="<?php echo $g['apply_info_select_fcfs'].$APPLY_INFO['uid']?>" onclick="return confirm('마갑하시겠습니까?');">마감하기</a>
			<?php endif?>
		</span>
		<?php endif?>
		<?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['CLOSED'] && ($MANAGER || $APPLY_INFO['st_id'] == $my['id'])):?>
		<span class="btn00">
			<a href="<?php echo $g['apply_info_add_2nd_apply'].$APPLY_INFO['uid']?>" onclick="return confirm('추가 신청을 받으시겠습니까?');">추가신청 생성</a>
		</span>
		<?php endif?>
		<?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['OPEN'] && ($MANAGER || $APPLY_INFO['st_id'] == $my['id'])):?>
		<span class="btn00">
			<a href="<?php echo $g['apply_info_modify'].$APPLY_INFO['uid']	?>">수정</a>
		</span>
		<span class="btn00">
			<a href="<?php echo $g['apply_info_del'].$APPLY_INFO['uid']?>" onclick="return confirm('정말로 삭제하시겠습니까?');">삭제</a>
		</span>
		<?php endif?>
		<span class="btn00">
			<a href="<?php echo $g['apply_info_list']?>">목록으로</a>
		</span>
	</div>
	
	<div class="item">
		항목 <span id="item_num1"><?php echo $ITEM_NUM?></span>개
		<span class="split">|</span>
		<?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['CLOSED']):?>
		<span  class="highlight">마감</span>
		<span class="split">|</span>
						<?php endif?>
		신청 시작 <span<?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['OPEN']):?> class="highlight"<?php endif?>><?php echo getDateFormat($APPLY_INFO['date_start'],'Y-m-d H:i:s')?></span>
		<span class="split">|</span>
		마감 시각 <span<?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['OPEN']):?> class="highlight"<?php endif?>><?php echo getDateFormat($APPLY_INFO['date_end'],'Y-m-d H:i:s')?></span>
		<span class="split">|</span>
		<?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['CLOSED']):?>
		실제마감시각 <span class="highlight"><?php echo getDateFormat($APPLY_INFO['date_select'],'Y-m-d H:i:s')?></span>
		<span class="split">|</span>
		<?php endif?>
		서버 시각 <span class="highlight"><?php echo getDateFormat($date['totime'],'Y-m-d H:i:s')?></span>
	</div>
	<div id="apply_item_list" class="khusd_st item apply">
		<table summary="신청 항목 리스트입니다.">
			<caption>신청 항목 리스트</caption>
			<colgroup>
				<col>
				<col width="30">
				<col width="30">
				<col width="30">
				<col width="30">
				<col width="30">
				<col width="60">
			</colgroup>
			<thead>
				<tr>
					<th scope="col" class="side1">신청 내용</th>
					<th scope="col">총 가능 인원</th>
					<th scope="col">유효 신청 인원</th>
					<th scope="col">당첨 인원</th>
					<th scope="col">상태</th>
					<th scope="col" class="side2">신청</th>
				</tr>
			</thead>
			<tbody>
				<!-- '$is_applicable' can have the following values -->
				<!--  0: not started yet -->
				<!--  1: applicable -->
				<!--  2: ended -->
				<?php
				if($APPLY_INFO['date_start'] > $date['totime']) {
					$is_applicable = 0;
				} elseif($APPLY_INFO['date_end'] < $date['totime']) {
					$is_applicable = 2;
				} else {
					$is_applicable = 1;
				}
				?>
				<?php foreach($ITEM_ARRAY as $ITEM):?>
				<tr>
					<td class="sbj">
						<?php if($MANAGER || $APPLY_INFO['st_id'] == $my['id']):?>
						<a href="<?php echo $g['apply_item_del'].$ITEM['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('삭제하시겠습니까?')">
						<img src="<?php echo $g['img_core']?>/_public/b_minus.gif" alt="삭제" title="삭제" />
						</a>
						<?php endif?>
						<?php if($APPLY_INFO['apply_type'] != 'rand' || $MANAGER || $APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['CLOSED']):?>
							<a href="javascript:applierListWindow('<?php echo $g['apply_item_applier'].$ITEM['uid']?>');"><?php echo $ITEM['content']?></a>
						<?php else:?>
							<?php echo $ITEM['content']?>
						<?php endif?>
						<?php if($ITEM['is_imp_cent'] == 1):?>
							<span class="num highlight">[임플란트 센터]</span>
						<?php endif?>
					</td>
					<td>
					<?php echo $ITEM['accept_limit'] == 0 ? '무제한' : $ITEM['accept_limit']?>
					</td>
					<td>
					<?php echo $ITEM['valid_apply_num']?>
					</td>
					<td>
					<?php echo $ITEM['accepted_num']?>
					</td>
					<td<?php if($ITEM['valid_applied'] || $ITEM['accepted']):?> class="valid_applied"<?php endif?>>
					<?php if($ITEM['accepted']):?>
					당첨
					<?php elseif($ITEM['valid_applied'] && $APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['CLOSED']):?>
					탈락
					<?php else:?>
					<?php echo $ITEM['valid_applied'] ? '유효신청' : ($ITEM['applied'] ? '무효신청' : '미신청')?></td>
					<?php endif?>
					<td>
						<?php if($ITEM['accept_limit'] > 0 && $ITEM['accepted_num'] >= $ITEM['accept_limit']):?>
						마감
						<?php else:?>
						<span class="btn00">
							<?php if(!$ITEM['valid_applied'] && $APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['OPEN']):?>
								<?php if($is_applicable == 1):?>
								<a href="<?php echo $g['apply_item_apply'].$ITEM['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 신청하시겠습니까?')">신청</a>
								<?php else:?>
								신청
								<?php endif?>
							<?php elseif($ITEM['valid_applied'] && $APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['OPEN']):?>
								<?php if($is_applicable == 1):?>
								<a href="<?php echo $g['apply_item_apply_cancel_via_item'].$ITEM['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 취소하시겠습니까?')">취소</a>
								<?php else:?>
								취소
								<?php endif?>
							<?php endif?>
						</span>
						<?php endif?>
					</td>
				</tr>
				<?php endforeach?>
			</tbody>
			
		</table>
	</div>
	
	<?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['OPEN'] && ($MANAGER || $APPLY_INFO['st_id'] == $my['id'])):?>
	<div id="item_add" class="wrbox">
		<form name="writeForm" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return writeCheck(this);">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="a" value="item_add" />
			<input type="hidden" name="m" value="<?php echo $m?>" />
			<input type="hidden" name="uid" value="<?php echo $APPLY_INFO['uid']?>" />
			<input type="hidden" name="c" value="<?php echo $c?>" />
			<input type="hidden" name="ref_uid" value="" />
		
			<div class="box">
				
				<div class="tt">
					항목 추가
					<span>- 신청 받을 새로운 항목을 입력해주세요.</span>
				</div>
				
				<div class="inputbox">
					<div>
						<input type="number" name="accept_limit" class="input1" /> <span>(최대 수용 인원, 0이면 제한 없음)</span>
					</div>
					<div>
						<input type="text" name="content" class="input2" maxlength="90" /> <span>(내용)</span>
					</div>
					<?php if($APPLY_INFO['is_perio_surgery'] == 'y'):?>
					<div>
						<input type="text" name="s_date" class="input1" value="<?php echo $_SESSION['last_apply_item_s_date']?>" /> <span>날짜 (20140505 형식으로... 꼭 8자리 숫자)</span>
					</div>
					<div>
						<input type="text" name="s_time" class="input1" /> <span>시간 (0903 형식으로... 꼭 4자리 숫자)</span>
					</div>
					<div>
						<input type="text" name="pt_name" class="input1" /> <span>환자이름</span>
					</div>
					<div>
						<select name="doctor">
							<option value="-">-</option>
							<?php foreach($d['khusd_st_apply_manager']['perio_sur']['doctor']['prof'] as $doctor):?>
							<option value="<?php echo $doctor?>"><?php echo $doctor?></option>
							<?php endforeach?>
							<?php foreach($d['khusd_st_apply_manager']['perio_sur']['doctor']['doctor'] as $doctor):?>
							<option value="<?php echo $doctor?>"><?php echo $doctor?></option>
							<?php endforeach?>
						</select>
						<span>술자이름</span>
					</div>
					<div>
						<select name="assist">
							<option value="-">-</option>
							<?php foreach($d['khusd_st_apply_manager']['perio_sur']['doctor']['doctor'] as $doctor):?>
							<option value="<?php echo $doctor?>"><?php echo $doctor?></option>
							<?php endforeach?>
						</select>
						<span>수련의 어시이름</span>
					</div>
					<div>
						<input type="checkbox" name="is_imp_cent" value="1"> 임플란트 센터 수술인 경우 체크해 주세요.
					</div>
					<?php endif?>
				</div>
				
				<div class="bottom">
					<div class="r">
						<input type="submit" value="추가" class="btnblue">
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		</form>
	</div>
	<?php endif?>
	
</div>
<script type="text/javascript">
//<![CDATA[
function applierListWindow(url)
{
	window.open(url, '', 'left=0, top=0, width=700px height=600px, statusbar=no, scrollbars=yes, toolbar=yes');
}
//]]>
</script>