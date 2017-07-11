<div id="ortho_follow_list" class="khusd_st follow ortho">

<h2>교정과 F/U 환자 목록</h2>

	<div id="follow_list">
		<table>
			<thead>
				<tr>
					<th width="35">번호</th>
					<th>환자명</th>
					<th>병록번호</th>
					<th>진료실 번호</th>
					<th>담당교수님</th>
					<th>담당의(수련의)</th>
					<th width="150">학번</th>
					<th>이름</th>
					<th>팔로우 상태</th>
				</tr>
			</thead>
			<tbody>
				<?php $idx = 1?>
				<?php foreach($FOLLOW_ARRAY as $FOLLOWS):?>
				<?php $st_num = count($FOLLOWS)?>
				<?php foreach($FOLLOWS as $FOLLOW):?>
				<tr>
					<td><?php echo $idx++?></td>
					<td><?php echo $FOLLOW['pt_name']?></td>
					<td><?php echo $FOLLOW['pt_id']?></td>
					<td><?php echo $FOLLOW['dr_room']?></td>
					<td><?php echo $FOLLOW['pf_name']?></td>
					<td><?php echo $FOLLOW['dr_name']?></td>

					<td><?php echo $FOLLOW['st_id']?></td>
					<td><?php echo $FOLLOW['st_name']?></td>
					<td>
						<?php if($FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW']['NEW_FOLLOWING']):?>
						신환
						<?php elseif($FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW']['FOLLOWING']):?>
						구환
						<?php else:?>
						중단
						<?php endif?>
					</td>
				</tr>
				<?php endforeach?>
				<?php endforeach?>
			</tbody>
		</table>
	</div>

</div>