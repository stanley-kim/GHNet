<style>
	table{width:100%;}
	.khusd_st .my_follow thead th{background: #FDF5E6;}
	h3{color:blue;}
	#searchFollow {padding-left:10px;}
	h4{margin-bottom:5px;}
	.pt_info span{margin-right:20px;}
	.add_follow_table td{height:24px;}
	.add_follow_table tr td:first-child{background: #F4F4F4;}
	
	#ortho_follow select{height:24px;}
	tr.pt_row{background: #fffff4;}
	.khusd_st .my_follow tbody td p{font-size:12px;}
	#ortho_follow table td{padding: 6px 0 4px 0}
</style>

<?php if($show_previous == "1") :?>
<div id="ortho_follow" class="khusd_st follow ortho">
<script type=text/javascript>
function go_current(){
	document.location.href = document.location.href.replace("show_previous=1","");
}
</script>
<a href="javascript:go_current()" style="color:#5F9EA0;text-decoration:underline;">뒤로</a>
<h2><b style="color:red;">지난학기</b> 교정과 F/U 환자 관리</h2>
	<h3>&#8226;나의 팔로우 현황</h3>

	<?php if($MY_PREV_FOLLOW_ARRAY && is_array($MY_PREV_FOLLOW_ARRAY) && count($MY_PREV_FOLLOW_ARRAY) > 0):?>
	<div id="follow_list">
		<table class="my_follow">
			<thead>
				<tr>
					<th>번호</th>
					<th>환자명</th>
					<th>병록번호</th>
					<th>진료실</th>
					<th>담당교수님</th>
					<th>담당의(수련의)</th>
				</tr>
			</thead>
			<tbody>
				<?php $idx = 1?>
				<?php foreach($MY_PREV_FOLLOW_ARRAY as $MY_FOLLOW):?>
				<tr class='pt_row'>
					<td><?php echo $idx++?></td>
					<td><a href="<?php echo $g['khusd_st_ortho_search_follow'].$MY_FOLLOW['pt_id']?>"><?php echo $MY_FOLLOW['pt_name']?></a></td>
					<td><a href="<?php echo $g['khusd_st_ortho_search_follow'].$MY_FOLLOW['pt_id']?>"><?php echo $MY_FOLLOW['pt_id']?></a></td>
					<td><?php echo $MY_FOLLOW['dr_room']?></td>
					<td><?php echo $MY_FOLLOW['pf_name']?></td>
					<td><?php echo $MY_FOLLOW['dr_name']?></td>
				</tr>
				<tr>

					<td colspan=6>
						<p>상태: 
						<?php if($MY_FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'] && $MY_FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['FOLLOWING']):?>
						<b>신환 팔로 중</b>
						<?php elseif($MY_FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'] && $MY_FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['FOLLOWING']):?>
						<b>구환 팔로 중</b>
						<?php elseif($MY_FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'] && $MY_FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['COMPLETE']):?>
						<b style="color:blue">신환 완료</b>
						<?php elseif($MY_FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'] && $MY_FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['COMPLETE']):?>
						<b style="color:green">구환 완료</b>
						<?php else:?>
						<b style="color:red">팔로 중단</b>
						<?php endif?>
						
					 업데이트: <?php echo getDateFormat($MY_FOLLOW['date_update'], 'Y-m-d H:i')?></p></td>
					</td>
				</tr>
				<?php endforeach?>
			</tbody>
		</table>
	</div>
	<?php endif?>
</div>

<?php else: ?>
<div id="ortho_follow" class="khusd_st follow ortho">
<script type=text/javascript>
function check_previous(){
	document.location.href = document.location.href + "&show_previous=1";
}
</script>
<a href="javascript:check_previous()" style="color:#5F9EA0;text-decoration:underline;">이전 학기 팔로우 확인</a>
<h2>교정과 F/U 환자 관리</h2>
	<h3>&#8226;나의 팔로우 현황</h3>

	<?php if($MY_FOLLOW_ARRAY && is_array($MY_FOLLOW_ARRAY) && count($MY_FOLLOW_ARRAY) > 0):?>
	<div id="follow_list">
		<table class="my_follow">
			<thead>
				<tr>
					<th>번호</th>
					<th>환자명</th>
					<th>병록번호</th>
					<th>진료실</th>
					<th>담당교수님</th>
					<th>담당의(수련의)</th>
				</tr>
			</thead>
			<tbody>
				<?php $idx = 1?>
				<?php foreach($MY_FOLLOW_ARRAY as $MY_FOLLOW):?>
				<tr class='pt_row'>
					<td><?php echo $idx++?></td>
					<td><a href="<?php echo $g['khusd_st_ortho_search_follow'].$MY_FOLLOW['pt_id']?>"><?php echo $MY_FOLLOW['pt_name']?></a></td>
					<td><a href="<?php echo $g['khusd_st_ortho_search_follow'].$MY_FOLLOW['pt_id']?>"><?php echo $MY_FOLLOW['pt_id']?></a></td>
					<td><?php echo $MY_FOLLOW['dr_room']?></td>
					<td><?php echo $MY_FOLLOW['pf_name']?></td>
					<td><?php echo $MY_FOLLOW['dr_name']?></td>
				</tr>
				<tr>

					<td colspan=5>
						<p>상태: 
						<?php if($MY_FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'] && $MY_FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['FOLLOWING']):?>
						<b>신환 팔로 중</b>
						<?php elseif($MY_FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'] && $MY_FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['FOLLOWING']):?>
						<b>구환 팔로 중</b>
						<?php elseif($MY_FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'] && $MY_FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['COMPLETE']):?>
						<b style="color:blue">신환 완료</b>
						<?php elseif($MY_FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'] && $MY_FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['COMPLETE']):?>
						<b style="color:green">구환 완료</b>
						<?php else:?>
						<b style="color:red">팔로 중단</b>
						<?php endif?>
						
					 업데이트: <?php echo getDateFormat($MY_FOLLOW['date_update'], 'Y-m-d H:i')?></p></td>
					</td><td>
						<?php if($MY_FOLLOW['status'] != $d['khusd_st_ortho']['FOLLOW_STATUS']['DROP']):?>
						<span class="btn00"><a href="<?php echo $g['khusd_st_ortho_drop_follow'].$MY_FOLLOW['uid']?>">포기</a></span>
						<?php endif?>
						<?php if($MY_FOLLOW['status'] != $d['khusd_st_ortho']['FOLLOW_STATUS']['COMPLETE']):?>
						<span class="btn01"><a href="<?php echo $g['khusd_st_ortho_complete_follow'].$MY_FOLLOW['uid']?>">완료</a></span>
						<?php endif?>
						<?php if($MY_FOLLOW['status'] != $d['khusd_st_ortho']['FOLLOW_STATUS']['FOLLOWING']):?>
						<span class="btn02"><a href="<?php echo $g['khusd_st_ortho_go_follow'].$MY_FOLLOW['uid']?>">팔로우</a></span>
						<?php endif?>
					</td>

				</tr>
				<?php endforeach?>
			</tbody>
		</table>
	</div>
	<?php endif?>

	<h3>&#8226;팔로우 환자 검색</h3>

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


		<?php if($FOLLOW_ARRAY):?>
			<p style="line-height:20px;">동명 이인이 검색된 경우, 병록번호로 검색하여 팔로 환자를 추가하세요.</p>

		<div class="pt_info">
		<span id="pt_name" style="background:none;"><b>이름:</b> <?php echo $FOLLOW_PT['pt_name']?></span>
		<span id="pt_id" style="background:none;"><b>병록번호:</b> <?php echo $FOLLOW_PT['pt_id']?></span>
		<span id="status">
			<b>상태:</b> 
			<?php if($FOLLOW_PT['status'] == $d['khusd_st_ortho']['FOLLOW_PT']['FOLLOWING']):?>
			팔로 있음
			<?php else:?>
			팔로 없음!!!
			<?php endif?>
		</span>
		</div>
		
			<table>
			<thead>
				<tr>
					<th>번호</th>
					<th>학번</th>
					<th>이름</th>
					<th>상태</th>
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
					<td>
						<?php if($FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'] && $FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['FOLLOWING']):?>
						신환 팔로 중
						<?php elseif($FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'] && $FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['FOLLOWING']):?>
						구환 팔로 중
						<?php elseif($FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['NEW'] && $FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['COMPLETE']):?>
						<b style="color:blue">신환 완료</b>
						<?php elseif($FOLLOW['type']==$d['khusd_st_ortho']['FOLLOW_TYPE']['OLD'] && $FOLLOW['status'] == $d['khusd_st_ortho']['FOLLOW_STATUS']['COMPLETE']):?>
						<b style="color:green">구환 완료</b>
						<?php else:?>
						팔로 중단
						<?php endif?>
					</td>
					<td><?php echo getDateFormat($FOLLOW['date_update'], 'Y-m-d H:i')?></td>
				</tr>
				<?php endforeach?>
			</tbody>
			</table>
		<?php else:?>
		<?php endif?>
		
		<?php if(isset($nameOrId) && $nameOrId && $nameOrId != '' && !$FOLLOW_PT):?>
			해당 환자는 F/U 목록에 없습니다. 등록하시겠습니까?
			<form name="addFollow" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return updateCheck(this);">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="a" value="add_follow" />
			<input type="hidden" name="c" value="<?php echo $c?>" />
			<input type="hidden" name="m" value="<?php echo $m?>" />
			
			<input type="hidden" name="st_id" value="<?php echo $my['id']?>" />
			
			<table>
				<tr>
					<td>환자명</td>
					<td>
						<input type="text" name="pt_name"  class="input" value="<?php echo $nameOrId?>" />
					</td>
				</tr>
				<tr>
					<td>병록번호</td>
					<td>
						<input type="text" name="pt_id" class="input" value="<?php echo $nameOrId?>" />
					</td>
				</tr>
				<tr>
					<td>진료실 번호</td>
					<td id="select">
						<select name="dr_room" class="input">
							<option value="1">1번방</option>
							<option value="2">2번방</option>
							<option value="3">3번방</option>
							<option value="5">5번방</option>
							<option value="7">7번방</option>
							<option value="8">8번방</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>담당교수님(이름 세자만)</td>
					<td>
						<input type="text" name="pf_name" class="input" />
					</td>
				</tr>
				<tr>
					<td>담당의(수련의)</td>
					<td>
						<input type="text" name="dr_name" class="input" />
					</td>
				</tr>
				<tr>
					<td>신환이면 체크</td>
					<td>
						<input type="checkbox" name="new_pt" />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="등록" class="btnblue" />
					</td>
				</tr>
			</table>
			</form>
		<?php elseif($FOLLOW_PT):?>
		
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
					<td>진료실 번호</td>
					<td>
						<?php if(!$ABLE_FOLLOW):?>
						<select name="dr_room" class="input">
							<option value="1"<?php if($FOLLOW_PT['dr_room'] == 1):?> selected<?php endif?>>1번방</option>
							<option value="2"<?php if($FOLLOW_PT['dr_room'] == 2):?> selected<?php endif?>>2번방</option>
							<option value="3"<?php if($FOLLOW_PT['dr_room'] == 3):?> selected<?php endif?>>3번방</option>
							<option value="5"<?php if($FOLLOW_PT['dr_room'] == 5):?> selected<?php endif?>>5번방</option>
							<option value="7"<?php if($FOLLOW_PT['dr_room'] == 7):?> selected<?php endif?>>7번방</option>
							<option value="8"<?php if($FOLLOW_PT['dr_room'] == 8):?> selected<?php endif?>>8번방</option>
						</select>
						<?php else:?>
						<?php echo $FOLLOW_PT['dr_room']?>번방
						<?php endif?>
					</td>
				</tr>
				<tr>
					<td>담당교수님(이름 세자만)</td>
					<td>
						<?php if(!$ABLE_FOLLOW):?>
						<input type="text" name="pf_name" value="<?php echo $FOLLOW_PT['pf_name']?>" />
						<?php else:?>
						<?php echo $FOLLOW_PT['pf_name']?>
						<?php endif?>
					</td>
				</tr>
				<tr>
					<td>담당의(수련의)</td>
					<td>
						<?php if(!$ABLE_FOLLOW):?>
						<input type="text" name="dr_name" value="<?php echo $FOLLOW_PT['dr_name']?>" />
						<?php else:?>
						<?php echo $FOLLOW_PT['dr_name']?>
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
		
					<input type="hidden" name="dr_room" class="input" value="<?php echo $FOLLOW_PT['dr_room']?>" />
					<input type="hidden" name="pf_name" class="input" value="<?php echo $FOLLOW_PT['pf_name']?>" />
					<input type="hidden" name="dr_name" class="input" value="<?php echo $FOLLOW_PT['dr_name']?>" />

					<td>신환이면 체크</td>
					<td>
						<input type="checkbox" name="new_pt" />
					</td>
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
		
		<?php endif?>
	</div>

</div>
<?php endif ?>