<div id="ortho_follow" class="khusd_st follow ortho">

<h2>통합 F/U 환자 관리</h2>

	<?php if($MY_FOLLOW_ARRAY && is_array($MY_FOLLOW_ARRAY) && count($MY_FOLLOW_ARRAY) > 0):?>
	<div id="follow_list">
		<table>
			<thead>
				<tr>
					<th>번호</th>
					<th>병록번호</th>
					<th>환자명</th>
					<th>진료과</th>
					<th>담당의</th>
					<th>팔로우 타입</th>
					<th>팔로우 상태</th>
					<th>업데이트 날짜</th>
					<th>포기</th>
				</tr>
			</thead>
			<tbody>
				<?php $idx = 1?>
				<?php foreach($MY_FOLLOW_ARRAY as $MY_FOLLOW):?>
				<tr>
					<td><?php echo $idx++?></td>
					<td><a href="<?php echo $g['khusd_st_follow_search'].$MY_FOLLOW['pt_id']?>"><?php echo $MY_FOLLOW['pt_id']?></a></td>
					<td><a href="<?php echo $g['khusd_st_follow_search'].$MY_FOLLOW['pt_id']?>"><?php echo $MY_FOLLOW['pt_name']?></a></td>
					<td><?php echo $d['khusd_st_follow']['DEPT'][$MY_FOLLOW['department']]?></td>
					<td><?php echo $MY_FOLLOW['dr_name']?></td>
					<td><?php echo $d['khusd_st_follow']['FW_TYPE'][$MY_FOLLOW['department']][$MY_FOLLOW['fw_type']]?></td>
					<td>
						<?php if($MY_FOLLOW['status'] == $d['khusd_st_follow']['STATUS']['FOLLOWING']):?>
						팔로우 중
						<?php elseif($MY_FOLLOW['status'] == $d['khusd_st_follow']['STATUS']['COMPLETE']):?>
						팔로우 완료
						<?php else:?>
						팔로우 중단
						<?php endif?>
					</td>
					<td><?php echo getDateFormat($MY_FOLLOW['date_update'], 'Y-m-d H:i')?></td>
					<td>
						<?php if($MY_FOLLOW['status'] != $d['khusd_st_follow']['STATUS']['DROP']):?>
						<span class="btn00"><a href="<?php echo $g['khusd_st_follow_drop'].$MY_FOLLOW['uid']?>">포기하기</a></span>
						<?php endif?>
					</td>
				</tr>
				<?php endforeach?>
			</tbody>
		</table>
	</div>
	<?php endif?>

	<form name="searchFollow" method="get" action="<?php echo $g['s']?>/" onsubmit="return updateCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	<input type="hidden" name="mode" value="follow" />
	
	<div id="searchFollow">
		환자명 혹은 병록번호 : <input type="text" name="nameOrId" maxlength="20" class="input" value="<?php echo $nameOrId?>">
		<input type="submit" value="검색" class="btnblue" />
	</div>
	</form>
	
	<div id="followList">
		<?php if(isset($nameOrId) && $nameOrId):?>
		<p><?php echo $nameOrId?> 님에 대한 검색 결과 : </p>
		<?php endif?>
		
		<?php if(isset($nameOrId) && $nameOrId && $nameOrId != '' && !$FOLLOW_PT):?>
			해당 환자는 F/U 목록에 없습니다. 등록하시겠습니까?
			<form name="addFollow" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="a" value="add_follow" />
			<input type="hidden" name="c" value="<?php echo $c?>" />
			<input type="hidden" name="m" value="<?php echo $m?>" />
			
			<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
			<div id="ptInfoInput">
				<p>
					이름 : <input type="text" name="pt_name"  class="input" value="<?php echo $nameOrId?>" />
				</p>
				<p>
					병록번호 : <input type="text" name="pt_id" class="input" value="<?php echo $nameOrId?>" />
				</p>
				<p>
					진료과 : 
					<select name="department" id="department" class="input">
						<option value='def'>-Select Department-</option>
						<?php foreach($d['khusd_st_follow']['DEPT'] as $dept):?>
						<option value="<?php echo $dept?>"><?php echo $dept?></option>
						<?php endforeach?>
					</select>
				</p>
				<p>
					담당의 : 
					<div id="dr_def" class="dr_name"  name="sub_dr" onchange="ChangeDropdowns(this.value)">
						<select name="dr_name" id="dr_name" class="input">
							<option value=''>Select</option>
						</select>
					</div>
					<?php foreach($d['khusd_st_follow']['DEPT'] as $dept):?>
					<div id="<?php echo 'dr_'.$dept?>" class="dr_name"  style="display: none;" name="sub_dr" onchange="ChangeDropdowns(this.value)">
						<select name="dr_name" id="<?php echo 'dr_'.$dept?>" class="input">
							<?php foreach($d['khusd_st_follow']['DR'][$dept] as $dr):?>
							<option value="<?php echo $dr?>"><?php echo $dr?></option>
							<?php endforeach?>
						</select>
					</div>
					<?php endforeach?>
				</p>
				<p>
					팔로우 타입 :
					<div id="fw_def" class="fw_type" name="sub_fw" onchange="ChangeDropdowns(this.value)">
						<select name="fw_type" id="fw_type" class="input">
							<option value=''>Select</option>
						</select>
					</div>
					<?php foreach($d['khusd_st_follow']['DEPT'] as $dept):?>
					<div id="<?php echo 'fw_'.$dept?>" class="fw_type"  style="display: none;" name="sub_fw" onchange="ChangeDropdowns(this.value)">
						<select name="fw_type" id="<?php echo 'fw_'.$dept?>" class="input">
							<?php foreach($d['khusd_st_follow']['FW_TYPE'][$dept] as $fw):?>
							<option value="<?php echo $fw?>"><?php echo $fw?></option>
							<?php endforeach?>
						</select>
					</div>
					<?php endforeach?>
				</p>
			
				<input type="submit" value="등록" class="btnblue" />
			</div>
			</form>
			
		<?php elseif($FOLLOW_PT):?>
		
			<div id="add_follow">
			
			<p><b>동명 이인이 검색된 경우, 병록번호로 검색하여 팔로 환자를 추가하세요.</b></p>

			</div>
		
			<?php if(!$ABLE_FOLLOW):?>
			<form name="editFollowPt" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="a" value="edit_follow" />
			<input type="hidden" name="c" value="<?php echo $c?>" />
			<input type="hidden" name="m" value="<?php echo $m?>" />
			
			<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
			<input type="hidden" name="pt_id" value="<?php echo $FOLLOW_PT['pt_id']?>" />
			<?php endif?>
			<table>
				<tr>
					<td>환자명</td>
					<td>
						<?php if(!$ABLE_FOLLOW):?>
						<input type="text" name="pt_name" value="<?php echo $FOLLOW_PT['pt_name']?>" />
						<?php else:?>
						<?php echo $FOLLOW_PT['pt_name']?>
						<?php endif?>
					</td>
				</tr>
				<tr>
					<td>병록번호</td>
					<td>
						<?php echo $FOLLOW_PT['pt_id']?>
					</td>
				</tr>
				<tr>
					<td>진료과</td>
					<td>
						<?php if(!$ABLE_FOLLOW):?>
						<select name="department" id="department" class="input">
							<option value='def'>-Select Department-</option>
							<?php foreach($d['khusd_st_follow']['DEPT'] as $dept):?>
							<option value="<?php echo $dept?>"
								<?php if($dept==$FOLLOW_PT['department']){ echo 'selected'; }?>
							>
								<?php echo $dept?>
							</option>
							<?php endforeach?>
						</select>
						<?php else:?>
						<?php echo $FOLLOW_PT['department']?>
						<?php endif?>
					</td>
				</tr>
				<tr>
					<td>담당의</td>
					<td>
						<?php if(!$ABLE_FOLLOW):?>
						<div id="dr_def" class="dr_name" <?php if($FOLLOW_PT['department']!=''){ echo "style='display: none;'";}?> name="sub_dr" onchange="ChangeDropdowns(this.value)">
							<select name="dr_name" id="dr_name" class="input">
								<option value=''>Select</option>
							</select>
						</div>
						<?php foreach($d['khusd_st_follow']['DEPT'] as $dept):?>
						<div id="<?php echo 'dr_'.$dept?>" class="dr_name" <?php if($FOLLOW_PT['department']!=$dept){ echo "style='display: none;'";}?> name="sub_dr" onchange="ChangeDropdowns(this.value)">
							<select name="dr_name" id="<?php echo 'dr_'.$dept?>" class="input">
								<?php foreach($d['khusd_st_follow']['DR'][$dept] as $dr):?>
								<option value="<?php echo $dr?>" <?php if($dr==$FOLLOW_PT['dr_name']){ echo 'selected'; }?>><?php echo $dr?></option>
								<?php endforeach?>
							</select>
						</div>
						<?php endforeach?>
						<?php else:?>
						<?php echo $FOLLOW_PT['dr_name']?>
						<?php endif?>
					</td>
				</tr>
				<tr>
					<td>팔로우 타입</td>
					<td>
						<?php if(!$ABLE_FOLLOW):?>
						<div id="fw_def" class="fw_type" <?php if($FOLLOW_PT['department']!=''){ echo "style='display: none;'";}?> name="sub_fw" onchange="ChangeDropdowns(this.value)">
							<select name="fw_type" id="fw_type" class="input">
								<option value=''>Select</option>
							</select>
						</div>
						<?php foreach($d['khusd_st_follow']['DEPT'] as $dept):?>
						<div id="<?php echo 'fw_'.$dept?>" class="fw_type" <?php if($FOLLOW_PT['department']!=$dept){ echo "style='display: none;'";}?> name="sub_fw" onchange="ChangeDropdowns(this.value)">
							<select name="fw_type" id="<?php echo 'fw_'.$dept?>" class="input">
								<?php foreach($d['khusd_st_follow']['FW_TYPE'][$dept] as $fw):?>
								<option value="<?php echo $fw?>" <?php if($fw==$FOLLOW_PT['fw_type']){ echo 'selected'; }?>><?php echo $fw?></option>
								<?php endforeach?>
							</select>
						</div>
						<?php endforeach?>
						<?php endif?>
					</td>
				</tr>
				<?php if(!$ABLE_FOLLOW):?>
				<tr>
					<td colspan="2">
						<input type="submit" value="수정" class="btnblue" />
					</td>
				</tr>
				<?php else:?>
				<form name="addFollow" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
				<tr>
					<input type="hidden" name="r" value="<?php echo $r?>" />
					<input type="hidden" name="a" value="add_follow" />
					<input type="hidden" name="c" value="<?php echo $c?>" />
					<input type="hidden" name="m" value="<?php echo $m?>" />
					
					<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
					<input type="hidden" name="pt_name"  class="input" value="<?php echo $FOLLOW_PT['pt_name']?>" />
					<input type="hidden" name="pt_id" class="input" value="<?php echo $FOLLOW_PT['pt_id']?>" />
		
					<input type="hidden" name="dr_room" class="input" value="<?php echo $FOLLOW_PT['department']?>" />
					<input type="hidden" name="pf_name" class="input" value="<?php echo $FOLLOW_PT['dr_name']?>" />
					<input type="hidden" name="dr_name" class="input" value="<?php echo $FOLLOW_PT['fw_type']?>" />
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="팔로우 추가" class="btnblue" />
					</td>
				</tr>
				</form>
				<?php endif?>
			</table>
			<?php if(!$ABLE_FOLLOW):?>
			</form>
			<?php endif?>
			
			<?php if($FOLLOW_ARRAY):?>
				<table>
				<thead>
					<tr>
						<th>번호</th>
						<th>학번</th>
						<th>이름</th>
						<th>진료과</th>
						<th>담당의</th>
						<th>팔로우 타입</th>
						<th>팔로우 상태</th>
						<th>업데이트 날짜</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $idx = 1?>
					<?php foreach($FOLLOW_ARRAY as $FOLLOW):?>
					<tr>
						<td><?php echo $idx++?></td>
						<td><?php echo $FOLLOW['st_id']?></td>
						<td><?php echo $FOLLOW['st_name']?></td>
						<td><?php echo $FOLLOW['department']?></td>
						<td><?php echo $FOLLOW['dr_name']?></td>
						<td><?php echo $FOLLOW['fw_type']?></td>
						<td><?php echo $d['khusd_st_follow']['FOLLOW'][$FOLLOW['status']]?></td>
						<td><?php echo getDateFormat($FOLLOW['date_update'], 'Y-m-d H:i')?></td>
					</tr>
					<?php endforeach?>
				</tbody>
				</table>
			<?php else:?>
			<?php endif?>
		
		<?php endif?>
	</div>

</div>

<script type="text/javascript">
	$("#department").change(function(){
		correspondingID = $(this).find(":selected").val();
		$(".dr_name").hide();
		$(".fw_type").hide();
		$("#dr_" + correspondingID).show();
		$("#fw_" + correspondingID).show();
	});
</script>