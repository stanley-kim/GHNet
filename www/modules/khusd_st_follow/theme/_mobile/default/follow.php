<div id="follow_follow" class="khusd_st follow follow">

<h2>통합 F/U 환자 관리</h2>

	<?php if($MY_FOLLOW_ARRAY && is_array($MY_FOLLOW_ARRAY) && count($MY_FOLLOW_ARRAY) > 0):?>
	<div id="follow_list">
		<table>
			<thead>
				<tr>
					<th>번호</th>
					<th><a href="<?php echo getSortingLink2($g['khusd_st_follow_list'], 'pt_id', $om, $order == 'pt_id')?>">병록번호</a></th>
					<th><a href="<?php echo getSortingLink2($g['khusd_st_follow_list'], 'pt_name', $om, $order == 'pt_name')?>">환자명</a></th>
					<th><a href="<?php echo getSortingLink2($g['khusd_st_follow_list'], 'department', $om, $order == 'department')?>">진료과</a></th>
					<th><a href="<?php echo getSortingLink2($g['khusd_st_follow_list'], 'dr_name', $om, $order == 'dr_name')?>">담당의</a></th>
					<th><a href="<?php echo getSortingLink2($g['khusd_st_follow_list'], 'fw_type', $om, $order == 'fw_type')?>">타입</a></th>
					<th><a href="<?php echo getSortingLink2($g['khusd_st_follow_list'], 'step', $om, $order == 'step')?>">횟수</a></th>
					<th><a href="<?php echo getSortingLink2($g['khusd_st_follow_list'], 'status', $om, $order == 'status')?>">상태</a></th>
					<th><a href="<?php echo getSortingLink2($g['khusd_st_follow_list'], 'misc', $om, $order == 'misc')?>">비고</a></th>
					<th>수정</th>
					<th>삭제</th>
				</tr>
			</thead>
			<tbody>
				<?php $idx = 1?>
				<?php foreach($MY_FOLLOW_ARRAY as $MY_FOLLOW):?>
				<tr>
					<td><?php echo $idx++?></td>
					<td><a href="<?php echo $g['khusd_st_follow_search'].$MY_FOLLOW['pt_id']?>"><?php echo $MY_FOLLOW['pt_id']?></a></td>
					<td><a href="<?php echo $g['khusd_st_follow_search'].$MY_FOLLOW['pt_id']?>"><?php echo $MY_FOLLOW['pt_name']?></a></td>
					<td><?php echo $MY_FOLLOW['department']?></td>
					<td><?php echo $MY_FOLLOW['dr_name']?></td>
					<td><?php echo $MY_FOLLOW['fw_type']?></td>
					<td><?php echo $MY_FOLLOW['step']?></td>
					<td><?php echo $d['khusd_st_follow']['STATUS'][$MY_FOLLOW['status']]?></td>
					<td><?php echo $MY_FOLLOW['misc']?></td>
					<td>
						<span class="btn00"><a href="<?php echo $g['khusd_st_follow_modify'].$MY_FOLLOW['uid']?>">수정</a></span>
					</td>
					<td>
						<form name="deleteFollow" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return delCheck(this);">
						<input type="hidden" name="r" value="<?php echo $r?>" />
						<input type="hidden" name="a" value="delete_follow" />
						<input type="hidden" name="c" value="<?php echo $c?>" />
						<input type="hidden" name="m" value="<?php echo $m?>" />
						<input type="hidden" name="uid" value="<?php echo $MY_FOLLOW['uid']?>" />
						<input type="submit" value="삭제"/>
						</form>
					</td>
				</tr>
				<?php endforeach?>
			</tbody>
		</table>
	</div>
	<?php endif?>

	<form name="searchFollow" method="get" action="<?php echo $g['s']?>/" onsubmit="return searchCheck(this);">
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
		<?php if(isset($nameOrId) && $nameOrId && $nameOrId != ''):?>
		<p><?php echo $nameOrId?> 님에 대한 검색 결과 : </p>
		<table>
			<thead>
				<tr>
					<th>원내생</th>
					<th>병록번호</th>
					<th>환자명</th>
					<th>진료과</th>
					<th>담당의</th>
					<th>팔로우 타입</th>
					<th>비고</th>
					<th>추가</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan=8>팔로우 신규 추가</td>
				</tr>
				<tr>
					<form name="addFollow" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return addCheck(this);">
					<input type="hidden" name="r" value="<?php echo $r?>" />
					<input type="hidden" name="a" value="add_follow" />
					<input type="hidden" name="c" value="<?php echo $c?>" />
					<input type="hidden" name="m" value="<?php echo $m?>" />
					<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
					<input type="hidden" name="add_type" value="new" />
					
					<td>
						<?php echo $my['name']?>
					</td>
					<td>
						<input type="text" name="pt_id" style="width:60px" value="<?php echo $nameOrId?>" />
					</td>
					<td>
						<input type="text" name="pt_name" style="width:60px" value="<?php echo $nameOrId?>" />
					</td>
					<td>
						<select name="department" id="department">
							<option value='def'>Select</option>
							<?php foreach($d['khusd_st_follow']['DEPT'] as $dept):?>
							<option value="<?php echo $dept?>"><?php echo $dept?></option>
							<?php endforeach?>
						</select>
					</td>
					<td>
						<div id="dr_def" class="dr_name"  name="sub_dr" onchange="ChangeDropdowns(this.value)">
							<select name="dr_name" id="dr_name">
								<option value=''>Select</option>
							</select>
						</div>
						<?php foreach($d['khusd_st_follow']['DEPT'] as $dept):?>
						<div id="<?php echo 'dr_'.$dept?>" class="dr_name"  style="display: none;" name="sub_dr" onchange="ChangeDropdowns(this.value)">
							<select name="dr_name_<?php echo $dept?>" id="<?php echo 'dr_'.$dept?>">
								<?php foreach($d['khusd_st_follow']['DR'][$dept] as $dr):?>
								<option value="<?php echo $dr?>"><?php echo $dr?></option>
								<?php endforeach?>
							</select>
						</div>
						<?php endforeach?>
					</td>
					<td>
						<div id="fw_def" class="fw_type" name="sub_fw" onchange="ChangeDropdowns(this.value)">
							<select name="fw_type" id="fw_type">
								<option value=''>Select</option>
							</select>
						</div>
						<?php foreach($d['khusd_st_follow']['DEPT'] as $dept):?>
						<div id="<?php echo 'fw_'.$dept?>" class="fw_type"  style="display: none;" name="sub_fw" onchange="ChangeDropdowns(this.value)">
							<select name="fw_type_<?php echo $dept?>" id="<?php echo 'fw_'.$dept?>">
								<?php foreach($d['khusd_st_follow']['FW_TYPE'][$dept] as $fw):?>
								<option value="<?php echo $fw?>"><?php echo $fw?></option>
								<?php endforeach?>
							</select>
						</div>
						<?php endforeach?>
					</td>
					<td>
						<div id="misc_def" class="misc" name="sub_misc" onchange="ChangeDropdowns(this.value)">
							<input type="text" name="misc" id="misc" value="" />
						</div>
						<?php foreach($d['khusd_st_follow']['DEPT'] as $dept):?>
						<div id="<?php echo 'misc_'.$dept?>" class="misc"  style="display: none;" name="sub_misc" onchange="ChangeDropdowns(this.value)">
							<?php if($dept=='consv'):?>
								<select name="misc_<?php echo $dept?>" id="<?php echo 'misc_'.$dept?>">
									<?php foreach($d['khusd_st_follow']['MISC'][$dept] as $mi):?>
									<option value="<?php echo $mi?>"><?php echo $mi?></option>
									<?php endforeach?>
								</select>
							<?php elseif($dept=='ortho'):?>
								Report <input type="checkbox" name="misc_<?php echo $dept?>" value="report"/>
							<?php else:?>
								<input type="text" name="misc_<?php echo $dept?>" id="<?php echo 'misc_'.$dept?>" value="" />
							<?php endif?>
						</div>
						<?php endforeach?>
					</td>
					<td>
						<input type="submit" value="추가" class="btnblue" />
					</td>
					</form>
				</tr>
				<?php if($FOLLOW_ARRAY):?>
					<tr>
						<td colspan=8>팔로우 추가 (기존 정보 사용)</td>
					</tr>
					<?php foreach($FOLLOW_ARRAY as $follow):?>
						<form name="addFollow" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return addCheck(this);">
						<input type="hidden" name="r" value="<?php echo $r?>" />
						<input type="hidden" name="a" value="add_follow" />
						<input type="hidden" name="c" value="<?php echo $c?>" />
						<input type="hidden" name="m" value="<?php echo $m?>" />
						<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
						
						<input type="hidden" name="pt_id" value="<?php echo $follow['pt_id']?>" />
						<input type="hidden" name="pt_name" value="<?php echo $follow['pt_name']?>" />
						<input type="hidden" name="department" value="<?php echo $follow['department']?>" />
						<input type="hidden" name="dr_name" value="<?php echo $follow['dr_name']?>" />
						<input type="hidden" name="fw_type" value="<?php echo $follow['fw_type']?>" />
						<input type="hidden" name="add_type" value="old" />
						
						<tr>
							<td><?php echo $follow['st_name']?></td>
							<td><?php echo $follow['pt_id']?></td>
							<td><?php echo $follow['pt_name']?></td>
							<td><?php echo $follow['department']?></td>
							<td><?php echo $follow['dr_name']?></td>
							<td><?php echo $follow['fw_type']?></td>
							<td><input type="submit" value="추가" class="btnblue" /></td>
						</tr>
						</form>
					<?php endforeach?>
				<?php endif?>
			</tbody>	
		</table>
			<!--
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
						<td><?php echo $FOLLOW['misc']?></td>
					</tr>
					<?php endforeach?>
				</tbody>
				</table>
			<?php endif?>-->
		<?php elseif(isset($fw_uid) && $fw_uid && $fw_uid!=''):?>
			<table>
			<form name="updateFollow" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="updateCheck(this.form)">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="a" value="update_follow" />
			<input type="hidden" name="c" value="<?php echo $c?>" />
			<input type="hidden" name="m" value="<?php echo $m?>" />
			
			<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
			<input type="hidden" name="pt_id" class="input" value="<?php echo $MOD_PT['pt_id']?>" />
			<input type="hidden" name="pt_uid" class="input" value="<?php echo $MOD_PT['pt_uid']?>" />
			<input type="hidden" name="fw_uid" class="input" value="<?php echo $MOD_PT['uid']?>" />
				<tr>
					<td>병록번호</td>
					<td>
						<?php echo $MOD_PT['pt_id']?>
					</td>
				</tr>
				<tr>
					<td>환자명</td>
					<td>
						<input type="text" name="pt_name" value="<?php echo $MOD_PT['pt_name']?>" />
					</td>
				</tr>
				<tr>
					<td>진료과</td>
					<td>
						<select name="department" id="department">
							<option value='def'>-Select Department-</option>
							<?php foreach($d['khusd_st_follow']['DEPT'] as $dept):?>
							<option value="<?php echo $dept?>"
								<?php if($dept==$MOD_PT['department']){ echo 'selected'; }?>
							>
								<?php echo $dept?>
							</option>
							<?php endforeach?>
						</select>
					</td>
				</tr>
				<tr>
					<td>담당의</td>
					<td>
						<div id="dr_def" class="dr_name" <?php if($MOD_PT['department']!=''){ echo "style='display: none;'";}?> name="sub_dr" onchange="ChangeDropdowns(this.value)">
							<select name="dr_name" id="dr_name">
								<option value=''>Select</option>
							</select>
						</div>
						<?php foreach($d['khusd_st_follow']['DEPT'] as $dept):?>
						<div id="<?php echo 'dr_'.$dept?>" class="dr_name" <?php if($MOD_PT['department']!=$dept){ echo "style='display: none;'";}?> name="sub_dr" onchange="ChangeDropdowns(this.value)">
							<select name="dr_name_<?php echo $dept?>" id="<?php echo 'dr_'.$dept?>">
								<?php foreach($d['khusd_st_follow']['DR'][$dept] as $dr):?>
								<option value="<?php echo $dr?>" <?php if($dr==$MOD_PT['dr_name']){ echo 'selected'; }?>><?php echo $dr?></option>
								<?php endforeach?>
							</select>
						</div>
						<?php endforeach?>
					</td>
				</tr>
				<tr>
					<td>팔로우 타입</td>
					<td>
						<div id="fw_def" class="fw_type" <?php if($MOD_PT['department']!=''){ echo "style='display: none;'";}?> name="sub_fw" onchange="ChangeDropdowns(this.value)">
							<select name="fw_type" id="fw_type">
								<option value=''>Select</option>
							</select>
						</div>
						<?php foreach($d['khusd_st_follow']['DEPT'] as $dept):?>
						<div id="<?php echo 'fw_'.$dept?>" class="fw_type" <?php if($MOD_PT['department']!=$dept){ echo "style='display: none;'";}?> name="sub_fw" onchange="ChangeDropdowns(this.value)">
							<select name="fw_type_<?php echo $dept?>" id="<?php echo 'fw_'.$dept?>">
								<?php foreach($d['khusd_st_follow']['FW_TYPE'][$dept] as $fw):?>
								<option value="<?php echo $fw?>" <?php if($fw==$MOD_PT['fw_type']){ echo 'selected'; }?>><?php echo $fw?></option>
								<?php endforeach?>
							</select>
						</div>
						<?php endforeach?>
					</td>
				</tr>
				<tr>
					<td>팔로우 횟수</td>
					<td>
						<input type="text" name="step" value="<?php echo $MOD_PT['step']?>" />
					</td>
				</tr>
				<tr>
					<td>팔로우 상태</td>
					<td>
						<select name="status" id="status">
							<?php foreach($d['khusd_st_follow']['STATUS'] as $stat):?>
							<option value="<?php echo strtolower(substr($stat,0,1));?>" <?php if(strtolower(substr($stat,0,1))==$MOD_PT['status']){ echo 'selected'; }?>><?php echo $stat?></option>
							<?php endforeach?>
						</select>
					</td>
				</tr>
				<tr>
					<td>비고</td>
					<td>
						<div id="misc_def" class="misc" <?php if($MOD_PT['department']!=''){ echo "style='display: none;'";}?> name="sub_misc" onchange="ChangeDropdowns(this.value)">
							<input type="text" name="misc" id="misc" value="" />
						</div>
						<?php foreach($d['khusd_st_follow']['DEPT'] as $dept):?>
							<div id="<?php echo 'misc_'.$dept?>" class="misc" <?php if($MOD_PT['department']!=$dept){ echo "style='display: none;'";}?> name="sub_misc" onchange="ChangeDropdowns(this.value)">
								<?php if($dept=='consv'):?>
									<select name="misc_<?php echo $dept?>" id="<?php echo 'misc_'.$dept?>">
										<?php foreach($d['khusd_st_follow']['MISC'][$dept] as $mi):?>
										<option value="#<?php echo $mi?>" <?php if(('#'.$mi)==$MOD_PT['misc']){ echo 'selected'; }?>>#<?php echo $mi?></option>
										<?php endforeach?>
									</select>
								<?php elseif($dept=='ortho'):?>
									Report <input type="checkbox" name="misc_<?php echo $dept?>" value="report" <?php if($MOD_PT['misc']=='report'){ echo 'checked'; }?>/>
								<?php else:?>
									<input type="text" name="misc_<?php echo $dept?>" id="<?php echo 'misc_'.$dept?>" value="" />
								<?php endif?>
							</div>
						<?php endforeach?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="수정" class="btnblue" />
					</td>
				</tr>
				</form>
			</table>
		<?php endif?>
	</div>

</div>

<script type="text/javascript">
	$("#department").change(function(){
		correspondingID = $(this).find(":selected").val();
		$(".dr_name").hide();
		$(".fw_type").hide();
		$(".misc").hide();
		$("#dr_" + correspondingID).show();
		$("#fw_" + correspondingID).show();
		$("#misc_" + correspondingID).show();
	});
	
	function updateFollowStatus(form)
	{	
		if(form.status.value == 'f')
		{
			alert('완료/포기 상태에서는 다시 팔로우 상태로 변경할 수 없습니다.');
			return;
		}
		
		form.submit();
	}
	
	function searchCheck(f) 
	{
		return confirm('환자를 검색하시겠습니까?');
	}
	
	function updateCheck(f) 
	{
		return confirm('정말로 수정하시겠습니까?');
	}
	
	function addCheck(f)
	{
		return confirm('정말로 추가하시겠습니까?');
	}
	
	function delCheck(f)
	{
		if(confirm('정말로 삭제하시겠습니까?')){
			return f.submit();
		}
	}
</script>