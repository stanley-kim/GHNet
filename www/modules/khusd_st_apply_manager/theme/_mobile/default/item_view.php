<div id="apply_info_view" class="khusd_st view apply">

	<div class="viewbox">
		<div class="icon hand"></div>
		<div class="subject">
			<h1><?php echo $APPLY_INFO['subject'].' - '.$APPLY_ITEM['content']?></h1>
		</div>
		<div class="info">
			<div class="xleft">
				<?php echo getDateFormat($APPLY_ITEM['date_reg'],'Y-m-d H:i:s')?>
				<span class="split">|</span>
				<span class="han">제한 인원</span>
				<span class="num" id="apply_limit"><?php echo $APPLY_ITEM['accept_limit']?></span>
			</div>
		</div>
	</div>
	
	<div class="bottom">
		<span class="btn00">
			<a href="" onclick="return alert('아직 미지원');">수정</a>
		</span>
		<span class="btn00">
			<a href="" onclick="return confirm('정말로 삭제하시겠습니까? (아직 미지원)');">삭제</a>
		</span>
	</div>
	
	<div class="item">
		신청자 <span id="item_num1"><?php echo count($APPLIER_ARRAY)?></span>명
	</div>
	<div id="apply_item_list" class="khusd_st apply">
		<table summary="신청자 리스트입니다.">
			<caption>신청자 리스트</caption>
			<colgroup>
				<col width="50">
				<col width="100">
				<col width="120">
				<col width="200">
				<col width="200">
				<col width="200">
				<col width="60">
				<col width="60">
			</colgroup>
			<thead>
				<tr>
					<th scope="col" class="side1">번호</th>
					<th scope="col">학번</th>
					<th scope="col">이름</th>
					<?php if($APPLY_INFO['apply_type'] == 'rand'):?>
					<th scope="col">랜덤값</th>
					<?php endif?>
					<th scope="col">신청시간</th>
					<th scope="col">취소시간</th>
					<th scope="col">상태</th>
					<th scope="col" class="side2">취소</th>
				</tr>
			</thead>
			<tbody>
				<?php $idx = 1?>
				<?php $idx_in_limit = 0?>
				<?php foreach($APPLIER_ARRAY as $APPLIER):?>
				<?php 
						$in_limit = false;
						if(
							$APPLIER['status'] == $d['khusd_st_apply_manager']['apply_list']['ACCEPTED']
							||
							( $APPLIER['status']!=$d['khusd_st_apply_manager']['apply_list']['CANCEL']
								&& $APPLIER['status']!=$d['khusd_st_apply_manager']['apply_list']['OVERAPPLY']
								&& $APPLIER['status']!=$d['khusd_st_apply_manager']['apply_list']['EARLY']
								&& $APPLIER['status']!=$d['khusd_st_apply_manager']['apply_list']['LATE']
								// 이 이하는 마감 전 상태에 대한 처리
								&& $APPLIER['date_reg']>=$APPLY_INFO['date_start'] 
								&& $APPLY_ITEM['accept_limit'] > 0 
							)
						)
						{
							$idx_in_limit++;
							if($APPLY_ITEM['accept_limit'] >= $idx_in_limit)
								$in_limit = true;
						}

					if($APPLIER['status'] == $d['khusd_st_apply_manager']['apply_list']['ACCEPTED'])
						$accepted = true;
						?>
				<tr>
					<td><?php echo $idx++?></td>
					<td><?php echo $APPLIER['st_id']?></td>
					<td><?php echo $APPLIER['name']?></td>
					<?php if($APPLY_INFO['apply_type'] == 'rand'):?>
					<td>
						<?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['CLOSED']):?>
						<?php echo $APPLIER['rand']?>
						<?php endif?>
					<?php endif?>
					<td><?php echo getDateFormat($APPLIER['date_reg'],'Y-m-d H:i:s').'&nbsp;&nbsp;&nbsp;'.$APPLIER['timestamp']?></td>
					<td><?php if($APPLIER['date_cancel']) echo getDateFormat($APPLIER['date_cancel'],'Y-m-d H:i:s')?></td>
					<td<?php if($in_limit || $accepted):?> class="highlight"<?php endif?>>
						<?php if($APPLIER['status']==$d['khusd_st_apply_manager']['apply_list']['CANCEL']):?>
							취소
						<?php elseif($APPLIER['status']==$d['khusd_st_apply_manager']['apply_list']['ACCEPTED']):?>
							당첨
						<?php elseif($APPLIER['status']==$d['khusd_st_apply_manager']['apply_list']['OVERAPPLY']):?>
							초과신청(무효)
						<?php elseif($APPLY_INFO['apply_type'] == 'fcfs' && $in_limit):?>
							순위권
						<?php elseif($APPLIER['date_reg'] < $APPLY_INFO['date_start']):?>
							무효신청
						<?php elseif($APPLY_INFO['apply_type'] == 'rand'):?>
							<?php if($APPLY_INFO['status'] == $d['khusd_st_apply_manager']['apply_info']['OPEN']):?>
							후보
							<?php else:?>
							탈락
							<?php endif?>
						<?php else:?>
							순위권 밖
						<?php endif?>
						<?php if($APPLIER['work_manager']):?>
						<p>by <span class="highlight"><?php echo $APPLIER['work_manager']?></span></p>
						<?php endif?>
					</td>
					<td><span class="btn00">
							<?php if($MANAGER && $APPLIER['status'] != $d['khusd_st_apply_manager']['apply_list']['ACCEPTED']):?>
							<a href="<?php echo $g['apply_item_apply_accept'].$APPLIER['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 당첨시키겠습니까?')">당첨</a>
							<?php endif?>
							<?php if($APPLIER['status'] != $d['khusd_st_apply_manager']['apply_list']['CANCEL']
									&& ( $MANAGER
									|| ($APPLY_INFO['status'] != $d['khusd_st_apply_manager']['apply_info']['CLOSED']
									&& $APPLIER['status'] != $d['khusd_st_apply_manager']['apply_list']['ACCEPTED'] 
									&& $APPLIER['st_id'] == $my['id']))):?>
							<a href="<?php echo $g['apply_item_apply_cancel'].$APPLIER['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 취소하시겠습니까?')">취소</a>
							<?php endif?>
						</span>
					</td>
				</tr>
				<?php endforeach?>
			</tbody>
			
		</table>
	</div>
	
</div>
